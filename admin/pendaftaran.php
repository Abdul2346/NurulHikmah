<?php include 'header.php'; ?>

<!-- content -->
<div class="content">

    <div class="container">

        <div class="box">

            <div class="box-header">
                Pendaftaran
            </div>

            <div class="box-body">

                <?php
                if (isset($_GET['success'])) {
                    echo "<div class='alert alert-success'>" . $_GET['success'] . "</div>";
                }
                ?>

                <form action="">
                    <div class="input-group">
                        <input type="text" name="key" placeholder="Pencarian">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>

                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Pendaftaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;

                        $where = " WHERE 1=1 ";
                        if (isset($_GET['key'])) {
                            $where .= " AND nama LIKE '%" . addslashes($_GET['key']) . "%' ";
                        }

                        $pendaftaran = mysqli_query($conn, "SELECT id, nama, email, no_telp, jenis_kelamin, created_at FROM pendaftaran $where ORDER BY id DESC");
                        if (mysqli_num_rows($pendaftaran) > 0) {
                            while ($p = mysqli_fetch_array($pendaftaran)) {
                        ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $p['nama'] ?></td>
                            <td><?= $p['email'] ?></td>
                            <td><?= $p['no_telp'] ?></td>
                            <td><?= $p['jenis_kelamin'] ?></td>
                            <td><?= $p['created_at'] ?></td>
                            <td>
                                <a href="hapus.php?idpendaftaran=<?= $p['id'] ?>"
                                    onclick="return confirm('Yakin ingin hapus ?')" title="Hapus Data"
                                    class="text-red"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>

                        <?php }
                        } else { ?>
                        <tr>
                            <td colspan="7">Data tidak ada</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>

        </div>

    </div>

</div>

<?php include 'footer.php'; ?>