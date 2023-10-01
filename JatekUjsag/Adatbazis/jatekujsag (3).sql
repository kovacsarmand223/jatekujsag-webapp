-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2023 at 11:30 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jatekujsag`
--

-- --------------------------------------------------------

--
-- Table structure for table `felhasznalo`
--

CREATE TABLE `felhasznalo` (
  `FelhasznaloNev` varchar(100) NOT NULL,
  `EmailCim` varchar(100) NOT NULL,
  `Jelszo` varchar(100) DEFAULT NULL,
  `Telefonszam` varchar(10) DEFAULT NULL,
  `SzuletesiDatum` date DEFAULT NULL,
  `Csaladnev` varchar(20) DEFAULT NULL,
  `Keresztnev` varchar(20) DEFAULT NULL,
  `Lakhely` varchar(50) DEFAULT NULL,
  `Foglalkozas` varchar(200) DEFAULT NULL,
  `kep` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `felhasznalo`
--

INSERT INTO `felhasznalo` (`FelhasznaloNev`, `EmailCim`, `Jelszo`, `Telefonszam`, `SzuletesiDatum`, `Csaladnev`, `Keresztnev`, `Lakhely`, `Foglalkozas`, `kep`) VALUES
('asd', 'asdf1234@gmail.com', 'd31d9f716bece3a5773365c4ea9a7c17', '9812389712', '2023-04-11', 'sadf', NULL, 'ASD', NULL, ''),
('asdfg', 'armand.kovacs13339@gmail.com', 'd31d9f716bece3a5773365c4ea9a7c17', NULL, '2023-04-12', NULL, NULL, NULL, NULL, 'IMG_8910.JPG'),
('kispityu', 'armando@gmail.com', '4d64f937758bd22977d4492d261c70ba', NULL, '2023-04-12', NULL, NULL, NULL, NULL, ''),
('kispityu234', 'armand.kovacs@gmail.com', 'd31d9f716bece3a5773365c4ea9a7c17', NULL, '2023-04-06', NULL, NULL, NULL, NULL, ''),
('kispityu33333333333', 'armand.kovacs13333339@gmail.com', 'd31d9f716bece3a5773365c4ea9a7c17', NULL, '2023-04-05', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gep`
--

CREATE TABLE `gep` (
  `FelhasznaloNev` varchar(100) NOT NULL,
  `EmailCim` varchar(100) NOT NULL,
  `Gepnev` varchar(100) NOT NULL,
  `OS` varchar(1000) DEFAULT NULL,
  `RAM` varchar(1000) DEFAULT NULL,
  `GPU` varchar(1000) DEFAULT NULL,
  `CPU` varchar(1000) DEFAULT NULL,
  `STORAGE` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gep`
--

INSERT INTO `gep` (`FelhasznaloNev`, `EmailCim`, `Gepnev`, `OS`, `RAM`, `GPU`, `CPU`, `STORAGE`) VALUES
('asdfg', 'armand.kovacs13339@gmail.com', 'Atomreaktor', 'sadf', 'asdf', 'asdf', 'sadf', 'asdf');

-- --------------------------------------------------------

--
-- Table structure for table `jatek`
--

CREATE TABLE `jatek` (
  `JatekNev` varchar(100) NOT NULL,
  `JatekkepId` int(200) DEFAULT NULL,
  `Jatekszoveg` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jatek`
--

INSERT INTO `jatek` (`JatekNev`, `JatekkepId`, `Jatekszoveg`) VALUES
('Cyberpunk 2077', 5, 'A Cyberpunk 2077 egy nyitott világú akció-kalandjáték, amely a jövőbeli Night City-ben játszódik. A játékosok testre szabható karakterüket irányíthatják, miközben bejárják a várost, teljesítenek küldetéseket és harcolnak a frakciókkal.'),
('Elden Ring', 2, 'Az Elden Ring egy várva várt akció-szerepjáték, amelyet a FromSoftware, a Bloodborne és a Dark Souls fejlesztője készít. A játékot a híres fantasy szerző, George R.R. Martin és Hidetaka Miyazaki, a FromSoftware alapítója közösen írta.'),
('GRAND THEFT AUTO 5', 7, 'Welcome to Los Santos When a young street hustler, a retired bank robber, and a terrifying psychopath find themselves entangled with some of the most frightening and deranged elements of the criminal underworld, the U.S. government, and the entertainment industry, they must pull off a series of dangerous heists to survive in a ruthless city in which they can trust nobody — least of all each other.'),
('Hogwarts Legacy', 3, 'A Hogwarts Legacy egy varázslatos akció-szerepjáték, amely a Harry Potter világában játszódik, ahol a játékosok létrehozhatnak saját varázsló karaktert, tanulhatnak a Roxfortban miközben felfedezik a varázslatos világot és harcolnak a sötét erőkkel szemben.'),
('Last of Us Part 1', 1, 'Az összesen több mint 500 Év Játéka díjat elnyert The Last of Us sorozatot a kritikusok érzelmes történetmesélése, felejthetetlen karakterei és feszültséggel teli akciókaland-játékmenete miatt éltetik.'),
('Monster Hunter: World', 6, 'A Monster Hunter: World egy akció-szerepjáték, amelyben a játékosok szörnyekkel küzdenek, hogy erősebb felszerelést szerezzenek és további küldetéseket teljesítsenek. A játék lenyűgözően részletes világgal rendelkezik, és az egyedi fegyverek és felszerelések testreszabásával lehetőséget biztosít a játékosoknak a saját játékstílusuk kialakítására.'),
('Resident Evil Village', 4, 'A Resident Evil Village egy akció-kalandjáték, amelyben a játékosok Ethan Winters karakterét irányítják, aki egy kísérteties faluban próbálja megmenteni lányát. A játék a Resident Evil sorozat legújabb része, és lenyűgöző vizuális stílussal, izgalmas játékmenettel és rémisztő ellenfelekkel rendelkezik.');

-- --------------------------------------------------------

--
-- Table structure for table `kategoria`
--

CREATE TABLE `kategoria` (
  `JatekNev` varchar(100) NOT NULL,
  `kategoria` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategoria`
--

INSERT INTO `kategoria` (`JatekNev`, `kategoria`) VALUES
('Cyberpunk 2077', 'Fantasy'),
('Cyberpunk 2077', 'Action'),
('Cyberpunk 2077', 'RPG'),
('Cyberpunk 2077', 'FPS'),
('Elden Ring', 'Fantasy'),
('Elden Ring', 'Open-world'),
('Elden Ring', 'RPG'),
('Elden Ring', 'Soulslike'),
('GRAND THEFT AUTO 5', 'Action'),
('GRAND THEFT AUTO 5', 'Open-world'),
('GRAND THEFT AUTO 5', 'Crime'),
('GRAND THEFT AUTO 5', 'RPG'),
('Hogwarts Legacy', 'RPG'),
('Hogwarts Legacy', 'THIRD-PERSON'),
('GRAND THEFT AUTO 5', 'THIRD-PERSON'),
('Last of Us Part 1', 'STORY-TELLING'),
('Last of Us Part 1', 'ACTION'),
('Last of Us Part 1', 'THIRD-PERSON-SHOOTER'),
('Resident Evil Village', 'HORROR'),
('Resident Evil Village', 'FIRST-PERSON'),
('Resident Evil Village', 'STORY-TELLING'),
('Cyberpunk 2077', 'Fantasztikus');

-- --------------------------------------------------------

--
-- Table structure for table `uzenet`
--

CREATE TABLE `uzenet` (
  `UzenetId` int(200) NOT NULL,
  `UzenetLike` bigint(255) DEFAULT NULL,
  `UzenetCim` varchar(200) DEFAULT NULL,
  `UzenetDatum` date DEFAULT NULL,
  `UzenetSzoveg` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uzenetiras`
--

CREATE TABLE `uzenetiras` (
  `FelhasznaloNev` varchar(100) NOT NULL,
  `UzenetId` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `valaszok`
--

CREATE TABLE `valaszok` (
  `UzenetId` int(100) NOT NULL,
  `Valaszok` varchar(2000) DEFAULT NULL,
  `ValaszokDatum` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD PRIMARY KEY (`FelhasznaloNev`),
  ADD UNIQUE KEY `EmailCim` (`EmailCim`);

--
-- Indexes for table `gep`
--
ALTER TABLE `gep`
  ADD KEY `FelhasznaloNev` (`FelhasznaloNev`);

--
-- Indexes for table `jatek`
--
ALTER TABLE `jatek`
  ADD PRIMARY KEY (`JatekNev`),
  ADD KEY `JatekNev` (`JatekNev`);

--
-- Indexes for table `kategoria`
--
ALTER TABLE `kategoria`
  ADD KEY `JatekNev` (`JatekNev`);

--
-- Indexes for table `uzenet`
--
ALTER TABLE `uzenet`
  ADD PRIMARY KEY (`UzenetId`);

--
-- Indexes for table `uzenetiras`
--
ALTER TABLE `uzenetiras`
  ADD PRIMARY KEY (`FelhasznaloNev`,`UzenetId`),
  ADD KEY `UzenetId` (`UzenetId`);

--
-- Indexes for table `valaszok`
--
ALTER TABLE `valaszok`
  ADD PRIMARY KEY (`UzenetId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `uzenet`
--
ALTER TABLE `uzenet`
  MODIFY `UzenetId` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `valaszok`
--
ALTER TABLE `valaszok`
  MODIFY `UzenetId` int(100) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gep`
--
ALTER TABLE `gep`
  ADD CONSTRAINT `gep_ibfk_1` FOREIGN KEY (`FelhasznaloNev`) REFERENCES `felhasznalo` (`FelhasznaloNev`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kategoria`
--
ALTER TABLE `kategoria`
  ADD CONSTRAINT `kategoria_ibfk_1` FOREIGN KEY (`JatekNev`) REFERENCES `jatek` (`JatekNev`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `uzenetiras`
--
ALTER TABLE `uzenetiras`
  ADD CONSTRAINT `uzenetiras_ibfk_1` FOREIGN KEY (`UzenetId`) REFERENCES `uzenet` (`UzenetId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uzenetiras_ibfk_2` FOREIGN KEY (`FelhasznaloNev`) REFERENCES `felhasznalo` (`FelhasznaloNev`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `valaszok`
--
ALTER TABLE `valaszok`
  ADD CONSTRAINT `valaszok_ibfk_1` FOREIGN KEY (`UzenetId`) REFERENCES `uzenet` (`UzenetId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
