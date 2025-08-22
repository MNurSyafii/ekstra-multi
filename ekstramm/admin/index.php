<?php
session_start();
// Cek apakah sesi login aktif
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header('Location: login.php'); // Arahkan ke halaman login jika sesi tidak valid
    exit();
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dashboard Admin Web Berita Benny">
    <meta name="author" content="Syafi'i">

    <title>Dashboard Admin</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Poppins', sans-serif;
        }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(145deg, #2c3e50, #34495e);
            color: #ecf0f1;
            min-height: 100vh;
            width: 240px;
            transition: all 0.3s;
            position: fixed;
            z-index: 1030;
            padding-top: 20px;
        }

        .sidebar a {
            color: #bdc3c7;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 5px;
            margin: 5px 15px;
            transition: all 0.3s;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        /* Hide text when sidebar is collapsed */
        .sidebar.toggled a span {
            display: none;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #1abc9c;
            color: #fff;
        }

        .sidebar.toggled {
            width: 60px;
        }

        .sidebar.toggled a {
            text-align: center;
            padding: 10px 0;
        }

        .sidebar.toggled .nav-item i {
            font-size: 20px;
        }

        /* Main Content */
        #content-wrapper {
            margin-left: 240px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        #content-wrapper.toggled {
            margin-left: 60px;
        }

        .topbar {
            background-color: #1abc9c;
            color: white;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar button {
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            transition: all 0.3s;
        }

        .topbar button:hover {
            color: #16a085;
        }

        .logout-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        .card-header {
            background-color: #1abc9c;
            color: white;
            font-weight: bold;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: static;
                height: auto;
                padding-top: 15px;
            }

            .sidebar.toggled {
                width: 100%;
            }

            #content-wrapper {
                margin-left: 0;
            }

            #content-wrapper.toggled {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <a href="?page=home" class="active"><i class="fas fa-home"></i><span>Dashboard</span></a>
        <a href="?page=berita"><i class="fas fa-newspaper"></i><span>Berita</span></a>
        <a href="?page=galeri"><i class="fas fa-image"></i><span>Galeri</span></a>
        <a href="?page=organisasi"><i class="fas fa-users"></i><span>Organisasi</span></a>
        <a href="?page=pendaftaran"><i class="fas fa-user-plus"></i><span>Pendaftaran</span></a>
    </div>

    <!-- Content Wrapper -->
    <div id="content-wrapper">
        <!-- Topbar -->
        <div class="topbar">
            <button id="toggleSidebar"><i class="fas fa-bars"></i></button>
            <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>

        <!-- Main Content -->
        <div class="container mt-4">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <?php include 'main.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Script -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const contentWrapper = document.getElementById('content-wrapper');
        const toggleSidebar = document.getElementById('toggleSidebar');

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('toggled');
            contentWrapper.classList.toggle('toggled');
        });
    </script>
</body>

</html>
