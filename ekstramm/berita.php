<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> 
        
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    <title>Daftar Berita</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .news-card {
            margin-bottom: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .news-card img {
            max-height: 150px;
            object-fit: cover;
        }
        .truncate-text {
            max-height: 3.6em;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3; /* Limit to 3 lines */
            -webkit-box-orient: vertical;
        }
        .news-title {
            font-weight: bold;
            font-size: 1.25rem;
        }
        .detail-title {
            font-size: 2rem;
            font-weight: bold;
        }
        .detail-img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

       <!-- Top Bar Start -->
           <div class="top-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-12">
                        <div class="logo">
                            <a href="index.php">
                                <h1>Multi<span>Media</span></h1> 
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7 d-none d-lg-block">
                        <div class="row">
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="fa fa-phone-alt"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Telp</h3>
                                        <p>+62 812-2625-9514</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="far fa-envelope"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Email Us</h3>
                                        <p>mm@smkn1bawang.sch.id</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Bar End -->

        <!-- Nav Bar Start -->
        <div class="nav-bar">
            <div class="container">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
                    <a href="#" class="navbar-brand">MENU</a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <a href="about.php" class="nav-item nav-link">Tentang</a>
                            <a href="berita.php" class="nav-item nav-link active">Berita</a>
                            <a href="struktur.php" class="nav-item nav-link">Struktur</a>
                            <a href="galeri.php" class="nav-item nav-link">Galeri</a>
                            <a href="pendaftaran.php" class="nav-item nav-link">Pendaftaran</a>

                        </div>
                        <div class="ml-auto">
                            <a class="btn btn-custom" href="admin/login.php">Admin</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Nav Bar End -->


        <div class="container my-5">

    <!-- Search Form -->
    <form action="" method="post" class="mb-4">
        <div class="input-group">
            <input type="text" name="pencarian" class="form-control" placeholder="Cari berita..." value="<?php echo isset($_POST['pencarian']) ? $_POST['pencarian'] : ''; ?>">
            <button type="submit" name="dicari" class="btn btn-primary">Cari</button>
        </div>
    </form>

    <?php
    require "koneksi.php";

    if (isset($_GET['id'])) {
        // Tampilkan detail berita
        $id = intval($_GET['id']);
        $query = mysqli_query($koneksi, "SELECT * FROM tb_berita WHERE idberita = $id");
        $data = mysqli_fetch_array($query);

        if ($data) {
            $gambarPath = "admin/image/" . $data['gambar']; // Path gambar
    ?>
        <!-- Detail Berita -->
        <div class="card mb-5">
            <div class="card-body">
                <h3 class="detail-title"><?php echo $data['judul']; ?></h3>
                <p class="text-muted mb-4"><?php echo date('d M Y', strtotime($data['tanggal'])); ?></p>
                <img src="<?php echo $gambarPath; ?>" alt="Gambar Berita" class="detail-img">
                <p><?php echo nl2br($data['isi']); ?></p>
                <a href="berita.php" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    <?php
        } else {
            echo "<p class='text-danger'>Berita tidak ditemukan.</p>";
        }
    } else {
        // Tampilkan daftar berita
        if (isset($_POST['dicari']) && !empty($_POST['pencarian'])) {
            $pencarian = mysqli_real_escape_string($koneksi, $_POST['pencarian']);
            $sql = mysqli_query($koneksi, "SELECT * FROM tb_berita WHERE judul LIKE '%$pencarian%' ORDER BY idberita DESC");
        } else {
            $sql = mysqli_query($koneksi, "SELECT * FROM tb_berita ORDER BY idberita DESC");
        }
    ?>

<div class="row">
    <?php
    while ($data = mysqli_fetch_array($sql)) {
        // Perbaiki path gambar
        $gambarPath = "admin/image/" . $data['gambar']; // Tambahkan '/' setelah 'image'
    ?>
    <div class="col-md-4">
        <div class="card news-card">
            <img src="<?php echo $gambarPath; ?>" class="card-img-top" alt="Gambar Berita">
            <div class="card-body">
                <h5 class="news-title"><?php echo $data['judul']; ?></h5>
                <p class="text-muted mb-2"><?php echo date('d M Y', strtotime($data['tanggal'])); ?></p>
                <p class="card-text truncate-text"><?php echo $data['isi']; ?></p>
                <a href="berita.php?id=<?php echo $data['idberita']; ?>" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div>
    <?php
    }
    ?>
</div>


        <!-- Footer Start -->
       <?php
        include 'footer.php';
       ?>
        <!-- Footer End -->
        
        <!-- Back to top button -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        
        <!-- Pre Loader -->
        <div id="loader" class="show">
            <div class="loader"></div>
        </div>

          <!-- JavaScript Libraries -->
          <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        
        <!-- Contact Javascript File -->
        <script src="mail/jqBootstrapValidation.min.js"></script>
        <script src="mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
