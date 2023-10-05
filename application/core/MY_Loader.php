<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader {

    public function __construct()
    {
        parent::__construct();
    }

    // public function view($view, $vars = array(), $return = FALSE)
    // {
    //     // Afficher le loader
    //     echo '<div class="loader-overlay" id="loaderOverlay">';
    //     echo '<img src="' . base_url('assets/img/logo.svg') . '" class="loader w-40 h-25" alt="Loading...">';
    //     echo '</div>';

    //     // Charger la vue
    //     return parent::view($view, $vars, $return);
    // }
}
