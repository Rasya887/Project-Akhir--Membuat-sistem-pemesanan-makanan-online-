<?php
include "connect.php";

// Menampilkan error untuk debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Pastikan session dimulai jika diperlukan
session_start();

// Ambil ID yang diterima dari form
$id = isset($_POST['id']) ? (int)$_POST['id'] : null;
$validate = isset($_POST['input_user_validate']) ? $_POST['input_user_validate'] : null;

// Periksa apakah ID dan input valid
if (!empty($id) && $validate === "12345") {
    // Menggunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("DELETE FROM tb_user WHERE id = ?");
    
    if ($stmt) {
        $stmt->bind_param("i", $id); // "i" untuk tipe integer
        $execute = $stmt->execute();

        // Cek apakah eksekusi berhasil
        if ($execute) {
            // Redirect ke halaman user jika berhasil
            header('Location: ../user.php');
            exit();
        } else {
            // Tampilkan error dari query
            echo '<script>alert("Data gagal dihapus: ' . htmlspecialchars($stmt->error, ENT_QUOTES, 'UTF-8') . '");</script>';
        }
        $stmt->close();
    } else {
        // Tampilkan error jika prepared statement gagal
        echo '<script>alert("Gagal mempersiapkan statement SQL.");</script>';
    }
} else {
    // Tampilkan pesan error jika ID atau input tidak valid
    echo '<script>alert("ID tidak valid atau form tidak lengkap.");</script>';
}

// Tutup koneksi
$conn->close();
?>
