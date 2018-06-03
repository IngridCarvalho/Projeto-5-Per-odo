ALTER TABLE `industria`.`itensordemproducao` CHANGE COLUMN `quantidade_produzida` `quantidade_prevista` FLOAT NOT NULL DEFAULT 0;

alter table itensordemproducao add quantidade_produzida float after quantidade_prevista