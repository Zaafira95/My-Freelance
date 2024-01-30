<?php
class Login_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function login($userEmail, $userPassword) {
        $this->db->where('userEmail', $userEmail);
        $query = $this->db->get('users');
        $user = $query->row();

        if ($user) {
            if (password_verify($userPassword, $user->userPassword) && ($user->userIsActive == 1)) {
                return $user;
            }
        }

        return false;
    }

    public function incrementLogin($userId) {
        $this->db->set('userLoginCount', 'userLoginCount+1', FALSE);
        $this->db->where('userId', $userId);
        $this->db->update('users');
    }

    public function getUserData($userId) {
        $this->db->where('userId', $userId);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function activateAccount($activationToken) {
        $this->db->where('userActivationToken', $activationToken);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            $user = $query->row();
            $this->db->where('userId', $user->userId);
            $this->db->update('users', ['userIsActive' => 1, 'userActivationToken' => NULL]);

            if ($this->db->affected_rows() > 0) {
                return true;
            }
        }
        return false;
    }
}
?>
