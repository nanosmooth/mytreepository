CREATE  TABLE IF NOT EXISTS `hamarlok_local`.`User` (
  `UserKey` INT(11) NOT NULL AUTO_INCREMENT ,
  `UserId` VARCHAR(45) NOT NULL ,
  `Email` VARCHAR(45) NOT NULL ,
  `FirstName` VARCHAR(45) NOT NULL ,
  `LastName` VARCHAR(45) NOT NULL ,
  `BirthDate` DATE NULL ,
  `Gender` ENUM('M','F') NOT NULL ,
  `CreatedDate` DATE NOT NULL ,
  `RegisteredDate` DATE NULL ,
  `LastModifiedDate` DATE NULL ,
  `Active` TINYINT(1) NOT NULL COMMENT '1 = Active\n0 = Inactive' ,
  `DisplayPicUrl` TEXT NULL ,
  `Status` TEXT NULL ,
  `Location` VARCHAR(45) NULL ,
  UNIQUE INDEX `UserId_UNIQUE` (`UserId` ASC) ,
  PRIMARY KEY (`UserKey`, `Email`) ,
  UNIQUE INDEX `UserKey_UNIQUE` (`UserKey` ASC) )
ENGINE = InnoDB



CREATE  TABLE IF NOT EXISTS `hamarlok_local`.`LogIn` (
  `UserId` VARCHAR(45) NOT NULL ,
  `Password` VARCHAR(64) NOT NULL ,
  `Salt` VARCHAR(64) NOT NULL ,
  `Activation` VARCHAR(45) NOT NULL ,
  `ActiveState` ENUM('0','1') NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`UserId`) )
ENGINE = InnoDB