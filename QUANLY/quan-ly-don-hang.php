<?php
session_start();
include '../TONGQUAT/config.php';
?>

<?php
if (isset($_GET['signout'])) {
    unset($_SESSION['signin']);
    header("location:index.php");
}
//thoát khỏi phiên đăng nhập
elseif (!isset($_SESSION['signin'])) {
    header("location:index.php");
}
?>

<!-- Lấy hàng hoá đã được đặt từ CSDL ra bảng này -->


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Quản lý đơn hàng</title>
    <!-- plugins:css -->
    <!-- <link rel="stylesheet" href="./vendors/feather/feather.css"> -->
    <link rel="stylesheet" href="./vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="./vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="./vendors/typicons/typicons.css">
    <link rel="stylesheet" href="./vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="./vendors/css/vendor.bundle.base.css">
    <!-- inject:css -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/style_.css">
    <link rel="stylesheet" href="./fonts/fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../KHACHHANG/assets/img/logo/icon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:./partials/_navbar.php -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="../QUANLY/quan-ly-nhan-vien.php">2T SHOP</a>
                    <a class="navbar-brand brand-logo-mini" href="../QUANLY/quan-ly-nhan-vien.php">
                        <img src="../KHACHHANG/assets/img/logo/icon.png" alt="logo" />
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">Xin chào,
                            <?php
                            if (isset($_SESSION['signin'])) {
                                echo $_SESSION['signin'];
                            }
                            ?>
                        </h1>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form class="search-form" action="#">
                            <i class="icon-search"></i>
                            <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                        </form>
                    </li>
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" src="../QUANLY/img/avatar.jpg"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <a class="dropdown-item" href="?signout"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Đăng xuất</a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- Main -->
        <div class="container-fluid page-body-wrapper">
            <!-- Chỉnh màu header -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border me-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>
            <!-- Thanh sidebar Quản lý -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="./quan-ly-nhan-vien.php">
                            <i class="menu-icon mdi mdi-account-circle-outline"></i>
                            <span class="menu-title">Quản lý nhân viên</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./quan-ly-hang-hoa.php">
                            <i class="fa-brands fa-product-hunt menu-icon"></i>
                            <span class="menu-title">Quản lý hàng hóa</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-brands fa-opencart menu-icon"></i>
                            <span class="menu-title">Quản lý đơn hàng</span>
                        </a>
                    </li>
            </nav>
            <!-- Bảng hàng hóa -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Đơn hàng</h4>
                                    <div class="table-responsive pt-3">
                                        <?php
                                        // $sql_select_sp = mysqli_query($conn, "SELECT * FROM hanghoa ORDER BY MSHH ASC")
                                        $sql_select_sp = mysqli_query($conn, "SELECT * FROM chitietdathang, dathang where chitietdathang.SoDonDH = dathang.SoDonDH ORDER BY chitietdathang.MSHH ASC")
                                        ?>
                                        <table style="max-width:100%" class="table table-bordered">
                                            <thead style="text-align: center;">
                                                <tr style="font-weight: bold; color: blue;">
                                                    <th>Số Đơn Hàng</th>
                                                    <th>Tên Khách Hàng</th>
                                                    <th>Tên Hàng Hoá</th>
                                                    <th>Giá</th>
                                                    <th>Số Lượng</th>
                                                    <th>Thành Tiền</th>
                                                    <th>Ngày đặt</th>
                                                    <th>Ngày giao (dự kiến)</th>
                                                    <th>Trạng Thái</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = mysqli_query($conn, "SELECT * FROM  chitietdathang, khachhang, dathang, hanghoa where dathang.SoDonDH = chitietdathang.SoDonDH 
                                                and khachhang.MSKH = dathang.MSKH
                                                and chitietdathang.MSHH=hanghoa.MSHH GROUP BY hanghoa.MSHH
                                                ORDER BY chitietdathang.SoDonDH");
                                                $i = 0;
                                                $tongSL = 0;
                                                while ($row_showSP = mysqli_fetch_array($sql)) {
                                                    $tongSL = $tongSL + $row_showSP['SoLuong'];
                                                    $thanhTien = $row_showSP['SoLuong'] * $row_showSP['Gia']; ?>
                                                    <tr>
                                                        <td><?php echo $row_showSP['SoDonDH'] ?></td>
                                                        <td><?php echo $row_showSP['HoTenKH'] . '(' . $row_showSP['MSKH'] . ')' ?></td>
                                                        <td><?php echo $row_showSP['TenHH'] ?></td>
                                                        <td><?php echo number_format($row_showSP['GiaDatHang'], 0, ',', '.') ?><b>&#8363;</b></td>
                                                        <td><?php echo $row_showSP['SoLuong'] ?></td>
                                                        <td><?php echo number_format($thanhTien, 0, ',', '.') ?><b>&#8363;</b></td>
                                                        <td><input type="date" value="<?php echo $row_showSP['NgayDH'] ?>"></td>
                                                        <td><input type="date" value="<?php echo $row_showSP['NgayGH'] ?>"></td>
                                                        <td>
                                                            <?php
                                                            if ($row_showSP['TrangthaiDH'] == 'Đơn hàng mới') {
                                                                echo '<a href="./xu-ly-don-hang.php?TrangThaiDH=0&MSHH=' . $row_showSP['MSHH'] . '">Xử lý đơn hàng</a>';
                                                            } else {
                                                                echo 'Đã xử lý';
                                                            } ?>
                                                        </td>
                                                        </tr=>
                                                    <?php
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sửa lỗi khi thêm nhân viên mới => sau đó load lại trang thì sẽ bị lặp lại nhân viên đó -->
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="./vendors/js/vendor.bundle.base.js"></script>
    <!-- Plugin js for this page -->
    <script src="./vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- inject:js -->
    <script src="./js/off-canvas.js"></script>
    <script src="./js/hoverable-collapse.js"></script>
    <script src="./js/template.js"></script>
    <script src="./js/settings.js"></script>
    <script src="./js/todolist.js"></script>
</body>

</html>


<?php
if (isset($_GET['capnhat'])) {
    $_SESSION["capnhat"] = $_GET['capnhat'];
}

?>