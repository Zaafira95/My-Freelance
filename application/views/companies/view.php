<?php
$currentPage = 'companies';


// Header Call
include(APPPATH . 'views/layouts/user/header.php');
?>
<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/nouislider.min.css');?>">
    <link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('/node_modules/choices.js/public/assets/styles/choices.min.css');?>" rel="stylesheet" type="text/css">
    <title><?=$company->companyName?> - Café Crème Community </title>
</head>



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

<div class="px-8 py-6 lg:px-4 lg:py-6 h-full no-scrollbar">
    <div class="justify-between mx-auto max-w-screen-xl h-full">
        <div class="h-full w-full mb-3">
            <div class="bg-white rounded-lg w-full mb-4 dark:text-white dark:bg-gray-800 relative">
                <div class="bg-white dark:bg-gray-800 relative rounded-lg w-full h-auto mb-8">
                    <div class="bg-white dark:bg-gray-800 rounded-lg w-full h-48 flex items-center justify-center">
                        <div class="bg-white dark:bg-gray-800 w-full h-full flex items-center justify-center">
                            <img src="<?=base_url($company->companyBannerPath)?>" class="object-cover w-full h-full rounded-lg dark:bg-gray-800" alt="Image de l'entreprise">
                        </div>
                    </div>
                    <div class="rounded-full border-10 w-40 h-40 flex items-center justify-center" style="margin-top:-50px;">
                        <img src="<?=base_url($company->companyLogoPath)?>" class="ml-4 object-cover w-full h-full rounded-full ring-8 ring-white dark:ring-gray-800" alt="Image de l'entreprise">
                    </div>
                </div>
                <div class="px-4 flex flex-wrap justify-between mt-4">
                    <div>
                        <h2 class="text-5xl font-bold flex items-center"><?= $company->companyName ?></h2>
                        <h3 class="text-3xl lg:text-2xl font-medium"><?=$company->companySlogan?></h3>
                        <h3 class="text-2xl lg:text-xl font-medium text-gray-400">Secteur d'activité : <?=$company->companySecteur?></h3>
                        <h3 class="text-2xl lg:text-xl font-medium text-gray-400"><?=$company->companyLocalisation?></h3>
                    </div>
                    <div class="flex flex-wrap lg:mt-0 mt-4">
                        <a href="https://wa.me/<?=$company->userTelephone?>?text=Bonjour%20<?=$company->userFirstName?>%20!%20Je%20suis%20intéressé%20par%20votre%20entreprise%20sur%20Café%20Crème%20Community%20!%20" target="_blank">
                            <button type="button" data-te-ripple-init data-te-ripple-color="light"
                                class="mr-4 h-10 inline-flex items-center rounded-full px-6 lg:py-2.5 py-4 leading-normal text-white  transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg"
                                style="background-color: #25D366">
                                <span class="mr-2 text-2xl lg:text-base font-medium">Contacter</span>
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
                        if (isset($company->userEmail) && !empty($company->userEmail)){
                        ?>
                            <a href="mailto:<?=$company->userEmail?>" title="Envoyer un mail" class="flex-shrink-0 mr-4" >
                                <div>
                                    <img src="<?=base_url('assets/img/logo-link/mail.png')?>" alt="Logo Mail" class="h-10 transition-transform transform hover:scale-110">
                                </div>
                            </a>
                        <?php
                        }
                        if (isset($company->userLinkedinLink) && !empty($company->userLinkedinLink)){
                        ?>
                            <a href="<?=$company->userLinkedinLink?>" title="Visiter le linkedin" class="flex-shrink-0 mr-2" target="_blank">
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
                        <div class="text-3xl lg:text-base items-center justify-between">
                            <p class="text-3xl lg:text-base font-normal mb-4">
                                <?=$company->companyDescription?>
                            </p>
                        </div>

                    </div>
                    <div class="relative bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                        <h2 class="text-4xl lg:text-xl font-bold mb-4 flex items-center">
                            Les avantages de l'entreprise
                        </h2>
                        <div class="text-3xl lg:text-base items-center justify-between">
                            <p class="text-3xl lg:text-base font-normal mb-4">
                                <?=$company->companyAdvantages?>
                            </p>
                        </div>

                    </div>
		<?php if($companyPhotos != null) { ?>
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
                    </div>
		<?php } ?>
                </div>
                <div class="hidden" id="myCompanyMissions" role="tabpanel" aria-labelledby="myCompanyMissions-tab">  
                    <div class="flex flex-wrap w-full pb-4 mb-12 mt-4" id="missions-section">
                        <div class="w-full flex flex-wrap justify-between items-center">
                            <h1 class="text-4xl lg:text-xl font-bold mb-4 mt-4">Nos missions</h1>
                        </div>
                        <div class="grid lg:grid-cols-2 gap-4">
                            
                            <?php 
                            if (empty($missions)) {
                                echo '<p class="text-center">Aucune mission disponible pour le moment</p>';
                            }
                            else {
                            foreach($missions as $mission): ?>
                                <div class="flex flex-wrap">
                                    <a href="<?=base_url('user/missionView/'.$mission->idMission)?>">
                                        <div class="bg-white rounded-lg h-20vh w-full mt-4 p-4 dark:bg-gray-800 dark:text-white relative mission-item" data-mission-name="<?=strtolower($mission->missionName)?>">
                                            <div class="flex items-center">
                                                <div class="mr-4">
                                                    <img src="<?=base_url($company->companyLogoPath)?>" alt="Logo de l'entreprise" class="w-16 h-16 lg:w-10 rounded-full">
                                                </div>
                                                <div class="w-3/4 mr-4">
                                                    <h2 class="text-3xl lg:text-lg font-bold"><?=$mission->missionName?></h2>
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

<script>

    $(document).ready(function () {

        const secteurChoices = new Choices('#secteursAll', {
            searchEnabled: true,
            removeItemButton: true,
            itemSelectText: '',
            placeholder: true,
            placeholderValue: 'Sélectionnez un secteur',
        });
    });
    
    function showFileName(input, elementId) {
        let imageElement = document.getElementById(elementId);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                imageElement.src = e.target.result;
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
