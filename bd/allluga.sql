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

CREATE TABLE `tb_tipo_usuario` (
    `ID_TipoUsu` int NOT NULL,
    `Tipo` varchar(14)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_tipo_usuario` (`ID_TipoUsu`, `Tipo`) VALUES
(1, 'Administrador'),
(2, 'Locador'),
(3, 'Locatário');

CREATE TABLE `tb_usuario` (
    `ID_Usuario` int PRIMARY KEY AUTO_INCREMENT,
    `Login` varchar(55),
    `Senha` varchar(40),
    `Telefone` varchar(13),
    `cpf` varchar(14),
    `DataNasc` date,
    `ID_TipoUsu` int,
    `ID_TipoSexo` int,
    `cep` varchar(9), 
    `Cidade` varchar(100),
    `Estado` varchar(100)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_usuario` (`Login`, `Senha`, `cpf`, `ID_TipoUsu`) VALUES
("LuisAdmin", "202cb962ac59075b964b07152d234b70", 123, 1);

CREATE TABLE `tb_categoria` (
    `ID_Categoria` int NOT NULL PRIMARY KEY,
    `TipoCategoria` varchar(55)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_categoria` (`ID_Categoria`, `TipoCategoria`) VALUES
(1, 'Eletrônicos'),
(2, 'Eletrodomésticos'),
(3, 'Utensílios'),
(4, 'Esportes');

CREATE TABLE `tb_produto` (
    `ID_Produto` int PRIMARY KEY AUTO_INCREMENT,
    `Nome` varchar(25),  
    `Descricao` varchar(300),
    `Preco` double,
    `Foto` varchar(40),
    `Proprietario` int NOT NULL,
    `ID_TipoCat` int NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*CREATE TABLE `tb_aluguel` (
    `ID_Aluguel` int not null primary key auto_increment,
    `ProdutoAlugado` int,
    `DadosAluguel` datetime,
    `Locatario` int
) ENGINE=InnoDB DEFAULT CHARSET=latin1;*/

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
    ADD CONSTRAINT `FK_Proprietario` FOREIGN KEY (`Proprietario`)
    REFERENCES `tb_usuario` (`ID_Usuario`),
    ADD CONSTRAINT `FK_TipoCat` FOREIGN KEY (`ID_TipoCat`)
    REFERENCES `tb_categoria` (`ID_Categoria`);
    
/*ALTER TABLE `tb_aluguel`
	ADD CONSTRAINT `FK_Locatario` FOREIGN KEY (`Locatario`)
    REFERENCES `tb_usuario` (`ID_Usuario`),
    ADD CONSTRAINT `FK_Alugado` FOREIGN KEY (`ProdutoAlugado`)
    REFERENCES `tb_produto` (`ID_Produto`);*/
    
/*delete FROM tb_usuario WHERE ID_Usuario= 19;*/