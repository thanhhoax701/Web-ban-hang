<?php
session_start();
include '../TONGQUAT/config.php';
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
// Cộng số lượng
if (isset($_GET['cong'])) {
    $id = $_GET['cong'];
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            $product[] = array(
                'tenSP' => $cart_item['tenSP'], 'id' => $cart_item['id'], 'soLuongSP' => $cart_item['soLuongSP'],
                'giaSP' => $cart_item['giaSP'], 'hinhSP' => $cart_item['hinhSP'], 'maSP' => $cart_item['maSP']
            );
            $_SESSION['cart'] = $product;
        } else {
            $tangSoLuong = $cart_item['soLuongSP'] + 1;
            // Số lượng tối đa được mua
            if ($cart_item['soLuongSP'] < 10) {
                $product[] = array(
                    'tenSP' => $cart_item['tenSP'], 'id' => $cart_item['id'], 'soLuongSP' => $tangSoLuong,
                    'giaSP' => $cart_item['giaSP'], 'hinhSP' => $cart_item['hinhSP'], 'maSP' => $cart_item['maSP']
                );
            } else {
                $product[] = array(
                    'tenSP' => $cart_item['tenSP'], 'id' => $cart_item['id'], 'soLuongSP' => $cart_item['soLuongSP'],
                    'giaSP' => $cart_item['giaSP'], 'hinhSP' => $cart_item['hinhSP'], 'maSP' => $cart_item['maSP']
                );
            }
            $_SESSION['cart'] = $product;
        }
    }
    header('location:gio-hang.php');
}

// Trừ số lượng
if (isset($_GET['tru'])) {
    $id = $_GET['tru'];
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            $product[] = array(
                'tenSP' => $cart_item['tenSP'], 'id' => $cart_item['id'], 'soLuongSP' => $cart_item['soLuongSP'],
                'giaSP' => $cart_item['giaSP'], 'hinhSP' => $cart_item['hinhSP'], 'maSP' => $cart_item['maSP']
            );
            $_SESSION['cart'] = $product;
        } else {
            $giamSoLuong = $cart_item['soLuongSP'] - 1;
            // Số lượng tối đa được mua
            if ($cart_item['soLuongSP'] > 1) {
                $product[] = array(
                    'tenSP' => $cart_item['tenSP'], 'id' => $cart_item['id'], 'soLuongSP' => $giamSoLuong,
                    'giaSP' => $cart_item['giaSP'], 'hinhSP' => $cart_item['hinhSP'], 'maSP' => $cart_item['maSP']
                );
            } else {
                $product[] = array(
                    'tenSP' => $cart_item['tenSP'], 'id' => $cart_item['id'], 'soLuongSP' => $cart_item['soLuongSP'],
                    'giaSP' => $cart_item['giaSP'], 'hinhSP' => $cart_item['hinhSP'], 'maSP' => $cart_item['maSP']
                );
            }
            $_SESSION['cart'] = $product;
        }
    }
    header('location:gio-hang.php');
}


// Xoá từng sản phẩm
if (isset($_SESSION['cart']) && isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    foreach ($_SESSION['cart'] as $cart_item) {
        // Nếu sản phẩm nào không thuộc id thì thiết lập section mới và bỏ đi sản phẩm mang id đó
        if ($cart_item['id'] != $id) {
            $product[] = array(
                'tenSP' => $cart_item['tenSP'], 'id' => $cart_item['id'], 'soLuongSP' => $cart_item['soLuongSP'],
                'giaSP' => $cart_item['giaSP'], 'hinhSP' => $cart_item['hinhSP'], 'maSP' => $cart_item['maSP']
            );
        }
        $_SESSION['cart'] = $product;
        header('location:gio-hang.php');
    }
}

// Xoá tất cả sản phẩm
if (isset($_GET['xoatatca']) && $_GET['xoatatca'] == 1) {
    unset($_SESSION['cart']);
}

// Thêm sản phẩm vào giỏ hàng
if (isset($_POST['themGioHang'])) {
    // session_destroy();
    $id = $_GET['id'];
    $soLuong = 1;
    $sql = mysqli_query($conn, "SELECT * from  hanghoa, hinhhh where hanghoa.MSHH = hinhhh.MSHH and hanghoa.MSHH = '$id' limit 1 ");
    $row_showSP = mysqli_fetch_array($sql);
    if ($row_showSP) {
        // Bảng 1
        $new_product = array(array(
            'tenSP' => $row_showSP['TenHH'], 'id' => $id, 'soLuongSP' => $soLuong,
            'giaSP' => $row_showSP['Gia'], 'hinhSP' => $row_showSP['TenHinh'], 'maSP' => $row_showSP['MSHH']
        ));
        // Kiểm tra section giỏ hàng tồn tại
        if (isset($_SESSION['cart'])) {
            $found = false;
            foreach ($_SESSION['cart'] as $cart_item) {
                // Nếu dữ liệu trùng
                if ($cart_item['id'] == $id) {
                    // $product[] = array(
                    //     'tenSP' => $cart_item['tenSP'], 'id' => $cart_item['id'], 'soLuongSP' => $soLuong + 1,
                    //     'giaSP' => $cart_item['giaSP'], 'hinhSP' => $cart_item['hinhSP'], 'maSP' => $cart_item['maSP']
                    // );
                    $found = true;
                } else {
                    // Nếu dữ liệu không trùng
                    // Bảng 2
                    $product[] = array(
                        'tenSP' => $cart_item['tenSP'], 'id' => $cart_item['id'], 'soLuongSP' => $soLuong,
                        'giaSP' => $cart_item['giaSP'], 'hinhSP' => $cart_item['hinhSP'], 'maSP' => $cart_item['maSP']
                    );
                }
            }
            if ($found == false) {
                // Nếu sp không trùng trong csdl thì liên kết Bảng 1 và Bảng 2 lại với nhau
                $_SESSION['cart'] = array_merge($_SESSION['cart'], $new_product);
                // Nếu xài kiểu click vô Đặt hàng rồi sl tự tăng lên 1 thì xài cái này và bật dòng 108-111 và cái else ở dưới lên
                // $_SESSION['cart'] = array_merge($product, $new_product);
            }
            // else {
            //     $_SESSION['cart'] = $product;
            // }
        } else {
            $_SESSION['cart'] = $new_product;
        }
    }
    header('location:gio-hang.php');
    // echo "<pre>";
    // print_r($_SESSION['cart']);
    // echo "</pre>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <link rel="shortcut icon" href="./assets/img/logo/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.1.1-web/css/all.min.css">
</head>

<body class="page">
    <!-- Page header -->
    <?php
    require '../TONGQUAT/include/header.php';
    ?>

    <!-- Page cart -->
    <section class="cart">
        <div class="container-cart">
            <div class="cart-top-wrap">
                <div class="cart-top">
                    <div class="cart-top-cart cart-top-item">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div  class="cart-top-address cart-top-item">
                        <i class="fas fa-location-arrow"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-cart">
            <?php
            if (isset($_SESSION['cart'])) {
            ?>
                <div class="cart-content row">
                    <div class="cart-content-left">
                        <table style="border-collapse: collapse; border: 1; width: 100%;">
                            <tr>
                                <th>Mã số</th>
                                <th>Sản Phẩm</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Số Lượng</th>
                                <th>Giá</th>
                                <th>Thành Tiền</th>
                                <th>Xóa Sản Phẩm</th>
                            </tr>
                            <?php
                            // echo $_SESSION['submit'];
                            // echo "</br>";
                            // echo $_SESSION['MSKH'];
                            if (isset($_SESSION['cart'])) {
                                $i = 0;
                                foreach ($_SESSION['cart'] as $cart_item) {
                                    $thanhTien = $cart_item['soLuongSP'] * $cart_item['giaSP'];
                                    $i++; ?>
                                    <tr>
                                        <td>
                                            <p style="font-size: 17px; line-height: 1.5;"><?php echo $i ?></p>
                                        </td>
                                        <td><img style="width: 100px; height: 100px; border-radius: unset;" src="../TONGQUAT/img_sp/<?php echo $cart_item['hinhSP'] ?>" alt=""></td>
                                        <td>
                                            <p style="font-size: 17px; line-height: 1.5;"><?php echo $cart_item['tenSP'] ?></p>
                                        </td>
                                        <td>
                                            <p>
                                                <a href="./gio-hang.php?tru=<?php echo $cart_item['id'] ?>"><i style="font-size: 15px; color: #0c63e1;" class="fa-solid fa-minus"></i></a>
                                                <b style="font-size: 20px; padding: 5px;"><?php echo $cart_item['soLuongSP'] ?></b>
                                                <a href="./gio-hang.php?cong=<?php echo $cart_item['id'] ?>"><i style="font-size: 15px; color: #0c63e1;" class="fa-solid fa-plus"></i></a>
                                            </p>
                                        </td>
                                        <td>
                                            <p style="font-size: 17px; line-height: 1.5;"><?php echo number_format($cart_item['giaSP'], 0, ',', '.') ?><b>&#8363;</b></p>
                                        </td>
                                        <td>
                                            <p style="font-size: 17px; line-height: 1.5;"><?php echo number_format($thanhTien, 0, ',', '.') ?><b>&#8363;</b></p>
                                        </td>
                                        <td>
                                            <p style="font-size: 17px; line-height: 1.5;"><a href="./gio-hang.php?xoa=<?php echo $cart_item['id'] ?>" style="color: #f00;"><i class="fa fa-trash"></i></a></p>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
                                <tr>
                                    <td colspan="7">
                                        <a href="./gio-hang.php?xoatatca=1" style="font-size: 25px; color: #f00;">Xoá tất cả</a>
                                    </td>
                                </tr>
                            <?php
                            } else {
                            } ?>
                        </table>
                    </div>
                    <div class="cart-content-right">
                        <table>
                            <?php
                            if (isset($_SESSION['cart'])) {
                                $i = 0;
                                $tongSL = 0;
                                $tongTien = 0;
                                foreach ($_SESSION['cart'] as $cart_item) {
                                    $tongSL = $tongSL + $cart_item['soLuongSP'];
                                    $thanhTien = $cart_item['soLuongSP'] * $cart_item['giaSP'];
                                    $tongTien += $thanhTien;
                                } ?>
                                <tr>
                                    <th colspan="2">TỔNG TIỀN GIỎ HÀNG</th>
                                </tr>
                                <tr>
                                    <td>TỔNG SẢN PHẨM</td>
                                    <td>
                                        <p><?php echo number_format($tongSL) ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>TỔNG TIỀN HÀNG</td>
                                    <td>
                                        <p><?php echo number_format($tongTien, 0, ',', '.') ?><b>&#8363;</b></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>TẠM TÍNH</td>
                                    <td>
                                        <p style="color: red; font-weight: bold;"><?php echo number_format($tongTien, 0, ',', '.') ?><b>&#8363;</b></p>
                                    </td>
                                </tr>
                            <?php
                            } else {
                            } ?>
                        </table>
                        <div class="cart-content-right-text">
                            <p>Bạn sẽ được miễn phí ship khi đơn hàng của bạn có tổng giá trị trên 10.000.000<sup>đ</sup></p>
                            <p style="color: red; font-weight: bold;">Mua thêm <span style="font-size: 18px;">500.000</span><sup style="font-size: 18px;">đ</sup> để được miễn phí SHIP</p>
                        </div>
                        <div class="cart-content-right-button">
                            <?php
                            if (isset($_SESSION['submit'])) {
                            ?>
                                <button style="background-color: #fff;"><a href="./giao-hang.php" style="color: #000;">ĐẶT HÀNG</a></button>
                            <?php
                            } else {
                            ?>
                                <button style="background-color: #fff;"><a href="./dang-ky.php" style="color: #000;">ĐĂNG KÝ ĐỂ ĐẶT HÀNG</a></button>
                            <?php
                            } ?>
                        </div>
                    </div>
                </div>
            <?php
            } else {
                echo "<div class='no-cart'>
                    <p class='text-cart'>Vui lòng thêm sản phẩm!!!</p><br>
                    <img src='./assets/img/no-cart.png'></img>
                </div>";
            }
            ?>
            <style>
                .no-cart {
                    display: block;
                    margin: 0 auto;
                    width: 300px;
                }

                .text-cart {
                    font-size: 20px;
                    color: #f00;
                    font-weight: bold;
                    text-align: center;
                }
            </style>
        </div>
    </section>

    <!-- Page footer -->
    <?php
    require '../TONGQUAT/include/footer.php';
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