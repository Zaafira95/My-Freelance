<?php
class Login_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function login($userEmail, $userPassword) {
        $this->db->where('userEmail', $userEmail);
        $query = $this->db->get('Users');
        $user = $query->row();

        if ($user) {
            if (password_verify($userPassword, $user->userPassword)) {
                return $user;
            }
        }

        return false;
    }

    public function incrementLogin($userId) {
        $this->db->set('userLoginCount', 'userLoginCount+1', FALSE);
        $this->db->where('userId', $userId);
        $this->db->update('Users');
    }

    public function getUserData($userId) {
        $this->db->where('userId', $userId);
        $query = $this->db->get('Users');
        return $query->row();
    }
}
?>
