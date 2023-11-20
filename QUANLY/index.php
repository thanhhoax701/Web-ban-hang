<?php
session_start();
include '../TONGQUAT/config.php';

if (isset($_POST['signin'])) {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    $sql = "SELECT * FROM nhanvien WHERE Username = '$username' AND Password = '$password' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        $_SESSION['signin'] = $username;
        header("location: quan-ly-nhan-vien.php");
    } else {
        echo '<script type="text/javascript">alert("Tên đăng nhập hoặc mật khẩu không đúng")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Đăng nhập</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="./vendors/feather/feather.css">
  <link rel="stylesheet" href="./vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="./vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="./vendors/typicons/typicons.css">
  <link rel="stylesheet" href="./vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="./vendors/css/vendor.bundle.base.css">
  <!-- inject:css -->
  <link rel="stylesheet" href="./css/style.css">
  <link rel="shortcut icon" href="../KHACHHANG/assets/img/logo/icon.png" />
  <!-- <script>
    alert("Sai rồi")
  </script> -->
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <h1 class="brand-logo">2T SHOP</h1>
              <h4>Xin chào!!!</h4>
              <h6 class="fw-light">Đăng nhập để tiếp tục.</h6>
              <form method="POST" class="pt-3">
                <div class="form-group">
                  <input type="text" name="username" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Tên người dùng">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Mật khẩu">
                </div>
                <div class="mt-3" style="text-align: center;">
                  <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="signin" value="Đăng nhập">
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Nhớ mật khẩu
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Quên mật khẩu?</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- plugins:js -->
  <script src="./vendors/js/vendor.bundle.base.js"></script>
  <!-- Plugin js for this page -->
  <script src="./vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="./js/off-canvas.js"></script>
  <script src="./js/hoverable-collapse.js"></script>
  <script src="./js/template.js"></script>
  <script src="./js/settings.js"></script>
  <script src="./js/todolist.js"></script>
</body>

</html>