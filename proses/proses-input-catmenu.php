<?php
include "connect.php";

// Ambil data dari form
$jenismenu = (isset($_POST['jenismenu'])) ? htmlentities($_POST['jenismenu']) : '';
$catmenu = (isset($_POST['catmenu '])) ? htmlentities($_POST['catmenu ']) : '';

// Cek apakah form valid
if (!empty($_POST['input-catmenu-validate'])) {
    $select = mysqli_query($conn, "SELECT category_menu FROM tb_category_menu WHERE category_menu = '$catmenu'");
    if(mysqli_num_rows($select)> 0){
        $message = '<script>alert("nama yang dimasukan telah ada"); window.location="../category.php?x=category"</script>';
    } else{
    // Perbaiki query SQL
    $query = mysqli_query($conn, "INSERT INTO tb_category_menu (jenis_menu, category_menu) 
    VALUES ('$jenismenu', '$catmenu')");

    // Periksa apakah query berhasil
    if ($query) {
        $message = '<script>alert("Kategori berhasil dimasukkan"); window.location="../category.php?x=category"</script>';
    } else {
        // Tangkap pesan error jika query gagal
        $message = '<script>alert("Data gagal dimasukkan: ' . mysqli_error($conn) . '");window.location="../category.php?x=category"</script>';
    }}
} else {
    $message = '<script>alert("Validasi form tidak lengkap!");</script>';
}

// Tampilkan pesan
echo $message;
?>
