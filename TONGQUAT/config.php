<?php
$conn = mysqli_connect("localhost", "root", "", "quanlydathang");
mysqli_set_charset($conn, "utf8");
if ($conn->connect_errno) {
    echo "Kết nối lỗi" . $conn->connect_error;
    exit();
}