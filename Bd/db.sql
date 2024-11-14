-- Apagando a base de dados se existir
DROP DATABASE IF EXISTS hourly_bd;

-- Criando a base de dados
CREATE DATABASE hourly_bd;

-- Colocando em uso a base
USE hourly_bd;

-- Criando a tabela de usuários
CREATE TABLE usuarios(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nomeCompleto VARCHAR(200) NOT NULL,
    email VARCHAR(50) NOT NULL,
    senha VARCHAR(32) NOT NULL,
    dataCriacao TIMESTAMP DEFAULT NOW(),
    token VARCHAR(255) DEFAULT NULL,
    expiracao_token DATETIME,
    foto_perfil VARCHAR(255) DEFAULT 'uploads/default.png'
);

-- Criando a tabela de funcionários
CREATE TABLE funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    funcao VARCHAR(50) NOT NULL,
    foto_perfil VARCHAR(255) DEFAULT 'uploads/default.png',
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Criando a tabela de serviços
CREATE TABLE IF NOT EXISTS servicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    tempo_medio INT NOT NULL
);

-- Criando a tabela associativa de serviço e funcionário
CREATE TABLE IF NOT EXISTS servico_funcionario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    servico_id INT NOT NULL,
    funcionario_id INT NOT NULL,
    FOREIGN KEY (servico_id) REFERENCES servicos(id),
    FOREIGN KEY (funcionario_id) REFERENCES funcionarios(id)
);

-- Criando a tabela de barbearias
CREATE TABLE barbearias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cep VARCHAR(9) NOT NULL,
    numero VARCHAR(10),
    descricao TEXT
);

-- Criando a tabela de telefones da barbearia
CREATE TABLE telefones_barbearia (
    id INT AUTO_INCREMENT PRIMARY KEY,
    barbearia_id INT NOT NULL,
    telefone VARCHAR(15),
    FOREIGN KEY (barbearia_id) REFERENCES barbearias(id) ON DELETE CASCADE
);

-- Criando a tabela de dias de funcionamento
CREATE TABLE dias_funcionamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    barbearia_id INT NOT NULL,
    dia_semana ENUM('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado') NOT NULL,
    FOREIGN KEY (barbearia_id) REFERENCES barbearias(id) ON DELETE CASCADE
);

-- Criando a tabela de horários de funcionamento
CREATE TABLE horarios_funcionamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    barbearia_id INT NOT NULL,
    dia_semana ENUM('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado') NOT NULL,
    turno ENUM('Manhã', 'Tarde', 'Noite') NOT NULL,
    inicio TIME NOT NULL,
    termino TIME NOT NULL,
    FOREIGN KEY (barbearia_id) REFERENCES barbearias(id) ON DELETE CASCADE
);

ALTER TABLE servico_funcionario ADD COLUMN status ENUM('ativo', 'inativo') DEFAULT 'ativo';

-- Adicionando a coluna 'cargo' à tabela de usuários
ALTER TABLE usuarios ADD COLUMN cargo ENUM('cliente', 'funcionario', 'dono') NOT NULL DEFAULT 'cliente';

ALTER TABLE barbearias ADD COLUMN dono_id INT NOT NULL;

ALTER TABLE barbearias ADD CONSTRAINT fk_dono FOREIGN KEY (dono_id) REFERENCES usuarios(id);

ALTER TABLE barbearias 
ADD COLUMN codigo_barbearia VARCHAR(5) NOT NULL;





