CREATE TABLE `ESTSEC` (
    `ESTSECCOD` int(9) NOT NULL COMMENT 'CÓDIGO',
    `ESTSECECC` int(9) NOT NULL COMMENT 'ESTADO',
    `ESTSECESC` int(9) NOT NULL COMMENT 'ESTABLECIMIENTO',
    `ESTSECNOM` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'NOMBRE',
    `ESTSECOBS` varchar(5120) COLLATE utf8_spanish_ci NULL COMMENT 'OBSERVACIÓN',
    `ESTSECAEM` int(9) NOT NULL COMMENT 'AUDITORÍA EMPRESA',
    `ESTSECAUS` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'AUDITORÍA USUARIO',
    `ESTSECAFH` datetime NOT NULL COMMENT 'AUDITORÍA FECHA HORA',
    `ESTSECAIP` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'AUDITORÍA IP'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='ESTABLECIMIENTO SECCION';


CREATE TABLE `ESTSECA` (
    `ESTSECACOD` int(11) NOT NULL COMMENT 'CÓDIGO',
    `ESTSECAMET` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'MÉTODO',
    `ESTSECAEMP` int(9) NOT NULL COMMENT 'EMPRESA',
    `ESTSECAUSU` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'USUARIO',
    `ESTSECAFEC` datetime NOT NULL COMMENT 'FECHA HORA',
    `ESTSECADIP` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'IP',

    `ESTSECACODOLD` int(9) NULL COMMENT 'CÓDIGO OLD',
    `ESTSECAECCOLD` int(9) NULL COMMENT 'ESTADO OLD',
    `ESTSECAESCOLD` int(9) NULL COMMENT 'ESTABLECIMIENTO OLD',
    `ESTSECANOMOLD` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'NOMBRE OLD',
    `ESTSECAOBSOLD` varchar(5120) COLLATE utf8_spanish_ci NULL COMMENT 'OBSERVACIÓN OLD',

    `ESTSECACODNEW` int(9) NULL COMMENT 'CÓDIGO NEW',
    `ESTSECAECCNEW` int(9) NULL COMMENT 'ESTADO NEW',
    `ESTSECAESCNEW` int(9) NULL COMMENT 'ESTABLECIMIENTO NEW',
    `ESTSECANOMNEW` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'NOMBRE NEW',
    `ESTSECAOBSNEW` varchar(5120) COLLATE utf8_spanish_ci NULL COMMENT 'OBSERVACIÓN NEW'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='ESTABLECIMIENTO SECCION AUDITORÍA';

ALTER TABLE `ESTSEC` ADD PRIMARY KEY (`ESTSECCOD`);
ALTER TABLE `ESTSEC` MODIFY `ESTSECCOD` int(9) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO', AUTO_INCREMENT=0;

ALTER TABLE `ESTSEC` ADD KEY `ESTSECECC` (`ESTSECECC`);
ALTER TABLE `ESTSEC` ADD KEY `ESTSECESC` (`ESTSECESC`);

ALTER TABLE `ESTSEC` ADD CONSTRAINT `FK_ESTSECECC` FOREIGN KEY (`ESTSECECC`) REFERENCES `mayordomo_default`.`DOMFIC` (`DOMFICCOD`);
ALTER TABLE `ESTSEC` ADD CONSTRAINT `FK_ESTSECESC` FOREIGN KEY (`ESTSECESC`) REFERENCES `mayordomo_default`.`ESTFIC` (`ESTFICCOD`);

ALTER TABLE `ESTSECA` ADD PRIMARY KEY (`ESTSECACOD`);
ALTER TABLE `ESTSECA` MODIFY `ESTSECACOD` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO', AUTO_INCREMENT=0;

CREATE TRIGGER `ESTSECDLT` 
  BEFORE DELETE ON `ESTSEC` 
  FOR EACH ROW 
    INSERT INTO `ESTSECA` (`ESTSECAMET`, `ESTSECAEMP`, `ESTSECAUSU`, `ESTSECAFEC`, `ESTSECADIP`, `ESTSECACODOLD`, `ESTSECAECCOLD`, `ESTSECAESCOLD`, `ESTSECANOMOLD`, `ESTSECAOBSOLD`)
    VALUES ('DELETE', OLD.`ESTSECAEM`, OLD.`ESTSECAUS`, NOW(), OLD.`ESTSECAIP`, OLD.`ESTSECCOD`, OLD.`ESTSECECC`, OLD.`ESTSECESC`, OLD.`ESTSECNOM`, OLD.`ESTSECOBS`);

CREATE TRIGGER `ESTSECINS` 
  AFTER INSERT ON `ESTSEC` 
  FOR EACH ROW 
    INSERT INTO `ESTSECA` (`ESTSECAMET`, `ESTSECAEMP`, `ESTSECAUSU`, `ESTSECAFEC`, `ESTSECADIP`, `ESTSECACODNEW`, `ESTSECAECCNEW`, `ESTSECAESCNEW`, `ESTSECANOMNEW`, `ESTSECAOBSNEW`)
    VALUES ('INSERT', NEW.`ESTSECAEM`, NEW.`ESTSECAUS`, NOW(), NEW.`ESTSECAIP`, NEW.`ESTSECCOD`, NEW.`ESTSECECC`, NEW.`ESTSECESC`, NEW.`ESTSECNOM`, NEW.`ESTSECOBS`);

CREATE TRIGGER `ESTSECUPD` 
  AFTER UPDATE ON `ESTSEC` 
  FOR EACH ROW 
    INSERT INTO `ESTSECA` (`ESTSECAMET`, `ESTSECAEMP`, `ESTSECAUSU`, `ESTSECAFEC`, `ESTSECADIP`, `ESTSECACODOLD`, `ESTSECAECCOLD`, `ESTSECAESCOLD`, `ESTSECANOMOLD`, `ESTSECAOBSOLD`, `ESTSECACODNEW`, `ESTSECAECCNEW`, `ESTSECAESCNEW`, `ESTSECANOMNEW`, `ESTSECAOBSNEW`)
    VALUES ('UPDATE', NEW.`ESTSECAEM`, NEW.`ESTSECAUS`, NOW(), NEW.`ESTSECAIP`, OLD.`ESTSECCOD`, OLD.`ESTSECECC`, OLD.`ESTSECESC`, OLD.`ESTSECNOM`, OLD.`ESTSECOBS`, NEW.`ESTSECCOD`, NEW.`ESTSECECC`, NEW.`ESTSECESC`, NEW.`ESTSECNOM`, NEW.`ESTSECOBS`);
