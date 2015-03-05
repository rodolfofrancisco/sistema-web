-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 03-Mar-2015 às 20:48
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sistemawebdb`
--
CREATE DATABASE IF NOT EXISTS `sistemawebdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `sistemawebdb`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE IF NOT EXISTS `endereco` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UsuarioID` int(11) NOT NULL,
  `Rua` varchar(100) NOT NULL,
  `Numero` int(11) NOT NULL,
  `Bairro` varchar(100) NOT NULL,
  `Cidade` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `UsuarioID` (`UsuarioID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`ID`, `UsuarioID`, `Rua`, `Numero`, `Bairro`, `Cidade`) VALUES
(3, 9, 'Rua 1', 1, 'B1', 'BH'),
(4, 10, 'RUA 2', 2, 'B2', 'BH'),
(5, 11, 'RUA 3', 3, 'B2', 'BH'),
(6, 12, 'z1', 1, 'z1', 'BH');

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupoestudo`
--

DROP TABLE IF EXISTS `grupoestudo`;
CREATE TABLE IF NOT EXISTS `grupoestudo` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) NOT NULL,
  `TipoGrupoID` int(11) NOT NULL,
  `Codigo` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Sigla` (`Nome`),
  UNIQUE KEY `Codigo` (`Codigo`),
  KEY `TipoGrupoID` (`TipoGrupoID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Extraindo dados da tabela `grupoestudo`
--

INSERT INTO `grupoestudo` (`ID`, `Nome`, `TipoGrupoID`, `Codigo`) VALUES
(5, 'N2', 2, 'N2'),
(11, 'N1', 1, 'N1'),
(52, 'Ensni', 1, 'EF01'),
(60, 'Grupo da Graduacao', 3, 'G01'),
(61, 'Grupo da Pos Graduacao', 4, 'PG01'),
(62, 'Grupo da Pos', 4, 'PG02'),
(63, 'Grupo do Ensino Medio', 2, 'EM02'),
(64, 'Grupo EM', 2, 'EM03'),
(84, 'PG09', 4, 'PG09'),
(85, 'Ensino Fundamental 09', 1, 'EnsF09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UsuarioID` int(11) NOT NULL,
  `NomeUsuario` varchar(100) NOT NULL,
  `Senha` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `NomeUsuario` (`NomeUsuario`),
  KEY `FK_Usuario` (`UsuarioID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`ID`, `UsuarioID`, `NomeUsuario`, `Senha`) VALUES
(6, 9, 'thiagopaivamed', 'abc123'),
(7, 10, 'marina', 'm123'),
(8, 11, 'amanda', 'abc555'),
(9, 12, 'zacas', 'abc123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sexo`
--

DROP TABLE IF EXISTS `sexo`;
CREATE TABLE IF NOT EXISTS `sexo` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Sigla` varchar(2) NOT NULL,
  `Tipo` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Tipo` (`Tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `sexo`
--

INSERT INTO `sexo` (`ID`, `Sigla`, `Tipo`) VALUES
(1, 'F', 'Feminino'),
(2, 'M', 'Masculino');

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefone`
--

DROP TABLE IF EXISTS `telefone`;
CREATE TABLE IF NOT EXISTS `telefone` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TipoTelefoneID` int(11) NOT NULL,
  `UsuarioID` int(11) NOT NULL,
  `Numero` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Numero` (`Numero`),
  KEY `FK_TipoTelefone` (`TipoTelefoneID`),
  KEY `FK_Usuario` (`UsuarioID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Extraindo dados da tabela `telefone`
--

INSERT INTO `telefone` (`ID`, `TipoTelefoneID`, `UsuarioID`, `Numero`) VALUES
(8, 1, 9, 88889999),
(9, 2, 9, 88998899),
(10, 3, 9, 77889988),
(11, 2, 10, 88879999),
(12, 1, 10, 88798899),
(13, 3, 10, 99879988),
(14, 2, 11, 88774455),
(15, 1, 11, 88798891),
(16, 3, 11, 99879989),
(17, 2, 12, 11223344),
(18, 1, 12, 33669988),
(19, 3, 12, 88554411);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipogrupo`
--

DROP TABLE IF EXISTS `tipogrupo`;
CREATE TABLE IF NOT EXISTS `tipogrupo` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Nome` (`Nome`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `tipogrupo`
--

INSERT INTO `tipogrupo` (`ID`, `Nome`) VALUES
(1, 'Ensino Fundamental'),
(2, 'Ensino Medio'),
(3, 'Graduacao'),
(4, 'Pos Graduacao');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipotelefone`
--

DROP TABLE IF EXISTS `tipotelefone`;
CREATE TABLE IF NOT EXISTS `tipotelefone` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Tipo` (`Tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tipotelefone`
--

INSERT INTO `tipotelefone` (`ID`, `Tipo`) VALUES
(3, 'Celular'),
(1, 'Telefone Comercial'),
(2, 'Telefone Residencial');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipousuario`
--

DROP TABLE IF EXISTS `tipousuario`;
CREATE TABLE IF NOT EXISTS `tipousuario` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Sigla` varchar(10) NOT NULL,
  `Tipo` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Tipo` (`Tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tipousuario`
--

INSERT INTO `tipousuario` (`ID`, `Sigla`, `Tipo`) VALUES
(1, 'ADM', 'Administrador'),
(2, 'UC', 'Usuario Comum');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) NOT NULL,
  `DataNascimento` date NOT NULL,
  `Email` varchar(100) NOT NULL,
  `SexoID` int(11) NOT NULL,
  `TipoUsuarioID` int(11) NOT NULL,
  `GrupoEstudoID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Email` (`Email`),
  KEY `FK_Sexo` (`SexoID`),
  KEY `FK_TipoUsuarioID` (`TipoUsuarioID`),
  KEY `GrupoEstudoID` (`GrupoEstudoID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`ID`, `Nome`, `DataNascimento`, `Email`, `SexoID`, `TipoUsuarioID`, `GrupoEstudoID`) VALUES
(9, 'Thiago', '1989-02-09', 'thiagopaivamed@gmail.com', 2, 1, 61),
(10, 'Marina', '1989-02-09', 'marina@gmail.com', 1, 2, 61),
(11, 'Amanda', '1987-02-09', 'amanda@gmail.com', 1, 2, 84),
(12, 'Zacarias', '2012-02-02', 'zaca@zaca.com', 2, 2, 52);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `FK_UsuarioID` FOREIGN KEY (`UsuarioID`) REFERENCES `usuarios` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `FK_Usuario` FOREIGN KEY (`UsuarioID`) REFERENCES `usuarios` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `telefone`
--
ALTER TABLE `telefone`
  ADD CONSTRAINT `FK_Usuarios` FOREIGN KEY (`UsuarioID`) REFERENCES `usuarios` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_TipoTelefone` FOREIGN KEY (`TipoTelefoneID`) REFERENCES `tipotelefone` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_GrupoEstudo` FOREIGN KEY (`GrupoEstudoID`) REFERENCES `grupoestudo` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Sexo` FOREIGN KEY (`SexoID`) REFERENCES `sexo` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_TipoUsuario` FOREIGN KEY (`TipoUsuarioID`) REFERENCES `tipousuario` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
