<?php
include("koneksi.php");


if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $kelas = $_POST['kelas'];
    $allowed_extensions = array('png', 'jpg', 'jpeg');
    $file_name = $_FILES['file']['name'];
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];

    // Cek apakah ekstensi file diperbolehkan
    if (in_array($file_extension, $allowed_extensions)) {
        // Cek ukuran file
        if ($file_size < 1044070) {
            $upload_dir = './image1/';
            
            // Buat folder jika belum ada
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Generate nama file unik
            $new_file_name = uniqid() . '.' . $file_extension;
            $upload_path = $upload_dir . $new_file_name;

            // Pindahkan file yang diupload
            if (move_uploaded_file($file_tmp, $upload_path)) {
                // Gunakan prepared statement untuk mencegah SQL injection
                $stmt = $koneksi->prepare("INSERT INTO tb_organisasi (nama, jabatan, kelas, gambar) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $nama, $jabatan, $kelas, $new_file_name);

                if ($stmt->execute()) {
                    header("Location: organisasitampil.php");
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
    <title>Tambah Struktur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    /* Style the navbar and content */
    .bg-company-red { background-color: #d9534f; }
        .nav-link { color: white !important; font-weight: bold; padding: 8px 15px; }
        .navbar-brand, .navbar-nav .nav-link { display: flex; align-items: center; }
        .navbar-brand .icon, .nav-link .icon { margin-right: 8px; font-size: 1.2em; }
        .navbar-collapse { justify-content: space-between; }
        .welcome-section { margin-top: 20px; }
        .card-icon { font-size: 2.5em; color: #d9534f; }
        .card-body p { font-size: 1.1em; color: #333; }
</style>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Struktur</h4>
                    </a>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <textarea name="jabatan" class="form-control" rows="1" placeholder="Masukkan isi jabatan" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <textarea name="kelas" class="form-control" rows="1" placeholder="Masukkan kelas" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Gambar</label>
                            <input type="file" name="file" class="form-control" required>
                            <small class="form-text text-muted">Ekstensi yang diperbolehkan: .png, .jpg, .jpeg (maksimal 1 MB).</small>
                        </div>
                        <button type="submit" name="tambah" class="btn btn-success w-100">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
