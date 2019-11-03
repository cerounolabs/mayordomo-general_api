CREATE TABLE `ESTPER` (
    `ESTPERCOD` int(9) NOT NULL COMMENT 'CÓDIGO',
    `ESTPERECC` int(9) NOT NULL COMMENT 'ESTADO',
    `ESTPERTUC` int(9) NOT NULL COMMENT 'TIPO USUARIO',
    `ESTPERTPC` int(9) NOT NULL COMMENT 'TIPO PERSONA',
    `ESTPERPDC` int(9) NOT NULL COMMENT 'TIPO DOCUMENTO',
    `ESTPERESC` int(9) NOT NULL COMMENT 'ESTABLECIMIENTO',
    `ESTPERPER` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'PERSONA',
    `ESTPERDOC` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'DOCUMENTO',
    `ESTPERCST` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'CODIGO SITRAP',
    `ESTPERCSG` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'CODIGO SIGOR',
    `ESTPERTEL` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'TELEFONO',
    `ESTPERMAI` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'EMAIL',
    `ESTPEROBS` varchar(5120) COLLATE utf8_spanish_ci NULL COMMENT 'OBSERVACIÓN',
    `ESTPERAEM` int(9) NOT NULL COMMENT 'AUDITORÍA EMPRESA',
    `ESTPERAUS` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'AUDITORÍA USUARIO',
    `ESTPERAFH` datetime NOT NULL COMMENT 'AUDITORÍA FECHA HORA',
    `ESTPERAIP` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'AUDITORÍA IP'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='ESTABLECIMIENTO PERSONA';

CREATE TABLE `ESTPERA` (
    `ESTPERACOD` int(11) NOT NULL COMMENT 'CÓDIGO',
    `ESTPERAMET` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'MÉTODO',
    `ESTPERAEMP` int(9) NOT NULL COMMENT 'EMPRESA',
    `ESTPERAUSU` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'USUARIO',
    `ESTPERAFEC` datetime NOT NULL COMMENT 'FECHA HORA',
    `ESTPERADIP` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'IP',

    `ESTPERACODOLD` int(9) NULL COMMENT 'CÓDIGO OLD',
    `ESTPERAECCOLD` int(9) NULL COMMENT 'ESTADO OLD',
    `ESTPERATUCOLD` int(9) NULL COMMENT 'TIPO USUARIO OLD',
    `ESTPERATPCOLD` int(9) NULL COMMENT 'TIPO PERSONA OLD',
    `ESTPERAPDCOLD` int(9) NULL COMMENT 'TIPO DOCUMENTO OLD',
    `ESTPERAESCOLD` int(9) NULL COMMENT 'ESTABLECIMIENTO OLD',
    `ESTPERAPEROLD` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'PERSONA OLD',
    `ESTPERADOCOLD` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'DOCUMENTO OLD',
    `ESTPERACSTOLD` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'CODIGO SITRAP OLD',
    `ESTPERACSGOLD` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'CODIGO SIGOR OLD',
    `ESTPERATELOLD` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'TELEFONO OLD',
    `ESTPERAMAIOLD` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'EMAIL OLD',
    `ESTPERAOBSOLD` varchar(5120) COLLATE utf8_spanish_ci NULL COMMENT 'OBSERVACIÓN OLD',

    `ESTPERACODNEW` int(9) NULL COMMENT 'CÓDIGO NEW',
    `ESTPERAECCNEW` int(9) NULL COMMENT 'ESTADO NEW',
    `ESTPERATUCNEW` int(9) NULL COMMENT 'TIPO USUARIO NEW',
    `ESTPERATPCNEW` int(9) NULL COMMENT 'TIPO PERSONA NEW',
    `ESTPERAPDCNEW` int(9) NULL COMMENT 'TIPO DOCUMENTO NEW',
    `ESTPERAESCNEW` int(9) NULL COMMENT 'ESTABLECIMIENTO NEW',
    `ESTPERAPERNEW` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'PERSONA NEW',
    `ESTPERADOCNEW` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'DOCUMENTO NEW',
    `ESTPERACSTNEW` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'CODIGO SITRAP NEW',
    `ESTPERACSGNEW` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'CODIGO SIGOR NEW',
    `ESTPERATELNEW` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'TELEFONO NEW',
    `ESTPERAMAINEW` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'EMAIL NEW',
    `ESTPERAOBSNEW` varchar(5120) COLLATE utf8_spanish_ci NULL COMMENT 'OBSERVACIÓN NEW'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='ESTABLECIMIENTO PERSONA AUDITORÍA';

ALTER TABLE `ESTPER` ADD PRIMARY KEY (`ESTPERCOD`);
ALTER TABLE `ESTPER` MODIFY `ESTPERCOD` int(9) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO', AUTO_INCREMENT=0;

ALTER TABLE `ESTPER` ADD KEY `ESTPERECC` (`ESTPERECC`);
ALTER TABLE `ESTPER` ADD KEY `ESTPERTUC` (`ESTPERTUC`);
ALTER TABLE `ESTPER` ADD KEY `ESTPERTPC` (`ESTPERTPC`);
ALTER TABLE `ESTPER` ADD KEY `ESTPERPDC` (`ESTPERPDC`);
ALTER TABLE `ESTPER` ADD KEY `ESTPERESC` (`ESTPERESC`);

ALTER TABLE `ESTPER` ADD CONSTRAINT `FK_ESTPERECC` FOREIGN KEY (`ESTPERECC`) REFERENCES `mayordomo_default`.`DOMFIC` (`DOMFICCOD`);
ALTER TABLE `ESTPER` ADD CONSTRAINT `FK_ESTPERTUC` FOREIGN KEY (`ESTPERTUC`) REFERENCES `mayordomo_default`.`DOMFIC` (`DOMFICCOD`);
ALTER TABLE `ESTPER` ADD CONSTRAINT `FK_ESTPERTPC` FOREIGN KEY (`ESTPERTPC`) REFERENCES `mayordomo_default`.`DOMFIC` (`DOMFICCOD`);
ALTER TABLE `ESTPER` ADD CONSTRAINT `FK_ESTPERPDC` FOREIGN KEY (`ESTPERPDC`) REFERENCES `mayordomo_default`.`DOMFIC` (`DOMFICCOD`);
ALTER TABLE `ESTPER` ADD CONSTRAINT `FK_ESTPERESC` FOREIGN KEY (`ESTPERESC`) REFERENCES `mayordomo_default`.`ESTFIC` (`ESTFICCOD`);

ALTER TABLE `ESTPERA` ADD PRIMARY KEY (`ESTPERACOD`);
ALTER TABLE `ESTPERA` MODIFY `ESTPERACOD` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO', AUTO_INCREMENT=0;

CREATE TRIGGER `ESTPERDLT` 
  BEFORE DELETE ON `ESTPER` 
  FOR EACH ROW 
    INSERT INTO `ESTPERA` (`ESTPERAMET`, `ESTPERAEMP`, `ESTPERAUSU`, `ESTPERAFEC`, `ESTPERADIP`, `ESTPERACODOLD`, `ESTPERAECCOLD`, `ESTPERATUCOLD`, `ESTPERATPCOLD`, `ESTPERAPDCOLD`, `ESTPERAESCOLD`, `ESTPERAPEROLD`, `ESTPERADOCOLD`, `ESTPERACSTOLD`, `ESTPERACSGOLD`, `ESTPERATELOLD`, `ESTPERAMAIOLD`, `ESTPERAOBSOLD`)
    VALUES ('DELETE', OLD.`ESTPERAEM`, OLD.`ESTPERAUS`, NOW(), OLD.`ESTPERAIP`, OLD.`ESTPERCOD`, OLD.`ESTPERECC`, OLD.`ESTPERTUC`, OLD.`ESTPERTPC`, OLD.`ESTPERPDC`, OLD.`ESTPERESC`, OLD.`ESTPERPER`, OLD.`ESTPERDOC`, OLD.`ESTPERCST`, OLD.`ESTPERCSG`, OLD.`ESTPERTEL`, OLD.`ESTPERMAI`, OLD.`ESTPEROBS`);

CREATE TRIGGER `ESTPERINS` 
  AFTER INSERT ON `ESTPER` 
  FOR EACH ROW 
    INSERT INTO `ESTPERA` (`ESTPERAMET`, `ESTPERAEMP`, `ESTPERAUSU`, `ESTPERAFEC`, `ESTPERADIP`, `ESTPERACODNEW`, `ESTPERAECCNEW`, `ESTPERATUCNEW`, `ESTPERATPCNEW`, `ESTPERAPDCNEW`, `ESTPERAESCNEW`, `ESTPERAPERNEW`, `ESTPERADOCNEW`, `ESTPERACSTNEW`, `ESTPERACSGNEW`, `ESTPERATELNEW`, `ESTPERAMAINEW`, `ESTPERAOBSNEW`)
    VALUES ('INSERT', NEW.`ESTPERAEM`, NEW.`ESTPERAUS`, NOW(), NEW.`ESTPERAIP`, NEW.`ESTPERCOD`, NEW.`ESTPERECC`, NEW.`ESTPERTUC`, NEW.`ESTPERTPC`, NEW.`ESTPERPDC`, NEW.`ESTPERESC`, NEW.`ESTPERPER`, NEW.`ESTPERDOC`, NEW.`ESTPERCST`, NEW.`ESTPERCSG`, NEW.`ESTPERTEL`, NEW.`ESTPERMAI`, NEW.`ESTPEROBS`);

CREATE TRIGGER `ESTPERUPD` 
  AFTER UPDATE ON `ESTPER` 
  FOR EACH ROW 
    INSERT INTO `ESTPERA` (`ESTPERAMET`, `ESTPERAEMP`, `ESTPERAUSU`, `ESTPERAFEC`, `ESTPERADIP`, `ESTPERACODOLD`, `ESTPERAECCOLD`, `ESTPERATUCOLD`, `ESTPERATPCOLD`, `ESTPERAPDCOLD`, `ESTPERAESCOLD`, `ESTPERAPEROLD`, `ESTPERADOCOLD`, `ESTPERACSTOLD`, `ESTPERACSGOLD`, `ESTPERATELOLD`, `ESTPERAMAIOLD`, `ESTPERAOBSOLD`, `ESTPERACODNEW`, `ESTPERAECCNEW`, `ESTPERATUCNEW`, `ESTPERATPCNEW`, `ESTPERAPDCNEW`, `ESTPERAESCNEW`, `ESTPERAPERNEW`, `ESTPERADOCNEW`, `ESTPERACSTNEW`, `ESTPERACSGNEW`, `ESTPERATELNEW`, `ESTPERAMAINEW`, `ESTPERAOBSNEW`)
    VALUES ('UPDATE', NEW.`ESTPERAEM`, NEW.`ESTPERAUS`, NOW(), NEW.`ESTPERAIP`, OLD.`ESTPERCOD`, OLD.`ESTPERECC`, OLD.`ESTPERTUC`, OLD.`ESTPERTPC`, OLD.`ESTPERPDC`, OLD.`ESTPERESC`, OLD.`ESTPERPER`, OLD.`ESTPERDOC`, OLD.`ESTPERCST`, OLD.`ESTPERCSG`, OLD.`ESTPERTEL`, OLD.`ESTPERMAI`, OLD.`ESTPEROBS`, NEW.`ESTPERCOD`, NEW.`ESTPERECC`, NEW.`ESTPERTUC`, NEW.`ESTPERTPC`, NEW.`ESTPERPDC`, NEW.`ESTPERESC`, NEW.`ESTPERPER`, NEW.`ESTPERDOC`, NEW.`ESTPERCST`, NEW.`ESTPERCSG`, NEW.`ESTPERTEL`, NEW.`ESTPERMAI`, NEW.`ESTPEROBS`);
