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

	<?php 
		$id_sp = $_GET["id_sp"];
		$sql = "SELECT * FROM tbl_san_pham WHERE id_sp = $id_sp";
		$sql_query = mysqli_query($ket_noi, $sql);
		$san_pham = mysqli_fetch_array($sql_query);

	?>

	<!-- product-details-section-start -->
	<div class="product-details pages section-padding">
		<div class="container">
			<div class="row">
				<div class="single-list-view">
					<div class="col-xs-12 col-sm-5 col-md-4">
						<div class="quick-image">
							<div class="single-quick-image text-center">
								<div class="list-img">
									<div class="product-img tab-content">
										<div class="simpleLens-container tab-pane active fade in" id="sin-2">
											<div class="pro-type sell">
												<span>sell</span>
											</div>
											<a class="simpleLens-image" data-lens-image="/btl/img/<?php echo $san_pham['anh'] ?>" href="#"><img src="/btl/img/<?php echo $san_pham['anh'] ?>" alt="" class="simpleLens-big-image"></a>
										</div>
										<?php $anh_sp_query = mysqli_query($ket_noi, "SELECT * FROM tbl_anh WHERE id_sp = ".$id_sp);

											while ($anh = mysqli_fetch_array($anh_sp_query)) {?>
											<div class="simpleLens-container tab-pane fade in" id="sin-anh-<?php echo $anh['id_anh'] ?>">
												<div class="pro-type">
													<span>new</span>
												</div>
												<a class="simpleLens-image" data-lens-image="/btl/img/<?php echo $anh['anh'] ?>" href="#"><img src="/btl/img/<?php echo $anh['anh'] ?>" alt="" class="simpleLens-big-image"></a>
											</div>
										<?php }?>
									</div>
								</div>
							</div>
							<div class="quick-thumb">
								<ul class="product-slider">
									<li class="active"><a data-toggle="tab" href="#sin-anh-<?php echo $anh['id_anh'] ?>"> <img src="/btl/img/<?php echo $san_pham['anh'] ?>" alt="small image" /> </a></li>
									<?php 
										$anh_sp_query = mysqli_query($ket_noi, "SELECT * FROM tbl_anh WHERE id_sp = ".$id_sp);
										while ($anh = mysqli_fetch_array($anh_sp_query)) {?>
										<li><a data-toggle="tab" href="#sin-anh-<?php echo $anh['id_anh'] ?>"> <img src="/btl/img/<?php echo $anh['anh'] ?>" alt="quick view" /> </a></li>
									<?php }?>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-7 col-md-8">
						<form method="get">
							<input type="hidden" name="id_sp" value="<?php echo $_GET['id_sp'] ?>"/>
							<input type="hidden" name="them_gio_hang" value="<?php echo $_GET['id_sp'] ?>"/>
							<div class="quick-right">
								<div class="list-text">
									<h3><?php echo $san_pham['ten_sp'] ?></h3>
									<h5><del><?php echo $san_pham['gia_ban'] ?> vnđ</del> <?php echo $san_pham['gia_giam'] ?> vnđ</h5>
									<p><?php echo $san_pham['mo_ta'] ?></p>
									<div class="all-choose">
										<div class="s-shoose">
											<h5>Color</h5>
											<div class="color-select clearfix">
												<span></span>
												<span class="outline"></span>
												<span></span>
												<span></span>
											</div>
										</div>
										<div class="s-shoose">
											<h5>size</h5>
											<div class="size-drop">
												<div class="btn-group">
													<button type="button" class="btn">XL</button>
													<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<span class=""><i class="mdi mdi-chevron-down"></i></span>
													</button>
													<ul class="dropdown-menu">
														<li><a href="#">Xl</a></li>
														<li><a href="#">SL</a></li>
														<li><a href="#">S</a></li>
														<li><a href="#">L</a></li>
													</ul>
												</div>
											</div>
										</div>
										<div class="s-shoose">
											<h5>Số lượng</h5>
											<form action="#" method="POST">
												<div class="plus-minus">
													<a class="dec qtybutton">-</a>
													<input type="text" value="02" name="so_luong_sp" class="plus-minus-box">
													<a class="inc qtybutton">+</a>
												</div>
											</form>
										</div>
									</div>
									<div class="list-btn">
										<button class="btn btn-success">Thêm vào giỏ hàng</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- single-product item end -->
		</div>
	</div>
	<!-- product-details section end -->

	<?php include 'includes/footer.php'; ?>
</body>
</html>