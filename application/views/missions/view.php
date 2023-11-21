<?php
// Header Call

if($user->userType == "freelance"){
    $currentPage = 'missions';
    include(APPPATH . 'views/layouts/user/header.php' );
}
else if ($user->userType == "sales"){
    $currentPage = 'my_company';
    include(APPPATH . 'views/layouts/company/header.php' );
}
?>
<head>
    <title><?=$mission->missionName?> | <?=$company->companyName?> | Café Crème Community </title>

<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>


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
<!-- Send message modal -->
<div id="sendMessage" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Votre message
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="sendMessage">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Fermer</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="#" method="post" id="userPreferenceForm" enctype="multipart/form-data">
                <div>
                    <label for="message" class="block mt-4 mb-2 font-medium text-gray-900 dark:text-white">Choisissez un message prédéfini</label>
                    <select id="message" name="message" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" onchange="updateTextarea()">
                        <option value="">Sélectionnez un message</option>
                        <?php foreach ($messageExamples as $message) { ?>
                            <option value="<?php echo $message->messageExamplesContent; ?>"><?php echo $message->messageExamplesContent; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div id="customMessageWrapper" class="hidden">
                    <label for="customMessage" class="block mt-4 mb-2 font-medium text-gray-900 dark:text-white">Personnalisez votre message</label>
                    <textarea id="customMessage" name="customMessage" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 h-32 resize-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                </div>
                <div class="flex items-center space-x-4 mt-4">
                    <button type="button" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" onclick="sendMessageOnWhatsApp()">
                        Envoyer
                    </button>
                    <button type="button" data-modal-toggle="sendMessage" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="px-4 lg:px-6 py-6 h-full overflow-y-auto no-scrollbar">
    <div class="flex-wrap justify-between items-center mx-auto max-w-screen-xl h-full">
        <div class="gap-6 h-full mb-3">
            <div class="w-full overflow-y-auto no-scrollbar" id="pdf-content">
                <!-- <a href="#" class="text-primary cursor-pointer mb-4"> 
                    < Retour
                </a>  -->
                    <div id="mission-header" class="items-center overflow-hidden bg-white rounded-lg mb-4 dark:bg-gray-800 py-2 px-4">
                        <div class="flex justify-between"> <!-- Utilisation de justify-between ici -->
                            <div class="flex items-center">
                                <div>
                                    <img src="<?=base_url($company->companyLogoPath)?>" alt="Logo de l'entreprise" class="w-32 h-32 rounded-full mr-3">
                                </div>
                                <div>
                                    <p class="font-bold text-3xl"><?=$mission->missionName?></p>
                                    <p>
                                        <span class="font-bold text-2xl"><?=$company->companyName?></span>
                                    </p>
                                    <p class="font-bold text-xl"><?=$mission->missionTJM.'€/Jour'?>
                                    <p class="font-medium text-xl">
                                    <?php foreach ($jobsAll as $joba): ?>
                                        <?php if ($mission->missionJobId == $joba['jobId']): ?>
                                            <?= $joba['jobName'] ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                     - <?=ucfirst($mission->missionExpertise)?>
                                    </p>
                                </div>
                            </div>
                            <div id="contactBlock" class="flex items-center justify-end">
                                <div class="flex flex-col items-end justify-end">
                                    <?php if($user->userType == 'sales') { ?>
                                        <a href="<?php echo base_url('company/missionEdit/'.$mission->idMission);?>">
                                            <button class="ml-4 text-primary hover:text-blue-600" type="button">
                                                <p>Modifier cette mission</p>
                                            </button>   
                                        </a>                                     
                                    <?php } ?>
                                    
                                        <?php foreach ($companyUser as $companyContact) : ?>
                                            <div class="mb-2 flex items-center justify-end">
                                                <span class="text-md mr-2">Contact </span>
                                                
                                                <div class="mr-2 flex p-1 text-primary border-primary border-1 rounded-full hover:bg-primary hover:text-white">
                                                <a href="https://wa.me/<?=$companyContact->userTelephone?>?text=Bonjour%20<?=$companyContact->userFirstName?>%20!%20Je%20suis%20intéressé%20par%20votre%20offre%20de%20mission%20sur%20Café%20Crème%20Community%20!%20" target="_blank">
                                                        <i class="fab fa-whatsapp"></i>
                                                    </a>
                                                </div>
                                                <div class="mr-2 flex p-1 text-red-800 border-red-800 border-1 rounded-full hover:bg-red-900 hover:text-white">
                                                    <a href="mailto:<?=$companyContact->userEmail?>" target="_blank">
                                                    <i class="fas fa-envelope"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    
                                    <div class="mb-2 flex items-center justify-end">
                                    
                                    </div>
                                    <div>
                                        <?php if($user->userType == 'freelance') { ?>
                                            <?php
                                            if(isFavorite($mission->idMission, $favoriteMissions)){
                                            ?>
                                                <a href="<?php echo base_url('user/removeFromFavorite/'.$mission->idMission);?>">
                                                    <button class="px-4 py-2 rounded-full bg-white border-1 border-red-800 text-red-800 hover:text-white mr-2 hover:bg-red-900"><i class="fas fa-heart"></i> Enregistrée</button>
                                                </a>    
                                            <?php
                                                }
                                                else{
                                            ?>
                                                <a href="<?php echo base_url('user/addToFavorite/'.$mission->idMission);?>">
                                                    <button class="px-4 py-2 rounded-full bg-white border-1 text-red-800 hover:text-red-900 mr-2 hover:bg-white-700"><i class="far fa-heart"></i> Enregistrer</button>
                                                </a>
                                            <?php
                                                }
                                            ?>
                                            <button class="px-4 py-2 rounded-full bg-primary text-white mr-2 hover:bg-blue-700" id="sendMessage" data-modal-toggle="sendMessage">Postuler maintenant</button>
                                        <?php } ?>

                                        <button id="generate-pdf-btn" class="bg-primary mb-4 hover:bg-blue-700 text-white py-2 px-4 rounded-full">
                                            PDF
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="flex gap-6 mb-3 mt-6">
                        <div class="w-1/4 sticky top-0">
                            <div class="w-full">
                                <div id="mission-infos" class="bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                                    <h2 class="text-xl font-bold mb-4">Informations clés</h2> 

                                        <div class="flex grid-cols-2 items-center mb-4">
                                            <?php
                                            // user is available or not
                                            if($mission->missionDeroulement == "hybride"){
                                            ?>
                                                <div>
                                                    <p class="w-10 h-10 rounded-full bg-pink-300 text-white text-center text-xl flex items-center justify-center mr-4 pt-2">✈️</p>
                                                </div>
                                            <?php
                                            }else
                                            {
                                                if ($mission->missionDeroulement == "teletravail"){
                                            ?>
                                            <div>
                                                <p class="w-10 h-10 rounded-full bg-pink-300 text-white text-center text-xl flex items-center justify-center mr-4 pt-2">✈️</p>
                                            </div>
                                            <?php
                                                }else{
                                            ?>
                                            <div>
                                                <p class="w-10 h-10 rounded-full bg-pink-300 text-white text-center text-xl flex items-center justify-center mr-4 pt-2">👨🏻‍💻</p>
                                            </div>
                                            <?php
                                            } }
                                            ?>
                                            <div>
                                                <p class="text">Mode de déroulement</p>
                                                <?php
                                                    if($mission->missionDeroulement == "hybride"){
                                                    ?>
                                                        <p class="font-bold text-lg">Hybride</p>
                                                    <?php
                                                        }else if($mission->missionDeroulement == "teletravail"){
                                                    ?>
                                                        <p class="font-bold text-lg">Télétravail</p>
                                                    <?php
                                                        }else if($mission->missionDeroulement == "site"){
                                                    ?>
                                                        <p class="font-bold text-lg">Sur site</p>
                                                    <?php
                                                        }
                                                    ?>
                                            </div>
                                        </div>
                                        <div class="flex grid-cols-2 items-center mb-4">
                                            <div>
                                                <p class="w-10 h-10 rounded-full bg-green-400 text-white text-center text-xl flex items-center justify-center mr-4 pt-2">🕐</p>
                                            </div>
                                            
                                            <div>
                                                <p class="text">Type de poste</p>
                                                <?php
                                                    if ($mission->missionType == "temps-plein"){
                                                        $mission->missionType = "Temps Plein";
                                                    }
                                                    elseif ($mission->missionType == "temps-partiel"){
                                                        $mission->missionType = "Temps Partiel";
                                                    }                                   
                                                ?>
                                                <p class="font-bold text-lg"><?=$mission->missionType?></p>

                                            </div>
                                        </div>
                                        <div class="flex grid-cols-2 items-center mb-4">
                                            <div>
                                                <p class="w-10 h-10 rounded-full bg-orange-400 text-white text-center text-xl flex items-center justify-center mr-4 pt-2">📍</p>
                                            </div>
                                            
                                            <div>
                                                <p class="text">Localisation</p>
                                                <p class="font-bold text-lg"><?=$mission->missionLocalisation?></p>

                                            </div>
                                        </div>
                                        <div class="flex grid-cols-2 items-center mb-4">
                                            <div>
                                                <p class="w-10 h-10 rounded-full bg-indigo-300 text-white text-center text-xl flex items-center justify-center mr-4 pt-2">⏳</p>
                                            </div>
                                            
                                            <div>
                                                <p class="text">Durée de la mission</p>
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
                                                <p class="font-bold text-lg"><?=$mission->missionDuration?></p>
                                                
                                            </div>
                                        </div>
                                        <div class="flex grid-cols-2 items-center mb-4">
                                            <div>
                                                <p class="w-10 h-10 rounded-full bg-red-400 text-white text-center text-xl flex items-center justify-center mr-4">📅</p>
                                            </div>
                                            
                                            <div>
                                                <p class="text">Dates</p>
                                                <p class="font-semibold text-lg"><?=$mission->missionDateDebut = date('d/m/Y', strtotime($mission->missionDateDebut))?> - 
                                                <?php
                                                if($mission->missionDateFin == NULL){
                                                    echo "Date de fin indéfinie";
                                                }
                                                else {
                                                    echo $mission->missionDateFin = date('d/m/Y', strtotime($mission->missionDateFin));
                                                }
                                                
                                                ?>
                                            </p>
                                                
                                            </div>
                                        </div>
                                </div>
                                <div id="mission-skills" class="relative bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                                    <h2 class="text-xl font-bold mb-4"> Compétences requises </h2> 
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
                                                <span class="dark:<?=$textdark?> inline-block px-4 py-1 mt-2 rounded-full <?=$text?>" style="background-color:<?=$color?>;"><?=$skill->skillName?></span>
                                                <div class="skill-level"><?=$level?></div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="flex justify-end gap-4" id="legendeskills">
                                        <div class="flex items-center gap-2">
                                            <div class="w-3 h-3 mr-1 rounded-full" style="background-color: #BEE3F8;"></div>
                                            <span class="text-gray-600 mr-2 text-sm dark:text-white">Junior</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div class="w-3 h-3 mr-1 rounded-full" style="background-color: #63B3ED;"></div>
                                            <span class="text-gray-600 mr-2 text-sm dark:text-white">Intermédiaire</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div class="w-3 h-3 mr-1 rounded-full" style="background-color: #2C5282;"></div>
                                            <span class="text-gray-600 mr-2 text-sm dark:text-white">Expert</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-3/4 sticky top-0">
                            <div class="w-full">
                                <div id="mission-description" class="bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                                    <h2 class="font-bold text-2xl">La mission</h2>
                                    <p class="text-gray-500 mt-2 dark:text-white">
                                        <?=$mission->missionDescription?>
                                    </p>
                                </div>
                                <div id="company-description" class="bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                                    <h2 class="font-bold text-2xl">L'entreprise</h2>
                                    <p class="text-gray-500 mt-2 dark:text-white">
                                        <?=$company->companyDescription?>
                                    </p>
                                </div>
                                <?php
                                if ($mission->missionAvantage != null) {
                                ?>
                                <div id="mission-avantages" class="bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                                    <h2 class="font-bold text-2xl">Les avantages</h2>
                                    <p class="text-gray-500 mt-2 dark:text-white">
                                        <?=$mission->missionAvantage?>
                                    </p>
                                </div>
                                <?php
                                }
                                ?> 
                            </div>
                        </div>
                    </div> 
             
            </div>
            <h2 class="font-bold text-2xl mt-2">Les autres offres proposés par <?=$company->companyName?></h2>
            <div class="overflow-x-auto flex pb-4 no-scrollbar">
                <?php foreach($companyMissions as $companyMission): ?>
                    <?php if ($companyMission->idMission !== $mission->idMission): ?>
                    <a href="<?=base_url('user/missionView/'.$companyMission->idMission)?>">
                        <div class="bg-white rounded-lg h-20vh mt-4 p-4 dark:bg-gray-800 dark:text-white relative mr-4">
                        <div class="w-full h-full flex items-start justify-center" style="width:500px;">
                            <div class="flex items-center">
                                <div class="mr-4">
                                    <img src="<?=base_url('assets/img/airbnb.png')?>" alt="Logo de l'entreprise" class="w-10 h-10 rounded-full">
                                </div>
                                <div class="w-3/4 mr-4">
                                    <h2 class="font-bold text-lg"><?=$companyMission->missionName?></h2>
                                    <p>
                                        <span class="mr-2"> • TJM : <?=$companyMission->missionTJM?> €</span>
                                        
                                        <span class="mr-2"> •
                                        <?php
                                        if ($companyMission->missionDuration == "courte"){
                                            $companyMission->missionDuration = "Courte durée";
                                        }
                                        elseif ($companyMission->missionDuration == "longue"){
                                            $companyMission->missionDuration = "Longue durée";
                                        }
                                        elseif ($companyMission->missionDuration == "indefinie"){
                                            $companyMission->missionDuration = "Durée indéfinie";
                                        }                                            
                                        ?>
                                        <?=$companyMission->missionDuration?> 
                                        </span>
                                        
                                        <span class="mr-2"> •
                                        <?php
                                        if ($companyMission->missionType == "temps-plein"){
                                            $companyMission->missionType = "Temps Plein";
                                        }
                                        elseif ($companyMission->missionType == "temps-partiel"){
                                            $companyMission->missionType = "Temps Partiel";
                                        }
                                        elseif ($companyMission->missionType == "remote"){
                                            $companyMission->missionType = "Remote";
                                        }                                            
                                        ?>
                                        <?=$companyMission->missionType?> 
                                        </span>

                                        <span class="mr-2"> • 
                                        <?php

                                        if ($companyMission->missionDeroulement == "teletravail"){
                                            $companyMission->missionDeroulement = "Télétravail";
                                        }
                                        elseif ($companyMission->missionDeroulement == "site"){
                                            $companyMission->missionDeroulement = "Sur site";
                                        }
                                        elseif ($companyMission->missionDeroulement == "hybride"){
                                            $companyMission->missionDeroulement = "Hybride";
                                        }                                            
                                        ?>
                                        <?=$companyMission->missionDeroulement?>
                                        </span>

                                        <span class="mr-2"> • <?=$companyMission->missionLocalisation?></span>

                                        <span class="mr-2"> •
                                        <?php
                                        if ($companyMission->missionExpertise == "junior"){
                                            $companyMission->missionExpertise = "Junior";
                                        }
                                        elseif ($companyMission->missionExpertise == "intermediaire"){
                                            $companyMission->missionExpertise = "Intermédiaire";
                                        }
                                        elseif ($companyMission->missionExpertise == "expert"){
                                            $companyMission->missionExpertise = "Expert";
                                        }
                                                                            
                                        ?>
                                        <?=$companyMission->missionExpertise?>
                                        </span>

                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="mt-4">
                                    <p class="font-light mt-4 mb-4">
                                        <?php 
                                        // limit missionDescription to 270 characters and add '...' at the end
                                        $companyMission->missionDescription = strlen($companyMission->missionDescription) > 270 ? substr($companyMission->missionDescription,0,270)."..." : $companyMission->missionDescription;    
                                        ?>
                                        <?=$companyMission->missionDescription?>
                                    </p>
                                    <?php if (isset($missionSkills[$companyMission->idMission])) : ?>
                                        <div class="skills-container mb-4">
                                        <?php foreach ($missionSkills[$companyMission->idMission] as $skill) : ?>
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
                                                    /*case 3:
                                                        $level = 'Confirmé';
                                                        $color = '#3182CE'; // Couleur pour le niveau confirmé
                                                        $textdark = "text-white";
                                                        $text = "text-white";
                                                        break;*/
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
                                                <span class="dark:<?=$textdark?> inline-block px-4 py-1 mt-2 rounded-full <?=$text?>" style="background-color:<?=$color?>;"><?=$skill->skillName?></span>
                                                <div class="skill-level"><?=$level?></div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="absolute top-0 right-4 mt-4 mb-4 z-9">
                                <?php if($user->userType == 'freelance') { ?>
                                    <?php
                                    if(isFavorite($companyMission->idMission, $favoriteMissions)){
                                        ?>
                                        <a href="<?php echo base_url('user/removeFromFavorite/'.$companyMission->idMission);?>">
                                            <i class="fas fa-heart text-xl text-red-800"></i>
                                        </a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url('user/addToFavorite/'.$companyMission->idMission);?>">
                                            <i class="far fa-heart text-xl text-red-800"></i>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                <?php } ?>

                                <?php if($user->userType == 'sales') { ?>
                                <a href="<?php echo base_url('company/missionEdit/'.$companyMission->idMission);?>">
                                    <button class="py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                        <i class="fas fa-pen fa-fw"></i>
                                    </button>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                        </div>
                    </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <div>
            </div>
        </div>

        </div>

    </div>
</div>




<!-- Script JS -->

<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>


<script>
    document.getElementById('generate-pdf-btn').addEventListener('click', function () {
    const element = document.getElementById('pdf-content');

    // Dupliquer le contenu de la div "pdf-content" sans le bloc "contactBlock"
    const clonedContent = element.cloneNode(true);
    const contactBlock = clonedContent.querySelector('#contactBlock');
    const missionHeader = clonedContent.querySelector('#mission-header');
    const missionInfos = clonedContent.querySelector('#mission-infos');
    const missionSkills = clonedContent.querySelector('#mission-skills');
    const missionDescription = clonedContent.querySelector('#mission-description');
    const companyDescription = clonedContent.querySelector('#company-description');
    const missionAvantages = clonedContent.querySelector('#mission-avantages');
    const paragrapheElements = clonedContent.querySelectorAll('p');

    const legendeskills = clonedContent.querySelector('#legendeskills');
    if (legendeskills) {
      legendeskills.remove();
    }
    if (contactBlock) {
      contactBlock.remove();
    }
    if (missionHeader) {
        missionHeader.classList.remove('dark:bg-gray-800');
        missionHeader.classList.add('text-black');
    }
    if (missionInfos) {
        missionInfos.classList.remove('dark:bg-gray-800');
        missionInfos.classList.remove('dark:text-white');
        missionInfos.classList.add('text-black');
    }
    if (missionSkills) {
        missionSkills.classList.remove('dark:bg-gray-800');
        missionSkills.classList.remove('dark:text-white');
        missionSkills.classList.add('text-black');
    }
    if (missionDescription) {
        missionDescription.classList.remove('dark:bg-gray-800');
        missionDescription.classList.remove('dark:text-white');
        missionDescription.classList.add('text-black');
    }
    if (companyDescription) {
        companyDescription.classList.remove('dark:bg-gray-800');
        companyDescription.classList.remove('dark:text-white');
        companyDescription.classList.add('text-black');
    }
    if (missionAvantages) {
        missionAvantages.classList.remove('dark:bg-gray-800');
        missionAvantages.classList.remove('dark:text-white');
        missionAvantages.classList.add('text-black');
    }
    paragrapheElements.forEach((pElement) => {
        pElement.classList.remove('dark:text-white');
    });

    const opt = {
      margin: 10,
      filename: '<?php echo $mission->missionName;?> - <?php echo $company->companyName;?>' + '.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 2 },
      jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
    };

    html2pdf().from(clonedContent).set(opt).save();
  });


    function toggleCustomMessage() {
        var customMessageWrapper = document.getElementById("customMessageWrapper");
        var messageSelect = document.getElementById("message");

        if (messageSelect.value === "") {
            customMessageWrapper.classList.add("hidden");
        } else {
            customMessageWrapper.classList.remove("hidden");
        }
    }

    function updateTextarea() {
        var messageSelect = document.getElementById("message");
        var customMessageTextarea = document.getElementById("customMessage");

        if (messageSelect.value === "") {
            customMessageTextarea.value = "";
            document.getElementById("customMessageWrapper").classList.add("hidden");
        } else {
            customMessageTextarea.value = messageSelect.value;
            document.getElementById("customMessageWrapper").classList.remove("hidden");
        }
    }


    function sendMessageOnWhatsApp() {
        var companyContactNumber = "<?php echo $companyContact->userTelephone; ?>";
        var customMessage = document.getElementById("customMessage").value;

        // Vérifiez si un message personnalisé a été saisi, sinon utilisez le message pré-défini du select
        var messageToSend = customMessage !== "" ? encodeURIComponent(customMessage) : encodeURIComponent(document.getElementById("message").value);

        // Redirection vers WhatsApp avec le numéro de l'entreprise et le message pré-rempli
        var whatsappURL = "https://wa.me/" + companyContactNumber + "?text=" + messageToSend;
        window.location.href = whatsappURL;
    }

</script>
