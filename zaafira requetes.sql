/* drop job related fields in 'users' */

ALTER TABLE cafecreme.users DROP FOREIGN KEY Users_fk0;
ALTER TABLE `users` DROP `userJobId`;

ALTER TABLE `users` DROP `userJobName`;













