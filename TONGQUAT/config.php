<?php
    // define("DB_HOST", "localhost");
    // define("DB_USER", "root");
    // define("DB_PASS", "");
    // define("DB_NAME", "your_db_name");
    $conn = mysqli_connect("localhost", "root", "", "quanlydathang");
    mysqli_set_charset($conn, "utf8");
    if ($conn->connect_errno) {
        echo "Kết nối lỗi" . $conn->connect_error;
        exit();
    }
?>
