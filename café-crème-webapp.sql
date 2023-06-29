CREATE TABLE `Users` (
    `userId` INT NOT NULL AUTO_INCREMENT,
    `userFirstName` VARCHAR(255) NOT NULL,
    `userLastName` VARCHAR(255) NOT NULL,
    `userEmail` VARCHAR(255) NOT NULL,
    `userPassword` VARCHAR(255) NOT NULL,
    `userType` VARCHAR(255) NOT NULL,
    `userJobId` INT NOT NULL,
    `userJobType` VARCHAR(255),
    `userTJM` INT,
    `userTelephone` VARCHAR(10),
    `userAdresse` VARCHAR(255),
    `userVille` VARCHAR(255),
    `userPays` VARCHAR(255),
    `userCodePostal` INT,
    `userSkillsId` INT,
    `userRatingAverage` DECIMAL(5, 2),
    `userPortfolioLink` VARCHAR(255),
    `userLinkedinLink` VARCHAR(255),
    `userGithubLink` VARCHAR(255),
    `userDribbleLink` VARCHAR(255),
    `userBehanceLink` VARCHAR(255),
    `userRemote` BOOLEAN DEFAULT 0,
    `userExperienceYear` VARCHAR(255),
    `userIsAvailable` BOOLEAN DEFAULT 0,
    `userCreated` DATETIME,
    `userModified` DATETIME,
    `userAvatarPath` VARCHAR(255),
    `userExperienceId` INT,
    `userCertificationId` INT,
    `userSavedMissionId` INT,
    `userRatingId` INT,
    PRIMARY KEY (`userId`)
);

CREATE TABLE `Certification` (
    `idCertification` INT NOT NULL AUTO_INCREMENT,
    `certificationUserId` INT NOT NULL,
    `certificationTitle` VARCHAR(255),
    `certificationPath` VARCHAR(255),
    PRIMARY KEY (`idCertification`)
);

CREATE TABLE `Rating` (
    `idRating` INT NOT NULL AUTO_INCREMENT,
    `idUser` INT NOT NULL,
    `idRatedUser` INT,
    `ratingStars` INT,
    `ratingComment` VARCHAR(255),
    `ratingDate` DATE,
    `ratingEmoji` VARCHAR(255),
    PRIMARY KEY (`idRating`)
);

CREATE TABLE `Experience` (
    `idExperience` INT NOT NULL AUTO_INCREMENT,
    `experienceCompany` VARCHAR(255),
    `experienceJob` VARCHAR(255),
    `experienceVille` VARCHAR(255),
    `experiencePays` VARCHAR(255),
    `experienceDateDebut` DATE,
    `experienceDateFin` DATE,
    `experienceDescription` VARCHAR(255),
    `experienceSkills` VARCHAR(255),
    `experienceUserId` INT,
    PRIMARY KEY (`idExperience`)
);

CREATE TABLE `Job` (
    `idJob` INT NOT NULL AUTO_INCREMENT,
    `jobName` VARCHAR(255),
    PRIMARY KEY (`idJob`)
);

CREATE TABLE `Company` (
    `idCompany` INT NOT NULL AUTO_INCREMENT,
    `companyName` VARCHAR(255),
    `companyDescription` VARCHAR(255),
    `companyLogoPath` VARCHAR(255),
    `companyUserID` INT,
    PRIMARY KEY (`idCompany`)
);

CREATE TABLE `Mission` (
    `idMission` INT NOT NULL AUTO_INCREMENT,
    `missionName` VARCHAR(255),
    `missionTJM` INT,
    `missionDescription` VARCHAR(255),
    `missionSkills` VARCHAR(255),
    `missionDateDebut` VARCHAR(255),
    `missionDateFin` VARCHAR(255),
    `missionRemote` BOOLEAN DEFAULT 0,
    `missionCompanyId` INT,
    `missionJobId` INT,
    PRIMARY KEY (`idMission`)
);

CREATE TABLE `InterestedProfiles` (
    `idInterest` INT NOT NULL AUTO_INCREMENT,
    `interestedProfilesCompanyID` INT,
    `interestedProfilesUserID` INT,
    `dateInterestedProfiles` DATETIME,
    PRIMARY KEY (`idInterest`)
);

CREATE TABLE `SavedMission` (
    `idSavedMission` INT NOT NULL AUTO_INCREMENT,
    `idMissionSavedMission` INT,
    `idUserSavedMission` INT,
    `idCompanySavedMission` INT,
    PRIMARY KEY (`idSavedMission`)
);

CREATE TABLE `Skills` (
    `skillId` INT NOT NULL AUTO_INCREMENT,
    `skillName` VARCHAR(255),
    PRIMARY KEY (`skillId`)
);

ALTER TABLE `Users` ADD CONSTRAINT `Users_fk0` FOREIGN KEY (`userJobId`) REFERENCES `Job`(`idJob`);
ALTER TABLE `Users` ADD CONSTRAINT `Users_fk1` FOREIGN KEY (`userSkillsId`) REFERENCES `Skills`(`skillId`);
ALTER TABLE `Users` ADD CONSTRAINT `Users_fk2` FOREIGN KEY (`userExperienceId`) REFERENCES `Experience`(`idExperience`);
ALTER TABLE `Users` ADD CONSTRAINT `Users_fk3` FOREIGN KEY (`userCertificationId`) REFERENCES `Certification`(`idCertification`);
ALTER TABLE `Users` ADD CONSTRAINT `Users_fk4` FOREIGN KEY (`userSavedMissionId`) REFERENCES `SavedMission`(`idSavedMission`);
ALTER TABLE `Users` ADD CONSTRAINT `Users_fk5` FOREIGN KEY (`userRatingId`) REFERENCES `Rating`(`idRating`);

ALTER TABLE `Certification` ADD CONSTRAINT `Certification_fk0` FOREIGN KEY (`certificationUserId`) REFERENCES `Users`(`userId`);

ALTER TABLE `Rating` ADD CONSTRAINT `Rating_fk0` FOREIGN KEY (`idUser`) REFERENCES `Users`(`userId`);
ALTER TABLE `Rating` ADD CONSTRAINT `Rating_fk1` FOREIGN KEY (`idRatedUser`) REFERENCES `Users`(`userId`);

ALTER TABLE `Experience` ADD CONSTRAINT `Experience_fk0` FOREIGN KEY (`experienceUserId`) REFERENCES `Users`(`userId`);

ALTER TABLE `Company` ADD CONSTRAINT `Company_fk0` FOREIGN KEY (`companyUserID`) REFERENCES `Users`(`userId`);

ALTER TABLE `Mission` ADD CONSTRAINT `Mission_fk0` FOREIGN KEY (`missionCompanyId`) REFERENCES `Company`(`idCompany`);
ALTER TABLE `Mission` ADD CONSTRAINT `Mission_fk1` FOREIGN KEY (`missionJobId`) REFERENCES `Job`(`idJob`);

ALTER TABLE `InterestedProfiles` ADD CONSTRAINT `InterestedProfiles_fk0` FOREIGN KEY (`interestedProfilesCompanyID`) REFERENCES `Company`(`idCompany`);
ALTER TABLE `InterestedProfiles` ADD CONSTRAINT `InterestedProfiles_fk1` FOREIGN KEY (`interestedProfilesUserID`) REFERENCES `Users`(`userId`);

ALTER TABLE `SavedMission` ADD CONSTRAINT `SavedMission_fk0` FOREIGN KEY (`idMissionSavedMission`) REFERENCES `Mission`(`idMission`);
ALTER TABLE `SavedMission` ADD CONSTRAINT `SavedMission_fk1` FOREIGN KEY (`idUserSavedMission`) REFERENCES `Users`(`userId`);
ALTER TABLE `SavedMission` ADD CONSTRAINT `SavedMission_fk2` FOREIGN KEY (`idCompanySavedMission`) REFERENCES `Company`(`idCompany`);


