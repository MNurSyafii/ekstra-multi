<?php
$page=isset($_GET['page']) ? $_GET['page'] : 'home';
if ($page=='home') include 'home.php';
if ($page=='berita') include 'beritatampil.php';
if ($page=='galeri') include 'galeritampil.php';
if ($page=='organisasi') include 'organisasitampil.php';
if ($page=='pendaftaran') include 'forms.php';

?>
