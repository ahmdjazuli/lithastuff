<?php require('headernya.php');  error_reporting(0); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content --><br>
<div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-default">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Filter Cetak</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="../assets/report/rpendapatan.php" target="_blank" method="post">
                <div class="input-group input-group-mb" style="margin-bottom: 10px">
                <div class="input-group-prepend" style="width: 50%">
                    <span class="input-group-text" style="width: 100%">Hari</span>
                </div>
                <input type="date" class="form-control" name="hari" value="<?= date('Y-m-d') ?>">
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="reset" class="btn btn-danger"><i class="fas fa-sync-alt"></i></button>
              <button type="submit" class="btn btn-primary"><i class="fas fa-file-pdf"></i></button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h2 style="display:inline;">Data Pendapatan Harian</h2>
                <button style="float: right" class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-sm" title="Cetak"><i class="fas fa-file-pdf"></i></button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTables" class="table table-bordered table-hover table-sm">
                  <thead class="table-dark">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Hari</th>
                        <th>Pembelian Pelanggan</th>
                        <th>Pembelian Reseller</th>
                        <th>Total Pendapatan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no = 1;
                      $query = mysqli_query($kon, "SELECT tglbeli, DATE(tglbeli) as hari FROM beli GROUP BY hari ORDER BY hari ASC");
                      while($data = mysqli_fetch_array($query)){
                        $hari = $data['hari'];
                        $pendapatan1 = mysqli_fetch_array(mysqli_query($kon, "SELECT level, SUM(total) as total FROM beli INNER JOIN user ON beli.id = user.id WHERE DATE(tglbeli) = '$hari' AND level = 'pelanggan'"));
                        $pendapatan2 = mysqli_fetch_array(mysqli_query($kon, "SELECT level, SUM(total) as total FROM beli INNER JOIN user ON beli.id = user.id WHERE DATE(tglbeli) = '$hari' AND level = 'reseller'"));
                        ?>
                          <tr class="text-center">
                          <td><?= $no++ ?></td> 
                          <td><?= tgl_indo($hari) ?></td>
                          <td>Rp. <?= number_format($pendapatan1['total'],0,'.','.') ?></td>
                          <td>Rp. <?= number_format($pendapatan2['total'],0,'.','.') ?></td>
                          <td>Rp. <?= number_format($pendapatan1['total']+$pendapatan2['total'],0,'.','.') ?></td>
                        <?php 
                      }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <hr>
            </div> <!-- /.card -->
          </div> <!-- /.col -->
        </div> <!-- /.row -->
      </div> <!-- /.container-fluid -->
    </section> <!-- /.content -->
  </div> <!-- /.content-wrapper -->
<?php require('footernya.php') ?>
