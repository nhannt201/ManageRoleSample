-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 15, 2022 lúc 02:25 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `demo_csdl`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `user_id` int(11) NOT NULL,
  `username` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`user_id`, `username`, `password`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'baocao', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'dbc', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `construction`
--

CREATE TABLE `construction` (
  `cons_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `date_report` date NOT NULL,
  `date_approve` date NOT NULL,
  `user_report` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sheet_link` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `construction`
--

INSERT INTO `construction` (`cons_id`, `name`, `date_report`, `date_approve`, `user_report`, `sheet_link`) VALUES
(2, 'Công trình A', '2002-12-02', '0000-00-00', '1', ''),
(6, 'Công trình 2002', '2001-06-12', '0000-00-00', '2', ''),
(7, 'New gen', '2022-08-08', '0000-00-00', '2', ''),
(8, 'cong trình 123', '2022-08-08', '0000-00-00', '2', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `construction_content`
--

CREATE TABLE `construction_content` (
  `content_id` int(11) NOT NULL,
  `cons_id` int(11) NOT NULL,
  `date_send_content` date NOT NULL,
  `date_approve_content` date NOT NULL,
  `stage_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `hard_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `suggest` text COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `user_report_content` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_approve_content` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `construction_content`
--

INSERT INTO `construction_content` (`content_id`, `cons_id`, `date_send_content`, `date_approve_content`, `stage_desc`, `hard_desc`, `suggest`, `comment`, `user_report_content`, `user_approve_content`) VALUES
(4, 6, '2022-08-08', '0000-00-00', 'oje 123', '5555', '666', '77777', '2', ''),
(5, 7, '2022-08-08', '0000-00-00', 'New demo', '1234', '569', '10', '2', ''),
(6, 8, '2022-08-08', '0000-00-00', '123', '123', '123\r\ndsds', '12333', '2', ''),
(7, 8, '2022-08-08', '0000-00-00', 'moi', 'moi', 'moi', 'moi', '2', ''),
(8, 8, '2022-08-08', '0000-00-00', 'moi 2', 'moi 2', 'moi 2', 'moi 2', '2', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `information`
--

CREATE TABLE `information` (
  `info_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `information`
--

INSERT INTO `information` (`info_id`, `user_id`, `fullname`, `email`, `status`, `role`) VALUES
(1, 1, 'Admin Manager', 'trungnhan21.12@gmail.com', 1, 0),
(2, 2, 'Le Van Tam', 'baocao@gmail.com', 1, 1),
(3, 3, 'dbc', 'dbc@gmail.com', 0, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `role` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`role`, `name`) VALUES
(0, 'Admin'),
(1, 'Nhập báo cáo'),
(2, 'Duyệt báo cáo');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `construction`
--
ALTER TABLE `construction`
  ADD PRIMARY KEY (`cons_id`);

--
-- Chỉ mục cho bảng `construction_content`
--
ALTER TABLE `construction_content`
  ADD PRIMARY KEY (`content_id`);

--
-- Chỉ mục cho bảng `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`info_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `construction`
--
ALTER TABLE `construction`
  MODIFY `cons_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `construction_content`
--
ALTER TABLE `construction_content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `information`
--
ALTER TABLE `information`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `role`
--
ALTER TABLE `role`
  MODIFY `role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
