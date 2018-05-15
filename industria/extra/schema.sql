CREATE TABLE usuarios (
cpf VARCHAR(15) NOT NULL PRIMARY KEY,
nome VARCHAR(200) NOT NULL,
sobrenome VARCHAR(100) NOT NULL,
senha VARCHAR(100) NOT NULL,
fk_nivel CHARACTER NOT NULL);

CREATE TABLE nivelusuarios(
    nivel CHARACTER NOT NULL PRIMARY KEY,
    tipo VARCHAR(50) NOT NULL
);

ALTER TABLE usuarios 
ADD CONSTRAINT fk_nivel
FOREIGN KEY(fk_nivel)REFERENCES nivelusuarios(nivel);

INSERT INTO nivelusuarios (nivel, tipo) VALUES (1,'Administrador');
INSERT INTO nivelusuarios (nivel, tipo) VALUES (2,'Gerente');
INSERT INTO nivelusuarios (nivel, tipo) VALUES (3,'Funcionário');