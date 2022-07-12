<?php 
require "../../koneksi.php";
require "../../tgl_indo.php";
	$bulan 		= $_REQUEST['bulan'];
	$tahun 		= $_REQUEST['tahun'];
	$status = $_REQUEST['status'];
	$metode   = $_REQUEST['metode'];

	if($bulan AND $tahun AND empty($status) AND empty($metode)){
		$result = mysqli_query($kon, "SELECT * FROM `beli` INNER JOIN ongkir ON beli.idongkir = ongkir.idongkir INNER JOIN user ON beli.id = user.id WHERE MONTH(tglbeli) = '$bulan' AND YEAR(tglbeli) = '$tahun' AND level = 'pelanggan' ORDER BY tglbeli ASC");
	}else if($bulan AND $tahun AND $status AND empty($metode)){
		$result = mysqli_query($kon, "SELECT * FROM `beli` INNER JOIN ongkir ON beli.idongkir = ongkir.idongkir INNER JOIN user ON beli.id = user.id WHERE MONTH(tglbeli) = '$bulan' AND YEAR(tglbeli) = '$tahun' AND status = '$status' AND level = 'pelanggan' ORDER BY tglbeli ASC");
	}else if($bulan AND $tahun AND empty($status) AND $metode == 1){
		$result = mysqli_query($kon, "SELECT * FROM `beli` INNER JOIN ongkir ON beli.idongkir = ongkir.idongkir INNER JOIN user ON beli.id = user.id WHERE MONTH(tglbeli) = '$bulan' AND YEAR(tglbeli) = '$tahun' AND level = 'pelanggan' AND namakota = '' ORDER BY tglbeli ASC");
	}else if($bulan AND $tahun AND empty($status) AND $metode == 2){
		$result = mysqli_query($kon, "SELECT * FROM `beli` INNER JOIN ongkir ON beli.idongkir = ongkir.idongkir INNER JOIN user ON beli.id = user.id WHERE MONTH(tglbeli) = '$bulan' AND YEAR(tglbeli) = '$tahun' AND level = 'pelanggan' AND namakota != '' ORDER BY tglbeli ASC");
	}else if($bulan AND $tahun AND $status AND $metode == 1){
		$result = mysqli_query($kon, "SELECT * FROM `beli` INNER JOIN ongkir ON beli.idongkir = ongkir.idongkir INNER JOIN user ON beli.id = user.id WHERE MONTH(tglbeli) = '$bulan' AND YEAR(tglbeli) = '$tahun' AND status = '$status' AND level = 'pelanggan' AND namakota = '' ORDER BY tglbeli ASC");
	}else if($bulan AND $tahun AND $status AND $metode == 2){
		$result = mysqli_query($kon, "SELECT * FROM `beli` INNER JOIN ongkir ON beli.idongkir = ongkir.idongkir INNER JOIN user ON beli.id = user.id WHERE MONTH(tglbeli) = '$bulan' AND YEAR(tglbeli) = '$tahun' AND status = '$status' AND level = 'pelanggan' AND namakota != '' ORDER BY tglbeli ASC");
	}else{
		?> <script>alert('Data Tidak Ditemukan');window.location='../../laman/beli.php';</script> <?php
	}

	if(mysqli_num_rows($result)==0){
		?> <script>alert('Data Tidak Ditemukan');window.location='../../laman/beli.php';</script> <?php
	}

	require('kepala.php');
?>

<style type="text/css" media="print"> @page { size: landscape; } </style>
<h3 style="text-align: center;">Laporan Data Pembelian</h3>
<h5 class="text-center">
	<?php 
	if($bulan AND $tahun AND empty($status) AND empty($metode)){
		echo "Periode bulan ".$namabulan.' '.$tahun. ', status : SEMUA dan metode : SEMUA';
	}else if($bulan AND $tahun AND $status AND empty($metode)){
		echo "Periode bulan ".$namabulan.' '.$tahun.' status yang di'.$status. ' dan metode : SEMUA';
	}else if($bulan AND $tahun AND empty($status) AND $metode == 1){
		echo "Periode bulan ".$namabulan.' '.$tahun.' status SEMUA dan metode : Offline';
	}else if($bulan AND $tahun AND empty($status) AND $metode == 2){
		echo "Periode bulan ".$namabulan.' '.$tahun.' status SEMUA dan metode : Online';
	}else if($bulan AND $tahun AND $status AND $metode == 1){
		echo "Periode bulan ".$namabulan.' '.$tahun.' status yang di'.$status. ' dan metode : Offline';
	}else if($bulan AND $tahun AND $status AND $metode == 2){
		echo "Periode bulan ".$namabulan.' '.$tahun.' status yang di'.$status. ' dan metode : Online';
	}?>
</h5>
<br>
	<!-- container form inputan -->
<div class="container-fluid">
  <!-- tabel buat nampilin data -->
  <table class="table table-sm" border="1px" style="font-weight: 400;">
    <thead class="text-center">
      <tr>
      <th>No</th>
      <th>Tanggal</th>
	    <th>Pembeli</th>
      <th>Metode</th>
	    <th>Tujuan</th>
      <th>Bukti Pembayaran</th>
      <th>Total</th>
      <th>Status</th>
      </tr>
    </thead>
<?php 
$i = 1;

while( $data = mysqli_fetch_array($result) ) :
 ?> 
<tr class="text-center">
  	<td><?= $i++; ?></td>
  	<td><?= haribulantahun($data['tglbeli'],true)?></td>          
	  <td><?= $data['nama'] ?></td>           
    <td><?= $data['kota'] == 'COD' ? $data['kota'].'('.$data['ket'].')' : $data['kota'] ?></td>
	  <td><?= $data['alamat'] ?></td>
	  <td><img src="../../img/<?= $data['bukti'] ?>" width='60px'></td>        
	  <td>Rp. <?= number_format($data['total'],0,',','.') ?> </td>       
	  <td><?= $data['status'] ?></td>
</tr>
<?php endwhile; ?>
  </table>
<!-- akhir table -->
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