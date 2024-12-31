<?php include 'header.php'; ?>
<!-- Bagian Banner -->
<div class="banner" style="background-image: url('uploads/identitas/<?= $d->foto_pesantren ?>');">
    <div class="banner-text">
        <div class="container">
            <h3 class="animate-from-left">Selamat Datang di <?= $d->nama ?></h3>
            <p class="animate-from-left">Mari berusaha menjadi pribadi yang lebih baik dengan ilmu dan iman yang kokoh.
            </p>
        </div>
    </div>
</div>

<!-- Bagian Sambutan -->
<div class="section">
    <div class="container text-center">
        <h3>Pimpinan Pesantren</h3>
        <div class="leader-info">
            <img src="uploads/identitas/<?= $d->foto_pimpinan ?>" alt="Pimpinan Pesantren" class="leader-img">
            <h4><?= $d->nama_pimpinan ?></h4>
            <p><?= $d->sambutan_pimpinan ?></p>
        </div>
    </div>
</div>

<!-- Bagian Video -->
<div class="section">
    <div class="container">
        <?php
        $videos = mysqli_query($conn, "SELECT * FROM videos ORDER BY id DESC LIMIT 3");
        if (mysqli_num_rows($videos) > 0) {
            while ($v = mysqli_fetch_array($videos)) {
                $video_url = $v['video_url'];

                // Menangani berbagai format URL YouTube
                if (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/', $video_url, $matches)) {
                    // Jika format embed, ambil ID video dari URL
                    $video_id = $matches[1];
                } elseif (preg_match('/youtu.be\/([a-zA-Z0-9_-]+)/', $video_url, $matches)) {
                    // Jika format pendek, ambil ID video dari sini
                    $video_id = $matches[1];
                } elseif (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $video_url, $matches)) {
                    // Jika format panjang, ambil ID video dari parameter 'v'
                    $video_id = $matches[1];
                } elseif (preg_match('/youtube\.com\/shorts\/([a-zA-Z0-9_-]+)/', $video_url, $matches)) {
                    // Jika format short, ambil ID video dari URL
                    $video_id = $matches[1];
                } else {
                    // Jika URL tidak valid atau tidak mengandung ID video, tampilkan URL asli
                    $video_id = null;
                }
        ?>
        <div class="video-section">
            <div class="video-box">
                <?php if ($video_id): ?>
                <iframe src="https://www.youtube.com/embed/<?= $video_id ?>" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
                <?php else: ?>
                <p><a href="<?= $video_url ?>" target="_blank"><?= $video_url ?></a></p>
                <?php endif; ?>
            </div>
            <div class="video-description"><?= $v['description'] ?></div>
        </div>
    </div>
    <?php }
        } else { ?>
    <p>Tidak ada video.</p>
    <?php } ?>
</div>

<!-- Bagian Informasi -->
<div class="section">
    <div class="container text-center">
        <h3>Informasi Terbaru</h3>
        <div class="row">
            <?php
            $informasi = mysqli_query($conn, "SELECT * FROM informasi ORDER BY id DESC LIMIT 8");
            if (mysqli_num_rows($informasi) > 0) {
                while ($p = mysqli_fetch_array($informasi)) { ?>
            <div class="col-4">
                <a href="detail-informasi.php?id=<?= $p['id'] ?>" class="thumbnail-link">
                    <div class="thumbnail-box">
                        <div class="thumbail-img"
                            style="background-image: url('uploads/informasi/<?= $p['gambar'] ?>');"></div>
                        <div class="thumbnail-text"><?= substr($p['judul'], 0, 50) ?>...</div>
                    </div>
                </a>
            </div>
            <?php }
            } else { ?>
            <p>Tidak ada data.</p>
            <?php } ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>