/* Statut par défaut des avis : 0 (en attente d'approbation) */

ALTER TABLE `rating` CHANGE `ratingStatus` `ratingStatus` INT(11) NULL DEFAULT '0';


/*  */

UPDATE `rating` SET `ratingDate` = '2023-06-12' WHERE `rating`.`idRating` = 17;

UPDATE `rating` SET `ratingDate` = '2023-07-05' WHERE `rating`.`idRating` = 19;

/*  */

UPDATE `rating` SET `ratingStatus` = '1' WHERE `rating`.`idRating` = 19;

UPDATE `rating` SET `ratingStatus` = '0' WHERE `rating`.`idRating` = 17;















