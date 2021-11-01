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
                <h2 style="display:inline;"><button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="bottom" title="Tambah"><i class="fas fa-folder-plus"></i></button> Data</h2>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Nama Petani</label>
                    <input type="text" class="form-control" name="namapetani" value="" required>
                  </div>
                  <div>

                  <label>Tempat tanggal lahir</label>
                    <input type="text" class="form-control" name="ttl" value="" required>
                  </div>
                  <div>
                  <label>Tanaman Unggulan</label>
                    <input type="text" class="form-control" name="tanamanunggulan" value="" required>
                  </div>

                 
                <div class="card-footer">
                  <button type="submit" name="simpan" class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Simpan"><i class="far fa-handshake"></i></button>
                  <button type="button" onclick="window.location='belajar.php';" data-toggle="tooltip" data-placement="bottom" title="Kembali" class="btn btn-danger float-right">
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
    $idpetani   = $_REQUEST['idpetani'];
    $namapetani= $_REQUEST['namapetani'];
    $ttl = $_REQUEST['ttl'];
    $tanamanunggulan = $_REQUEST['tanamanunggulan'];

    
        
        $tambah = mysqli_query($kon,"INSERT INTO petanikopi(namapetani, ttl, tanamanunggulan) VALUES ('$namapetani','$ttl','$tanamanunggulan')");

        if($tambah){
      ?> <script>alert('Berhasil Disimpan');window.location='petani.php';</script> <?php
      }
}?>

