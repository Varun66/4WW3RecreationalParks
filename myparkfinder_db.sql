-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 02, 2019 at 02:32 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myparkfinder_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `objects`
--

DROP TABLE IF EXISTS `objects`;
CREATE TABLE IF NOT EXISTS `objects` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `Latitude` float NOT NULL,
  `Longitude` float NOT NULL,
  `ImageKey` text NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `objects`
--

INSERT INTO `objects` (`ID`, `Name`, `Latitude`, `Longitude`, `ImageKey`, `Description`) VALUES
(1, 'Bruce Peninsula National Park', 45.226, -81.5271, 'php870F.tmp', 'Bruce Peninsula National Park straddles the Niagara Escarpment, a huge forested ridge that runs through southern Ontario, Canada. The Grotto is a limestone cave overlooking Georgian Bay\'s clear waters. Cliffs frame the beach at nearby Indian Head Cove. Singing Sands Beach, on Lake Huron, has shallow waters with sand dunes and a boardwalk. The Bruce Trail passes caves, forests and cliff overlooks.'),
(2, 'High Park', 43.6466, -79.4659, 'php4377.tmp', 'High Park is a municipal park in Toronto, Ontario, Canada. It spans 161 hectares, and is a mixed recreational and natural park, with sporting facilities, cultural facilities, educational facilities, gardens, playgrounds and a zoo. One third of the park remains in a natural state, with a rare oak savannah ecology.'),
(3, 'Georgian Bay Islands National Park', 44.8743, -79.8721, 'phpBB0A.tmp', 'Georgian Bay Islands National Park consists of 63 small islands or parts of islands in Georgian Bay, near Port Severn, Ontario. The total park area is approximately 13.5 km^2. Prior to the creation of Fathom Five National Marine Park, Flowerpot Island was also a part of the park.'),
(4, 'Pinery Provincial Park', 43.2579, -81.8503, 'phpE4E6.tmp', 'Pinery Provincial Park is a provincial park located on Lake Huron near Grand Bend, Ontario. It occupies an area of 25.32 square kilometres. It is a natural environment-class Provincial Park created to help preserve oak savannah and the beach dune ecology. It has 1,275 sites of which 404 have electrical hookups.'),
(6, 'Algonquin Provincial Park', 45.502, -78.1675, 'php4AE1.tmp', 'Algonquin Provincial Park is in southeastern Ontario, Canada. Its forests, rivers and numerous lakes, including the large Lake of Two Rivers, are home to moose, bears and common loons. The parkâ€™s many trails include the Whiskey Rapids Trail, along the Oxtongue River, and the Barron Canyon Trail, with views from the north rim. The Algonquin Logging Museum features a re-created camp and a steam-powered amphibious tug.');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` text NOT NULL,
  `ParkName` text NOT NULL,
  `Rating` text NOT NULL,
  `Review` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`ID`, `Username`, `ParkName`, `Rating`, `Review`) VALUES
(1, 'John', 'Bruce Peninsula National Park', '5', 'This park is amazing! The water is very clear and beautiful. I always bring my family here for picnics.'),
(2, 'Alex', 'Bruce Peninsula National Park', '4', 'Fantastic place! I always have a great time every time I go there'),
(3, 'Amanda', 'High Park', '3', 'The park is always crowded! They have some nice spots though'),
(4, 'Alex', 'High Park', '4', 'Nice place. There is plenty of trails to go for walks and it\'s a great spot for kids.'),
(5, 'John', 'High Park', '4', 'They have a mini zoo which my kids love! Very nice views of nature and wildlife.'),
(6, 'Amanda', 'Bruce Peninsula National Park', '4', 'Amazing scenery and great place for canoeing/kayaking. This park has trails for all level of hikers as well!'),
(7, 'Amanda', 'Georgian Bay Islands National Park', '5', 'Absolute gem. Very clean and well maintained park. Fantastic place to experience nature!'),
(8, 'Amanda', 'Pinery Provincial Park', '4', 'Great family park! Only downside is that the picnic areas are very far apart'),
(9, 'John', 'Georgian Bay Islands National Park', '5', 'Great park! Very clean and staff are friendly. Fantastic waters. One of the best parks I have ever camped in'),
(10, 'John', 'Pinery Provincial Park', '4', 'It\'s a nice place to go camping. There are many activities like kayaking, paddle board, bicycle, hiking'),
(11, 'Alex', 'Georgian Bay Islands National Park', '4', 'You can get some great views at this park. I always enjoy my visits here!'),
(12, 'Alex', 'Pinery Provincial Park', '3', 'The beach and biking trails are decent. The park is very big so you have to drive everywhere.'),
(13, 'Chris', 'Bruce Peninsula National Park', '5', 'The place is gorgeous and breathtaking! The Grotto is a must see'),
(14, 'Chris', 'High Park', '5', 'Great park with lots of things to do. Fun place for kids'),
(15, 'Chris', 'Georgian Bay Islands National Park', '4', 'Nice relaxing park. Great place for kayaking and camping'),
(16, 'Chris', 'Pinery Provincial Park', '5', 'Loved camping here. Great place to go with family'),
(17, 'Chris', 'Algonquin Provincial Park', '5', 'A must see! It\'s beautiful in all seasons and it\'s one of my favorite parks.'),
(19, 'Alex', 'Algonquin Provincial Park', '4', 'Nice park! Great views and hiking trails');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `Email` text NOT NULL,
  `Password` char(60) NOT NULL,
  `BirthDate` text NOT NULL,
  `Age` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Name`, `Email`, `Password`, `BirthDate`, `Age`) VALUES
(1, 'John', 'john@dummy.com', '$2y$10$zD6tHC2ntqEpb8cJksWoGeyo8h2hpF/eJTQvXW6NiOz5N4LZB90qG', '1997-02-12', 22),
(2, 'Alex', 'alex@dummy.com', '$2y$10$2Em0u8m1AP9T/eMNAH/Xwu4c8RCTQI1XHdt2pfeBEzMsxo22Q92w2', '1987-09-03', 32),
(3, 'Amanda', 'amanda@dummy.com', '$2y$10$FqmCW7Lk8/HQH1Q9weujX.cHWxx59U11z36eTKTlhI0eEKnaJxI6u', '1972-03-23', 37),
(5, 'Chris', 'chris@dummy.com', '$2y$10$alRX0O09TSLTcJf501KGWOyfmGpzZcIFH61nEQn5cw4NVylJOu8t2', '1985-12-09', 36);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
