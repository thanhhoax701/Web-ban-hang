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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
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
    require './TONGQUAT/include/header.php';
    ?>

    <!-- Page container -->
    <div class="page__container">
        <!-- Slider Animation -->
        <div class="shop-big-img-box hide-on-mobile">
            <div class="shop-big-img" style="background-image: url(data:image/jpeg;base64,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),url(data:image/jpeg;base64,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);"></div>
            <div class="shop-big-img-box-content">
                <div class="shop-big-img-content">
                    <div class="shop-big-img-content-header">
                        <span>Sale Sập Sàn</span>
                    </div>
                    <div class="shop-big-img-content-main">
                        <span style="display: block;">BLACK FRIDAY</span>
                    </div>
                    <div class="shop-big-img-content-end">
                        <span>OFF 20% TOÀN BỘ CỬA HÀNG</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container sticky -->
        <div class="container-sticky">
            <div class="grid wide">
                <div class="sticky-item">
                    <ul class="sticky-list">
                        <li class="col l-3 m-3 c-6 sticky-list-tab sticky-active">
                            <img src="./assets/img/tab/icon-smartphone.png" alt="" class="sticky-list-img">
                            <div class="sticky-box">ĐIỆN THOẠI</div>
                        </li>
                        <li class="col l-3 m-3 c-6 sticky-list-tab">
                            <img src="./assets/img/tab/icon-tablet.png" alt="" class="sticky-list-img">
                            <div class="sticky-box">MÁY TÍNH BẢNG</div>
                        </li>
                        <li class="col l-3 m-3 c-6 sticky-list-tab">
                            <img src="./assets/img/tab/icon-phukien.png" alt="" class="sticky-list-img">
                            <div class="sticky-box">PHỤ KIỆN</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Product suggestions -->
        <div class="product-suggestions">
            <div class="grid wided">
                <div class="highlight-container">
                    <!-- Trang sản phẩm - Điện thoại -->
                    <div class="product-suggestions-container block-active">
                        <div class="grid wided product-main">
                            <div class="row">
                                <div class="col l-3 m-12 trademark">
                                    <div class="wrapper1">
                                        <span class="filter-price-title">LỌC THEO GIÁ</span>
                                        <div class="container">
                                            <div class="slider-track" style="background: linear-gradient(to right, rgb(218, 218, 229) 0%, rgb(102, 102, 102) 0%, rgb(102, 102, 102) 100%, rgb(218, 218, 229) 100%);"></div>
                                            <input type="range" min="0" max="50" value="0" id="slider-1" oninput="slideOne()">
                                            <input type="range" min="2" max="50" value="50" id="slider-2" oninput="slideTwo()">
                                        </div>
                                        <div class="values">
                                            <label for="">Giá:</label>
                                            <span id="range1">0.000.000đ</span>
                                            <span> ‐ </span>
                                            <span id="range2">50.000.000đ</span>
                                        </div>
                                        <button type="submit" class="filter-price">LỌC</button>
                                    </div>
                                    <div class="shop-reducing-price">
                                        <span class="shop-reducing-title">HÃNG SẢN XUẤT</span>
                                        <div class="shop-reducing-items-box">
                                            <div class="product-type">

                                                <a href="" class="tag-a-sp">
                                                    <span>iPhone</span>
                                                </a>

                                                <a href="" class="tag-a-sp">
                                                    <span>Samsung</span>
                                                </a>

                                                <a href="" class="tag-a-sp">
                                                    <span>Oppo</span>
                                                </a>

                                                <a href="" class="tag-a-sp">
                                                    <span>ViVo</span>
                                                </a>

                                                <a href="" class="tag-a-sp">
                                                    <span>Xiaomi</span>
                                                </a>

                                                <a href="" class="tag-a-sp">
                                                    <span>Realme</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="shop-introducing">
                                        <iframe width="230" src="https://www.youtube.com/embed/MMdQ-gWBNZE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                                    </div>
                                </div>
                                <div class="col l-9 m-12">
                                    <div class="product__main-phone">
                                        <div class="row product__group">
                                            <?php
                                            $sql = mysqli_query($conn, "SELECT * from  hanghoa, hinhhh where hanghoa.MSHH = hinhhh.MSHH and TenHH Like '%Điện thoại%' group by hanghoa.MSHH limit 3");
                                            $i = 0;
                                            while ($row_showSP = mysqli_fetch_array($sql)) {
                                                $i++;
                                            ?>
                                                <div class="col l-4 m-4 c-6">
                                                    <div class="home-product-item" style="margin-bottom: 15px;">
                                                        <a class="home-product-item__link" href="<?php echo "./chitietsp/chitiet.php" . "?id=" . $row_showSP['MSHH']; ?>">
                                                            <img src="./TONGQUAT/img_sp/<?php echo $row_showSP['TenHinh'] ?>" alt="">
                                                            <h4 class="home-product-item__name"><?php echo $row_showSP['TenHH'] ?></h4>
                                                            <div class="home-product-item__price">
                                                                <span class="home-product-item__price-old"><?php echo number_format($row_showSP['Gia'] * 100 / 90,0,',','.') ?><b>&#8363;</b></span>
                                                                <span class="home-product-item__price-current"><?php echo number_format($row_showSP['Gia'],0,',','.') ?><b>&#8363;</b></span>
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
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
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
                                        <div class="see-more-product">
                                            <h3 class="show-more-prod-phone">Xem thêm
                                                <i class="fas fa-chevron-down"></i>
                                            </h3>
                                        </div>
                                        <div class="row product__group" id="product__main-2-phone">
                                            <?php
                                            $sql = mysqli_query($conn, "SELECT * from  hanghoa, hinhhh where hanghoa.MSHH = hinhhh.MSHH and TenHH Like '%Điện thoại OPPO%' group by hanghoa.MSHH");
                                            $i = 0;
                                            while ($row_showSP = mysqli_fetch_array($sql)) {
                                                $i++;
                                            ?>
                                                <div class="col l-4 m-4 c-6">
                                                    <div class="home-product-item">
                                                        <a class="home-product-item__link" href="<?php echo "./chitietsp/chitiet.php" . "?id=" . $row_showSP['MSHH']; ?>">
                                                            <img src="./TONGQUAT/img_sp/<?php echo $row_showSP['TenHinh'] ?>" alt="">
                                                            <h4 class="home-product-item__name"><?php echo $row_showSP['TenHH'] ?></h4>
                                                            <div class="home-product-item__price">
                                                                <span class="home-product-item__price-old"><?php echo number_format($row_showSP['Gia'] * 100 / 90,0,',','.') ?><b>&#8363;</b></span>
                                                                <span class="home-product-item__price-current"><?php echo number_format($row_showSP['Gia'],0,',','.') ?><b>&#8363;</b></span>
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
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
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
                                        <div class="see-more-product-hide">
                                            <h3 class="hide-more-prod-phone">Ẩn bớt
                                                <i class="fas fa-chevron-up"></i>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Trang sản phẩm - Máy tính bảng -->
                    <div class="product-suggestions-container">
                        <div class="grid wided product-main">
                            <div class="row">
                                <div class="col l-3 m-12 trademark">
                                    <div class="wrapper1">
                                        <span class="filter-price-title">LỌC THEO GIÁ</span>
                                        <div class="container">
                                            <div class="slider-track" style="background: linear-gradient(to right, rgb(218, 218, 229) 0%, rgb(102, 102, 102) 0%, rgb(102, 102, 102) 100%, rgb(218, 218, 229) 100%);"></div>
                                            <input type="range" min="0" max="50" value="0" id="slider-1" oninput="slideOne()">
                                            <input type="range" min="2" max="50" value="50" id="slider-2" oninput="slideTwo()">
                                        </div>
                                        <div class="values">
                                            <label for="">Giá:</label>
                                            <span id="range1">0.000.000đ</span>
                                            <span> ‐ </span>
                                            <span id="range2">50.000.000đ</span>
                                        </div>
                                        <button type="submit" class="filter-price">LỌC</button>
                                    </div>
                                    <div class="shop-reducing-price">
                                        <span class="shop-reducing-title">HÃNG SẢN XUẤT</span>
                                        <div class="shop-reducing-items-box">
                                            <div class="product-type">
                                                <a href="" class="tag-a-sp">
                                                    <span>iPad</span>
                                                </a>
                                                <a href="" class="tag-a-sp">
                                                    <span>Samsung</span>
                                                </a>
                                                <a href="" class="tag-a-sp">
                                                    <span>Lenovo</span>
                                                </a>
                                                <a href="" class="tag-a-sp">
                                                    <span>Huawei</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="shop-introducing">
                                        <iframe width="230" src="https://www.youtube.com/embed/MMdQ-gWBNZE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                                    </div>
                                </div>
                                <div class="col l-9 m-12">
                                    <div class="product__main-tablet">
                                        <div class="row product__group">
                                            <?php
                                            $sql = mysqli_query($conn, "SELECT * from  hanghoa, hinhhh where hanghoa.MSHH = hinhhh.MSHH and TenHH Like '%Máy tính bảng%' group by hanghoa.MSHH Limit 3");
                                            $i = 0;
                                            while ($row_showSP = mysqli_fetch_array($sql)) {
                                                $i++; ?>
                                                <div class="col l-4 m-4 c-6">
                                                    <div class="home-product-item">
                                                        <a class="home-product-item__link" href="<?php echo "./chitietsp/chitiet.php" . "?id=" . $row_showSP['MSHH']; ?>">
                                                            <img src="./TONGQUAT/img_sp/<?php echo $row_showSP['TenHinh'] ?>" alt="">
                                                            <h4 class="home-product-item__name"><?php echo $row_showSP['TenHH'] ?></h4>
                                                            <div class="home-product-item__price">
                                                                <span class="home-product-item__price-old"><?php echo number_format($row_showSP['Gia'] * 100 / 90,0,',','.') ?><b>&#8363;</b></span>
                                                                <p><span class="home-product-item__price-current"><?php echo number_format($row_showSP['Gia'],0,',','.') ?><b>&#8363;</b></p>
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
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
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
                                        <div class="see-more-product">
                                            <h3 class="show-more-prod-tablet">Xem thêm
                                                <i class="fas fa-chevron-down"></i>
                                            </h3>
                                        </div>
                                        <div class="row product__group" id="product__main-2-tablet">
                                            <?php
                                            $sql = mysqli_query($conn, "SELECT * from  hanghoa, hinhhh where hanghoa.MSHH = hinhhh.MSHH and TenHH Like '%Máy tính bảng iPad%' group by hanghoa.MSHH Limit 3");
                                            $i = 0;
                                            while ($row_showSP = mysqli_fetch_array($sql)) {
                                                $i++; ?>
                                                <div class="col l-4 m-4 c-6">
                                                    <div class="home-product-item">
                                                        <a class="home-product-item__link" href="<?php echo "./chitietsp/chitiet.php" . "?id=" . $row_showSP['MSHH']; ?>">
                                                            <img src="./TONGQUAT/img_sp/<?php echo $row_showSP['TenHinh'] ?>" alt="">
                                                            <h4 class="home-product-item__name"><?php echo $row_showSP['TenHH'] ?></h4>
                                                            <div class="home-product-item__price">
                                                                <span class="home-product-item__price-old"><?php echo number_format($row_showSP['Gia'] * 100 / 90,0,',','.') ?><b>&#8363;</b></span>
                                                                <p><span class="home-product-item__price-current"><?php echo number_format($row_showSP['Gia'],0,',','.') ?><b>&#8363;</b></p>
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
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
                                                                <input type="radio" name="star-product-1">
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
                                        <div class="see-more-product-hide">
                                            <h3 class="hide-more-prod-tablet">Ẩn bớt
                                                <i class="fas fa-chevron-up"></i>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Trang sản phẩm - Phụ kiện -->
                    <div class="product-suggestions-container">
                        <div class="grid wided product-main">
                            <div class="row">
                                <div class="grid wide phukien">
                                    <div class="phu-kien-header">
                                        <span class="phu-kien-header-tit">PHỤ KIỆN NỔI BẬT</span>
                                        <div class="phu-kien-header-main">
                                            <div class="phu-kien-header-items">
                                                <a href="#sacduphong" class="tag-a">
                                                    <div class="phu-kien-header-items-box-img">
                                                        <img src="https://cdn.tgdd.vn/Category/57/5-Pinsa%CC%A3cdu%CC%9B%CC%A3pho%CC%80ng-120x120.png" alt="">
                                                    </div>
                                                </a>
                                                <div class="phu-kien-header-items-des">Sạc dự phòng</div>
                                            </div>
                                            <div class="phu-kien-header-items">
                                                <a href="#tainghe" class="tag-a">
                                                    <div class="phu-kien-header-items-box-img">
                                                        <img src="https://cdn.tgdd.vn/Category/54/21-Tainghe-120x120.png" alt="">
                                                    </div>
                                                </a>
                                                <div class="phu-kien-header-items-des">Tai nghe</div>
                                            </div>
                                            <div class="phu-kien-header-items">
                                                <a href="#loa" class="tag-a">
                                                    <div class="phu-kien-header-items-box-img">
                                                        <img src="https://cdn.tgdd.vn/Category/2162/22-Loa2-120x120.png" alt="">
                                                    </div>
                                                </a>
                                                <div class="phu-kien-header-items-des">Loa</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid wided phu-kien-body">
                                    <!-- Sạc dự phòng -->
                                    <div class="sacduphong" id="sacduphong">
                                        <div class="sac-box-img">
                                            <img src="https://cdn.tgdd.vn/2021/10/banner/pinsac-1200x150.png" alt="">
                                        </div>
                                        <div class="sac-main-box">
                                            <div class="row sac-main">
                                                <?php
                                                $sql = mysqli_query($conn, "SELECT * from  hanghoa, hinhhh where hanghoa.MSHH = hinhhh.MSHH and TenHH Like '%Polymer%' group by hanghoa.MSHH");
                                                $i = 0;
                                                while ($row_showSP = mysqli_fetch_array($sql)) {
                                                    $i++;
                                                ?>
                                                    <div class="col l-4 m-4 c-6 product-selling-items shop-cuahang-items" style="">
                                                        <div class="home-product-item">
                                                            <a class="home-product-item__link" href="<?php echo "./chitietsp/chitiet.php" . "?id=" . $row_showSP['MSHH']; ?>">
                                                                <img src="./TONGQUAT/img_sp/<?php echo $row_showSP['TenHinh'] ?>" alt="">
                                                                <h4 class="home-product-item__name"><?php echo $row_showSP['TenHH'] ?></h4>
                                                                <div class="home-product-item__price">
                                                                    <span class="home-product-item__price-old"><?php echo number_format($row_showSP['Gia'] * 100 / 90,0,',','.') ?><b>&#8363;</b></span>
                                                                    <p><span class="home-product-item__price-current"><?php echo number_format($row_showSP['Gia'],0,',','.') ?><b>&#8363;</b></p>
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
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
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
                                    <!-- Tai nghe -->
                                    <div class="tainghe" id="tainghe">
                                        <div class="sac-box-img">
                                            <img src="https://cdn.tgdd.vn/2021/10/banner/taignhe-1200x150.png" alt="">
                                        </div>
                                        <div class="sac-main-box">
                                            <div class="row sac-main">
                                                <?php
                                                $sql = mysqli_query($conn, "SELECT * from  hanghoa, hinhhh where hanghoa.MSHH = hinhhh.MSHH and TenHH Like '%Tai nghe%' group by hanghoa.MSHH");
                                                $i = 0;
                                                while ($row_showSP = mysqli_fetch_array($sql)) {
                                                    $i++; ?>
                                                    <div class="col l-4 m-4 c-6 product-selling-items shop-cuahang-items">
                                                        <div class="home-product-item">
                                                            <a class="home-product-item__link" href="<?php echo "./chitietsp/chitiet.php" . "?id=" . $row_showSP['MSHH']; ?>">
                                                                <img src="./TONGQUAT/img_sp/<?php echo $row_showSP['TenHinh'] ?>" alt="">
                                                                <h4 class="home-product-item__name"><?php echo $row_showSP['TenHH'] ?></h4>
                                                                <div class="home-product-item__price">
                                                                    <span class="home-product-item__price-old"><?php echo number_format($row_showSP['Gia'] * 100 / 90,0,',','.') ?><b>&#8363;</b></span>
                                                                    <p><span class="home-product-item__price-current"><?php echo number_format($row_showSP['Gia'],0,',','.') ?><b>&#8363;</b></p>
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
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
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
                                    <!-- Loa -->
                                    <div class="loa" id="loa">
                                        <div class="sac-box-img">
                                            <img src="https://cdn.tgdd.vn/2021/10/banner/loa-1200x150.png" alt="">
                                        </div>
                                        <div class="sac-main-box">
                                            <div class="row sac-main">
                                                <?php
                                                $sql = mysqli_query($conn, "SELECT * from  hanghoa, hinhhh where hanghoa.MSHH = hinhhh.MSHH and TenHH Like '%Loa%' group by hanghoa.MSHH");
                                                $i = 0;
                                                while ($row_showSP = mysqli_fetch_array($sql)) {
                                                    $i++; ?>
                                                    <div class="col l-4 m-4 c-6 product-selling-items shop-cuahang-items">
                                                        <div class="home-product-item">
                                                            <a class="home-product-item__link" href="<?php echo "./chitietsp/chitiet.php" . "?id=" . $row_showSP['MSHH']; ?>">
                                                                <img src="./TONGQUAT/img_sp/<?php echo $row_showSP['TenHinh'] ?>" alt="">
                                                                <h4 class="home-product-item__name"><?php echo $row_showSP['TenHH'] ?></h4>
                                                                <div class="home-product-item__price">
                                                                    <span class="home-product-item__price-old"><?php echo number_format($row_showSP['Gia'] * 100 / 90,0,',','.') ?><b>&#8363;</b></span>
                                                                    <p><span class="home-product-item__price-current"><?php echo number_format($row_showSP['Gia'],0,',','.') ?><b>&#8363;</b></p>
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
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
                                                                    <input type="radio" name="star-product-1">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page footer -->
    <?php
    require './TONGQUAT/include/footer.php';
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

    <script src="./assets/javascript/main.js"></script>
    <script src="./assets/javascript/product.js"></script>
    <script src="./assets/javascript/cart.js"></script>
</body>

</html>