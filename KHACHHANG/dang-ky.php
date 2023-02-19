<?php
session_start();
include '../TONGQUAT/config.php';
?>
<?php
// session_destroy();
if (isset($_POST['submit'])) {
    // $hoTen = $_POST['fullname'];
    // $pass = md5($_POST['password']);
    // $diaChi = $_POST['address'];
    // $sdt = $_POST['phone'];
    // $sql_insert_product = mysqli_query($conn, "INSERT INTO khachhang (HoTenKH, Password, DiaChi, SoDienThoai) values ('$hoTen', '$pass', '$diaChi', '$sdt')");
    // if ($sql_insert_product) {
    //     echo "<script>alert('Đã đăng ký thành công')</script>";
    //     // header('location:dang-nhap.php');
    //     $_SESSION['submit'] = $hoTen;
    //     $_SESSION['id_khachhang'] = mysqli_insert_id($conn);
    // }
    $msg_success = 'Xin vui lòng điền đầy đủ thông tin';
    $hoTen = $_POST['fullname'];
    $pass = md5($_POST['password']);
    $diaChi = $_POST['address'];
    $sdt = $_POST['phone'];
    if ($hoTen == null || $pass == null || $diaChi == null || $sdt == null) {
        echo '<script type="text/javascript">alert("' . $msg_success . '")</script>';
    } else {
        $sql_insert_product = mysqli_query($conn, "INSERT INTO khachhang (HoTenKH, Password, DiaChi, SoDienThoai) values ('$hoTen', '$pass', '$diaChi', '$sdt')");
        if ($sql_insert_product) {
            echo "<script>alert('Đã đăng ký thành công')</script>";
            header('location:dang-nhap.php');
            $_SESSION['submit'] = $hoTen;
            $_SESSION['id_khachhang'] = mysqli_insert_id($conn);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="shortcut icon" href="./assets/img/logo/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/signin-register.css">
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-5.15.4-web/css/all.min.css">
</head>

<body class="page">
    <!-- Page header -->
    <?php
    require '../TONGQUAT/include/header.php';
    ?>

    <!-- Page container -->
    <div class="page__container">
        <!-- Page content -->
        <div class="content_sign-up">
            <h2 class="content-heading">Đăng ký tài khoản</h2>
            <div class="sign-up">
                <span id="or" class="or">Or</span>
                <div class="left">
                    <form action="" method="POST" class="form" id="form-1">
                        <div class="form-group">
                            <label for="fullname" class="required" for="">Họ tên đầy đủ</label>
                            <input class="auth-from__input" type="text" name="fullname" id="fullname" placeholder="Trần Thanh Hòa" />
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="password" id="password-normal" class="required">Mật khẩu của bạn</label>
                            <input class="auth-from__input" type="password" name="password" id="password" placeholder="Mật khẩu của bạn" />
                            <i class="fas fa-eye" aria-hidden="true" type="button" id="eye1"></i>
                            <p id="message">Password is <span id="strenght"></span></p>
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="repassword" id="password-repeat" class="required">Nhập lại mật khẩu</label>
                            <input class="auth-from__input" type="password" name="repassword" id="repassword" placeholder="Nhập lại mật khẩu" />
                            <i class="fas fa-eye" aria-hidden="true" type="button" id="eye2"></i>
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="address" class="required">Địa chỉ</label>
                            <input class="auth-from__input" type="text" name="address" id="address" placeholder="Vĩnh Long" />
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="required">Số điện thoại</label>
                            <input class="auth-from__input" type="text" name="phone" id="phone" placeholder="0701119544" />
                            <span class="form-message"></span>
                        </div>
                        <input type="checkbox" name="show-password" class="show-password a11y-hidden" id="show-password" tabindex="3" />
                        <label class="log__form-form-label label-show-password" for="show-password">
                            <span class="log__form-form-label-span">Nhớ mật khẩu</span>
                        </label>
                        <div class="form__aside">
                            <p class="form__policy-text">
                                Bằng việc đăng ký, bạn đã đồng ý với 2T SHOP về
                                <a href="#" class="form__text-link">Điều khoản dịch vụ</a> &
                                <a href="#" class="form__text-link">Chính sách bảo mật</a>
                            </p>
                        </div>
                        <button style="display: block; padding: 20px; color: #fff; background-color: #f87253; width: 100%; text-transform: uppercase; font-size: 1.6rem; text-align: center; outline: none; outline: none; border: 0; border-radius: 25px; cursor: pointer;" type="submit" class="form-submit" name="submit">Đăng ký</button>
                    </form>
                </div>
                <div class="right">
                    <ul>
                        <li class="facebook">
                            <a href="#">
                                <i class="fab fa-facebook-square"></i>
                                <span>Connect with Facebook</span>
                            </a>
                        </li>
                        <li class="twitter">
                            <a href="#">
                                <i class="fab fa-twitter-square"></i>
                                <span>Connect with Twitter</span>
                            </a>
                        </li>
                        <li class="google">
                            <a href="#">
                                <i class="fab fa-google"></i>
                                <span>Connect with Google</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <p class="member">Bạn có phải là thành viên? <a href="./dang-nhap.php" class="link">Login now</a></p>
        </div>
    </div>

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
    <!-- <script src="./assets/javascript/signUp-signIn.js"></script> -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dựa vào file js đã được dựng sẵn
            Validator({
                form: '#form-1',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                // Khi muốn bắt buộc thằng nào thì chọn đúng thằng đó và lấy id của nó
                rules: [
                    // Gọi đến đối số của từng hàm đã được khai báo
                    Validator.isRequired('#fullname', 'Vui lòng nhập tên đầy đủ của bạn'),
                    Validator.isRequired('#email'),
                    Validator.isEmail('#email'),
                    Validator.isRequired('#password1'),
                    Validator.minLength('#password1', 6),
                    Validator.isRequired('#password2'),
                    Validator.isConfirmed('#password2', function() {
                        // Trả về giá trị người dùng nhập vào ở ô password nếu không khớp sẽ báo lỗi bên dưới
                        return document.querySelector('#form-1 #password1').value;
                    }, 'Mật khẩu nhập không chính xác')
                ],
                onSubmit: function(data) {
                    // Call API
                    console.log(data);
                }
            });
        });
    </script>
</body>

</html>