<?php
include 'header.php';
?>

<!-- content -->
<div class="content">

    <div class="container">

        <div class="box">

            <div class="box-header">
                Background
            </div>

            <div class="box-body">

                <?php
                if (isset($_GET['success'])) {
                    echo "<div class='alert alert-success'>" . $_GET['success'] . "</div>";
                }

                // Ambil data background berdasarkan ID
                $query = "SELECT * FROM background ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($conn, $query);
                $p = mysqli_fetch_object($result);
                ?>

                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Background</label>
                        <?php if (isset($p) && isset($p->background)): ?>
                        <img src="../uploads/background/<?= $p->background ?>" width="200px" class="image">
                        <?php else: ?>
                        <p>Background tidak ditemukan.</p>
                        <?php endif; ?>
                        <input type="hidden" name="foto_lama" value="<?= isset($p) ? $p->background : '' ?>">
                        <input type="file" name="foto_baru" class="input-control">
                    </div>

                    <input type="submit" name="submit" value="Simpan Perubahan" class="btn btn-blue">

                </form>

                <?php

                if (isset($_POST['submit'])) {

                    $currdate = date('Y-m-d H:i:s');

                    if ($_FILES['foto_baru']['name'] != '') {

                        $filename   = $_FILES['foto_baru']['name'];
                        $tmpname    = $_FILES['foto_baru']['tmp_name'];
                        $filesize   = $_FILES['foto_baru']['size'];

                        $formatfile = pathinfo($filename, PATHINFO_EXTENSION);
                        $rename      = 'background' . time() . '.' . $formatfile;

                        $allowedtype = array('png', 'jpg', 'jpeg', 'gif');

                        if (!in_array($formatfile, $allowedtype)) {
                            echo '<div class="alert alert-error">Format file background tidak diizinkan.</div>';
                            return false;
                        } elseif ($filesize > 5000000) {
                            echo '<div class="alert alert-error">Ukuran file background tidak boleh lebih dari 5 MB.</div>';
                            return false;
                        } else {
                            if (isset($p) && isset($p->background) && file_exists("../uploads/background/" . $p->background)) {
                                unlink("../uploads/background/" . $p->background);
                            }

                            move_uploaded_file($tmpname, "../uploads/background/" . $rename);
                        }
                    } else {
                        $rename     = $_POST['foto_lama'];
                    }

                    $query_update = "UPDATE background SET
                                    background = '" . $rename . "',
                                    updated_at = '" . $currdate . "'
                                    WHERE id = '" . $p->id . "'";

                    $update = mysqli_query($conn, $query_update);

                    if ($update) {
                        echo "<script>window.location='background.php?success=Edit Data Berhasil'</script>";
                    } else {
                        echo 'Gagal edit: ' . mysqli_error($conn);
                    }
                }

                ?>

            </div>

        </div>

    </div>

</div>

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

<?php include 'footer.php' ?>