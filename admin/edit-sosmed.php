<?php include 'header.php'; ?>

<!-- content -->
<div class="content">

    <div class="container">

        <div class="box">

            <div class="box-header">
                Edit Video
            </div>

            <div class="box-body">

                <?php
                // Fungsi validasi input
                function validasi_input($data)
                {
                    return htmlspecialchars(stripslashes(trim($data)));
                }

                // Mendapatkan ID dari URL
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    // Mengambil data dari database berdasarkan ID
                    $stmt = $conn->prepare("SELECT * FROM videos WHERE id = ?");
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();

                    // Periksa apakah data ditemukan
                    if ($row) {
                        $video_url = $row['video_url'];
                        $description = $row['description'];
                    } else {
                        echo "<div class='alert alert-error'>Data tidak ditemukan!</div>";
                    }

                    $stmt->close();
                } else {
                    echo "<div class='alert alert-error'>ID tidak ditemukan!</div>";
                }

                // Update Data
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $video_url = validasi_input($_POST['video_url']);
                    $description = validasi_input($_POST['description']);

                    // Menggunakan prepared statement untuk update data
                    $stmt = $conn->prepare("UPDATE videos SET video_url = ?, description = ? WHERE id = ?");
                    $stmt->bind_param("ssi", $video_url, $description, $id);

                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success' id='alert'>Data berhasil diupdate!</div>";
                    } else {
                        echo "<div class='alert alert-error' id='alert'>Error: " . $stmt->error . "</div>";
                    }

                    $stmt->close();
                }
                ?>

                <form action="" method="POST">
                    <div class="form-group">
                        <label for="video_url">URL Video YouTube</label>
                        <input type="text" name="video_url" class="input-control"
                            value="<?php echo isset($video_url) ? $video_url : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi Video</label>
                        <textarea name="description" class="input-control"
                            required><?php echo isset($description) ? $description : ''; ?></textarea>
                    </div>

                    <button type="submit" name="submit" class="btn btn-blue">Update</button>
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