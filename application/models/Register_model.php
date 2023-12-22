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

    public function RegisterUser($userEmail, $userPassword, $userFirstName, $userLastName, $userType, $relative_path, $userVille, $userJobName, $userTJM, $userSkill, $userJobId, $userIsAvailable){
        $data = array(
            'userEmail' => $userEmail,
            'userPassword' => $userPassword,
            'userFirstName' => $userFirstName,
            'userLastName' => $userLastName,
            'userType' => $userType,
            'userAvatarPath' => $relative_path,
            'userVille' => $userVille,
            'userJobName' => $userJobName,
            'userTJM' => $userTJM,
            'userSkill' => $userSkill,
            'userJobId' => $userJobId,
            'userIsAvailable' => $userIsAvailable
        );
        $this->db->insert('users', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else {
            return false;
        }
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
