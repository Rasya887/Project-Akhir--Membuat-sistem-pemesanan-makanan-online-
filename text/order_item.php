<?php
include "proses/connect.php";

// Pastikan $_GET['order'] terdefinisi dan valid
$order_id = isset($_GET['order']) ? intval($_GET['order']) : 0;

$query = mysqli_query($conn, "SELECT *, SUM(harga * jumlah) AS harganya FROM tb_list_order
    LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.`kode_order`
    LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
    LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
    WHERE tb_list_order.`kode_order` = $order_id
    GROUP BY id_list_order");


$result = [];
$kode = $meja = $pelanggan = ""; // Initialize variables


$kode = $_GET['order'] ?? '';  // Use null coalescing operator
$meja = $_GET['meja'] ?? '';
$pelanggan = $_GET['pelanggan'] ?? '';

while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
    //$kode = $record['id_order'] ?? '';  // Use null coalescing operator
    ///$meja = $record['meja'] ?? '';
    //$pelanggan = $record['pelanggan'] ?? '';
}

$select_menu = mysqli_query($conn, "SELECT id,nama_menu, category FROM tb_daftar_menu");
?>

<div class="col-lg mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Order Item
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="kodeorder" value="<?php echo htmlspecialchars($kode); ?>">
                        <label for="kodeorder">Kode Order</label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="meja" value="<?php echo htmlspecialchars($meja); ?>">
                        <label for="meja">Meja</label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="pelanggan" value="<?php echo htmlspecialchars($pelanggan); ?>">
                        <label for="pelanggan">Pelanggan</label>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Item Baru -->
            <div class="modal fade" id="tambahItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses-input_orderitem.php" method="POST">
                                <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-floating mb-3">
                                        <select class="form-select" name="menu" id="">
                                            <option selected hidden value="">Pilih Menu</option>
                                            <?php 
                                                foreach ($select_menu as $value) {
                                                echo "<option value='".$value['id']."'>".$value['nama_menu']."</option>";
                                                    }
                                            ?>
                                        </select>
                                            <label for="menu">Menu Makanan/Minuman</label>
                                            <div class="invalid-feedback">Pilih Menu</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="Jumlah porsi" name="jumlah" required>
                                            <label for="floatingInput">Jumlah Porsi</label>
                                            <div class="invalid-feedback">Masukkan Jumlah Porsi.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="catatan" name="catatan" required>
                                            <label for="floatingPassword">catatan</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="input-orderitem-validate" value="12345">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Tambah Item Baru -->

                        <!-- Modal Bayar -->
                        <div class="modal fade" id="bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-nowrap">
                            <th scope="col">Menu</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Qty</th>
                            <th scope="col">catatan</th>
                            <th scope="col">Total</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($result as $row) {
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['nama_menu']); ?></td>
                                <td><?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($row['jumlah']); ?></td>
                                <td><?php echo htmlspecialchars($row['catatan']); ?></td>
                                <td><?php echo number_format($row['harganya'], 0, ',', '.'); ?></td>
                            </tr>
                        <?php
                            $total += $row['harganya'];
                        }
                        ?>
                        <tr>
                            <td class="fw-bold" colspan="3">Total Harga</td>
                            <td class="fw-bold">
                                <?php echo number_format($total, 0, ',', '.'); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div>
                </div>
            </div>
                            <span class="text-danger fs-5 fw-semibold">Apakah anda yakin ingin melakukan pembayaran?</span>
                            <form class="needs-validation" novalidate action="proses/proses_bayar.php" method="POST">
                                <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                <input type="hidden" name="catatan" value="<?php echo $catatan ?>">
                                <input type="hidden" name="total" value="<?php echo $total ?>">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="Nominal Uang" name="uang" required>
                                            <label for="floatingInput">Nominal Uang</label>
                                            <div class="invalid-feedback">Masukkan Nominal Uang.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="bayar-validate" value="12345">Bayar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Bayar -->

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-nowrap">
                            <th scope="col">Menu</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Status</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($result as $row) {
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['nama_menu']); ?></td>
                                <td><?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($row['jumlah']); ?></td>
                                <td><?php 
                                if($row['status']==1){
                                    echo "<span class='badge text-bg-warning'>Masuk ke dapur</span>";
                                }elseif($row['status']==2){
                                    echo "<span class='badge text-bg-primary'>Siap Saji</span>";
                                }
                            ?></td>
                                <td><?php echo number_format($row['harganya'], 0, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($row['catatan']); ?></td>
                            </tr>
                        <?php
                            $total += $row['harganya'];
                        }
                        ?>
                        <tr>
                            <td class="fw-bold" colspan="4">Total Harga</td>
                            <td class="fw-bold">
                                <?php echo number_format($total, 0, ',', '.'); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div>
                <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : "btn btn-success" ; ?>" style="background-color: maroon; border-color: maroon;" data-bs-toggle="modal" data-bs-target="#tambahItem">
                                        <i class="bi bi-bag-plus-fill"></i>tambah item</i>
                                    </button>
                    <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : "btn btn-primary" ; ?>" style="background-color: maroon; border-color: maroon;" data-bs-toggle="modal" data-bs-target="#bayar"><i class="bi bi-wallet"></i>bayar</button>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal View -->
<div class="modal fade" id="ModalView<?php echo $row['id_order']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses-view-menu.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class
