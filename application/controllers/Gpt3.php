<?php
class Gpt3 extends CI_Controller {
    public function generer_message() {
        // Récupérez les données de la mission et du profil du freelance
        $mission = "Description de la mission XYZ...";
        $profil_freelance = "Compétences et expérience du freelance...";

        // Construisez le texte d'entrée pour l'API GPT-3
        $texte_entree = "Un freelance exprime son intérêt pour la mission : " . $mission . " avec les compétences suivantes : " . $profil_freelance;

        // Effectuez l'appel à l'API GPT-3 via cURL
        $url = 'https://api.openai.com/v1/engines/text-davinci-002/completions';
        $headers = array(
            'Authorization: Bearer VOTRE_CLE_D_API_GPT3',
            'Content-Type: application/json',
        );
        $data = array(
            'prompt' => $texte_entree,
            'temperature' => 0.7,
            'max_tokens' => 100,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $resultat = curl_exec($ch);
        curl_close($ch);

        // Récupérez le message généré à partir de la réponse de l'API
        $message_genere = json_decode($resultat, true)['choices'][0]['text'];

        // Affichez le message généré à l'utilisateur
        // Vous pouvez le passer à votre vue pour l'afficher
        // echo $message_genere;
    }
}
?>