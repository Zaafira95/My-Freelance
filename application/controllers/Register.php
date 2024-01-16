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
        $data['secteursAll'] = $this->Register_model->get_all_secteurs();

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
    
    public function search_jobs() {
        $term = $this->input->post('term');
        $this->load->model('Register_model');
        $jobs = $this->Register_model->search_jobs($term);
        echo json_encode($jobs);
    }

    // Dans votre contrôleur, par exemple: Skills.php
    public function search_skills() {
        $term = $this->input->post('term');
        $this->load->model('Register_model'); 
        $skills = $this->Register_model->get_skills($term);
        echo json_encode($skills);
    }

    public function search_secteurs() {
        $term = $this->input->post('term');
        $this->load->model('Register_model');
        $jobs = $this->Register_model->search_secteurs($term);
        echo json_encode($jobs);
    }

    public function registerUser(){
        $this->load->model('Register_model');
        $userEmail = $this->input->post('userEmail');
        $userPassword = $this->input->post('userPassword');
        // hash password
        $userPassword = password_hash($userPassword, PASSWORD_DEFAULT);

        $userType = $this->input->post('userType');

        if($userType == 'freelance'){  
            $userFirstName = $this->input->post('userFirstName');
            $userLastName = $this->input->post('userLastName');
            $userTelephone = $this->input->post('userTelephone');
            $userVille = $this->input->post('userVille');
            $userEtranger = $this->input->post('userEtranger');
            $userVille = $userEtranger == 'on' ? "Étranger" : $userVille;

            $userJobName = $this->input->post('userJob');
            //$userJobName = implode(',', $userJobName);
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
            }
        }

        if($userType == 'sales') {
            $companyUserFirstName = $this->input->post('companyUserFirstName');
            $companyUserLastName = $this->input->post('companyUserLastName');
            $companyUserTelephone = $this->input->post('companyUserTelephone');

            $companyName = $this->input->post('companyName');
            $companyVille = $this->input->post('companyVille');
            $companyEtranger = $this->input->post('companyEtranger');
            $companyVille = $companyEtranger == 'on' ? "Étranger" : $companyVille;
            $companySlogan = $this->input->post('companySlogan');
            $companySecteur = $this->input->post('companySecteur');
            
            $companyDescription = $this->input->post('companyDescription');
            $companyAvantages = $this->input->post('companyAvantages');

            $result = $this->Register_model->registerCompany($userEmail, $userPassword, $userType, 
            $companyUserFirstName, $companyUserLastName, $companyUserTelephone, $companyName, $companyVille, 
            $companySlogan, $companySecteur, $companyDescription, $companyAvantages);

            $companyId = $result;

            $config = [
                'allowed_types' => 'jpg|jpeg|png',
                'max_size' => 2048, // Taille maximale du fichier en kilo-octets
            ];

            // Vérifier si un fichier a été téléchargé
            if ($_FILES['banner-upload']['name']) {
                // Créer un dossier pour chaque utilisateur avec son ID
                $companyBannerPath = 'assets/img/company/' . $companyId . '/banner/';
                if (!is_dir($companyBannerPath)) {
                    mkdir($companyBannerPath, 0777, true);
                }
        
                $config['upload_path'] = $companyBannerPath;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
        
                if (!$this->upload->do_upload('banner-upload')) {
                    // Erreur lors du téléchargement du fichier
                    $error = $this->upload->display_errors();
                    echo "Erreur lors du téléchargement de l'image";
                    // Gérez l'erreur en conséquence
                } else {
                    // Téléchargement du fichier réussi
                    // Récupérer les informations sur le fichier téléchargé
                    $uploadData = $this->upload->data();
                    
                    $companyBannerPath .= $uploadData['file_name'];
                    //$companyBannerPath="test";

                    // Mettre à jour le chemin de l'avatar de l'utilisateur dans la base de données
                    $this->Register_model->insertBannerPath($companyId, $companyBannerPath);
        
                }
            }

            // Vérifier si un fichier a été téléchargé
            if ($_FILES['companyLogo']['name']) {
                // Créer un dossier pour chaque utilisateur avec son ID
                $companyLogoPath = 'assets/img/company/' . $companyId . '/logo/';
                if (!is_dir($companyLogoPath)) {
                    mkdir($companyLogoPath, 0777, true);
                }

                $config['upload_path'] = $companyLogoPath;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
        
                if (!$this->upload->do_upload('companyLogo')) {
                    // Erreur lors du téléchargement du fichier
                    $error = $this->upload->display_errors();
                    echo "Erreur lors du téléchargement de l'image";
                } else {
                    // Téléchargement du fichier réussi
                    // Récupérer les informations sur le fichier téléchargé
                    $uploadData = $this->upload->data();
                    
                    $companyLogoPath .= $uploadData['file_name'];

                    // Mettre à jour le chemin de l'avatar de l'utilisateur dans la base de données
                    $this->Register_model->insertLogoPath($companyId, $companyLogoPath);
        
                }
            }
 
            // Vérifier si des fichiers ont été téléchargés
            if (!empty($_FILES['photo-upload']['name'][0])) {
                // Récupérer le chemin du dossier pour les photos de l'entreprise
                $companyPhotoPath = 'assets/img/company/' . $companyId . '/photos/';

                // Créer le dossier s'il n'existe pas encore
                if (!is_dir($companyPhotoPath)) {
                    mkdir($companyPhotoPath, 0777, true);
                }

                // Configuration pour le téléchargement du fichier
                $config['upload_path'] = $companyPhotoPath;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Itérer sur chaque fichier
                foreach ($_FILES['photo-upload']['name'] as $i => $name) {
                    if ($_FILES['photo-upload']['size'][$i] > 0) {
                        $_FILES['singleFile']['name'] = $_FILES['photo-upload']['name'][$i];
                        $_FILES['singleFile']['type'] = $_FILES['photo-upload']['type'][$i];
                        $_FILES['singleFile']['tmp_name'] = $_FILES['photo-upload']['tmp_name'][$i];
                        $_FILES['singleFile']['error'] = $_FILES['photo-upload']['error'][$i];
                        $_FILES['singleFile']['size'] = $_FILES['photo-upload']['size'][$i];

                        if (!$this->upload->do_upload('singleFile')) {
                            // Erreur lors du téléchargement du fichier
                            $error = $this->upload->display_errors();
                            echo "Erreur lors du téléchargement de l'image : " . $error;
                            // Gérez l'erreur en conséquence
                        } else {
                            // Téléchargement du fichier réussi
                            // Récupérer les informations sur le fichier téléchargé
                            $uploadData = $this->upload->data();
                            $companyPhotoName = $uploadData['file_name'];
                            $companyPhotoFullPath = $companyPhotoPath . $companyPhotoName;
                            
                            // Insérer le nouveau chemin de l'image dans la table 'companyphotos'
                            $this->Register_model->insertPhotoPath($companyId, $companyPhotoFullPath);
                        }
                    }
                }
            }

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