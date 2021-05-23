-- TABLE: baixa_lancamento
CREATE TABLE `baixa_lancamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipoLancamento` varchar(16) NOT NULL,
  `lancamento` int(11) NOT NULL,
  `obsBaixa` text DEFAULT NULL,
  `valorBaixa` decimal(15,4) NOT NULL,
  `contaBaixa` int(11) NOT NULL,
  `dataBaixa` date NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCadastro` varchar(16) NOT NULL,
  `usuarioCadastroNome` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

-- TABLE: bancos
CREATE TABLE `bancos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod` int(11) NOT NULL,
  `banco` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8mb4;

-- TABLE: cliente
CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CNPJ` varchar(16) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCadastro` varchar(16) NOT NULL,
  `usuarioCadastroNome` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `CNPJ` (`CNPJ`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- TABLE: condicao_pagamento
CREATE TABLE `condicao_pagamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(64) NOT NULL,
  `formaPagamento` varchar(64) NOT NULL,
  `parcelas` int(11) NOT NULL,
  `carencia` int(11) NOT NULL,
  `intervalo` int(11) NOT NULL,
  `desconto` decimal(15,4) NOT NULL,
  `diasBloqueados` varchar(32) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCadastro` varchar(16) NOT NULL,
  `usuarioCadastroNome` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- TABLE: conta_financeira
CREATE TABLE `conta_financeira` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(63) NOT NULL,
  `banco` varchar(64) DEFAULT NULL,
  `agencia` varchar(32) DEFAULT NULL,
  `conta` varchar(32) DEFAULT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCadastro` int(16) NOT NULL,
  `usuarioCadastroNome` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- TABLE: forma_pagamento
CREATE TABLE `forma_pagamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numReceita` int(11) NOT NULL,
  `descricao` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- TABLE: receita
CREATE TABLE `receita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nfe` int(11) DEFAULT NULL,
  `historico` varchar(128) NOT NULL,
  `valor` decimal(15,4) NOT NULL,
  `status` varchar(32) NOT NULL DEFAULT 'aberta',
  `entidadeTipo` varchar(32) DEFAULT NULL,
  `entidadeCNPJ` varchar(16) DEFAULT NULL,
  `condicaoPagamento` int(11) NOT NULL,
  `contaFinanceira` int(11) DEFAULT NULL,
  `parcela` int(11) NOT NULL DEFAULT 1,
  `totalParcelas` int(11) NOT NULL DEFAULT 1,
  `dataEmissao` date DEFAULT NULL,
  `dataVencimento` date NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCadastro` varchar(16) NOT NULL,
  `usuarioCadastroNome` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;

-- TABLE: user
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(64) NOT NULL,
  `userLogin` varchar(32) NOT NULL,
  `userEmail` varchar(64) DEFAULT NULL,
  `userPass` text NOT NULL,
  `userDataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `userUserCadastro` varchar(16) NOT NULL,
  `userUserCadastroNome` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userLogin` (`userLogin`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;

