<?php
// Header Call
$currentPage = 'whatsapp';

include(APPPATH . 'views/layouts/user/header.php' );
?>
<head>
    <title>Communauté WhatsApp | Café Crème Community </title>

<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>


</head>


<div id="updateProductModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Votre disponibilité
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg  p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateProductModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Fermer</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?=base_url("user/updateAvailability")?>" method="post">
                    <div>
                        <label for="name" class="block mb-2  font-medium text-gray-900 dark:text-white">Êtes-vous disponible pour travailler dès maintenant ?</label>
                        <label class=" text-gray-500 mr-3 dark:text-gray-400">Non</label>
                        <input type="checkbox" name="userIsAvailable" id="hs-basic-with-description" <?php echo $checkboxChecked; ?> class="relative shrink-0 w-[3.25rem] h-7 bg-gray-100 checked:bg-gray-100 rounded-full cursor-pointer transition-colors ease-in-out duration-200 border border-transparent ring-1 ring-transparent focus:border-green-600 focus:ring-green-600 ring-offset-white focus:outline-none appearance-none dark:bg-gray-700 dark:checked:bg-green-600 dark:focus:ring-offset-gray-800 before:inline-block before:w-6 before:h-6 before:bg-white checked:before:bg-green-500 before:translate-x-0 checked:before:translate-x-full before:shadow before:rounded-full before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-gray-400 dark:checked:before:bg-green-200">
                        <label class=" text-gray-500 ml-3 dark:text-gray-400">Oui</label>
                    </div>
                <div class="flex items-center space-x-4 mt-4">
                    <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Valider
                    </button>
                    <button type="button" data-modal-toggle="updateProductModal" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="absolute hidden top-0 right-4 mt-4 mb-4">
    <svg id="heart" class="w-5 h-5 text-red-600 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 30" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.879c-2.484-4.375-12-1.82-12 4.879 0 5.572 5.126 7.664 12 14.121 6.874-6.457 12-8.549 12-14.121 0-6.699-9.516-9.254-12-4.879z"/>
    </svg>
</div>

<div class="px-4 lg:px-6 py-6 h-full overflow-y-auto no-scrollbar">
    <div class="flex-wrap justify-between items-center mx-auto max-w-screen-xl h-full">
        <div class="gap-6 h-full mb-3">
            <div class="w-full overflow-y-auto no-scrollbar">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white py-4 px-4">
                    Rejoignez les groupes de la plus grande communauté de freelance en France
                </h1>
                <div class="items-center overflow-hidden py-4 px-4">
                    <div class="grid grid-cols-4 gap-4">
                        <!-- Remplacez les informations de chaque groupe avec vos propres données -->
                        <?php $count = 0; ?>
                        <?php foreach ($groups as $group) : ?>
                            <div class="bg-white  mb-4 dark:bg-gray-800 shadow-md rounded-lg p-6">
                                <!-- Icône du groupe -->
                                <img src="<?php echo base_url($group->whatsAppGroupImage); ?>" alt="Icone du groupe" class="rounded-full mx-auto mb-4" style="width:120px; height:120px;">

                                <!-- Nom du groupe -->
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white"><?= $group->whatsAppGroupName?></h3>

                                <!-- Description du groupe -->
                                <p class="text-gray-600 mb-4 dark:text-white"><?= $group->whatsAppGroupDescription?></p>

                                <!-- Bouton pour rejoindre le groupe -->
                                <a href="<?= $group->whatsAppGroupLink?>" class="block w-full text-center bg-primary hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-full hover:shadow-md transition duration-300 dark:text-white">Rejoindre</a>
                            </div>
                            <?php $count++; ?>
                        <?php endforeach; ?>
                    </div>
                    <form method="post" class="bg-white dark:bg-gray-800 px-4 py-4 rounded-lg mt-4" action="<?php echo site_url('user/addWhatsAppGroup'); ?>">
                        <h3 class="text-lg font-semibold text-primary dark:text-white">Seulement pour admin (en cours de dev)</h3>

                        <label for="whatsAppGroupName" class="block mb-1  font-medium text-gray-900 dark:text-white">Nom du groupe</label>
                        <input type="text" id="whatsAppGroupName" name="whatsAppGroupName" class="w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500">

                        <label for="whatsAppGroupDescription" class="block mb-1  font-medium text-gray-900 dark:text-white">Description du groupe</label>
                        <textarea id="whatsAppGroupDescription" name="whatsAppGroupDescription" class="w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500"></textarea>

                        <label for="whatsAppGroupLink" class="block mb-1  font-medium text-gray-900 dark:text-white">Lien du groupe</label>
                        <input type="text" id="whatsAppGroupLink" name="whatsAppGroupLink" class="w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500">

                        <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Ajouter le groupe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
