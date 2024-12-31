<?php include 'header.php' ?>

<!-- content -->
<div class="content">

    <div class="container">

        <div class="box">

            <div class="box-header">
                Tentang Pesantren
            </div>

            <div class="box-body">

                <?php
                if (isset($_GET['success'])) {
                    echo "<div class='alert alert-success'>" . $_GET['success'] . "</div>";
                }
                ?>

                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Tentang Pesantren</label>
                        <textarea name="tentang" class="input-control" placeholder="Tentang Pesantren"
                            id="keterangan"><?= $d->tentang_pesantren ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Foto Pesantren</label>
                        <img src="../uploads/identitas/<?= $d->foto_pesantren ?>" width="200px" class="image">
                        <input type="hidden" name="foto_lama" value="<?= $d->foto_pesantren ?>">
                        <input type="file" name="foto_baru" class="input-control">
                    </div>

                    <input type="submit" name="submit" value="Simpan Perubahan" class="btn btn-blue">

                </form>

                <?php

                if (isset($_POST['submit'])) {

                    $tentang  = addslashes($_POST['tentang']);
                    $currdate = date('Y-m-d H:i:s');

                    // menampung dan validasi data foto sekolah
                    if ($_FILES['foto_baru']['name'] != '') {

                        $filename   = $_FILES['foto_baru']['name'];
                        $tmpname    = $_FILES['foto_baru']['tmp_name'];
                        $filesize   = $_FILES['foto_baru']['size'];

                        $formatfile = pathinfo($filename, PATHINFO_EXTENSION);
                        $rename      = 'pesantren' . time() . '.' . $formatfile;

                        $allowedtype = array('png', 'jpg', 'jpeg', 'gif');

                        if (!in_array($formatfile, $allowedtype)) {

                            echo '<div class="alert alert-error">Format file foto sekolah tidak diizinkan.</div>';

                            return false;
                        } elseif ($filesize > 5000000) {

                            echo '<div class="alert alert-error">Ukuran file foto sekolah tidak boleh lebih dari 5 MB.</div>';

                            return false;
                        } else {

                            if (file_exists("../uploads/identitas/" . $_POST['foto_lama'])) {

                                unlink("../uploads/identitas/" . $_POST['foto_lama']);
                            }

                            move_uploaded_file($tmpname, "../uploads/identitas/" . $rename);
                        }
                    } else {

                        $rename     = $_POST['foto_lama'];
                    }


                    $update = mysqli_query($conn, "UPDATE pengaturan SET
                                        tentang_pesantren = '" . $tentang . "',
                                        foto_pesantren = '" . $rename . "',
                                        updated_at = '" . $currdate . "'
                                        WHERE id = '" . $d->id . "'
                                    ");

                    if ($update) {
                        echo "<script>window.location='tentang-pesantren.php?success=Edit Data Berhasil'</script>";
                    } else {
                        echo 'gagal edit ' . mysqli_error($conn);
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