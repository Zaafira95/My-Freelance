<?php
class Company_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    
    public function getUserData($userId) {
        $this->db->where('userId', $userId);
        $query = $this->db->get('Users');
        return $query->row();
    }

    public function get_freelancers(){
        $this->db->select('*');
        $this->db->from('Users');
        $this->db->where('userCompanyId', 0);
        $this->db->where('userType', 'freelance');
        // trier par disponibilité (userIsAvailable = 1 pour les freelances disponibles)
        $this->db->order_by('userIsAvailable', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_freelancer_job($freelancerUserId) {
        $this->db->select('Job.jobId, joJob.jobName, UserJob.userJob_jobId, UserJob.userJob_userId');
        $this->db->from('UserJob');
        $this->db->join('Job', 'UserJob.userJob_userId = Users.userId');
        $this->db->where('UserSkills.userSkills_userId', $freelancerUserId);
        $query = $this->db->get();
        return $query->result();
    }


    public function getJobByUserId($freelancerUserId) {
        $this->db->select('Job.jobName, Job.jobId');
        $this->db->from('Users');
        $this->db->join('UserJob', 'Users.userId = UserJob.userJob_userId'); 
        $this->db->join('Job', 'UserJob.userJob_jobId = Job.jobId');
        $this->db->where('Users.userId', $freelancerUserId);
        $query = $this->db->get();
        return $query->result();
    }

    // Select * From Company Where companyUserID = 1;
    public function getCompanyData($userId) {
        $this->db->select('*');
        $this->db->from('Company');
        $this->db->where('companyUserID', $userId);
        $query = $this->db->get();
        return $query->row();
    }

    public function getCompanyMissions($companyId) {
        $this->db->select('*');
        $this->db->from('Mission');
        $this->db->join('Job', 'Job.jobId = Mission.missionJobId');
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
    

    public function get_skills($term=''){
        $this->db->like('skillName', $term);
        $query = $this->db->get('Skills');
        return $query->result_array();
    }

    public function get_freelancer($id){
        $this->db->select('*');
        $this->db->from('Users');
        $this->db->where('userId', $id);
        $query = $this->db->get();
        return $query->row();

    }

    public function getRatingCountByUser($id){
        $this->db->select('COUNT(*) as total');
        $this->db->where('idRatedUser', $id);
        $this->db->where('ratingStatus', 1);
        $query = $this->db->get('Rating');
        return $query->row()->total;
    }
    
    public function getRatingCountByCompanyForAUser($idRatedUser, $idUser){
        $this->db->select('COUNT(*) as total');
        $this->db->where('idRatedUser', $idRatedUser);
        $this->db->where('idUser', $idUser);
        $query = $this->db->get('Rating');
        return $query->row()->total;
    }

    public function getRaterUser($id){
        $this->db->select('*');
            $this->db->from('Rating');
            $this->db->join('Users', 'Users.userId = Rating.idUser');

            $this->db->join('Company', 'Users.userId = Company.companyUserID');
            $this->db->where('idRatedUser', $id);
            $this->db->where('RatingStatus', 1);
            $query = $this->db->get();
            return $query->result();
    }

    public function getRatingsByUser($id) {
        $this->db->select('AVG(r.ratingStars) AS ratingAverage, r.ratingStars, r.ratingComment, r.ratingDate, u.userId, u.userFirstName, u.userAvatarPath');
        $this->db->from('Rating r');
        $this->db->join('Users u', 'u.userId = r.idUser');
        $this->db->where('r.idRatedUser', $id);
        $this->db->group_by('r.ratingStars, r.ratingComment, r.ratingDate, u.userId, u.userFirstName, u.userAvatarPath');
        $this->db->order_by('r.ratingDate', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteRating($ratingId) {
        $this->db->where('idRating', $ratingId);
        $this->db->delete('Rating');
    }

    public function addRating($userId, $ratedUserId, $ratingComment, $ratingStars, $ratingDate, $ratingStatus){
        $this->db->set('idUser', $userId);
        $this->db->set('idRatedUser', $ratedUserId);
        $this->db->set('ratingComment', $ratingComment);
        $this->db->set('ratingStars', $ratingStars);
        $this->db->set('ratingDate', $ratingDate);
        $this->db->set('ratingStatus', $ratingStatus);
        $this->db->insert('Rating');
    }

    public function getAllRatingsByCompany($id){
        $this->db->select('*');
            $this->db->from('Rating');
            $this->db->join('Users', 'Users.userId = Rating.idRatedUser');
            $this->db->where('idUser', $id);
            $this->db->order_by('Rating.ratingDate', 'DESC');
            $query = $this->db->get();
            return $query->result();
    }
    public function getJobNameForAUser($id){
        $this->db->select('jobName');
        $this->db->from('Job');
        $this->db->join('UserJob', 'UserJob.userJob_jobId = Job.jobId');
        $this->db->where('userJob_userId', $id);
        $query = $this->db->get();
        return $query->result();
    }
    

    public function getUserSkillsAll($id) {
        $this->db->select('Skills.skillId, Skills.skillName, UserSkills.userSkillsExperience');
        $this->db->from('UserSkills');
        $this->db->join('Skills', 'UserSkills.userSkills_skillId = Skills.skillId');
        $this->db->where('UserSkills.userSkills_userId', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getUserExperience($id){
        $this->db->select('*');
        $this->db->from('Experience');
        $this->db->where('experienceUserId', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getUserAttachement($id){
        $this->db->select('*');
        $this->db->from('Attachment');
        $this->db->where('attachmentUserId', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_UserData($userId){
        $this->db->select('*');
        $this->db->from('Users');
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        return $query->row();
        
    }


    public function getJobWithId($companyJobs){
        $this->db->select('missionName');
        $this->db->from('Mission');
        $this->db->where('idMission', $companyJobs);
        $query = $this->db->get();
        return $query->row();
    }

    public function getTjm($companyJobs){
        $this->db->select('missionTjm');
        $this->db->from('Mission');
        $this->db->where('idMission', $companyJobs);
        $query = $this->db->get();
        return $query->row();
    }

    public function getUserTelephone($freelancerId){
        $this->db->select('userTelephone');
        $this->db->from('Users');
        $this->db->where('userId', $freelancerId);
        $query = $this->db->get();
        return $query->result();
    }
    public function addMission($missionName, $missionTJM, $missionJobId, $missionExperience, $missionSkills, $missionLocation, $missionDescription, $missionAvantages, $missionType, $missionDeroulement, $missionDuration, $missionDateDebut, $missionDateFin, $missionCompanyId) {
        $data = array(
            'missionName' => $missionName,
            'missionTJM' => $missionTJM,
            'missionJobId' => $missionJobId,
            'missionExpertise' => $missionExperience,
            'missionSkills' => $missionSkills,
            'missionLocalisation' => $missionLocation,
            'missionDescription' => $missionDescription,
            'missionAvantage' => $missionAvantages,
            'missionType' => $missionType,
            'missionDuration' => $missionDuration,
            'missionDeroulement' => $missionDeroulement,
            'missionDateDebut' => $missionDateDebut,
            'missionDateFin' => $missionDateFin,
            'missionCompanyId' => $missionCompanyId
        );
    
        $this->db->insert('Mission', $data);
        // Obtenez l'ID de la mission nouvellement créée
        $missionId = $this->db->insert_id();

        return $missionId; // Retournez l'ID de la mission
    }
    
    public function addMissionSkills($missionId, $skillId, $level){
        $this->db->set('missionSkills_missionId', $missionId);
        $this->db->set('missionSkills_skillId', $skillId);
        $this->db->set('missionSkillsExperience', $level);
        $this->db->insert('MissionSkills');
    }

    public function get_all_jobs() {
        $query = $this->db->get('Job'); // Remplacez 'skills' par le nom exact de votre table de compétences si ce n'est pas le cas.
        return $query->result_array();
    }

    public function get_jobs($term=''){
        $this->db->like('jobName', $term);
        $query = $this->db->get('Job');
        return $query->result_array();
    }


    public function get_cities($term=''){
        $this->db->like('name', $term);
        $query = $this->db->get('Geonames_cities');
        return $query->result_array();

    }

    public function get_all_cities(){
        $query = $this->db->get('Geonames_cities');
        return $query->result_array();
    }

    public function get_all_skills() {
        $query = $this->db->get('Skills'); // Remplacez 'skills' par le nom exact de votre table de compétences si ce n'est pas le cas.
        return $query->result_array();
    }
    
    public function get_all_secteurs() {
        $query = $this->db->get('Secteurs'); // Remplacez 'skills' par le nom exact de votre table de compétences si ce n'est pas le cas.
        return $query->result_array();
    }


    public function getMissionById($missionId){
        $this->db->select('*');
        $this->db->from('Mission');
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
        $this->db->where('missionCompanyId', $companyId);
        $query = $this->db->get();
        return $query->result();
    }

    public function getMissionSkills($idMissions) {
        $this->db->select('Skills.skillName, MissionSkills.missionSkills_skillId, MissionSkills.missionSkillsExperience');
        $this->db->from('MissionSkills');
        $this->db->join('Skills', 'MissionSkills.missionSkills_skillId = Skills.skillId');
        $this->db->where('MissionSkills.missionSkills_missionId', $idMissions);
        $this->db->order_by('MissionSkills.missionSkillsExperience', 'DESC'); // Tri par ordre décroissant
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getExperienceSkills($idExperience) {
        $this->db->select('Skills.skillName, Skills.skillId, ExperienceSkills.experienceSkillsExpertise');
        $this->db->from('ExperienceSkills');
        $this->db->join('Skills', 'ExperienceSkills.experienceSkills_skillId = Skills.skillId');
        $this->db->where('ExperienceSkills.experienceSkills_experienceId', $idExperience);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getCompanyMission($idMissions)
    {
        $this->db->select('Company.companyName');
        $this->db->from('Mission');
        $this->db->join('Company', 'Mission.missionCompanyId = Company.idCompany');
        $this->db->where('Mission.idMission', $idMissions);
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

    public function getFavoriteMissions($userId){
        $this->db->select('*');
        $this->db->from('SavedMission');
        $this->db->where('idUsersavedMission', $userId);
        $query = $this->db->get();
        return $query->result();
    }


    public function editMission($missionId, $missionName, $missionTJM, $missionJobId, $missionExperience, $missionSkills, $missionLocation, $missionDescription, $missionAvantages, $missionType, $missionDeroulement, $missionDuration, $missionDateDebut, $missionDateFin) {
        // Mettez à jour les données de mission
        $data = array(
            'missionName' => $missionName,
            'missionTJM' => $missionTJM,
            'missionJobId' => $missionJobId,
            'missionExpertise' => $missionExperience,
            'missionSkills' => $missionSkills,
            'missionLocalisation' => $missionLocation,
            'missionDescription' => $missionDescription,
            'missionAvantage' => $missionAvantages,
            'missionType' => $missionType,
            'missionDuration' => $missionDuration,
            'missionDeroulement' => $missionDeroulement,
            'missionDateDebut' => $missionDateDebut,
            'missionDateFin' => $missionDateFin
        );

        $this->db->where('idMission', $missionId);
        $this->db->update('Mission', $data);

        // Supprimez d'abord les compétences existantes liées à cette mission
        $this->db->where('missionSkills_missionId', $missionId);
        $this->db->delete('MissionSkills');
    }

    public function deleteMission($missionId) {
        $this->db->where('missionSkills_missionId', $missionId);
        $this->db->delete('MissionSkills');
        
        $this->db->where('idMission', $missionId);
        $this->db->delete('Mission');
    }
    
    public function updateCompanyDescription($companyId, $companyDescription){
        $this->db->set('companyDescription', $companyDescription);
        $this->db->where('idCompany', $companyId);
        $this->db->update('Company');
    }
    
    public function updateCompanyAdvantages($companyId, $companyAdvantages){
        $this->db->set('companyAdvantages', $companyAdvantages);
        $this->db->where('idCompany', $companyId);
        $this->db->update('Company');
    }    

    public function updateCompanyData($companyId, $companyName, $companySlogan, $companySecteur, $companyLocalisation, $userId, $userLinkedinLink, $userTelephone, $companyWebsite){
        $this->db->set('companyName', $companyName);
        $this->db->set('companySlogan', $companySlogan);
        $this->db->set('companySecteur', $companySecteur);
        $this->db->set('companyLocalisation', $companyLocalisation);
        $this->db->set('companyWebsite', $companyWebsite);
        $this->db->where('idCompany', $companyId);
        $this->db->update('Company');
        
        $this->db->set('userTelephone', $userTelephone);
        $this->db->set('userLinkedinLink', $userLinkedinLink);
        $this->db->where('userId', $userId);
        $this->db->update('Users');

    }
        
    public function updateBannerPath($companyId, $file_path){
        $this->db->set('companyBannerPath', $file_path);
        $this->db->where('idcompany', $companyId);
        $this->db->update('Company');
    }
            
    public function updateLogoPath($companyId, $file_path){
        $this->db->set('companyLogoPath', $file_path);
        $this->db->where('idcompany', $companyId);
        $this->db->update('Company');
    }
    
    public function getLogoPath($companyId) {
        $this->db->select('companyLogoPath');
        $this->db->where('idCompany', $companyId);
        $query = $this->db->get('Company');
        return $query->row()->companyLogoPath;
    }
    
    public function getBannerPath($companyId) {
        $this->db->select('companyBannerPath');
        $this->db->where('idCompany', $companyId);
        $query = $this->db->get('Company');
        return $query->row()->companyBannerPath;
    }
    
    public function deletePhotoPath($id) {
        $this->db->where('idCompanyPhotos', $id);
        $this->db->delete('CompanyPhotos');
    }
    public function insertPhotoPath($companyId, $companyPhotoPath) {
        $data = array(
            'companyPhotosPath' => $companyPhotoPath,
            'companyPhotos_companyId' => $companyId
        );
        $this->db->insert('CompanyPhotos', $data);
    }
    
    public function getAllPhotos($companyId){
        $this->db->select('*');
        $this->db->from('CompanyPhotos');
        $this->db->where('companyPhotos_companyId', $companyId);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getPhotoPath($id){
        $this->db->select('companyPhotosPath');
        $this->db->where('idCompanyPhotos', $id);
        $query = $this->db->get('CompanyPhotos');
        return $query->row()->companyPhotosPath;
    }

    public function updatePhotoPath($id, $companyPhotoPath){
        $this->db->set('companyPhotosPath', $companyPhotoPath);
        $this->db->where('idCompanyPhotos', $id);
        $this->db->update('CompanyPhotos');
    }

    public function updateUserData($userId, $userFirstName, $userLastName, $userTelephone){
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

    public function getWhatsAppGroups(){
        $this->db->select('*');
        $this->db->from('WhatsAppGroups');
        $query = $this->db->get();
        return $query->result();
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

    
}
?>