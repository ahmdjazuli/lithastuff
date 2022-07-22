<?php 
  require('headernya.php');
  error_reporting(1);

  $se= mysqli_fetch_array(mysqli_query($kon, "SELECT * FROM pengaturan WHERE id = 1"));
  $pengeluaran= mysqli_num_rows(mysqli_query($kon, "SELECT * FROM pengeluaran"));
   $kurir   = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM kurir"));
   $kirim = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM kirim"));
   $flashsale     = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM flashsale"));
   $pendapatan     = mysqli_num_rows(mysqli_query($kon, "SELECT DATE(tglbeli) as hari FROM beli GROUP BY hari"));
   $pendapatan1     = mysqli_num_rows(mysqli_query($kon, "SELECT MONTH(tglbeli) as bulan FROM beli GROUP BY bulan"));
   $ongkir   = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM ongkir"));
   $reseller   = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM `beli` INNER JOIN ongkir ON beli.idongkir = ongkir.idongkir INNER JOIN user ON beli.id = user.id WHERE level = 'reseller'"));
   $tanammasuk      = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM tanammasuk"));
   $beli   = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM `beli` INNER JOIN ongkir ON beli.idongkir = ongkir.idongkir INNER JOIN user ON beli.id = user.id WHERE level = 'pelanggan'"));
   $tanam      = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM tanam"));
   $user      = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM user WHERE NOT level='admin'"));
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br><br>
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <a href="user.php">
            <div class="info-box <?= $se['warna_master'] ?>">
              <span class="info-box-icon" style="font-size: 50px">
                <i class="fas fa-user-secret"></i></span>
              <div class="info-box-content">
                <span class="info-box-text"><b>Pengguna</b></span>
                <span class="info-box-number" style="font-size: 25px;"><?= $user ?></span>
              </div>
            </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <a href="kurir.php">
            <div class="info-box <?= $se['warna_master'] ?>">
              <span class="info-box-icon" style="font-size: 50px">
                <i class="fas fa-user-astronaut"></i></span>
              <div class="info-box-content">
                <span class="info-box-text"><b>Kurir</b></span>
                <span class="info-box-number" style="font-size: 25px;"><?= $kurir ?></span>
              </div>
            </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <a href="ongkir.php">
            <div class="info-box <?= $se['warna_master'] ?>">
              <span class="info-box-icon" style="font-size: 50px">
                <i class="fas fa-file-invoice-dollar"></i></span>
              <div class="info-box-content">
                <span class="info-box-text"><b>Ongkir</b></span>
                <span class="info-box-number" style="font-size: 25px;"><?= $ongkir ?></span>
              </div>
            </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <a href="tanam.php">
            <div class="info-box <?= $se['warna_master'] ?>">
              <span class="info-box-icon" style="font-size: 50px">
                <i class="fas fa-tshirt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text"><b>Barang</b></span>
                <span class="info-box-number" style="font-size: 25px;"><?= $tanam ?></span>
              </div>
            </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <a href="pengeluaran.php">
            <div class="info-box <?= $se['warna_master'] ?>">
              <span class="info-box-icon" style="font-size: 50px">
                <i class="fas fa-hand-holding-usd"></i></span>
              <div class="info-box-content">
                <span class="info-box-text"><b>Pengeluaran</b></span>
                <span class="info-box-number" style="font-size: 25px;"><?= $pengeluaran ?></span>
              </div>
            </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <a href="tanammasuk.php">
            <div class="info-box <?= $se['warna_report'] ?>">
              <span class="info-box-icon" style="font-size: 50px">
                <i class="fas fa-shopping-basket"></i></span>
              <div class="info-box-content">
                <span class="info-box-text"><b>Barang Masuk</b></span>
                <span class="info-box-number" style="font-size: 25px;"><?= $tanammasuk ?></span>
              </div>
            </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <a href="transaksi.php">
            <div class="info-box <?= $se['warna_report'] ?>">
              <span class="info-box-icon" style="font-size: 50px">
                <i class="fas fa-store-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text"><b>Pembelian Reseller</b></span>
                <span class="info-box-number" style="font-size: 25px;"><?= $reseller ?></span>
              </div>
            </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <a href="beli.php">
            <div class="info-box <?= $se['warna_report'] ?>">
              <span class="info-box-icon" style="font-size: 50px">
                <i class="fas fa-shopping-bag"></i></span>
              <div class="info-box-content">
                <span class="info-box-text"><b>Pembelian Pelanggan</b></span>
                <span class="info-box-number" style="font-size: 25px;"><?= $beli ?></span>
              </div>
            </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <a href="flashsale.php">
            <div class="info-box <?= $se['warna_report'] ?>">
              <span class="info-box-icon" style="font-size: 50px">
                <i class="fab fa-optin-monster"></i></span>
              <div class="info-box-content">
                <span class="info-box-text"><b>Flash Sale</b></span>
                <span class="info-box-number" style="font-size: 25px;"><?= $flashsale ?></span>
              </div>
            </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <a href="kirim.php">
            <div class="info-box <?= $se['warna_report'] ?>">
              <span class="info-box-icon" style="font-size: 50px">
                <i class="fas fa-shipping-fast"></i></span>
              <div class="info-box-content">
                <span class="info-box-text"><b>Pengiriman</b></span>
                <span class="info-box-number" style="font-size: 25px;"><?= $kirim ?></span>
              </div>
            </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <a href="pendapatan.php">
            <div class="info-box <?= $se['warna_report'] ?>">
              <span class="info-box-icon" style="font-size: 50px">
                <i class="fas fa-dollar-sign"></i></span>
              <div class="info-box-content">
                <span class="info-box-text"><b>Pendapatan Harian</b></span>
                <span class="info-box-number" style="font-size: 25px;"><?= $pendapatan ?></span>
              </div>
            </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <a href="pendapatan1.php">
            <div class="info-box <?= $se['warna_report'] ?>">
              <span class="info-box-icon" style="font-size: 50px">
                <i class="fas fa-dollar-sign"></i></span>
              <div class="info-box-content">
                <span class="info-box-text"><b>Pendapatan Bulanan</b></span>
                <span class="info-box-number" style="font-size: 25px;"><?= $pendapatan1 ?></span>
              </div>
            </div>
            </a>
          </div>

          <!-- kolom ke 2 -->
<!-- <div class="col-md-6">
  <div class="card">
    <div class="card-header border-0">
      <div class="d-flex justify-content-between">
        <h3 class="card-title">Statistik Hasil Penjualan</h3>
        <a color="black">2021</a>
      </div>
    </div>
    <div class="card-body">
      <div class="position-relative mb-4">
        <canvas id="statistik" height="200"></canvas>
      </div>
    </div>
  </div>  
</div> -->

<div class="col-md-12">
  <div class="card">
    <div class="card-header border-0">
      <div class="d-flex justify-content-between">
        <h3 class="card-title">Statistik Penjualan Terlaris</h3>
        <a color="black">2021</a>
      </div>
    </div>
    <div class="card-body">
      <div class="position-relative mb-4">
        <canvas id="statistik1" height="200"></canvas>
      </div>
    </div>
  </div>  
</div>

        </div> <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div> 
</div><!-- /.content wrapper -->

<?php require('footernya.php') ?>

<?php 
  $grafik = mysqli_query($kon, "SELECT MONTH(tglbeli) as bulan, MONTH(tglbeli) as angka, SUM(total) as total FROM beli WHERE status = 'Diterima' GROUP BY bulan");

  $grafik1 = mysqli_query($kon, "SELECT namatanam, terjual FROM tanam ORDER BY terjual DESC LIMIT 0,5");

  $total = [];
  $bulan = [];
  $namatanam = [];
  $terjual = [];

  while($baris=mysqli_fetch_array($grafik)){
    if($baris['bulan']==7){
      $baris['bulan'] = 'Juli';
    }else if($baris['bulan']==8){
      $baris['bulan'] = 'Agustus';
    }else if($baris['bulan']==6){
      $baris['bulan'] = 'Juni';
    }else if($baris['bulan']==1){
      $baris['bulan'] = 'Januari';
    }else if($baris['bulan']==2){
      $baris['bulan'] = 'Februari';
    }else if($baris['bulan']==3){
      $baris['bulan'] = 'Maret';
    }else if($baris['bulan']==4){
      $baris['bulan'] = 'April';
    }else if($baris['bulan']==5){
      $baris['bulan'] = 'Mei';
    }else if($baris['bulan']==9){
      $baris['bulan'] = 'September';
    }else if($baris['bulan']==10){
      $baris['bulan'] = 'Oktober';
    }else if($baris['bulan']==11){
      $baris['bulan'] = 'November';
    }else if($baris['bulan']==12){
      $baris['bulan'] = 'Desember';
    }
    $total[] = (float)$baris['total'];
    $bulan[] = (string)$baris['bulan'];
  } 

  while($baris1=mysqli_fetch_array($grafik1)){
    $namatanam[] = (string)$baris1['namatanam'];
    $terjual[] = (float)$baris1['terjual'];
  }
?>

<script src="../assets/plugins/chart.js/Chart.min.js"></script>
<script>
  $(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true

  var $salesChart = $('#statistik')
  var salesChart  = new Chart($salesChart, {
    type   : 'bar',
    data   : {
      labels  : <?php echo json_encode($bulan); ?>,
      datasets: [
        {
          backgroundColor: '<?= $se[warna_grafik] ?>',
          borderColor    : '#fd7e14',
          data           : <?php echo json_encode($total); ?>
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero: false,
            callback: function (value, index, values) {
              if (value >= 1) {
                value /= 1
              }
              return 'Rp. ' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
});

  $(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true

  var $salesChart = $('#statistik1')
  var salesChart  = new Chart($salesChart, {
    type   : 'horizontalBar',
    data   : {
      labels  : <?php echo json_encode($namatanam); ?>,
      datasets: [
        {
          backgroundColor: '<?= $se['background_grafik1'] ?>',
          borderColor    : '<?= $se['background_grafik'] ?>',
          borderWidth: 1.5,
          data           : <?php echo json_encode($terjual); ?>
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero: false
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
})
</script>
