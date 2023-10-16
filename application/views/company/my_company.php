<?php
$currentPage = 'my_company';


// Header Call
include(APPPATH . 'views/layouts/company/header.php');
?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/nouislider.min.css');?>">
<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('/node_modules/choices.js/public/assets/styles/choices.min.css');?>" rel="stylesheet" type="text/css">

<div class="px-4 lg:px-6 py-6 h-full overflow-y-auto no-scrollbar">
    <div class="flex flex-wrap justify-between items-center mx-auto h-full w-screen-90">
        <div class="w-full flex flex-wrap gap-4 h-full mb-3">
            <div class="relative w-full bg-white rounded-lg mb-4 px-4 pt-4 dark:bg-gray-800 dark:text-white">
                <div class="relative rounded-lg w-full h-auto mb-8">
                    <div class="rounded-lg w-full h-40 flex items-center justify-center">
                        <div class="w-full h-full flex items-center justify-center">
                            <img id="company-image" src="<?=base_url('assets/img/airbnb-couverture.png')?>" class=" object-cover w-full h-full rounded-lg" alt="Image de l'entreprise">
                        </div>
                    </div>
                    <div class="absolute-logo rounded-full border-10 border-primary w-20 h-20 flex items-center justify-center">
                        <img id="company-image" src="<?=base_url('assets/img/airbnb.png')?>" class=" object-cover w-full h-full rounded-full ring-2 ring-white" alt="Image de l'entreprise">
                    </div>
                </div>
                <div class="flex flex-wrap justify-between mt-4">
                    <div>
                        <h2 class="text-xl font-bold flex items-center"><?= $company->companyName ?></h2>
                        <h3 class=" font-medium">Slogan de l'entreprise</h3>
                        <h3 class=" font-normal">Secteur d'activité</h3>
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
                <ul class="flex flex-wrap mt-10 -mb-px text-primary text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="mr-4" role="presentation">
                        <button class="inline-block border-b-2 font-normal text-black hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="myCompanyProfile-tab" data-tabs-target="#myCompanyProfile" type="button" role="tab" aria-controls="myCompanyProfile" aria-selected="false">À propos</button>
                    </li>
                    <li class="mr-4" role="presentation">
                        <button class="inline-block border-b-2 font-normal hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="myCompanyMissions-tab" data-tabs-target="#myCompanyMissions" type="button" role="tab" aria-controls="myCompanyMissions" aria-selected="false">Emplois</button>
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


                    <div class="relative bg-white rounded-lg mt-4 mb-4 py-4 dark:bg-gray-800 dark:text-white">
                        <h2 class="text-xl font-bold mb-4 pl-4 flex items-center">
                            Photos de l'entreprise
                        </h2>
                        
                        <div class="w-screen-90 overflow-x-auto flex pb-4 px-4 gap-4 no-scrollbar">
                            <div class="rounded-lg w-100 h-60 flex flex-shrink-0 items-center justify-center">
                                <div class="w-full h-full flex items-center justify-center">
                                    <img id="company-image" src="<?=base_url('assets/img/airbnb-couverture.png')?>" class=" object-cover w-full h-full rounded-lg" alt="Image de l'entreprise">
                                </div>
                            </div>
                            <div class="rounded-lg w-100 h-60 flex flex-shrink-0 items-center justify-center">
                                <div class="w-full h-full flex items-center justify-center">
                                    <img id="company-image" src="<?=base_url('assets/img/airbnb-couverture.png')?>" class=" object-cover w-full h-full rounded-lg" alt="Image de l'entreprise">
                                </div>
                            </div>
                            <div class="rounded-lg w-100 h-60 flex flex-shrink-0 items-center justify-center">
                                <div class="w-full h-full flex items-center justify-center">
                                    <img id="company-image" src="<?=base_url('assets/img/airbnb-couverture.png')?>" class=" object-cover w-full h-full rounded-lg" alt="Image de l'entreprise">
                                </div>
                            </div>
                            <div class="rounded-lg w-100 h-60 flex flex-shrink-0 items-center justify-center">
                                <div class="w-full h-full flex items-center justify-center">
                                    <img id="company-image" src="<?=base_url('assets/img/airbnb-couverture.png')?>" class=" object-cover w-full h-full rounded-lg" alt="Image de l'entreprise">
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="hidden" id="myCompanyMissions" role="tabpanel" aria-labelledby="myCompanyMissions-tab">
                    <div class="bg-primary w-screen-90 rounded-lg h-20vh p-4 text-white">
                        <p class="font-bold">Découvrez la manière la plus rapide et efficace de décrochez une mission chez <?=$company->companyName?>.</p>
                        <div class="flex w-full">
                            <input type="text" id="search-mission-input" class="w-full bg-white bg-opacity-20 rounded-lg p-2 placeholder-white mr-2 text-center" placeholder="Recherchez..." />
                            <!--<button class="w-1/5 bg-white text-primary rounded-lg px-4 py-2">Rechercher</button>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap w-full pb-4 mb-12" id="missions-section">
                <h1 class="text-2xl font-bold mb-4">Mes missions</h1>
                <div class="grid grid-cols-2 gap-4">
                    <?php foreach($missions as $mission): ?>
                        <div class="flex flex-wrap">
                            <a href="<?=base_url('user/missionView/'.$mission->idMission)?>">
                                <div class="bg-white rounded-lg h-20vh mt-4 p-4 dark:bg-gray-800 dark:text-white relative mission-item" data-mission-name="<?=strtolower($mission->missionName)?>">
                                    <div class="flex items-center">
                                        <div class="mr-4">
                                            <img src="<?=base_url('assets/img/airbnb.png')?>" alt="Logo de l'entreprise" class="w-10 h-10 rounded-full">
                                        </div>
                                        <div class="w-3/4 mr-4">
                                            <h2 class="font-bold text-lg"><?=$mission->missionName?></h2>
                                            <p>
                                                <span class="mr-2"> • <?= $company->companyName ?></span>
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
                                            
                                        </div>
                                    </div>
                                    <div class="absolute top-0 right-4 mt-4 mb-4 z-9">
                                        <a href="<?php echo base_url('user/addToFavorite/'.$mission->idMission);?>">
                                            <i class="far fa-heart text-xl text-red-800"></i>
                                        </a>
                                        <?php
                                        ?>
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