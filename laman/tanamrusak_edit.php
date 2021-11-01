<?php require('headernya.php');
	$idtanamrusak = $_GET['idtanamrusak'];
	$query = mysqli_query($kon, "SELECT * FROM tanamrusak INNER JOIN tanam ON tanamrusak.idtanam = tanam.idtanam WHERE idtanamrusak = '$idtanamrusak'");
	$data  = mysqli_fetch_array($query);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br><br>
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h2 style="display:inline;"><button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="bottom" title="Ubah"><i class="fas fa-edit"></i></button> Data Bibit Rusak</h2>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" name="tgl" value="<?= $data['tgl'] ?>">
                  </div>
                  <td>
                  <div class="form-group">
                  <label>Nama Bibit</label>
                    <select name="idtanam" class="form-control" onchange='ubah(this.value)' required>
                      <option readonly selected value="<?= $data['idtanam'] ?>"><?= $data['namatanam'] ?></option><?php
                        $epep = mysqli_query($kon, "SELECT * FROM tanam ORDER BY namatanam ASC");
                        $a    = "var maxStok = new Array();\n;";
                          while($bocil = mysqli_fetch_array($epep)) {
                              ?> <option value="<?= $bocil['idtanam'] ?>"><?= $bocil['namatanam'] ?></option> <?php
                              $a .= "maxStok['" . $bocil['idtanam'] . "'] = {maxStok:'" . addslashes($bocil['stok'])."'};\n";
                      } ?>
                    </select></td>
                  </div>
                  <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" class="form-control" id="maxStok" name="jumlah" value="<?= $data['jumlah'] ?>">
                  </div>
                  <div class="form-group">
                    <label>Catatan</label>
                    <textarea class="form-control" name="catatan"><?= $data['catatan'] ?></textarea>
                  </div>
                  <div class="form-group">
                    <label>Ganti Foto</label>
                    <input type="file" class="form-control" name="foto">
                    <input type="hidden" name="fotoLama" value="<?= $data['foto'] ?>">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="simpan" class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Simpan"><i class="far fa-handshake"></i></button>
                  <button type="button" onclick="window.location='tanamrusak.php';" data-toggle="tooltip" data-placement="bottom" title="Kembali" class="btn btn-danger float-right">
                    <i class="far fa-window-close"></i></button>
                </div>
            	</div>
            </div>
        </div> <!-- /.row -->
      </section>
  </div> <!-- /.content-wrapper -->
<?php require('footernya.php') ?>

<?php 
  require('../koneksi.php');
  if (isset($_POST['simpan'])) {
    $jumlah        = $_REQUEST['jumlah'];
    $tgl           = $_REQUEST['tgl'];
    $catatan       = $_REQUEST['catatan'];
    $idtanam       = $_REQUEST['idtanam'];

    $ekstensi_diperbolehkan = array('png','jpg','jpeg');
    $namafoto = $_FILES['foto']['name'];
    $x = explode('.', $namafoto);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];
    $foto     = $_FILES['foto']['error'];
    $fotoLama  = $_REQUEST['fotoLama'];

    if($foto){
      $ubah = mysqli_query($kon,"UPDATE tanamrusak SET jumlah='$jumlah', tgl='$tgl', catatan = '$catatan', idtanam = '$idtanam', foto = '$fotoLama' WHERE idtanamrusak = '$idtanamrusak'");
      ?> <script>alert('Berhasil Diperbaharui, tanpa Mengubah Foto');window.location='tanamrusak.php';</script> <?php
    }else{
      if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        if($ukuran < 2048000){  
          $namabaru = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $namafoto);   
          move_uploaded_file($file_tmp, '../img/'.$namabaru);
          unlink("../img/".$fotoLama);
          $ubah = mysqli_query($kon,"UPDATE tanamrusak SET jumlah='$jumlah', tgl='$tgl', catatan = '$catatan', idtanam = '$idtanam', foto = '$namabaru' WHERE idtanamrusak = '$idtanamrusak'");
          
          if($ubah){
            ?> <script>alert('Berhasil Diperbaharui');window.location='tanamrusak.php';</script> <?php
          }else{
            ?> <script>alert('Gagal Diperbaharui');window.location='tanamrusak_edit.php?idtanamrusak=<?=$idtanamrusak?>';</script> <?php
          }
        }else{
          ?> <script>alert('Gagal, Ukuran File Maksimal 2MB!'); window.location = 'tanamrusak_edit.php?idtanamrusak=<?=$idtanamrusak?>';</script><?php
        }
      }else{
        ?> <script>alert('Gagal, File yang diupload format jpg, jpeg atau png!'); window.location = 'tanamrusak_edit.php?idtanamrusak=<?=$idtanamrusak?>';</script><?php
      }
    }    
} ?>

 <script type="text/javascript">   
  <?php echo $a; ?>
  function ubah(id){  
      document.getElementById('maxStok').max = maxStok[id].maxStok; 
  };   
</script> 