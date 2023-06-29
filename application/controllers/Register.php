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
        $this->load->view('register_view');
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

    public function registerUser()
    {
        $config['upload_path'] = 'assets/img/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // Taille maximale du fichier en kilo-octets
    
        $this->load->library('upload', $config);
    
        if ($this->input->post()) {
            // get all information
            $userFirstName = $this->input->post('userFirstName');
            $datetime = date("Y-m-d-H-i-s");
            $file_extension = pathinfo($_FILES['avatar-upload']['name'], PATHINFO_EXTENSION);
            $file_name = $datetime . '_' . $file_extension;
            $file_name = $userFirstName . '_' . $file_name;
    
            $relative_path = 'assets/img/' . $file_name;
    
            if (!$this->upload->do_upload('avatar-upload')) {
                // Erreur lors du téléchargement du fichier
                $error = $this->upload->display_errors();
                echo "Erreur lors du téléchargement de l'avatar";
                // Gérez l'erreur en conséquence
            } else {
                // Téléchargement du fichier réussi
                $upload_data = $this->upload->data();
                $new_file_path = $upload_data['file_path'] . $file_name;
    
                // Renommez le fichier téléchargé avec le bon nom dans le répertoire
                rename($upload_data['full_path'], $new_file_path);
    
                // get other information
                $userEmail = $this->input->post('userEmail');
                $userPassword = $this->input->post('userPassword');
                // hash password
                $userPassword = password_hash($userPassword, PASSWORD_DEFAULT);
                $userLastName = $this->input->post('userLastName');
                $userType = $this->input->post('userType');
                $userVille = $this->input->post('userVille');
                $userJobName = $this->input->post('userJobName');
                $userTJM = $this->input->post('userTJM');
                $userSkill = $this->input->post('userSkill');
                $userJobId = 1;
                $userIsAvailable = $this->input->post('userIsAvailable');
                if ($userIsAvailable == 'on') {
                    $userIsAvailable = 1;
                } else {
                    $userIsAvailable = 0;
                }
    
                $result = $this->Register_model->registerUser($userEmail, $userPassword, $userFirstName, $userLastName, $userType, $relative_path, $userVille, $userJobName, $userTJM, $userSkill, $userJobId, $userIsAvailable);
    
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
    }
    

}
?>
