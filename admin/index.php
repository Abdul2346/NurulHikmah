<?php include 'header.php'; ?>

<!-- Content -->
<div class="content">

    <div class="container">

        <div class="box">

            <div class="box-body">
                <h3>Selamat Datang <?= $_SESSION['uname'] ?> di Panel Admin <?= $d->nama ?></h3>
                <p>Panel Admin ini memberi Anda kontrol penuh untuk mengelola situs. Gunakan menu di atas untuk
                    mengakses berbagai fitur dan pengaturan.</p>
            </div>

        </div>

    </div>

</div>

<?php include 'footer.php'; ?>