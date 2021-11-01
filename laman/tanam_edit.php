<?php require('headernya.php');
	$idtanam = $_GET['idtanam'];
	$query = mysqli_query($kon, "SELECT * FROM tanam WHERE idtanam = '$idtanam'");
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
                <h2 style="display:inline;"><button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="bottom" title="Ubah"><i class="fas fa-edit"></i></button> Data Barang</h2>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" class="form-control" name="namatanam" value="<?= $data['namatanam']?>">
                  </div>
                  <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori" class="form-control">
                      <option value="<?= $data['kategori'] ?>"><?= $data['kategori'] ?></option>
                      <option value="Kemeja">Kemeja</option>
                      <option value="Sweater">Sweater</option>
                      <option value="Jilbab">Jilbab</option>
                      <option value="Tas">Tas</option>
                      <option value="Jam Tangan">Jam Tangan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Modal</label>
                    <input type="text" class="form-control" name="modal" value="<?= $data['modal']?>">
                  </div>
                  <div class="form-group">
                    <label>Harga Reseller</label>
                    <input type="number" class="form-control" name="harga_r" value="<?= $data['harga_r']?>">
                  </div>
                </div>
              </div>
              </div>
              <div class="col-md-6 col-sm-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="POST" autocomplete="off">
                  <div class="form-group">
                    <label>Harga Jual</label>
                    <input type="number" class="form-control" name="harga" value="<?= $data['harga']?>">
                  </div>
                  <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="4"><?= $data['deskripsi']?></textarea>
                  </div>
                  <div class="form-group">
                    <label>Ubah Gambar</label>
                    <input type="file" class="form-control" name="foto">
                    <input type="hidden" class="form-control" name="fotoLama" value="<?= $data['gambar']?>">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="simpan" class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Simpan"><i class="far fa-handshake"></i></button>
                  <button type="button" onclick="window.location='tanam.php';" data-toggle="tooltip" data-placement="bottom" title="Kembali" class="btn btn-danger float-right">
                    <i class="far fa-window-close"></i></button>
                </div>
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
    $namatanam    = $_REQUEST['namatanam'];
    $kategori     = $_REQUEST['kategori'];
    $modal         = $_REQUEST['modal'];
    $harga_r        = $_REQUEST['harga_r'];
    $deskripsi    = $_REQUEST['deskripsi'];
    $harga       = $_REQUEST['harga'];

    $ekstensi_diperbolehkan = array('png','jpg','jpeg');
    $namafoto = $_FILES['foto']['name'];
    $x = explode('.', $namafoto);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];
    $foto     = $_FILES['foto']['error'];
    $fotoLama  = $_REQUEST['fotoLama'];

    if($foto){
      $ubah = mysqli_query($kon,"UPDATE tanam SET modal='$modal', namatanam='$namatanam', deskripsi = '$deskripsi', harga_r = '$harga_r', harga = '$harga', gambar = '$fotoLama', kategori = '$kategori' WHERE idtanam = '$idtanam'");
      ?> <script>alert('Berhasil Diperbaharui, tanpa Mengubah Foto');window.location='tanam.php';</script> <?php
    }else{
      if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        if($ukuran < 2048000){  
          $namabaru = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $namafoto);   
          move_uploaded_file($file_tmp, '../img/'.$namabaru);
          unlink("../img/".$fotoLama);
          $ubah = mysqli_query($kon,"UPDATE tanam SET modal='$modal', namatanam='$namatanam', deskripsi = '$deskripsi', harga_r = '$harga_r', harga = '$harga', gambar = '$namabaru' WHERE idtanam = '$idtanam'");
          
          if($ubah){
            ?> <script>alert('Berhasil Diperbaharui');window.location='tanam.php';</script> <?php
          }else{
            ?> <script>alert('Gagal Diperbaharui');window.location='tanam_edit.php?idtanam=<?=$idtanam?>';</script> <?php
          }
        }else{
          ?> <script>alert('Gagal, Ukuran File Maksimal 2MB!'); window.location = 'tanam_edit.php?idtanam=<?=$idtanam?>';</script><?php
        }
      }else{
        ?> <script>alert('Gagal, File yang diupload format jpg, jpeg atau png!'); window.location = 'tanam_edit.php?idtanam=<?=$idtanam?>';</script><?php
      }
    }    
} ?>