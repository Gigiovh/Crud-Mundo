CREATE DATABASE  bd_mundo;
USE bd_mundo;

CREATE TABLE tb_pais(
id_pais INT AUTO_INCREMENT PRIMARY  KEY,
nome VARCHAR(120) NOT NULL,
continente VARCHAR(160) NOT NULL,
populacao FLOAT NOT NULL,
idioma VARCHAR(60) NOT NULL
);

CREATE TABLE tb_cidade(
id_cidade INT AUTO_INCREMENT PRIMARY  KEY,
nome VARCHAR(120) NOT NULL,
populacao FLOAT NOT NULL,
id_pais INT NOT NULL,
FOREIGN KEY (id_pais) REFERENCES tb_pais (id_pais)
);

ALTER TABLE tb_pais
MODIFY populacao INT NOT NULL;

ALTER TABLE tb_cidade
MODIFY populacao INT NOT NULL;

INSERT INTO tb_pais (nome, continente, populacao, idioma)
VALUES 
('Brasil', 'América do Sul', 203100000, 'Português'),
('Estados Unidos', 'América do Norte', 331900000, 'Inglês'),
('Japão', 'Ásia', 125700000, 'Japonês'),
('Alemanha', 'Europa', 83200000, 'Alemão'),
('Nigéria', 'África', 223800000, 'Inglês');

INSERT INTO tb_cidade (nome, populacao, id_pais)
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
UPDATE tb_pais SET idioma="Inglês" Where idioma="Britânico"  ;

DELETE FROM tb_cidade WHERE id_pais=5;
DELETE FROM tb_pais WHERE id_pais=5;

SELECT * FROM tb_cidade;
SELECT * FROM tb_pais;




