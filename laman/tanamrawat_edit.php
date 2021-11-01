<?php require('headernya.php');
	$idtanamrawat = $_GET['idtanamrawat'];
	$query = mysqli_query($kon, "SELECT * FROM tanamrawat INNER JOIN tanamrusak ON tanamrawat.idtanamrusak = tanamrusak.idtanamrusak INNER JOIN tanam ON tanamrusak.idtanam = tanam.idtanam WHERE idtanamrawat = '$idtanamrawat'");
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
                <h2 style="display:inline;"><button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="bottom" title="Ubah"><i class="fas fa-edit"></i></button> Data Bibit Rawat</h2>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="POST" autocomplete="off">
                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" name="tglrawat" value="<?= $data['tglrawat'] ?>">
                  </div>
                  <div class="form-group">
                    <label>Nama Bibit</label>
                    <input type="text" class="form-control" name="namatanam" value="<?= $data['namatanam'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" class="form-control" name="kuantiti" value="<?= $data['kuantiti'] ?>">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="simpan" class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Simpan"><i class="far fa-handshake"></i></button>
                  <button type="button" onclick="window.location='prosesrawat.php';" data-toggle="tooltip" data-placement="bottom" title="Kembali" class="btn btn-danger float-right">
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
    $tglrawat      = $_REQUEST['tglrawat'];
    $kuantiti     = $_REQUEST['kuantiti'];

    $ubah = mysqli_query($kon,"UPDATE tanamrawat SET tglrawat='$tglrawat', kuantiti='$kuantiti' WHERE idtanamrawat = '$idtanamrawat'");
    if($ubah){
      ?> <script>alert('Berhasil Diperbaharui');window.location='tanamrawat.php?idtanamrawat=<?= $idtanamrawat; ?>';</script> <?php
    }else{
      ?> <script>alert('Gagal Diperbaharui');window.location='tanamrawat_edit.php?idtanamrawat=<?= $idtanamrawat; ?>';</script> <?php
    }
  }
 ?>