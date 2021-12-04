<?php 
	session_start();
	$idtanam = $_GET['idtanam'];
	unset($_SESSION['keranjang'][$idtanam]);
	?><script> window.location = 'beli_input.php';</script><?php
?>