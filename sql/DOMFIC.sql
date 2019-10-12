CREATE TABLE `DOMFIC` (
  `DOMFICCOD` int(9) NOT NULL COMMENT 'CÓDIGO',
  `DOMFICEDC` int(9) NOT NULL COMMENT 'ESTADO',
  `DOMFICNOM` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'NOMRBE',
  `DOMFICVAL` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'DOMINIO',
  `DOMFICOBS` varchar(5120) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'OBSERVACIÓN',
  `DOMFICAEM` int(9) NOT NULL COMMENT 'AUDITORÍA EMPRESA',
  `DOMFICAUS` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'AUDITORÍA USUARIO',
  `DOMFICAFH` datetime NOT NULL COMMENT 'AUDITORÍA FECHA HORA',
  `DOMFICAIP` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'AUDITORÍA IP'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='DOMINIO';

CREATE TABLE `DOMFICA` (
  `DOMFICACOD` int(11) NOT NULL COMMENT 'CÓDIGO',
  `DOMFICAMET` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'MÉTODO',
  `DOMFICAEMP` int(9) NOT NULL COMMENT 'EMPRESA',
  `DOMFICAUSU` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'USUARIO',
  `DOMFICAFEC` datetime NOT NULL COMMENT 'FECHA HORA',
  `DOMFICADIP` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'IP',
  `DOMFICACODOLD` int(9) DEFAULT NULL COMMENT 'CÓDIGO OLD',
  `DOMFICAEDCOLD` int(9) DEFAULT NULL COMMENT 'ESTADO OLD',
  `DOMFICANOMOLD` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'NOMBRE OLD',
  `DOMFICAVALOLD` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'DOMINIO OLD',
  `DOMFICAOBSOLD` varchar(5120) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'OBSERVACIÓN OLD',
  `DOMFICACODNEW` int(9) DEFAULT NULL COMMENT 'CÓDIGO NEW',
  `DOMFICAEDCNEW` int(9) DEFAULT NULL COMMENT 'ESTADO NEW',
  `DOMFICANOMNEW` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'NOMBRE NEW',
  `DOMFICAVALNEW` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'DOMINIO NEW',
  `DOMFICAOBSNEW` varchar(5120) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'OBSERVACIÓN NEW'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='DOMINIO AUDITORÍA';

ALTER TABLE `DOMFIC` ADD PRIMARY KEY `DOMFICEDC` (`DOMFICCOD`);
ALTER TABLE `DOMFIC` ADD KEY `DOMFICEDC` (`DOMFICEDC`);
ALTER TABLE `DOMFIC` MODIFY `DOMFICCOD` int(9) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO', AUTO_INCREMENT=0;
ALTER TABLE `DOMFIC` ADD CONSTRAINT `FK_DOMFICEDC` FOREIGN KEY (`DOMFICEDC`) REFERENCES `DOMFIC` (`DOMFICCOD`);

ALTER TABLE `DOMFICA` ADD PRIMARY KEY (`DOMFICACOD`);
ALTER TABLE `DOMFICA` MODIFY `DOMFICACOD` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO', AUTO_INCREMENT=0;

CREATE TRIGGER `DOMFICDLT` 
  BEFORE DELETE ON `DOMFIC` 
  FOR EACH ROW 
    INSERT INTO `DOMFICA` (`DOMFICAMET`, `DOMFICAEMP`, `DOMFICAUSU`, `DOMFICAFEC`, `DOMFICADIP`, `DOMFICACODOLD`, `DOMFICAEDCOLD`, `DOMFICANOMOLD`, `DOMFICAVALOLD`, `DOMFICAOBSOLD`)
                  VALUES ('DELETE', OLD.`DOMFICAEM`, OLD.`DOMFICAUS`, NOW(), OLD.`DOMFICAIP`, OLD.`DOMFICCOD`, OLD.`DOMFICEDC`, OLD.`DOMFICNOM`, OLD.`DOMFICVAL`, OLD.`DOMFICOBS`);

CREATE TRIGGER `DOMFICINS` 
  AFTER INSERT ON `DOMFIC` 
  FOR EACH ROW 
    INSERT INTO `DOMFICA` (`DOMFICAMET`, `DOMFICAEMP`, `DOMFICAUSU`, `DOMFICAFEC`, `DOMFICADIP`, `DOMFICACODNEW`, `DOMFICAEDCNEW`, `DOMFICANOMNEW`, `DOMFICAVALNEW`, `DOMFICAOBSNEW`)
                  VALUES ('INSERT', NEW.`DOMFICAEM`, NEW.`DOMFICAUS`, NOW(), NEW.`DOMFICAIP`, NEW.`DOMFICCOD`, NEW.`DOMFICEDC`, NEW.`DOMFICNOM`, NEW.`DOMFICVAL`, NEW.`DOMFICOBS`);

CREATE TRIGGER `DOMFICUPD` 
  AFTER UPDATE ON `DOMFIC` 
  FOR EACH ROW 
    INSERT INTO `DOMFICA` (`DOMFICAMET`, `DOMFICAEMP`, `DOMFICAUSU`, `DOMFICAFEC`, `DOMFICADIP`, `DOMFICACODOLD`, `DOMFICAEDCOLD`, `DOMFICANOMOLD`, `DOMFICAVALOLD`, `DOMFICAOBSOLD`, `DOMFICACODNEW`, `DOMFICAEDCNEW`, `DOMFICANOMNEW`, `DOMFICAVALNEW`, `DOMFICAOBSNEW`)
                  VALUES ('UPDATE', NEW.`DOMFICAEM`, NEW.`DOMFICAUS`, NOW(), NEW.`DOMFICAIP`, OLD.`DOMFICCOD`, OLD.`DOMFICEDC`, OLD.`DOMFICNOM`, OLD.`DOMFICVAL`, OLD.`DOMFICOBS`, NEW.`DOMFICCOD`, NEW.`DOMFICEDC`, NEW.`DOMFICNOM`, NEW.`DOMFICVAL`, NEW.`DOMFICOBS`);

INSERT INTO `DOMFIC` (`DOMFICCOD`, `DOMFICEDC`, `DOMFICNOM`, `DOMFICVAL`, `DOMFICOBS`, `DOMFICAEM`, `DOMFICAUS`, `DOMFICAFH`, `DOMFICAIP`) VALUES (1, 'ACTIVO', 'DOMINIOESTADO', NULL, 1, 'SISTEMA', NOW(), '127.1.1.1');
INSERT INTO `DOMFIC` (`DOMFICCOD`, `DOMFICEDC`, `DOMFICNOM`, `DOMFICVAL`, `DOMFICOBS`, `DOMFICAEM`, `DOMFICAUS`, `DOMFICAFH`, `DOMFICAIP`) VALUES (1, 'INACTIVO', 'DOMINIOESTADO', NULL, 1, 'SISTEMA', NOW(), '127.1.1.1');