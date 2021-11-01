<?php 
require "../../koneksi.php";
require "../../tgl_indo.php";
	$bulan 		= $_REQUEST['bulan'];
	$tahun 		= $_REQUEST['tahun'];

	if($bulan AND $tahun ){
		$result = mysqli_query($kon, "SELECT * FROM tanamrawat INNER JOIN tanamrusak ON tanamrawat.idtanamrusak = tanamrusak.idtanamrusak INNER JOIN tanam ON tanamrusak.idtanam = tanam.idtanam WHERE MONTH(tglrawat) = '$bulan' AND YEAR(tglrawat) = '$tahun' ORDER BY tglrawat ASC");
	}else{
		$result = mysqli_query($kon, "SELECT * FROM tanamrawat INNER JOIN tanamrusak ON tanamrawat.idtanamrusak = tanamrusak.idtanamrusak INNER JOIN tanam ON tanamrusak.idtanam = tanam.idtanam ORDER BY tglrawat ASC");
	}

	if(mysqli_num_rows($result)==0){
		?> <script>alert('Data Tidak Ditemukan');window.location='../../laman/tanamrawat.php';</script> <?php
	}

	require('kepala.php');
?>
<style type="text/css" media="print"> @page { size: portrait; } </style>
<h3 style="text-align: center;">Laporan Data Bibit Rawat</h3>
<h5 class="text-center">
	<?php 
	if($bulan AND $tahun){
		echo "Periode bulan ".$namabulan.' '.$tahun;
	} ?>
</h5>

<div class="container">
  <table class="table table-sm" border="1px" style="font-weight: 400;">
    <thead class="text-center">
      <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Nama Bibit</th>
        <th>Jumlah</th>
        <th>Status</th>
      </tr>
    </thead>
<?php 
$i = 1;
while( $data = mysqli_fetch_array($result) ) : ?>
<tr class="text-center">
  	<td><?= $i++; ?></td>
  	<td><?= haribulantahun($data['tglrawat'],true)?></td>          
	  <td><?= $data['namatanam'] ?></td>                   
	  <td><?= $data['kuantiti'] ?></td>
	  <td><?= $data['ket'] ?></td>
</tr>
<?php endwhile; ?>
  </table>
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