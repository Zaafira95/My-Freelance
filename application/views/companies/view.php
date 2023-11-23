<?php
$currentPage = 'company';


// Header Call
include(APPPATH . 'views/layouts/user/header.php');
?>
<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/nouislider.min.css');?>">
    <link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('/node_modules/choices.js/public/assets/styles/choices.min.css');?>" rel="stylesheet" type="text/css">
    <title><?=$company->companyName?> - Café Crème Community </title>
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

<div class="px-4 lg:px-6 py-6 h-full overflow-y-auto no-scrollbar">
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
                        <h3 class="text-2xl font-medium"><?=$company->companySlogan?></h3>
                        <h3 class="text-xl font-medium text-gray-400">Secteur d'activité : <?=$company->companySecteur?></h3>
                        <h3 class="text-xl font-medium text-gray-400"><?=$company->companyLocalisation?></h3>
                    </div>
                    <div class="flex flex-wrap">
                        <a href="https://wa.me/<?=$company->userTelephone?>?text=Bonjour%20<?=$company->userFirstName?>%20!%20Je%20suis%20intéressé%20par%20votre%20entreprise%20sur%20Café%20Crème%20Community%20!%20" target="_blank">
                            <button type="button" data-te-ripple-init data-te-ripple-color="light"
                                class="mr-4 inline-flex items-center rounded-full px-3 h-8 leading-normal text-white "
                                style="background-color: #25D366">
                                <span class="mr-2">Contacter</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                </svg>
                                </button>
                            </a>
                        <?php
                        if (isset($company->userEmail) && !empty($company->userEmail)){
                        ?>
                            <a href="mailto:<?=$company->userEmail?>" title="Envoyer un mail" class="flex-shrink-0 mr-4">
                                <div>
                                    <img src="<?=base_url('assets/img/logo-link/mail.png')?>" alt="Logo Mail" class="w-8 h-8 transition-transform transform hover:scale-110">
                                </div>
                            </a>
                        <?php
                        }
                        if (isset($company->userLinkedinLink) && !empty($company->userLinkedinLink)){
                        ?>
                            <a href="<?=$company->userLinkedinLink?>" title="Visiter le linkedin" class="flex-shrink-0 mr-2">
                                <div>
                                    <img src="<?=base_url('assets/img/logo-link/linkedin.png')?>" alt="Logo Linkedin" class="w-8 h-8 transition-transform transform hover:scale-110">
                                </div>
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <ul class="flex flex-wrap mt-10 -mb-px px-4 pb-4 text-primary text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="mr-4" role="presentation">
                        <button class="inline-block border-b-2 font-normal text-black hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="myCompanyProfile-tab" data-tabs-target="#myCompanyProfile" type="button" role="tab" aria-controls="myCompanyProfile" aria-selected="false">À propos</button>
                    </li>
                    <li class="mr-4" role="presentation">
                        <button class="inline-block border-b-2 font-normal hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="myCompanyMissions-tab" data-tabs-target="#myCompanyMissions" type="button" role="tab" aria-controls="myCompanyMissions" aria-selected="false">Missions</button>
                    </li>
                </ul>

            </div>  
            <div id="relative myTabContent w-full">
                <div class="hidden" id="myCompanyProfile" role="tabpanel" aria-labelledby="myCompanyProfile-tab">
                    <div class="relative bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                        <h2 class="text-xl font-bold mb-4 flex items-center">
                            Description de l'entreprise
                        </h2>
                        <div class="flex items-center justify-between">
                            <p class="font-normal mb-4">
                                <?=$company->companyDescription?>
                            </p>
                        </div>

                    </div>
                    <div class="relative bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                        <h2 class="text-xl font-bold mb-4 flex items-center">
                            Les avantages de l'entreprise
                        </h2>
                        <div class="flex items-center justify-between">
                            <p class="font-normal mb-4">
                                <?=$company->companyAdvantages?>
                            </p>
                        </div>

                    </div>

                    <div class="relative bg-white rounded-lg mt-4 mb-4 py-4 dark:bg-gray-800 dark:text-white">
                        <h2 class="text-xl font-bold mb-4 pl-4 flex items-center">
                            Photos de l'entreprise
                        </h2>
                        <div class="overflow-x-auto flex pb-4 px-4 gap-4 no-scrollbar">
                            <?php $imageCount = 0; ?>
                            <?php foreach($companyPhotos as $companyPhoto): 
                                $imageCount++; ?>
                                <div class="rounded-lg flex items-center justify-center">
                                    <div class="w-full h-full flex items-center justify-center" style="width:500px;">
                                        <img src="<?=base_url($companyPhoto->companyPhotosPath)?>" class="w-full h-full rounded-lg" alt="Image de l'entreprise" style="width:100%;">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
                <div class="hidden" id="myCompanyMissions" role="tabpanel" aria-labelledby="myCompanyMissions-tab">  
                    <div class="flex flex-wrap w-full pb-4 mb-12 mt-4" id="missions-section">
                        <div class="w-full flex flex-wrap justify-between items-center">
                            <h1 class="text-2xl font-bold mb-4 mt-4">Nos missions</h1>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            
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
                                                    <img src="<?=base_url('assets/img/airbnb.png')?>" alt="Logo de l'entreprise" class="w-10 h-10 rounded-full">
                                                </div>
                                                <div class="w-3/4 mr-4">
                                                    <h2 class="font-bold text-lg"><?=$mission->missionName?></h2>
                                                    <p>
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
                                                    <p class="font-light mt-4 mb-4">
                                                        <?php 
                                                        // limit missionDescription to 270 caracteres and add '...' at the end
                                                        $mission->missionDescription = strlen($mission->missionDescription) > 370 ? substr($mission->missionDescription,0,370)."..." : $mission->missionDescription;    
                                                        ?>
                                                        <?=$mission->missionDescription?>
                                                    </p>
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
                                                            <div class="skill-item" data-level="<?=$level?>">
                                                                <span class="dark:<?=$textdark?> inline-block px-4 py-1 rounded-full <?=$text?>" style="background-color:<?=$color?>;"><?=$skill->skillName?></span>
                                                                <div class="skill-level"><?=$level?></div>
                                                            </div>
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
    
</script>
