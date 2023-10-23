<?php
// Header Call
$currentPage = 'mission';

include(APPPATH . 'views/layouts/company/header.php' );
?>
<head>
    <title> Poster une mission  </title>
    <link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('/node_modules/choices.js/public/assets/styles/choices.min.css');?>" rel="stylesheet" type="text/css">
</head>
<div class="px-4 lg:px-6 py-6 h-full overflow-y-auto no-scrollbar">
    <div class="flex flex-wrap justify-between mx-auto max-w-screen-xl h-full">
        <div class="flex h-full w-full mb-3">
            <div class="w-full flex gap-6 h-full mb-3">
                <div class="w-3/4 relative grid-cols-2 bg-white rounded-lg mb-4 dark:bg-gray-800 py-4 px-4 overflow-y-auto no-scrollbaroverflow-y-auto no-scrollbar">
                    <h1 class="text-2xl font-bold "> Poster une offre de mission </h1>
                    <form action="<?=base_url("company/addMission")?>" method="post" enctype="multipart/form-data">

                        <div class="flex flex-1 mt-4">
                            <input type="text" name="missionName" placeholder= "Titre de la mission" class="mr-3 w-full block  mb-4 border mt-2 border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required/>
                            <input type="number" name="missionTJM" placeholder="TJM €" class="block mb-4 border mt-2 border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required/>
                        </div>

                        <div>
                            <select id="jobsAll" name="jobsAll[]"  style="font-size:1rem;" class="block mr-3 mb-4 border mt-2 border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <?php foreach ($jobsAll as $joba): ?>
                                    <option class="dark:text-black" value="<?= $joba['jobId']?>"><?= $joba['jobName'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 

                        <div>
                        <div class="relative city-search-container w-full">
                            
                        </div> 
                        <p class="text-lg font-bold mt-4"> Localisation de la mission </p>
                        <div class="flex flex-1 mt-4">
                            <input type="text" name="missionLocation" id="citySearch" placeholder="Cherchez votre ville" class="border p-2 rounded-lg w-full text-black">
                                <div id="cities-list" class="absolute z-10 mt-2 w-full rounded bg-white max-h-64 overflow-y-auto text-black"></div>
                            </div>
                        
                            <p class="text-lg font-bold mt-4"> Durée de la mission </p>

                            <!-- <select id="missionDuration" name="missionDuration" class="w-full block mr-3 mb-4 border mt-2 border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <?php
                                // $missionDurationOption = ['Courte Durée', 'Longue Durée', 'Durée indéfinie'];
                                // foreach ($missionDurationOption as $missionDuration) {
                                //    echo '<option value="'.$missionDuration.'">'.$missionDuration.'</option>';
                                // }
                                ?>
                            </select> -->
                            <div class="flex mb-4">
                                <div class="flex flex-col w-full mr-4">
                                    <label for="missionDateDebut" class="block mt-4 mb-2 font-medium text-gray-900 dark:text-white">Date de début</label>
                                    <input type="date" id="missionDateDebut" name="missionDateDebut" class="w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>

                                <div class="flex flex-col w-full">
                                    <label for="missionDateFin" class="block mt-4 mb-2 font-medium text-gray-900 dark:text-white">Date de fin</label>
                                    <input type="date" id="missionDateFin" name="missionDateFin" class="w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                            </div>


                            <div class="flex flex-1">
                                <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700 w-full mr-4">
                                    <input id="bordered-checkbox-2" type="checkbox" value="Courte Durée" name="missionType[]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="bordered-checkbox-2" class="py-4 ml-2  font-medium text-gray-900 dark:text-white">Courte Durée</label>
                                </div>
                                <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700 w-full mr-4">
                                    <input id="bordered-checkbox-2" type="checkbox" value="Longue Durée" name="missionType[]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="bordered-checkbox-2" class="py-4 ml-2  font-medium text-gray-900 dark:text-white">Longue Durée</label>
                                </div>
                                <div class="flex items-center pl-4 border  border-gray-200 rounded dark:border-gray-700 w-full mr-4">
                                    <input id="bordered-checkbox-2" type="checkbox" value="Durée Indéfinie" name="missionType[]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="bordered-checkbox-2" class="py-4 ml-2  font-medium text-gray-900 dark:text-white">Durée indéfinie</label>
                                </div>
                            </div> 

                        </div>

                        <div>
                            <p class="text-lg font-bold mt-4"> Expérience requise </p>
                            <select id="missionExperience" name="missionExperience" class="w-full block mr-3 mb-4 border mt-2 border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <?php
                                $missionExperienceOptions = ['Junior (1 à 2 ans) ', 'Intermédiaire (3 à 5 ans)', 'Expert (+ 5 ans)'];
                                foreach ($missionExperienceOptions as $missionExperience) {
                                   echo '<option value="'.$missionExperience.'">'.$missionExperience.'</option>';
                                }
                                ?>
                            </select>   
                        </div>      
                        
                        <div id="skills-container">
                            <p class="text-lg font-bold mt-4"> Compétences requises </p>
                            <div class="flex flex-1 mb-4 skill-row">
                                <div class="w-3/4 mr-2">
                                    <select id="skillsAll" name="skillsAll[]"  class="new-skill-select mt-1 block w-full py-2 px-3 border border-gray-300 bg-white text-black rounded-full shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="">Sélectionnez une compétence</option>
                                        <?php foreach ($skillsAll as $skill): ?>
                                            <option value="<?= $skill['skillId'] ?>"><?= $skill['skillName'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="w-1/4">
                                    <select class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="skillsLevel[]" required>
                                        <option value="1">Junior</option>
                                        <option value="2">Intermédiaire</option>
                                        <option value="3">Expert</option>
                                    </select>
                                </div>
                            </div>                       
                        </div>
                        <button id="add-skill-btn" type="button" class="py-2 px-4 bg-primary text-white rounded-lg">Ajouter une compétence</button>


                        <div class="flex flex-1 mt-4">
                            <p class="text-lg font-bold"> Où se déroule la mission ? </p>
                        </div>
                        <div class="mt-4">
                            <div class="flex flex-1">
                                <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700 w-full mr-4">
                                    <input id="bordered-checkbox-2" type="checkbox" value="remote" name="userJobType[]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="bordered-checkbox-2" class="py-4 ml-2  font-medium text-gray-900 dark:text-white">Télétravail</label>
                                </div>
                                <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700 w-full mr-4">
                                    <input id="bordered-checkbox-2" type="checkbox" value="hybride" name="userJobType[]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="bordered-checkbox-2" class="py-4 ml-2  font-medium text-gray-900 dark:text-white">Hybride</label>
                                </div>
                                <div class="flex items-center pl-4 border  border-gray-200 rounded dark:border-gray-700 w-full mr-4">
                                    <input id="bordered-checkbox-2" type="checkbox" value="sur-site" name="userJobType[]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="bordered-checkbox-2" class="py-4 ml-2  font-medium text-gray-900 dark:text-white">Sur site</label>
                                </div>
                            </div> 
                        </div>

                        <div class="flex flex-1 mt-4">
                            <p class="text-lg font-bold"> Description de la mission</p>
                        </div>
                        <div class="flex flex-1 mt-4">
                            <textarea name="missionDescription" placeholder="Description de la mission" cols="20" rows="5" class="block  mb-4 border mt-2 border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                        </div>

                        <div class="flex flex-1 mt-4">
                            <p class="text-lg font-bold"> Avantages de la mission</p>
                        </div>
                        <div class="flex flex-1 mt-4">
                            <textarea name="missionAvantages" placeholder="Avantages de la mission" cols="20" rows="5" class="block  mb-4 border mt-2 border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                        </div>


                        <div class="flex flex-1 mt-4">
                            <button type="submit" class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Poster la mission</button>
                        </div>

                    </form> 
                </div>
                <div class="w-1/4 sticky top-0">
                    <div class="bg-white rounded-lg h-22vh p-4 dark:bg-gray-800 dark:text-white">
                        <div class="flex flex-col items-center mb-4">
                        <a class="flex flex-col items-center" href="<?=base_url('user/profil')?>">
                            <div class="w-20 h-20 rounded-full border-10 ring-2 ring-primary overflow-hidden">
                                <?php 
                                if($user->userAvatarPath == null){
                                    $user->userAvatarPath = 'assets/img/default-avatar.png';
                                }
                                ?>
                                <img src="<?php echo base_url($user->userAvatarPath); ?>" alt="Avatar" class="w-20 h-20 p-0.5 rounded-full ring-2 ring-primary">
                            </div>

                                <h3 class="text-lg font-medium mt-2"><?=$user->userFirstName .' '. $user->userLastName?></h3>
                        </a>
                            <div class="flex items-center mt-1">
                                <p class="font-light"><?=$company->companyName?></p>
                            </div>
                            <a href="<?php echo base_url('User/profil');?>" class="text-primary mt-2 border border-primary px-4 py-1 rounded 2 hover:bg-primary-900 hover:text-white">Modifier mon profil</a>
                        <!-- missions favorites -->
                            <a href="<?php echo base_url('Company/missionAdd');?>" class="text-primary mt-2  px-4 py-1 rounded 2 hover:bg-primary-900 hover:text-white">Ajouter une offre</a>
                            <a href="<?php echo base_url('Company/logout');?>" class="text-red-600 mt-2 hover:text-red-900">Déconnexion</a>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg mt-4 p-4 text-left dark:bg-gray-800 dark:text-white">
                        <h3 class="text-xl font-medium mt-2">Vos Offres de mission</h3>
                        <?php if (is_array($job_for_company) && !empty($job_for_company)) {
                            $job_for_companyCount = 0;
                            foreach ($job_for_company as $job) {
                                if ($job_for_companyCount < 3) {
                            ?>
                                    <div class="flex items-center mt-2 mb-2">
                                        <div class="mr-2 mt-2">
                                            <p class="w-10 h-10 rounded-full bg-secondary text-white text-center flex items-center justify-center mr-4" style="font-size:1rem;">💼</p>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-medium"><?= $job->missionName ?></h3>
                                            <p class="text-sm text-gray-500"><?= strlen($job->missionDescription) > 100 ? substr($job->missionDescription, 0, 100)."..." : $job->missionDescription ?></p>
                                        </p>
                                        </div>
                                    </div>
                            <?php
                                    $job_for_companyCount++;
                                } else {
                                    break;
                                }
                            }
                            ?>
                        <?php } else { ?>
                            <p class="mt-2 mb-2"> Aucune offre disponible. </p>
                            <button class="bg-primary text-white px-4 py-2 mt-2 rounded-full">Ajouter une offre</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<script src="<?php echo base_url('/node_modules/choices.js/public/assets/scripts/choices.min.js'); ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js@10.0.0"></script>

<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>

<script>
    var base_url = '<?php echo base_url(); ?>';

    // Fonction pour détruire l'instance Choices.js existante
    function destroyChoicesInstance(element) {
        if (element.choices) {
            element.choices.destroy();
        }
    }

    // Fonction pour créer une nouvelle instance Choices.js
    function createChoicesInstance(element) {
        new Choices(element, {
            /* options spécifiques à Choices */
        });
    }

    $(document).ready(function() {
        $('#citySearch').on('keyup', function() {
            let term = $(this).val();
            if(term.length > 2) { // Recherche après 2 caractères
                $.post(base_url + 'Company/search_cities', { term: term }, function(data) {
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

        // Initialisation des choix pour les métiers
        const jobsChoices = new Choices('#jobsAll', {
            searchEnabled: true,
            removeItemButton: true,
            itemSelectText: '',
            placeholder: true,
            placeholderValue: 'Sélectionnez votre métier',
        });

        // Gestion de la recherche des métiers
        $('#search-input-job').on('keyup', function() {
            let term = $(this).val();
            $.post('company/search_jobs', { term: term }, function(data) {
                let jobs = JSON.parse(data);
                let jobsList = $('#jobs-list');
                jobsList.empty();
                jobs.forEach(function(job) {
                    jobsList.append(`<div class="job-item" data-id="${job.jobId}">${job.jobName}</div>`);
                });
            });
        });

        // Gestion de la sélection des métiers
        $(document).on('click', '.job-item', function() {
            let jobId = $(this).data('id');
            let jobName = $(this).text();
            let selectedJobs = $('#selected-jobs');
            if (!$(`.selected-job[data-id="${jobId}"]`, selectedJobs).length) {
                selectedJobs.append(`<div class="selected-job" data-id="${jobId}">${jobName}</div>`);
            }
        });

        const currentDate = new Date().toISOString().split('T')[0];
        document.getElementById('missionDateDebut').value = currentDate;

        const endDate = new Date();
        endDate.setMonth(endDate.getMonth() + 1);
        const endDateString = endDate.toISOString().split('T')[0];

        document.getElementById('missionDateFin').value = endDateString;

        // Gestion des compétences avec Choices.js
        const skillsChoices = new Choices('#skillsAll', {
            searchEnabled: true,
            removeItemButton: true,
            itemSelectText: '',
            placeholder: true,
            placeholderValue: 'Sélectionnez des compétences',
            allowHTML: true,
        });

        $('#search-input-skill').on('keyup', function(){
            let term = $(this).val();
            if (term.length > 2) {
                $.post('company/search_skills', { term: term }, function(data){
                    let skills = JSON.parse(data);
                    $('#skills-list').empty();
                    skills.forEach(function(skill){
                        $('#skills-list').append(`<div class="skill-item p-2 hover:bg-gray-200 cursor-pointer" data-id="${skill.skillId}">${skill.skillName}</div>`);
                    });
                });
            } else {
                $('#skills-list').empty();
            }
        });

        $(document).on('click', '.skill-item', function(){
            let skillId = $(this).data('id');
            let skillName = $(this).text();
            if (!$(`#selected-skills .selected-skill[data-id="${skillId}"]`).length) {
                $('#selected-skills').append(`<div class="selected-skill" data-id="${skillId}">${skillName}</div>`);
            }
            $('#skills-list').empty(); // Vider la liste après sélection
        });

        // Pour fermer la liste lorsque vous cliquez en dehors
        $(document).on('click', function(event) {
            if (!$(event.target).closest('#search-input-skill, #skills-list').length) {
                $('#skills-list').empty();
            }
        });

        // Gestion de l'ajout dynamique de compétences
        $('#add-skill-btn').on('click', function() {
            const newSkillRow = `
                <div class="flex flex-1 mb-4 skill-row">
                    <div class="w-3/4 mr-2">
                        <select class="p-2 border rounded-lg w-full new-skill-select" name="skillsAll[]" required>
                            <option value="">Sélectionnez une compétence</option>
                            <?php foreach ($skillsAll as $skill): ?>
                                <option value="<?= $skill['skillId'] ?>"><?= $skill['skillName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="w-1/4">
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="skillsLevel[]" required>
                            <option value="1">Junior</option>
                            <option value="2">Intermédiaire</option>
                            <option value="3">Expert</option>
                        </select>
                    </div>
                </div>
            `;
            $('#skills-container').append(newSkillRow);

            // Désinitialisez et réinitialisez les instances Choices.js sur les éléments nouvellement ajoutés
            $('.new-skill-select').each(function() {
                destroyChoicesInstance(this);
                createChoicesInstance(this);
            });
        });
    });
</script>

