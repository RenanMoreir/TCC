-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Jun-2023 às 14:18
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

drop database if exists quicktalk;

create database quicktalk;

use quicktalk;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `quicktalk`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `chat`
--

CREATE TABLE `chat` (
  `Id` int(11) NOT NULL,
  `Sender` int(11) NOT NULL,
  `Reciever` int(11) NOT NULL,
  `Message` varchar(500) NOT NULL,
  `Image` varchar(1000) NOT NULL,
  `Creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `conversations`
--

CREATE TABLE `conversations` (
  `Id` int(11) NOT NULL,
  `MainUser` int(11) NOT NULL,
  `OtherUser` int(11) NOT NULL,
  `Unread` varchar(1) NOT NULL DEFAULT 'n',
  `Modification` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `Username` varchar(15) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Password` varchar(70) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Dtnasc` varchar(30) not Null,
  `Telefone` varchar(30) NOT NULL,
  `Cpf` varchar(20) NOT NULL,
  `Cep` varchar(38) NOT NULL,
  `Rua` varchar(60) NOT NULL,
  `Numero` varchar(10) NOt NULL,
  `Bairro` varchar(50) NOT NULL,
  `Cidade` varchar(100) NOT NULL,

  `Picture` varchar(1000) default "user.jpg" NOT NULL,
  `Online` datetime NOT NULL,
  `Token` varchar(100) NOT NULL,
  `Secure` bigint(20) NOT NULL,
  `Creation` datetime NOT NULL,
  `Porte` VARCHAR(50) default 'Não tenho preferência',  
  `Especie` VARCHAR(50) default 'Não tenho preferência',
  `Sexo` VARCHAR(50) default 'Não tenho preferência',
  `Pelagem` VARCHAR(50) default 'Não tenho preferência',  
  `Tipo` int default 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `chat`
--
ALTER TABLE `chat`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `conversations`
--
ALTER TABLE `conversations`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE Usuario_abrigo 
( 
 Id_abrigo INT PRIMARY KEY AUTO_INCREMENT,  
 Username varchar(15) NOT NULL,
 Nome varchar(100) NOT NULL,
 Descricao varchar(1000) NOT NULL,
 Telefone varchar(15) NOT NULL,
 Cnpj varchar(18) NOT NULL,
 Estado varchar(50) NOT NULL,
 Rua varchar(100) NOT NULL,
 Cidade varchar(100) NOT NULL,
 Bairro varchar(100) NOT NULL,
 Numero varchar (5) NOT NULL,
 Cep varchar(12) NOT NULL,
 Email varchar(100) NOT NULL,
 Senha varchar(100) NOT NULL,
 Picture varchar(1000) default "user.jpg" NOT NULL,
 Online datetime NOT NULL,
 Token varchar(100) NOT NULL,
 Secure bigint(20) NOT NULL,
 Creation datetime NOT NULL,
 Tipo varchar(1) default 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE animal 
( 
 Nome VARCHAR(50)NOT NULL,  
 Id_animal INT PRIMARY KEY AUTO_INCREMENT,  
 Curtidas int default 0,
 Porte VARCHAR(50) NOT NULL,  
 Cor VARCHAR(50) NOT NULL,  
 Especie VARCHAR(50) NOT NULL,
 Raca VARCHAR(50) NOT NULL,  
 Sexo VARCHAR(50) NOT NULL,
 Pelagem VARCHAR(50) NOT NULL,
 Idade INT NOT NULL, 
 Descricao VARCHAR(500),  
 Imagem VARCHAR(100),
 FK_id_abrigo INT  
); 


INSERT INTO `usuario_abrigo` (`Id_abrigo`, `Username`, `Nome`, `Descricao`, 
`Telefone`, `Cnpj`, `Estado`, `Rua`, `Cidade`, `Bairro`, `Numero`, `Cep`, `Email`, 
`Senha`, `Picture`, `Online`, `Token`, `Secure`, `Creation`, `Tipo`) 
VALUES ('1', 'admin', 'Admin', 'superuser', '12 34567-8123', '1234567812345678', 'SP', 
'Rua Luiz Catharin', 'Birig&uuml;i', 'Residencial S&atilde;o Jos&eacute', '595', '16201235', 
'admin@gmail.com', '$2y$10$MYZDSMZqmBKHpGuD.SMMgu6l/qH2WKOwBNYrYaafcoVqaLdmglPra', 'user.jpg', 
'2023-11-27 17:42:48.000000', '39c3de6e93b44af3de11dc505174334c34701c3e', '3508011679', 
'2023-11-27 17:42:48.000000', '1');

INSERT INTO `user` (`Id`, `Username`, `Email`, `Password`, `Nome`, `Dtnasc`, 
`Telefone`, `Cpf`, `Cep`, `Rua`, `Numero`, `Bairro`, `Cidade`, `Picture`, `Online`, 
`Token`, `Secure`, `Creation`, `Porte`, `Especie`, `Sexo`, `Pelagem`, `Tipo`) 
VALUES ('1', 'admin', 'admin_user@gmail.com', '$2y$10$MYZDSMZqmBKHpGuD.SMMgu6l/qH2WKOwBNYrYaafcoVqaLdmglPra', 
'admin', '', '12 34567-8123', '12345678912', '16201235', 'Rua Luiz Catharin', '595', 'Residencial S&atilde;o Jos&eacute;', 
'Birig&uuml;i', 'user.jpg', '2023-11-27 17:49:16.000000', 
'e71704763742cb5560ed5c598584a3b73bc8ccaa', '2547483576', '2023-11-27 17:49:16.000000', 
'Não tenho preferência', 'Não tenho preferência', 'Não tenho preferência', 
'Não tenho preferência', '1');