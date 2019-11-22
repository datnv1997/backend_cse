-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 24, 2019 lúc 08:28 PM
-- Phiên bản máy phục vụ: 10.3.16-MariaDB
-- Phiên bản PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_khoacntt`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bai-giang`
--

CREATE TABLE `bai-giang` (
  `id` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `idSubject` varchar(100) NOT NULL,
  `nameSubject` varchar(100) DEFAULT NULL,
  `idCreator` varchar(200) NOT NULL,
  `createdDate` date DEFAULT current_timestamp(),
  `detail` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bo-mon`
--

CREATE TABLE `bo-mon` (
  `mbm` varchar(100) NOT NULL,
  `name` varchar(300) NOT NULL,
  `khoa` varchar(100) NOT NULL DEFAULT 'cntt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi-tiet-bai-viet`
--

CREATE TABLE `chi-tiet-bai-viet` (
  `id` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `subDescription` varchar(100) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `idCategory` varchar(20) NOT NULL,
  `idCreator` varchar(100) NOT NULL,
  `createdDate` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cong-trinh-cong-bo`
--

CREATE TABLE `cong-trinh-cong-bo` (
  `id` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `author` varchar(200) NOT NULL,
  `tapChi` varchar(200) DEFAULT NULL,
  `year` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh-sach-bai-viet`
--

CREATE TABLE `danh-sach-bai-viet` (
  `id` varchar(100) NOT NULL,
  `name` varchar(300) NOT NULL,
  `subDescription` varchar(1000) DEFAULT NULL,
  `idCreator` varchar(100) NOT NULL,
  `idCategory` varchar(100) NOT NULL,
  `createdDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh-sach-diem-danh`
--

CREATE TABLE `danh-sach-diem-danh` (
  `id` int(11) DEFAULT NULL,
  `msv` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `idLopHocPhan` varchar(100) NOT NULL,
  `idgv` varchar(100) NOT NULL,
  `dateAttendance` date NOT NULL DEFAULT current_timestamp(),
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detai-duan`
--

CREATE TABLE `detai-duan` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `startDat` date NOT NULL,
  `endDay` date NOT NULL,
  `deTaiCap` varchar(200) DEFAULT NULL,
  `nguoiThucHien` varchar(200) NOT NULL,
  `position` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giao-vien`
--

CREATE TABLE `giao-vien` (
  `mgv` varchar(100) NOT NULL,
  `name` varchar(300) NOT NULL,
  `email` varchar(200) NOT NULL,
  `boMon` varchar(200) NOT NULL,
  `capBac` varchar(200) DEFAULT NULL,
  `birthDay` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `giao-vien`
--

INSERT INTO `giao-vien` (`mgv`, `name`, `email`, `boMon`, `capBac`, `birthDay`) VALUES
('021E8A9A-E2FF-C720-ABD5-A46072536736', 'Kasper', 'ipsum.ac.mi@dapibusrutrum.co.uk', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2018-09-30'),
('0244F3B2-48D0-157C-523C-1933819F23DC', 'Elmo', 'Proin.dolor@tincidunt.edu', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et', '', '2018-12-21'),
('02A9AA19-5525-5ADC-42AA-71BDC94F4634', 'Kuame', 'iaculis@arcuNuncmauris.com', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2020-03-26'),
('0AA6B9D4-875E-A09F-03A5-72E8BE7FEACC', 'Dane', 'Nulla@Maecenasornareegestas.edu', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing', '', '2019-08-03'),
('0AC81C26-13CE-1124-323C-5703B835B529', 'Patrick', 'Sed@Duismienim.ca', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor.', '', '2020-04-23'),
('0B55E34D-CD99-DBB3-00FD-047E87ABD31D', 'Prescott', 'vulputate.lacus@Duisami.com', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2018-10-25'),
('0EC3F1F1-ED44-BCE7-350A-4DBFEA1745DC', 'Hashim', 'id.risus@iaculis.org', 'Lorem ipsum dolor sit', '', '2018-09-13'),
('10392D56-00B6-8F4F-5A68-F0C01B616104', 'Gage', 'nisi.a.odio@miAliquam.ca', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2018-12-29'),
('11C23F32-75FE-153C-A2E6-B87A41AE2784', 'Cruz', 'Vestibulum.ante.ipsum@ullamcorpervelitin.co.uk', 'Lorem ipsum dolor sit', '', '2020-06-04'),
('11E6EFCB-063A-DB9A-6457-31330BC1707A', 'Curran', 'euismod.est@faucibus.edu', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-12-18'),
('14340FA5-1E50-83EF-F9A0-8D90F394E283', 'Micah', 'parturient.bo-montes@Morbiquis.net', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis', '', '2019-12-30'),
('187AA604-59F3-D154-7BAA-116A9D7D40BE', 'Fritz', 'sit.amet@ullamcorper.com', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2020-05-04'),
('1A41C6CA-F1EE-3F04-B29F-A4DFA0839A71', 'Ralph', 'ac.turpis@penatibuset.co.uk', 'Lorem ipsum', '', '2019-11-21'),
('1BA8036F-6F1A-9ABC-E16A-190C7D10F974', 'Quinn', 'a@euaccumsansed.org', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur', '', '2020-02-22'),
('1ECB2715-BA5E-B4BC-E256-905C157715E9', 'Keith', 'consectetuer.adipiscing.elit@Namligula.co.uk', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2018-10-17'),
('1EF08358-7079-CA82-B91D-FCC9D1A40ACA', 'Dale', 'nec.tempus@maurissagittis.net', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam', '', '2019-04-12'),
('219BE005-1835-D2D7-6C13-B7CBF2421EB4', 'Alvin', 'pede.Suspendisse.dui@anteipsum.edu', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien,', '', '2020-05-20'),
('21AF0EA0-70F8-0933-5D1E-67D32C7FDD21', 'Travis', 'et.risus@neceuismod.edu', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed', '', '2020-06-19'),
('258F405B-5F0D-C6EA-1249-13C102B8C6C0', 'Kamal', 'a@cursuset.net', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed', '', '2018-11-18'),
('2AAFA2B2-59E4-0221-3A39-49D5F658FE61', 'Quamar', 'pharetra.nibh.Aliquam@cursus.edu', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2018-11-11'),
('2D404D91-0C60-C716-9E3B-FDF9C13A5607', 'Tucker', 'bo-montes@lectusquis.ca', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing', '', '2020-01-11'),
('2F65477B-AB55-E103-C730-B3ACD203679E', 'Sibo-mon', 'adipiscing.elit@ridiculus.co.uk', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at', '', '2019-09-13'),
('306AED5C-1A78-6429-5F9F-3DB8FEF16973', 'Joseph', 'lorem.ac.risus@Curabitursed.net', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-08-22'),
('32195F80-57AF-80E5-732C-F5EB3D4F7BBE', 'Ezra', 'eleifend.non@dictumauguemalesuada.net', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2018-12-25'),
('35BCBBF8-669F-5C42-A553-77DD9935FBFA', 'Elton', 'et.commodo.at@dolorDonecfringilla.org', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-03-04'),
('36BB5CF2-E7C0-3837-A539-F1F8DAD348B4', 'Aladdin', 'tellus@risus.com', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-09-11'),
('37DD1BB1-A501-7F73-F8D5-5EEEC721DBCA', 'Alfonso', 'sapien@Cumsociis.edu', 'Lorem ipsum dolor sit amet, consectetuer', '', '2020-01-04'),
('3C7BA64A-AE15-6058-0B30-B0583FFE2180', 'Amal', 'nec.enim@cursus.edu', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-12-20'),
('3ECE779E-2765-31B5-97B2-E893FA0B553F', 'Mason', 'tempor.est@eueuismodac.net', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor.', '', '2019-09-17'),
('41D3636F-ADE3-EC1A-B224-F24653257058', 'Abdul', 'turpis.nec@velitAliquamnisl.ca', 'Lorem', '', '2018-10-21'),
('4809DCC1-0554-7AD8-ACEB-9E1DF3A5D3D0', 'Nolan', 'scelerisque@magnaDuis.com', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur', '', '2018-12-12'),
('484DF8C7-0655-692E-A822-383AFFEC4EE1', 'Dale', 'urna@arcuVivamus.net', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-07-29'),
('48BAF6CC-4E44-0A83-4406-1863F554593B', 'Amery', 'nulla@acarcu.org', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-07-26'),
('499CEFDB-E34D-A654-EC2E-D72A84759E3B', 'Marvin', 'Pellentesque.ultricies.dignissim@Nuncsollicitudincommodo.org', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-12-21'),
('4D33E711-5671-F930-AFAA-6758E5AEE034', 'Cole', 'fermentum.convallis.ligula@diam.org', 'Lorem ipsum dolor', '', '2019-11-20'),
('4EDF8DE0-FEA6-D6A1-99B0-2ACE924577F2', 'Fulton', 'Quisque.fringilla@pedeac.net', 'Lorem ipsum dolor sit amet,', '', '2020-04-13'),
('4F0924E0-FC47-6D31-FF37-FFBF003D31CF', 'Orlando', 'est.Nunc@quisaccumsanconvallis.ca', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', '', '2019-04-26'),
('507957FF-A81A-AEF1-2F7C-E8180FF2562B', 'Ignatius', 'primis@est.ca', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-07-17'),
('5377EEAE-58B3-B125-9F18-D6175173E1F3', 'Lamar', 'ut@Maecenasornare.ca', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien,', '', '2019-04-26'),
('55F8B095-DDE9-F940-D444-94103D9D4C30', 'Caldwell', 'eu.elit.Nulla@interdumenim.co.uk', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-06-09'),
('59C7F9FF-0A9E-46F7-C12B-EC2D95F699DD', 'Andrew', 'senectus.et@ac.co.uk', 'Lorem ipsum dolor', '', '2019-05-05'),
('5DAFDAD3-C1EC-9755-48E8-F519BDDDC220', 'Sawyer', 'Duis.dignissim.tempor@ametrisusDonec.net', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', '', '2019-02-27'),
('5DC70B0E-D3BF-6929-46CF-8F53CFDF3F92', 'Tarik', 'amet.consectetuer@Suspendisse.com', 'Lorem ipsum dolor sit amet, consectetuer adipiscing', '', '2020-03-14'),
('5F4BA216-89D0-4AC1-48EF-79E997AF3F49', 'Basil', 'luctus@ac.com', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis', '', '2018-10-11'),
('5FA732AD-44D7-7C7C-439F-48A60CF8ABC4', 'Norman', 'sodales.elit.erat@inaliquet.net', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-04-17'),
('620E918C-7EA1-7A90-C6D4-91D020064B96', 'Mark', 'Mauris.vel.turpis@fermentum.com', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus', '', '2019-07-06'),
('6402EC45-802B-6AE3-3734-40EEC924FFE6', 'Jason', 'Duis.sit.amet@acfeugiat.com', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut', '', '2018-10-18'),
('645058B7-DDA2-423A-6BC4-BFAFB3A1E0FC', 'Hu', 'dictum@eu.edu', 'Lorem ipsum dolor sit amet, consectetuer adipiscing', '', '2019-04-06'),
('68419144-3A4F-A32E-1806-3096E911A21E', 'Quentin', 'accumsan.laoreet@quamPellentesquehabitant.ca', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-11-26'),
('6882555D-8A71-F58F-A797-8602C92461EF', 'Brennan', 'Nunc.sed.orci@nequevenenatis.ca', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2018-09-22'),
('6B0CB596-A44F-7241-9F53-B03E000CAC74', 'Macon', 'nec.urna@mauris.edu', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor.', '', '2019-12-24'),
('73E6893E-A0C0-994F-51F5-86899C4959F1', 'Galvin', 'ipsum.porta.elit@loremloremluctus.co.uk', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-09-28'),
('75EE57CB-5714-A43D-FED6-D871DCC4591C', 'Nicholas', 'Morbi.vehicula@egestaslaciniaSed.com', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-04-16'),
('76C7F0B3-11F2-1D05-AFEB-5EBDDCA2AA96', 'Myles', 'nisl.sem.consequat@acliberonec.ca', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-09-21'),
('76FA618A-6E89-A248-C649-7D0D131596D0', 'Octavius', 'eros@ultrices.ca', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna', '', '2020-02-15'),
('7D131603-C6AB-A81F-D52F-179883FA1A7C', 'Kareem', 'nisi.Aenean.eget@Cumsociisnatoque.co.uk', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien,', '', '2019-02-13'),
('7D455FBE-EC58-7853-C85D-7468B9FDBA61', 'Dale', 'dictum.eu.eleifend@velfaucibusid.edu', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2020-01-01'),
('838790E0-1C96-D00B-751D-D54AC88C1D0E', 'Ralph', 'ullamcorper.Duis.cursus@velitCras.ca', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer', '', '2019-02-07'),
('8B95A09D-2348-8A8B-7000-C24214AA9F26', 'Nathan', 'mauris.rhoncus@vehiculaaliquetlibero.co.uk', 'Lorem ipsum dolor sit amet, consectetuer', '', '2020-04-17'),
('8D5C1946-9783-731D-F043-87F3181090DD', 'Shad', 'Nullam.nisl.Maecenas@diameudolor.net', 'Lorem ipsum dolor sit amet, consectetuer', '', '2019-04-11'),
('8D880CF3-EC95-8ECD-3129-5213575C5482', 'Gary', 'vestibulum.nec.euismod@lacusAliquamrutrum.edu', 'Lorem ipsum dolor sit', '', '2019-02-07'),
('8EB63B87-0981-6A39-1383-A55CD3F8F223', 'Mannix', 'eget.laoreet.posuere@duiquis.edu', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-11-04'),
('90504769-481B-68D9-A492-BADF03A2E358', 'Kato', 'ante.blandit@mauris.org', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-12-12'),
('907351EE-917F-BED2-0F8A-48BB03996F20', 'Myles', 'morbi.tristique.senectus@eutellusPhasellus.com', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus', '', '2019-08-28'),
('91C41AC4-2448-03EE-FB6B-55DD8D8BC3B1', 'Chancellor', 'elit.Nulla@eleifend.net', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2018-12-11'),
('94A8256D-6F0C-6552-5CC2-7223649A9488', 'Clayton', 'ipsum.dolor@laoreet.edu', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna', '', '2020-03-03'),
('A04F681D-218B-C139-647C-6942243EB1A7', 'Jerome', 'Nunc@tortorat.org', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper.', '', '2019-01-05'),
('A12D74C5-5512-B077-DC9C-808308AC5DFF', 'Peter', 'Donec@Mauriseuturpis.edu', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-05-11'),
('A14AC8E7-4610-1121-9B03-65BDF1433695', 'Cole', 'tristique.neque@tellus.org', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-11-23'),
('A15249F4-F8FE-C2BA-8F14-0C038D83D968', 'Caldwell', 'ullamcorper.nisl@vulputatevelit.net', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2020-09-09'),
('A26F4736-AA5B-89CB-B5EB-4536970CB775', 'Jamal', 'Mauris@semperrutrum.net', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2020-06-20'),
('A31140F3-6B07-D044-98E4-58D418693E3D', 'Zachery', 'Duis.sit.amet@mauris.edu', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-11-19'),
('A33B9929-0356-75E4-476A-8F8063DFC29E', 'Hammett', 'fringilla.Donec@NullamnislMaecenas.org', 'Lorem', '', '2020-07-22'),
('A93AD9BC-36B1-F9D7-D668-79CAA21C922C', 'Kareem', 'tempus.risus.Donec@luctus.edu', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-08-24'),
('AEA9C7DF-1627-D3A2-0A39-58967B9ABCFB', 'Chancellor', 'neque.venenatis@luctus.co.uk', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque', '', '2019-05-05'),
('AF1F2D95-8BCC-1D49-62EB-C1F80955D765', 'Barrett', 'facilisis@etmagna.co.uk', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque', '', '2018-11-09'),
('B11048A0-B85C-AB05-0BF5-F467463AE2FE', 'Callum', 'tristique.neque@nec.edu', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at', '', '2018-10-29'),
('B2AFD4BC-70D1-C6EA-E474-CFE33C06BAE0', 'Len', 'tincidunt@rhoncusidmollis.edu', 'Lorem ipsum dolor sit amet,', '', '2018-11-06'),
('BFBDC472-6609-C8C1-452A-FCC18E49DE56', 'Rooney', 'tellus.Suspendisse.sed@odio.org', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque', '', '2019-04-04'),
('C068DE2E-DF4C-3BAA-6FB1-3D9F5264DEDD', 'Edward', 'sagittis.augue@gravidanon.ca', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2020-06-02'),
('C305E31E-136B-27E6-8404-E1D67EDDBEC6', 'Mohammad', 'lorem.fringilla.ornare@atsem.org', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur', '', '2019-02-09'),
('C57AE7BB-9B85-7CFD-653C-DC42330E01CD', 'Brennan', 'gravida@enimdiam.ca', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', '', '2019-08-27'),
('C96B33FD-6D6A-ECD1-15E1-F8B1FC9ED800', 'Macaulay', 'Proin@nuncestmollis.co.uk', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing', '', '2019-12-01'),
('CD983BE1-811E-6095-4E78-E57CE8817318', 'Nash', 'sem.Pellentesque.ut@acorci.net', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna', '', '2019-08-18'),
('D50D17B3-C137-5EBF-56CF-A80ADCE4F8FF', 'Driscoll', 'mi@purusDuiselementum.org', 'Lorem ipsum dolor sit', '', '2019-12-16'),
('D5D6D24A-EBF9-8593-9075-658B40B65FBD', 'Abraham', 'consequat@ornare.net', 'Lorem ipsum dolor', '', '2018-11-20'),
('D6800DA0-F289-031F-F235-974F7C397AF1', 'Emmanuel', 'bo-montes@Donecconsectetuermauris.co.uk', 'Lorem ipsum dolor', '', '2018-12-18'),
('DA12FEC1-5F09-2968-6E69-06E96651CDEA', 'Barrett', 'Class.apho-tent.taciti@interdumNuncsollicitudin.org', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec', '', '2018-10-02'),
('DB538A05-D5D3-6F9C-711B-99C48399B494', 'Lane', 'justo@dignissim.ca', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-03-02'),
('DB9F4176-9364-5DEB-153E-BB95F73F806C', 'Zahir', 'et.netus@congue.co.uk', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur', '', '2019-08-15'),
('DC72E5B9-48A5-EE1B-3950-6DC39351D5E0', 'Amery', 'tincidunt@faucibus.ca', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2018-12-24'),
('DE649BC4-A380-E971-B291-27A7061B44AA', 'Aaron', 'amet@natoquepenatibuset.net', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-08-09'),
('EC7BC86E-5AFA-B170-1BEA-D0AA93470757', 'Jarrod', 'luctus.et@porta.org', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at', '', '2020-05-16'),
('ED7D0E6C-7DE6-C6FE-F197-B81FA30A87A3', 'Henry', 'erat@quamdignissimpharetra.edu', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2020-02-22'),
('EDA2A89F-2DD3-AA2E-EE8B-AE42AD28B6F8', 'Barclay', 'vehicula.risus.Nulla@Duis.ca', 'Lorem', '', '2019-10-11'),
('EFDA7B89-2518-F717-4D80-9563B93F4EB4', 'Francis', 'lacus.varius@nuncrisusvarius.com', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2020-02-06'),
('F5223038-34C0-B865-28B7-3468ECCFB52F', 'Graham', 'Integer@eratvitae.com', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2020-08-01'),
('F6B9D117-B915-D032-648F-62C84818947E', 'Aaron', 'eget.massa.Suspendisse@Proinnislsem.ca', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna', '', '2020-08-12'),
('F7A45272-FFAC-9853-9280-702CCFEF8AE0', 'Raja', 'ornare@tempus.org', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravid', '', '2019-02-19'),
('FF1D8807-6A4D-6427-5D27-A290BA95D53A', 'Lester', 'tristique.pellentesque@Crasinterdum.net', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien,', '', '2018-09-30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lop`
--

CREATE TABLE `lop` (
  `mlop` varchar(100) NOT NULL,
  `khoa` varchar(100) NOT NULL DEFAULT 'cntt',
  `mgvCn` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lop-hoc-phan`
--

CREATE TABLE `lop-hoc-phan` (
  `id` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `mgv` varchar(100) NOT NULL,
  `createdDate` date DEFAULT NULL,
  `sumStudent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_11_140232_create_bai-giang_table', 0),
(4, '2019_08_11_140232_create_bo-mon_table', 0),
(5, '2019_08_11_140232_create_chi-tiet-bai-viet_table', 0),
(6, '2019_08_11_140232_create_danh-sach-bai-viet_table', 0),
(7, '2019_08_11_140232_create_danh-sach-diem-danh_table', 0),
(8, '2019_08_11_140232_create_giao-vien_table', 0),
(9, '2019_08_11_140232_create_lop_table', 0),
(10, '2019_08_11_140232_create_mon-hoc_table', 0),
(11, '2019_08_11_140232_create_password_resets_table', 0),
(12, '2019_08_11_140232_create_phan-loai-bai-viet_table', 0),
(13, '2019_08_11_140232_create_sinh-vien_table', 0),
(14, '2019_08_11_140232_create_users_table', 0),
(15, '2019_08_11_140233_add_foreign_keys_to_bai-giang_table', 0),
(16, '2019_08_11_140233_add_foreign_keys_to_chi-tiet-bai-viet_table', 0),
(17, '2019_08_11_140233_add_foreign_keys_to_danh-sach-bai-viet_table', 0),
(18, '2019_08_11_140233_add_foreign_keys_to_danh-sach-diem-danh_table', 0),
(19, '2019_08_11_140233_add_foreign_keys_to_lop_table', 0),
(20, '2019_08_11_140233_add_foreign_keys_to_mon-hoc_table', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mon-hoc`
--

CREATE TABLE `mon-hoc` (
  `mmh` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `idBoMon` varchar(300) NOT NULL,
  `tinChi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phan-loai-bai-viet`
--

CREATE TABLE `phan-loai-bai-viet` (
  `id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `createdDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `phan-loai-bai-viet`
--

INSERT INTO `phan-loai-bai-viet` (`id`, `name`, `description`, `createdDate`) VALUES
('abfbd91c-6e96-45e1-b7ea-93537b63de83', 'blog', 'hay the', '2019-09-24'),
('d7a79565-1034-490f-8802-69b920c5a8c3', 'new', 'hehe', '2019-09-24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinh-vien`
--

CREATE TABLE `sinh-vien` (
  `msv` varchar(100) NOT NULL,
  `name` varchar(300) NOT NULL,
  `lop` varchar(50) NOT NULL,
  `birthDay` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `sinh-vien`
--

INSERT INTO `sinh-vien` (`msv`, `name`, `lop`, `birthDay`) VALUES
('0225976A-DD6B-5E6D-2470-4CB2AC933E27', 'Garth Fisher', 'Saint-Eug�ne-de-Guigues', '2019-04-08'),
('0291612D-8874-2A11-93AC-8E31F222302B', 'Curran Conner', 'Montgomery', '2020-01-29'),
('0A4B4731-A7AE-AF70-B01B-266564E8AB54', 'Nolan Harper', 'Grimbergen', '2019-04-08'),
('0AFEAF71-8D0B-AF05-68F4-39BFD2BD6A73', 'Macon Howard', 'Pepingen', '2020-02-02'),
('0CB496A9-679A-8A8F-4F49-07E2C7F212B8', 'Joshua Mathews', 'Isola del Gran Sasso d\'Italia', '2019-06-07'),
('19967BF2-7500-CC93-40D2-8216E64FD6A7', 'Zephania Hubbard', 'Santa Luzia', '2020-03-21'),
('1BC3FF8A-64A7-5F7C-5DBC-4FAEA94BA5FC', 'Rigel Keller', 'Saint-Médard-en-Jalles', '2019-10-20'),
('1C6CF207-7C53-B1C8-4A2F-1F9F189E4834', 'Mannix Gaines', 'Henis', '2020-01-14'),
('1DA050B8-C7E1-0843-84C5-5E6FE9835D9D', 'Russell Walters', 'Bear', '2019-10-01'),
('2091114C-599B-4673-ED34-9CE412894D94', 'Hop Soto', 'Loksbergen', '2019-04-29'),
('20D8B3DD-42DC-3C63-B2D7-5B26290472B3', 'Orson Pierce', 'Placilla', '2018-10-18'),
('20DABC2E-9B1F-564C-A6F1-3BFA19CE75B6', 'Nathaniel Chavez', 'Juazeiro', '2019-09-28'),
('221E56C1-25BE-9860-BF6C-047C75CE60A1', 'Felix Lester', 'Stralsund', '2019-04-20'),
('228D2F0F-618F-D5FC-1DE6-033D4412B194', 'Lewis Webb', 'Cessnock', '2018-08-23'),
('23FEB7E8-6228-0021-D24D-432BF5BEBB02', 'Eaton Walton', 'Sala Baganza', '2019-09-13'),
('2589470A-7B2F-A324-716F-E878A5831731', 'Gray Harrington', 'Avadi', '2018-08-27'),
('259A9931-7FF4-EE07-6379-B1A85D67C9A3', 'Calvin Hogan', 'Olathe', '2019-08-26'),
('273CF1BD-A919-B546-982F-BDF6CF641484', 'Xander Frye', 'Henderson', '2018-09-21'),
('297499C3-67DB-5355-BF1F-EAA2F1C424DD', 'Alvin Bridges', 'Belmonte del Sannio', '2020-07-22'),
('2C643369-7F5D-F6F3-AA1E-89CFD6772F29', 'Akeem Cooper', 'Chaitén', '2020-01-05'),
('2C80F89F-5EDD-5532-81E1-8A718AC18832', 'Wesley Clayton', 'Miramichi', '2020-02-12'),
('2D858687-C43D-0D33-2FAD-FC284A4B21BB', 'Yoshio Griffith', 'Molenbeersel', '2018-10-08'),
('2EB75FCE-8856-8C9D-0148-2B89B3E03334', 'Kevin Williams', 'Groß-Gerau', '2019-10-18'),
('2EFFF16B-A0C9-084F-6ED2-750421CEE7A3', 'Drake Duke', 'Heerlen', '2020-07-06'),
('30F30C67-57AD-4F7E-6FF9-8BD2A85EC7B8', 'Reuben Craft', 'Alandur', '2019-01-09'),
('33C47A90-D499-4E40-89F1-C66C2875C648', 'Joshua Mullins', 'Ladispoli', '2018-10-27'),
('38CA9749-559D-40E5-21F4-230DDDA8F21F', 'Seth Tillman', 'Villa Faraldi', '2018-09-13'),
('3C05986F-984E-A003-7330-E4F3AB3D5C15', 'Igor Carr', 'Montebello', '2018-08-14'),
('3C0877BB-F854-CEEF-3966-F21E298A37A8', 'Camden Peters', 'Gallodoro', '2018-10-06'),
('3E723576-6E70-76C2-D4DF-CA3956AD2B05', 'Ishmael Boyer', 'Curanilahue', '2020-06-27'),
('41E99461-2E3A-BACC-B0C8-05EF67B390A9', 'Christian Simpson', 'Maunath Bhanjan', '2020-05-28'),
('4383A563-D3CC-4628-B0B3-595995ABD7DA', 'Tad Dunlap', 'Dudzele', '2019-05-03'),
('44A9FCBC-68A4-3C35-20C8-AF84A27FEB4F', 'Ferdinand Adkins', 'Indianapolis', '2019-07-26'),
('4CFB0C75-298F-0CD1-0065-D23FC2A1176B', 'Henry Kline', 'Jabalpur', '2020-02-10'),
('4D8ACA44-8E61-0BB2-A2AE-1B60144BD429', 'Dorian Charles', 'Gulfport', '2019-01-24'),
('530C9BF2-8144-5B55-7B9F-12CAA1EF6E26', 'Kadeem Hatfield', 'Tongrinne', '2020-01-06'),
('54D434FF-03C6-8B5D-3984-8F60AAEA2802', 'Hamish Rowe', 'Kinross', '2019-08-19'),
('55075AF9-0C61-91F9-03C4-49EE4EBEAD20', 'Keefe Mcgowan', 'Sannazzaro de\' Burgondi', '2019-01-07'),
('57C51938-D597-D645-B3C5-0C55BC9C599E', 'Alvin Sherman', 'Värnamo', '2018-11-23'),
('58643EE6-D89F-199C-D3CA-437DA7B6B3A4', 'Jonah Velez', 'Tours', '2018-11-02'),
('5D1BB036-5096-FBDC-7598-659E4C0421F7', 'Fritz Manning', 'Oudenaken', '2019-09-07'),
('5DF45FB8-B602-150D-53A2-1B75264B9AF4', 'Edward Hamilton', 'Hoorn', '2018-10-06'),
('5E83B625-91F0-5178-E0F1-0CDF62DEAF95', 'Macon Conway', 'Gijón', '2019-10-18'),
('5EC42A7A-CC99-E9A8-4E0C-D2E7C17D05C7', 'Tarik Boyd', 'Nossegem', '2019-01-03'),
('61211E7D-D3B6-F918-830B-93B44C25294E', 'Hu Petty', 'Buken', '2018-09-05'),
('621D0938-3CA9-C874-32A1-366FF077DE2F', 'Castor Tran', 'Tarrasa', '2019-08-26'),
('6234C2E5-990B-4971-1968-E1D2CC792BDC', 'Beau Charles', 'Matagami', '2019-06-10'),
('63C91756-984E-4B4C-23D4-4FF9D80B9A87', 'Felix Lopez', 'Nicoya', '2018-08-30'),
('651E0C0C-AB4F-2B08-1DB6-8A504757BC00', 'Marshall Henson', 'Lampernisse', '2018-09-09'),
('6537E4BD-3780-E4A4-4F1F-D7D2CF91EC24', 'Theodore Bates', 'Hisar', '2019-09-25'),
('6619AF8D-65FA-935A-4418-B156D67ADEB5', 'Troy Stephens', 'Bokaro Steel City', '2020-06-18'),
('669EE2DD-8A7F-9AC5-AEBB-A3F2F4C69842', 'Scott Rhodes', 'Bevagna', '2019-04-16'),
('71F1AAF4-5823-03EB-7BAE-11FAD11ACF37', 'Moses Cunningham', 'Pamel', '2018-11-24'),
('795BCF2A-2365-2541-57C4-4BEC4B5442F3', 'Macon Hobbs', 'Candidoni', '2019-12-25'),
('7CFFD7F2-E2FD-B510-27E8-C63A495668AA', 'Oliver Morse', 'Flint', '2019-08-14'),
('8708EDE9-8B30-AC85-D0AF-2857049F65C4', 'Scott Griffith', 'Mülheim', '2019-01-21'),
('8944F34B-684B-A5B1-C5D1-37114263881C', 'Channing Mcclure', 'Weert', '2018-08-20'),
('8A855436-EECB-933C-7634-D4A6E99A8ACD', 'Amery Beasley', 'Valley East', '2019-12-09'),
('8C315872-07E3-B198-CBE0-29E2CECE8C69', 'Forrest Briggs', 'Columbia', '2019-06-09'),
('8C3B43D1-F61B-CF58-A21F-3B706D9C2DCA', 'Nash House', 'Ambala Sadar', '2019-08-11'),
('8D5EB24A-1011-2D97-02F3-66E378BC3A95', 'Ethan Howell', 'Castellana Sicula', '2019-06-18'),
('8EFF7D50-80EE-575C-5D52-26BB947DAD02', 'Dorian Sharpe', 'Boise', '2018-10-16'),
('9180C362-DB9B-FC6F-2702-3A53051CBC87', 'Plato Tate', 'Ayr', '2018-10-09'),
('9A9C13D6-C497-CEDA-FD7E-02E7FEB7BFE4', 'Zephania Osborne', 'Valcourt', '2020-02-25'),
('A3093D72-AE04-EC14-F2ED-C03533C5039E', 'Gabriel Grant', 'Silifke', '2019-10-15'),
('A3C61254-D028-71D6-5137-4F78A243F414', 'Burke Avery', 'Dibrugarh', '2019-04-23'),
('A9DB3F0B-8A97-43CD-D9EC-B314C5CDD1BB', 'Justin David', 'Lens-Saint-Servais', '2019-01-03'),
('AB385FB6-FB8A-C850-29F6-7F4CB4E4334D', 'Arthur Stanley', 'Cork', '2020-03-14'),
('B070D92A-391D-9AE3-0AAB-AE000352344F', 'Plato Lowery', 'Goulburn', '2019-11-22'),
('B31FE77C-708C-49F4-A427-2F18D0C994AA', 'Herrod Woodard', 'Comeglians', '2019-05-23'),
('B330DE0A-E573-E1BC-2E18-97BBF4E543E6', 'Edward Flynn', 'Zwettl-Niederösterreich', '2019-06-08'),
('B430A066-8A4F-9B84-DDBC-CE6F74A20D50', 'Jesse Chang', 'Menai Bridge', '2019-03-20'),
('B563047E-30C7-3439-9CE2-B363336A84F2', 'Jarrod Mcfadden', 'Caprauna', '2020-06-22'),
('B604EF16-9EDF-FC8E-4323-31DE65C90127', 'Callum Olsen', 'Galbiate', '2019-03-22'),
('B7AE27C7-143D-51D3-0B33-D0FD75382282', 'Mason Christensen', 'Santa Cruz de Tenerife', '2020-01-26'),
('B93192A5-84F2-9FCB-38CE-2B4BF4093F1B', 'Levi Pitts', 'Castelmarte', '2018-12-24'),
('BA076ED6-28F4-A871-CBE6-E1E0E09BE8D3', 'Isaiah Mcfadden', 'Lloydminster', '2019-04-21'),
('BD48DAE2-C64B-F7CD-44B0-EA719A131B68', 'Macon Woodard', 'Tarbes', '2018-10-28'),
('BE8E4350-6DF9-FDB6-8072-A58E82794C0A', 'Maxwell Byers', 'Zaragoza', '2020-02-25'),
('C1C1BFDB-3CB7-4965-4A54-3C3890467EDB', 'Chaney Owen', 'Greater Sudbury', '2019-05-25'),
('C497A931-D236-A411-4AFF-2C1A4AE86E95', 'Abdul Cervantes', 'Wood Buffalo', '2020-05-10'),
('CC5544BC-98AA-16F8-9E0A-93D88B77418E', 'Davis Atkins', 'Newark', '2018-08-23'),
('D10D1896-D772-7125-DFF0-5DFF5479D742', 'Dustin Shaw', 'Zaanstad', '2018-12-07'),
('D4551BF6-AA02-5DE4-2674-9F8AB87F438F', 'Kermit Reeves', 'Anzegem', '2020-02-04'),
('DA2AA003-AA0A-69D9-709A-F979B9FB83C7', 'Kasimir Santana', 'Feira de Santana', '2019-01-08'),
('DA42F825-B6E7-230F-7C9D-A9079318818B', 'Blake Davis', 'Barrhead', '2019-06-15'),
('DA600C98-0726-6970-6854-01A23D1BBE4C', 'Lance Wilkerson', 'Reana del Rojale', '2018-12-29'),
('DAFBF369-79C5-05FB-1D1C-2BB5DF0861D9', 'Lane Hodge', 'Hay River', '2019-10-26'),
('DC81FF1D-1F34-122B-B53F-6C79E97B9AD0', 'Cairo Hutchinson', 'Melsele', '2020-02-17'),
('DE666575-338D-8831-507C-F28FA128ED6D', 'Coby Livingston', 'Palmerston', '2019-11-14'),
('DF4B2966-529A-F9B7-4227-203215C453CF', 'Vance Peck', 'LaSalle', '2018-10-23'),
('E59DD3AD-E3E6-070E-B423-D38B9E6A0E1C', 'Porter Davis', 'Munger', '2019-10-11'),
('E900C492-FF21-6CFD-3429-8008B0C477F7', 'Asher Mullen', 'Hove', '2019-09-11'),
('EA61317F-522B-70D9-67E5-68DFFDA54C48', 'Damon Sandoval', 'Salzgitter', '2020-02-03'),
('EC8C1F3D-ED63-D578-35D9-DDC9A36EA5FB', 'Barclay Stewart', 'Roxboro', '2019-09-03'),
('ED284204-E1DD-3BAE-B0BD-7A394873BBF9', 'Malcolm Marsh', 'Moradabad', '2020-05-13'),
('F65C9BF8-B942-E7CA-3F88-E354EF25486E', 'Cooper Walters', 'Nasino', '2019-09-20'),
('F86E1C35-90C6-C021-B91D-75E2D672F3A0', 'Cadman Vega', 'Namur', '2019-03-23'),
('FB7D1860-D48D-CD89-3036-0176A3009208', 'Maxwell Mccullough', 'Beypazarı', '2019-11-09'),
('FFE77A04-CB68-E4DF-7A77-4A556490E3DD', 'Gray Doyle', 'Sahiwal', '2020-01-27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Nhom', 'datnv1997@gmail.com', NULL, '$2y$10$sikMKUYhmb1AyPCfqEGZhuv6LExVGZeoxrssxRXQUkEGqYkM0e6Rm', NULL, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bai-giang`
--
ALTER TABLE `bai-giang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id-ng-tao` (`idCreator`),
  ADD KEY `id-mon-hoc` (`idSubject`);

--
-- Chỉ mục cho bảng `bo-mon`
--
ALTER TABLE `bo-mon`
  ADD PRIMARY KEY (`mbm`);

--
-- Chỉ mục cho bảng `chi-tiet-bai-viet`
--
ALTER TABLE `chi-tiet-bai-viet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id-ng-tao` (`idCreator`),
  ADD KEY `id-phan-loai` (`idCategory`);

--
-- Chỉ mục cho bảng `cong-trinh-cong-bo`
--
ALTER TABLE `cong-trinh-cong-bo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `danh-sach-bai-viet`
--
ALTER TABLE `danh-sach-bai-viet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id-ng-tao` (`idCreator`),
  ADD KEY `id-phan-loai` (`idCategory`);

--
-- Chỉ mục cho bảng `danh-sach-diem-danh`
--
ALTER TABLE `danh-sach-diem-danh`
  ADD KEY `ma-gv` (`idgv`),
  ADD KEY `msv` (`msv`);

--
-- Chỉ mục cho bảng `detai-duan`
--
ALTER TABLE `detai-duan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `giao-vien`
--
ALTER TABLE `giao-vien`
  ADD PRIMARY KEY (`mgv`);

--
-- Chỉ mục cho bảng `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`mlop`),
  ADD KEY `mgv-cn` (`mgvCn`);

--
-- Chỉ mục cho bảng `lop-hoc-phan`
--
ALTER TABLE `lop-hoc-phan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `mon-hoc`
--
ALTER TABLE `mon-hoc`
  ADD PRIMARY KEY (`mmh`),
  ADD KEY `ma-bo-mon` (`idBoMon`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `phan-loai-bai-viet`
--
ALTER TABLE `phan-loai-bai-viet`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sinh-vien`
--
ALTER TABLE `sinh-vien`
  ADD PRIMARY KEY (`msv`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bai-giang`
--
ALTER TABLE `bai-giang`
  ADD CONSTRAINT `bai-giang_ibfk_1` FOREIGN KEY (`idCreator`) REFERENCES `giao-vien` (`mgv`),
  ADD CONSTRAINT `bai-giang_ibfk_2` FOREIGN KEY (`idSubject`) REFERENCES `mon-hoc` (`mmh`);

--
-- Các ràng buộc cho bảng `chi-tiet-bai-viet`
--
ALTER TABLE `chi-tiet-bai-viet`
  ADD CONSTRAINT `chi-tiet-bai-viet_ibfk_1` FOREIGN KEY (`idCreator`) REFERENCES `giao-vien` (`mgv`),
  ADD CONSTRAINT `chi-tiet-bai-viet_ibfk_2` FOREIGN KEY (`idCategory`) REFERENCES `phan-loai-bai-viet` (`id`);

--
-- Các ràng buộc cho bảng `danh-sach-bai-viet`
--
ALTER TABLE `danh-sach-bai-viet`
  ADD CONSTRAINT `danh-sach-bai-viet_ibfk_1` FOREIGN KEY (`idCreator`) REFERENCES `chi-tiet-bai-viet` (`idCreator`),
  ADD CONSTRAINT `danh-sach-bai-viet_ibfk_2` FOREIGN KEY (`idCategory`) REFERENCES `phan-loai-bai-viet` (`id`);

--
-- Các ràng buộc cho bảng `danh-sach-diem-danh`
--
ALTER TABLE `danh-sach-diem-danh`
  ADD CONSTRAINT `danh-sach-diem-danh_ibfk_1` FOREIGN KEY (`idgv`) REFERENCES `giao-vien` (`mgv`),
  ADD CONSTRAINT `danh-sach-diem-danh_ibfk_2` FOREIGN KEY (`msv`) REFERENCES `sinh-vien` (`msv`);

--
-- Các ràng buộc cho bảng `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `lop_ibfk_1` FOREIGN KEY (`mgvCn`) REFERENCES `giao-vien` (`mgv`);

--
-- Các ràng buộc cho bảng `mon-hoc`
--
ALTER TABLE `mon-hoc`
  ADD CONSTRAINT `mon-hoc_ibfk_1` FOREIGN KEY (`idBoMon`) REFERENCES `bo-mon` (`mbm`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
