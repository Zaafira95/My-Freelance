<?php

$currentPage = 'missions';

include(APPPATH . 'views/layouts/user/header.php');

?>
    <title> Vos missions favorites - My Freelance </title>
<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">

</head>




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
                <h1 class="text-5xl lg:text-2xl font-semibold text-gray-900 dark:text-white">
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
                                            <img src="<?=base_url($company->companyLogoPath)?>" alt="Logo de l'entreprise" class="object-cover w-16 h-16 lg:w-10 rounded-full">
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="w-3/4 mr-4">
                                            <h2 class="text-3xl lg:text-lg"><?=$mission->missionName?></h2>
                                            <p class="text-3xl lg:text-base">
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
                                            <div class="font-light overflow-hidden mt-4 mb-4 text-3xl lg:text-base">
                                                <p class="font-light mt-4 mb-4">
                                                    <?php 
                                                    // limit missionDescription to 270 caracteres and add '...' at the end
                                                    $mission->missionDescription = strlen($mission->missionDescription) > 270 ? substr($mission->missionDescription,0,270)."..." : $mission->missionDescription;    
                                                    ?>
                                                    <?=$mission->missionDescription?>
                                                </p>
                                            </div>
                                            <div class="skills-container mb-4 mt-8">
                                            <?php 
                                            $skillsCount = 0;
                                            ?>
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
                                                <?php 
                                               if ($skillsCount <=5) {
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
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>

<script>

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
