<footer class="footer-custom">
    <div class="footer-content">
        <!-- Informasi Utama -->
        <div class="footer-info">
            <h3>Pondok Pesantren Nurul Hikmah</h3>
            <p>Alamat: Jl. Parungbarang, Dusun Kulon Rt/Rw 04/01 Desa Bayasari, Kec. Jatinagara, Kab. Ciamis, Jawa Barat
                46273.</p>
            <p>Telepon: <a href="tel:+6285695748313">+62 856 9574 8313</a></p>
            <p>Email: <a href="mailto:pstnurulhikmah@gmail.com">pstnurulhikmah@gmail.com</a></p>
        </div>

        <!-- Navigasi Cepat -->
        <div class="footer-links">
            <h4>Tentang Kami</h4>
            <ul>
                <li><a href="pendaftaran.php">Pendaftaran</a></li>
            </ul>
        </div>

        <!-- Kutipan Islami -->
        <div class="footer-quote">
            <h4>Kata Mutiara</h4>
            <blockquote>"Menuntut ilmu adalah kewajiban bagi setiap muslim." - (HR. Ibnu Majah)</blockquote>
        </div>
    </div>

    <!-- Ikon Media Sosial -->
    <div class="social-icons">
        <a href="https://wa.me/+6285695748313" target="_blank" title="WhatsApp" aria-label="WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
        <a href="https://instagram.com/abdul.manan90" target="_blank" title="Instagram" aria-label="Instagram">
            <i class="fab fa-instagram"></i>
        </a>
        <a href="mailto:pstnurulhikmah@gmail.com" title="Email" aria-label="Email">
            <i class="fas fa-envelope"></i>
        </a>
        <a href="http://www.youtube.com/@NurulHikmah-24" target="_blank" title="YouTube" aria-label="YouTube">
            <i class="fab fa-youtube"></i>
        </a>
    </div>

    <!-- Hak Cipta -->
    <div class="footer-copyright">
        <p>
            Copyright &copy; <?= date('Y') ?> -
            <?= htmlspecialchars($d->nama ?? 'Pondok Pesantren Nurul Hikmah', ENT_QUOTES, 'UTF-8') ?>. All Rights
            Reserved.
        </p>
    </div>

    <!-- Back to Top -->
    <!-- <a href="#" class="back-to-top" title="Kembali ke Atas" aria-label="Kembali ke Atas">↑ Kembali ke Atas</a> -->
</footer>

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<noscript>
    <style>
    .social-icons i::before {
        content: 'Ikon';
    }
    </style>
</noscript>