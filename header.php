<?php
include 'koneksi.php';
date_default_timezone_set("Asia/Jakarta");

// Mengambil data pengaturan dengan prepared statement untuk mencegah SQL Injection
$stmt = $conn->prepare("SELECT * FROM pengaturan ORDER BY id DESC LIMIT 1");
$stmt->execute();
$result = $stmt->get_result();
$d = $result->fetch_object();

// Validasi data yang diambil
$favicon = htmlspecialchars($d->favicon ?? 'default-favicon.png', ENT_QUOTES, 'UTF-8');
$logo = htmlspecialchars($d->logo ?? 'default-logo.png', ENT_QUOTES, 'UTF-8');
$nama = htmlspecialchars($d->nama ?? 'Pesantren', ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" href="uploads/identitas/<?= $favicon ?>">
    <link rel="apple-touch-icon" href="uploads/identitas/<?= $favicon ?>">
    <link rel="icon" sizes="192x192" href="uploads/identitas/<?= $favicon ?>">
    <link rel="msapplication-TileImage" content="uploads/identitas/<?= $favicon ?>">

    <!-- Judul -->
    <title><?= $nama ?></title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>
    <!-- Header UI -->
    <div class="header-ui">
        <div class="container">
            <!-- Logo -->
            <div class="header-logo">
                <img src="uploads/identitas/<?= $logo ?>" width="70" alt="Logo <?= $nama ?>">
                <h2><a href="index.php"><?= $nama ?></a></h2>
            </div>

            <!-- Menu Desktop -->
            <ul class="header-menu-ui">
                <li><a href="index.php">Beranda</a></li>
                <li><a href="tentang-pesantren.php">Profil Pesantren</a></li>
                <li><a href="gtk.php">Pengajar</a></li>
                <li><a href="galeri.php">Galeri</a></li>
                <li><a href="informasi.php">Informasi</a></li>
                <li><a href="kontak.php">Kontak</a></li>
            </ul>

            <!-- Tombol Mobile Menu -->
            <div class="mobile-menu-btn-ui" id="hamburgerBtnUI" onclick="toggleMobileMenuUI()">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </div>

    <!-- Menu Mobile UI -->
    <div class="box-menu-mobile-ui" id="mobileMenuUI">
        <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="tentang-pesantren.php">Profil Pesantren</a></li>
            <li><a href="gtk.php">Pengajar</a></li>
            <li><a href="galeri.php">Galeri</a></li>
            <li><a href="informasi.php">Informasi</a></li>
            <li><a href="kontak.php">Kontak</a></li>
        </ul>
    </div>

    <script>
    function toggleMobileMenuUI() {
        var menu = document.getElementById('mobileMenuUI');
        var menuItems = menu.querySelectorAll('li');
        var hamburgerBtn = document.getElementById('hamburgerBtnUI');
        var icon = hamburgerBtn.querySelector('i');
        var header = document.querySelector('.header-ui');

        if (menu.classList.contains('open')) {
            menu.classList.remove('open');
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');

            menuItems.forEach(function(item, index) {
                setTimeout(function() {
                    item.classList.add('closing-item');
                }, index * 100);
            });

            setTimeout(function() {
                menu.style.display = 'none';
                menuItems.forEach(function(item) {
                    item.classList.remove('closing-item');
                });
            }, 500);

            header.classList.remove('menu-open');
        } else {
            menu.style.display = 'block';
            menu.classList.add('open');
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');

            menuItems.forEach(function(item, index) {
                setTimeout(function() {
                    item.classList.add('open-item');
                }, index * 100);
            });

            header.classList.add('menu-open');
        }
    }

    function closeMobileMenuOnScroll() {
        var menu = document.getElementById('mobileMenuUI');
        var hamburgerBtn = document.getElementById('hamburgerBtnUI');
        var icon = hamburgerBtn.querySelector('i');
        var header = document.querySelector('.header-ui');

        if (menu.classList.contains('open')) {
            menu.classList.remove('open');
            menu.style.display = 'none';
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
            header.classList.remove('menu-open');
        }
    }

    window.addEventListener('scroll', closeMobileMenuOnScroll);
    </script>
</body>

</html>
