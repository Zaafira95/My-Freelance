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
        $jobUser = $this->User_model->getUserJob($userId);
        $data['jobUser'] = $jobUser;
        // Récupérer l'expérience de l'utilisateur connecté avec l'expérience id
        $experiences = $this->User_model->getUserExperience($userId);
        $data['experiences'] = $experiences;

        // Récupérer les compétences de l'utilisateur connecté avec les compétences id
        $skills = $this->User_model->getUserSkillsAll($user->userId);
        $data['skills'] = $skills;

        // Récupérer toutes les missions
        $missions = $this->User_model->getAllMission();
        $data['missions'] = $missions;

        $missionsPerso = $this->User_model->getRelevantMissions($userId);
        $data['missionsPerso'] = $missionsPerso;

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

        $attachments = $this->User_model->getUserAttachement($userId);
        $data['attachments'] = $attachments;
                
        $data['skillsAll'] = $this->User_model->get_all_skills();

        $data['jobsAll'] = $this->User_model->get_all_jobs();

        $data['countriesAll'] = $this->User_model->get_all_countries();
        
        $userData = $this->User_model->getUserData($user->userId);

        $banner = $this->User_model->getBanner();
		$data['banner'] = $banner;

        if ($user) {

            if ($userData->userCompanyId != 0) {
                redirect('company');
            } else {
                $data['user'] = $user;
                $this->load->view('user/index', $data);
            }
            $data['user'] = $user;
            $welcome_mail = $user->userWelcomeMail;

            if ($user->userLoginCount == 1 && $welcome_mail == "False") {

                $this->load->library('email');
                $this->email->from('no-reply@cafe-creme.agency', 'My Freelance');
                $this->email->to($user->userEmail); // Assurez-vous d'utiliser l'email de l'utilisateur
                $this->email->subject('Welcome to My Freelance 👋🏻');
                $profileComplete = base_url();
                $data['profileComplete'] = $profileComplete;
                $data['userFirstName'] = $user->userFirstName;
                $data['userLastName'] = $user->userLastName;
                $body = $this->load->view('email/welcome_email_freelance', $data, TRUE);
                $this->email->set_mailtype("html");
                $this->email->message($body);
                $this->email->send();
                $this->load->model('User_model');
                $this->User_model->updateWelcomeMail($userId);
            }
    
        }
        else {
            // echo "Erreur 1 lors de la récupération des informations de l'utilisateur";
        }
    }


    

    public function logout() {
        $this->session->unset_userdata('userId'); 
        redirect('login'); 
    }

    public function uploadAvatar() {
        $config['upload_path'] = 'assets/img/user/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // Taille maximale du fichier en kilo-octets
        $userId = $this->session->userdata('userId');
    
        $datetime = date("Y-m-d-H-i-s");
        $file_extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $file_name = $datetime . '_' . $file_extension;
        $file_name = $userId . '_' . $file_name;
        $relative_path = 'assets/img/user/' . $file_name;
    
        $this->load->library('upload', $config);
    
        if (!$this->upload->do_upload('avatar')) {
            // Erreur lors du téléchargement du fichier
            $error = $this->upload->display_errors();
            // echo "Erreur lors du téléchargement de l'avatar";
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
    
            // echo "Avatar téléchargé avec succès";
        }
    }

    // Zaafira 24/01/2024 : modification fonction updateAvailability
    public function updateAvailability(){
        $userId = $this->session->userdata('userId');
        $userAvailability = $this->input->post('userIsAvailable');
        if($userAvailability == "on"){
            $userAvailability = 1;
        }else{
            $userAvailability = 0;
        }

        $userJobTimePartielOrFullTime = $this->input->post('userJobTimePartielOrFullTime');
        $dateFinIndisponibilite = $this->input->post('dateFinIndisponibilite');

        $this->load->model('User_model');
        $this->User_model->updateUserAvailability($userId, $userAvailability, $userJobTimePartielOrFullTime, $dateFinIndisponibilite);
        $this->session->set_flashdata('message', 'Your availability has been successfully updated!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function profil(){
        $userId = $this->session->userdata('userId');
        $this->load->model('User_model');
        $user = $this->User_model->get_UserData($userId);
        if ($user->userCompanyId != 0) {
            redirect('company');
        }
        $data['user'] = $user;

         // Récupérer le job de l'utilisateur connecté avec le job id
         $job = $this->User_model->getUserJob($userId);
         $data['job'] = $job;

         // Récupérer le pays de l'utilisateur connecté avec le job id
         $country = $this->User_model->getUserCountry($userId->userCountryId);
         $data['userCountry'] = $country;
 
         // Récupérer l'expérience de l'utilisateur connecté avec l'expérience id
         $experiences = $this->User_model->getUserExperience($userId);
         $data['experiences'] = $experiences;

        // Récupérer les skills de chaque experience
        $experienceSkills = array();
        foreach ($experiences as $experience) {
            $idExperience = $experience->idExperience;
            $experienceSkills[$idExperience] = $this->User_model->getExperienceSkills($idExperience);
        }
        $data['experienceSkills'] = $experienceSkills;
 
         // Récupérer les compétences de l'utilisateur connecté avec les compétences id
         $skills = $this->User_model->getUserSkillsAll($user->userId);
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


        // $ratings = $this->User_model->getRatingsByUser($userId);
        // $data['ratings'] = $ratings;
        $ratingCount = $this->User_model->getRatingCountByUser($userId);
        $data['ratingCount'] = $ratingCount;

        // $raterUser = $this->User_model->getRaterUser($userId);
        // $data['raterUser'] = $raterUser;

        $raterUser = $this->User_model->getRaterUser($userId);
        $ratings = $this->User_model->getRatingsByUser($userId);
        $data['raterUser'] = $raterUser;
        $data['ratings'] = $ratings;

        $isAvailable = $user->userIsAvailable ;
        
        // Cocher la case appropriée en fonction de la valeur récupérée
        if ($isAvailable == 1) {
            $checkboxChecked = 'checked';
        } else {
            $checkboxChecked = '';
        }
        $data['checkboxChecked'] = $checkboxChecked;
        $attachments = $this->User_model->getUserAttachement($userId);
        $data['attachments'] = $attachments;

        $data['skillsAll'] = $this->User_model->get_all_skills();

        $data['jobsAll'] = $this->User_model->get_all_jobs();

        $this->load->view('user/profil', $data);
    }

    
    public function updateUserData() {
        $this->load->model('User_model');
    
        $userId = $this->session->userdata('userId');
        $userFirstName = $this->input->post('userFirstName');
        $userLastName = $this->input->post('userLastName');
        $userTelephone = $this->input->post('userTelephone');
        $userJobName = $this->input->post('jobsAll');
        $userExpertise = $this->input->post('userExpertise');
        $userTJM = $this->input->post('userTJM');

        // $userJobName is an array convert it to string 
        $userJobName = implode(',', $userJobName);
        //$userExpertise = implode(',', $userExpertise);

        $jobId = $this->User_model->getJobId($userJobName);

        // Vérifier si un fichier a été téléchargé
        if ($_FILES['avatar-upload']['name']) {
            // Créer un dossier pour chaque utilisateur avec son ID
            $userAvatarPath = 'assets/img/user/' . $userId . '/';
            if (!is_dir($userAvatarPath)) {
                mkdir($userAvatarPath, 0777, true);
            }

            // Récupérer le chemin de l'avatar de l'utilisateur à partir de la base de données
            $existinguUerAvatarPath = $this->User_model->getAvatarPath($userId);

            // Vérifier si le fichier existe et le supprimer
            if (file_exists($existinguUerAvatarPath)) {
                unlink($existinguUerAvatarPath); // Supprimer le fichier
            }
    
            $config['upload_path'] = $userAvatarPath;
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // Taille maximale du fichier en kilo-octets
    
            $this->load->library('upload', $config);
    
            if (!$this->upload->do_upload('avatar-upload')) {
                // Erreur lors du téléchargement du fichier
                $error = $this->upload->display_errors();
                // echo "Erreur lors du téléchargement de l'avatar";
                // Gérez l'erreur en conséquence
            } else {
                // Téléchargement du fichier réussi
                // Récupérer les informations sur le fichier téléchargé
                $uploadData = $this->upload->data();
                $userAvatarPath .= $uploadData['file_name'];
    
                // Mettre à jour le chemin de l'avatar de l'utilisateur dans la base de données
                $this->User_model->updateAvatarPath($userId, $userAvatarPath);
    
                // echo "Avatar téléchargé avec succès";
            }
        }
       
    
        // Mettre à jour les autres données de l'utilisateur dans la base de données
        $this->User_model->updateUserData($userId, $userFirstName, $userLastName, $userTelephone, $jobId, $userExpertise, $userTJM);
    
        $this->session->set_flashdata('message', 'Your information has been successfully updated!');
        $this->session->set_flashdata('status', 'success');
    
        // Recharger la page actuelle
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function updateUserBio(){
        $this->load->model('User_model');
        $userId = $this->session->userdata('userId');
        $userBio = $this->input->post('userBio');

        $this->User_model->updateUserBio($userId, $userBio);
        $this->session->set_flashdata('message', 'Your description has been successfully updated!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
       
    }

    public function updateUserPreference(){
        $this->load->model('User_model');
        $userId = $this->session->userdata('userId');
        $userIsAvailable = $this->input->post('userIsAvailable');
        $userIsAvailable = $userIsAvailable == 'on' ? 1 : 0;
        
        $userJobType = $this->input->post('userJobType');
        
        /*if (is_array($userJobType) && in_array('Remote', $userJobType)) {
        }
        if (is_array($userJobType) && in_array('Physique', $userJobType)) {
        }*/
        //$jobTypeString = implode(',', $userJobType);
        $userVille = $this->input->post('userVille');
        
        $userEtranger = $this->input->post('userEtranger');
        $userVille = $userEtranger == 'on' ? "Etranger" : $userVille;

        $userJobTime = $this->input->post('userJobTime');

        $userJobTimePartielOrFullTime = $this->input->post('userJobTimePartielOrFullTime');
        $dateFinIndisponibilite = $this->input->post('dateFinIndisponibilite');

        $this->User_model->updateUserPreference($userId, $userIsAvailable, $userJobType, $userVille, $userJobTime, $userJobTimePartielOrFullTime, $dateFinIndisponibilite);
        $this->session->set_flashdata('message', 'Your preferences have been successfully updated!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
        
    }

    public function updateUserLinks(){
        $this->load->model('User_model');
        $userId = $this->session->userdata('userId');
        $userPortfolioLink = $this->input->post('userPortfolioLink');
        $userLinkedinLink = $this->input->post('userLinkedinLink');
        $userGithubLink = $this->input->post('userGithubLink');
        $userDribbleLink = $this->input->post('userDribbleLink');
        $userBehanceLink = $this->input->post('userBehanceLink');

        $this->User_model->updateUserLinks($userId, $userPortfolioLink, $userLinkedinLink, $userGithubLink, $userDribbleLink, $userBehanceLink);
        $this->session->set_flashdata('message', 'Your links have been successfully updated!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
       
    }

    public function updateUserExperience($experienceId) {
        $this->load->model('User_model');
        $userId = $this->session->userdata('userId');
        $userExperienceJob = $this->input->post('userExperienceJob');
        $userExperienceCompany = $this->input->post('userExperienceCompany');
        $userExperienceDescription = $this->input->post('userExperienceDescription');
        $userExperienceDateDebut = $this->input->post('userExperienceDateDebut');
        $userExperienceDateFin = $this->input->post('userExperienceDateFin');
        
        // $updateUserExperienceDateFinToday = $this->input->post('userEtranger');
        // $userExperienceDateFin = $updateUserExperienceDateFinToday == 'on' ? "Aujourd'hui" : $userExperienceDateFin;
        
        $this->User_model->updateUserExperience($experienceId, $userId, $userExperienceJob, $userExperienceCompany, $userExperienceDescription, $userExperienceDateDebut, $userExperienceDateFin);
        $skills = $this->input->post("skillsAll");
        $levels = $this->input->post("skillsLevel");
        
        // Bouclez à travers les compétences et les niveaux associés
        $this->User_model->deleteUserExperienceSkills($experienceId);
        if(!empty($skills)){
            for ($i = 0; $i < count($skills); $i++) {
                $skillId = $skills[$i];
                $level = $levels[$i];

                // Ajoutez les compétences de mission à la table missionSkills
                $this->User_model->updateUserExperienceSkills($experienceId, $skillId, $level);
            }
        }
        $this->session->set_flashdata('message', 'Your experience has been successfully updated!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function addUserExperience(){
        $this->load->model('User_model');
        $userId = $this->session->userdata('userId');
        $userExperienceJob = $this->input->post('userExperienceJob');
        $userExperienceCompany = $this->input->post('userExperienceCompany');
        $userExperienceDescription = $this->input->post('userExperienceDescription');
        $userExperienceDateDebut = $this->input->post('userExperienceDateDebut');
        $userExperienceDateFin = $this->input->post('userExperienceDateFin');
        
        $experienceId = $this->User_model->addUserExperience($userId, $userExperienceJob, $userExperienceCompany, $userExperienceDescription, $userExperienceDateDebut, $userExperienceDateFin);
        $skills = $this->input->post("skillsAll");
        $levels = $this->input->post("skillsLevel");
        
        // Bouclez à travers les compétences et les niveaux associés
        //$this->User_model->deleteUserExperienceSkills($experienceId);
        if(!empty($skills)){
            for ($i = 0; $i < count($skills); $i++) {
                $skillId = $skills[$i];
                $level = $levels[$i];

                // Ajoutez les compétences de mission à la table missionSkills
                $this->User_model->updateUserExperienceSkills($experienceId, $skillId, $level);
            }
        }
        $this->session->set_flashdata('message', 'Your experience has been successfully added!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);


    }
    

    public function deleteUserExperience($experienceId){
        $this->load->model('User_model');
        $this->User_model->deleteUserExperience($experienceId);
        $this->session->set_flashdata('message', 'Your experience has been successfully deleted!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
    }
//test

    public function addUserAttachment(){
        $userId = $this->session->userdata('userId');
        $userAttachmentPath = 'assets/attachments/' . $userId . '/';
        if (!is_dir($userAttachmentPath)) {
            mkdir($userAttachmentPath, 0777, true);
        }
        $config['upload_path'] = $userAttachmentPath;
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 2048; // Taille maximale du fichier en kilo-octets

        $this->load->library('upload', $config);

        // Vérifier la taille du fichier avant l'upload
        $file_size = $_FILES['userAttachmentFile']['size']; // Récupérer la taille du fichier en octets
        $max_file_size = 2048 * 1024; // Convertir la taille maximale en octets (2048 Ko)

        if ($file_size > $max_file_size) {
            // Le fichier est trop lourd, afficher un message d'erreur
            $this->session->set_flashdata('message', 'The file is too large. The maximum allowed size is 2MB.');
            $this->session->set_flashdata('status', 'error');
            redirect($_SERVER['HTTP_REFERER']);
            return; // Arrêter l'exécution de la fonction
        }

        if (!$this->upload->do_upload('userAttachmentFile')) {
            // Erreur lors du téléchargement du fichier
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('message', 'Error uploading the attachment.');
            $this->session->set_flashdata('status', 'error');
            redirect($_SERVER['HTTP_REFERER']);
            // Gérez l'erreur en conséquence
        } else {
            // Téléchargement du fichier réussi
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name']; // Récupérer le nom du fichier
            $relative_path = 'assets/attachments/' . $userId . '/' . $file_name;

            // Récupérez le nom de la pièce jointe à partir du formulaire
            $attachmentName = $this->input->post('userAttachmentName');

            // Enregistrez les informations de la pièce jointe dans la base de données
            $attachmentData = array(
                'attachmentName' => $attachmentName,
                'attachmentPath' => $relative_path,
                'attachmentUserId' => $this->session->userdata('userId')
            );

            $this->load->model('User_model');
            $this->User_model->addAttachment($attachmentData);
            $this->session->set_flashdata('message', 'Your attachment has been successfully added!');
            $this->session->set_flashdata('status', 'success');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }
    
    public function deleteUserAttachment($attachmentId){
        $this->load->model('User_model');
            
        // Supprimer la pièce jointe existante dans le dossier 'attachments'
        $attachmentPath = $this->User_model->getAttachmentPath($attachmentId);

        if (file_exists($attachmentPath)) {
            unlink($attachmentPath);
        } 

        $this->User_model->deleteUserAttachment($attachmentId);
        $this->session->set_flashdata('message', 'Your attachment has been successfully deleted!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function deleteProfilPicture($userId) {
        $this->load->model('User_model');
        
        // Récupérer le chemin de l'avatar de l'utilisateur à partir de la base de données
        $userAvatarPath = $this->User_model->getAvatarPath($userId);

        // Vérifier si le fichier existe et le supprimer
        if (file_exists($userAvatarPath)) {
            unlink($userAvatarPath); // Supprimer le fichier
        }

        // Mettre à jour le chemin de l'avatar de l'utilisateur dans la base de données
        $this->User_model->updateAvatarPath($userId, '');

        $this->session->set_flashdata('message', 'Your profile picture has been successfully deleted!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function settings(){
        $userId = $this->session->userdata('userId');
        $this->load->model('User_model');
        $user = $this->User_model->get_UserData($userId);
        $data['user'] = $user;

        // Récupérer le job de l'utilisateur connecté avec le job id
        $job = $this->User_model->getUserJob($userId);
        $data['job'] = $job;

        // Récupérer l'expérience de l'utilisateur connecté avec l'expérience id
        $experiences = $this->User_model->getUserExperience($userId);
        $data['experiences'] = $experiences;

        // Récupérer les compétences de l'utilisateur connecté avec les compétences id
        // $skills = $this->User_model->getUserSkills($user->userId);
        // $data['skills'] = $skills;

        


       // $ratings = $this->User_model->getRatingsByUser($userId);
       // $data['ratings'] = $ratings;
       $ratingCount = $this->User_model->getRatingCountByUser($userId);
       $data['ratingCount'] = $ratingCount;

       // $raterUser = $this->User_model->getRaterUser($userId);
       // $data['raterUser'] = $raterUser;

       $raterUser = $this->User_model->getRaterUser($userId);
       $ratings = $this->User_model->getRatingsByUser($userId);
       $data['raterUser'] = $raterUser;
       $data['ratings'] = $ratings;

        $isAvailable = $user->userIsAvailable ;
        
        // Cocher la case appropriée en fonction de la valeur récupérée
        if ($isAvailable == 1) {
            $checkboxChecked = 'checked';
        } else {
            $checkboxChecked = '';
        }

        $data['checkboxChecked'] = $checkboxChecked;



        $this->load->view('user/settings', $data);
    }


    public function missionView($missionId){
        $userId = $this->session->userdata('userId');
        $this->load->model('User_model');
        $user = $this->User_model->get_UserData($userId);
        $data['user'] = $user;
        $isAvailable = $user->userIsAvailable ;
        
        // Cocher la case appropriée en fonction de la valeur récupérée
        if ($isAvailable == 1) {
            $checkboxChecked = 'checked';
        } else {
            $checkboxChecked = '';
        }

        // vérifier si la mission existe 
        

        $data['checkboxChecked'] = $checkboxChecked;


        $mission = $this->User_model->getMissionById($missionId);
        $data['mission'] = $mission;

        $company = $this->User_model->getCompanyForMission($missionId);
        $data['company'] = $company;

        $companyMissions = $this->User_model->getMissionOfCompany($company->idCompany);
        $data['companyMissions'] = $companyMissions;

        $missionSkills = array();
        foreach ($companyMissions as $mission) {
            $idMission = $mission->idMission;
            $missionSkills[$idMission] = $this->User_model->getMissionSkills($idMission);
        }
        $data['missionSkills'] = $missionSkills;

        // Récupérer les infos de l'entreprise par mission
        $missionCompany = array();
        $missionCompany[$missionId] = $this->User_model->getCompanyMission($missionId);
        $data['missionCompany'] = $missionCompany;

        $companyUser = $this->User_model->getCompanyUser($company->idCompany);
        $data['companyUser'] = $companyUser;

        $messageExamples = $this->User_model->getMessageExamples();
        $data['messageExamples'] = $messageExamples;


        // get the companyUser phone number
        $companyUserPhone = $this->User_model->getCompanyUserPhone($company->idCompany);

        $data['companyUserPhone'] = $companyUserPhone;

        $favoriteMissions = $this->User_model->getFavoriteMissions($userId); // Remplacez cette ligne avec votre logique pour récupérer les missions favorites de l'utilisateur
       
        $data['favoriteMissions'] = $favoriteMissions;

        $favoriteMissions =  $this->User_model->getFavoriteMissions($userId);

        $isMissionFavorite = false;

        $data['isMissionFavorite'] = $isMissionFavorite;

        $data['jobsAll'] = $this->User_model->get_all_jobs();


        if(!$mission){
            redirect('login');
        }


        $this->load->view('missions/view', $data);

    }

    public function mission(){
        $userId = $this->session->userdata('userId');
        $this->load->model('User_model');
        $user = $this->User_model->get_UserData($userId);
        $data['user'] = $user;
        $isAvailable = $user->userIsAvailable ;

        if ($user->userCompanyId != 0) {
            redirect('company');
        }
        
        // Cocher la case appropriée en fonction de la valeur récupérée
        if ($isAvailable == 1) {
            $checkboxChecked = 'checked';
        } else {
            $checkboxChecked = '';
        }

        $data['checkboxChecked'] = $checkboxChecked;

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
        $data['favoriteMissions'] = $favoriteMissions;
        $data['skillsAll'] = $this->User_model->get_all_skills();
        
        $data['jobsAll'] = $this->User_model->get_all_jobs();



        $this->load->view('missions/index', $data);
    }

   
    
   
    // Fonction pour convertir un tableau en chaîne de caractères
    private function convertirTableauEnChaine($tableau) {
        $chaine = '';
        foreach ($tableau as $element) {
            if (is_array($element)) {
                $chaine .= $this->convertirTableauEnChaine($element) . ', ';
            } else {
                $chaine .= $element . ', ';
            }
        }
        return rtrim($chaine, ', '); // Supprimer la virgule finale
    }

  

    public function whatsapp() {
        $userId = $this->session->userdata('userId');
        $this->load->model('User_model');
        $user = $this->User_model->get_UserData($userId);
        $data['user'] = $user;
        $isAvailable = $user->userIsAvailable;
    
        // Cocher la case appropriée en fonction de la valeur récupérée
        if ($isAvailable == 1) {
            $checkboxChecked = 'checked';
        } else {
            $checkboxChecked = '';
        }
        $data['checkboxChecked'] = $checkboxChecked;

        $groups = $this->User_model->getWhatsAppGroups();
    
        $data['groups'] = $groups;
    
        $this->load->view('user/whatsapp', $data);
    }

   

    public function isMissionFavorite($missionId){
        $userId = $this->session->userdata('userId');
        $this->load->model('User_model');
        $missionId = 1;
        $favoriteMissions =  $this->User_model->getFavoriteMissions($userId);

        $isMissionFavorite = false;
      
        foreach($favoriteMissions as $favoriteMission){
            if($favoriteMission->idMissionSavedMission == $missionId){
                $isMissionFavorite = true;
            }
        }


    }

    public function addToFavorite($missionId){
        $userId = $this->session->userdata('userId');
        $this->load->model('User_model');
        $companyMissionId = $this->User_model->getCompanyMissionId($missionId);
        $this->User_model->addToFavorite($userId, $missionId, $companyMissionId);
        $this->session->set_flashdata('message', 'The mission has been successfully added to your favorites!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);        
    }

    public function removeFromFavorite($missionId){
        $userId = $this->session->userdata('userId');
        $this->load->model('User_model');
        $this->User_model->deleteFromFavorite($userId, $missionId);
        $this->session->set_flashdata('message', 'The mission has been successfully removed from your favorites!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);        
    }

    public function favoriteMission(){
        $userId = $this->session->userdata('userId');
        $this->load->model('User_model');
        $user = $this->User_model->get_UserData($userId);
        $data['user'] = $user;
        $isAvailable = $user->userIsAvailable ;

        if ($user->userCompanyId != 0) {
            redirect('company');
        }
        
        
        // Cocher la case appropriée en fonction de la valeur récupérée
        if ($isAvailable == 1) {
            $checkboxChecked = 'checked';
        } else {
            $checkboxChecked = '';
        }

        $data['checkboxChecked'] = $checkboxChecked;
        $favoriteMissions = $this->User_model->getFavoriteMissions($userId);
        $data['favoriteMissions'] = $favoriteMissions;

        $missions = $this->User_model->getMissionSavedMission($userId);

        $data['missions'] = $missions;

        $missionCompany = array();
        foreach ($missions as $mission) {
            $idMission = $mission->idMission;
            $missionCompany[$idMission] = $this->User_model->getCompanyMission($idMission);
        }
        $data['missionCompany'] = $missionCompany;

        $missionSkills = array();
        foreach ($missions as $mission) {
            $idMission = $mission->idMission;
            $missionSkills[$idMission] = $this->User_model->getMissionSkills($idMission);
        }
        $data['missionSkills'] = $missionSkills;
        
        $data['jobsAll'] = $this->User_model->get_all_jobs();

        $this->load->view('user/favorite_mission', $data);
    }

    // Dans votre contrôleur, par exemple: Skills.php
    public function search_skills() {
        $term = $this->input->post('term');
        $this->load->model('User_model'); 
        $skills = $this->User_model->get_skills($term);
        echo json_encode($skills);
    }

    public function search_cities() {
        $term = $this->input->post('term');
        $this->load->model('User_model');
        $cities = $this->User_model->search_cities($term);
        echo json_encode($cities);
    }

    public function addUserSkills() {
        $userId = $this->session->userdata('userId');
        if ($this->input->server("REQUEST_METHOD") === "POST") {
            $skills = $this->input->post("skillsAll");
            $levels = $this->input->post("skillsLevel");
            $this->load->model('User_model');
    
            // Assurez-vous que les deux tableaux ont la même taille
            if (count($skills) === count($levels)) {
                $existingSkills = array(); // Tableau pour stocker les compétences déjà existantes
    
                foreach ($skills as $index => $skillId) {
                    $level = intval($levels[$index]);
    
                    // Vérifiez si la compétence n'est pas vide
                    if (!empty($skillId)) {
                        // Vérifiez si l'utilisateur a déjà cette compétence
                        if ($this->User_model->userHasSkill($userId, $skillId)) {
                            $existingSkills[] = $skillId; // Ajoutez l'ID de la compétence aux compétences existantes
                        } else {
                            $this->User_model->addUserSkills($userId, $skillId, $level);
                        }
                    }
                }
    
                if (!empty($existingSkills)) {
                    $existingSkillsNames = implode(', ', $existingSkills);
                    $errorMsg = "La compétence est déjà ajoutée !";
                    $this->session->set_flashdata('message', $errorMsg);
                    $this->session->set_flashdata('status', 'error');
                } else {
                    $this->session->set_flashdata('message', 'Your skills have been successfully added!');
                    $this->session->set_flashdata('status', 'success');
                }
    
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('message', 'An error has occurred!');
                $this->session->set_flashdata('status', 'error');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function deleteUserSkill($id){
        $userId = $this->session->userdata('userId');
        $this->load->model('User_model');
        $this->User_model->deleteUserSkill($id, $userId);
        $this->session->set_flashdata('message', 'Your skill has been successfully deleted!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function editUserSkills(){
        $userId = $this->session->userdata('userId');
        $this->load->model('User_model');
        $skillsName = $this->input->post('skillsName');
        $skillsLevel = $this->input->post('skillsLevel');
        $skillsId = array();
        foreach ($skillsName as $index => $skillName) {
            $skillId = $this->User_model->getSkillIdByName($skillName);
            if ($skillId !== false) {
                $skillsId[] = $skillId;
                }
        }
        
        foreach ($skillsId as $index => $skillId) {
            $skillLevel = $skillsLevel[$index];
            $this->User_model->editUserSkills($userId, $skillId, $skillLevel);
        }

    
        $this->session->set_flashdata('message', 'Your skills have been successfully updated!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    
    public function search_jobs() {
        $term = $this->input->post('term');
        $this->load->model('User_model'); 
        $jobs = $this->User_model->get_jobs($term);
        echo json_encode($jobs);
    }
    
    public function companies(){
        $userId = $this->session->userdata('userId');
        $this->load->model('User_model');
        $user = $this->User_model->get_UserData($userId);
        $data['user'] = $user;
        $isAvailable = $user->userIsAvailable;

        if ($user->userCompanyId != 0) {
            redirect('company');
        }
    
        // Cocher la case appropriée en fonction de la valeur récupérée
        if ($isAvailable == 1) {
            $checkboxChecked = 'checked';
        } else {
            $checkboxChecked = '';
        }
        $data['checkboxChecked'] = $checkboxChecked;
        $banner = $this->User_model->getBanner();
		$data['banner'] = $banner;
        
        $companies = $this->User_model->getAllCompanies();
        $data['companies'] = $companies;
        $data['secteursAll'] = $this->User_model->get_all_secteurs();

        $this->load->view('companies/index', $data);
    }

    public function companyView($companyId){
        $userId = $this->session->userdata('userId');
        $this->load->model('User_model');
        $user = $this->User_model->get_UserData($userId);
        $data['user'] = $user;
        $isAvailable = $user->userIsAvailable ;


        if ($user->userCompanyId != 0) {
            redirect('company');
        }
        
        // Cocher la case appropriée en fonction de la valeur récupérée
        if ($isAvailable == 1) {
            $checkboxChecked = 'checked';
        } else {
            $checkboxChecked = '';
        }
        $data['checkboxChecked'] = $checkboxChecked;

        $company = $this->User_model->getCompanyDataById($companyId);
        $data['company'] = $company;
        $missions = $this->User_model->getCompanyMissions($companyId);
        $data['missions'] = $missions;

        $user = $this->User_model->get_UserData($userId);

        // Récupérer les skills de chaque mission
        $missionSkills = array();
        if ($missions) {
            foreach ($missions as $mission) {
                $idMission = $mission->idMission;
                $missionSkills[$idMission] = $this->User_model->getMissionSkills($idMission);
            }
        }
        // foreach ($missions as $mission) {
        //     $idMission = $mission->idMission;
        //     $missionSkills[$idMission] = $this->User_model->getMissionSkills($idMission);
        // }
        $data['missionSkills'] = $missionSkills;

        $companyPhotos = $this->User_model->getCompanyAllPhotos($companyId);
        $data['companyPhotos'] = $companyPhotos;

        $favoriteMissions = $this->User_model->getFavoriteMissions($userId); // Remplacez cette ligne avec votre logique pour récupérer les missions favorites de l'utilisateur
        $data['favoriteMissions'] = $favoriteMissions;
        
        $data['jobsAll'] = $this->User_model->get_all_jobs();
        
        $this->load->view('companies/view', $data);
    }
    
    public function updateUserDataSettings(){
        $this->load->model('User_model');
        $userId = $this->session->userdata('userId');
        $userFirstName = $this->input->post('userFirstName');
        $userLastName = $this->input->post('userLastName');
        $userTelephone = $this->input->post('userTelephone');

        $this->User_model->updateUserDataSettings($userId, $userFirstName, $userLastName, $userTelephone);
        $this->session->set_flashdata('message', 'Your personal information has been successfully updated!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function updateUserPassword(){
        $this->load->model('User_model');
        $userId = $this->session->userdata('userId');
        $userPassword = $this->input->post('userPassword');
        // hash password
        $userPassword = password_hash($userPassword, PASSWORD_DEFAULT);

        $this->User_model->updateUserPassword($userId, $userPassword);
        $this->session->set_flashdata('message', 'Your password has been successfully updated!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function checkCurrentPassword(){
        $this->load->model('User_model');
        $currentPassword = $this->input->post('userCurrentPassword');
        if ($this->User_model->checkPassword($this->session->userdata('userId'), $currentPassword)) {
            // Mot de passe correct
            echo json_encode(array('status' => 'success', 'message' => ''));
        } else {
            // Mot de passe incorrect
            echo json_encode(array('status' => 'error', 'message' => 'Incorrect password'));
        }
    }

    public function sendWelcomeMail(){
        // tableau members avec email, nom, prénom de chaque membres
        $members = array(
            array('email' => 'kassim@cafe-creme.agency', 'firstName' => 'Kassim', 'lastName' => 'Mohamed'),
            array('email' => 'zaafira@cafe-creme.agency', 'firstName' => 'Zaafira', 'lastName' => 'Abou'),
 	array('email' => 'mohamed@cafe-creme.agency', 'firstName' => 'Mohamed', 'lastName' => 'Beghdadi'),
            array('email' => 'luqman@cafe-creme.agency', 'firstName' => 'Luqman', 'lastName ' => 'Nizari'),
            array('email' => 'fayaz@cafe-creme.agency', 'firstName' => 'Fayaz', 'lastName' => 'Mohamad'),
            array('email' => 'nassir@cafe-creme.agency', 'firstName' => 'Nassir', 'lastName' => 'Mouhamad'),
            array('email' => 'ihaconseils@gmail.com', 'firstName' => 'Imrane', 'lastName' => 'Haniff'),
            array('email' => 'radhia@cafe-creme.agency', 'firstName' => 'Radhia', 'lastName' => 'Necer'),
            array('email' => 'thanzile22@gmail.com', 'firstName' => 'Thanzile', 'lastName' => 'Shahul Hameed'),
            array('email' => 'a.traore@garden-it.com' , 'firstName' => 'Aliou', 'lastName' => 'Traore'),
            array('email' => 'a.mouhamad@garden-it.com', 'firstName' => 'Adil', 'lastName' => 'Mouhamad'),
            array('email' => 'i.kebe@garden-it.com', 'firstName' => 'Ibrahim', 'lastName' => 'Kebe'),
            array('email' => 'ijlale@cafe-creme.agency' , 'firstName' => 'Ijlale', 'lastName' => 'Bendaoud'),

           
        );

        foreach ($members as $member) {
            // récupérer les infos de chaque membre
            $memberEmail = $member['email'];
            $memberFirstName = $member['firstName'];
            $memberLastName = $member['lastName'];


            $this->load->library('email');
            $this->email->from('no-reply@cafe-creme.agency', 'My Freelance');
            $this->email->to($memberEmail); // Assurez-vous d'utiliser l'email de l'utilisateur
            $this->email->subject('Bienvenue chez My Freelance 👋🏻');
            $mailLink = base_url();
            $data['mailLink'] = $mailLink;
            $data['memberFirstName'] = $memberFirstName;
            $data['memberLastName'] = $memberLastName;
            $body = $this->load->view('email/welcome_email_members', $data, TRUE);
            $this->email->set_mailtype("html");
            $this->email->message($body);
            $this->email->send();
        }
    }

}
?>
