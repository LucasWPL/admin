-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Maio-2021 às 15:37
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
-- Banco de dados: `sistema`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `baixa_lancamento`
--

CREATE TABLE `baixa_lancamento` (
  `id` int(11) NOT NULL,
  `tipoLancamento` varchar(16) NOT NULL,
  `lancamento` int(11) NOT NULL,
  `obsBaixa` text DEFAULT NULL,
  `valorBaixa` decimal(15,4) NOT NULL,
  `dataBaixa` date NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCadastro` varchar(16) NOT NULL,
  `usuarioCadastroNome` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `baixa_lancamento`
--

INSERT INTO `baixa_lancamento` (`id`, `tipoLancamento`, `lancamento`, `obsBaixa`, `valorBaixa`, `dataBaixa`, `dataCadastro`, `usuarioCadastro`, `usuarioCadastroNome`) VALUES
(10, 'receita', 5, 'teste', '800.0000', '2021-05-16', '2021-05-16 17:06:34', '1', 'Administrador'),
(11, 'receita', 4, 'parcial', '400.0000', '2021-05-16', '2021-05-16 17:09:08', '1', 'Administrador'),
(12, 'receita', 4, '', '400.0000', '2021-05-16', '2021-05-16 17:27:32', '1', 'Administrador'),
(13, 'receita', 6, '', '8000.0000', '2021-05-16', '2021-05-16 17:27:58', '1', 'Administrador'),
(14, 'receita', 6, '', '554.5200', '2021-05-16', '2021-05-16 17:28:05', '1', 'Administrador'),
(17, 'receita', 8, '', '500.0000', '2021-05-16', '2021-05-16 20:43:58', '1', 'Administrador'),
(21, 'receita', 2, '', '3000.0000', '2021-05-16', '2021-05-16 20:56:17', '1', 'Administrador'),
(22, 'receita', 7, '', '85.0000', '2021-05-16', '2021-05-16 21:53:33', '1', 'Administrador'),
(23, 'receita', 15, 'parcial', '200.0000', '2021-05-18', '2021-05-18 02:02:13', '1', 'Administrador'),
(24, 'receita', 15, '', '700.0000', '2021-05-18', '2021-05-18 02:06:28', '1', 'Administrador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `CNPJ` varchar(16) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCadastro` varchar(16) NOT NULL,
  `usuarioCadastroNome` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `CNPJ`, `nome`, `dataCadastro`, `usuarioCadastro`, `usuarioCadastroNome`) VALUES
(1, '04747896000128', 'MARILUX INDUSTRIA E COMERCIO LTDA', '2021-05-16 21:21:21', '1', 'Administrador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `condicao_pagamento`
--

CREATE TABLE `condicao_pagamento` (
  `id` int(11) NOT NULL,
  `descricao` varchar(64) NOT NULL,
  `formaPagamento` varchar(64) NOT NULL,
  `parcelas` int(11) NOT NULL,
  `carencia` int(11) NOT NULL,
  `intervalo` int(11) NOT NULL,
  `desconto` decimal(15,4) NOT NULL,
  `diasBloqueados` varchar(32) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCadastro` varchar(16) NOT NULL,
  `usuarioCadastroNome` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `condicao_pagamento`
--

INSERT INTO `condicao_pagamento` (`id`, `descricao`, `formaPagamento`, `parcelas`, `carencia`, `intervalo`, `desconto`, `diasBloqueados`, `dataCadastro`, `usuarioCadastro`, `usuarioCadastroNome`) VALUES
(1, '2 PARCELAS 30 DIAS', '15', 2, 15, 15, '0.0000', '', '2021-05-22 12:56:48', '1', 'Administrador'),
(2, 'À VISTA', '1', 1, 0, 0, '10.0000', '', '2021-05-22 13:37:34', '1', 'Administrador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `forma_pagamento`
--

CREATE TABLE `forma_pagamento` (
  `id` int(11) NOT NULL,
  `numReceita` int(11) NOT NULL,
  `descricao` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `forma_pagamento`
--

INSERT INTO `forma_pagamento` (`id`, `numReceita`, `descricao`) VALUES
(1, 1, 'Dinheiro'),
(2, 1, 'Dinheiro'),
(3, 2, 'Cheque'),
(4, 3, 'Cartão de crédito'),
(5, 4, 'Cartão de débito'),
(6, 5, 'Crédito loja'),
(7, 10, 'Vale alimentação'),
(8, 11, 'Vale refeição'),
(9, 12, 'Vale presente'),
(10, 13, 'Vale combustível'),
(11, 15, 'Boleto bancário'),
(12, 16, 'Depósito bancário'),
(13, 17, 'PIX'),
(14, 18, 'Transferência bancária'),
(15, 19, 'Cashback'),
(16, 90, 'Sem pagamento'),
(17, 99, 'Outros');

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita`
--

CREATE TABLE `receita` (
  `id` int(11) NOT NULL,
  `nfe` int(11) DEFAULT NULL,
  `historico` varchar(128) NOT NULL,
  `valor` decimal(15,4) NOT NULL,
  `status` varchar(32) NOT NULL DEFAULT 'aberta',
  `entidadeTipo` varchar(32) DEFAULT NULL,
  `entidadeCNPJ` varchar(16) DEFAULT NULL,
  `dataVencimento` date NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCadastro` varchar(16) NOT NULL,
  `usuarioCadastroNome` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `receita`
--

INSERT INTO `receita` (`id`, `nfe`, `historico`, `valor`, `status`, `entidadeTipo`, `entidadeCNPJ`, `dataVencimento`, `dataCadastro`, `usuarioCadastro`, `usuarioCadastroNome`) VALUES
(1, 56858, 'PAGAMENTO FRETE, VENDA 566, NF-e N° 56858', '100000.0000', 'apagada', NULL, NULL, '2021-05-15', '2021-05-16 00:38:18', '1', 'Administrador'),
(2, 123321, 'Ordenamento', '3000.0000', 'baixada', NULL, NULL, '2021-05-30', '2021-05-15 15:00:00', '1', 'Administrador'),
(3, 123321, 'Ordenamento', '3000.0000', 'aberta', NULL, NULL, '2021-05-30', '2021-05-15 15:00:00', '1', 'Administrador'),
(4, 56858, 'PAGAMENTO FRETE, VENDA 566, NF-e N° 56858', '800.0000', 'baixada', NULL, NULL, '2021-05-16', '2021-05-16 16:58:38', '1', 'Administrador'),
(5, 56858, 'Venda fone', '800.0000', 'baixada', NULL, NULL, '2021-05-16', '2021-05-16 16:58:50', '1', 'Administrador'),
(6, 56858, 'Venda reposição', '8554.5200', 'baixada', NULL, NULL, '2021-05-29', '2021-05-16 17:20:35', '1', 'Administrador'),
(7, 56858, 'teste', '85.0000', 'baixada', 'cliente', '04747896000128', '2021-05-29', '2021-05-16 17:41:10', '1', 'Administrador'),
(8, 124332, 'PAGAMENTO FRETE, VENDA 566, NF-e N° 56858', '500.0000', 'baixada', NULL, NULL, '2021-05-14', '2021-05-16 18:06:21', '1', 'Administrador'),
(9, 56858, 'PAGAMENTO FRETE, VENDA 566, NF-e N° 56858', '450.3200', 'aberta', 'cliente', '04747896000128', '2021-05-15', '2021-05-16 18:12:35', '1', 'Administrador'),
(10, 56858, 'PAGAMENTO FRETE, VENDA 566, NF-e N° 56858', '500.0000', 'aberta', 'cliente', '04747896000128', '2021-05-15', '2021-05-16 18:26:12', '1', 'Administrador'),
(11, 56858, 'PAGAMENTO FRETE, VENDA 566, NF-e N° 56858', '1500.0000', 'aberta', 'cliente', '04747896000128', '2021-05-19', '2021-05-16 18:26:23', '1', 'Administrador'),
(12, 56858, 'PAGADOR', '96.0000', 'aberta', 'cliente', '04747896000128', '2021-05-19', '2021-05-16 20:26:59', '1', 'Administrador'),
(13, 56858, 'PAGAMENTO FRETE, VENDA 566, NF-e N° 56858', '154.0000', 'aberta', 'cliente', '04747896000128', '2021-05-30', '2021-05-16 21:56:10', '1', 'Administrador'),
(14, 56858, 'PAGAMENTO FRETE, VENDA 566, NF-e N° 56858', '250.0000', 'aberta', 'cliente', '04747896000128', '2021-05-29', '2021-05-18 00:22:47', '1', 'Administrador'),
(15, 56858, 'PAGAMENTO FRETE, VENDA 566, NF-e N° 56858', '900.0000', 'baixada', 'cliente', '04747896000128', '2021-05-30', '2021-05-18 00:24:15', '1', 'Administrador');

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
(1, 'Administrador', 'admin', 'pedro.lucaswpl@gmail.com', '$2y$10$cGs0pNR6E3SB.97EeI6m8u4d/dvYLtWHDWr4ekb648GZouDluLI.u', '2021-05-08 16:23:21', '1', 'Administrador'),
(54, 'Usuário 2', 'admin2', 'pedro.lucaswpl@gmail.com', '$2y$10$xBLQ/jrr2vV3ovS3zxeXreTl4cJ5Y1eZmJQNW/a3C9iyjRCHlIpUG', '2021-05-15 16:12:19', '1', 'Administrador');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `baixa_lancamento`
--
ALTER TABLE `baixa_lancamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `CNPJ` (`CNPJ`);

--
-- Índices para tabela `condicao_pagamento`
--
ALTER TABLE `condicao_pagamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `forma_pagamento`
--
ALTER TABLE `forma_pagamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `receita`
--
ALTER TABLE `receita`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de tabela `baixa_lancamento`
--
ALTER TABLE `baixa_lancamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `condicao_pagamento`
--
ALTER TABLE `condicao_pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `forma_pagamento`
--
ALTER TABLE `forma_pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `receita`
--
ALTER TABLE `receita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
