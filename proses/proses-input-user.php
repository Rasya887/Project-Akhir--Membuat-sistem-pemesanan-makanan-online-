<?php
include "connect.php";

// Ambil data dari form
$name = (isset($_POST['name'])) ? htmlentities($_POST['name']) : '';
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : '';
$level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : '';
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : '';
$password = md5('password'); // Anda mungkin ingin mengganti 'password' dengan password sebenarnya dari form

// Cek apakah form valid
if (!empty($_POST['input-user-validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
    if(mysqli_num_rows($select)> 0){
        $message = '<script>alert("nama yang dimasukan telah ada"); window.location="../user.php"</script>';
    } else{
    // Perbaiki query SQL
    $query = mysqli_query($conn, "INSERT INTO tb_user (name, username, level, nohp, password) 
    VALUES ('$name', '$username', '$level', '$nohp', '$password')");

    // Periksa apakah query berhasil
    if ($query) {
        $message = '<script>alert("Data berhasil dimasukkan"); window.location="../user.php"</script>';
    } else {
        // Tangkap pesan error jika query gagal
        $message = '<script>alert("Data gagal dimasukkan: ' . mysqli_error($conn) . '");</script>';
    }}
} else {
    $message = '<script>alert("Validasi form tidak lengkap!");</script>';
}

// Tampilkan pesan
echo $message;
?>
