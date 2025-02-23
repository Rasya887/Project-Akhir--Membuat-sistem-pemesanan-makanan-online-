<?php
include "connect.php";

// Ambil data dari form
$nama_menu = isset($_POST['nama_menu']) ? htmlentities($_POST['nama_menu']) : '';
$keterangan = isset($_POST['keterangan']) ? htmlentities($_POST['keterangan']) : '';
$harga = isset($_POST['harga']) ? str_replace('.', '', $_POST['harga']) : 0; // Menghapus titik pada harga
$stok = isset($_POST['stok']) ? intval($_POST['stok']) : 0;

$kode_rand = rand(10000, 99999) . "-";
$target_dir = "../asset/img/" . $kode_rand;
$target_file = $target_dir . basename($_FILES['foto']['name']);
$imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Cek apakah form valid
if (isset($_POST['input-menu-validate'])) {
    // Validasi file gambar
    $cek = getimagesize($_FILES['foto']['tmp_name']);
    if ($cek === false) {
        $message = "Ini bukan file gambar";
        $statusUpload = 0;
    } else {
        $statusUpload = 1;

        if (file_exists($target_file)) {
            $message = "File sudah ada";
            $statusUpload = 0;
        } elseif ($_FILES['foto']['size'] > 500000) {
            $message = "File terlalu besar";
            $statusUpload = 0;
        } elseif (!in_array($imageType, ["jpg", "png", "jpeg", "gif"])) {
            $message = "Format file tidak sesuai";
            $statusUpload = 0;
        }
    }

    // Jika validasi gambar gagal
    if ($statusUpload == 0) {
        echo '<script>alert("' . $message . ', Gambar tidak dapat diupload"); window.location.href = "../menu.php?x=menu";</script>';
        exit();
    }

    // Cek apakah nama menu sudah ada
    $select = mysqli_prepare($conn, "SELECT COUNT(*) FROM tb_daftar_menu WHERE nama_menu = ?");
    mysqli_stmt_bind_param($select, 's', $nama_menu);
    mysqli_stmt_execute($select);
    mysqli_stmt_bind_result($select, $count);
    mysqli_stmt_fetch($select);
    mysqli_stmt_close($select);

    if ($count > 0) {
        echo '<script>alert("Nama menu yang dimasukkan telah ada"); window.location="../menu.php?x=menu";</script>';
        exit();
    }

    // Upload file jika valid
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
        // Insert data ke database
        $query = mysqli_prepare($conn, "INSERT INTO tb_daftar_menu (foto, nama_menu, keterangan, harga, stok) VALUES (?, ?, ?, ?, ?)");
        $foto = $kode_rand . $_FILES['foto']['name'];
        mysqli_stmt_bind_param($query, 'sssii', $foto, $nama_menu, $keterangan, $harga, $stok);
        $result = mysqli_stmt_execute($query);
        mysqli_stmt_close($query);

        if ($result) {
            echo '<script>alert("Data berhasil dimasukkan"); window.location="../menu.php?x=menu";</script>';
        } else {
            echo '<script>alert("Data gagal dimasukkan"); window.location="../menu.php?x=menu";</script>';
        }
    } else {
        echo '<script>alert("Maaf, terjadi kesalahan file tidak dapat diupload"); window.location="../menu.php?x=menu";</script>';
    }
}
?>
