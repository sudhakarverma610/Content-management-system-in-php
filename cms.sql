-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2018 at 04:07 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

CREATE TABLE `catagory` (
  `id` int(11) NOT NULL,
  `catagory` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`id`, `catagory`) VALUES
(27, 'books');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `date`, `name`, `username`, `post_id`, `email`, `website`, `image`, `comment`, `status`) VALUES
(14, '1517309819', 'amit kumar verma', 'user', 3, 'sudhakar@gmail.com', '', 'IMG20171014122109.jpg', 'I am Sudhakar verma from spn', 'pending'),
(21, '1541127940', 'sudhakar', 'user', 25, 'xxx@gmail.com', 'github.com', 'IMG20171014122109.jpg', 'hii goood', 'pendding');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `image`) VALUES
(104, 'hqdefault(35).jpg'),
(103, 'hqdefault(34).jpg'),
(102, 'hqdefault(33).jpg'),
(101, 'hqdefault(32).jpg'),
(100, 'hqdefault(31).jpg'),
(99, 'hqdefault(30).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `author_image` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `catagory` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `post_data` text NOT NULL,
  `views` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `date`, `title`, `author`, `author_image`, `image`, `catagory`, `tags`, `post_data`, `views`, `status`) VALUES
(8, 1517382588, 'sudhakar verma', 'sudhakar', 'WIN_20180109_19_28_45_Pro.jpg', 'BeautyPlus_20180105160622_save.jpg', 'mobile', 'rohit', 'mere mere ', 0, 'draft'),
(25, 1541127809, 'Function Basics', 'sudha', 'facebook.png', 'slider-3.jpg', 'books', 'function-python', 'Need For New System:\r\nIn new system we can see notification.\r\nWe can manage status,photo,video or album.\r\nNew system capable to send Email and SMS on mobile facility.\r\nWe can manage event and count to the member of coming in this event.\r\nOnline chatting with their friends.\r\nWe can view the advertised.\r\nFunctional Specification\r\nAdmin\r\nLogin\r\nIn this module Admin can register in the site and login\r\ninto the site.\r\n Manage User\r\nIn this module Admin can manage for all User.\r\n Manage News\r\nIn this module Admin can manage News.\r\nSend Mail & message\r\nIn this module Admin can send the mail & message..\r\n Manage Notification\r\nIn this module Admin can manage notification.\r\n Manage Event\r\nIn this module Admin can manage Event.\r\n Manage Photo/video\r\nIn this module Admin can manage Photo/Video album.\r\nAdvertisement\r\nIn this module Admin can manage the multiple Advertisement.\r\nUser\r\n Registration\r\nIn this module user can Registration in the site.\r\n Update Status\r\nIn the update Status module user can update status.\r\n Profile\r\nIn the profile module user can set own profile\r\nEvents\r\nIn this module user can create events and inform the friends for\r\nevents.\r\nAlbums\r\nIn the album module user can create multiple albums and share\r\nthis albums to the friends.\r\n Chat\r\nIn the chat module user can online chat with friends.\r\nFind Friend\r\nIn this module user can find friend and socially communicate\r\nwith each other.\r\nPhoto/Videos\r\nIn this module user can upload multiple videos.\r\n Message\r\nIn this module user can send message and chat with others\r\n E-mail\r\nIn this module user can send mail to multiple own friends\r\nAdvertisement\r\nIn this module user can view the multiple Advertisement.\r\nMinimum Hardware Requirement:\r\nServer Side:\r\nProcessor 1.0 GHz\r\nRAM 1 GB\r\nHard Disk 40 GB\r\nClient Side:\r\nProcessor 800 MHz\r\nRAM 512 MB\r\nHard Disk 20 GB\r\nMinimum Software Requirement:\r\nServer Side:\r\nOS Window Server 2003\r\nWeb Server IIS 6.0\r\nFront End .NET Framework 4.0\r\nBack End Microsoft SQL Server 2008\r\nClient Side:\r\nOS Window XP or any compatible\r\nOS\r\nBrowser Internet explorer 7.0 or any\r\ncompatible Browser\r\nStart\r\nIs\r\nRegistered\r\n?\r\nStop\r\nLogin\r\nRegistration\r\nNo\r\nIs\r\nValid\r\n?\r\nYes\r\nNo\r\nYes\r\nIs\r\nAdmin\r\n?\r\nYes\r\nYes\r\nChange Profile\r\nManage Video & Photo\r\nSend Friend request\r\nChat\r\nView Event & News\r\nView Advertisement\r\nView Notification\r\nSend SMS And Email\r\nManage friends\r\nManage Video And Photo\r\nManage Notification\r\nManage Friend Request\r\nManage News & Event\r\nManage Advertisement\r\nManage User Profile\r\nSend Mail & Message\r\nNo\r\nSystem Flow Chart\r\nLogout\r\nGantt chart\r\nTask Time Duration (In Days) Total Days\r\n15 30 45 60 75 90\r\nRequirement\r\nGathering & Analysis\r\n15\r\nDesigning 15\r\nCoding 35\r\nTesting 15\r\nDeployment &\r\nImplementation\r\n10\r\nTotal 90\r\nUSER\r\nADMIN\r\nPassword\r\nUsername\r\nsend REQUEST Manage\r\nRequest from\r\n_userid\r\nRequest to\r\n_userid\r\nMESSAGE/EMAIL Send\r\nMessage from\r\n_userid\r\nMessage_to\r\n_userid\r\nMessage\r\ndescription\r\nsend\r\nmanage EVENT Manage\r\nEvent_Id Friend_Id\r\nEventdate\r\ncreate &\r\nManage\r\nALBUM/PHOTO\r\nAlbum_Id\r\nPhoto_Id\r\nAlbum_Desc\r\nCreate&\r\nManage\r\nVIDEO Manage\r\nVideo_Id Video_Desc Uploaded Date_Id\r\nUpload\r\nAdmin_id\r\nPassword\r\n1\r\n1\r\n1\r\n1\r\n1\r\n1\r\n1\r\n1 1 1\r\nM\r\nM\r\nM\r\nM\r\nM M\r\nM\r\nM\r\nM\r\nM\r\nView Advertisement Manage\r\n1\r\nM M\r\n1\r\nUml Diagram\r\nUse case diagram for Admin\r\nUse case diagram for User\r\nActivity Diagram for Admin\r\nActivity Diagram for User\r\nclass diagram\r\nSequence diagram for Admin\r\nSequence diagram for user\r\nCollabration diagram for Admin\r\nCollabration diagram for User\r\n', 3, 'publish');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `salt` varchar(255) NOT NULL DEFAULT '$2y$10$quickbrownfoxjumpsover'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `date`, `first_name`, `last_name`, `username`, `email`, `image`, `password`, `role`, `details`, `salt`) VALUES
(31, 1517383723, '    sudhakar', '     verma', 'sudha', 's@gmail.com', 'facebook.png', '1234', 'admin', '', '$2y$10$quickbrownfoxjumpsover');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catagory`
--
ALTER TABLE `catagory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catagory`
--
ALTER TABLE `catagory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
