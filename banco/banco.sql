drop database if exists banco;
create database banco;
use banco;

/*CREATE TABLE usuario      ////acho que vou tirar essa tabela(pretendo fazer um cadastro para cada tipo)
( 
 id_usuario INT PRIMARY KEY AUTO_INCREMENT,  
 senha VARCHAR(60),  
 nome_usuario VARCHAR(100),  
 rua VARCHAR(60),  
 bairro VARCHAR(60),  
 cidade VARCHAR(60),  
 estado VARCHAR(60),  
 numero INT,  
 cep INT  
); */

CREATE TABLE mensagem 
( 
 id_mensagem INT PRIMARY KEY AUTO_INCREMENT,  
 visualização INT,  
 hora INT  
); 

CREATE TABLE pessoa 
( 
 cpf INT,  
 data_nacimento DATE,  
 id_pessoa INT PRIMARY KEY AUTO_INCREMENT,  
 nome VARCHAR(100),  
 FK_id_usuario INT
); 

CREATE TABLE Usuario_abrigo 
( 
 Id_abrigo INT PRIMARY KEY AUTO_INCREMENT,  
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
 raca VARCHAR(50),  
 carterinha VARCHAR(50),  
 porte VARCHAR(50),  
 cor VARCHAR(50),  
 especie VARCHAR(50),  
 idade INT,  
 nome VARCHAR(50),  
 id_animal INT PRIMARY KEY AUTO_INCREMENT,  
 descricao VARCHAR(500),  
 FK_id_abrigo INT  
); 

CREATE TABLE personalidade 
( 
 id_personalidade INT PRIMARY KEY AUTO_INCREMENT,  
 caracteristica VARCHAR(60) 
); 

CREATE TABLE personalidade_Pessoa 
( 
 fk_id_pessoa INT,  
 fk_id_personalidade INT 
); 

CREATE TABLE personalidade_animal 
( 
 fk_id_animal INT,  
 fk_id_personalidade INT 
); 

CREATE TABLE usuario_mensagem 
( 
 fk_id_usuario INT,  
 fk_id_mensagem INT 
); 

CREATE TABLE animal_mensagem 
( 
 fk_id_animal INT,  
 fk_id_mensagem INT 
); 

ALTER TABLE pessoa ADD FOREIGN KEY(FK_id_usuario) REFERENCES usuario (id_usuario);
ALTER TABLE abrigo ADD FOREIGN KEY(FK_id_usuario) REFERENCES usuario (id_usuario);
ALTER TABLE animal ADD FOREIGN KEY(FK_id_abrigo) REFERENCES abrigo (id_abrigo);
ALTER TABLE personalidade_Pessoa ADD FOREIGN KEY(fk_id_pessoa) REFERENCES pessoa (id_pessoa);
ALTER TABLE personalidade_Pessoa ADD FOREIGN KEY(fk_id_personalidade) REFERENCES personalidade (id_personalidade);
ALTER TABLE personalidade_animal ADD FOREIGN KEY(fk_id_animal) REFERENCES animal (id_animal);
ALTER TABLE personalidade_animal ADD FOREIGN KEY(fk_id_personalidade) REFERENCES personalidade (id_personalidade);
ALTER TABLE usuario_mensagem ADD FOREIGN KEY(fk_id_usuario) REFERENCES usuario (id_usuario);
ALTER TABLE usuario_mensagem ADD FOREIGN KEY(fk_id_mensagem) REFERENCES mensagem (id_mensagem);
ALTER TABLE animal_mensagem ADD FOREIGN KEY(fk_id_animal) REFERENCES animal (id_animal);
ALTER TABLE animal_mensagem ADD FOREIGN KEY(fk_id_mensagem) REFERENCES mensagem (id_mensagem);
/*
CREATE TABLE Usuario_abrigo  
( 
 Id INT PRIMARY KEY AUTO_INCREMENT,  
 Nome VARCHAR(50) NOT Null,
 Descricao VARCHAR(500),
 Telefone int not Null,
Cnpj VARCHAR(12),
Estado VARCHAR(20),
Rua VARCHAR(50),
Cidade VARCHAR(50),
Bairro VARCHAR(50),
Numero VARCHAR(10),
Cep VARCHAR(20),
Email VARCHAR(100),
Senha VARCHAR(30),
Token varchar(100),
Secure bigint(11),
Picture varchar(1000)
Creation datetime		
); */