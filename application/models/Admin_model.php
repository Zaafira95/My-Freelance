<?php

class Admin_model extends CI_Model {
    
    public function get_Users(){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('userType', 'user');
        $query = $this->db->get();
        return $query->result();
    }

}
