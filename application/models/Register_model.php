<?php
class Register_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function checkEmailExists($email){
        $this->db->where('userEmail', $email);
        $query = $this->db->get('Users');
        return $query->num_rows() > 0;
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
        $this->db->limit(5);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function search_jobs($term) {
        $escaped_term = $this->db->escape_str($term);
        
        // Sélectionner toutes les colonnes
        $this->db->select('*');
        $this->db->from('Job');
    
        // Condition pour filtrer les villes qui contiennent le terme
        $this->db->like('jobName', $term);
        
        // Ordonner par priorité
        $this->db->order_by("
            CASE 
                WHEN jobName LIKE '".$escaped_term."%' THEN 1 
                WHEN jobName LIKE '%".$escaped_term."%' THEN 2 
                ELSE 3 
            END, jobName", 'ASC');
        
        // Limiter les résultats (optionnel)
        $this->db->limit(10);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function search_secteurs($term) {
        $escaped_term = $this->db->escape_str($term);
        
        // Sélectionner toutes les colonnes
        $this->db->select('*');
        $this->db->from('Secteurs');
    
        // Condition pour filtrer les villes qui contiennent le terme
        $this->db->like('secteurName', $term);
        
        // Ordonner par priorité
        $this->db->order_by("
            CASE 
                WHEN secteurName LIKE '".$escaped_term."%' THEN 1 
                WHEN secteurName LIKE '%".$escaped_term."%' THEN 2 
                ELSE 3 
            END, secteurName", 'ASC');
        
        // Limiter les résultats (optionnel)
        $this->db->limit(10);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function registerUser($userEmail, $userPassword, $userType, $userFirstName, $userLastName, $userVille, $userTelephone, $userJobId, $userTJM, $userJobType, $userExpertise, $userJobTime, $userBio, $userIsAvailable, $userJobTimePartielOrFullTime, $dateFinIndisponibilite, $activationToken){
        $data = array(
            'userEmail' => $userEmail,
            'userPassword' => $userPassword,
            'userType' => $userType,
            'userFirstName' => $userFirstName,
            'userLastName' => $userLastName,
            'userVille' => $userVille,
            'userTelephone' => $userTelephone,
            'userTJM' => $userTJM,
            'userJobType' => $userJobType,
            'userExperienceYear' => $userExpertise,
            'userJobTime' => $userJobTime,
            'userBio' => $userBio,
            'userIsAvailable' => $userIsAvailable,
            'userJobTimePartielOrFullTime' => $userJobTimePartielOrFullTime,
            'userDateFinIndisponibilite' => $dateFinIndisponibilite, 
            'userActivationToken' => $activationToken
        );
        $this->db->insert('Users', $data);

        if ($this->db->affected_rows() > 0) {
            $userId = $this->db->insert_id();
    
            // Insertion dans la table userjob
            $userJobData = array(
                'userJob_userId' => $userId,
                'userJob_jobId' => $userJobId
            );
            $this->db->insert('UserJob', $userJobData);
    
            if ($this->db->affected_rows() > 0) {
                return $userId;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function registerCompany($userEmail, $userPassword, $userType, 
    $companyUserFirstName, $companyUserLastName, $companyUserTelephone, $companyName, $companyVille, 
    $companySlogan, $companySecteur, $companyDescription, $companyAvantages, $activationToken){
        
        $data = array(
            'userEmail' => $userEmail,
            'userPassword' => $userPassword,
            'userType' => $userType,
            'userFirstName' => $companyUserFirstName,
            'userLastName' => $companyUserLastName,
            'userTelephone' => $companyUserTelephone,
            'userActivationToken' => $activationToken
        );
        $this->db->insert('Users', $data);

        if ($this->db->affected_rows() > 0) {
            $companyUserId = $this->db->insert_id();

            $data = array(
                'companyName' => $companyName,
                'companyLocalisation' => $companyVille,
                'companySlogan' => $companySlogan,
                'companySecteur' => $companySecteur,
                'companyDescription' => $companyDescription,
                'companyAdvantages' => $companyAvantages,
                'companyUserId' => $companyUserId
            );
            $this->db->insert('Company', $data);

            $companyId = $this->db->insert_id();
            
            $this->db->set('userCompanyId', $companyId);
            $this->db->where('userId', $companyUserId);
            $this->db->update('Users');

            if ($this->db->affected_rows() > 0) {
                return $companyId;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function addAvatarPath($userId, $file_path){
        $this->db->set('userAvatarPath', $file_path);
        $this->db->where('userId', $userId);
        $this->db->update('Users');
    }
    
    public function getJobId($jobName) {
        $this->db->select('jobId');
        $this->db->from('Job');
        $this->db->where('jobName', $jobName);
        $query = $this->db->get();
        return $query->row()->jobId;
    }

    public function get_all_jobs() {
        $query = $this->db->get('Job'); // Remplacez 'skills' par le nom exact de votre table de compétences si ce n'est pas le cas.
        return $query->result_array();
    }

    public function get_all_skills() {
        $query = $this->db->get('Skills'); // Remplacez 'skills' par le nom exact de votre table de compétences si ce n'est pas le cas.
        return $query->result_array();
    }
    
    public function get_all_secteurs() {
        $this->db->order_by('secteurName', 'ASC');
        $query = $this->db->get('Secteurs'); // Remplacez 'skills' par le nom exact de votre table de compétences si ce n'est pas le cas.
        // order by secteurName asc
        return $query->result_array();
    }

    public function get_skills($term=''){
        $this->db->like('skillName', $term);
        $query = $this->db->get('Skills');
        return $query->result_array();
    }

    public function insertBannerPath($companyId, $companyBannerPath) {
        $this->db->set('companyBannerPath', $companyBannerPath);
        $this->db->where('idcompany', $companyId);
        $this->db->update('Company');
    }

    public function insertLogoPath($companyId, $companyLogoPath) {
        $this->db->set('companyLogoPath', $companyLogoPath);
        $this->db->where('idcompany', $companyId);
        $this->db->update('Company');
    }

    public function insertPhotoPath($companyId, $companyPhotoPath) {
        $data = array(
            'companyPhotosPath' => $companyPhotoPath,
            'companyPhotos_companyId' => $companyId
        );
        $this->db->insert('CompanyPhotos', $data);
    }
}
?>
