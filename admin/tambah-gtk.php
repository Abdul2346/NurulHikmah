<?php include 'header.php' ?>

<!-- content -->
<div class="content">

    <div class="container">

        <div class="box">

            <div class="box-header">
                Tambah Pengajar
            </div>

            <div class="box-body">

                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" placeholder="Nama Pengajar" class="input-control" required>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="input-control" placeholder="Keterangan"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="input-control" required>
                    </div>

                    <button type="button" class="btn" onclick="window.location = 'gtk.php'">Kembali</button>
                    <input type="submit" name="submit" value="Simpan" class="btn btn-blue">

                </form>

                <?php

				if (isset($_POST['submit'])) {

					// print_r($_FILES['gambar']);

					$nama 	= addslashes(ucwords($_POST['nama']));
					$ket 	= addslashes($_POST['keterangan']);

					$filename 	= $_FILES['gambar']['name'];
					$tmpname 	= $_FILES['gambar']['tmp_name'];
					$filesize 	= $_FILES['gambar']['size'];

					$formatfile = pathinfo($filename, PATHINFO_EXTENSION);
					$rename 	= 'gtk' . time() . '.' . $formatfile;

					$allowedtype = array('png', 'jpg', 'jpeg', 'gif');

					if (!in_array($formatfile, $allowedtype)) {

						echo '<div class="alert alert-error">Format file tidak diizinkan.</div>';
					} elseif ($filesize > 3000000) {

						echo '<div class="alert alert-error">Ukuran file tidak boleh lebih dari 3 MB.</div>';
					} else {

						move_uploaded_file($tmpname, "../uploads/gtk/" . $rename);

						$simpan = mysqli_query($conn, "INSERT INTO gtk VALUES (
											null,
											'" . $nama . "',
											'" . $ket . "',
											'" . $rename . "',
											null,
											null
									)");

						if ($simpan) {
							echo '<div class="alert alert-success">Simpan Berhasil</div>';
						} else {
							echo 'gagal simpan ' . mysqli_error($conn);
						}
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