<?php include 'header.php'; ?>

<div class="section informasi-section">
    <div class="container informasi-container">

        <?php
        // Validasi input ID agar hanya angka
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            echo "<script>window.location = 'index.php'</script>";
            exit();
        }

        // Gunakan prepared statement untuk menghindari SQL Injection
        $stmt = $conn->prepare("SELECT * FROM informasi WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Periksa apakah data ditemukan
        if ($result->num_rows == 0) {
            echo "<script>window.location = 'index.php'</script>";
            exit();
        }

        // Ambil data sebagai objek
        $p = $result->fetch_object();

        // Format tanggal
        $tanggal = DateTime::createFromFormat('Y-m-d H:i:s', $p->created_at);
        $formatted_date = $tanggal ? $tanggal->format('d M Y, H:i') : 'Tidak diketahui';
        ?>

        <!-- Menampilkan Judul dan Metadata -->
        <h1 class="informasi-title"><?= htmlspecialchars($p->judul, ENT_QUOTES, 'UTF-8') ?></h1>
        <small class="informasi-meta">Dibuat pada: <?= $formatted_date ?></small>

        <div class="informasi-wrapper">
            <!-- Validasi dan tampilkan gambar -->
            <?php
            $allowed_path = realpath("uploads/informasi/" . basename($p->gambar));
            if (strpos($allowed_path, realpath("uploads/informasi/")) !== 0 || !file_exists($allowed_path)) {
                $image_path = 'uploads/informasi/default-image.png'; // Gambar default
            } else {
                $image_path = "uploads/informasi/" . htmlspecialchars($p->gambar, ENT_QUOTES, 'UTF-8');
            }
            ?>
            <div class="informasi-image-container">
                <img src="<?= $image_path ?>" class="informasi-image"
                    alt="<?= htmlspecialchars($p->judul, ENT_QUOTES, 'UTF-8') ?>">
            </div>

            <!-- Menampilkan Konten -->
            <div class="informasi-content">
                <?php
                $paragraphs = explode("\n", $p->keterangan);
                foreach ($paragraphs as $paragraph) {
                    echo '<p>' . nl2br(htmlspecialchars($paragraph, ENT_QUOTES, 'UTF-8')) . '</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>