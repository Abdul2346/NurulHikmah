<?php include 'header.php'; ?>

<!-- content -->
<div class="content">

    <div class="container">

        <div class="box">

            <div class="box-header">
                URL
            </div>

            <div class="box-body">

                <a href="tambah-sosmed.php" class="text-green"><i class="fa fa-plus"></i> Tambah</a>

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
                            <th>URL</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;

                        $where = " WHERE 1=1 ";
                        if (isset($_GET['key'])) {
                            $where .= " AND nama_rancangan LIKE '%" . addslashes($_GET['key']) . "%' ";
                        }

                        $sosmed = mysqli_query($conn, "SELECT * FROM videos $where ORDER BY id DESC");
                        if (mysqli_num_rows($sosmed) > 0) {
                            while ($row = mysqli_fetch_array($sosmed)) {
                        ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['video_url'] ?></td>
                            <td><?= $row['description'] ?></td>
                            <td>
                                <a href="edit-sosmed.php?id=<?= $row['id'] ?>" title="Edit Data" class="text-orange"><i
                                        class="fa fa-edit"></i></a>
                                <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin hapus ?')"
                                    title="Hapus Data" class="text-red"><i class="fa fa-times"></i></a>
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

<?php include 'footer.php'; ?>