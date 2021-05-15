-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Maio-2021 às 14:12
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `userName` varchar(64) NOT NULL,
  `userLogin` varchar(32) NOT NULL,
  `userEmail` varchar(64) DEFAULT NULL,
  `userPass` text NOT NULL,
  `userDataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `userUserCadastro` varchar(16) NOT NULL,
  `userUserCadastroNome` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `userName`, `userLogin`, `userEmail`, `userPass`, `userDataCadastro`, `userUserCadastro`, `userUserCadastroNome`) VALUES
(1, 'Administrador', 'admin', NULL, 'root', '2021-05-08 16:23:21', '1', 'Administrador'),
(24, 'Administrador 2', 'admin2', 'pedro.lucaswpl@gmail.com', '$2y$10$wkCywCr4v3F9YYvjQyXWyeVDqwUAFYBVmpw7g5eUpCL1h8YfVdX0i', '2021-05-08 18:51:55', '1', 'Administrador'),
(38, 'Administrador 3', 'admin3', 'pedro.lucaswpl@gmail.com', '$2y$10$agTp/5NCogUkLJ6dBUEJ1.JGlRbEce39lUMN8incPK.YwjYt9QayS', '2021-05-08 19:15:33', '1', 'Administrador');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userLogin` (`userLogin`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
