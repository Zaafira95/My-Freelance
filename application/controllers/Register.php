<?php
class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Register_model');
    }

    public function index() {
        if ($this->session->userdata('userId')) {
            redirect('user');
        }
        $data['skillsAll'] = $this->Register_model->get_all_skills();
        $data['jobsAll'] = $this->Register_model->get_all_jobs();

        $this->load->view('register_view', $data);
    }

    public function checkEmailExists(){
        $email = $this->input->post('userEmail');

        if ($this->Register_model->checkEmailExists($email)) {
            // Email existe déjà
            echo json_encode(array('status' => 'error', 'message' => 'Cet email existe déjà.'));
        } else {
            // Email n'existe pas
            echo json_encode(array('status' => 'success', 'message' => ''));
        }
    }

    public function search_cities() {
        $term = $this->input->post('term');
        $this->load->model('Register_model');
        $cities = $this->Register_model->search_cities($term);
        echo json_encode($cities);
    }

    // Dans votre contrôleur, par exemple: Skills.php
    public function search_skills() {
        $term = $this->input->post('term');
        $this->load->model('Register_model'); 
        $skills = $this->Register_model->get_skills($term);
        echo json_encode($skills);
    }

    public function registerUser(){
        $this->load->model('Register_model');
        $userEmail = $this->input->post('userEmail');
        $userPassword = $this->input->post('userPassword');
        // hash password
        $userPassword = password_hash($userPassword, PASSWORD_DEFAULT);

        $userType = $this->input->post('userType');

        $userFirstName = $this->input->post('userFirstName');
        $userLastName = $this->input->post('userLastName');
        $userVille = $this->input->post('userVille');
        $userTelephone = $this->input->post('userTelephone');

        $userJobName = $this->input->post('jobsAll');
        $userJobName = implode(',', $userJobName);
        $userJobId = $this->Register_model->getJobId($userJobName);
        $userTJM = $this->input->post('userTJM');
        $userJobType = $this->input->post('userJobType');
        $userExpertise = $this->input->post('userExpertise');
        $userJobTime = $this->input->post('userJobTime');
        
        $userBio = $this->input->post('userBio');
        $userIsAvailable = $this->input->post('userIsAvailable');
        if ($userIsAvailable == 'on') {
            $userIsAvailable = 1;
        } else {
            $userIsAvailable = 0;
        }
        $userJobTimePartielOrFullTime = $this->input->post('userJobTimePartielOrFullTime');
        
        $skills = $this->input->post("skillsAll");
        $levels = $this->input->post("skillsLevel");

        $result = $this->Register_model->registerUser($userEmail, $userPassword, $userType, $userFirstName, $userLastName, $userVille, $userTelephone, $userJobId, $userTJM, $userJobType, $userExpertise, $userJobTime, $userBio, $userIsAvailable, $userJobTimePartielOrFullTime);


        if ($result !== false) {
            $userId = $result;

            // Vérifier si un fichier a été téléchargé
            if ($_FILES['avatar-upload']['name']) {
                // Créer un dossier pour chaque utilisateur avec son ID
                $userAvatarPath = 'assets/img/user/' . $userId . '/';
                if (!is_dir($userAvatarPath)) {
                    mkdir($userAvatarPath, 0777, true);
                }
        
                $config['upload_path'] = $userAvatarPath;
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048; // Taille maximale du fichier en kilo-octets
        
                $this->load->library('upload', $config);
        
                if (!$this->upload->do_upload('avatar-upload')) {
                    // Erreur lors du téléchargement du fichier
                    $error = $this->upload->display_errors();
                    echo "Erreur lors du téléchargement de l'avatar";
                    // Gérez l'erreur en conséquence
                } else {
                    // Téléchargement du fichier réussi
                    // Récupérer les informations sur le fichier téléchargé
                    $uploadData = $this->upload->data();
                    $userAvatarPath .= $uploadData['file_name'];
        
                    // Mettre à jour le chemin de l'avatar de l'utilisateur dans la base de données
                    $this->Register_model->addAvatarPath($userId, $userAvatarPath);        
                }
            }

            //if (!empty($skills)) {
            // Bouclez à travers les compétences et les niveaux associés
                for ($i = 0; $i < count($skills); $i++) {
                    $skillId = $skills[$i];
                    $level = $levels[$i];
                    $this->Register_model->addUserSkills($userId, $skillId, $level);
                }
            //}
            var_dump($skills);
            die;
        }

        if ($result) {
            // Enregistrement réussi
            $this->session->set_flashdata('message', 'Vous êtes bien enregistré. Connectez-vous pour accéder à votre compte.');
            $this->session->set_flashdata('status', 'success');
            $this->load->view('login_view');
        } else {
            // Erreur lors de l'enregistrement
            echo "Erreur lors de l'enregistrement";
        }
    }
}
?>