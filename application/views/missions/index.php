<?php
// Header Call
$currentPage = 'missions';

include(APPPATH . 'views/layouts/user/header.php' );
?>
<head>
    <title>Nos Missions | My Freelance </title>

<link rel="stylesheet" href="<?php echo base_url('assets/css/nouislider.min.css');?>">
<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('/node_modules/choices.js/public/assets/styles/choices.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">



</head>   

<div class="px-8 py-6 lg:px-4 lg:py-6 h-90 lg:overflow-y-auto no-scrollbar ">
    <div class="justify-between items-center mx-auto max-w-screen-xl h-full">
        <div class="lg:flex gap-6 h-full mb-3">
            <div class=" w-full lg:w-1/4 md:block md:top-0 z-10">
                <!-- Button to show filter block on mobile -->
                <div class="relative text-right mb-4 lg:hidden">
                    <button id="showFilterButton" class="relative text-4xl text-primary border p-2 border-primary  rounded-lg 2 hover:bg-primary-900 hover:text-white">
                        <i class="fas fa-sliders-h"></i>
                    </button>
                </div>
                <div class="hidden lg:block bg-white rounded-lg lg:h-full overflow-y-auto no-scrollbar lg:no-shadow shadow-lg mb-8 lg:mb-4 p-4 dark:bg-gray-800 dark:text-white" id="FilterMission">
                    <h3 class="text-3xl lg:text-lg font-medium mt-2">Filters</h3>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Location</h4>
                    <div class="w-full mx-auto mt-2 text-black">
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
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="temps-plein">
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
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="courte">
                            <span class="ml-2 text-3xl lg:text-base">Short-term</span>
                        </label>
                        <label class="flex items-center text-xl lg:text-base">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="longue">
                            <span class="ml-2 text-3xl lg:text-base">Long-term</span>
                        </label>
                        <label class="flex items-center text-xl lg:text-base">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="indefinie">
                            <span class="ml-2 text-3xl lg:text-base">Indefinite duration</span>
                        </label>
                    </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Work Mode</h4>
                    <div class="mt-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="site">
                            <span class="ml-2 text-3xl lg:text-base">On-site</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="teletravail">
                            <span class="ml-2 text-3xl lg:text-base">Remote</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="hybride">
                            <span class="ml-2 text-3xl lg:text-base">Hybrid</span>
                        </label>
                    </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Experience Level</h4>
                    <div class="mt-2">
                        <label class="flex items-center text-xl lg:text-base">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="junior">
                            <span class="ml-2 text-3xl lg:text-base">Junior (1 to 2 years)</span>
                        </label>
                        <label class="flex items-center text-xl lg:text-base">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="intermediaire">
                            <span class="ml-2 text-3xl lg:text-base">Intermediate (3 to 5 years)</span>
                        </label>
                        <label class="flex items-center text-xl lg:text-base">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="expert">
                            <span class="ml-2 text-3xl lg:text-base">Expert (5+ years)</span>
                        </label>
                    </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Daily Rate</h4>
                    <div class="mt-2 mr-3">
                        <div id="tjm-slider" class="w-full mt-2"></div>
                        <div class="flex justify-between mt-2">
                            <span id="tjm-min" class="text-3xl lg:text-base">300 AED</span>
                            <span id="tjm-max" class="text-3xl lg:text-base">1200 AED</span>
                        </div>
                    </div>
                
                    <h4 class="text-3xl lg:text-base font-medium mt-4">Skills</h4>
                    <div class="w-full mx-auto mt-2 text-black">
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
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Jobs</h4>
                    <div class="w-full mx-auto mt-2 text-black">
                        <select id="jobsAll" name="jobsAll[]" multiple class="text-3xl lg:text-base mt-1 block w-full py-2 px-3 border border-gray-300 bg-white text-black rounded-full shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <?php foreach ($jobsAll as $job): ?>
                                <option class="text-black" value="<?= $job['jobId'] ?>"><?= $job['jobName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="flex justify-between mt-6">
                        <button id="resetFiltersButton" class="text-3xl lg:text-base text-primary border border-primary px-4 py-1 rounded-full 2 hover:bg-primary-900 hover:text-white">Reset</button>
                    </div>

                    

                
                    <!-- <div class="flex justify-between mt-10">
                        <button class="px-4 py-2 rounded-full border border-primary text-primary">Effacer</button>
                        <button class="px-4 py-2 rounded-full bg-primary text-white">Appliquer</button>
                    </div> -->
                </div>
                
            </div>
            <div class="w-full overflow-y-auto no-scrollbar">
                <!-- Barre de recherche -->
                <div class="bg-primary rounded-lg h-20vh p-4 text-white">
                    <p class="text-3xl lg:text-lg font-bold">Hello, <?=$user->userFirstName?></p>
                    <p class="text-3xl lg:text-base mt-2 mb-2">Discover the fastest and most effective way to land a job.</p>
                    <div class="flex w-full">
                        <input type="text" id="search-input" class="text-3xl lg:text-base w-full bg-white bg-opacity-20 rounded-lg p-2 placeholder-white mr-2 text-center" placeholder="Type the job title you are looking for..." />
                        <!-- <button class="w-1/5 bg-white text-primary rounded-lg px-4 py-2">Rechercher</button> -->
                    </div>
                </div>
                <h3 class="text-5xl lg:text-2xl font-medium mt-4 mb-4" id="result-section">For you :</h3>
                <div class="flex flex-wrap" id="missions-section">
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
                    <?php foreach($missions as $mission): ?>
                        <?php
                        $dataMissionSkills = [];
                        foreach ($missionSkills[$mission->idMission] as $skill):
                            $dataMissionSkills[] = $skill->skillId;
                        endforeach;
                        $dataMissionSkillsString = implode(',', $dataMissionSkills);
                        ?>
                        <a href="<?=base_url('user/missionView/'.$mission->idMission)?>" 
                            class="mission-item " 
                            data-mission-name="<?=strtolower($mission->missionName)?>" 
                            data-mission-type="<?=strtolower($mission->missionType)?>"
                            data-mission-job="<?=strtolower($mission->missionJobId)?>"
                            data-mission-deroulement="<?=strtolower($mission->missionDeroulement)?>"
                            data-mission-duree="<?=strtolower($mission->missionDuration)?>" 
                            data-mission-expertise="<?=strtolower($mission->missionExpertise)?>" 
                            data-mission-tjm="<?=$mission->missionTJM?>" 
                            data-mission-localisation="<?=strtolower($mission->missionCountryId)?>"
                            data-mission-skills="<?=$dataMissionSkillsString?>"> <!-- Utilisez implode pour combiner les compétences en une chaîne -->
                            <div class="bg-white rounded-lg h-20vh mt-4 p-4 w-full dark:bg-gray-800 dark:text-white relative mission-item" data-mission-name="<?=strtolower($mission->missionName)?>" data-mission-job="<?=strtolower($mission->missionJobId)?>" data-mission-type="<?=strtolower($mission->missionType)?>" data-mission-deroulement="<?=strtolower($mission->missionDeroulement)?>" data-mission-duree="<?=strtolower($mission->missionDuration)?>" data-mission-expertise="<?=strtolower($mission->missionExpertise)?>" data-mission-tjm="<?=$mission->missionTJM?>" data-mission-localisation="<?=$mission->missionCountryId?>" data-mission-skills="<?=$dataMissionSkillsString?>">
                                <div class="flex items-center">
                                    <div class="mr-4">
                                    <?php foreach ($missionCompany[$mission->idMission] as $company) : ?>
                                            <?php if (is_object($company)) : ?>
                                        <img src="<?=base_url($company->companyLogoPath)?>" alt="Logo de l'entreprise" class="object-cover w-16 h-16 lg:w-10 rounded-full">
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="w-3/4 mr-4">
                                        <h2 class="text-3xl lg:text-lg font-bold"><?=$mission->missionName?></h2>
                                        <p class="text-3xl lg:text-base">
                                        <?php foreach ($missionCompany[$mission->idMission] as $company) : ?>
                                            <?php if (is_object($company)) : ?>
                                                <!-- <span class="mr-2"> • <?= $company->companyName ?></span> -->
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                            <span class="mr-2"> 
                                                •   <?= $mission->jobName?>
                                            </span>
                                            <span class="mr-2"> • Daily rate: <?=$mission->missionTJM?> AED</span>
                                            
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
                                <div class="flex items-center justify-between">
                                    <div class="mt-4 text-3xl lg:text-base">
                                        <div class="font-normal overflow-hidden text-3xl lg:text-base mt-4 mb-4" style="max-height : 6em">
                                            <p>
                                                <?=$mission->missionDescription?>
                                            </p>
                                        </div>
                                        <div class="skills-container mt-4 mb-4">
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

                            </div>
                        </a>
                    <?php endforeach; ?>
                    </div>
                    <div id="no-mission-found">
                        <p class="text-3xl lg:text-lg mt-6 text-left">No missions found.</p>
                        <h3 class="text-5xl lg:text-2xl font-medium mt-10" id="result-section">Other missions:</h3>
                        <?php foreach($missions as $mission): ?>
                        <?php
                        $dataMissionSkills = [];
                        foreach ($missionSkills[$mission->idMission] as $skill):
                            $dataMissionSkills[] = $skill->skillId;
                        endforeach;
                        $dataMissionSkillsString = implode(',', $dataMissionSkills);
                        ?>
                        <a href="<?=base_url('user/missionView/'.$mission->idMission)?>" 
                            class="" 
                            data-mission-name="<?=strtolower($mission->missionName)?>" 
                            data-mission-type="<?=strtolower($mission->missionType)?>"
                            data-mission-job="<?=strtolower($mission->missionJobId)?>"
                            data-mission-deroulement="<?=strtolower($mission->missionDeroulement)?>"
                            data-mission-duree="<?=strtolower($mission->missionDuration)?>" 
                            data-mission-expertise="<?=strtolower($mission->missionExpertise)?>" 
                            data-mission-tjm="<?=$mission->missionTJM?>" 
                            data-mission-localisation="<?=strtolower($mission->missionCountryId)?>"
                            data-mission-skills="<?=$dataMissionSkillsString?>"> <!-- Utilisez implode pour combiner les compétences en une chaîne -->
                            <div class="mb-12 bg-white rounded-lg h-20vh mt-4 p-4 w-full dark:bg-gray-800 dark:text-white relative " data-mission-name="<?=strtolower($mission->missionName)?>" data-mission-job="<?=strtolower($mission->missionJobId)?>" data-mission-type="<?=strtolower($mission->missionType)?>" data-mission-deroulement="<?=strtolower($mission->missionDeroulement)?>" data-mission-duree="<?=strtolower($mission->missionDuration)?>" data-mission-expertise="<?=strtolower($mission->missionExpertise)?>" data-mission-tjm="<?=$mission->missionTJM?>" data-mission-localisation="<?=$mission->missionCountryId?>" data-mission-skills="<?=$dataMissionSkillsString?>">
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
                                        <?php foreach ($missionCompany[$mission->idMission] as $company) : ?>
                                            <?php if (is_object($company)) : ?>
                                                <!-- <span class="mr-2"> • <?= $company->companyName ?></span> -->
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                            <span class="mr-2"> 
                                                •   <?= $mission->jobName?>
                                            </span>
                                            <span class="mr-2"> • Daily rate: <?=$mission->missionTJM?> AED</span>
                                            
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
                                <div class="text-3xl lg:text-base flex items-center justify-between">
                                    <div class="mt-4">
                                        <div class="font-normal overflow-hidden text-3xl lg:text-base mt-4 mb-4" style="max-height : 6em">
                                            <p>
                                                <?=$mission->missionDescription?>
                                            </p>
                                        </div>
                                        <div class="skills-container mt-4 mb-4">
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
                                            <div class="skill-item" data-level="<?=$level?>">
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

                            </div>
                        </a>
                    <?php endforeach; ?>
                    </div>
                    </div>
                </div>
            </div>
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
    
// JS POUR LOCALISATION PAR RECHERCHE

        // $('#citySearch').on('keyup', function() {
        //     let term = $(this).val();
        //     if(term.length > 2) { // Recherche après 2 caractères
        //         $.post('search_cities', { term: term }, function(data) {
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

        // // Pour fermer la liste lorsque vous cliquez en dehors
        // $(document).on('click', function(event) {
        //     // Si le clic n'est pas sur le champ de saisie (#citySearch)
        //     // et n'est pas sur un élément à l'intérieur de la liste (#cities-list)...
        //     if (!$(event.target).closest('#citySearch, #cities-list').length) {
        //         // ... alors videz et fermez la liste.
        //         $('#cities-list').empty().removeClass('has-border');
        //     }
        // });

        // FIN JS POUR LOCALISATION PR RECHERCHE ///////////////////////////////////////////////////////////////////////

    });

    //Script selection des compétences
    const skillsChoices = new Choices('#skillsAll', {
        searchEnabled: true,
        removeItemButton: true,
        itemSelectText: '',
        placeholder: true, // Ajoutez cette ligne pour activer le placeholder
        placeholderValue: 'Select Skills', // Texte du placeholder

    });

    //Script selection des Jobs
        const jobsChoices = new Choices('#jobsAll', {
        searchEnabled: true,
        removeItemButton: true,
        itemSelectText: '',
        placeholder: true, // Ajoutez cette ligne pour activer le placeholder
        placeholderValue: 'Select Jobs', // Texte du placeholder

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
                    $('#skills-list').append(`<div class="skill-item" data-id="${skill.skillId}">${skill.skillName}</div>`);
                });
            });
        });

        $(document).on('click', '.skill-item', function(){
            let skillId = $(this).data('id');
            let skillName = $(this).text();
            // Vérifiez si la compétence est déjà sélectionnée
            if (!$(`#selected-skills .selected-skill[data-id="${skillId}"]`).length) {
                $('#selected-skills').append(`<div class="selected-skill" data-id="${skillId}">${skillName}</div>`);
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
        start: [300, 1200],
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