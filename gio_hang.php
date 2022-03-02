<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Giỏ hàng</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include 'includes/head.php'; ?>
</head>
<body>
	<?php include 'includes/header.php'; ?>

    <!-- cart content section start -->
    <section class="pages cart-page section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-responsive padding60">
                        <table class="wishlist-table text-center">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($_SESSION['gio_hang']) && !empty($_SESSION['gio_hang'])) {
                                        foreach($_SESSION['gio_hang'] as $gh) {
                                            ?>
                                                <tr>
                                                    <td  class="td-img text-left">
                                                        <a href="/btl/chi_tiet_sp.php?id_sp=<?php echo $gh["id_sp"]; ?>"><img src="/btl/img/<?php echo $gh["anh"]; ?>">" alt="Add Product" /></a>
                                                        <div class="items-dsc">
                                                            <h5><a href="/btl/chi_tiet_sp.php?id_sp=<?php echo $gh["id_sp"]; ?>"><?php echo $gh['ten_sp'] ?></a></h5>
                                                            <p class="itemcolor">Color : <span>Blue</span></p>
                                                            <p class="itemcolor">Size   : <span>SL</span></p>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $gh['gia_giam'] ?>vnđ</td>
                                                    <td>
                                                        <?php echo $gh['so_luong_sp'] ?>
                                                    </td>
                                                    <td>
                                                        <strong><?php echo $gh['gia_giam'] * $gh['so_luong_sp'] ?>vnđ</strong>
                                                    </td>
                                                    <td><a href="?xoa_gio_hang=<?php echo $gh["id_sp"]; ?>"><i class="mdi mdi-close" title="Remove this product"></i></a></td>
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
                        </table>
                    </div>
                </div>
            </div>
           
            <div class="text-center" style="margin-top: 30px;">
                <?php
                    if(isset($_SESSION['dang_nhap']) && !empty($_SESSION['dang_nhap'])) {
                ?>
                    <a href="/btl/mua_hang.php" class="btn btn-success">Mua hàng</a>
                <?php 
                    } else{
                ?>
                    <a href="/btl/dang_nhap.php" class="btn btn-success">Đăng nhập để mua hàng</a>
                <?php 
                    }
                ?>
            </div>
        </div>
    </section>
    <!-- cart content section end -->

	<?php include 'includes/footer.php'; ?>
</body>
</html>