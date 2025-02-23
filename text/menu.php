<?php
 include "proses/connect.php";
$query = mysqli_query($conn,"SELECT * FROM tb_daftar_menu
    LEFT JOIN tb_category ON tb_category.id_cat_menu= tb_daftar_menu.category");
 while ($record = mysqli_fetch_array($query)){
  $result[] = $record;
 }

 $select_category = mysqli_query($conn, "SELECT id_cat_menu, category_menu FROM tb_category");
?>


<div class="col-lg mt-2">
    <div class="card">
        <div class="card-header"> 
            Halaman Menu
        </div>
        <div class="card-body">
        <div class="row">
    <div class="col d-flex justify-content-end">
        <?php if ($hasil['level'] == 1) { ?>
            <button class="btn text-white" data-bs-toggle="modal" data-bs-target="#modaladduser" style="background-color:#8B0000;">
                Tambah Menu
            </button>
        <?php } ?>
    </div>
</div>

            <!-- tambah menu baru!-->
            <div class="modal fade" id="modaladduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">add user</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  class="needs-validation" novalidate action="proses/proses-input-menu.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                    <div class="col">
            <div class="input-group mb-3">
  <input type="file" class="form-control my-3" id="uploadfoto" placeholder="Your name" name="foto" required>
  <label class="input-group-text" for="uploadfoto">Upload Foto Menu</label>
  <div class="invalid-feedback">
        Masukan File Foto Menu
      </div>
</div>
</div>
<div class="col">
<div class="form-floating mb-3">
  <input type="text" class="form-control" id="floatingInput" placeholder="Nama Menu" name="nama_menu" required>
  <label for="floatingInput">Nama Menu</label>
  <div class="invalid-feedback">
        Masukan Nama Menu.
      </div>
</div>
</div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput"
                placeholder="Keterangan" name="keterangan" required>
                <label for="floatingPassword">Keterangan</label>
                <div class="invalid-feedback">
        Masukkan keterangan
      </div>
        </div>
    </div>
</div>
<div class="row">
<div class="col-4">
<div class="form-floating">
<select class="form-select" aria-label="Default select example" name="cat-menu" required>
<option selected hidden value="">Pilih jenis Menu</option>
<?php foreach ($select_category as $value): ?>
    <option value="<?= htmlspecialchars($value['category_menu'], ENT_QUOTES) ?>">
        <?= htmlspecialchars($value['category_menu'], ENT_QUOTES) ?>
    </option>
<?php endforeach; ?>


</select>
<label for="floatingInput">Menu Makanan atau minuman</label>
<div class="invalid-feedback">
        Pilih Menu makanan atau Minuman
      </div>
</div>
</div>
<div class="col-4">
<div class="form-floating mb-3">
  <input type="number" class="form-control" id="floatingInput" placeholder="harga" name="harga" required>
  <label for="floatingInput">harga</label>
  <div class="invalid-feedback">
        Masukan jumlah harga
      </div>
</div>
</div>
<div class="col-4">
<div class="form-floating mb-3">
  <input type="number" class="form-control" id="floatingInput" placeholder="stok" name="stok" required>
  <label for="floatingInput">stok</label>
  <div class="invalid-feedback">
        Masukan jumlah stok
      </div>
</div>
</div>

</div>
<div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="input-menu-validate" value="12345">Save changes</button>
            </div>
</form>
            </div>

        </div>
    </div>
</div>
            <!-- tambah menu baru!-->

 <?php  foreach($result as $row)?>
        <!-- modal view-->
        <div class="modal fade" id="ModalView<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  class="needs-validation" novalidate action="proses/proses-view-menu.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                    <div class="col">
            <div class="input-group mb-3">
</div>
</div>
<div class="col-lg-12">
<div class="form-floating mb-3">
  <input disabled type="text" class="form-control" id="floatingInput" value="<?php echo $row['nama_menu']?>">
  <label for="floatingInput">Nama Menu</label>
  <div class="invalid-feedback">
        Masukan Nama Menu.
      </div>
</div>
</div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-floating mb-3">
            <input disabled  type="text" class="form-control" id="floatingInput"
                value="<?php echo $row['keterangan']?>">
                <label for="floatingPassword">Keterangan</label>
                <div class="invalid-feedback">
        Masukkan keterangan
      </div>
        </div>
    </div>
</div>
<div class="row">
<div class="col-4">
<div class="form-floating">
<select class="form-select" aria-label="Default select example" name="cat-menu" required>
<option selected hidden value="">Pilih jenis Menu</option>
<?php foreach ($select_category as $value): ?>
    <?php if ($row['category'] == $value['id_cat_menu']): ?>
        <option selected value="<?= htmlspecialchars($value['id_cat_menu']) ?>">
            <?= htmlspecialchars($value['category_menu']) ?>
        </option>
    <?php else: ?>
        <option value="<?= htmlspecialchars($value['id_cat_menu']) ?>">
            <?= htmlspecialchars($value['category_menu']) ?>
        </option>
    <?php endif; ?>
<?php endforeach; ?>



</select>
<label for="floatingInput">Menu Makanan atau minuman</label>
<div class="invalid-feedback">
        Pilih Menu makanan atau Minuman
      </div>
</div>
</div>
<div class="col-4">
<div class="form-floating mb-3">
  <input disabled type="number" class="form-control" id="floatingInput" value="<?php echo $row['harga']?>">
  <label for="floatingInput">harga</label>
  <div class="invalid-feedback">
        Masukan jumlah harga
      </div>
</div>
</div>
<div class="col-4">
<div class="form-floating mb-3">
  <input disabled type="number" class="form-control" id="floatingInput" value="<?php echo $row['stok']?>">
  <label for="floatingInput">stok</label>
  <div class="invalid-feedback">
        Masukan jumlah stok
      </div>
</div>
</div>

</div>
</form>
            </div>

        </div>
    </div>
</div>
        <!-- modal view-->
      
 <!-- Modal Delete -->
<div class="modal fade" id="ModalDelete<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses-delete-menu.php" method="POST">
                    <!-- Input hidden untuk ID -->
                    <input type="hidden" value="<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" name="id"> 

                    <div class="col-lg-12">
                        Apakah Anda yakin ingin menghapus user 
                        <b><?php echo htmlspecialchars($row['nama_menu'], ENT_QUOTES, 'UTF-8'); ?></b>?
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- Tombol delete dengan value dan kondisi disabled -->
                        <button type="submit" class="btn btn-danger" 
                            name="input_user_validate" 
                            value="12345">
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
 
         if(empty($result)){
          echo "Data user tidak ada";
         }else

         
         ?>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr class="text-nowrap">
                <th scope="col">No</th>
                <th scope="col">Foto</th>
                <th scope="col">Nama menu</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Jenis Menu</th>
                <th scope="col">Harga</th>
                <th scope="col">Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($result as $row) {
            ?>
                <tr>
                    <th scope="row"><?php echo $no++; ?></th>
                    <td>
                        <div style="width: 50px">
                            <img src="asset/img/<?php echo htmlspecialchars($row['foto']); ?>" class="img-thumbnail" alt="Menu Image">
                        </div>
                    </td>
                    <td><?php echo htmlspecialchars($row['nama_menu']); ?></td>
                    <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
                    <td><?php echo ($row['jenis_menu'] == 1) ? "Food" : "Drink"; ?></td>
                    <td><?php echo htmlspecialchars($row['harga']); ?></td>
                    <td><?php echo htmlspecialchars($row['stok']); ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
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
})();
</script>