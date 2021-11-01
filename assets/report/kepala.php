<!DOCTYPE html>
<html lang="id, in">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css.map">
  	<link rel="stylesheet" href="../css/bootstrap-grid.min.css">
  	<link rel="stylesheet" href="../css/bootstrap-grid.min.css.map">
  	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="../icon/apple-touch-icon-57x57.png" />
  	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../icon/apple-touch-icon-114x114.png" />
  	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../icon/apple-touch-icon-72x72.png" />
  	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../icon/apple-touch-icon-144x144.png" />
  	<link rel="apple-touch-icon-precomposed" sizes="60x60" href="../icon/apple-touch-icon-60x60.png" />
  	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="../icon/apple-touch-icon-120x120.png" />
  	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="../icon/apple-touch-icon-76x76.png" />
  	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="../icon/apple-touch-icon-152x152.png" />
  	<link rel="icon" type="image/png" href="../icon/favicon-196x196.png" sizes="196x196" />
  	<link rel="icon" type="image/png" href="../icon/favicon-96x96.png" sizes="96x96" />
  	<link rel="icon" type="image/png" href="../icon/favicon-32x32.png" sizes="32x32" />
  	<link rel="icon" type="image/png" href="../icon/favicon-16x16.png" sizes="16x16" />
  	<link rel="icon" type="image/png" href="../icon/favicon-128.png" sizes="128x128" />
  	<meta name="application-name" content="&nbsp;"/>
  	<meta name="msapplication-TileColor" content="#FFFFFF" />
  	<meta name="msapplication-TileImage" content="../icon/mstile-144x144.png" />
  	<meta name="msapplication-square70x70logo" content="../icon/mstile-70x70.png" />
  	<meta name="msapplication-square150x150logo" content="../icon/mstile-150x150.png" />
  	<meta name="msapplication-wide310x150logo" content="../icon/mstile-310x150.png" />
  	<meta name="msapplication-square310x310logo" content="../icon/mstile-310x310.png" />
	<style>
		hr{ border: 2px; border-style: solid; width: 100%; }
		.wew{ margin-right: 5%; }
		.wow{ margin-left: 5%; float: left }		
		#kiri{
			width: 80%; height: 100px; float:left; font-weight: normal;
		}
		#kanan{
			width: 20%; height: 100px; float:right; font-weight: normal;
		}
		th{text-align:center;}
	</style>
</head>
<body>
<div class="container-fluid"><br>
	<p class="text-center"><b>
		<img src="../icon/logoreport.png" style="width: 200px">
		<br>
		<span style="font-weight: 400; font-size: 12px;">Alamat : Jembatan Rahmat RT01/RW01 Gang RINDU Nomor 3, <br>Kelurahan Bukat, Kecamatan Barabai Kabupaten HST</span>
	</p>
	<hr>
</div>
<?php 
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
	}
?>