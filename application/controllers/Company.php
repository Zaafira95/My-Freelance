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
               

        if ($user) {
            $data['user'] = $user;
            $this->load->view('company/index', $data);
        }
        else {
            echo "Erreur 1 lors de la récupération des informations de l'utilisateur";
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

        // contact or not on or off



        if ($contactOrNot == 'on') {
            $outputMessage = $companyMessage . "\n\n Nom de la mission : " . $job->missionName .  "\n\n TJM : " . $missionTjm . "€ \n\n Nom de l'entreprise : " .$company->companyName ;
        } else {
            $outputMessage = $companyMessageDefault . "\n\n Nom de l'entreprise : " .$company->companyName ;
        }

      
    
        $encodedMessage = urlencode($outputMessage);
    
        $whatsappLink = "https://wa.me/$userTelephone?text=$encodedMessage";

         //open the link 

        redirect($whatsappLink);
        
    }


    public function mycompany(){

        $this->load->view('company/mycompany');
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






        $this->load->view('company/addMission', $data);
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
        $missionLocation = $this->input->post('missionLocation');
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

        $missionId = $this->Company_model->addMission($missionName, $missionTJM, $missionJobId, $missionExperience, $missionSkills, $missionLocation, $missionDescription, $missionAvantages, $missionType, $missionDeroulement, $missionDuration, $missionDateDebut, $missionDateFin, $missionCompanyId);

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

        $this->session->set_flashdata('message', 'Votre mission a bien été ajoutée !');
        $this->session->set_flashdata('status', 'success');
        redirect('company');
    }

    public function my_company(){
        $userId = $this->session->userdata('userId');
        $this->load->model('Company_model');
        $company = $this->Company_model->getCompanyData($userId);
        $data['company'] = $company;
        $companyId = $company->idCompany;
        $missions = $this->Company_model->getCompanyMissions($companyId);
        $data['missions'] = $missions;

        // Récupérer les skills de chaque mission
        $missionSkills = array();
        foreach ($missions as $mission) {
            $idMission = $mission->idMission;
            $missionSkills[$idMission] = $this->Company_model->getMissionSkills($idMission);
        }
        $data['missionSkills'] = $missionSkills;

        $user = $this->Company_model->get_UserData($userId);
        $data['user'] = $user;

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


        $isMissionFavorite = false;

        $data['isMissionFavorite'] = $isMissionFavorite;


        $this->load->view('missions/view', $data);

    }

    public function freelancer(){
        $userId = $this->session->userdata('userId');
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $user = $this->User_model->get_UserData($userId);

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
        $data['user'] = $user;

        $this->load->view('freelancers/index', $data);
    }
}
?>