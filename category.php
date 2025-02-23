
<?php
    session_start();
    if (empty($_SESSION['username_padangfast'])) {
        header('location:login.php');
    }
    include "proses/connect.php";
    $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_padangfast]'");
    $hasil = mysqli_fetch_array($query);
    ?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <body style="height:3000px">
    <!--heaader-->
    <?php include __DIR__ . "/header.php"; ?>
    <!--end-heaader-->
<div class="container-lg">
    <div class="row">
            <!--sidebar-->
            <?php include __DIR__ . "/sidebar.php"; ?>
<!--end-sidebar-->

    <!--content-->
    <?php
if (isset($_GET['x']) && $_GET['x'] == 'category') {
    include "text/catmenu.php";
}
?>
            <!--end-content-->
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>