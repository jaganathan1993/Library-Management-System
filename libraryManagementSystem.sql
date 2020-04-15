-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2020 at 07:47 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Book_totalSub` ()  NO SQL
SELECT a.id,a.bname,a.bCategory,(select count(b.id) from subscribers b where b.Bookid = a.id) as subt FROM `books` a$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CategorywiseSubscribe` ()  NO SQL
SELECT val.bCategory as name,sum(val.subt) as y from(SELECT a.bCategory,(select count(b.id) from subscribers b where b.Bookid = a.id) as subt FROM `books` a)val where val.subt!=0 group by val.bCategory$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `subscribe_books` (IN `userid` INT(20), IN `catvalue` VARCHAR(500))  NO SQL
SELECT a.*,(select count(b.id) from subscribers b where b.Bookid = a.id and b.Userid=userid) as subt FROM `books` a WHERE a.bCategory=catvalue$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `bookID` varchar(30) NOT NULL,
  `bname` text,
  `author` varchar(500) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `description` text,
  `publisher` varchar(500) DEFAULT NULL,
  `bCategory` varchar(200) NOT NULL,
  `bcount` int(20) NOT NULL,
  `bImage` varchar(200) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `bookID`, `bname`, `author`, `price`, `description`, `publisher`, `bCategory`, `bcount`, `bImage`, `status`, `created_at`, `updated_at`) VALUES
(2, 'BC1002', 'C programing', 'Brian Kernighan and Dennis Ritchie', 1500, 'C  is a general-purpose, procedural computer programming language supporting structured programming, lexical variable scope, and recursion, while a static type system prevents unintended operations.', 'sdd', 'Computer Science', 2, '1586793151.png', 'Available', '2020-04-11 08:47:46', '2020-04-13 15:52:31'),
(3, 'BC1003', 'PHP Programming', 'Rasmus Lerdorf', 455, 'PHP is a server side scripting language. that is used to develop Static websites or Dynamic websites or Web applications. PHP stands for Hypertext Pre-processor', 'dss', 'Computer Science', 2, '1586793170.png', 'Available', '2020-04-11 09:09:41', '2020-04-13 15:52:50'),
(4, 'BC1004', 'C advanbce programing', 'Brian Kernighan and Dennis Ritchie', 1500, 'dsfsdf', 'sdd', 'Computer Science', 1, '', 'Available', '2020-04-11 09:40:04', '2020-04-13 15:51:23'),
(5, 'BC1005', 'Go lang', 'Dennis Ritchie', 1500, 'erer', 'sdd', 'Computer Science', 2, '', 'Available', '2020-04-11 09:43:19', '2020-04-11 09:43:19'),
(6, 'BC1006', 'c#', 'Dennis Ritchie', 522, 'gfdgdg', 'sdd', 'Computer Science', 2, '1586598232.jfif', 'Available', '2020-04-11 09:43:52', '2020-04-11 09:43:52'),
(7, 'BC1007', 'asp.net', 'Dennis Ritchie', 1500, 'fsdfsdfs', 'sdd', 'Computer Science', 3, '', 'Available', '2020-04-11 12:05:29', '2020-04-11 12:05:29'),
(8, 'BC1008', 'js', 'Dennis Ritchie', 1500, 'gfgfdg', 'sdd', 'Computer Science', 2, '', 'Available', '2020-04-11 12:10:27', '2020-04-11 12:10:27'),
(237, 'BC1009', 'Fundamentals of Wavelets', 'Goswami, Jaideva', 228, NULL, 'Wiley', 'Signal Processing', 30, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(238, 'BC1010', 'Data Smart', 'Foreman, John', 235, NULL, 'Wiley', 'Data Science', 39, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(239, 'BC1011', 'God Created the Integers', 'Hawking, Stephen', 197, NULL, 'Penguin', 'Mathematics', 41, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(240, 'BC1012', 'Superfreakonomics', 'Dubner, Stephen', 179, NULL, 'HarperCollins', 'Economics', 0, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(241, 'BC1013', 'Orientalism', 'Said, Edward', 197, NULL, 'Penguin', 'History', 9, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(242, 'BC1014', 'Nature of Statistical Learning Theory, The', 'Vapnik, Vladimir', 230, NULL, 'Springer', 'Data Science', 34, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(243, 'BC1015', 'Integration of the Indian States', 'Menon, V P', 217, NULL, 'Orient Blackswan', 'History', 27, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(244, 'BC1016', 'Drunkard\'s Walk, The', 'Mlodinow, Leonard', 197, NULL, 'Penguin', 'Science', 26, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(245, 'BC1017', 'Image Processing & Mathematical Morphology', 'Shih, Frank', 241, NULL, 'CRC', 'Signal Processing', 21, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(246, 'BC1018', 'How to Think Like Sherlock Holmes', 'Konnikova, Maria', 240, NULL, 'Penguin', 'Psychology', 31, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(247, 'BC1019', 'Data Scientists at Work', 'Sebastian Gutierrez', 230, NULL, 'Apress', 'Data Science', 14, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(248, 'BC1020', 'Slaughterhouse Five', 'Vonnegut, Kurt', 198, NULL, 'Random House', 'Fiction', 18, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(249, 'BC1021', 'Birth of a Theorem', 'Villani, Cedric', 234, NULL, 'Bodley Head', 'Mathematics', 48, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(250, 'BC1022', 'Structure & Interpretation of Computer Programs', 'Sussman, Gerald', 240, NULL, 'MIT Press', 'Computer Science', 39, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(251, 'BC1023', 'Age of Wrath, The', 'Eraly, Abraham', 238, NULL, 'Penguin', 'History', 11, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(252, 'BC1024', 'Trial, The', 'Kafka, Frank', 198, NULL, 'Random House', 'Fiction', 38, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(253, 'BC1025', 'Statistical Decision Theory\'', 'Pratt, John', 236, NULL, 'MIT Press', 'Data Science', 17, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(254, 'BC1026', 'Data Mining Handbook', 'Nisbet, Robert', 242, NULL, 'Apress', 'Data Science', 45, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(255, 'BC1027', 'New Machiavelli, The', 'Wells, H. G.', 180, NULL, 'Penguin', 'Fiction', 11, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(256, 'BC1028', 'Physics & Philosophy', 'Heisenberg, Werner', 197, NULL, 'Penguin', 'Science', 24, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(257, 'BC1029', 'Making Software', 'Oram, Andy', 232, NULL, 'O\'Reilly', 'Computer Science', 21, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(258, 'BC1030', 'Analysis, Vol I', 'Tao, Terence', 248, NULL, 'HBA', 'Mathematics', 9, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(259, 'BC1031', 'Machine Learning for Hackers', 'Conway, Drew', 233, NULL, 'O\'Reilly', 'Data Science', 12, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(260, 'BC1032', 'Signal and the Noise, The', 'Silver, Nate', 233, NULL, 'Penguin', 'Data Science', 41, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(261, 'BC1033', 'Python for Data Analysis', 'McKinney, Wes', 233, NULL, 'O\'Reilly', 'Data Science', 9, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(262, 'BC1034', 'Introduction to Algorithms', 'Cormen, Thomas', 234, NULL, 'MIT Press', 'Computer Science', 14, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(263, 'BC1035', 'Beautiful and the Damned, The', 'Deb, Siddhartha', 198, NULL, 'Penguin', 'Nonfiction', 13, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(264, 'BC1036', 'Outsider, The', 'Camus, Albert', 198, NULL, 'Penguin', 'Fiction', 3, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(265, 'BC1037', 'Complete Sherlock Holmes, The - Vol I', 'Doyle, Arthur Conan', 176, NULL, 'Random House', 'Fiction', 48, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(266, 'BC1038', 'Complete Sherlock Holmes, The - Vol II', 'Doyle, Arthur Conan', 176, NULL, 'Random House', 'Fiction', 7, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(267, 'BC1039', 'Wealth of Nations, The', 'Smith, Adam', 175, NULL, 'Random House', 'Economics', 37, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(268, 'BC1040', 'Pillars of the Earth, The', 'Follett, Ken', 176, NULL, 'Random House', 'Fiction', 39, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(269, 'BC1041', 'Mein Kampf', 'Hitler, Adolf', 212, NULL, 'Rupa', 'Nonfiction', 27, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(270, 'BC1042', 'Tao of Physics, The', 'Capra, Fritjof', 179, NULL, 'Penguin', 'Science', 2, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(271, 'BC1043', 'Surely You\'re Joking Mr Feynman', 'Feynman, Richard', 198, NULL, 'Random House', 'Science', 47, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(272, 'BC1044', 'Farewell to Arms, A', 'Hemingway, Ernest', 179, NULL, 'Rupa', 'Fiction', 14, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(273, 'BC1045', 'Veteran, The', 'Forsyth, Frederick', 177, NULL, 'Transworld', 'Fiction', 19, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(274, 'BC1046', 'False Impressions', 'Archer, Jeffery', 177, NULL, 'Pan', 'Fiction', 33, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(275, 'BC1047', 'Last Lecture, The', 'Pausch, Randy', 197, NULL, 'Hyperion', 'Nonfiction', 10, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(276, 'BC1048', 'Return of the Primitive', 'Rand, Ayn', 202, NULL, 'Penguin', 'Philosophy', 23, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(277, 'BC1049', 'Jurassic Park', 'Crichton, Michael', 174, NULL, 'Random House', 'Fiction', 30, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(278, 'BC1050', 'Russian Journal, A', 'Steinbeck, John', 196, NULL, 'Penguin', 'Nonfiction', 6, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(279, 'BC1051', 'Tales of Mystery and Imagination', 'Poe, Edgar Allen', 172, NULL, 'HarperCollins', 'Fiction', 17, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(280, 'BC1052', 'Freakonomics', 'Dubner, Stephen', 197, NULL, 'Penguin', 'Economics', 44, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(281, 'BC1053', 'Hidden Connections, The', 'Capra, Fritjof', 197, NULL, 'HarperCollins', 'Science', 12, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(282, 'BC1054', 'Story of Philosophy, The', 'Durant, Will', 170, NULL, 'Pocket', 'Philosophy', 12, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(283, 'BC1055', 'Asami Asami', 'Deshpande, P L', 205, NULL, 'Mauj', 'Fiction', 49, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(284, 'BC1056', 'Journal of a Novel', 'Steinbeck, John', 196, NULL, 'Penguin', 'Fiction', 39, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(285, 'BC1057', 'Once There Was a War', 'Steinbeck, John', 196, NULL, 'Penguin', 'Nonfiction', 42, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(286, 'BC1058', 'Moon is Down, The', 'Steinbeck, John', 196, NULL, 'Penguin', 'Fiction', 1, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(287, 'BC1059', 'Brethren, The', 'Grisham, John', 174, NULL, 'Random House', 'Fiction', 5, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(288, 'BC1060', 'In a Free State', 'Naipaul, V. S.', 196, NULL, 'Rupa', 'Fiction', 37, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(289, 'BC1061', 'Catch 22', 'Heller, Joseph', 178, NULL, 'Random House', 'Fiction', 31, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(290, 'BC1062', 'Complete Mastermind, The', 'BBC', 178, NULL, 'BBC', 'Nonfiction', 42, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(291, 'BC1063', 'Dylan on Dylan', 'Dylan, Bob', 197, NULL, 'Random House', 'Nonfiction', 46, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(292, 'BC1064', 'Soft Computing & Intelligent Systems', 'Gupta, Madan', 242, NULL, 'Elsevier', 'Data Science', 14, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(293, 'BC1065', 'Textbook of Economic Theory', 'Stonier, Alfred', 242, NULL, 'Pearson', 'Economics', 20, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(294, 'BC1066', 'Econometric Analysis', 'Greene, W. H.', 242, NULL, 'Pearson', 'Economics', 0, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(295, 'BC1067', 'Learning OpenCV', 'Bradsky, Gary', 232, NULL, 'O\'Reilly', 'Data Science', 18, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(296, 'BC1068', 'Data Structures Using C & C++', 'Tanenbaum, Andrew', 235, NULL, 'Prentice Hall', 'Computer Science', 3, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(297, 'BC1069', 'Computer Vision, A Modern Approach', 'Forsyth, David', 255, NULL, 'Pearson', 'Data Science', 48, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(298, 'BC1070', 'Principles of Communication Systems', 'Taub, Schilling', 240, NULL, 'TMH', 'Computer Science', 4, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(299, 'BC1071', 'Let Us C', 'Kanetkar, Yashwant', 213, NULL, 'Prentice Hall', 'Computer Science', 45, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(300, 'BC1072', 'Amulet of Samarkand, The', 'Stroud, Jonathan', 179, NULL, 'Random House', 'Fiction', 3, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(301, 'BC1073', 'Crime and Punishment', 'Dostoevsky, Fyodor', 180, NULL, 'Penguin', 'Fiction', 4, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(302, 'BC1074', 'Angels & Demons', 'Brown, Dan', 178, NULL, 'Random House', 'Fiction', 15, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(303, 'BC1075', 'Argumentative Indian, The', 'Sen, Amartya', 209, NULL, 'Picador', 'Nonfiction', 8, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(304, 'BC1076', 'Sea of Poppies', 'Ghosh, Amitav', 197, NULL, 'Penguin', 'Fiction', 8, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(305, 'BC1077', 'Idea of Justice, The', 'Sen, Amartya', 212, NULL, 'Penguin', 'Nonfiction', 2, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(306, 'BC1078', 'Raisin in the Sun, A', 'Hansberry, Lorraine', 175, NULL, 'Penguin', 'Fiction', 33, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(307, 'BC1079', 'All the President\'s Men', 'Woodward, Bob', 177, NULL, 'Random House', 'History', 47, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(308, 'BC1080', 'Prisoner of Birth, A', 'Archer, Jeffery', 176, NULL, 'Pan', 'Fiction', 35, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(309, 'BC1081', 'Scoop!', 'Nayar, Kuldip', 216, NULL, 'HarperCollins', 'History', 49, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(310, 'BC1082', 'Ahe Manohar Tari', 'Deshpande, Sunita', 213, NULL, 'Mauj', 'Nonfiction', 27, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(311, 'BC1083', 'Last Mughal, The', 'Dalrymple, William', 199, NULL, 'Penguin', 'History', 6, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(312, 'BC1084', 'Social Choice & Welfare, Vol 39 No. 1', 'Various', 235, NULL, 'Springer', 'Economics', 43, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(313, 'BC1085', 'Radiowaril Bhashane & Shrutika', 'Deshpande, P L', 213, NULL, 'Mauj', 'Nonfiction', 46, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(314, 'BC1086', 'Gun Gayin Awadi', 'Deshpande, P L', 212, NULL, 'Mauj', 'Nonfiction', 42, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(315, 'BC1087', 'Aghal Paghal', 'Deshpande, P L', 212, NULL, 'Mauj', 'Nonfiction', 42, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(316, 'BC1088', 'Maqta-e-Ghalib', 'Garg, Sanjay', 221, NULL, 'Mauj', 'Fiction', 21, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(317, 'BC1089', 'Beyond Degrees', NULL, 222, NULL, 'HarperCollins', 'Nonfiction', 22, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(318, 'BC1090', 'Manasa', 'Kale, V P', 213, NULL, 'Mauj', 'Nonfiction', 29, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(319, 'BC1091', 'India from Midnight to Milennium', 'Tharoor, Shashi', 198, NULL, 'Penguin', 'History', 8, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(320, 'BC1092', 'World\'s Greatest Trials, The', NULL, 210, NULL, NULL, 'History', 25, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(321, 'BC1093', 'Great Indian Novel, The', 'Tharoor, Shashi', 198, NULL, 'Penguin', 'Fiction', 20, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(322, 'BC1094', 'O Jerusalem!', 'Lapierre, Dominique', 217, NULL, 'vikas', 'History', 49, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(323, 'BC1095', 'City of Joy, The', 'Lapierre, Dominique', 177, NULL, 'vikas', 'Fiction', 20, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(324, 'BC1096', 'Freedom at Midnight', 'Lapierre, Dominique', 167, NULL, 'vikas', 'History', 0, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(325, 'BC1097', 'Winter of Our Discontent, The', 'Steinbeck, John', 196, NULL, 'Penguin', 'Fiction', 41, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(326, 'BC1098', 'On Education', 'Russell, Bertrand', 203, NULL, 'Routledge', 'Philosophy', 38, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(327, 'BC1099', 'Free Will', 'Harris, Sam', 203, NULL, 'FreePress', 'Philosophy', 24, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(328, 'BC1100', 'Bookless in Baghdad', 'Tharoor, Shashi', 206, NULL, 'Penguin', 'Nonfiction', 27, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(329, 'BC1101', 'Case of the Lame Canary, The', 'Gardner, Earle Stanley', 179, NULL, NULL, 'Fiction', 36, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(330, 'BC1102', 'Theory of Everything, The', 'Hawking, Stephen', 217, NULL, 'Jaico', 'Science', 43, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(331, 'BC1103', 'New Markets & Other Essays', 'Drucker, Peter', 176, NULL, 'Penguin', 'Economics', 36, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(332, 'BC1104', 'Electric Universe', 'Bodanis, David', 201, NULL, 'Penguin', 'Science', 49, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(333, 'BC1105', 'Hunchback of Notre Dame, The', 'Hugo, Victor', 175, NULL, 'Random House', 'Fiction', 26, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(334, 'BC1106', 'Burning Bright', 'Steinbeck, John', 175, NULL, 'Penguin', 'Fiction', 10, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(335, 'BC1107', 'Age of Discontuinity, The', 'Drucker, Peter', 178, NULL, 'Random House', 'Economics', 14, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(336, 'BC1108', 'Doctor in the Nude', 'Gordon, Richard', 179, NULL, 'Penguin', 'Fiction', 21, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(337, 'BC1109', 'Down and Out in Paris & London', 'Orwell, George', 179, NULL, 'Penguin', 'Nonfiction', 48, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(338, 'BC1110', 'Identity & Violence', 'Sen, Amartya', 219, NULL, 'Penguin', 'Philosophy', 25, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(339, 'BC1111', 'Beyond the Three Seas', 'Dalrymple, William', 197, NULL, 'Random House', 'History', 14, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(340, 'BC1112', 'World\'s Greatest Short Stories, The', NULL, 217, NULL, 'Jaico', 'Fiction', 47, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(341, 'BC1113', 'Talking Straight', 'Iacoca, Lee', 175, NULL, NULL, 'Nonfiction', 41, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(342, 'BC1114', 'Maugham\'s Collected Short Stories, Vol 3', 'Maugham, William S', 171, NULL, 'Vintage', 'Fiction', 47, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(343, 'BC1115', 'Phantom of Manhattan, The', 'Forsyth, Frederick', 180, NULL, NULL, 'Fiction', 42, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(344, 'BC1116', 'Ashenden of The British Agent', 'Maugham, William S', 160, NULL, 'Vintage', 'Fiction', 43, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(345, 'BC1117', 'Zen & The Art of Motorcycle Maintenance', 'Pirsig, Robert', 172, NULL, 'Vintage', 'Philosophy', 14, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(346, 'BC1118', 'Great War for Civilization, The', 'Fisk, Robert', 197, NULL, 'HarperCollins', 'History', 17, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(347, 'BC1119', 'We the Living', 'Rand, Ayn', 178, NULL, 'Penguin', 'Fiction', 5, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(348, 'BC1120', 'Artist and the Mathematician, The', 'Aczel, Amir', 186, NULL, 'HighStakes', 'Science', 28, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(349, 'BC1121', 'History of Western Philosophy', 'Russell, Bertrand', 213, NULL, 'Routledge', 'Philosophy', 48, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(350, 'BC1122', 'Selected Short Stories', NULL, 215, NULL, 'Jaico', 'Fiction', 5, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(351, 'BC1123', 'Rationality & Freedom', 'Sen, Amartya', 213, NULL, 'Springer', 'Economics', 37, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(352, 'BC1124', 'Clash of Civilizations and Remaking of the World Order', 'Huntington, Samuel', 228, NULL, 'Simon&Schuster', 'History', 47, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(353, 'BC1125', 'Uncommon Wisdom', 'Capra, Fritjof', 197, NULL, 'Fontana', 'Nonfiction', 8, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(354, 'BC1126', 'One', 'Bach, Richard', 172, NULL, 'Dell', 'Nonfiction', 47, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(355, 'BC1127', 'Karl Marx Biography', NULL, 162, NULL, NULL, 'Nonfiction', 34, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(356, 'BC1128', 'To Sir With Love', 'Braithwaite', 197, NULL, 'Penguin', 'Fiction', 33, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(357, 'BC1129', 'Half A Life', 'Naipaul, V S', 196, NULL, NULL, 'Fiction', 48, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(358, 'BC1130', 'Discovery of India, The', 'Nehru, Jawaharlal', 230, NULL, NULL, 'History', 27, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(359, 'BC1131', 'Apulki', 'Deshpande, P L', 211, NULL, NULL, 'Nonfiction', 6, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(360, 'BC1132', 'Unpopular Essays', 'Russell, Bertrand', 198, NULL, NULL, 'Philosophy', 38, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(361, 'BC1133', 'Deceiver, The', 'Forsyth, Frederick', 178, NULL, NULL, 'Fiction', 44, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(362, 'BC1134', 'Veil: Secret Wars of the CIA', 'Woodward, Bob', 171, NULL, NULL, 'History', 34, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(363, 'BC1135', 'Char Shabda', 'Deshpande, P L', 214, NULL, NULL, 'Nonfiction', 31, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(364, 'BC1136', 'Rosy is My Relative', 'Durrell, Gerald', 176, NULL, NULL, 'Fiction', 17, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(365, 'BC1137', 'Moon and Sixpence, The', 'Maugham, William S', 180, NULL, NULL, 'Fiction', 49, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(366, 'BC1138', 'Political Philosophers', NULL, 162, NULL, NULL, 'Philosophy', 38, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(367, 'BC1139', 'Short History of the World, A', 'Wells, H G', 197, NULL, NULL, 'History', 39, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(368, 'BC1140', 'Trembling of a Leaf, The', 'Maugham, William S', 205, NULL, NULL, 'Fiction', 47, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(369, 'BC1141', 'Doctor on the Brain', 'Gordon, Richard', 204, NULL, NULL, 'Fiction', 7, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(370, 'BC1142', 'Simpsons & Their Mathematical Secrets', 'Singh, Simon', 233, NULL, NULL, 'Science', 39, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(371, 'BC1143', 'Pattern Classification', 'Duda, Hart', 241, NULL, NULL, 'Data Science', 18, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(372, 'BC1144', 'From Beirut to Jerusalem', 'Friedman, Thomas', 202, NULL, NULL, 'History', 4, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(373, 'BC1145', 'Code Book, The', 'Singh, Simon', 197, NULL, NULL, 'Science', 1, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(374, 'BC1146', 'Age of the Warrior, The', 'Fisk, Robert', 197, NULL, NULL, 'History', 2, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(375, 'BC1147', 'Final Crisis', NULL, 257, NULL, NULL, 'Comic', 32, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(376, 'BC1148', 'Killing Joke, The', NULL, 283, NULL, NULL, 'Comic', 43, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(377, 'BC1149', 'Flashpoint', NULL, 265, NULL, NULL, 'Comic', 19, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(378, 'BC1150', 'Batman Earth One', NULL, 265, NULL, NULL, 'Comic', 22, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(379, 'BC1151', 'Crisis on Infinite Earths', NULL, 258, NULL, NULL, 'Comic', 40, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(380, 'BC1152', 'Numbers Behind Numb3rs, The', 'Devlin, Keith', 202, NULL, NULL, 'Science', 24, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(381, 'BC1153', 'Superman Earth One - 1', NULL, 259, NULL, NULL, 'Comic', 5, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(382, 'BC1154', 'Superman Earth One - 2', NULL, 258, NULL, NULL, 'Comic', 11, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(383, 'BC1155', 'Justice League: Throne of Atlantis', NULL, 258, NULL, NULL, 'Comic', 44, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(384, 'BC1156', 'Justice League: The Villain\'s Journey', NULL, 258, NULL, NULL, 'Comic', 6, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(385, 'BC1157', 'Death of Superman, The', NULL, 258, NULL, NULL, 'Comic', 21, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(386, 'BC1158', 'History of the DC Universe', NULL, 258, NULL, NULL, 'Comic', 47, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(387, 'BC1159', 'Batman: The Long Halloween', NULL, 258, NULL, NULL, 'Comic', 17, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(388, 'BC1160', 'Life in Letters, A', 'Steinbeck, John', 196, NULL, NULL, 'Nonfiction', 25, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(389, 'BC1161', 'Information, The', 'Gleick, James', 233, NULL, NULL, 'Science', 4, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(390, 'BC1162', 'Journal of Economics, vol 106 No 3', NULL, 235, NULL, NULL, 'Economics', 23, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(391, 'BC1163', 'Elements of Information Theory', 'Thomas, Joy', 229, NULL, NULL, 'Data Science', 38, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(392, 'BC1164', 'Power Electronics - Rashid', 'Rashid, Muhammad', 235, NULL, NULL, 'Computer Science', 7, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(393, 'BC1165', 'Power Electronics - Mohan', 'Mohan, Ned', 237, NULL, NULL, 'Computer Science', 45, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(394, 'BC1166', 'Neural Networks', 'Haykin, Simon', 240, NULL, NULL, 'Data Science', 43, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(395, 'BC1167', 'Grapes of Wrath, The', 'Steinbeck, John', 196, NULL, NULL, 'Fiction', 6, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(396, 'BC1168', 'Vyakti ani Valli', 'Deshpande, P L', 211, NULL, NULL, 'Nonfiction', 15, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(397, 'BC1169', 'Statistical Learning Theory', 'Vapnik, Vladimir', 228, NULL, NULL, 'Data Science', 8, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(398, 'BC1170', 'Empire of the Mughal - The Tainted Throne', 'Rutherford, Alex', 180, NULL, NULL, 'History', 4, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(399, 'BC1171', 'Empire of the Mughal - Brothers at War', 'Rutherford, Alex', 180, NULL, NULL, 'History', 9, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(400, 'BC1172', 'Empire of the Mughal - Ruler of the World', 'Rutherford, Alex', 180, NULL, NULL, 'History', 28, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(401, 'BC1173', 'Empire of the Mughal - The Serpent\'s Tooth', 'Rutherford, Alex', 180, NULL, NULL, 'History', 10, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(402, 'BC1174', 'Empire of the Mughal - Raiders from the North', 'Rutherford, Alex', 180, NULL, NULL, 'History', 29, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(403, 'BC1175', 'Mossad', 'Baz-Zohar, Michael', 236, NULL, NULL, 'History', 33, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(404, 'BC1176', 'Jim Corbett Omnibus', 'Corbett, Jim', 223, NULL, NULL, 'Nonfiction', 4, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(405, 'BC1177', '20000 Leagues Under the Sea', 'Verne, Jules', 190, NULL, NULL, 'Fiction', 41, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(406, 'BC1178', 'Batatyachi Chal', 'Deshpande P L', 200, NULL, NULL, 'Fiction', 17, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(407, 'BC1179', 'Hafasavnuk', 'Deshpande P L', 211, NULL, NULL, 'Fiction', 5, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(408, 'BC1180', 'Urlasurla', 'Deshpande P L', 211, NULL, NULL, 'Fiction', 46, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(409, 'BC1181', 'Pointers in C', 'Kanetkar, Yashwant', 213, NULL, NULL, 'Computer Science', 16, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(410, 'BC1182', 'Cathedral and the Bazaar, The', 'Raymond, Eric', 217, NULL, NULL, 'Computer Science', 34, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(411, 'BC1183', 'Design with OpAmps', 'Franco, Sergio', 240, NULL, NULL, 'Computer Science', 8, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(412, 'BC1184', 'Think Complexity', 'Downey, Allen', 230, NULL, NULL, 'Data Science', 26, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(413, 'BC1185', 'Devil\'s Advocate, The', 'West, Morris', 178, NULL, NULL, 'Fiction', 25, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(414, 'BC1186', 'Ayn Rand Answers', 'Rand, Ayn', 203, NULL, NULL, 'Philosophy', 0, '', 'Not Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(415, 'BC1187', 'Philosophy: Who Needs It', 'Rand, Ayn', 171, NULL, NULL, 'Philosophy', 43, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(416, 'BC1188', 'World\'s Great Thinkers, The', NULL, 189, NULL, NULL, 'Philosophy', 29, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(417, 'BC1189', 'Data Analysis with Open Source Tools', 'Janert, Phillip', 230, NULL, NULL, 'Data Science', 44, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(418, 'BC1190', 'Broca\'s Brain', 'Sagan, Carl', 174, NULL, NULL, 'Science', 10, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(419, 'BC1191', 'Men of Mathematics', 'Bell, E T', 217, NULL, NULL, 'Mathematics', 6, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(420, 'BC1192', 'Oxford book of Modern Science Writing', 'Dawkins, Richard', 240, NULL, NULL, 'Science', 35, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(421, 'BC1193', 'Justice, Judiciary and Democracy', 'Ranjan, Sudhanshu', 224, NULL, NULL, 'Philosophy', 15, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(422, 'BC1194', 'Arthashastra, The', 'Kautiyla', 214, NULL, NULL, 'Philosophy', 0, '', 'Not Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(423, 'BC1195', 'We the People', 'Palkhivala', 216, NULL, NULL, 'Philosophy', 45, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(424, 'BC1196', 'We the Nation', 'Palkhivala', 216, NULL, NULL, 'Philosophy', 20, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(425, 'BC1197', 'Courtroom Genius, The', 'Sorabjee', 217, NULL, NULL, 'Nonfiction', 12, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(426, 'BC1198', 'Dongri to Dubai', 'Zaidi, Hussain', 216, NULL, NULL, 'Nonfiction', 5, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(427, 'BC1199', 'History of England, Foundation', 'Ackroyd, Peter', 197, NULL, NULL, 'History', 16, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(428, 'BC1200', 'City of Djinns', 'Dalrymple, William', 198, NULL, NULL, 'History', 38, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(429, 'BC1201', 'India\'s Legal System', 'Nariman', 177, NULL, NULL, 'Nonfiction', 10, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(430, 'BC1202', 'More Tears to Cry', 'Sassoon, Jean', 235, NULL, NULL, 'Fiction', 42, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(431, 'BC1203', 'Ropemaker, The', 'Dickinson, Peter', 196, NULL, NULL, 'Fiction', 29, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(432, 'BC1204', 'Angels & Demons', 'Brown, Dan', 170, NULL, NULL, 'Fiction', 12, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(433, 'BC1205', 'Judge, The', NULL, 170, NULL, NULL, 'Fiction', 40, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(434, 'BC1206', 'Attorney, The', NULL, 170, NULL, NULL, 'Fiction', 32, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(435, 'BC1207', 'Prince, The', 'Machiavelli', 173, NULL, NULL, 'Philosophy', 8, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(436, 'BC1208', 'Eyeless in Gaza', 'Huxley, Aldous', 180, NULL, NULL, 'Fiction', 7, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(437, 'BC1209', 'Tales of Beedle the Bard', 'Rowling, J K', 184, NULL, NULL, 'Fiction', 24, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(438, 'BC1210', 'Girl with the Dragon Tattoo', 'Larsson, Steig', 179, NULL, NULL, 'Fiction', 11, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(439, 'BC1211', 'Girl who kicked the Hornet\'s Nest', 'Larsson, Steig', 179, NULL, NULL, 'Fiction', 10, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(440, 'BC1212', 'Girl who played with Fire', 'Larsson, Steig', 179, NULL, NULL, 'Fiction', 32, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(441, 'BC1213', 'Batman Handbook', NULL, 270, NULL, NULL, 'Comic', 0, '', 'Not Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(442, 'BC1214', 'Murphy\'s Law', NULL, 178, NULL, NULL, 'Nonfiction', 48, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(443, 'BC1215', 'Structure and Randomness', 'Tao, Terence', 252, NULL, NULL, 'Mathematics', 8, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(444, 'BC1216', 'Image Processing with MATLAB', 'Eddins, Steve', 241, NULL, NULL, 'Signal Processing', 32, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(445, 'BC1217', 'Animal Farm', 'Orwell, George', 180, NULL, NULL, 'Fiction', 40, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(446, 'BC1218', 'Idiot, The', 'Dostoevsky, Fyodor', 197, NULL, NULL, 'Fiction', 23, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49'),
(447, 'BC1219', 'Christmas Carol, A', 'Dickens, Charles', 196, NULL, NULL, 'Fiction', 49, '', 'Available', '2020-04-13 14:24:49', '2020-04-13 14:24:49');

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `id` int(12) NOT NULL,
  `category` varchar(20) NOT NULL,
  `userid` varchar(30) NOT NULL,
  `pw` varchar(60) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`id`, `category`, `userid`, `pw`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'v.jaganathan93@gmail.com', '$2y$12$W03Tst8VHkfaQi4.C3jAAezR8IRXALmr0m.Oo4Wii4osx1DXB6SDK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'User', 'suresh@gmail.com', '$2y$10$.cF1ztLZX6Trr305Y4GWiexYqB395tinLoaIMdJ73TcO9mO949EJO', '2020-04-11 04:53:59', '2020-04-11 04:53:59'),
(3, 'User', 'vimal@gmail.com', '$2y$10$u1r2oqBjusR5XNOMo841aOLSsXACaHcR/6FiWiyBaKYMYSauP5Jl2', '2020-04-13 06:21:53', '2020-04-13 06:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(20) NOT NULL,
  `Bookid` int(20) NOT NULL,
  `Userid` int(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `Bookid`, `Userid`, `created_at`, `updated_at`) VALUES
(5, 5, 12, '2020-04-12 15:25:27', '2020-04-12 15:25:27'),
(6, 3, 12, '2020-04-12 17:06:06', '2020-04-12 17:06:06'),
(7, 16, 12, '2020-04-12 17:24:35', '2020-04-12 17:24:35'),
(8, 15, 12, '2020-04-12 17:24:38', '2020-04-12 17:24:38'),
(11, 10, 12, '2020-04-13 05:13:00', '2020-04-13 05:13:00'),
(12, 2, 12, '2020-04-13 06:16:19', '2020-04-13 06:16:19'),
(13, 3, 13, '2020-04-13 06:34:00', '2020-04-13 06:34:00'),
(14, 5, 13, '2020-04-13 06:34:03', '2020-04-13 06:34:03'),
(15, 17, 13, '2020-04-13 06:34:06', '2020-04-13 06:34:06'),
(16, 14, 13, '2020-04-13 06:34:10', '2020-04-13 06:34:10'),
(17, 14, 13, '2020-04-13 06:34:10', '2020-04-13 06:34:10'),
(18, 245, 12, '2020-04-13 14:35:01', '2020-04-13 14:35:01'),
(19, 258, 12, '2020-04-13 14:35:04', '2020-04-13 14:35:04'),
(20, 247, 12, '2020-04-13 14:35:08', '2020-04-13 14:35:08'),
(21, 238, 12, '2020-04-13 14:35:12', '2020-04-13 14:35:12'),
(22, 371, 12, '2020-04-13 14:35:19', '2020-04-13 14:35:19'),
(23, 280, 12, '2020-04-13 14:35:23', '2020-04-13 14:35:23'),
(24, 243, 12, '2020-04-13 14:35:29', '2020-04-13 14:35:29'),
(25, 267, 12, '2020-04-13 14:35:35', '2020-04-13 14:35:35'),
(26, 270, 12, '2020-04-13 14:35:41', '2020-04-13 14:35:41'),
(27, 246, 12, '2020-04-13 14:35:49', '2020-04-13 14:35:49'),
(28, 275, 12, '2020-04-13 14:35:54', '2020-04-13 14:35:54'),
(29, 256, 12, '2020-04-13 14:35:59', '2020-04-13 14:35:59'),
(30, 326, 12, '2020-04-13 14:36:05', '2020-04-13 14:36:05'),
(31, 377, 12, '2020-04-13 14:36:11', '2020-04-13 14:36:11'),
(32, 375, 12, '2020-04-13 14:36:19', '2020-04-13 14:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `gender` varchar(60) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(10) NOT NULL,
  `emailID` varchar(120) NOT NULL,
  `Address` text NOT NULL,
  `ID_Proff` varchar(200) NOT NULL,
  `ID_Proff_Attachment` varchar(500) DEFAULT NULL,
  `User_image` varchar(500) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `name`, `gender`, `dob`, `phone`, `emailID`, `Address`, `ID_Proff`, `ID_Proff_Attachment`, `User_image`, `created_at`, `updated_at`) VALUES
(12, 'suresh', 'Male', '2020-04-15', '8754875487', 'suresh@gmail.com', 'sdfsdfsdfs', 'Addhar-578458457584', '1586580681Attachment.jfif', '1586580681UI.jfif', '2020-04-11 04:51:21', '2020-04-11 04:51:21'),
(13, 'vimal', 'Male', '2020-04-08', '8745845758', 'vimal@gmail.com', 'jagan', 'Addhar-578458457584', '1586758913Attachment.jpg', '1586758913UI.jfif', '2020-04-13 06:21:53', '2020-04-13 06:21:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookID` (`bookID`),
  ADD KEY `id` (`id`),
  ADD KEY `author` (`author`),
  ADD KEY `publisher` (`publisher`),
  ADD KEY `bcount` (`bcount`),
  ADD KEY `bImage` (`bImage`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emailID` (`emailID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=448;

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
