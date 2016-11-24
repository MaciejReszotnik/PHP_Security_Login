-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 14 Cze 2014, 13:55
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test_sb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `allowed_messages`
--

CREATE TABLE IF NOT EXISTS `allowed_messages` (
  `user_id` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `message_id` int(11) NOT NULL,
  `owner` tinyint(1) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `message_id` (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `allowed_messages`
--

INSERT INTO `allowed_messages` (`user_id`, `message_id`, `owner`) VALUES
('test1', 1, 1),
('test1', 13, 1),
('test1', 14, 1),
('test2', 13, 1),
('test3', 13, 1),
('test2', 14, 1),
('test1', 19, 1),
('test3', 14, 1),
('test3', 1, 1),
('test1', 20, 0),
('test1', 23, 1),
('test3', 19, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `hashed_passes`
--

CREATE TABLE IF NOT EXISTS `hashed_passes` (
  `pass_id` int(11) NOT NULL AUTO_INCREMENT,
  `pass_hash` varchar(5000) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `pass_salt` varchar(5000) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `mask` varchar(500) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `user_id` varchar(25) NOT NULL,
  `if_not_validated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pass_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=134 ;

--
-- Zrzut danych tabeli `hashed_passes`
--

INSERT INTO `hashed_passes` (`pass_id`, `pass_hash`, `pass_salt`, `mask`, `user_id`, `if_not_validated`) VALUES
(23, '522643015dfe9a81cd80d7831d111ab692908cec', '394892857539a14d5bb59f5.54746947', 'a:5:{i:0;i:2;i:1;i:3;i:2;i:4;i:3;i:12;i:4;i:14;}', 'attisplecourse', 0),
(24, '9778af04a1fa0d513fa98fbc2f2a1fc5d87f0352', '1484084055539a14d5bce465.68928482', 'a:8:{i:0;i:1;i:1;i:2;i:2;i:5;i:3;i:8;i:4;i:9;i:5;i:12;i:6;i:13;i:7;i:14;}', 'attisplecourse', 0),
(25, '64309da541771dee8934daab5d7e5677a526ac43', '747529152539a14d5be6683.50584739', 'a:6:{i:0;i:2;i:1;i:3;i:2;i:6;i:3;i:8;i:4;i:9;i:5;i:12;}', 'attisplecourse', 0),
(26, 'bb38a2519b080cc7d92b3918e60bb7c3f35984cb', '729415714539a14d5c04967.15136724', 'a:8:{i:0;i:3;i:1;i:6;i:2;i:7;i:3;i:8;i:4;i:9;i:5;i:10;i:6;i:12;i:7;i:13;}', 'attisplecourse', 0),
(27, '67548767c84139f9d60fcfae1a1f4c569d4f2c42', '1369415276539a14d5c1d491.18379417', 'a:5:{i:0;i:5;i:1;i:6;i:2;i:8;i:3;i:11;i:4;i:13;}', 'attisplecourse', 0),
(28, '43506d1eccde7b4c4252372c613ce753c8cdfd29', '1862805423539a14d5c35319.32709817', 'a:6:{i:0;i:0;i:1;i:1;i:2;i:5;i:3;i:7;i:4;i:12;i:5;i:13;}', 'attisplecourse', 0),
(29, 'bd83d54d8952caeb4916bef5647f93c437a8f8ac', '2090254746539a14d5c4c435.33444307', 'a:7:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:12;i:6;i:13;}', 'attisplecourse', 0),
(30, '00f9ce9fcfdaf662c35fc9a2f1ec372392c489cc', '825656903539a14d5c63f09.25373295', 'a:8:{i:0;i:1;i:1;i:3;i:2;i:4;i:3;i:8;i:4;i:9;i:5;i:11;i:6;i:13;i:7;i:14;}', 'attisplecourse', 0),
(31, 'f9f54525482a32ed02509e9c80113c47d5b07d2f', '1244619787539a14d5c7aeb4.92277834', 'a:7:{i:0;i:1;i:1;i:4;i:2;i:6;i:3;i:9;i:4;i:10;i:5;i:11;i:6;i:12;}', 'attisplecourse', 0),
(32, '98ef2178a70b02737d49d90e28b2c358370d83fe', '1032011372539a14d5c91310.69818180', 'a:7:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:9;i:5;i:10;i:6;i:11;}', 'attisplecourse', 0),
(54, '36385836fd540dd58a0322969794a525e377b8ad', '548735736539c2e5ed0bb70.58558784', 'a:5:{i:0;i:4;i:1;i:5;i:2;i:10;i:3;i:11;i:4;i:12;}', 'MCOpeniTflat', 0),
(55, 'dd7220ace0a7e1465966289913a001493edd358e', '2061049104539c2e5ed242b9.90592641', 'a:7:{i:0;i:0;i:1;i:2;i:2;i:4;i:3;i:6;i:4;i:8;i:5;i:9;i:6;i:12;}', 'MCOpeniTflat', 0),
(56, '029f10af5b077a1f81623d4f144f10aa1f21eba9', '163991522539c2e5ed4add1.91201812', 'a:6:{i:0;i:3;i:1;i:4;i:2;i:7;i:3;i:10;i:4;i:11;i:5;i:12;}', 'MCOpeniTflat', 0),
(57, '49f26b7a049364d7feae0f1534078094be314df0', '958397893539c2e5ed5b772.57814134', 'a:6:{i:0;i:1;i:1;i:3;i:2;i:4;i:3;i:7;i:4;i:9;i:5;i:12;}', 'MCOpeniTflat', 0),
(58, 'cd4fe83659f7644eba9bcc2672e6ec7f321e01b9', '1960265999539c2e5ed64f85.89499399', 'a:5:{i:0;i:3;i:1;i:5;i:2;i:8;i:3;i:10;i:4;i:11;}', 'MCOpeniTflat', 0),
(59, '3c635c03acce1e897254da2213bbe1ffc31bfcf9', '969475105539c2e5ed84d20.06740765', 'a:7:{i:0;i:2;i:1;i:3;i:2;i:5;i:3;i:6;i:4;i:7;i:5;i:9;i:6;i:10;}', 'MCOpeniTflat', 0),
(60, '9a8d55731f64b7af2a1e44839e7ab3f08d2341a0', '862229095539c2e5eda78b2.54932693', 'a:5:{i:0;i:4;i:1;i:5;i:2;i:7;i:3;i:10;i:4;i:11;}', 'MCOpeniTflat', 0),
(61, '2cf7afbe96d00791de19594c39da02d83fb2ef48', '190281595539c2e5edb2b61.03065697', 'a:7:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:5;i:4;i:8;i:5;i:11;i:6;i:12;}', 'MCOpeniTflat', 0),
(62, 'fd3fccf39be1447796d7cf22131b36acc0219775', '1115110590539c2e5edbd298.64971378', 'a:6:{i:0;i:1;i:1;i:5;i:2;i:6;i:3;i:10;i:4;i:11;i:5;i:12;}', 'MCOpeniTflat', 0),
(63, 'b5cb41418fc7ef7b84fa2c73b2c426fbc1c7b766', '58260610539c2e5edc8147.74360757', 'a:5:{i:0;i:0;i:1;i:2;i:2;i:5;i:3;i:8;i:4;i:11;}', 'MCOpeniTflat', 0),
(64, '2011ea0c49df6bb85a7cd7918f8448e5183a2b88', '934754984539c2ee1debf52.81011520', 'a:5:{i:0;i:0;i:1;i:6;i:2;i:7;i:3;i:9;i:4;i:12;}', 'qwerty', 0),
(65, '487f431fe490416959844fca598698af06103965', '21507888539c2ee1e04352.43197780', 'a:6:{i:0;i:0;i:1;i:1;i:2;i:8;i:3;i:11;i:4;i:12;i:5;i:14;}', 'qwerty', 0),
(66, 'c1cf3105e18a695429495641ddc218e757cef62e', '1431688889539c2ee1e31a36.52601546', 'a:6:{i:0;i:0;i:1;i:1;i:2;i:3;i:3;i:5;i:4;i:9;i:5;i:10;}', 'qwerty', 0),
(67, '49aac3a6ee11b11b8a6462a116ebb0da7419a0f0', '152022321539c2ee1e478d5.10017861', 'a:7:{i:0;i:0;i:1;i:3;i:2;i:6;i:3;i:9;i:4;i:10;i:5;i:11;i:6;i:14;}', 'qwerty', 0),
(68, '799da004e60ce0aa76185259c1792543eb946c93', '1774285823539c2ee1e5e758.53331170', 'a:8:{i:0;i:0;i:1;i:2;i:2;i:4;i:3;i:6;i:4;i:9;i:5;i:10;i:6;i:13;i:7;i:14;}', 'qwerty', 0),
(69, '0e9223c75d0903db3cfbd923d8d8e71396854365', '1740432655539c2ee1e7ea63.07689873', 'a:8:{i:0;i:0;i:1;i:1;i:2;i:4;i:3;i:7;i:4;i:10;i:5;i:11;i:6;i:12;i:7;i:13;}', 'qwerty', 0),
(70, '5328b4c431c549632fb8c11219210a9c6fbdbddc', '607023738539c2ee1e94f78.59668802', 'a:8:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;i:4;i:9;i:5;i:10;i:6;i:13;i:7;i:14;}', 'qwerty', 0),
(71, 'f2c975f6731a8a81efa478a21a75665e7189856e', '411938660539c2ee1eac847.96482784', 'a:5:{i:0;i:5;i:1;i:6;i:2;i:7;i:3;i:9;i:4;i:13;}', 'qwerty', 0),
(72, 'd5d49867b52dae1896fd6dee85ccaa151807a15a', '1775420299539c2ee1ec2581.10235433', 'a:6:{i:0;i:2;i:1;i:4;i:2;i:8;i:3;i:9;i:4;i:10;i:5;i:14;}', 'qwerty', 0),
(73, '950f961dd12eab917f47aa3453db35e46796fed7', '1773276925539c2ee1ed98d4.03789974', 'a:5:{i:0;i:3;i:1;i:5;i:2;i:7;i:3;i:13;i:4;i:14;}', 'qwerty', 0),
(74, 'd90c4699093e4c5a311ab525bc3ce39ba2830651', '1680987363539c2f82392a83.40960058', 'a:7:{i:0;i:0;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:10;i:5;i:12;i:6;i:14;}', '5678', 0),
(75, '7fec56dae539aad9379572b16e2b6c0088bca582', '2129064717539c2f823a9e72.62557531', 'a:8:{i:0;i:1;i:1;i:3;i:2;i:4;i:3;i:7;i:4;i:8;i:5;i:10;i:6;i:12;i:7;i:13;}', '5678', 0),
(76, '2229e772deae9aae5e4c39730adc8151bb883c4f', '981431869539c2f823c0b71.20245298', 'a:5:{i:0;i:0;i:1;i:3;i:2;i:8;i:3;i:9;i:4;i:11;}', '5678', 0),
(77, '52f6821ec2ea925a1b532c0ed9fdcccd26b3546b', '1603361232539c2f823d7c91.93242660', 'a:7:{i:0;i:1;i:1;i:3;i:2;i:4;i:3;i:5;i:4;i:9;i:5;i:10;i:6;i:14;}', '5678', 0),
(78, 'd9b4269b987da8560d534cb1ffcf1feb81abf214', '1599137867539c2f823ef877.35049216', 'a:8:{i:0;i:3;i:1;i:5;i:2;i:6;i:3;i:7;i:4;i:9;i:5;i:10;i:6;i:12;i:7;i:14;}', '5678', 0),
(79, '9ec1be018e95b0f52b9bf5b1cfc2e2b736556d76', '2120151859539c2f82402c57.14804868', 'a:8:{i:0;i:3;i:1;i:5;i:2;i:6;i:3;i:7;i:4;i:8;i:5;i:12;i:6;i:13;i:7;i:14;}', '5678', 0),
(80, '1c5bec3ce93b57553145482a2ffa7d59cee391a2', '1466586855539c2f8242d5c1.88617781', 'a:5:{i:0;i:0;i:1;i:3;i:2;i:6;i:3;i:9;i:4;i:13;}', '5678', 0),
(81, 'de9f404a993bae8fc2cae609fb5b0ad0b2ec2721', '15591347539c2f8243fe55.58105722', 'a:8:{i:0;i:1;i:1;i:3;i:2;i:4;i:3;i:7;i:4;i:8;i:5;i:12;i:6;i:13;i:7;i:14;}', '5678', 0),
(82, 'e2e95d40b1b86d9c5ba87306970d24f762d67fbf', '897358891539c2f82450313.06092072', 'a:6:{i:0;i:2;i:1;i:3;i:2;i:8;i:3;i:9;i:4;i:10;i:5;i:14;}', '5678', 0),
(83, 'fab77082ce720057907a791e21a6443da650b607', '1733815876539c2f82460d20.78117126', 'a:6:{i:0;i:3;i:1;i:4;i:2;i:8;i:3;i:11;i:4;i:13;i:5;i:14;}', '5678', 0),
(84, '2a7b8dd128938543cdb7a8906caad9a4571c0ed6', '1912363125539c2ffe3a33f6.72428724', 'a:6:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:7;i:4;i:12;i:5;i:14;}', 'aaaarnold', 0),
(85, 'd3b538902c338cd0dead34287f8749256bbfdcc0', '2034946651539c2ffe3d88b0.46377757', 'a:6:{i:0;i:0;i:1;i:3;i:2;i:7;i:3;i:11;i:4;i:12;i:5;i:14;}', 'aaaarnold', 0),
(86, 'b57a6a3084934d15f27e3831eaee91d0d596a494', '1063197646539c2ffe3ef3e5.43457104', 'a:8:{i:0;i:0;i:1;i:2;i:2;i:5;i:3;i:6;i:4;i:8;i:5;i:10;i:6;i:12;i:7;i:13;}', 'aaaarnold', 0),
(87, 'c0ee03fd08296b6194489bd6997f19a3bf4110bc', '936785641539c2ffe406e78.86040237', 'a:8:{i:0;i:1;i:1;i:2;i:2;i:5;i:3;i:7;i:4;i:9;i:5;i:10;i:6;i:13;i:7;i:14;}', 'aaaarnold', 0),
(88, '094f40fcde02db3f3a7231c629485d1ffd25cdf8', '784880471539c2ffe4202b2.27981793', 'a:8:{i:0;i:0;i:1;i:1;i:2;i:2;i:3;i:4;i:4;i:5;i:5;i:9;i:6;i:10;i:7;i:14;}', 'aaaarnold', 0),
(89, 'ea125d57093d86eb26215b5180887e9fe53594a0', '1873014523539c2ffe439727.12018862', 'a:7:{i:0;i:2;i:1;i:4;i:2;i:6;i:3;i:8;i:4;i:12;i:5;i:13;i:6;i:14;}', 'aaaarnold', 0),
(90, 'c360f8ef42dc7f15deb95d217873929f913a1560', '1876579590539c2ffe451972.62342682', 'a:6:{i:0;i:0;i:1;i:1;i:2;i:4;i:3;i:7;i:4;i:8;i:5;i:14;}', 'aaaarnold', 0),
(91, '611c62589d9ea75bc999e413a08e10f2f1bc387a', '96276943539c2ffe472e12.70131999', 'a:8:{i:0;i:1;i:1;i:3;i:2;i:4;i:3;i:5;i:4;i:6;i:5;i:9;i:6;i:12;i:7;i:13;}', 'aaaarnold', 0),
(92, '88126397b927cf86f18e5eb885f2a02e9dde19a0', '1422824794539c2ffe48f392.00643587', 'a:6:{i:0;i:1;i:1;i:3;i:2;i:4;i:3;i:6;i:4;i:7;i:5;i:13;}', 'aaaarnold', 0),
(93, '34fb90de457bd56c0f75366b116620e3ac225faf', '909519609539c2ffe4a5f83.50664429', 'a:5:{i:0;i:0;i:1;i:3;i:2;i:5;i:3;i:7;i:4;i:11;}', 'aaaarnold', 0),
(104, 'cf44e3ded3a752cbbbf65710aae8d5a9dcbd927b', '282365214539c30f2cfbc69.66643813', 'a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:6;i:4;i:7;}', 'ccarnold', 0),
(105, 'c1f138390478f995edc757a8995904ed3a0464b5', '742031944539c30f2d0cdc0.71623104', 'a:5:{i:0;i:2;i:1;i:3;i:2;i:6;i:3;i:7;i:4;i:9;}', 'ccarnold', 0),
(106, 'd4408f60ba572dc1c92d939ddaff88ee1e204356', '205777621539c30f2d1e8c3.44514766', 'a:5:{i:0;i:0;i:1;i:3;i:2;i:5;i:3;i:7;i:4;i:8;}', 'ccarnold', 0),
(107, 'c2dfe1d35fc4bcedaa78170ed7a1af93a880916a', '1614675699539c30f2d31098.17628516', 'a:5:{i:0;i:0;i:1;i:2;i:2;i:3;i:3;i:5;i:4;i:9;}', 'ccarnold', 0),
(108, '9b2f8304376079e20439a20c1aee882e110c85c4', '1647337236539c30f2d42029.01952467', 'a:5:{i:0;i:0;i:1;i:1;i:2;i:2;i:3;i:8;i:4;i:9;}', 'ccarnold', 0),
(109, '8edd52242d1e906197d515525d8c3609db3cf60d', '778082532539c30f2d4c7e1.24602067', 'a:5:{i:0;i:0;i:1;i:1;i:2;i:2;i:3;i:6;i:4;i:9;}', 'ccarnold', 0),
(110, 'dcd3b7443555569702db33738d6c53ce39022ddb', '889049604539c30f2d56e22.34198669', 'a:5:{i:0;i:0;i:1;i:2;i:2;i:3;i:3;i:6;i:4;i:9;}', 'ccarnold', 0),
(111, 'ecd0c68bf091fca88e5cc82f9899b854bd7c3f3b', '471047460539c30f2d61ad4.51949381', 'a:5:{i:0;i:0;i:1;i:2;i:2;i:4;i:3;i:6;i:4;i:8;}', 'ccarnold', 0),
(112, '79c9e522af0e555bbd0bdb670b1799d27f547d1a', '1710033447539c30f2d6c044.82689557', 'a:5:{i:0;i:0;i:1;i:3;i:2;i:5;i:3;i:6;i:4;i:7;}', 'ccarnold', 0),
(113, '0c47ac4c2abd8af7a2adc2b048b3c135f33b6185', '1415134801539c30f2d76ff9.18341078', 'a:5:{i:0;i:0;i:1;i:1;i:2;i:5;i:3;i:6;i:4;i:8;}', 'ccarnold', 0),
(124, 'f3980b3fa2961f6a62d96b3e0855420fe4e5148c', '2031658959539c370a8e0bc7.63263057', 'a:5:{i:0;i:0;i:1;i:2;i:2;i:5;i:3;i:7;i:4;i:9;}', 'vvbbbbkol', 0),
(125, '9c2d12f690fa1e633f7492acdae4cff6e5814be5', '1087349064539c370a8eb047.66903947', 'a:5:{i:0;i:0;i:1;i:4;i:2;i:5;i:3;i:6;i:4;i:8;}', 'vvbbbbkol', 0),
(126, 'e2f158cd22b0fb3ea7b489d6b494f59b8889befe', '175829452539c370a8fb380.27688118', 'a:5:{i:0;i:0;i:1;i:3;i:2;i:4;i:3;i:5;i:4;i:9;}', 'vvbbbbkol', 0),
(127, '3cedd4f9e91e32af2fdb015ad150d4b1e3dcc7a0', '1737429491539c370a90bea3.10637429', 'a:5:{i:0;i:0;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:8;}', 'vvbbbbkol', 0),
(128, 'c55a2b8e42b0373cd866b562c71d68dc03980f56', '306742577539c370a9343b8.33301496', 'a:5:{i:0;i:3;i:1;i:4;i:2;i:5;i:3;i:6;i:4;i:9;}', 'vvbbbbkol', 0),
(129, 'b138d85251ef06a238e8799b8c89a94a51de69c3', '1538621759539c370a943752.45910498', 'a:5:{i:0;i:1;i:1;i:5;i:2;i:6;i:3;i:8;i:4;i:9;}', 'vvbbbbkol', 0),
(130, 'd264201422df8f93ec7f81f944eb050eeff82b4a', '2046459709539c370a94cef9.79234298', 'a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:6;i:4;i:7;}', 'vvbbbbkol', 0),
(131, 'c3f6427afcbc726ca7e3ffa2127efe93d7214e4a', '789316017539c370a96f9b9.34221011', 'a:5:{i:0;i:0;i:1;i:1;i:2;i:5;i:3;i:6;i:4;i:9;}', 'vvbbbbkol', 0),
(132, 'a2b3e88db5b854d5b1d12155c300cea965091677', '617772206539c370a978ad7.86496192', 'a:5:{i:0;i:2;i:1;i:5;i:2;i:6;i:3;i:8;i:4;i:9;}', 'vvbbbbkol', 0),
(133, '8e4abc4e80f014e00e3bc3476222e574ac168355', '1433161172539c370a981472.76623780', 'a:5:{i:0;i:1;i:1;i:3;i:2;i:4;i:3;i:7;i:4;i:8;}', 'vvbbbbkol', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `text_msg` varchar(500) CHARACTER SET latin1 NOT NULL,
  `mod_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Zrzut danych tabeli `message`
--

INSERT INTO `message` (`message_id`, `text_msg`, `mod_time`) VALUES
(1, 'Whale (origin Old English hwæl from Proto-Germanic *hwalaz) is the common name for various marine mammals of the order Cetacea.[1] The term whale sometimes refers to all cetaceans, but more often it excludes dolphins and porpoises, which belong to the suborder Odontoceti (toothed whales). This suborder includes the sperm whale, killer whale, pilot whale, and beluga whale. The other Cetacean suborder, Mysticeti (baleen whales), comprises filter feeders that eat small organisms caught by straining', '2014-04-21 10:16:00'),
(13, 'The cat was playing in the garden.\r\n   ', '2014-04-23 18:37:10'),
(14, 'Th bombastycznie ', '2014-05-03 10:24:33'),
(18, 'The cat was playing in the garden.\r\n   ', '2014-04-24 18:17:41'),
(19, 'Najnowszy wpis 3333\r\n   ', '2014-05-03 10:26:12'),
(20, 'testowa message', '2014-05-03 10:38:07'),
(23, 'absolutnie nowy wpis', '2014-05-03 10:44:06');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `non_existent_users`
--

CREATE TABLE IF NOT EXISTS `non_existent_users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `fake_user` varchar(25) DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `no_allowed_fails` int(11) NOT NULL DEFAULT '3',
  `no_fails` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Zrzut danych tabeli `non_existent_users`
--

INSERT INTO `non_existent_users` (`ID`, `fake_user`, `last_login`, `no_allowed_fails`, `no_fails`) VALUES
(1, 'terer', '2014-05-08 15:40:44', 3, 0),
(2, 'rere', '2014-05-08 15:40:49', 3, 0),
(3, 'test34534', '2014-05-08 15:50:23', 9, 2),
(4, 'dsfdg', '2014-05-08 15:51:53', 7, 1),
(5, 'gdgdsg', '2014-05-09 15:33:03', 3, 4),
(6, 'sdfdg', '2014-05-09 15:29:12', 9, 1),
(7, '1234', '2014-05-10 02:44:09', 3, 1),
(8, 'Terra K', '2014-06-14 07:14:50', 7, 8),
(9, 'fsdfsd', '2014-06-14 08:44:45', 5, 1),
(10, 'Ronallddd', '2014-06-14 08:45:03', 3, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `password_hash` varchar(5000) COLLATE utf8_polish_ci NOT NULL,
  `salt` varchar(5000) COLLATE utf8_polish_ci DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_failed_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `no_allowed_fails` int(11) NOT NULL DEFAULT '0',
  `no_fails` int(11) NOT NULL DEFAULT '0',
  `no_fails_display` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_id`, `password_hash`, `salt`, `last_login`, `last_failed_login`, `no_allowed_fails`, `no_fails`, `no_fails_display`) VALUES
('12345', 'e930c7a26859be0afbe448b7e5104c48a6e2eddb', '5957950335399df888c98b6.28197648', '2014-06-12 17:13:22', '0000-00-00 00:00:00', 0, 0, 0),
('123456', 'e9ebd838981f38782bda42ad083c737a3f1e782d', '407519113539a09617e4a02.97584801', '2014-06-12 20:11:13', '0000-00-00 00:00:00', 0, 0, 0),
('1234567', 'dddf16c155eb52ba0c1a54e61253aedd40d42f92', '2114179204539a0c13b6ab31.21053292', '2014-06-12 20:22:43', '0000-00-00 00:00:00', 0, 0, 0),
('5678', '0c1530df97a1247d31dae82eea32b950ee448fda', '513227443539c2f8236e030.58581962', '2014-06-14 11:18:26', '0000-00-00 00:00:00', 0, 0, 0),
('aaaarnold', 'd075b35bbd42dcaa4f7f4111cf9344ff97eef8d9', '521109738539c2ffe373d68.74045122', '2014-06-14 11:21:24', '2014-06-14 11:21:24', 0, 1, 0),
('ABCD', '2a85a625beb9d8b1f1b77ae31113348e983fe154', '10866760653993df68b0cc5.65336436', '2014-06-12 05:43:18', '0000-00-00 00:00:00', 0, 0, 0),
('acmlesstores', '196f052f577d6c135a84a2230f7be997048eb67e', '297366562539a1301eca271.64664641', '2014-06-12 20:52:17', '0000-00-00 00:00:00', 0, 0, 0),
('attisplecourse', '198451b828f4298b95e20c7ba0bb54309e8f6433', '411961898539a14d5b91472.66641144', '2014-06-12 21:00:05', '0000-00-00 00:00:00', 0, 0, 0),
('ccarnold', '37294a19a9d4d25c599a88937987c1184a1d0763', '271465902539c30f2cc42b4.12324597', '2014-06-14 11:24:34', '0000-00-00 00:00:00', 0, 0, 0),
('electedAdepit', '623f243fbdf6d0403e75972ddaa348a0e2514ef5', '1330486657539a0f4bd70146.81073536', '2014-06-12 20:36:27', '0000-00-00 00:00:00', 0, 0, 0),
('ernest', 'haslociasto', NULL, '2014-06-09 17:03:51', '0000-00-00 00:00:00', 0, 0, 0),
('Kamil', '83116ebbfb05e143fa9c5ccf8569da4c128ee37a', '189837189353993c78c3a093.85610835', '2014-06-12 05:36:56', '0000-00-00 00:00:00', 0, 0, 0),
('Korneliusz', '2a85a625beb9d8b1f1b77ae31113348e983fe154', '10866760653993df68b0cc5.65336436', '2014-06-12 20:18:51', '0000-00-00 00:00:00', 0, 0, 0),
('Marcin', '79cd295f940c9832bd9bf9fd1958796cc16c620e', '109661735753994220177e88.65017692', '2014-06-12 06:01:04', '0000-00-00 00:00:00', 0, 0, 0),
('MCOpeniTflat', 'f827bc3ec5d0e9cdf4f9032a166646029942c328', '1286232373539c2e5ecd4378.43280980', '2014-06-14 11:13:34', '2014-06-14 08:42:52', 0, 0, 0),
('Mordor', 'dbd7025fa3917ff453f90e648b210529c82485e7', '9677115005399df19e6a7c7.65411869', '2014-06-12 17:10:49', '0000-00-00 00:00:00', 0, 0, 0),
('ngionityeffect', 'e9a1768b56c10508d13e4987e624d41206cdf8c3', '1097361136539a0d8bb0c877.67450313', '2014-06-12 20:28:59', '0000-00-00 00:00:00', 0, 0, 0),
('qsdfg', 'c1064d59455f797ae1ba92efe607be3be1a659ae', '1576908911539a0eecc9f558.47287278', '2014-06-12 20:34:52', '0000-00-00 00:00:00', 0, 0, 0),
('qwerty', 'f28ae4e176db1c2a10de49c98f9654283adf4125', '303427529539c2ee1dba5b7.38593717', '2014-06-14 11:17:39', '2014-06-14 11:17:39', 0, 2, 0),
('terra9', 'haslomaslo', NULL, '2014-06-09 16:40:43', '0000-00-00 00:00:00', 0, 0, 0),
('test1', 'haslo1', NULL, '2014-05-10 02:41:53', '2014-05-10 02:18:50', 3, 0, 4),
('test2', 'haslo2', NULL, '2014-05-09 14:48:26', '2014-05-08 14:03:19', 0, 0, 0),
('test3', 'haslo3', NULL, '2014-04-23 05:03:24', '0000-00-00 00:00:00', 0, 0, 0),
('turban', '4656fff44e8fe26fe30e644c5d30446d73e4e41e', '166396989153993b8e8d0a18.82051646', '2014-06-12 05:33:02', '0000-00-00 00:00:00', 0, 0, 0),
('vvbbbbkol', '2392c9086e5ed7b8c2a23e505d8f89084da71e9c', '641548577539c370a8a9070.91806913', '2014-06-14 11:51:47', '0000-00-00 00:00:00', 0, 0, 0);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `allowed_messages`
--
ALTER TABLE `allowed_messages`
  ADD CONSTRAINT `allowed_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `allowed_messages_ibfk_2` FOREIGN KEY (`message_id`) REFERENCES `message` (`message_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
