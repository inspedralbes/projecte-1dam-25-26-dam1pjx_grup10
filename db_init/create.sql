-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Temps de generació: 22-04-2026 a les 10:14:08
-- Versió del servidor: 11.4.8-MariaDB-ubu2404
-- Versió de PHP: 8.3.25
SET NAMES utf8mb4;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `a25izagomdel_Incidencies`
--


DROP TABLE IF EXISTS ACTUACIO;
DROP TABLE IF EXISTS DEPARTAMENT;
DROP TABLE IF EXISTS INCIDENCIA;
DROP TABLE IF EXISTS TECNIC;
DROP TABLE IF EXISTS TIPOLOGIA;

-- --------------------------------------------------------
CREATE DATABASE IF NOT EXISTS incidencies
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
-- Donem permisos a l'usuari 'usuari' per accedir a la base de dades 'persones'
-- sinó, aquest usuari no podrà veure la base de dades i no podrà accedir a les taules
GRANT ALL PRIVILEGES ON incidencies.* TO 'usuari'@'%';
FLUSH PRIVILEGES;
-- Després de crear la base de dades, cal seleccionar-la per treballar-hi
USE incidencies;
--
-- Estructura de la taula `ACTUACIO`
--

CREATE TABLE `ACTUACIO` (
                            `idACTUACIO` int(11) NOT NULL,
                            `descripcio` varchar(255) NOT NULL,
                            `temps` int(11) DEFAULT NULL,
                            `visible` int(11) DEFAULT 0 CHECK (`visible` = 0 or `visible` = 1),
                            `incidencia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de la taula `DEPARTAMENT`
--

CREATE TABLE `DEPARTAMENT` (
                               `idDepartament` int(11) NOT NULL,
                               `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de la taula `INCIDENCIA`
--

CREATE TABLE `INCIDENCIA` (
                              `idIncidencia` int(11) NOT NULL,
                              `descripcio` varchar(255) NOT NULL,
                              `prioritat` enum('Alta','Mitja','Baixa') DEFAULT NULL,
                              `data_inici` timestamp NULL DEFAULT NULL,
                              `data_fi` date DEFAULT NULL,
                              `departament` int(11) DEFAULT NULL,
                              `tecnic` int(11) DEFAULT NULL,
                              `tipologia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `TECNIC`
--

CREATE TABLE `TECNIC` (
                          `idTecnic` int(11) NOT NULL,
                          `nom` varchar(255) DEFAULT NULL,
                          `cognom` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `TIPOLOGIA`
--

CREATE TABLE `TIPOLOGIA` (
                             `idTipus` int(11) NOT NULL,
                             `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `ACTUACIO`
--
ALTER TABLE `ACTUACIO`
    ADD PRIMARY KEY (`idACTUACIO`),
ADD KEY `fk_incidencia` (`incidencia`);

--
-- Índexs per a la taula `DEPARTAMENT`
--
ALTER TABLE `DEPARTAMENT`
    ADD PRIMARY KEY (`idDepartament`);

--
-- Índexs per a la taula `INCIDENCIA`
--
ALTER TABLE `INCIDENCIA`
    ADD PRIMARY KEY (`idIncidencia`),
ADD KEY `fk_departament` (`departament`),
ADD KEY `fk_tipologia` (`tipologia`),
ADD KEY `fk_tecnic` (`tecnic`);

--
-- Índexs per a la taula `TECNIC`
--
ALTER TABLE `TECNIC`
    ADD PRIMARY KEY (`idTecnic`);

--
-- Índexs per a la taula `TIPOLOGIA`
--
ALTER TABLE `TIPOLOGIA`
    ADD PRIMARY KEY (`idTipus`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `ACTUACIO`
--
ALTER TABLE `ACTUACIO`
    MODIFY `idACTUACIO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `DEPARTAMENT`
--
ALTER TABLE `DEPARTAMENT`
    MODIFY `idDepartament` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `INCIDENCIA`
--
ALTER TABLE `INCIDENCIA`
    MODIFY `idIncidencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `TECNIC`
--
ALTER TABLE `TECNIC`
    MODIFY `idTecnic` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `TIPOLOGIA`
--
ALTER TABLE `TIPOLOGIA`
    MODIFY `idTipus` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `ACTUACIO`
--
ALTER TABLE `ACTUACIO`
    ADD CONSTRAINT `fk_incidencia` FOREIGN KEY (`incidencia`) REFERENCES `INCIDENCIA` (`idIncidencia`);

--
-- Restriccions per a la taula `INCIDENCIA`
--
ALTER TABLE `INCIDENCIA`
    ADD CONSTRAINT `fk_departament` FOREIGN KEY (`departament`) REFERENCES `DEPARTAMENT` (`idDepartament`),
ADD CONSTRAINT `fk_tecnic` FOREIGN KEY (`tecnic`) REFERENCES `TECNIC` (`idTecnic`),
ADD CONSTRAINT `fk_tipologia` FOREIGN KEY (`tipologia`) REFERENCES `TIPOLOGIA` (`idTipus`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

INSERT into TECNIC (nom, cognom)
values ('Jo', 'M');

INSERT into TECNIC (nom, cognom)
values ('I', 'G');

INSERT into TECNIC (nom, cognom)
values ('Pepita', 'Menganita');

INSERT into TECNIC (nom, cognom)
values ('Tècnic', 'Tecnicador');


INSERT into DEPARTAMENT (nom)
values ('Informàtica'),
       ('Català'),
       ('Castellà'),
       ('Matemàtiques');

INSERT into TIPOLOGIA (nom)
values ('Hardware'),
       ('Software'),
       ('Xarxa'),
       ('Seguretat'),
       ('Base de dades');


