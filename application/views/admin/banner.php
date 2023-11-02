<?php
$currentPage = 'dashboard';


// Header Call
include(APPPATH . 'views/layouts/admin/header.php');
?>
<head>
    <title> Administateur </title>

<style>
    html,
    body {
        height: 85vh;
    }
    #cities-list {
    max-height: 200px; /* ou toute autre valeur appropriée */
    overflow-y: auto;
    /* Ajoutez d'autres styles si nécessaire */
}
.has-border {
    border: 1px solid #e2e8f0; /* Couleur de bordure exemple */
}
</style>
<link rel="stylesheet" href="<?php echo base_url('assets/css/nouislider.min.css');?>">
<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('/node_modules/choices.js/public/assets/styles/choices.min.css');?>" rel="stylesheet" type="text/css">


</head> 


<div class="px-4 lg:px-6 py-6 h-90 overflow-y-auto no-scrollbar">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl h-full">
        <div class="w-full flex gap-6 h-full mb-3">
            <div class="bg-white rounded-lg w-full h-full overflow-y-auto no-scrollbar mb-4 p-8 dark:bg-gray-800 dark:text-white">
                <h1 class="text-2xl font-semibold mb-4">Ajouter une bannière</h1>
                <form action="<?=base_url('admin/addBanner/'.$banner->idBanner)?>" method="post" id ="addBanner" enctype="multipart/form-data">
                    <div>
                        <label for="bannerTitle" class="block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Titre de la bannière</label>
                        <input type="text" name="bannerTitle" id="bannerTitle" value="<?=$banner->bannerTitle?>" class="w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" placeholder="Titre de la bannière">

                        <label for="bannerStatus" class="block mb-2 font-medium text-gray-900 dark:text-white">Souhaitez-vous activer la bannière ?</label>
                        <label class="text-gray-500 mr-3 dark:text-white">Non</label>
                        <input type="checkbox" name="bannerStatus" id="bannerStatus" class="relative shrink-0 w-[3.25rem] h-7 bg-gray-100 checked:bg-gray-100 rounded-full cursor-pointer transition-colors ease-in-out duration-200 border border-transparent ring-1 ring-transparent focus:border-green-600 focus:ring-green-600 ring-offset-white focus:outline-none appearance-none dark:bg-gray-700 dark:checked:bg-green-600 dark:focus:ring-offset-gray-800 before:inline-block before:w-6 before:h-6 before:bg-white checked:before:bg-green-500 before:translate-x-0 checked:before:translate-x-full before:shadow before:rounded-full before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-gray-400 dark:checked:before:bg-green-200" <?php echo ($banner->bannerStatus === 'active') ? 'checked' : ''; ?>>
                        <label class="text-gray-500 ml-3 dark:text-white">Oui</label>

                        <label for="bannerMessage" class="block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Message de la bannière</label>
                        <input type="text" name="bannerMessage" id="bannerMessage" value="<?=$banner->bannerMessage?>" class="w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" placeholder="Message de la bannière">

                        <label for="bannerCta" class="block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Message du lien (CTA)</label>
                        <input type="text" name="bannerCta" id="bannerCta" value="<?=$banner->bannerCta?>" class="w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" placeholder="Message du lien (CTA)">

                        <label for="bannerLink" class="block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Lien de la bannière </label>
                        <input type="text" name="bannerLink" id="bannerLink" value="<?=$banner->bannerLink?>" class="w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" placeholder="Lien de la bannière">
                    
                        <p id="errorMessage" class="text-red-500  mt-2 hidden">Veuillez remplir tous les champs correctement</p>
                    </div>
                    <div class="flex items-center space-x-4 mt-4">
                        <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Valider
                        </button>
                        <!-- <button type="button" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Annuler
                        </button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
