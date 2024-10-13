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
	token VARCHAR(255) DEFAULT NULL,
	expiracao_token DATETIME
	);
	
CREATE TABLE funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,        -- Chave primária com incremento automático
    nome VARCHAR(100) NOT NULL,               -- Nome do funcionário
    email VARCHAR(100) NOT NULL UNIQUE,       -- E-mail do funcionário (único)
    funcao VARCHAR(50) NOT NULL,              -- Função ou cargo do funcionário
    foto_perfil VARCHAR(255) DEFAULT 'uploads/default.png', -- Caminho da foto de perfil, com valor padrão
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Data de cadastro
);
