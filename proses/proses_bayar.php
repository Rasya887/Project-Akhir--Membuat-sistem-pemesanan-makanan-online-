<?php
include "connect.php";
session_start();

// Ambil data dari form dengan validasi
$kode_order = isset($_POST['kode_order']) ? mysqli_real_escape_string($conn, $_POST['kode_order']) : '';
$meja = isset($_POST['meja']) ? mysqli_real_escape_string($conn, $_POST['meja']) : '';
$pelanggan = isset($_POST['pelanggan']) ? mysqli_real_escape_string($conn, $_POST['pelanggan']) : '';
$total = isset($_POST['total']) ? mysqli_real_escape_string($conn, $_POST['total']) : '';
$uang = isset($_POST['uang']) ? mysqli_real_escape_string($conn, $_POST['uang']) : '';
$kembalian = $uang - $total;

// Cek apakah form dikirimkan   
if (!empty($_POST['bayar-validate'])) {
    if ($kembalian<0) {
        $message = '<script>alert("NOMINAL UANG TIDAK MENCUKUPI"); window.location="../order_item.php?x=orderitem&order='.$kode_order.'&meja='.$meja.'&pelanggan='.$pelanggan.'";</script>';
        } else {
            // Query INSERT ke database
            $query = mysqli_query($conn, "INSERT INTO tb_bayar (id_bayar,nominal_uang,total_bayar) 
                    VALUES ('$kode_order', '$uang', '$total')");
    
            // Periksa apakah query berhasil
            if ($query) {
                $message = '<script>alert("Pembayaran Berhasil \nUang Kembalian Rp. '. $kembalian.'"); window.location="../order_item.php?x=orderitem&order='.$kode_order.'&meja='.$meja.'&pelanggan='.$pelanggan.'";</script>';
            } else {
                // Tangkap pesan error jika query gagal
                $message = '<script>alert("Pembayaran gagal: ' . mysqli_error($conn) . '")
                window.location="../order_item.php?x=orderitem&order='.$kode_order.'&meja='.$meja.'&pelanggan='.$pelanggan.'";</script>';
            }
        }
    } 

// Tampilkan pesan
echo $message;
?>
