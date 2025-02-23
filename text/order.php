<?php
 include "proses/connect.php";
 date_default_timezone_set('Asia/Jakarta');
 $result = []; // Tambahkan ini sebelum while loop

 $query = mysqli_query($conn,"SELECT tb_order.*,tb_bayar.*,name, SUM(harga*jumlah) AS harganya FROM tb_order
     LEFT JOIN tb_user ON tb_user.id = tb_order.pelayan
     LEFT JOIN tb_list_order ON tb_list_order.kode_order = tb_order.id_order
     LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
     LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
     GROUP BY id_order ORDER BY waktu_order DESC");
 
 while ($record = mysqli_fetch_array($query)){
     $result[] = $record;
 }
 

// $select_category = mysqli_query($conn, "SELECT id_cat_menu, category_menu FROM tb_category");
?>


<div class="col-lg mt-2">
    <div class="card">
        <div class="card-header"> 
            Halaman Order
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn text-white" data-bs-toggle="modal" data-bs-target="#modaladduser" style="background-color:#8B0000;">Tambah Order </button>
                </div>
            </div>
            <!-- tambah order baru!-->
            <div class="modal fade" id="modaladduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Order makanan dan minuman</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  class="needs-validation" novalidate action="proses/proses-input-order.php" method="POST">
                    <div class="row">
                    <div class="col-lg-3">
            <div class="form-floating mb-3">
  <input type="text" class="form-control " id="uploadfoto"   name="kode_order" value="<?php echo date('ymdHi').rand(100,999)?>" readonly>
  <label  for="uploadfoto">Kode order</label>
  <div class="invalid-feedback">
        Masukan Kode order
      </div>
</div>
</div>
<div class="col-lg-2">
<div class="form-floating mb-3">
  <input type="text" class="form-control" id="meja" placeholder="Nomor Meja" name="meja" required>
  <label for="meja">Meja</label>
  <div class="invalid-feedback">
        Masukan Meja
      </div>
</div>
</div>
<div class="col-lg-7">
<div class="form-floating mb-3">
  <input type="text" class="form-control" id="Pelanggan" placeholder="Nama Pelanggan" name="pelanggan" required>
  <label for="Pelanggan">pelanggan</label>
  <div class="invalid-feedback">
        Masukan Nama Pelanggan
      </div>
</div>
</div>
</div>
<div class="row">
    <div class="col-lg-12">
        
        </div>
    </div>
</div>
<div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="input-order-validate" value="12345">Buat Order</button>
            </div>
</form>
            </div>

        </div>
    </div>
</div>
            <!-- tambah order baru!-->

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
                <th scope="col">Kode Order</th>
                <th scope="col">Meja</th>
                <th scope="col">Pelanggan</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Pelayan</th>
                <th scope="col">Status Order</th>
                <th scope="col">Waktu order</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($result as $row) {
            ?>
                <tr>
                    <th scope="row"><?php echo $no++; ?></th>
                    <td><?php echo htmlspecialchars($row['id_order']); ?></td>
                    <td><?php echo htmlspecialchars($row['meja']); ?></td>
                    <td><?php echo htmlspecialchars($row['pelanggan']); ?></td>
                    <td><?php echo htmlspecialchars($row['harganya']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo (!empty($row['id_bayar'])) ? "<span class='badge text-bg-success'>dibayar</span>" : ""; ?></td>
                    <td><?php echo htmlspecialchars($row['waktu_order']); ?></td>
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