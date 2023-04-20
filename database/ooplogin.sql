-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2023 at 02:23 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ooplogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `passwordreset`
--

CREATE TABLE `passwordreset` (
  `passwordReset_id` int(11) NOT NULL,
  `passwordReset_email` text NOT NULL,
  `passwordReset_selector` text NOT NULL,
  `passwordReset_token` longtext NOT NULL,
  `passwordReset_expires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userfriendrequest`
--

CREATE TABLE `userfriendrequest` (
  `request_id` int(11) NOT NULL,
  `request_sender` int(11) NOT NULL,
  `request_receiver` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userfriends`
--

CREATE TABLE `userfriends` (
  `friends_id` int(11) NOT NULL,
  `friends_one` int(11) NOT NULL,
  `friends_two` int(11) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userfriends`
--

INSERT INTO `userfriends` (`friends_id`, `friends_one`, `friends_two`, `date_added`) VALUES
(20, 5, 23, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `usernotifications`
--

CREATE TABLE `usernotifications` (
  `noti_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `noti_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usernotifications`
--

INSERT INTO `usernotifications` (`noti_id`, `user_id`, `noti_message`) VALUES
(119, 23, 'Your profile has been updated.'),
(120, 23, 'Friend request has been sent to Dn1San1.'),
(121, 5, 'You recieved a friend request from Test.'),
(122, 23, 'Your post has been posted and is now under review.'),
(123, 23, 'Your post has been accepted and can now be viewed on your profile.'),
(124, 5, 'You and Test are now friends.'),
(125, 23, 'You and Dn1San1 are now friends.');

-- --------------------------------------------------------

--
-- Table structure for table `userposts`
--

CREATE TABLE `userposts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_picture` varchar(1000) NOT NULL,
  `post_description` text NOT NULL,
  `post_status` text NOT NULL DEFAULT 'under review'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userposts`
--

INSERT INTO `userposts` (`post_id`, `user_id`, `post_picture`, `post_description`, `post_status`) VALUES
(23, 23, 'uploads/64412e5e819b36.73630938.jpg', 'Hello World Again', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `userprofile_picture` varchar(1000) NOT NULL,
  `userprofile_description` text NOT NULL,
  `userprofile_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`profile_id`, `user_id`, `userprofile_picture`, `userprofile_description`, `userprofile_status`) VALUES
(27, 23, 'uploads/64412e3b799017.55247547.jpg', 'Hello World!', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_username` tinytext NOT NULL,
  `users_fullname` tinytext NOT NULL,
  `users_password` tinytext NOT NULL,
  `users_email` tinytext NOT NULL,
  `users_phone_number` int(11) NOT NULL,
  `users_date_of_birth` date NOT NULL,
  `users_role` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_username`, `users_fullname`, `users_password`, `users_email`, `users_phone_number`, `users_date_of_birth`, `users_role`) VALUES
(5, 'Dn1San1', 'Daniel Mozafari', '$2y$10$ObuAxo7oegmgknPgQLftfec/lYuBnYql6WTKfQ7vbCV7J0kE.Ezti', 'dmozafari12@gmail.com', 1, '1111-11-11', 'admin'),
(23, 'Test', 'Test User', '$2y$10$yy0dUZbbjKOruTTSUzFwjO3E/AhHgzlea1P58SSCH5URcyVtdUAL6', 'test@gmail.com', 2147483647, '2002-11-12', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `passwordreset`
--
ALTER TABLE `passwordreset`
  ADD PRIMARY KEY (`passwordReset_id`);

--
-- Indexes for table `userfriendrequest`
--
ALTER TABLE `userfriendrequest`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `userfriends`
--
ALTER TABLE `userfriends`
  ADD PRIMARY KEY (`friends_id`);

--
-- Indexes for table `usernotifications`
--
ALTER TABLE `usernotifications`
  ADD PRIMARY KEY (`noti_id`);

--
-- Indexes for table `userposts`
--
ALTER TABLE `userposts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `passwordreset`
--
ALTER TABLE `passwordreset`
  MODIFY `passwordReset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `userfriendrequest`
--
ALTER TABLE `userfriendrequest`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `userfriends`
--
ALTER TABLE `userfriends`
  MODIFY `friends_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `usernotifications`
--
ALTER TABLE `usernotifications`
  MODIFY `noti_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `userposts`
--
ALTER TABLE `userposts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
