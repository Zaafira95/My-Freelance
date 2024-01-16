<?php

$currentPage = 'missions';

include(APPPATH . 'views/layouts/user/header.php');

?>
    <title> Vos missions favorites - Café Crème Community </title>
<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">

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
                            <?php
                            $userJobTimePartielOrFullTime = ['Temps Plein', 'Temps Partiel'];
                            foreach ($userJobTimePartielOrFullTime as $option) {
                                echo '<option value="' . $option . '"';
                                if ($user->userJobTimePartielOrFullTime === $option) {
                                    echo ' selected';
                                }
                                echo '>' . $option . '</option>';
                            }
                            ?>
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

<div class="absolute hidden top-0 right-4 mt-4 mb-4">
    <svg id="heart" class="w-5 h-5 text-red-600 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 30" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.879c-2.484-4.375-12-1.82-12 4.879 0 5.572 5.126 7.664 12 14.121 6.874-6.457 12-8.549 12-14.121 0-6.699-9.516-9.254-12-4.879z"/>
    </svg>
</div>
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
<div class="px-8 py-6 lg:px-4 lg:py-6 h-full overflow-y-auto no-scrollbar">
    <div class="flex flex-wrap justify-between mx-auto max-w-screen-xl h-full">
        <div class="flex h-full w-full mb-3">
            <div class="rounded-lg h-full w-full mb-4 dark:text-white">
                <h1 class="text-3xl lg:text-2xl font-semibold text-gray-900 dark:text-white">
                    Vos missions favorites
                </h1>
                <div class="flex flex-wrap justify-start">
                    <?php if(empty($missions)): ?>
                        <div class="flex flex-col items-start">
                            <p class="text-gray-500 dark:text-gray-400">Vous n'avez pas encore de missions favorites.</p>
                            <a href="<?=base_url('user/mission')?>" class="bg-primary text-white px-4 py-2 mt-2 rounded-full">Parcourir les missions</a>
                        </div>
                    <?php else: ?>
                        <?php foreach($missions as $mission): ?>
                            <a href="<?=base_url('user/missionView/'.$mission->idMission)?>" class="mission-item" data-mission-name="<?=strtolower($mission->missionName)?>" data-mission-type="<?=strtolower($mission->missionType)?>" data-mission-expertise="<?=strtolower($mission->missionExpertise)?>" data-mission-tjm="<?=$mission->missionTJM?>">
                                <div class="w-full lg:w-48percent mr-4 bg-white rounded-lg h-20vh mt-4 p-4 dark:bg-gray-800 dark:text-white relative mission-item" data-mission-name="<?=strtolower($mission->missionName)?>" data-mission-type="<?=strtolower($mission->missionType)?>" data-mission-expertise="<?=strtolower($mission->missionExpertise)?>" data-mission-tjm="<?=$mission->missionTJM?>">
                                    <div class="flex items-center">
                                        <div class="mr-4">
                                            <?php foreach ($missionCompany[$mission->idMission] as $company) : ?>
                                                <?php if (is_object($company)) : ?>
                                            <img src="<?=base_url($company->companyLogoPath)?>" alt="Logo de l'entreprise" class="w-10 h-10 rounded-full">
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="w-3/4 mr-4">
                                            <h2 class="font-bold text-lg"><?=$mission->missionName?></h2>
                                            <p>
                                            <?php foreach ($missionCompany[$mission->idMission] as $company) : ?>
                                                <?php if (is_object($company)) : ?>
                                                    <!-- <span class="mr-2"> • <?= $company->companyName ?></span> -->
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                                <span class="mr-2"> • TJM : <?=$mission->missionTJM?> €</span>
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
                                            <p class="font-light mt-4 mb-4">
                                                <?php 
                                                // limit missionDescription to 270 caracteres and add '...' at the end
                                                $mission->missionDescription = strlen($mission->missionDescription) > 270 ? substr($mission->missionDescription,0,270)."..." : $mission->missionDescription;    
                                                ?>
                                                <?=$mission->missionDescription?>
                                            </p>
                                            <div class="skills-container mb-4">
                                            <?php foreach ($missionSkills[$mission->idMission] as $skill) : ?>
                                                <?php
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
                                                    <span class="dark:<?=$textdark?> inline-block px-4 py-1 rounded-full <?=$text?>" style="background-color:<?=$color?>;"><?=$skill->skillName?></span>
                                                    <div class="skill-level"><?=$level?></div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="absolute top-0 right-4 mt-4 mb-4 z-9">
                                        <?php
                                        if(isFavorite($mission->idMission, $favoriteMissions)){
                                            ?>
                                            <a href="<?php echo base_url('user/removeFromFavorite/'.$mission->idMission);?>">
                                                <i class="fas fa-heart text-xl text-red-800"></i>
                                            </a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="<?php echo base_url('user/addToFavorite/'.$mission->idMission);?>">
                                                <i class="far fa-heart text-xl text-red-800"></i>
                                            </a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
