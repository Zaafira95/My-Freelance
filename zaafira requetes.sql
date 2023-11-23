/* add of company location */

ALTER TABLE `company` ADD `companyLocalisation` VARCHAR(255) NULL DEFAULT NULL AFTER `companyBannerPath`;

UPDATE `company` SET `companyLocalisation` = 'Paris' WHERE `company`.`idCompany` = 1;

UPDATE `company` SET `companyLocalisation` = 'Paris' WHERE `company`.`idCompany` = 2;





