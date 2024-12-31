<?php include 'header.php'; ?>

<div class="section tentang-pesantren">
    <div class="container tentang-container">
        <h3 class="text-center tentang-title">Tentang Pesantren</h3>
        <img src="uploads/identitas/<?= $d->foto_pesantren ?>" width="100%" class="image tentang-image">
        <div class="tentang-content">
            <?= $d->tentang_pesantren ?>
        </div>
    </div>
</div>