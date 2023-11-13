/* Statut par défaut des avis : 0 (en attente d'approbation) */

ALTER TABLE `rating` CHANGE `ratingStatus` `ratingStatus` INT(11) NULL DEFAULT '0';

















