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

<!-- Thêm hàng hóa -->
<?php
if (isset($_POST['addHangHoa'])) {
    $tenHangHoa = $_POST['tenHH'];
    $moTaHangHoa = $_POST['moTaHH'];
    $gia = $_POST['giaHH'];
    $soLuongHangHoa = $_POST['soLuongHH'];
    // sl
    $count_hinhHH = count($_FILES['hinhHH']['name']);
    $ghiChu = $_POST['ghiChuHH'];
    $sql_insert_product = mysqli_query($conn, "INSERT INTO hanghoa (TenHH, MoTaHH, Gia, SoLuongHang, GhiChu) values ('$tenHangHoa','$moTaHangHoa','$gia','$soLuongHangHoa', '$ghiChu')");
    $id_HH = mysqli_insert_id($conn);
    for ($i = 0; $i < $count_hinhHH; $i++) {
        // lấy tên hình
        $name = $_FILES['hinhHH']['name'][$i];
        $sql_insert_hinhHH = mysqli_query($conn, "INSERT INTO hinhhh (MSHH, TenHinh) values('$id_HH', '$name')");
        // Lưu ảnh vào img_sp
        $file_hinhHH = $_FILES['hinhHH']['tmp_name'][$i];
        move_uploaded_file($file_hinhHH, '../TONGQUAT/img_sp/' . $name);
    }
}
?>

<!-- Xóa hàng hóa -->
<?php
if (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    $get_mahinh_xoa = mysqli_query($conn, "SELECT * FROM hinhhh where MaHinh = '$id'");
    $get_mshh = mysqli_query($conn, "SELECT * FROM hanghoa,hinhhh where hanghoa.mshh = hinhhh.mshh and MaHinh = '$id'");
    $mshhcanxoa = mysqli_fetch_array($get_mshh)['MSHH'];
    $path_xoa = '../TONGQUAT/img_sp/';
    while ($row_mshinh = mysqli_fetch_array($get_mahinh_xoa)) {
        unlink($path_xoa . $row_mshinh['TenHinh']);
    }
    $sql_xoas = mysqli_query($conn, " DELETE FROM hinhhh where MaHinh = '$id'");
    $sql_xoa = mysqli_query($conn, " DELETE FROM hanghoa where mshh = '$mshhcanxoa'");
}
?>


<!-- Cập nhật hàng hóa -->
<?php
if (isset($_POST['upHangHoa'])) {
    $mahinh_capnhat = $_SESSION["capnhat"];
    $mshh =  mysqli_query($conn, "SELECT * FROM hinhhh where MaHinh = '$mahinh_capnhat'");
    $mshh_capnhat = mysqli_fetch_array($mshh)['MSHH'];
    // echo $mshh_capnhat . "". $mahinh_capnhat;
    $tenhh = $_POST['tenHH'];
    $giahh = $_POST['giaHH'];
    $motahh = $_POST['moTaHH'];
    $soluonghh = $_POST['soLuongHH'];
    $ghichu = $_POST['ghiChuHH'];
    $count_hinh_sua = count($_FILES['hinhHH']['name']);
    // xem co up hinh moi len khong -> co thi xoa het hinh cu up moi len. ->khong thi thay doi thong so
    $count_hinh_sua_value = $_FILES['hinhHH']['name'];
    $path = "../TONGQUAT/img_sp/";
    // select ten hinh xong unlink
    if ($count_hinh_sua_value[0] != null) {
        $sql_select_tenhinh = mysqli_query($conn, "SELECT TenHinh FROM hinhhh where MaHinh = '$mahinh_capnhat'");
        while ($row_tenhinh = mysqli_fetch_array($sql_select_tenhinh)) {
            unlink($path . $row_tenhinh['TenHinh']);
        }
        // $sql_dem_hinhcu = mysqli_query($conn,"select count(*) FROM hinhhh where mshh = '$mshh_capnhat'");
        // $count = mysqli_fetch_row($sql_dem_hinhcu)[0];

        $sql_xoa_hhh_cu = mysqli_query($conn, "DELETE FROM hinhhh where MaHinh = '$mahinh_capnhat'");
        // Add hinh moi vao
        for ($i = 0; $i < $count_hinh_sua; $i++) {
            $name = $_FILES['hinhHH']['name'][$i];
            $query_insert_hhh = "INSERT INTO hinhhh (MSHH,TenHinh) value ('$mshh_capnhat','$name')";
            mysqli_query($conn, $query_insert_hhh);
            move_uploaded_file($_FILES['hinhHH']['tmp_name'][$i], $path . $name);
        }
    }

    // thay doi thong so hang hoa
    $sql_update_thongso = mysqli_query($conn, "UPDATE hanghoa set TenHH = '$tenhh', Gia = '$giahh', MoTaHH = '$motahh', SoLuongHang = '$soluonghh', GhiChu = '$ghichu' where MSHH ='$mshh_capnhat'");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Quản lý hàng hóa</title>
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
    <link rel="stylesheet" href="./fonts/fontawesome-free-5.15.4-web/css/all.min.css">
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
                        <a class="nav-link" href="#">
                            <i class="fa-brands fa-product-hunt menu-icon"></i>
                            <span class="menu-title">Quản lý hàng hóa</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./quan-ly-don-hang.php">
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
                                    <h4 class="card-title">Danh sách hàng hóa</h4>
                                    <div class="table-responsive pt-3">
                                        <?php
                                        // $sql_select_sp = mysqli_query($conn, "SELECT * FROM hanghoa ORDER BY MSHH ASC")
                                        $sql_select_sp = mysqli_query($conn, "SELECT * FROM hanghoa, hinhhh where hanghoa.MSHH = hinhhh.MSHH ORDER BY hanghoa.MSHH ASC")
                                        ?>
                                        <table style="max-width:100%" class="table table-bordered">
                                            <thead style="text-align: center;">
                                                <tr style="font-weight: bold; color: blue;">
                                                    <th>MSHH</th>
                                                    <th style="width: auto;">Tên Hàng Hóa</th>
                                                    <th>Hình</th>
                                                    <th>Giá</th>
                                                    <th>Mô Tả Hàng Hoá</th>
                                                    <th>Số Lượng Hàng</th>
                                                    <th>Ghi Chú</th>
                                                    <th>Thao Tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                while ($row_spHH = mysqli_fetch_array($sql_select_sp)) {
                                                    $i++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row_spHH['MSHH'] ?></td>
                                                        <td style="width: auto;"><?php echo $row_spHH['TenHH'] ?></td>
                                                        <td><img style="width: 100px; height: 100px; border-radius: unset;" src="<?php echo '../TONGQUAT/img_sp/' . $row_spHH['TenHinh'] ?>" alt=""></td>
                                                        <td><?php echo number_format($row_spHH['Gia'], 0, ',', '.') ?>&#8363;</td>
                                                        <td><?php echo $row_spHH['MoTaHH'] ?></td>
                                                        <td><?php echo $row_spHH['SoLuongHang'] ?></td>
                                                        <td><?php echo $row_spHH['GhiChu'] ?></td>
                                                        <td>
                                                            <a class="icon_delete" href="?xoa=<?php echo $row_spHH['MaHinh'] ?>"><i class="fas fa-trash"></i></a> | <a class="text_update" href="?capnhat=<?php echo $row_spHH['MaHinh'] ?>">Cập nhật</a>
                                                        </td>
                                                        </tr=>
                                                    <?php
                                                }
                                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php
                                if (isset($_GET['capnhat'])) {
                                    $id = $_GET['capnhat'];
                                    $sql_capnhat = mysqli_query($conn, "SELECT * FROM hanghoa, hinhhh where hanghoa.MSHH = hinhhh.MSHH AND hinhhh.MaHinh = '$id' ORDER BY hanghoa.MSHH ASC");
                                    $row_capnhat = mysqli_fetch_array($sql_capnhat);
                                ?>
                                    <!-- Bảng sửa hàng hóa -->
                                    <div class="demo_capnhatHH" style="margin: 10px;">
                                        <form action="" method="POST" class="form_" enctype="multipart/form-data">
                                            <div class="form-input">
                                                <label for="">Tên Hàng Hóa </label>
                                                <input name="tenHH" type="text" value="<?php echo $row_capnhat['TenHH'] ?>"><br>
                                            </div>
                                            <div class="form-input">
                                                <label for="">Hình </label>
                                                <input name="hinhHH[]" type="file" multiple value="<?php echo $row_capnhat['MaHinh'] ?>">
                                            </div>
                                            <div class="form-input">
                                                <label for="">Giá </label>
                                                <input name="giaHH" type="text" value="<?php echo $row_capnhat['Gia'] ?>"><br>
                                            </div>
                                            <div class="form-input">
                                                <label for="">Mô Tả </label>
                                                <!-- <input name="moTaHH" type="text" value="<?php echo $row_capnhat['MoTaHH'] ?>"></input><br> -->
                                                <textarea name="moTaHH" id="" cols="100" rows="5" value="<?php echo $row_capnhat['MoTaHH'] ?>"></textarea><br>
                                            </div>
                                            <div class="form-input">
                                                <label for="">Số Lượng </label>
                                                <input name="soLuongHH" type="number" value="<?php echo $row_capnhat['SoLuongHang'] ?>"><br>
                                            </div>
                                            <div class="form-input">
                                                <label for="">Ghi Chú </label>
                                                <input name="ghiChuHH" type="text" value="<?php echo $row_capnhat['GhiChu'] ?>"></input><br>
                                                <!-- <textarea name="ghiChuHH" id="" cols="100" rows="5" value="<?php echo $row_capnhat['GhiChu'] ?>"></textarea><br> -->
                                            </div>
                                            <div class="form-submit">
                                                <a class="back" href="./quan-ly-hang-hoa.php">Quay lại</a>
                                                <input type="submit" value="Cập Nhật" name="upHangHoa">
                                            </div>
                                        </form>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <!-- Bảng thêm hàng hóa -->
                                    <div class="demo">
                                        <label for="checkcontact" class="contactbutton">
                                            <div class="addHangHoa">Thêm hàng hóa</div>
                                        </label>
                                        <input id="checkcontact" type="checkbox">
                                        <form action="" method="POST" class="form" enctype="multipart/form-data">
                                            <div class="form-input">
                                                <label for="">Tên Hàng Hóa </label>
                                                <input name="tenHH" type="text"><br>
                                            </div>
                                            <div class="form-input">
                                                <label for="">Hình </label>
                                                <input name="hinhHH[]" type="file" multiple>
                                            </div>
                                            <div class="form-input">
                                                <label for="">Giá </label>
                                                <input name="giaHH" type="text"><br>
                                            </div>
                                            <div class="form-input">
                                                <label for="">Mô Tả </label>
                                                <!-- <input name="moTaHH" type="text"><br> -->
                                                <textarea name="moTaHH" id="" cols="100" rows="5"></textarea>
                                            </div>
                                            <div class="form-input">
                                                <label for="">Số Lượng </label>
                                                <input name="soLuongHH" type="number"><br>
                                            </div>
                                            <div class="form-input">
                                                <label for="">Ghi Chú </label>
                                                <input name="ghiChuHH"></input><br>
                                                <!-- <textarea name="ghiChuHH" id="" cols="100" rows="5"></textarea> -->
                                            </div>
                                            <input type="submit" value="Thêm" name="addHangHoa">
                                        </form>
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