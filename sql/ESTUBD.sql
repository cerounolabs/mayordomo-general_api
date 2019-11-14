CREATE TABLE `ESTUBD` (
    `ESTUBDCOD` int(9) NOT NULL COMMENT 'CÓDIGO',
    `ESTUBDECC` int(9) NOT NULL COMMENT 'ESTADO',
    `ESTUBDTSC` int(9) NOT NULL COMMENT 'TIPO SUBCATEGORIA',
    `ESTUBDUBC` int(9) NOT NULL COMMENT 'UBICACION',
    `ESTUBDCAN` int(10) NOT NULL COMMENT 'CANTIDAD',
    `ESTUBDOBS` varchar(5120) COLLATE utf8_spanish_ci NULL COMMENT 'OBSERVACIÓN',
    `ESTUBDAEM` int(9) NOT NULL COMMENT 'AUDITORÍA EMPRESA',
    `ESTUBDAUS` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'AUDITORÍA USUARIO',
    `ESTUBDAFH` datetime NOT NULL COMMENT 'AUDITORÍA FECHA HORA',
    `ESTUBDAIP` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'AUDITORÍA IP'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='ESTABLECIMIENTO UBICACIÓN DETALLE';

CREATE TABLE `ESTUBDA` (
    `ESTUBDACOD` int(11) NOT NULL COMMENT 'CÓDIGO',
    `ESTUBDAMET` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'MÉTODO',
    `ESTUBDAEMP` int(9) NOT NULL COMMENT 'EMPRESA',
    `ESTUBDAUSU` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'USUARIO',
    `ESTUBDAFEC` datetime NOT NULL COMMENT 'FECHA HORA',
    `ESTUBDADIP` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'IP',

    `ESTUBDCODOLD` int(9) NULL COMMENT 'CÓDIGO OLD',
    `ESTUBDECCOLD` int(9) NULL COMMENT 'ESTADO OLD',
    `ESTUBDTSCOLD` int(9) NULL COMMENT 'TIPO SUBCATEGORIA OLD',
    `ESTUBDUBCOLD` int(9) NULL COMMENT 'UBICACION OLD',
    `ESTUBDCANOLD` int(10) NULL COMMENT 'CANTIDAD OLD',
    `ESTUBDOBSOLD` varchar(5120) COLLATE utf8_spanish_ci NULL COMMENT 'OBSERVACIÓN OLD',

    `ESTUBDCODNEW` int(9) NULL COMMENT 'CÓDIGO NEW',
    `ESTUBDECCNEW` int(9) NULL COMMENT 'ESTADO NEW',
    `ESTUBDTSCNEW` int(9) NULL COMMENT 'TIPO SUBCATEGORIA NEW',
    `ESTUBDUBCNEW` int(9) NULL COMMENT 'UBICACION NEW',
    `ESTUBDCANNEW` int(10) NULL COMMENT 'CANTIDAD NEW',
    `ESTUBDOBSNEW` varchar(5120) COLLATE utf8_spanish_ci NULL COMMENT 'OBSERVACIÓN NEW'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='ESTABLECIMIENTO UBICACIÓN DETALLE AUDITORÍA';

ALTER TABLE `ESTUBD` ADD PRIMARY KEY (`ESTUBDCOD`);
ALTER TABLE `ESTUBD` MODIFY `ESTUBDCOD` int(9) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO', AUTO_INCREMENT=0;

ALTER TABLE `ESTUBD` ADD KEY `ESTUBDECC` (`ESTUBDECC`);
ALTER TABLE `ESTUBD` ADD CONSTRAINT `FK_ESTUBDECC` FOREIGN KEY (`ESTUBDECC`) REFERENCES `mayordomo_default`.`DOMFIC` (`DOMFICCOD`);

ALTER TABLE `ESTUBD` ADD KEY `ESTUBDTSC` (`ESTUBDTSC`);
ALTER TABLE `ESTUBD` ADD CONSTRAINT `FK_ESTUBDTSC` FOREIGN KEY (`ESTUBDTSC`) REFERENCES `mayordomo_default`.`DOMFIC` (`DOMFICCOD`);

ALTER TABLE `ESTUBD` ADD KEY `ESTUBDUBC` (`ESTUBDUBC`);
ALTER TABLE `ESTUBD` ADD CONSTRAINT `FK_ESTUBDUBC` FOREIGN KEY (`ESTUBDUBC`) REFERENCES `mayordomo_establecimiento`.`ESTUBC` (`ESTUBCCOD`);

ALTER TABLE `ESTUBDA` ADD PRIMARY KEY (`ESTUBDACOD`);
ALTER TABLE `ESTUBDA` MODIFY `ESTUBDACOD` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO', AUTO_INCREMENT=0;

CREATE TRIGGER `ESTUBDDLT` 
  BEFORE DELETE ON `ESTUBD` 
  FOR EACH ROW 
    INSERT INTO `ESTUBDA` (`ESTUBDAMET`, `ESTUBDAEMP`, `ESTUBDAUSU`, `ESTUBDAFEC`, `ESTUBDADIP`, `ESTUBDCODOLD`, `ESTUBDECCOLD`, `ESTUBDTSCOLD`, `ESTUBDUBCOLD`, `ESTUBDCANOLD`, `ESTUBDOBSOLD`)
    VALUES ('DELETE', OLD.`ESTUBDAEM`, OLD.`ESTUBDAUS`, NOW(), OLD.`ESTUBDAIP`, OLD.`ESTUBDCOD`, OLD.`ESTUBDECC`, OLD.`ESTUBDTSC`, OLD.`ESTUBDUBC`, OLD.`ESTUBDCAN`, OLD.`ESTUBDOBS`);

CREATE TRIGGER `ESTUBDINS` 
  AFTER INSERT ON `ESTUBD` 
  FOR EACH ROW 
    INSERT INTO `ESTUBDA` (`ESTUBDAMET`, `ESTUBDAEMP`, `ESTUBDAUSU`, `ESTUBDAFEC`, `ESTUBDADIP`, `ESTUBDCODNEW`, `ESTUBDECCNEW`, `ESTUBDTSCNEW`, `ESTUBDUBCNEW`, `ESTUBDCANNEW`, `ESTUBDOBSNEW`)
    VALUES ('INSERT', NEW.`ESTUBDAEM`, NEW.`ESTUBDAUS`, NOW(), NEW.`ESTUBDAIP`, NEW.`ESTUBDCOD`, NEW.`ESTUBDECC`, NEW.`ESTUBDTSC`, NEW.`ESTUBDUBC`, NEW.`ESTUBDCAN`, NEW.`ESTUBDOBS`);

CREATE TRIGGER `ESTUBDUPD` 
  AFTER UPDATE ON `ESTUBD` 
  FOR EACH ROW
    INSERT INTO `ESTUBDA` (`ESTUBDAMET`, `ESTUBDAEMP`, `ESTUBDAUSU`, `ESTUBDAFEC`, `ESTUBDADIP`, `ESTUBDCODOLD`, `ESTUBDECCOLD`, `ESTUBDTSCOLD`, `ESTUBDUBCOLD`, `ESTUBDCANOLD`, `ESTUBDOBSOLD`, `ESTUBDCODNEW`, `ESTUBDECCNEW`, `ESTUBDTSCNEW`, `ESTUBDUBCNEW`, `ESTUBDCANNEW`, `ESTUBDOBSNEW`)
    VALUES ('UPDATE', NEW.`ESTUBDAEM`, NEW.`ESTUBDAUS`, NOW(), NEW.`ESTUBDAIP`, OLD.`ESTUBDCOD`, OLD.`ESTUBDECC`, OLD.`ESTUBDTSC`, OLD.`ESTUBDUBC`, OLD.`ESTUBDCAN`, OLD.`ESTUBDOBS`, NEW.`ESTUBDCOD`, NEW.`ESTUBDECC`, NEW.`ESTUBDTSC`, NEW.`ESTUBDUBC`, NEW.`ESTUBDCAN`, NEW.`ESTUBDOBS`);