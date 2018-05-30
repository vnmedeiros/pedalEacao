CREATE TABLE `cadastro` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `nome` varchar(256) DEFAULT NULL,
 `CPF` varchar(16) DEFAULT NULL,
 `email` varchar(256) DEFAULT NULL,
 `celular` varchar(18) DEFAULT NULL,
 `nascimento` date DEFAULT NULL,
 `logradouro` varchar(512) DEFAULT NULL,
 `bairro` varchar(256) DEFAULT NULL,
 `cep` varchar(10) DEFAULT NULL,
 `cidade` varchar(256) DEFAULT NULL,
 `UF` char(2) DEFAULT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `unq_cadastroCPF` (`CPF`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8

CREATE TABLE `evento` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `nome` varchar(128) DEFAULT NULL,
 `descricao` varchar(512) DEFAULT NULL,
 `data_evento` date DEFAULT NULL,
 `limite_inscricao` date DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8

CREATE TABLE `categoria` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `id_evento` int(11) DEFAULT NULL,
 `descricao` varchar(256) DEFAULT NULL,
 `valor` float DEFAULT NULL,
 PRIMARY KEY (`id`),
 KEY `fk_categoria_evento` (`id_evento`),
 CONSTRAINT `fk_categoria_evento` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

CREATE TABLE `cadastro_evento` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `id_cadastro` int(11) DEFAULT NULL,
 `id_categoria` int(11) DEFAULT NULL,
 `pago` char(1) DEFAULT 'N',
 PRIMARY KEY (`id`),
 UNIQUE KEY `uq_cadastro_categoria` (`id_cadastro`,`id_categoria`),
 KEY `fk_cadastroEvento_categoria` (`id_categoria`),
 CONSTRAINT `fk_cadastroEvento_cadastro` FOREIGN KEY (`id_cadastro`) REFERENCES `cadastro` (`id`),
 CONSTRAINT `fk_cadastroEvento_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=utf8

