<?php

include '../koneksi.php';

if (isset($_GET['idadmin'])) {

	$delete = mysqli_query($conn, "DELETE FROM admin WHERE id = '" . $_GET['idadmin'] . "' ");
	echo "<script>window.location = 'admin.php'</script>";
}

if (isset($_GET['idgtk'])) {

	$gtk = mysqli_query($conn, "SELECT gambar FROM gtk WHERE id = '" . $_GET['idgtk'] . "' ");

	if (mysqli_num_rows($gtk) > 0) {

		$p = mysqli_fetch_object($gtk);

		if (file_exists("../uploads/gtk/" . $p->gambar)) {

			unlink("../uploads/gtk/" . $p->gambar);
		}
	}

	$delete = mysqli_query($conn, "DELETE FROM gtk WHERE id = '" . $_GET['idgtk'] . "' ");
	echo "<script>window.location = 'gtk.php'</script>";
}

if (isset($_GET['idgaleri'])) {

	$galeri = mysqli_query($conn, "SELECT foto FROM galeri WHERE id = '" . $_GET['idgaleri'] . "' ");

	if (mysqli_num_rows($galeri) > 0) {

		$p = mysqli_fetch_object($galeri);

		if (file_exists("../uploads/galeri/" . $p->foto)) {

			unlink("../uploads/galeri/" . $p->foto);
		}
	}

	$delete = mysqli_query($conn, "DELETE FROM galeri WHERE id = '" . $_GET['idgaleri'] . "' ");
	echo "<script>window.location = 'galeri.php'</script>";
}

if (isset($_GET['idinformasi'])) {

	$informasi = mysqli_query($conn, "SELECT gambar FROM informasi WHERE id = '" . $_GET['idinformasi'] . "' ");

	if (mysqli_num_rows($informasi) > 0) {

		$p = mysqli_fetch_object($informasi);

		if (file_exists("../uploads/informasi/" . $p->gambar)) {

			unlink("../uploads/informasi/" . $p->gambar);
		}
	}

	$delete = mysqli_query($conn, "DELETE FROM informasi WHERE id = '" . $_GET['idinformasi'] . "' ");
	echo "<script>window.location = 'informasi.php'</script>";
}

if (isset($_GET['idpendaftaran'])) {
	$pendaftaran = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE id = '" . $_GET['idpendaftaran'] . "'");

	if (mysqli_num_rows($pendaftaran) > 0) {
		$delete = mysqli_query($conn, "DELETE FROM pendaftaran WHERE id = '" . $_GET['idpendaftaran'] . "'");

		if ($delete) {
			echo "<script>alert('Data pendaftaran berhasil dihapus');</script>";
		} else {
			echo "<script>alert('Gagal menghapus data pendaftaran');</script>";
		}
	} else {
		echo "<script>alert('Data pendaftaran tidak ditemukan');</script>";
	}

	echo "<script>window.location = 'pendaftaran.php'</script>";
}

if (isset($_GET['id'])) {
	$id = intval($_GET['id']);

	$delete = mysqli_query($conn, "DELETE FROM videos WHERE id = '$id'");

	if ($delete) {
		echo "<script>alert('Video berhasil dihapus');</script>";
	} else {
		echo "<script>alert('Gagal menghapus video');</script>";
	}

	echo "<script>window.location = 'sosmed.php'</script>";
}