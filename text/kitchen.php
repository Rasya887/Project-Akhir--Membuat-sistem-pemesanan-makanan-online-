    <?php
    include "proses/connect.php";

    // Pastikan $_GET['order'] terdefinisi dan valid
    $order_id = isset($_GET['order']) ? intval($_GET['order']) : 0;

    $query = mysqli_query($conn, "SELECT tb_list_order.*, tb_daftar_menu.nama_menu, tb_daftar_menu.harga, tb_order.meja, tb_order.pelanggan, tb_order.waktu_order, tb_bayar.id_bayar 
        FROM tb_list_order
        LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order
        LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
        LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
        GROUP BY tb_list_order.kode_order ORDER BY tb_order.waktu_order DESC");

    while ($record = mysqli_fetch_array($query)) {
        $result[] = $record;
    }

    $select_menu = mysqli_query($conn, "SELECT id,nama_menu, category FROM tb_daftar_menu");
    ?>

    <div class="col-lg mt-2">
        <div class="card">
            <div class="card-header">
                Halaman Kitchen
            </div>

            <!-- Modal Terima Dapur -->
            <?php foreach ($result as $row) { ?>
            <div class="modal fade" id="terima<?php echo $row['id_list_order']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu Makanan dan Minuman</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_terima_orderitem.php" method="POST">
                                <input type="hidden" name="id_list_order" value="<?php echo $row['id_list_order']; ?>">

                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-floating mb-3">
                                            <select disabled class="form-select" name="menu" required>
                                                <option selected value="<?php echo $row['menu']; ?>"><?php echo $row['nama_menu']; ?></option>
                                                <?php 
                                                    // Ambil menu lainnya dari tb_daftar_menu
                                                    while ($value = mysqli_fetch_assoc($select_menu)) {
                                                        if ($value['id'] != $row['menu']) {
                                                            echo "<option value='".$value['id']."'>".$value['nama_menu']."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <label for="menu">Menu Makanan/Minuman</label>
                                            <div class="invalid-feedback">Pilih Menu</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input disabled type="number" class="form-control" placeholder="Jumlah Porsi" name="jumlah" required value="<?php echo $row['jumlah']; ?>">
                                            <label for="floatingInput">Jumlah Porsi</label>
                                            <div class="invalid-feedback">Masukkan Jumlah Porsi.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
    <div class="col-lg-12">
        <div class="form-floating mb-3">
            <input readonly type="text" class="form-control" placeholder="Catatan" name="catatan" value="<?php echo $row['catatan']; ?>">
            <label for="floatingPassword">Catatan</label>
        </div>
    </div>
</div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="terima_orderitem_validate" value="12345">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- Akhir Modal Terima Dapur -->

            <!-- Modal Siap Saji -->
            <?php foreach ($result as $row) { ?>
            <div class="modal fade" id="siapsaji<?php echo $row['id_list_order']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Siap saji</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_siapsaji_orderitem.php" method="POST">
                                <input type="hidden" name="id_list_order" value="<?php echo $row['id_list_order']; ?>">

                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-floating mb-3">
                                            <select disabled class="form-select" name="menu" required>
                                                <option selected value="<?php echo $row['menu']; ?>"><?php echo $row['nama_menu']; ?></option>
                                                <?php 
                                                    // Ambil menu lainnya dari tb_daftar_menu
                                                    while ($value = mysqli_fetch_assoc($select_menu)) {
                                                        if ($value['id'] != $row['menu']) {
                                                            echo "<option value='".$value['id']."'>".$value['nama_menu']."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <label for="menu">Menu Makanan/Minuman</label>
                                            <div class="invalid-feedback">Pilih Menu</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input disabled type="number" class="form-control" placeholder="Jumlah Porsi" name="jumlah" required value="<?php echo $row['jumlah']; ?>">
                                            <label for="floatingInput">Jumlah Porsi</label>
                                            <div class="invalid-feedback">Masukkan Jumlah Porsi.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
    <div class="col-lg-12">
        <div class="form-floating mb-3">
            <input readonly type="text" class="form-control" placeholder="Catatan" name="catatan" value="<?php echo $row['catatan']; ?>">
            <label for="floatingPassword">Catatan</label>
        </div>
    </div>
</div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="siapsaji_orderitem_validate" value="12345">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- Akhir Modal Siap saji -->

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-nowrap">
                            <th scope="col">No</th>
                            <th scope="col">Kode Order</th>
                            <th scope="col">Waktu order</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if (!empty($result)) {
                            foreach ($result as $row) {
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo htmlspecialchars($row['kode_order']); ?></td>
                            <td><?php echo htmlspecialchars($row['waktu_order']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_menu']); ?></td>
                            <td><?php echo htmlspecialchars($row['jumlah']); ?></td>
                            <td><?php echo htmlspecialchars($row['catatan']); ?></td>
                            <td><?php 
                                if($row['status']==1){
                                    echo "<span class='badge text-bg-warning'>Masuk ke dapur</span>";
                                }elseif($row['status']==2){
                                    echo "<span class='badge text-bg-primary'>Siap Saji</span>";
                                }
                            ?></td>
                            <td class="d-flex">
                                <!-- Tombol Terima -->
                                <button class="<?php echo (empty($row['status'])) ? "btn btn-primary btn-sm me-1" : "btn btn-secondary btn-sm me-1 disabled"; ?>" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#terima<?php echo $row['id_list_order']; ?>">
                                    Terima
                                </button>

                                <!-- Tombol Siap Saji -->
                                <button class="<?php echo (empty($row['status']) || $row['status'] != 1) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-success btn-sm me-1 text-nowrap"; ?>" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#siapsaji<?php echo $row['id_list_order']; ?>">
                                    Siap Saji
                                </button>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='8' class='text-center'>Tidak ada data</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
