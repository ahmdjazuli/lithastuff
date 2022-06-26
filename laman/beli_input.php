<?php require('headernya.php'); error_reporting(0);  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"><br>
    <section class="content">
      <div class="container"><h2 class="text-center"><button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="bottom" title="Tambah"><i class="fas fa-folder-plus"></i></button> Tambah Pembelian Pelanggan</h2>
        <div class="row">
          <div class="col-md-4">
            <div class="card card-outline card-dark">
              <div class="card-header">
                <h3 class="card-title">Petunjuk</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <button class="btn btn-outline btn-danger"><i class="fas fa-plus"></i></button> untuk menambahkan daftar belanja. <br><br>
               <button class="btn btn-dark"><i class="far fa-handshake"></i></button> untuk menyimpan transaksi.
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card card-outline card-danger">
              <div class="card-body bg-dark">
                <form action="" method="POST">
                  <div class="form-group">
                    <label>Nama Barang</label>
                    <select name="idtanam" class="form-control" onchange='ubah(this.value)' required>
                      <option value="">-Pilih-</option>
                    <?php
                      $ahay = mysqli_query($kon, "SELECT * FROM tanam ORDER BY namatanam ASC");
                      $a    = "var harga = new Array();\n;";
                        while($baris = mysqli_fetch_array($ahay)) {
                          echo "<option value='$baris[idtanam]'>$baris[namatanam]</option>";
                          $a .= "harga['" . $baris['idtanam'] . "'] = {harga:'" . addslashes($baris['harga'])."'};\n";
                        } 
                      ?>
                  </select>
                  </div>
                  <div class="form-group">
                    <label>Harga</label>
                    <input type="number" class="form-control" name="harga" id="harga" readonly>
                  </div>
                  <div class="form-group">
                      <label>Jumlah</label>
                      <input type="number" name="jumlahku" class="form-control" required>
                  </div>
                  <button type="submit" name="tambah" class="btn btn-outline btn-danger" data-toggle="tooltip" data-placement="bottom" title="Tambah"><i class="fas fa-plus"></i></button>
                  <button type="button" class="btn btn-outline btn-default" data-toggle="tooltip" data-placement="bottom" title="Bersihkan Daftar Belanja"><a href="mohon_bersih.php" style="color: black; text-decoration: none"><i class="fas fa-sync-alt"></i></a></button>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-8 col-sm-12">
            <div class="card">
              <div class="card-body">
                <form role="form" action="" method="POST">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTables-example">
                            <thead class="success table-dark">
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Sub Harga</th>
                                    <th><i class="fa fa-toggle-on"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; $totalbelanja = 0; foreach ($_SESSION['keranjang'] as $idtanam => $jumlah) :
                                    $tanam = mysqli_query($kon, "SELECT * FROM tanam WHERE idtanam = '$idtanam'"); 
                                    $data = mysqli_fetch_assoc($tanam); 
                                    $subharga = $data['harga']*$jumlah;?>
                                    <tr class="text-center">
                                        <td><?= $no++; ?></td>
                                        <td><?= $data['namatanam'] ?></td>
                                        <td><?= $data['kategori'] ?></td>
                                        <td><?= $data['harga'] ?></td>
                                        <td><?= $jumlah ?></td>
                                        <td>Rp. <?= $subharga ?></td>
                                        <td> <a href="beli_hapus.php?idtanam=<?php echo $data['idtanam'] ?>" class="btn btn-outline btn-danger btn-sm"><i class="fas fa-trash"></i></a> </td>
                                    </tr>
                                <?php $totalbelanja+=$subharga; ?>
                                <?php endforeach ?>  
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="5">Total yang harus dibayarkan : </th>
                                <th colspan="2">
                                <span>Rp. <?= number_format($totalbelanja,0,',','.') ?></span>
                                </th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="form-group">
                      <label>Nama Pelanggan</label>
                      <select name="id" class="form-control" required>
                        <option value="">-Pilih-</option>
                      <?php
                        $gasken = mysqli_query($kon, "SELECT * FROM user WHERE level='pelanggan' ORDER BY nama ASC");
                          while($bakwan = mysqli_fetch_array($gasken)) {
                            echo "<option value='$bakwan[id]'>$bakwan[nama]</option>";
                          } 
                        ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <label>Pilihan COD</label>
                      <select name="idongkir" onchange='ubahCOD(this.value)' class="form-control" required>
                        <option value="">-Pilih-</option>
                      <?php
                        $j = mysqli_query($kon, "SELECT * FROM ongkir WHERE kota LIKE '%COD%'");
                        $b = "var tarif = new Array();\n;";
                          while($ju = mysqli_fetch_array($j)) {
                            echo "<option value='$ju[idongkir]'>$ju[kota] ($ju[ket])</option>";
                            $b .= "tarif['" . $ju['idongkir'] . "'] = {tarif:'" . addslashes($ju['tarif'])."'};\n";
                          } 
                        ?>
                    </select>
                    </div>
                    <div class="form-group">
                    <label>Tarif COD</label>
                    <input type="number" class="form-control" name="tarif" id="tarif" readonly>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="simpan" class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Simpan"><i class="far fa-handshake"></i></button>
                  <button type="button" onclick="window.location='beli.php';" data-toggle="tooltip" data-placement="bottom" title="Kembali" class="btn btn-danger float-right">
                    <i class="far fa-window-close"></i></button>
                </div>
              </div> <!-- /.card-body -->
            </div> <!-- /.card -->
          </div> <!-- /.col -->
        </div> <!-- /.row -->
      </section>
  </div> <!-- /.content-wrapper -->
<?php require('footernya.php') ?>

<?php 
  require('../koneksi.php');
  if (isset($_POST['tambah'])) {
      $idtanam  = $_REQUEST['idtanam'];
      $jumlahku = $_REQUEST['jumlahku'];
      $harga    = $_REQUEST['harga'];
      if (isset($_SESSION['keranjang'][$idtanam])) {
        $_SESSION['keranjang'][$idtanam] += $jumlahku;
      }else{
        $_SESSION['keranjang'][$idtanam] = $jumlahku;
      }

      echo "<script>window.location = 'beli_input.php';</script>";
  }
  if (isset($_POST['simpan'])) {
        $id          = $_REQUEST['id'];
        $tglbeli     = date('Y-m-d');
        $tarif       = $_REQUEST['tarif'];
        $idongkir    = $_REQUEST['idongkir'];
        $notransaksi = date('Ymds');

        $firdaus = mysqli_query($kon, "SELECT * FROM user WHERE id = '$id'");
        $capek = mysqli_fetch_array($firdaus);
        $alamat = $capek['alamat'];
        $totalbelanja += $tarif;

        $hasil = mysqli_query($kon,"INSERT INTO beli (id,total,tglbeli,bukti,alamat,status,tarifnya,idongkir) VALUES ('$id','$totalbelanja','$tglbeli','$namabaru','$alamat','Diterima','$tarif','$idongkir')");

        $idbeli = $kon->insert_id;
        foreach ($_SESSION['keranjang'] as $idtanam => $jumlah) {
          $query = mysqli_query($kon, "SELECT * FROM tanam WHERE idtanam = '$idtanam'");
          $ambil = mysqli_fetch_array($query);

          $namanya = $ambil['namatanam'];
          $harganya = $ambil['harga'];
          $subharga = $ambil['harga']*$jumlah;

          mysqli_query($kon,"INSERT INTO beliproduk (idbeli, idtanam,jumlah, namanya, harganya, subharga) VALUES ('$idbeli','$idtanam','$jumlah','$namanya','$harganya','$subharga')");
        }

        if($hasil){
          ?> <script>alert('Pembelian Sukses.'); window.location = 'beli.php';</script><?php
          unset($_SESSION['keranjang']);
        }else{
          ?> <script>alert('Gagal, cek kembali!.'); window.location = 'beli_input.php';</script><?php
        }
    }
?>
<script>   
    <?php echo $a.$b;?>
        function ubah(id){  
        document.getElementById('harga').value = harga[id].harga; 
    }function ubahCOD(id){  
        document.getElementById('tarif').value = tarif[id].tarif; 
    };
</script> 