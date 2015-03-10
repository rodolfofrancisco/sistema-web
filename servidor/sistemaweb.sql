-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 09-Mar-2015 às 19:51
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sistemaweb`
--
CREATE DATABASE IF NOT EXISTS `sistemaweb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sistemaweb`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE IF NOT EXISTS `grupo` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `tipo` varchar(40) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `grupo`
--

INSERT INTO `grupo` (`codigo`, `nome`, `tipo`) VALUES
(1, 'Grupo 1', 'Pós graduação'),
(4, 'Grupo 2', 'Ensino Fundamental'),
(8, 'Grupo 3', 'Graduação'),
(9, 'Grupo 4', 'Pós Graduação'),
(10, 'Grupo 5', 'Ensino Médio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `recurso`
--

DROP TABLE IF EXISTS `recurso`;
CREATE TABLE IF NOT EXISTS `recurso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caminho` varchar(100) NOT NULL,
  `codigogrupo` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `codigogrupo` (`codigogrupo`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acesso` int(11) NOT NULL DEFAULT '2',
  `login` varchar(30) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(40) NOT NULL,
  `codigogrupo` int(11) NOT NULL,
  `datanasc` varchar(20) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `telefone` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  KEY `codigogrupo` (`codigogrupo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `acesso`, `login`, `senha`, `nome`, `email`, `codigogrupo`, `datanasc`, `sexo`, `telefone`) VALUES
(14, 2, 'noob', 'e99a18c428cb38d5f260853678922e03', 'noob', 'noob@noob.com', 1, '06/03/2015', 'M', '(88) 8888-8888'),
(15, 1, 'Administrador', 'e99a18c428cb38d5f260853678922e03', 'Adminstrador', 'admin@gmail.com', 1, '09/02/1989', 'M', '(31) 1234-5678');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `recurso`
--
ALTER TABLE `recurso`
  ADD CONSTRAINT `recurso_ibfk_1` FOREIGN KEY (`codigogrupo`) REFERENCES `grupo` (`codigo`),
  ADD CONSTRAINT `recurso_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`codigogrupo`) REFERENCES `grupo` (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
