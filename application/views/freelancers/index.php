<?php
$currentPage = 'freelancers';


// Header Call
include(APPPATH . 'views/layouts/company/header.php');
?>
    <title> Café Crème Community </title>

<link rel="stylesheet" href="<?php echo base_url('assets/css/nouislider.min.css');?>">
<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('/node_modules/choices.js/public/assets/styles/choices.min.css');?>" rel="stylesheet" type="text/css">


<div class="px-4 lg:px-6 py-6 h-90 overflow-y-auto no-scrollbar">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl h-full">
        <div class="w-full flex gap-6 h-full mb-3">
            <div class="w-1/4 sticky top-0">
                <div class="bg-white rounded-lg h-full overflow-y-auto no-scrollbar mb-4 p-4 dark:bg-gray-800 dark:text-white">
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
                            <input type="checkbox" class="form-checkbox mr-2" id="junior">
                            <span class="ml-2">Junior (1 à 2 ans)</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox mr-2" id="intermediaire">
                            <span class="ml-2">Intermédiaire (3 à 5 ans)</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox mr-2" id="expert">
                            <span class="ml-2">Expert (+ 5 ans)</span>
                        </label>
                    </div>
                    <h4 class="text-lg font-medium mt-4">Disponibilité</h4>
                    <div class="mt-2">
                        <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox mr-2" id="available">
                            <span class="ml-2">Disponible</span>
                        </label>
                        <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox mr-2" id="unavailable">
                            <span class="ml-2">Non disponible</span>
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
                    <h4 class="text-lg font-medium mt-4">Métiers</h4>
                    <div class="w-full max-w-xs mx-auto mt-5 text-black">
                        <!-- <label for="skillsAll" class="block text-sm font-medium text-gray-700">Sélectionnez vos compétences</label> -->
                        <select id="jobsAll" name="jobsAll[]" multiple class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white text-black rounded-full shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <?php foreach ($jobsAll as $job): ?>
                                <option class="text-black" value="<?= $job['jobId'] ?>"><?= $job['jobName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!--<div class="flex justify-between mt-10">
                        <button id="resetFiltersButton" class="px-4 py-2 rounded-full border border-primary text-primary">Effacer</button>
                    </div>-->
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
                        <?php $freelancerSkillsArray = array(); ?>
                        <?php foreach ($freelancer_skills[$freelancer->userId] as $skill): ?>
                            <?php $freelancerSkillsArray[] = $skill->skillId; ?>
                        <?php endforeach; ?>
                        <a href="<?=base_url('company/freelancerView/'.$freelancer->userId)?>" 
                            class=" ">                            
                            <div class="bg-white rounded-lg h-20vh mt-4 p-4 dark:bg-gray-800 dark:text-white relative freelancer-item" 
                            data-freelancer-firstname="<?=strtolower($freelancer->userFirstName)?>" 
                            data-freelancer-lastname="<?=strtolower($freelancer->userLastName)?>" 
                            data-freelancer-city="<?=strtolower($freelancer->userVille)?>" 
                            data-freelancer-time="<?=strtolower($freelancer->userJobTimePartielOrFullTime)?>" 
                            data-freelancer-remote="<?=strtolower($freelancer->userRemote)?>" 
                            data-freelancer-expertise="<?=strtolower($freelancer->userExperienceYear)?>" 
                            data-freelancer-isavailable="<?=$freelancer->userIsAvailable?>"
                            data-freelancer-tjm="<?=$freelancer->userTJM?>" 
                            data-freelancer-job="<?php foreach ($freelancer_job[$freelancer->userId] as $job): ?><?=$job->jobId?><?php endforeach; ?>"
                            data-freelancer-skills="<?= implode(',', $freelancerSkillsArray) ?>">
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
                                        <?php foreach ($freelancer_job[$freelancer->userId] as $job): ?>
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
                                            </span>

                                            <?php
                                            if($freelancer->userRemote == 1){
                                            ?>
                                            <span class="mr-2"> • Remote </span>
                                            <?php
                                            }
                                            ?>
                                            <span class="mr-2"> • <?=$freelancer->userVille?></span>
                                            <span class="mr-2"> •
                                            <?php
                                                if ($freelancer->userExperienceYear == "junior"){
                                                    $freelancer->userExperienceYear = "Junior";
                                                }
                                                elseif ($freelancer->userExperienceYear == "intermediaire"){
                                                    $freelancer->userExperienceYear = "Intermédiaire";
                                                }
                                                elseif ($freelancer->userExperienceYear == "expert"){
                                                    $freelancer->userExperienceYear = "Expert";
                                                }
                                            ?>
                                            <?=$freelancer->userExperienceYear?>
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
                                
                                <div class="skills-container mb-4">
                                    <?php
                                    if (is_array($freelancer_skills[$freelancer->userId]) && !empty($freelancer_skills[$freelancer->userId])) {
                                    foreach ($freelancer_skills[$freelancer->userId] as $skill) {
                                        $level = '';
                                        $color = '';
                                        switch ($skill->userSkillsExperience) {
                                            case 1:
                                                $level = 'Junior';
                                                $color = '#BEE3F8'; // Couleur pour le niveau junior
                                                $text = "text-black";
                                                $textdark = "text-black";
                                                break;
                                            case 2:
                                                $level = 'Intermédiaire';
                                                $color = '#63B3ED'; // Couleur pour le niveau intermédiaire
                                                $text = "text-black";
                                                $textdark = "text-white";
                                                break;
                                            case 3:
                                                $level = 'Expert';
                                                $color = '#2C5282'; // Couleur pour le niveau confirmé
                                                $text = "text-white";
                                                $textdark = "text-white";
                                                break;

                                            default:
                                                $level = 'N/A'; // Si la valeur de userSkillsExperience n'est pas valide, afficher "N/A"
                                                break;
                                        }
                                    ?>
                                        <div class="skill-item" data-level="<?=$level?>">
                                            <span class="dark:<?=$textdark?> inline-block px-4 py-1 rounded-full <?=$text?>" style="background-color:<?=$color?>;"><?=$skill->skillName?></span>
                                            <div class="skill-level"><?=$level?></div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <?php } ?>
                                    
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                    </div>
                    <p class="text-xl mt-10 hidden text-left" id="no-freelancer-found">Aucun freelance n'a été trouvée.</p>
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

    $(document).ready(function() {
        
        $('#citySearch').on('keyup', function() {
            let term = $(this).val();
            if(term.length > 2) { // Recherche après 2 caractères
                $.post('company/search_cities', { term: term }, function(data) {
                    let cities = JSON.parse(data);
                    if(cities.length > 0) {
                        // Ajoutez la classe .has-border si des résultats sont retournés
                        $('#cities-list').addClass('has-border');
                    } else {
                        // Supprimez la classe .has-border si aucun résultat n'est retourné
                        $('#cities-list').removeClass('has-border');
                    }
                    $('#cities-list').empty();
                    cities.forEach(function(city) {
                        $('#cities-list').append(`<div class="city-item p-2 hover:bg-gray-200 cursor-pointer" data-id="${city.geoname_id}">${city.name}</div>`);
                    });
                });
            }
            else {
                // Supprimez la classe .has-border si l'input est trop court
                $('#cities-list').removeClass('has-border').empty();
            }
        });

        $(document).on('click', '.city-item', function() {
            let cityName = $(this).text();
            $('#citySearch').val(cityName);  // Mettez à jour le champ de saisie avec le nom de la ville sélectionnée
            $('#cities-list').empty(); // Videz la liste
            $('#cities-list').removeClass('has-border').empty();
        });

        // Pour fermer la liste lorsque vous cliquez en dehors
        $(document).on('click', function(event) {
            // Si le clic n'est pas sur le champ de saisie (#citySearch)
            // et n'est pas sur un élément à l'intérieur de la liste (#cities-list)...
            if (!$(event.target).closest('#citySearch, #cities-list').length) {
                // ... alors videz et fermez la liste.
                $('#cities-list').empty().removeClass('has-border');
            }
        });

    });

        //Script selection des métiers
        const jobsChoices = new Choices('#jobsAll', {
        searchEnabled: true,
        removeItemButton: true,
        itemSelectText: '',
        placeholder: true, // Ajoutez cette ligne pour activer le placeholder
        placeholderValue: 'Sélectionnez des compétences', // Texte du placeholder

    });

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
        noUiSlider.create(slider, {
            start: [500, 950],
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
                var freelancerFirstName = removeAccents($(this).data('freelancer-firstname').toLowerCase());
                var freelancerLastName = removeAccents($(this).data('freelancer-lastname').toLowerCase());
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


    document.addEventListener("DOMContentLoaded", function() {
    var slider = document.getElementById('tjm-slider');
    const checkboxes = document.querySelectorAll(".form-checkbox");

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener("change", filterFreelancers);
    });

    $('#skillsAll').on('change', function() {
        filterFreelancers();
    });

    $('#jobsAll').on('change', function() {
        filterFreelancers();
    });

    slider.noUiSlider.on("change", filterFreelancers);

    document.getElementById("citySearch").addEventListener("keyup", filterFreelancers);

/*
    $(document).ready(function() {
        $('#resetFiltersButton').on('click', function() {
            // Réinitialisez les filtres en décochant toutes les cases à cocher
            $('.form-checkbox').prop('checked', false);

            $('#citySearch').val('');

            // Réinitialisez les valeurs des sélecteurs de compétences et de métiers
            skillsChoices.clearStore();
            skillsChoices.setChoices([], 'value', 'label', false); // Effacez toutes les options sélectionnées
            jobsChoices.clearStore();
            jobsChoices.setChoices([], 'value', 'label', false); // Effacez toutes les options sélectionnées

            var slider = document.getElementById('tjm-slider');
            var defaultTJMValues = [300, 1200]; // Valeurs par défaut
            slider.noUiSlider.set(defaultTJMValues);

            filterFreelancers();
        });
    });
*/
    function filterFreelancers() {
        const freelancers = document.querySelectorAll(".freelancer-item");
        const activeFilters = [];
        const cityInput = document.getElementById("citySearch");
        const cityFilter = cityInput.value.toLowerCase();
        const tjmValues = slider.noUiSlider.get();
        const tjmMin = parseInt(tjmValues[0]);
        const tjmMax = parseInt(tjmValues[1]);
        const selectedSkills = $('#skillsAll').val();
        const selectedJobs = $('#jobsAll').val();
    

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                activeFilters.push(checkbox.id);
            }
        });

        const expertiseFilters = []; // Tableau pour stocker les filtres d'expertise sélectionnés

        // Remplissez expertiseFilters avec les filtres d'expertise sélectionnés
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked && (checkbox.id === "junior" || checkbox.id === "intermediaire" || checkbox.id === "expert")) {
                expertiseFilters.push(checkbox.id);
            }
        });

        let visibleFreelancersCount = 0;

        freelancers.forEach(function(freelancer) {
            //const missionName = mission.getAttribute("data-mission-name");
            const freelancerTime = freelancer.getAttribute("data-freelancer-time");
            const freelancerRemote = freelancer.getAttribute("data-freelancer-remote");
            const freelancerExpertise = freelancer.getAttribute("data-freelancer-expertise");
            const freelancerCity = freelancer.getAttribute("data-freelancer-city").toLowerCase();
            const freelancerIsAvailable = freelancer.getAttribute("data-freelancer-isavailable");
            const freelancerJobAttr = freelancer.getAttribute("data-freelancer-job");
            const freelancerJob = freelancerJobAttr.split(',');
            const freelancerSkillsAttr = freelancer.getAttribute("data-freelancer-skills");
            const freelancerTJM = parseInt(freelancer.getAttribute("data-freelancer-tjm"));

            let showFreelancer = true;  
            activeFilters.every(function(filter) {
                if (filter === "temps-plein" && freelancerTime !== "temps-plein") showFreelancer = false;
                if (filter === "remote" && freelancerRemote !== "1") showFreelancer = false;
                if (filter === "temps-partiel" && freelancerTime !== "temps-partiel") showFreelancer = false;
                if (filter === "available" && freelancerIsAvailable !== "1") showFreelancer = false;
                if (filter === "unavailable" && freelancerIsAvailable !== "0") showFreelancer = false;
                return true;
            });

            // Filtre par expertise
            let matchesExpertise = true;
            if (expertiseFilters.length > 0) {
                matchesExpertise = expertiseFilters.some(function(filter) {
                    return (
                        (filter === "junior" && freelancerExpertise === "junior") ||
                        (filter === "intermediaire" && freelancerExpertise === "intermediaire") ||
                        (filter === "expert" && freelancerExpertise === "expert")
                    );
                });
            }
            showFreelancer = showFreelancer && matchesExpertise;

            // Filtre par ville
            if (cityFilter && !freelancerCity.includes(cityFilter)) {
                showFreelancer = false;
            }
                    
            // Filtre par métier
            if (selectedJobs.length > 0) {
                const matchesJob = selectedJobs.some(function(selectedJob) {
                    return freelancerJob.includes(selectedJob);
                });
                if (!matchesJob) {
                    showFreelancer = false;
                }
            }

            // Filtre par compétences
            if (selectedSkills.length > 0) {
                const freelancerSkills = freelancerSkillsAttr.split(','); // Divise la chaîne en un tableau d'IDs de compétences
                const matchesSkills = selectedSkills.some(function(selectedSkill) {
                    return freelancerSkills.includes(selectedSkill);
                });
                if (!matchesSkills) {
                    showFreelancer = false;
                }
            }


            if (freelancerTJM < tjmMin || freelancerTJM > tjmMax) {
                showFreelancer = false;
            }

            freelancer.style.display = showFreelancer ? "block" : "none";

            if (showFreelancer) {
                visibleFreelancersCount++;
            }
        });

        const noFreelancerFound = document.getElementById("no-freelancer-found");
        noFreelancerFound.style.display = visibleFreelancersCount === 0 ? "block" : "none";
    }
});

</script>

