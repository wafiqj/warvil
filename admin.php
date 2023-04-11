<?php
require 'functions.php';


if(isset($_POST["tambah_menu"])) {
    if(tambah_menu($_POST)) {
        echo "<script>
            alert('Berhasil menambahkan menu');
            </script>";
    } else {
        echo "<script>
            alert('Gagal menambahkan menu');
            </script>";
    }
}

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
<a href= "logout.php" class="nav-link text-danger" onclick="return confirm('Apakah anda yakin ingin logout?');">Logout</a>
<h1>Tambah Menu</h1>

<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
    </div>
    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" class="form-control" id="harga" name="harga" required>
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <input type="text" class="form-control" id="deskripsi" name="deskripsi">
    </div>
    <div class="mb-3">
        <label for="gambar" class="form-label">Gambar</label>
        <input type="file" class="form-control" id="gambar" name="gambar">
    </div>
    <button type="submit" name="tambah_menu" class="btn btn-primary">Tambah</button>
</form>
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
                        <th scope="col">Aksi</th>
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
                        <td>
                            <a href="ubah.php?id=<?= $menu["id"]?>" class="btn btn-primary">Ubah</a>  <a href="hapus.php?id=<?= $menu["id"]?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data?');">Hapus</a>
                        </td>
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