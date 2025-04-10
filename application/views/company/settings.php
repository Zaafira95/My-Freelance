<?php
// Header Call
$currentPage = 'settings';

include(APPPATH . 'views/layouts/company/header.php' );
?>
<head>
    <title><?='Paramètres '.$company->companyName?>  - My Freelance </title>

<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">
<link href="<?php echo base_url('/node_modules/choices.js/public/assets/styles/choices.min.css');?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('/node_modules/intl-tel-input/build/css/intlTelInput.min.css');?>">



<style>
        /* Barre de progression */
        .password-strength-meter {
            height: 10px;
            background-color: #f3f3f3;
            margin-bottom: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }

        .password-strength-meter-fill {
            height: 100%;
            transition: width 0.3s ease;
            border-radius: 5px;
        }

        .password-strength-weak {
            background-color: #ff4d4f;
            border-radius: 5px;
        }

        .password-strength-medium {
            background-color: #ff7f50;
            border-radius: 5px;
        }

        .password-strength-strong {
            background-color: #52c41a;
            border-radius: 5px;
        }

        /* Couleur du texte */
        .password-strength-weak-text {
            color: #ff4d4f;
        }

        .password-strength-medium-text {
            color: #ff7f50;
        }

        .password-strength-strong-text {
            color: #52c41a;
        }

        .image-rotation {
            transition: opacity 0.5s ease;
            opacity: 0;
        }

       
    </style>
</head>

<?php
$ratedUsersApproved = array(); // Initialiser le tableau pour les utilisateurs approuvés
$ratedUsersWaiting = array();  // Initialiser le tableau pour les utilisateurs en attente

foreach ($ratedUsers as $rating) {
    if ($rating->ratingStatus == 1) {
        // Si ratingStatus est égal à 1, ajoutez l'utilisateur à $ratedUsersApproved
        $ratedUsersApproved[] = $rating;
    } else {
        // Sinon, ajoutez l'utilisateur à $ratedUsersWaiting
        $ratedUsersWaiting[] = $rating;
    }
}
?>

<div class="px-8 py-6 lg:px-4 lg:py-6 h-90 overflow-y-auto no-scrollbar ">
    <div class="flex flex-wrap justify-between mx-auto max-w-screen-xl h-full">
        <div class="h-full w-full mb-3">
            <div class="rounded-lg w-full mb-4 dark:text-white">
                <div class="relative flex grid-cols-2 items-center overflow-hidden bg-white rounded-lg mb-4 dark:bg-gray-800 py-4 px-4">
                    <div class="flex flex-1">
                        <div>
                            <img src="<?=base_url($company->companyLogoPath)?>" class="w-40 h-40 rounded-full" alt="Logo de l'entreprise">
                        </div>
                        <div class="ml-4">
                            <div class="flex">
                                <h1 class="text-5xl font-bold"><?=$company->companyName?></h1>
                            </div>
                            <p class="text-3xl lg:text-2xl text-black-500 font-bold"><?=$company->companySlogan?></p>
                            <h3 class="text-2xl lg:text-xl font-medium text-gray-400">Sector: <?=$company->companySecteur?></h3>
                            <!-- Whatsapp -->
                            <div class="flex flex-wrap items-center">
                                    <!-- Whatsapp -->
                                <!--<a href="https://wa.me/<?=$user->userTelephone?>?text=Bonjour%20<?=$user->userFirstName?>%20!%20Je%20suis%20intéressé%20par%20votre%20profil%20sur%20Café%20Crème%20Community%20!%20" target="_blank">
                                
                                <button type="button" data-te-ripple-init data-te-ripple-color="light"
                                    class="mb-2 mr-4 inline-flex items-center rounded-full px-6 py-2.5 leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg"
                                    style="background-color: #25D366">
                                    <span class="mr-2">Contacter</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                    </svg>
                                    </button>
                                </a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:flex flex-1">
                    <div class="rounded-lg lg:h-full lg:w-1/2 mb-4 lg:mr-4 dark:text-white">
                        <div class="relative lg:flex grid-cols-2 items-center overflow-hidden bg-white lg:h-full w-full rounded-lg mb-4 dark:bg-gray-800 py-8 px-4">
                            <ul class="w-full">
                                <li class="tab-item mb-8 w-full flex"> <a href="#user-data" class="tab-link px-2 text-3xl lg:text-lg font-bold text-primary w-full"><i class="far fa-user mr-4"></i>Personal information</a></li>

                                <li class="tab-item mb-8 w-full flex"> <a href="#company-data" class="tab-link px-2 text-3xl lg:text-lg w-full"><i class="far fa-building mr-4"></i>Professional information</a></li>

                                <li class="tab-item mb-8 w-full flex"> <a href="#user-password" class="tab-link px-2 text-3xl lg:text-lg w-full"><i class="far fa-eye mr-4"></i>Password</a></li>
                                
                                <li class="tab-item"> <a href="#rating" class="tab-link px-2 text-3xl lg:text-lg w-full"><i class="far fa-star mr-4"></i>Reviews</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="rounded-lg lg:h-full lg:w-3/4 mb-4 dark:text-white">
                        <div class="form-container h-full relative flex grid-cols-2 items-center overflow-hidden bg-white rounded-lg mb-4 dark:bg-gray-800 py-4 px-4">
                            <div id="user-data" class="px-6 space-y-4 md:space-y-6 w-full h-full">
                                <form method="post" action="<?php echo base_url('company/updateUserData'); ?>" id="updateUserDataForm" enctype="multipart/form-data">
                                    <label for="userFirstName" class="text-3xl lg:text-base block font-medium text-gray-900 dark:text-white">Your first name *</label>
                                    <input type="text" name="userFirstName" id="userFirstName" value="<?=$user->userFirstName?>" class="text-3xl lg:text-base  w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required>

                                    <label for="userLastName" class="text-3xl lg:text-base  block font-medium text-gray-900 dark:text-white">Your last name *</label>
                                    <input type="text" name="userLastName" id="userLastName" value="<?=$user->userLastName?>" class="text-3xl lg:text-base  w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required>

                                    <label for="userTelephone" class="text-3xl lg:text-base  block font-medium text-gray-900 dark:text-white">Your WhatsApp number *</label>
                                    <input type="tel" name="userTelephone" id="userTelephone" value="<?=$user->userTelephone?>" class="text-3xl lg:text-base  w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required>    
                                    <p id="errorUserTelephone" class="text-red-500 text-3xl lg:text-base mt-2 hidden">Please enter a valid mobile number</p>

                                    <label for="userEmail" class="text-3xl lg:text-base mt-4 block font-medium text-gray-900 dark:text-white">Your email *</label>
                                    <input type="email" name="userEmail" id="userEmail" value="<?=$user->userEmail?>" class="text-3xl lg:text-base  w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" disabled>    

                                    <button type="submit" class="text-3xl lg:text-base  text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg px-5 py-2.5 mt-4 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        Save
                                    </button>
                                </form>
                            </div>
                            <div id="company-data" class="px-6 space-y-4 md:space-y-6 w-full hidden h-full">
                            <form method="post" action="<?php echo base_url('company/updateCompanyData'); ?>" enctype="multipart/form-data">
                                <label for="companyName" class="text-3xl lg:text-base  block font-medium text-gray-900 dark:text-white">Name *</label>
                                <input type="text" name="companyName" id="companyName" value="<?=$company->companyName?>" class="text-3xl lg:text-base w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required>    
                                <label for="companySlogan" class="text-3xl lg:text-base  block font-medium text-gray-900 dark:text-white">Slogan *</label>
                                <input type="text" name="companySlogan" id="companySlogan" value="<?=$company->companySlogan?>" class="text-3xl lg:text-base  w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required>    
                                <label for="companySecteur" class="text-3xl lg:text-base  block font-medium text-gray-900 dark:text-white">Sector *</label>
                                <div class="w-full text-black text-3xl lg:text-base  ">
                                    <select id="secteursAll" name="secteursAll[]"  class="z-10 text-3xl lg:text-base mt-1 block w-full py-2 px-3 border border-gray-300 bg-white text-black rounded-full shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="">Select a sector</option>
                                        <?php foreach ($secteursAll as $secteur): ?>
                                            <option class="text-3xl lg:text-base  dark:text-black" value="<?= $secteur['secteurName'] ?>"
                                                <?= ($company->companySecteur == $secteur['secteurName']) ? 'selected' : '' ?>>
                                            <?= $secteur['secteurName'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    </div>
                                    <input type="text" name="userLinkedinLink" id="userLinkedinLink" value="<?=$user->userLinkedinLink?>" class="text-3xl lg:text-base  hidden mb-2 bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                
                                    <button type="submit" class="text-3xl lg:text-base  text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg px-5 py-2.5 mt-4 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        Save
                                    </button>
                                </form>
                            </div>
                            <div id="user-password" class="px-6 space-y-4 md:space-y-6 hidden w-full h-full">
                                <form method="post" action="<?php echo base_url('company/updateUserPassword'); ?>" enctype="multipart/form-data">

                                <label for="userCurrentPassword" class="text-3xl lg:text-base block font-medium text-gray-900 dark:text-white">Enter your current password *</label>
                                <input type="password" name="userCurrentPassword" id="userCurrentPassword" class="text-3xl lg:text-base w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" oninput="checkCurrentPassword(this.value)" required> 
                                <p id="currentPasswordError" class="text-3xl lg:text-base text-red-500"></p>
                                <label for="userPassword" class="text-3xl lg:text-base block font-medium text-gray-900 dark:text-white">Enter your new password *</label>
                                <input type="password" name="userPassword" id="userPassword" class="text-3xl lg:text-base w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required oninput="checkPasswordStrength(this.value)"> 
                                <label for="confirmPassword" class="text-3xl lg:text-base block font-medium text-gray-900 dark:text-white">Confirm your new password *</label>
                                <input type="password" name="confirmPassword" id="confirmPassword" class="text-3xl lg:text-base w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required  oninput="checkPasswordMatch()"> 

                                <div>
                                    <p id="confirmPasswordError" class="text-3xl lg:text-base text-red-500"></p>
                                </div>

                                <div class="password-strength-meter">
                                    <div class="password-strength-meter-fill"></div>
                                </div>
                                <p id="passwordError" class="text-3xl lg:text-base text-red-500"></p>
                                <div>
                                    <input type="checkbox" id="togglePasswordCheckbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox text-primary rounded mr-2">
                                    <label for="togglePasswordCheckbox" class="text-3xl lg:text-base font-medium text-gray-900 dark:text-white">Show password</label>
                                </div>
                                    <!-- Autres champs d'informations personnelles -->
                                    
                                    <button id="passwordSubmit" type="submit" class="text-3xl lg:text-base text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg px-5 py-2.5 mt-4 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        Save
                                    </button>
                                </form>
                            </div>
                            <div id="rating" class="px-6 space-y-4 md:space-y-6 w-full hidden h-full">
                            <?php
                                if (is_array($ratedUsers) && !empty($ratedUsers)) {
                                    if (is_array($ratedUsersApproved) && !empty($ratedUsersApproved)) {
                                        foreach ($ratedUsersApproved as $rating) {
                                        ?>
                                            <div class="relative">
                                                <a href="<?= base_url('company/freelancerView/'.$rating->userId) ?>" title="Voir le profil" class="flex-shrink-0 w-full ">
                                                    <div class="lg:flex grid-cols-2 items-center mt-4 mb-4">                                             
                                                        <div class="mr-2 mt-2">
                                                            <div class="w-20 h-20">
                                                                <img src="<?=base_url($rating->userAvatarPath)?>" class="object-cover w-20 h-20 rounded-full flex items-center justify-center" alt="User Photo">
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <p class="text-3xl lg:text-lg font-medium lg:ml-4"><?= $rating->userFirstName.' '.$rating->userLastName?></p>
                                                            <p class="text-3xl lg:text-base mt-2 lg:ml-4"><?= '"'.$rating->ratingComment.'"'?></p>
                                                            <div class="flex items-center lg:ml-4">
                                                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                                                    <?php if ($i <= $rating->ratingStars) { ?>
                                                                        <img src="<?php echo base_url('assets/img/fill-star.svg'); ?>" class="w-8 h-8 lg:w-4 lg:h-4">
                                                                    <?php } else { ?>
                                                                        <img src="<?php echo base_url('assets/img/light-star.svg'); ?>" class="w-8 h-8 lg:w-4 lg:h-4">
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </div>
                                                            <p class="text-3xl lg:text-base text-gray-400 mt-2 ml-4"><?=$rating->ratingDate = date('d/m/Y', strtotime($rating->ratingDate))?></p>
                                                        </div>
                                                    </div>
                                                    <div class="absolute bottom-0 right-0">
                                                        <a onclick="showModal('deleteRatingConfirmationModal-<?= $rating->idRating ?>');">
                                                            <button type="button" class="mb-4 text-3xl lg:text-base text-red-600 hover:text-red-900 focus:outline-none ml-2">
                                                            <span>Delete review</span>
                                                            </button>
                                                        </a>
                                                        <div id="deleteRatingConfirmationModal-<?= $rating->idRating ?>" class="hidden fixed inset-0 flex items-center justify-center z-50">
                                                            <div class="fixed inset-0 bg-black opacity-50"></div>
                                                            <div class="relative bg-gray-50 rounded-lg shadow p-6 border border-gray-800 dark:bg-gray-800 sm:p-5">
                                                                <h3 class="text-3xl lg:text-lg font-semibold mb-4">Deletion confirmation</h3>
                                                                <p class="text-3xl lg:text-base text-gray-700 dark:text-white mb-6">Are you sure you want to delete this review?</p>
                                                                <div class="flex justify-end">
                                                                    <button type="button" onclick="hideModal('deleteRatingConfirmationModal-<?= $rating->idRating ?>');" class="text-3xl lg:text-base text-gray-600 inline-flex items-center hover:text-white hover:bg-gray-800 border-gray-600  focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg px-5 py-2.5 text-center dark:border-gray-500 dark:text-gray-500  dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-900">Cancel</button>
                                                                    <a href="<?=base_url('company/deleteRating/'.$rating->idRating)?>" class="text-3xl lg:text-base text-red-800 inline-flex items-center hover:text-white hover:bg-red-900 border-red-900  focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500  dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="mt-4">
                                                </a>
                                            </div>
                                        <?php
                                        }
                                    }
                                    if (is_array($ratedUsersWaiting) && !empty($ratedUsersWaiting)){ ?>
                                        <?php 
                                        foreach ($ratedUsersWaiting as $rating) {
                                        ?>
                                        <div class="relative">
                                            <a href="<?= base_url('company/freelancerView/'.$rating->userId) ?>" title="Voir le profil" class="flex-shrink-0 w-full " target="_blank">
                                                <div class="flex grid-cols-2 items-center mt-4 mb-4">
                                                    <div class="mr-2 mt-2">
                                                            <div class="w-20 h-20">
                                                                <img src="<?=base_url($rating->userAvatarPath)?>" class="w-20 h-20 rounded-full flex items-center justify-center" alt="User Photo">
                                                            </div>
                                                        </div>
                                                    <div>
                                                        <p class="text-lg font-medium ml-4 "><?= $rating->userFirstName.' '.$rating->userLastName?></p>
                                                        <p class="text mt-2 ml-4"><?= '"'.$rating->ratingComment.'"'?></p>
                                                        <div class="flex items-center ml-4">
                                                            <?php for ($i = 1; $i <= 5; $i++) { ?>
                                                                <?php if ($i <= $rating->ratingStars) { ?>
                                                                    <img src="<?php echo base_url('assets/img/fill-star.svg'); ?>" class="w-4 h-4">
                                                                <?php } else { ?>
                                                                    <img src="<?php echo base_url('assets/img/light-star.svg'); ?>" class="w-4 h-4">
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                        <p class="text text-sm text-gray-400 mt-2 ml-4" style="font-style: italic">Pending validation</p>
                                                    </div>
                                                </div>
                                                <div class="absolute bottom-0 right-0">
                                                    <a onclick="showModal('deleteRatingConfirmationModal-<?= $rating->idRating ?>');">
                                                        <button type="button" class="text-red-600 hover:text-red-900 focus:outline-none ml-2">
                                                        <span>Supprimer l'avis</span>
                                                        </button>
                                                    </a>
                                                    <div id="deleteRatingConfirmationModal-<?= $rating->idRating ?>" class="hidden fixed inset-0 flex items-center justify-center z-50">
                                                        <div class="fixed inset-0 bg-black opacity-50"></div>
                                                        <div class="relative bg-gray-50 rounded-lg shadow p-6 border border-gray-800 dark:bg-gray-800 sm:p-5">
                                                            <h3 class="text-lg font-semibold mb-4">Deletion confirmation</h3>
                                                            <p class="text-gray-700 dark:text-white mb-6">Are you sure you want to delete this review?</p>
                                                            <div class="flex justify-end">
                                                                <button type="button" onclick="hideModal('deleteRatingConfirmationModal-<?= $rating->idRating ?>');" class="text-gray-600 inline-flex items-center hover:text-white hover:bg-gray-800 border-gray-600  focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg px-5 py-2.5 text-center dark:border-gray-500 dark:text-gray-500  dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-900">Annuler</button>
                                                                <a href="<?=base_url('company/deleteRating/'.$rating->idRating)?>" class="text-red-800 inline-flex items-center hover:text-white hover:bg-red-900 border-red-900  focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500  dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Supprimer</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <?php
                                        } ?>

                                    <?php
                                    }
                                }
                                else {
                                    ?>
                                        <p class="mt-2 mb-2"> You haven't left any reviews yet. </p>
                                        <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Script JS -->

<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url('/node_modules/choices.js/public/assets/scripts/choices.min.js'); ?>"></script>


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



    document.querySelector("#updateUserDataForm").addEventListener("submit", function(event) {
        
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
$(document).ready(function () {

    const secteurChoices = new Choices('#secteursAll', {
        searchEnabled: true,
        removeItemButton: true,
        itemSelectText: '',
        placeholder: true,
        placeholderValue: 'Select a sector',
    });

    // Cacher tous les formulaires sauf le premier au chargement de la page
    $(".form-container > div:not(:first-child)").hide();

    // Gérer le changement d'onglet lorsque l'utilisateur clique sur un lien d'onglet
    $(".tab-link").click(function (event) {
        event.preventDefault();
        var target = $(this).attr("href");
        $(".form-container > div").hide();
        $(target).fadeIn();

        // Supprimer la classe "text-gray-400" de tous les liens avec la classe "tab-link"
        $(".tab-link").removeClass("font-bold text-primary");
        // Ajouter la classe "text-gray-400" à l'élément cliqué
        $(this).addClass("font-bold text-primary");

        // Mettre à jour l'URL sans recharger la page
        history.pushState(null, null, target);
    });

    // Gérer le retour en arrière du navigateur
    window.addEventListener('popstate', function (event) {
        // Récupérer l'ancien état de l'URL et afficher la section correspondante
        var target = window.location.hash;
        $(".form-container > div").hide();
        $(target).fadeIn();

        // Rétablir la classe "text-gray-400" à tous les liens avec la classe "tab-link"
        $(".tab-link").addClass("text-gray-400");
        // Ajouter la classe "text-gray-400" à l'élément correspondant à l'onglet actif
        $("a[href='" + target + "']").removeClass("text-gray-400");
    });
});

function checkPasswordStrength(userPassword) {
    var strength = 0;

    if (userPassword.length >= 8) {
        // Vérifier si le mot de passe contient au moins une lettre minuscule
        if (/[a-z]/.test(userPassword)) {
            strength += 1;
        }

        // Vérifier si le mot de passe contient au moins une lettre majuscule
        if (/[A-Z]/.test(userPassword)) {
            strength += 1;
        }

        // Vérifier si le mot de passe contient au moins un chiffre
        if (/\d/.test(userPassword)) {
            strength += 1;
        }

        // Vérifier si le mot de passe contient au moins un caractère spécial
        if (/[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/.test(userPassword)) {
            strength += 1;
        }
    }

    // Mettre à jour la barre de progression
    var passwordStrengthMeterFill = document.querySelector('.password-strength-meter-fill');
    var passwordStrengthMeter = document.querySelector('.password-strength-meter');
    passwordStrengthMeterFill.style.width = (strength * 25) + '%';

    // Mettre à jour la couleur de la barre de progression
    passwordStrengthMeterFill.classList.remove('password-strength-weak', 'password-strength-medium', 'password-strength-strong');
    if (strength === 0) {
        passwordStrengthMeterFill.classList.add('password-strength-weak');
    } else if (strength === 1 || strength === 2) {
        passwordStrengthMeterFill.classList.add('password-strength-medium');
    } else if (strength >= 3) {
        passwordStrengthMeterFill.classList.add('password-strength-strong');
    }

    // Mettre à jour le texte de la force du mot de passe
    var passwordError = document.getElementById('passwordError');
    if (strength === 0) {
        passwordError.textContent = 'Weak password';
        passwordError.classList.remove('password-strength-medium-text', 'password-strength-strong-text');
        passwordError.classList.add('password-strength-weak-text');
    } else if (strength === 1 || strength === 2) {
        passwordError.textContent = 'Medium password';
        passwordError.classList.remove('password-strength-weak-text', 'password-strength-strong-text');
        passwordError.classList.add('password-strength-medium-text');
    } else if (strength >= 3) {
        passwordError.textContent = 'Strong password';
        passwordError.classList.remove('password-strength-weak-text', 'password-strength-medium-text');
        passwordError.classList.add('password-strength-strong-text');
    }

    if (strength >=3){
        return true;
    } else {
        return false;
    }
}

function checkPasswordMatch() {
    var passwordInput = document.getElementById('userPassword');
    var confirmPasswordInput = document.getElementById('confirmPassword');
    var confirmPasswordError = document.getElementById('confirmPasswordError');

    var password = passwordInput.value;
    var confirmPassword = confirmPasswordInput.value;

    if (password === confirmPassword) {
        // document.getElementById("passwordSubmit").removeAttribute("disabled");
        confirmPasswordInput.classList.remove('border-red-500');
        confirmPasswordError.textContent = '';
        
        // Vérifier si l'élément confirmPasswordError a la classe 'border-red-500'
        var currentPasswordInput = document.getElementById("userCurrentPassword");
        if (!currentPasswordInput.classList.contains('border-red-500')) {
            document.getElementById("passwordSubmit").removeAttribute("disabled");
            return true;
        }
        return false;
    } else {
        document.getElementById("passwordSubmit").setAttribute("disabled", "true");
        confirmPasswordInput.classList.add('border-red-500');
        confirmPasswordError.textContent = "The passwords do not match";
        return false;
    }
}

const togglePasswordCheckbox = document.getElementById('togglePasswordCheckbox');
const passwordInput = document.getElementById('userPassword');
const confirmPasswordInput = document.getElementById('confirmPassword');
const userCurrentPasswordInput = document.getElementById('userCurrentPassword');

togglePasswordCheckbox.addEventListener('change', function () {
    if (togglePasswordCheckbox.checked) {
        passwordInput.setAttribute('type', 'text');
        confirmPasswordInput.setAttribute('type', 'text');
        userCurrentPasswordInput.setAttribute('type', 'text');
    } else {
        passwordInput.setAttribute('type', 'password');
        confirmPasswordInput.setAttribute('type', 'password');
        userCurrentPasswordInput.setAttribute('type', 'password');
    }
});


function showModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.remove('hidden');
}

function hideModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.add('hidden');
}


function checkCurrentPassword(password) {
    var passwordInput = document.getElementById('userCurrentPassword');
    var passwordError = document.getElementById('currentPasswordError');

    // Vérifiez si le mot de passe est vide
    if (password.trim() === '') {
        passwordInput.classList.remove('border-red-500');
        passwordError.textContent = '';
        return;
    }

    // Envoie d'une requête AJAX pour vérifier le mot de passe
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?php echo base_url('company/checkCurrentPassword'); ?>', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'error') {
                    passwordInput.classList.add('border-red-500');
                    passwordError.textContent = response.message;
                    document.getElementById("passwordSubmit").setAttribute("disabled", "true");
                } else {
                    passwordInput.classList.remove('border-red-500');
                    passwordError.textContent = '';

                    // Vérifier si l'élément confirmPasswordError a la classe 'border-red-500'
                    var confirmPasswordInput = document.getElementById("confirmPassword");
                    if (!confirmPasswordInput.classList.contains('border-red-500')) {
                        document.getElementById("passwordSubmit").removeAttribute("disabled");
                    }
                }
            }
        }
    };
    xhr.send('userCurrentPassword=' + password);
}

$('#updatePassword-form').on('submit', function(event) {
    var passwordError = document.getElementById('currentPasswordError');

    if (passwordError.textContent != '') {
        event.preventDefault(); // Empêcher la soumission du formulaire
    }
});

</script>



