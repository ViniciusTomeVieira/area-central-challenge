-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Jun-2021 às 02:45
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `areacentral`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `valor_unitario` float NOT NULL,
  `estoque` int(10) NOT NULL,
  `data_ultima_venda` timestamp NULL DEFAULT NULL,
  `total_vendas` float NOT NULL,
  `codigo_de_barras` int(14) NOT NULL,
  `excluido` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `descricao`, `valor_unitario`, `estoque`, `data_ultima_venda`, `total_vendas`, `codigo_de_barras`, `excluido`) VALUES
(1, 'Arroz', 5.3, 2, '2021-06-01 05:37:10', 7, 888888, 0),
(9, 'Feijão', 7, 14, '2021-06-01 05:39:44', 1, 2147483647, 0),
(10, 'Abacaxi', 12, 6, NULL, 0, 565674687, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `produto` varchar(50) NOT NULL,
  `quantidade` int(10) NOT NULL,
  `valor_unitario` float NOT NULL,
  `valor_total_venda` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`id`, `produto`, `quantidade`, `valor_unitario`, `valor_total_venda`) VALUES
(1, 'Arroz', 3, 5, 15),
(2, 'Arroz', 3, 50, 150),
(3, 'Arroz', 3, 4.5, 13.5),
(4, 'Arroz', 2, 4.5, 9),
(5, 'Arroz', 2, 5.5, 11),
(6, 'Arroz', 3, 5.5, 16.5),
(7, 'Feijão', 3, 8, 24),
(8, 'Feijão', 4, 7, 28),
(9, 'Arroz', 3, 5.3, 15.9),
(10, 'Feijão', 5, 7, 35);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
