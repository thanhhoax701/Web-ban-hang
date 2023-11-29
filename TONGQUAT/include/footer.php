<?php
include './TONGQUAT/config.php';
?>

<!-- Page footer -->
<footer class="page__footer">
    <div class="footer">
        <div class="grid wide footer-container">
            <div class="row">
                <div class="col l-3 m-6 c-12">
                    <div class="footer-item category">
                        <div class="footer-item__header">Sản phẩm đánh giá cao</div>
                        <div class="rate-height">
                            <?php
                            $sql = mysqli_query($conn, "SELECT * from  hanghoa, hinhhh where hanghoa.MSHH = hinhhh.MSHH and TenHH Like '%Điện thoại Samsung Galaxy Z%' group by hanghoa.MSHH");
                            $i = 0;
                            while ($row_showSP = mysqli_fetch_array($sql)) {
                                $i++;
                            ?>
                                <div class="rate-height-items">
                                    <div class="rate-height-box-img">
                                        <a class="tag-a" href="<?php echo "./chitietsp/chitiet.php" . "?id=" . $row_showSP['MSHH']; ?>">
                                            <img style="width: 70;height: 70px;object-fit: cover;" class="product-selling-img" src="./TONGQUAT/img_sp/<?php echo $row_showSP['TenHinh'] ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="rate-height-right">
                                        <span class="footer-item__item"><?php echo $row_showSP['TenHH'] ?></span>
                                        <span class="rate-height-price"><?php echo number_format($row_showSP['Gia']) ?><b>&#8363;</b></b></span>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                            $sql = mysqli_query($conn, "SELECT * from  hanghoa, hinhhh where hanghoa.MSHH = hinhhh.MSHH and TenHH Like '%Điện thoại iPhone 13%' group by hanghoa.MSHH");
                            $i = 0;
                            while ($row_showSP = mysqli_fetch_array($sql)) {
                                $i++; ?>
                                <div class="rate-height-items">
                                    <div class="rate-height-box-img">
                                        <a class="tag-a" href="<?php echo "./chitietsp/chitiet.php" . "?id=" . $row_showSP['MSHH']; ?>">
                                            <img style="width: 70;height: 70px;object-fit: cover;" class="product-selling-img" src="./TONGQUAT/img_sp/<?php echo $row_showSP['TenHinh'] ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="rate-height-right">
                                        <span class="footer-item__item">Điện thoại iPhone 13 Pro Max 128GB</span>
                                        <span class="rate-height-price">34,990,000<sup>đ</sup></span>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col l-3 m-6 c-12">
                    <div class="footer-item category">
                        <div class="footer-item__header">Thông tin</div>
                        <div class="footer-item__list">
                            <a href="#" class="footer-item__item">Giao hàng và thanh toán</a>
                            <a href="#" class="footer-item__item">Chế độ bảo hành</a>
                            <a href="#" class="footer-item__item">Nhận hàng và đổi trả</a>
                            <a href="#" class="footer-item__item">Đập hộp và nhận quà</a>
                            <a href="#" class="footer-item__item">Chính sách bảo mật</a>
                        </div>
                    </div>
                </div>

                <div class="col l-3 m-6 c-12">
                    <div class="footer-item">
                        <div class="footer-name">2T SHOP</div>
                        <input type="text" class="footer-input" placeholder="Email...">
                    </div>
                </div>

                <div class="col l-3 m-6 c-12">
                    <div class="footer-item category">
                        <div class="footer-item__header">THÔNG TIN LIÊN HỆ</div>
                        <div class="footer-item__list">
                            <a href="#" class="footer-item__item">
                                Ninh Kiều - Cần Thơ
                            </a>
                            <a href="#" class="footer-item__item">
                                <i class="fas fa-mobile"></i> 0706839544
                            </a>
                            <a href="#" class="footer-item__item">
                                <i class="fas fa-envelope"></i> tth1610.vl@gmail.com
                            </a>
                            <a href="#" class="footer-item__item">
                                <i class="fab fa-facebook"></i> Facebook
                            </a>
                            <a href="https://github.com/thanhhoax701" class="footer-item__item">
                                <i class="fab fa-github"></i> Github
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer__bottom">
        <div class="grid wide">
            <p class="footer__text">&copy; 2021 - Bản quyền thuộc về TGDĐ</p>
        </div>
    </div>
    </div>

    <!-- Footer button -->
    <div class="footer__button">
        <div class="footer__active">
            <a class="footer__active-item" href=""><img src="./assets/img/socials/zalo-icon.png" alt="" class="footer__active-img"></a>
            <div class="footer__active-fix-icon"></div>
        </div>
        <div class="footer__active-up">
            <button><i class="footer__active-up-icon fas fa-chevron-up"></i></button>
        </div>
    </div>
</footer>