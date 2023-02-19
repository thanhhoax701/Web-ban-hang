<?php
session_start();
include '../TONGQUAT/config.php';
?>

<?php
if (isset($_GET['MSHH'])) {
$mshh = $_GET['MSHH'];
$sql = mysqli_query($conn, "UPDATE dathang SET TrangThaiDH='Đã xử lý'");
header('location:quan-ly-don-hang.php');
}
?>