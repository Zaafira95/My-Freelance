<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Geonames {

    private $base_url = 'http://api.geonames.org/';
    private $username = 'kassim___7';

    public function search($query) {
        $endpoint = "searchJSON";
        $url = "{$this->base_url}{$endpoint}?name_startsWith={$query}&maxRows=10&username={$this->username}";

        $response = file_get_contents($url);
        return json_decode($response);
    }

    // Ajoutez d'autres méthodes au besoin pour d'autres appels à l'API GeoNames.
}
