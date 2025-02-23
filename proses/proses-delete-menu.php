<?php
include "connect.php";
$id = (isset($_POST['id_cat_menu'])) ? htmlentities($_POST['id_cat_menu']) : "";

if(!empty($_POST['input_menu_validate'])){
    $query = mysqli_query($conn, "DELETE FROM tb_daftar_menu WHERE id_cat_menu = '$id'");
    if($query){
        $message = '<script>alert("Data berhasil dihapus");
                    window.location="../user"</script>';
    }else{
        $message = '<script>alert("Data gagal dihapus");
                    window.location="../user"</script>';
    }
}
?>
