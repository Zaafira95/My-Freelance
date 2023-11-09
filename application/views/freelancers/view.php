<?php
// Header Call
$currentPage = 'freelancers';

include(APPPATH . 'views/layouts/company/header.php' );
?>
<head>
    <title><?=$freelancer->userFirstName.' '.$freelancer->userLastName.' '.ucfirst($freelancer->userType)?>  - Café Crème Community </title>

<style>
    html,
    body {
        height: 100vh;
    }
    .pdf-thumbnail-img {
    max-width: 100%;
    height: auto;
    cursor: pointer;
    border-radius: 4px;
}

.full-pdf-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    display: none;
    z-index: 9999;
    overflow: auto;
}

.full-pdf-container canvas {
    display: block;
    margin: 20px auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 4px;
}





</style>

<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">
<link href="<?php echo base_url('/node_modules/choices.js/public/assets/styles/choices.min.css');?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('/node_modules/intl-tel-input/build/css/intlTelInput.min.css');?>">



</head>


<!-- Give rating modal -->
<div id="addRating" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Donnez votre avis sur <?=$freelancer->userFirstName  ?> <?=$freelancer->userLastName  ?>  
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg  p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="addRating">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Fermer</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?=base_url("company/addRating/".$freelancer->userId)?>" method="post" enctype="multipart/form-data">
                <div>
                <div class="flex items-center">                    
                <label for="ratingStars" class="block mr-4 font-medium text-gray-900 dark:text-white">Votre note : </label>

                <img src="<?php echo base_url('assets/img/light-star.svg'); ?>" class="star w-6 h-6" onclick="setRating(1)">
                <img src="<?php echo base_url('assets/img/light-star.svg'); ?>" class="star w-6 h-6" onclick="setRating(2)">
                <img src="<?php echo base_url('assets/img/light-star.svg'); ?>" class="star w-6 h-6" onclick="setRating(3)">
                <img src="<?php echo base_url('assets/img/light-star.svg'); ?>" class="star w-6 h-6" onclick="setRating(4)">
                <img src="<?php echo base_url('assets/img/light-star.svg'); ?>" class="star w-6 h-6" onclick="setRating(5)">
                </div>

                <input type="text" name="ratingStars" id="ratingStars" value="0" class="hidden mb-2 bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>

                    
                    <label for="ratingComment" class="block mt-4 mb-2 font-medium text-gray-900 dark:text-white">Votre commentaire</label>
                        <textarea id="ratingComment" name="ratingComment" rows="6" class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> </textarea>

                </div>
                <div class="flex items-center space-x-4 mt-4">
                    <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Valider
                    </button>
                    <button type="button" data-modal-toggle="addRating" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<div id="sendMessage" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Contacter : <?=$freelancer->userFirstName.' '.$freelancer->userLastName?>
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="sendMessage">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Fermer</span>
                </button>
            </div>
            <form action="<?= base_url("company/sendMessage/".$freelancer->userId) ?>" method="post" id="sendMessage" enctype="multipart/form-data">
                <div>
                    <label for="name" class="block mb-2 font-medium text-gray-900 dark:text-white">Souhaitez-vous contacter ce freelance pour l'une de vos missions ?</label>
                    <label class="text-gray-500 mr-3 dark:text-gray-400">Non</label>
                    <input type="checkbox" name="contactOrNot" id="hs-basic-with-description" class="relative shrink-0 w-[3.25rem] h-7 bg-gray-100 checked:bg-gray-100 rounded-full cursor-pointer transition-colors ease-in-out duration-200 border border-transparent ring-1 ring-transparent focus:border-green-600 focus:ring-green-600 ring-offset-white focus:outline-none appearance-none dark:bg-gray-700 dark:checked:bg-green-600 dark:focus:ring-offset-gray-800 before:inline-block before:w-6 before:h-6 before:bg-white checked:before:bg-green-500 before:translate-x-0 checked:before:translate-x-full before:shadow before:rounded-full before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-gray-400 dark:checked:before:bg-green-200">
                    <label class="text-gray-500 ml-3 dark:text-gray-400">Oui</label>
                    <label for="companyJobs" id="labelCompanyJobs" class="hidden mt-4 mb-2 font-medium text-gray-900 dark:text-white" id="companyJobsLabel">Sélectionnez votre mission</label>
                    <select id="companyJobsSelect" name="companyJobs" class="hidden mb-2 bg-gray-50 border mt-2 border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> <!-- Utilisez la classe hidden pour masquer par défaut -->
                        <?php foreach ($job_for_company as $mission): ?>
                            <option value="<?= $mission->idMission ?>"><?= $mission->missionName.' - '.$mission->missionTJM.'€'?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="message" id="labelMessage" class="hidden mt-4 mb-2 font-medium text-gray-900 dark:text-white">Votre message</label>
                    <textarea name="companyMessage" id="companyMessage" cols="20" rows="5" class="hidden bg-gray-50 border mt-2 border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                    
                    <label for="message" id="labelMessageDefault" class="block mt-4 mb-2 font-medium text-gray-900 dark:text-white">Votre message</label>
                    <textarea name="companyMessageDefault" id="companyMessageDefault" cols="20" rows="5" class="block bg-gray-50 border mt-2 border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                </div>
                <div class="flex items-center space-x-4 mt-4">
                <button type="submit" id="validerButton" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Valider
                </button>
                <button type="button" data-modal-toggle="sendMessage" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                    Annuler
                </button>
                </div>
            </form>
        </div>
    </div>
</div>






<?php
// Rating
$totalStars = 0;
$totalCount = 0;
foreach ($ratings as $rating) {
  $totalStars += $rating->ratingStars;
  $totalCount += 1;
}
if ($totalCount > 0) {
  $averageStars = $totalStars / $totalCount;
} else {
  $averageStars = 0;
}
?>
<div class="absolute hidden top-0 right-4 mt-4 mb-4">
    <svg id="heart" class="w-5 h-5 text-red-600 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 30" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.879c-2.484-4.375-12-1.82-12 4.879 0 5.572 5.126 7.664 12 14.121 6.874-6.457 12-8.549 12-14.121 0-6.699-9.516-9.254-12-4.879z"/>
    </svg>
</div>

<div class="px-4 lg:px-6 py-6 h-full overflow-y-auto no-scrollbar">
    <div class="flex flex-wrap justify-between mx-auto max-w-screen-xl h-full">
        <div class="flex h-full w-full mb-3">
            <div class="rounded-lg h-full w-full mb-4 dark:text-white ">
                <div class="relative flex grid-cols-2 items-center overflow-hidden bg-white rounded-lg mb-4 dark:bg-gray-800 py-4 px-4">
                    <div class="flex flex-1">
                        <div>
                            <img src="<?php echo base_url($freelancer->userAvatarPath); ?>" class="w-40 h-40 rounded-full" alt="Photo de profil">
                        </div>
                        <div class="ml-4">
                            <div class="flex">
                                <div class="flex" id="user-data">
                                    <h1 class="text-5xl font-bold" id="userFirstName"><?=$freelancer->userFirstName?></h1>
                                        <?php 
                                        // capitalize user last name
                                        $userLastName = $freelancer->userLastName;
                                        $userLastName = strtoupper($userLastName);
                                        ?>
                                        <h1 class="text-5xl font-bold ml-2" id="userLastName"><?=$userLastName?></h1>
                                        
                                </div>
                                <?php
                                    if($freelancer->userIsAvailable == 1){
                                ?>
                                <div style="height:1.5rem; margin:auto; margin-left:1rem;" class="my-auto flex items-center space-x-1 bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-300 dark:text-green-900">
                                    <div style="width: 0.5rem; height: 0.5rem" class="bg-green-500 rounded-full dark:bg-green-700"></div>
                                    <div>Disponible</div>
                                </div>
                                <?php
                                    } else {
                                ?>
                                    <div style="height:1.5rem; margin:auto; margin-left:1rem;" class="my-auto flex items-center space-x-1 bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-300 dark:text-red-900">
                                        <div style="width: 0.5rem; height: 0.5rem" class="bg-red-500 rounded-full dark:bg-red-700"></div>
                                        <div>Non Disponible</div>
                                    </div>
                                <?php
                                    }
                                ?> 
                            </div>
                            <p class="text-lg text-black-500 font-bold"><?= $freelancer_job[0]->jobName ?></p>
                            <p class="text-lg text-black-500 font-medium">
                                <?php
                                    if ($user->userExperienceYear == "junior"){
                                        $user->userExperienceYear = "Junior";
                                    }
                                    elseif ($user->userExperienceYear == "intermediaire"){
                                        $user->userExperienceYear = "Intermédiaire";
                                    }
                                    elseif ($user->userExperienceYear == "expert"){
                                        $user->userExperienceYear = "Expert";
                                    }
                                ?>
                                <?=$user->userExperienceYear?>
                            </p>
                            <div class="flex items-center mb-4">
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                <?php if ($i <= $averageStars) { ?>
                                    <img src="<?php echo base_url('assets/img/fill-star.svg'); ?>" class="w-6 h-6">
                                <?php } else { ?>
                                    <img src="<?php echo base_url('assets/img/light-star.svg'); ?>" class="w-6 h-6">
                                <?php } ?>
                                <?php } ?>
                                <a href="#rating">
                                    <p class="ml-2"><?=round($averageStars, 1).' ( '.$ratingCount.' avis )'?></p>
                                </a>
                                <button id="addRating" data-modal-toggle="addRating" class="ml-4 underline text-gray-400 bg-transparent hover:text-gray-900 rounded-lg inline-flex items-center dark:hover:text-white" style="text-underline-offset: 0.2rem" type="button">
                                    <p>Donner un avis</p>
                                </button>
                            </div>
                        <!-- Whatsapp -->
                        <div class="flex flex-wrap items-center">
                                <!-- Whatsapp -->
                            <!-- <a href="https://wa.me/<?=$freelancer->userTelephone?>?text=Bonjour%20<?=$freelancer->userFirstName?>%20!%20Je%20suis%20intéressé%20par%20votre%20profil%20sur%20Café%20Crème%20Community%20!%20" target="_blank"> -->
                            
                            <button id="sendMessage" data-modal-toggle="sendMessage" type="button" data-te-ripple-init data-te-ripple-color="light"
                                class="mb-2 mr-4 inline-flex items-center rounded-full px-6 py-2.5 leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg"
                                style="background-color: #25D366">
                                <span class="mr-2">Contacter</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                </svg>
                                </button>
                            <!-- </a> -->
                                <p class="mb-2 mt-2 inline-block px-4 py-2.5 rounded-full bg-primary text-white"><?=$freelancer->userTJM?> € / Jour</p>
                            </div>
                        </div>
                    </div>
                    

                </div>
                <div class="flex gap-6 mb-3 mt-6">
                    <div class="w-1/4 sticky top-0">
                        <div class="w-full">
                            <div class="bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                                <h2 class="text-xl font-bold mb-4"> Préférences </h2> 
                                    <div class="flex grid-cols-2 items-center mb-4">
                                        <?php
                                        // user is available or not
                                        if($freelancer->userIsAvailable == 1){
                                        ?>
                                            <div>
                                                <p class="w-10 h-10 rounded-full bg-secondary text-white text-center text-xl flex items-center justify-center mr-4 pt-2">👍🏻</p>
                                            </div>
                                        <?php
                                        }else
                                        {
                                        ?>
                                        <div>
                                            <p class="w-10 h-10 rounded-full bg-red-400 text-white text-center text-xl flex items-center justify-center mr-4 pt-2">👎🏻</p>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <div>
                                            <p class="text">Disponibilité</p>
                                            <?php
                                            if($freelancer->userIsAvailable == 1){
                                            ?>
                                                <p class="font-bold text-lg">Dispo. <?=$freelancer->userJobTimePartielOrFullTime?> </p>
                                            <?php
                                                }else{
                                            ?>
                                                <p class="font-bold text-lg">Indispo. <?=$freelancer->userJobTimePartielOrFullTime?> </p>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="flex grid-cols-2 items-center mb-4">
                                        <?php
                                        // user is available or not
                                        if($freelancer->userJobType == "Remote,Physique"){
                                        ?>
                                            <div>
                                                <p class="w-10 h-10 rounded-full bg-pink-300 text-white text-center text-xl flex items-center justify-center mr-4 pt-2">✈️</p>
                                            </div>
                                        <?php
                                        }else
                                        {
                                            if ($freelancer->userJobType == "Remote"){
                                        ?>
                                        <div>
                                            <p class="w-10 h-10 rounded-full bg-pink-300 text-white text-center text-xl flex items-center justify-center mr-4 pt-2">✈️</p>
                                        </div>
                                        <?php
                                            }else{
                                        ?>
                                        <div>
                                            <p class="w-10 h-10 rounded-full bg-green-400 text-white text-center text-xl flex items-center justify-center mr-4 pt-2">👨🏻‍💻</p>
                                        </div>
                                        <?php
                                        } }
                                        ?>
                                        <div>
                                            <p class="text">Type de poste</p>
                                            <?php
                                                if($freelancer->userJobType == "Remote,Physique"){
                                                ?>
                                                    <p class="font-bold text-lg">Télétravail & Physique</p>
                                                <?php
                                                    }else if($freelancer->userJobType == "Remote"){
                                                ?>
                                                    <p class="font-bold text-lg">Télétravail</p>
                                                <?php
                                                    }else if($freelancer->userJobType == "Physique"){
                                                ?>
                                                    <p class="font-bold text-lg">Physique</p>
                                                <?php
                                                    }
                                                ?>
                                            <!-- error message -->
                                        </div>
                                    </div>
                                    <div class="flex grid-cols-2 items-center mb-4">
                                        <div>
                                            <p class="w-10 h-10 rounded-full bg-orange-400 text-white text-center text-xl flex items-center justify-center mr-4 pt-2">📍</p>
                                        </div>
                                        
                                        <div>
                                            <p class="text">Localisation</p>
                                            
                                                <p class="font-bold text-lg"><?=$freelancer->userVille?></p>
                                            
                                        </div>
                                    </div>
                                    <div class="flex grid-cols-2 items-center mb-4">
                                        <div>
                                            <p class="w-10 h-10 rounded-full bg-indigo-300 text-white text-center text-xl flex items-center justify-center mr-4 pt-2">⏳</p>
                                        </div>
                                        
                                        <div>
                                            <p class="text">Durée de la mission</p>
                                            
                                            <p class="font-bold text-lg"><?=$freelancer->userJobTime?></p>
                                            
                                        </div>
                                    </div>
                                    
                            </div>
                            <div class="relative bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                                <h2 class="text-xl font-bold mb-4"> Liens utiles </h2> 
                                <div class="flex flex-col mt-2 mb-2 w-full">
                                    <?php
                                    // mail link

                                    if (isset($freelancer->userEmail)){
                                    ?>
                                    <a href="mailto:<?=$freelancer->userEmail?>" title="Envoyer un mail" class="flex-shrink-0 mr-2">
                                        <div class="flex grid-cols-2 items-center mb-4">
                                                <div>
                                                    <img src="<?=base_url('assets/img/logo-link/mail.png')?>" alt="Logo Mail" class="w-10 h-10 transition-transform transform hover:scale-110">
                                                </div>
                                                <div>
                                                    <p class="text ml-4"><?=$freelancer->userEmail?></p>
                                                </div>
                                        </div>
                                    </a>
                                    <?php
                                    }?>
                                    <?php 
                                    // Links
                                    if (isset($freelancer->userPortfolioLink) && !empty($freelancer->userPortfolioLink)){
                                    ?>
                                    <a href="<?=$freelancer->userPortfolioLink?>" title="Visiter le portfolio" class="flex-shrink-0 mr-2" target="_blank">
                                        <div class="flex grid-cols-2 items-center mb-4">
                                                <div>
                                                    <img src="<?=base_url('assets/img/logo-link/portfolio.png')?>" alt="Logo Portfolio" class="w-10 h-10 transition-transform transform hover:scale-110">
                                                </div>
                                                <div>
                                                    <p class="text ml-4">Portfolio</p>
                                                </div>
                                        </div>
                                    </a>
                                    <?php
                                    }
                                    if (isset($freelancer->userLinkedinLink) && !empty($freelancer->userLinkedinLink)){
                                    ?>
                                    <a href="<?=$freelancer->userLinkedinLink?>" title="Visiter le linkedin" class="flex-shrink-0 mr-2" target="_blank">
                                        <div class="flex grid-cols-2 items-center mb-4">
                                                <div>
                                                    <img src="<?=base_url('assets/img/logo-link/linkedin.png')?>" alt="Logo Linkedin" class="w-10 h-10 transition-transform transform hover:scale-110">
                                                </div>
                                                <div>
                                                    <p class="text ml-4">Linkedin</p>
                                                </div>
                                        </div>
                                    </a>
                                    <?php
                                    }
                                    if (isset($freelancer->userGithubLink) && !empty($freelancer->userGithubLink)){
                                    ?>
                                    <a href="<?=$freelancer->userGithubLink?>" title="Visiter le github" class="flex-shrink-0 mr-2" target="_blank">
                                        <div class="flex grid-cols-2 items-center mb-4">
                                                <div>
                                                    <img src="<?=base_url('assets/img/logo-link/github.png')?>" alt="Logo Github" class="w-10 h-10 transition-transform transform hover:scale-110">
                                                </div>
                                                <div>
                                                    <p class="text ml-4">Github</p>
                                                </div>
                                        </div>
                                    </a>
                                    <?php
                                    }
                                    if (isset($freelancer->userDribbleLink) && !empty($freelancer->userDribbleLink)){
                                    ?>
                                    <a href="<?=$freelancer->userDribbleLink?>" title="Visiter le dribbble" class="flex-shrink-0 mr-2" target="_blank">
                                        <div class="flex grid-cols-2 items-center mb-4">
                                                <div>
                                                    <img src="<?=base_url('assets/img/logo-link/dribbble.png')?>" alt="Logo Dribbble" class="w-10 h-10 transition-transform transform hover:scale-110">
                                                </div>
                                                <div>
                                                    <p class="text ml-4">Dribbble</p>
                                                </div>
                                        </div>
                                    </a>
                                    <?php 
                                    }
                                    if (isset($freelancer->userBehanceLink) && !empty($freelancer->userBehanceLink)): ?>
                                        <a href="<?=$freelancer->userBehanceLink?>" title="Visiter le Behance" class="flex-shrink-0 mr-2" target="_blank">
                                            <div class="flex grid-cols-2 items-center mb-4">
                                                <div>
                                                    <img src="<?=base_url('assets/img/logo-link/behance.png')?>" alt="Logo Behance" class="w-10 h-10 transition-transform transform hover:scale-110">
                                                </div>
                                                <div>
                                                    <p class="text ml-4">Behance</p>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                
                            </div>
                            <div class="bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white" id="rating">
                                <h2 class="text-xl font-bold mb-4"> Avis </h2> 
                                    <div class="flex flex-col mt-2 mb-2 w-full">
                                    <div class="flex-1"></div>
                                    <?php
                                        if (is_array($raterUser) && !empty($raterUser)) {
                                            $ratingsCount = 0;
                                                foreach ($raterUser as $rating) {
                                                    if ($ratingsCount < 3) {
                                                    ?>
                                                    <a href="<?= base_url('company/freelancer/'.$rating->idUser) ?>" title="Visiter le portfolio" class="flex-shrink-0 mr-2" target="_blank">
                                                        <div class="flex grid-cols-2 items-center mb-4">
                                                            <div>
                                                                <img src="<?php echo base_url($rating->userAvatarPath); ?>" alt="User Photo" class="rounded-full w-10 h-10 transition-transform transform hover:scale-110">
                                                            </div>
                                                            <div>
                                                                <p class="text ml-4"><?= '"'.$rating->ratingComment.'"'?></p>
                                                                <div class="flex items-center ml-4">
                                                                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                                                                        <?php if ($i <= $rating->ratingStars) { ?>
                                                                            <img src="<?php echo base_url('assets/img/fill-star.svg'); ?>" class="w-4 h-4">
                                                                        <?php } else { ?>
                                                                            <img src="<?php echo base_url('assets/img/light-star.svg'); ?>" class="w-4 h-4">
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                </div>
                                                                <p class="text ml-4 mt-2 "><?= $rating->userFirstName.' '.$rating->userLastName?></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <?php
                                                    $ratingsCount++;
                                                    } else {
                                                        break; // Arrêter la boucle si le nombre d'avis atteint 3
                                                        echo $ratingsCount;
                                                    }
                                                    
                                                }
                                            
                                            
                                        }
                                        else {
                                            ?>
                                                <p class="mt-2 mb-2"> Aucun avis pour le moment. </p>
                                             <?php
                                        }
                                        ?>


                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-3/4 sticky top-0">
                        <div class="w-full">
                            <div class="bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                                <h2 class="text-xl font-bold mb-4 flex items-center cursor-pointer" id="skillsTitle">
                                    Compétences
                                    <i class="fas fa-chevron-down ml-2" id="skillsArrow" style='font-size:0.75rem;' data-order="asc"></i>
                                </h2>

                                <div class="skills-container mb-4">
                                    <?php
                                    if (is_array($skills) && !empty($skills)) {
                                    foreach ($skills as $skill) {
                                        $level = '';
                                        $color = '';
                                        switch ($skill->userSkillsExperience) {
                                            case 1:
                                                $level = 'Junior';
                                                $color = '#BEE3F8'; // Couleur pour le niveau junior
                                                $text = "text-black";
                                                $textdark = "text-black";
                                                break;
                                            case 2:
                                                $level = 'Intermédiaire';
                                                $color = '#63B3ED'; // Couleur pour le niveau intermédiaire
                                                $text = "text-black";
                                                $textdark = "text-white";
                                                break;
                                            case 3:
                                                $level = 'Expert';
                                                $color = '#2C5282'; // Couleur pour le niveau confirmé
                                                $text = "text-white";
                                                $textdark = "text-white";
                                                break;

                                            default:
                                                $level = 'N/A'; // Si la valeur de userSkillsExperience n'est pas valide, afficher "N/A"
                                                break;
                                        }
                                    ?>
                                        <div class="skill-item" data-level="<?=$level?>">
                                            <span class="dark:<?=$textdark?> inline-block px-4 py-1 rounded-full <?=$text?>" style="background-color:<?=$color?>;"><?=$skill->skillName?></span>
                                            <div class="skill-level"><?=$level?></div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <?php } ?>
                                    
                                </div> 
                                
                            </div>
                        </div>

                            <div class="relative bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                                <h2 class="text-xl font-bold mb-4">Expériences</h2>
                                <?php
                                if (is_array($experiences) && !empty($experiences)) {
                                    $experienceCount = 0;
                                    foreach ($experiences as $index => $experience) {
                                        if ($experienceCount < 3) {
                                ?>
                                            <div class="mb-4 mt-4">
                                                <div class="flex items-center mt-2 mb-2">
                                                    <div class="mr-2 mt-2">
                                                        <p class="w-20 h-20 rounded-full bg-secondary text-white text-center flex items-center justify-center mr-4" style="font-size:2rem;">💼</p>
                                                    </div>
                                                    <div>
                                                        <h3 class="text-lg font-medium"><?= $experience->experienceJob?></h3>
                                                        <h3 class=" font-medium"><?= $experience->experienceCompany?></h3>
                                                        <?php
                                                        setlocale(LC_TIME, 'fr_FR.utf8');
                                                        $dateDebut = strftime('%d %B %Y', strtotime($experience->experienceDateDebut));
                                                        $dateFin = strftime('%d %B %Y', strtotime($experience->experienceDateFin));
                                                        $months = array(
                                                            'January' => 'Janvier',
                                                            'February' => 'Février',
                                                            'March' => 'Mars',
                                                            'April' => 'Avril',
                                                            'May' => 'Mai',
                                                            'June' => 'Juin',
                                                            'July' => 'Juillet',
                                                            'August' => 'Août',
                                                            'September' => 'Septembre',
                                                            'October' => 'Octobre',
                                                            'November' => 'Novembre',
                                                            'December' => 'Décembre'
                                                        );

                                                        $dateDebut = strtr($dateDebut, $months);
                                                        $dateFin = strtr($dateFin, $months);
                                                        ?>
                                                        <p class=""><?= $dateDebut.' - '. $dateFin?></p>
                                                    </div>
                                                    
                                                    
                                                </div>

                                                <p class="text-lg text-gray-500 mb-4 mt-4 ml-2 mr-4 dark:text-white"><?= $experience->experienceDescription ?></p>
                                            </div>
                                            <?php
                                            if ($experienceCount < 2) {
                                            ?>
                                                <hr>
                                            <?php
                                            }
                                        ?>
                                    <?php
                                            $experienceCount++;
                                        } else {
                                            break;
                                        }
                                    }
                                ?>
                                <?php }?>
                            </div>
                            <div class="relative bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                                <h2 class="text-xl font-bold mb-4">Portfolio & Réalisations </h2>
                                <?php if (is_array($attachments) && !empty($attachments)) { ?>
                                    <div class="grid grid-cols-4 gap-8">
                                        <?php foreach ($attachments as $index => $attachment) { ?>
                                            <div class="border border-1 p-2 mr-4 mb-4 relative rounded-lg bg-white">
                                                <h3 class="text-lg font-medium"><?= $attachment->attachmentName ?></h3>
                                                <div class="pdf-thumbnail relative z-10 mb-2" data-pdf="<?= base_url($attachment->attachmentPath) ?>">
                                                    <div class="absolute top-0 right-0 flex space-x-4 z-20">
                                                    <a href="<?= base_url($attachment->attachmentPath) ?>" download class="download-icon text-gray-400 hover:text-gray-900" onclick="event.stopPropagation();">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                    </div>
                                                </div>              
                                            </div>
                                        <?php } ?>
                                    </div>

                            <?php } else { ?>
                                <p class="mt-2 mb-2">Aucune pièce jointe disponible.</p>
                            <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/pdf.js'); ?>"></script>
<script src="<?php echo base_url('/node_modules/choices.js/public/assets/scripts/choices.min.js'); ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js@10.0.0"></script>
<script src="<?php echo base_url('/node_modules/intl-tel-input/build/js/intlTelInput.min.js'); ?>"></script>
<script>        


    document.addEventListener('DOMContentLoaded', function () {
        // Sélectionnez le bouton Valider par son identifiant
        var validerButton = document.getElementById('validerButton');

        // Ajoutez un gestionnaire d'événement au clic sur le bouton
        validerButton.addEventListener('click', function () {
            // Faites une requête AJAX pour récupérer le lien WhatsApp du serveur
            fetch('<?= base_url("company/sendMessage") ?>', {
                method: 'POST',
                body: new FormData(document.getElementById('sendMessage')),
            })
                .then(response => response.json())
                .then(data => {
                    // Ouvrez le lien WhatsApp dans une nouvelle fenêtre ou un nouvel onglet
                    window.open(data.whatsappLink);
                })
                .catch(error => {
                    console.error('Une erreur s\'est produite :', error);
                });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var base_url = '<?php echo base_url(); ?>';


        
        const arrow = document.getElementById('skillsArrow');
        const skillsContainer = document.querySelector('.skills-container');
        const skillItems = [...skillsContainer.querySelectorAll('.skill-item')];
        let sortOrder = 'asc';

        arrow.addEventListener('click', function() {
            sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
            updateSkillsOrder(skillItems, sortOrder);
        });

        function updateSkillsOrder(items, order) {
            const sortedItems = items.slice().sort(function(a, b) {
                const aLevel = a.getAttribute('data-level');
                const bLevel = b.getAttribute('data-level');
                return order === 'asc' ? aLevel.localeCompare(bLevel) : bLevel.localeCompare(aLevel);
            });

            skillsContainer.innerHTML = ''; // Clear container

            sortedItems.forEach(function(item) {
                skillsContainer.appendChild(item);
            });
        }

        const checkbox = document.getElementById('hs-basic-with-description');
        const labelCompanyJobs = document.getElementById('labelCompanyJobs');
        const companyJobsSelect = document.getElementById('companyJobsSelect');
        const labelMessage = document.getElementById('labelMessage');
        const companyMessage = document.getElementById('companyMessage');

        // If checkbox is checked, show the select and textarea fields

        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                labelCompanyJobs.classList.remove('hidden');
                labelCompanyJobs.classList.add('block');
                companyJobsSelect.classList.remove('hidden');
                labelMessage.classList.remove('hidden');
                companyMessage.classList.remove('hidden');

                labelMessageDefault.classList.remove('block');
                labelMessageDefault.classList.add('hidden');
                companyMessageDefault.classList.remove('block');
                companyMessageDefault.classList.add('hidden');


            } else {
                labelCompanyJobs.classList.add('hidden');
                companyJobsSelect.classList.add('hidden');
                labelMessage.classList.add('hidden');
                companyMessage.classList.add('hidden');

                labelMessageDefault.classList.remove('hidden');
                labelMessageDefault.classList.add('block');

                companyMessageDefault.classList.remove('hidden');
                companyMessageDefault.classList.add('block');
               

            }
        });


      
        // // Écoutez l'événement de changement dans la liste déroulante
        // companyJobsSelect.addEventListener('change', function () {
        //     // Obtenez la mission sélectionnée
        //     var selectedMission = companyJobsSelect.options[companyJobsSelect.selectedIndex].text;
        //     var companyName = '';
        //     companyMessageDefault.value = companyMessage.value + '\n\n' + companyMessageDefault.value + '\n\nNom de la mission : ' + selectedMission + '\nNom de l\'entreprise : ' + companyName;
        //     console.log(companyMessageDefault.value);
        // });

    });

    
</script>


<!-- Inclure PDF.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
<!-- Inclure le PDF.js Worker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js"></script>




<script>
    // Fonction pour charger la miniature PDF dans un conteneur donné
    function loadPdfThumbnail(pdfUrl, container) {
        // Charger le PDF en utilisant PDF.js
        pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
            // Obtenir la première page du PDF
            pdf.getPage(1).then(function(page) {
                var viewport = page.getViewport({ scale: 0.25 }); // Échelle de 0.25 pour la miniature
                var canvas = document.createElement('canvas');
                var context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Dessiner la miniature sur le canvas
                page.render({ canvasContext: context, viewport: viewport }).promise.then(function() {
                    // Convertir le canvas en base64 pour l'afficher comme une image
                    var thumbnailUrl = canvas.toDataURL();
                    var img = new Image();
                    img.src = thumbnailUrl;
                    img.classList.add('pdf-thumbnail-img');

                    // Ajouter l'image miniature dans le conteneur spécifié
                    container.appendChild(img);

                    // Gérer le clic sur la miniature pour afficher le PDF complet
                    container.addEventListener('click', function() {
                        // Charger le PDF complet
                        pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
                            var numPages = pdf.numPages;
                            var fullPdfContainer = document.createElement('div');
                            fullPdfContainer.classList.add('full-pdf-container');

                            // Afficher chaque page du PDF complet dans le conteneur
                            for (var pageNum = 1; pageNum <= numPages; pageNum++) {
                                pdf.getPage(pageNum).then(function(page) {
                                    var fullViewport = page.getViewport({ scale: 1 });
                                    var fullCanvas = document.createElement('canvas');
                                    var fullContext = fullCanvas.getContext('2d');
                                    fullCanvas.height = fullViewport.height;
                                    fullCanvas.width = fullViewport.width;

                                    // Dessiner la page du PDF sur le canvas
                                    page.render({ canvasContext: fullContext, viewport: fullViewport }).promise.then(function() {
                                        fullPdfContainer.appendChild(fullCanvas);
                                    });
                                });
                            }

                            // Afficher le PDF complet dans une boîte de dialogue
                            
                            fullPdfContainer.style.display = 'block';
                            document.body.appendChild(fullPdfContainer);

                            // Gérer le clic en dehors de la boîte de dialogue pour la fermer
                            fullPdfContainer.addEventListener('click', function(event) {
                                if (event.target === fullPdfContainer) {
                                    fullPdfContainer.style.display = 'none';
                                }
                            });
                        });
                    });
                });
            });
        });
    }

    // Chargement des miniatures pour chaque conteneur avec la classe .pdf-thumbnail
    var thumbnailContainers = document.querySelectorAll('.pdf-thumbnail');
    thumbnailContainers.forEach(function(container) {
        var pdfUrl = container.getAttribute('data-pdf');
        loadPdfThumbnail(pdfUrl, container);
    });

    const fileInput = document.getElementById('userAttachmentFile');
    const filenameSpan = document.querySelector('.filename');

    fileInput.addEventListener('change', function() {
        if (fileInput.files.length > 0) {
            filenameSpan.textContent = fileInput.files[0].name;
        } else {
            filenameSpan.textContent = 'Choisir un fichier';
        }
    });

    function setRating(rating) {
    // Mettre à jour la valeur du champ "ratingStars"
    document.getElementById("ratingStars").value = rating;

    // Mettre à jour les sources des images "light-star" jusqu'à celle cliquée
    const stars = document.querySelectorAll(".star");
    for (let i = 0; i < stars.length; i++) {
        if (i < rating) {
        stars[i].src = "<?php echo base_url('assets/img/fill-star.svg'); ?>";
        } else {
        stars[i].src = "<?php echo base_url('assets/img/light-star.svg'); ?>";
        }
    }
    }


    
</script>
