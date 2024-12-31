<?php include 'header.php'; ?>

<!-- content -->
<div class="content">
    <div class="container">
        <div class="box">
            <div class="box-header">
                Tambah Video
            </div>
            <div class="box-body">
                <?php
                // Fungsi validasi input
                function validasi_input($data)
                {
                    return htmlspecialchars(stripslashes(trim($data)));
                }

                // Fungsi untuk memeriksa URL YouTube
                function isValidYoutubeUrl($url)
                {
                    // Regex untuk memeriksa URL YouTube
                    $pattern = '/^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$/';
                    return preg_match($pattern, $url);
                }

                // Tambah Data
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $video_url = validasi_input($_POST['video_url']);
                    $description = validasi_input($_POST['description']);

                    if (isValidYoutubeUrl($video_url)) {
                        // Menggunakan prepared statement
                        $stmt = $conn->prepare("INSERT INTO videos (video_url, description) VALUES (?, ?)");
                        $stmt->bind_param("ss", $video_url, $description);

                        if ($stmt->execute()) {
                            echo "<div class='alert alert-success' id='alert'>Data berhasil ditambahkan!</div>";
                        } else {
                            echo "<div class='alert alert-error' id='alert'>Error: " . $stmt->error . "</div>";
                        }

                        $stmt->close();
                    } else {
                        echo "<div class='alert alert-error' id='alert'>URL YouTube tidak valid!</div>";
                    }
                }
                ?>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="video_url">URL Video YouTube</label>
                        <input type="text" name="video_url" class="input-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi Video</label>
                        <textarea name="description" class="input-control" required></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-blue">Simpan</button>
                    <a href="sosmed.php" class="btn btn-red">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Menghilangkan alert setelah 3 detik
setTimeout(function() {
    var alert = document.getElementById('alert');
    if (alert) {
        alert.style.display = 'none';
    }
}, 3000);
</script>

<?php include 'footer.php'; ?>