-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2025 at 01:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teste_epav7`
--
CREATE DATABASE IF NOT EXISTS `teste_epav7` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `teste_epav7`;

-- --------------------------------------------------------

--
-- Table structure for table `infogaleria`
--

CREATE TABLE `infogaleria` (
  `gId` int(11) NOT NULL,
  `pIdXgId` int(11) NOT NULL,
  `gArquivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `infoparticipante`
--

CREATE TABLE `infoparticipante` (
  `pId` int(11) NOT NULL,
  `pNome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inforanking`
--

CREATE TABLE `inforanking` (
  `rId` int(11) NOT NULL,
  `rIdParticipante` int(11) NOT NULL,
  `rPontuacaoFinal` int(11) NOT NULL DEFAULT 0,
  `rTempoInicial` timestamp NOT NULL DEFAULT current_timestamp(),
  `rTempoFinal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rParticipouBarraca1` tinyint(1) NOT NULL DEFAULT 0,
  `rParticipouBarraca2` tinyint(1) NOT NULL DEFAULT 0,
  `rParticipouBarraca3` tinyint(1) NOT NULL DEFAULT 0,
  `rParticipouBarraca4` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for table `infogaleria`
--
ALTER TABLE `infogaleria`
  ADD PRIMARY KEY (`gId`),
  ADD KEY `pIdxgId` (`pIdXgId`);

--
-- Indexes for table `infoparticipante`
--
ALTER TABLE `infoparticipante`
  ADD PRIMARY KEY (`pId`);

--
-- Indexes for table `inforanking`
--
ALTER TABLE `inforanking`
  ADD PRIMARY KEY (`rId`),
  ADD KEY `fk_infoparticipanteXinforanking` (`rIdParticipante`);

--
-- AUTO_INCREMENT for table `infogaleria`
--
ALTER TABLE `infogaleria`
  MODIFY `gId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `infoparticipante`
--
ALTER TABLE `infoparticipante`
  MODIFY `pId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT for table `inforanking`
--
ALTER TABLE `inforanking`
  MODIFY `rId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
