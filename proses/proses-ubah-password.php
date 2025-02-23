<?php
session_start();
include "connect.php";

$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : '';
$passwordlama = (isset($_POST['passwordlama'])) ? md5(htmlentities($_POST['passwordlama'])) : '';
$passwordbaru = (isset($_POST['passwordbaru'])) ? md5(htmlentities($_POST['passwordbaru'])) : '';
$repasswordbaru = (isset($_POST['repasswordbaru'])) ? md5(htmlentities($_POST['repasswordbaru'])) : '';

if (!empty($_POST['ubah-password-validate'])) {
    // Periksa apakah username dan password lama sesuai
    $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '{$_SESSION['username_padangfast']}' && password = '$passwordlama'");
    $hasil = mysqli_fetch_array($query);
    if ($hasil) {
        // Periksa apakah password baru sama dengan konfirmasi password
        if ($passwordbaru === $repasswordbaru) {
            // Lakukan pembaruan password
            $update = mysqli_query($conn, "UPDATE tb_user SET password='$passwordbaru' WHERE username = '{$_SESSION['username_padangfast']}'");
            if ($update) {
                $message = '<script>alert("Password berhasil diupdate"); window.history.back();</script>';
            } else {
                $message = '<script>alert("Terjadi kesalahan saat memperbarui password. Silakan coba lagi.");</script>';
            }
        } else {
            $message = '<script>alert("Password baru dan konfirmasi password tidak sesuai.");</script>';
        }
    } else {
        $message = '<script>alert("Password lama yang Anda masukkan salah."); window.history.back();</script>';
    }

    // Tampilkan pesan
    echo $message;
} else {
    header('location:../index.php');
}
?>
