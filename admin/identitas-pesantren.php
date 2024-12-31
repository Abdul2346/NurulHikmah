<?php include 'header.php'; ?>

<!-- content -->
<div class="content">

	<div class="container">

		<div class="box">

			<div class="box-header">
				Identitas Pesantren
			</div>

			<div class="box-body">

				<?php
				if (isset($_GET['success'])) {
					echo "<div class='alert alert-success'>" . htmlspecialchars($_GET['success']) . "</div>";
				}
				?>

				<form action="" method="POST" enctype="multipart/form-data">

					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama" placeholder="Nama Pesantren"
							value="<?= htmlspecialchars($d->nama) ?>" class="input-control" required>
					</div>

					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" placeholder="Email Pesantren"
							value="<?= htmlspecialchars($d->email) ?>" class="input-control" required>
					</div>

					<div class="form-group">
						<label>Telepon</label>
						<input type="text" name="telp" placeholder="Telepon Pesantren"
							value="<?= htmlspecialchars($d->telepon) ?>" class="input-control" required>
					</div>

					<div class="form-group">
						<label>Alamat</label>
						<textarea name="alamat" class="input-control"
							placeholder="Alamat"><?= htmlspecialchars($d->alamat) ?></textarea>
					</div>

					<div class="form-group">
						<label>Google Maps</label>
						<textarea name="gmaps" class="input-control"
							placeholder="Google Maps"><?= htmlspecialchars($d->google_maps) ?></textarea>
					</div>

					<div class="form-group">
						<label>Logo</label>
						<img src="../uploads/identitas/<?= htmlspecialchars($d->logo) ?>" width="200px" class="image">
						<input type="hidden" name="logo_lama" value="<?= htmlspecialchars($d->logo) ?>">
						<input type="file" name="logo_baru" class="input-control">
					</div>

					<div class="form-group">
						<label>Favicon</label>
						<img src="../uploads/identitas/<?= htmlspecialchars($d->favicon) ?>" width="32" class="image">
						<input type="hidden" name="favicon_lama" value="<?= htmlspecialchars($d->favicon) ?>">
						<input type="file" name="favicon_baru" class="input-control">
					</div>

					<input type="submit" name="submit" value="Simpan Perubahan" class="btn btn-blue">

				</form>

				<?php
				if (isset($_POST['submit'])) {

					$nama   = addslashes(ucwords($_POST['nama']));
					$email  = addslashes($_POST['email']);
					$telp   = addslashes($_POST['telp']);
					$alamat = addslashes($_POST['alamat']);
					$gmaps  = addslashes($_POST['gmaps']);
					$currdate = date('Y-m-d H:i:s');

					// Menampung dan validasi data logo
					if ($_FILES['logo_baru']['name'] != '') {

						$filename_logo  = $_FILES['logo_baru']['name'];
						$tmpname_logo   = $_FILES['logo_baru']['tmp_name'];
						$filesize_logo  = $_FILES['logo_baru']['size'];
						$formatfile_logo = pathinfo($filename_logo, PATHINFO_EXTENSION);
						$rename_logo    = 'logo' . time() . '.' . $formatfile_logo;

						$allowedtype_logo = array('png', 'jpg', 'jpeg', 'gif');

						if (!in_array($formatfile_logo, $allowedtype_logo)) {
							echo '<div class="alert alert-error">Format file logo sekolah tidak diizinkan.</div>';
							return false;
						} elseif ($filesize_logo > 1000000) {
							echo '<div class="alert alert-error">Ukuran file logo sekolah tidak boleh lebih dari 1 MB.</div>';
							return false;
						} else {
							if (file_exists("../uploads/identitas/" . $_POST['logo_lama'])) {
								unlink("../uploads/identitas/" . $_POST['logo_lama']);
							}

							// Verifikasi mime type file logo
							$mime_type = mime_content_type($tmpname_logo);
							if (!in_array($mime_type, ['image/png', 'image/jpeg', 'image/gif'])) {
								echo '<div class="alert alert-error">Format mime file logo tidak valid.</div>';
								return false;
							}

							move_uploaded_file($tmpname_logo, "../uploads/identitas/" . $rename_logo);
						}
					} else {
						$rename_logo = $_POST['logo_lama'];
					}

					// Menampung dan validasi data favicon
					if ($_FILES['favicon_baru']['name'] != '') {

						$filename_favicon  = $_FILES['favicon_baru']['name'];
						$tmpname_favicon   = $_FILES['favicon_baru']['tmp_name'];
						$filesize_favicon  = $_FILES['favicon_baru']['size'];
						$formatfile_favicon = pathinfo($filename_favicon, PATHINFO_EXTENSION);
						$rename_favicon    = 'favicon' . time() . '.' . $formatfile_favicon;

						$allowedtype_favicon = array('png', 'jpg', 'jpeg', 'gif');

						if (!in_array($formatfile_favicon, $allowedtype_favicon)) {
							echo '<div class="alert alert-error">Format file favicon sekolah tidak diizinkan.</div>';
							return false;
						} elseif ($filesize_favicon > 1000000) {
							echo '<div class="alert alert-error">Ukuran file favicon sekolah tidak boleh lebih dari 1 MB.</div>';
							return false;
						} else {
							if (file_exists("../uploads/identitas/" . $_POST['favicon_lama'])) {
								unlink("../uploads/identitas/" . $_POST['favicon_lama']);
							}

							// Verifikasi mime type file favicon
							$mime_type_favicon = mime_content_type($tmpname_favicon);
							if (!in_array($mime_type_favicon, ['image/png', 'image/jpeg', 'image/gif'])) {
								echo '<div class="alert alert-error">Format mime file favicon tidak valid.</div>';
								return false;
							}

							move_uploaded_file($tmpname_favicon, "../uploads/identitas/" . $rename_favicon);
						}
					} else {
						$rename_favicon = $_POST['favicon_lama'];
					}

					// Update data pengaturan
					$update = mysqli_query($conn, "UPDATE pengaturan SET
                                        nama = '" . $nama . "',
                                        email = '" . $email . "',
                                        telepon = '" . $telp . "',
                                        alamat = '" . $alamat . "',
                                        google_maps = '" . $gmaps . "',
                                        logo = '" . $rename_logo . "',
                                        favicon = '" . $rename_favicon . "',
                                        updated_at = '" . $currdate . "'
                                        WHERE id = '" . $d->id . "'");

					if ($update) {
						echo "<script>window.location='identitas-pesantren.php?success=Edit Data Berhasil'</script>";
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

<?php include 'footer.php'; ?>