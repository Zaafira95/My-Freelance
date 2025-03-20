<?php
$currentPage = 'dashboard';


// Header Call
include(APPPATH . 'views/layouts/user/header.php');
?>
<head>
    <title> My Freelance </title>

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


<div class="px-8 py-6 lg:px-4 lg:py-6 h-90 lg:overflow-y-auto no-scrollbar ">
    <div class="justify-between items-center mx-auto max-w-screen-xl h-full">
        <div class="lg:flex gap-6 h-full mb-3">
            <!-- Bloc Filtre -->
            <div class=" w-full lg:w-1/4 md:block">
                <!-- Button to show filer block on mobile -->
                <div class="relative text-right mb-4 lg:hidden">
                    <button id="showFilterButton" class="relative text-4xl text-primary border p-2 border-primary  rounded-lg 2 hover:bg-primary-900 hover:text-white">
                        <i class="fas fa-sliders-h"></i>
                    </button>
                </div>
                <div class="hidden lg:block bg-white rounded-lg lg:h-full overflow-y-auto no-scrollbar lg:no-shadow shadow-lg mb-8 lg:mb-4 p-4 dark:bg-gray-800 dark:text-white" id="FilterMission">
                    <h3 class="text-3xl lg:text-lg font-medium mt-2">Filters</h3>
                    <!-- <h4 class="text-3xl lg:text-lg font-medium mt-4">Location</h4>
                        <div class="flex items-center mt-2">
                            <i class="text-3xl lg:text-base fa fa-map-marker-alt mr-3"></i>    
                            <div class="relative city-search-container w-full">
                                <input type="text" id="citySearch" value="<?=$user->userVille?>" placeholder="Cherchez votre ville" class="text-3xl lg:text-lg border p-2 rounded-lg w-full text-black" onkeypress="return preventNumberInput(event)">
                                <div id="cities-list" class="text-3xl lg:text-lg absolute z-10 mt-2 w-full  rounded bg-white max-h-64 overflow-y-auto text-black"></div>
                            </div>
                        </div> -->
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Location</h4>
                    <div class="w-full mx-auto mt-5 text-black">
                        <select id="countriesAll" name="countriesAll[]" multiple class="text-3xl lg:text-base mt-1 block w-full py-2 px-3 border border-gray-300 bg-white text-black rounded-full shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <?php foreach ($countriesAll as $country): ?>
                                <!-- <option class="text-black" value="<?= $country['idCountry'] ?>" 
                                    <?php if (!empty($userCountry)): ?>
                                            <?= ($userCountry->$userCoutryId == $country['idCountry']) ? 'selected' : '' ?>
                                    <?php endif; ?>> -->
                                    <option class="text-black" value="<?= $country['idCountry'] ?>">
                                    <?= $country['countryName'] ?>
                                    </option>
                                    
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Job Type</h4>
                    <div class="mt-2">
                        <label class="flex items-center ">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="temps-plein" <?= ($user->userJobTimePartielOrFullTime == 'temps-plein') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Full-time</span>
                        </label>
                        <label class="flex items-center text-xl lg:text-base">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="temps-partiel" <?= ($user->userJobTimePartielOrFullTime == 'temps-partiel') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Part-time</span>
                        </label>
                    </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Mission Duration</h4>
                    <div class="mt-2">
                        <label class="flex items-center text-xl lg:text-base">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="courte" <?= ($user->userJobTime == 'Courte Durée') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Short-term</span>
                        </label>
                        <label class="flex items-center text-xl lg:text-base">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="longue" <?= ($user->userJobTime == 'Longue Durée') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Long-term</span>
                        </label>
                        <label class="flex items-center text-xl lg:text-base">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="indefinie" <?= ($user->userJobTime == 'Durée indéfinie') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Indefinite duration</span>
                        </label>
                    </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Work Mode</h4>
                    <div class="mt-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="site" <?= ($user->userJobType === 'Physique') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">On-site</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="teletravail" <?= ($user->userJobType === 'Remote') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Remote</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="hybride" <?= ($user->userJobType === 'Hybride') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Hybrid</span>
                        </label>
                    </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Experience Level</h4>
                    <div class="mt-2">
                        <label class="flex items-center text-xl lg:text-base">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="junior" <?= ($user->userExperienceYear === 'junior') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Junior (1 to 2 years)</span>
                        </label>
                        <label class="flex items-center text-xl lg:text-base">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="intermediaire" <?= ($user->userExperienceYear === 'intermediaire') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Intermediate (3 to 5 years)</span>
                        </label>
                        <label class="flex items-center text-xl lg:text-base">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="expert" <?= ($user->userExperienceYear === 'expert') ? 'checked' : '' ?>>
                            <span class="ml-2 text-3xl lg:text-base">Expert (5+ years)</span>
                        </label>
                    </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Daily rate</h4>
                    <div class="mt-2 mr-3">
                        <div id="tjm-slider" class="w-full mt-2"></div>
                        <div class="flex justify-between mt-2">
                            <span id="tjm-min" class="text-3xl lg:text-base">300AED</span>
                            <span id="tjm-max" class="text-3xl lg:text-base">1200AED</span>
                        </div>
                    </div>
                
                    <h4 class="text-3xl lg:text-base font-medium mt-4">Skills</h4>
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
                                    <?= $skill['skillName'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Jobs</h4>
                    <div class="w-full mx-auto mt-5 text-black">
                        <select id="jobsAll" name="jobsAll[]" multiple class="text-3xl lg:text-base mt-1 block w-full py-2 px-3 border border-gray-300 bg-white text-black rounded-full shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <?php foreach ($jobsAll as $job): ?>
                                <option class="text-black" value="<?= $job['jobId'] ?>"
                                    <?php if (!empty($jobUser)): ?>
                                            <?= ($jobUser->userJob_jobId == $job['jobId']) ? 'selected' : '' ?>
                                    <?php endif; ?>>
                                    <?= $job['jobName'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="flex justify-between mt-6">
                        <button id="resetFiltersButton" class="text-3xl lg:text-base text-primary border border-primary px-4 py-1 rounded-full 2 hover:bg-primary-900 hover:text-white">Cancel</button>
                    </div>

                </div>
                
            </div>
            <!-- Fin Bloc Filtre -->

            <!-- Début Mission -->
            <div class="w-full lg:w-6/12 lg:sticky lg:top-0 h-full overflow-y-auto no-scrollbar">
                <!-- Barre de recherche -->
                <div class="bg-primary rounded-lg h-20vh p-4 text-white">
                    <p class="text-3xl lg:text-lg font-bold">Hello, <?=$user->userFirstName?></p>
                    <p class="text-3xl lg:text-base mt-2 mb-2">Discover the fastest and most effective way to land a mission.</p>
                    <div class="flex w-full">
                        <input type="text" id="search-input" class="text-3xl lg:text-base w-full bg-white bg-opacity-20 rounded-lg p-2 placeholder-white mr-2 text-center" placeholder="Type the job title you are looking for..." />
                        <!-- <button class="w-1/5 bg-white text-primary rounded-lg px-4 py-2">Rechercher</button> -->
                    </div>
                </div>
                <!-- Fin Barre de recherche -->
                <!-- Début section pour vous -->
                <h3 class="text-5xl lg:text-2xl font-medium mt-4 mb-4" id="result-section">For you:</h3> 
                <!-- Début section contenant toutes les missions -->
                <div class="flex flex-wrap" id="missions-section">
                    <!-- Fonction ajouter favoris -->
                    <?php
                    if (!function_exists('isFavorite')) {
                        function isFavorite($missionId, $favoriteMissions) {
                            foreach ($favoriteMissions as $favoriteMission) {
                                if ($favoriteMission->idMissionSavedMission == $missionId) {
                                    return true;
                                }
                            }
                            return false;
                        }
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
                            data-mission-job="<?=strtolower($mission->missionJobId)?>"
                            data-mission-deroulement="<?=strtolower($mission->missionDeroulement)?>"
                            data-mission-duree="<?=strtolower($mission->missionDuration)?>" 
                            data-mission-expertise="<?=strtolower($mission->missionExpertise)?>" 
                            data-mission-tjm="<?=$mission->missionTJM?>" 
                            data-mission-localisation="<?=strtolower($mission->missionCountryId)?>"
                            data-mission-skills="<?=$dataMissionSkillsString?>"> 
                            <!-- Fin du a -->

                            <!-- Début de la carte -->
                            <div class="bg-white w-full mb-4 rounded-lg lg:h-20vh p-4 dark:bg-gray-800 dark:text-white relative mission-item" data-mission-name="<?=strtolower($mission->missionName)?>" data-mission-job="<?=strtolower($mission->missionJobId)?>" data-mission-type="<?=strtolower($mission->missionType)?>" data-mission-deroulement="<?=strtolower($mission->missionDeroulement)?>" data-mission-duree="<?=strtolower($mission->missionDuration)?>" data-mission-expertise="<?=strtolower($mission->missionExpertise)?>" data-mission-tjm="<?=$mission->missionTJM?>" data-mission-localisation="<?=$mission->missionCountryId?>" data-mission-skills="<?=$dataMissionSkillsString?>">
                                
                                <!-- Début div en tête -->
                                <div class="flex items-center">

                                    <!-- Div logo entreprise -->
                                    <div class="mr-4">
                                        <!-- Logo entreprise --> 
                                        <?php foreach ($missionCompany[$mission->idMission] as $company) : ?>
                                            <?php if (is_object($company)) : ?>
                                            <img src="<?=base_url($company->companyLogoPath)?>" alt="Logo de l'entreprise" class="object-cover w-16 h-16 lg:w-10 rounded-full">
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <!-- Fin logo entreprise -->
                                    </div>
                                    <!-- Fin div logo entreprise -->

                                    <!-- Div informations clés mission -->
                                    <div class="w-3/4 mr-4">
                                        <h2 class="text-3xl lg:text-lg font-bold"><?=$mission->missionName?></h2>
                                        <p class="text-3xl lg:text-base">
                                            <span class="mr-2"> 
                                                •   <?php foreach ($jobsAll as $joba): ?>
                                                        <?php if ($mission->missionJobId == $joba['jobId']): ?>
                                                            <?= $joba['jobName'] ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                            </span>

                                            <span class="mr-2"> 
                                                • Daily rate : <?=$mission->missionTJM?> AED
                                            </span>
                                            
                                            <span class="mr-2"> •
                                                <?php
                                                if ($mission->missionDuration == "courte"){
                                                    $mission->missionDuration = "Short-term";
                                                }
                                                elseif ($mission->missionDuration == "longue"){
                                                    $mission->missionDuration = "Long-term";
                                                }
                                                elseif ($mission->missionDuration == "indefinie"){
                                                    $mission->missionDuration = "Indefinite duration";
                                                }                                            
                                                ?>
                                                <?=$mission->missionDuration?> 
                                            </span>
                                            
                                            <span class="mr-2"> •
                                                <?php
                                                if ($mission->missionType == "temps-plein"){
                                                    $mission->missionType = "Full-time";
                                                }
                                                elseif ($mission->missionType == "temps-partiel"){
                                                    $mission->missionType = "Part-time";
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
                                                    $mission->missionDeroulement = "Full remote";
                                                }
                                                elseif ($mission->missionDeroulement == "site"){
                                                    $mission->missionDeroulement = "On site";
                                                }
                                                elseif ($mission->missionDeroulement == "hybride"){
                                                    $mission->missionDeroulement = "Hybrid";
                                                }                                            
                                                ?>
                                                <?=$mission->missionDeroulement?>
                                            </span>

                                            <span class="mr-2"> 
                                                •   <?php foreach ($countriesAll as $country): ?>
                                                        <?php if ($mission->missionCountryId == $country['idCountry']): ?>
                                                            <?= $country['countryName'] ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                            </span>

                                            <span class="mr-2"> •
                                                <?php
                                                if ($mission->missionExpertise == "junior"){
                                                    $mission->missionExpertise = "Junior";
                                                }
                                                elseif ($mission->missionExpertise == "intermediaire"){
                                                    $mission->missionExpertise = "Intermediate";
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
					<div class="font-normal overflow-hidden text-3xl lg:text-base mt-4 mb-4" style="max-height:6em;">
                                        <p>

                                            <?php 
                                            // limit missionDescription to 270 caracteres and add '...' at the end
                                                $mission->missionDescription = strlen($mission->missionDescription) > 270 ? substr($mission->missionDescription,0,270)."..." : $mission->missionDescription;    
                                            ?>
                                            <?=$mission->missionDescription?>
                                        </p>
					</div>
                                        <!-- Fin description mission -->

                                        <!-- Compétences mission -->
                                        <div class="skills-container mt-4 mb-4">
                                            <?php
                                                $dataMissionSkills = [];
						// Compteur skills
                                            	$countSkills = 0;
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
                                            	// limit skills to 5
                                           	if ($countSkills <= 5) { ?>
                                                <div class="text-3xl lg:text-base skill-item" data-level="<?=$level?>">
                                                    <span class="text-3xl lg:text-base dark:<?=$textdark?> inline-block px-4 py-1 rounded-full <?=$text?>" style="background-color:<?=$color?>;"><?=$skill->skillName?></span>
                                                    <div class="skill-level"><?=$level?></div>
                                                </div>
 <?php
                                                $countSkills++;
                                            } else {
                                                break;
                                            }
                                            ?>
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
                                        <i class="fas fa-heart text-4xl lg:text-xl text-red-800"></i>
                                    </a>
                                    <?php
                                        } else {
                                    ?>
                                    <a href="<?php echo base_url('user/addToFavorite/'.$mission->idMission);?>">
                                        <i class="far fa-heart text-4xl lg:text-xl text-red-800"></i>
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
                    <p class="text-3xl lg:text-lg mt-6 text-left">No missions found.</p>
                    <h3 class="text-5xl lg:text-2xl font-medium mt-10" id="result-section">Other missions:</h3>
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
                        data-mission-job="<?=strtolower($mission->missionJobId)?>"
                        data-mission-deroulement="<?=strtolower($mission->missionDeroulement)?>"
                        data-mission-duree="<?=strtolower($mission->missionDuration)?>" 
                        data-mission-expertise="<?=strtolower($mission->missionExpertise)?>" 
                        data-mission-tjm="<?=$mission->missionTJM?>" 
                        data-mission-localisation="<?=strtolower($mission->missionLocalisation)?>"
                        data-mission-skills="<?=$dataMissionSkillsString?>"> 
                        <!-- Début carte mission -->
                        <div class="mb-12 bg-white w-full rounded-lg h-20vh mt-4 p-8 lg:p-4 dark:bg-gray-800 dark:text-white relative lg:mb-2" data-mission-name="<?=strtolower($mission->missionName)?>" data-mission-job="<?=strtolower($mission->missionJobId)?>" data-mission-type="<?=strtolower($mission->missionType)?>" data-mission-deroulement="<?=strtolower($mission->missionDeroulement)?>" data-mission-duree="<?=strtolower($mission->missionDuration)?>" data-mission-expertise="<?=strtolower($mission->missionExpertise)?>" data-mission-tjm="<?=$mission->missionTJM?>" data-mission-localisation="<?=$mission->missionCountryId?>" data-mission-skills="<?=$dataMissionSkillsString?>">
                            <!-- Début div en tête -->
                            <div class="flex items-center">
                                <div class="mr-4">
                                    <?php foreach ($missionCompany[$mission->idMission] as $company) : ?>
                                        <?php if (is_object($company)) : ?>
                                            <img src="<?=base_url($company->companyLogoPath)?>" alt="Logo de l'entreprise" class="object-cover w-16 h-16 lg:w-10 rounded-full">
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                                <div class="w-3/4 mr-4">
                                    <h2 class="text-3xl lg:text-lg font-bold "><?=$mission->missionName?></h2>
                                    <p class="text-3xl lg:text-base">
                                        <span class="mr-2"> 
                                            •   <?= $mission->jobName?>
                                        </span>
                                        
                                        <span class="mr-2">
                                            • Daily rate: <?=$mission->missionTJM?> AED
                                        </span>
                                        
                                        <span class="mr-2"> •
                                            <?php
                                            if ($mission->missionDuration == "courte"){
                                                $mission->missionDuration = "Short-term";
                                            }
                                            elseif ($mission->missionDuration == "longue"){
                                                $mission->missionDuration = "Long-term";
                                            }
                                            elseif ($mission->missionDuration == "indefinie"){
                                                $mission->missionDuration = "Indefinite duration";
                                            }                                            
                                            ?>
                                            <?=$mission->missionDuration?> 
                                        </span>
                                        
                                        <span class="mr-2"> •
                                            <?php
                                            if ($mission->missionType == "temps-plein"){
                                                $mission->missionType = "Full-time";
                                            }
                                            elseif ($mission->missionType == "temps-partiel"){
                                                $mission->missionType = "Part-time";
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
                                                $mission->missionDeroulement = "Full remote";
                                            }
                                            elseif ($mission->missionDeroulement == "site"){
                                                $mission->missionDeroulement = "On site";
                                            }
                                            elseif ($mission->missionDeroulement == "hybride"){
                                                $mission->missionDeroulement = "Hybrid";
                                            }                                            
                                            ?>
                                            <?=$mission->missionDeroulement?>
                                        </span>

                                        <span class="mr-2"> 
                                        •   <?php foreach ($countriesAll as $country): ?>
                                                <?php if ($mission->missionCountryId == $country['idCountry']): ?>
                                                    <?= $country['countryName'] ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </span>

                                        <span class="mr-2"> •
                                            <?php
                                            if ($mission->missionExpertise == "junior"){
                                                $mission->missionExpertise = "Junior";
                                            }
                                            elseif ($mission->missionExpertise == "intermediaire"){
                                                $mission->missionExpertise = "Intermediate";
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
				<div class="font-normal overflow-hidden text-3xl lg:text-base mt-4 mb-4" style="max-height:6em;">
                                     <p>
                                        <?php 
                                        // limit missionDescription to 270 caracteres and add '...' at the end
                                        $mission->missionDescription = strlen($mission->missionDescription) > 270 ? substr($mission->missionDescription,0,270)."..." : $mission->missionDescription;    
                                        ?>
                                        <?=$mission->missionDescription?>
                                    </p>
				</div>
                                    <div class="skills-container mb-4 mt-4">
                                        <?php
                                            $dataMissionSkills = [];
						$countSkills = 0;
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
                                            // limit skills to 5
                                            if ($countSkills <= 5) { ?>
                                            <div class="skill-item" data-level="<?=$level?>">
                                                <span class="text-3xl lg:text-base dark:<?=$textdark?> inline-block px-4 py-1 rounded-full <?=$text?>" style="background-color:<?=$color?>;"><?=$skill->skillName?></span>
                                                <div class="skill-level"><?=$level?></div>
                                            </div>
 						<?php
                                                $countSkills++;
                                            } else {
                                                break;
                                            }
                                            ?>
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
                                        <i class="fas fa-heart text-4xl lg:text-xl text-red-800"></i>
                                    </a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="<?php echo base_url('user/addToFavorite/'.$mission->idMission);?>">
                                        <i class="far fa-heart text-4xl lg:text-xl text-red-800"></i>
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
                            <img src="<?php echo base_url($user->userAvatarPath); ?>" alt="Avatar" class="object-cover w-20 h-20 p-0.5 rounded-full ring-2 ring-primary">
                        </div>

                            <h3 class="text-lg font-medium mt-2"><?=$user->userFirstName .' '. $user->userLastName?></h3>
                    </a>
                        <div class="items-center mt-1">
                            <p class="font-light text-center"><?=$jobUser->jobName?></p>
                            <p class="font-light text-center"><?=$user->userTJM . ' AED'?></p>
                        </div>
                      <?php
                        if ($tauxCompletion != 100){
                        ?>
                            <div class="flex items-center mt-1">
                                <p class="text-xl lg:text-base italic font-light">Profile completed at <?= $tauxCompletion?>%</p>
                            </div>
                        <?php 
                        }
                      ?>
                        <a href="<?php echo base_url('User/profil');?>" class="text-primary mt-2 border border-primary px-4 py-1 rounded-full hover:bg-primary-900 hover:text-white">Edit my profile</a>
                    <!-- missions favorites -->
                        <a href="<?php echo base_url('User/favoriteMission');?>" class="text-primary mt-2  px-4 py-1 rounded 2 hover:bg-primary-900 hover:text-white">My favorite missions</a>
                        <a href="<?php echo base_url('user/logout');?>" class="text-red-800 mt-2 hover:text-red-900">Logout</a>

                    </div>
                </div>

                <div class="bg-white rounded-lg mt-4 p-4 text-left dark:bg-gray-800 dark:text-white">
                    <h3 class="text-xl font-medium mt-2">Experiences</h3>
                    <?php if (is_array($experiences) && !empty($experiences)) {
                        $experienceCount = 0;
                        foreach ($experiences as $experience) {
                            if ($experienceCount < 3) {
                        ?>
                                <div class="w-full items-center mt-2 mb-2 p-2 rounded-lg shadow">
                                    <div class="mr-2 mt-2">
                                        <h3 class="text-lg font-medium"><?= $experience->experienceJob ?></h3>
                                    </div>
                                    <div>
                                        
                                        <p class="text-sm text-gray-500"><?= $experience->experienceCompany ?></p>
                                        
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
                        <p class="mt-2 mb-4"> No experience available. </p>
                        <a href="<?php echo base_url('User/profil');?>" class="text-3xl lg:text-base py-2 px-4 bg-primary text-white rounded-full">Add an experience</a>
                    <?php } ?>
                </div>


                <div class="bg-white rounded-lg mt-4 p-4 text-left dark:bg-gray-800 dark:text-white">
                    <h3 class="text-xl font-medium mt-2 mb-4">Skills and expertise</h3>
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
                                    $level = 'Intermediate';
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
                        <p class="mt-2 mb-4"> No skills and expertise provided. </p>
                        <a href="<?php echo base_url('User/profil');?>" class="text-3xl lg:text-base py-2 px-4 bg-primary text-white rounded-full">Add a skill</a>
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

    function preventNumberInput(e) {
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return true;
        }
        return false;
    }


    $(document).ready(function() {
    

        // $('#citySearch').on('keyup', function() {
        //     let term = $(this).val();
        //     if(term.length > 2) { // Recherche après 2 caractères
        //         $.post('user/search_cities', { term: term }, function(data) {
        //             let cities = JSON.parse(data);
        //             if(cities.length > 0) {
        //                 // Ajoutez la classe .has-border si des résultats sont retournés
        //                 $('#cities-list').addClass('has-border');
        //             } else {
        //                 // Supprimez la classe .has-border si aucun résultat n'est retourné
        //                 $('#cities-list').removeClass('has-border');
        //             }
        //             $('#cities-list').empty();
        //             cities.forEach(function(city) {
        //                 $('#cities-list').append(`<div class="city-item p-2 hover:bg-gray-200 cursor-pointer" data-id="${city.geoname_id}">${city.name}</div>`);
        //             });
        //         });
        //     }
        //     else {
        //         // Supprimez la classe .has-border si l'input est trop court
        //         $('#cities-list').removeClass('has-border').empty();
        //     }
        // });

        // $(document).on('click', '.city-item', function() {
        //     let cityName = $(this).text();
        //     $('#citySearch').val(cityName);  // Mettez à jour le champ de saisie avec le nom de la ville sélectionnée
        //     $('#cities-list').empty(); // Videz la liste
        //     $('#cities-list').removeClass('has-border').empty();
        // });

        // Pour fermer la liste lorsque vous cliquez en dehors
        // $(document).on('click', function(event) {
        //     // Si le clic n'est pas sur le champ de saisie (#citySearch)
        //     // et n'est pas sur un élément à l'intérieur de la liste (#cities-list)...
        //     if (!$(event.target).closest('#citySearch, #cities-list').length) {
        //         // ... alors videz et fermez la liste.
        //         $('#cities-list').empty().removeClass('has-border');
        //     }
        // });

    });

    //Script selection des compétences
    const skillsChoices = new Choices('#skillsAll', {
        searchEnabled: true,
        removeItemButton: true,
        itemSelectText: '',
        placeholder: true, // Ajoutez cette ligne pour activer le placeholder
        placeholderValue: 'Select skills', // Texte du placeholder

    });

    //Script selection des métiers
        const jobsChoices = new Choices('#jobsAll', {
        searchEnabled: true,
        removeItemButton: true,
        itemSelectText: '',
        placeholder: true, // Ajoutez cette ligne pour activer le placeholder
        placeholderValue: 'Select jobs', // Texte du placeholder

    });

        //Script selection des métiers
        const countriesChoices = new Choices('#countriesAll', {
        searchEnabled: true,
        removeItemButton: true,
        itemSelectText: '',
        placeholder: true, // Ajoutez cette ligne pour activer le placeholder
        placeholderValue: 'Select country', // Texte du placeholder

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
            return parseInt(value) + ' AED';
        },
        from: function(value) {
            return value.replace(' AED', '');
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

    $('#jobsAll').on('change', function() {
        filterMissions();
    });
    
    $('#countriesAll').on('change', function() {
        filterMissions();
    });

    slider.noUiSlider.on("change", filterMissions);

    // POUR RECHERCHE LOCALISATION --> document.getElementById("citySearch").addEventListener("keyup", filterMissions);

    $(document).ready(function() {
        $('#resetFiltersButton').on('click', function() {
            // Réinitialisez les filtres en décochant toutes les cases à cocher
            $('.form-checkbox').prop('checked', false);

            // document.querySelector('#skillsAll').parentNode.querySelector('.choices__input--cloned').value = '';
            // document.querySelector('#jobsAll').parentNode.querySelector('.choices__input--cloned').value = '';

            skillsChoices.removeActiveItems();
            jobsChoices.removeActiveItems();
            countriesChoices.removeActiveItems();
            
            var slider = document.getElementById('tjm-slider');
            var defaultTJMValues = [300, 1200]; // Valeurs par défaut
            slider.noUiSlider.set(defaultTJMValues);

            filterMissions();
        });
    });

    function filterMissions() {
        const missions = document.querySelectorAll(".mission-item");
        const activeFilters = [];
        // POUR RECHERCHE LOCALISATION --> const cityInput = document.getElementById("citySearch");
        // POUR RECHERCHE LOCALISATION --> const cityFilter = cityInput.value.toLowerCase();
        const tjmValues = slider.noUiSlider.get();
        const tjmMin = parseInt(tjmValues[0]);
        const tjmMax = parseInt(tjmValues[1]);
        const selectedSkills = $('#skillsAll').val();
        const selectedJobs = $('#jobsAll').val();
        const selectedCountry = $('#countriesAll').val();
        

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
            const missionJobAttr = mission.getAttribute("data-mission-job");
            const missionJob = missionJobAttr.split(',');
            const missionDeroulement = mission.getAttribute("data-mission-deroulement");
            const missionDuration = mission.getAttribute("data-mission-duree");
            const missionExpertise = mission.getAttribute("data-mission-expertise");
            //const missionLocalisation = mission.getAttribute("data-mission-localisation").toLowerCase();
            const missionLocalisationAttr = mission.getAttribute("data-mission-localisation").toLowerCase();
            const missionLocalisation = missionLocalisationAttr;
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

            // FILTRE LOCALISATION 
            // if (cityFilter && !missionLocalisation.includes(cityFilter)) {
            //     showMission = false;
            // }

            // Filtre par compétences
            if (selectedSkills.length > 0) {
                const missionSkills = missionSkillsAttr.split(','); // Divise la chaîne en un tableau d'IDs de compétences
                const matchesSkills = selectedSkills.some(function(selectedSkill) {
                    return missionSkills.includes(selectedSkill);
                });
                if (!matchesSkills) {
                    showMission = false;
                }
            }
                                
            // Filtre par métier
            if (selectedJobs.length > 0) {
                const matchesJob = selectedJobs.some(function(selectedJob) {
                    return missionJob.includes(selectedJob);
                });
                if (!matchesJob) {
                    showMission = false;
                }
            }
                                            
            // Filtre par pays
            if (selectedCountry.length > 0) {
                const matchesCountry = selectedCountry.some(function(selectedCountry) {
                    return missionLocalisation.includes(selectedCountry);
                });
                if (!matchesCountry) {
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

$(document).ready(function(){ 

    $(document).on('change', 'input[name="finIndisponibiliteDuree"]', function() {
        const selectedDuration = $(this).val();
        const dateInput = document.getElementById('dateFinIndisponibilite');

        if (selectedDuration === '1') {
            const endDate = new Date();
            endDate.setMonth(endDate.getMonth() + 1);
            const endDateString = endDate.toISOString().split('T')[0];
            dateInput.value = endDateString;
        } else if (selectedDuration === '3') {
            const endDate = new Date();
            endDate.setMonth(endDate.getMonth() + 3);
            const endDateString = endDate.toISOString().split('T')[0];
            dateInput.value = endDateString;
        } else if (selectedDuration === '6') {
            const endDate = new Date();
            endDate.setMonth(endDate.getMonth() + 6);
            const endDateString = endDate.toISOString().split('T')[0];
            dateInput.value = endDateString;
        } else {
            dateInput.value = '';
        }
    });

    $('#userAvailabilityForm').on('submit', function(event) {
        var dateInput = document.getElementById('dateFinIndisponibilite');
        var checkBox = document.getElementById('hs-basic-with-description');

        if (!checkBox.checked && dateInput.value == '') {
            $('#errorDateFinIndisponibilite').show();
            event.preventDefault(); // Empêcher la soumission du formulaire
        }
    });

});

function displayAvailibilityOptions() {
    var checkBox = document.getElementById('hs-basic-with-description');

    var isAvailableDiv = document.getElementById('isAvailaibleOptions');
    var isNotAvailableDiv = document.getElementById('isNotAvailaibleOptions');
    var radioButtons = document.getElementsByClassName('finIndisponibiliteBtn');
    var dateInput = document.getElementById('dateFinIndisponibilite');
    var errorMessage = document.getElementById('errorDateFinIndisponibilite');

    if (checkBox.checked) {
        isAvailableDiv.style.display = 'block';
        isNotAvailableDiv.style.display = 'none';
        errorMessage.style.display = 'none';
        for (var i = 0; i < radioButtons.length; i++) {
            radioButtons[i].checked = false;
        }
        dateInput.value = '';
    } else {
        isAvailableDiv.style.display = 'none';
        isNotAvailableDiv.style.display = 'block';
    }
}

</script>