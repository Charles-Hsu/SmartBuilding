-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2018 at 09:56 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartbuilding`
--

-- --------------------------------------------------------

--
-- Table structure for table `apartment`
--

CREATE TABLE `apartment` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apartment`
--

INSERT INTO `apartment` (`id`, `name`, `address`) VALUES
(0, 'illumin', '台北市中山區建國北路190號5樓');

-- --------------------------------------------------------

--
-- Table structure for table `apartment_settings`
--

CREATE TABLE `apartment_settings` (
  `committee_meeting_num` int(11) NOT NULL,
  `holder_meeting_num` int(11) NOT NULL,
  `op_man_num` int(11) NOT NULL,
  `op_patrol_num` int(11) NOT NULL,
  `bonus` int(11) NOT NULL,
  `performance_bonus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apartment_settings`
--

INSERT INTO `apartment_settings` (`committee_meeting_num`, `holder_meeting_num`, `op_man_num`, `op_patrol_num`, `bonus`, `performance_bonus`) VALUES
(1, 1, 4, 10, 35000, 35000);

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(11) NOT NULL,
  `asset_no` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `asset_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `asset_category` int(1) NOT NULL,
  `price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `order_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order_date` datetime NOT NULL,
  `status_no` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `asset_no`, `asset_name`, `asset_category`, `price`, `amount`, `order_by`, `order_date`, `status_no`) VALUES
(1, 'AST0001A', '測試資產A', 1, 3000, 50, '王小明', '2018-03-01 00:00:00', 5),
(2, 'AST0001B', '測試資產B', 3, 30000, 1, '王小明', '2018-03-01 00:00:00', 1),
(3, 'AST0001C', '測試資產C', 3, 35000, 1, '王小明', '2018-03-01 00:00:00', 1),
(4, 'AST0001D', '測試資產D', 3, 32000, 1, '王小明', '2018-03-01 00:00:00', 0),
(5, 'AST0001E', '測試資產E', 3, 2000, 1, '王小明', '2018-03-01 00:00:00', 0),
(6, 'AST0001F', '測試資產F', 3, 200000, 1, '王小明', '2018-03-01 00:00:00', 0),
(7, 'AST0001G', '測試資產G', 3, 300000, 1, '王小明', '2018-03-01 00:00:00', 0),
(8, 'AST0001H', '測試資產H', 3, 50000, 1, '王小明', '2018-03-01 00:00:00', 0),
(9, 'AST0001I', '測試資產I', 3, 650000, 1, '王小明', '2018-03-01 00:00:00', 0),
(10, 'AST0001J', '測試資產J', 3, 50000, 1, '王小明', '2018-03-01 00:00:00', 0),
(11, 'AST0001K', '測試資產K', 3, 35000, 1, '王小明', '2018-03-01 00:00:00', 0),
(12, 'AST0001L', '測試資產L', 3, 48000, 1, '王小明', '2018-03-01 00:00:00', 0),
(13, 'AST0001M', '測試資產M', 3, 18000, 1, '王小明', '2018-03-01 00:00:00', 0),
(14, 'AST0001N', '測試資產N', 3, 88000, 1, '王小明', '2018-03-01 00:00:00', 0),
(15, 'AST0001P', '測試資產P', 3, 18000, 1, '王小明', '2018-03-01 00:00:00', 0),
(16, 'AST0001Q', '測試資產Q', 3, 88800, 1, '王小明', '2018-03-01 00:00:00', 0),
(17, 'AST0001R', '測試資產R', 3, 18800, 1, '王小明', '2018-03-01 00:00:00', 0),
(18, 'AST0001S', '測試資產S', 3, 16800, 1, '王小明', '2018-03-01 00:00:00', 0),
(19, 'AST0001T', '測試資產T', 3, 6800, 1, '王小明', '2018-03-01 00:00:00', 0),
(22, 'AST0001Tt1', '測試資產Tt1', 3, 0, 1, '', '2018-03-15 00:00:00', 0),
(23, 'AST0001Tt2', '測試資產Tt2', 3, 0, 1, '', '2018-03-13 00:00:00', 0),
(24, 'AST0001Tt3', '測試資產Tt3', 3, 0, 1, '', '2018-03-15 00:00:00', 0),
(25, 'AST0001Tt4', '測試資產Tt4', 3, 0, 1, '', '2018-03-15 00:00:00', 0),
(26, 'AST0001Tt45', '測試資產Tt45', 3, 0, 1, '', '2018-03-19 00:00:00', 0),
(27, 'AST0001Tt456', '測試資產Tt456', 3, 0, 1, '', '2018-03-19 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `asset_category`
--

CREATE TABLE `asset_category` (
  `id` int(11) NOT NULL,
  `category` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset_category`
--

INSERT INTO `asset_category` (`id`, `category`) VALUES
(1, '行政文書類'),
(2, '財務報表類'),
(3, '設施設備類'),
(4, '公共資產/資材類');

-- --------------------------------------------------------

--
-- Table structure for table `asset_status`
--

CREATE TABLE `asset_status` (
  `id` int(2) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset_status`
--

INSERT INTO `asset_status` (`id`, `name`) VALUES
(0, '使用中'),
(1, '故障'),
(2, '損毀'),
(3, '遺失'),
(4, '維修中'),
(5, '報廢');

-- --------------------------------------------------------

--
-- Table structure for table `bank_acc`
--

CREATE TABLE `bank_acc` (
  `id` int(11) NOT NULL,
  `account_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `account_type` int(1) NOT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `account_number` varchar(25) NOT NULL,
  `account_purpose` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `account_balance` int(11) NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_acc`
--

INSERT INTO `bank_acc` (`id`, `account_name`, `account_type`, `bank_name`, `account_number`, `account_purpose`, `account_balance`, `comment`) VALUES
(1, '國泰親水管理委員會', 1, '台灣銀行', '123-456-789-00', '長期維護', 100, ''),
(14, '國泰親水管理委員會', 3, '台北富邦銀行', '012-345-678-900', '零用金', 350000, '備註備註'),
(15, '國泰親水管理委員會', 2, '台北富邦銀行', '012-345-678-999', '電梯更換', 500000, '123456中文');

-- --------------------------------------------------------

--
-- Table structure for table `bank_acc_type`
--

CREATE TABLE `bank_acc_type` (
  `id` int(11) NOT NULL,
  `type` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_acc_type`
--

INSERT INTO `bank_acc_type` (`id`, `type`) VALUES
(1, '法定公共基金'),
(2, '定期存款'),
(3, '活期存款');

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `planning_dt` date NOT NULL,
  `amount` int(11) NOT NULL,
  `bank_acc_no` int(11) NOT NULL,
  `budget_years` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`id`, `name`, `planning_dt`, `amount`, `bank_acc_no`, `budget_years`) VALUES
(1, 'A大樓電梯更換', '2018-03-29', 200000, 15, 5),
(9, 'B大樓電梯更換', '2018-03-31', 300000, 15, 5);

-- --------------------------------------------------------

--
-- Table structure for table `budget_type`
--

CREATE TABLE `budget_type` (
  `id` int(11) NOT NULL,
  `budget_type_name` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budget_type`
--

INSERT INTO `budget_type` (`id`, `budget_type_name`) VALUES
(1, '採購'),
(2, '維修保養');

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `id` int(11) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `alias_name` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `license_no` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `approved_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`id`, `name`, `alias_name`, `address`, `license_no`, `approved_date`) VALUES
(1, '忠孝樓', 'A', '台北市中山區建國北路二段188號', '使照1234567', '2017-11-01'),
(2, '仁愛樓', 'B', '台北市中山區建國北路二段190號', '使照1234568', '2017-11-01'),
(3, '復興樓', 'C', '台北市中山區建國北路二段192號', '使照1234569', '2017-11-01');

-- --------------------------------------------------------

--
-- Table structure for table `committee`
--

CREATE TABLE `committee` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `holder_id` int(11) NOT NULL,
  `session` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `committee`
--

INSERT INTO `committee` (`id`, `role_id`, `holder_id`, `session`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 1),
(3, 3, 3, 1),
(4, 4, 4, 1),
(5, 5, 8, 1),
(6, 6, 1, 1),
(7, 7, 13, 1),
(8, 8, 14, 1),
(9, 9, 15, 1),
(10, 10, 16, 1),
(11, 1, 1, 2),
(12, 2, 2, 2),
(13, 3, 3, 2),
(14, 4, 4, 2),
(15, 5, 8, 2),
(16, 6, 1, 2),
(17, 7, 13, 2),
(18, 8, 14, 2),
(19, 9, 15, 2),
(20, 10, 16, 2),
(51, 1, 1, 3),
(52, 2, 2, 3),
(53, 3, 3, 3),
(54, 4, 4, 3),
(55, 5, 8, 3),
(56, 6, 1, 3),
(57, 7, 13, 3),
(58, 8, 14, 3),
(59, 9, 15, 3),
(60, 10, 16, 3),
(61, 1, 1, 3),
(62, 2, 2, 3),
(63, 3, 3, 3),
(64, 4, 4, 3),
(65, 5, 8, 3),
(66, 6, 1, 3),
(67, 7, 13, 3),
(68, 8, 14, 3),
(69, 9, 15, 3),
(70, 10, 16, 3);

-- --------------------------------------------------------

--
-- Table structure for table `committee_role`
--

CREATE TABLE `committee_role` (
  `id` int(11) NOT NULL,
  `title` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `committee_role`
--

INSERT INTO `committee_role` (`id`, `title`) VALUES
(1, '主委'),
(2, '副主委'),
(3, '監委'),
(4, '財委'),
(5, '機電'),
(6, '總務'),
(7, '園藝'),
(8, '康樂'),
(9, '環保'),
(10, '公關');

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `id` int(11) NOT NULL,
  `name` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name_eng` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `in_charge` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(32) NOT NULL,
  `web` varchar(32) NOT NULL,
  `contact_person` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contact_phone` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contract_item` int(11) NOT NULL,
  `dt` date NOT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`id`, `name`, `name_eng`, `phone`, `fax`, `in_charge`, `email`, `web`, `contact_person`, `contact_phone`, `contract_item`, `dt`, `score`) VALUES
(0, '自聘', '', '', '', '', '', '', '主委', '0800080123', 0, '2018-04-01', NULL),
(1, '怡盛保全', '', '', '', '', '', '', 'Peter', '0968123456', 1, '2018-01-01', 80),
(2, '東京都', '', '', '', '', '', '', 'Alex', '0933123456', 2, '2017-12-07', NULL),
(3, '高力國際', '', '', '', '', '', '', 'Tomy', '02-2123-456', 3, '2017-10-02', NULL),
(4, '第一太平戴維斯', '', '', '', '', '', '', 'Adam', '04-688-799', 4, '2018-01-01', NULL),
(5, '怡盛集團', '', '', '', '', '', '', 'Vivian', '090-888-888', 5, '2018-02-08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contract_item`
--

CREATE TABLE `contract_item` (
  `id` int(11) NOT NULL,
  `item` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contract_item`
--

INSERT INTO `contract_item` (`id`, `item`) VALUES
(1, '電梯'),
(2, '消防'),
(3, '機電'),
(4, '清潔'),
(5, '園藝'),
(6, '保全'),
(7, '其他');

-- --------------------------------------------------------

--
-- Table structure for table `elect_fee`
--

CREATE TABLE `elect_fee` (
  `yyyymm` varchar(6) NOT NULL COMMENT '年月',
  `fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `elect_fee`
--

INSERT INTO `elect_fee` (`yyyymm`, `fee`) VALUES
('201601', 3000),
('201602', 2000),
('201603', 2000),
('201604', 2000),
('201605', 2000),
('201606', 2000),
('201607', 2000),
('201608', 2000),
('201609', 2000),
('201610', 2000),
('201611', 2000),
('201612', 2000),
('201701', 2000),
('201702', 2000),
('201703', 2000),
('201704', 2000),
('201705', 2000),
('201706', 2000),
('201707', 2000),
('201708', 2000),
('201709', 2000),
('201710', 2000),
('201711', 2000),
('201712', 2000),
('201801', 5000),
('201802', 6800),
('201803', 22000),
('201804', 25000);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `id` int(11) NOT NULL,
  `dt` date NOT NULL,
  `committee` int(11) NOT NULL COMMENT '屆別',
  `examinor` int(11) NOT NULL COMMENT '考核人 eval_examinor',
  `target_id` int(11) NOT NULL COMMENT '0表團隊, 參看 staff',
  `eval_type` int(11) NOT NULL COMMENT '評量方式 eval_type',
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`id`, `dt`, `committee`, `examinor`, `target_id`, `eval_type`, `score`) VALUES
(38, '2018-04-26', 1, 1, 0, 1, 80),
(39, '2018-04-26', 1, 1, 0, 1, 75),
(40, '2018-04-27', 1, 1, 0, 1, 80),
(41, '2018-04-27', 1, 1, 1, 1, 80);

-- --------------------------------------------------------

--
-- Table structure for table `eval_category`
--

CREATE TABLE `eval_category` (
  `id` int(1) NOT NULL,
  `category` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eval_category`
--

INSERT INTO `eval_category` (`id`, `category`) VALUES
(1, '公寓大廈一般事務管理服務類'),
(2, '建築物及基地之維護修繕'),
(3, '建築物附屬設備之檢查及修護'),
(4, '公寓大廈環境衛生類'),
(5, '公寓大廈安全防災管理維護類'),
(6, '財務管理類'),
(7, '生活服務與商業支援類'),
(8, '品德'),
(9, '工作能力'),
(10, '工作表現'),
(11, '工作成績');

-- --------------------------------------------------------

--
-- Table structure for table `eval_detail`
--

CREATE TABLE `eval_detail` (
  `id` int(11) NOT NULL,
  `eval_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eval_detail`
--

INSERT INTO `eval_detail` (`id`, `eval_id`, `item_id`, `score`) VALUES
(298, 38, 38, 1),
(299, 38, 39, 1),
(300, 39, 116, 1),
(301, 39, 117, 1),
(302, 40, 101, 5),
(303, 40, 120, 5),
(304, 41, 101, 5),
(305, 41, 120, 5);

-- --------------------------------------------------------

--
-- Table structure for table `eval_examinor`
--

CREATE TABLE `eval_examinor` (
  `id` int(11) NOT NULL,
  `name` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eval_examinor`
--

INSERT INTO `eval_examinor` (`id`, `name`) VALUES
(1, '管委會'),
(2, '物管公司'),
(3, '總幹事');

-- --------------------------------------------------------

--
-- Table structure for table `eval_item`
--

CREATE TABLE `eval_item` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `description` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eval_item`
--

INSERT INTO `eval_item` (`id`, `category`, `item`, `description`) VALUES
(1, 1, 1, '區分所有權人會議作業流程'),
(2, 1, 2, '管理委員會會議作業流程'),
(3, 1, 3, '管理服務人委任管理流程'),
(4, 1, 4, '管理服務人員訓練流程'),
(5, 1, 5, '公寓大廈管理組織申請報備流程'),
(6, 1, 6, '室內裝修管理'),
(7, 1, 7, '公文管理流程'),
(8, 1, 8, '共用鑰匙管理流程'),
(9, 1, 9, '掛號信件處理流程'),
(10, 1, 10, '住戶管理費催繳作業流程'),
(11, 1, 11, '住戶滿意度作業流程'),
(12, 1, 12, '住戶搬入遷出作業流程'),
(13, 1, 13, '住戶反映事項作業流程'),
(14, 1, 14, '社區財產作業流程'),
(15, 2, 1, '住戶違規處理作業流程'),
(16, 2, 2, '建築物及基地管理維護修繕作業流程'),
(17, 3, 1, '公寓大廈停車場管理作業流程'),
(18, 3, 2, '共用設施保養維護作業流程'),
(19, 4, 1, '公寓大廈環境清潔作業流程'),
(20, 4, 2, '公寓大廈環境綠化美化作業流程'),
(21, 4, 3, '公寓大廈資源回收作業流程'),
(22, 4, 4, '公寓大廈病媒防治作業流程'),
(23, 5, 1, '公寓大廈安全管理作業流程'),
(24, 5, 2, '公寓大廈安全防災作業流程'),
(25, 5, 3, '公寓大廈安全維護作業流程'),
(26, 5, 4, '公寓大廈緊急事做處理作業流程'),
(27, 6, 1, '財務計畫作業流程'),
(28, 6, 2, '零用金支出請款流程'),
(29, 6, 3, '管理費繳交流程'),
(30, 6, 4, '請款支出流程'),
(31, 6, 5, '裝潢保證金作業流程'),
(32, 6, 6, '遙控器、感應卡作業流程'),
(33, 6, 7, '管理費作業流程'),
(34, 6, 8, '公共基金管理作業流程'),
(35, 7, 1, '社區社團作業流程'),
(36, 7, 2, '社區櫃台作業流程:訪客接待'),
(37, 7, 3, '社區櫃台作業流程:衣物送洗'),
(38, 7, 4, '社區櫃台作業流程:代叫計程車'),
(39, 7, 5, '社區櫃台作業流程:代辦事項'),
(101, 8, 1, '忠於公司維護大樓利益'),
(102, 8, 2, '團結友愛、和睦相處且互助'),
(103, 8, 3, '待人坦誠、謙虛有禮且可靠'),
(104, 8, 4, '奉獻精神'),
(105, 9, 1, '責任感'),
(106, 9, 2, '理解能力'),
(107, 9, 3, '判斷能力'),
(108, 9, 4, '計畫性'),
(109, 9, 5, '表達能力'),
(110, 9, 6, '處理問題'),
(111, 9, 7, '組織能力'),
(112, 9, 8, '協調溝通能力'),
(113, 10, 1, '服從性'),
(114, 10, 2, '原則性'),
(115, 10, 3, '積極性'),
(116, 10, 4, '團隊合作'),
(117, 10, 5, '規章制度'),
(118, 11, 1, '工作效率'),
(119, 11, 2, '工作品質'),
(120, 11, 3, '工作目標完成量');

-- --------------------------------------------------------

--
-- Table structure for table `eval_type`
--

CREATE TABLE `eval_type` (
  `id` int(11) NOT NULL,
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eval_type`
--

INSERT INTO `eval_type` (`id`, `name`) VALUES
(1, '不定期抽查'),
(2, '每月'),
(3, '每季'),
(4, '自評');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `charge` int(11) NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `charge`, `comment`) VALUES
(1, '游泳池 - SPA池', 100, ''),
(2, '健身房', 100, ''),
(3, '圖書館', 0, '不可預約'),
(4, '交誼聽', 100, '最多10人同時使用'),
(5, '會議室A(8人)', 100, '8人'),
(6, '會議室B(32人)', 100, '32人'),
(7, 'KTV - 娛樂室', 400, '最多10人同時使用');

-- --------------------------------------------------------

--
-- Table structure for table `facility_reserve`
--

CREATE TABLE `facility_reserve` (
  `id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `dt` datetime NOT NULL COMMENT '預約以1小時微單位',
  `house_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facility_reserve`
--

INSERT INTO `facility_reserve` (`id`, `facility_id`, `dt`, `house_id`) VALUES
(1, 1, '2018-04-17 09:00:00', 17),
(2, 1, '2018-04-17 10:00:00', 17),
(3, 1, '2018-04-17 11:00:00', 17),
(4, 1, '2018-04-18 12:00:00', 19),
(5, 1, '2018-04-18 13:00:00', 19);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `dt` date NOT NULL,
  `type` int(11) NOT NULL,
  `desc` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `dt`, `type`, `desc`, `path`) VALUES
(1, '0000-00-00', 1, 'smartbuilding資料庫', 'customer_20170211.csv'),
(2, '0000-00-00', 1, '國文會考實戰試題1~8回(教用合併檔)', '國文會考實戰試題1~8回(教用合併檔).pdf'),
(3, '0000-00-00', 2, '品質管理與績效指標示範手冊', '品質管理與績效指標示範手冊.pdf'),
(4, '2018-04-23', 7, 'media', 'media.zip'),
(5, '2018-04-16', 7, '新文字文件', '新文字文件.txt'),
(6, '2018-04-04', 7, '課程分類', '課程分類.pages.pdf'),
(7, '0000-00-00', 1, '布平方手作教室預約課程', '布平方手作教室預約課程.pdf'),
(8, '0000-00-00', 1, '布平方手作教室預約課程 (1)', '布平方手作教室預約課程 (1).pdf'),
(9, '2018-04-24', 7, '未命名-1', '未命名-1.png'),
(10, '2018-04-24', 7, 'pietty0400b14 (1)', 'pietty0400b14 (1).zip'),
(11, '2018-04-24', 7, '命名-1', '未命名-1.png'),
(12, '2018-04-24', 7, 'pietty0400b14', 'pietty0400b14.zip'),
(13, '2018-04-24', 7, 'pietty0400b1', 'pietty0400b14 (1).zip'),
(14, '2018-04-24', 7, 'pietty0400b14', 'pietty0400b14 (1).zip'),
(15, '2018-04-24', 7, '1060105ULISTADDRESS', '1060105ULISTADDRESS.CSV'),
(16, '2018-04-24', 7, '標題:123', '國文會考實戰試題1_8回(教用合併檔).pdf'),
(21, '2018-04-24', 9, '公告標題', 'system_log.sql');

-- --------------------------------------------------------

--
-- Table structure for table `file_type`
--

CREATE TABLE `file_type` (
  `id` int(11) NOT NULL,
  `type` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file_type`
--

INSERT INTO `file_type` (`id`, `type`) VALUES
(1, '效能管理'),
(2, '資產管理'),
(3, '組織管理'),
(4, '維運管理'),
(5, '長期修繕'),
(6, '資安管理'),
(7, '管理辦法'),
(8, '空間變更'),
(9, '公告');

-- --------------------------------------------------------

--
-- Table structure for table `hoa_fee_defined`
--

CREATE TABLE `hoa_fee_defined` (
  `id` int(11) NOT NULL,
  `hid` int(11) NOT NULL,
  `fee_type` int(11) NOT NULL,
  `fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hoa_fee_defined`
--

INSERT INTO `hoa_fee_defined` (`id`, `hid`, `fee_type`, `fee`) VALUES
(1, 1, 1, 3000),
(2, 1, 2, 800),
(3, 1, 3, 500),
(4, 2, 1, 2000),
(5, 2, 2, 200),
(6, 3, 1, 3500),
(7, 3, 2, 800),
(8, 3, 3, 200),
(9, 4, 1, 4000),
(10, 4, 2, 400),
(11, 4, 3, 500),
(12, 8, 1, 2000),
(13, 8, 2, 800),
(14, 8, 3, 550);

-- --------------------------------------------------------

--
-- Table structure for table `hoa_fee_month_printed`
--

CREATE TABLE `hoa_fee_month_printed` (
  `id` int(11) NOT NULL,
  `has_generated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hoa_fee_month_printed`
--

INSERT INTO `hoa_fee_month_printed` (`id`, `has_generated`) VALUES
(16, '2018-04-01'),
(17, '2018-01-01'),
(18, '2018-02-01'),
(19, '2018-03-01'),
(20, '2018-05-01'),
(21, '2018-06-01'),
(22, '2018-07-01'),
(23, '2018-08-01'),
(24, '2018-09-01'),
(25, '2018-10-01'),
(26, '2018-11-01');

-- --------------------------------------------------------

--
-- Table structure for table `hoa_fee_record`
--

CREATE TABLE `hoa_fee_record` (
  `id` int(11) NOT NULL,
  `hid` int(11) NOT NULL,
  `fee_type` int(11) NOT NULL,
  `fee` int(11) NOT NULL,
  `m` date NOT NULL COMMENT '應繳日期',
  `p` date DEFAULT NULL COMMENT '繳納日期'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hoa_fee_record`
--

INSERT INTO `hoa_fee_record` (`id`, `hid`, `fee_type`, `fee`, `m`, `p`) VALUES
(4, 1, 1, 3000, '2018-04-01', '2018-04-03'),
(5, 1, 2, 800, '2018-04-05', '2018-04-02'),
(6, 2, 1, 2000, '2018-04-01', '2018-04-16'),
(7, 2, 2, 200, '2018-04-01', '2018-04-04'),
(8, 3, 1, 3500, '2018-04-01', '2018-04-03'),
(9, 3, 2, 800, '2018-04-01', '2018-04-03'),
(10, 4, 1, 4000, '2018-04-01', '2018-04-03'),
(11, 4, 2, 400, '2018-04-01', '2018-04-04'),
(12, 8, 1, 2000, '2018-04-01', '2018-04-04'),
(13, 8, 2, 800, '2018-04-01', '2018-04-04'),
(14, 1, 1, 3000, '2018-01-01', '2018-04-04'),
(15, 1, 2, 800, '2018-01-01', '2018-04-03'),
(16, 2, 1, 2000, '2018-01-01', '2018-04-04'),
(17, 2, 2, 200, '2018-01-01', NULL),
(18, 3, 1, 3500, '2018-01-02', NULL),
(19, 3, 2, 800, '2018-01-01', NULL),
(20, 4, 1, 4000, '2018-01-01', NULL),
(21, 4, 2, 400, '2018-01-01', NULL),
(22, 8, 1, 2000, '2018-01-01', '2018-04-04'),
(23, 8, 2, 800, '2018-01-01', NULL),
(24, 1, 1, 3000, '2018-02-02', '2018-04-03'),
(25, 1, 2, 800, '2018-02-02', NULL),
(26, 2, 1, 2000, '2018-02-01', '2018-04-03'),
(27, 12, 2, 200, '2018-02-09', NULL),
(28, 3, 1, 3500, '2018-02-01', '2018-04-03'),
(29, 3, 2, 800, '2018-02-01', '2018-04-03'),
(30, 4, 1, 4000, '2018-02-01', '2018-04-03'),
(31, 4, 2, 400, '2018-02-01', NULL),
(32, 8, 1, 2000, '2018-02-01', NULL),
(33, 8, 2, 800, '2018-02-01', NULL),
(34, 1, 1, 3000, '2018-03-01', NULL),
(35, 1, 2, 800, '2018-03-01', NULL),
(36, 2, 1, 2000, '2018-03-01', NULL),
(37, 2, 2, 200, '2018-03-01', NULL),
(38, 3, 1, 3500, '2018-03-01', NULL),
(39, 3, 2, 800, '2018-03-01', NULL),
(40, 4, 1, 4000, '2018-03-01', '2018-04-10'),
(41, 4, 2, 400, '2018-03-01', NULL),
(42, 8, 1, 2000, '2018-03-01', '2018-04-03'),
(43, 8, 2, 800, '2018-03-01', NULL),
(44, 1, 1, 3000, '2018-05-01', NULL),
(45, 1, 2, 800, '2018-05-01', NULL),
(46, 2, 1, 2000, '2018-05-01', NULL),
(47, 2, 2, 200, '2018-05-01', NULL),
(48, 3, 1, 3500, '2018-05-01', NULL),
(49, 3, 2, 800, '2018-05-01', NULL),
(50, 4, 1, 4000, '2018-05-01', '2018-04-03'),
(51, 4, 2, 400, '2018-05-01', NULL),
(52, 8, 1, 2000, '2018-05-01', '2018-04-03'),
(53, 8, 2, 800, '2018-05-01', NULL),
(54, 1, 1, 3000, '2018-06-01', '2018-04-03'),
(55, 1, 2, 800, '2018-06-01', NULL),
(56, 2, 1, 2000, '2018-06-01', NULL),
(57, 2, 2, 200, '2018-06-01', NULL),
(58, 3, 1, 3500, '2018-06-01', '2018-04-03'),
(59, 3, 2, 800, '2018-06-01', NULL),
(60, 4, 1, 4000, '2018-06-01', '2018-04-03'),
(61, 4, 2, 400, '2018-06-01', NULL),
(62, 8, 1, 2000, '2018-06-01', NULL),
(63, 8, 2, 800, '2018-06-01', NULL),
(64, 1, 1, 3000, '2018-07-01', '2018-04-04'),
(65, 1, 2, 800, '2018-07-01', NULL),
(66, 2, 1, 2000, '2018-07-01', NULL),
(67, 2, 2, 200, '2018-07-01', NULL),
(68, 3, 1, 3500, '2018-07-01', '2018-04-04'),
(69, 3, 2, 800, '2018-07-01', NULL),
(70, 4, 1, 4000, '2018-07-01', '2018-04-02'),
(71, 4, 2, 400, '2018-07-01', NULL),
(72, 8, 1, 2000, '2018-07-01', '2018-04-03'),
(73, 8, 2, 800, '2018-07-01', NULL),
(74, 1, 1, 3000, '2018-08-01', '2018-04-03'),
(75, 1, 2, 800, '2018-08-01', NULL),
(76, 2, 1, 2000, '2018-08-01', '2018-04-04'),
(77, 2, 2, 200, '2018-08-01', NULL),
(78, 3, 1, 3500, '2018-08-01', '2018-04-03'),
(79, 3, 2, 800, '2018-08-01', NULL),
(80, 4, 1, 4000, '2018-08-01', '2018-04-03'),
(81, 4, 2, 400, '2018-08-01', NULL),
(82, 8, 1, 2000, '2018-08-01', NULL),
(83, 8, 2, 800, '2018-08-01', NULL),
(84, 1, 1, 3000, '2018-09-01', NULL),
(85, 1, 2, 800, '2018-09-01', NULL),
(86, 2, 1, 2000, '2018-09-01', NULL),
(87, 2, 2, 200, '2018-09-01', NULL),
(88, 3, 1, 3500, '2018-09-01', NULL),
(89, 3, 2, 800, '2018-09-01', NULL),
(90, 4, 1, 4000, '2018-09-01', NULL),
(91, 4, 2, 400, '2018-09-01', NULL),
(92, 8, 1, 2000, '2018-09-01', NULL),
(93, 8, 2, 800, '2018-09-01', NULL),
(94, 1, 1, 3000, '2018-10-01', NULL),
(95, 1, 2, 800, '2018-10-01', NULL),
(96, 2, 1, 2000, '2018-10-01', NULL),
(97, 2, 2, 200, '2018-10-01', NULL),
(98, 3, 1, 3500, '2018-10-01', NULL),
(99, 3, 2, 800, '2018-10-01', NULL),
(100, 4, 1, 4000, '2018-10-01', NULL),
(101, 4, 2, 400, '2018-10-01', NULL),
(102, 8, 1, 2000, '2018-10-01', NULL),
(103, 8, 2, 800, '2018-10-01', NULL),
(104, 1, 1, 3000, '2018-11-01', NULL),
(105, 1, 2, 800, '2018-11-01', NULL),
(106, 2, 1, 2000, '2018-11-01', NULL),
(107, 2, 2, 200, '2018-11-01', NULL),
(108, 3, 1, 3500, '2018-11-01', NULL),
(109, 3, 2, 800, '2018-11-01', NULL),
(110, 4, 1, 4000, '2018-11-01', NULL),
(111, 4, 2, 400, '2018-11-01', NULL),
(112, 8, 1, 2000, '2018-11-01', NULL),
(113, 8, 2, 800, '2018-11-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hoa_fee_type`
--

CREATE TABLE `hoa_fee_type` (
  `id` int(11) NOT NULL,
  `type` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hoa_fee_type`
--

INSERT INTO `hoa_fee_type` (`id`, `type`) VALUES
(1, '管理費'),
(2, '停車費'),
(3, '帶看費');

-- --------------------------------------------------------

--
-- Table structure for table `hoa_fee_unpaid`
--

CREATE TABLE `hoa_fee_unpaid` (
  `id` int(11) NOT NULL,
  `hoa_fee_id` int(11) NOT NULL,
  `dt` date NOT NULL,
  `paid_dt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hoa_month_checked`
--

CREATE TABLE `hoa_month_checked` (
  `id` int(11) NOT NULL,
  `Y-m` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hoa_month_checked`
--

INSERT INTO `hoa_month_checked` (`id`, `Y-m`) VALUES
(1, '2018-01-01'),
(4, '2018-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `household`
--

CREATE TABLE `household` (
  `id` int(11) NOT NULL,
  `building` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `purpose` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `addr_no` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `floor` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `short_id` varchar(10) NOT NULL COMMENT '門號代碼+樓層+戶號',
  `holder` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `resident` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `owner_percentage` float NOT NULL,
  `space` float NOT NULL,
  `house_type` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `buy_date` date NOT NULL,
  `used_for` int(1) NOT NULL,
  `sellrent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `household`
--

INSERT INTO `household` (`id`, `building`, `purpose`, `status`, `addr_no`, `floor`, `short_id`, `holder`, `resident`, `owner_percentage`, `space`, `house_type`, `buy_date`, `used_for`, `sellrent`) VALUES
(1, 'A', 1, 1, '188-1', '12', 'A1202', 'Charles001', 'Charles001', 12, 35.6, '3房2廳', '2018-03-01', 0, 0),
(2, 'A', 0, 0, '188-2', '12', 'A1203', 'Charles', 'Charles', 12, 35.6, '3房2廳', '2018-03-01', 0, 1),
(3, 'C', 0, 0, '190-2', '3', 'B0303', 'Tony', 'Tony', 10, 24.6, '2房1廳', '2018-03-01', 0, 1),
(4, 'C', 0, 0, '300-1', '15', 'C1502', 'Charles', 'Charles', 20, 30, '3房2廳', '2018-03-19', 0, 1),
(8, 'C', 0, 0, '300-1', '14', 'C1402', 'Charles', 'Charles', 20, 30, '3房2廳', '2018-03-19', 0, 1),
(12, 'C', 0, 0, '300', '13', 'C1301', 'Charles', 'Charles', 20, 30, '3房2廳', '2018-03-19', 0, 1),
(13, 'C', 0, 0, '300', '12', 'C1301', 'Charles', 'Charles', 20, 30, '3房2廳', '2018-03-19', 0, 1),
(14, 'C', 0, 0, '300', '11', 'C1301', 'Charles', 'Charles', 20, 30, '3房2廳', '2018-03-19', 0, 1),
(15, 'C', 0, 0, '300', '10', 'C1301', 'Charles', 'Charles', 20, 30, '3房2廳', '2018-03-19', 0, 1),
(16, 'C', 0, 0, '300', '9', 'C1301', 'Charles', 'Charles', 20, 30, '3房2廳', '2018-03-19', 0, 1),
(17, 'C', 0, 0, '300', '8', 'C1301', 'Charles', 'Charles', 20, 30, '3房2廳', '2018-03-19', 0, 1),
(18, 'C', 0, 0, '300', '7', 'C1301', 'Charles', 'Charles', 20, 30, '3房2廳', '2018-03-19', 0, 1),
(19, 'C', 0, 0, '300', '6', 'C1301', 'Charles', 'Charles', 20, 30, '3房2廳', '2018-03-19', 0, 1),
(20, 'C', 0, 0, '300', '5', 'C1301', 'Charles', 'Charles', 20, 30, '3房2廳', '2018-03-19', 0, 1),
(21, 'C', 0, 0, '300', '4', 'C1301', 'Charles', 'Charles', 20, 30, '3房2廳', '2018-03-19', 0, 1),
(22, 'C', 0, 0, '300', '3', 'C1301', 'Charles', 'Charles', 20, 30, '3房2廳', '2018-03-19', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `household_purpose`
--

CREATE TABLE `household_purpose` (
  `id` int(1) NOT NULL,
  `name` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `household_purpose`
--

INSERT INTO `household_purpose` (`id`, `name`) VALUES
(0, '住宅用'),
(1, '商業用');

-- --------------------------------------------------------

--
-- Table structure for table `household_status`
--

CREATE TABLE `household_status` (
  `id` int(1) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `household_status`
--

INSERT INTO `household_status` (`id`, `name`) VALUES
(0, '自用'),
(1, '出租'),
(2, '裝潢');

-- --------------------------------------------------------

--
-- Table structure for table `household_used_for`
--

CREATE TABLE `household_used_for` (
  `id` int(1) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `household_used_for`
--

INSERT INTO `household_used_for` (`id`, `name`) VALUES
(0, '自用'),
(1, '租賃');

-- --------------------------------------------------------

--
-- Table structure for table `hs-sr`
--

CREATE TABLE `hs-sr` (
  `id` int(11) NOT NULL COMMENT '對應到household的PK',
  `fee` int(5) NOT NULL COMMENT '帶看費用',
  `s_or_r` int(1) NOT NULL COMMENT '售0, 租1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hs-sr`
--

INSERT INTO `hs-sr` (`id`, `fee`, `s_or_r`) VALUES
(2, 1000, 0),
(3, 1000, 0),
(4, 500, 1);

-- --------------------------------------------------------

--
-- Table structure for table `license`
--

CREATE TABLE `license` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `license`
--

INSERT INTO `license` (`id`, `type`, `name`) VALUES
(1, 1, '事務管理人員'),
(2, 1, '防火避難設施管理人'),
(3, 1, '設備安全管理人員'),
(4, 2, '電匠'),
(5, 2, '冷凍空調'),
(6, 2, '水匠'),
(7, 2, '工業配線'),
(8, 2, '室內配線'),
(9, 2, '工業電子'),
(10, 2, '鍋爐操作'),
(11, 2, '高壓氣體'),
(12, 2, '壓力容器'),
(13, 2, '消防設備士(師)'),
(14, 2, '汙廢水操作人員'),
(15, 3, '病媒防治'),
(16, 3, '水池水塔清洗');

-- --------------------------------------------------------

--
-- Table structure for table `license_of_staff`
--

CREATE TABLE `license_of_staff` (
  `id` int(11) NOT NULL,
  `license_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `license_of_staff`
--

INSERT INTO `license_of_staff` (`id`, `license_id`, `staff_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 1, 3),
(4, 5, 3),
(5, 10, 4),
(6, 1, 5),
(7, 2, 5),
(8, 3, 5),
(9, 1, 0),
(10, 4, 0),
(11, 13, 0),
(12, 15, 0),
(13, 1, 6),
(14, 4, 6),
(15, 7, 6),
(16, 1, 7),
(17, 4, 7),
(18, 7, 7),
(19, 10, 7),
(20, 13, 7),
(21, 1, 8),
(22, 4, 8),
(23, 7, 8),
(24, 10, 8),
(25, 13, 8),
(26, 14, 8),
(27, 15, 8),
(28, 16, 8);

-- --------------------------------------------------------

--
-- Table structure for table `license_type`
--

CREATE TABLE `license_type` (
  `id` int(11) NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `license_type`
--

INSERT INTO `license_type` (`id`, `type`) VALUES
(0, '無'),
(1, '物業管理類'),
(2, '機電類'),
(3, '環保類');

-- --------------------------------------------------------

--
-- Table structure for table `mails`
--

CREATE TABLE `mails` (
  `id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `mail_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mails`
--

INSERT INTO `mails` (`id`, `house_id`, `mail_num`) VALUES
(1, 1, 3),
(2, 2, 0),
(3, 3, 0),
(4, 15, 0),
(5, 14, 0),
(6, 13, 0),
(7, 12, 0),
(8, 8, 0),
(9, 4, 0),
(10, 22, 0),
(11, 21, 0),
(12, 20, 0),
(13, 19, 0),
(14, 18, 0),
(15, 17, 0),
(16, 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mails_log`
--

CREATE TABLE `mails_log` (
  `id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `dd` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mails_log`
--

INSERT INTO `mails_log` (`id`, `house_id`, `dd`) VALUES
(1, 1, '2018-01-01'),
(2, 1, '2018-01-02'),
(3, 1, '2018-01-03'),
(4, 1, '2018-01-03'),
(5, 1, '2018-01-03'),
(6, 1, '2018-01-10'),
(7, 1, '2018-01-11'),
(8, 1, '2018-02-11'),
(9, 1, '2018-02-11'),
(10, 1, '2018-03-11'),
(11, 1, '2018-04-10'),
(12, 2, '2018-01-01'),
(13, 2, '2018-04-01'),
(14, 2, '2018-04-02'),
(15, 2, '2018-04-02'),
(18, 1, '2018-04-18'),
(19, 1, '2018-04-18'),
(20, 1, '2018-04-18'),
(21, 2, '2018-04-18'),
(22, 2, '2018-04-18'),
(23, 2, '2018-04-18'),
(24, 2, '2018-04-18'),
(25, 1, '2018-04-18'),
(26, 1, '2018-04-18'),
(27, 1, '2018-04-18'),
(28, 1, '2018-04-18'),
(29, 1, '2018-04-18'),
(30, 1, '2018-04-18'),
(31, 1, '2018-04-18'),
(32, 1, '2018-04-18'),
(33, 1, '2018-04-18'),
(34, 1, '2018-04-18'),
(35, 1, '2018-04-18'),
(36, 1, '2018-04-19'),
(37, 1, '2018-04-19'),
(38, 1, '2018-04-19'),
(39, 1, '2018-04-19'),
(40, 1, '2018-04-19'),
(41, 1, '2018-04-20'),
(42, 1, '2018-04-20'),
(43, 1, '2018-04-20'),
(44, 1, '2018-04-20');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `meeting_type` int(11) NOT NULL,
  `round` int(11) NOT NULL,
  `session` int(11) NOT NULL,
  `att_rate` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `date`, `meeting_type`, `round`, `session`, `att_rate`) VALUES
(1, '2018-04-09', 1, 1, 1, 100);

-- --------------------------------------------------------

--
-- Table structure for table `meeting_att`
--

CREATE TABLE `meeting_att` (
  `id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `att_id` int(11) NOT NULL,
  `dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meeting_att`
--

INSERT INTO `meeting_att` (`id`, `meeting_id`, `att_id`, `dt`) VALUES
(7, 1, 1, '2018-04-11 11:30:00'),
(8, 1, 2, '2018-04-13 17:42:00'),
(9, 1, 3, '2018-04-13 17:42:00'),
(10, 1, 15, '2018-04-13 17:42:00'),
(11, 1, 14, '2018-04-11 11:22:00'),
(12, 1, 13, '2018-04-11 10:44:00'),
(13, 1, 12, '2018-04-11 10:57:00'),
(14, 1, 8, '2018-04-11 10:48:00'),
(15, 1, 4, '2018-04-11 10:49:00'),
(16, 1, 22, '2018-04-11 11:16:00'),
(17, 1, 21, '2018-04-11 11:22:00'),
(18, 1, 20, '2018-04-11 10:53:00'),
(19, 1, 19, '2018-04-11 11:25:00'),
(20, 1, 18, '2018-04-11 11:18:00'),
(21, 1, 17, '2018-04-13 17:43:00'),
(22, 1, 16, '2018-04-20 09:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_type`
--

CREATE TABLE `meeting_type` (
  `id` int(11) NOT NULL,
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meeting_type`
--

INSERT INTO `meeting_type` (`id`, `name`) VALUES
(1, '區權會'),
(2, '臨時區權會'),
(3, '管委會'),
(4, '臨時管委會');

-- --------------------------------------------------------

--
-- Table structure for table `opinions`
--

CREATE TABLE `opinions` (
  `id` int(11) NOT NULL,
  `dt` date NOT NULL,
  `household_id` int(11) NOT NULL,
  `whois` int(11) NOT NULL,
  `content` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dt_responsed` date DEFAULT NULL,
  `dt_completed` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opinions`
--

INSERT INTO `opinions` (`id`, `dt`, `household_id`, `whois`, `content`, `dt_responsed`, `dt_completed`) VALUES
(15, '2018-01-01', 2, 0, '意見', '2018-04-13', '2018-04-13'),
(16, '2018-01-01', 8, 0, '意見12345', '2018-01-02', '2018-04-17'),
(17, '2018-01-01', 3, 0, '意見12345', '2018-01-02', '2018-04-17'),
(18, '2018-01-01', 2, 0, '意見12345', '2018-04-13', '2018-04-13'),
(19, '2018-01-01', 3, 0, 'A棟電梯門無法緊閉', '2018-01-09', '2018-04-17'),
(26, '2018-01-01', 3, 0, '意見', '2018-01-05', '2018-04-17'),
(27, '2018-01-01', 3, 0, '設備異常', '2018-01-21', '2018-04-17'),
(28, '2018-01-01', 8, 0, '意見12345', '2018-01-20', '2018-04-17'),
(29, '2018-01-01', 8, 0, '意見12345', '2018-01-20', '2018-04-17'),
(30, '2018-02-01', 8, 0, '意見12345', '2018-01-30', '2018-04-17'),
(31, '2018-02-01', 8, 0, '意見12345', '2018-01-30', '2018-04-17'),
(32, '2018-02-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(33, '2018-02-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(34, '2018-02-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(35, '2018-02-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(36, '2018-02-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(37, '2018-02-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(38, '2018-02-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(39, '2018-02-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(40, '2018-03-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(41, '2018-03-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(42, '2018-03-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(43, '2018-03-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(44, '2018-03-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(45, '2018-03-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(46, '2018-03-01', 8, 0, '意見12345', '2018-03-05', '2018-04-17'),
(47, '2018-03-01', 8, 0, '意見12345', '2018-03-13', '2018-04-17'),
(48, '2018-03-01', 8, 0, '意見12345', '2018-03-09', '2018-04-17'),
(49, '2018-03-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(50, '2018-03-01', 8, 0, '意見12345', '2018-03-14', '2018-04-17'),
(51, '2018-03-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(52, '2018-03-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(53, '2018-03-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(54, '2018-04-01', 8, 0, '意見12345', '2018-04-01', '2018-04-17'),
(55, '2018-04-01', 8, 0, '意見12345', '2018-04-02', '2018-04-17'),
(56, '2018-04-01', 8, 0, '意見12345', '2018-04-03', '2018-04-17'),
(57, '2018-04-01', 8, 0, '意見12345', '2018-04-04', '2018-04-17'),
(58, '2018-04-01', 8, 0, '意見12345', '2018-04-04', '2018-04-17'),
(59, '2018-04-01', 8, 0, '意見12345', '2018-04-04', '2018-04-17'),
(60, '2018-04-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(61, '2018-04-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(62, '2018-04-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(63, '2018-04-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(64, '2018-04-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(65, '2018-04-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(66, '2018-04-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(67, '2018-04-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(68, '2018-01-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(69, '2018-01-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(70, '2018-01-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(71, '2018-01-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(72, '2018-01-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(73, '2018-01-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(74, '2018-01-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(75, '2018-01-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(76, '2018-01-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(77, '2018-01-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(78, '2018-01-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(79, '2018-01-01', 8, 0, '意見12345', '2018-04-09', '2018-04-17'),
(80, '2018-01-01', 8, 0, '意見12345', '2018-04-01', '2018-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `opinion_type`
--

CREATE TABLE `opinion_type` (
  `id` int(11) NOT NULL,
  `type` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opinion_type`
--

INSERT INTO `opinion_type` (`id`, `type`) VALUES
(1, '一般'),
(2, '設備');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `post_by` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `attached_file` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `date`, `post_by`, `content`, `attached_file`) VALUES
(1, '2018-03-19', '管委會', '敦聘吳謹斌為法律顧問', NULL),
(2, '2018-03-21', '管委會', '敦聘吳謹斌為法律顧問預計2018/3/22 24:00~2018/3/23 3:00停電', NULL),
(3, '2018-03-21', '管委會', '第一屆管委會例行會議2018/3/22上午10:00社區一樓會議室', NULL),
(4, '2018-03-22', '管委會', '公告欠繳管理費住戶姓名 不違個資法', NULL),
(5, '2018-03-22', '管委會', '自來水公司第二區通知，預計停水日期、時間為：\r\n3/25 AM 7:00 ~ 3/26 AM 3：00', NULL),
(6, '2018-04-09', '管委會', '氣象局今晨宣佈：中度颱風莫克拉於今天(8月6日)晚上24:00將直撲本島，同時氣象局也發佈豪雨特報，請住戶儘速作好防颱準備', NULL),
(7, '2018-04-09', '管委會', '5月份管理費開始收取', NULL),
(8, '2018-04-09', '管委會', '本社區將於4月12日進行中庭花園花木修剪，預計當日下午4:00實施噴藥殺蟲作業，請各住戶門窗務必關上，感謝您的配合!', NULL),
(9, '2018-04-09', '管委會', '依管委會於4/9會議記錄決議事項, 本社區4/10起禁止於社區內公共場所吸煙。', NULL),
(10, '2018-04-09', '管委會', '本社區大樓將於4/10進行全面消毒', NULL),
(11, '2018-04-09', '管委會', '地下室車道燈光不足問題, 將於4/11日發包廠商施工進行解決', 16);

-- --------------------------------------------------------

--
-- Table structure for table `real_estate_agent`
--

CREATE TABLE `real_estate_agent` (
  `id` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `real_estate_agent`
--

INSERT INTO `real_estate_agent` (`id`, `name`) VALUES
(1, '信義'),
(2, '永慶'),
(3, '東森'),
(4, '21世紀'),
(5, '太平洋'),
(6, '其他');

-- --------------------------------------------------------

--
-- Table structure for table `real_estate_agent_event`
--

CREATE TABLE `real_estate_agent_event` (
  `id` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `household_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `real_estate_agent_event`
--

INSERT INTO `real_estate_agent_event` (`id`, `dt`, `household_id`, `agent_id`) VALUES
(1, '2018-03-27 04:15:24', 1, 1),
(2, '2018-03-20 04:15:24', 1, 1),
(3, '2018-03-07 04:15:24', 1, 1),
(4, '2018-03-07 04:15:24', 1, 2),
(5, '2018-03-07 04:15:24', 1, 3),
(6, '2018-03-22 05:25:23', 1, 5),
(7, '2018-03-27 00:00:00', 1, 1),
(8, '2018-03-27 00:00:00', 1, 5),
(9, '2018-03-27 00:00:00', 1, 5),
(10, '2018-03-22 00:00:00', 1, 4),
(11, '2018-03-14 00:00:00', 1, 2),
(12, '2018-03-20 00:00:00', 2, 1),
(13, '2018-03-20 00:00:00', 2, 3),
(14, '2018-03-14 00:00:00', 2, 4),
(15, '2018-03-01 00:00:00', 2, 5),
(16, '2018-03-27 00:00:00', 2, 5),
(17, '2018-03-27 00:00:00', 3, 1),
(18, '2018-03-27 00:00:00', 3, 2),
(19, '2018-03-27 00:00:00', 3, 4),
(20, '2018-03-27 00:00:00', 3, 6),
(21, '2018-03-27 16:52:18', 1, 1),
(22, '2018-03-27 16:52:18', 1, 1),
(23, '2018-03-27 16:52:18', 1, 1),
(24, '2018-03-27 17:08:57', 1, 4),
(25, '2018-03-27 17:08:57', 1, 4),
(26, '2018-03-27 17:10:39', 1, 4),
(27, '2018-03-27 17:10:56', 1, 5),
(28, '2018-03-27 17:11:42', 2, 1),
(29, '2018-03-27 00:00:00', 4, 1),
(30, '2018-03-27 17:15:30', 4, 1),
(31, '2018-03-27 17:25:04', 4, 1),
(32, '2018-03-30 00:00:00', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `round`
--

CREATE TABLE `round` (
  `id` int(11) NOT NULL,
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `round`
--

INSERT INTO `round` (`id`, `name`) VALUES
(1, '第一次'),
(2, '第二次'),
(3, '第三次'),
(4, '第四次');

-- --------------------------------------------------------

--
-- Table structure for table `service_item`
--

CREATE TABLE `service_item` (
  `id` int(11) NOT NULL,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `service_item`
--

INSERT INTO `service_item` (`id`, `name`) VALUES
(1, '訪客管理'),
(2, '鐘點服務'),
(3, '衣物送洗'),
(4, '叫車服務'),
(5, '外送外燴'),
(6, '商務服務'),
(7, '照護服務'),
(8, '私人服務');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `name`) VALUES
(1, '第一屆'),
(2, '第二屆'),
(3, '第三屆'),
(4, '第四屆'),
(5, '第五屆'),
(6, '第六屆'),
(7, '第七屆'),
(8, '第八屆'),
(9, '第九屆'),
(10, '第十屆'),
(11, '第十一屆'),
(12, '第十二屆'),
(13, '第十三屆'),
(14, '第十四屆');

-- --------------------------------------------------------

--
-- Table structure for table `shift_table`
--

CREATE TABLE `shift_table` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `dt` date NOT NULL,
  `shift` int(11) NOT NULL,
  `hours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shift_table`
--

INSERT INTO `shift_table` (`id`, `staff_id`, `dt`, `shift`, `hours`) VALUES
(1, 1, '2018-04-01', 1, 8),
(2, 1, '2018-04-02', 1, 8),
(3, 1, '2018-04-03', 1, 8),
(4, 1, '2018-04-04', 1, 8),
(5, 1, '2018-04-05', 1, 8),
(6, 1, '2018-04-06', 1, 8),
(7, 1, '2018-04-09', 1, 8),
(8, 1, '2018-04-10', 1, 8),
(9, 1, '2018-04-11', 1, 8),
(10, 1, '2018-04-12', 1, 8),
(11, 1, '2018-04-13', 1, 8),
(12, 1, '2018-04-17', 1, 8),
(13, 1, '2018-04-18', 1, 8),
(14, 1, '2018-04-19', 1, 8),
(15, 1, '2018-04-20', 1, 8),
(16, 1, '2018-04-21', 1, 8),
(17, 1, '2018-04-25', 1, 8),
(18, 1, '2018-04-26', 1, 8),
(19, 1, '2018-04-27', 1, 8),
(20, 1, '2018-04-28', 1, 8),
(21, 1, '2018-04-29', 1, 8),
(498, 2, '2018-04-01', 1, 8),
(499, 2, '2018-04-02', 1, 8),
(500, 2, '2018-04-03', 1, 8),
(501, 2, '2018-04-04', 1, 8),
(502, 2, '2018-04-05', 1, 8),
(503, 2, '2018-04-06', 1, 8),
(504, 2, '2018-04-09', 1, 8),
(505, 2, '2018-04-10', 1, 8),
(506, 2, '2018-04-11', 1, 8),
(507, 2, '2018-04-12', 1, 8),
(508, 2, '2018-04-13', 1, 8),
(509, 2, '2018-04-17', 1, 8),
(510, 2, '2018-04-18', 1, 8),
(511, 2, '2018-04-19', 1, 8),
(512, 2, '2018-04-20', 1, 8),
(513, 2, '2018-04-21', 1, 8),
(514, 2, '2018-04-25', 1, 8),
(515, 2, '2018-04-26', 1, 8),
(516, 2, '2018-04-27', 1, 8),
(517, 2, '2018-04-28', 1, 8),
(518, 2, '2018-04-29', 1, 8),
(529, 3, '2018-04-01', 1, 8),
(530, 3, '2018-04-02', 1, 8),
(531, 3, '2018-04-03', 1, 8),
(532, 3, '2018-04-04', 1, 8),
(533, 3, '2018-04-05', 1, 8),
(534, 3, '2018-04-06', 1, 8),
(535, 3, '2018-04-09', 1, 8),
(536, 3, '2018-04-10', 1, 8),
(537, 3, '2018-04-11', 1, 8),
(538, 3, '2018-04-12', 1, 8),
(539, 3, '2018-04-13', 1, 8),
(540, 3, '2018-04-17', 1, 8),
(541, 3, '2018-04-18', 1, 8),
(542, 3, '2018-04-19', 1, 8),
(543, 3, '2018-04-20', 1, 8),
(544, 3, '2018-04-21', 1, 8),
(545, 3, '2018-04-25', 1, 8),
(546, 3, '2018-04-26', 1, 8),
(547, 3, '2018-04-27', 1, 8),
(548, 3, '2018-04-28', 1, 8),
(549, 3, '2018-04-29', 1, 8),
(560, 4, '2018-04-01', 1, 8),
(561, 4, '2018-04-02', 1, 8),
(562, 4, '2018-04-03', 1, 8),
(563, 4, '2018-04-04', 1, 8),
(564, 4, '2018-04-05', 1, 8),
(565, 4, '2018-04-06', 1, 8),
(566, 4, '2018-04-09', 1, 8),
(567, 4, '2018-04-10', 1, 8),
(568, 4, '2018-04-11', 1, 8),
(569, 4, '2018-04-12', 1, 8),
(570, 4, '2018-04-13', 1, 8),
(571, 4, '2018-04-17', 1, 8),
(572, 4, '2018-04-18', 1, 8),
(573, 4, '2018-04-19', 1, 8),
(574, 4, '2018-04-20', 1, 8),
(575, 4, '2018-04-21', 1, 8),
(576, 4, '2018-04-25', 1, 8),
(577, 4, '2018-04-26', 1, 8),
(578, 4, '2018-04-27', 1, 8),
(579, 4, '2018-04-28', 1, 8),
(580, 4, '2018-04-29', 1, 8),
(591, 5, '2018-04-01', 1, 8),
(592, 5, '2018-04-02', 1, 8),
(593, 5, '2018-04-03', 1, 8),
(594, 5, '2018-04-04', 1, 8),
(595, 5, '2018-04-05', 1, 8),
(596, 5, '2018-04-06', 1, 8),
(597, 5, '2018-04-09', 1, 8),
(598, 5, '2018-04-10', 1, 8),
(599, 5, '2018-04-11', 1, 8),
(600, 5, '2018-04-12', 1, 8),
(601, 5, '2018-04-13', 1, 8),
(602, 5, '2018-04-17', 1, 8),
(603, 5, '2018-04-18', 1, 8),
(604, 5, '2018-04-19', 1, 8),
(605, 5, '2018-04-20', 1, 8),
(606, 5, '2018-04-21', 1, 8),
(607, 5, '2018-04-25', 1, 8),
(608, 5, '2018-04-26', 1, 8),
(609, 5, '2018-04-27', 1, 8),
(610, 5, '2018-04-28', 1, 8),
(611, 5, '2018-04-29', 1, 8),
(622, 6, '2018-04-01', 1, 8),
(623, 6, '2018-04-02', 1, 8),
(624, 6, '2018-04-03', 1, 8),
(625, 6, '2018-04-04', 1, 8),
(626, 6, '2018-04-05', 1, 8),
(627, 6, '2018-04-06', 1, 8),
(628, 6, '2018-04-09', 1, 8),
(629, 6, '2018-04-10', 1, 8),
(630, 6, '2018-04-11', 1, 8),
(631, 6, '2018-04-12', 1, 8),
(632, 6, '2018-04-13', 1, 8),
(633, 6, '2018-04-17', 1, 8),
(634, 6, '2018-04-18', 1, 8),
(635, 6, '2018-04-19', 1, 8),
(636, 6, '2018-04-20', 1, 8),
(637, 6, '2018-04-21', 1, 8),
(638, 6, '2018-04-25', 1, 8),
(639, 6, '2018-04-26', 1, 8),
(640, 6, '2018-04-27', 1, 8),
(641, 6, '2018-04-28', 1, 8),
(642, 6, '2018-04-29', 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `shift_table_record`
--

CREATE TABLE `shift_table_record` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `dt0` datetime NOT NULL,
  `dt1` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shift_table_record`
--

INSERT INTO `shift_table_record` (`id`, `staff_id`, `dt0`, `dt1`) VALUES
(1, 1, '2018-05-01 06:53:00', '2018-05-01 19:05:00'),
(2, 1, '2018-05-02 06:53:00', '2018-05-02 19:05:00'),
(3, 1, '2018-05-03 06:53:00', '2018-05-03 19:05:00'),
(4, 1, '2018-05-04 06:53:00', '2018-05-04 19:05:00'),
(5, 1, '2018-05-05 06:53:00', '2018-05-05 19:05:00'),
(6, 1, '2018-05-06 06:53:00', '2018-05-06 19:05:00'),
(7, 1, '2018-05-07 06:53:00', NULL),
(8, 2, '2018-05-01 18:53:00', '2018-05-01 07:05:00'),
(9, 2, '2018-05-02 18:53:00', '2018-05-02 07:05:00'),
(10, 2, '2018-05-03 18:53:00', '2018-05-03 07:05:00'),
(11, 2, '2018-05-04 18:53:00', '2018-05-04 07:05:00'),
(12, 2, '2018-05-05 18:53:00', '2018-05-05 07:05:00'),
(13, 2, '2018-05-06 18:53:00', '2018-05-06 07:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `space_change`
--

CREATE TABLE `space_change` (
  `id` int(11) NOT NULL,
  `dt` date NOT NULL,
  `purpose` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `meeting` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `announcement` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `space_change`
--

INSERT INTO `space_change` (`id`, `dt`, `purpose`, `meeting`, `announcement`) VALUES
(1, '2018-04-27', '一樓開放空見改建機車停車位', 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `no` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `identify` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contract_id` int(1) DEFAULT NULL,
  `role` int(1) DEFAULT NULL COMMENT '0職員,1總幹事,2秘書,3主任',
  `on_board_date` date DEFAULT NULL,
  `trained_date` date DEFAULT NULL,
  `quit_date` date DEFAULT NULL,
  `license` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `no`, `mobile`, `identify`, `contract_id`, `role`, `on_board_date`, `trained_date`, `quit_date`, `license`) VALUES
(0, '團隊', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(1, 'Joe Lee', '0001', '19123456qq', 'A120129015', 0, 0, '2018-03-01', '2018-04-19', NULL, 1),
(2, 'Alex Wang', '0002', '1912345678', 'B120129015', 0, 0, '2018-03-01', '2018-03-16', NULL, 1),
(3, 'Peter', '0003', '1912345678', 'B120129015', 1, 0, '2018-03-01', '2018-03-16', NULL, 2),
(4, 'Charles', '0004', '1912345678', 'B120129015', 3, 1, '2018-03-01', '2018-03-16', NULL, 1),
(5, 'Tony', '0005', '1912345678', 'B120129015', 3, 2, '2018-03-01', '2018-03-16', NULL, 3),
(7, '許家齊', '0006', '0968-123311', 'Y120129015', 1, 0, '2018-04-27', NULL, NULL, 5),
(8, '許家齊', '0007', '0968-123311', 'Y120129015', 0, 0, '2018-04-27', NULL, NULL, 8);

-- --------------------------------------------------------

--
-- Table structure for table `staff_role`
--

CREATE TABLE `staff_role` (
  `id` int(1) NOT NULL COMMENT '0職員,1總幹事,2秘書,3主任',
  `title` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_role`
--

INSERT INTO `staff_role` (`id`, `title`) VALUES
(0, '職員'),
(1, '總幹事'),
(2, '秘書'),
(3, '機電'),
(4, '保全'),
(5, '清潔'),
(6, '園藝'),
(7, '教練');

-- --------------------------------------------------------

--
-- Table structure for table `staff_work_time`
--

CREATE TABLE `staff_work_time` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_work_time`
--

INSERT INTO `staff_work_time` (`id`, `staff_id`, `dt`) VALUES
(1, 1, '2018-03-01 08:00:00'),
(2, 1, '2018-03-01 18:00:00'),
(3, 1, '2018-03-02 08:00:00'),
(4, 1, '2018-03-02 18:00:00'),
(5, 1, '2018-03-03 08:00:00'),
(6, 1, '2018-03-03 18:00:00'),
(7, 1, '2018-03-04 08:00:00'),
(8, 1, '2018-03-04 18:00:00'),
(9, 1, '2018-03-05 08:00:00'),
(10, 1, '2018-03-05 18:00:00'),
(11, 1, '2018-03-06 08:00:00'),
(12, 1, '2018-03-06 18:00:00'),
(13, 1, '2018-03-07 08:00:00'),
(14, 1, '2018-03-07 18:00:00'),
(15, 1, '2018-03-14 08:00:00'),
(16, 1, '2018-03-14 18:00:00'),
(17, 1, '2018-03-15 08:00:00'),
(18, 1, '2018-03-15 18:00:00'),
(19, 1, '2018-03-16 08:00:00'),
(20, 1, '2018-03-16 18:00:00'),
(21, 1, '2018-03-17 08:00:00'),
(22, 1, '2018-03-17 18:00:00'),
(23, 1, '2018-03-24 08:00:00'),
(24, 1, '2018-03-24 18:00:00'),
(25, 1, '2018-03-25 08:00:00'),
(26, 1, '2018-03-25 18:00:00'),
(27, 1, '2018-03-26 08:00:00'),
(28, 1, '2018-03-26 18:00:00'),
(29, 1, '2018-03-27 08:00:00'),
(30, 1, '2018-03-27 18:00:00'),
(31, 1, '2018-03-30 09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `supply_type`
--

CREATE TABLE `supply_type` (
  `id` int(11) NOT NULL,
  `type` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supply_type`
--

INSERT INTO `supply_type` (`id`, `type`) VALUES
(1, '辦公用品'),
(2, '清潔用品'),
(3, '其他');

-- --------------------------------------------------------

--
-- Table structure for table `system_log`
--

CREATE TABLE `system_log` (
  `id` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `ip` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_log`
--

INSERT INTO `system_log` (`id`, `dt`, `ip`, `username`, `message`) VALUES
(4, '2018-03-01 15:49:32', '192.168.1.201', 'admin', '使用者登入'),
(5, '2018-03-15 15:49:33', '192.168.1.201', 'admin', '使用者登出'),
(6, '2018-03-08 15:49:34', '192.168.1.201', 'admin', '使用者登入'),
(7, '2018-03-14 15:49:35', '192.168.1.201', 'admin', '使用者登出'),
(8, '2018-03-20 15:51:21', '192.168.1.201', 'admin', '使用者登入'),
(9, '2018-04-01 16:01:54', '192.168.1.201', 'admin', '使用者登入'),
(11, '2018-04-03 09:33:59', '192.168.1.201', 'admin', '使用者登入'),
(12, '2018-04-17 09:34:30', '192.168.1.201', 'admin', '使用者登出'),
(13, '2018-04-16 09:34:31', '192.168.1.201', 'admin', '使用者登入'),
(14, '2018-04-18 09:40:50', '192.168.1.201', 'admin', '使用者登出'),
(15, '2018-04-17 09:46:56', '192.168.1.201', 'admin', '使用者登入'),
(16, '2018-04-20 09:51:22', '192.168.1.201', 'admin', '使用者登出'),
(17, '2018-04-20 09:51:58', '192.168.1.201', 'admin', '使用者登入'),
(18, '2018-04-20 09:57:27', '192.168.1.201', 'admin', '使用者登出'),
(19, '2018-04-20 09:57:33', '192.168.1.201', 'guest', '使用者登入'),
(20, '2018-04-20 09:58:32', '192.168.1.201', 'guest', '使用者登出'),
(21, '2018-04-20 09:58:37', '192.168.1.201', 'staff', '使用者登入'),
(22, '2018-04-20 09:59:03', '192.168.1.201', 'staff', '使用者登出'),
(23, '2018-04-20 09:59:12', '192.168.1.201', 'admin', '使用者登入'),
(24, '2018-04-20 09:59:24', '192.168.1.201', 'admin', '使用者登出'),
(26, '2018-04-20 10:23:30', '192.168.1.201', 'admin', '使用者登入'),
(27, '2018-04-20 10:31:22', '', '', '使用者登出'),
(28, '2018-04-20 10:44:01', '192.168.1.201', 'admin', '使用者登入'),
(29, '2018-04-24 14:17:56', '', '', '使用者登出'),
(30, '2018-04-24 14:36:26', '', '', '使用者登出'),
(31, '2018-04-24 14:36:33', '192.168.1.201', 'admin', '使用者登入'),
(32, '2018-04-25 11:12:47', '192.168.1.201', 'admin', '使用者登出'),
(33, '2018-04-25 11:15:48', '192.168.1.201', 'admin', '使用者登入'),
(34, '2018-04-25 11:18:24', '192.168.1.201', 'admin', '使用者登出'),
(35, '2018-04-25 11:21:25', '192.168.1.201', 'admin', '使用者登入'),
(36, '2018-04-25 17:05:43', '192.168.1.201', 'admin', '使用者登出'),
(37, '2018-04-25 17:42:19', '192.168.1.201', 'admin', '使用者登入'),
(38, '2018-04-25 18:01:10', '', '', '使用者登出'),
(39, '2018-04-25 18:01:17', '192.168.1.201', 'admin', '使用者登入'),
(40, '2018-04-26 11:14:00', '192.168.1.201', 'admin', '使用者登入'),
(41, '2018-04-26 11:14:01', '192.168.1.201', 'admin', '使用者登入'),
(42, '2018-04-26 11:14:01', '192.168.1.201', 'admin', '使用者登入'),
(43, '2018-04-26 11:14:23', '192.168.1.201', 'admin', '使用者登入'),
(44, '2018-04-26 12:06:04', '192.168.1.201', 'admin', '使用者登入'),
(45, '2018-04-27 15:46:18', '192.168.1.201', 'admin', '使用者登出'),
(46, '2018-04-27 15:46:28', '192.168.1.201', 'staff', '使用者登入'),
(47, '2018-04-27 15:47:10', '192.168.1.201', 'staff', '使用者登出'),
(48, '2018-04-27 15:47:11', '192.168.1.201', 'staff', '使用者登入'),
(49, '2018-04-27 15:54:04', '192.168.1.201', 'staff', '使用者登出'),
(50, '2018-04-27 15:54:05', '192.168.1.201', 'staff', '使用者登入'),
(51, '2018-04-27 15:54:22', '192.168.1.201', 'staff', '使用者登出'),
(52, '2018-04-27 15:54:25', '192.168.1.201', 'admin', '使用者登入'),
(53, '2018-04-30 09:43:34', '192.168.1.201', 'admin', '使用者登入'),
(54, '2018-05-02 09:29:52', '192.168.1.201', 'admin', '使用者登出'),
(55, '2018-05-02 09:30:06', '192.168.1.201', 'guest', '使用者登入'),
(56, '2018-05-02 09:30:19', '192.168.1.201', 'guest', '使用者登出'),
(57, '2018-05-02 09:30:22', '192.168.1.201', 'admin', '使用者登入'),
(58, '2018-05-02 09:34:23', '192.168.1.201', 'admin', '使用者登出'),
(59, '2018-05-02 09:34:26', '192.168.1.201', 'staff', '使用者登入'),
(60, '2018-05-02 09:35:43', '192.168.1.201', 'staff', '使用者登出'),
(61, '2018-05-02 09:35:44', '192.168.1.201', 'staff', '使用者登入'),
(62, '2018-05-02 09:35:47', '192.168.1.201', 'staff', '使用者登出'),
(63, '2018-05-02 09:35:50', '192.168.1.201', 'admin', '使用者登入'),
(64, '2018-05-03 10:36:05', '192.168.1.201', 'admin', '使用者登入'),
(65, '2018-05-04 15:03:41', '', '', '使用者登出'),
(66, '2018-05-04 15:03:43', '192.168.1.201', 'admin', '使用者登入'),
(67, '2018-05-04 15:11:53', '192.168.1.201', 'admin', '使用者登出'),
(68, '2018-05-04 15:11:56', '192.168.1.201', 'staff', '使用者登入'),
(69, '2018-05-04 15:11:58', '192.168.1.201', 'staff', '使用者登出'),
(70, '2018-05-04 15:12:02', '192.168.1.201', 'admin', '使用者登入'),
(71, '2018-05-04 15:33:54', '192.168.1.201', 'admin', '使用者登出'),
(72, '2018-05-04 15:33:59', '192.168.1.201', 'staff', '使用者登入'),
(73, '2018-05-04 15:34:09', '192.168.1.201', 'staff', '使用者登出'),
(74, '2018-05-04 15:34:11', '192.168.1.201', 'admin', '使用者登入'),
(75, '2018-05-04 15:34:46', '192.168.1.201', 'admin', '使用者登出'),
(76, '2018-05-04 15:35:34', '192.168.1.201', 'staff', '使用者登入'),
(77, '2018-05-04 15:36:09', '192.168.1.201', 'admin', '使用者登入'),
(78, '2018-05-04 15:36:33', '192.168.1.201', 'admin', '使用者登出'),
(79, '2018-05-04 15:36:48', '192.168.1.201', 'admin', '使用者登入'),
(80, '2018-05-04 15:37:12', '192.168.1.201', 'admin', '使用者登出'),
(81, '2018-05-04 15:46:37', '192.168.1.201', 'admin', '使用者登入'),
(82, '2018-05-04 15:57:01', '192.168.1.201', 'admin', '使用者登入'),
(83, '2018-05-08 16:46:06', '192.168.1.201', 'admin', '使用者登出'),
(84, '2018-05-08 16:46:20', '192.168.1.201', '188-1-12', '使用者登入'),
(85, '2018-05-08 16:46:40', '192.168.1.201', '188-1-12', '使用者登出'),
(86, '2018-05-08 16:46:44', '192.168.1.201', 'admin', '使用者登入'),
(87, '2018-05-10 10:04:40', '', '', '使用者登出'),
(88, '2018-05-10 10:04:41', '192.168.1.201', 'admin', '使用者登入'),
(89, '2018-05-10 16:09:21', '192.168.1.201', 'admin', '使用者登出'),
(90, '2018-05-10 16:09:29', '192.168.1.201', 'staff', '使用者登入'),
(91, '2018-05-10 16:10:13', '192.168.1.201', 'staff', '使用者登出'),
(92, '2018-05-10 16:10:25', '192.168.1.201', '188-1-12', '使用者登入'),
(93, '2018-05-10 16:10:42', '192.168.1.201', '188-1-12', '使用者登出'),
(94, '2018-05-10 16:10:45', '192.168.1.201', 'admin', '使用者登入'),
(95, '2018-05-10 17:18:01', '192.168.1.201', 'admin', '使用者登出'),
(96, '2018-05-10 17:18:50', '192.168.1.201', 'admin', '使用者登入'),
(97, '2018-05-10 17:19:21', '192.168.1.201', 'admin', '使用者登出'),
(98, '2018-05-10 17:19:29', '192.168.1.201', 'admin', '使用者登入'),
(99, '2018-05-10 17:20:48', '192.168.1.201', 'admin', '使用者登出'),
(100, '2018-05-10 17:20:56', '192.168.1.201', 'admin', '使用者登入'),
(101, '2018-05-10 17:20:58', '192.168.1.201', 'admin', '使用者登出'),
(102, '2018-05-10 17:21:33', '192.168.1.201', 'admin', '使用者登入'),
(103, '2018-05-10 17:21:38', '192.168.1.201', 'admin', '使用者登出'),
(104, '2018-05-10 17:22:58', '192.168.1.201', 'admin', '使用者登入'),
(105, '2018-05-10 17:23:02', '192.168.1.201', 'admin', '使用者登出'),
(106, '2018-05-10 17:25:15', '192.168.1.201', 'admin', '使用者登入'),
(107, '2018-05-10 17:25:19', '192.168.1.201', 'admin', '使用者登出'),
(108, '2018-05-10 18:07:06', '192.168.1.201', 'admin', '使用者登入'),
(109, '2018-05-10 18:07:38', '192.168.1.201', 'admin', '使用者登出'),
(110, '2018-05-10 18:07:40', '192.168.1.201', 'admin', '使用者登入'),
(111, '2018-05-10 18:09:27', '192.168.1.201', 'admin', '使用者登出'),
(112, '2018-05-10 18:09:30', '192.168.1.201', 'admin', '使用者登入'),
(113, '2018-05-10 18:17:34', '192.168.1.201', 'admin', '使用者登出'),
(114, '2018-05-10 18:17:57', '192.168.1.201', 'admin', '使用者登入'),
(115, '2018-05-10 18:18:00', '192.168.1.201', 'admin', '使用者登出'),
(116, '2018-05-10 18:19:39', '', '', '使用者登出'),
(117, '2018-05-10 18:20:46', '', '', '使用者登出'),
(118, '2018-05-10 18:29:26', '', '', '使用者登出'),
(119, '2018-05-10 18:29:39', '192.168.1.201', 'admin', '使用者登入'),
(120, '2018-05-10 18:29:40', 'null', 'admin', '使用者登出'),
(121, '2018-05-10 18:30:33', 'null', '', '使用者登出'),
(122, '2018-05-10 18:31:40', 'null', '', '使用者登出'),
(123, '2018-05-10 18:31:48', '192.168.1.201', 'admin', '使用者登入'),
(124, '2018-05-10 18:34:28', '192.168.1.201', 'admin', '使用者登入'),
(125, '2018-05-10 18:37:46', '192.168.1.201', 'admin', '使用者登入'),
(126, '2018-05-10 18:37:56', '192.168.1.201', 'admin', '使用者登出'),
(127, '2018-05-10 18:38:12', '192.168.1.201', 'admin', '使用者登入'),
(128, '2018-05-10 18:43:25', '192.168.1.201', 'admin', '使用者登出'),
(129, '2018-05-10 18:45:39', '', '', '使用者登出'),
(130, '2018-05-10 18:46:05', '192.168.1.201', 'admin', '使用者登入'),
(131, '2018-05-10 18:46:08', '', 'admin', '使用者登出'),
(132, '2018-05-10 18:46:44', '192.168.1.201', 'admin', '使用者登入'),
(133, '2018-05-10 18:47:55', '', 'admin', '使用者登出'),
(134, '2018-05-10 18:49:14', '', '', '使用者登出'),
(135, '2018-05-10 18:49:18', '192.168.1.201', 'admin', '使用者登入'),
(136, '2018-05-10 18:49:20', '', 'admin', '使用者登出'),
(137, '2018-05-10 18:50:46', '', '', '使用者登出'),
(138, '2018-05-10 18:50:50', '', '', '使用者登出'),
(139, '2018-05-10 18:50:58', '192.168.1.201', 'admin', '使用者登入'),
(140, '2018-05-10 18:51:09', '', 'admin', '使用者登出'),
(141, '2018-05-11 09:23:39', '', '', '使用者登出'),
(142, '2018-05-11 09:23:51', '', '', '使用者登出'),
(143, '2018-05-11 09:23:58', '192.168.1.201', 'admin', '使用者登入'),
(144, '2018-05-11 09:24:18', '192.168.1.201', 'admin', '使用者登入'),
(145, '2018-05-11 09:28:56', '192.168.1.201', 'admin', '使用者登入'),
(146, '2018-05-11 09:29:37', '192.168.1.201', 'admin', '使用者登入'),
(147, '2018-05-11 09:32:49', '192.168.1.201', 'admin', '使用者登入'),
(148, '2018-05-11 09:33:52', '', 'admin', '使用者登出'),
(149, '2018-05-11 09:40:36', '192.168.1.201', 'admin', '使用者登入'),
(150, '2018-05-11 09:42:29', '192.168.1.201', 'admin', '使用者登入'),
(151, '2018-05-11 09:43:11', '192.168.1.201', 'admin', '使用者登入'),
(152, '2018-05-11 09:45:14', '192.168.1.201', 'admin', '使用者登入'),
(153, '2018-05-11 09:45:33', '192.168.1.201', 'admin', '使用者登入'),
(154, '2018-05-11 09:57:27', '', 'admin', '使用者登出'),
(155, '2018-05-11 10:02:58', '', '', '使用者登出'),
(156, '2018-05-11 10:41:32', '192.168.1.201', 'admin', '使用者登入'),
(157, '2018-05-11 10:45:38', '192.168.1.201', 'admin', '使用者登入'),
(158, '2018-05-11 10:46:25', '', 'admin', '使用者登出'),
(159, '2018-05-11 10:46:27', '192.168.1.201', 'admin', '使用者登入'),
(160, '2018-05-11 10:47:03', '192.168.1.201', 'admin', '使用者登入'),
(161, '2018-05-11 11:45:57', '', 'admin', '使用者登入'),
(162, '2018-05-11 11:49:26', '', 'admin', '使用者登出'),
(163, '2018-05-11 11:49:27', '', 'admin', '使用者登入'),
(164, '2018-05-11 11:56:20', '', 'admin', '使用者登入'),
(165, '2018-05-11 13:17:34', '', 'admin', '使用者登出'),
(166, '2018-05-11 13:17:53', '', 'admin', '使用者登入'),
(167, '2018-05-11 13:22:31', '', 'admin', '使用者登出'),
(168, '2018-05-11 13:27:18', '', 'admin', '使用者登入'),
(169, '2018-05-11 13:28:31', '', 'admin', '使用者登出'),
(170, '2018-05-11 13:29:28', '', 'admin', '使用者登入'),
(171, '2018-05-11 15:18:10', '', 'admin', '使用者登入'),
(172, '2018-05-11 16:26:27', '', 'admin', '使用者登出'),
(173, '2018-05-11 17:55:59', '', 'admin', '使用者登入'),
(174, '2018-05-11 17:57:57', '', 'admin', '使用者登入'),
(175, '2018-05-11 18:31:27', '192.168.1.201', 'admin', '使用者登入'),
(176, '2018-05-11 18:55:08', '192.168.1.201', 'admin', '使用者登入'),
(177, '2018-05-11 18:57:13', '192.168.1.201', 'admin', '使用者登入'),
(178, '2018-05-11 18:57:22', '192.168.1.201', 'admin', '使用者登入');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `dt` date NOT NULL,
  `category_id` int(11) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `descript` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `dt`, `category_id`, `contract_id`, `descript`) VALUES
(151684, '2018-03-29', 1, 1, '檢查電梯電力插頭'),
(151685, '2018-03-30', 1, 4, '檢查電梯電力插頭'),
(151686, '2018-06-30', 1, 4, '檢查電梯電力插頭'),
(151687, '2018-09-21', 1, 4, '檢查電梯電力插頭'),
(151688, '2018-12-30', 1, 4, '檢查電梯電力插頭'),
(151975, '2018-05-12', 6, 0, '作業內容'),
(151976, '2018-03-30', 3, 1, '檢查電梯電力插頭'),
(151977, '2018-04-09', 1, 0, '作業內容'),
(151978, '2018-05-09', 1, 0, '作業內容'),
(151979, '2018-06-09', 1, 0, '作業內容'),
(151980, '2018-07-09', 1, 0, '作業內容'),
(151981, '2018-08-09', 1, 0, '作業內容'),
(151982, '2018-09-09', 1, 0, '作業內容'),
(151983, '2018-10-09', 1, 0, '作業內容'),
(151984, '2018-11-09', 1, 0, '作業內容'),
(151985, '2018-12-09', 1, 0, '作業內容');

-- --------------------------------------------------------

--
-- Table structure for table `task_category`
--

CREATE TABLE `task_category` (
  `id` int(11) NOT NULL,
  `category` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_category`
--

INSERT INTO `task_category` (`id`, `category`) VALUES
(1, '電梯'),
(2, '消防'),
(3, '基地'),
(4, '花園'),
(5, '健身房'),
(6, '游泳池'),
(7, '其他');

-- --------------------------------------------------------

--
-- Table structure for table `task_repeat`
--

CREATE TABLE `task_repeat` (
  `id` int(11) NOT NULL,
  `duration` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_repeat`
--

INSERT INTO `task_repeat` (`id`, `duration`) VALUES
(0, '單次'),
(1, '每日'),
(2, '每月'),
(3, '每季'),
(4, '每年');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `account` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `account`, `password`, `role_id`) VALUES
(1, 'admin', '0000', 1),
(6, 'guest', '0000', 0),
(7, 'staff', '0000', 2),
(8, '188-1-12', '0000', 0),
(9, '188-2-12', '0000', 0),
(10, '190-2-1', '0000', 0),
(11, '300-15', '0000', 0),
(12, '300-14', '0000', 0),
(13, '300-13', '0000', 0),
(14, '300-12', '0000', 0),
(15, '300-11', '0000', 0),
(16, '300-10', '0000', 0),
(17, '300-9', '0000', 0),
(18, '300-8', '0000', 0),
(19, '300-7', '0000', 0),
(20, '300-6', '0000', 0),
(21, '300-5', '0000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `whois`
--

CREATE TABLE `whois` (
  `id` int(11) NOT NULL,
  `who` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `whois`
--

INSERT INTO `whois` (`id`, `who`) VALUES
(1, '區權人'),
(2, '住戶');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apartment`
--
ALTER TABLE `apartment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_category`
--
ALTER TABLE `asset_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_status`
--
ALTER TABLE `asset_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_acc`
--
ALTER TABLE `bank_acc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_acc_type`
--
ALTER TABLE `bank_acc_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget_type`
--
ALTER TABLE `budget_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `committee`
--
ALTER TABLE `committee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `committee_role`
--
ALTER TABLE `committee_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract_item`
--
ALTER TABLE `contract_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elect_fee`
--
ALTER TABLE `elect_fee`
  ADD PRIMARY KEY (`yyyymm`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eval_category`
--
ALTER TABLE `eval_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eval_detail`
--
ALTER TABLE `eval_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eval_examinor`
--
ALTER TABLE `eval_examinor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eval_item`
--
ALTER TABLE `eval_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eval_type`
--
ALTER TABLE `eval_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facility_reserve`
--
ALTER TABLE `facility_reserve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_type`
--
ALTER TABLE `file_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hoa_fee_defined`
--
ALTER TABLE `hoa_fee_defined`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hoa_fee_month_printed`
--
ALTER TABLE `hoa_fee_month_printed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hoa_fee_record`
--
ALTER TABLE `hoa_fee_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hoa_fee_type`
--
ALTER TABLE `hoa_fee_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hoa_fee_unpaid`
--
ALTER TABLE `hoa_fee_unpaid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hoa_month_checked`
--
ALTER TABLE `hoa_month_checked`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `household`
--
ALTER TABLE `household`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `addr_no` (`addr_no`,`floor`);

--
-- Indexes for table `household_purpose`
--
ALTER TABLE `household_purpose`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `household_status`
--
ALTER TABLE `household_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `household_used_for`
--
ALTER TABLE `household_used_for`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hs-sr`
--
ALTER TABLE `hs-sr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `license`
--
ALTER TABLE `license`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `license_of_staff`
--
ALTER TABLE `license_of_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `license_type`
--
ALTER TABLE `license_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mails_log`
--
ALTER TABLE `mails_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_att`
--
ALTER TABLE `meeting_att`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_type`
--
ALTER TABLE `meeting_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opinions`
--
ALTER TABLE `opinions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opinion_type`
--
ALTER TABLE `opinion_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `real_estate_agent`
--
ALTER TABLE `real_estate_agent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `real_estate_agent_event`
--
ALTER TABLE `real_estate_agent_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `round`
--
ALTER TABLE `round`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_item`
--
ALTER TABLE `service_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shift_table`
--
ALTER TABLE `shift_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shift_table_record`
--
ALTER TABLE `shift_table_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `space_change`
--
ALTER TABLE `space_change`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_role`
--
ALTER TABLE `staff_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_work_time`
--
ALTER TABLE `staff_work_time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supply_type`
--
ALTER TABLE `supply_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_log`
--
ALTER TABLE `system_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_category`
--
ALTER TABLE `task_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_repeat`
--
ALTER TABLE `task_repeat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whois`
--
ALTER TABLE `whois`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `asset_category`
--
ALTER TABLE `asset_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `asset_status`
--
ALTER TABLE `asset_status`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bank_acc`
--
ALTER TABLE `bank_acc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bank_acc_type`
--
ALTER TABLE `bank_acc_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `budget_type`
--
ALTER TABLE `budget_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `committee`
--
ALTER TABLE `committee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `contract_item`
--
ALTER TABLE `contract_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `eval_detail`
--
ALTER TABLE `eval_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

--
-- AUTO_INCREMENT for table `eval_examinor`
--
ALTER TABLE `eval_examinor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `eval_item`
--
ALTER TABLE `eval_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `facility_reserve`
--
ALTER TABLE `facility_reserve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `file_type`
--
ALTER TABLE `file_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hoa_fee_defined`
--
ALTER TABLE `hoa_fee_defined`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `hoa_fee_month_printed`
--
ALTER TABLE `hoa_fee_month_printed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `hoa_fee_record`
--
ALTER TABLE `hoa_fee_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `hoa_fee_type`
--
ALTER TABLE `hoa_fee_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hoa_fee_unpaid`
--
ALTER TABLE `hoa_fee_unpaid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hoa_month_checked`
--
ALTER TABLE `hoa_month_checked`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `household`
--
ALTER TABLE `household`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `household_purpose`
--
ALTER TABLE `household_purpose`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `household_status`
--
ALTER TABLE `household_status`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `household_used_for`
--
ALTER TABLE `household_used_for`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hs-sr`
--
ALTER TABLE `hs-sr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '對應到household的PK', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `license`
--
ALTER TABLE `license`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `license_of_staff`
--
ALTER TABLE `license_of_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `license_type`
--
ALTER TABLE `license_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mails`
--
ALTER TABLE `mails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `mails_log`
--
ALTER TABLE `mails_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `meeting_att`
--
ALTER TABLE `meeting_att`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `meeting_type`
--
ALTER TABLE `meeting_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `opinions`
--
ALTER TABLE `opinions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `opinion_type`
--
ALTER TABLE `opinion_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `real_estate_agent`
--
ALTER TABLE `real_estate_agent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `real_estate_agent_event`
--
ALTER TABLE `real_estate_agent_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `round`
--
ALTER TABLE `round`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_item`
--
ALTER TABLE `service_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `shift_table`
--
ALTER TABLE `shift_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=643;

--
-- AUTO_INCREMENT for table `shift_table_record`
--
ALTER TABLE `shift_table_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `space_change`
--
ALTER TABLE `space_change`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staff_work_time`
--
ALTER TABLE `staff_work_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `supply_type`
--
ALTER TABLE `supply_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `system_log`
--
ALTER TABLE `system_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151986;

--
-- AUTO_INCREMENT for table `task_category`
--
ALTER TABLE `task_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `task_repeat`
--
ALTER TABLE `task_repeat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `whois`
--
ALTER TABLE `whois`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
