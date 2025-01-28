<?php
$currentPage = 'my_company';


// Header Call
include(APPPATH . 'views/layouts/company/header.php');
?>
<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/nouislider.min.css');?>">
    <link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('/node_modules/choices.js/public/assets/styles/choices.min.css');?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('/node_modules/intl-tel-input/build/css/intlTelInput.min.css');?>">

    <title><?=$company->companyName?> - Café Crème Community </title>

    <style>
    .ql-container {
      height: auto;
    }
  </style>
</head>

<!--Company Data modal -->
<div id="updateCompanyData" tabindex="-1" aria-hidden="true" class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-80 lg:w-60 h-90 overflow-y-auto no-scrollbar">

        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-3xl lg:text-lg font-semibold text-gray-900 dark:text-white">
                    Votre entreprise
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg  p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateCompanyData">
                    <svg aria-hidden="true" class="w-8 h-8 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Fermer</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?=base_url("company/updateCompanyData")?>" id="updateCompanyDataForm" method="post" enctype="multipart/form-data">
                <div class="bg-white dark:bg-gray-800 relative rounded-lg w-full h-auto mb-8">
                    <div class="bg-white dark:bg-gray-800 rounded-lg w-full h-40 lg:w-full flex items-center justify-center">

                        <div class="bg-white dark:bg-gray-800 w-full h-full flex items-center justify-center">
                            <?php 
                                if($company->companyBannerPath == null){
                                    $company->companyBannerPath = 'assets/img/default-image-input.jpg';
                                }
                            ?>
                            <img id="banner-image" src="<?=base_url($company->companyBannerPath)?>" class="object-cover w-full h-full rounded-lg dark:bg-gray-800" alt="Image de l'entreprise">
                        </div>
                        <div class="absolute bottom-0 right-0 bg-white rounded-full">
                            <label for="banner-upload">
                                <div class="text-3xl lg:text-base rounded-full p-2 ring ring-primary">
                                    <i class="fas fa-pen text-primary cursor-pointer"></i>
                                </div>
                            </label>
                            <input type="file" id="banner-upload" name="banner-upload" class="hidden" accept=".png, .jpeg, .jpg" onchange="showFileName(this, 'banner-image', 'logoBannerErrorMessage')">
                        </div>
                    </div>
                    <div class="">
                        <div class="relative rounded-full border-10 w-32 h-32 lg:w-20 lg:h-20 flex items-center justify-center" style="margin-top:-50px;">
                            <img id="logo-image" src="<?=base_url($company->companyLogoPath)?>" class="object-cover w-full h-full rounded-full ring-8 ring-white dark:ring-gray-800" alt="Image de l'entreprise">
                            <div class="absolute bottom-0 right-0 bg-white rounded-full">
                                <label for="logo-upload">
                                    <div class="text-3xl lg:text-base rounded-full p-2 ring ring-primary">
                                        <i class="fas fa-pen text-primary cursor-pointer"></i>
                                    </div>
                                </label>
                                <input type="file" id="logo-upload" name="logo-upload" class="hidden" accept=".png, .jpeg, .jpg" onchange="showFileName(this, 'logo-image', 'logoBannerErrorMessage')">
                            </div>
                        </div>
                    </div>
                </div>
                <p id="logoBannerErrorMessage" class="text-red-500 text-base mb-4 hidden">La taille de l'image doit être inférieur à 2048 Ko</p>

                <div>
                    <label for="companyName" class="text-3xl lg:text-base block mb-1 font-medium text-gray-900 dark:text-white">Nom *</label>
                        <input type="text" name="companyName" id="companyName" value="<?=$company->companyName?>" class="text-3xl lg:text-base mb-4 bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    
                    <label for="companySlogan" class="text-3xl lg:text-base block mb-1  font-medium text-gray-900 dark:text-white">Slogan *</label>
                        <input type="text" name="companySlogan" id="companySlogan" value="<?=$company->companySlogan?>" class="text-3xl lg:text-base mb-4 bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    
                    <label for="companySecteur" class="text-3xl lg:text-base block mb-1  font-medium text-gray-900 dark:text-white">Secteur d'activité *</label>
                    <div class="text-3xl lg:text-base w-full text-black mb-4">
                        <select id="secteursAll" name="secteursAll[]"  class="text-3xl lg:text-base  mt-1 block w-full py-2 px-3 border border-gray-300 bg-white text-black rounded-full shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Sélectionnez un secteur</option>
                            <?php foreach ($secteursAll as $secteur): ?>
                                <option class="dark:text-black" value="<?= $secteur['secteurName'] ?>"
                                    <?= ($company->companySecteur == $secteur['secteurName']) ? 'selected' : '' ?>>
                                <?= $secteur['secteurName'] ?></option>
                            <?php endforeach; ?>
                        </select> 
                    </div>                    
                    <label for="companyCity" class="text-3xl lg:text-base block mb-1 font-medium text-gray-900 dark:text-white">Localisation *</label>
                    <div class="relative city-search-container w-full mb-4">
                        <input type="text" id="citySearch" name="companyLocalisation" value="<?=$company->companyLocalisation?>" placeholder="Cherchez votre ville" class="text-3xl lg:text-base border p-2 rounded-lg w-full text-black">
                            <div id="cities-list" class="text-3xl lg:text-base absolute z-10 mt-2 w-full  rounded bg-white max-h-64 overflow-y-auto text-black"></div>
                    </div>
                    <div class="flex items-center mb-4">
                            <input type="checkbox" id="companyEtranger" name="companyEtranger" <?php echo $company->companyLocalisation === 'Etranger' ? 'checked' : "" ?>>
                            <label class="text-3xl lg:text-base ml-2 text-gray-500 dark:text-gray-400">Étranger</label>
                     </div>
                    <label for="userLinkedinLink" class="text-3xl lg:text-base block mb-1  font-medium text-gray-900 dark:text-white">Lien LinkedIn</label>
                        <input type="text" name="userLinkedinLink" id="userLinkedinLink" value="<?=$user->userLinkedinLink?>" class="text-3xl lg:text-base mb-4 bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" onblur="checkLinkedinLink()">


                    <label for="companyWebsite" class="text-3xl lg:text-base block mb-1  font-medium text-gray-900 dark:text-white">Lien du site internet</label>
                        <input type="text" name="companyWebsite" id="companyWebsite" value="<?=$company->companyWebsite?>" class="text-3xl lg:text-base mb-4 bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" onblur="checkWebsiteLink()">
                    
                                        <label for="userTelephone" class="text-3xl lg:text-base block mb-1  font-medium text-gray-900 dark:text-white">Votre numéro WhatsApp * </label>
                        <input type="tel" name="userTelephone" id="userTelephone" value="<?=$user->userTelephone?>" class="text-3xl lg:text-base mb-4 bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <p id="errorUserTelephone" class="text-red-500 text-3xl lg:text-base mt-2 hidden">Veuillez renseigner un numéro de téléphone valide</p>

                </div>
                <div class="flex items-center space-x-4 mt-6">
                    <button type="submit" class="text-3xl lg:text-base text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Valider
                    </button>
                    <button type="button" data-modal-toggle="updateCompanyData" class="text-3xl lg:text-base text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Company Description modal -->
<div id="updateCompanyDescription" tabindex="-1" aria-hidden="true" class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-80 lg:w-60 h-90 overflow-y-auto no-scrollbar">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-3xl lg:text-lg font-semibold text-gray-900 dark:text-white">
                    Description de votre entreprise
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg  p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateCompanyDescription">
                    <svg aria-hidden="true" class="w-8 h-8 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Fermer</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="descriptionForm" action="<?=base_url("company/updateCompanyDescription")?>" method="post" enctype="multipart/form-data">
                <div>
                    <div id="editor2" class="text-3xl lg:text-base block mb-4 border mt-2 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <div class="ql-editor text-3xl lg:text-base"><?= $company->companyDescription ?></div>
                    </div>
                    <!--<label for="companyDescription" class="block mt-4 mb-2 font-medium text-gray-900 dark:text-white">Description</label>-->
                    <textarea id="companyDescription" name="companyDescription" rows="6" class="text-3xl lg:text-base hidden bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required><?=$company->companyDescription?></textarea>
                    <p id="descriptionErrorMessage" class="text-red-500 text-base mt-2 hidden">La description ne doit pas être vide</p>


                </div>
                <div class="flex items-center space-x-4 mt-4">
                    <button type="submit" class="text-3xl lg:text-base text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Valider
                    </button>
                    <button type="button" data-modal-toggle="updateCompanyDescription" class="text-3xl lg:text-base text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Company Advantages modal -->
<div id="updateCompanyAdvantages" tabindex="-1" aria-hidden="true" class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-80 lg:w-60 h-90 overflow-y-auto no-scrollbar">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-3xl lg:text-lg font-semibold text-gray-900 dark:text-white">
                    Vos avantages
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg  p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateCompanyAdvantages">
                    <svg aria-hidden="true" class="w-8 h-8 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Fermer</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="avantagesForm" action="<?=base_url("company/updateCompanyAdvantages")?>" method="post" enctype="multipart/form-data">
                <div>
                    <div id="editor" class="text-3xl lg:text-base block mb-4 border mt-2 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <div class="ql-editor"><?= $company->companyAdvantages ?></div>
                    </div>
                    <!--<label for="companyDescription" class="block mt-4 mb-2 font-medium text-gray-900 dark:text-white">Description</label>-->
                    <textarea id="companyAvantages" name="companyAvantages" rows="6" class="text-3xl lg:text-base hidden bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required><?=$company->companyAdvantages?></textarea>
                    <p id="avantagesErrorMessage" class="text-red-500 text-base mt-2 hidden">Les avantages ne doivent pas être vide</p>

                </div>
                <div class="flex items-center space-x-4 mt-4">
                    <button type="submit" class="text-3xl lg:text-base text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Valider
                    </button>
                    <button type="button" data-modal-toggle="updateCompanyAdvantages" class="text-3xl lg:text-base text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Company Pictures modal -->
<div id="updateCompanyPhotos" tabindex="-1" aria-hidden="true" class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-80 lg:w-60 h-90 overflow-y-auto no-scrollbar">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-3xl lg:text-lg font-semibold text-gray-900 dark:text-white">
                    Photos de votre entreprise
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg  p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateCompanyPhotos">
                    <svg aria-hidden="true" class="w-8 h-8 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Fermer</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?= base_url("company/updateCompanyPhotos") ?>" method="post" enctype="multipart/form-data">
                <div class="image-container grid lg:grid-cols-2 gap-4">
                <?php foreach ($companyPhotos as $companyPhoto): ?>
                        <div class="rounded-lg flex items-center justify-center mb-2">
                            <div class="relative w-full h-full flex items-center justify-center">
                                <img id="company-image-<?= $companyPhoto->idCompanyPhotos ?>" src="<?= base_url($companyPhoto->companyPhotosPath) ?>" class="rounded-lg" alt="Image de l'entreprise">
                                <div class="absolute right-0 top-0 rounded-lg pt-4 pr-4">
                                    <label for="photo-upload-<?= $companyPhoto->idCompanyPhotos ?>" class="text-3xl lg:text-base py-2.5 px-2.5 text-gray-400 hover:text-gray-900 bg-transparent rounded-lg ml-auto inline-flex items-center">
                                        <div class="cursor-pointer">
                                            <i class="fas fa-pen"></i>
                                        </div>
                                    </label>
                                    <input type="file" id="photo-upload-<?= $companyPhoto->idCompanyPhotos ?>" name="photo-upload-<?= $companyPhoto->idCompanyPhotos ?>" class="hidden" accept=".png, .jpeg, .jpg" onchange="showFileName(this, 'company-image-<?= $companyPhoto->idCompanyPhotos ?>', 'photosUpdateErrorMessage')">
                                    <a href="#" onclick="showModal('deleteImageConfirmationModal-<?= $companyPhoto->idCompanyPhotos ?>');">
                                        <button type="button" class="text-3xl lg:text-base text-red-600 hover:text-red-900 focus:outline-none ml-2">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </a>
                                    <div id="deleteImageConfirmationModal-<?= $companyPhoto->idCompanyPhotos ?>" class="hidden fixed inset-0 flex items-center justify-center z-50">
                                        <div class="fixed inset-0 bg-black opacity-50"></div>
                                        <div class="relative bg-gray-50 rounded-lg shadow p-6 border border-gray-800 dark:bg-gray-800 sm:p-5">
                                            <h3 class="text-2xl lg:text-lg font-semibold mb-4">Confirmation de suppression</h3>
                                            <p class="text-3xl lg:text-base text-gray-700 dark:text-white mb-6">Êtes-vous sûr de vouloir supprimer cette image ?</p>
                                            <div class="flex justify-end">
                                                <button type="button" onclick="hideModal('deleteImageConfirmationModal-<?= $companyPhoto->idCompanyPhotos ?>');" class="text-3xl lg:text-base text-gray-600 inline-flex items-center hover:text-white hover:bg-gray-800 border-gray-600  focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg px-5 py-2.5 text-center dark:border-gray-500 dark:text-gray-500  dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-900">Annuler</button>
                                                <a href="<?=base_url('company/deleteCompanyPhoto/'.$companyPhoto->idCompanyPhotos)?>" class="text-3xl lg:text-base text-red-800 inline-flex items-center hover:text-white hover:bg-red-900 border-red-900  focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500  dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Supprimer</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <p id="photosUpdateErrorMessage" class="text-red-500 text-base mt-2 hidden">La taille de l'image doit être inférieur à 2048 Ko</p>
                <div class="flex items-center space-x-4 mt-6">
                    <button type="submit" class="text-2xl lg:text-lg text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Valider
                    </button>
                    <button type="button" data-modal-toggle="updateCompanyPhotos" class="text-2xl lg:text-lg text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Annuler
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<!--Company Pictures modal -->
<div id="addCompanyPhotos" tabindex="-1" aria-hidden="true" class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-80 lg:w-60 h-90 overflow-y-auto no-scrollbar">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-3xl lg:text-lg font-semibold text-gray-900 dark:text-white">
                    Photos de votre entreprise
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg  p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="addCompanyPhotos">
                    <svg aria-hidden="true" class="w-8 h-8 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Fermer</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?= base_url("company/addCompanyPhotos") ?>" method="post" enctype="multipart/form-data">
                <div class="rounded-lg flex flex-wrap items-center justify-center mb-4">
                    <div class="w-full h-full flex items-center justify-center">
                        <img id="company-image" src="<?php echo base_url('assets/img/default-image-input.jpg'); ?>" class=" max-h-64 max-w-xs rounded-lg" alt="Image de l'entreprise">
                    </div>
                    <div class="flex items-center justify-center w-full">
                        <p id="photosAddErrorMessage" class="text-red-500 text-base mt-2 hidden">La taille de l'image doit être inférieur à 2048 Ko</p>
                    </div>
                    <label for="photo-upload" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 mt-4 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-pointer">
                        <span class="filename">Choisir une image</span>
                    </label>
                    <input type="file" id="photo-upload" name="photo-upload" class="hidden" accept=".png, .jpeg, .jpg" onchange="showFileName(this, 'company-image', 'photosAddErrorMessage')">
                </div>
                <div class="flex items-center space-x-4 mt-10">
                    <button type="submit" class="text-3xl lg:text-base text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Valider
                    </button>
                    <button type="button" data-modal-toggle="addCompanyPhotos" class="text-3xl lg:text-base text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="px-8 py-6 lg:px-4 lg:py-6 h-full no-scrollbar">
    <div class="justify-between mx-auto max-w-screen-xl h-full">
        <div class="h-full w-full mb-3">
            <div class="bg-white rounded-lg w-full mb-4 dark:text-white dark:bg-gray-800 relative">
                <div class="bg-white dark:bg-gray-800 relative rounded-lg w-full h-auto mb-8">
                    <div class="bg-white dark:bg-gray-800 rounded-lg w-full h-48 flex items-center justify-center">
                        <div class="bg-white dark:bg-gray-800 w-full h-full flex items-center justify-center">
                            <?php 
                                if($company->companyBannerPath == null){
                                    $company->companyBannerPath = 'assets/img/default-image-input.jpg';
                                }
                            ?>
                            <img src="<?=base_url($company->companyBannerPath)?>" class="object-cover w-full h-full rounded-lg dark:bg-gray-800" alt="Image de l'entreprise">
                        </div>
                    </div>
                    <div class="w-full flex justify-between">
                        <div class="rounded-full border-10 w-40 h-40 flex items-center justify-center" style="margin-top:-50px;">
                            <img src="<?=base_url($company->companyLogoPath)?>" class="ml-4 object-cover w-full h-full rounded-full ring-8 ring-white dark:ring-gray-800" alt="Image de l'entreprise">
                        </div> 
                        <button id="updateCompanyData" data-modal-toggle="updateCompanyData" class="text-3xl lg:text-base ml-4 mr-4 text-primary hover:text-blue-600" type="button">
                            <p>Modifier mes informations</p>
                        </button>
                    </div>                   
                    <?php if($user->userType == 'sales') { ?>
                    <div class="w-full flex justify-end mb-4 mr-4">
                        
                    </div>
                    <?php } ?>
                    
                </div>
                <div class="relative px-4 flex flex-wrap justify-between mt-4">
                    <div>
                        <h2 class="text-5xl font-bold flex items-center"><?= $company->companyName ?></h2>
                        <h3 class="text-3xl lg:text-2xl font-medium"><?=$company->companySlogan?></h3>
                        <h3 class="text-2xl lg:text-xl font-medium text-gray-400">Secteur d'activité : <?=$company->companySecteur?></h3>
                        <h3 class="text-2xl lg:text-xl font-medium text-gray-400"><?=$company->companyLocalisation?></h3>
                    </div>
                    <div class="flex flex-wrap">
                        <a href="https://wa.me/<?=$user->userTelephone?>?text=Bonjour%20<?=$user->userFirstName?>%20!%20Je%20suis%20intéressé%20par%20votre%20entreprise%20sur%20Café%20Crème%20Community%20!%20" target="_blank">
                            <button type="button" data-te-ripple-init data-te-ripple-color="light"
                            class="mr-4 h-10 inline-flex items-center rounded-full px-6 py-2.5 leading-normal text-white  transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg"
                                style="background-color: #25D366">
                                <span class="mr-2 text-3xl lg:text-base font-medium">Contacter</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                </svg>
                                </button>
                            </a>
                        <?php
                        if (isset($company->companyWebsite) && !empty($company->companyWebsite)){
                        ?>
                            <a href="<?=$company->companyWebsite?>" title="Visiter le site" class="flex-shrink-0 mr-4" target="_blank">
                                <div>
                                    <img src="<?=base_url('assets/img/logo-link/portfolio.png')?>" alt="Logo Website" class="h-10 transition-transform transform hover:scale-110">
                                </div>
                            </a>
                        <?php
                        }
                        if (isset($user->userEmail) && !empty($user->userEmail)){
                        ?>
                            <a href="mailto:<?=$user->userEmail?>" title="Envoyer un mail" class="flex-shrink-0 mr-4">
                                <div>
                                    <img src="<?=base_url('assets/img/logo-link/mail.png')?>" alt="Logo Mail" class="h-10 transition-transform transform hover:scale-110">
                                </div>
                            </a>
                        <?php
                        }
                        if (isset($user->userLinkedinLink) && !empty($user->userLinkedinLink)){
                        ?>
                            <a href="<?=$user->userLinkedinLink?>" title="Visiter le linkedin" class="flex-shrink-0 mr-2" target="_blank">
                                <div>
                                    <img src="<?=base_url('assets/img/logo-link/linkedin.png')?>" alt="Logo Linkedin" class="h-10 transition-transform transform hover:scale-110">
                                </div>
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <ul class="flex flex-wrap mt-10 -mb-px px-4 pb-4 text-primary text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="mr-4" role="presentation">
                        <button class="text-3xl lg:text-base inline-block border-b-2 font-normal text-black hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="myCompanyProfile-tab" data-tabs-target="#myCompanyProfile" type="button" role="tab" aria-controls="myCompanyProfile" aria-selected="false">À propos</button>
                    </li>
                    <li class="mr-4" role="presentation">
                        <button class="text-3xl lg:text-base inline-block border-b-2 font-normal hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="myCompanyMissions-tab" data-tabs-target="#myCompanyMissions" type="button" role="tab" aria-controls="myCompanyMissions" aria-selected="false">Missions</button>
                    </li>
                </ul>
            </div>  
            <div id="relative myTabContent w-full">
                <div class="hidden" id="myCompanyProfile" role="tabpanel" aria-labelledby="myCompanyProfile-tab">
                    <div class="relative bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                        <h2 class="text-4xl lg:text-xl font-bold mb-4 flex items-center">
                            Description de l'entreprise
                        </h2>
                        <div class="text-3xl lg:text-base richTextList items-center justify-between">
                            <div class="text-3xl lg:text-base font-normal mb-4">
                                <?=$company->companyDescription?>
                            </div>
                        </div>
                        <?php if($user->userType == 'sales') { ?>
                        <div class="absolute top-0 right-0 mt-4 mr-4 flex">
                            <button id="updateCompanyDescription" data-modal-toggle="updateCompanyDescription" class="text-3xl lg:text-base py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                <i class="fas fa-pen fa-fw"></i>
                            </button>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="relative bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                        <h2 class="text-4xl lg:text-xl font-bold mb-4 flex items-center">
                            Les avantages de l'entreprise
                        </h2>
                        <div class="text-3xl lg:text-base richTextList flex items-center justify-between">
                            <div class="text-3xl lg:text-base font-normal mb-4">
                                <?=$company->companyAdvantages?>
                            </div>
                        </div>
                        <?php if($user->userType == 'sales') { ?>
                        <div class="absolute top-0 right-0 mt-4 mr-4 flex">
                            <button id="updateCompanyAdvantages" data-modal-toggle="updateCompanyAdvantages" class="text-3xl lg:text-base py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                <i class="fas fa-pen fa-fw"></i>
                            </button>
                        </div>
                        <?php } ?>
                    </div>

                    <div class="relative bg-white rounded-lg mt-4 mb-4 py-4 dark:bg-gray-800 dark:text-white">
                        <h2 class="text-4xl lg:text-xl font-bold mb-4 pl-4 flex items-center">
                            Photos de l'entreprise
                        </h2>
                        <div class="overflow-x-auto flex pb-4 px-4 gap-4 no-scrollbar">
                            <?php $imageCount = 0; ?>
                            <?php foreach($companyPhotos as $companyPhoto): 
                                $imageCount++; ?>
                                <div class="rounded-lg flex items-center justify-center">
                                    <div class="w-full h-full flex items-center justify-center" style="width:500px; height:500px;">
                                        <img src="<?=base_url($companyPhoto->companyPhotosPath)?>" class="object-cover w-full h-full rounded-lg" alt="Image de l'entreprise" style="width:100%;">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php if($user->userType == 'sales') { ?>
                        <div class="absolute top-0 right-0 mt-4 mr-4 flex">
                            <?php if($imageCount < 4) { ?>
                                <button id="addCompanyPhotos" data-modal-toggle="addCompanyPhotos" class="text-3xl lg:text-base py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                    <i class="fas fa-plus fa-fw"></i>
                                </button>
                            <?php }   ?> 

                            <?php
                            if ($companyPhotos != null) {
                            ?>
                            <button id="updateCompanyPhotos" data-modal-toggle="updateCompanyPhotos" class="text-3xl lg:text-base py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                <i class="fas fa-pen fa-fw"></i>
                            </button>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="hidden" id="myCompanyMissions" role="tabpanel" aria-labelledby="myCompanyMissions-tab">  
                    <div class="flex flex-wrap w-full pb-4 mb-12 mt-4" id="missions-section">
                        <div class="w-full flex flex-wrap justify-between items-center">
                            <h1 class="text-4xl lg:text-2xl font-bold mb-4 mt-4">Nos missions</h1>
                            <a href="<?php echo base_url('Company/missionAdd');?>" class="text-3xl lg:text-base px-4 py-1 rounded-full 2 hover:bg-primary-900 bg-primary text-white">Ajouter une offre</a>
                        </div>
                        <div class="grid lg:grid-cols-2 gap-4">
                        <?php 
                            if (empty($missions)) {
                                echo '<p class="text-center">Aucune mission disponible pour le moment</p>';
                            }
                            else {
                            foreach($missions as $mission): ?>
                                <div class="flex flex-wrap">
                                    <a href="<?=base_url('company/missionView/'.$mission->idMission)?>">
                                        <div class="bg-white rounded-lg h-20vh w-full mt-4 p-4 dark:bg-gray-800 dark:text-white relative mission-item" data-mission-name="<?=strtolower($mission->missionName)?>">
                                            <div class="flex items-center">
                                                <div class="mr-4">
                                                    <img src=<?=base_url($company->companyLogoPath)?> alt="Logo de l'entreprise" class="w-16 h-16 lg:w-10 rounded-full">
                                                </div>
                                                <div class="w-3/4 mr-4">
                                                    <h2 class="font-bold text-3xl lg:text-lg"><?=$mission->missionName?></h2>
                                                    <p class="text-3xl lg:text-base">
                                                        <span class="mr-2"> 
                                                            •   <?= $mission->jobName?>
                                                        </span>
                                                        <span class="mr-2 font-medium"> • TJM : <?=$mission->missionTJM?> €</span>
                                                        
                                                        <span class="mr-2"> •
                                                        <?php
                                                        if ($mission->missionDuration == "courte"){
                                                            $mission->missionDuration = "Courte durée";
                                                        }
                                                        elseif ($mission->missionDuration == "longue"){
                                                            $mission->missionDuration = "Longue durée";
                                                        }
                                                        elseif ($mission->missionDuration == "indefinie"){
                                                            $mission->missionDuration = "Durée indéfinie";
                                                        }                                            
                                                        ?>
                                                        <?=$mission->missionDuration?> 
                                                        </span>
                                                        
                                                        <span class="mr-2"> •
                                                        <?php
                                                        if ($mission->missionType == "temps-plein"){
                                                            $mission->missionType = "Temps Plein";
                                                        }
                                                        elseif ($mission->missionType == "temps-partiel"){
                                                            $mission->missionType = "Temps Partiel";
                                                        }
                                                        elseif ($mission->missionType == "remote"){
                                                            $mission->missionType = "Remote";
                                                        }                                            
                                                        ?>
                                                        <?=$mission->missionType?> 
                                                        </span>

                                                        <span class="mr-2"> • 
                                                        <?php

                                                        if ($mission->missionDeroulement == "teletravail"){
                                                            $mission->missionDeroulement = "Télétravail";
                                                        }
                                                        elseif ($mission->missionDeroulement == "site"){
                                                            $mission->missionDeroulement = "Sur site";
                                                        }
                                                        elseif ($mission->missionDeroulement == "hybride"){
                                                            $mission->missionDeroulement = "Hybride";
                                                        }                                            
                                                        ?>
                                                        <?=$mission->missionDeroulement?>
                                                        </span>

                                                        <span class="mr-2"> • <?=$mission->missionLocalisation?></span>

                                                        <span class="mr-2"> •
                                                        <?php
                                                        if ($mission->missionExpertise == "junior"){
                                                            $mission->missionExpertise = "Junior";
                                                        }
                                                        elseif ($mission->missionExpertise == "intermediaire"){
                                                            $mission->missionExpertise = "Intermédiaire";
                                                        }
                                                        elseif ($mission->missionExpertise == "expert"){
                                                            $mission->missionExpertise = "Expert";
                                                        }
                                                                                            
                                                        ?>
                                                        <?=$mission->missionExpertise?>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <div class="mt-4">
                                                    <div class="font-light mt-4 mb-4 overflow-hidden text-3xl lg:text-base" style="max-height : 6em">
                                                            <?php 
                                                            // limit missionDescription to 270 caracteres and add '...' at the end
                                                            //$mission->missionDescription = strlen($mission->missionDescription) > 370 ? substr($mission->missionDescription,0,370)."..." : $mission->missionDescription;    
                                                            ?>
                                                            <?=$mission->missionDescription?>
                                                        
                                                    </div>
                                                    <div class="skills-container mb-4">
                                                        <?php
                                                            $dataMissionSkills = [];
                                                            $skillsCount = 0;
                                                            foreach ($missionSkills[$mission->idMission] as $skill):
                                                                $dataMissionSkills[] = $skill->skillName;
                                                            $dataMissionSkillsString = implode(',', $dataMissionSkills);
                                                        
                                                                // Déterminer le niveau en fonction de la valeur de missionSkillsExperience
                                                                $level = '';
                                                                $color = '';
                                                                switch ($skill->missionSkillsExperience) {
                                                                    case 1:
                                                                        $level = 'Junior';
                                                                        $color = '#BEE3F8'; // Couleur pour le niveau junior
                                                                        $textdark = "text-black";
                                                                        $text = "text-black";
                                                                        
                                                                        break;
                                                                    case 2:
                                                                        $level = 'Intermediate';
                                                                        $color = '#63B3ED'; // Couleur pour le niveau intermédiaire
                                                                        $textdark = "text-white";
                                                                        $text = "text-black";
                                                                        break;
                                                                    case 3:
                                                                        $level = 'Expert';
                                                                        $color = '#2C5282'; // Couleur pour le niveau expert
                                                                        $textdark = "text-white";
                                                                        $text = "text-white";
                                                                        break;
                                                                    default:
                                                                        $level = 'N/A'; // Si la valeur de missionSkillsExperience n'est pas valide, afficher "N/A"
                                                                        break;
                                                                }
                                                            ?>
                                                            <?php
                                                                // limit $skillsCount at 5
                                                                if ($skillsCount <= 5) {
                                                                ?>
                                                                <div class="text-3xl lg:text-base skill-item" data-level="<?=$level?>">
                                                                    <span class="text-3xl lg:text-base dark:<?=$textdark?> inline-block px-4 py-1 rounded-full <?=$text?>" style="background-color:<?=$color?>;"><?=$skill->skillName?></span>
                                                                    <div class="skill-level"><?=$level?></div>
                                                                </div>
                                                                <?php 
                                                                $skillsCount++;
                                                                } else {
                                                                    break;
                                                                }
                                                                ?>
                                                            <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="absolute top-0 right-4 mt-4 mb-4 z-9">
                                                <?php if($user->userType == 'freelance') { ?>
                                                    <?php
                                                    if(isFavorite($mission->idMission, $favoriteMissions)){
                                                        ?>
                                                        <a href="<?php echo base_url('user/removeFromFavorite/'.$mission->idMission);?>">
                                                            <i class="fas fa-heart text-3xl lg:text-base text-red-800"></i>
                                                        </a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <a href="<?php echo base_url('user/addToFavorite/'.$mission->idMission);?>">
                                                            <i class="far fa-heart text-3xl lg:text-base text-red-800"></i>
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>
                                                <?php } ?>

                                                <?php if($user->userType == 'sales') { ?>
                                                    <a href="<?php echo base_url('company/missionEdit/'.$mission->idMission);?>">
                                                        <button class="text-3xl lg:text-base py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                                            <i class="fas fa-pen fa-fw"></i>
                                                        </button>
                                                    </a>
                                                    <a href="#" onclick="showModal('deleteMissionConfirmationModal-<?= $mission->idMission?>');">
                                                        <button type="button" class="text-3xl lg:text-base text-red-600 hover:text-red-900 focus:outline-none ml-2">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </a>
                                                    <div id="deleteMissionConfirmationModal-<?= $mission->idMission ?>" class="hidden fixed inset-0 flex items-center justify-center z-50">
                                                        <div class="fixed inset-0 bg-black opacity-50"></div>
                                                        <div class="relative bg-gray-50 rounded-lg shadow p-6 border border-gray-800 dark:bg-gray-800 sm:p-5">
                                                            <h3 class="text-lg font-semibold mb-4">Confirmation de suppression</h3>
                                                            <p class="text-gray-700 dark:text-white mb-6">Êtes-vous sûr de vouloir supprimer cette mission ?</p>
                                                            <div class="flex justify-end">
                                                                <button type="button" onclick="hideModal('deleteMissionConfirmationModal-<?= $mission->idMission ?>');" class="text-gray-600 inline-flex items-center hover:text-white hover:bg-gray-800 border-gray-600  focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg px-5 py-2.5 text-center dark:border-gray-500 dark:text-gray-500  dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-900">Annuler</button>
                                                                <a href="<?=base_url('company/deleteMission/'.$mission->idMission)?>" class="text-red-800 inline-flex items-center hover:text-white hover:bg-red-900 border-red-900  focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500  dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Supprimer</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; }?>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url('/node_modules/choices.js/public/assets/scripts/choices.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/quill/quill.js'); ?>"></script>
<script src="<?php echo base_url('/node_modules/intl-tel-input/build/js/intlTelInput.min.js'); ?>"></script>
<script src="<?php echo base_url('/node_modules/intl-tel-input/build/js/intlTelInput.js'); ?>"></script>
<script src="<?php echo base_url('/node_modules/intl-tel-input/build/js/utils.js'); ?>"></script>


<script>

    var base_url = '<?php echo base_url(); ?>'; // Assurez-vous que PHP est exécuté correctement ici

    var input = document.querySelector("#userTelephone");
    var iti = window.intlTelInput(input, {
        preferredCountries: ['us', 'fr', 'ae'],
        utilsScript: base_url + "node_modules/intl-tel-input/build/js/utils.js"
    });



    document.querySelector("#updateCompanyDataForm").addEventListener("submit", function(event) {
        
        var errorMap = ["Numéro invalide", "Code de pays invalide", "Trop court", "Trop long", "Numéro invalide"];
        
        if (iti.isValidNumber()) {
            var phoneNumber = iti.getNumber();
            input.value = phoneNumber;
        } else {
            var errorCode = iti.getValidationError();
            event.preventDefault();
            document.getElementById("errorUserTelephone").style = "display:block"; 
        }
    });


    var quill = new Quill('#editor', {
        theme: 'snow'
    });
    
    var quill2 = new Quill('#editor2', {
        theme: 'snow'
    });


    document.addEventListener('DOMContentLoaded', function() {
        var editors = document.querySelectorAll('.ql-editor');

        editors.forEach(function(editor) {
            editor.addEventListener('paste', function(e) {
                e.preventDefault(); // Empêcher le collage par défaut avec mise en forme

                // Obtenir le texte du presse-papiers en tant que texte brut
                var text = e.clipboardData.getData('text/plain');

                // Insérer le texte brut à la position actuelle du curseur
                if (document.queryCommandSupported('insertText')) {
                    document.execCommand('insertText', false, text);
                } else { // Pour les navigateurs qui ne supportent pas insertText
                    // Récupérer la sélection actuelle
                    var selection = window.getSelection();
                    if (!selection.rangeCount) return false;
                    selection.deleteFromDocument(); // Supprimer la sélection actuelle
                    selection.getRangeAt(0).insertNode(document.createTextNode(text));
                    
                    // Déplacer la sélection après le texte inséré
                    var range = document.createRange();
                    range.setStartAfter(textNode);
                    range.collapse(true);
                    selection.removeAllRanges();
                    selection.addRange(range);
                }
            });
        });
    });

    document.getElementById('descriptionForm').addEventListener('submit', function (e) {
        // Récupérer le contenu HTML de Quill
        var companyElementsHTML = document.querySelectorAll('.ql-editor');

        // Mettre le contenu HTML dans le champ de texte masqué
        document.getElementById('companyDescription').value = companyElementsHTML[0].innerHTML;

        // Mettre le contenu HTML dans le champ de texte masqué
    });

    
    document.getElementById('avantagesForm').addEventListener('submit', function (e) {
        // Récupérer le contenu HTML de Quill
        var companyElementsHTML = document.querySelectorAll('.ql-editor');

        // Mettre le contenu HTML dans le champ de texte masqué
        document.getElementById('companyAvantages').value = companyElementsHTML[1].innerHTML;

        // Mettre le contenu HTML dans le champ de texte masqué
    });

    $(document).ready(function() {
    
        $('#citySearch').on('keyup', function() {
            let term = $(this).val();
            if(term.length > 2) { // Recherche après 2 caractères
                $.post('search_cities', { term: term }, function(data) {
                    let cities = JSON.parse(data);
                    if(cities.length > 0) {
                        // Ajoutez la classe .has-border si des résultats sont retournés
                        $('#cities-list').addClass('has-border');
                    } else {
                        // Supprimez la classe .has-border si aucun résultat n'est retourné
                        $('#cities-list').removeClass('has-border');
                    }
                    $('#cities-list').empty();
                    cities.forEach(function(city) {
                        $('#cities-list').append(`<div class="city-item p-2 hover:bg-gray-200 cursor-pointer" data-id="${city.geoname_id}">${city.name}</div>`);
                    });
                });
            }
            else {
                // Supprimez la classe .has-border si l'input est trop court
                $('#cities-list').removeClass('has-border').empty();
            }
        });

        $(document).on('click', '.city-item', function() {
            let cityName = $(this).text();
            $('#citySearch').val(cityName);  // Mettez à jour le champ de saisie avec le nom de la ville sélectionnée
            $('#cities-list').empty(); // Videz la liste
            $('#cities-list').removeClass('has-border').empty();
        });

        // Pour fermer la liste lorsque vous cliquez en dehors
        $(document).on('click', function(event) {
            // Si le clic n'est pas sur le champ de saisie (#citySearch)
            // et n'est pas sur un élément à l'intérieur de la liste (#cities-list)...
            if (!$(event.target).closest('#citySearch, #cities-list').length) {
                // ... alors videz et fermez la liste.
                $('#cities-list').empty().removeClass('has-border');
            }
        });

        
        $('#companyEtranger').change(function() {
            if ($(this).is(':checked')) {
                $('#citySearch').val('');
            }
        });
        
        $('#citySearch').on('input', function() {
            $('#companyEtranger').prop('checked', false);
        });

    });



    $(document).ready(function () {

        const secteurChoices = new Choices('#secteursAll', {
            searchEnabled: true,
            removeItemButton: true,
            itemSelectText: '',
            placeholder: true,
            placeholderValue: 'Sélectionnez un secteur',
        });
    });
    
    function showFileName(input, elementId, errorMessageId) {
        const MAX_SIZE = 2048; // Taille maximale en Ko
        let imageElement = document.getElementById(elementId);
        let errorMessage = document.getElementById(errorMessageId);
        if (input.files && input.files[0]) {
            const fileSize = input.files[0].size / 1024; // Taille en Ko
            if (fileSize > MAX_SIZE) {
            // Afficher un message d'erreur
            errorMessage.classList.remove("hidden");
            return; // Arrêter l'exécution si le fichier est trop grand
        }

            var reader = new FileReader();
            reader.onload = function(e) {
                imageElement.src = e.target.result;
                errorMessage.classList.add("hidden");

            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function showModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('hidden');
    }

    function hideModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.add('hidden');
    }
    
    // function to check on input of userLinkedinLink if there is https:// or http:// in the url after the user leaves the input and give me the html
    function checkLinkedinLink() {
        let linkedinLink = document.getElementById('userLinkedinLink');
        let linkedinLinkValue = linkedinLink.value;
        if (linkedinLinkValue !== '') {
            if (!linkedinLinkValue.startsWith('https://') && !linkedinLinkValue.startsWith('http://')) {
                linkedinLink.value = 'https://' + linkedinLinkValue;
            }
        }
    }
    
    function checkWebsiteLink(){
        let websiteLink = document.getElementById('companyWebsite');
        let websiteLinkValue = websiteLink.value;
        if (websiteLinkValue !== '') {
            if (!websiteLinkValue.startsWith('https://') && !websiteLinkValue.startsWith('http://')) {
                websiteLink.value = 'https://' + websiteLinkValue;
            }
        }   
    }

// Vérifie avant de soumettre le formulaire si companyDescription ne contient pas que des balises html, car par défaut il prend la valeur <p><br></p> si vide
    document.getElementById('descriptionForm').addEventListener('submit', function (e) {
        let companyDescription = document.getElementById('companyDescription').value;
        if (companyDescription === "<p><br></p>") {
            e.preventDefault();
            var descriptionErrorMessage = document.getElementById('descriptionErrorMessage');
            descriptionErrorMessage.classList.remove("hidden");
            // alert('La description de l\'entreprise ne peut pas être vide');
        }
        // vérifie si il n'y a pas que des balises html
        else if (!companyDescription.replace(/<[^>]+>/g, '').trim()) {
            e.preventDefault();
            var descriptionErrorMessage = document.getElementById('descriptionErrorMessage');
            descriptionErrorMessage.classList.remove("hidden");
            // alert('La description de l\'entreprise ne peut pas être vide');
        }
        // Si y'a un élément span avec du style il faut que tu me retire l'élément span pour que le texte soit homogène
        

    
    });


    // Vérifie avant de soumettre le formulaire si companyAvantages ne contient pas que des balises html, car par défaut il prend la valeur <p><br></p> si vide
    document.getElementById('avantagesForm').addEventListener('submit', function (e) {
        let companyAvantages = document.getElementById('companyAvantages').value;
        if (companyAvantages === "<p><br></p>") {
            e.preventDefault();
            var avantagesErrorMessage = document.getElementById('avantagesErrorMessage');
            avantagesErrorMessage.classList.remove("hidden");
            // alert('La description de l\'entreprise ne peut pas être vide');
        }
        // vérifie si il n'y a pas que des balises html
        else if (!companyAvantages.replace(/<[^>]+>/g, '').trim()) {
            e.preventDefault();
            var avantagesErrorMessage = document.getElementById('avantagesErrorMessage');
            avantagesErrorMessage.classList.remove("hidden");

            // alert('La description de l\'entreprise ne peut pas être vide');
        }
    });

    
    
  
</script>
