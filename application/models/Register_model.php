<?php
class Register_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function checkEmailExists($email){
        $this->db->where('userEmail', $email);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
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

    public function RegisterUser($userEmail, $userPassword, $userType, $userFirstName, $userLastName, $userVille, $userTelephone, $userJobId, $userTJM, $userJobType, $userExpertise, $userJobTime, $userBio, $userIsAvailable, $userJobTimePartielOrFullTime){
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
            'userJobTimePartielOrFullTime' => $userJobTimePartielOrFullTime
        );
        $this->db->insert('users', $data);

        if ($this->db->affected_rows() > 0) {
            $userId = $this->db->insert_id();
    
            // Insertion dans la table userjob
            $userJobData = array(
                'userJob_userId' => $userId,
                'userJob_jobId' => $userJobId
            );
            $this->db->insert('userjob', $userJobData);
    
            if ($this->db->affected_rows() > 0) {
                return $userId;
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
        $this->db->update('users');
    }
    
    public function addUserSkills($userId, $skillId, $level){
        $this->db->set('userSkills_userId', $userId);
        $this->db->set('userSkills_skillId', $skillId);
        $this->db->set('userSkillsExperience', $level);
        $this->db->insert('userSkills');
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
        $query = $this->db->get('skills'); // Remplacez 'skills' par le nom exact de votre table de compétences si ce n'est pas le cas.
        return $query->result_array();
    }

    public function get_skills($term=''){
        $this->db->like('skillName', $term);
        $query = $this->db->get('skills');
        return $query->result_array();
    }
}
?>
