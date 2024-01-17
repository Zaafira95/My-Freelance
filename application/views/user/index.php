<?php
$currentPage = 'dashboard';


// Header Call
include(APPPATH . 'views/layouts/user/header.php');
?>
<head>
    <title> Café Crème Community </title>

<style>
    html,
    body {
        height: 100vh;
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
<?php
if ($banner->bannerStatus == "active"){ ?>
<div id="sticky-banner" tabindex="-1" class="fixed top-0 left-0 z-50 mt-4 flex justify-between w-full p-4 border-b border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
    <div class="flex items-center mx-auto">
        <p class="flex items-center  font-normal text-gray-500 dark:text-white">
            <span class="inline-flex p-1 mr-3 bg-gray-200 rounded-full dark:bg-gray-600 w-6 h-6 items-center justify-center">
                <svg class="w-3 h-3 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 19">
                    <path d="M15 1.943v12.114a1 1 0 0 1-1.581.814L8 11V5l5.419-3.871A1 1 0 0 1 15 1.943ZM7 4H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2v5a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V4ZM4 17v-5h1v5H4ZM16 5.183v5.634a2.984 2.984 0 0 0 0-5.634Z"/>
                </svg>
                <span class="sr-only">Light bulb</span>
            </span>
            <span><?= $banner->bannerMessage?> <a href="<?=$banner->bannerLink?>" class="inline font-medium text-primary underline dark:text-primary underline-offset-2 decoration-600 dark:decoration-500 decoration-solid hover:no-underline" target ="_blank"><?=$banner->bannerCta?></a></span>
        </p>
    </div>
    <div class="flex items-center">
        <button data-dismiss-target="#sticky-banner" type="button" class="flex-shrink-0 inline-flex justify-center w-7 h-7 items-center text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Fermer</span>
        </button>
    </div>
</div>
<?php } ?>

<div id="updateProductModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-3xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Votre disponibilité
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateProductModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Fermer</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?=base_url("user/updateAvailability")?>" method="post">
                    <div>
                        <label for="name" class="block mb-2 font-medium text-gray-900 dark:text-white">Êtes-vous disponible pour travailler dès maintenant ?</label>
                        <label class="text-gray-500 mr-3 dark:text-gray-400">Non</label>
                        <input type="checkbox" name="userIsAvailable" id="hs-basic-with-description" <?php echo $checkboxChecked; ?> class="relative shrink-0 w-[3.25rem] h-7 bg-gray-100 checked:bg-gray-100 rounded-full cursor-pointer transition-colors ease-in-out duration-200 border border-transparent ring-1 ring-transparent focus:border-green-600 focus:ring-green-600 ring-offset-white focus:outline-none appearance-none dark:bg-gray-700 dark:checked:bg-green-600 dark:focus:ring-offset-gray-800 before:inline-block before:w-6 before:h-6 before:bg-white checked:before:bg-green-500 before:translate-x-0 checked:before:translate-x-full before:shadow before:rounded-full before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-gray-400 dark:checked:before:bg-green-200">
                        <label class="text-gray-500 ml-3 dark:text-gray-400">Oui</label>
                        <label for="name" class="block mb-2 mt-2 font-medium text-gray-900 dark:text-white">Combien de jours par semaine êtes-vous disponible ?</label>
                        <select id="userJobTimePartielOrFullTime" name="userJobTimePartielOrFullTime" class="bg-gray-50 border mt-2 border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="temps-plein" 
                                <?php if ($user->userJobTimePartielOrFullTime === "temps-plein") {
                                    echo ' selected';
                                } ?>> Temps Plein 
                            </option>
                            <option value="temps-partiel" 
                                <?php if ($user->userJobTimePartielOrFullTime === "temps-partiel") {
                                    echo ' selected';
                                } ?>> Temps Partiel 
                            </option>
                        </select>
                    </div>
                <div class="flex items-center space-x-4 mt-4">
                    <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Valider
                    </button>
                    <button type="button" data-modal-toggle="updateProductModal" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
// Vérification taux de complétion du profil
$totalInfos = 0;
$tauxCompletion = 40;
if(is_array($skills) && !empty($skills)){
    $totalInfos += 1;
}
if(is_array($experiences) && !empty($experiences)){
    $totalInfos += 1;
}
if(is_array($attachments) && !empty($attachments)){
    $totalInfos += 1;
}
if((isset($user->userPortfolioLink) && !empty($user->userPortfolioLink)) || (isset($user->userLinkedinLink) && !empty($user->userLinkedinLink)) || (isset($user->userGithubLink) && !empty($user->userGithubLink)) || (isset($user->userDribbleLink) && !empty($user->userDribbleLink)) || (isset($user->userBehanceLink) && !empty($user->userBehanceLink))){
    $totalInfos += 1;
}

if($totalInfos == 1 ){
    $tauxCompletion = 55;
} else if ($totalInfos == 2 ){
    $tauxCompletion = 70;
} else if ($totalInfos == 3 ){
    $tauxCompletion = 85;
} else if ($totalInfos == 4 ){
    $tauxCompletion = 100;
}

?>


<div class="px-8 py-6 lg:px-4 lg:py-6 h-90 overflow-y-auto no-scrollbar ">
    <div class="justify-between items-center mx-auto max-w-screen-xl h-full">
        <div class="lg:flex gap-6 h-full mb-3">
            <!-- Bloc Filtre -->
            <div class=" w-full lg:w-1/4 md:block md:sticky md:top-0">
                <!-- Button to show filer block on mobile -->
                <div class="text-right mb-4 lg:hidden">
                    <button id="showFilterButton" class="text-4xl text-primary border p-2 border-primary  rounded-lg 2 hover:bg-primary-900 hover:text-white">
                        <i class="fas fa-sliders-h"></i>
                    </button>
                </div>
                <div class="hidden lg:block bg-white rounded-lg h-full overflow-y-auto no-scrollbar mb-4 p-4 dark:bg-gray-800 dark:text-white" id="FilterMission">
                    <h3 class="text-3xl lg:text-lg font-medium mt-2">Filtre</h3>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Localisation</h4>
                        <div class="flex items-center mt-2">
                            <i class="fa fa-map-marker-alt mr-3"></i>    
                            <div class="relative city-search-container w-full">
                                <input type="text" id="citySearch" value="<?=$user->userVille?>" placeholder="Cherchez votre ville" class="text-3xl lg:text-lg border p-2 rounded-lg w-full text-black">
                                <div id="cities-list" class="absolute z-10 mt-2 w-full  rounded bg-white max-h-64 overflow-y-auto text-black"></div>
                            </div>
                        </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Type de poste</h4>
                    <div class="mt-2">
                        <label class="flex items-center ">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="temps-plein" <?= ($user->userJobTimePartielOrFullTime == 'temps-plein') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Temps plein</span>
                        </label>
                        <label class="flex items-center text-xl lg:text-base">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="temps-partiel" <?= ($user->userJobTimePartielOrFullTime == 'temps-partiel') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Temps partiel</span>
                        </label>
                    </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Durée de la mission</h4>
                    <div class="mt-2">
                        <label class="flex items-center text-xl lg:text-base">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="courte" <?= ($user->userJobTime == 'Courte Durée') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Courte durée</span>
                        </label>
                        <label class="flex items-center text-xl lg:text-base">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="longue" <?= ($user->userJobTime == 'Longue Durée') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Longue durée</span>
                        </label>
                        <label class="flex items-center text-xl lg:text-base">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="indefinie" <?= ($user->userJobTime == 'Durée indéfinie') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Durée indéfinie</span>
                        </label>
                    </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Mode de déroulement</h4>
                    <div class="mt-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="site" <?= ($user->userJobType === 'Physique') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Sur site</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="teletravail" <?= ($user->userJobType === 'Remote') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Télétravail</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="hybride" <?= ($user->userJobType === 'Hybride') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Hybride</span>
                        </label>
                    </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Niveau d'expérience</h4>
                    <div class="mt-2">
                        <label class="flex items-center text-xl lg:text-base">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="junior" <?= ($user->userExperienceYear === 'junior') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Junior (1 à 2 ans)</span>
                        </label>
                        <label class="flex items-center text-xl lg:text-base">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="intermediaire" <?= ($user->userExperienceYear === 'intermediaire') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Intermédiaire (3 à 5 ans)</span>
                        </label>
                        <label class="flex items-center text-xl lg:text-base">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="expert" <?= ($user->userExperienceYear === 'expert') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Expert (+ 5 ans)</span>
                        </label>
                    </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">TJM</h4>
                    <div class="mt-2 mr-3">
                        <div id="tjm-slider" class="w-full mt-2"></div>
                        <div class="flex justify-between mt-2">
                            <span id="tjm-min" class="text-3xl lg:text-base">300€</span>
                            <span id="tjm-max" class="text-3xl lg:text-base">1200€</span>
                        </div>
                    </div>
                
                    <h4 class="text-3xl lg:text-base font-medium mt-4">Compétences</h4>
                    <div class="w-full mx-auto mt-5 text-black">
                        <!-- <label for="skillsAll" class="block text-sm font-medium text-gray-700">Sélectionnez vos compétences</label> -->
                        <select id="skillsAll" name="skillsAll[]" multiple class="text-3xl lg:text-base mt-1 block w-full py-2 px-3 border border-gray-300 bg-white text-black rounded-full shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <?php foreach ($skillsAll as $skill): ?>
                                <option class="text-3xl lg:text-base text-black" value="<?= $skill['skillId'] ?>" 
                                    <?php if (!empty($skills)): ?>
                                        <?php foreach ($skills as $userSkill): ?>
                                            <?= ($userSkill->skillId == $skill['skillId']) ? 'selected' : '' ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>>
                                    <?= $skill['skillName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="flex justify-between mt-6">
                        <button id="resetFiltersButton" class="text-3xl lg:text-base text-primary border border-primary px-4 py-1 rounded-lg 2 hover:bg-primary-900 hover:text-white">Effacer</button>
                    </div>

                    

                
                    <!-- <div class="flex justify-between mt-10">
                        <button class="px-4 py-2 rounded-full border border-primary text-primary">Effacer</button>
                        <button class="px-4 py-2 rounded-full bg-primary text-white">Appliquer</button>
                    </div> -->
                </div>
                
            </div>
            <!-- Fin Bloc Filtre -->

            <!-- Début Mission -->
            <div class="w-full lg:w-6/12 h-full overflow-y-auto no-scrollbar">
                <!-- Barre de recherche -->
                <div class="bg-primary rounded-lg h-20vh p-4 text-white">
                    <p class="text-3xl lg:text-lg font-bold">Hello, <?=$user->userFirstName?></p>
                    <p class="text-3xl lg:text-base mt-2 mb-2">Découvrez la manière la plus rapide et efficace de décrocher une mission.</p>
                    <div class="flex w-full">
                        <input type="text" id="search-input" class="text-3xl lg:text-base w-full bg-white bg-opacity-20 rounded-lg p-2 placeholder-white mr-2 text-center" placeholder="Ecrivez le nom du poste que vous recherchez..." />
                        <!-- <button class="w-1/5 bg-white text-primary rounded-lg px-4 py-2">Rechercher</button> -->
                    </div>
                </div>
                <!-- Fin Barre de recherche -->
                <!-- Début section pour vous -->
                <h3 class="text-5xl lg:text-lg font-medium mt-4 mb-4" id="result-section">Pour vous :</h3>
                <!-- Début section contenant toutes les missions -->
                <div class="flex flex-wrap" id="missions-section">
                    <!-- Fonction ajouter favoris -->
                    <?php
                        function isFavorite($missionId, $favoriteMissions) {
                            foreach ($favoriteMissions as $favoriteMission) {
                                if ($favoriteMission->idMissionSavedMission == $missionId) {
                                    return true;
                                }
                            }
                            return false;
                        }
                    ?>
                    <!-- Fin Fonction ajouter favoris -->

                    <!-- Début Affichage mission -->
                    <?php foreach($missionsPerso as $mission): ?>


                        <!-- Compétences de mission -->
                        <?php
                            $dataMissionSkills = [];
                            foreach ($missionSkills[$mission->idMission] as $skill):
                                $dataMissionSkills[] = $skill->skillId;
                            endforeach;
                            $dataMissionSkillsString = implode(',', $dataMissionSkills);
                        ?>
                        <!-- Fin Compétences de mission -->

                        <!-- Début section mission -->
                        <a href="<?=base_url('user/missionView/'.$mission->idMission)?>" 
                            class="mission-item" 
                            data-mission-name="<?=strtolower($mission->missionName)?>" 
                            data-mission-type="<?=strtolower($mission->missionType)?>"
                            data-mission-deroulement="<?=strtolower($mission->missionDeroulement)?>"
                            data-mission-duree="<?=strtolower($mission->missionDuration)?>" 
                            data-mission-expertise="<?=strtolower($mission->missionExpertise)?>" 
                            data-mission-tjm="<?=$mission->missionTJM?>" 
                            data-mission-localisation="<?=strtolower($mission->missionLocalisation)?>"
                            data-mission-skills="<?=$dataMissionSkillsString?>"> 
                            <!-- Fin du a -->

                            <!-- Début de la carte -->
                            <div class="bg-white mb-4 rounded-lg lg:h-20vh p-4 dark:bg-gray-800 dark:text-white relative mission-item" data-mission-name="<?=strtolower($mission->missionName)?>" data-mission-type="<?=strtolower($mission->missionType)?>" data-mission-deroulement="<?=strtolower($mission->missionDeroulement)?>" data-mission-duree="<?=strtolower($mission->missionDuration)?>" data-mission-expertise="<?=strtolower($mission->missionExpertise)?>" data-mission-tjm="<?=$mission->missionTJM?>" data-mission-localisation="<?=$mission->missionLocalisation?>" data-mission-skills="<?=$dataMissionSkillsString?>">
                                
                                <!-- Début div en tête -->
                                <div class="flex items-center">

                                    <!-- Div logo entreprise -->
                                    <div class="mr-4">
                                        <!-- Logo entreprise --> 
                                        <?php foreach ($missionCompany[$mission->idMission] as $company) : ?>
                                            <?php if (is_object($company)) : ?>
                                            <img src="<?=base_url($company->companyLogoPath)?>" alt="Logo de l'entreprise" class="w-16 h-16 lg:w-10 rounded-full">
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <!-- Fin logo entreprise -->
                                    </div>
                                    <!-- Fin div logo entreprise -->

                                    <!-- Div informations clés mission -->
                                    <div class="w-3/4 mr-4">
                                        <h2 class="text-3xl lg:text-lg font-bold "><?=$mission->missionName?></h2>
                                        <p class="text-3xl lg:text-base">
                                            <span class="mr-2"> 
                                                • TJM : <?=$mission->missionTJM?> €
                                            </span>
                                            
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

                                            <span class="mr-2"> •
                                                <?=$mission->missionLocalisation?>
                                            </span>

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
                                    <!-- Fin div informations clés mission -->
                                </div>
                                <!-- Fin div en tête -->

                                <!-- Div Flex description + compétences mission -->                
                                <div class="flex items-center justify-between">
                                    <!-- Div description + compétences mission -->
                                    <div class="mt-4 text-3xl lg:text-base">
                                        
                                        <!-- Description mission -->
                                        <p class="font-normal text-3xl lg:text-base mt-4 mb-4">

                                            <?php 
                                            // limit missionDescription to 270 caracteres and add '...' at the end
                                                $mission->missionDescription = strlen($mission->missionDescription) > 270 ? substr($mission->missionDescription,0,270)."..." : $mission->missionDescription;    
                                            ?>
                                            <?=$mission->missionDescription?>
                                        </p>
                                        <!-- Fin description mission -->

                                        <!-- Compétences mission -->
                                        <div class="skills-container mb-4">
                                            <?php
                                                $dataMissionSkills = [];
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
                                                            $level = 'Intermédiaire';
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
                                                <div class="text-3xl lg:text-base skill-item" data-level="<?=$level?>">
                                                    <span class="text-3xl lg:text-base dark:<?=$textdark?> inline-block px-4 py-1 rounded-full <?=$text?>" style="background-color:<?=$color?>;"><?=$skill->skillName?></span>
                                                    <div class="skill-level"><?=$level?></div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <!-- Fin compétences mission -->
                                    </div>
                                    <!-- Fin div description + compétences mission -->

                                </div>
                                <!-- Fin div Flex description + compétences mission -->

                                <!-- Div bouton favoris -->
                                <div class="absolute top-0 right-4 mt-4 mb-4 z-9">
                                    <?php
                                        if(isFavorite($mission->idMission, $favoriteMissions)){
                                    ?>
                                    <a href="<?php echo base_url('user/removeFromFavorite/'.$mission->idMission);?>">
                                        <i class="fas fa-heart text-3xl lg:text-xl text-red-800"></i>
                                    </a>
                                    <?php
                                        } else {
                                    ?>
                                    <a href="<?php echo base_url('user/addToFavorite/'.$mission->idMission);?>">
                                        <i class="far fa-heart text-3xl lg:text-xl text-red-800"></i>
                                    </a>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <!-- Fin div bouton favoris -->
                            </div>
                            <!-- Fin de la carte -->
                        </a>
                        <!-- Fin section mission -->
                    <?php endforeach; ?>
                    <!-- Fin Affichage mission -->
                </div>
                <!-- Fin section contenant toutes les missions -->
                <!-- Début section aucune mission trouvée -->
                <div id="no-mission-found">
                    <p class="text-3xl lg:text-base mt-6 text-left">Aucune mission n'a été trouvée.</p>
                    <h3 class="text-5xl lg:text-lg font-medium mt-10" id="result-section">Autres missions :</h3>
                    <?php 
                        foreach($missionsPerso as $mission):
                            $dataMissionSkills = [];
                            foreach ($missionSkills[$mission->idMission] as $skill):
                                $dataMissionSkills[] = $skill->skillId;
                            endforeach;
                        $dataMissionSkillsString = implode(',', $dataMissionSkills);
                    ?>
                    <a href="<?=base_url('user/missionView/'.$mission->idMission)?>"  
                        data-mission-name="<?=strtolower($mission->missionName)?>" 
                        data-mission-type="<?=strtolower($mission->missionType)?>"
                        data-mission-deroulement="<?=strtolower($mission->missionDeroulement)?>"
                        data-mission-duree="<?=strtolower($mission->missionDuration)?>" 
                        data-mission-expertise="<?=strtolower($mission->missionExpertise)?>" 
                        data-mission-tjm="<?=$mission->missionTJM?>" 
                        data-mission-localisation="<?=strtolower($mission->missionLocalisation)?>"
                        data-mission-skills="<?=$dataMissionSkillsString?>"> 
                        <!-- Début carte mission -->
                        <div class="mb-12 bg-white rounded-lg h-20vh mt-4 p-8 lg:p-4 dark:bg-gray-800 dark:text-white relative lg:mb-2" data-mission-name="<?=strtolower($mission->missionName)?>" data-mission-type="<?=strtolower($mission->missionType)?>" data-mission-deroulement="<?=strtolower($mission->missionDeroulement)?>" data-mission-duree="<?=strtolower($mission->missionDuration)?>" data-mission-expertise="<?=strtolower($mission->missionExpertise)?>" data-mission-tjm="<?=$mission->missionTJM?>" data-mission-localisation="<?=$mission->missionLocalisation?>" data-mission-skills="<?=$dataMissionSkillsString?>">
                            <!-- Début div en tête -->
                            <div class="flex items-center">
                                <div class="mr-4">
                                    <?php foreach ($missionCompany[$mission->idMission] as $company) : ?>
                                        <?php if (is_object($company)) : ?>
                                            <img src="<?=base_url($company->companyLogoPath)?>" alt="Logo de l'entreprise" class="w-16 h-16 lg:w-10 rounded-full">
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                                <div class="w-3/4 mr-4">
                                    <h2 class="text-3xl lg:text-lg font-bold "><?=$mission->missionName?></h2>
                                    <p class="text-3xl lg:text-base">
                                        <span class="mr-2">
                                            • TJM : <?=$mission->missionTJM?> €
                                        </span>
                                        
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

                                        <span class="mr-2"> • 
                                            <?=$mission->missionLocalisation?>
                                        </span>

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
                            <!-- Fin div en tête -->

                            <!-- Div Flex description + compétences mission -->
                            <div class="text-3xl lg:text-base flex items-center justify-between">
                                <div class="mt-4">
                                    <p class="font-normal mt-4 mb-4 text-3xl lg:text-base">
                                        <?php 
                                        // limit missionDescription to 270 caracteres and add '...' at the end
                                        $mission->missionDescription = strlen($mission->missionDescription) > 270 ? substr($mission->missionDescription,0,270)."..." : $mission->missionDescription;    
                                        ?>
                                        <?=$mission->missionDescription?>
                                    </p>
                                    <div class="skills-container mb-4 mt-4">
                                        <?php
                                            $dataMissionSkills = [];
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
                                                        $level = 'Intermédiaire';
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
                                            <div class="skill-item" data-level="<?=$level?>">
                                                <span class="text-3xl lg:text-base dark:<?=$textdark?> inline-block px-4 py-1 rounded-full <?=$text?>" style="background-color:<?=$color?>;"><?=$skill->skillName?></span>
                                                <div class="skill-level"><?=$level?></div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin div Flex description + compétences mission -->

                            <!-- Div bouton favoris -->
                            <div class="absolute top-0 right-8 mt-8 lg:right-4 lg:mt-4 mb-4 z-9">
                                <?php
                                if(isFavorite($mission->idMission, $favoriteMissions)){
                                    ?>
                                    <a href="<?php echo base_url('user/removeFromFavorite/'.$mission->idMission);?>">
                                        <i class="fas fa-heart text-3xl lg:text-xl text-red-800"></i>
                                    </a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="<?php echo base_url('user/addToFavorite/'.$mission->idMission);?>">
                                        <i class="far fa-heart text-3xl lg:text-xl text-red-800"></i>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                            <!-- Fin div bouton favoris -->

                        </div>
                        <!-- Fin carte mission -->
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- Fin Mission -->

            <!-- Vos informations -->
            <div class="hidden lg:block lg:w-1/4 sticky top-0 h-full overflow-y-auto no-scrollbar">
                <div class="bg-white rounded-lg h-22vh p-4 dark:bg-gray-800 dark:text-white">
                    <div class="flex flex-col items-center mb-4">
                    <a class="flex flex-col items-center" href="<?=base_url('user/profil')?>">
                        <div class="w-20 h-20 rounded-full border-10 ring-2 ring-primary overflow-hidden">
                            <?php 
                            if($user->userAvatarPath == null){
                                $user->userAvatarPath = 'assets/img/default-avatar.png';
                            }
                            ?>
                            <img src="<?php echo base_url($user->userAvatarPath); ?>" alt="Avatar" class="w-20 h-20 p-0.5 rounded-full ring-2 ring-primary">
                        </div>

                            <h3 class="text-lg font-medium mt-2"><?=$user->userFirstName .' '. $user->userLastName?></h3>
                    </a>
                        <div class="items-center mt-1">
                            <p class="font-light text-center"><?=$jobUser->jobName?></p>
                            <p class="font-light text-center"><?=$user->userTJM . ' €'?></p>
                        </div>
                      <?php
                        if ($tauxCompletion != 100){
                        ?>
                            <div class="flex items-center mt-1">
                                <p class="text-xl lg:text-base italic font-light">Profil complété à <?= $tauxCompletion?>%</p>
                            </div>
                        <?php 
                        }
                      ?>
                        <a href="<?php echo base_url('User/profil');?>" class="text-primary mt-2 border border-primary px-4 py-1 rounded 2 hover:bg-primary-900 hover:text-white">Modifier mon profil</a>
                    <!-- missions favorites -->
                        <a href="<?php echo base_url('User/favoriteMission');?>" class="text-primary mt-2  px-4 py-1 rounded 2 hover:bg-primary-900 hover:text-white">Mes missions favorites</a>
                        <a href="<?php echo base_url('user/logout');?>" class="text-red-600 mt-2 hover:text-red-900">Déconnexion</a>

                    </div>
                </div>

                <div class="bg-white rounded-lg mt-4 p-4 text-left dark:bg-gray-800 dark:text-white">
                    <h3 class="text-xl font-medium mt-2">Expériences</h3>
                    <?php if (is_array($experiences) && !empty($experiences)) {
                        $experienceCount = 0;
                        foreach ($experiences as $experience) {
                            if ($experienceCount < 3) {
                        ?>
                                <div class="flex items-center mt-2 mb-2">
                                    <div class="mr-2 mt-2">
                                        <p class="w-10 h-10 rounded-full bg-secondary text-white text-center flex items-center justify-center mr-4" style="font-size:1rem;">💼</p>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-medium"><?= $experience->experienceJob ?></h3>
                                        <p class="text-sm text-gray-500"><?= $experience->experienceCompany ?></p>
                                        <p class="text-sm text-gray-500"><?= $experience->experienceJob ?></p>
                                    </div>
                                </div>
                        <?php
                                $experienceCount++;
                            } else {
                                break;
                            }
                        }
                        ?>
                    <?php } else { ?>
                        <p class="mt-2 mb-2"> Aucune expérience disponible. </p>
                        <button class="bg-primary text-white px-4 py-2 mt-2 rounded-full">Ajouter une expérience</button>
                    <?php } ?>
                </div>


                <div class="bg-white rounded-lg mt-4 p-4 text-left dark:bg-gray-800 dark:text-white">
                    <h3 class="text-xl font-medium mt-2 mb-4">Compétences et expertises</h3>
                    <?php if (is_array($skills) && !empty($skills)) {
                        foreach ($skills as $skill) {
                            $level = '';
                            $color = '';
                            switch ($skill->userSkillsExperience) {
                                case 1:
                                    $level = 'Junior';
                                    $color = '#BEE3F8'; // Couleur pour le niveau junior
                                    $text = "text-black";
                                    break;
                                case 2:
                                    $level = 'Intermédiaire';
                                    $color = '#63B3ED'; // Couleur pour le niveau intermédiaire
                                    $text = "text-black";
                                    break;
                                case 3:
                                    $level = 'Expert';
                                    $color = '#2C5282'; // Couleur pour le niveau expert
                                    $text = "text-white";
                                    break;
                                default:
                                    $level = 'N/A'; // Si la valeur de userSkillsExperience n'est pas valide, afficher "N/A"
                                    break;
                            }
                    ?>
                        <span class="inline-block px-4 py-1 mb-2 rounded-full <?=$text?>" style="background-color:<?=$color?>;"><?=$skill->skillName?></span>
                    <?php
                        }
                    } else {

                    ?>
                        <p class="mt-2 mb-2"> Aucune compétences et expertises renseignées. </p>
                        <button class="bg-primary text-white px-4 py-2 mt-2 rounded-full">Ajouter une compétence</button>
                    <?php } ?>
                </div>

            </div>
            <!-- Fin Vos informations -->
        </div>
    </div>
</div>

        
<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.js"></script>
<script src="<?php echo base_url('/node_modules/choices.js/public/assets/scripts/choices.min.js'); ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

    // When you click on showFilterButton the filter block appears in mobile version
    $('#showFilterButton').click(function() {
        $('#FilterMission').toggleClass('hidden');
    });


    $(document).ready(function() {
    
        $('#citySearch').on('keyup', function() {
            let term = $(this).val();
            if(term.length > 2) { // Recherche après 2 caractères
                $.post('user/search_cities', { term: term }, function(data) {
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

    });



    //Script selection des compétences
    const skillsChoices = new Choices('#skillsAll', {
        searchEnabled: true,
        removeItemButton: true,
        itemSelectText: '',
        placeholder: true, // Ajoutez cette ligne pour activer le placeholder
        placeholderValue: 'Sélectionnez des compétences', // Texte du placeholder

    });
    
    $(document).ready(function(){
        $('#search-input-skill').on('keyup', function(){
            let term = $(this).val();
            $.post('user/search_skills', { term: term }, function(data){
                let skills = JSON.parse(data);
                $('#skills-list').empty();
                skills.forEach(function(skill){
                    $('#skills-list').append(`<div class="text-3xl lg:text-base skill-item" data-id="${skill.skillId}">${skill.skillName}</div>`);
                });
            });
        });

        $(document).on('click', '.skill-item', function(){
            let skillId = $(this).data('id');
            let skillName = $(this).text();
            // Vérifiez si la compétence est déjà sélectionnée
            if (!$(`#selected-skills .selected-skill[data-id="${skillId}"]`).length) {
                $('#selected-skills').append(`<div class="text-3xl lg:text-base selected-skill" data-id="${skillId}">${skillName}</div>`);
            }
        });
    });

    


    var base_url = '<?php echo base_url(); ?>';


    document.addEventListener('DOMContentLoaded', function() {
    var slider = document.getElementById('tjm-slider');
    var min = document.getElementById('tjm-min');
    var max = document.getElementById('tjm-max');
    var userTJM = <?=$user->userTJM?>;
    noUiSlider.create(slider, {
        start: [userTJM, userTJM + 400],
        connect: true,
        range: {
        'min': 300,
        'max': 1200
        },
        step: 10, // Ajout de la propriété step pour les tranches de 10
        format: {
        to: function(value) {
            return parseInt(value) + '€';
        },
        from: function(value) {
            return value.replace('€', '');
        }
        }
    });

    slider.noUiSlider.on('update', function(values, handle) {
        if (handle === 0) {
        min.textContent = values[handle];
        } else {
        max.textContent = values[handle];
        }
    });
    });

    document.addEventListener("DOMContentLoaded", function(event) {
        document.getElementById('updateProductButton').click();
    });
    $(document).ready(function() {
        // Écouteur d'événement pour détecter les changements dans la barre de recherche
        $('#search-input').on('input', function() {
            // Masquer la section "Pour vous" par défaut
            $('#result-section').hide();

            var searchText = removeAccents($(this).val().trim().toLowerCase());

            // Parcours de chaque mission pour filtrer celles qui correspondent à la recherche
            var anyMissionFound = false;
            $('.mission-item').each(function() {
                var missionName = removeAccents($(this).data('mission-name').toLowerCase());
                if (missionName.includes(searchText)) {
                    $(this).show(); // Affiche la mission si elle correspond à la recherche
                    anyMissionFound = true;
                } else {
                    $(this).hide(); // Masque la mission si elle ne correspond pas à la recherche
                }
            });

            // Afficher ou masquer la section "Aucune mission n'a été trouvée" en fonction des résultats de la recherche
            if (anyMissionFound) {
                $('#no-mission-found').hide();
                $('#result-section').show();
            } else {
                $('#no-mission-found').show();
                $('#result-section').hide();
            }
        });

        
    });

    // Fonction pour supprimer les accents d'une chaîne de caractères
    function removeAccents(str) {
        return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    }

    // JavaScript code for handling active filters
document.addEventListener("DOMContentLoaded", function() {
    var slider = document.getElementById('tjm-slider');
    const checkboxes = document.querySelectorAll(".form-checkbox");

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener("change", filterMissions);
    });

    $('#skillsAll').on('change', function() {
        filterMissions();
    });

    slider.noUiSlider.on("change", filterMissions);

    document.getElementById("citySearch").addEventListener("keyup", filterMissions);


    $(document).ready(function() {
        $('#resetFiltersButton').on('click', function() {
            // Réinitialisez les filtres en décochant toutes les cases à cocher
            $('.form-checkbox').prop('checked', false);

            $('#citySearch').val('');

            document.querySelector('#skillsAll').parentNode.querySelector('.choices__input--cloned').value = '';


            skillsChoices.removeActiveItems();
            
            var slider = document.getElementById('tjm-slider');
            var defaultTJMValues = [300, 1200]; // Valeurs par défaut
            slider.noUiSlider.set(defaultTJMValues);

            filterMissions();
        });
    });

    function filterMissions() {
        const missions = document.querySelectorAll(".mission-item");
        const activeFilters = [];
        const cityInput = document.getElementById("citySearch");
        const cityFilter = cityInput.value.toLowerCase();
        const tjmValues = slider.noUiSlider.get();
        const tjmMin = parseInt(tjmValues[0]);
        const tjmMax = parseInt(tjmValues[1]);
        const selectedSkills = $('#skillsAll').val();
        

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                activeFilters.push(checkbox.id);
            }
        });

        const typeFilters = []; // Tableau pour stocker les filtres d'expertise sélectionnés

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked && (checkbox.id === "temps-plein" || checkbox.id === "temps-partiel")) {
                typeFilters.push(checkbox.id);
            }
        });

        const expertiseFilters = []; // Tableau pour stocker les filtres d'expertise sélectionnés

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked && (checkbox.id === "junior" || checkbox.id === "intermediaire" || checkbox.id === "expert")) {
                expertiseFilters.push(checkbox.id);
            }
        });

        const durationFilters = []; // Tableau pour stocker les filtres d'expertise sélectionnés

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked && (checkbox.id === "courte" || checkbox.id === "longue" || checkbox.id === "indefinie")) {
                durationFilters.push(checkbox.id);
            }
        });

        const deroulementFilters = []; // Tableau pour stocker les filtres d'expertise sélectionnés

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked && (checkbox.id === "teletravail" || checkbox.id === "site" || checkbox.id === "hybride")) {
                deroulementFilters.push(checkbox.id);
            }
        });

        let visibleMissionsCount = 0;

        missions.forEach(function(mission) {
            const missionName = mission.getAttribute("data-mission-name");
            const missionType = mission.getAttribute("data-mission-type");
            const missionDeroulement = mission.getAttribute("data-mission-deroulement");
            const missionDuration = mission.getAttribute("data-mission-duree");
            const missionExpertise = mission.getAttribute("data-mission-expertise");
            const missionLocalisation = mission.getAttribute("data-mission-localisation").toLowerCase();
            const missionSkillsAttr = mission.getAttribute("data-mission-skills");
            const missionTJM = parseInt(mission.getAttribute("data-mission-tjm"));
/*
            let showMission = activeFilters.every(function(filter) {
                if (filter === "temps-plein" && missionType !== "temps-plein") return false;
                //if (filter === "remote" && missionDeroulement !== "1") return false;
                if (filter === "temps-partiel" && missionType !== "temps-partiel") return false;
                //if (filter === "junior" && missionExpertise !== "junior") return false;
                //if (filter === "intermediaire" && missionExpertise !== "intermediaire") return false;
                //if (filter === "expert" && missionExpertise !== "expert") return false;
                return true;
            });
*/

            let showMission = true;

             // Filtre par type
            let matchesType = true;
            if (typeFilters.length > 0) {
                matchesType = typeFilters.some(function(filter) {
                    return (
                        (filter === "temps-plein" && missionType === "temps-plein") ||
                        (filter === "temps-partiel" && missionType === "temps-partiel")
                    );
                });
            }
            showMission = showMission && matchesType;           

            // Filtre par expertise
            let matchesExpertise = true;
            if (expertiseFilters.length > 0) {
                matchesExpertise = expertiseFilters.some(function(filter) {
                    return (
                        (filter === "junior" && missionExpertise === "junior") ||
                        (filter === "intermediaire" && missionExpertise === "intermediaire") ||
                        (filter === "expert" && missionExpertise === "expert")
                    );
                });
            }
            showMission = showMission && matchesExpertise;

            // Filtre par duree
            let matchesDuration = true;
            if (durationFilters.length > 0) {
                matchesDuration = durationFilters.some(function(filter) {
                    return (
                        (filter === "courte" && missionDuration === "courte") ||
                        (filter === "longue" && missionDuration === "longue") ||
                        (filter === "indefinie" && missionDuration === "indefinie")
                    );
                });
            }
            showMission = showMission && matchesDuration;

            // Filtre par mode de deroulement
            let matchesDeroulement = true;
            console.log("1", deroulementFilters);
            console.log("1", deroulementFilters);
            if (deroulementFilters.length > 0) {
                matchesDeroulement = deroulementFilters.some(function(filter) {
                    return (
                        (filter === "teletravail" && missionDeroulement === "teletravail") ||
                        (filter === "site" && missionDeroulement === "site") ||
                        (filter === "hybride" && missionDeroulement === "hybride")
                    );
                });
            }
            showMission = showMission && matchesDeroulement;

            
            if (missionTJM < tjmMin || missionTJM > tjmMax) {
                    showMission = false;
            }

            // Filtre par ville
            if (cityFilter && !missionLocalisation.includes(cityFilter)) {
                showMission = false;
            }

            // Filtre par compétences
            if (selectedSkills.length > 0) {
                const missionSkills = missionSkillsAttr.split(','); // Divise la chaîne en un tableau d'IDs de compétences
                console.log("1 :",missionSkills);
                console.log("2 :",selectedSkills);
                const matchesSkills = selectedSkills.some(function(selectedSkill) {
                    return missionSkills.includes(selectedSkill);
                });
                if (!matchesSkills) {
                    showMission = false;
                }
            }

            mission.style.display = showMission ? "block" : "none";

            if (showMission) {
                visibleMissionsCount++;
            }
        });

        const noMissionFound = document.getElementById("no-mission-found");
        noMissionFound.style.display = visibleMissionsCount === 0 ? "block" : "none";

    }

    filterMissions();
});

</script>