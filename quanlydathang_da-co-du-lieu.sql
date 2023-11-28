-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2022 at 08:32 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

--
-- Database: `quanlydathang`
--
CREATE DATABASE IF NOT EXISTS `quanlydathang` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `quanlydathang`;

-- --------------------------------------------------------
--
-- Table structure for table `chitietdathang`
--
CREATE TABLE `chitietdathang` (
  `SoDonDH` int(11) NOT NULL,
  `MSHH` int(11) NOT NULL,
  `SoLuong` int(11) DEFAULT NULL,
  `GiaDatHang` float DEFAULT NULL,
  `GiamGia` float DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `chitietdathang`
--
INSERT INTO
  `chitietdathang` (
    `SoDonDH`,
    `MSHH`,
    `SoLuong`,
    `GiaDatHang`,
    `GiamGia`
  )
VALUES
  (1, 1, 1, 26290000, NULL),
  (2, 2, 3, 44990000, NULL),
  (4, 2, 3, 44990000, NULL),
  (5, 8, 1, 4740000, NULL);

-- --------------------------------------------------------
--
-- Table structure for table `dathang`
--
CREATE TABLE `dathang` (
  `SoDonDH` int(11) NOT NULL,
  `MSKH` int(11) DEFAULT NULL,
  `MSNV` int(11) DEFAULT NULL,
  `NgayDH` date DEFAULT NULL CHECK (`NgayDH` <= `NgayGH`),
  `NgayGH` date DEFAULT NULL,
  `TrangthaiDH` varchar(20) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `dathang`
--
INSERT INTO
  `dathang` (
    `SoDonDH`,
    `MSKH`,
    `MSNV`,
    `NgayDH`,
    `NgayGH`,
    `TrangthaiDH`
  )
VALUES
  (1, 1, NULL, '2022-05-10', NULL, '0'),
  (2, 1, NULL, '2022-05-10', NULL, 'Đơn hàng mới'),
  (3, 1, NULL, '2022-05-10', NULL, 'Đơn hàng mới'),
  (4, 2, NULL, '2022-05-10', NULL, 'Đơn hàng mới'),
  (5, 3, NULL, '2022-05-10', NULL, 'Đơn hàng mới');

-- --------------------------------------------------------
--
-- Table structure for table `hanghoa`
--
CREATE TABLE `hanghoa` (
  `MSHH` int(11) NOT NULL,
  `TenHH` varchar(50) DEFAULT NULL,
  `MoTaHH` varchar(500) DEFAULT NULL,
  `Gia` float DEFAULT NULL,
  `SoLuongHang` int(11) DEFAULT NULL,
  `GhiChu` varchar(50) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `hanghoa`
--
INSERT INTO
  `hanghoa` (
    `MSHH`,
    `TenHH`,
    `MoTaHH`,
    `Gia`,
    `SoLuongHang`,
    `GhiChu`
  )
VALUES
  (
    1,
    'Điện thoại iPhone 12 Pro Max 128GB',
    'Điểm sáng giá đầu tiên phải nói đến kết nối 5G lần đầu được Apple tích hợp trên các dòng iPhone 12 của mình với tốc độ và hiệu suất cao.  IPhone 12 Pro được trang bị con chip xử lý A14 Bionic mạnh mẽ. Không thể bỏ qua hệ thống camera trên iPhone 12 Pro với sự kết hợp của 3 ống kính 12 MP chất lượng và cảm biến LiDAR. IPhone 12 Pro được trang bị tính năng sạc không dây MagSafe vô cùng tiện lợi.',
    26290000,
    10,
    '500 đã bán'
  ),
  (
    2,
    'Điện thoại Samsung Galaxy Z Fold3 5G 512GB',
    'Khung viền Galaxy Z Fold3 được hoàn thiện bằng chất liệu Armor Aluminum cao cấp nhất từ trước đến giờ nhằm tăng cường được độ bền. Cụm camera trên Galaxy Z Fold3 bao gồm 3 ống kính: Camera góc rộng, camera góc siêu rộng, camera tele tích hợp chống rung OIS và đều sở hữu độ phân giải 12 MP. Màn hình chính trên Z Fold3 có kích thước 7.6 inches, sử dụng tấm nền Dynamic AMOLED 2X cho độ phân giải 1768 x 2208 Pixels hỗ trợ khả năng hiển thị HDR10+.',
    44990000,
    10,
    '400 đã bán'
  ),
  (
    3,
    'Máy tính bảng Samsung Galaxy Tab S7 FE 4G',
    'Galaxy Tab S7 FE sẽ khiến bạn choáng ngợp với dụng lượng pin cực khủng 10090 mAh đảm bảo cho cường độ làm việc, giải trí liên tục trong nhiều giờ liền. Chơi hết sức, làm việc hết mình với màn hình siêu lớn lên đến 12.4 inch. Galaxy Tab S7 FE vẫn sử dụng thiết kế vát thẳng mạnh mẽ ở phần cạnh viền tương tự Galaxy Tab S7. Trang bị vi xử lý Snapdragon 750G giúp cho máy có tốc độ mở ứng dụng khá nhanh và chơi game 3D mượt mà. Galaxy Tab S7 FE tương thích với bút S-Pen thế hệ mới.',
    13990000,
    10,
    '300 đã bán'
  ),
  (
    4,
    'Máy tính bảng Huawei MatePad 11',
    'Thiết kế tối giản, màu sắc thanh lịch do máy chỉ mỏng khoảng 7.25 mm và trọng lượng 485 gam nên khi cầm trên tay. MatePad 11 sở hữu màn hình 10.9 inch tỷ lệ 16:9 có độ phân giải là 2K, sử dụng tấm nền IPS LCD, hỗ trợ công nghệ HDR. Matepad 11 trang bị con chip Snapdragon 865 đồng thời nó được chạy trên HarmonyOS 2.0. Vì là một chiếc máy tính bảng nên có chút đáng tiếc là Matepad 11 có vẻ không được chăm chút nhiều về phần camera, nhưng nó vẫn được trang bị camera sau có độ phân giải 13 MP.',
    14990000,
    10,
    '200 đã bán'
  ),
  (
    5,
    'Polymer 10.000 mAh Type C Xiaomi Mi Wireless Power',
    'Thiết kế dạng hình chữ nhật với lớp vỏ chắc chắn và có độ nhám giúp tăng ma sát, chống trơn trượt khi cầm nắm. Tích hợp sạc không dây chuẩn Qi với công suất lên đến 10 W. Với 2 tính năng sạc có dây và không dây với công suất sạc đạt tối đa 15 W giúp người dùng tiết kiệm thời gian. Trang bị đèn led báo hiệu dung lượng pin. Dung lượng pin lớn lên đến 10.000 mAh cùng hiệu suất sạc 58% cho người dùng thoải mái sử dụng trong thời gian dài, tiện lợi khi đi xa.',
    559000,
    10,
    '100 đã bán'
  ),
  (
    6,
    'Polymer 10.000 mAh Type C Xmobile PJ JP190ST',
    'Pin sạc dự phòng Polymer 10.000mAh Type C Xmobile PJ JP190ST xanh có kích thước gọn gàng cùng màu sắc đẹp mắt, dễ dàng mang theo đến nhiều nơi và sử dụng khi cần. Có 3 nguồn ra, gồm 2 cổng USB và 1 cổng USB Type-C đạt công suất 5V - 2.4A, cho tốc độ sạc nhanh, tiết kiệm thời gian và không gian khi sạc. Sạc dự phòng Xmobie trang bị lõi pin Polymer bền bỉ, an toàn hơn cho bạn khi sử dụng.',
    495000,
    10,
    '500 đã bán'
  ),
  (
    7,
    'Tai nghe Bluetooth True Wireless Soundpeats',
    'SoundPeats Sonic có bề mặt phủ màu xám, nút nhấn và đường viền tô điểm bởi màu vàng đồng bóng loáng. Nút đệm tai nghe mềm êm, có 3 kích cỡ cho bạn dễ chọn. Âm thanh táo bạo, sống động, tái tạo âm bass chi tiết, mạnh mẽ. Cải thiện độ rõ của cuộc gọi như khi đối thoại trực tiếp nhờ công nghệ giảm tiếng ồn cVC. Kết nối Bluetooth 5.2 thần tốc. Dung lượng pin đủ cho 15 giờ chỉ với tai nghe, kèm hộp sạc tổng thời gian tới 35 giờ.',
    714000,
    10,
    '400 đã bán'
  ),
  (
    8,
    'Loa Bluetooth Harman Kardon Onyx Studio 6',
    'Thiết kế sang trọng, tinh tế đầy sức hút, hai màu đen và xanh dương để lựa chọn. Chất liệu cao cấp tăng độ bền tốt của sản phẩm với các tác nhân môi trường ngoài. Tiêu chuẩn chống nước IPX7 bảo vệ loa hiệu quả. Loa Bluetooth Harman Kardon với công nghệ Bluetooth 4.2 kết nối không dây nhanh chóng và dễ dàng. Âm thanh sống động, ấn tượng với công suất 50 W và công nghệ âm thanh ưu tú Harman Kardon.',
    4740000,
    10,
    '300 đã bán'
  ),
  (
    9,
    'Điện thoại iPhone 13 Pro Max 128GB',
    'iPhone mới kế thừa thiết kế đặc trưng từ iPhone 13 Pro Max khi sở hữu khung viền vuông vức, mặt lưng kính cùng màn hình tai thỏ tràn viền nằm ở phía trước. Màn hình giải trí siêu mượt cùng tần số quét 120 Hz. iPhone 13 Pro Max vẫn sẽ có bộ camera 3 ống kính xếp xen kẽ thành một cụm vuông, đặt ở góc trên bên trái của lưng máy. Hiệu năng đầy hứa hẹn với Apple A15 Bionic.',
    34990000,
    10,
    '500 đã bán'
  ),
  (
    10,
    'Điện thoại OPPO Reno6 5G',
    '',
    12990000,
    10,
    '400 đã bán'
  ),
  (
    11,
    'Điện thoại OPPO Reno7 Z 5G',
    'Điện thoại OPPO Reno7 Z 5G có khung viền vát phẳng, vuông vức trendy làm cho máy toát lên nét hiện đại và năng động. Bốn góc được bo cong mềm mại tạo cảm giác thoải mái và nhẹ nhàng (chỉ 173 g). OPPO đánh mạnh vào phần trải nghiệm camera, Reno7 Z trang bị cụm 3 camera sau với cảm biến chính độ phân giải 64 MP, ống kính macro 2 MP và camera chụp ảnh xoá phông 2 MP. OPPO Reno7 Z 5G năm nay đã có cải tiến khi trang bị con chip Snapdragon 695 5G đến từ nhà Qualcomm.',
    10490000,
    10,
    '300 đã bán'
  ),
  (
    12,
    'Máy tính bảng Lenovo Tab P11 Plus',
    'Lenovo Tab P11 Plus mang đến hiệu suất hoạt động khá ấn tượng nhờ vi xử lý MediaTek Helio G90T. Thiết kế nguyên khối từng đường nét được thể hiện rõ ràng cùng phần viền bo cong 4 góc mềm mại, trọng lượng 490g. Chụp ảnh, quay video ổn định Camera sau có độ phân giải 13 MP.',
    8190000,
    10,
    '200 đã bán'
  ),
  (
    13,
    'Máy tính bảng iPad Air 4 Wifi 256GB (2020)',
    'iPad Air 4 Wifi 256GB 2020 được thay đổi gần như toàn bộ thiết kế ở phần mặt trước khi so sánh với thế hệ iPad Air 3 tiền nhiệm. Chuẩn quay video 4K được tích hợp trên camera 12 MP ở mặt sau trở thành một nâng cấp đáng giá trên chiếc iPad dòng Air thế hệ mới nhất của Apple. Hiệu năng siêu khủng cùng bộ nhớ trong 256 GB. ',
    22290000,
    10,
    '1000 đã bán'
  ),
  (
    14,
    'Máy tính bảng iPad Pro 12.9 inch Wifi 128GB',
    'iPad Pro 12.9 inch 2020 có một thiết kế khá vuông vức với viền màn hình 4 cạnh không quá dày và đều nhau. Hiệu năng mạnh mẽ với chip CPU A12Z với 8 nhân đồ họa. Cụm camera \"Pro\", nâng tầm trải nghiệm AR.',
    26790000,
    10,
    '500 đã bán'
  ),
  (
    15,
    'Polymer 10.000 mAh Hydrus PA CK01',
    'Hiệu suất sạc tới 64%, dung lượng sạc dự phòng 10.000 mAh. Nắm bắt lượng pin hiện tại của sạc dự phòng thuận tiện nhờ dải đèn LED 4 bóng với mỗi bóng thể hiện cho 25% dung lượng pin, dải đèn nằm ở vị trí gần các cổng kết nối rất dễ dàng quan sát. Hỗ trợ chế độ sạc nhỏ giọt giúp bảo vệ pin của máy. Sạc dự phòng Hydrus có độ dày 1.5 cm, các góc cạnh được làm uốn cong cho cảm giác cầm nắm cực thoải mái, nặng 233g.',
    196000,
    10,
    '1000 đã bán'
  ),
  (
    16,
    'Tai nghe Bluetooth AirPods Pro Wireless Charge App',
    'Thiết kế nhỏ gọn, dễ dàng đem theo bất cứ đâu. Kết nối nhanh và ổn định với công nghệ Bluetooth 5.0. Do chuyển sang dạng In-ear, nên AirPods Pro được kèm theo đệm tai cao su với 3 kích cỡ khác nhau. Âm thanh chất lượng, sống động cùng công nghệ Adaptive EQ tự điều chỉnh âm thanh thông minh. Tai nghe True Wireless AirPods Pro trang bị 2 chế độ: Transparency Mode (xuyên âm) và Noise Cancellation Mode (chống ồn chủ động).',
    4890000,
    10,
    '300 đã bán'
  ),
  (
    17,
    'Tai nghe Bluetooth AirPods 2 Apple',
    'AirPods 2 được tích hợp chip xử lý H1 thế hệ mới cho thời gian chuyển đổi kết nối giữa các thiết bị nhanh hơn gấp 2 lần so với phiên bản cũ. Giữ nguyên mẫu thiết kế quen thuộc, nhỏ gọn và tiện lợi, đi kèm thời lượng pin ổn định. Thao tác điều khiển cảm ứng nhanh nhạy, chất âm phù hợp với mọi thể loại nhạc.',
    2990000,
    10,
    '500 đã bán'
  ),
  (
    18,
    'Loa Bluetooth MozardX',
    'Loa Bluetooth MozardX BM01 đen có thiết kế năng động, trẻ trung, với quai cầm tiện ích, dễ dàng mang theo khi đi du lịch, cắm trại. Có đèn Led đổi màu theo nhịp điệu, cho không khí thêm sôi động. Công nghệ Bluetooth 5.0 cho kết nối ổn định trong khoảng cách 10 m, giúp bạn tiện lợi hơn khi kết nối. Khả năng chống nước IPX5 giúp loa Bluetooth chống lại tia nước áp suất thấp trong ít nhất 3 phút. Với dung lượng pin lên đến 3.000 mAh.',
    920000,
    10,
    '1000 đã bán'
  ),
  (
    19,
    'Loa Bluetooth JBL Charge 4 ',
    'Chiếc loa bluetooth JBL Charge 4 này có thiết kế gọn gàng, không có chi tiết dư thừa nào. Âm thanh phát ra mạnh mẽ, rõ ràng từng chi tiết với tổng công suất 30 W và bộ tản âm độc quyền của JBL. Bảo vệ loa an toàn khi không may ướt nước nhờ khả năng chống nước đạt chuẩn IPX7. Kết nối với đa dạng thiết bị điện tử thông qua Bluetooth 4.2. Bao phủ toàn bộ bữa tiệc bằng âm nhạc qua tính năng JBL Connect+ kết nối 100 loa cùng lúc.',
    2990000,
    10,
    '500 đã bán'
  );

-- --------------------------------------------------------
--
-- Table structure for table `hinhhh`
--
CREATE TABLE `hinhhh` (
  `MSHH` int(11) DEFAULT NULL,
  `MaHinh` int(11) NOT NULL,
  `TenHinh` varchar(50) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `hinhhh`
--
INSERT INTO
  `hinhhh` (`MSHH`, `MaHinh`, `TenHinh`)
VALUES
  (1, 1, 'ip12_1.jpg'),
  (1, 2, 'ip12_2.jpg'),
  (1, 3, 'ip12_3.jpg'),
  (1, 4, 'ip12_4.jpg'),
  (2, 5, 'samsung-fold_1.jpg'),
  (2, 6, 'samsung-fold_2.jpg'),
  (2, 7, 'samsung-fold_3.jpg'),
  (2, 8, 'samsung-fold_4.jpg'),
  (3, 9, 'samsung-galaxy-tab-s7-fe_1.jpg'),
  (3, 10, 'samsung-galaxy-tab-s7-fe_2.jpg'),
  (3, 11, 'samsung-galaxy-tab-s7-fe_3.jpg'),
  (3, 12, 'samsung-galaxy-tab-s7-fe_4.jpg'),
  (4, 13, 'matepad11_1.jpg'),
  (4, 14, 'matepad11_2.jpg'),
  (4, 15, 'matepad11_3.png'),
  (4, 16, 'matepad11_4.jpg'),
  (5, 17, 'sac-xiaomi_1.jpg'),
  (5, 18, 'sac-xiaomi_2.jpg'),
  (5, 19, 'sac-xiaomi_3.jpg'),
  (5, 20, 'sac-xiaomi_4.jpg'),
  (6, 21, 'sac-xmobile_1.jpg'),
  (6, 22, 'sac-xmobile_2.jpg'),
  (6, 23, 'sac-xmobile_3.jpg'),
  (6, 24, 'sac-xmobile_4.jpg'),
  (7, 25, 'wireless-soundpeats_1.jpg'),
  (7, 26, 'wireless-soundpeats_2.jpg'),
  (7, 27, 'wireless-soundpeats_3.jpg'),
  (7, 28, 'wireless-soundpeats_4.jpg'),
  (8, 29, 'harman-kardon_1.jpg'),
  (8, 30, 'harman-kardon_2.jpg'),
  (8, 31, 'harman-kardon_3.jpg'),
  (8, 32, 'harman-kardon_4.jpg'),
  (9, 33, 'iphone-13-pro-max_1.jpg'),
  (9, 34, 'iphone-13-pro-max_2.jpg'),
  (9, 35, 'iphone-13-pro-max_3.jpg'),
  (9, 36, 'iphone-13-pro-max_4.jpg'),
  (10, 37, 'oppo-reno6_1.jpg'),
  (10, 38, 'oppo-reno6_2.jpg'),
  (10, 39, 'oppo-reno6_3.jpg'),
  (10, 40, 'oppo-reno6_4.jpg'),
  (11, 41, 'oppo-reno7_1.jpg'),
  (11, 42, 'oppo-reno7_2.jpg'),
  (11, 43, 'oppo-reno7_3.jpg'),
  (11, 44, 'oppo-reno7_4.jpg'),
  (12, 45, 'lenovo-tab-p11_1.jpg'),
  (12, 46, 'lenovo-tab-p11_2.jpg'),
  (12, 47, 'lenovo-tab-p11_3.png'),
  (12, 48, 'lenovo-tab-p11_4.jpg'),
  (13, 49, 'ipad-air-4_1.jpg'),
  (13, 50, 'ipad-air-4_2.jpg'),
  (13, 51, 'ipad-air-4_3.jpg'),
  (13, 52, 'ipad-air-4_4.jpg'),
  (14, 53, 'ipad-pro_1.jpg'),
  (14, 54, 'ipad-pro_2.jpg'),
  (14, 55, 'ipad-pro_3.jpg'),
  (14, 56, 'ipad-pro_4.jpg'),
  (15, 57, 'polymer-10000-mah-hydrus_1.jpg'),
  (15, 58, 'polymer-10000-mah-hydrus_2.jpg'),
  (15, 59, 'polymer-10000-mah-hydrus_3.jpg'),
  (15, 60, 'polymer-10000-mah-hydrus_4.jpg'),
  (16, 61, 'airpods-pro_1.jpg'),
  (16, 62, 'airpods-pro_2.jpg'),
  (16, 63, 'airpods-pro_3.jpg'),
  (16, 64, 'airpods-pro_4.jpg'),
  (17, 65, 'airpods-2_1.jpg'),
  (17, 66, 'airpods-2_2.jpg'),
  (17, 67, 'airpods-2_3.jpg'),
  (17, 68, 'airpods-2_4.jpg'),
  (18, 69, 'loa-bluetooth-mozardx_1.jpg'),
  (18, 70, 'loa-bluetooth-mozardx_2.jpg'),
  (18, 71, 'loa-bluetooth-mozardx_3.jpg'),
  (18, 72, 'loa-bluetooth-mozardx_4.jpg'),
  (19, 73, 'jbl_charge4_1.jpg'),
  (19, 74, 'jbl_charge4_2.jpg'),
  (19, 75, 'jbl_charge4_3.jpg'),
  (19, 76, 'jbl_charge4_4.jpg');

-- --------------------------------------------------------
--
-- Table structure for table `khachhang`
--
CREATE TABLE `khachhang` (
  `MSKH` int(11) NOT NULL,
  `HoTenKH` varchar(50) DEFAULT NULL,
  `Password` varchar(32) DEFAULT NULL,
  `DiaChi` varchar(200) DEFAULT NULL,
  `SoDienThoai` varchar(10) DEFAULT NULL,
  `facebook_user_id` varchar(50) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `khachhang`
--
INSERT INTO
  `khachhang` (
    `MSKH`,
    `HoTenKH`,
    `Password`,
    `DiaChi`,
    `SoDienThoai`,
    `facebook_user_id`
  )
VALUES
  (
    1,
    'Trần Thanh Hoà',
    'c4ca4238a0b923820dcc509a6f75849b',
    '250/8A, Tầm Vu, Hưng Lợi, Ninh Kiều, Cần Thơ',
    '0706839544',
    ''
  ),
  (
    2,
    'Trần Dần',
    'c4ca4238a0b923820dcc509a6f75849b',
    'Đường Ngô Đức Kế, phường Bến Nghé, quận 1, thành phố Hồ Chí Minh',
    '0701239544',
    ''
  ),
  (
    3,
    'Lê Thị Lài',
    'c4ca4238a0b923820dcc509a6f75849b',
    'Đường 3/2, Phường Xuân Khánh, Quận Ninh Kiều, Thành phố Cần Thơ.',
    '0703339544',
    ''
  );

-- --------------------------------------------------------
--
-- Table structure for table `nhanvien`
--
CREATE TABLE `nhanvien` (
  `MSNV` int(11) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `HoTenNV` varchar(50) DEFAULT NULL,
  `Password` varchar(32) DEFAULT NULL,
  `ChucVu` varchar(20) DEFAULT NULL,
  `DiaChi` varchar(50) DEFAULT NULL,
  `SoDienThoai` varchar(10) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `nhanvien`
--
INSERT INTO
  `nhanvien` (
    `MSNV`,
    `Username`,
    `HoTenNV`,
    `Password`,
    `ChucVu`,
    `DiaChi`,
    `SoDienThoai`
  )
VALUES
  (
    1,
    'admin',
    'Trần Thanh Hòa',
    'c4ca4238a0b923820dcc509a6f75849b',
    'Quản Trị',
    'Phú Thạnh A, Phú Quới, Long Hồ, Vĩnh Long',
    '0706839544'
  ),
  (
    2,
    'admin',
    'Đặng Quốc Đạt',
    'c4ca4238a0b923820dcc509a6f75849b',
    'Giám Đốc',
    '3/2, Tầm Vu, Hưng Lợi, Ninh Kiều, Cần Thơ',
    '0703219544'
  );

--
-- Indexes for dumped tables
--
--
-- Indexes for table `chitietdathang`
--
ALTER TABLE
  `chitietdathang`
ADD
  PRIMARY KEY (`SoDonDH`, `MSHH`),
ADD
  KEY `MSHH` (`MSHH`);

--
-- Indexes for table `dathang`
--
ALTER TABLE
  `dathang`
ADD
  PRIMARY KEY (`SoDonDH`),
ADD
  KEY `MSKH` (`MSKH`),
ADD
  KEY `MSNV` (`MSNV`);

--
-- Indexes for table `hanghoa`
--
ALTER TABLE
  `hanghoa`
ADD
  PRIMARY KEY (`MSHH`);

--
-- Indexes for table `hinhhh`
--
ALTER TABLE
  `hinhhh`
ADD
  PRIMARY KEY (`MaHinh`),
ADD
  KEY `MSHH` (`MSHH`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE
  `khachhang`
ADD
  PRIMARY KEY (`MSKH`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE
  `nhanvien`
ADD
  PRIMARY KEY (`MSNV`);

--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `dathang`
--
ALTER TABLE
  `dathang`
MODIFY
  `SoDonDH` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 6;

--
-- AUTO_INCREMENT for table `hanghoa`
--
ALTER TABLE
  `hanghoa`
MODIFY
  `MSHH` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 20;

--
-- AUTO_INCREMENT for table `hinhhh`
--
ALTER TABLE
  `hinhhh`
MODIFY
  `MaHinh` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 77;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE
  `khachhang`
MODIFY
  `MSKH` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE
  `nhanvien`
MODIFY
  `MSNV` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;

--
-- Constraints for dumped tables
--
--
-- Constraints for table `chitietdathang`
--
ALTER TABLE
  `chitietdathang`
ADD
  CONSTRAINT `chitietdathang_ibfk_1` FOREIGN KEY (`SoDonDH`) REFERENCES `dathang` (`SoDonDH`),
ADD
  CONSTRAINT `chitietdathang_ibfk_2` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`);

--
-- Constraints for table `dathang`
--
ALTER TABLE
  `dathang`
ADD
  CONSTRAINT `dathang_ibfk_1` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`),
ADD
  CONSTRAINT `dathang_ibfk_2` FOREIGN KEY (`MSNV`) REFERENCES `nhanvien` (`MSNV`);

--
-- Constraints for table `hinhhh`
--
ALTER TABLE
  `hinhhh`
ADD
  CONSTRAINT `hinhhh_ibfk_1` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;