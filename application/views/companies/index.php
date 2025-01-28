<?php
$currentPage = 'companies';


// Header Call
include(APPPATH . 'views/layouts/user/header.php');
?>
<head>
    <title> Café Crème Community </title>

<style>
    #cities-list {
    max-height: 200px; /* ou toute autre valeur appropriée */
    overflow-y: auto;
    /* Ajoutez d'autres styles si nécessaire */
}
.has-border {
    border: 1px solid #e2e8f0; /* Couleur de bordure exemple */
}
</style>
<link rel="stylesheet" href="<?php echo base_url('assets/css/nouislider.min.css');?>">
<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('/node_modules/choices.js/public/assets/styles/choices.min.css');?>" rel="stylesheet" type="text/css">


</head>   
<?php
if ($banner->bannerStatus == "active"){ ?>
<div id="sticky-banner" tabindex="-1" class="fixed top-0 left-0 z-50 mt-4 flex justify-between w-full p-4 border-b border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
    <div class="flex items-center mx-auto">
        <p class="flex items-center  font-normal text-gray-500 dark:text-white">
            <span class="inline-flex p-1 mr-3 bg-gray-200 rounded-full dark:bg-gray-600 w-6 h-6 items-center justify-center">
                <svg class="w-3 h-3 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 19">
                    <path d="M15 1.943v12.114a1 1 0 0 1-1.581.814L8 11V5l5.419-3.871A1 1 0 0 1 15 1.943ZM7 4H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2v5a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V4ZM4 17v-5h1v5H4ZM16 5.183v5.634a2.984 2.984 0 0 0 0-5.634Z"/>
                </svg>
                <span class="sr-only">Light bulb</span>
            </span>
            <span><?= $banner->bannerMessage?> <a href="<?=$banner->bannerLink?>" class="inline font-medium text-primary underline dark:text-primary underline-offset-2 decoration-600 dark:decoration-500 decoration-solid hover:no-underline" target ="_blank"><?=$banner->bannerCta?></a></span>
        </p>
    </div>
    <div class="flex items-center">
        <button data-dismiss-target="#sticky-banner" type="button" class="flex-shrink-0 inline-flex justify-center w-7 h-7 items-center text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Fermer</span>
        </button>
    </div>
</div>
<?php } ?>



<!-- <div class="absolute hidden top-0 right-4 mt-4 mb-4">
    <svg id="heart" class="w-5 h-5 text-red-600 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 30" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.879c-2.484-4.375-12-1.82-12 4.879 0 5.572 5.126 7.664 12 14.121 6.874-6.457 12-8.549 12-14.121 0-6.699-9.516-9.254-12-4.879z"/>
    </svg>
</div> -->
<div class="px-8 py-6 lg:px-4 lg:py-6 lg:h-90 lg:overflow-y-auto no-scrollbar ">
    <div class="justify-between items-center mx-auto max-w-screen-xl">
        <div class="lg:flex gap-6 mb-3">
            <div class="w-full lg:w-1/4 md:block md:top-0">
            <!-- Button to show the filter block on mobile -->
                <div class="relative text-right mb-4 lg:hidden">
                    <button id="showFilterButton" class="relative text-4xl text-primary border p-2 border-primary  rounded-lg 2 hover:bg-primary-900 hover:text-white">
                        <i class="fas fa-sliders-h"></i>
                    </button>
                </div>
                <div class="hidden lg:block bg-white rounded-lg lg:h-full lg:overflow-y-auto no-scrollbar lg:no-shadow shadow-lg mb-8 lg:mb-4 p-4 dark:bg-gray-800 dark:text-white" id="FilterMission">
                    <h3 class="text-3xl lg:text-lg font-medium mt-2">Filtre</h3>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Localisation</h4>
                        <div class="flex items-center mt-2">
                            <i class="fa fa-map-marker-alt mr-3"></i>    
                            <div class="relative city-search-container w-full">
                                <input type="text" id="citySearch" value="<?=$user->userVille?>" placeholder="Search your city" class="text-3xl lg:text-lg border p-2 rounded-lg w-full text-black">
                                    <div id="cities-list" class="absolute z-10 mt-2 w-full  rounded bg-white max-h-64 overflow-y-auto text-black"></div>
                            </div>
                        </div>
                    <h4 class="text-3xl lg:text-lg font-medium mt-4">Activity sectors</h4>
                    <div class="w-full mx-auto mt-5 text-black">
                        <!-- <label for="skillsAll" class="block text-sm font-medium text-gray-700">Sélectionnez vos compétences</label> -->
                        <select id="secteursAll" name="secteursAll[]" multiple class="text-3xl lg:text-base mt-1 block w-full py-2 px-3 border border-gray-300 bg-white text-black rounded-full shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <?php foreach ($secteursAll as $secteur): ?>
                                <option class="text-3xl lg:text-base text-black" value="<?= $secteur['secteurId'] ?>">
                                    <?= $secteur['secteurName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="flex justify-between mt-6">
                        <button id="resetFiltersButton" class="text-3xl lg:text-base text-primary border border-primary px-4 py-1 rounded-full 2 hover:bg-primary-900 hover:text-white">Reset</button>
                    </div>

                    

                
                    <!-- <div class="flex justify-between mt-10">
                        <button class="px-4 py-2 rounded-full border border-primary text-primary">Effacer</button>
                        <button class="px-4 py-2 rounded-full bg-primary text-white">Appliquer</button>
                    </div> -->
                </div>
                
            </div>
            <div class="w-full lg:overflow-y-auto no-scrollbar">
                <div class="bg-primary rounded-lg h-20vh p-4 text-white">
                    <p class="text-3xl lg:text-lg font-bold">Hello, <?=$user->userFirstName?></p>
                    <p class="text-3xl lg:text-base font-normal mt-2 mb-2">Discover companies</p>

                    <div class="flex w-full">
                        <input type="text" id="search-input" class="text-3xl lg:text-base w-full bg-white bg-opacity-20 rounded-lg p-2 placeholder-white mr-2 text-center" placeholder="Enter the name of the company you are looking for..." />
                        <!-- <button class="w-1/5 bg-white text-primary rounded-lg px-4 py-2">Rechercher</button> -->
                    </div>
                </div>
                <h3 class="text-5xl lg:text-2xl font-medium mt-4 mb-4" id="result-section">For you:</h3>
                <div class="flex flex-wrap" id="companies-section">
                    <?php foreach($companies as $company): ?>
                        <a href="<?=base_url('user/companyView/'.$company->idCompany)?>" 
                            class="company-item w-full" 
                            data-company-name="<?=strtolower($company->companyName)?>"
                            data-company-localisation="<?=strtolower($company->companyLocalisation)?>"
                            data-company-secteur="<?=$company->secteurId?>"> 
                            <div class="bg-white rounded-lg w-full h-20vh mt-4 p-4 dark:bg-gray-800 dark:text-white relative company-item" data-company-name="<?=strtolower($company->companyName)?>" data-company-localisation="<?=$company->companyLocalisation?>" data-company-secteur="<?=$company->secteurId?>">
                                <div class="flex items-center">
                                    <div class="mr-4">
                                        <img src="<?=base_url($company->companyLogoPath)?>" alt="Logo de l'entreprise" class="object-cover w-16 h-16 lg:w-10 rounded-full">
                                    </div>
                                    <div class="w-3/4 mr-4">
                                        <h2 class="text-3xl lg:text-lg font-bold"><?=$company->companyName?></h2>
                                        <p class="text-3xl lg:text-base">
                                            <span class="mr-2"> • <?=$company->companyLocalisation?></span>
                                            
                                            <span class="mr-2"> • <?=$company->secteurName?></span>

                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="font-normal text-3xl lg:text-base mt-4 mb-4">
                                        <p class="font-normal text-3xl lg:text-base mt-4 mb-4">
                                            <?php 
                                            // limit missionDescription to 270 caracteres and add '...' at the end
                                            $company->companyDescription = strlen($company->companyDescription) > 270 ? substr($company->companyDescription,0,270)."..." : $company->companyDescription;    
                                            ?>
                                            <?=$company->companyDescription?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                    </div>
                    <div id="no-company-found">
                        <p class="text-3xl lg:text-lg mt-6 text-left">No companies were found.</p>
                        <h3 class="text-5xl lg:text-2xl font-medium mt-10" id="result-section">Other companies:</h3>
                        <?php foreach($companies as $company): ?>
                            <a href="<?=base_url('user/companyView/'.$company->idCompany)?>" 
                                class="w-full" > 
                                <div class="bg-white rounded-lg h-20vh mt-4 p-4 dark:bg-gray-800 dark:text-white relative">
                                    <div class="flex items-center">
                                        <div class="mr-4">
                                            <img src="<?=base_url($company->companyLogoPath)?>" alt="Logo de l'entreprise" class="object-cover w-16 h-16 lg:w-10 rounded-full">
                                        </div>
                                        <div class="w-3/4 mr-4">
                                            <h2 class="text-3xl lg:text-lg font-bold"><?=$company->companyName?></h2>
                                            <p class="text-3xl lg:text-base">
                                                <span class="mr-2"> • <?=$company->companyLocalisation?></span>
                                                
                                                <span class="mr-2"> • <?=$company->companySecteur?></span>

                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-3xl lg:text-base flex items-center justify-between">
                                        <div class="mt-4">
                                            <p class="font-light mt-4 mb-4 text-3xl lg:text-base">
                                                <?php 
                                                // limit missionDescription to 270 caracteres and add '...' at the end
                                                $company->companyDescription = strlen($company->companyDescription) > 270 ? substr($company->companyDescription,0,270)."..." : $company->companyDescription;    
                                                ?>
                                                <?=$company->companyDescription?>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
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



    //Script selection des compétences
    const secteursChoices = new Choices('#secteursAll', {
        searchEnabled: true,
        removeItemButton: true,
        itemSelectText: '',
        placeholder: true, // Ajoutez cette ligne pour activer le placeholder
        placeholderValue: 'Select sectors', // Texte du placeholder

    });
    
    $(document).ready(function(){
        $('#search-input-skill').on('keyup', function(){
            let term = $(this).val();
            $.post('user/search_skills', { term: term }, function(data){
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

    document.addEventListener("DOMContentLoaded", function(event) {
        document.getElementById('updateProductButton').click();
    });
    $(document).ready(function() {
        // Écouteur d'événement pour détecter les changements dans la barre de recherche
        $('#search-input').on('input', function() {
            // Masquer la section "Pour vous" par défaut
            $('#result-section').hide();

            var searchText = removeAccents($(this).val().trim().toLowerCase());

            // Parcours de chaque mission pour filtrer celles qui correspondent à la recherche
            var anyCompanyFound = false;
            $('.company-item').each(function() {
                var companyName = removeAccents($(this).data('company-name').toLowerCase());
                if (companyName.includes(searchText)) {
                    $(this).show(); // Affiche la mission si elle correspond à la recherche
                    anyCompanyFound = true;
                } else {
                    $(this).hide(); // Masque la mission si elle ne correspond pas à la recherche
                }
            });

            if (anyCompanyFound) {
                $('#no-company-found').hide();
                $('#result-section').show();
            } else {
                $('#no-company-found').show();
                $('#result-section').hide();
            }
        });

        
    });

    // Fonction pour supprimer les accents d'une chaîne de caractères
    function removeAccents(str) {
        return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    }

    // JavaScript code for handling active filters
document.addEventListener("DOMContentLoaded", function() {

    $('#secteursAll').on('change', function() {
        filterCompanies();
    });

    document.getElementById("citySearch").addEventListener("keyup", filterCompanies);


    $(document).ready(function() {
        $('#resetFiltersButton').on('click', function() {
            // Réinitialisez les filtres en décochant toutes les cases à cocher

            $('#citySearch').val('');

            secteursChoices.removeActiveItems();
            filterCompanies();
        });
    });

    function filterCompanies() {
        const missions = document.querySelectorAll(".company-item");
        const cityInput = document.getElementById("citySearch");
        const cityFilter = cityInput.value.toLowerCase();
        const selectedSkills = $('#secteursAll').val();
        
        let visibleMissionsCount = 0;

        missions.forEach(function(mission) {
            const missionName = mission.getAttribute("data-mission-name");
            const missionLocalisation = mission.getAttribute("data-company-localisation").toLowerCase();
            const missionSkillsAttr = mission.getAttribute("data-company-secteur");
            // console.log("secteur :",missionSkillsAttr);

            let showMission = true;

            // Filtre par ville
            if (cityFilter && !missionLocalisation.includes(cityFilter)) {
                showMission = false;
            }

            // Filtre par compétences
            if (selectedSkills.length > 0) {
                //const missionSkills = missionSkillsAttr.split(','); // Divise la chaîne en un tableau d'IDs de compétences
                // console.log("1 :",missionSkillsAttr);
                // console.log("2 :",selectedSkills);
                const matchesSkills = selectedSkills.some(function(selectedSkill) {
                    return missionSkillsAttr.includes(selectedSkill);
                });
                if (!matchesSkills) {
                    showMission = false;
                }
            }

            mission.style.display = showMission ? "block" : "none";

            if (showMission) {
                visibleMissionsCount++;
            }
        });

        const noMissionFound = document.getElementById("no-company-found");
        noMissionFound.style.display = visibleMissionsCount === 0 ? "block" : "none";

    }

    filterCompanies();
});

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