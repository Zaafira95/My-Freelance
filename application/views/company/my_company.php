<?php
$currentPage = 'my_company';


// Header Call
include(APPPATH . 'views/layouts/company/header.php');
?>
<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/nouislider.min.css');?>">
    <link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('/node_modules/choices.js/public/assets/styles/choices.min.css');?>" rel="stylesheet" type="text/css">
    <title><?=$company->companyName?> - Café Crème Community </title>
</head>

<!--Company Data modal -->
<div id="updateCompanyData" tabindex="-1" aria-hidden="true" class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Vos coordonnées
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg  p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateCompanyData">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Fermer</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?=base_url("company/updateCompanyData")?>" method="post" enctype="multipart/form-data">
                <div>
                    <label for="companyName" class="block mb-1  font-medium text-gray-900 dark:text-white">Nom *</label>
                        <input type="text" name="companyName" id="companyName" value="<?=$company->companyName?>" class="mb-2 bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    
                    <label for="companySlogan" class="block mb-1  font-medium text-gray-900 dark:text-white">Slogan *</label>
                        <input type="text" name="companySlogan" id="companySlogan" value="<?=$company->companySlogan?>" class="mb-2 bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    
                    <label for="companySecteur" class="block mb-1  font-medium text-gray-900 dark:text-white">Secteur d'activité *</label>
                        <input type="text" name="companySecteur" id="companySecteur" value="<?=$company->companySecteur?>" class="mb-2 bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    
                </div>
                <div class="flex items-center space-x-4 mt-4">
                    <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Valider
                    </button>
                    <button type="button" data-modal-toggle="updateCompanyData" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Company Description modal -->
<div id="updateCompanyDescription" tabindex="-1" aria-hidden="true" class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Votre entreprise
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg  p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateCompanyDescription">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Fermer</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?=base_url("company/updateCompanyDescription")?>" method="post" enctype="multipart/form-data">
                <div>

                    <!--<label for="companyDescription" class="block mt-4 mb-2 font-medium text-gray-900 dark:text-white">Description</label>-->
                    <textarea id="companyDescription" name="companyDescription" rows="6" class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><?=$company->companyDescription?></textarea>

                </div>
                <div class="flex items-center space-x-4 mt-4">
                    <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Valider
                    </button>
                    <button type="button" data-modal-toggle="updateCompanyDescription" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Company Advantages modal -->
<div id="updateCompanyAdvantages" tabindex="-1" aria-hidden="true" class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Vos avantages
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg  p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateCompanyAdvantages">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Fermer</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?=base_url("company/updateCompanyAdvantages")?>" method="post" enctype="multipart/form-data">
                <div>

                    <!--<label for="companyDescription" class="block mt-4 mb-2 font-medium text-gray-900 dark:text-white">Description</label>-->
                    <textarea id="companyAvantages" name="companyAvantages" rows="6" class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><?=$company->companyAdvantages?></textarea>

                </div>
                <div class="flex items-center space-x-4 mt-4">
                    <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Valider
                    </button>
                    <button type="button" data-modal-toggle="updateCompanyAdvantages" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="px-4 lg:px-6 py-6 h-full overflow-y-auto no-scrollbar">
    <div class="justify-between mx-auto max-w-screen-xl h-full">
        <div class="h-full w-full mb-3">
            <div class="bg-white rounded-lg w-full mb-4 dark:text-white dark:bg-gray-800 relative">
                <div class="bg-white dark:bg-gray-800 relative rounded-lg w-full h-auto mb-8">
                    <div class="bg-white dark:bg-gray-800 rounded-lg w-full h-50 flex items-center justify-center">
                        <div class="bg-white dark:bg-gray-800 w-full h-full flex items-center justify-center">
                            <img id="company-image" src="<?=base_url('assets/img/airbnb-couverture.png')?>" class="object-cover w-full h-full rounded-lg dark:bg-gray-800" alt="Image de l'entreprise">
                        </div>
                    </div>
                    <div class="rounded-full border-10 w-40 h-40 flex items-center justify-center" style="margin-top:-50px;">
                        <img id="company-image" src="<?=base_url('assets/img/airbnb.png')?>" class="ml-4 object-cover w-full h-full rounded-full ring-8 ring-white dark:ring-gray-800" alt="Image de l'entreprise">
                    </div>
                </div>
                <div class="px-4 flex flex-wrap justify-between mt-4">
                    <div>
                        <h2 class="text-3xl font-bold flex items-center"><?= $company->companyName ?></h2>
                        <h3 class="text-2xl font-medium"><?=$company->companySlogan?></h3>
                        <h3 class="text-xl font-medium text-gray-400">Secteur d'activité: <?=$company->companySecteur?></h3>
                    </div>
                    <div class="flex flex-wrap">
                        <p class="text mr-2">Contact</p>
                        <a href="mailto:kassim91@gmail.com" title="Envoyer un mail" class="flex-shrink-0 mr-2">
                            <div>
                                <img src="<?=base_url('assets/img/logo-link/mail.png')?>" alt="Logo Mail" class="w-6 h-6 transition-transform transform hover:scale-110">
                            </div>
                        </a>
                        <a href="www.linkedin.com" title="Visiter le linkedin" class="flex-shrink-0 mr-2">
                            <div>
                                <img src="<?=base_url('assets/img/logo-link/linkedin.png')?>" alt="Logo Linkedin" class="w-6 h-6 transition-transform transform hover:scale-110">
                            </div>
                        </a>
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
                <div class="absolute bottom-0 right-0 mb-4 mr-4 flex">
                    <button id="updateCompanyData" data-modal-toggle="updateCompanyData" class="py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                        <i class="fas fa-pen fa-fw"></i>
                    </button>
                </div>
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
                        <div class="absolute top-0 right-0 mt-4 mr-4 flex">
                            <button id="updateCompanyDescription" data-modal-toggle="updateCompanyDescription" class="py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                <i class="fas fa-pen fa-fw"></i>
                            </button>
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
                        <div class="absolute top-0 right-0 mt-4 mr-4 flex">
                            <button id="updateCompanyAdvantages" data-modal-toggle="updateCompanyAdvantages" class="py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                <i class="fas fa-pen fa-fw"></i>
                            </button>
                        </div>
                    </div>

                    <div class="relative bg-white rounded-lg mt-4 mb-4 py-4 dark:bg-gray-800 dark:text-white">
                        <h2 class="text-xl font-bold mb-4 pl-4 flex items-center">
                            Photos de l'entreprise
                        </h2>
                        
                        <div class="overflow-x-auto flex pb-4 px-4 gap-4 no-scrollbar">
                            <div class="rounded-lg flex items-center justify-center">
                                <div class="w-full h-full flex items-center justify-center" style="width:500px;">
                                    <img id="company-image" src="<?=base_url('assets/img/airbnb1.png')?>" class="w-full h-full rounded-lg" alt="Image de l'entreprise" style="width:100%;">
                                </div>
                            </div>
                            <div class="rounded-lg flex items-center justify-center">
                            <div class="w-full h-full flex items-center justify-center" style="width:500px;">
                                <img id="company-image" src="<?=base_url('assets/img/airbnb2.png')?>" class="w-full h-full rounded-lg" alt="Image de l'entreprise" style="width:100%;">
                                </div>
                            </div>
                            <div class="rounded-lg flex items-center justify-center">
                            <div class="w-full h-full flex items-center justify-center" style="width:500px;">
                                <img id="company-image" src="<?=base_url('assets/img/airbnb1.png')?>" class="w-full h-full rounded-lg" alt="Image de l'entreprise" style="width:100%;">
                                </div>
                            </div>
                            <div class="rounded-lg flex items-center justify-center">
                            <div class="w-full h-full flex items-center justify-center" style="width:500px;">
                                <img id="company-image" src="<?=base_url('assets/img/airbnb2.png')?>" class=" w-full h-full rounded-lg" alt="Image de l'entreprise" style="width:100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden" id="myCompanyMissions" role="tabpanel" aria-labelledby="myCompanyMissions-tab">  
                    <div class="flex flex-wrap w-full pb-4 mb-12" id="missions-section">
                        <h1 class="text-2xl font-bold mb-4">Mes missions</h1>
                        <div class="grid grid-cols-2 gap-4">
                            <?php foreach($missions as $mission): ?>
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
                                                <!--<a href="<?php echo base_url('user/addToFavorite/'.$mission->idMission);?>">
                                                    <i class="far fa-heart text-xl text-red-800"></i>
                                                </a>-->
                                                <a href="<?php echo base_url('company/missionEdit/'.$mission->idMission);?>">
                                                    <button class="py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                                        <i class="fas fa-pen fa-fw"></i>
                                                    </button>
                                                </a>
                                                
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
