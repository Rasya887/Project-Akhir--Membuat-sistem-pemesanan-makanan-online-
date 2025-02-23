<?php
include "connect.php";

// Ambil data dari form
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$name = (isset($_POST['name'])) ? htmlentities($_POST['name']) : "";
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "";

// Periksa apakah form valid
if (!empty($_POST['input-user-validate'])) {
    // Perbaiki query SQL
    $query = mysqli_query($conn, 
        "UPDATE tb_user 
        SET name='$name', username='$username', level='$level', nohp='$nohp' 
        WHERE id='$id'"
    );

    // Periksa apakah query berhasil
    if ($query) {
        $message = '<script>alert("Data berhasil diupdate"); window.location="../user.php"</script>';
    } else {
        // Tampilkan pesan error jika query gagal
        $message = '<script>alert("Data gagal diupdate: ' . mysqli_error($conn) . '");</script>';
    }
} else {
    $message = '<script>alert("Validasi form tidak lengkap!");</script>';
}

// Tampilkan pesan
echo $message;
?>
