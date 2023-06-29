<?php
class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        // Si l'utilisateur n'est pas connecté, redirigez-le vers le contrôleur "Login"
        if (!$this->session->userdata('userId')) {
            redirect('login');
        }

    }

    public function index() {
        $userId = $this->session->userdata('userId');
        $this->load->model('User_model');
        $user = $this->User_model->get_UserData($userId);

        // Récupérer le job de l'utilisateur connecté avec le job id
        $job = $this->User_model->getUserJob($user->userJobId);
        $data['job'] = $job;

        // Récupérer l'expérience de l'utilisateur connecté avec l'expérience id
        $experiences = $this->User_model->getUserExperience($user->userExperienceId);
        $data['experiences'] = $experiences;

        // Récupérer les compétences de l'utilisateur connecté avec les compétences id
        $skills = $this->User_model->getUserSkills($user->userId);
        $data['skills'] = $skills;

        // Récupérer toutes les missions
        $missions = $this->User_model->getAllMission();
        $data['missions'] = $missions;

        // Récupérer les skills de chaque mission
        $missionSkills = array();
        foreach ($missions as $mission) {
            $idMission = $mission->idMission;
            $missionSkills[$idMission] = $this->User_model->getMissionSkills($idMission);
        }
        $data['missionSkills'] = $missionSkills;

        // Récupérer les infos de l'entreprise par mission
        $missionCompany = array();
        foreach ($missions as $mission) {
            $idMission = $mission->idMission;
            $missionCompany[$idMission] = $this->User_model->getCompanyMission($idMission);
        }
        $data['missionCompany'] = $missionCompany;


        $favoriteMissions = $this->User_model->getFavoriteMissions($userId); // Remplacez cette ligne avec votre logique pour récupérer les missions favorites de l'utilisateur
        if (in_array($idMission, $favoriteMissions)) {
        } else {
        }

        $data['favoriteMissions'] = $favoriteMissions;

        $data['avatarPath'] = $user->userAvatarPath;

        $isAvailable = $user->userIsAvailable ;
        
        // Cocher la case appropriée en fonction de la valeur récupérée
        if ($isAvailable == 1) {
            $checkboxChecked = 'checked';
        } else {
            $checkboxChecked = '';
        }

        $data['checkboxChecked'] = $checkboxChecked;
                
        
        if ($user) {
            $data['user'] = $user;

            $this->load->view('user/index', $data);
        } else {
            echo "Erreur 1 lors de la récupération des informations de l'utilisateur";
        }
    }

    public function logout() {
        $this->session->unset_userdata('userId'); 
        redirect('login'); 
    }

    public function uploadAvatar()
    {
        $config['upload_path'] = 'assets/img/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // Taille maximale du fichier en kilo-octets
        $userId = $this->session->userdata('userId');
    
        $datetime = date("Y-m-d-H-i-s");
        $file_extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $file_name = $datetime . '_' . $file_extension;
        $file_name = $userId . '_' . $file_name;
        $relative_path = 'assets/img/' . $file_name;
    
        $this->load->library('upload', $config);
    
        if (!$this->upload->do_upload('avatar')) {
            // Erreur lors du téléchargement du fichier
            $error = $this->upload->display_errors();
            echo "Erreur lors du téléchargement de l'avatar";
            // Gérez l'erreur en conséquence
        } else {
            // Téléchargement du fichier réussi
            // Renommez le fichier téléchargé avec le bon nom dans le répertoire
            $upload_data = $this->upload->data();
            $new_file_path = $upload_data['file_path'] . $file_name;
            rename($upload_data['full_path'], $new_file_path);
    
            // Enregistrez le chemin relatif dans la base de données pour l'utilisateur actuel
            $userId = $this->session->userdata('userId');
            $this->load->model('User_model');
            $this->User_model->updateAvatarPath($userId, $relative_path);
    
            echo "Avatar téléchargé avec succès";
        }
    }
    


    public function updateAvailability(){
        $userId = $this->session->userdata('userId');
        $userAvailability = $this->input->post('userIsAvailable');
        if($userAvailability == "on"){
            $userAvailability = 1;
        }else{
            $userAvailability = 0;
        }
        $this->load->model('User_model');
        $this->User_model->updateUserAvailability($userId, $userAvailability);
        $this->session->set_flashdata('message', 'Votre disponibilité a bien été mise à jour !');
        $this->session->set_flashdata('status', 'success');
        redirect('user');
    }

    public function addToFavorite($missionId){
        $userId = $this->session->userdata('userId');
        $this->load->model('User_model');
        $this->User_model->addToFavorite($userId, $missionId);
        $this->session->set_flashdata('message', 'La mission a bien été ajoutée à vos favoris !');
        $this->session->set_flashdata('status', 'success');
        redirect('user');
    }

    public function isMissionFavorite($missionId){
        $userId = $this->session->userdata('userId');
        $favoriteMissions = $this->User_model->getFavoriteMissions($userId); // Remplacez cette ligne avec votre logique pour récupérer les missions favorites de l'utilisateur
        if (in_array($missionId, $favoriteMissions)) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false]);
        }
    }

    
    
}
?>
