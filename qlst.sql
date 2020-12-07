-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 27, 2020 lúc 11:24 AM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlst`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `benhnhan`
--

CREATE TABLE `benhnhan` (
  `MaBN` int(11) NOT NULL,
  `TenBN` varchar(255) NOT NULL,
  `SDT` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadonban`
--

CREATE TABLE `chitiethoadonban` (
  `MaThuoc` int(11) NOT NULL,
  `ThoiGian` datetime NOT NULL,
  `SoLuong` double NOT NULL,
  `MaHDB` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadonnhap`
--

CREATE TABLE `chitiethoadonnhap` (
  `MaHDN` int(11) NOT NULL,
  `MaThuoc` int(11) NOT NULL,
  `ThoiGian` datetime NOT NULL,
  `GiaNhap` double NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `LoThuoc` varchar(255) NOT NULL,
  `NgaySanXuat` date NOT NULL,
  `HanSuDung` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chitiethoadonnhap`
--

INSERT INTO `chitiethoadonnhap` (`MaHDN`, `MaThuoc`, `ThoiGian`, `GiaNhap`, `SoLuong`, `LoThuoc`, `NgaySanXuat`, `HanSuDung`) VALUES
(22, 5, '2020-11-19 10:46:20', 454, 4545, '54545', '2020-11-20', '2020-11-28'),
(24, 1, '2020-11-20 01:56:25', 454, 4545, '54545', '2020-11-13', '2020-12-06'),
(25, 2, '2020-11-20 09:01:25', 454, 4545, '54545', '2020-11-26', '2020-12-06'),
(26, 6, '2020-11-22 03:58:11', 45000, 4545, '345345', '2020-11-26', '2020-12-06'),
(27, 4, '2020-11-22 03:58:49', 45000, 4545, '54545', '2020-11-25', '2020-11-28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chucvu`
--

CREATE TABLE `chucvu` (
  `MaCV` int(11) NOT NULL,
  `TenCV` varchar(255) NOT NULL,
  `GhiChu` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chucvu`
--

INSERT INTO `chucvu` (`MaCV`, `TenCV`, `GhiChu`) VALUES
(1, 'GiamDoc', 'Giasm Đốc'),
(2, 'QuanLy', 'Quản lý'),
(3, 'TruongPhong', 'Trưởng phòng'),
(4, 'NhanVien', 'Nhân Viên'),
(5, 'KeToan', 'kế toán');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dangnhap`
--

CREATE TABLE `dangnhap` (
  `MaNV` int(11) NOT NULL,
  `TenDangNhap` varchar(255) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `MaSN` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `dangnhap`
--

INSERT INTO `dangnhap` (`MaNV`, `TenDangNhap`, `MatKhau`, `MaSN`) VALUES
(1, 'trongdac11', 'MTIz', ''),
(4, 'trongdac', 'MTIz', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donvitinh`
--

CREATE TABLE `donvitinh` (
  `MaDVT` int(11) NOT NULL,
  `TenDVT` varchar(255) NOT NULL,
  `GhiChu` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `donvitinh`
--

INSERT INTO `donvitinh` (`MaDVT`, `TenDVT`, `GhiChu`) VALUES
(1, 'Vỉ', 'Vỉ'),
(2, 'Hộp', 'Hộp'),
(3, 'Lọ', 'Vỉ'),
(4, 'Chai', 'Chai'),
(5, 'Túi', 'Túi'),
(6, 'tuýp', 'tuýp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadonban`
--

CREATE TABLE `hoadonban` (
  `MaHDB` int(11) NOT NULL,
  `MaNV` int(11) NOT NULL,
  `MaBN` int(11) NOT NULL,
  `TinhTrang` varchar(10) NOT NULL,
  `ThoiGian` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadonnhap`
--

CREATE TABLE `hoadonnhap` (
  `MaHDN` int(11) NOT NULL,
  `MaNV` int(11) NOT NULL,
  `MaNCC` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hoadonnhap`
--

INSERT INTO `hoadonnhap` (`MaHDN`, `MaNV`, `MaNCC`) VALUES
(22, 1, 1),
(24, 1, 1),
(25, 1, 2),
(26, 1, 3),
(27, 1, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `MaNCC` int(11) NOT NULL,
  `TenNCC` varchar(255) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `SDT` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhacungcap`
--

INSERT INTO `nhacungcap` (`MaNCC`, `TenNCC`, `DiaChi`, `SDT`) VALUES
(1, 'vutrongdac', 'nam định', '4444444444'),
(2, 'Quang Tuấn', 'Quang Tuấn', '090992928'),
(3, 'Thành Lộc', 'Thành Lộc', ''),
(4, 'Tuấn Tài', 'Tuấn Tài', ''),
(8, 'trongdac', 'sdfsdfsd', '4444444444');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MaNV` int(11) NOT NULL,
  `TenNV` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `SDT` varchar(10) NOT NULL,
  `SoCMT` varchar(16) NOT NULL,
  `HinhAnh` varchar(255) NOT NULL,
  `MaCV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`MaNV`, `TenNV`, `Email`, `DiaChi`, `SDT`, `SoCMT`, `HinhAnh`, `MaCV`) VALUES
(1, 'Vũ Trọng Đắc', 'it1k58utc@gmail.com', 'Nam Định', '0945240518', '036099001356', 'nv01.jpg', 1),
(3, 'Trần Cao Phong', 'tcphong1911@gmail.com', 'Nghĩa Hung Nam Định', '0392084912', '036099001356', 'nv20.jpg', 5),
(4, 'Lê Hải Đăng', 'haidangle.nd@gmail.com', 'hà nội', '0367053759', '54545', 'nv04.jpg', 4),
(5, 'Nguyễn Đình Tâm', 'dinhtam@gmail.com', 'Hưng Yên', '0835795554', '09567654', 'nv03.jpg', 2),
(6, 'Cao Thu Ngân', 'thungan@gmail.com', 'Thái Bình', '0966365780', '09567654343', 'nv04.jpg', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhasanxuat`
--

CREATE TABLE `nhasanxuat` (
  `MaNSX` int(11) NOT NULL,
  `TenNSX` varchar(255) NOT NULL,
  `GhiChu` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhasanxuat`
--

INSERT INTO `nhasanxuat` (`MaNSX`, `TenNSX`, `GhiChu`) VALUES
(1, 'Eaple', 'Eales'),
(2, 'Nam Hà', 'Nam Hà'),
(3, 'Vingroup', 'Vingroup'),
(4, 'Tasle', 'Tasle'),
(5, 'tuýp', 'sdfsdfsd');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhomthuoc`
--

CREATE TABLE `nhomthuoc` (
  `MaNT` int(11) NOT NULL,
  `TenNT` varchar(255) NOT NULL,
  `GhiChu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhomthuoc`
--

INSERT INTO `nhomthuoc` (`MaNT`, `TenNT`, `GhiChu`) VALUES
(1, 'trongdac', 'sfsdf'),
(2, 'Thục phẩm chức năng', 'Thực phẩm chức năng'),
(3, 'Dạ Dày', 'Dạ dày'),
(4, 'Kháng sinh', 'Kháng sinh'),
(5, 'Kháng viêm', 'Kháng viêm'),
(6, 'Tiêu Hóa', 'Tiêu hóa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thuoc`
--

CREATE TABLE `thuoc` (
  `MaThuoc` int(11) NOT NULL,
  `MaNSX` int(11) NOT NULL,
  `MaDVT` int(11) NOT NULL,
  `MaNT` int(11) NOT NULL,
  `GiaBan` double NOT NULL,
  `TenThuoc` varchar(255) NOT NULL,
  `GhiChu` varchar(255) NOT NULL,
  `HinhAnh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `thuoc`
--

INSERT INTO `thuoc` (`MaThuoc`, `MaNSX`, `MaDVT`, `MaNT`, `GiaBan`, `TenThuoc`, `GhiChu`, `HinhAnh`) VALUES
(1, 1, 2, 3, 60000, 'Clopheniramin', 'Clopheniramin', 'sp01.jpg'),
(2, 1, 2, 3, 60000, 'Acetylcyctein ', 'Acetylcyctein ', 'sp02.jpg'),
(3, 1, 2, 3, 60000, 'paracetamol ', 'paracetamol ', 'sp03.jpg'),
(4, 1, 2, 3, 60000, 'Bromhexin', 'Bromhexin', 'sp04.jpg'),
(5, 1, 2, 3, 60000, 'Lansoprazol', 'Lansoprazol', 'sp05.jpg'),
(6, 2, 4, 2, 1880000, 'Ranitidine', 'Ranitidine', 'sp06.jpg'),
(7, 2, 4, 2, 180000, 'Yumagel', 'Yumagel', 'sp07.jpg'),
(8, 2, 4, 2, 9880000, 'Antacil', 'Antacil', 'sp08.jpg'),
(9, 2, 4, 2, 480000, 'Photphalugel', 'Photphalugel', 'sp09.jpg'),
(10, 2, 4, 2, 1880000, 'Famotidine', 'Famotidine', 'sp10.jpg'),
(11, 5, 2, 4, 500000, 'Enterogemina', 'enterogemina', 'sp11.jpg'),
(12, 5, 2, 4, 500000, 'Hidrasec', 'Hidrasec', 'sp12.jpg'),
(13, 5, 2, 4, 500000, 'Neopeptine', 'Neopeptine', 'sp13.jpg'),
(14, 5, 2, 4, 500000, 'Lactomin', 'Lactomin', 'sp14.jpg'),
(15, 5, 2, 4, 500000, 'Probio', 'Probio', 'sp15.jpg'),
(16, 2, 2, 5, 67000, 'Loperamid', 'Loperamid', 'sp16.jpg'),
(17, 2, 2, 5, 67000, 'Conversyl', 'Conversyl', 'sp17.jpg'),
(18, 2, 2, 5, 97000, 'Bisoprolol', 'Bisoprolol', 'sp18.jpg'),
(19, 2, 2, 5, 22000, 'Orgamantril', 'Orgamantril', 'sp19.jpg'),
(20, 2, 2, 5, 87000, 'Alverin', 'Alverin', 'sp20.jpg'),
(21, 2, 4, 1, 54000, 'Vastarel ', 'Vastarel ', 'sp21.jpg'),
(22, 2, 4, 1, 54000, 'Regulon ', 'Regulon ', 'sp22.jpg'),
(23, 2, 4, 1, 54000, 'Metfotmin ', 'Metfotmin ', 'sp23.jpg'),
(24, 2, 4, 1, 54000, 'Atorvastatin ', 'Atorvastatin ', 'sp24.jpg'),
(25, 2, 4, 1, 54000, 'Rosuvastatin ', 'Rosuvastatin ', 'sp25.jpg'),
(26, 2, 5, 2, 67000, 'Newlevo ', 'Newlevo ', 'sp26.jpg'),
(27, 2, 5, 2, 67000, 'noubiron ', 'noubiron ', 'sp27.jpg'),
(28, 2, 5, 2, 67000, 'Fluconazol ', 'Fluconazol ', 'sp28.jpg'),
(29, 2, 5, 2, 67000, 'Itraconazol ', 'Itraconazol ', 'sp29.jpg'),
(30, 2, 5, 2, 67000, 'Nystatin ', 'Nystatin ', 'sp30.jpg'),
(31, 2, 5, 2, 67000, 'Griseofulvin ', 'Griseofulvin ', 'sp31.jpg'),
(32, 2, 5, 2, 67000, 'Mercilon ', 'Mercilon ', 'sp32.jpg'),
(33, 2, 1, 1, 545, 'asdad', 'sfsdf', 'nv09.jpg'),
(34, 1, 2, 2, 545, 'asdad', 'sfsdf', 'sp01.jpg'),
(35, 1, 1, 1, 545, 'asdad', 'sfsdf', 'sp32.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `benhnhan`
--
ALTER TABLE `benhnhan`
  ADD PRIMARY KEY (`MaBN`);

--
-- Chỉ mục cho bảng `chitiethoadonban`
--
ALTER TABLE `chitiethoadonban`
  ADD KEY `PK_ChiTietHoaDonBan_Thuoc` (`MaThuoc`),
  ADD KEY `PK_ChiTietHoaDonBan_HoaDonBan` (`MaHDB`);

--
-- Chỉ mục cho bảng `chitiethoadonnhap`
--
ALTER TABLE `chitiethoadonnhap`
  ADD PRIMARY KEY (`MaHDN`),
  ADD KEY `PK_ChiTietHoaDonNhap_Thuoc` (`MaThuoc`);

--
-- Chỉ mục cho bảng `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`MaCV`);

--
-- Chỉ mục cho bảng `dangnhap`
--
ALTER TABLE `dangnhap`
  ADD PRIMARY KEY (`MaNV`);

--
-- Chỉ mục cho bảng `donvitinh`
--
ALTER TABLE `donvitinh`
  ADD PRIMARY KEY (`MaDVT`);

--
-- Chỉ mục cho bảng `hoadonban`
--
ALTER TABLE `hoadonban`
  ADD PRIMARY KEY (`MaHDB`),
  ADD KEY `PK_HoaDonBan_BenhNhan` (`MaBN`),
  ADD KEY `PK_HoaDonBan_NhanVien` (`MaNV`);

--
-- Chỉ mục cho bảng `hoadonnhap`
--
ALTER TABLE `hoadonnhap`
  ADD PRIMARY KEY (`MaHDN`),
  ADD KEY `PK_HoaDonNhap_NhaCungCap` (`MaNCC`),
  ADD KEY `PK_HoaDonNhap_NhanVien` (`MaNV`);

--
-- Chỉ mục cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`MaNCC`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNV`),
  ADD KEY `PK_NhanVien_ChucVu` (`MaCV`);

--
-- Chỉ mục cho bảng `nhasanxuat`
--
ALTER TABLE `nhasanxuat`
  ADD PRIMARY KEY (`MaNSX`);

--
-- Chỉ mục cho bảng `nhomthuoc`
--
ALTER TABLE `nhomthuoc`
  ADD PRIMARY KEY (`MaNT`);

--
-- Chỉ mục cho bảng `thuoc`
--
ALTER TABLE `thuoc`
  ADD PRIMARY KEY (`MaThuoc`),
  ADD KEY `PK_Thuoc_NhomThuoc` (`MaNT`),
  ADD KEY `PK_Thuoc_NhaSanXuat` (`MaNSX`),
  ADD KEY `PK_Thuoc_DonViTinh` (`MaDVT`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `benhnhan`
--
ALTER TABLE `benhnhan`
  MODIFY `MaBN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT cho bảng `chucvu`
--
ALTER TABLE `chucvu`
  MODIFY `MaCV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `donvitinh`
--
ALTER TABLE `donvitinh`
  MODIFY `MaDVT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `hoadonban`
--
ALTER TABLE `hoadonban`
  MODIFY `MaHDB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT cho bảng `hoadonnhap`
--
ALTER TABLE `hoadonnhap`
  MODIFY `MaHDN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  MODIFY `MaNCC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MaNV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `nhasanxuat`
--
ALTER TABLE `nhasanxuat`
  MODIFY `MaNSX` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `nhomthuoc`
--
ALTER TABLE `nhomthuoc`
  MODIFY `MaNT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `thuoc`
--
ALTER TABLE `thuoc`
  MODIFY `MaThuoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitiethoadonban`
--
ALTER TABLE `chitiethoadonban`
  ADD CONSTRAINT `PK_ChiTietHoaDonBan_HoaDonBan` FOREIGN KEY (`MaHDB`) REFERENCES `hoadonban` (`MaHDB`),
  ADD CONSTRAINT `PK_ChiTietHoaDonBan_Thuoc` FOREIGN KEY (`MaThuoc`) REFERENCES `thuoc` (`MaThuoc`);

--
-- Các ràng buộc cho bảng `chitiethoadonnhap`
--
ALTER TABLE `chitiethoadonnhap`
  ADD CONSTRAINT `PK_ChiTietHoaDonNhap_HoaDonNhap` FOREIGN KEY (`MaHDN`) REFERENCES `hoadonnhap` (`MaHDN`),
  ADD CONSTRAINT `PK_ChiTietHoaDonNhap_Thuoc` FOREIGN KEY (`MaThuoc`) REFERENCES `thuoc` (`MaThuoc`);

--
-- Các ràng buộc cho bảng `dangnhap`
--
ALTER TABLE `dangnhap`
  ADD CONSTRAINT `PK_DangNhap_NhanVien` FOREIGN KEY (`MaNV`) REFERENCES `nhanvien` (`MaNV`);

--
-- Các ràng buộc cho bảng `hoadonban`
--
ALTER TABLE `hoadonban`
  ADD CONSTRAINT `PK_HoaDonBan_BenhNhan` FOREIGN KEY (`MaBN`) REFERENCES `benhnhan` (`MaBN`),
  ADD CONSTRAINT `PK_HoaDonBan_NhanVien` FOREIGN KEY (`MaNV`) REFERENCES `nhanvien` (`MaNV`);

--
-- Các ràng buộc cho bảng `hoadonnhap`
--
ALTER TABLE `hoadonnhap`
  ADD CONSTRAINT `PK_HoaDonNhap_NhaCungCap` FOREIGN KEY (`MaNCC`) REFERENCES `nhacungcap` (`MaNCC`),
  ADD CONSTRAINT `PK_HoaDonNhap_NhanVien` FOREIGN KEY (`MaNV`) REFERENCES `nhanvien` (`MaNV`);

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `PK_NhanVien_ChucVu` FOREIGN KEY (`MaCV`) REFERENCES `chucvu` (`MaCV`);

--
-- Các ràng buộc cho bảng `thuoc`
--
ALTER TABLE `thuoc`
  ADD CONSTRAINT `PK_Thuoc_DonViTinh` FOREIGN KEY (`MaDVT`) REFERENCES `donvitinh` (`MaDVT`),
  ADD CONSTRAINT `PK_Thuoc_NhaSanXuat` FOREIGN KEY (`MaNSX`) REFERENCES `nhasanxuat` (`MaNSX`),
  ADD CONSTRAINT `PK_Thuoc_NhomThuoc` FOREIGN KEY (`MaNT`) REFERENCES `nhomthuoc` (`MaNT`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
