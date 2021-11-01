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
              <form action="../assets/report/rtanamrawat.php" target="_blank" method="post">
              <div class="input-group input-group-mb" style="margin-bottom: 10px">
                <div class="input-group-prepend" style="width: 50%">
                    <span class="input-group-text" style="width: 100%">Bulan</span>
                </div>
                <select name="bulan" class="form-control" required>
                  <option value="">Pilih</option>
                  <?php
                    $ahay = mysqli_query($kon, "SELECT DISTINCT MONTH(tglrawat) as bulan FROM `tanamrawat` ORDER BY bulan ASC");
                    while($baris = mysqli_fetch_array($ahay)) {
                    $bulan = $baris['bulan']; 
                      if($bulan == 1){ $namabulan = "Januari";
                        }else if($bulan == 2){ $namabulan = "Februari";
                        }else if($bulan == 3){ $namabulan = "Maret";
                        }else if($bulan == 4){ $namabulan = "April";
                        }else if($bulan == 5){ $namabulan = "Mei";
                        }else if($bulan == 6){ $namabulan = "Juni";
                        }else if($bulan == 7){ $namabulan = "Juli";
                        }else if($bulan == 8){ $namabulan = "Agustus";
                        }else if($bulan == 9){ $namabulan = "September";
                        }else if($bulan == 10){ $namabulan = "Oktober";
                        }else if($bulan == 11){ $namabulan = "November";
                        }else if($bulan == 12){ $namabulan = "Desember";
                        } ?><option value="<?= $baris[bulan] ?>"><?= $namabulan; ?></option> 
                      }
                    <?php } ?>
                </select>
              </div>
                <div class="input-group input-group-mb" style="margin-bottom: 10px">
                    <div class="input-group-prepend" style="width: 50%">
                        <span class="input-group-text" style="width: 100%">Tahun</span>
                    </div>
                <select name="tahun" class="form-control">
                <?php
                    $ahay = mysqli_query($kon, "SELECT DISTINCT YEAR(tglrawat) as tahun FROM `tanamrawat` ORDER BY tahun ASC");
                    while($baris = mysqli_fetch_array($ahay)) {
                    $tahun = $baris['tahun']; 
                        ?><option value="<?= $baris[tahun] ?>"><?= $tahun; ?></option> 
                <?php } ?>
                </select>
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
                <h2 style="display:inline;">Data Bibit Rawat</h2>
                <button style="float: right;margin-left: 5px" class="btn btn-success" type="button" data-toggle="tooltip" data-placement="bottom" title="Tambah"><a href="tanamrawat_input.php" class="text-white"><i class="fas fa-folder-plus"></i></a>
                </button>
                <button style="float: right" class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-sm" title="Cetak"><i class="fas fa-file-pdf"></i></button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTables" class="table table-bordered table-hover table-sm">
                  <thead class="table-dark">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Bibit</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th class="hide"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no = 1;
                      $query = mysqli_query($kon, "SELECT * FROM tanamrawat INNER JOIN tanamrusak ON tanamrawat.idtanamrusak = tanamrusak.idtanamrusak INNER JOIN tanam ON tanamrusak.idtanam = tanam.idtanam ORDER BY tglrawat ASC");
                      while($data = mysqli_fetch_array($query)){
                        ?>
                          <tr class="text-center">
                          <td><?= $no++ ?></td>        
                          <td><?= haribulantahun($data['tglrawat'],true)?></td>             
                          <td><?= $data['namatanam'] ?></td>
                          <td><?= $data['kuantiti'] ?></td>
                          <td><?php 
                            $ohh = $data['idtanamrawat'];
                            $gini = mysqli_query($kon, "SELECT * FROM prosesrawat WHERE idtanamrawat = '$ohh' ORDER BY tgl DESC");
                            $lah = mysqli_fetch_array($gini);
                            if($lah['catatan'] == 'Selesai'){
                              ?> <a target="_blank" href="prosesrawat.php?idtanamrawat=<?= $data[idtanamrawat] ?>"><i class='fas fa-check'></i></a><?php
                            }else if($lah['catatan'] == 'Gagal'){
                              ?> <a target="_blank" href="prosesrawat.php?idtanamrawat=<?= $data[idtanamrawat] ?>"><i class='fas fa-times'></i></a><?php
                            }else{
                              ?> <a target="_blank" href="prosesrawat.php?idtanamrawat=<?= $data[idtanamrawat] ?>"><i class='fas fa-clock'></i></a><?php
                            }  ?></td>       
                          <td>
                            <button class="btn bg-warning" type="button"><a href="tanamrawat_edit.php?idtanamrawat=<?= $data['idtanamrawat'] ?>" class="text-white"><i class="far fa-edit"></i></a></button>
                            <button class="btn bg-orange" onclick="yakin = confirm('Apakah Kamu yakin ingin Menghapus?'); if(yakin){ window.location = 'hapus.php?idtanamrawat=<?= $data['idtanamrawat'] ?>';
                              }" type="button"><i class="fas fa-trash"></i></button>
                          </td>
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
