<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Trang chủ</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include 'includes/head.php'; ?>
</head>
<body>
	<?php include 'includes/header.php'; ?>

	<!-- slider-section-start -->
	<div class="main-slider-one main-slider-two slider-area">
		<div id="wrapper">
			<div class="slider-wrapper">
				<div id="mainSlider" class="nivoSlider">
					<img src="/btl/accets/img/slider/4.jpg" alt="main slider"/>
					<img src="/btl/accets/img/slider/6.jpg" alt="main slider"/>
				</div>
			</div>							
		</div>
	</div>
	<!-- slider section end -->

	<!-- tab-products section start -->
	<div class="tab-products single-products products-two section-padding">
		<div class="container">
			<div class="row">
				<div class="wrapper">
					<div class="row text-center">
						<div class="col-xs-12">
							<div class="section-title text-center">
								<h2>Sản phẩm</h2>
							</div>
						</div>
						<?php
							$sql = 'SELECT * FROM tbl_san_pham LIMIT 0, 8';

							$san_pham = mysqli_query($ket_noi, $sql);

							$i = 0;
							while ($row = mysqli_fetch_array($san_pham)) {
								++$i; ?>
						<div class="col-xs-12 col-sm-6 col-md-3 " style="margin-bottom: 30px">
							<div class="single-product">
								<div class="product-img">
									<div class="pro-type">
										<span>new</span>
									</div>
									<a href="/btl/chi_tiet_sp.php?id_sp=<?php echo $row["id_sp"]; ?>">
										<img src="/btl/img/<?php echo $row["anh"]; ?>"/>
									</a>
									<div class="actions-btn">
										<a href="?them_gio_hang=<?php echo $row["id_sp"]; ?>&&so_luong_sp=1"><i class="mdi mdi-cart"></i></a>
										<a href="/btl/chi_tiet_sp.php?id_sp=<?php echo $row["id_sp"]; ?>"><i class="mdi mdi-eye"></i></a>
									</div>
								</div>
								<div class="product-dsc">
									<p><a href="/btl/chi_tiet_sp.php?id_sp=<?php echo $row["id_sp"]; ?>"><?php echo $row["ten_sp"];?></a></p>
									<span><?php echo $row["gia_giam"];?> vnđ <del><?php echo $row["gia_ban"];?></del></span>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
					<br>
					<div class="text-center">
						<a href="/btl/san_pham.php" class="btn btn-default">Xem thêm</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- tab-products section end -->
	<?php include 'includes/footer.php'; ?>
</body>
</html>