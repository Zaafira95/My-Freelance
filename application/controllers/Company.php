<?php
class Company extends CI_Controller {
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
        $this->load->model('Company_model');
        $user = $this->User_model->get_UserData($userId);

        

        if ($user->userCompanyId == 0) {
            redirect('login'); 
        }
        
        $freelancers = $this->Company_model->get_freelancers();
        $data['freelancers'] = $freelancers;
    
        foreach ($freelancers as $freelancer) {
            $freelancerUserId = $freelancer->userId; // Supposons que vous avez récupéré le userId d'un freelance
            $freelancer_job[$freelancerUserId] = $this->Company_model->getJobByUserId($freelancerUserId);
            $freelancer_skills[$freelancerUserId] = $this->Company_model->getUserSkillsAll($freelancerUserId);

            $isAvailable = $freelancer->userIsAvailable ;
        
            if ($isAvailable == 1) {
                $checkboxChecked = 'checked';
            } else {
                $checkboxChecked = '';
            }
            
            $data['checkboxChecked'] = $checkboxChecked;
        }

        $data['freelancer_job'] = $freelancer_job;
        $data['freelancer_skills'] = $freelancer_skills;

        $company = $this->Company_model->getCompanyData($userId);
        $data['company'] = $company;
        $companyId = $company->idCompany;
        $job_for_company = $this->Company_model->getCompanyMissions($companyId);
        $data['job_for_company'] = $job_for_company;

        $data['skillsAll'] = $this->Company_model->get_all_skills();
        $data['jobsAll'] = $this->Company_model->get_all_jobs();

        $data['countriesAll'] = $this->Company_model->get_all_countries();
               

        if ($user) {
            $data['user'] = $user;

            $welcome_mail = $user->userWelcomeMail;

            if ($user->userLoginCount == 1 && $welcome_mail == "False") {

                $this->load->library('email');
                $this->email->from('no-reply@cafe-creme.agency', 'My Freelance');
                $this->email->to($user->userEmail); // Assurez-vous d'utiliser l'email de l'utilisateur
                $this->email->subject('Welcome to My Freelance 👋🏻');
                $mailLink = base_url();
                $data['mailLink'] = $mailLink;
                // $data['userFirstName'] = $user->userFirstName;
                // $data['userLastName'] = $user->userLastName;
                $data['companyName'] = $company->companyName;
                
                $body = $this->load->view('email/welcome_email_company', $data, TRUE);
                $this->email->set_mailtype("html");
                $this->email->message($body);
                $this->email->send();
                $this->load->model('User_model');
                $this->User_model->updateWelcomeMail($userId);
            }


            // Si user est autre que sales renvoyé vers la page connexion
            $this->load->view('company/index', $data);
        }
        else {
            // echo "Erreur 1 lors de la récupération des informations de l'utilisateur";
        }
    }

    public function logout() {
        $this->session->unset_userdata('userId');
        redirect('login');
    }

    public function freelancerView($id){
        $userId = $this->session->userdata('userId');
        $this->load->model('Company_model');
        $user = $this->Company_model->get_UserData($userId);
        if ($user->userCompanyId == 0) {
            redirect('login'); 
        }
        $data['user'] = $user;


        $this->load->model('Company_model');
        $freelancer = $this->Company_model->get_freelancer($id);
        $data['freelancer'] = $freelancer;

        $ratingCount = $this->Company_model->getRatingCountByUser($id);
        $data['ratingCount'] = $ratingCount;

        $raterUser = $this->Company_model->getRaterUser($id);
        $ratings = $this->Company_model->getRatingsByUser($id);
        $data['raterUser'] = $raterUser;
        $data['ratings'] = $ratings;

        $freelancer_job = $this->Company_model->getJobNameForAUser($id);

        $data['freelancer_job'] = $freelancer_job;


        // Récupérer les compétences de l'utilisateur connecté avec le id
        $skills = $this->Company_model->getUserSkillsAll($id);
        $data['skills'] = $skills;


        $experiences = $this->Company_model->getUserExperience($id);
        $data['experiences'] = $experiences;

        // Récupérer les skills de chaque experience
        $experienceSkills = array();
        foreach ($experiences as $experience) {
            $idExperience = $experience->idExperience;
            $experienceSkills[$idExperience] = $this->Company_model->getExperienceSkills($idExperience);
        }
        $data['experienceSkills'] = $experienceSkills;
 

        $attachments = $this->Company_model->getUserAttachement($id);
        $data['attachments'] = $attachments;

        $isAvailable = $freelancer->userIsAvailable ;
        
            if ($isAvailable == 1) {
                $checkboxChecked = 'checked';
            } else {
                $checkboxChecked = '';
            }
            
            $data['checkboxChecked'] = $checkboxChecked;

        $company = $this->Company_model->getCompanyData($userId);
        $data['company'] = $company;
        $companyId = $company->idCompany;
        $job_for_company = $this->Company_model->getCompanyMissions($companyId);
        $data['job_for_company'] = $job_for_company;

        $ratingCountForAUser = $this->Company_model->getRatingCountByCompanyForAUser($id, $userId);
        $data['ratingCountForAUser'] = $ratingCountForAUser;


        // Vérifiez si l'utilisateur existe 
        if (!$freelancer) {
            redirect('login');
        }
        

        $this->load->view('freelancers/view', $data);
    }


    public function sendMessage($freelancerId){

        $userId = $this->session->userdata('userId');
        $contactOrNot = $this->input->post('contactOrNot');
        $companyJobs = $this->input->post('companyJobs');
        $companyMessage = $this->input->post('companyMessage');
        $companyMessageDefault = $this->input->post('companyMessageDefault');
        
        $this->load->model('Company_model');

        $company = $this->Company_model->getCompanyData($userId);
        $data['company'] = $company;


        $job = $this->Company_model->getJobWithId($companyJobs);
        $userTelephone = $this->Company_model->getUserTelephone($freelancerId);
        $tjm = $this->Company_model->getTjm($companyJobs);
    
        if (!empty($userTelephone) && is_array($userTelephone)) {
            $userTelephone = $userTelephone[0]->userTelephone ?? '';
        } else {
            $userTelephone = '';
        }

        $missionTjm = $tjm->missionTjm;   

	// var_dump($userTelephone);die;


        // contact or not on or off



        if ($contactOrNot == 'on') {
            $outputMessage = $companyMessage . "\n\n Mission name : " . $job->missionName .  "\n\n Daily rate : " . $missionTjm . "AED \n\n Company name : " .$company->companyName ;
        } else {
            $outputMessage = $companyMessageDefault . "\n\n Company name : " .$company->companyName ;
        }

      
    
        $encodedMessage = urlencode($outputMessage);
    
        // $whatsappLink = "https://wa.me/$userTelephone?text=$encodedMessage";
        $whatsappLink = "https://api.whatsapp.com/send/?phone=$userTelephone&text=$encodedMessage";



         //open the link 

        redirect($whatsappLink);
        
    }



    public function missionAdd(){
        $userId = $this->session->userdata('userId');
        $this->load->model('Company_model');
        $user = $this->Company_model->get_UserData($userId);

        $data['user'] = $user;

        if ($user->userCompanyId == 0) {
            redirect('login'); 
        }

        $company = $this->Company_model->getCompanyData($userId);
        $data['company'] = $company;
        $companyId = $company->idCompany;
        $job_for_company = $this->Company_model->getCompanyMissions($companyId);
        $data['job_for_company'] = $job_for_company;

        $data['jobsAll'] = $this->Company_model->get_all_jobs();

        $data['citiesAll'] = $this->Company_model->get_all_cities();

        $data['skillsAll'] = $this->Company_model->get_all_skills();
        $data['countriesAll'] = $this->Company_model->get_all_countries();

        $this->load->view('company/addMission', $data);
    }

    public function missionEdit($missionId){
        $userId = $this->session->userdata('userId');
        $this->load->model('Company_model');
        $user = $this->Company_model->get_UserData($userId);

        $data['user'] = $user;

        if ($user->userCompanyId == 0) {
            redirect('login'); 
        }
        $mission = $this->Company_model->getMissionById($missionId);
        $missionSkills = $this->Company_model->getMissionSkills($missionId);

        // Envoyez les données de la mission à la vue pour l'affichage
        $data['mission'] = $mission;
        $data['missionSkills'] = $missionSkills;

        $company = $this->Company_model->getCompanyData($userId);
        $data['company'] = $company;
        $companyId = $company->idCompany;
        $job_for_company = $this->Company_model->getCompanyMissions($companyId);
        $data['job_for_company'] = $job_for_company;

        $data['jobsAll'] = $this->Company_model->get_all_jobs();

        $data['citiesAll'] = $this->Company_model->get_all_cities();

        $data['skillsAll'] = $this->Company_model->get_all_skills();
        $data['countriesAll'] = $this->Company_model->get_all_countries();

        if ($user->userCompanyId != $mission->missionCompanyId) {
            redirect('login'); 
        }

        $this->load->view('company/editMission', $data);
    }

    public function search_jobs() {
        $term = $this->input->post('term');
        $this->load->model('Company_model'); 
        $jobs = $this->Company_model->get_jobs($term);
        echo json_encode($jobs);
    }

    public function search_cities(){
        $term = $this->input->post('term');
        $this->load->model('Company_model'); 
        $cities = $this->Company_model->get_cities($term);
        echo json_encode($cities);
    }

    public function search_skills() {
        $term = $this->input->post('term');
        $this->load->model('Company_model'); 
        $skills = $this->Company_model->get_skills($term);
        echo json_encode($skills);
    }


    public function addMission(){
        $userId = $this->session->userdata('userId');
        $this->load->model('Company_model');
        $user = $this->Company_model->get_UserData($userId);

        $data['user'] = $user;

        if ($user->userCompanyId == 0) {
            redirect('login'); 
        }

        $company = $this->Company_model->getCompanyData($userId);
        $data['company'] = $company;
        $companyId = $company->idCompany;

        $company = $this->Company_model->getCompanyData($userId);
        $data['company'] = $company;
        $companyId = $company->idCompany;
        $job_for_company = $this->Company_model->getCompanyMissions($companyId);
        $data['job_for_company'] = $job_for_company;
        $missionName = $this->input->post('missionName');
        $missionTJM = $this->input->post('missionTJM');
        $missionJobId = $this->input->post('jobsAll');
        $missionExperience = $this->input->post('missionExperience');
        $missionSkills = $this->input->post('missionSkills');
        $missionType = $this->input->post('missionType');
        $missionDeroulement = $this->input->post('missionDeroulement');
        $missionDuration = $this->input->post('missionDuration');
        $missionCountryId = $this->input->post('missionCountryId');
        $missionDescription = $this->input->post('missionDescription');
        $missionDateDebut = $this->input->post('missionDateDebut');
        $missionDateFin = $this->input->post('missionDateFin');
        $missionAvantages = $this->input->post('missionAvantages');

        $missionCompanyId = $companyId;
        if (!empty($missionJobId)) {
            $missionJobId = $missionJobId[0]; // Prendre le premier élément du tableau
        } else {
            $missionJobId = 0;
        }

        $skills = $this->input->post("skillsAll");
        $levels = $this->input->post("skillsLevel");

        $missionId = $this->Company_model->addMission($missionName, $missionTJM, $missionJobId, $missionExperience, $missionSkills, $missionCountryId, $missionDescription, $missionAvantages, $missionType, $missionDeroulement, $missionDuration, $missionDateDebut, $missionDateFin, $missionCompanyId);

        // Vérifiez si la mission a été ajoutée avec succès et qu'un ID a été généré
        if ($missionId) {
            if (!empty($skills)) {
            // Bouclez à travers les compétences et les niveaux associés
                for ($i = 0; $i < count($skills); $i++) {
                    $skillId = $skills[$i];
                    $level = $levels[$i];

                    // Ajoutez les compétences de mission à la table missionSkills
                    $this->Company_model->addMissionSkills($missionId, $skillId, $level);
                }
            }
        }

        $this->session->set_flashdata('message', 'Your mission has been successfully added!');
        $this->session->set_flashdata('status', 'success');
        redirect('company/missionView/' . $missionId); 
    }
    
    public function editMission($missionId) {
        $this->load->model('Company_model');
        $mission = $this->Company_model->getMissionById($missionId);
        $data['mission'] = $mission;

        if ($this->input->post()) {
            $missionName = $this->input->post('missionName');
            $missionTJM = $this->input->post('missionTJM');
            $missionJobId = implode(',', $this->input->post('jobsAll'));
            $missionExperience = $this->input->post('missionExperience');
            $missionSkills = $this->input->post('missionSkills');
            $missionType = $this->input->post('missionType');
            $missionDeroulement = $this->input->post('missionDeroulement');
            $missionDuration = $this->input->post('missionDuration');
            $missionCountryId = $this->input->post('missionCountryId');
            $missionDescription = $this->input->post('missionDescription');
            $missionDateDebut = $this->input->post('missionDateDebut');
            $missionDateFin = $this->input->post('missionDateFin');
            $missionAvantages = $this->input->post('missionAvantages');

            $skills = $this->input->post("skillsAll");
            $levels = $this->input->post("skillsLevel");

            $this->Company_model->editMission($missionId, $missionName, $missionTJM, $missionJobId, $missionExperience, $missionSkills, $missionCountryId, $missionDescription, $missionAvantages, $missionType, $missionDeroulement, $missionDuration, $missionDateDebut, $missionDateFin);
            if (!empty($skills)) {
            // Bouclez à travers les compétences et les niveaux associés
                for ($i = 0; $i < count($skills); $i++) {
                    $skillId = $skills[$i];
                    $level = $levels[$i];

                    // Ajoutez les compétences de mission à la table missionSkills
                    $this->Company_model->addMissionSkills($missionId, $skillId, $level);
                }
            }

            $this->session->set_flashdata('message', 'Your mission has been successfully updated!');
            $this->session->set_flashdata('status', 'success');
            redirect('company/missionView/' . $missionId); 
        } else {
            $this->load->view('company/editMission', $data);
        }
    }

    public function deleteMission($missionId){

        $userId = $this->session->userdata('userId');
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $user = $this->User_model->get_UserData($userId);
        $mission = $this->Company_model->getMissionById($missionId);


        

        if ($user->userCompanyId == 0) {
            redirect('login'); 
        }
        else {

            $this->load->model('Company_model');

            if ($user->userCompanyId != $mission->missionCompanyId) {
                redirect('login'); 
            }

            $this->Company_model->deleteMission($missionId);
            $this->session->set_flashdata('message', 'Your mission has been successfully deleted!');
            $this->session->set_flashdata('status', 'success');
            redirect('company/my_company');

        }

        
       
    }

    public function my_company(){
        $userId = $this->session->userdata('userId');
        $this->load->model('Company_model');
        $this->load->model('User_model');
        $company = $this->Company_model->getCompanyData($userId);
        $data['company'] = $company;
        $companyId = $company->idCompany;
        $missions = $this->Company_model->getCompanyMissions($companyId);
        $data['missions'] = $missions;

        $user = $this->User_model->get_UserData($userId);
        if ($user->userCompanyId == 0) {
            redirect('login'); 
        }

        // Récupérer les skills de chaque mission
        $missionSkills = array();
        if ($missions) {
            foreach ($missions as $mission) {
                $idMission = $mission->idMission;
                $missionSkills[$idMission] = $this->Company_model->getMissionSkills($idMission);
            }
        }
        // foreach ($missions as $mission) {
        //     $idMission = $mission->idMission;
        //     $missionSkills[$idMission] = $this->Company_model->getMissionSkills($idMission);
        // }
        $data['missionSkills'] = $missionSkills;

        $companyPhotos = $this->Company_model->getAllPhotos($companyId);
        $data['companyPhotos'] = $companyPhotos;

        $user = $this->Company_model->get_UserData($userId);
        $data['user'] = $user;

        $data['secteursAll'] = $this->Company_model->get_all_secteurs();
        $data['citiesAll'] = $this->Company_model->get_all_cities();
        $data['countriesAll'] = $this->Company_model->get_all_countries();
        
        $this->load->view('company/my_company', $data);
    }


    public function missionView($missionId){


        $userId = $this->session->userdata('userId');
        $this->load->model('Company_model');
        $user = $this->Company_model->get_UserData($userId);
        $data['user'] = $user;

        $mission = $this->Company_model->getMissionById($missionId);
        $data['mission'] = $mission;

        $company = $this->Company_model->getCompanyForMission($missionId);
        $data['company'] = $company;

        $companyMissions = $this->Company_model->getMissionOfCompany($company->idCompany);
        $data['companyMissions'] = $companyMissions;

        $missionSkills = array();
        foreach ($companyMissions as $mission) {
            $idMission = $mission->idMission;
            $missionSkills[$idMission] = $this->Company_model->getMissionSkills($idMission);
        }
        $data['missionSkills'] = $missionSkills;

        // Récupérer les infos de l'entreprise par mission
        $missionCompany = array();
        $missionCompany[$missionId] = $this->Company_model->getCompanyMission($missionId);
        $data['missionCompany'] = $missionCompany;

        $companyUser = $this->Company_model->getCompanyUser($company->idCompany);
        $data['companyUser'] = $companyUser;

        $messageExamples = $this->Company_model->getMessageExamples();
        $data['messageExamples'] = $messageExamples;

        // get the companyUser phone number
        $companyUserPhone = $this->Company_model->getCompanyUserPhone($company->idCompany);

        $data['companyUserPhone'] = $companyUserPhone;

        $favoriteMissions = $this->Company_model->getFavoriteMissions($userId); // Remplacez cette ligne avec votre logique pour récupérer les missions favorites de l'utilisateur
       
        $data['favoriteMissions'] = $favoriteMissions;

        $data['jobsAll'] = $this->Company_model->get_all_jobs();

        $isMissionFavorite = false;

        $data['isMissionFavorite'] = $isMissionFavorite;

        // Check if this mission is the mission of the company otherwise redirect to login
        if ($user->userCompanyId != $mission->missionCompanyId) {
            redirect('login'); 
        }

        // Vérifiez si la mission existe
        if (!$mission) {
            redirect('login');
        }



        $this->load->view('missions/view', $data);

    }

    public function freelancer(){
        $userId = $this->session->userdata('userId');
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $user = $this->User_model->get_UserData($userId);
        if ($user->userCompanyId == 0) {
            redirect('login'); 
        }
        $freelancers = $this->Company_model->get_freelancers();
        $data['freelancers'] = $freelancers;
        
        foreach ($freelancers as $freelancer) {
            $freelancerUserId = $freelancer->userId; // Supposons que vous avez récupéré le userId d'un freelance
            $freelancer_job[$freelancerUserId] = $this->Company_model->getJobByUserId($freelancerUserId);
            $freelancer_skills[$freelancerUserId] = $this->Company_model->getUserSkillsAll($freelancerUserId);

            $isAvailable = $freelancer->userIsAvailable ;
        
            if ($isAvailable == 1) {
                $checkboxChecked = 'checked';
            } else {
                $checkboxChecked = '';
            }
            
            $data['checkboxChecked'] = $checkboxChecked;
        }
    
        $data['freelancer_job'] = $freelancer_job;
        $data['freelancer_skills'] = $freelancer_skills;

        $company = $this->Company_model->getCompanyData($userId);
        $data['company'] = $company;
        $companyId = $company->idCompany;
        $job_for_company = $this->Company_model->getCompanyMissions($companyId);
        $data['job_for_company'] = $job_for_company;

        $data['skillsAll'] = $this->Company_model->get_all_skills();
        $data['jobsAll'] = $this->Company_model->get_all_jobs();
        $data['countriesAll'] = $this->Company_model->get_all_countries();
        $data['user'] = $user;

        $this->load->view('freelancers/index', $data);
    }
    
    public function updateCompanyDescription(){
        $this->load->model('Company_model');
        $userId = $this->session->userdata('userId');
        $companyDescription = $this->input->post('companyDescription');
        $company = $this->Company_model->getCompanyData($userId);
        $companyId = $company->idCompany;

        $this->Company_model->updateCompanyDescription($companyId, $companyDescription);
        $this->session->set_flashdata('message', 'Your description has been successfully updated!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
       
    }
    
    public function updateCompanyAdvantages(){
        $this->load->model('Company_model');
        $userId = $this->session->userdata('userId');
        $companyAvantages = $this->input->post('companyAvantages');
        $company = $this->Company_model->getCompanyData($userId);
        $companyId = $company->idCompany;

        $this->Company_model->updateCompanyAdvantages($companyId, $companyAvantages);
        $this->session->set_flashdata('message', 'Your advantages have been successfully updated!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
       
    }

    public function updateCompanyData(){
        $this->load->model('Company_model');
        $userId = $this->session->userdata('userId');
        $companyName = $this->input->post('companyName');
        $companySlogan = $this->input->post('companySlogan');
        $companySecteur = $this->input->post('secteursAll');

        $companyCountryId = $this->input->post('companyLocalisation');
        $companyEtranger = $this->input->post('companyEtranger');

        $userLinkedinLink = $this->input->post('userLinkedinLink');
        $companyWebsite = $this->input->post('companyWebsite');
        $userTelephone = $this->input->post('userTelephone');
        $company = $this->Company_model->getCompanyData($userId);
        $companyId = $company->idCompany;
        $companySecteur = implode(',', $companySecteur);
    

        $configBanner = [
            'upload_path' => 'assets/img/company/' . $companyId . '/banner/',
            'allowed_types' => 'jpg|jpeg|png',
            'max_size' => 2048
        ];
        // Vérifier si un fichier a été téléchargé
        if ($_FILES['banner-upload']['name']) {
            // Créer un dossier pour chaque utilisateur avec son ID
            $companyBannerPath = 'assets/img/company/' . $companyId . '/banner/';
            if (!is_dir($companyBannerPath)) {
                mkdir($companyBannerPath, 0777, true);
            }
    
            // Supprimer l'image existante du logo
            $existingBannerPath = $this->Company_model->getBannerPath($companyId);
            if ($existingBannerPath) {
                // Supprimer le fichier existant
                if (file_exists($existingBannerPath)) {
                    unlink($existingBannerPath);
                }
            }
    
            // $config['upload_path'] = $companyBannerPath;
            // $config['allowed_types'] = 'jpg|jpeg|png';
            // $config['max_size'] = 2048; // Taille maximale du fichier en kilo-octets
            $this->load->library('upload', $configBanner);
    
            if (!$this->upload->do_upload('banner-upload')) {
                // Erreur lors du téléchargement du fichier
                $error = $this->upload->display_errors();
                // echo "Erreur lors du téléchargement de l'image";
                // Gérez l'erreur en conséquence
            } else {
                // Téléchargement du fichier réussi
                // Récupérer les informations sur le fichier téléchargé
                $uploadData = $this->upload->data();
                
                $companyBannerPath .= $uploadData['file_name'];
                //$companyBannerPath="test";

                // Mettre à jour le chemin de l'avatar de l'utilisateur dans la base de données
                $this->Company_model->updateBannerPath($companyId, $companyBannerPath);
    
                // echo "Image téléchargée avec succès";
            }
        }
    
        $configLogo = [
            'upload_path' => 'assets/img/company/' . $companyId . '/logo/',
            'allowed_types' => 'jpg|jpeg|png',
            'max_size' => 2048
        ];
        // Vérifier si un fichier a été téléchargé
        if ($_FILES['logo-upload']['name']) {
            // Créer un dossier pour chaque utilisateur avec son ID
            $companyLogoPath = 'assets/img/company/' . $companyId . '/logo/';
            if (!is_dir($companyLogoPath)) {
                mkdir($companyLogoPath, 0777, true);
            }
    
            // Supprimer l'image existante du logo
            $existingLogoPath = $this->Company_model->getLogoPath($companyId);
            if ($existingLogoPath) {
                // Supprimer le fichier existant
                if (file_exists($existingLogoPath)) {
                    unlink($existingLogoPath);
                }
            }

            // $config['upload_path'] = $companyLogoPath;
            // $config['allowed_types'] = 'jpg|jpeg|png';
            // $config['max_size'] = 2048; // Taille maximale du fichier en kilo-octets
            //$this->load->library('upload', $configLogo);

            
            if($_FILES['banner-upload']['name']) {
                $this->upload->initialize($configLogo);
            } else {
                $this->load->library('upload', $configLogo);
            }
    
            if (!$this->upload->do_upload('logo-upload')) {
                // Erreur lors du téléchargement du fichier
                $error = $this->upload->display_errors();
                // echo "Erreur lors du téléchargement de l'image";
                // Gérez l'erreur en conséquence
            } else {
                // Téléchargement du fichier réussi
                // Récupérer les informations sur le fichier téléchargé
                $uploadData = $this->upload->data();
                
                $companyLogoPath .= $uploadData['file_name'];

                // Mettre à jour le chemin de l'avatar de l'utilisateur dans la base de données
                $this->Company_model->updateLogoPath($companyId, $companyLogoPath);
    
                // echo "Image téléchargée avec succès";
            }
        }

        $this->Company_model->updateCompanyData($companyId, $companyName, $companySlogan, $companySecteur, $companyCountryId, $userId, $userLinkedinLink, $userTelephone, $companyWebsite);
        $this->session->set_flashdata('message', 'Your information have been successfully updated!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function updateCompanyPhotos(){
        $this->load->model('Company_model');
        $userId = $this->session->userdata('userId');
        $company = $this->Company_model->getCompanyData($userId);
        $companyId = $company->idCompany;
    
        // Récupérer les photos actuellement enregistrées en base de données
        $currentPhotos = $this->Company_model->getAllPhotos($companyId);
    
        // Parcourir les photos actuelles
        foreach ($currentPhotos as $photo) {
            $photoId = $photo->idCompanyPhotos;
            $photoNameInput = 'photo-upload-' . $photoId;
    
            // Vérifier si une nouvelle image a été téléchargée pour cette photo
            if (isset($_FILES[$photoNameInput]) && $_FILES[$photoNameInput]['name']) {
                $companyPhotoPath = 'assets/img/company/' . $companyId . '/photos/';
    
                // Supprimer l'ancienne image
                if (file_exists($photo->companyPhotosPath)) {
                    unlink($photo->companyPhotosPath);
                }
    
                $config['upload_path'] = $companyPhotoPath;
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048; // Taille maximale du fichier en kilo-octets
                $this->load->library('upload', $config);
    
                if (!$this->upload->do_upload($photoNameInput)) {
                    // Erreur lors du téléchargement du fichier
                    $error = $this->upload->display_errors();
                    // echo "Erreur lors du téléchargement de l'image";
                    // Gérez l'erreur en conséquence
                } else {
                    // Téléchargement du fichier réussi
                    // Récupérer les informations sur le fichier téléchargé
                    $uploadData = $this->upload->data();
                    $companyPhotoPath = $companyPhotoPath . $uploadData['file_name'];
    
                    // Mettre à jour le chemin de l'image dans la base de données
                    $this->Company_model->updatePhotoPath($photoId, $companyPhotoPath);
                }
            }
        }
    
        $this->session->set_flashdata('message', 'Your pictures have been successfully updated!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    
    public function deleteCompanyPhoto($id){
        $this->load->model('Company_model');
        $userId = $this->session->userdata('userId');
        $company = $this->Company_model->getCompanyData($userId);
        $companyId = $company->idCompany;
            
        // Supprimer les images existantes dans le dossier 'photos' de l'entreprise
        $companyPhotoPath = $this->Company_model->getPhotoPath($id);

        if (file_exists($companyPhotoPath)) {
            unlink($companyPhotoPath);
        }        

        $this->Company_model->deletePhotoPath($id);

        $this->session->set_flashdata('message', 'Your picture has been successfully deleted!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function addCompanyPhotos(){
        $this->load->model('Company_model');
        $userId = $this->session->userdata('userId');
        $company = $this->Company_model->getCompanyData($userId);
        $companyId = $company->idCompany;
    
        // Récupérer le chemin du dossier pour les photos de l'entreprise
        $companyPhotoPath = 'assets/img/company/' . $companyId . '/photos/';
    
        // Vérifier si un fichier a été téléchargé
        if ($_FILES['photo-upload']['name']) {
            // Créer le dossier s'il n'existe pas encore
            if (!is_dir($companyPhotoPath)) {
                mkdir($companyPhotoPath, 0777, true);
            }
    
            // Configuration pour le téléchargement du fichier
            $config['upload_path'] = $companyPhotoPath;
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // Taille maximale du fichier en kilo-octets
            $this->load->library('upload', $config);
    
            if (!$this->upload->do_upload('photo-upload')) {
                // Erreur lors du téléchargement du fichier
                $error = $this->upload->display_errors();
                // echo "Erreur lors du téléchargement de l'image";
                // Gérez l'erreur en conséquence
            } else {
                // Téléchargement du fichier réussi
                // Récupérer les informations sur le fichier téléchargé
                $uploadData = $this->upload->data();
                $companyPhotoName = $uploadData['file_name'];
                $companyPhotoPath = $companyPhotoPath . $companyPhotoName;
    
                // Insérer le nouveau chemin de l'image dans la table 'companyphotos'
                $this->Company_model->insertPhotoPath($companyId, $companyPhotoPath);
    
                // echo "Image téléchargée avec succès";
            }
        }
    
        $this->session->set_flashdata('message', 'Your picture has been successfully added!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function settings(){
        $userId = $this->session->userdata('userId');
        $this->load->model('Company_model');
        $user = $this->Company_model->get_UserData($userId);
        $data['user'] = $user;
        if ($user->userCompanyId == 0) {
            redirect('login'); 
        }
        // Récupérer l'expérience de l'utilisateur connecté avec l'expérience id
        $experiences = $this->Company_model->getUserExperience($userId);
        $data['experiences'] = $experiences;

        // $ratings = $this->Company_model->getRatingsByUser($userId);
        // $data['ratings'] = $ratings;
        $ratingCount = $this->Company_model->getRatingCountByUser($userId);
        $data['ratingCount'] = $ratingCount;

        // $raterUser = $this->Company_model->getRaterUser($userId);
        // $data['raterUser'] = $raterUser;
        
        $company = $this->Company_model->getCompanyData($userId);
        $data['company'] = $company;

        $ratedUsers = $this->Company_model->getAllRatingsByCompany($userId);
        $data['ratedUsers'] = $ratedUsers;

        $isAvailable = $user->userIsAvailable;
        
        // Cocher la case appropriée en fonction de la valeur récupérée
        if ($isAvailable == 1) {
            $checkboxChecked = 'checked';
        } else {
            $checkboxChecked = '';
        }

        $data['checkboxChecked'] = $checkboxChecked;

        $data['secteursAll'] = $this->Company_model->get_all_secteurs();
        $data['jobsAll'] = $this->Company_model->get_all_jobs();

        

        $this->load->view('company/settings', $data);
    }

    public function updateUserData(){
        $this->load->model('Company_model');
        $userId = $this->session->userdata('userId');
        $userFirstName = $this->input->post('userFirstName');
        $userLastName = $this->input->post('userLastName');
        $userTelephone = $this->input->post('userTelephone');

        $this->Company_model->updateUserData($userId, $userFirstName, $userLastName, $userTelephone);
        $this->session->set_flashdata('message', 'Your personal information have been successfully updated!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function updateUserPassword(){
        $this->load->model('Company_model');
        $userId = $this->session->userdata('userId');
        $userPassword = $this->input->post('userPassword');
        // hash password
        $userPassword = password_hash($userPassword, PASSWORD_DEFAULT);

        $this->Company_model->updateUserPassword($userId, $userPassword);
        $this->session->set_flashdata('message', 'Your password has been successfully updated!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function addRating($ratedUserId){
        $this->load->model('Company_model');
        $userId = $this->session->userdata('userId');
        $ratingComment = $this->input->post('ratingComment');
        $ratingStars = $this->input->post('ratingStars');
        $ratingDate = date('Y-m-d H:i:s');
        
        // 0 = en attente d'approbation
        // 1 = avis ajouté
        $ratingStatus = 1;

        $this->Company_model->addRating($userId, $ratedUserId, $ratingComment, $ratingStars, $ratingDate, $ratingStatus);
        $this->session->set_flashdata('message', "Your review has been successfully added!");
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function deleteRating($ratingId){
        $this->load->model('Company_model');

        $this->Company_model->deleteRating($ratingId);
        $this->session->set_flashdata('message', 'Your review has been successfully deleted!');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function whatsapp() {
        $userId = $this->session->userdata('userId');
        $this->load->model('Company_model');
        $user = $this->Company_model->get_UserData($userId);


        if ($user->userCompanyId == 0) {
            redirect('login'); 
        }
        $data['user'] = $user;

        $company = $this->Company_model->getCompanyData($userId);
        $data['company'] = $company;

        $groups = $this->Company_model->getWhatsAppGroups();

        $company = $this->Company_model->getCompanyData($userId);
        $data['company'] = $company;
    
        $data['groups'] = $groups;
    
        $this->load->view('company/whatsapp', $data);
    }

    public function checkCurrentPassword(){
        $this->load->model('Company_model');
        $currentPassword = $this->input->post('userCurrentPassword');
        if ($this->Company_model->checkPassword($this->session->userdata('userId'), $currentPassword)) {
            // Mot de passe correct
            echo json_encode(array('status' => 'success', 'message' => ''));
        } else {
            // Mot de passe incorrect
            echo json_encode(array('status' => 'error', 'message' => 'Incorrect password'));
        }
    }
    

}
?>