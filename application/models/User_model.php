<?php

class User_model extends CI_Model {
    
    public function get_UserData($userId){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        return $query->row();
        
    }
    
    // Récupérer le job de l'utilisateur connecté avec le job id
    public function getUserJob($jobId){
        $this->db->select('*');
        $this->db->from('job');
        $this->db->where('idJob', $jobId);
        $query = $this->db->get();
        return $query->row();
    }

    
    // Recupérer toutes les expériences avec le user id
    public function getUserExperience($userId){
        $this->db->select('*');
        $this->db->from('experience');
        $this->db->where('experienceUserId', $userId);
        $query = $this->db->get();
        return $query->result();
    }

    // Recupérer toutes les compétences avec le user id
    public function getUserSkills($userId){
        $this->db->select('Skills.skillName');
        $this->db->from('UserSkills');
        $this->db->join('Skills', 'UserSkills.userSkills_skillId = Skills.skillId');
        $this->db->where('UserSkills.userSkills_userId', $userId);
        $query = $this->db->get();
        return $query->result();
    }


    public function updateAvatarPath($userId, $file_path){
        $this->db->set('userAvatarPath', $file_path);
        $this->db->where('userId', $userId);
        $this->db->update('users');
    }

    public function updateUserAvailability($userId, $userAvailability){
        $this->db->set('userIsAvailable', $userAvailability);
        $this->db->where('userId', $userId);
        $this->db->update('users');
    }

    public function getAllMission(){
        $this->db->select('*');
        $this->db->from('mission');
        $query = $this->db->get();
        return $query->result();
    }

    public function getMissionSkills($idMissions){
        $this->db->select('Skills.skillName');
        $this->db->from('MissionSkills');
        $this->db->join('Skills', 'MissionSkills.missionSkills_skillId = Skills.skillId');
        $this->db->where('MissionSkills.missionSkills_missionId', $idMissions);
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

    public function addToFavorite($userId, $missionId){
        $data = array(
            'idUserSavedMission' => $userId,
            'idMissionSavedMission' => $missionId
        );
        $this->db->insert('SavedMission', $data);
    }
    
    public function getFavoriteMissions($userId){
        $this->db->select('*');
        $this->db->from('SavedMission');
        $this->db->where('idUserSavedMission', $userId);
        $query = $this->db->get();
        return $query->result();
    }


    
    



}
