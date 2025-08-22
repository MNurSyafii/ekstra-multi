<?php

// Cek apakah sesi login aktif
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header('Location: login.php'); // Arahkan ke halaman login jika sesi tidak valid
    exit();
}
?>
<div class="d-flex left-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
        
      </div>

      <div class="jumbotron">
      <h1 class="display-4">Hello <?php echo $_SESSION['username'];?></h1>
      <p class="lead">Have fun :).</p>
      <hr class="my-4">
      <p>Kamu bisa melihat web multimedia melalui tombol yang ada dibawah.</p>
      <a class="btn btn-primary btn-lg" href="../index.php" role="button">Menuju web MM</a>
  </div>
  </div>
  </div>