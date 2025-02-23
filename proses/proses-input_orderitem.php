<?php
include "connect.php";
session_start();

// Ambil data dari form dengan validasi
$kode_order = isset($_POST['kode_order']) ? mysqli_real_escape_string($conn, $_POST['kode_order']) : '';
$meja = isset($_POST['meja']) ? mysqli_real_escape_string($conn, $_POST['meja']) : '';
$pelanggan = isset($_POST['pelanggan']) ? mysqli_real_escape_string($conn, $_POST['pelanggan']) : '';
$catatan = isset($_POST['catatan']) ? mysqli_real_escape_string($conn, $_POST['catatan']) : '';
$menu = isset($_POST['menu']) ? mysqli_real_escape_string($conn, $_POST['menu']) : '';
$jumlah = isset($_POST['jumlah']) ? mysqli_real_escape_string($conn, $_POST['jumlah']) : '';


// Cek apakah form dikirimkan
if (!empty($_POST['input-orderitem-validate'])) {
    // Cek apakah kode order sudah ada
    $select = mysqli_query($conn, "SELECT * FROM tb_list_order WHERE menu = '$menu' && kode_order='$kode_order'");
    
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Item yang dimasukkan telah ada"); wwindow.location="../order_item.php?x=orderitem&order='.$kode_order.'&meja='.$meja.'&pelanggan='.$pelanggan.'";</script>';
    } else {
        // Query INSERT ke database
        $sql = "INSERT INTO tb_list_order (menu,kode_order,jumlah,catatan) 
                VALUES ('$menu', '$kode_order', '$jumlah', '$catatan')";
        
        // Debug: Cetak query untuk dicek manual
        echo "DEBUG: SQL Query = $sql <br>";

        $query = mysqli_query($conn, $sql);

        // Periksa apakah query berhasil
        if ($query) {
            $message = '<script>alert("Data berhasil dimasukkan"); window.location="../order_item.php?x=orderitem&order='.$kode_order.'&meja='.$meja.'&pelanggan='.$pelanggan.'";</script>';
        } else {
            // Tangkap pesan error jika query gagal
            $message = '<script>alert("Data gagal dimasukkan: ' . mysqli_error($conn) . '")
            window.location="../order_item.php?x=orderitem&order='.$kode_order.'&meja='.$meja.'&pelanggan='.$pelanggan.'";</script>';
        }
    }
} else {
    $message = '<script>alert("Validasi form tidak lengkap!");</script>';
}

// Tampilkan pesan
echo $message;
?>
