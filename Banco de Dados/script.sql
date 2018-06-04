ALTER TABLE `industria`.`itensordemproducao` CHANGE COLUMN `quantidade_produzida` `quantidade_prevista` FLOAT NOT NULL DEFAULT 0;

alter table itensordemproducao add quantidade_produzida float after quantidade_prevista

/*----- CASO TIVER O BANCO MAIS ANTIGO */
ALTER TABLE itensordemproducao
ADD CONSTRAINT codigo_ordem_fk
FOREIGN KEY (numero_ordem) REFERENCES ordemproducao(codigo)
ON DELETE CASCADE;

ALTER TABLE itensordemproducao DROP FOREIGN KEY codigo_ordem_fk;



ALTER TABLE itensordemproducao 
ADD CONSTRAINT codigo_item_fk
FOREIGN KEY (codigo_item) REFERENCES produtos(codigo)
ON DELETE CASCADE;

ALTER TABLE itensordemproducao DROP FOREIGN KEY codigo_item_fk;
/*-------------------*/