<?php include 'header.php' ?>

<!-- content -->
<div class="content">

    <div class="container">

        <div class="box">

            <div class="box-header">
                Pimpinan Pesantren
            </div>

            <div class="box-body">

                <?php
				if (isset($_GET['success'])) {
					echo "<div class='alert alert-success'>" . $_GET['success'] . "</div>";
				}
				?>

                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="input-control" placeholder="Nama Pimpinan Pesantren"
                            value="<?= $d->nama_pimpinan ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Sambutan</label>
                        <textarea name="sambutan" class="input-control" placeholder="Sambutan Pimpinan Pesantren"
                            id="keterangan"><?= $d->sambutan_pimpinan ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Foto</label>
                        <img src="../uploads/identitas/<?= $d->foto_pimpinan ?>" width="200px" class="image">
                        <input type="hidden" name="foto_lama" value="<?= $d->foto_pimpinan ?>">
                        <input type="file" name="foto_baru" class="input-control">
                    </div>

                    <input type="submit" name="submit" value="Simpan Perubahan" class="btn btn-blue">

                </form>

                <?php

				// Fungsi untuk validasi file upload
				function validasi_upload($file, $format_valid = ['png', 'jpg', 'jpeg', 'gif'], $ukuran_max = 1000000)
				{
					$filename = $file['name'];
					$tmpname = $file['tmp_name'];
					$filesize = $file['size'];
					$formatfile = pathinfo($filename, PATHINFO_EXTENSION);

					if (!in_array($formatfile, $format_valid)) {
						return "Format file tidak diizinkan.";
					}
					if ($filesize > $ukuran_max) {
						return "Ukuran file tidak boleh lebih dari 1 MB.";
					}
					return null; // Tidak ada error
				}

				if (isset($_POST['submit'])) {

					$nama  		= addslashes(ucwords($_POST['nama']));
					$sambutan  	= addslashes($_POST['sambutan']);
					$currdate 	= date('Y-m-d H:i:s');

					// Validasi dan upload foto baru jika ada
					if ($_FILES['foto_baru']['name'] != '') {
						$error = validasi_upload($_FILES['foto_baru']);
						if ($error) {
							echo '<div class="alert alert-error">' . $error . '</div>';
							return false;
						}

						$filename 	= $_FILES['foto_baru']['name'];
						$tmpname 	= $_FILES['foto_baru']['tmp_name'];
						$formatfile = pathinfo($filename, PATHINFO_EXTENSION);
						$rename 	 = 'pimpinan' . time() . '.' . $formatfile;

						// Hapus foto lama jika ada
						if (file_exists("../uploads/identitas/" . $_POST['foto_lama']) && is_file("../uploads/identitas/" . $_POST['foto_lama'])) {
							unlink("../uploads/identitas/" . $_POST['foto_lama']);
						}

						move_uploaded_file($tmpname, "../uploads/identitas/" . $rename);
					} else {
						$rename 	= $_POST['foto_lama']; // Gunakan foto lama jika tidak ada file baru
					}

					// Menggunakan prepared statement untuk query
					$stmt = $conn->prepare("UPDATE pengaturan SET nama_pimpinan = ?, sambutan_pimpinan = ?, foto_pimpinan = ?, updated_at = ? WHERE id = ?");
					$stmt->bind_param("ssssi", $nama, $sambutan, $rename, $currdate, $d->id);

					if ($stmt->execute()) {
						echo "<script>window.location='pimpinan-pesantren.php?success=Edit Data Berhasil'</script>";
					} else {
						echo '<div class="alert alert-error">Gagal edit data: ' . $stmt->error . '</div>';
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