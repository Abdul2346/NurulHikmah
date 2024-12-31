<?php include 'header.php'; ?>

<!-- content -->
<div class="content">

    <div class="container">

        <div class="box">

            <div class="box-header">
                Jadwal
            </div>

            <div class="box-body">

                <a href="tambah-jadwal.php" class="text-green"><i class="fa fa-plus"></i> Tambah</a>

                <?php
                if (isset($_GET['success'])) {
                    echo "<div class='alert alert-success'>" . htmlspecialchars($_GET['success']) . "</div>";
                }
                ?>

                <form action="" method="GET">
                    <div class="input-group">
                        <input type="text" name="key" placeholder="Pencarian"
                            value="<?= isset($_GET['key']) ? htmlspecialchars($_GET['key']) : '' ?>">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>

                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kegiatan</th>
                            <th>Hari</th>
                            <th>Waktu</th>
                            <th>Tempat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;

                        $where = " WHERE 1=1 ";
                        if (isset($_GET['key'])) {
                            $where .= " AND nama_kegiatan LIKE '%" . addslashes($_GET['key']) . "%' ";
                        }

                        $jadwal = mysqli_query($conn, "SELECT * FROM jadwal $where ORDER BY id DESC");
                        if (mysqli_num_rows($jadwal) > 0) {
                            while ($p = mysqli_fetch_assoc($jadwal)) {
                        ?>

                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($p['nama_kegiatan']); ?></td>
                            <td><?= htmlspecialchars($p['hari']); ?></td>
                            <td><?= htmlspecialchars($p['waktu']); ?></td>
                            <td><?= htmlspecialchars($p['tempat']); ?></td>
                            <td>
                                <a href="edit-jadwal.php?id=<?= $p['id'] ?>" title="Edit Data" class="text-orange"><i
                                        class="fa fa-edit"></i></a>
                                <a href="hapus.php?idjadwal=<?= $p['id'] ?>"
                                    onclick="return confirm('Yakin ingin hapus?')" title="Hapus Data"
                                    class="text-red"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>

                        <?php }
                        } else { ?>
                        <tr>
                            <td colspan="6">Data tidak ada</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>

        </div>

    </div>

</div>

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