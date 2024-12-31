<?php include 'header.php'; ?>

<div class="section gtk-section">
    <div class="container gtk-container">
        <?php
        // Validasi input ID agar hanya berupa angka
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            echo "<script>window.location='index.php'</script>";
            exit();
        }

        // Menggunakan prepared statement untuk menghindari SQL Injection
        $stmt = $conn->prepare("SELECT * FROM gtk WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Cek apakah data ditemukan
        if ($result->num_rows == 0) {
            echo "<script>window.location='index.php'</script>";
            exit();
        }

        // Ambil data sebagai objek
        $p = $result->fetch_object();
        ?>

        <!-- Menampilkan judul detail -->
        <h3 class="gtk-title"><?= htmlspecialchars($p->nama, ENT_QUOTES, 'UTF-8') ?></h3>

        <!-- Wrapper untuk detail -->
        <div class="gtk-wrapper">
            <!-- Validasi file gambar dan mencegah Directory Traversal -->
            <?php
            $allowed_path = realpath("uploads/gtk/" . basename($p->gambar));
            if (strpos($allowed_path, realpath("uploads/gtk/")) !== 0 || !file_exists($allowed_path)) {
                $image_path = 'default-image.png'; // Gambar default jika file tidak valid
            } else {
                $image_path = "uploads/gtk/" . htmlspecialchars($p->gambar, ENT_QUOTES, 'UTF-8');
            }
            ?>
            <!-- Gambar -->
            <img src="<?= $image_path ?>" class="gtk-image"
                alt="<?= htmlspecialchars($p->nama, ENT_QUOTES, 'UTF-8') ?>">

            <!-- Konten -->
            <div class="gtk-content">
                <?php
                // Sanitasi konten dengan nl2br dan htmlspecialchars untuk mencegah XSS
                $paragraphs = explode("\n", $p->keterangan);
                foreach ($paragraphs as $paragraph) {
                    echo '<p>' . nl2br(htmlspecialchars($paragraph, ENT_QUOTES, 'UTF-8')) . '</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>