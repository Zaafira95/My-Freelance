-- Création champ companyWebsite
ALTER TABLE `company` ADD `companyWebsite` VARCHAR(255) NULL DEFAULT NULL AFTER `companyLocalisation`;
