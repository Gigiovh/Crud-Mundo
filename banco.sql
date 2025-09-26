CREATE DATABASE  Crud_Mundo;
USE Crud_mundo;

CREATE TABLE tb_pais(
Id_pais INT AUTO_INCREMENT PRIMARY  KEY,
nome_oficial VARCHAR(120) NOT NULL,
continente VARCHAR(160) NOT NULL,
populacao FLOAT NOT NULL,
idioma_principal VARCHAR(60) NOT NULL
);

CREATE TABLE tb_cidade(
Id_cidade INT AUTO_INCREMENT PRIMARY  KEY,
nome VARCHAR(120) NOT NULL,
populacao FLOAT NOT NULL,
pais INT NOT NULL,
FOREIGN KEY (pais) REFERENCES tb_pais (Id_pais)
);

ALTER TABLE tb_pais
MODIFY populacao INT NOT NULL;

ALTER TABLE tb_cidade
MODIFY populacao INT NOT NULL;

INSERT INTO tb_pais (nome_oficial, continente, populacao, idioma_principal)
VALUES 
('Brasil', 'América do Sul', 203100000, 'Português'),
('Estados Unidos', 'América do Norte', 331900000, 'Inglês'),
('Japão', 'Ásia', 125700000, 'Japonês'),
('Alemanha', 'Europa', 83200000, 'Alemão'),
('Nigéria', 'África', 223800000, 'Inglês');

INSERT INTO tb_cidade (nome, populacao, pais)
VALUES
('São Paulo', 12300000, 1),
('Rio de Janeiro', 6700000, 1),
('Nova York', 8800000, 2),
('Los Angeles', 3900000, 2),
('Tóquio', 13900000, 3),
('Osaka', 2700000, 3),
('Berlim', 3600000, 4),
('Hamburgo', 1800000, 4),
('Laguinhos', 15300000, 5),
('Abuja', 3600000, 5);

UPDATE tb_cidade SET nome="Lagos" Where nome="Laguinhos"  ;
UPDATE tb_pais SET idioma_principal="Inglês" Where idioma_principal="Britânico"  ;

DELETE FROM tb_cidade WHERE pais=5;
DELETE FROM tb_pais WHERE Id_pais=5;

SELECT * FROM tb_cidade;
SELECT * FROM tb_pais;




