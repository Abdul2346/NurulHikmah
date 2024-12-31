<?php include 'header.php'; ?>

<div class="section">
    <div class="container">
        <h3 class="text-center">Pengajar</h3>

        <div class="row">
            <?php
            $gtk = mysqli_query($conn, "SELECT * FROM gtk ORDER BY id DESC");
            if (mysqli_num_rows($gtk) > 0) {
                while ($j = mysqli_fetch_array($gtk)) {
            ?>

            <div class="col-4">
                <a href="detail-gtk.php?id=<?= $j['id'] ?>" class="thumbnail-link">
                    <div class="thumbnail-box">
                        <div class="thumbail-img" style="background-image: url('uploads/gtk/<?= $j['gambar'] ?>');">
                        </div>

                        <div class="thumbnail-text">
                            <?= substr($j['nama'], 0, 50) ?>
                        </div>
                    </div>
                </a>
            </div>

            <?php }
            } else { ?>

            <p class="text-center">Tidak ada data</p>

            <?php } ?>
        </div>

    </div>
</div>