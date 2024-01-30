ALTER TABLE `users` ADD `userDateFinIndisponibilite` DATE NULL DEFAULT NULL AFTER `userCompanyId`;

/* Ajout champ token d'activation */
ALTER TABLE `users` ADD `activationToken` VARCHAR(255) NULL DEFAULT NULL AFTER `userDateFinIndisponibilite`;

/* Vérifier si compte activé */
ALTER TABLE `users` ADD `isActive` INT NOT NULL DEFAULT '0' AFTER `activationToken`;
