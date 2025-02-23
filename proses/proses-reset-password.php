<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

if (!empty($_POST['input_user_validate'])) {
    $query = mysqli_query($conn, "UPDATE tb_user SET password= md5('password') WHERE id='$id'");
    if ($query) {
        $message = '<script>alert("password berhasil di reset"); 
        window.location="../index.php";</script>'; 
    } else {
        $message = '<scrip>alert("password gagal di reset");</script>';
    } 
    echo $message;
}
?>
