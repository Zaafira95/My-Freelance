<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>
<link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">

<style>
    .center-screen {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    body {
        background-color: white;
    }

    .container {
        display: flex;
        justify-content: center; /* Centre horizontalement */
    }

    .container img {
        display: block; /* Empêche les marges par défaut des images en ligne */
    }

</style>


</head>
<body>

<div class="center-screen">
    <div class="text-center">
        <img src="<?php echo base_url('assets/img/loader.gif');?>" alt="404" class="w-60 mx-auto">
        <div class="rounded-lg bg-white p-8">
            <h1 class="mb-4 text-4xl font-bold">404</h1>
            <p class="text-gray-600">Oups ! La page que vous recherchez est introuvable.</p>
            <a href="<?php echo base_url('/');?>" class="mt-4 inline-block rounded bg-primary px-4 py-2 font-semibold text-white hover:bg-blue-600"> Retour à l'accueil </a>
        </div>
    </div>
</div>

</body>
</html>