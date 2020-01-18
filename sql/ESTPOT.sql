CREATE TABLE `ESTPOT` (
    `ESTPOTCOD` int(9) NOT NULL COMMENT 'CÓDIGO',
    `ESTPOTECC` int(9) NOT NULL COMMENT 'ESTADO',
    `ESTPOTTPC` int(9) NOT NULL COMMENT 'TIPO PASTURA 1',
    `ESTPOTTAC` int(9) NOT NULL COMMENT 'TIPO PASTURA 2',
    `ESTPOTESC` int(9) NOT NULL COMMENT 'ESTABLECIMIENTO',
    `ESTPOTSEC` int(9) NOT NULL COMMENT 'ESTABLECIMIENTO SECCIÓN',
    `ESTPOTNOM` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'NOMBRE',
    `ESTPOTHEC` decimal(10, 2) NULL COMMENT 'HECTÁREA',
    `ESTPOTCAP` decimal(10, 2) NULL COMMENT 'CAPACIDAD REPRODUCTIVA',
    `ESTPOTOBS` varchar(5120) COLLATE utf8_spanish_ci NULL COMMENT 'OBSERVACIÓN',
    `ESTPOTAEM` int(9) NOT NULL COMMENT 'AUDITORÍA EMPRESA',
    `ESTPOTAUS` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'AUDITORÍA USUARIO',
    `ESTPOTAFH` datetime NOT NULL COMMENT 'AUDITORÍA FECHA HORA',
    `ESTPOTAIP` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'AUDITORÍA IP'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='ESTABLECIMIENTO POTRERO';

CREATE TABLE `ESTPOTA` (
    `ESTPOTACOD` int(11) NOT NULL COMMENT 'CÓDIGO',
    `ESTPOTAMET` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'MÉTODO',
    `ESTPOTAEMP` int(9) NOT NULL COMMENT 'EMPRESA',
    `ESTPOTAUSU` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'USUARIO',
    `ESTPOTAFEC` datetime NOT NULL COMMENT 'FECHA HORA',
    `ESTPOTADIP` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'IP',

    `ESTPOTACODOLD` int(9) NULL COMMENT 'CÓDIGO OLD',
    `ESTPOTAECCOLD` int(9) NULL COMMENT 'ESTADO OLD',
    `ESTPOTATPCOLD` int(9) NULL COMMENT 'TIPO PASTURA 1 OLD',
    `ESTPOTATACOLD` int(9) NULL COMMENT 'TIPO PASTURA 2 OLD',
    `ESTPOTAESCOLD` int(9) NULL COMMENT 'ESTABLECIMIENTO OLD',
    `ESTPOTASECOLD` int(9) NULL COMMENT 'ESTABLECIMIENTO SECCIÓN OLD',
    `ESTPOTANOMOLD` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'NOMBRE OLD',
    `ESTPOTAHECOLD` decimal(10, 2) NULL COMMENT 'HECTÁREA OLD',
    `ESTPOTACAPOLD` decimal(10, 2) NULL COMMENT 'CAPACIDAD REPRODUCTIVA OLD',
    `ESTPOTAOBSOLD` varchar(5120) COLLATE utf8_spanish_ci NULL COMMENT 'OBSERVACIÓN OLD',

    `ESTPOTACODNEW` int(9) NULL COMMENT 'CÓDIGO NEW',
    `ESTPOTAECCNEW` int(9) NULL COMMENT 'ESTADO NEW',
    `ESTPOTATPCNEW` int(9) NULL COMMENT 'TIPO PASTURA 1 NEW',
    `ESTPOTATACNEW` int(9) NULL COMMENT 'TIPO PASTURA 2 NEW',
    `ESTPOTAESCNEW` int(9) NULL COMMENT 'ESTABLECIMIENTO NEW',
    `ESTPOTASECNEW` int(9) NULL COMMENT 'ESTABLECIMIENTO SECCIÓN NEW',
    `ESTPOTANOMNEW` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'NOMBRE NEW',
    `ESTPOTAHECNEW` decimal(10, 2) NULL COMMENT 'HECTÁREA NEW',
    `ESTPOTACAPNEW` decimal(10, 2) NULL COMMENT 'HECTÁREA NEW',
    `ESTPOTAOBSNEW` varchar(5120) COLLATE utf8_spanish_ci NULL COMMENT 'OBSERVACIÓN NEW'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='ESTABLECIMIENTO POTRERO AUDITORÍA';

ALTER TABLE `ESTPOT` ADD PRIMARY KEY (`ESTPOTCOD`);
ALTER TABLE `ESTPOT` MODIFY `ESTPOTCOD` int(9) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO', AUTO_INCREMENT=0;

ALTER TABLE `ESTPOT` ADD KEY `ESTPOTECC` (`ESTPOTECC`);
ALTER TABLE `ESTPOT` ADD KEY `ESTPOTTPC` (`ESTPOTTPC`);
ALTER TABLE `ESTPOT` ADD KEY `ESTPOTTAC` (`ESTPOTTAC`);
ALTER TABLE `ESTPOT` ADD KEY `ESTPOTESC` (`ESTPOTESC`);
ALTER TABLE `ESTPOT` ADD KEY `ESTPOTSEC` (`ESTPOTSEC`);

ALTER TABLE `ESTPOT` ADD CONSTRAINT `FK_ESTPOTECC` FOREIGN KEY (`ESTPOTECC`) REFERENCES `mayordomo_default`.`DOMFIC` (`DOMFICCOD`);
ALTER TABLE `ESTPOT` ADD CONSTRAINT `FK_ESTPOTTPC` FOREIGN KEY (`ESTPOTTPC`) REFERENCES `mayordomo_default`.`DOMFIC` (`DOMFICCOD`);
ALTER TABLE `ESTPOT` ADD CONSTRAINT `FK_ESTPOTTAC` FOREIGN KEY (`ESTPOTTAC`) REFERENCES `mayordomo_default`.`DOMFIC` (`DOMFICCOD`);
ALTER TABLE `ESTPOT` ADD CONSTRAINT `FK_ESTPOTESC` FOREIGN KEY (`ESTPOTESC`) REFERENCES `mayordomo_default`.`ESTFIC` (`ESTFICCOD`);
ALTER TABLE `ESTPOT` ADD CONSTRAINT `FK_ESTPOTSEC` FOREIGN KEY (`ESTPOTSEC`) REFERENCES `mayordomo_default`.`ESTSEC` (`ESTSECCOD`);

ALTER TABLE `ESTPOTA` ADD PRIMARY KEY (`ESTPOTACOD`);
ALTER TABLE `ESTPOTA` MODIFY `ESTPOTACOD` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO', AUTO_INCREMENT=0;

CREATE TRIGGER `ESTPOTDLT` 
  BEFORE DELETE ON `ESTPOT` 
  FOR EACH ROW 
    INSERT INTO `ESTPOTA` (`ESTPOTAMET`, `ESTPOTAEMP`, `ESTPOTAUSU`, `ESTPOTAFEC`, `ESTPOTADIP`, `ESTPOTACODOLD`, `ESTPOTAECCOLD`, `ESTPOTATPCOLD`, `ESTPOTATACOLD`, `ESTPOTAESCOLD`, `ESTPOTASECOLD`, `ESTPOTANOMOLD`, `ESTPOTAHECOLD`, `ESTPOTACAPOLD`, `ESTPOTAOBSOLD`)
    VALUES ('DELETE', OLD.`ESTPOTAEM`, OLD.`ESTPOTAUS`, NOW(), OLD.`ESTPOTAIP`, OLD.`ESTPOTCOD`, OLD.`ESTPOTECC`, OLD.`ESTPOTTPC`, OLD.`ESTPOTTAC`, OLD.`ESTPOTESC`, OLD.`ESTPOTSEC`, OLD.`ESTPOTNOM`, OLD.`ESTPOTHEC`, OLD.`ESTPOTCAP`, OLD.`ESTPOTOBS`);

CREATE TRIGGER `ESTPOTINS` 
  AFTER INSERT ON `ESTPOT` 
  FOR EACH ROW 
    INSERT INTO `ESTPOTA` (`ESTPOTAMET`, `ESTPOTAEMP`, `ESTPOTAUSU`, `ESTPOTAFEC`, `ESTPOTADIP`, `ESTPOTACODNEW`, `ESTPOTAECCNEW`, `ESTPOTATPCNEW`, `ESTPOTATACNEW`, `ESTPOTAESCNEW`, `ESTPOTASECNEW`, `ESTPOTANOMNEW`, `ESTPOTAHECNEW`, `ESTPOTACAPNEW`, `ESTPOTAOBSNEW`)
    VALUES ('INSERT', NEW.`ESTPOTAEM`, NEW.`ESTPOTAUS`, NOW(), NEW.`ESTPOTAIP`, NEW.`ESTPOTCOD`, NEW.`ESTPOTECC`, NEW.`ESTPOTTPC`, NEW.`ESTPOTTAC`, NEW.`ESTPOTESC`, NEW.`ESTPOTSEC`, NEW.`ESTPOTNOM`, NEW.`ESTPOTHEC`, NEW.`ESTPOTCAP`, NEW.`ESTPOTOBS`);

CREATE TRIGGER `ESTPOTUPD` 
  AFTER UPDATE ON `ESTPOT` 
  FOR EACH ROW 
    INSERT INTO `ESTPOTA` (`ESTPOTAMET`, `ESTPOTAEMP`, `ESTPOTAUSU`, `ESTPOTAFEC`, `ESTPOTADIP`, `ESTPOTACODOLD`, `ESTPOTAECCOLD`, `ESTPOTATPCOLD`, `ESTPOTATACOLD`, `ESTPOTAESCOLD`, `ESTPOTASECOLD`, `ESTPOTANOMOLD`, `ESTPOTAHECOLD`, `ESTPOTACAPOLD`, `ESTPOTAOBSOLD`, `ESTPOTACODNEW`, `ESTPOTAECCNEW`, `ESTPOTATPCNEW`, `ESTPOTATACNEW`, `ESTPOTAESCNEW`, `ESTPOTASECNEW`, `ESTPOTANOMNEW`, `ESTPOTAHECNEW`, `ESTPOTACAPNEW`, `ESTPOTAOBSNEW`)
    VALUES ('UPDATE', NEW.`ESTPOTAEM`, NEW.`ESTPOTAUS`, NOW(), NEW.`ESTPOTAIP`, OLD.`ESTPOTCOD`, OLD.`ESTPOTECC`, OLD.`ESTPOTTPC`, OLD.`ESTPOTTAC`, OLD.`ESTPOTESC`, OLD.`ESTPOTSEC`, OLD.`ESTPOTNOM`, OLD.`ESTPOTHEC`, OLD.`ESTPOTCAP`, OLD.`ESTPOTOBS`, NEW.`ESTPOTCOD`, NEW.`ESTPOTECC`, NEW.`ESTPOTTPC`, NEW.`ESTPOTTAC`, NEW.`ESTPOTESC`, NEW.`ESTPOTSEC`, NEW.`ESTPOTNOM`, NEW.`ESTPOTHEC`, NEW.`ESTPOTCAP`, NEW.`ESTPOTOBS`);
