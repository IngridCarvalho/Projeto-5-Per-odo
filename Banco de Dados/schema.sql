CREATE TABLE usuarios (
	id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    cpf VARCHAR(15) NOT NULL,
    nome VARCHAR(200) NOT NULL,
    sobrenome VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL,
    fk_nivel CHARACTER NOT NULL
);

CREATE TABLE nivelusuarios(
    nivel CHARACTER NOT NULL PRIMARY KEY,
    tipo VARCHAR(50) NOT NULL
);

CREATE TABLE produtos (
 	id INT AUTO_INCREMENT NOT NULL,
	codigo INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    quantidade FLOAT NOT NULL,
    preco_custo FLOAT NOT NULL,
    preco_venda FLOAT NOT NULL,
    tipo_produto INT NOT NULL,
	PRIMARY KEY(id,codigo)
);

ALTER TABLE produtos ADD INDEX(codigo);

CREATE TABLE Tipoproduto (
	codigo INT NOT NULL PRIMARY KEY,
	descricao VARCHAR(20) NOT NULL
);

CREATE TABLE composicao(
	id INT AUTO_INCREMENT NOT NULL,
	codigo_produto INT NOT NULL,
	/*codigo_componente INT NOT NULL*/
	quantidade_componente FLOAT NOT NULL,
	PRIMARY KEY(id,codigo)
);

CREATE TABLE ordemproducao(
	id INT AUTO_INCREMENT NOT NULL,
	numero INT NOT NULL,
	descricao VARCHAR(500) NOT NULL,
	data_emissao DATE NOT NULL,
	data_finalizacao DATE NOT NULL,
	status int NOT NULL,
	PRIMARY KEY(id,numero)
);

ALTER TABLE ordemproducao ADD INDEX(numero);

CREATE TABLE itensordemproducao(
	id INT AUTO_INCREMENT NOT NULL,
	codigo INT NOT NULL,
	numero_ordem INT NOT NULL,
	codigo_item INT NOT NULL,
	quantidade_produzida FLOAT NOT NULL,
	custo_unitario FLOAT NOT NULL,
	custo_total FLOAT NOT NULL,
	PRIMARY KEY(id,codigo)
);

CREATE TABLE status_ordem(
    id int NOT NULL PRIMARY KEY,
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

ALTER TABLE itensordemproducao
ADD CONSTRAINT numero_ordem_fk
FOREIGN KEY (numero_ordem) REFERENCES ordemproducao(numero);

ALTER TABLE itensordemproducao 
ADD CONSTRAINT codigo_item_fk
FOREIGN KEY (codigo_item) REFERENCES produtos(codigo);

ALTER TABLE ordemproducao
ADD CONSTRAINT status_fk
FOREIGN KEY (status) REFERENCES status_ordem(id);

INSERT INTO nivelusuarios (nivel, tipo) VALUES (1,'Administrador');
INSERT INTO nivelusuarios (nivel, tipo) VALUES (2,'Gerente');
INSERT INTO nivelusuarios (nivel, tipo) VALUES (3,'Funcionário');

INSERT INTO tipoproduto (codigo, descricao) VALUES (1, 'Composição');
INSERT INTO tipoproduto (codigo, descricao) VALUES (2, 'Componente');

INSERT INTO status_ordem (id, status) VALUES (1, 'Pendente');
INSERT INTO status_ordem (id, status) VALUES (2, 'Finalizado');