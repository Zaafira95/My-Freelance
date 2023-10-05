<?php
$currentPage = 'my_company';


// Header Call
include(APPPATH . 'views/layouts/company/header.php');
?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/nouislider.min.css');?>">
<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">

<div class="px-4 lg:px-6 py-6 h-full overflow-y-auto no-scrollbar">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl h-full">
        <div class="w-full flex gap-6 h-full mb-3">
            <div class="flex flex-wrap" id="missions-section">
                <h1 class="text-2xl font-bold mb-4">Mes missions</h1>
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