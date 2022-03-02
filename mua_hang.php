<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Thanh toán</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include 'includes/head.php'; ?>
</head>
<body>
	<?php include 'includes/header.php'; ?>

	<?php
		if(!isset($_SESSION['dang_nhap'])) {
			echo 
			"
				<script type='text/javascript'>
					window.location.href = '/btl/dang_nhap.php'
				</script>
			";
		}

		// xử lý đặt hàng
		if(isset($_POST['dat_hang'])) {
			$id_khach_hang = $_SESSION['dang_nhap']["id_khach_hang"];
			$phuong_thuc_tt = 'Thanh toán khi nhận hàng';
			$ngay_dat_hang = date('Y-m-d');
			$tong_tien = $_SESSION['tong_tien_gio_hang'];
			$ten_kh = $_POST["ten_kh"];
			$email = $_POST["email"];
			$sdt = $_POST["sdt"];
			$dia_chi = $_POST["dia_chi"];
			$trang_thai = 'Đặt hàng';

			$sql_hdb = "INSERT INTO `tbl_hdb` (`id_khach_hang`, `phuong_thuc_tt`, `ngay_dat_hang`,`tong_tien`, `ten_kh`, `email`, `sdt`, `dia_chi`, `trang_thai`) 
				VALUES ('".$id_khach_hang."', '".$phuong_thuc_tt."', '".$ngay_dat_hang."', '".$tong_tien."', '".$ten_kh."', '".$email."', '".$sdt."', '".$dia_chi."', '".$trang_thai."');";

			if ($ket_noi->query($sql_hdb) === TRUE) {
				// insert chi tiết đơn hàng
				$id_hdb = $ket_noi->insert_id;
				foreach($_SESSION['gio_hang'] as $gh) {
					$id_sp = $gh['id_sp'];
					$so_luong = $gh['so_luong_sp'];
					$gia_ban = (int) $gh['gia_giam'];
					$tong_tien = (int) ($gh['gia_giam'] * $gh['so_luong_sp']);

					$sql_chi_tiet = "INSERT INTO `tbl_chi_tiet_hdb` (`id_hdb`, `id_sp`, `so_luong`, `gia_ban`,`tong_tien`) 
						VALUES ('".$id_hdb."', '".$id_sp."', '".$so_luong."', '".$gia_ban."', '".$tong_tien."');";
					
					$ket_noi->query($sql_chi_tiet);
				}

				// Sau khi đặt hàng xong xóa giỏ hàng
				unset($_SESSION['gio_hang']);
				unset($_SESSION['tong_tien_gio_hang']);

				echo 
				"
					<script type='text/javascript'>
						window.alert('Đặt hàng thành công.');
					</script>
				";

				echo 
				"
					<script type='text/javascript'>
						window.location.href = '/btl'
					</script>
				";
			} else {
				echo "<script type='text/javascript'>
					window.alert(Đặt hàng thất bại.');
				</script>";
				// echo "Error: " . $sql . "<br>" . $ket_noi->error;
			}
		}
	?>

   <!-- Checkout content section start -->
	<section class="pages checkout section-padding">
		<div class="container">
			<div class="row">
				<form method="post">
					<div class="col-sm-6">
						<div class="main-input single-cart-form padding60">
							<div class="log-title">
								<h3><strong>Thông tin khách hàng</strong></h3>
							</div>
							<div class="custom-input">
								<?php 
									$id_khach_hang = $_SESSION['dang_nhap']["id_khach_hang"];
									$sql = "SELECT * FROM tbl_khach_hang WHERE id_khach_hang = $id_khach_hang";
									$sql_query = mysqli_query($ket_noi, $sql);
									$khach_hang = mysqli_fetch_array($sql_query);
								?>
							
								<input type="text" name="ten_kh" value="<?php echo $khach_hang['ten_kh']; ?>" placeholder="Tên khách hàng" />
								<input type="email" name="email" value="<?php echo $khach_hang['email']; ?>" placeholder="Địa chỉ email" />
								<input type="text" name="sdt" value="<?php echo $khach_hang['sdt']; ?>" placeholder="Số điện thoại" />
								<div class="custom-mess">
									<textarea rows="2" name="dia_chi" placeholder="Địa chỉ nhận hàng"><?php echo $khach_hang['dia_chi']; ?></textarea>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-6">
						<div class="padding60">
							<div class="log-title">
								<h3><strong>Thông tin thanh toán</strong></h3>
							</div>
							<div class="cart-form-text pay-details table-responsive">
								<table>
									<thead>
										<tr>
											<th>Sản phẩm</th>
											<td>Tổng tiền</td>
										</tr>
									</thead>
									<tbody>
									<?php
										if(isset($_SESSION['gio_hang']) && !empty($_SESSION['gio_hang'])) {
											foreach($_SESSION['gio_hang'] as $gh) {
												?>
													<tr>
														<th><?php echo $gh["ten_sp"]; ?>  x <?php echo $gh['so_luong_sp'] ?></th>
														<td><?php echo $gh['gia_giam'] * $gh['so_luong_sp'] ?> vnđ</td>
													</tr>
												<?php
											}
											?>
											<?php
										} else {
											echo '<tr><td colspan="5">Không có sản phẩm nào</td></tr>';
										}
									?>
									</tbody>
									<tfoot>
										<tr>
											<th>Tổng tiền</th>
											<td><?php echo $_SESSION['tong_tien_gio_hang']; ?> vnđ</td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-6">
						<div class="text-center">
							<div class="normal-a">
								<p>Thanh toán khi nhận hàng</p>
							</div>
							<div class="categories">
								<div class="submit-text">
									<button name="dat_hang">Đặt mua</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
	<!-- Checkout content section end -->

	<?php include 'includes/footer.php'; ?>
</body>
</html>