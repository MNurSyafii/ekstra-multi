<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Multimedia</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free Website Template" name="keywords">
        <meta content="Free Website Template" name="description">
        <link href="img/favicon.ico" rel="icon">
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> 
        
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>
    <style>
    </style>
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
                            <a href="berita.php" class="nav-item nav-link">Berita</a>
                            <a href="struktur.php" class="nav-item nav-link">Struktur</a>
                            <a href="galeri.php" class="nav-item nav-link">Galeri</a>
                            <a href="pendaftaran.php" class="nav-item nav-link active">Pendaftaran</a>

                        </div>
                        <div class="ml-auto">
                            <a class="btn btn-custom" href="admin/login.php">Admin</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Nav Bar End -->

       
        <div class="container">
    <hr>

    <?php
    require "koneksi.php"; // Pastikan koneksi database tersedia
    
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $NIS = input($_POST["NIS"]);
        $namalengkap = input($_POST["namalengkap"]);
        $kelas = input($_POST["kelas"]);
        $nohp = input($_POST["nohp"]);
        $email = input($_POST["email"]);
        $alamat = input($_POST["alamat"]);

        // Query untuk memasukkan data ke database
        $sql = "INSERT INTO tb_form (NIS, namalengkap, kelas, nohp, email, alamat) VALUES ('$NIS', '$namalengkap', '$kelas', '$nohp', '$email', '$alamat')";
        
        $hasil = mysqli_query($koneksi, $sql);

        if ($hasil) {
            echo "<div class='alert alert-success'>Pendaftaran berhasil! Terima kasih sudah mendaftar.</div>";
        } else {
            echo "<div class='alert alert-danger'>Pendaftaran gagal! Silakan coba lagi.</div>";
        }
    }
    ?>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="form-group mb-3">
            <label for="NIS" class="form-label">NIS:</label>
            <input type="text" name="NIS" class="form-control" placeholder="Masukkan NIS Anda" required pattern="\d+" title="Hanya angka diperbolehkan" />
        </div>
        
        <div class="form-group mb-3">
            <label for="namalengkap" class="form-label">Nama Lengkap:</label>
            <input type="text" name="namalengkap" class="form-control" placeholder="Masukkan nama lengkap" required />
        </div>
        
        <div class="form-group mb-3">
            <label for="kelas" class="form-label">Kelas:</label>
            <input type="text" name="kelas" class="form-control" placeholder="Masukkan kelas" required />
        </div>
        
        <div class="form-group mb-3">
            <label for="nohp" class="form-label">No. Tlp:</label>
            <input type="tel" name="nohp" class="form-control" placeholder="Masukkan no. telepon" required pattern="\d{10,15}" title="Harap masukkan no. telepon yang valid, 10-15 digit angka" />
        </div>
        
        <div class="form-group mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" placeholder="Masukkan email" required />
        </div>
        
        <div class="form-group mb-3">
            <label for="alamat" class="form-label">Alamat:</label>
            <textarea name="alamat" class="form-control" placeholder="Masukkan alamat lengkap" required></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-primary btn-block mt-3">Daftar</button>
    </form>
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
</php>
