<?php
class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Login_model');
    }

    public function index() {
        if ($this->session->userdata('userId')) {
            redirect('user');
        }

        $token = $_GET['token'] ?? '';

        if ($this->Login_model->activateAccount($token)) {
            $this->session->set_flashdata('message', 'Votre compte activé. Connectez-vous pour accéder à votre compte.');
            $this->session->set_flashdata('status', 'success');
            $this->load->view('login_view');
        }        

        $this->load->view('login_view');
    }

    public function login() {
        $userEmail = $this->input->post('userEmail');
        $userPassword = $this->input->post('userPassword');
        $user = $this->Login_model->login($userEmail, $userPassword);
    
        if ($user) {
            $this->session->set_userdata('userId', $user->userId);
            
            // incrémenter le nombre de connexion
            $this->Login_model->incrementLogin($user->userId);
    
            // Récupérer toutes les informations de l'utilisateur
            $userData = $this->Login_model->getUserData($user->userId);


            if ($userData->userType == 'admin') {
                $this->session->set_flashdata('message', 'Vous êtes connecté avec succès.');
                $this->session->set_flashdata('status', 'success');
                redirect('admin');
            }

            elseif ($userData->userCompanyId != 0) {
                $this->session->set_flashdata('message', 'Vous êtes connecté avec succès.');
                $this->session->set_flashdata('status', 'success');
                redirect('company');
            } 
            else {  
                $this->session->set_flashdata('message', 'Vous êtes connecté avec succès.');
                $this->session->set_flashdata('status', 'success');
                redirect('user'); 
            }

            
        } 
        else {
            $this->session->set_flashdata('message', 'Identifiant invalide ou mot de passe incorrect. Veuillez réessayer');
            $this->session->set_flashdata('status', 'error');
            $this->load->view('login_view');   
        }
    }
    
    public function forgot_password() {
        if ($this->session->userdata('userId')) {
            redirect('user');
        }
        $this->load->view('forgot_password_view');
    }
    
    public function forgotPassword() {
        $userEmail = $this->input->post('userEmail');
        $resetPasswordToken =  bin2hex(random_bytes(16));

        if($this->Login_model->savePasswordToken($userEmail, $resetPasswordToken)) {
            //send email
            $this->load->library('email');
            $this->email->from('no-reply@cafe-creme.agency', 'Café Crème Community');
            $this->email->to($userEmail); 
            $this->email->subject('Réinitialisation de votre mot de passe');

            // Lien d'activation
            $resetPasswordLink = base_url() . 'login/reset_password?token=' . $resetPasswordToken;

            // // Données à passer à la vue
            // $data = [
            //     'resetPasswordLink' => $resetPasswordLink,
            // ];
            // $body = $this->load->view('email/reset_email', $data, TRUE);
            // $this->email->set_mailtype("html");
            $this->email->message($resetPasswordLink);

            if ($this->email->send()) {
                $this->session->set_flashdata('message', 'Un lien de réinitialisation vous a été envoyé.');
                $this->session->set_flashdata('status', 'success');
                //$this->load->view('login');
                redirect('login');
            }
        }
        else {
            $this->session->set_flashdata('message', 'Cette adresse mail n\'a pas de compte');
            $this->session->set_flashdata('status', 'error');
            $this->load->view('forgot_password_view'); 
        }
        
    }

    public function reset_password() {
        $token = $_GET['token'] ?? '';
        $this->load->model('Login_model');
        $userEmail = $this->Login_model->checkResetPasswordToken($token);
        $data['userEmail'] = $userEmail; 
        $this->load->view('reset_password', $data);
    }

    public function resetPassword() {
        $this->load->model('Login_model');
        $userEmail = $this->input->post('userEmail');
        $userPassword = $this->input->post('userPassword');
        // hash password
        $userPassword = password_hash($userPassword, PASSWORD_DEFAULT);

        $this->Login_model->resetUserPassword($userEmail, $userPassword);
        $this->session->set_flashdata('message', 'Votre mot de passe a bien été mis à jour !');
        $this->session->set_flashdata('status', 'success');
        $this->load->view('login_view');
    }

}
?>
