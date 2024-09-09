-- apagando se existir a base de dados
DROP DATABASE hourly_bd;

-- criando a base de dados
CREATE DATABASE hourly_bd;

-- colocando em uso a base
USE hourly_bd;

-- criando a tabela de usuarios
CREATE TABLE usuarios(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nomeCompleto VARCHAR(200) NOT NULL,
	email VARCHAR(50) NOT NULL,
	senha VARCHAR(32) NOT NULL,
	dataCriacao TIMESTAMP DEFAULT NOW(),
	token VARCHAR(255) DEFAULT NULL
	);