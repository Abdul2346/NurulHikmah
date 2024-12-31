<?php include 'header.php' ?>

<?php
$admin     = mysqli_query($conn, "SELECT * FROM admin WHERE id = '" . $_GET['id'] . "' ");

if (mysqli_num_rows($admin) == 0) {
    echo "<script>window.location='admin.php'</script>";
}

$p             = mysqli_fetch_object($admin);
?>

<!-- content -->
<div class="content">

    <div class="container">

        <div class="box">

            <div class="box-header">
                Edit Admin
            </div>

            <div class="box-body">

                <form action="" method="POST">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control"
                            value="<?= $p->nama ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="user" placeholder="Username" class="input-control"
                            value="<?= $p->username ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Level</label>
                        <select name="level" class="input-control" required>
                            <option value="">Pilih</option>
                            <option value="Super Admin" <?= ($p->level == 'Super Admin') ? 'selected' : ''; ?>>Super
                                Admin</option>
                            <option value="Admin" <?= ($p->level == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                        </select>
                    </div>

                    <button type="button" class="btn" onclick="window.location = 'admin.php'">Kembali</button>
                    <input type="submit" name="submit" value="Simpan" class="btn btn-blue">

                </form>

                <?php

                if (isset($_POST['submit'])) {

                    $nama     = addslashes(ucwords($_POST['nama']));
                    $user     = addslashes($_POST['user']);
                    $level     = $_POST['level'];
                    $currdate = date('Y-m-d H:i:s');

                    $update = mysqli_query($conn, "UPDATE admin SET
										nama = '" . $nama . "',
										username = '" . $user . "',
										level = '" . $level . "',
										updated_at = '" . $currdate . "'
										WHERE id = '" . $_GET['id'] . "'
									");


                    if ($update) {
                        echo "<script>window.location='admin.php?success=Edit Data Berhasil'</script>";
                    } else {
                        echo 'gagal edit ' . mysqli_error($conn);
                    }
                }

                ?>

            </div>

        </div>

    </div>

</div>

<script>
    // Menghilangkan alert setelah 3 detik
    setTimeout(function() {
        var alert = document.getElementById('alert');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 3000);
</script>

<?php include 'footer.php' ?>