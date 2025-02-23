<?php
 include "proses/connect.php";
$query = mysqli_query($conn,"SELECT * FROM tb_category");
 while ($record = mysqli_fetch_array($query)){
  $result[] = $record;
 }
?>



<div class="col-lg mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Category
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn text-white" data-bs-toggle="modal" data-bs-target="#modaladduser" style="background-color:#8B0000;">Tambah Category Menu</button>
                </div>
            </div>
            <!-- tambah menu baru!-->
            <div class="modal fade" id="modaladduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah category menu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  class="needs-validation" novalidate action="proses/proses-input-catmenu.php" method="POST">
                    <div class="row">
                    <div class="col">
            <div class="form-floating mb-3">
  <select class="form-select" name="jenis menu" id="">
    <option value="1">Makanan</option>
    <option value="2">Minuman</option>
  </select>
  <label for="floatingInput">Jenis Menu</label>
  <div class="invalid-feedback">
        Masukan Jenis Menu
      </div>
</div>
</div>
<div class="col">
<div class="form-floating mb-3">
  <input type="text" class="form-control" id="floatingInput" placeholder="Kategori Menu" name="catmenu" required>
  <label for="floatingInput">Kategori Menu</label>
  <div class="invalid-feedback">
        Masukan Kategori Menu
      </div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="input-catmenu-validate" value="12345">Save changes</button>
            </div>
</form>
            </div>

        </div>
    </div>
</div>
            <!-- tambah menu baru!-->

 <?php  foreach($result as $row){?>
        <!-- modal view-->
        <div class="modal fade" id="ModalView<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> data user</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form  class="needs-validation" novalidate action="proses/proses-input-user.php" method="POST">
                    <div class="row">
                    <div class="col">
            <div class="form-floating mb-3">
  <input  type="text" class="form-control" id="floatingInput" placeholder="Your name" name="name" value="<?php echo $row['name'] ?>">
  <label for="floatingInput">name</label>
  <div class="invalid-feedback">
        Masukan nama
      </div>
</div>
</div>
<div class="col">
<div class="form-floating mb-3">
  <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" value="<?php echo $row['name'] ?>">
  <label for="floatingInput">username</label>
  <div class="invalid-feedback">
        Masukan username 
      </div>
</div>
</div>
</div>
<div class="row">
  <div class="col-lg-4">
    <div class="form-floating mb-3">
      <select class="form-select" aria-label="Default select example" name="level" id="" required>
        <?php
        $data = array("Owner/Admin", "cashier", "waiters", "kitchen");
        foreach ($data as $key => $value) {
          if ($row['level'] == $key + 1) {
            echo "<option selected value='$key'>$value</option>";
          } else {
            echo "<option value='$key'>$value</option>";
          }
        }
        ?>
      </select>
      <label for="floatingInput">Level User</label>
      <div class="invalid-feedback">Pilih Level User.</div>
    </div>
  </div>
<div class="col-8">
<div class="form-floating mb-3">
  <input type="number" class="form-control" id="floatingInput" placeholder="08xxxxx" name="nohp"  value="<?php echo $row['nohp'] ?>">
  <label for="floatingInput">no-handphone</label>
  <div class="invalid-feedback">
        Masukan no handphone 
      </div>
</div>
</div>
<div class="col">
<div class="form-floating mb-3">
  <input type="password" class="form-control" id="floatingInput" placeholder="*****"  value="12345" name="password"  value="<?php echo $row['password'] ?>">
  <label for="floatingInput">password</label>
  <div class="invalid-feedback">
        Masukan password
      </div>
</div>
</div>
</div>
<div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="input-user-validate" value="12345">Save changes</button>
            </div>
</form>
            </div>
        </div>
    </div>
</div>
        <!-- modal view-->
             <!-- modal edit-->
        <div class="modal fade" id="ModalEdit<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> data user</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form  class="needs-validation" novalidate action="proses/proses-edit-user.php" method="POST">
            <input type="hidden" value="<?php echo $row['id'] ?>" name="id"> 
                    <div class="row">
                    <div class="col">
            <div class="form-floating mb-3">
  <input type="text" class="form-control" id="floatingInput" placeholder="Your name" name="name"  required value="<?php echo $row['name'] ?>">
  <label for="floatingInput">name</label>
  <div class="invalid-feedback">
        Masukan nama
      </div>
</div>
</div>
<div class="col">
<div class="form-floating mb-3">
  <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required value="<?php echo $row['name'] ?>">
  <label for="floatingInput">username</label>
  <div class="invalid-feedback">
        Masukan username 
      </div>
</div>
</div>
</div>
<div class="row">
  <div class="col-lg-4">
    <div class="form-floating mb-3">
      <select class="form-select" aria-label="Default select example" name="level" id="" required>
        <?php
        $data = array("Owner/Admin", "cashier", "waiters", "kitchen");
        foreach ($data as $key => $value) {
          if ($row['level'] == $key + 1) {
            echo "<option selected value='.($key+1).'>$value</option>";
          } else {
            echo "<option value='.($key+1).'>$value</option>";
          }
        }
        ?>
      </select>

<label for="floatingInput">level-user</label>
<div class="invalid-feedback">
        pilih level user
      </div>
</div>
</div>
<div class="col-8">
<div class="form-floating mb-3">
  <input type="number" class="form-control" id="floatingInput" placeholder="08xxxxx" name="nohp" required value="<?php echo $row['nohp'] ?>">
  <label for="floatingInput">no-handphone</label>
  <div class="invalid-feedback">
        Masukan no handphone 
      </div>
</div>
</div>
<div class="col">
<div class="form-floating mb-3">
  <input type="password" class="form-control" id="floatingInput" placeholder="*****"  value="12345" name="password" required  value="<?php echo $row['password'] ?>">
  <label for="floatingInput">password</label>
  <div class="invalid-feedback">
        Masukan password
      </div>
</div>
</div>
</div>
<div class="modal-footer">
    
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="input-user-validate" value="12345">Save changes</button>

            </div>
</form>
            </div>
        </div>
    </div>
</div>
 <!-- Modal Delete -->
<div class="modal fade" id="ModalDelete<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses-delete-user.php" method="POST">
                    <!-- Input hidden untuk ID -->
                    <input type="hidden" value="<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" name="id"> 

                    <div class="col-lg-12">
                        Apakah Anda yakin ingin menghapus user 
                        <b><?php echo htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8'); ?></b>?
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- Tombol delete dengan value dan kondisi disabled -->
                        <button type="submit" class="btn btn-danger" 
                            name="input_user_validate" 
                            value="12345"
                            <?php echo ($row['username'] == $_SESSION['username_padangfast']) ? 'disabled' : ''; ?>>
                            Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Delete -->
         <?php
 }
         if(empty($result)){
          echo "Data user tidak ada";
         }else{

         
         ?>
         <!--  tabel daftar kategori Menu-->
         <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Jenis Menu</th>
                            <th scope="col">Category</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no =1;
                      foreach($result as $row){
                       

                      
                      ?>
                        <tr>
                            <th scope="row"><?php echo $no++  ?></th>
                         <td><?php  echo ($row['jenis_menu']==1)  ? "Makanan" : "Minuman"?></td>
                            <td><?php  echo $row['category_menu']   ?></td>
                            <td class="d-flex">
                            <button class="btn btn-sm me-1" style="background-color: maroon; border-color: maroon;" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id_cat_menu']; ?>">
    <i class="bi bi-eye text-white"></i>
</button>
<button class="btn btn-sm me-1 data-bs-toggle="modal style="background-color: maroon; border-color: maroon;" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_cat_menu']; ?>">
    <i class="bi bi-pencil-square text-white"></i>
</button>
<button class="btn btn-sm me-1" style="background-color: maroon; border-color: maroon;" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id_cat_menu']; ?>">
    <i class="bi bi-trash text-white"></i>
</button>

                      </td>
                        </tr>
                        <?php
                      }
                        ?>
                    </tbody>
                </table>
            </div>
                      <!-- Akhir table daftar kategori menu -->
            <?php 
         }
            ?>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="input-user-validate" value="12345">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script>
