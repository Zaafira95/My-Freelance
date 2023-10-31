<?php
class Company_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function getUserData($userId) {
        $this->db->where('userId', $userId);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function get_freelancers(){
        $this->db->select('userId, userFirstName, userLastName, userEmail, userBio, userType, userJobId, userJobName, userJobType, userRemote, userJobTimePartielOrFullTime, userJobTime, userTJM, userTelephone, userAdresse, userVille, userPays, userCodePostal, userSkillsId, userSkill, userRatingAverage, userPortfolioLink, userLinkedinLink, userGithubLink, userDribbleLink, userBehanceLink, userExperienceYear, userSeniorite, userIsAvailable, userCreated, userModified, userAvatarPath, userExperienceId, userCertificationId, userSavedMissionId, userRatingId, userLoginCount, userCompanyId');
        $this->db->from('users');
        $this->db->where('userCompanyId', 0);
        $this->db->where('userType', 'freelance');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_freelancer_job($freelancerUserId) {
        $this->db->select('job.jobId, job.jobName, userJob.userJob_jobId, userJob.userJob_userId');
        $this->db->from('userJob');
        $this->db->join('job', 'userJob.userJob_userId = users.userId');
        $this->db->where('userSkills.userSkills_userId', $freelancerUserId);
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
        $query = $this->db->get('skills');
        return $query->result_array();
    }

    public function get_freelancer($id){
        $this->db->select('userId, userFirstName, userLastName, userEmail, userBio, userType, userJobId, userJobName, userJobType, userRemote, userJobTimePartielOrFullTime, userJobTime, userTJM, userTelephone, userAdresse, userVille, userPays, userCodePostal, userSkillsId, userSkill, userRatingAverage, userPortfolioLink, userLinkedinLink, userGithubLink, userDribbleLink, userBehanceLink, userExperienceYear, userSeniorite, userIsAvailable, userCreated, userModified, userAvatarPath, userExperienceId, userCertificationId, userSavedMissionId, userRatingId, userLoginCount, userCompanyId');
        $this->db->from('users');
        $this->db->where('userId', $id);
        $query = $this->db->get();
        return $query->row();

    }

    public function getRatingCountByUser($id){
        $this->db->select('COUNT(*) as total');
        $this->db->where('idRatedUser', $id);
        $query = $this->db->get('rating');
        return $query->row()->total;
    }

    public function getRaterUser($id){
        $this->db->select('*');
            $this->db->from('rating');
            $this->db->join('users', 'users.userId = rating.idUser');
            $this->db->where('idRatedUser', $id);
            $query = $this->db->get();
            return $query->result();
    }

    public function getRatingsByUser($id) {
        $this->db->select('AVG(r.ratingStars) AS ratingAverage, r.ratingStars, r.ratingComment, r.ratingDate, u.userId, u.userFirstName, u.userAvatarPath');
        $this->db->from('rating r');
        $this->db->join('users u', 'u.userId = r.idUser');
        $this->db->where('r.idRatedUser', $id);
        $this->db->group_by('r.ratingStars, r.ratingComment, r.ratingDate, u.userId, u.userFirstName, u.userAvatarPath');
        $this->db->order_by('r.ratingDate', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getJobNameForAUser($id){
        $this->db->select('jobName');
        $this->db->from('job');
        $this->db->join('userJob', 'userJob.userJob_jobId = job.jobId');
        $this->db->where('userJob_userId', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getUserSkillsAll($id) {
        $this->db->select('skills.skillId, skills.skillName, userSkills.userSkillsExperience');
        $this->db->from('userSkills');
        $this->db->join('skills', 'userSkills.userSkills_skillId = skills.skillId');
        $this->db->where('userSkills.userSkills_userId', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getUserExperience($id){
        $this->db->select('*');
        $this->db->from('experience');
        $this->db->where('experienceUserId', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getUserAttachement($id){
        $this->db->select('*');
        $this->db->from('attachment');
        $this->db->where('attachmentUserId', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_UserData($userId){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        return $query->row();
        
    }


    public function getJobWithId($companyJobs){
        $this->db->select('missionName');
        $this->db->from('mission');
        $this->db->where('idMission', $companyJobs);
        $query = $this->db->get();
        return $query->row();
    }

    public function getTjm($companyJobs){
        $this->db->select('missionTjm');
        $this->db->from('mission');
        $this->db->where('idMission', $companyJobs);
        $query = $this->db->get();
        return $query->row();
    }

    public function getUserTelephone($freelancerId){
        $this->db->select('userTelephone');
        $this->db->from('users');
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
    
        $this->db->insert('mission', $data);
        // Obtenez l'ID de la mission nouvellement créée
        $missionId = $this->db->insert_id();

        return $missionId; // Retournez l'ID de la mission
    }
    
    public function addMissionSkills($missionId, $skillId, $level){
        $this->db->set('missionSkills_missionId', $missionId);
        $this->db->set('missionSkills_skillId', $skillId);
        $this->db->set('missionSkillsExperience', $level);
        $this->db->insert('missionSkills');
    }

    public function get_all_jobs() {
        $query = $this->db->get('job'); // Remplacez 'skills' par le nom exact de votre table de compétences si ce n'est pas le cas.
        return $query->result_array();
    }

    public function get_jobs($term=''){
        $this->db->like('jobName', $term);
        $query = $this->db->get('job');
        return $query->result_array();
    }


    public function get_cities($term=''){
        $this->db->like('name', $term);
        $query = $this->db->get('geonames_cities');
        return $query->result_array();

    }

    public function get_all_cities(){
        $query = $this->db->get('geonames_cities');
        return $query->result_array();
    }

    public function get_all_skills() {
        $query = $this->db->get('skills'); // Remplacez 'skills' par le nom exact de votre table de compétences si ce n'est pas le cas.
        return $query->result_array();
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

    public function getMissionSkills($idMissions) {
        $this->db->select('skills.skillName, missionSkills.missionSkills_skillId, missionSkills.missionSkillsExperience');
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
    public function getCompanyUser($companyId){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('userCompanyId', $companyId);
        $query = $this->db->get();
        return $query->result();
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

    public function getFavoriteMissions($userId){
        $this->db->select('*');
        $this->db->from('savedMission');
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
        $this->db->update('mission', $data);

        // Supprimez d'abord les compétences existantes liées à cette mission
        $this->db->where('missionSkills_missionId', $missionId);
        $this->db->delete('missionSkills');
    }

    
    public function updateCompanyDescription($companyId, $companyDescription){
        $this->db->set('companyDescription', $companyDescription);
        $this->db->where('idCompany', $companyId);
        $this->db->update('company');
    }
    
    public function updateCompanyAdvantages($companyId, $companyAdvantages){
        $this->db->set('companyAdvantages', $companyAdvantages);
        $this->db->where('idCompany', $companyId);
        $this->db->update('company');
    }    

    public function updateCompanyData($companyId, $companyName, $companySlogan, $companySecteur){
        $this->db->set('companyName', $companyName);
        $this->db->set('companySlogan', $companySlogan);
        $this->db->set('companySecteur', $companySecteur);
        $this->db->where('idCompany', $companyId);
        $this->db->update('company');
    }
        
    public function updateBannerPath($companyId, $file_path){
        $this->db->set('companyBannerPath', $file_path);
        $this->db->where('idcompany', $companyId);
        $this->db->update('company');
    }
            
    public function updateLogoPath($companyId, $file_path){
        $this->db->set('companyLogoPath', $file_path);
        $this->db->where('idcompany', $companyId);
        $this->db->update('company');
    }
    
    public function getLogoPath($companyId) {
        $this->db->select('companyLogoPath');
        $this->db->where('idCompany', $companyId);
        $query = $this->db->get('company');
        return $query->row()->companyLogoPath;
    }
    
    public function getBannerPath($companyId) {
        $this->db->select('companyBannerPath');
        $this->db->where('idCompany', $companyId);
        $query = $this->db->get('company');
        return $query->row()->companyBannerPath;
    }
    

}
?>