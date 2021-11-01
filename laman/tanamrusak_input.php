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
                <h2 style="display:inline;"><button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="bottom" title="Tambah"><i class="fas fa-folder-plus"></i></button> Data Bibit Rusak</h2>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" name="tgl" value="<?= date('Y-m-d') ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Nama Bibit</label>
                    <select name="idtanam" class="form-control" onchange='ubah(this.value)' required>
                      <option disabled selected>Pilih</option>
                    <?php
                      $epep = mysqli_query($kon, "SELECT * FROM tanam ORDER BY namatanam ASC");
                      $a    = "var maxStok = new Array();\n;";
                        while($bocil = mysqli_fetch_array($epep)) {
                          echo "<option value='$bocil[idtanam]'>$bocil[namatanam]</option>";
                          $a .= "maxStok['" . $bocil['idtanam'] . "'] = {maxStok:'" . addslashes($bocil['stok'])."'};\n";
                        } 
                      ?>
                  </select>
                  </div>
                  <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" class="form-control" id="maxStok" name="jumlah" required>
                  </div>
                  <div class="form-group">
                    <label>Catatan</label>
                    <textarea class="form-control" name="catatan"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Foto</label>
                    <input type="file" name="foto" class="form-control">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="simpan" class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Simpan"><i class="far fa-handshake"></i></button>
                  <button type="button" onclick="window.location='tanamrusak.php';" data-toggle="tooltip" data-placement="bottom" title="Kembali" class="btn btn-danger float-right">
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
    $idtanam       = $_REQUEST['idtanam'];
    $tgl           = $_REQUEST['tgl'];
    $jumlah        = $_REQUEST['jumlah'];
    $catatan       = $_REQUEST['catatan'];

    $ekstensi_diperbolehkan = array('png','jpg','jpeg');
    $namafoto = $_FILES['foto']['name'];
    $x = explode('.', $namafoto);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];

    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
      if($ukuran < 2048000){  
        $namabaru = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $namafoto);   
        move_uploaded_file($file_tmp, '../img/'.$namabaru);
        
        $tambah = mysqli_query($kon,"INSERT INTO tanamrusak(tgl, jumlah, idtanam, catatan, foto) VALUES ('$tgl','$jumlah','$idtanam','$catatan','$namabaru')");

        if($tambah){
          ?> <script>alert('Berhasil Disimpan');window.location='tanamrusak.php';</script> <?php
        }else{
          ?> <script>alert('Gagal');window.location='tanamrusak_input.php';</script> <?php
        }
      }else{
        ?> <script>alert('Gagal, Ukuran File Maksimal 2MB!'); window.location = 'tanamrusak_input.php';</script><?php
      }
    }else{
      ?> <script>alert('Gagal, File yang diupload format jpg, jpeg atau png!'); window.location = 'tanamrusak_input.php';</script><?php
    }    
}?>

<script type="text/javascript">   
  <?php echo $a; ?>
  function ubah(id){  
      document.getElementById('maxStok').max = maxStok[id].maxStok; 
  };   
</script> 