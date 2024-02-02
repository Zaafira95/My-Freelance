-- Création champ companyWebsite
ALTER TABLE `company` ADD `companyWebsite` VARCHAR(255) NULL DEFAULT NULL AFTER `companyLocalisation`;

-- Création champ userResetPasswordTokenExpirationDate
ALTER TABLE `users` ADD `userResetPasswordTokenExpirationDate` DATETIME NULL DEFAULT NULL AFTER `userResetPasswordToken`;

