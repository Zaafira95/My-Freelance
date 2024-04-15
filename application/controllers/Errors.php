<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function error_404() {
        $this->output->set_status_header('404');
        $data['content'] = 'erreur personnalisée'; // Vous pouvez charger des données spécifiques à la vue ici
        $this->load->view('errors/html/error_404', $data); // Chargez votre vue personnalisée pour les erreurs 404
    }
}
