CREATE TABLE `cafecreme`.`Banner` (`idBanner` INT NOT NULL AUTO_INCREMENT , `bannerMessage` TEXT NOT NULL , `bannerLink` VARCHAR(255) NOT NULL , `bannerStatus` VARCHAR(255) NOT NULL , `bannerTitle` VARCHAR(255) NOT NULL , PRIMARY KEY (`idBanner`)) ENGINE = InnoDB;



-- Création champ userWelcomeMail
ALTER TABLE `users` ADD `userWelcomeMail` VARCHAR(255) NOT NULL DEFAULT 'False' AFTER `userResetPasswordToken`;


-- Création champ whatsAppGroupIsFull

ALTER TABLE `whatsappgroups` ADD `whatsAppGroupIsFull` VARCHAR(200) NOT NULL DEFAULT '0' AFTER `whatsAppGroupLink`;
