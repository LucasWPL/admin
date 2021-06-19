-- TABLE: baixa_lancamento
CREATE TABLE IF NOT EXISTS `baixa_lancamento` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

-- TABLE: bancos
CREATE TABLE IF NOT EXISTS `bancos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod` int(11) NOT NULL,
  `banco` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("1", "1", "001 - BANCO DO BRASIL S/A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("2", "2", "002 - BANCO CENTRAL DO BRASIL");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("3", "3", "003 - BANCO DA AMAZONIA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("4", "4", "004 - BANCO DO NORDESTE DO BRASIL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("5", "7", "007 - BANCO NAC DESENV. ECO. SOCIAL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("6", "8", "008 - BANCO MERIDIONAL DO BRASIL");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("7", "20", "020 - BANCO DO ESTADO DE ALAGOAS S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("8", "21", "021 - BANCO DO ESTADO DO ESPIRITO SANTO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("9", "22", "022 - BANCO DE CREDITO REAL DE MINAS GERAIS SA");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("10", "24", "024 - BANCO DO ESTADO DE PERNAMBUCO");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("11", "25", "025 - BANCO ALFA S/A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("12", "26", "026 - BANCO DO ESTADO DO ACRE S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("13", "27", "027 - BANCO DO ESTADO DE SANTA CATARINA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("14", "28", "028 - BANCO DO ESTADO DA BAHIA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("15", "29", "029 - BANCO DO ESTADO DO RIO DE JANEIRO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("16", "30", "030 - BANCO DO ESTADO DA PARAIBA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("17", "31", "031 - BANCO DO ESTADO DE GOIAS S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("18", "32", "032 - BANCO DO ESTADO DO MATO GROSSO S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("19", "33", "033 - BANCO DO ESTADO DE SAO PAULO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("20", "34", "034 - BANCO DO ESADO DO AMAZONAS S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("21", "35", "035 - BANCO DO ESTADO DO CEARA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("22", "36", "036 - BANCO DO ESTADO DO MARANHAO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("23", "37", "037 - BANCO DO ESTADO DO PARA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("24", "38", "038 - BANCO DO ESTADO DO PARANA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("25", "39", "039 - BANCO DO ESTADO DO PIAUI S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("26", "41", "041 - BANCO DO ESTADO DO RIO GRANDE DO SUL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("27", "47", "047 - BANCO DO ESTADO DE SERGIPE S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("28", "48", "048 - BANCO DO ESTADO DE MINAS GERAIS S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("29", "59", "059 - BANCO DO ESTADO DE RONDONIA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("30", "66", "066 - BANCO MORGAN STANLEY S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("31", "70", "070 - BANCO DE BRASILIA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("32", "77", "077 - BANCO DE INTER S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("33", "104", "104 - CAIXA ECONOMICA FEDERAL");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("34", "106", "106 - BANCO ITABANCO S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("35", "107", "107 - BANCO BBM S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("36", "109", "109 - BANCO CREDIBANCO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("37", "116", "116 - BANCO B.N.L DO BRASIL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("38", "129", "129 - UBS BRASIL BANCO DE INVESTIMENTO S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("39", "148", "148 - MULTI BANCO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("40", "151", "151 - CAIXA ECONOMICA DO ESTADO DE SAO PAULO");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("41", "153", "153 - CAIXA ECONOMICA DO ESTADO DO R.G.SUL");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("42", "165", "165 - BANCO NORCHEM S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("43", "166", "166 - BANCO INTER-ATLANTICO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("44", "168", "168 - BANCO C.C.F. BRASIL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("45", "175", "175 - CONTINENTAL BANCO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("46", "184", "184 - BBA - CREDITANSTALT S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("47", "199", "199 - BANCO FINANCIAL PORTUGUES");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("48", "200", "200 - BANCO FRICRISA AXELRUD S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("49", "201", "201 - BANCO AUGUSTA INDUSTRIA E COMERCIAL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("50", "204", "204 - BANCO S.R.L S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("51", "205", "205 - BANCO SUL AMERICA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("52", "206", "206 - BANCO MARTINELLI S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("53", "208", "208 - BANCO PACTUAL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("54", "210", "210 - DEUTSCH SUDAMERIKANICHE BANK AG");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("55", "211", "211 - BANCO SISTEMA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("56", "212", "212 - BANCO ORIGINAL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("57", "213", "213 - BANCO ARBI S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("58", "214", "214 - BANCO DIBENS S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("59", "215", "215 - BANCO AMERICA DO SUL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("60", "216", "216 - BANCO REGIONAL MALCON S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("61", "217", "217 - BANCO AGROINVEST S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("62", "218", "218 - BBS - BANCO BONSUCESSO S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("63", "219", "219 - BANCO DE CREDITO DE SAO PAULO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("64", "220", "220 - BANCO CREFISUL");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("65", "221", "221 - BANCO GRAPHUS S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("66", "222", "222 - BANCO AGF BRASIL S. A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("67", "223", "223 - BANCO INTERUNION S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("68", "224", "224 - BANCO FIBRA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("69", "225", "225 - BANCO BRASCAN S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("70", "228", "228 - BANCO ICATU S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("71", "229", "229 - BANCO CRUZEIRO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("72", "230", "230 - BANCO BANDEIRANTES S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("73", "231", "231 - BANCO BOAVISTA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("74", "232", "232 - BANCO INTERPART S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("75", "233", "233 - BANCO MAPPIN S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("76", "234", "234 - BANCO LAVRA S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("77", "235", "235 - BANCO LIBERAL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("78", "236", "236 - BANCO CAMBIAL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("79", "237", "237 - BANCO BRADESCO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("80", "239", "239 - BANCO BANCRED S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("81", "240", "240 - BANCO DE CREDITO REAL DE MINAS GERAIS S.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("82", "241", "241 - BANCO CLASSICO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("83", "242", "242 - BANCO EUROINVEST S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("84", "243", "243 - BANCO STOCK S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("85", "244", "244 - BANCO CIDADE S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("86", "245", "245 - BANCO EMPRESARIAL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("87", "246", "246 - BANCO ABC ROMA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("88", "247", "247 - BANCO OMEGA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("89", "249", "249 - BANCO INVESTCRED S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("90", "250", "250 - BANCO SCHAHIN CURY S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("91", "251", "251 - BANCO SAO JORGE S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("92", "252", "252 - BANCO FININVEST S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("93", "254", "254 - BANCO PARANA BANCO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("94", "255", "255 - MILBANCO S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("95", "256", "256 - BANCO GULVINVEST S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("96", "258", "258 - BANCO INDUSCRED S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("97", "260", "260 - NU PAGAMENTOS S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("98", "261", "261 - BANCO VARIG S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("99", "262", "262 - BANCO BOREAL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("100", "263", "263 - BANCO CACIQUE");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("101", "264", "264 - BANCO PERFORMANCE S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("102", "265", "265 - BANCO FATOR S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("103", "266", "266 - BANCO CEDULA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("104", "267", "267 - BANCO BBM-COM.C.IMOB.CFI S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("105", "275", "275 - BANCO REAL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("106", "277", "277 - BANCO PLANIBANC S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("107", "282", "282 - BANCO BRASILEIRO COMERCIAL");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("108", "291", "291 - BANCO DE CREDITO NACIONAL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("109", "294", "294 - BCR - BANCO DE CREDITO REAL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("110", "295", "295 - BANCO CREDIPLAN S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("111", "300", "300 - BANCO DE LA NACION ARGENTINA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("112", "302", "302 - BANCO DO PROGRESSO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("113", "303", "303 - BANCO HNF S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("114", "304", "304 - BANCO PONTUAL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("115", "308", "308 - BANCO COMERCIAL BANCESA S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("116", "318", "318 - BANCO B.M.G. S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("117", "320", "320 - BANCO INDUSTRIAL E COMERCIAL");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("118", "341", "341 - BANCO ITAU S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("119", "346", "346 - BANCO FRANCES E BRASILEIRO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("120", "347", "347 - BANCO SUDAMERIS BRASIL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("121", "351", "351 - BANCO BOZANO SIMONSEN S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("122", "353", "353 - BANCO GERAL DO COMERCIO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("123", "356", "356 - ABN AMRO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("124", "366", "366 - BANCO SOGERAL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("125", "369", "369 - PONTUAL");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("126", "370", "370 - BEAL - BANCO EUROPEU PARA AMERICA LATINA");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("127", "372", "372 - BANCO ITAMARATI S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("128", "375", "375 - BANCO FENICIA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("129", "376", "376 - CHASE MANHATTAN BANK S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("130", "388", "388 - BANCO MERCANTIL DE DESCONTOS S/A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("131", "389", "389 - BANCO MERCANTIL DO BRASIL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("132", "392", "392 - BANCO MERCANTIL DE SAO PAULO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("133", "394", "394 - BANCO B.M.C. S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("134", "399", "399 - HSBC BANK BRASIL S.A. â BANCO MÃLTIPLO");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("135", "409", "409 - UNIBANCO - UNIAO DOS BANCOS BRASILEIROS");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("136", "412", "412 - BANCO NACIONAL DA BAHIA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("137", "415", "415 - BANCO NACIONAL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("138", "420", "420 - BANCO NACIONAL DO NORTE S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("139", "422", "422 - BANCO SAFRA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("140", "424", "424 - BANCO NOROESTE S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("141", "434", "434 - BANCO FORTALEZA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("142", "453", "453 - BANCO RURAL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("143", "456", "456 - BANCO TOKIO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("144", "464", "464 - BANCO SUMITOMO BRASILEIRO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("145", "466", "466 - BANCO MITSUBISHI BRASILEIRO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("146", "472", "472 - LLOYDS BANK PLC");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("147", "473", "473 - BANCO FINANCIAL PORTUGUES S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("148", "477", "477 - CITIBANK N.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("149", "479", "479 - BANCO DE BOSTON S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("150", "480", "480 - BANCO PORTUGUES DO ATLANTICO-BRASIL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("151", "483", "483 - BANCO AGRIMISA S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("152", "487", "487 - DEUTSCHE BANK S.A - BANCO ALEMAO");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("153", "488", "488 - BANCO J. P. MORGAN S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("154", "489", "489 - BANESTO BANCO URUGAUAY S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("155", "492", "492 - INTERNATIONALE NEDERLANDEN BANK N.V.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("156", "493", "493 - BANCO UNION S.A.C.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("157", "494", "494 - BANCO LA REP. ORIENTAL DEL URUGUAY");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("158", "495", "495 - BANCO LA PROVINCIA DE BUENOS AIRES");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("159", "496", "496 - BANCO EXTERIOR DE ESPANA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("160", "498", "498 - CENTRO HISPANO BANCO");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("161", "499", "499 - BANCO IOCHPE S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("162", "501", "501 - BANCO BRASILEIRO IRAQUIANO S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("163", "502", "502 - BANCO SANTANDER S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("164", "504", "504 - BANCO MULTIPLIC S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("165", "505", "505 - BANCO GARANTIA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("166", "600", "600 - BANCO LUSO BRASILEIRO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("167", "601", "601 - BFC BANCO S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("168", "602", "602 - BANCO PATENTE S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("169", "604", "604 - BANCO INDUSTRIAL DO BRASIL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("170", "607", "607 - BANCO SANTOS NEVES S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("171", "608", "608 - BANCO OPEN S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("172", "610", "610 - BANCO V.R. S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("173", "611", "611 - BANCO PAULISTA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("174", "612", "612 - BANCO GUANABARA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("175", "613", "613 - BANCO PECUNIA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("176", "616", "616 - BANCO INTERPACIFICO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("177", "617", "617 - BANCO INVESTOR S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("178", "618", "618 - BANCO TENDENCIA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("179", "621", "621 - BANCO APLICAP S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("180", "622", "622 - BANCO DRACMA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("181", "623", "623 - BANCO PANAMERICANO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("182", "624", "624 - BANCO GENERAL MOTORS S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("183", "625", "625 - BANCO ARAUCARIA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("184", "626", "626 - BANCO FICSA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("185", "627", "627 - BANCO DESTAK S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("186", "628", "628 - BANCO CRITERIUM S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("187", "629", "629 - BANCORP BANCO COML. E. DE INVESTMENTO");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("188", "630", "630 - BANCO INTERCAP S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("189", "633", "633 - BANCO REDIMENTO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("190", "634", "634 - BANCO TRIANGULO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("191", "635", "635 - BANCO DO ESTADO DO AMAPA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("192", "637", "637 - BANCO SOFISA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("193", "638", "638 - BANCO PROSPER S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("194", "639", "639 - BIG S.A. - BANCO IRMAOS GUIMARAES");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("195", "640", "640 - BANCO DE CREDITO METROPOLITANO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("196", "641", "641 - BANCO EXCEL ECONOMICO S/A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("197", "643", "643 - BANCO SEGMENTO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("198", "645", "645 - BANCO DO ESTADO DE RORAIMA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("199", "647", "647 - BANCO MARKA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("200", "648", "648 - BANCO ATLANTIS S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("201", "649", "649 - BANCO DIMENSAO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("202", "650", "650 - BANCO PEBB S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("203", "652", "652 - ITAÃ UNIBANCO HOLDING S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("204", "653", "653 - BANCO INDUSVAL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("205", "654", "654 - BANCO A. J. RENNER S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("206", "655", "655 - BANCO VOTORANTIM S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("207", "656", "656 - BANCO MATRIX S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("208", "657", "657 - BANCO TECNICORP S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("209", "658", "658 - BANCO PORTO REAL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("210", "702", "702 - BANCO SANTOS S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("211", "705", "705 - BANCO INVESTCORP S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("212", "707", "707 - BANCO DAYCOVAL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("213", "711", "711 - BANCO VETOR S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("214", "713", "713 - BANCO CINDAM S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("215", "715", "715 - BANCO VEGA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("216", "718", "718 - BANCO OPERADOR S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("217", "719", "719 - BANCO PRIMUS S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("218", "720", "720 - BANCO MAXINVEST S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("219", "721", "721 - BANCO CREDIBEL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("220", "722", "722 - BANCO INTERIOR DE SAO PAULO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("221", "724", "724 - BANCO PORTO SEGURO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("222", "725", "725 - BANCO FINABANCO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("223", "726", "726 - BANCO UNIVERSAL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("224", "728", "728 - BANCO FITAL S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("225", "729", "729 - BANCO FONTE S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("226", "730", "730 - BANCO COMERCIAL PARAGUAYO S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("227", "731", "731 - BANCO GNPP S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("228", "732", "732 - BANCO PREMIER S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("229", "733", "733 - BANCO NACOES S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("230", "734", "734 - BANCO GERDAU S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("231", "735", "735 - BACO POTENCIAL");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("232", "736", "736 - BANCO UNITED S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("233", "737", "737 - THECA");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("234", "738", "738 - MARADA");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("235", "739", "739 - BGN");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("236", "740", "740 - BCN BARCLAYS");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("237", "741", "741 - BRP");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("238", "742", "742 - EQUATORIAL");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("239", "743", "743 - BANCO EMBLEMA S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("240", "744", "744 - THE FIRST NATIONAL BANK OF BOSTON");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("241", "745", "745 - CITIBAN N.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("242", "746", "746 - MODAL SA");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("243", "747", "747 - RAIBOBANK DO BRASIL");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("244", "748", "748 - SICREDI");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("245", "749", "749 - BRMSANTIL SA");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("246", "750", "750 - BANCO REPUBLIC NATIONAL OF NEW YORK (BRA");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("247", "751", "751 - DRESDNER BANK LATEINAMERIKA-BRASIL S/A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("248", "752", "752 - BANCO BANQUE NATIONALE DE PARIS BRASIL S");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("249", "753", "753 - BANCO COMERCIAL URUGUAI S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("250", "755", "755 - BANCO MERRILL LYNCH S.A");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("251", "756", "756 - BANCO COOPERATIVO DO BRASIL S.A.");
INSERT INTO `bancos` (`id`, `cod`, `banco`) VALUES ("252", "757", "757 - BANCO KEB DO BRASIL S.A.");

-- TABLE: cliente
CREATE TABLE IF NOT EXISTS `cliente` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

-- TABLE: cliente_endereco
CREATE TABLE IF NOT EXISTS `cliente_endereco` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

-- TABLE: condicao_pagamento
CREATE TABLE IF NOT EXISTS `condicao_pagamento` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

-- TABLE: conta_financeira
CREATE TABLE IF NOT EXISTS `conta_financeira` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(63) NOT NULL,
  `banco` varchar(64) DEFAULT NULL,
  `agencia` varchar(32) DEFAULT NULL,
  `conta` varchar(32) DEFAULT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCadastro` int(16) NOT NULL,
  `usuarioCadastroNome` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

-- TABLE: despesa
CREATE TABLE IF NOT EXISTS `despesa` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

-- TABLE: emitente
CREATE TABLE IF NOT EXISTS `emitente` (
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
CREATE TABLE IF NOT EXISTS `emitente_endereco` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

-- TABLE: forma_pagamento
CREATE TABLE IF NOT EXISTS `forma_pagamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numReceita` int(11) NOT NULL,
  `descricao` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

-- TABLE: fornecedor
CREATE TABLE IF NOT EXISTS `fornecedor` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

-- TABLE: fornecedor_endereco
CREATE TABLE IF NOT EXISTS `fornecedor_endereco` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

-- TABLE: receita
CREATE TABLE IF NOT EXISTS `receita` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

-- TABLE: user
CREATE TABLE IF NOT EXISTS `user` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

-- TABLE: venda
CREATE TABLE IF NOT EXISTS `venda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuarioCadastro` int(11) NOT NULL,
  `usuarioCadastroNome` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

