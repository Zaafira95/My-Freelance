/* add of company location */

ALTER TABLE `company` ADD `companyLocalisation` VARCHAR(255) NULL DEFAULT NULL AFTER `companyBannerPath`;

UPDATE `company` SET `companyLocalisation` = 'Lyon' WHERE `company`.`idCompany` = 1;

UPDATE `company` SET `companyLocalisation` = 'Paris' WHERE `company`.`idCompany` = 2;


/* add logo path to Airbnb*/

UPDATE `company` SET `companyLogoPath` = 'assets/img/company/1/logo/airb.png' WHERE `company`.`idCompany` = 1;
