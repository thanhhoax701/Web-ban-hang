<?php
session_start();
include '../TONGQUAT/config.php';
// Sign in Facebook
include '../TONGQUAT/config_facebook.php';
?>
<?php
if (isset($_POST['submit'])) {
    $msg_success = 'Xin vui lòng điền đầy đủ tên tài khoản và mật khẩu';
    $msg_error = 'Bạn đã nhập sai tài khoản hoặc mật khẩu';
    $taikhoan = $_POST['phone'];
    $matkhau = md5($_POST['password']);
    if ($taikhoan == null || $matkhau == null) {
        echo '<script type="text/javascript">alert("' . $msg_success . '")</script>';
    } else {
        $sql_select_admin = mysqli_query($conn, "SELECT * FROM khachhang where SoDienThoai='$taikhoan' AND Password='$matkhau' LIMIT 1");
        $count = mysqli_num_rows($sql_select_admin);
        $row_dangnhap = mysqli_fetch_array($sql_select_admin);
        if ($count > 0) {
            $_SESSION['submit'] = $row_dangnhap['HoTenKH'];
            $_SESSION['MSKH'] = $row_dangnhap['MSKH'];
            header("location:index.php");
        } else {
            echo '<script type="text/javascript">alert("' . $msg_error . '")</script>';
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
    <title>Đăng nhập</title>
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
        <div class="content_sign-in">
            <h2 class="content-heading">Đăng nhập tài khoản</h2>
            <div class="sign-up">
                <span id="or_sign-in" class="or">Or</span>
                <div class="left">
                    <form action="" method="POST" class="form" id="form-2">
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="phone" class="required">Số điện thoại</label>
                                <input class="auth-from__input" type="text" name="phone" id="phone" placeholder="070xxx9544" />
                                <span class="form-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="password3" id="password-normal" class="required">Mật khẩu</label>
                                <input class="auth-from__input" type="password" name="password" id="password3" placeholder="Mật khẩu của bạn" />
                                <i class="fas fa-eye" aria-hidden="true" type="button" id="eye3"></i>
                                <span class="form-message"></span>
                            </div>
                            <input type="checkbox" name="show-password" class="show-password a11y-hidden" id="show-password" tabindex="3" />
                            <label class="log__form-form-label label-show-password" for="show-password">
                                <span class="log__form-form-label-span">Nhớ mật khẩu</span>
                            </label>
                        </div>
                        <div class="auth-form__help">
                            <div class="auth-form__help-email">
                                <a class="auth-form__help--forgot-password" href="#">Quên mật khẩu?</a>
                            </div>
                        </div>
                        <input type="submit" class="form-submit" name="submit" value="Đăng nhập"></input>
                    </form>
                </div>
                <div class="right">
                    <ul>
                        <?php
                        if (isset($accessToken)) {
                            if (isset($_SESSION['facebook_access_token'])) {
                                $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
                            } else {
                                $_SESSION['facebook_access_token'] = (string) $accessToken;
                                $oAuth2Client = $fb->getOAuth2Client();
                                $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
                                $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
                                $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
                            }
                            try {
                                $profile_request = $fb->get('/me?fields=name');
                                $profile = $profile_request->getGraphUser();

                                $fbid = $profile->getId();           // To Get Facebook ID
                                $fbfullname = $profile->getName();   // To Get Facebook full name

                                # save the user nformation in session variable
                                $_SESSION['fb_id'] = $fbid . '</br>';
                                $_SESSION['fb_name'] = $fbfullname . '</br>';
                            } catch (Facebook\Exceptions\FacebookResponseException $e) {
                                echo 'Graph returned an error: ' . $e->getMessage();
                                session_destroy();
                                exit;
                            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                                exit;
                            }
                        } else {
                            $loginUrl = $helper->getLoginUrl('http://localhost/web-ban-hang/KHACHHANG/dang-nhap.php', $permissions);
                            echo '<li class="facebook">
                            <a href="' . htmlspecialchars($loginUrl) . '">
                                <i class="fab fa-facebook-square"></i>
                                <span>Đăng nhập với Facebook</span>
                            </a>
                        </li>';
                        }
                        ?>
                        </li>
                        <li class="google">
                            <a href="#">
                                <i class="fab fa-google"></i>
                                <span>Đăng nhập với Google</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <p class="member">Bạn chưa có tài khoản? <a href="./dang-ky.php" class="link">Đăng ký ngay</a></p>

            <?php if (isset($_SESSION['fb_id'])) { ?>
                <div class="container">
                    <div class="jumbotron">
                        <h1>Hello <?php echo $_SESSION['fb_name']; ?></h1>
                    </div>
                </div>
            <?php } ?>
            <!-- Forgot password -->
            <div class="forgot-password modal__body">
                <div class="modal__overlay"></div>
                <div class="auth-form">
                    <div class="auth-form__container">
                        <div class="auth-form__header">
                            <h3 class="auth-form__heading auth-form__heading--forgot">Quên mật khẩu</h3>
                            <span class="auth-form__switch-btn btn-close-sign-in">Đăng nhập</span>
                        </div>
                        <form action="" method="POST" id="form-3">
                            <div class="auth-form__form">
                                <div class="auth-form__group">
                                    <label for="email"></label>
                                    <input class="auth-form__input auth-form__input--forgot" type="email" name="email" placeholder="Email của bạn" required />
                                    <span class="form-message"></span>
                                </div>
                            </div>
                        </form>
                        <div class="auth-form__control auth-form__control--forgot">
                            <button class="btn btn--normal auth-form__control-back">
                                <span class="btn btn-close">TRỞ LẠI</span>
                            </button>
                            <button class="btn btn-forgot auth-form__control-sign">
                                <span>LẤY LẠI MẬT KHẨU</span>
                            </button>
                        </div>
                    </div>
                    <div class="auth-form__socials">
                        <a href="" class="auth-form__socials--facebook btn btn--size-s btn--with-icon">
                            <i class="auth-form__socials-icon fab fa-facebook-square"></i>
                            <span class="auth-form__socials-title">Đăng nhập với Facebook</span>
                        </a>
                        <a href="" class="auth-form__socials--google btn btn--size-s btn--with-icon">
                            <i class="auth-form__socials-icon fab fa-google"></i>
                            <span class="auth-form__socials-title">Đăng nhập với Google</span>
                        </a>
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

    <script src="./assets/javascript/main.js"></script>

    <!-- Hiện form quên password -->
    <script>
        // Forgot Password
        var forgotPassword = document.querySelector('.auth-form__help--forgot-password');
        var showForgotPassword = document.querySelector('.forgot-password');
        var closeForgotPassword = document.querySelector('.btn-close');
        var nextSignIn = document.querySelector('span[class="auth-form__switch-btn btn-close-sign-in"]');

        forgotPassword.addEventListener('click', function() {
            showForgotPassword.style.display = 'block'
        })

        closeForgotPassword.addEventListener('click', function() {
            showForgotPassword.style.display = 'none'
        })

        nextSignIn.addEventListener('click', function() {
            showForgotPassword.style.display = 'none'
        })
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Validator({
                form: '#form-2',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#email'),
                    Validator.isRequired('#password3'),
                    Validator.isEmail('#email'),
                    Validator.minLength('#password3', 6),
                ],
                onSubmit: function(data) {
                    // Call API
                    console.log(data);
                }
            });

            // 
            const togglePassword3 = document.querySelector('#eye3');
            const password3 = document.querySelector('#password3');

            togglePassword3.addEventListener('click', function(e) {
                const type = password3.getAttribute('type') === 'password' ? 'text' : 'password';
                password3.setAttribute('type', type);
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>

</html>