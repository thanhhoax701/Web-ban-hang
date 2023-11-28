<?php
include '../TONGQUAT/config.php';
include '../TONGQUAT/fb_config.php';
?>


<!-- Page header -->
<header class="page__header" id="logo">
    <div class="grid wide">
        <nav class="header__navbar hide-on-mobile-tablet">
            <ul class="header__navbar-list">
                <li class="header__navbar-item header__navbar-item--separate">
                    <a href="./index.php" class="header__navbar-item-link"><span id="header-hover">Trang chủ</span></a>
                </li>
                <li class="header__navbar-item header__navbar-item--separate">
                    <a href="./san-pham.php" class="header__navbar-item-link"><span id="header-hover">Sản phẩm</span></a>
                </li>
                <li class="header__navbar-item header__navbar-item--has-qr header__navbar-item--separate">
                    <span id="header-hover">Tải ứng dụng</span>
                    <!-- Header QR code -->
                    <div class="header__qr">
                        <img src="./assets/img/qr/qr_code.png" alt="QR" class="header__qr-img">
                        <div class="header__qr-apps">
                            <a href="" class="header__qr-link">
                                <img src="./assets/img/qr/google_play.png" alt="Google Play" class="header__qr-download-img">
                            </a>
                            <a href="" class="header__qr-link">
                                <img src="./assets/img/qr/app_store.png" alt="App Store" class="header__qr-download-img">
                            </a>
                        </div>
                    </div>
                </li>
                <li class="header__navbar-item">
                    <span class="header__navbar-title--no-pointer">Kết nối</span>
                    <a href="" class="header__navbar-icon-link">
                        <i class="header__navbar-icon fab fa-facebook"></i>
                    </a>
                    <a href="" class="header__navbar-icon-link">
                        <i class="header__navbar-icon fab fa-instagram"></i>
                    </a>
                </li>
            </ul>
            <ul class="header__navbar-list">
                <li class="header__navbar-item">
                    <a href="#" id="header-hover" class="header__navbar-icon-link">
                        <i class="header__navbar-icon far fa-question-circle"></i>Trợ giúp
                    </a>
                </li>
                <li class="header__navbar-item">
                    <a href="#" id="header-hover" class="header__navbar-icon-link">
                        <i class="header__navbar-icon fas fa-globe"></i>Ngôn ngữ
                    </a>
                    <ul class="header__navbar-languages-menu">
                        <li class="header__navbar-language-item">
                            <a href="">
                                <img class="header__navbar-language-img" src="./assets/img/language/vietnam.png" alt="tieng-viet">
                                <span>Tiếng Việt</span>
                            </a>
                        </li>
                        <li class="header__navbar-language-item">
                            <a href="">
                                <img class="header__navbar-language-img" src="./assets/img/language/english.png" alt="english">
                                <span>English</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php
                if (isset($_SESSION['facebook_access_token'])) {
                ?>
                    <li class="header__navbar-item header__navbar-item--separate">
                        <a href="../../KHACHHANG/index.php">
                            <span style="color: #000; font-weight: bold; font-family: monospace;" id="header-hover" class="header__navbar-icon-link header__navbar-icon-link2">Hello!
                                <?php if (isset($_SESSION['facebook_user_name'])) {
                                    echo $_SESSION['facebook_user_name'];
                                } ?>
                            </span>
                        </a>
                    </li>
                    <li class="header__navbar-item">
                        <a href="?login=dangxuat"><span id="header-hover" class="header__navbar-icon-link" title="Sign-out">Đăng xuất</span></a>
                    </li>
                <?php
                } elseif (isset($_SESSION['MSKH'])) {
                    $id = $_SESSION['MSKH'];
                    $sql = mysqli_query($conn, "SELECT * FROM khachhang WHERE MSKH='$id' ");
                    $row = mysqli_fetch_array($sql);
                ?>
                    <li class="header__navbar-item header__navbar-item--separate">
                        <a href="../../KHACHHANG/index.php">
                            <span style="color: #000; font-weight: bold; font-family: monospace;" id="header-hover" class="header__navbar-icon-link header__navbar-icon-link2">Hello!
                                <?php if (isset($_SESSION['submit'])) {
                                    echo $_SESSION['submit'];
                                } ?>
                            </span>
                        </a>
                    </li>
                    <li class="header__navbar-item">
                        <a href="?login=dangxuat"><span id="header-hover" class="header__navbar-icon-link" title="Sign-out">Đăng xuất</span></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="header__navbar-item header__navbar-item--separate">
                        <a href="./dang-ky.php"><span id="header-hover" class="header__navbar-icon-link" title="Sign-up">Đăng ký</span></a>
                    </li>
                    <li class="header__navbar-item">
                        <a href="./dang-nhap.php"><span id="header-hover" class="header__navbar-icon-link" title="Sign-in">Đăng nhập</span></a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </nav>

        <!-- Header with search -->
        <div class="header-with-search">
            <!-- Nav mobile -->
            <label for="nav-mobile-input" class="nav__bars-btn"><i class="fas fa-bars"></i></label>
            <input type="checkbox" name="" class="nav__input" id="nav-mobile-input">
            <label for="nav-mobile-input" class="nav__overlay"></label>

            <nav class="nav__mobile">
                <label for="nav-mobile-input" class="nav__mobile-close"><i class="fas fa-times"></i></label>
                <ul class="nav__mobile-list">
                    <li class="nav__mobile-item">
                        <a href="#" class="nav__mobile-link">
                            <i class="nav-btn fas fa-home"></i>
                            <span>Trang chủ</span>
                        </a>
                    </li>
                    <li class="nav__mobile-item">
                        <a href="./san-pham.php" class="nav__mobile-link">
                            <i class="nav-btn fas fa-shopping-basket"></i>
                            <span>Sản phẩm</span>
                        </a>
                    </li>
                    <li class="nav__mobile-item">
                        <a href="./dang-ky.php" class="nav__mobile-link">
                            <i class="nav-btn fas fa-registered"></i>
                            <span>Đăng ký</span>
                        </a>
                    </li>
                    <li class="nav__mobile-item">
                        <a href="./dang-nhap.php" class="nav__mobile-link">
                            <i class="nav-btn fas fa-sign-in-alt"></i>
                            <span>Đăng nhập</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Mobile search -->
            <label for="mobile-search-checkbox" class="header__mobile-search hide-on-pc hide-on-tablet">
                <i class="header__mobile-search-icon fas fa-search"></i>
            </label>

            <div class="header__logo hide-on-tablet">
                <a href="./index.php" class="header__logo-link">
                    <img class="header__logo-img" src="./assets/img/logo/logo.png" alt="">
                </a>
            </div>

            <input type="checkbox" hidden id="mobile-search-checkbox" class="header__search-checkbox">
            <form action="../KHACHHANG/tim-kiem.php" method="POST" class="header__search">
                <!-- Input search -->
                <div class="header__search-input-wrap">
                    <input type="search" class="input-search" placeholder="Tìm kiếm sản phẩm" name="search_product" required>
                </div>

                <!-- Search options -->
                <div class="header__search-select">
                    <span class="header__search-select-label">Trong shop</span>
                    <i class="header__search-select-icon fas fa-angle-down"></i>

                    <ul class="header__search-option">
                        <li class="header__search-option-item header__search-option-item--active">
                            <span>Trong shop</span>
                            <i class="fas fa-check"></i>
                        </li>
                        <li class="header__search-option-item">
                            <span>Ngoài shop</span>
                            <i class="fas fa-check"></i>
                        </li>
                    </ul>
                </div>

                <!-- Button search -->
                <button class="header__search-btn" type="submit" name="search_submit">
                    <i class="header__search-btn-icon fas fa-search"></i>
                </button>
            </form>

            <!-- Cart -->
            <div class="header__cart">
                <div style="clear: both;"></div>
                <a href="../KHACHHANG/gio-hang.php"><i class="header__cart-icon fas fa-shopping-cart"></i></a>
                <?php
                if (isset($_SESSION['cart'])) {
                    $tongSL = 0;
                    foreach ($_SESSION['cart'] as $cart_item) {
                        $tongSL = $tongSL + $cart_item['soLuongSP'];
                    } ?>
                    <p class="cart-number"><?php echo $tongSL ?></p>
                <?php
                } else {
                } ?>
                <style>
                    .header__cart {
                        margin: 0px 15px 0 25px;
                        text-align: center;
                        position: relative;
                        padding: 0 12px;
                        cursor: pointer;
                        bottom: 3%;
                        left: -1%;
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                    }

                    .cart-number {
                        bottom: 5%;
                        left: 62%;
                        position: absolute;
                        padding: 2px 5px;
                        border: 1px solid #000;
                        border-radius: 100%;
                        background-color: #000;
                        color: #fff;
                        font-size: 16px;
                    }
                </style>
            </div>
        </div>
    </div>
</header>