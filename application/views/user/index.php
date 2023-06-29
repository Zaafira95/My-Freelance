<?php
// Header Call
include(APPPATH . 'views/layouts/header.php');
?>

<style>
    html,
    body {
        height: 100vh;
    }
</style>
<link rel="stylesheet" href="<?php echo base_url('assets/css/nouislider.min.css');?>">
<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
   
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
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Êtes-vous disponible pour travailler dès maintenant ?</label>
                        <label class="text-sm text-gray-500 mr-3 dark:text-gray-400">Non</label>
                        <input type="checkbox" name="userIsAvailable" id="hs-basic-with-description" <?php echo $checkboxChecked; ?> class="relative shrink-0 w-[3.25rem] h-7 bg-gray-100 checked:bg-gray-100 rounded-full cursor-pointer transition-colors ease-in-out duration-200 border border-transparent ring-1 ring-transparent focus:border-green-600 focus:ring-green-600 ring-offset-white focus:outline-none appearance-none dark:bg-gray-700 dark:checked:bg-green-600 dark:focus:ring-offset-gray-800 before:inline-block before:w-6 before:h-6 before:bg-white checked:before:bg-green-500 before:translate-x-0 checked:before:translate-x-full before:shadow before:rounded-full before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-gray-400 dark:checked:before:bg-green-200">
                        <label class="text-sm text-gray-500 ml-3 dark:text-gray-400">Oui</label>
                    </div>
                <div class="flex items-center space-x-4 mt-4">
                    <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Valider
                    </button>
                    <button type="button" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="px-4 lg:px-6 py-6 h-full overflow-y-auto no-scrollbar">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl h-full">
        <div class="flex gap-6 h-full mb-3">
        <div class="w-1/4 sticky top-0">
        <div class="bg-white rounded-lg h-full mb-4 p-4 dark:bg-gray-800 dark:text-white">
            <h3 class="text-xl font-medium mt-2">Filtre</h3>
            <h4 class="text-lg font-medium mt-4">Localisation</h4>
            <div class="flex items-center mt-2">
            <i class="fa fa-map-marker-alt mr-3"></i>

        
            <select id="localisation-select" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5">
                <option value="">Sélectionnez une localisation</option>
            </select>
            </div>
            <h4 class="text-lg font-medium mt-4">Type de poste</h4>
            <div class="mt-2">
            <label class="flex items-center">
                <input type="checkbox" class="form-checkbox mr-2">
                <span class="ml-2">Temps plein</span>
            </label>
            <label class="flex items-center">
                <input type="checkbox" class="form-checkbox mr-2">
                <span class="ml-2">Temps partiel</span>
            </label>
            <label class="flex items-center">
                <input type="checkbox" class="form-checkbox mr-2">
                <span class="ml-2">Full remote</span>
            </label>
            </div>
            <h4 class="text-lg font-medium mt-4">Niveau d'expérience</h4>
            <div class="mt-2">
            <label class="flex items-center">
                <input type="checkbox" class="form-checkbox mr-2">
                <span class="ml-2">Junior (1 à 2 ans)</span>
            </label>
            <label class="flex items-center">
                <input type="checkbox" class="form-checkbox mr-2">
                <span class="ml-2">Intermédiaire (3 à 5 ans)</span>
            </label>
            <label class="flex items-center">
                <input type="checkbox" class="form-checkbox mr-2">
                <span class="ml-2">Expert (+ 5 ans)</span>
            </label>
            </div>
            <h4 class="text-lg font-medium mt-4">TJM</h4>
                <div class="mt-2 mr-3">
                <div id="tjm-slider" class="w-full mt-2"></div>
                <div class="flex justify-between mt-2">
                    <span id="tjm-min" class="text-sm">300€</span>
                    <span id="tjm-max" class="text-sm">1200€</span>
                </div>
                </div>
            <h4 class="text-lg font-medium mt-4">Compétences</h4>
            <div class="flex items-center mt-2">
            <i class="fa fa-laptop mr-3"></i>
            <input type="text" placeholder="Javascript, PHP, CSS ..." class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5">
            </div>
            <div class="flex justify-between mt-10">
                <button class="px-4 py-2 rounded-full border border-primary text-primary">Effacer</button>
                <button class="px-4 py-2 rounded-full bg-primary text-white">Appliquer</button>
            </div>

        </div>
        </div>


            <div class="w-1/2 overflow-y-auto no-scrollbar">
                <div class="bg-primary rounded-lg h-20vh p-4 text-white">
                    <p class="font-bold">Hello, <?=$user->userFirstName?></p>
                    <p class="font-normal mt-2 mb-2">Découvrez la manière la plus rapide et efficace de décrocher une mission.</p>

                    <div class="flex w-full">
                        <input type="text" class="w-full bg-white bg-opacity-20 rounded-lg p-2 placeholder-white mr-2 text-center" placeholder="Ecrivez le nom du poste que vous recherchez..." />
                        <button class="w-1/5 bg-white text-primary rounded-lg px-4 py-2">Rechercher</button>
                    </div>
                </div>
                <h3 class="text-2xl font-medium mt-4">Pour vous : </h3>

                <?php foreach($missions as $mission): ?>
                <div class="bg-white rounded-lg h-20vh mt-4 p-4 dark:bg-gray-800 dark:text-white relative cursor-pointer">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <img src="<?=base_url('assets/img/airbnb.png')?>" alt="Logo de l'entreprise" class="w-15 h-15 rounded-full mr-3">
                        </div>
                        <div class="w-3/4 mr-4">
                            <h2 class="font-bold text-lg"><?=$mission->missionName?></h2>
                            <p>
                            <?php foreach ($missionCompany[$mission->idMission] as $company) : ?>
                                <?php if (is_object($company)) : ?>
                                    <span class="mr-2"> • <?= $company->companyName ?></span>
                                <?php endif; ?>
                            <?php endforeach; ?>
                                <span class="mr-2"> • TJM : <?=$mission->missionTJM?> €</span>
                                <span class="mr-2"> • <?=$mission->missionType?></span>
                                <span class="mr-2"> • <?=$mission->missionLocalisation?></span>
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="mt-4">
                            <p class="font-light mt-4 mb-4">
                                <?=$mission->missionDescription?>
                            </p>
                            <?php foreach ($missionSkills[$mission->idMission] as $skill) : ?>
                            <span class="inline-block px-4 py-1 mb-2 rounded-full bg-gray-300 text-black"><?=$skill->skillName?></span>
                            <?php endforeach; ?>
                           
                        </div>
                    </div>
                        <div class="absolute top-0 right-4 mt-4 mb-4">
                            <svg id="heart" class="w-5 h-5 text-red-600 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 30" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.879c-2.484-4.375-12-1.82-12 4.879 0 5.572 5.126 7.664 12 14.121 6.874-6.457 12-8.549 12-14.121 0-6.699-9.516-9.254-12-4.879z"/>
                            </svg>
                        </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="w-1/4 sticky top-0">
                <div class="bg-white rounded-lg h-22vh p-4 dark:bg-gray-800 dark:text-white">
                    <div class="flex flex-col items-center mb-4">
                    <div class="w-20 h-20 rounded-full border-10 ring-2 ring-primary overflow-hidden">
                        <?php 
                        if($user->userAvatarPath == null){
                            $user->userAvatarPath = 'assets/img/default-avatar.png';
                        }
                        ?>
                        <img src="<?php echo base_url($user->userAvatarPath); ?>" alt="Avatar" class="w-20 h-20 p-0.5 rounded-full ring-2 ring-primary">
                    </div>

                        <h3 class="text-lg font-medium mt-2"><?=$user->userFirstName .' '. $user->userLastName?></h3>
                        <div class="flex items-center mt-1">
                            <p class="font-light"><?=$job->jobName?></p>
                            <span class="mx-2">•</span>
                            <p class="font-light"><?=$user->userTJM . ' €'?></p>
                        </div>
                       




                        <a href="#" class="text-primary mt-2 border border-primary px-4 py-1 rounded 2 hover:bg-primary-900 hover:text-white">Modifier mon profil</a>
                        <a href="<?php echo base_url('user/logout');?>" class="text-red-500 mt-2">Déconnexion</a>
                        

                    </div>
                </div>

                <div class="bg-white rounded-lg mt-4 p-4 text-left dark:bg-gray-800 dark:text-white">
                    <h3 class="text-xl font-medium mt-2">Expériences</h3>
                    <?php if (is_array($experiences) && !empty($experiences)) {
                        $experienceCount = 0;
                        foreach ($experiences as $experience) {
                            if ($experienceCount < 3) {
                        ?>
                                <div class="flex items-center mt-2 mb-2">
                                    <div class="mr-2 mt-2">
                                        <img src="<?php echo base_url('assets/img/airbnb.png'); ?>" alt="Logo" class="w-15 h-15 rounded-full mr-3">
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-medium"><?= $experience->experienceJob ?></h3>
                                        <p class="text-sm text-gray-500"><?= $experience->experienceCompany ?></p>
                                        <p class="text-sm text-gray-500"><?= $experience->experienceJob ?></p>
                                    </div>
                                </div>
                        <?php
                                $experienceCount++;
                            } else {
                                break;
                            }
                        }
                        ?>
                    <?php } else { ?>
                        <p class="mt-2 mb-2"> Aucune expérience disponible. </p>
                        <button class="bg-primary text-white px-4 py-2 mt-2 rounded-full">Ajouter une expérience</button>
                    <?php } ?>
                </div>


                <div class="bg-white rounded-lg mt-4 p-4 text-left dark:bg-gray-800 dark:text-white">
                    <h3 class="text-xl font-medium mt-2 mb-4">Compétences et expertises</h3>

                    <?php
                    if (is_array($skills) && !empty($skills)) {
                        $skillCount = 0;
                        $colors = ['bg-red-300', 'bg-blue-300', 'bg-green-300', 'bg-yellow-300', 'bg-purple-300', 'bg-orange-300', 'bg-teal-300', 'bg-pink-300', 'bg-indigo-300']; // Liste des couleurs

                        foreach ($skills as $skill) {
                            if ($skillCount < 9) {
                                $colorIndex = $skillCount % count($colors); // Calcul de l'index de couleur
                                ?>
                                <span class="inline-block px-4 py-1 mb-2 rounded-full <?=$colors[$colorIndex]?> text-black">
                                    <?=$skill->skillName?>
                                </span>
                                <?php

                                $skillCount++;
                            } else {
                                break;
                            }
                        }
                    } else {
                        ?>
                        <p class="mt-2 mb-2"> Aucune compétences et expertises renseignées. </p>
                        <button class="bg-primary text-white px-4 py-2 mt-2 rounded-full">Ajouter une compétence</button>
                    <?php } ?>
                </div>

        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.js"></script>


<script>
 var base_url = '<?php echo base_url(); ?>';
  document.addEventListener('DOMContentLoaded', function() {
  var slider = document.getElementById('tjm-slider');
  var min = document.getElementById('tjm-min');
  var max = document.getElementById('tjm-max');
  var userTJM = <?=$user->userTJM?>;


  noUiSlider.create(slider, {
    start: [userTJM, userTJM + 400],
    connect: true,
    range: {
      'min': 300,
      'max': 1200
    },
    step: 10, // Ajout de la propriété step pour les tranches de 10
    format: {
      to: function(value) {
        return parseInt(value) + '€';
      },
      from: function(value) {
        return value.replace('€', '');
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

</script>


