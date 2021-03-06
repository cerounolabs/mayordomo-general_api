CREATE TABLE `PERFIC` (
  `PERFICCOD` int(9) NOT NULL COMMENT 'CÓDIGO',
  `PERFICECC` int(9) NOT NULL COMMENT 'ESTADO',
  `PERFICTPC` int(9) NOT NULL COMMENT 'TIPO PERSONA',
  `PERFICTDC` int(9) NOT NULL COMMENT 'TIPO DOCUMENTO',
  `PERFICNOM` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'NOMBRE',
  `PERFICDOC` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'DOCUMENTO',
  `PERFICCST` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'CODIGO SITRAP',
  `PERFICCSG` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'CODIGO SIGOR',
  `PERFICTEL` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'TELEFONO',
  `PERFICMAI` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'EMAIL',
  `PERFICOBS` varchar(5120) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'OBSERVACIÓN',
  `PERFICAEM` int(9) NOT NULL COMMENT 'AUDITORÍA EMPRESA',
  `PERFICAUS` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'AUDITORÍA USUARIO',
  `PERFICAFH` datetime NOT NULL COMMENT 'AUDITORÍA FECHA HORA',
  `PERFICAIP` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'AUDITORÍA IP'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='PERSONA';

CREATE TABLE `PERFICA` (
  `PERFICACOD` int(11) NOT NULL COMMENT 'CÓDIGO',
  `PERFICAMET` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'MÉTODO',
  `PERFICAEMP` int(9) NOT NULL COMMENT 'EMPRESA',
  `PERFICAUSU` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'USUARIO',
  `PERFICAFEC` datetime NOT NULL COMMENT 'FECHA HORA',
  `PERFICADIP` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'IP',
  `PERFICACODOLD` int(9) NULL COMMENT 'CÓDIGO OLD',
  `PERFICAECCOLD` int(9) NULL COMMENT 'ESTADO OLD',
  `PERFICATPCOLD` int(9) NULL COMMENT 'TIPO PERSONA OLD',
  `PERFICATDCOLD` int(9) NULL COMMENT 'TIPO DOCUMENTO OLD',
  `PERFICANOMOLD` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'NOMBRE OLD',
  `PERFICADOCOLD` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'DOCUMENTO OLD',
  `PERFICACSTOLD` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'CODIGO SITRAP OLD',
  `PERFICACSGOLD` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'CODIGO SIGOR OLD',
  `PERFICATELOLD` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'TELEFONO OLD',
  `PERFICAMAIOLD` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'EMAIL OLD',
  `PERFICAOBSOLD` varchar(5120) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'OBSERVACIÓN OLD',
  `PERFICACODNEW` int(9) NULL COMMENT 'CÓDIGO NEW',
  `PERFICAECCNEW` int(9) NULL COMMENT 'ESTADO NEW',
  `PERFICATPCNEW` int(9) NULL COMMENT 'TIPO PERSONA NEW',
  `PERFICATDCNEW` int(9) NULL COMMENT 'TIPO DOCUMENTO NEW',
  `PERFICANOMNEW` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'NOMBRE NEW',
  `PERFICADOCNEW` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'DOCUMENTO NEW',
  `PERFICACSTNEW` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'CODIGO SITRAP NEW',
  `PERFICACSGNEW` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'CODIGO SIGOR NEW',
  `PERFICATELNEW` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'TELEFONO NEW',
  `PERFICAMAINEW` varchar(100) COLLATE utf8_spanish_ci NULL COMMENT 'EMAIL NEW',
  `PERFICAOBSNEW` varchar(5120) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'OBSERVACIÓN NEW'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='PERSONA AUDITORÍA';

ALTER TABLE `PERFIC` ADD PRIMARY KEY (`PERFICCOD`);
ALTER TABLE `PERFIC` ADD KEY `PERFICECC` (`PERFICECC`);
ALTER TABLE `PERFIC` ADD KEY `PERFICTPC` (`PERFICTPC`);
ALTER TABLE `PERFIC` ADD KEY `PERFICTDC` (`PERFICTDC`);
ALTER TABLE `PERFIC` MODIFY `PERFICCOD` int(9) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO', AUTO_INCREMENT=0;
ALTER TABLE `PERFIC` ADD CONSTRAINT `FK_PERFICECC` FOREIGN KEY (`PERFICECC`) REFERENCES `DOMFIC` (`DOMFICCOD`);
ALTER TABLE `PERFIC` ADD CONSTRAINT `FK_PERFICTPC` FOREIGN KEY (`PERFICTPC`) REFERENCES `DOMFIC` (`DOMFICCOD`);
ALTER TABLE `PERFIC` ADD CONSTRAINT `FK_PERFICTDC` FOREIGN KEY (`PERFICTDC`) REFERENCES `DOMFIC` (`DOMFICCOD`);

ALTER TABLE `PERFICA` ADD PRIMARY KEY (`PERFICACOD`);
ALTER TABLE `PERFICA` MODIFY `PERFICACOD` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO', AUTO_INCREMENT=0;

CREATE TRIGGER `PERFICDLT` 
  BEFORE DELETE ON `PERFIC` 
  FOR EACH ROW 
    INSERT INTO `PERFICA` (`PERFICAMET`, `PERFICAEMP`, `PERFICAUSU`, `PERFICAFEC`, `PERFICADIP`, `PERFICACODOLD`, `PERFICAECCOLD`, `PERFICATPCOLD`, `PERFICATDCOLD`, `PERFICANOMOLD`, `PERFICADOCOLD`, `PERFICACSTOLD`, `PERFICACSGOLD`, `PERFICATELOLD`, `PERFICAMAIOLD`, `PERFICAOBSOLD`)
                  VALUES ('DELETE', OLD.`PERFICAEM`, OLD.`PERFICAUS`, NOW(), OLD.`PERFICAIP`, OLD.`PERFICCOD`, OLD.`PERFICECC`, OLD.`PERFICTPC`, OLD.`PERFICTDC`, OLD.`PERFICNOM`, OLD.`PERFICDOC`, OLD.`PERFICCST`, OLD.`PERFICCSG`, OLD.`PERFICTEL`, OLD.`PERFICMAI`, OLD.`PERFICOBS`);

CREATE TRIGGER `PERFICINS` 
  AFTER INSERT ON `PERFIC` 
  FOR EACH ROW 
    INSERT INTO `PERFICA` (`PERFICAMET`, `PERFICAEMP`, `PERFICAUSU`, `PERFICAFEC`, `PERFICADIP`, `PERFICACODNEW`, `PERFICAECCNEW`, `PERFICATPCNEW`, `PERFICATDCNEW`, `PERFICANOMNEW`, `PERFICADOCNEW`, `PERFICACSTNEW`, `PERFICACSGNEW`, `PERFICATELNEW`, `PERFICAMAINEW`, `PERFICAOBSNEW`)
                  VALUES ('INSERT', NEW.`PERFICAEM`, NEW.`PERFICAUS`, NOW(), NEW.`PERFICAIP`, NEW.`PERFICCOD`, NEW.`PERFICECC`, NEW.`PERFICTPC`, NEW.`PERFICTDC`, NEW.`PERFICNOM`, NEW.`PERFICDOC`, NEW.`PERFICCST`, NEW.`PERFICCSG`, NEW.`PERFICTEL`, NEW.`PERFICMAI`, NEW.`PERFICOBS`);

CREATE TRIGGER `PERFICUPD` 
  AFTER UPDATE ON `PERFIC` 
  FOR EACH ROW 
    INSERT INTO `PERFICA` (`PERFICAMET`, `PERFICAEMP`, `PERFICAUSU`, `PERFICAFEC`, `PERFICADIP`, `PERFICACODOLD`, `PERFICAECCOLD`, `PERFICATPCOLD`, `PERFICATDCOLD`, `PERFICANOMOLD`, `PERFICADOCOLD`, `PERFICACSTOLD`, `PERFICACSGOLD`, `PERFICATELOLD`, `PERFICAMAIOLD`, `PERFICAOBSOLD`, `PERFICACODNEW`, `PERFICAECCNEW`, `PERFICATPCNEW`, `PERFICATDCNEW`, `PERFICANOMNEW`, `PERFICADOCNEW`, `PERFICACSTNEW`, `PERFICACSGNEW`, `PERFICATELNEW`, `PERFICAMAINEW`, `PERFICAOBSNEW`)
                  VALUES ('UPDATE', NEW.`PERFICAEM`, NEW.`PERFICAUS`, NOW(), NEW.`PERFICAIP`, OLD.`PERFICCOD`, OLD.`PERFICECC`, OLD.`PERFICTPC`, OLD.`PERFICTDC`, OLD.`PERFICNOM`, OLD.`PERFICDOC`, OLD.`PERFICCST`, OLD.`PERFICCSG`, OLD.`PERFICTEL`, OLD.`PERFICMAI`, OLD.`PERFICOBS`, NEW.`PERFICCOD`, NEW.`PERFICECC`, NEW.`PERFICTPC`, NEW.`PERFICTDC`, NEW.`PERFICNOM`, NEW.`PERFICDOC`, NEW.`PERFICCST`, NEW.`PERFICCSG`, NEW.`PERFICTEL`, NEW.`PERFICMAI`, NEW.`PERFICOBS`);
