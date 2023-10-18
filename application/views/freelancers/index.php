<?php
$currentPage = 'freelancers';


// Header Call
include(APPPATH . 'views/layouts/company/header.php');
?>
    <title> Nos Freelances | Café Crème Community </title>

<link href="stylesheet" href="<?php echo base_url('assets/css/nouislider.min.css');?>">
<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('/node_modules/choices.js/public/assets/styles/choices.min.css');?>" rel="stylesheet" type="text/css">


<div class="px-4 lg:px-6 py-6 h-90 overflow-y-auto no-scrollbar">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl h-full">
        <div class="w-full flex gap-6 h-full mb-3">
            <div class="w-1/4 sticky top-0">
                <div class="bg-white rounded-lg h-full mb-4 p-4 dark:bg-gray-800 dark:text-white">
                    <h3 class="text-xl font-medium mt-2">Filtre</h3>
                    <h4 class="text-lg font-medium mt-4">Localisation</h4>
                        <div class="flex items-center mt-2">
                            <i class="fa fa-map-marker-alt mr-3"></i>    
                            <div class="relative city-search-container w-full">
                                <input type="text" id="citySearch" placeholder="Cherchez votre ville" class="border p-2 rounded-lg w-full text-black">
                                    <div id="cities-list" class="absolute z-10 mt-2 w-full rounded bg-white max-h-64 overflow-y-auto text-black"></div>
                            </div>
                        </div>
                    <h4 class="text-lg font-medium mt-4">Type de poste</h4>
                    <div class="mt-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox mr-2" id="temps-plein">
                            <span class="ml-2">Temps plein</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox mr-2" id="temps-partiel">
                            <span class="ml-2">Temps partiel</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox mr-2" id="remote">
                            <span class="ml-2">Remote</span>
                        </label>
                    </div>
                    <h4 class="text-lg font-medium mt-4">Niveau d'expérience</h4>
                    <div class="mt-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox mr-2" id="junior" <?= ($user->userExperienceYear === 'Junior') ? 'checked' : '' ?>>
                            <span class="ml-2">Junior (1 à 2 ans)</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox mr-2" id="intermediaire" <?= ($user->userExperienceYear === 'Intermédiaire') ? 'checked' : '' ?>>
                            <span class="ml-2">Intermédiaire (3 à 5 ans)</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox mr-2" id="expert" <?= ($user->userExperienceYear === 'Expert') ? 'checked' : '' ?>>
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
                    <div class="w-full max-w-xs mx-auto mt-5 text-black">
                        <!-- <label for="skillsAll" class="block text-sm font-medium text-gray-700">Sélectionnez vos compétences</label> -->
                        <select id="skillsAll" name="skillsAll[]" multiple class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white text-black rounded-full shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <?php foreach ($skillsAll as $skill): ?>
                                <option class="text-black" value="<?= $skill['skillId'] ?>"><?= $skill['skillName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                </div>
                
            </div>
            <div class="w-full overflow-y-auto no-scrollbar">
                <div class="bg-primary rounded-lg h-20vh p-4 text-white">
                    <p class="font-bold">Hello, <?=$user->userFirstName?></p>
                    <p class="font-normal mt-2 mb-2">Découvrez la manière la plus rapide et efficace de décrocher une mission.</p>
                    <div class="flex w-full">
                        <input type="text" id="search-input" class="w-full bg-white bg-opacity-20 rounded-lg p-2 placeholder-white mr-2 text-center" placeholder="Ecrivez le nom du freelance que vous recherchez..." />
                        <!-- <button class="w-1/5 bg-white text-primary rounded-lg px-4 py-2">Rechercher</button> -->
                    </div>
                </div>
                <h3 class="text-2xl font-medium mt-4" id="result-section">Pour vous :</h3>
                <div class="flex flex-wrap" id="freelancers-section">
                    <?php foreach($freelancers as $freelancer): ?>
                        <a href="<?=base_url('company/freelancerView/'.$freelancer->userId)?>" class=" ">                            
                            <div class="bg-white rounded-lg h-20vh mt-4 p-4 dark:bg-gray-800 dark:text-white relative freelancer-item" data-freelancer-first-name="<?=strtolower($freelancer->userFirstName)?>"data-freelancer-last-name="<?=strtolower($freelancer->userLastName)?>">
                                <div class="flex items-center">
                                    <div class="mr-4">
                                    <?php 
                                        if($freelancer->userAvatarPath == null){
                                            $freelancer->userAvatarPath = 'assets/img/default-avatar.png';
                                        }
                                    ?>
                                        <img src="<?php echo base_url($freelancer->userAvatarPath); ?>" alt="Avatar" class="w-10 h-10 rounded-full">
                                    </div>
                                   
                                    <div class="w-3/4 mr-4">
                                        <div class="flex flex-1 mb-1">
                                            <h2 class="font-bold text-lg mr-2 "><?=$freelancer->userFirstName.' '.$freelancer->userLastName?> </h2>
                                            <?php
                                                if($freelancer->userIsAvailable == 1){
                                            ?>
                                            <div class="flex items-center space-x-1 bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-300 dark:text-green-900">
                                                <div style="width: 0.5rem; height: 0.5rem" class="bg-green-500 rounded-full dark:bg-green-700"></div>
                                                <div>Disponible</div>
                                            </div>
                                            <?php
                                                } else {
                                            ?>
                                                <div class="flex items-center space-x-1 bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-300 dark:text-red-900">
                                                    <div style="width: 0.5rem; height: 0.5rem" class="bg-red-500 rounded-full dark:bg-red-700"></div>
                                                    <div>Non Disponible</div>
                                                </div>
                                            <?php
                                                }
                                            ?> 
                                        </div>
                                        
                                        <p>
                                        <?php foreach ($freelancer_job as $job): ?>
                                            <span class="mr-2"><?=$job->jobName?></span>
                                        <?php endforeach; ?>
                                            <span class="mr-2"> • TJM : <?=$freelancer->userTJM?> €</span>
                                            <span class="mr-2"> •
                                            <?php
                                            if ($freelancer->userJobTimePartielOrFullTime == "temps-plein"){
                                                $freelancer->userJobTimePartielOrFullTime = "Temps Plein";
                                            }
                                            elseif ($freelancer->userJobTimePartielOrFullTime == "temps-partiel"){
                                                $freelancer->userJobTimePartielOrFullTime = "Temps Partiel";
                                            }
                                            elseif ($freelancer->userJobTimePartielOrFullTime == "remote"){
                                                $freelancer->userJobTimePartielOrFullTime = "Remote";
                                            }                                            
                                            ?>
                                            <?=$freelancer->userJobTimePartielOrFullTime?> 
                                            <?php

                                            if($freelancer->userRemote == 1){
                                            ?>
                                                • Remote
                                            <?php
                                            }
                                            ?>
                                        
                                            </span>
                                            <span class="mr-2"> • <?=$freelancer->userVille?></span>
                                            <span class="mr-2"> •
                                            <?php
                                                if ($freelancer->userSeniorite == "junior"){
                                                    $freelancer->userSeniorite = "Junior";
                                                }
                                                elseif ($freelancer->userSeniorite == "intermediaire"){
                                                    $freelancer->userSeniorite = "Intermédiaire";
                                                }
                                                elseif ($freelancer->userSeniorite == "expert"){
                                                    $freelancer->userSeniorite = "Expert";
                                                }
                                            ?>
                                            <?=$freelancer->userSeniorite?>
                                        </span>

                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="mt-4">
                                        <p class="font-light mt-4 mb-4">
                                            <?php 
                                            // limit missionDescription to 270 caracteres and add '...' at the end
                                            $freelancer->userBio = strlen($freelancer->userBio) > 270 ? substr($freelancer->userBio,0,270)."..." : $freelancer->userBio;    
                                            ?>
                                            <?=$freelancer->userBio?>
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                    </div>
                    <p class="text-xl mt-10 hidden text-left" id="no-freelancer-found">Aucun freelance n'a été trouvé.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.js"></script>
<script src="<?php echo base_url('/node_modules/choices.js/public/assets/scripts/choices.min.js'); ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    //Script selection des compétences
    const skillsChoices = new Choices('#skillsAll', {
        searchEnabled: true,
        removeItemButton: true,
        itemSelectText: '',
        placeholder: true, // Ajoutez cette ligne pour activer le placeholder
        placeholderValue: 'Sélectionnez des compétences', // Texte du placeholder

    });

    $(document).ready(function(){
        $('#search-input-skill').on('keyup', function(){
            let term = $(this).val();
            $.post('company/search_skills', { term: term }, function(data){
                let skills = JSON.parse(data);
                $('#skills-list').empty();
                skills.forEach(function(skill){
                    $('#skills-list').append(`<div class="skill-item" data-id="${skill.skillId}">${skill.skillName}</div>`);
                });
            });
        });

        $(document).on('click', '.skill-item', function(){
            let skillId = $(this).data('id');
            let skillName = $(this).text();
            // Vérifiez si la compétence est déjà sélectionnée
            if (!$(`#selected-skills .selected-skill[data-id="${skillId}"]`).length) {
                $('#selected-skills').append(`<div class="selected-skill" data-id="${skillId}">${skillName}</div>`);
            }
        });
    });

    


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

    $(document).ready(function() {
        // Écouteur d'événement pour détecter les changements dans la barre de recherche
        $('#search-input').on('input', function() {
            // Masquer la section "Pour vous" par défaut
            $('#result-section').hide();

            var searchText = removeAccents($(this).val().trim().toLowerCase());

            // Parcours de chaque mission pour filtrer celles qui correspondent à la recherche
            var anyFreelancerFound = false;
            $('.freelancer-item').each(function() {
                var freelancerFirstName = removeAccents($(this).data('freelancer-first-name').toLowerCase());
                var freelancerLastName = removeAccents($(this).data('freelancer-last-name').toLowerCase());
                var freelancerFullName = freelancerFirstName + ' ' + freelancerLastName;
                if (freelancerFullName.includes(searchText)) {
                    $(this).show(); // Affiche la mission si elle correspond à la recherche
                    anyFreelancerFound = true;
                } else {
                    $(this).hide(); // Masque la mission si elle ne correspond pas à la recherche
                }
            });

            // Afficher ou masquer la section "Aucune mission n'a été trouvée" en fonction des résultats de la recherche
            if (anyFreelancerFound) {
                $('#no-freelancer-found').hide();
                $('#result-section').show();
            } else {
                $('#no-freelancer-found').show();
                $('#result-section').hide();
            }
        });

    });

    // Fonction pour supprimer les accents d'une chaîne de caractères
    function removeAccents(str) {
        return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    }
</script>

