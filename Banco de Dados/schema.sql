CREATE TABLE usuarios (
	cpf VARCHAR(15) NOT NULL PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    sobrenome VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL,
    fk_nivel CHAR NOT NULL
);

CREATE TABLE nivelusuarios(
    nivel CHAR NOT NULL PRIMARY KEY,
    tipo VARCHAR(50) NOT NULL
);

CREATE TABLE produtos (
 	codigo INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
    quantidade FLOAT NOT NULL,
    preco_custo FLOAT NOT NULL,
    preco_venda FLOAT NOT NULL,
    tipo_produto CHAR NOT NULL
);

CREATE TABLE tipoproduto (
	codigo CHAR NOT NULL PRIMARY KEY,
	descricao VARCHAR(20) NOT NULL
);

CREATE TABLE composicao(
	codigo_produto INT NOT NULL,
	codigo_composicao INT NOT NULL,
	quantidade_componente FLOAT NOT NULL
);

CREATE TABLE ordemproducao(
	codigo INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	descricao VARCHAR(500) NOT NULL,
	data_emissao DATE NOT NULL,
	data_finalizacao DATE NOT NULL,
	status CHAR NOT NULL
);

CREATE TABLE itensordemproducao(
	codigo INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	numero_ordem INT NOT NULL,
	codigo_item INT NOT NULL,
	quantidade_produzida FLOAT NOT NULL,
	custo_unitario FLOAT NOT NULL,
	custo_total FLOAT NOT NULL
);

CREATE TABLE status_ordem(
    codigo CHAR NOT NULL PRIMARY KEY,
    status varchar(15) NOT NULL
);

ALTER TABLE usuarios 
ADD CONSTRAINT fk_nivel
FOREIGN KEY(fk_nivel)REFERENCES nivelusuarios(nivel);

ALTER TABLE produtos 
ADD CONSTRAINT produtos_tipo_fk
FOREIGN KEY (tipo_produto) REFERENCES tipoproduto(codigo);

ALTER TABLE composicao 
ADD CONSTRAINT codigo_produto_fk
FOREIGN KEY (codigo_produto) REFERENCES produtos(codigo);

ALTER TABLE composicao 
ADD CONSTRAINT codigo_composicao_fk
FOREIGN KEY (codigo_composicao) REFERENCES produtos(codigo);

ALTER TABLE itensordemproducao
ADD CONSTRAINT codigo_ordem_fk
FOREIGN KEY (numero_ordem) REFERENCES ordemproducao(codigo);

ALTER TABLE itensordemproducao 
ADD CONSTRAINT codigo_item_fk
FOREIGN KEY (codigo_item) REFERENCES produtos(codigo);

ALTER TABLE ordemproducao
ADD CONSTRAINT status_fk
FOREIGN KEY (status) REFERENCES status_ordem(codigo);

INSERT INTO nivelusuarios (nivel, tipo) VALUES (1,'Administrador');
INSERT INTO nivelusuarios (nivel, tipo) VALUES (2,'Gerente');
INSERT INTO nivelusuarios (nivel, tipo) VALUES (3,'Funcionário');

INSERT INTO tipoproduto (codigo, descricao) VALUES (1, 'Composição');
INSERT INTO tipoproduto (codigo, descricao) VALUES (2, 'Componente');

INSERT INTO status_ordem (codigo, status) VALUES (1, 'Pendente');
INSERT INTO status_ordem (codigo, status) VALUES (2, 'Finalizado');