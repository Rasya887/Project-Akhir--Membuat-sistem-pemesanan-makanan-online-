<?php
include "connect.php";
session_start();

// Ambil data dari form dengan validasi
$kode_order = isset($_POST['kode_order']) ? mysqli_real_escape_string($conn, $_POST['kode_order']) : '';
$meja = isset($_POST['meja']) ? mysqli_real_escape_string($conn, $_POST['meja']) : '';
$pelanggan = isset($_POST['pelanggan']) ? mysqli_real_escape_string($conn, $_POST['pelanggan']) : '';
$catatan = isset($_POST['catatan']) ? mysqli_real_escape_string($conn, $_POST['catatan']) : '';

// Debug: Periksa apakah data dari form sudah diterima
echo "DEBUG: kode_order = $kode_order, meja = $meja, pelanggan = $pelanggan, catatan = $catatan <br>";

// Cek apakah session pelayan tersedia
if (!isset($_SESSION['id_padangfast']) || empty($_SESSION['id_padangfast'])) {
    die('<script>alert("Error: ID Pelayan tidak ditemukan!"); window.location="../order.php?x=order.php";</script>');
}

$id_pelayan = mysqli_real_escape_string($conn, $_SESSION['id_padangfast']);

// Cek apakah form dikirimkan
if (!empty($_POST['input-order-validate'])) {
    // Cek apakah kode order sudah ada
    $select = mysqli_query($conn, "SELECT * FROM tb_order WHERE id_order = '$kode_order'");
    
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Order yang dimasukkan telah ada"); window.location="../order.php?x=order";</script>';
    } else {
        // Query INSERT ke database
        $sql = "INSERT INTO tb_order (id_order, meja, pelanggan, catatan, pelayan) 
                VALUES ('$kode_order', '$meja', '$pelanggan', '$catatan', '$id_pelayan')";
        
        // Debug: Cetak query untuk dicek manual
        echo "DEBUG: SQL Query = $sql <br>";

        $query = mysqli_query($conn, $sql);

        // Periksa apakah query berhasil
        if ($query) {
            $message = '<script>alert("Data berhasil dimasukkan"); window.location="../order_item.php?x=orderitem&order='.$kode_order.'&meja='.$meja.'&pelanggan='.$pelanggan.'";</script>';
        } else {
            // Tangkap pesan error jika query gagal
            $message = '<script>alert("Data gagal dimasukkan: ' . mysqli_error($conn) . '");</script>';
        }
    }
} else {
    $message = '<script>alert("Validasi form tidak lengkap!");</script>';
}

// Tampilkan pesan
echo $message;
?>
