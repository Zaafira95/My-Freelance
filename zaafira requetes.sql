ALTER TABLE `users` ADD `userDateFinIndisponibilite` DATE NULL DEFAULT NULL AFTER `userCompanyId`;

/* Ajout champ token d'activation */
ALTER TABLE `users` ADD `userActivationToken` VARCHAR(255) NULL DEFAULT NULL AFTER `userDateFinIndisponibilite`;

/* Vérifier si compte activé */
ALTER TABLE `users` ADD `userIsActive` INT NOT NULL DEFAULT '0' AFTER `userActivationToken`;
