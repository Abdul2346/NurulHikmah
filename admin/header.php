<?php
session_start();
include '../koneksi.php';
if (!isset($_SESSION['status_login'])) {
    echo "<script>window.location = '../login.php?msg=Harap Login Terlebih Dahulu!'</script>";
}
date_default_timezone_set("Asia/Jakarta");

$identitas = mysqli_query($conn, "SELECT * FROM pengaturan ORDER BY id DESC LIMIT 1");
$d = mysqli_fetch_object($identitas);
?>

<!DOCTYPE html>
<html>

<head>

    <link rel="icon" href="../uploads/identitas/<?= $d->favicon ?>">

    <link rel="apple-touch-icon" href="../uploads/identitas/<?= $d->favicon ?>">

    <link rel="icon" sizes="192x192" href="../uploads/identitas/<?= $d->favicon ?>">

    <link rel="msapplication-TileImage" content="../uploads/identitas/<?= $d->favicon ?>">

    <title>Panel Admin - <?= $d->nama ?></title>
    <link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-light">

    <!-- navbar -->
    <div class="navbar">

        <div class="container">

            <!-- navbar brand -->
            <h2 class="nav-brand float-left"><a href="index.php"><?= $d->nama ?></a></h2>

            <!-- navbar menu -->
            <ul class="nav-menu float-left">
                <li><a href="index.php">Dashboard</a></li>

                <?php if ($_SESSION['ulevel'] == 'Super Admin') { ?>

                <li><a href="admin.php">Admin</a></li>
                <li><a href="pendaftaran.php">Pendaftaran</a></li>

                <?php } elseif ($_SESSION['ulevel'] == 'Admin') { ?>

                <li><a href="gtk.php">Pengajar</a></li>
                <li><a href="galeri.php">Galeri</a></li>
                <li><a href="sosmed.php">Sosmed</a></li>
                <li><a href="informasi.php">Informasi</a></li>
                <li><a href="background.php">Background</a></li>
                <li>
                    <a href="#">Pengaturan <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown">
                        <li><a href="identitas-pesantren.php">Identitas Pesantren</a></li>
                        <li><a href="tentang-pesantren.php">Profil Pesantren</a></li>
                        <li><a href="pimpinan-pesantren.php">Pimpinan Pesantren</a></li>
                    </ul>
                </li>

                <?php } ?>

                <li>
                    <a href="#"><?= $_SESSION['uname'] ?> (<?= $_SESSION['ulevel'] ?>) <i
                            class="fa fa-caret-down"></i></a>

                    <!-- sub menu -->
                    <ul class="dropdown">
                        <li><a href="ubah-password.php">Ubah Password</a></li>
                        <li><a href="logout.php">Keluar</a></li>
                    </ul>
                </li>
            </ul>

            <div class="clearfix"></div>
        </div>

    </div>