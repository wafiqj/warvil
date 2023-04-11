<?php
require 'functions.php';
session_start();

// cek cookie
if(isset($_COOKIE["id"]) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $cookie = mysqli_query($conn, "SELECT username FROM users WHERE id = $id");
    $cookie = mysqli_fetch_assoc($cookie);

    // cek cookie dan username
    if($key === hash('sha256', $cookie['username'])) {
        $_SESSION['login'] = true;
    }
}

// cek session
if(isset($_SESSION["login"])) {
  header("Location:   index.php");
  exit;
}

if(isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    if(mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);
        $id_user = $row["id"];

        if(password_verify($password, $row["password"])) {

            $_SESSION["login"] = true;
            $_SESSION["id_user"] = $id_user;

            // cek remember me
            if(isset($_POST["remember"])) {
            // set cookie
                setcookie('id', $row['id_user'], time()+60);
                setcookie('key', hash('sha256', $row['username']), time()+60);
        }
            if($row["role"] == 1) {
                header("Location: admin.php");
                exit;
            } else {
                header("Location: index.php");
                exit;
            }
        }
    }
    $error = true;

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
    <h1>Halaman Login</h1>

    <?php if(isset($error)) : ?>
        <div class="alert alert-danger" role="alert">
            Username atau password salah
        </div>
    <?php endif; ?>
    <section>
        <div class="container">
            <form action="" method="post">
                <!-- <div class="form-outline mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" autocomplete="off">
                </div> -->
                <div class="form-outline mb-4">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" autocomplete="off">
                </div>
                <div class="form-outline mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="remember" name="remember" autocomplete="off">
                            <label for="remember" class="form-check-label"> Remember me </label>
                        </div>
                    </div>
                    <div class="col">
                        <a href="#!">Forgot password?</a>
                    </div>
                </div>
                <button type="submit" name="login" class="btn btn-primary">Sign In</button>
                <div class="text-center">
                    <p>Belum punya akun? <a href="registrasi.php" class="btn btn-primary">Daftar</a></p>
                </div>
            </form>
        </div>
    </section>
    
</body>
</html>