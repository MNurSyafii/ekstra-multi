<?php
include("koneksi.php");

if (isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $allowed_extensions = array('png', 'jpg', 'jpeg');
    $file_name = $_FILES['file']['name'];
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];

    // Check if the file extension is allowed
    if (in_array($file_extension, $allowed_extensions)) {
        // Check if the file size is within the allowed limit
        if ($file_size < 1044070) {
            $upload_dir = './image/';
            
            // Buat folder jika belum ada
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Generate unique file name
            $new_file_name = uniqid() . '.' . $file_extension;
            $upload_path = $upload_dir . $new_file_name;

            // Move the uploaded file
            if (move_uploaded_file($file_tmp, $upload_path)) {
                $tanggal = date("Y-m-d");
                $stmt = $koneksi->prepare("INSERT INTO tb_berita (judul, tanggal, isi, gambar) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $judul, $tanggal, $isi, $new_file_name);

                if ($stmt->execute()) {
                    header("Location: beritatampil.php");
                    exit();
                } else {
                    echo '<div class="alert alert-danger mt-3">Gagal menyimpan ke database.</div>';
                }
                $stmt->close();
            } else {
                echo '<div class="alert alert-danger mt-3">Gagal meng-upload gambar.</div>';
            }
        } else {
            echo '<div class="alert alert-warning mt-3">Ukuran file terlalu besar (maksimal 1 MB).</div>';
        }
    } else {
        echo '<div class="alert alert-warning mt-3">Ekstensi file tidak diperbolehkan. Hanya png, jpg, atau jpeg yang diizinkan.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Tambah Berita</h4>
                    <!-- Home icon link to index.php -->
                    <a href="index.php" class="text-white" title="Kembali ke Home">
                        <i class="bi bi-house-fill"></i>
                    </a>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Berita</label>
                            <input type="text" name="judul" class="form-control" placeholder="Masukkan judul berita" required>
                        </div>
                        <div class="mb-3">
                            <label for="isi" class="form-label">Isi Berita</label>
                            <textarea name="isi" class="form-control" rows="5" placeholder="Masukkan isi berita" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Gambar</label>
                            <input type="file" name="file" class="form-control">
                            <small class="form-text text-muted">Ekstensi yang diperbolehkan: .png, .jpg, .jpeg (maksimal 1 MB).</small>
                        </div>
                        <button type="submit" name="tambah" class="btn btn-success w-100">Tambah Berita</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
