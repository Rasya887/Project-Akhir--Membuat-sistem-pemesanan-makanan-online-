<?php
include "connect.php";
session_start();

// Ambil data dari form dengan validasi
$id_list_order = isset($_POST['id_list_order']) ? mysqli_real_escape_string($conn, $_POST['id_list_order']) : '';
$catatan = isset($_POST['catatan']) ? mysqli_real_escape_string($conn, $_POST['catatan']) : '';

// Cek apakah form dikirimkan
if (isset($_POST['siapsaji_orderitem_validate']) && !empty($id_list_order)) {
    // Ambil data order yang sesuai dari database untuk validasi
    $query = mysqli_query($conn, "SELECT * FROM tb_list_order WHERE id_list_order='$id_list_order'");
    $order_data = mysqli_fetch_assoc($query);
    
    // Jika order tidak ditemukan, tampilkan error
    if (!$order_data) {
        echo '<script>alert("Order tidak ditemukan!"); window.location="../kitchen.php?x=kitchen";</script>';
        exit;
    }
    
    // Validasi apakah catatan dan data lain sesuai dengan yang ada di database
    if ($catatan === $order_data['catatan']) {
        // Data sudah sesuai, lakukan update status order menjadi "Diterima"
        $update_query = mysqli_query($conn, "UPDATE tb_list_order SET catatan='$catatan', status=2 WHERE id_list_order='$id_list_order'");
        
        if ($update_query) {
            echo '<script>alert("Order Siap disajikan"); window.location="../kitchen.php?x=kitchen";</script>';
        } else {
            echo '<script>alert("Gagal proses data: ' . mysqli_error($conn) . '"); window.location="../kitchen.php?x=kitchen";</script>';
        }
    } else {
        // Jika catatan tidak sesuai dengan yang ada di database
        echo '<script>alert("Catatan tidak sesuai dengan yang ada di database!"); window.location="../kitchen.php?x=kitchen";</script>';
    }
} else {
    echo '<script>alert("Form tidak valid! Pastikan semua data terisi dengan benar!"); window.location="../kitchen.php?x=kitchen";</script>';
}
?>
