
<?php 
require "../../koneksi.php";

require('kepala2.php');
	$result = mysqli_query($kon, "SELECT * FROM belajar ORDER BY nama ASC");
?>

<!DOCTYPE html>
<html lang="id, in">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Cetak</title>
	<style>
		hr{ border: 2px; border-style: solid; width: 82%; }
		.wew{ margin-right: 15%; }
		.wow{ margin-left: 9%; float: left }		
		#kiri{
			width: 50%; height: 100px; float:left; font-weight: normal;
		}
		#kanan{
			width: 50%; height: 100px; float:right; font-weight: normal;
		}
		th{text-align:center;}
	</style>
	<style type="text/css" media="print"> @page { size: portrait; } </style>
</head>
<body>
	<!-- kop kelurahan -->
	
	</div>
	<!-- akhir kop -->

	<!-- container form inputan -->
<div class="container-fluid">
  <!-- tabel buat nampilin data -->
  <table class="table table-bordered table-sm" border="1px" style="font-weight: 400;">
    <thead class="text-center">
      <tr>
        <th>No</th>
		<th>Nama</th>
		<th>Alamatt</th>
		<th>NoHp</th>
      </tr>
    </thead>
<?php 
$i = 1;

while( $data = mysqli_fetch_array($result) ) :
 ?> 
<tr class="text-center">
  	<td><?= $i++; ?></td>
  	<td><?= $data['nama'] ?></td>
	<td><?= $data['alamat'] ?></td>
	<td><?= $data['nohp'] ?></td>
	
</tr>
<?php endwhile; ?>
  </table>
</div>	
</body>
</html>
<script>window.print()</script>