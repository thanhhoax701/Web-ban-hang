-- ALTER TABLE nhanvien AUTO_INCREMENT=1;
-- create database Quanlydathang;
create table KhachHang(
    MSKH int primary key AUTO_INCREMENT,
    HoTenKH varchar(50),
    Password varchar(32),
    DiaChi varchar(200),
    SoDienThoai varchar(10),
    facebook_user_id varchar(50)
);

create table NhanVien(
    MSNV int primary key AUTO_INCREMENT,
    Username varchar(50),
    HoTenNV varchar(50),
    Password varchar(32),
    ChucVu varchar(20),
    DiaChi varchar(50),
    SoDienThoai varchar(10)
);

create table HangHoa(
    MSHH int primary key AUTO_INCREMENT,
    TenHH varchar(50),
    MoTaHH varchar(500),
    Gia float,
    SoLuongHang int,
    GhiChu varchar(50)
);

create table hinhHH(
    MSHH int,
    MaHinh int primary key AUTO_INCREMENT,
    TenHinh varchar(50),
    FOREIGN KEY (MSHH) references HangHoa(MSHH)
);

create table DatHang(
    SoDonDH int primary key AUTO_INCREMENT,
    MSKH int,
    MSNV int,
    NgayDH date check (NgayDH <= NgayGH),
    NgayGH date,
    TrangthaiDH varchar(20),
    FOREIGN KEY (MSKH) references KhachHang(MSKH),
    FOREIGN KEY (MSNV) references NhanVien(MSNV)
);

create table ChiTietDatHang (
    SoDonDH int,
    MSHH int,
    SoLuong int,
    GiaDatHang float,
    GiamGia float,
    Primary key(SoDonDH, MSHH),
    FOREIGN KEY (SoDonDH) references DatHang(SoDonDH),
    FOREIGN KEY (MSHH) references HangHoa(MSHH)
);

CREATE TRIGGER check_ngaydh_insert BEFORE
INSERT
    ON dathang FOR EACH ROW BEGIN IF NEW.NgayDH > NEW.NgayGH THEN
INSERT INTO
    dathang (SoDonDH, MSKH, MSNV, NgayDH, NgayGH, TrangThaiDH)
VALUES
    (
        NEW.SoDonDH,
        NEW.MSKH,
        NEW.MSNV,
        NEW.NgayDH,
        NEW.NgayGH,
        NEW.TrangThaiDH
    );

END IF;

END CREATE TRIGGER 'check_ngaydh_update' BEFORE
UPDATE
    ON 'dathang' FOR EACH ROW BEGIN IF NEW.NgayDH > NEW.NgayGH THEN
INSERT INTO
    dathang (SoDonDH, MSKH, MSNV, NgayDH, NgayGH, TrangThaiDH)
VALUES
    (
        NEW.SoDonDH,
        NEW.MSKH,
        NEW.MSNV,
        NEW.NgayDH,
        NEW.NgayGH,
        NEW.TrangThaiDH
    );

END IF;

END CREATE TRIGGER 'check_soluonghang_xoa'
AFTER
    DELETE ON 'dathang' FOR EACH ROW BEGIN
UPDATE
    hanghoa
SET
    SoLuongHang = SoLuongHang + (
        SELECT
            SoLuong
        FROM
            chitietdathang
        WHERE
            chitietdathang.MSHH = hanghoa.MSHH
    )
WHERE
    chitietdathang.MSHH = hanghoa.MSHH;

END CREATE TRIGGER 'check_soluonghang_sua'
AFTER
UPDATE
    ON 'hanghoa' FOR EACH ROW BEGIN
UPDATE
    hanghoa
SET
    SoLuongHang = SoLuongHang - (
        SELECT
            SoLuong
        FROM
            chitietdathang
        WHERE
            chitietdathang.MSHH = hanghoa.MSHH
    ) +(
        SELECT
            SoLuong
        FROM
            chitietdathang
        WHERE
            chitietdathang.MSHH = hanghoa.MSHH
    )
WHERE
    chitietdathang.MSHH = hanghoa.MSHH;

END CREATE TRIGGER 'check_soluonghang_them'
AFTER
INSERT
    ON 'hanghoa' FOR EACH ROW BEGIN
UPDATE
    hanghoa
SET
    SoLuongHang = SoLuongHang - (
        SELECT
            SoLuong
        FROM
            chitietdathang
        WHERE
            chitietdathang.MSHH = hanghoa.MSHH
    )
WHERE
    chitietdathang.MSHH = hanghoa.MSHH;

END