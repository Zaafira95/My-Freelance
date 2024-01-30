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

            // Redirection administateur

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
        $this->load->view('login_view');
    }
    
    public function forgotPassword() {
        $userEmail = $this->input->post('userEmail');
        $resetPasswordToken =  bin2hex(random_bytes(16));

        if($this->Login_model->savePasswordToken($userEmail, $resetPasswordToken)) {
            //send email
            $this->session->set_flashdata('message', 'Un lien de réinitialisation vous a été envoyé.');
            $this->session->set_flashdata('status', 'success');
            $this->load->view('login');
        }
        else {
            $this->session->set_flashdata('message', 'Cette adresse mail n\'a pas de compte');
            $this->session->set_flashdata('status', 'error');
            $this->load->view('forgot_password_view'); 
        }
        
    }

    public function send_email()
{
    $to = 'kassim@cafe-creme.agency';
    $subject = 'Sujet de l\'email';
    $message = 'Contenu de l\'email';

    $headers = "From: kassim91000@gmail.com\r\n";
    $headers .= "Reply-To: kassim91000@gmail.com\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $message, $headers)) {
        echo 'Email envoyé avec succès.';
        var_dump($to);
        var_dump($subject);
        var_dump($message);
        var_dump($headers);
        die;
    } else {
        echo 'Erreur lors de l\'envoi de l\'email.';
    }
}

}
?>
