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
if (isset($_POST['search_submit'])) {
    $key = $_POST['search_product'];
    $sql_product = mysqli_query($conn, "SELECT * FROM  hanghoa, hinhhh where hanghoa.MSHH = hinhhh.MSHH 
    and hanghoa.TenHH  Like '%$key%' group by hanghoa.TenHH order by hanghoa.MSHH;");
    $title = $key;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="shortcut icon" href="./assets/img/logo/icon.png" type="image/x-icon">
    <!-- Link font awesome như này dành cho việc chèn unicode của icon vào phần css, nhưng sẽ không sử dụng được nếu không có internet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <!-- Link font awesome như này dùng để chèn icon bằng mã html -->
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-5.15.4-web/css/all.min.css">
</head>

<body class="page">
    <!-- Page header -->
    <?php
    require '../TONGQUAT/include/header.php';
    ?>

    <!-- Page container -->
    <div class="page__container">
        <!-- Container nổi bật -->
        <div class="container-noibat">
            <div class="product-selling-title">
                <?php
                $sql_product = mysqli_query($conn, "SELECT * FROM  hanghoa, hinhhh where hanghoa.MSHH = hinhhh.MSHH 
                    and hanghoa.TenHH  Like '%$key%' group by hanghoa.TenHH order by hanghoa.MSHH;");
                $count = mysqli_num_rows($sql_product);
                $title = $key;
                if ($count <= 0) {
                ?>
                    <hr>
                    <span>Không tìm thấy kết quả phù hợp</span>
                    <hr>
                <?php
                } else {
                ?>
                    <hr>
                    <span>Từ khoá tìm kiếm: <?php echo $title ?></span>
                    <hr>
                <?php
                }
                ?>
            </div>
            <div class="grid wided product__main-1">
                <div class="row product__group">
                    <?php
                    while ($row_showSP = mysqli_fetch_array($sql_product)) {
                    ?>
                        <div class="col l-3 m-6 c-6">
                            <div class="home-product-item" style="margin-bottom: 15px;">
                                <a class="home-product-item__link" href="<?php echo "./chitietsp/chitiet.php" . "?id=" . $row_showSP['MSHH']; ?>">
                                    <img src="../TONGQUAT/img_sp/<?php echo $row_showSP['TenHinh'] ?>" alt="">
                                    <h4 class="home-product-item__name"><?php echo $row_showSP['TenHH'] ?></h4>
                                    <div class="home-product-item__price">
                                        <span class="home-product-item__price-old"><?php echo number_format($row_showSP['Gia'] * 100 / 90, 0, ',', '.') ?><b>&#8363;</b></span>
                                        <span class="home-product-item__price-current"><?php echo number_format($row_showSP['Gia'], 0, ',', '.') ?><b>&#8363;</b></span>
                                    </div>
                                    <div class="product-more">
                                        <div class="product-more__show">
                                            <a class="button" href="<?php echo "./chitietsp/chitiet.php" . "?id=" . $row_showSP['MSHH']; ?>">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </a>
                                <div class="home-product-item__action">
                                    <span class="home-product-item__like"><i class="fas fa-heart"></i></span>
                                    <div class="home-product-item__rating">
                                        <input type="radio" name="star-product-2">
                                        <input type="radio" name="star-product-2">
                                        <input type="radio" name="star-product-2">
                                        <input type="radio" name="star-product-2">
                                        <input type="radio" name="star-product-2">
                                        <input type="radio" name="star-product-2">
                                        <input type="radio" name="star-product-2">
                                        <input type="radio" name="star-product-2">
                                        <input type="radio" name="star-product-2">
                                        <input type="radio" name="star-product-2">
                                    </div>
                                </div>
                                <div class="home-product-item__sold">
                                    <span><?php echo $row_showSP['GhiChu'] ?></span>
                                </div>
                                <div class="home-product-item__sale-off">
                                    <span class="home-product-item__percent">0%</span>
                                    <span class="home-product-item__label">Lãi Suất</span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Container thông tin -->
        <div class="grid wided policy">
            <div class="row">
                <div class="col l-4 m-12 c-12">
                    <div class="icon-cart-ship icon-policy">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div class="policy-title">
                        <span>Giao Hàng Toàn Quốc</span>
                    </div>
                    <div class="policy-content">
                        <span>Ship COD toàn quốc. Nhận hàng trong vòng 2-3 ngày</span>
                    </div>
                </div>
                <div class="col l-4 m-12 c-12 return-free">
                    <div class="icon-cart-ship icon-policy">
                        <i class="fas fa-undo"></i>
                    </div>
                    <div class="policy-title">
                        <span>Hoàn Trả Miễn Phí</span>
                    </div>
                    <div class="policy-content">
                        <span>Xem hàng trước khi nhận. Hoàn trả miễn phí nếu không hài lòng</span>
                    </div>
                </div>
                <div class="col l-4 m-12 c-12">
                    <div class="icon-cart-ship icon-policy">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="policy-title">
                        <span>Bảo hành 1 năm</span>
                    </div>
                    <div class="policy-content">
                        <span>Bảo hành 1 năm. Lỗi 1 đổi 1 tất cả các sản phẩm của Apple</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page footer -->
    <?php
    require '../TONGQUAT/include/footer.php';
    ?>

    <!---------------------- Javascript ---------------------->

    <!-- Javascript Like (jquery) -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script>
        $(document).ready(function() {
            $('.home-product-item__like').click(function() {
                $(this).toggleClass('heart')
            })
        })
    </script>

    <!-- https://kenwheeler.github.io/slick/ (JQuery Slick Slider)-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!-- Đây là phần Javascript của slider (JQuery Slick Slider) -->
    <script>
        $(document).ready(function() {
            $('.image-slider').slick({
                // Số lượng phần tử hiện 1 lần
                slidesToShow: 3,
                // Số lần dịch chuyển khi bấm next hoặc previous
                slidesToScroll: 1,
                // Cho nó lặp lại vô tận
                infinite: true,
                // Nút bấm tới và lùi, nếu muốn ẩn thì chuyển sang false khi đó người dùng có thể kéo qua lại
                arrows: true,
                // Không cho dùng chuột kéo phần tử đó
                draggable: false,
                // Nút bấm của từng phần tử
                dots: true,
                // Chỉnh lại nút prev và next
                prevArrow: "<button type='button' class='slick-prev slick-arrow'><i class='fas fa-arrow-left'></i></button>",
                nextArrow: "<button type='button' class='slick-next slick-arrow'><i class='fas fa-arrow-right' aria-hidden='true'></i></button>",
                // tự động chạy
                autoplay: true,
                // thời gian là 2000 tương đương 2s
                autoplaySpeed: 2000,
                // Đây là phần reponsive
                responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                }, {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }, {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: true
                    }
                }]
            });
        });
    </script>

    <script type="text/javascript" src="./assets/javascript/main.js"></script>
    <script type="text/javascript" src="./assets/javascript/product.js"></script>
    <script src="./assets/javascript/cart.js"></script>
</body>

</html>