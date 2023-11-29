<?php
session_start();
include '../TONGQUAT/config.php';
?>

<?php
// session_start();
if (isset($_GET['dangxuat'])) {
    unset($_SESSION['dangnhap']);
    header("location: ../index.php");
}
if (isset($_GET['login'])) {
    $dangxuat = $_GET['login'];
} else {
    $dangxuat = '';
}
if ($dangxuat == 'dangxuat') {
    session_destroy();
    header('location: ../index.php');
}
?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '';
}
$sql_chitiet = mysqli_query($conn, "SELECT * FROM hanghoa, hinhhh where hanghoa.MSHH = hinhhh.MSHH and hanghoa.mshh = '$id' ORDER BY hanghoa.MSHH ASC");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = mysqli_query($conn, "SELECT * From hanghoa where MSHH =  '$id' ");
        $row_chitiet = mysqli_fetch_row($sql); ?>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $row_chitiet[1] ?></title>
    <?php
    }
    ?>
    <link rel="shortcut icon" href="../assets/img/logo/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/grid.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-5.15.4-web/css/all.min.css">
</head>

<body class="page">
    <!-- Page header -->
    <?php
    require './include/header-chitiet.php';
    ?>

    <!-- Page container -->
    <div class="page__container">
        <!-- Back to san-pham.html -->
        <div class="product__back">
            <a href="../san-pham.php">
                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $sql = mysqli_query($conn, "SELECT * From hanghoa where MSHH =  '$id' ");
                    $row_chitiet = mysqli_fetch_row($sql); ?>
                    <i class="product__back--icon fa fa-chevron-left"></i>
                    <strong class="product__back-text"><?php echo $row_chitiet[1] ?></strong>
                <?php
                }
                ?>
            </a>
        </div>
        <!-- Product main -->
        <section class="product__main">
            <div class="product__content">
                <div class="product__content-left col l-6 m-12 c-12">
                    <div class="product__content-left-big">
                        <div class="product__content-left--image">
                            <?php
                            $row = mysqli_fetch_row($sql_chitiet);
                            ?>
                            <img src="../TONGQUAT/img_sp/<?php echo $row[8] ?>" alt="">
                        </div>
                        <div class="product__content-left--result hide"></div>
                    </div>
                    <div class="product__content-left-small">
                        <?php
                        while ($row_chitiet = mysqli_fetch_array($sql_chitiet)) {
                        ?>
                            <div class="product__content-left-small--image">
                                <img src="../TONGQUAT/img_sp/<?php echo $row_chitiet['TenHinh'] ?>" alt="">
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- Image gallery by nodemy.vn -->
                    <div class="product__content--gallery hide-on-mobile-tablet">
                        <span class="product__content--control prev"><i class="fas fa-chevron-left"></i></span>
                        <span class="product__content--control next"><i class="fas fa-chevron-right"></i></span>
                        <div class="product__content--gallery-inner">
                            <img class="product__content--gallery-img" src="" alt="" />
                        </div>
                        <i class="fas fa-times close"></i>
                    </div>
                </div>
                <div class="product__content-right col l-6 m-12 c-12">
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $sql = mysqli_query($conn, "SELECT * From hanghoa where MSHH = '$id' ");
                        $row_chitiet = mysqli_fetch_row($sql);
                    ?>
                        <div class="product__content-right-name">
                            <h1><?php echo $row_chitiet[1] ?></h1>
                            <?php
                            // Lấy số lượng hàng cần trừ
                            $quantityToSubtract = 1; // Số lượng hàng cần trừ (trong ví dụ này, trừ đi 1 sản phẩm)

                            // Kiểm tra xem có đủ số lượng hàng trong kho hay không
                            $sqlCheck = "SELECT SoLuongHang FROM hanghoa WHERE MSHH = '$id'";
                            $resultCheck = $conn->query($sqlCheck);

                            if ($resultCheck->num_rows > 0) {
                                $rowCheck = $resultCheck->fetch_assoc();
                                $currentQuantity = $rowCheck["SoLuongHang"];

                                if ($currentQuantity >= $quantityToSubtract) {
                                    // Cập nhật số lượng hàng mới trong kho
                                    $newQuantity = $currentQuantity - $quantityToSubtract;
                                    $sqlUpdate = "UPDATE hanghoa SET SoLuongHang = $newQuantity WHERE MSHH = '$id'";

                                    if ($conn->query($sqlUpdate) === TRUE) {
                            ?>
                                        <p>Kho: <?php echo $row_chitiet[4] ?></p>
                            <?php
                                    } else {
                                        echo "Lỗi cập nhật số lượng hàng: " . $conn->error;
                                    }
                                } else {
                                    echo "Không đủ hàng trong kho.";
                                }
                            } else {
                                echo "Không tìm thấy sản phẩm trong kho.";
                            }
                            ?>
                        </div>
                        <div class="product__content-right-price">
                            <span class="product__content-right-price--old"><?php echo number_format($row_chitiet[3] * 100 / 90, 0, ',', '.') ?><b>&#8363;</b></span>
                            <span class="product__content-right-price--current"><?php echo number_format($row_chitiet[3], 0, ',', '.') ?><b>&#8363;</b></span>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    $id = $_GET['id'];
                    $sql = mysqli_query($conn, "SELECT * from  hanghoa, hinhhh where hanghoa.MSHH = hinhhh.MSHH and hanghoa.MSHH = '$id' ");
                    $row_showSP = mysqli_fetch_array($sql);
                    ?>
                    <form action="../gio-hang.php?id=<?php echo $row_showSP['MSHH']; ?>" method="POST" class="product__content-right-quantity">
                        <input type="hidden" name="maSP" value="<?php echo $row_showSP['MSHH'] ?>">
                        <input type="hidden" name="tenSP" value="<?php echo $row_showSP['TenHH'] ?>">
                        <input type="hidden" name="hinhSP" value="<?php echo $row_showSP['TenHinh'] ?>">
                        <input type="hidden" name="giaSP" value="<?php echo number_format($row_showSP['Gia']) ?>">
                        <input type="hidden" name="soLuongSP" value="1">
                        <input style="min-width: 80px; min-height: 30px;" type="submit" id="add-cart" class="btn btn-cart" value="Đặt hàng" name="themGioHang"></input>
                    </form>
                    <div class="product__content-right--description">
                        <div class="product__content-right--description-top">&#8744;</div>
                        <div class="product__content-right--description-content-big">
                            <div class="product__content-right--description-content-title">
                                <h4 class="product__content-right--description-content-title-item-a">Mô tả sản phẩm</h4>
                                <h4 class="product__content-right--description-content-title-item-b">Hướng dẫn đặt hàng</h4>
                            </div>
                            <div class="product__content-right--description-content">
                                <ul class="product__content-right--description-content-a l-6">
                                    <?php
                                    if (isset($_GET['id'])) {
                                        $id = $_GET['id'];
                                        $sql = mysqli_query($conn, "SELECT * FROM hanghoa where MSHH =  '$id' ");
                                        $row_chitiet = mysqli_fetch_array($sql); ?>
                                        <li><?php echo $row_chitiet['MoTaHH'] ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                                <p class="product__content-right--description-gradient"></p>
                                <ul class="product__content-right--description-content-b l-6">
                                    <li>1. Chọn kích thước bạn muốn.</li>
                                    <li>2. Vào giỏ hàng để tiến hành mua hàng.</li>
                                    <li>3. Có thể điều chỉnh số lượng mua trong giỏ hàng nếu muốn.</li>
                                    <li>4. Quý khách vui lòng đặt mua đúng mẫu, kích thước của sản phẩm trên hệ thống để tránh nhầm lẫn.</li>
                                    <li>5. Những đơn hàng đã xác nhận có mã vận chuyển thì shop sẽ không hủy với bất kì lý do gì.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="product-content-right-contact">
                        <div class="product-content-right-icon facebook">
                            <i class="fab fa-facebook-f"></i>
                            <span>Facebook</span>
                        </div>
                        <div class="product-content-right-icon instagram">
                            <i class="fab fa-instagram"></i>
                            <span>Instagram</span>
                        </div>
                        <div class="product-content-right-icon youtube">
                            <i class="fab fa-youtube"></i>
                            <span>Youtube</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Page footer -->
    <?php
    require './include/footer-chitiet.php';
    ?>

    <!---------------------- Javascript ---------------------->

    <script src="../assets/javascript/main.js"></script>
    <script src="../assets/javascript/product.js"></script>
    <script src="../assets/javascript/product-details.js"></script>
    <script src="../assets/javascript/cart.js"></script>
</body>

</html>