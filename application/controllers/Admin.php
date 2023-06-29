<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
        $this->load->model('Admin_model');
		$this->data['users'] = $this->Admin_model->get_Users();
		$this->load->view('indexUser', $this->data);
	}
}
