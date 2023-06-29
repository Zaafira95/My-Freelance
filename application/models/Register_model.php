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

}
?>
