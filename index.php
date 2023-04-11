<?php
require 'functions.php';
session_start();

if(!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION["id_user"];
$data_user = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id_user'");
$data_user = mysqli_fetch_assoc($data_user);

$menus = ambil("SELECT * FROM menus");
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
    <h1>Selamat datang <?= $data_user["nama"] ?></h1>
    <a href= "logout.php" class="nav-link text-danger" onclick="return confirm('Apakah anda yakin ingin logout?');">Logout</a>
    <section id="daftar">
    <div class="container">
        <div class="row text-center">
          <div class="col m-4">
            <h1 class="text-black fw-bold">Daftar Menu</h2>
          </div>
        </div>
        <div class="row text-center">
          <div id="container" class="col mb-4">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Deskripsi</th>
                        </tr>
                </thead>
                <tbody>

                    <?php $i=1 ?>
                    <?php foreach($menus as $menu) : ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td>
                            <img src="img/<?= $menu["gambar"]  ?>" width="100" alt="">
                        </td>
                        <td><?= $menu["nama"]  ?></td>
                        <td><?= $menu["harga"]  ?></td>
                        <td><?= $menu["deskripsi"]  ?></td>
                    </tr>
                    <?php $i++ ?>
                    <?php endforeach; ?>
                </tbody> 
            </table>  
          </div> 
        </div>
    </div>
</section>
</body>
</html>