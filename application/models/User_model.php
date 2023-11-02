<?php

class User_model extends CI_Model {
    
    public function get_UserData($userId){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        return $query->row();
        
    }
    
    // Récupérer le job de l'utilisateur connecté avec le job id
    public function getUserJob($jobId){
        $this->db->select('*');
        $this->db->from('job');
        $this->db->where('jobId', $jobId);
        $query = $this->db->get();
        return $query->row();
    }

    
    // Recupérer toutes les expériences avec le user id
    public function getUserExperience($userId){
        $this->db->select('*');
        $this->db->from('experience');
        $this->db->where('experienceUserId', $userId);
        $query = $this->db->get();
        return $query->result();
    }

    // Recupérer toutes les compétences avec le user id
    public function getUserSkillsAll($userId) {
        $this->db->select('skills.skillId, skills.skillName, userSkills.userSkillsExperience');
        $this->db->from('userSkills');
        $this->db->join('skills', 'userSkills.userSkills_skillId = skills.skillId');
        $this->db->where('userSkills.userSkills_userId', $userId);
        $query = $this->db->get();
        return $query->result();
    }
    
    
    public function updateAvatarPath($userId, $file_path){
        $this->db->set('userAvatarPath', $file_path);
        $this->db->where('userId', $userId);
        $this->db->update('users');
    }

    public function updateUserAvailability($userId, $userAvailability, $userJobTimePartielOrFullTime){
        $this->db->set('userIsAvailable', $userAvailability);
        $this->db->set('userJobTimePartielOrFullTime', $userJobTimePartielOrFullTime);
        $this->db->where('userId', $userId);
        $this->db->update('users');
    }

    public function getAllMission(){
        $this->db->select('*');
        $this->db->from('mission');
        $query = $this->db->get();
        return $query->result();
    }

    public function getMissionSkills($idMissions) {
        $this->db->select('skills.skillName, skills.skillId, missionSkills.missionSkillsExperience');
        $this->db->from('missionSkills');
        $this->db->join('skills', 'missionSkills.missionSkills_skillId = skills.skillId');
        $this->db->where('missionSkills.missionSkills_missionId', $idMissions);
        $this->db->order_by('missionSkills.missionSkillsExperience', 'DESC'); // Tri par ordre décroissant
        $query = $this->db->get();
        return $query->result();
    }
    
    

    public function getCompanyMission($idMissions)
    {
        $this->db->select('company.companyName');
        $this->db->from('mission');
        $this->db->join('company', 'mission.missionCompanyId = company.idCompany');
        $this->db->where('mission.idMission', $idMissions);
        $query = $this->db->get();
        return $query->result();
    }

    public function addToFavorite($userId, $missionId, $companyMissionId){
        $data = array(
            'idUsersavedMission' => $userId,
            'idMissionsavedMission' => $missionId,
            'idCompanysavedMission' =>  $companyMissionId
        );
        $this->db->insert('savedMission', $data);
    }
    
    public function getFavoriteMissions($userId){
        $this->db->select('*');
        $this->db->from('savedMission');
        $this->db->where('idUsersavedMission', $userId);
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteFromFavorite($userId, $missionId){
        $this->db->where('idUsersavedMission', $userId);
        $this->db->where('idMissionsavedMission', $missionId);
        $this->db->delete('savedMission');
    }


    // public function getRatingsByUser($userId) {
    //     $this->db->select('AVG(ratingStars) AS ratingAverage, ratingStars, ratingComment, ratingDate');
    //     $this->db->where('idRatedUser', $userId);
    //     $this->db->group_by('ratingStars, ratingComment, ratingDate');
    //     $this->db->order_by('ratingDate', 'DESC');
    //     $query = $this->db->get('Rating');
    //     return $query->result();
    // }
    
        
      
      public function getRatingCountByUser($userId) {
        $this->db->select('COUNT(*) as total');
        $this->db->where('idRatedUser', $userId);
        $query = $this->db->get('rating');
        return $query->row()->total;
      }

      // get all the data of the user who rated the user currently connected you can pick data in user table with the idUser in rating table

        public function getRaterUser($userId) {
            $this->db->select('*');
            $this->db->from('rating');
            $this->db->join('users', 'users.userId = rating.idUser');
            $this->db->where('idRatedUser', $userId);
            $query = $this->db->get();
            return $query->result();
        }


        public function getRatingsByUser($userId) {
            $this->db->select('AVG(r.ratingStars) AS ratingAverage, r.ratingStars, r.ratingComment, r.ratingDate, u.userId, u.userFirstName, u.userAvatarPath');
            $this->db->from('rating r');
            $this->db->join('users u', 'u.userId = r.idUser');
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
            $this->db->set('userJobId', $jobId);
            $this->db->set('userExperienceYear', $userExperienceYear);
            $this->db->set('userTJM', $userTJM);
            $this->db->where('userId', $userId);
            $this->db->update('users');
        }

        public function updateUserPreference($userId, $userIsAvailable, $jobTypeString, $userVille, $userJobTime, $userJobTimePartielOrFullTime){
            $this->db->set('userIsAvailable', $userIsAvailable);
            $this->db->set('userJobType', $jobTypeString);
            $this->db->set('userVille', $userVille);
            $this->db->set('userJobTime', $userJobTime);
            $this->db->set('userJobTimePartielOrFullTime', $userJobTimePartielOrFullTime);
            $this->db->where('userId', $userId);
            $this->db->update('users');
        }

        public function updateUserLinks($userId, $userPortfolioLink, $userLinkedinLink, $userGithubLink, $userDribbleLink, $userBehanceLink){
            $this->db->set('userPortfolioLink', $userPortfolioLink);
            $this->db->set('userLinkedinLink', $userLinkedinLink);
            $this->db->set('userGithubLink', $userGithubLink);
            $this->db->set('userDribbleLink', $userDribbleLink);
            $this->db->set('userBehanceLink', $userBehanceLink);
            $this->db->where('userId', $userId);
            $this->db->update('users');
        }


        public function getUserJobType($userId){
            $this->db->select('userJobType');
            $this->db->from('users');
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
            $this->db->update('experience');
        }

        public function addUserExperience($userId, $userExperienceJob, $userExperienceCompany, $userExperienceDescription, $userExperienceDateDebut, $userExperienceDateFin){
            $this->db->set('experienceJob', $userExperienceJob);
            $this->db->set('experienceCompany', $userExperienceCompany);
            $this->db->set('experienceDescription', $userExperienceDescription);
            $this->db->set('experienceDateDebut', $userExperienceDateDebut);
            $this->db->set('experienceDateFin', $userExperienceDateFin);
            $this->db->set('experienceUserId', $userId);
            $this->db->insert('experience');
           
        }

        public function deleteUserExperience($experienceId) {
            // Supprimer les références à l'expérience dans la table "users"
            $this->db->where('userExperienceId', $experienceId);
            $this->db->update('users', array('userExperienceId' => NULL));
        
            // Supprimer l'expérience de la table "experience"
            $this->db->where('idExperience', $experienceId);
            $this->db->delete('experience');
        }

        public function getMissionDescription($missionId){
            $this->db->select('missionDescription');
            $this->db->from('mission');
            $this->db->where('idMission', $missionId);
            $query = $this->db->get();
            return $query->row()->missionDescription;
        }


        public function getUserSkills($userId){
            $this->db->select('userSkill'); // Ajout de la colonne userSkillsExperience
            $this->db->from('users');
            $this->db->where('userId', $userId);
            $query = $this->db->get();
            return $query->row()->userSkill;
        }

        // // get job id from job name

        public function getJobId($jobName) {
            $this->db->select('jobId');
            $this->db->from('job');
            $this->db->where('jobName', $jobName);
            $query = $this->db->get();
            return $query->row()->jobId;
        }


        public function getUserAttachement($userId){
            $this->db->select('*');
            $this->db->from('attachment');
            $this->db->where('attachmentUserId', $userId);
            $query = $this->db->get();
            return $query->result();
        }

        // Dans le modèle Attachment_model

        public function addAttachment($data)
        {
            $this->db->insert('attachment', $data);
            return $this->db->insert_id();
        }

        public function deleteUserAttachment($attachmentId) {
            $this->db->where('idAttachment', $attachmentId);
            $this->db->delete('attachment');
        } 

        public function deleteProfilPicture($userId){
            $this->db->set('userAvatarPath', NULL);
            $this->db->where('userId', $userId);
            $this->db->update('users');
        }

        public function getMissionById($missionId){
            $this->db->select('*');
            $this->db->from('mission');
            $this->db->where('idMission', $missionId);
            $query = $this->db->get();
            return $query->row();
        }

        public function getCompanyForMission($missionId){
            $this->db->select('*');
            $this->db->from('company');
            $this->db->join('mission', 'mission.missionCompanyId = company.idCompany');
            $this->db->where('mission.idMission', $missionId);
            $query = $this->db->get();
            return $query->row();
        }

        public function getMissionOfCompany($companyId){
            $this->db->select('*');
            $this->db->from('mission');
            $this->db->where('missionCompanyId', $companyId);
            $query = $this->db->get();
            return $query->result();
        }


        public function getCompanyUser($companyId){
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('userCompanyId', $companyId);
            $query = $this->db->get();
            return $query->result();
        }

        public function getAvatarPath($userId){
            $this->db->select('userAvatarPath');
            $this->db->from('users');
            $this->db->where('userId', $userId);
            $query = $this->db->get();
            return $query->row()->userAvatarPath;
        }

        public function getMessageExamples(){
            $this->db->select('*');
            $this->db->from('messageExamples');
            $query = $this->db->get();
            return $query->result();
        }
        

        public function getCompanyUserPhone($companyId){
            $this->db->select('userTelephone');
            $this->db->from('users');
            $this->db->where('userCompanyId', $companyId);
            $query = $this->db->get();
            return $query->result();
        }

        public function getWhatsAppGroups(){
            $this->db->select('*');
            $this->db->from('whatsAppGroups');
            $query = $this->db->get();
            return $query->result();
        }

        public function insertWhatsAppGroup($whatsAppGroupName, $whatsAppGroupDescription, $whatsAppGroupLink, $whatsAppGroupImage){
            $this->db->set('whatsAppGroupName', $whatsAppGroupName);
            $this->db->set('whatsAppGroupDescription', $whatsAppGroupDescription);
            $this->db->set('whatsAppGroupLink', $whatsAppGroupLink);
            $this->db->set('whatsAppGroupImage', $whatsAppGroupImage);
            $this->db->insert('whatsAppGroups');
        }

        public function getCompanyMissionId($missionId){
            $this->db->select('missionCompanyId');
            $this->db->from('mission');
            $this->db->where('idMission', $missionId);
            $query = $this->db->get();
            return $query->row()->missionCompanyId;
        }

        public function getMissionsavedMission($userId){
            $this->db->select('*');
            $this->db->from('mission');
            $this->db->join('savedMission', 'savedMission.idMissionsavedMission = mission.idMission');
            $this->db->where('savedMission.idUsersavedMission', $userId);
            $query = $this->db->get();
            return $query->result();

        }

        
        public function get_skills($term=''){
            $this->db->like('skillName', $term);
            $query = $this->db->get('skills');
            return $query->result_array();
        }

        public function get_all_skills() {
            $query = $this->db->get('skills'); // Remplacez 'skills' par le nom exact de votre table de compétences si ce n'est pas le cas.
            return $query->result_array();
        }
        
        public function get_all_cities(){
            $query = $this->db->get('geonames_cities');
            return $query->result_array();
        }

        public function search_cities($term) {
            $escaped_term = $this->db->escape_str($term);
            
            // Sélectionner toutes les colonnes
            $this->db->select('*');
            $this->db->from('geonames_cities');
        
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
            $subQuerySkillMatch = "(SELECT COUNT(*) FROM userSkills US JOIN missionSkills MS ON MS.missionSkills_skillId = US.userSkills_skillId WHERE US.userSkills_userId = $userId AND MS.missionSkills_missionId = M.idMission)";
            
            $this->db->select('M.*, ' . $subQuerySkillMatch . ' AS skillMatches, 
                             (100 * ' . $subQuerySkillMatch . ' + 
                             CASE WHEN M.missionTJM >= U.userTJM THEN 50 ELSE 0 END + 
                             CASE WHEN M.missionType = U.userJobType THEN 30 ELSE 0 END + 
                             CASE WHEN M.missionLocalisation = U.userVille THEN 20 ELSE 0 END + 
                             CASE WHEN M.missionExpertise = U.userSeniorite THEN 10 ELSE 0 END) AS RelevanceScore');
            
            $this->db->from('mission M');
            
            $this->db->join('users U', 'U.userId = ' . $userId, 'left');
            
            $this->db->group_by('M.idMission');
            
            $this->db->order_by('RelevanceScore', 'DESC');
            
            $query = $this->db->get();
            
            return $query->result();
        }

        public function userHasSkill($userId, $skillId) {
            $this->db->where('userSkills_userId', $userId);
            $this->db->where('userSkills_skillId', $skillId);
            $query = $this->db->get('userSkills');
    
            return $query->num_rows() > 0;
        }

        public function addUserSkills($userId, $skillId, $level){
            $this->db->set('userSkills_userId', $userId);
            $this->db->set('userSkills_skillId', $skillId);
            $this->db->set('userSkillsExperience', $level);
            $this->db->insert('userSkills');
        }

        public function deleteUserSkill($id, $userId){
            $this->db->where('userSkills_skillId', $id);
            $this->db->where('userSkills_userId', $userId);
            $this->db->delete('userSkills');
        }

        public function getSkillIdByName($skillName) {
            $this->db->select('skillId');
            $this->db->from('skills');
            $this->db->where('skillName', $skillName);
            $query = $this->db->get();
            return $query->row()->skillId;
        }

        public function editUserSkills($userId, $skillId, $skillLevel){
            $this->db->set('userSkillsExperience', $skillLevel);
            $this->db->where('userSkills_userId', $userId);
            $this->db->where('userSkills_skillId', $skillId);
            $this->db->update('userSkills');
        }

        public function getJobs(){
            $this->db->select('*');
            $this->db->from('job');
            $query = $this->db->get();
            return $query->result();
        }


        public function get_jobs($term=''){
            $this->db->like('jobName', $term);
            $query = $this->db->get('job');
            return $query->result_array();
        }

        public function get_all_jobs() {
            $query = $this->db->get('job'); // Remplacez 'skills' par le nom exact de votre table de compétences si ce n'est pas le cas.
            return $query->result_array();
        }
        
        public function getUserData($userId) {
            $this->db->where('userId', $userId);
            $query = $this->db->get('users');
            return $query->row();
        }

        public function getBanner(){
            $this->db->select('*');
            $this->db->from('banner');
            $query = $this->db->get();
            return $query->row();
        }
        
}
