CREATE TABLE `DOMSUB` (
  `DOMSUBCO1` int(9) NOT NULL COMMENT 'CÓDIGO DOMINIO 1',
  `DOMSUBCO2` int(9) NOT NULL COMMENT 'CÓDIGO DOMINIO 2',
  `DOMSUBEDC` int(9) NOT NULL COMMENT 'ESTADO',
  `DOMSUBVAL` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'DOMINIO',
  `DOMSUBOBS` varchar(5120) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'OBSERVACIÓN',
  `DOMSUBAEM` int(9) NOT NULL COMMENT 'AUDITORÍA EMPRESA',
  `DOMSUBAUS` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'AUDITORÍA USUARIO',
  `DOMSUBAFH` datetime NOT NULL COMMENT 'AUDITORÍA FECHA HORA',
  `DOMSUBAIP` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'AUDITORÍA IP'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='DOMINIO';

CREATE TABLE `DOMSUBA` (
  `DOMSUBACOD` int(11) NOT NULL COMMENT 'CÓDIGO',
  `DOMSUBAMET` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'MÉTODO',
  `DOMSUBAEMP` int(9) NOT NULL COMMENT 'EMPRESA',
  `DOMSUBAUSU` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'USUARIO',
  `DOMSUBAFEC` datetime NOT NULL COMMENT 'FECHA HORA',
  `DOMSUBADIP` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'IP',
  `DOMSUBACO1OLD` int(9) DEFAULT NULL COMMENT 'CÓDIGO DOMINIO 1 OLD',
  `DOMSUBACO2OLD` int(9) DEFAULT NULL COMMENT 'CÓDIGO DOMINIO 2 OLD',
  `DOMSUBAEDCOLD` int(9) DEFAULT NULL COMMENT 'ESTADO OLD',
  `DOMSUBAVALOLD` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'DOMINIO OLD',
  `DOMSUBAOBSOLD` varchar(5120) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'OBSERVACIÓN OLD',
  `DOMSUBACO1NEW` int(9) DEFAULT NULL COMMENT 'CÓDIGO DOMINIO 1 NEW',
  `DOMSUBACO2NEW` int(9) DEFAULT NULL COMMENT 'CÓDIGO DOMINIO 2 NEW',
  `DOMSUBAEDCNEW` int(9) DEFAULT NULL COMMENT 'ESTADO NEW',
  `DOMSUBAVALNEW` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'DOMINIO NEW',
  `DOMSUBAOBSNEW` varchar(5120) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'OBSERVACIÓN NEW'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='DOMINIO AUDITORÍA';

ALTER TABLE `DOMSUB` ADD PRIMARY KEY `DOMSUBCOD` (`DOMSUBCO1`, `DOMSUBCO2`);
ALTER TABLE `DOMSUB` ADD KEY `DOMSUBEDC` (`DOMSUBEDC`);
ALTER TABLE `DOMSUB` ADD CONSTRAINT `FK_DOMSUBCO1` FOREIGN KEY (`DOMSUBCO1`) REFERENCES `DOMFIC` (`DOMFICCOD`);
ALTER TABLE `DOMSUB` ADD CONSTRAINT `FK_DOMSUBCO2` FOREIGN KEY (`DOMSUBCO2`) REFERENCES `DOMFIC` (`DOMFICCOD`);
ALTER TABLE `DOMSUB` ADD CONSTRAINT `FK_DOMSUBEDC` FOREIGN KEY (`DOMSUBEDC`) REFERENCES `DOMFIC` (`DOMFICCOD`);

ALTER TABLE `DOMSUBA` ADD PRIMARY KEY (`DOMSUBACOD`);
ALTER TABLE `DOMSUBA` MODIFY `DOMSUBACOD` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO', AUTO_INCREMENT=0;

CREATE TRIGGER `DOMSUBDLT` 
  BEFORE DELETE ON `DOMSUB` 
  FOR EACH ROW 
    INSERT INTO `DOMSUBA` (`DOMSUBAMET`, `DOMSUBAEMP`, `DOMSUBAUSU`, `DOMSUBAFEC`, `DOMSUBADIP`, `DOMSUBACO1OLD`, `DOMSUBACO2OLD`, `DOMSUBAEDCOLD`, `DOMSUBAVALOLD`, `DOMSUBAOBSOLD`)
                  VALUES ('DELETE', OLD.`DOMSUBAEM`, OLD.`DOMSUBAUS`, NOW(), OLD.`DOMSUBAIP`, OLD.`DOMSUBCO1`, OLD.`DOMSUBCO2`, OLD.`DOMSUBEDC`, OLD.`DOMSUBVAL`, OLD.`DOMSUBOBS`);

CREATE TRIGGER `DOMSUBINS` 
  AFTER INSERT ON `DOMSUB` 
  FOR EACH ROW 
    INSERT INTO `DOMSUBA` (`DOMSUBAMET`, `DOMSUBAEMP`, `DOMSUBAUSU`, `DOMSUBAFEC`, `DOMSUBADIP`, `DOMSUBACO1NEW`, `DOMSUBACO2NEW`, `DOMSUBAEDCNEW`, `DOMSUBAVALNEW`, `DOMSUBAOBSNEW`)
                  VALUES ('INSERT', NEW.`DOMSUBAEM`, NEW.`DOMSUBAUS`, NOW(), NEW.`DOMSUBAIP`, NEW.`DOMSUBCO1`, NEW.`DOMSUBCO2`, NEW.`DOMSUBEDC`, NEW.`DOMSUBVAL`, NEW.`DOMSUBOBS`);

CREATE TRIGGER `DOMSUBUPD` 
  AFTER UPDATE ON `DOMSUB` 
  FOR EACH ROW 
    INSERT INTO `DOMSUBA` (`DOMSUBAMET`, `DOMSUBAEMP`, `DOMSUBAUSU`, `DOMSUBAFEC`, `DOMSUBADIP`, `DOMSUBACO1OLD`, `DOMSUBACO2OLD`, `DOMSUBAEDCOLD`, `DOMSUBAVALOLD`, `DOMSUBAOBSOLD`, `DOMSUBACO1NEW`, `DOMSUBACO2NEW`, `DOMSUBAEDCNEW`, `DOMSUBAVALNEW`, `DOMSUBAOBSNEW`)
                  VALUES ('UPDATE', NEW.`DOMSUBAEM`, NEW.`DOMSUBAUS`, NOW(), NEW.`DOMSUBAIP`, OLD.`DOMSUBCO1`, OLD.`DOMSUBCO2`, OLD.`DOMSUBEDC`, OLD.`DOMSUBVAL`, OLD.`DOMSUBOBS`, NEW.`DOMSUBCO1`, NEW.`DOMSUBCO2`, NEW.`DOMSUBEDC`, NEW.`DOMSUBVAL`, NEW.`DOMSUBOBS`);