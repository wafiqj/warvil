<?php
require 'functions.php';


if(isset($_POST["registrasi"])) {
    if(registrasi($_POST)) {
        echo "<script>
            alert('Registrasi berhasil');
            </script>";
        $_SESSION["username"] = 
        header('Location: index.php');
        exit;
    } else {
        echo "<script>
            alert('Registrasi gagal');
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warvil</title>
</head>
<body>
<h1>Halaman Registrasi</h1>

<form action="" method="post">
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="mb-3">
        <label for="password2" class="form-label">Konfirmasi Password</label>
        <input type="password" class="form-control" id="password2" name="password2" required>
    </div>
    <button type="submit" name="registrasi" class="btn btn-primary">Sign Up</button>
    <div class="text-center">
        <p>Sudah punya akun? <a href="login.php" class="btn btn-primary">Login</a></p>
    </div>
</form>
</body>
</html>