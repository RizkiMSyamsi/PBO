<?php
    include "inc/config.php";

    if (!empty($_SESSION['iam_user'])) {
        redir("index.php");
    }

    include "layout/header.php";

    if (!empty($_POST)) {
        extract($_POST);

        // Pastikan email dan kedua password tidak kosong
        if (!empty($email) && !empty($password) && !empty($confirm_password)) {
            // Pastikan password dan konfirmasi password cocok
            if ($password === $confirm_password) {
                // Query untuk memeriksa apakah email ada di database
                $check_email = mysqli_query($db, "SELECT * FROM user WHERE email='$email'");

                if (mysqli_num_rows($check_email) > 0) {
                    // Jika email ada di database, lakukan update password
                    $hashed_password = md5($password);
                    $update_query = mysqli_query($db, "UPDATE user SET password='$hashed_password' WHERE email='$email'");

                    if ($update_query) {
                        ?>
                        <div class="alert alert-success">Password berhasil diubah. Silakan <a href="login.php">login</a> dengan password baru Anda.</div>
                        <?php
                    } else {
                        ?>
                        <div class="alert alert-danger">Terjadi kesalahan saat mengubah password. Silakan coba lagi.</div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="alert alert-danger">Email tidak ditemukan. Silakan coba lagi.</div>
                    <?php
                }
            } else {
                ?>
                <div class="alert alert-danger">Password dan konfirmasi password tidak cocok. Silakan coba lagi.</div>
                <?php
            }
        } else {
            ?>
            <div class="alert alert-danger">Mohon isi semua kolom dengan benar.</div>
            <?php
        }
    }
?>

<div class="col-md-9">
    <div class="row">
        <div class="col-md-12">
            <h3>Ganti Password</h3>
            <hr>
            <div class="col-md-7 content-menu" style="margin-top:-20px;">
                <form action="" method="post">
                    <label>Email</label><br>
                    <input type="email" class="form-control" name="email" required placeholder="Masukkan Email"><br>
                    <label>Password Baru</label><br>
                    <input type="password" class="form-control" name="password" required placeholder="Masukkan Password Baru"><br>
                    <label>Konfirmasi Password Baru</label><br>
                    <input type="password" class="form-control" name="confirm_password" required placeholder="Konfirmasi Password Baru"><br>
                    <input type="submit" name="form-input" value="Ganti Password" class="btn btn-success">
                </form>
            </div>
            <div class="col-md-7 content-menu">
                Sudah Punya Akun ? <a href="login.php">Login Sekarang !</a>
            </div>
        </div>
    </div>
</div>

<?php include "layout/footer.php"; ?>
