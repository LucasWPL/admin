-- TABLE: baixa_lancamento
CREATE TABLE `baixa_lancamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipoLancamento` varchar(16) NOT NULL,
  `lancamento` int(11) NOT NULL,
  `obsBaixa` text DEFAULT NULL,
  `valorBaixa` decimal(15,4) NOT NULL,
  `desconto` decimal(15,4) DEFAULT NULL,
  `juros` decimal(15,4) DEFAULT NULL,
  `contaBaixa` int(11) NOT NULL,
  `dataBaixa` date NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCadastro` varchar(16) NOT NULL,
  `usuarioCadastroNome` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4;

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
  `IE` int(11) DEFAULT NULL,
  `celular` varchar(64) DEFAULT NULL,
  `contatoComercial` varchar(64) DEFAULT NULL,
  `email` varchar(64) NOT NULL,
  `telefone` varchar(64) NOT NULL,
  `tipo` varchar(16) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCadastro` varchar(16) NOT NULL,
  `usuarioCadastroNome` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `CNPJ` (`CNPJ`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- TABLE: cliente_endereco
CREATE TABLE `cliente_endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CNPJ` varchar(32) NOT NULL,
  `CEP` varchar(10) NOT NULL,
  `UF` varchar(2) NOT NULL,
  `nro` int(11) NOT NULL,
  `xBairro` varchar(32) NOT NULL,
  `xCpl` text DEFAULT NULL,
  `xLgr` text NOT NULL,
  `xMun` varchar(32) NOT NULL,
  `cMun` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- TABLE: despesa
CREATE TABLE `despesa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nfe` int(11) DEFAULT NULL,
  `historico` varchar(128) NOT NULL,
  `valor` decimal(15,4) NOT NULL,
  `status` varchar(32) NOT NULL DEFAULT 'aberta',
  `entidadeTipo` varchar(32) DEFAULT NULL,
  `entidadeCNPJ` varchar(16) DEFAULT NULL,
  `entidadeNome` varchar(64) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- TABLE: emitente
CREATE TABLE `emitente` (
  `id` int(11) NOT NULL,
  `CNPJ` varchar(14) NOT NULL,
  `IE` int(11) NOT NULL,
  `fantasia` varchar(64) NOT NULL,
  `razaoSocial` text NOT NULL,
  `tipo` varchar(16) NOT NULL,
  `regime` varchar(16) NOT NULL,
  `telefone` varchar(16) NOT NULL,
  `email` varchar(32) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`CNPJ`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- TABLE: emitente_endereco
CREATE TABLE `emitente_endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CNPJ` varchar(32) NOT NULL,
  `CEP` varchar(10) NOT NULL,
  `UF` varchar(2) NOT NULL,
  `nro` int(11) NOT NULL,
  `xBairro` varchar(32) NOT NULL,
  `xCpl` text DEFAULT NULL,
  `xLgr` text NOT NULL,
  `xMun` varchar(32) NOT NULL,
  `cMun` int(11) NOT NULL,
  `logo` varchar(128) NOT NULL COMMENT 'está aqui pois na grid emitente seria problematico',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- TABLE: forma_pagamento
CREATE TABLE `forma_pagamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numReceita` int(11) NOT NULL,
  `descricao` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- TABLE: fornecedor
CREATE TABLE `fornecedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CNPJ` varchar(16) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `IE` int(11) DEFAULT NULL,
  `celular` varchar(64) DEFAULT NULL,
  `email` varchar(64) NOT NULL,
  `telefone` varchar(64) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCadastro` varchar(16) NOT NULL,
  `usuarioCadastroNome` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- TABLE: fornecedor_endereco
CREATE TABLE `fornecedor_endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CNPJ` varchar(32) NOT NULL,
  `CEP` varchar(10) NOT NULL,
  `UF` varchar(2) NOT NULL,
  `nro` int(11) NOT NULL,
  `xBairro` varchar(32) NOT NULL,
  `xCpl` text DEFAULT NULL,
  `xLgr` text NOT NULL,
  `xMun` varchar(32) NOT NULL,
  `cMun` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- TABLE: receita
CREATE TABLE `receita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nfe` int(11) DEFAULT NULL,
  `historico` varchar(128) NOT NULL,
  `valor` decimal(15,4) NOT NULL,
  `status` varchar(32) NOT NULL DEFAULT 'aberta',
  `entidadeTipo` varchar(32) DEFAULT NULL,
  `entidadeCNPJ` varchar(16) DEFAULT NULL,
  `entidadeNome` varchar(64) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb4;

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

-- TABLE: venda
CREATE TABLE `venda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCadastro` int(11) NOT NULL,
  `usuarioCadastroNome` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
