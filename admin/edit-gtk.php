<?php include 'header.php' ?>

<?php
$gtk 	= mysqli_query($conn, "SELECT * FROM gtk WHERE id = '" . $_GET['id'] . "' ");

if (mysqli_num_rows($gtk) == 0) {
	echo "<script>window.location='gtk.php'</script>";
}

$p 			= mysqli_fetch_object($gtk);
?>

<!-- content -->
<div class="content">

    <div class="container">

        <div class="box">

            <div class="box-header">
                Edit Pengajar
            </div>

            <div class="box-body">

                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" placeholder="Nama Pengajar" value="<?= $p->nama ?>"
                            class="input-control" required>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="input-control"
                            placeholder="Keterangan"><?= $p->keterangan ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Gambar</label>
                        <img src="../uploads/gtk/<?= $p->gambar ?>" width="200px" class="image">
                        <input type="hidden" name="gambar2" value="<?= $p->gambar ?>">
                        <input type="file" name="gambar" class="input-control">
                    </div>

                    <button type="button" class="btn" onclick="window.location = 'gtk.php'">Kembali</button>
                    <input type="submit" name="submit" value="Simpan" class="btn btn-blue">

                </form>

                <?php

				if (isset($_POST['submit'])) {

					$nama 	= addslashes(ucwords($_POST['nama']));
					$ket 	= addslashes($_POST['keterangan']);
					$currdate = date('Y-m-d H:i:s');

					if ($_FILES['gambar']['name'] != '') {

						// echo 'user ganti gambar';

						$filename 	= $_FILES['gambar']['name'];
						$tmpname 	= $_FILES['gambar']['tmp_name'];
						$filesize 	= $_FILES['gambar']['size'];

						$formatfile = pathinfo($filename, PATHINFO_EXTENSION);
						$rename 	= 'gtk' . time() . '.' . $formatfile;

						$allowedtype = array('png', 'jpg', 'jpeg', 'gif');

						if (!in_array($formatfile, $allowedtype)) {

							echo '<div class="alert alert-error">Format file tidak diizinkan.</div>';

							return false;
						} elseif ($filesize > 3000000) {

							echo '<div class="alert alert-error">Ukuran file tidak boleh lebih dari 3 MB.</div>';

							return false;
						} else {

							if (file_exists("../uploads/gtk/" . $_POST['gambar2'])) {

								unlink("../uploads/gtk/" . $_POST['gambar2']);
							}

							move_uploaded_file($tmpname, "../uploads/gtk/" . $rename);
						}
					} else {

						// echo 'user tidak ganti gambar';

						$rename 	= $_POST['gambar2'];
					}

					$update = mysqli_query($conn, "UPDATE gtk SET
										nama = '" . $nama . "',
										keterangan = '" . $ket . "',
										gambar = '" . $rename . "',
										updated_at = '" . $currdate . "'
										WHERE id = '" . $_GET['id'] . "'
									");


					if ($update) {
						echo "<script>window.location='gtk.php?success=Edit Data Berhasil'</script>";
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