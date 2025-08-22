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
    .card {
        margin-bottom: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden; /* Penting agar gambar tidak meluap */
    }
    .card img {
        width: 100%; /* Pastikan gambar mengisi lebar card */
        height: auto; /* Proporsionalitas gambar tetap terjaga */
        object-fit: cover; /* Potong gambar jika terlalu besar */
    }
    .card-body {
        text-align: center; /* Opsional: untuk memusatkan teks */
    }
    .news-title {
        font-weight: bold;
        font-size: 1.25rem;
    }
    .card-text {
        font-size: 0.9rem;
        color: #6c757d;
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
                            <a href="berita.php" class="nav-item nav-link ">Berita</a>
                            <a href="struktur.php" class="nav-item nav-link active">Struktur</a>
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
       
        <div class="container mt-5">

    <?php
    require "koneksi.php";

    // Query untuk pembina (misal jabatan = 'Pembina')
    $pembinaQuery = mysqli_query($koneksi, "SELECT * FROM tb_organisasi WHERE jabatan = 'Pembina' LIMIT 1");
    if ($pembina = mysqli_fetch_array($pembinaQuery)) {
    ?>
    <!-- Card untuk Pembina -->
    <div class="card">
    <img src="admin/image1/<?php echo htmlspecialchars($pembina['gambar']); ?>" alt="Pembina" class="img-fluid">
    <div class="card-body">
        <h5 class="card-title">Pembina</h5>
        <p class="card-text"><?php echo htmlspecialchars($pembina['nama']); ?></p>
        <p class="card-text text-muted"><?php echo htmlspecialchars($pembina['kelas']); ?></p>
    </div>
</div>
    <?php } ?>

    <!-- Card untuk Anggota -->
    <div class="row">
        <?php
        // Query untuk anggota (selain pembina)
        $anggotaQuery = mysqli_query($koneksi, "SELECT * FROM tb_organisasi WHERE jabatan != 'Pembina' ORDER BY id DESC");
        while ($anggota = mysqli_fetch_array($anggotaQuery)) {
        ?>
        <div class="col-md-4">
    <div class="card">
        <img src="admin/image1/<?php echo htmlspecialchars($anggota['gambar']); ?>" class="card-img-top" alt="Anggota">
        <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($anggota['nama']); ?></h5>
            <p class="card-text"><?php echo htmlspecialchars($anggota['jabatan']); ?></p>
            <p class="card-text text-muted"><?php echo htmlspecialchars($anggota['kelas']); ?></p>
        </div>
    </div>
</div>
        <?php } ?>
    </div>
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
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        
        <!-- Contact Javascript File -->
        <script src="mail/jqBootstrapValidation.min.js"></script>
        <script src="mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
