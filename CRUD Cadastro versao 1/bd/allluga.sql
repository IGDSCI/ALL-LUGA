SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `tb_sexo`(
    `ID_Sexo` int NOT NULL,
    `Genero` varchar(14)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_sexo` (`ID_Sexo`, `Genero`) VALUES
(1, 'Masculino'),
(2, 'Feminino'),
(3, 'Prefiro não dizer');

CREATE TABLE `tb_endereco` (
    `ID_Endereco` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `Estado` varchar(100),
    `Cidade` varchar(100),
    `CEP` int 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_endereco` (`Estado`, `Cidade`, `CEP`) VALUES
('Parana', 'Curitiba', 83023238);

CREATE TABLE `tb_tipo_usuario` (
    `ID_TipoUsu` int NOT NULL,
    `Tipo` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_tipo_usuario` (`ID_TipoUsu`, `Tipo`) VALUES
(1, 'Administrador'),
(2, 'Locador'),
(3, 'Locatário');

CREATE TABLE `tb_usuario` (
    `ID_Usuario` int PRIMARY KEY AUTO_INCREMENT,
    `Login` varchar(55),
    `Senha` varchar(40),
    `Telefone` varchar(20),
    `cpf` varchar(11) NOT NULL,
    `ID_Endereco` int NOT NULL, 
    KEY (`ID_Endereco`),
    FOREIGN KEY (`ID_Endereco`) REFERENCES `tb_endereco` (`ID_Endereco`),
    `DataNasc` date,
    `ID_TipoUsu` int NOT NULL,
    `ID_TipoSexo` int
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_usuario` (`Login`, `Senha`, `Telefone`, `ID_Endereco`, `DataNasc`, `ID_TipoUsu`, `ID_TipoSexo`) 
VALUES ('alef.manga', '70b4269b412a8af42b1f7b0d26eceff2', '(41)99777-1234', (SELECT ID_Endereco FROM tb_endereco), '1998-06-20', 2, 1);

CREATE TABLE `tb_produto` (
    `ID_Produto` int NOT NULL,
    `Nome` varchar(25),  
    `Preco` float NOT NULL,
    `Descricao` varchar(155),
    `Proprietario` int NOT NULL,
    `Categoria` varchar(15),
    `DataDeAnuncio` date
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `tb_sexo`
    ADD PRIMARY KEY (`ID_Sexo`);

ALTER TABLE `tb_tipo_usuario`
    ADD PRIMARY KEY (`ID_TipoUsu`);

ALTER TABLE `tb_usuario`
  ADD CONSTRAINT `FK_TipoUsu` FOREIGN KEY (`ID_TipoUsu`)
  REFERENCES `tb_tipo_usuario` (`ID_TipoUsu`),
  ADD CONSTRAINT `FK_TipoSexo` FOREIGN KEY (`ID_TipoSexo`)
  REFERENCES `tb_sexo` (`ID_Sexo`);

ALTER TABLE `tb_produto`
    ADD PRIMARY KEY (`ID_Produto`),
    ADD CONSTRAINT `FK_Proprietario` FOREIGN KEY (`Proprietario`)
    REFERENCES `tb_usuario` (`ID_Usuario`);