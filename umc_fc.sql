
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `umc_fc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `umc_fc`;


CREATE TABLE `futbolistas` (
  `ID` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `edad` int(11) NOT NULL,
  `posicion` varchar(255) NOT NULL,
  `dorsal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `futbolistas` (`ID`, `imagen`, `nombre`, `edad`, `posicion`, `dorsal`) VALUES
(1, '1762388637_796b7adf7f7e1d985254.png', 'Diego Alviarez', 20, 'Delantero', 10),
(5, '1762377322_0782d513800590360135.png', 'Anyel Silva', 21, 'Portero', 1),
(6, '1762378076_bc324e2e976ed1867ba0.png', 'Neymar', 20, 'Delantero', 20),
(7, '1762378228_5045c6fc2f687293bb06.png', 'Messi', 45, 'Delantero', 11);


ALTER TABLE `futbolistas`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `futbolistas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;


