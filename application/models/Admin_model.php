<?php
//admin
class Admin_model extends CI_Model {
    
    public function get_Users(){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('userType', 'freelance');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_Companies(){
        $this->db->select('*');
        $this->db->from('company');
        // $this->db->where('userType', 'company');
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

    public function getMissions(){
        $this->db->select('*');
        $this->db->from('mission');
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

    public function getBanner(){
        $this->db->select('*');
        $this->db->from('banner');
        $query = $this->db->get();
        return $query->row();
    }

    public function addBanner($bannerTitle, $bannerStatus, $bannerMessage, $bannerCta, $bannerLink){
        $data = array(
            'bannerTitle' => $bannerTitle,
            'bannerStatus' => $bannerStatus,
            'bannerMessage' => $bannerMessage,
            'bannerCta' => $bannerCta,
            'bannerLink' => $bannerLink
        );
        $this->db->where('idBanner', 1);
        $this->db->update('banner', $data);
    }

}
