CREATE DATABASE  IF NOT EXISTS `sistemacidadao` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sistemacidadao`;
-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Fev-2023 às 20:58
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistemacidadao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `citizens`
--

CREATE TABLE `citizens` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nis` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `citizens` (`id`, `name`, `nis`) VALUES
(5, 'Novo Nome', '626.777.678-93'),
(8, 'John Doe', '517.285.508-58');
--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `citizens`
--
ALTER TABLE `citizens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `citizens`
--
ALTER TABLE `citizens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
