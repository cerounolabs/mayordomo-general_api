CREATE TABLE `ANINAC` (
    `ANINACCOD` int(9) NOT NULL COMMENT 'CÓDIGO',
    `ANINACESC` int(9) NOT NULL COMMENT 'ESTABLECIMIENTO',
    `ANINACPEC` int(9) NOT NULL COMMENT 'PERSONA',
    `ANINACANC` int(9) NOT NULL COMMENT 'ANIMAL',
    `ANINACOBS` varchar(5120) COLLATE utf8_spanish_ci NULL COMMENT 'OBSERVACIÓN',
    `ANINACAEM` int(9) NOT NULL COMMENT 'AUDITORÍA EMPRESA',
    `ANINACAUS` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'AUDITORÍA USUARIO',
    `ANINACAFH` datetime NOT NULL COMMENT 'AUDITORÍA FECHA HORA',
    `ANINACAIP` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'AUDITORÍA IP'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='ANIMAL NACIMIENTO';

CREATE TABLE `ANINACA` (
    `ANINACACOD` int(11) NOT NULL COMMENT 'CÓDIGO',
    `ANINACAMET` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'MÉTODO',
    `ANINACAEMP` int(9) NOT NULL COMMENT 'EMPRESA',
    `ANINACAUSU` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'USUARIO',
    `ANINACAFEC` datetime NOT NULL COMMENT 'FECHA HORA',
    `ANINACADIP` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'IP',

    `ANINACACODOLD` int(9) NULL COMMENT 'CÓDIGO OLD',
    `ANINACAESCOLD` int(9) NULL COMMENT 'ESTABLECIMIENTO OLD',
    `ANINACAPECOLD` int(9) NULL COMMENT 'PERSONA OLD',
    `ANINACAANCOLD` int(9) NULL COMMENT 'ANIMAL OLD',
    `ANINACAOBSOLD` varchar(5120) COLLATE utf8_spanish_ci NULL COMMENT 'OBSERVACIÓN OLD',

    `ANINACACODNEW` int(9) NULL COMMENT 'CÓDIGO NEW',
    `ANINACAESCNEW` int(9) NULL COMMENT 'ESTABLECIMIENTO NEW',
    `ANINACAPECNEW` int(9) NULL COMMENT 'PERSONA NEW',
    `ANINACAANCNEW` int(9) NULL COMMENT 'ANIMAL NEW',
    `ANINACAOBSNEW` varchar(5120) COLLATE utf8_spanish_ci NULL COMMENT 'OBSERVACIÓN NEW'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='ANIMAL NACIMIENTO AUDITORÍA';

ALTER TABLE `ANINAC` ADD PRIMARY KEY (`ANINACCOD`);
ALTER TABLE `ANINAC` MODIFY `ANINACCOD` int(9) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO', AUTO_INCREMENT=0;

ALTER TABLE `ANINAC` ADD KEY `ANINACESC` (`ANINACESC`);
ALTER TABLE `ANINAC` ADD CONSTRAINT `FK_ANINACESC` FOREIGN KEY (`ANINACESC`) REFERENCES `mayordomo_default`.`ESTFIC` (`ESTFICCOD`);

ALTER TABLE `ANINAC` ADD KEY `ANINACPEC` (`ANINACPEC`);
ALTER TABLE `ANINAC` ADD CONSTRAINT `FK_ANINACPEC` FOREIGN KEY (`ANINACPEC`) REFERENCES `mayordomo_establecimiento`.`ESTPER` (`ESTPERCOD`);

ALTER TABLE `ANINAC` ADD KEY `ANINACANC` (`ANINACANC`);
ALTER TABLE `ANINAC` ADD CONSTRAINT `FK_ANINACANC` FOREIGN KEY (`ANINACANC`) REFERENCES `mayordomo_establecimiento`.`ANIFIC` (`ANIFICCOD`);

ALTER TABLE `ANINACA` ADD PRIMARY KEY (`ANINACACOD`);
ALTER TABLE `ANINACA` MODIFY `ANINACACOD` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO', AUTO_INCREMENT=0;

CREATE TRIGGER `ANINACDLT` 
  BEFORE DELETE ON `ANINAC` 
  FOR EACH ROW 
    INSERT INTO `ANINACA` (`ANINACAMET`, `ANINACAEMP`, `ANINACAUSU`, `ANINACAFEC`, `ANINACADIP`, `ANINACACODOLD`, `ANINACAESCOLD`, `ANINACAPECOLD`, `ANINACAANCOLD`, `ANINACAOBSOLD`)
    VALUES ('DELETE', OLD.`ANINACAEM`, OLD.`ANINACAUS`, NOW(), OLD.`ANINACAIP`, OLD.`ANINACCOD`, OLD.`ANINACESC`, OLD.`ANINACPEC`, OLD.`ANINACANC`, OLD.`ANINACOBS`);

CREATE TRIGGER `ANINACINS` 
  AFTER INSERT ON `ANINAC` 
  FOR EACH ROW 
    INSERT INTO `ANINACA` (`ANINACAMET`, `ANINACAEMP`, `ANINACAUSU`, `ANINACAFEC`, `ANINACADIP`, `ANINACACODNEW`, `ANINACAESCNEW`, `ANINACAPECNEW`, `ANINACAANCNEW`, `ANINACAOBSNEW`)
    VALUES ('INSERT', NEW.`ANINACAEM`, NEW.`ANINACAUS`, NOW(), NEW.`ANINACAIP`, NEW.`ANINACCOD`, NEW.`ANINACESC`, NEW.`ANINACPEC`, NEW.`ANINACANC`, NEW.`ANINACOBS`);

CREATE TRIGGER `ANINACUPD` 
  AFTER UPDATE ON `ANINAC` 
  FOR EACH ROW 
    INSERT INTO `ANINACA` (`ANINACAMET`, `ANINACAEMP`, `ANINACAUSU`, `ANINACAFEC`, `ANINACADIP`, `ANINACACODOLD`, `ANINACAESCOLD`, `ANINACAPECOLD`, `ANINACAANCOLD`, `ANINACAOBSOLD`, `ANINACACODNEW`, `ANINACAESCNEW`, `ANINACAPECNEW`, `ANINACAANCNEW`, `ANINACAOBSNEW`)
    VALUES ('UPDATE', NEW.`ANINACAEM`, NEW.`ANINACAUS`, NOW(), NEW.`ANINACAIP`, OLD.`ANINACCOD`, OLD.`ANINACESC`, OLD.`ANINACPEC`, OLD.`ANINACANC`, OLD.`ANINACOBS`, NEW.`ANINACCOD`, NEW.`ANINACESC`, NEW.`ANINACPEC`, NEW.`ANINACANC`, NEW.`ANINACOBS`);