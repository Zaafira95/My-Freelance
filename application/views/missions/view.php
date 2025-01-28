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
    <div class="relative p-4 w-80 lg:w-60 h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-3xl lg:text-lg font-semibold text-gray-900 dark:text-white">
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
                    <label for="message" class="text-3xl lg:text-base block mt-4 mb-2 font-medium text-gray-900 dark:text-white">Choisissez un message prédéfini</label>
                    <select id="message" name="message" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" onchange="updateTextarea()">
                        <option value="">Sélectionnez un message</option>
                        <!-- <?php foreach ($messageExamples as $message) { ?>
                            <option value="<?php echo $message->messageExamplesContent; ?>"><?php echo $message->messageExamplesContent; ?></option>
                        <?php } ?> -->
                        <option value="Bonjour, je suis intéressé par votre offre de mission (<?=$mission->missionName?>) sur Café Crème Community ! Je suis disponible dès maintenant.">
                            Bonjour, je suis intéressé par votre offre de mission (<?=$mission->missionName?>) sur Café Crème Community ! Je suis disponible dès maintenant.
                        </option>
                        <option value="Hello, votre mission (<?=$mission->missionName?>) m'intéresse ! Je suis disponible dès maintenant.">
                            Hello, votre mission (<?=$mission->missionName?>) m'intéresse ! Je suis disponible dès maintenant.
                        </option>
                    </select>
                </div>
                <div id="customMessageWrapper" class="hidden">
                    <label for="customMessage" class="text-3xl lg:text-base block mt-4 mb-2 font-medium text-gray-900 dark:text-white">Personnalisez votre message</label>
                    <textarea id="customMessage" name="customMessage" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 h-32 resize-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                </div>
                <div class="flex items-center space-x-4 mt-8">
                    <button type="button" class="text-3xl lg:text-base text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" onclick="sendMessageOnWhatsApp()">
                        Envoyer
                    </button>
                    <button type="button" data-modal-toggle="sendMessage" class="text-3xl lg:text-base text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="px-8 py-6 lg:px-4 lg:py-6 h-full overflow-y-auto no-scrollbar">
    <div class="flex-wrap justify-between items-center mx-auto max-w-screen-xl h-full">
        <div class="gap-6 h-full mb-3">
            <div class="w-full overflow-y-auto no-scrollbar" id="pdf-content">
                <!-- <a href="#" class="text-primary cursor-pointer mb-4"> 
                    < Retour
                </a>  -->
                    <div id="mission-header" class="items-center overflow-hidden bg-white rounded-lg mb-4 dark:bg-gray-800 py-4 px-4">
                        <div class="lg:flex justify-between"> <!-- Utilisation de justify-between ici -->
                            <div class="flex items-center">
                                <a href="<?=base_url('user/companyView/'.$company->idCompany)?>">
                                    <div class="w-32 h-32 mr-4">
                                        <img src="<?=base_url($company->companyLogoPath)?>" alt="Logo de l'entreprise" class="object-cover w-32 h-32 rounded-full">
                                    </div>
                                </a>
                                <div>
                                    <p class="font-bold text-5xl lg:text-3xl"><?=$mission->missionName?></p>
                                    <a href="<?=base_url('user/companyView/'.$company->idCompany)?>">
                                    <p>
                                        <span class="font-bold text-2xl lg:text-lg"><?=$company->companyName?></span>
                                    </p>
                                    </a>
                                    <p class="font-bold text-2xl lg:text-lg"><?=$mission->missionTJM.'€/Jour'?>
                                    <p class="font-medium text-2xl lg:text-lg">
                                    <?php foreach ($jobsAll as $joba): ?>
                                        <?php if ($mission->missionJobId == $joba['jobId']): ?>
                                            <?= $joba['jobName'] ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                     - <?=ucfirst($mission->missionExpertise)?>
                                    </p>
                                </div>
                            </div>
                            <div id="contactBlock" class="lg:flex items-center lg:justify-end mb-4 mt-4 ">
                                <div class="lg:flex flex-col items-end justify-end">
                                    <?php if($user->userType == 'sales') { ?>
                                        <a href="<?php echo base_url('company/missionEdit/'.$mission->idMission);?>">
                                            <button class="text-3xl lg:text-base ml-4 text-primary hover:text-blue-600" type="button">
                                                <p class="text-right">Modifier cette mission</p>
                                            </button>   
                                        </a>                                     
                                    <?php } ?>
                                    
                                    <?php foreach ($companyUser as $companyContact) : ?>
                                        <div class="hidden lg:flex mb-2  items-center justify-end">
                                            <span class="text-3xl lg:text-base text-md mr-2">Contact </span>
                                            
                                            <div class="text-3xl lg:text-base mr-2 flex p-1 text-primary border-primary border-1 rounded-full hover:bg-primary hover:text-white">
                                            <a href="https://wa.me/<?=$companyContact->userTelephone?>?text=Bonjour%20<?=$companyContact->userFirstName?>%20!%20Je%20suis%20intéressé%20par%20votre%20offre%20de%20mission%20sur%20Café%20Crème%20Community%20!%20" target="_blank">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>
                                            </div>
                                            <div class="text-3xl lg:text-base mr-2 flex p-1 text-red-800 border-red-800 border-1 rounded-full hover:bg-red-900 hover:text-white">
                                                <a href="mailto:<?=$companyContact->userEmail?>" target="_blank">
                                                <i class="fas fa-envelope"></i>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    
                                    <div class="mb-2 flex items-center justify-end">
                                    
                                    </div>
                                    <div class="lg:flex flex-wrap justify-end gap-2">
                                        <?php if($user->userType == 'freelance') { ?>
                                            
                                            <button class="text-3xl lg:text-base px-4 py-2 rounded-full bg-primary text-white mr-2 hover:bg-blue-700" id="sendMessage" data-modal-toggle="sendMessage">Postuler maintenant</button>
                                            <?php
                                            if(isFavorite($mission->idMission, $favoriteMissions)){
                                            ?>
                                                <a href="<?php echo base_url('user/removeFromFavorite/'.$mission->idMission);?>">
                                                    <button class="text-3xl lg:text-base px-4 py-2 rounded-full bg-white border-1 border-red-800 text-red-800 hover:text-white mr-2 hover:bg-red-900"><i class="fas fa-heart"></i> Enregistrée</button>
                                                </a>    
                                            <?php
                                                }
                                                else{
                                            ?>
                                                <a href="<?php echo base_url('user/addToFavorite/'.$mission->idMission);?>">
                                                    <button class="text-3xl lg:text-base px-4 py-2 rounded-full bg-white border-1 text-red-800 hover:text-red-900 mr-2 hover:bg-white-700"><i class="far fa-heart"></i> Enregistrer</button>
                                                </a>
                                            <?php
                                                }
                                            ?>
                                        <?php } ?>

                                        <!-- <button id="generate-pdf-btn" class="text-3xl lg:text-base bg-primary mb-4 hover:bg-blue-700 text-white py-2 px-4 rounded-full">
                                            PDF
                                        </button> -->
                                        <!-- <?php if($user->userType == 'freelance') { ?>
                                        <a href="<?=base_url('user/companyView/'.$company->idCompany)?>">
                                            <button class="text-3xl lg:text-base border border-primary text-primary mb-4 py-2 px-4 rounded-full">
                                                Voir l'entreprise 
                                            </button>
                                        </a>
                                        <?php } ?> -->
                                    </div>
                                    <div>
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="lg:flex gap-6 mb-3 mt-6">
                        <div class="w-full lg:w-1/4 sticky top-0"  id="left-side-content">
                            <div class="w-full">
                                <div class="bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                                    <h2 class="text-4xl lg:text-xl font-bold mb-4">Informations clés</h2> 

                                        <div class="flex grid-cols-2 items-center mb-4">
                                            <?php
                                            // user is available or not
                                            if($mission->missionDeroulement == "hybride"){
                                            ?>
                                                <div>
                                                    <p class="w-16 h-16 lg:w-9 lg:h-9 rounded-full bg-pink-300 text-white text-center text-4xl lg:text-xl flex items-center justify-center mr-4 pt-2">✈️</p>
                                                </div>
                                            <?php
                                            }else
                                            {
                                                if ($mission->missionDeroulement == "teletravail"){
                                            ?>
                                            <div>
                                                <p class="w-16 h-16 lg:w-9 lg:h-9 rounded-full bg-pink-300 text-white text-center text-4xl lg:text-xl flex items-center justify-center mr-4 pt-2">✈️</p>
                                            </div>
                                            <?php
                                                }else{
                                            ?>
                                            <div>
                                                <p class="w-16 h-16 lg:w-9 lg:h-9 rounded-full bg-pink-300 text-white text-center text-4xl lg:text-xl flex items-center justify-center mr-4 pt-2">👨🏻‍💻</p>
                                            </div>
                                            <?php
                                            } }
                                            ?>
                                            <div>
                                                <p class="text text-2xl lg:text-lg">Mode de déroulement</p>
                                                <?php
                                                    if($mission->missionDeroulement == "hybride"){
                                                    ?>
                                                        <p class="font-bold text-3xl lg:text-lg">Hybride</p>
                                                    <?php
                                                        }else if($mission->missionDeroulement == "teletravail"){
                                                    ?>
                                                        <p class="font-bold text-3xl lg:text-lg">Télétravail</p>
                                                    <?php
                                                        }else if($mission->missionDeroulement == "site"){
                                                    ?>
                                                        <p class="font-bold text-3xl lg:text-lg">Sur site</p>
                                                    <?php
                                                        }
                                                    ?>
                                            </div>
                                        </div>
                                        <div class="flex grid-cols-2 items-center mb-4">
                                            <div>
                                                <p class="w-16 h-16 lg:w-9 lg:h-9 rounded-full bg-green-400 text-white text-center text-4xl lg:text-xl flex items-center justify-center mr-4 pt-2">🕐</p>
                                            </div>
                                            
                                            <div>
                                                <p class="text text-2xl lg:text-lg">Type de poste</p>
                                                <?php
                                                    if ($mission->missionType == "temps-plein"){
                                                        $mission->missionType = "Temps Plein";
                                                    }
                                                    elseif ($mission->missionType == "temps-partiel"){
                                                        $mission->missionType = "Temps Partiel";
                                                    }                                   
                                                ?>
                                                <p class="font-bold text-3xl lg:text-lg"><?=$mission->missionType?></p>

                                            </div>
                                        </div>
                                        <div class="flex grid-cols-2 items-center mb-4">
                                            <div>
                                                <p class="w-16 h-16 lg:w-9 lg:h-9 rounded-full bg-orange-400 text-white text-center text-4xl lg:text-xl flex items-center justify-center mr-4 pt-2">📍</p>
                                            </div>
                                            
                                            <div>
                                                <p class="text text-2xl lg:text-lg">Localisation</p>
                                                <p class="font-bold text-3xl lg:text-lg"><?=$mission->missionLocalisation?></p>

                                            </div>
                                        </div>
                                        <div class="flex grid-cols-2 items-center mb-4">
                                            <div>
                                                <p class="w-16 h-16 lg:w-9 lg:h-9 rounded-full bg-indigo-300 text-white text-center text-4xl lg:text-xl flex items-center justify-center mr-4 pt-2">⏳</p>
                                            </div>
                                            
                                            <div>
                                                <p class="text text-2xl lg:text-lg">Durée de la mission</p>
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
                                                <p class="font-bold text-3xl lg:text-lg"><?=$mission->missionDuration?></p>
                                                
                                            </div>
                                        </div>
                                        <div class="flex grid-cols-2 items-center mb-4">
                                            <div>
                                                <p class="w-16 h-16 lg:w-9 lg:h-9 rounded-full bg-red-400 text-white text-center text-4xl lg:text-xl flex items-center justify-center mr-4">📅</p>
                                            </div>
                                            
                                            <div>
                                                <p class="text text-2xl lg:text-lg">Dates</p>
                                                <p class="font-semibold text-3xl lg:text-lg"><?=$mission->missionDateDebut = date('d/m/Y', strtotime($mission->missionDateDebut))?> - 
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
                                <div class="relative bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                                    <h2 class="text-4xl lg:text-xl font-bold mb-4"> Compétences requises </h2> 
                                    <div class="skills-container mb-6">
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
                                            <div class="skill-item" data-level="<?=$level?>">
                                                <span class="text-3xl lg:text-base dark:<?=$textdark?> inline-block px-4 py-1 mt-2 rounded-full <?=$text?>" style="background-color:<?=$color?>;"><?=$skill->skillName?></span>
                                                <div class="skill-level"><?=$level?></div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="flex justify-end gap-4" id="legendeskills">
                                        <div class="flex items-center gap-2">
                                            <div class="w-5 h-5 lg:w-3 lg:h-3 mr-1 rounded-full" style="background-color: #BEE3F8;"></div>
                                            <span class="text-gray-600 mr-2 text-xl lg:text-sm dark:text-white">Junior</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div class="w-5 h-5 lg:w-3 lg:h-3 mr-1 rounded-full" style="background-color: #63B3ED;"></div>
                                            <span class="text-gray-600 mr-2 text-xl lg:text-sm dark:text-white">Intermédiaire</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div class="w-5 h-5 lg:w-3 lg:h-3 mr-1 rounded-full" style="background-color: #2C5282;"></div>
                                            <span class="text-gray-600 mr-2 text-xl lg:text-sm dark:text-white">Expert</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-3/4 sticky top-0" id="mission-main-content">
                            <div class="w-full">
                                <div id="mission-infos" class="hidden bg-white rounded-lg mb-4 p-4 text-black">
                                    <h2 class="text-xl font-bold mb-4">Informations clés</h2> 
                                    <div class="flex flex-wrap">
                                        <div class="flex grid-cols-2 items-center mb-2" style="width:33%">
                                            <?php
                                            // user is available or not
                                            if($mission->missionDeroulement == "hybride"){
                                            ?>
                                                <div>
                                                    <p class="w-6 h-6 rounded-full bg-pink-300 text-white text-center text-sm flex items-center justify-center mr-4">✈️</p>
                                                </div>
                                            <?php
                                            }else
                                            {
                                                if ($mission->missionDeroulement == "teletravail"){
                                            ?>
                                            <div>
                                                <p class="w-6 h-6 rounded-full bg-pink-300 text-white text-center text-sm flex items-center justify-center mr-4">✈️</p>
                                            </div>
                                            <?php
                                                }else{
                                            ?>
                                            <div>
                                                <p class="w-6 h-6 rounded-full bg-pink-300 text-white text-center text-sm flex items-center justify-center mr-4">👨🏻‍💻</p>
                                            </div>
                                            <?php
                                            } }
                                            ?>
                                            <div>
                                                <p class="text">Mode de déroulement</p>
                                                <?php
                                                    if($mission->missionDeroulement == "hybride"){
                                                    ?>
                                                        <p class="font-bold text-base">Hybride</p>
                                                    <?php
                                                        }else if($mission->missionDeroulement == "teletravail"){
                                                    ?>
                                                        <p class="font-bold text-base">Télétravail</p>
                                                    <?php
                                                        }else if($mission->missionDeroulement == "site"){
                                                    ?>
                                                        <p class="font-bold text-base">Sur site</p>
                                                    <?php
                                                        }
                                                    ?>
                                            </div>
                                        </div>
                                        <div class="flex grid-cols-2 items-center mb-2" style="width:33%">
                                            <div>
                                                <p class="w-6 h-6 rounded-full bg-green-400 text-white text-center text-sm flex items-center justify-center mr-4">🕐</p>
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
                                                <p class="font-bold text-base"><?=$mission->missionType?></p>

                                            </div>
                                        </div>
                                        <div class="flex grid-cols-2 items-center mb-2" style="width:33%">
                                            <div>
                                                <p class="w-6 h-6 rounded-full bg-orange-400 text-white text-center text-sm flex items-center justify-center mr-4">📍</p>
                                            </div>
                                            
                                            <div>
                                                <p class="text">Localisation</p>
                                                <p class="font-bold text-base"><?=$mission->missionLocalisation?></p>

                                            </div>
                                        </div>
                                        <div class="flex grid-cols-2 items-center mb-2" style="width:33%">
                                            <div>
                                                <p class="w-6 h-6 rounded-full bg-indigo-300 text-white text-center text-sm flex items-center justify-center mr-4">⏳</p>
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
                                                <p class="font-bold text-base"><?=$mission->missionDuration?></p>
                                                
                                            </div>
                                        </div>
                                        <div class="flex grid-cols-2 items-center mb-2">
                                            <div>
                                                <p class="w-6 h-6 rounded-full bg-red-400 text-white text-center text-sm flex items-center justify-center mr-4">📅</p>
                                            </div>
                                            
                                            <div>
                                                <p class="text">Dates</p>
                                                <p class="font-semibold text-base"><?=$mission->missionDateDebut = date('d/m/Y', strtotime($mission->missionDateDebut))?> - 
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
                                
                                </div>
                                <div  id="mission-skills" class="hidden relative bg-white rounded-lg mb-4 p-4 text-black">
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
                                            <div class="skill-item" data-level="<?=$level?>">
                                                <span class="dark:<?=$textdark?> inline-block px-4 py-1 mt-2 rounded-full <?=$text?>" style="background-color:<?=$color?>;"><?=$skill->skillName?></span>
                                                <div class="skill-level"><?=$level?></div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div id="mission-description" class="bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                                    <h2 class="font-bold text-5xl lg:text-2xl">La mission</h2>
                                    <div class="richTextList">
                                        <div class="text-3xl lg:text-base text-gray-500 mt-2 dark:text-white">
                                            <?=$mission->missionDescription?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if ($mission->missionAvantage != null) {
                                ?>
                                <div id="mission-avantages" class="bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                                    <h2 class="font-bold text-5xl lg:text-2xl">Les avantages</h2>
                                    <div class="richTextList text-3xl lg:text-base text-gray-500 mt-2 dark:text-white">
                                        <?=$mission->missionAvantage?>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                                <div id="company-description" class="bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                                    <h2 class="font-bold text-5xl lg:text-2xl">L'entreprise</h2>
                                    <div class="richTextList text-3xl lg:text-base text-gray-500 mt-2 dark:text-white">
                                        <?=$company->companyDescription?>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div> 
            </div>
            <?php if(count($companyMissions) >= 2) { ?>
                <h2 class="font-bold text-4xl lg:text-xl mt-2 mb-4">Les autres offres proposés par <?=$company->companyName?></h2>
                <div class="overflow-x-auto flex pb-4 no-scrollbar">
                <?php foreach($companyMissions as $companyMission): ?>
                    <?php if ($companyMission->idMission !== $mission->idMission): ?>
                    <a href="<?=base_url('user/missionView/'.$companyMission->idMission)?>">
                        <div class="bg-white rounded-lg h-20vh mt-4 p-4 dark:bg-gray-800 dark:text-white relative mr-4">
                             <div class="lg:w-500px h-full items-start justify-center" style="width:500px;">
                                <div class="flex items-center">
                                    <div class="mr-4">
                                        <img src="<?=base_url($company->companyLogoPath)?>" alt="Logo de l'entreprise" class="object-cover w-16 h-16 lg:w-10 rounded-full">
                                    </div>
                                    <div class="w-3/4 mr-4">
                                        <h2 class="font-bold text-3xl lg:text-lg"><?=$companyMission->missionName?></h2>
                                        <p class="text-3xl lg:text-base">
                                            <span class="mr-2"> 
                                                •   <?= $companyMission->jobName?>
                                            </span>
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
                                            <div class="font-normal overflow-hidden text-3xl lg:text-base mt-4 mb-4" style="max-height : 6em">
                                                <p>
                                                    <?=$companyMission->missionDescription?>
                                                </p>
                                            </div>
                                            <?php if (isset($missionSkills[$companyMission->idMission])) : ?>
                                                <div class="skills-container mb-4">
                                                <?php
                                                $skillsCount = 0;
                                                ?>
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
                                                                $level = 'Intermediate';
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
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="absolute top-0 right-4 mt-4 mb-4 z-9">
                                    <?php if($user->userType == 'freelance') { ?>
                                        <?php
                                        if(isFavorite($companyMission->idMission, $favoriteMissions)){
                                            ?>
                                            <a href="<?php echo base_url('user/removeFromFavorite/'.$companyMission->idMission);?>">
                                                <i class="fas fa-heart text-4xl lg:text-xl text-red-800"></i>
                                            </a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="<?php echo base_url('user/addToFavorite/'.$companyMission->idMission);?>">
                                                <i class="far fa-heart text-4xl lg:text-xl text-red-800"></i>
                                            </a>
                                            <?php
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($user->userType == 'sales') { ?>
                                        <a href="<?php echo base_url('company/missionEdit/'.$companyMission->idMission);?>">
                                            <button class="py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                                <i class="fas fa-pen fa-fw text-4xl lg:text-xl"></i>
                                            </button>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                    </a>
                    <?php endif; ?>
                <?php endforeach; ?>
                </div>
            <?php } ?>

            <div>
            </div>
        </div>

        </div>

    </div>
</div>




<!-- Script JS -->

<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script>
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
