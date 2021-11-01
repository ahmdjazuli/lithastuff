<?php 
require "../../koneksi.php";
require "../../tgl_indo.php";
	$bulan 		= $_REQUEST['bulan'];
	$tahun 		= $_REQUEST['tahun'];

	if($bulan AND $tahun ){
		$woy = mysqli_fetch_array(mysqli_query($kon, "SELECT SUM(total) as total FROM beli WHERE MONTH(tglbeli) = '$bulan' AND YEAR(tglbeli) = '$tahun' AND status = 'Diterima'"));
        $woy1 = mysqli_fetch_array(mysqli_query($kon, "SELECT SUM(total) as total FROM pengeluaran WHERE MONTH(tgl) = '$bulan' AND YEAR(tgl) = '$tahun'"));
	}

	require('kepala.php');
?>
<style type="text/css" media="print"> @page { size: portrait; margin: minimum; } </style>
<style>th{text-align:left;}</style>
<h3 class="text-center">Laporan Laba tahun <?= $tahun ?></h3>
<h5 class="text-center">
	<?php 
	if($bulan){
		echo "Periode bulan <b>".$namabulan."</b>";
	}?>
</h5>
<br>
<div class="container">
<div class="row">
  <div class="col-md-4">
  <table class="table table-striped table-bordered table-responsive">
		<tr>
			<th style="font-weight: normal;">Laba Kotor</th>
			<td style="font-weight: normal;">Rp. <?php echo number_format($woy['total'],0,'.','.') ?></td>
		</tr>
		<tr>
			<th style="font-weight: normal;">Biaya Pengeluaran</th>
			<td style="font-weight: normal;">Rp. <?php echo number_format($woy1['total'],0,'.','.') ?></td>
		</tr>
		<tr>
			<th>Laba Bersih</th>
			<td>Rp. <?php echo number_format($woy['total']-$woy1['total'],0,'.','.') ?></td>
		</tr>
	</table>
	</div>
</div>
</div>
<div id="kiri"></div>
<div id="kanan">
	Mengetahui,<br><br><br>
	Pemilik Toko
</div>
<script>
	window.print();
</script> 	
</body>
</html>