-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2015 at 09:05 AM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `littleBlog`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `teaser` text,
  `content` text,
  `postedOn` int(11) DEFAULT NULL,
  `teaserImg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `teaser`, `content`, `postedOn`, `teaserImg`) VALUES
(1, 'Article 1 title', 'Article 1 teaser ', 'Article 1 content', 1449217165, 'https://images.unsplash.com/photo-1446426156356-92b664d86b77?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&s=92e96949ac731e7cbcac943aa5934554'),
(2, 'Title 2', 'Teaser 2', 'Content 2', 123451542, 'https://images.unsplash.com/photo-1445699269025-bcc2c8f3faee?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&s=4976ce71b8fdd672a13658f7894a4a51'),
(3, 'Creating a Web Type Lockup', 'A type lockup is a typographic design where the words and characters are styled and arranged very specifically. Like the design is literally locked in place. This idea is slightly at-odds with the responsive web that we know and love, where text is fluid and wrappable and whatnot. Yet, the design possibilities of lockups are very appealing. I think we can hang onto what makes them awesome while still holding onto what makes the web awesome.', 'Sorry the website I just sent you the link to wasn''t looking right on your phone. I checked it out, and the layout was pretty jacked up. I personally caused that, as I''m solely responsible for each and every website on the internet. My bad, everybody.\n\n\n\nA special guest post by Jimmy Allweber.\nRemember that site I shared the other day for that cool hot sauce club I joined? If it was hard to navigate on your Nebulous Plexus 6700 you can blame me directly. I was the site owner, project manager, designer, and developer on that project.', 1449221759, 'https://images.unsplash.com/photo-1447752875215-b2761acb3c5d?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&s=21ce0991c656c3dc50f55b4ecc81d30d');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `rights` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `rights`) VALUES
(1, 'admin', 'sutmil@gmail.com', '123admin456', 100);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
