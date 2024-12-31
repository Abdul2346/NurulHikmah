-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Des 2024 pada 08.42
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nurulhikmah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('Super Admin','Admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`, `level`, `created_at`, `updated_at`) VALUES
(4, 'Hanan A.M', 'hananadmin', '990ac8b047f7ec820b3378f5ffd64087', 'Admin', '2024-12-14 06:41:52', '2024-12-14 13:42:30'),
(5, 'Hanan Attaki', 'hanansuper', '0ecaffdf1c487d6b1d058231c42be02b', 'Super Admin', '2024-12-23 03:52:21', '2024-12-23 10:53:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alamat`
--

CREATE TABLE `alamat` (
  `id` int(11) NOT NULL,
  `alamat_tujuan` text NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `alamat`
--

INSERT INTO `alamat` (`id`, `alamat_tujuan`, `updated_at`) VALUES
(1, 'Jl. Parungbarang, Dusun Kulon Rt/Rw 04/01 Desa Bayasari, kec. Jatinagara, Kab. Ciamis, Jawa Barat 46273.', '2024-12-26 17:50:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `background`
--

CREATE TABLE `background` (
  `id` int(11) NOT NULL,
  `background` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `background`
--

INSERT INTO `background` (`id`, `background`, `created_at`, `updated_at`) VALUES
(1, 'background1735017026.jpeg', '2024-12-21 12:08:49', '2024-12-24 12:10:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `donasi`
--

CREATE TABLE `donasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `kontak` varchar(15) NOT NULL,
  `bukti_pengiriman` varchar(255) DEFAULT NULL,
  `tipe_donasi` enum('uang','barang') NOT NULL,
  `pesan` text DEFAULT NULL,
  `nominal` decimal(15,2) DEFAULT NULL,
  `metode_pengiriman` enum('bank','ewallet') NOT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `ewallet` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `donasi`
--

INSERT INTO `donasi` (`id`, `nama`, `email`, `kontak`, `bukti_pengiriman`, `tipe_donasi`, `pesan`, `nominal`, `metode_pengiriman`, `bank`, `ewallet`, `created_at`) VALUES
(13, 'Hanan', 'han@gmail.com', '234354656', 'bck.jpeg', 'barang', '', 0.00, '', '', '', '2024-12-28 06:04:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id`, `foto`, `keterangan`, `created_at`, `updated_at`) VALUES
(6, 'galeri1735622486.jpeg', 'Kunjungan Mahasiswa', '2024-12-31 05:21:26', NULL),
(7, 'galeri1735622569.jpeg', 'Renovasi Masjid', '2024-12-31 05:22:49', NULL),
(8, 'galeri1735622718.jpeg', 'Mahalul Qiyam', '2024-12-31 05:25:18', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gtk`
--

CREATE TABLE `gtk` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gtk`
--

INSERT INTO `gtk` (`id`, `nama`, `keterangan`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'USTAZ AZIZ', 'DATA DIRI\r\n\r\nNama: Aziz Maulana\r\nTempat, Tanggal Lahir: Ciamis, 03 Agustus 1996\r\nPekerjaan: Wiraswasta\r\n\r\nAlamat: Jl. Parungbarang, Dusun Kulon Rt/Rw 04/01 Desa Bayasari, kec. Jatinagara, Kab. Ciamis, Jawa Barat 46273.\r\nNo. HP: +62 812-2209-2090\r\nEmail: azizmaulana@gmail.com', 'gtk1735621697.jpeg', '2024-12-25 04:05:52', '2024-12-31 12:10:37'),
(3, 'USTAZ SUHADA', 'DATA DIRI\r\n\r\nNama: Suhada\r\nTempat, Tanggal Lahir: Ciamis, 10 Juli 1977\r\nPekerjaan: Imam Masjid\r\n\r\nAlamat: Jl. Parungbarang, Dusun Kulon Rt/Rw 04/01 Desa Bayasari, kec. Jatinagara, Kab. Ciamis, Jawa Barat 46273.\r\nNo. HP: +62 852-2159-7211\r\nEmail: suhada@gmail.com\r\n', 'gtk1735621503.jpg', '2024-12-30 10:12:55', '2024-12-31 12:10:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi`
--

CREATE TABLE `informasi` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `informasi`
--

INSERT INTO `informasi` (`id`, `judul`, `keterangan`, `gambar`, `created_at`, `updated_at`) VALUES
(6, 'Libur Akhir Tahun', 'Libur akan di laksanakan mulai dari 31 Desember 2024 - 05 Januari 2025', 'informasi1735623365.jpg', '2024-12-31 05:36:05', '2024-12-31 12:53:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `nama`, `email`, `no_telp`, `jenis_kelamin`, `created_at`) VALUES
(1, 'Hanan Abdul Manan', 'hananabdulmanan90@gmail.com', '+6285794604675', 'laki-laki', '2024-12-24 07:08:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `logo` varchar(50) NOT NULL,
  `favicon` varchar(50) NOT NULL,
  `tentang_pesantren` text NOT NULL,
  `foto_pesantren` varchar(50) NOT NULL,
  `google_maps` text NOT NULL,
  `nama_pimpinan` varchar(50) NOT NULL,
  `foto_pimpinan` varchar(50) NOT NULL,
  `sambutan_pimpinan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `nama`, `email`, `telepon`, `alamat`, `logo`, `favicon`, `tentang_pesantren`, `foto_pesantren`, `google_maps`, `nama_pimpinan`, `foto_pimpinan`, `sambutan_pimpinan`, `created_at`, `updated_at`) VALUES
(1, 'NURUL HIKMAH', 'pstnurulhikmah@gmail.com', '+6285695748313', 'Jl. Parungbarang, Dusun Kulon Rt/Rw 04/01 Desa Bayasari, kec. Jatinagara, Kab. Ciamis, Jawa Barat 46273.', 'logo1733884438.png', 'favicon1733884438.png', '<body> \r\n<center> \r\n<strong>VISI</strong> \r\n</center> \r\n<p style=\"text-align: center;\"> \r\nMewujudkan generasi Islami yang berakhlak mulia, berilmu syar’i, dan berkomitmen untuk menegakkan nilai-nilai Al-Qur\'an dan Sunnah sesuai pemahaman Salafus Shalih. \r\n</p> \r\n\r\n<br><br> \r\n\r\n<center> <strong>MISI</strong> </center> \r\n<ol> \r\n<li><strong>Pendidikan Agama yang Mendalam:</strong> Menyelenggarakan pendidikan berbasis Al-Qur\'an dan Sunnah dengan pendekatan yang sesuai dengan pemahaman Salafus Shalih.</li>\r\n<li><strong>Pembentukan Akhlak Mulia:</strong> Membina santri untuk memiliki akhlak yang luhur, amanah, dan mampu menjadi teladan di tengah masyarakat.</li> \r\n<li><strong>Komitmen pada Ilmu Syar’i:</strong> Mengembangkan pembelajaran yang memadukan teori dan praktik dalam mendalami ilmu agama, seperti fikih, aqidah, hadits, dan bahasa Arab.</li> \r\n<li><strong>Kemandirian Santri:</strong> Melatih santri untuk menjadi pribadi yang mandiri, bertanggung jawab, dan siap menghadapi tantangan zaman tanpa meninggalkan prinsip-prinsip Islam.</li>\r\n <li><strong>Dakwah Berkesinambungan:</strong> Menyiapkan santri untuk menjadi dai dan pembimbing masyarakat dalam menegakkan tauhid dan sunnah.</li> \r\n<li><strong>Lingkungan Islami:</strong> Menyediakan lingkungan yang kondusif untuk tumbuhnya karakter Islami yang istiqamah dalam kehidupan sehari-hari.</li> \r\n</ol>\r\n</body>\r\n', 'pesantren1734156013.jpeg', 'https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3326.775182502466!2d108.41537614398777!3d-7.176264873923042!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2s!5e0!3m2!1sid!2sid!4v1734143331957!5m2!1sid!2sid', 'USTAZ SUHADA', 'pimpinan1734145302.jpg', '<strong>Hirupmah Ulah Ngaji Luhur-luhur, Asakeun Kitab Anu Laletik</strong>', '2021-08-14 15:24:49', '2024-12-31 12:29:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `video_url` text NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `videos`
--

INSERT INTO `videos` (`id`, `video_url`, `description`, `created_at`) VALUES
(4, 'https://youtube.com/shorts/R117-wUa_lY?si=VKk6PtVcbJY0eQm0', 'Pondok Pesantren Nurul Hikmah ❤️✨\r\nTempat kami menuntut ilmu dan mendekatkan diri kepada Allah.\r\nMasih banyak yang perlu direnovasi, sehingga uluran tangan dari Bapak/Ibu sangat kami harapkan. Terima kasih kepada para donatur yang telah berbagi rezeki untuk pesantren kami. Semoga Allah membalasnya dengan rezeki yang berlipat ganda dan keberkahan yang tiada henti. 🙏🌟', '2024-12-29 13:17:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wakaf`
--

CREATE TABLE `wakaf` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `kontak` varchar(15) NOT NULL,
  `bukti_pengiriman` varchar(255) DEFAULT NULL,
  `tipe_wakaf` enum('money','goods','Al-Quran') NOT NULL,
  `nominal_wakaf` decimal(15,2) DEFAULT NULL,
  `pesan_wakaf` text DEFAULT NULL,
  `metode_pengiriman` enum('bank','ewallet') NOT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `ewallet` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `alamat`
--
ALTER TABLE `alamat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `background`
--
ALTER TABLE `background`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `donasi`
--
ALTER TABLE `donasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gtk`
--
ALTER TABLE `gtk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wakaf`
--
ALTER TABLE `wakaf`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `alamat`
--
ALTER TABLE `alamat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `background`
--
ALTER TABLE `background`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `donasi`
--
ALTER TABLE `donasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `gtk`
--
ALTER TABLE `gtk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `wakaf`
--
ALTER TABLE `wakaf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
