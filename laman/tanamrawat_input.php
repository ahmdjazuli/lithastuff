<?php require('headernya.php');  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br><br>
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h2 style="display:inline;"><button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="bottom" title="Tambah"><i class="fas fa-folder-plus"></i></button> Data Bibit Rawat</h2>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="POST" autocomplete="off">
                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" name="tglrawat" value="<?= date('Y-m-d') ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Nama Bibit</label>
                    <select name="idtanamrusak" class="form-control" onchange='ubah(this.value)' required>
                      <option disabled selected>Pilih</option>
                    <?php
                      $epep = mysqli_query($kon, "SELECT * FROM tanamrusak INNER JOIN tanam ON tanamrusak.idtanam = tanam.idtanam ORDER BY tgl DESC");
                      $a    = "var maxStok = new Array();\n;";
                        while($bocil = mysqli_fetch_array($epep)) {
                          echo "<option value='$bocil[idtanamrusak]'>$bocil[namatanam] ($bocil[tgl]) : $bocil[catatan]</option>";
                          $a .= "maxStok['" . $bocil['idtanamrusak'] . "'] = {maxStok:'" . addslashes($bocil['stok'])."'};\n";
                        } 
                      ?>
                  </select>
                  </div>
                  <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" class="form-control" id="maxStok" name="kuantiti" required>
                  </div>
                  <div class="form-group">
                    <label>Catatan</label>
                    <textarea class="form-control" name="ket"></textarea>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="simpan" class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Simpan"><i class="far fa-handshake"></i></button>
                  <button type="button" onclick="window.location='tanamrawat.php';" data-toggle="tooltip" data-placement="bottom" title="Kembali" class="btn btn-danger float-right">
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
  if (isset($_POST['simpan'])) {
    $idtanamrusak    = $_REQUEST['idtanamrusak'];
    $tglrawat = $_REQUEST['tglrawat'];
    $kuantiti = $_REQUEST['kuantiti'];
    $ket = $_REQUEST['ket'];

      $tambah = mysqli_query($kon,"INSERT INTO tanamrawat(tglrawat, kuantiti, idtanamrusak, ket) VALUES ('$tglrawat','$kuantiti','$idtanamrusak','$ket')");
      if($tambah){
        ?> <script>alert('Berhasil Disimpan');window.location='tanamrawat.php';</script> <?php
      }else{
        ?> <script>alert('Gagal');window.location='tanamrawat_input.php';</script> <?php
      }
  }
 ?>

<script type="text/javascript">   
  <?php echo $a; ?>
  function ubah(id){  
      document.getElementById('maxStok').max = maxStok[id].maxStok; 
  };   
</script> 