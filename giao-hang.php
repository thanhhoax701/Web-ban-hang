<?php
session_start();
include './TONGQUAT/config.php';
?>

<?php
// session_start();
if (isset($_GET['dangxuat'])) {
    unset($_SESSION['dangnhap']);
    header("location:index.php");
}
if (isset($_GET['login'])) {
    $dangxuat = $_GET['login'];
} else {
    $dangxuat = '';
}
if ($dangxuat == 'dangxuat') {
    session_destroy();
    header('location: index.php');
}
?>

<?php
// session_destroy();
$id_khachhang = $_SESSION['MSKH'];
$ngayDH = date("Y/m/d");
$insert_cart = "INSERT INTO dathang(MSKH, NgayDH, TrangThaiDH) values('$id_khachhang','$ngayDH', 'Đơn hàng mới')";
$cart_query = mysqli_query($conn, $insert_cart);
// echo $id_khachhang.'+'.$msnv;
// echo $cart_query;
// echo (json_encode($cart_query));
// die();
$soDH = mysqli_insert_id($conn);
if (isset($cart_query)) {
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            $id_sp = $value['id'];
            $soluong = $value['soLuongSP'];
            $gia = $value['giaSP'];
            $insert_order_detail = "INSERT INTO chitietdathang(SoDonDH, MSHH, SoLuong, GiaDatHang) values('$soDH','$id_sp','$soluong','$gia')";
            mysqli_query($conn, $insert_order_detail);
        }
        echo '<script type="text/javascript">alert("Cảm ơn bạn đã đặt hàng. Vui lòng điền đầy đủ thông tin để nhận hàng")</script>';
        unset($_SESSION['cart']);
    } else {
        // echo '<script type="text/javascript">alert("Vui lòng thêm hàng hoá vào giỏ")</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Địa chỉ giao hàng</title>
    <link rel="shortcut icon" href="./assets/img/logo/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-5.15.4-web/css/all.min.css">
</head>

<body class="page">
    <!-- Page header -->
    <?php
    require './TONGQUAT/include/header.php';
    ?>

    <!-- Page address -->
    <section class="address">
        <div class="container-address">
            <div class="address-top-wrap">
                <div class="address-top">
                    <div class="address-top-cart address-top-item">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="address-top-address address-top-item">
                        <i class="fas fa-location-arrow"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-address">
            <div class="address-content row">
                <div class="address-content-left">
                    <p>Vui lòng chọn địa chỉ giao hàng</p>
                    <style>
                        .address-content-left-input-top-item input,
                        .address-content-left-input-bottom input {
                            width: 100%;
                            height: 35px;
                            border: 1px solid #ddd;
                            padding-left: 6px;
                            font-size: 18px;
                        }
                    </style>
                    <?php
                    if (isset($_SESSION['MSKH'])) {
                        $id = $_SESSION['MSKH'];
                        $sql = mysqli_query($conn, "SELECT * FROM khachhang WHERE MSKH='$id' ");
                        $row_showDiaChi = mysqli_fetch_array($sql);
                    ?>
                        <div class="address-content-left-input-top row">
                            <div class="address-content-left-input-top-item">
                                <label for="">Họ tên <span style="color: red;">*</span></label>
                                <input type="text" value="<?php echo $row_showDiaChi['HoTenKH'] ?>">
                            </div>
                            <div class="address-content-left-input-top-item">
                                <label for="">Điện thoại <span style="color: red;">*</span></label>
                                <input type="text" value="<?php echo $row_showDiaChi['SoDienThoai'] ?>">
                            </div>
                            <div style="width:100%;" class="address-content-left-input-top-item">
                                <label for="">Địa chỉ <span style="color: red;">*</span></label>
                                <input type="text" value="<?php echo $row_showDiaChi['DiaChi'] ?>">
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="address-content-left-button row">
                        <a href="./gio-hang.php"><i class="fas fa-backward"></i>
                            <p>Quay lại giỏ hàng</p>
                        </a>
                        <button>
                            <p style="font-weight: bold;"><a href="./cam-on.php">THANH TOÁN VÀ GIAO HÀNG</a></p>
                        </button>
                        <style>
                            .address-content-left-button a:hover {
                                color: #fff !important;
                            }
                        </style>
                    </div>
                </div>
                <div class="address-content-right">
                    <table>
                        <tr>
                            <th>Tên Sản Phẩm</th>
                            <th>Giảm Giá</th>
                            <th>Số Lượng</th>
                            <th>Thành Tiền</th>
                        </tr>
                        <?php
                        $sql = mysqli_query($conn, "SELECT * FROM  chitietdathang, khachhang, dathang, hanghoa where dathang.SoDonDH = chitietdathang.SoDonDH 
                        and khachhang.MSKH = dathang.MSKH
                        and chitietdathang.MSHH=hanghoa.MSHH GROUP BY hanghoa.MSHH");
                        $i = 0;
                        while ($row_showSP = mysqli_fetch_array($sql)) {
                            $giamGia = rand(1, 20);
                            $i++; ?>
                            <tr>
                                <td class="name-left"><?php echo $row_showSP['TenHH'] ?></td>
                                <td><?php echo $giamGia ?>%</td>
                                <td><?php echo $row_showSP['SoLuong'] ?></td>
                                <td><?php echo number_format($row_showSP['GiaDatHang'], 0, ',', '.') ?><b>&#8363;</b></td>
                            </tr>
                        <?php
                        }
                        ?>
                        <?php
                        $sql = mysqli_query($conn, "SELECT * FROM  chitietdathang, khachhang, dathang, hanghoa where dathang.SoDonDH = chitietdathang.SoDonDH 
                        and khachhang.MSKH = dathang.MSKH
                        and chitietdathang.MSHH=hanghoa.MSHH GROUP BY hanghoa.MSHH");
                        $i = 0;
                        $tongSL = 0;
                        $tongTien = 0;
                        while ($row_showSP = mysqli_fetch_array($sql)) {
                            $i++;
                            $tongSL = $tongSL + $row_showSP['SoLuong'];
                            $thanhTien = $row_showSP['SoLuong'] * $row_showSP['Gia'];
                            $tongTien = $tongTien + $thanhTien ?>
                        <?php
                        }
                        ?>
                        <tr>
                            <td style="font-weight: bold;" colspan="3">Tổng tiền hàng</td>
                            <td class="price-right" style="font-weight: bold;">
                                <span><?php echo number_format($tongTien, 0, ',', '.') ?><b>&#8363;</b></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Page footer -->
    <?php
    require './TONGQUAT/include/footer.php';
    ?>

    <!---------------------- Javascript ---------------------->

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="./assets/javascript/main.js"></script>
    <script src="./assets/javascript/cart.js"></script>
</body>

</html>