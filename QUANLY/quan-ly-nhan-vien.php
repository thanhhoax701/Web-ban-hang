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

<?php
//thêm nhân viên
if (isset($_POST['addNhanVien'])) {
  $username = $_POST['username'];
  $hoTen = $_POST['hoTen'];
  $chucVu = $_POST['chucVu'];
  $diaChi = $_POST['diaChi'];
  $sdt = $_POST['sdt'];
  $sql_insert_product = mysqli_query($conn, "INSERT INTO nhanvien (Username, HoTenNV, ChucVu, DiaChi, SoDienThoai) values ('$username', '$hoTen','$chucVu','$diaChi','$sdt')");
} elseif (isset($_POST['upnhanvien'])) {

  $id_update = $_POST['msnv'];
  $username = $_POST['username'];
  $hoten = $_POST['hoTen'];
  $chucvu = $_POST['chucVu'];
  $diachi = $_POST['diaChi'];
  $sodienthoai = $_POST['sdt'];

  $sql_update_nhanvien = mysqli_query($conn, "UPDATE nhanvien SET Username='$username', HoTenNV='$hoten', ChucVu='$chucvu', DiaChi='$diachi', SoDienThoai='$sodienthoai' WHERE MSNV= '$id_update'");
  // Gọi hàm JavaScript sau khi cập nhật thành công
  echo '<script>hideFormAndShowAlert();</script>';
}
?>

<?php
if (isset($_GET['xoa'])) {
  $id = $_GET['xoa'];
  $sql_xoa = mysqli_query($conn, "DELETE FROM nhanvien WHERE MSNV = '$id'");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Quản lý nhân viên</title>
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
            <a class="nav-link" href="#">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">Quản lý nhân viên</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./quan-ly-hang-hoa.php">
              <!-- <i class="fas fa-cart-arrow-down menu-icon"></i> -->
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
      <!-- Bảng nhân viên -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Danh sách nhân viên</h4>
                  <div class="table-responsive pt-3">
                    <?php
                    $sql_select_sp = mysqli_query($conn, "SELECT * FROM nhanvien ORDER BY MSNV ASC")
                    // $sql_select_sp = mysqli_query($con,"SELECT * FROM hanghoa,hinhhh where hanghoa.MSHH = hinhhh.MSHH ORDER BY hanghoa.MSHH DESC")
                    ?>
                    <table class="table table-bordered">
                      <thead style="text-align: center;">
                        <tr style="font-weight: bold; color: blue;">
                          <th>MSNV</th>
                          <th>Username</th>
                          <th>Họ Tên Nhân Viên</th>
                          <th>Chức Vụ</th>
                          <th>Địa Chỉ</th>
                          <th>Số Điện Thoại</th>
                          <th>Thao tác</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 0;
                        while ($row_sp = mysqli_fetch_array($sql_select_sp)) {
                          $i++;
                        ?>
                          <tr>
                            <td><?php echo $row_sp['MSNV'] ?></td>
                            <td><?php echo $row_sp['Username'] ?></td>
                            <td><?php echo $row_sp['HoTenNV'] ?></td>
                            <td><?php echo $row_sp['ChucVu'] ?></td>
                            <td><?php echo $row_sp['DiaChi'] ?></td>
                            <td><?php echo $row_sp['SoDienThoai'] ?></td>
                            <td>
                              <div class="td_actions">
                                <a class="actions" href="?capnhat=<?php echo $row_sp['MSNV'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>|
                                <a class="actions" href="?xoa=<?php echo $row_sp['MSNV'] ?>"><i class="fa-solid fa-trash"></i></a>
                              </div>
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
                  $sql_capnhat = mysqli_query($conn, "SELECT * FROM nhanvien WHERE MSNV = '$id'");
                  $row_capnhat = mysqli_fetch_array($sql_capnhat);
                ?>
                  <!-- Bảng sửa nhân viên -->
                  <div class="demo" style="margin: 10px;">
                    <form action="" method="POST" class="form_">
                      <div class="form-input">
                        <label for="">Username </label>
                        <input name="username" type="text" value="<?php echo $row_capnhat['Username'] ?>"><br>
                      </div>
                      <div class="form-input">
                        <label for="">Họ tên NV </label>
                        <input name="hoTen" type="text" value="<?php echo $row_capnhat['HoTenNV'] ?>"><br>
                        <input type="hidden" name='msnv' value="<?php echo $row_capnhat['MSNV'] ?>">
                      </div>
                      <div class="form-input">
                        <label for="">Chức vụ </label>
                        <input name="chucVu" type="text" value="<?php echo $row_capnhat['ChucVu'] ?>"><br>
                      </div>
                      <div class="form-input">
                        <label for="">Địa chỉ </label>
                        <input name="diaChi" type="text" value="<?php echo $row_capnhat['DiaChi'] ?>"><br>
                      </div>
                      <div class="form-input">
                        <label for="">Số điện thoại </label>
                        <input name="sdt" type="text" value="<?php echo $row_capnhat['SoDienThoai'] ?>"><br>
                      </div>
                      <div class="form-submit">
                        <a class="back" href="./quan-ly-nhan-vien.php">Quay lại</a>
                        <input type="submit" value="Cập Nhật" name="upnhanvien">
                      </div>
                    </form>
                    <script>
                      function hideFormAndShowAlert() {
                        // Ẩn form
                        document.querySelector('.demo').style.display = 'none';
                        // Hiển thị thông báo
                        alert('Cập nhật thành công');
                      }
                    </script>
                  </div>
                <?php
                } else {
                ?>
                  <!-- Bảng thêm nhân viên -->
                  <div class="demo">
                    <label for="checkcontact" class="contactbutton">
                      <div class="addNhanVien">Thêm nhân viên</div>
                    </label>
                    <input id="checkcontact" type="checkbox">
                    <form action="" method="POST" class="form">
                      <div class="form-input">
                        <label for="">Username </label>
                        <input name="username" type="text"><br>
                      </div>
                      <div class="form-input">
                        <label for="">Họ tên NV </label>
                        <input name="hoTen" type="text"><br>
                      </div>
                      <div class="form-input">
                        <label for="">Chức vụ </label>
                        <input name="chucVu" type="text"><br>
                      </div>
                      <div class="form-input">
                        <label for="">Địa chỉ </label>
                        <input name="diaChi" type="text"><br>
                      </div>
                      <div class="form-input">
                        <label for="">Số điện thoại </label>
                        <input name="sdt" type="text"><br>
                      </div>
                      <input type="submit" value="Thêm" name="addNhanVien">
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