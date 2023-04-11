<?php

$conn = mysqli_connect("localhost", "root", "", "warvil");

function ambil($command) {
    global $conn;
    $result = mysqli_query($conn, $command);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)) {
        $rows[] = $row; 
    }
    return $rows;
}

function registrasi($data) {
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $nama = htmlspecialchars($data["nama"]);

    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username sudah terdaftar');
        </script>";
        return false;
    }

    if($password !== $password2) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai!');        
        </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (id_user, role, username, password, nama) VALUES ('', 2, '$username', '$password', '$nama')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambah_menu($data) {
    global $conn;
    $nama = $data["nama"];
    $harga = $data["harga"];
    $deskripsi = $data["deskripsi"];

    $gambar = upload();
    if(!$gambar) {
        return false;
    } 

    $query = "INSERT INTO menus (id, nama, harga, deskripsi, gambar) VALUES ('', '$nama', '$harga', '$deskripsi', '$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if($error === 4) {
        echo "<script>
                alert('Pilih gambar terlebih dahulu');
        </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = pathinfo($namaFile, PATHINFO_EXTENSION);
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('File harus berupa gambar');
        </script>";
        return false;
    }

    if($ukuranFile > 1000000) {
        echo "<script>
                alert('Ukuran gambar terlalu besar');
        </script>";
        return false;
    }

    move_uploaded_file($tmpName, 'img/'.$namaFile);
    return $namaFile;
}
?>