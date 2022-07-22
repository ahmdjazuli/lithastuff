<?php require('header.php') ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="text-homeimage">
					<div class="maintext-image" data-scrollreveal="enter right over 1.5s after 0.1s" >
						 <p style="font-size:65px;">Lithastuff</p> 
					</div>
					<div class="subtext-image" data-scrollreveal="enter left over 1.7s after 0.3s">
						 <p style="font-size:30px;">Memakai pakaian yang pantas merupakan bentuk menghargai diri sendiri.</p> 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</header>


<!-- STEPS =============================-->
<div class="item content">
	<div class="container toparea">
		<div class="row text-center">
			<div class="col-md-4">
				<div class="col editContent">
					<span class="numberstep"><i class="fa fa-shopping-cart"></i></span>
					<h3 class="numbertext">Promosi</h3>
					<p>
						Tunggu apa lagi?<br> Beli sekarang sebelum besok naik harga!
					</p>
				</div>
				<!-- /.col-md-4 -->
			</div>
			<!-- /.col-md-4 col -->
			<div class="col-md-4 editContent">
				<div class="col">
					<span class="numberstep"><i class="fa fa-gift"></i></span>
					<h3 class="numbertext">Penjualan</h3>
					<p>
						 Cuma kami toko dengan harga termurah!
					</p>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.col-md-4 col -->
			<div class="col-md-4 editContent">
				<div class="col">
					<span class="numberstep"><i class="fa fa-download"></i></span>
					<h3 class="numbertext">Pengiriman</h3>
					<p>
						 Barang sampai ke tangan penerima yang tepat.
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
	
	
	<!-- LATEST ITEMS =============================-->
<section class="item content">
	<div class="container">
		<div class="underlined-title">
			<div class="editContent">
				<h1 class="text-center latestitems">Flash Sale</h1>
			</div>
			<div class="wow-hr type_short">
				<span class="wow-hr-h">
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				</span>
			</div>
		</div>
		<div class="row">
<?php 
	$tanam = mysqli_query($kon, "SELECT * FROM flashsale INNER JOIN tanam ON flashsale.idtanam = tanam.idtanam WHERE cekflash = 1");
	while($data = mysqli_fetch_array($tanam)){
		?>  
			<div class="col-md-4">
			<div class="productbox">
				<div class="fadeshop">
					<form action="beli.php" method="POST">
					<div class="captionshop text-center" style="display: none;">
						<h3><?= $data['namatanam'] ?></h3>
						<p> <?= substr(strip_tags($data['deskripsi']),0,90).'...'; ?> </p>
						<p>
							<input type="hidden" name="idtanam" value="<?= $data['idtanam'] ?>" class="form-control">
							<input type="number" name="jumlah" placeholder="contoh : 1" class="form-control" required>
							<button type="submit" class="belilah" id="beli"><i class="fa fa-shopping-cart"></i> Beli</button>
							<a href="detail.php?idtanam=<?= $data['idtanam'] ?>" class="learn-more detailslearn"><i class="fa fa-link"></i> Detail</a>
						</p>
					</div>
					<span class="maxproduct"><img src="img/<?= $data['gambar'] ?>" alt=""></span>
					</form>
				</div>
				<div class="product-details">
					<a href="#">
					<h1><del style="font-weight: normal">Rp. <?= number_format($data['hargaawal'],0,',','.') ?></del> Rp. <?= number_format($data['hasil'],0,',','.') ?></h1>
					</a>
					<span class="price">
					<span id="demo" class="edd_price"><script>
						var countDownDate = new Date("<?= $data['waktu'] ?>").getTime();
					</script></span>
					</span>
				</div>
			</div>
		</div>

<?php }  ?>
		</div>
	</div>
</div>
</section>

<!-- BUTTON =============================-->
<div class="item content">
	<div class="container text-center">
		<a href="belanja.php" class="homebrowseitems">Lihat Semua Produk
		<div class="homebrowseitemsicon">
			<i class="fa fa-star fa-spin"></i>
		</div>
		</a>
	</div>
</div>
<br/>

<?php require('footer.php') ?>