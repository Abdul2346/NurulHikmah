<?php
session_start();
include 'koneksi.php';

// Ambil data identitas untuk favicon
$query_identitas = "SELECT * FROM pengaturan LIMIT 1"; // Ganti query jika menggunakan tabel lain
$result_identitas = mysqli_query($conn, $query_identitas);
$d = mysqli_fetch_object($result_identitas);

// Ambil data background dari database
$query_bg = "SELECT * FROM background ORDER BY id DESC LIMIT 1";
$result_bg = mysqli_query($conn, $query_bg);
$background = mysqli_fetch_object($result_bg);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="icon" href="uploads/identitas/<?= $d->favicon ?>">

    <link rel="apple-touch-icon" href="uploads/identitas/<?= $d->favicon ?>">

    <link rel="icon" sizes="192x192" href="uploads/identitas/<?= $d->favicon ?>">

    <link rel="msapplication-TileImage" content="uploads/identitas/<?= $d->favicon ?>">

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style>
    body {
        background: url('uploads/background/<?= isset($background->background) ? $background->background : '' ?>') no-repeat center center fixed;
        background-size: cover;
    }
    </style>
</head>

<body>
    <div class="page-login">
        <div class="box box-login">
            <div class="box-header">
                Login
            </div>
            <div class="box-body">
                <?php
                if (isset($_GET['msg'])) {
                    echo "<div class='alert alert-error'>" . htmlspecialchars($_GET['msg']) . "</div>";
                }
                ?>
                <form action="" method="POST">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="user" placeholder="Username" class="input-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="pass" placeholder="Password" class="input-control" required>
                    </div>
                    <input type="submit" name="submit" value="Login" class="btn">
                </form>

                <?php
                if (isset($_POST['submit'])) {
                    $user = mysqli_real_escape_string($conn, $_POST['user']);
                    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

                    $cek = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$user'");
                    if (mysqli_num_rows($cek) > 0) {
                        $d = mysqli_fetch_object($cek);
                        if (md5($pass) == $d->password) {
                            $_SESSION['status_login'] = true;
                            $_SESSION['uid'] = $d->id;
                            $_SESSION['uname'] = $d->nama;
                            $_SESSION['ulevel'] = $d->level;
                            echo "<script>window.location = 'admin/index.php'</script>";
                        } else {
                            echo '<div class="alert alert-error">Password salah</div>';
                        }
                    } else {
                        echo '<div class="alert alert-error">Username tidak ditemukan</div>';
                    }
                }
                ?>
            </div>
            <div class="box-footer">
                <a href="index.php">Halaman Utama</a>
            </div>
        </div>
    </div>
</body>

<!-- Tambahkan script JavaScript di sini -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.display = 'none';
        }, 3000); // Alert akan hilang setelah 3 detik
    });
});
</script>

</html>
