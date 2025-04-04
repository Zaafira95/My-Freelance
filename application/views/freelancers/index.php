<?php
$currentPage = 'freelancers';


// Header Call
include(APPPATH . 'views/layouts/company/header.php');
?>
    <title> My Freelance </title>

<link rel="stylesheet" href="<?php echo base_url('assets/css/nouislider.min.css');?>">
<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('/node_modules/choices.js/public/assets/styles/choices.min.css');?>" rel="stylesheet" type="text/css">


<div class="px-8 py-6 lg:px-4 lg:py-6 h-90 lg:overflow-y-auto no-scrollbar ">
    <div class="justify-between items-center mx-auto max-w-screen-xl h-full">
        <div class="lg:flex gap-6 h-full mb-3">
            <div class="w-full lg:w-1/4 md:block">
                <div class="relative text-right mb-4 lg:hidden">
                    <button id="showFilterButton" class="relative text-4xl text-primary border p-2 border-primary  rounded-lg 2 hover:bg-primary-900 hover:text-white">
                        <i class="fas fa-sliders-h"></i>
                    </button>
                </div>
                <div class="hidden lg:block bg-white rounded-lg lg:h-full overflow-y-auto no-scrollbar lg:no-shadow shadow-lg mb-8 lg:mb-4 p-4 dark:bg-gray-800 dark:text-white" id="FilterMission">
                    <h3 class="text-3xl lg:text-lg font-medium mt-2">Filters</h3>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Location</h4>
                    <div class="w-full mx-auto mt-2 text-black">
                        <select id="countriesAll" name="countriesAll[]" multiple class="text-3xl lg:text-base mt-1 block w-full py-2 px-3 border border-gray-300 bg-white text-black rounded-full shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <?php foreach ($countriesAll as $country): ?>
                                <option class="text-black" value="<?= $country['idCountry'] ?>">
                                    <?= $country['countryName'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Job type</h4>
                    <div class="mt-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="temps-plein">
                            <span class="ml-2 text-3xl lg:text-base">Full-time</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="temps-partiel">
                            <span class="ml-2 text-3xl lg:text-base">Part-time</span>
                        </label>
                    </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Work mode</h4>
                    <div class="mt-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="site">
                            <span class="ml-2 text-3xl lg:text-base">On-site</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="teletravail">
                            <span class="ml-2 text-3xl lg:text-base">Remote</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="hybride">
                            <span class="ml-2 text-3xl lg:text-base">Hybrid</span>
                        </label>
                    </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Experience level</h4>
                    <div class="mt-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="junior">
                            <span class="ml-2 text-3xl lg:text-base">Junior (1 to 2 years)</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="intermediaire">
                            <span class="ml-2 text-3xl lg:text-base">Intermediate (3 to 5 years)</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="expert">
                            <span class="ml-2 text-3xl lg:text-base">Expert (5+ years)</span>
                        </label>
                    </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Availability</h4>
                    <div class="mt-2">
                        <label class="flex items-center">
                        <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="available">
                            <span class="ml-2 text-3xl lg:text-base">Available</span>
                        </label>
                        <label class="flex items-center">
                        <input type="checkbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox mr-2" id="unavailable">
                            <span class="ml-2 text-3xl lg:text-base">Unvailable</span>
                        </label>
                    </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">TJM</h4>
                    <div class="mt-2 mr-3">
                        <div id="tjm-slider" class="w-full mt-2"></div>
                        <div class="flex justify-between mt-2">
                            <span id="tjm-min" class="text-3xl lg:text-base">300AED</span>
                            <span id="tjm-max" class="text-3xl lg:text-base">1200AED</span>
                        </div>
                    </div>
                
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Skills</h4>
                    <div class="w-full mx-auto mt-5 text-black">
                        <select id="skillsAll" name="skillsAll[]" multiple class="text-3xl lg:text-base mt-1 block w-full py-2 px-3 border border-gray-300 bg-white text-black rounded-full shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <?php foreach ($skillsAll as $skill): ?>
                                <option class="text-black" value="<?= $skill['skillId'] ?>"><?= $skill['skillName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Jobs</h4>
                    <div class="w-full mx-auto mt-5 text-black">
                        <select id="jobsAll" name="jobsAll[]" multiple class="text-3xl lg:text-base mt-1 block w-full py-2 px-3 border border-gray-300 bg-white text-black rounded-full shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <?php foreach ($jobsAll as $job): ?>
                                <option class="text-black" value="<?= $job['jobId'] ?>"><?= $job['jobName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="flex justify-between mt-6">
                        <button id="resetFiltersButton" class="text-3xl lg:text-base text-primary border border-primary px-4 py-1 rounded-full 2 hover:bg-primary-900 hover:text-white">Reset</button>
                    </div>
                </div>
                
            </div>
            <div class="w-full h-full overflow-y-auto no-scrollbar">
                <div class="bg-primary rounded-lg h-20vh p-4 text-white">
                    <p class="text-3xl lg:text-lg font-bold">Hello, <?=$user->userFirstName?></p>
                    <p class="text-3xl lg:text-base mt-2 mb-2">Discover the fastest and most efficient way to find your freelancer.</p>
                    <div class="flex w-full">
                        <input type="text" id="search-input" class="text-3xl lg:text-base w-full bg-white bg-opacity-20 rounded-lg p-2 placeholder-white mr-2 text-center" placeholder="Enter the name of the freelancer you are looking for..." />
                        <!-- <button class="w-1/5 bg-white text-primary rounded-lg px-4 py-2">Rechercher</button> -->
                    </div>
                </div>
                <h3 class="text-5xl lg:text-2xl font-medium mt-4" id="result-section">For you:</h3>
                <div class="flex flex-wrap" id="freelancers-section">

                    <?php foreach($freelancers as $freelancer): ?>
                        <?php $freelancerSkillsArray = array(); ?>
                        <?php foreach ($freelancer_skills[$freelancer->userId] as $skill): ?>
                            <?php $freelancerSkillsArray[] = $skill->skillId; ?>
                        <?php endforeach; ?>
                        <a href="<?=base_url('company/freelancerView/'.$freelancer->userId)?>" 
                            class="w-full">                            
                            <div class="bg-white rounded-lg h-20vh mt-4 p-4 w-full dark:bg-gray-800 dark:text-white relative freelancer-item" 
                            data-freelancer-firstname="<?=strtolower($freelancer->userFirstName)?>" 
                            data-freelancer-lastname="<?=strtolower($freelancer->userLastName)?>"
                            data-freelancer-localisation="<?=$freelancer->userCountryId?>"
                            data-freelancer-time="<?=strtolower($freelancer->userJobTimePartielOrFullTime)?>" 
                            data-freelancer-mode="<?=strtolower($freelancer->userJobType)?>" 
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
                                        <img src="<?php echo base_url($freelancer->userAvatarPath); ?>" alt="Avatar" class="object-cover w-16 h-16 lg:w-10 rounded-full">
                                    </div>
                                   
                                    <div class="w-3/4 mr-4">
                                        <div class="flex flex-1 mb-1">
                                            <h2 class="text-3xl lg:text-lg font-bold mr-4"><?=$freelancer->userFirstName.' '.$freelancer->userLastName?> </h2>
                                            <?php
                                                if($freelancer->userIsAvailable == 1){
                                            ?>
                                            <div class="flex items-center space-x-1 bg-green-100 text-green-800 text-xl lg:text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-300 dark:text-green-900">
                                                <div class="w-2 h-2 lg:h-2 lg:w-2 bg-green-500 rounded-full dark:bg-green-700"></div>
                                                <div>Available</div>
                                            </div>
                                            <?php
                                                } else {
                                            ?>
                                                <div class="flex items-center space-x-1 bg-red-100 text-red-800 text-xl lg:text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-300 dark:text-red-900">
                                                    <div class="w-2 h-2 lg:h-2 lg:w-2 bg-red-500 rounded-full dark:bg-red-700"></div>
                                                    <div>Unvailable</div>
                                                </div>
                                            <?php
                                                }
                                            ?> 
                                        </div>
                                        
                                        <p class="text-3xl lg:text-base">
                                            <?php foreach ($freelancer_job[$freelancer->userId] as $job): ?>
                                                <span class="mr-2"><?=$job->jobName?></span>
                                            <?php endforeach; ?>
                                                <span class="mr-2"> • Daily rate: <?=$freelancer->userTJM?> AED</span>
                                                <span class="mr-2"> •
                                                <?php
                                                if ($freelancer->userJobTimePartielOrFullTime == "temps-plein"){
                                                    $freelancer->userJobTimePartielOrFullTime = "Full-time";
                                                }
                                                elseif ($freelancer->userJobTimePartielOrFullTime == "temps-partiel"){
                                                    $freelancer->userJobTimePartielOrFullTime = "Part-time";
                                                }
                                                elseif ($freelancer->userJobTimePartielOrFullTime == "remote"){
                                                    $freelancer->userJobTimePartielOrFullTime = "Remote";
                                                }                                            
                                                ?>
                                                <?=$freelancer->userJobTimePartielOrFullTime?> 
                                                </span>

                                                <span class="mr-2"> •
                                                <?php
                                                if ($freelancer->userJobType == "Physique"){
                                                    $freelancer->userJobType = "On-site";
                                                }
                                                elseif ($freelancer->userJobType == "Remote"){
                                                    $freelancer->userJobType = "Remote";
                                                }
                                                elseif ($freelancer->userJobType == "Hybride"){
                                                    $freelancer->userJobType = "Hybrid";
                                                }                                            
                                                ?>
                                                <?=$freelancer->userJobType?> 
                                                </span>

                                                <span class="mr-2"> • <?=$freelancer->countryName?></span>
                                                <span class="mr-2"> •
                                                <?php
                                                    if ($freelancer->userExperienceYear == "junior"){
                                                        $freelancer->userExperienceYear = "Junior";
                                                    }
                                                    elseif ($freelancer->userExperienceYear == "intermediaire"){
                                                        $freelancer->userExperienceYear = "Intermediate";
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
                                    <div class="text-3xl lg:text-base mt-4">
                                        <p class="text-3xl lg:text-base font-light mt-4 mb-4">
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
                                    $count = 0;
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
                                                $level = 'Intermediate';
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
                                    <!-- Limiter les compétences à 6 -->
                                    <?php if ($count <= 5) { ?>
                                        <div class="skill-item" data-level="<?=$level?>">
                                            <span class="text-3xl lg:text-base dark:<?=$textdark?> inline-block px-4 py-1 rounded-full <?=$text?>" style="background-color:<?=$color?>;"><?=$skill->skillName?></span>
                                            <div class="skill-level"><?=$level?></div>
                                        </div>
                                    <?php
                                    $count++;
                                    } else {
                                        break;
                                    }
                                    }
                                    ?>
                                    <?php } ?>
                                    
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                    </div>
                        <p class="text-4xl lg:text-xl mt-10 hidden text-left" id="no-freelancer-found">No freelancers were found.</p>
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

    // When you click on showFilterButton the filter block appears in mobile version
    $('#showFilterButton').click(function() {
        $('#FilterMission').toggleClass('hidden');
    });


    function preventNumberInput(e) {
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return true;
        }
        return false;
    }

    $(document).ready(function() {
        
        $('#citySearch').on('keyup', function() {
            let term = $(this).val();
            if(term.length > 2) { // Recherche après 2 caractères
                $.post('search_cities', { term: term }, function(data) {
                    let cities = JSON.parse(data);
                    if(cities.length > 0) {
                        // Ajoutez la classe .has-border si des résultats sont retournés
                        $('#cities-list').addClass('has-border');
                    } else {
                        $('#cities-list').removeClass('has-border');
                    }
                    $('#cities-list').empty();
                    cities.forEach(function(city) {
                        $('#cities-list').append(`<div class="city-item p-2 hover:bg-gray-200 cursor-pointer" data-id="${city.geoname_id}">${city.name}</div>`);
                    });
                });
            }
            else {
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
        placeholderValue: 'Select Jobs', // Texte du placeholder

    });

    //Script selection des pays
    const countriesChoices = new Choices('#countriesAll', {
        searchEnabled: true,
        removeItemButton: true,
        itemSelectText: '',
        placeholder: true, // Ajoutez cette ligne pour activer le placeholder
        placeholderValue: 'Select country', // Texte du placeholder

    });

    //Script selection des compétences
    const skillsChoices = new Choices('#skillsAll', {
        searchEnabled: true,
        removeItemButton: true,
        itemSelectText: '',
        placeholder: true, // Ajoutez cette ligne pour activer le placeholder
        placeholderValue: 'Select Skills', // Texte du placeholder

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
            start: [300, 1200],
            connect: true,
            range: {
            'min': 300,
            'max': 1200
            },
            step: 10, // Ajout de la propriété step pour les tranches de 10
            format: {
            to: function(value) {
                return parseInt(value) + ' AED';
            },
            from: function(value) {
                return value.replace(' AED', '');
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
    
    $('#countriesAll').on('change', function() {
        filterFreelancers();
    });

    slider.noUiSlider.on("change", filterFreelancers);

    $(document).ready(function() {
        $('#resetFiltersButton').on('click', function() {
            // Réinitialisez les filtres en décochant toutes les cases à cocher
            $('.form-checkbox').prop('checked', false);

            skillsChoices.removeActiveItems();
            jobsChoices.removeActiveItems();
            countriesChoices.removeActiveItems();

            var slider = document.getElementById('tjm-slider');
            var defaultTJMValues = [300, 1200]; // Valeurs par défaut
            slider.noUiSlider.set(defaultTJMValues);

            filterFreelancers();
        });
    });
    function filterFreelancers() {
        const freelancers = document.querySelectorAll(".freelancer-item");
        const activeFilters = [];
        const tjmValues = slider.noUiSlider.get();
        const tjmMin = parseInt(tjmValues[0]);
        const tjmMax = parseInt(tjmValues[1]);
        const selectedSkills = $('#skillsAll').val();
        const selectedJobs = $('#jobsAll').val();
        const selectedCountry = $('#countriesAll').val();
    

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

        const typeFilters = []; // Tableau pour stocker les filtres d'expertise sélectionnés

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked && (checkbox.id === "temps-plein" || checkbox.id === "temps-partiel")) {
                typeFilters.push(checkbox.id);
            }
        });

        const modeFilters = []; // Tableau pour stocker les filtres d'expertise sélectionnés

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked && (checkbox.id === "site" || checkbox.id === "teletravail" || checkbox.id === "hybride")) {
                modeFilters.push(checkbox.id);
            }
        });

        const availableFilters = []; // Tableau pour stocker les filtres d'expertise sélectionnés

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked && (checkbox.id === "available" || checkbox.id === "unavailable")) {
                availableFilters.push(checkbox.id);
            }
        });

        let visibleFreelancersCount = 0;

        freelancers.forEach(function(freelancer) {
            const freelancerTime = freelancer.getAttribute("data-freelancer-time");
            const freelancerMode = freelancer.getAttribute("data-freelancer-mode");
            const freelancerExpertise = freelancer.getAttribute("data-freelancer-expertise");
            const freelancerLocalisation = freelancer.getAttribute("data-freelancer-localisation").toLowerCase();
            const freelancerIsAvailable = freelancer.getAttribute("data-freelancer-isavailable");
            const freelancerJobAttr = freelancer.getAttribute("data-freelancer-job");
            const freelancerJob = freelancerJobAttr.split(',');
            const freelancerSkillsAttr = freelancer.getAttribute("data-freelancer-skills");
            const freelancerTJM = parseInt(freelancer.getAttribute("data-freelancer-tjm"));

            let showFreelancer = true;  
            activeFilters.every(function(filter) {
                //if (filter === "temps-plein" && freelancerTime !== "temps-plein") showFreelancer = false;
                if (filter === "remote" && freelancerRemote !== "1") showFreelancer = false;
                //if (filter === "temps-partiel" && freelancerTime !== "temps-partiel") showFreelancer = false;
                //if (filter === "available" && freelancerIsAvailable !== "1") showFreelancer = false;
                //if (filter === "unavailable" && freelancerIsAvailable !== "0") showFreelancer = false;
                return true;
            });

           
            // Filtre par disponibilité
            let matchesAvailable = true;
            if (availableFilters.length > 0) {
                matchesAvailable = availableFilters.some(function(filter) {
                    return (
                        (filter === "available" && freelancerIsAvailable === "1") ||
                        (filter === "unavailable" && freelancerIsAvailable === "0")
                    );
                });
            }
            showFreelancer = showFreelancer && matchesAvailable; 
           
            // Filtre par temps de travail
            let matchesType = true;
            if (typeFilters.length > 0) {
                matchesType = typeFilters.some(function(filter) {
                    return (
                        (filter === "temps-plein" && freelancerTime === "temps-plein") ||
                        (filter === "temps-partiel" && freelancerTime === "temps-partiel")
                    );
                });
            }
            showFreelancer = showFreelancer && matchesType; 

            // Filtre par mode de travail
            let matchesMode = true;
            if (modeFilters.length > 0) {
                console.log(modeFilters);
                console.log(freelancerMode);
                matchesMode = modeFilters.some(function(filter) {
                    return (
                        (filter === "site" && freelancerMode === "physique") ||
                        (filter === "teletravail" && freelancerMode === "remote") ||
                        (filter === "hybride" && freelancerMode === "hybride")
                    );
                });
            }
            showFreelancer = showFreelancer && matchesMode; 

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
                                            
            // Filtre par pays
            if (selectedCountry.length > 0) {
                const matchesCountry = selectedCountry.some(function(selectedCountry) {
                    return freelancerLocalisation.includes(selectedCountry);
                });
                if (!matchesCountry) {
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

