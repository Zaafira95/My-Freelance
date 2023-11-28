<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->library('session');
        // Si l'utilisateur n'est pas connecté, redirigez-le vers le contrôleur "Login"
        if (!$this->session->userdata('userId')) {
            redirect('login');
        }

    }

	public function index()
	{
        $this->load->model('Admin_model');
		$freelancers = $this->Admin_model->get_Users();
		$this->data['freelancers'] = $freelancers;

		$companies = $this->Admin_model->get_Companies();
		$this->data['companies'] = $companies;

		// Créez un tableau pour stocker les utilisateurs de chaque entreprise
		$companyUsers = array();

		foreach ($companies as $company) {
			$companyId = $company->idCompany;
			$companyUser = $this->Admin_model->getCompanyUser($companyId);
			
			// Ajoutez les utilisateurs de l'entreprise au tableau
			$companyUsers[$companyId] = $companyUser;
		}

		// Stockez le tableau des utilisateurs de l'entreprise dans les données
		$this->data['companyUsers'] = $companyUsers;

		$missions = $this->Admin_model->getMissions();
		$this->data['missions'] = $missions;

				

		
		 
		





		$userId = $this->session->userdata('userId');
        $user = $this->Admin_model->get_UserData($userId);

		$this->data['user'] = $user;


		$banner = $this->Admin_model->getBanner();
		$this->data['banner'] = $banner;

		$this->load->view('admin/index', $this->data);
	}

	public function addBanner($idBanner){

		$userId = $this->session->userdata('userId');
		$this->load->model('Admin_model');
		$user = $this->Admin_model->get_UserData($userId);
		$this->data['user'] = $user;

		$bannerStatus = $this->input->post('bannerStatus');
		if ($bannerStatus == "on") {
			$bannerStatus = "active";
		} else {
			$bannerStatus = "disabled";
		}


		$bannerTitle = $this->input->post('bannerTitle');
		$bannerMessage = $this->input->post('bannerMessage');
		$bannerCta = $this->input->post('bannerCta');
		$bannerLink = $this->input->post('bannerLink');

		$this->Admin_model->addBanner($bannerTitle, $bannerStatus, $bannerMessage, $bannerCta, $bannerLink);
        $this->session->set_flashdata('message', 'Votre bannière a été modifiée avec succès.');
        $this->session->set_flashdata('status', 'success');
        // Recharger la page actuelle
        redirect($_SERVER['HTTP_REFERER']);


	}

	public function banner(){
		$this->load->model('Admin_model');
		$this->data['users'] = $this->Admin_model->get_Users();

		$userId = $this->session->userdata('userId');
        $user = $this->Admin_model->get_UserData($userId);

		$this->data['user'] = $user;


		$banner = $this->Admin_model->getBanner();
		$this->data['banner'] = $banner;

		$this->load->view('admin/banner', $this->data);

	}
}

/* test */