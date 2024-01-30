/* reset password token */

ALTER TABLE `users` ADD `userResetPasswordToken` VARCHAR(255) NULL DEFAULT NULL AFTER `userIsActive`;
