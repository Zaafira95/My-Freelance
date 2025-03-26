<?php

class User_model extends CI_Model {
    
    public function get_UserData($userId){
        $this->db->select('*');
        $this->db->from('Users');
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        return $query->row();
        
    }
    
    // Récupérer le job de l'utilisateur connecté avec le job id
    public function getUserJob($userId){
        $this->db->select('*');
        $this->db->from('Job');
        $this->db->join('UserJob', 'UserJob.userJob_jobId = Job.jobId');
        $this->db->where('userJob_userId', $userId);
        $query = $this->db->get();
        return $query->row();
    }

    // Récupérer le pays de l'utilisateur connecté avec le country id
    public function getUserCountry($userCountryId){
        $this->db->select('*');
        $this->db->from('Countries');
        $this->db->where('idCountry', $userCountryId);
        $query = $this->db->get();
        return $query->row();
    }

    
    // Recupérer toutes les expériences avec le user id
    public function getUserExperience($userId){
        $this->db->select('*');
        $this->db->from('Experience');
        $this->db->where('experienceUserId', $userId);
        $this->db->order_by('experienceDateDebut', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Recupérer toutes les compétences avec le user id
    public function getUserSkillsAll($userId) {
        $this->db->select('Skills.skillId, Skills.skillName, UserSkills.userSkillsExperience');
        $this->db->from('UserSkills');
        $this->db->join('Skills', 'UserSkills.userSkills_skillId = Skills.skillId');
        $this->db->where('UserSkills.userSkills_userId', $userId);
        $query = $this->db->get();
        return $query->result();
    }
    
    
    public function updateAvatarPath($userId, $file_path){
        $this->db->set('userAvatarPath', $file_path);
        $this->db->where('userId', $userId);
        $this->db->update('Users');
    }

    
    public function updateUserAvailability($userId, $userAvailability, $userJobTimePartielOrFullTime, $dateFinIndisponibilite){
        $this->db->set('userIsAvailable', $userAvailability);
        $this->db->set('userJobTimePartielOrFullTime', $userJobTimePartielOrFullTime);
        $this->db->set('userDateFinIndisponibilite', $dateFinIndisponibilite);
        $this->db->where('userId', $userId);
        $this->db->update('Users');
    }

    public function getAllMission(){
        $this->db->select('*');
        $this->db->from('Mission');
        $this->db->join('Job', 'Mission.missionJobId = Job.jobId');
        $this->db->join('Countries', 'Mission.missionCountryId = Countries.idCountry');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllCompanies(){
        $this->db->select('*');
        $this->db->from('Company');
        $this->db->join('Secteurs', 'Company.companySecteur = Secteurs.secteurName');
        $this->db->join('Countries', 'Company.companyCountryId = Countries.idCountry');
        $query = $this->db->get();
        return $query->result();
    }

    public function getMissionSkills($idMissions) {
        $this->db->select('Skills.skillName, Skills.skillId, MissionSkills.missionSkillsExperience');
        $this->db->from('MissionSkills');
        $this->db->join('Skills', 'MissionSkills.missionSkills_skillId = Skills.skillId');
        $this->db->where('MissionSkills.missionSkills_missionId', $idMissions);
        $this->db->order_by('MissionSkills.missionSkillsExperience', 'DESC'); // Tri par ordre décroissant
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getExperienceSkills($idExperience) {
        $this->db->select('Skills.skillName, Skills.skillId, ExperienceSkills.experienceSkillsExpertise,  ExperienceSkills.experienceSkills_skillId');
        $this->db->from('ExperienceSkills');
        $this->db->join('Skills', 'ExperienceSkills.experienceSkills_skillId = Skills.skillId');
        $this->db->where('ExperienceSkills.experienceSkills_experienceId', $idExperience);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function deleteUserExperienceSkills($experienceId){
        $this->db->where('experienceSkills_experienceId', $experienceId);
        $this->db->delete('ExperienceSkills');
    }

    public function updateUserExperienceSkills($experienceId, $skillId, $level){
        $this->db->set('experienceSkills_experienceId', $experienceId);
        $this->db->set('experienceSkills_skillId', $skillId);
        $this->db->set('experienceSkillsExpertise', $level);
        $this->db->insert('ExperienceSkills');
    }

    public function getCompanyMission($idMissions)
    {
        $this->db->select('Company.companyName, Company.companyLogoPath');
        $this->db->from('Mission');
        $this->db->join('Company', 'Mission.missionCompanyId = Company.idCompany');
        $this->db->where('Mission.idMission', $idMissions);
        $query = $this->db->get();
        return $query->result();
    }

    
    // Récupérer le pays de l'ESN connecté avec le country id
    public function getCompanyCountry($companyCountryId){
        $this->db->select('*');
        $this->db->from('Countries');
        $this->db->where('idCountry', $companyCountryId);
        $query = $this->db->get();
        return $query->row();
    }

    public function addToFavorite($userId, $missionId, $companyMissionId){
        $data = array(
            'idUsersavedMission' => $userId,
            'idMissionsavedMission' => $missionId,
            'idCompanysavedMission' =>  $companyMissionId
        );
        $this->db->insert('SavedMission', $data);
    }
    
    public function getFavoriteMissions($userId){
        $this->db->select('*');
        $this->db->from('SavedMission');
        $this->db->where('idUsersavedMission', $userId);
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteFromFavorite($userId, $missionId){
        $this->db->where('idUsersavedMission', $userId);
        $this->db->where('idMissionsavedMission', $missionId);
        $this->db->delete('SavedMission');
    }
    
        
      
      public function getRatingCountByUser($userId) {
        $this->db->select('COUNT(*) as total');
        $this->db->where('idRatedUser', $userId);
        $this->db->where('ratingStatus', 1);
        $query = $this->db->get('Rating');
        return $query->row()->total;
      }

      // get all the data of the user who rated the user currently connected you can pick data in user table with the idUser in rating table

        public function getRaterUser($userId) {
            $this->db->select('*');
            $this->db->from('Rating');
            $this->db->join('Users', 'Users.userId = Rating.idUser');
            $this->db->join('Company', 'Users.userId = Company.companyUserID');
            $this->db->where('idRatedUser', $userId);
            $this->db->where('ratingStatus', 1);
            $query = $this->db->get();
            return $query->result();
        }


        public function getRatingsByUser($userId) {
            $this->db->select('AVG(r.ratingStars) AS ratingAverage, r.ratingStars, r.ratingComment, r.ratingDate, u.userId, u.userFirstName, u.userAvatarPath');
            $this->db->from('Rating r');
            $this->db->join('Users u', 'u.userId = r.idUser');
            $this->db->where('r.idRatedUser', $userId);
            $this->db->group_by('r.ratingStars, r.ratingComment, r.ratingDate, u.userId, u.userFirstName, u.userAvatarPath');
            $this->db->order_by('r.ratingDate', 'DESC');
            $query = $this->db->get();
            return $query->result();
        }

        public function updateUserData($userId, $userFirstName, $userLastName, $userTelephone, $jobId, $userExperienceYear, $userTJM){
            $this->db->set('userFirstName', $userFirstName);
            $this->db->set('userLastName', $userLastName);
            $this->db->set('userTelephone', $userTelephone);
            $this->db->set('userExperienceYear', $userExperienceYear);
            $this->db->set('userTJM', $userTJM);
            $this->db->where('userId', $userId);
            $this->db->update('Users');

            $this->db->set('userJob_jobId', $jobId);
            $this->db->where('userJob_userId', $userId);
            $this->db->update('UserJob');
        }

        //Zaafira 25/01/2024
        public function updateUserPreference($userId, $userIsAvailable, $jobTypeString, $userCountryId, $userJobTime, $userJobTimePartielOrFullTime, $dateFinIndisponibilite){
            $this->db->set('userIsAvailable', $userIsAvailable);
            $this->db->set('userJobType', $jobTypeString);
            $this->db->set('userCountryId', $userCountryId);
            $this->db->set('userJobTime', $userJobTime);
            $this->db->set('userJobTimePartielOrFullTime', $userJobTimePartielOrFullTime);
            $this->db->set('userDateFinIndisponibilite', $dateFinIndisponibilite);
            $this->db->where('userId', $userId);
            $this->db->update('Users');
        }

        public function updateUserLinks($userId, $userPortfolioLink, $userLinkedinLink, $userGithubLink, $userDribbleLink, $userBehanceLink){
            $this->db->set('userPortfolioLink', $userPortfolioLink);
            $this->db->set('userLinkedinLink', $userLinkedinLink);
            $this->db->set('userGithubLink', $userGithubLink);
            $this->db->set('userDribbleLink', $userDribbleLink);
            $this->db->set('userBehanceLink', $userBehanceLink);
            $this->db->where('userId', $userId);
            $this->db->update('Users');
        }

        public function updateUserBio($userId, $userBio){
            $this->db->set('userBio', $userBio);
            $this->db->where('userId', $userId);
            $this->db->update('Users');
        }

        public function getUserJobType($userId){
            $this->db->select('Userjobtype');
            $this->db->from('Users');
            $this->db->where('userId', $userId);
            $query = $this->db->get();
            return $query->row()->userJobType;
        }

        public function updateUserExperience($experienceId, $userId, $userExperienceJob, $userExperienceCompany, $userExperienceDescription, $userExperienceDateDebut, $userExperienceDateFin){
            $this->db->set('experienceJob', $userExperienceJob);
            $this->db->set('experienceCompany', $userExperienceCompany);
            $this->db->set('experienceDescription', $userExperienceDescription);
            $this->db->set('experienceDateDebut', $userExperienceDateDebut);
            $this->db->set('experienceDateFin', $userExperienceDateFin);
            $this->db->where('experienceUserId', $userId);
            $this->db->where('idExperience', $experienceId);
            $this->db->update('Experience');
        }

        public function addUserExperience($userId, $userExperienceJob, $userExperienceCompany, $userExperienceDescription, $userExperienceDateDebut, $userExperienceDateFin){
            $this->db->set('experienceJob', $userExperienceJob);
            $this->db->set('experienceCompany', $userExperienceCompany);
            $this->db->set('experienceDescription', $userExperienceDescription);
            $this->db->set('experienceDateDebut', $userExperienceDateDebut);
            $this->db->set('experienceDateFin', $userExperienceDateFin);
            $this->db->set('experienceUserId', $userId);
            $this->db->insert('Experience');
            $experienceId = $this->db->insert_id();
            return $experienceId; 
           
        }

        public function deleteUserExperience($experienceId) {
            // Supprimer l'expérience de la table "experience"
            $this->db->where('idExperience', $experienceId);
            $this->db->delete('Experience');
        }

        public function getMissionDescription($missionId){
            $this->db->select('Missiondescription');
            $this->db->from('Mission');
            $this->db->where('idMission', $missionId);
            $query = $this->db->get();
            return $query->row()->missionDescription;
        }


        // public function getUserSkills($userId){
        //     $this->db->select('userSkill'); // Ajout de la colonne userSkillsExperience
        //     $this->db->from('Users');
        //     $this->db->where('userId', $userId);
        //     $query = $this->db->get();
        //     return $query->row()->userSkill;
        // }

        // // get job id from job name

        public function getJobId($jobName) {
            $this->db->select('jobId');
            $this->db->from('Job');
            $this->db->where('jobName', $jobName);
            $query = $this->db->get();
            return $query->row()->jobId;
        }


        public function getUserAttachement($userId){
            $this->db->select('*');
            $this->db->from('Attachment');
            $this->db->where('attachmentUserId', $userId);
            $query = $this->db->get();
            return $query->result();
        }

        // Dans le modèle Attachment_model

        public function addAttachment($data)
        {
            $this->db->insert('Attachment', $data);
            return $this->db->insert_id();
        }

        public function deleteUserAttachment($attachmentId) {
            $this->db->where('idAttachment', $attachmentId);
            $this->db->delete('Attachment');
        } 

        public function getAttachmentPath($id){
            $this->db->select('attachmentPath');
            $this->db->where('idAttachment', $id);
            $query = $this->db->get('Attachment');
            return $query->row()->attachmentPath;
        }
        
        public function deleteProfilPicture($userId){
            $this->db->set('userAvatarPath', NULL);
            $this->db->where('userId', $userId);
            $this->db->update('Users');
        }

        public function getMissionById($missionId){
            $this->db->select('*');
            $this->db->from('Mission');
            $this->db->join('Countries', 'Mission.missionCountryId = Countries.idCountry');
            $this->db->where('idMission', $missionId);
            $query = $this->db->get();
            return $query->row();
        }

        public function getCompanyForMission($missionId){
            $this->db->select('*');
            $this->db->from('Company');
            $this->db->join('Mission', 'Mission.missionCompanyId = Company.idCompany');
            $this->db->where('Mission.idMission', $missionId);
            $query = $this->db->get();
            return $query->row();
        }

        public function getMissionOfCompany($companyId){
            $this->db->select('*');
            $this->db->from('Mission');
            $this->db->join('Job', 'Job.jobId = Mission.missionJobId');
            $this->db->join('Countries', 'Countries.idCountry = Mission.missionCountryId');
            $this->db->where('missionCompanyId', $companyId);
            $query = $this->db->get();
            return $query->result();
        }


        public function getCompanyUser($companyId){
            $this->db->select('*');
            $this->db->from('Users');
            $this->db->where('userCompanyId', $companyId);
            $query = $this->db->get();
            return $query->result();
        }

        public function getAvatarPath($userId){
            $this->db->select('userAvatarPath');
            $this->db->from('Users');
            $this->db->where('userId', $userId);
            $query = $this->db->get();
            return $query->row()->userAvatarPath;
        }

        public function getMessageExamples(){
            $this->db->select('*');
            $this->db->from('MessageExamples');
            $query = $this->db->get();
            return $query->result();
        }
        

        public function getCompanyUserPhone($companyId){
            $this->db->select('Usertelephone');
            $this->db->from('Users');
            $this->db->where('userCompanyId', $companyId);
            $query = $this->db->get();
            return $query->result();
        }

        public function getWhatsAppGroups(){
            $this->db->select('*');
            $this->db->from('WhatsAppGroups');
            $query = $this->db->get();
            return $query->result();
        }

        public function insertWhatsAppGroup($whatsAppGroupName, $whatsAppGroupDescription, $whatsAppGroupLink, $whatsAppGroupImage){
            $this->db->set('whatsAppGroupName', $whatsAppGroupName);
            $this->db->set('whatsAppGroupDescription', $whatsAppGroupDescription);
            $this->db->set('whatsAppGroupLink', $whatsAppGroupLink);
            $this->db->set('whatsAppGroupImage', $whatsAppGroupImage);
            $this->db->insert('WhatsAppGroups');
        }

        public function getCompanyMissionId($missionId){
            $this->db->select('Missioncompanyid');
            $this->db->from('Mission');
            $this->db->where('idMission', $missionId);
            $query = $this->db->get();
            return $query->row()->missionCompanyId;
        }

        public function getMissionsavedMission($userId){
            $this->db->select('*');
            $this->db->from('Mission');
            $this->db->join('SavedMission', 'SavedMission.idMissionsavedMission = Mission.idMission');
            $this->db->join('Job', 'Job.jobId = Mission.missionJobId');
            $this->db->join('Countries', 'Countries.idCountry = Mission.missionCountryId');
            $this->db->where('SavedMission.idUsersavedMission', $userId);
            $query = $this->db->get();
            return $query->result();

        }

        public function getCompanyDataById($id) {
            $this->db->select('*');
            $this->db->from('Company');
            $this->db->join('Users', 'Users.userId = Company.companyUserId');
            $this->db->where('idCompany', $id);
            $query = $this->db->get();
            return $query->row();
        }
        
        public function getCompanyMissions($companyId) {
            $this->db->select('*');
            $this->db->from('Mission');
            $this->db->join('Job', 'Job.jobId = Mission.missionJobId');
            $this->db->join('Countries', 'Countries.idCountry = Mission.missionCountryId');
            $this->db->where('missionCompanyId', $companyId);
            $this->db->order_by('idMission', 'DESC');
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
                // Utilisez result() pour retourner un tableau d'objets contenant les résultats
                return $query->result();
            } else {
                // Retournez null si aucune donnée n'est trouvée
                return null;
            }
        }

        public function getCompanyAllPhotos($companyId){
            $this->db->select('*');
            $this->db->from('CompanyPhotos');
            $this->db->where('companyPhotos_companyId', $companyId);
            $query = $this->db->get();
            return $query->result();
        }

        public function get_skills($term=''){
            $this->db->like('SkillName', $term);
            $query = $this->db->get('Skills');
            return $query->result_array();
        }

        public function get_all_skills() {
            $query = $this->db->get('Skills'); 
            return $query->result_array();
        }

        public function get_all_secteurs() {
            $query = $this->db->get('Secteurs'); 
            return $query->result_array();
        }

        public function get_all_cities(){
            $query = $this->db->get('Geonames_cities');
            return $query->result_array();
        }
        public function get_all_countries(){
            $query = $this->db->get('Countries');
            return $query->result_array();
        }

        public function search_cities($term) {
            $escaped_term = $this->db->escape_str($term);
            
            // Sélectionner toutes les colonnes
            $this->db->select('*');
            $this->db->from('Geonames_cities');
        
            // Condition pour filtrer les villes qui contiennent le terme
            $this->db->like('name', $term);
            
            // Ordonner par priorité
            $this->db->order_by("
                CASE 
                    WHEN name LIKE '".$escaped_term."%' THEN 1 
                    WHEN name LIKE '%".$escaped_term."%' THEN 2 
                    ELSE 3 
                END, name", 'ASC');
            
            // Limiter les résultats (optionnel)
            $this->db->limit(10);
            
            $query = $this->db->get();
            return $query->result_array();
        }


        public function getRelevantMissions($userId) {
            $subQuerySkillMatch = "(SELECT COUNT(*) FROM UserSkills US 
                                    JOIN MissionSkills MS ON MS.missionSkills_skillId = US.userSkills_skillId 
                                    WHERE US.userSkills_userId = $userId 
                                    AND MS.missionSkills_missionId = M.idMission)";
        
            // Ajout de J.jobName, J.jobDescription et Countries.countryName à la sélection
            $this->db->select('M.*, J.jobName, C.*, ' . $subQuerySkillMatch . ' AS skillMatches, 
                               (100 * ' . $subQuerySkillMatch . ' + 
                               CASE WHEN M.missionTJM >= U.userTJM THEN 50 ELSE 0 END + 
                               CASE WHEN M.missionType = U.userJobType THEN 30 ELSE 0 END + 
                               CASE WHEN M.missionCountryId = C.idCountry THEN 20 ELSE 0 END + 
                               CASE WHEN M.missionExpertise = U.userSeniorite THEN 10 ELSE 0 END) AS RelevanceScore');
        
            $this->db->from('Mission M');
            
            // Jointure à gauche avec Users, Job et Countries
            $this->db->join('Users U', 'U.userId = ' . $userId, 'left');
            $this->db->join('Job J', 'M.missionJobId = J.jobId', 'left');
            $this->db->join('Countries C', 'M.missionCountryId = C.idCountry');  // Jointure avec la table Countries
            
            $this->db->group_by('M.idMission');
            
            $this->db->order_by('RelevanceScore', 'DESC');
            
            $query = $this->db->get();
            
            return $query->result();
        }
        
        

        public function userHasSkill($userId, $skillId) {
            $this->db->where('userSkills_userId', $userId);
            $this->db->where('userSkills_skillId', $skillId);
            $query = $this->db->get('UserSkills');
    
            return $query->num_rows() > 0;
        }

        public function addUserSkills($userId, $skillId, $level){
            $this->db->set('userSkills_userId', $userId);
            $this->db->set('userSkills_skillId', $skillId);
            $this->db->set('userSkillsExperience', $level);
            $this->db->insert('UserSkills');
        }

        public function deleteUserSkill($id, $userId){
            $this->db->where('userSkills_skillId', $id);
            $this->db->where('userSkills_userId', $userId);
            $this->db->delete('UserSkills');
        }

        public function getSkillIdByName($skillName) {
            $this->db->select('skillId');
            $this->db->from('Skills');
            $this->db->where('skillName', $skillName);
            $query = $this->db->get();
            return $query->row()->skillId;
        }

        public function editUserSkills($userId, $skillId, $skillLevel){
            $this->db->set('userSkillsExperience', $skillLevel);
            $this->db->where('userSkills_userId', $userId);
            $this->db->where('userSkills_skillId', $skillId);
            $this->db->update('UserSkills');
        }

        public function getJobs(){
            $this->db->select('*');
            $this->db->from('Job');
            $query = $this->db->get();
            return $query->result();
        }


        public function get_jobs($term=''){
            $this->db->like('jobName', $term);
            $query = $this->db->get('Job');
            return $query->result_array();
        }

        public function get_all_jobs() {
            $query = $this->db->get('Job'); // Remplacez 'skills' par le nom exact de votre table de compétences si ce n'est pas le cas.
            return $query->result_array();
        }
        
        public function getUserData($userId) {
            $this->db->where('userId', $userId);
            $query = $this->db->get('Users');
            return $query->row();
        }

        public function getBanner(){
            $this->db->select('*');
            $this->db->from('Banner');
            $query = $this->db->get();
            return $query->row();
        }

        public function updateUserDataSettings($userId, $userFirstName, $userLastName, $userTelephone){
            $this->db->set('userFirstName', $userFirstName);
            $this->db->set('userLastName', $userLastName);
            $this->db->set('userTelephone', $userTelephone);
            $this->db->where('userId', $userId);
            $this->db->update('Users');
        }

        public function updateUserPassword($userId, $userPassword){
            $this->db->set('userPassword', $userPassword);
            $this->db->where('userId', $userId);
            $this->db->update('Users');
        }

        public function checkPassword($userId, $password){
            $this->db->where('userId', $userId);
            $query = $this->db->get('users');
        
            if ($query->num_rows() == 1) {
                $userData = $query->row();
                return password_verify($password, $userData->userPassword);
            }
            return false;
        }

        // Kassim le 31/01/2021 : Requete pour récupérer getWelcomeMail($userId)

        public function getWelcomeMail($userId){
            $this->db->select('userWelcomeMail');
            $this->db->from('users');
            $this->db->where('userId', $userId);
            $query = $this->db->get();
            return $query->row();
        }

        public function updateWelcomeMail($userId){
            $this->db->set('userWelcomeMail', 'True');
            $this->db->where('userId', $userId);
            $this->db->update('Users');
        }

}
