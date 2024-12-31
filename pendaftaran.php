<?php
session_start(); // Memulai session untuk menyimpan status alert
include 'koneksi.php'; // Pastikan file koneksi database sudah ada

// Ambil data identitas untuk favicon
$query_identitas = "SELECT * FROM pengaturan LIMIT 1"; // Sesuaikan nama tabel
$result_identitas = mysqli_query($conn, $query_identitas);
$d = mysqli_fetch_object($result_identitas);

// Fungsi untuk mengurutkan ID
function reorderIds($conn)
{
    // Ambil semua data dari tabel dan urutkan berdasarkan ID
    $query = "SELECT id FROM pendaftaran ORDER BY id ASC";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $counter = 1; // Mulai dari ID 1
        while ($row = mysqli_fetch_assoc($result)) {
            $current_id = $row['id'];
            // Update ID ke nilai baru yang berurutan jika tidak sama
            if ($current_id != $counter) {
                $update_query = "UPDATE pendaftaran SET id = $counter WHERE id = $current_id";
                mysqli_query($conn, $update_query);
            }
            $counter++;
        }
    }
}

// Proses data setelah formulir dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, htmlspecialchars($_POST['nama']));
    $email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
    $no_telp = mysqli_real_escape_string($conn, htmlspecialchars($_POST['no_telp']));
    $jenis_kelamin = mysqli_real_escape_string($conn, htmlspecialchars($_POST['jenis_kelamin']));

    // Query untuk menyimpan data
    $sql = "INSERT INTO pendaftaran (nama, email, no_telp, jenis_kelamin) VALUES ('$nama', '$email', '$no_telp', '$jenis_kelamin')";
    if (mysqli_query($conn, $sql)) {
        reorderIds($conn); // Panggil fungsi reorderIds setelah penambahan data

        // Set session untuk status berhasil
        $_SESSION['alert'] = "Pendaftaran berhasil. Kami akan segera menghubungi Anda.";
        $_SESSION['alert_type'] = 'success'; // Set jenis alert
        header("Location: pendaftaran.php");
        exit;
    } else {
        // Jika gagal, set session untuk status error
        $_SESSION['alert'] = "Gagal mendaftar. Silakan coba lagi.";
        $_SESSION['alert_type'] = 'error'; // Set jenis alert
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pondok Pesantren - <?= htmlspecialchars($d->nama) ?></title>
    <link rel="icon" href="uploads/identitas/<?= $d->favicon ?>">

    <link rel="apple-touch-icon" href="uploads/identitas/<?= $d->favicon ?>">

    <link rel="icon" sizes="192x192" href="uploads/identitas/<?= $d->favicon ?>">

    <link rel="msapplication-TileImage" content="uploads/identitas/<?= $d->favicon ?>">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Cache Control to prevent browser caching -->
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="Sat, 26 Jul 1997 05:00:00 GMT">
</head>

<body>
    <header>
        <h1>Pendaftaran Pondok Pesantren Nurul Hikmah</h1>
        <p>Isi formulir di bawah ini untuk mendaftar.</p>
    </header>

    <div class="container">
        <section class="registration-form">
            <h2>Formulir Pendaftaran</h2>

            <!-- Tampilkan alert berdasarkan session -->
            <?php
            if (isset($_SESSION['alert'])) {
                echo '<div class="alert ' . ($_SESSION['alert_type'] == 'success' ? 'alert-success' : 'alert-error') . '">
                        <i class="' . ($_SESSION['alert_type'] == 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-triangle') . '"></i> ' . $_SESSION['alert'] . '
                      </div>';
                unset($_SESSION['alert']);
                unset($_SESSION['alert_type']);
            }
            ?>

            <form action="pendaftaran.php" method="POST" autocomplete="off">
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap Anda" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required>
                </div>
                <div class="form-group">
                    <label for="no-telp">No. Telepon</label>
                    <input type="text" id="no-telp" name="no_telp" placeholder="Masukkan nomor telepon Anda" required>
                </div>
                <div class="form-group">
                    <label for="jenis-kelamin">Pilih Jenis Kelamin</label>
                    <select id="jenis-kelamin" name="jenis_kelamin" required>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-blue">Daftar Sekarang</button>
                </div>
            </form>
        </section>
    </div>

    <script>
    // Hilangkan alert setelah 3 detik
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                alert.style.display = 'none';
            }, 3000);
        });

        // Reset form ketika halaman dimuat
        const form = document.querySelector('form');
        if (form) {
            form.reset();
        }
    });
    </script>
</body>

</html>