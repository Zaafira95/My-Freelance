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
            if (password_verify($userPassword, $user->userPassword) && ($user->userIsActive == 1)) {
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

    public function savePasswordToken($userEmail, $resetPasswordToken, $expirationDate) {
        $this->db->where('userEmail', $userEmail);
        $query = $this->db->get('Users');
        $user = $query->row();

        if($user) {
            $this->db->set('userResetPasswordToken', $resetPasswordToken);
            $this->db->set('userResetPasswordTokenExpirationDate', $expirationDate);
            $this->db->where('userId', $user->userId);
            $this->db->update('Users');
            return true;
        }
        
        return false;
    }

    public function checkResetPasswordToken($token) {
        $this->db->where('userResetPasswordToken', $token);
        $query = $this->db->get('Users');

        if ($query->num_rows() == 1) {
            $user = $query->row();
            if ($this->db->affected_rows() > 0) {
                return $user->userEmail;
            }
            return $user->userEmail;
        }
        return false;
    }

    function getResetPasswordTokenExpirationDate($token){
        $this->db->where('userResetPasswordToken', $token);
        $query = $this->db->get('Users');

        if ($query->num_rows() == 1) {
            $user = $query->row();
            return $user->userResetPasswordTokenExpirationDate;
        }
        return false;
    }
    
    public function resetUserPassword($userEmail, $userPassword){
        $this->db->set('userPassword', $userPassword);
        $this->db->set('userResetPasswordToken', NULL);
        $this->db->where('userEmail', $userEmail);
        $this->db->update('Users');
    }
  
  public function activateAccount($activationToken) {
        $this->db->where('userActivationToken', $activationToken);
        $query = $this->db->get('Users');

        if ($query->num_rows() == 1) {
            $user = $query->row();
            $this->db->where('userId', $user->userId);
            $this->db->update('Users', ['userIsActive' => 1, 'userActivationToken' => NULL]);

            if ($this->db->affected_rows() > 0) {
                return true;
            }
        }
        return false;
    }
  
}

?>
