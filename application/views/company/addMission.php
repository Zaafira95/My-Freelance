<!DOCTYPE html>
<?php
// Header Call
$currentPage = 'my_company';

include(APPPATH . 'views/layouts/company/header.php' );
?>
<head>
    <title> Poster une mission  </title>
    <link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('/node_modules/choices.js/public/assets/styles/choices.min.css');?>" rel="stylesheet" type="text/css">
        

</head>

<style>
    .ql-editor {
      height: 200px;
    }
  </style>
<div class="px-8 py-6 lg:px-4 lg:py-6 h-full no-scrollbar">
    <div class="flex flex-wrap justify-between mx-auto max-w-screen-xl h-full">
        <div class="flex h-full w-full mb-3">
            <div class="w-full flex gap-6 h-full mb-3">
                <div class="w-full lg:w-3/4 relative grid-cols-2 bg-white rounded-lg mb-4 dark:bg-gray-800 py-4 px-4 overflow-y-auto no-scrollbaroverflow-y-auto no-scrollbar">
                    <h1 class="text-4xl lg:text-2xl font-bold "> Add your mission </h1>
                    <form id="missionForm" action="<?=base_url("company/addMission")?>" method="post" enctype="multipart/form-data">
                        <div class="flex flex-1 mt-4">
                            <input type="text" name="missionName" placeholder= "Mission name" class="text-3xl lg:text-base mr-3 w-full block  mb-4 border mt-2 border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required/>
                            <input type="number" name="missionTJM" placeholder="TJM AED" min="100" class="text-3xl lg:text-base block mb-4 border mt-2 border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required/>
                        </div>

                        <div class="w-full text-black">
                            <select id="jobsAll" name="jobsAll[]"  class="text-3xl lg:text-base block mr-3 mb-4 border mt-2 border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <?php foreach ($jobsAll as $joba): ?>
                                    <option class="text-3xl lg:text-base dark:text-black" value="<?= $joba['jobId']?>"><?= $joba['jobName'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 

                        <div>
                        <div class="relative city-search-container w-full">
                            
                        </div> 
                        <p class="text-3xl lg:text-lg font-bold mt-4"> Mission location </p>
                        <div class="w-full mx-auto mt-2 text-black">
                            <select id="countriesAll" name="missionCountryId"  style="font-size:1rem;" class="text-3xl lg:text-base font-medium mb-2 bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <?php foreach ($countriesAll as $country): ?>
                                    <option class="text-3xl lg:text-base dark:text-white" value="<?= $country['idCountry']?>">
                                    <?= $country['countryName'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                            <p class="text-3xl lg:text-lg font-bold mt-4"> Mission duration </p>

                            <!-- <select id="missionDuration" name="missionDuration" class="w-full block mr-3 mb-4 border mt-2 border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <?php
                                // $missionDurationOption = ['Courte Durée', 'Longue Durée', 'Durée indéfinie'];
                                // foreach ($missionDurationOption as $missionDuration) {
                                //    echo '<option value="'.$missionDuration.'">'.$missionDuration.'</option>';
                                // }
                                ?>
                            </select> -->

                            <div class="flex flex-1 mt-4">
                                <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700 w-full mr-4">
                                    <input type="radio" id="courte" value="courte" name="missionDuration" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required>
                                    <label for="courte" class="text-3xl lg:text-base py-4 ml-2  font-medium text-gray-900 dark:text-white">Short-term</label>
                                </div>
                                <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700 w-full mr-4">
                                    <input type="radio" id="longue" value="longue" name="missionDuration" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="longue" class="text-3xl lg:text-base py-4 ml-2  font-medium text-gray-900 dark:text-white">Long-term</label>
                                </div>
                                <div class="flex items-center pl-4 border  border-gray-200 rounded dark:border-gray-700 w-full mr-4">
                                    <input type="radio" id="indefinie" value="indefinie" name="missionDuration" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="indefinie" class="text-3xl lg:text-base py-4 ml-2  font-medium text-gray-900 dark:text-white">Indefinite duration</label>
                                </div>
                            </div>
                                
                            <div class="flex mb-4">
                                <div class="flex flex-col w-full mr-4">
                                    <label for="missionDateDebut" class="text-3xl lg:text-base w-full block mt-4 mb-2 font-medium text-gray-900 dark:text-white">Start date</label>
                                    <input type="date" id="missionDateDebut" name="missionDateDebut" class="text-3xl lg:text-base w-full bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>

                                <div class="flex flex-col w-full">
                                    <label for="missionDateFin" class="text-3xl lg:text-base w-full block mt-4 mb-2 font-medium text-gray-900 dark:text-white">End date</label>
                                    <input type="date" id="missionDateFin" name="missionDateFin" class="text-3xl lg:text-base w-full bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-1 mt-4">
                            <p class="text-3xl lg:text-lg font-bold"> Job type</p>
                        </div>
                        <div class="mt-4">
                            <div class="flex flex-1">
                                <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700 w-full mr-4">
                                    <input id="temps-plein" type="radio" value="temps-plein" name="missionType" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required>
                                    <label for="temps-plein" class="text-3xl lg:text-base py-4 ml-2  font-medium text-gray-900 dark:text-white">Full-time</label>
                                </div>
                                <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700 w-full mr-4">
                                    <input id="temps-partiel" type="radio" value="temps-partiel" name="missionType" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="temps-partiel" class="text-3xl lg:text-base py-4 ml-2  font-medium text-gray-900 dark:text-white">Part-time</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="text-3xl lg:text-lg font-bold mt-4"> Required expertise </p>
                            <select id="missionExperience" name="missionExperience" class="text-3xl lg:text-base w-full block mr-3 mb-4 border mt-2 border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <?php
                                $missionExperienceOptions = ['Junior (1 to 2 years) ', 'Intermediate (3 to 5 years)', 'Expert (5+ years)'];
                                $missionExperienceOptionsValues = ['junior', 'intermediaire', 'expert'];
                                for ($i = 0; $i < count($missionExperienceOptions); $i++) {
                                    $missionExperience = $missionExperienceOptions[$i];
                                    $missionExperienceValue = $missionExperienceOptionsValues[$i];
                                    echo '<option value="' . $missionExperienceValue . '">' . $missionExperience . '</option>';
                                }
                                ?>
                            </select>
                        </div>      
                        
                        <div id="skills-container">
                            <p class="text-3xl lg:text-lg font-bold mt-4 mb-4"> Required skills </p>
                            <div class="flex flex-1 mb-4 skill-row">
                                <div class="w-3/4 mr-2 text-black">
                                    <select id="skillsAll" name="skillsAll[]"  class="text-3xl lg:text-base new-skill-select mt-1 block w-full py-2 px-3 border border-gray-300 bg-white text-black rounded-full shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                        <option value="">Select a skill</option>
                                        <?php foreach ($skillsAll as $skill): ?>
                                            <option value="<?= $skill['skillId'] ?>"><?= $skill['skillName'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="w-1/4">
                                    <select class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="skillsLevel[]" required>
                                        <option value="1">Junior</option>
                                        <option value="2">intermediate</option>
                                        <option value="3">Expert</option>
                                    </select>
                                </div>
                                <button type="button" class="text-red-600 hover:text-red-900 focus:outline-none ml-4 delete-skill-row">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>                       
                        </div>
                        <button id="add-skill-btn" type="button" class="text-3xl lg:text-base py-2 px-4 bg-primary text-white rounded-lg">Add a skill</button>

                        <div class="flex flex-1 mt-4">
                            <p class="text-3xl lg:text-lg font-bold"> Mission work mode </p>
                        </div>
                        <div class="mt-4">
                            <div class="flex flex-1">
                                <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700 w-full mr-4">
                                    <input id="teletravail" type="radio" value="teletravail" name="missionDeroulement" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required>
                                    <label for="teletravail" class="text-3xl lg:text-base py-4 ml-2  font-medium text-gray-900 dark:text-white">Télétravail</label>
                                </div>
                                <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700 w-full mr-4">
                                    <input id="hybride" type="radio" value="hybride" name="missionDeroulement" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="hybride" class="text-3xl lg:text-base py-4 ml-2  font-medium text-gray-900 dark:text-white">Hybride</label>
                                </div>
                                <div class="flex items-center pl-4 border  border-gray-200 rounded dark:border-gray-700 w-full mr-4">
                                    <input id="sur-site" type="radio" value="site" name="missionDeroulement" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="sur-site" class="text-3xl lg:text-base py-4 ml-2  font-medium text-gray-900 dark:text-white">Sur site</label>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-1 mt-4">
                            <p class="text-3xl lg:text-lg font-bold"> Mission description</p>
                        </div>
                        <div class="mt-4">
                            <div id="editor" class="text-3xl lg:text-base block  mb-4 border mt-2 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <!--<textarea name="missionDescription" placeholder="Description de la mission" cols="20" rows="5" class="hidden block  mb-4 border mt-2 border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                                -->
                                <div id="editor-description" class="text-3xl lg:text-base ql-editor" style="height:200px;"></div>
                            </div>
                        </div>
                        <textarea id="missionDescription" name="missionDescription" placeholder="Description de la mission" cols="20" rows="5" class="text-3xl lg:text-base hidden block  mb-4 border mt-2 border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                        <p id="missionDescriptionError" class="text-3xl lg:text-base text-red-600 hidden">Mission description is required</p>


                        <div class="flex flex-1 mt-4">
                            <p class="text-3xl lg:text-lg font-bold">Mission advantages</p>
                        </div>
                        <div class="mt-4">
                            <div id="editor2" class="text-3xl lg:text-base block mb-4 border mt-2 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div class="ql-editor"></div>
                            </div>
                        </div>
                        <textarea id="missionAvantages" name="missionAvantages" placeholder="Description de la mission" cols="20" rows="5" class="text-3xl lg:text-base hidden block  mb-4 border mt-2 border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                        <p id="missionAvantagesError" class="text-3xl lg:text-base text-red-600 hidden">Mission advantages are required</p>


                        <div class="flex flex-1 mt-4">
                            <button type="submit" class="text-3xl lg:text-base bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Add mission</button>
                        </div>

                    </form> 
                </div>
                <div class="hidden lg:block w-1/4 sticky top-0">
                    <div class="bg-white rounded-lg h-22vh p-4 dark:bg-gray-800 dark:text-white">
                        <div class="flex flex-col items-center mb-4">
                        <a class="flex flex-col items-center" href="<?=base_url('company/my_company')?>">
                            <div class="w-20 h-20 rounded-full border-10 ring-2 ring-primary overflow-hidden">
                                <?php 
                                if($user->userAvatarPath == null){
                                    $user->userAvatarPath = 'assets/img/default-avatar.png';
                                }
                                ?>
                                <img src="<?php echo base_url($company->companyLogoPath); ?>" alt="Avatar" class="w-20 h-20 p-0.5 rounded-full ring-2 ring-primary">
                            </div>

                                <h3 class="text-lg font-medium mt-2"><?=$user->userFirstName .' '. $user->userLastName?></h3>
                        </a>
                            <div class="flex items-center mt-1">
                                <p class="font-light"><?=$company->companyName?></p>
                            </div>
                            <a href="<?php echo base_url('company/my_company');?>" class="text-primary mt-2 px-4 py-1 rounded 2">Edit my company</a>
                            <a href="<?php echo base_url('Company/missionAdd');?>" class="mt-2  px-4 py-1 rounded 2 hover:bg-primary-900 bg-primary-700 text-white">Add a mission</a>
                            <a href="<?php echo base_url('Company/logout');?>" class="text-red-600 mt-2 hover:text-red-900">Logout</a>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg mt-4 p-4 text-left dark:bg-gray-800 dark:text-white">
                        <h3 class="text-xl font-medium mt-2">Your missions</h3>
                        <?php if (is_array($job_for_company) && !empty($job_for_company)) {
                            $job_for_companyCount = 0;
                            foreach ($job_for_company as $job) {
                                if ($job_for_companyCount < 3) {
                            ?>
                                <a href="<?=base_url('company/missionView/'.$job->idMission)?>">
                                    <div class="flex items-center mt-2 mb-2 p-2 rounded-lg shadow">
                                        <div class="mr-2 mt-2">
                                            <div class="w-10 h-10" style="font-size:1rem;">
                                                <img src="<?=base_url($company->companyLogoPath)?>" class="w-10 h-10 rounded-full flex items-center justify-center" alt="Logo de l'entreprise">
                                            </div>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-medium"><?= $job->missionName ?></h3>
                                            <div class="text-sm text-gray-500"><?= strlen($job->missionDescription) > 100 ? substr($job->missionDescription, 0, 100)."..." : $job->missionDescription ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php
                                    $job_for_companyCount++;
                                } else {
                                    break;
                                }
                            }
                            ?>
                        <?php } else { ?>
                            <p class="mt-2 mb-2"> No mission available. </p>
                            <button class="bg-primary text-white px-4 py-2 mt-2 rounded-full">Add a mission</button>
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
<script src="<?php echo base_url('assets/quill/quill.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.1/tinymce.min.js"></script>-->

<script>
  var quill = new Quill('#editor', {
    theme: 'snow'
  });

  var quill2 = new Quill('#editor2', {
        theme: 'snow'
    });

    
    document.addEventListener('DOMContentLoaded', function() {
        var editors = document.querySelectorAll('.ql-editor');

        editors.forEach(function(editor) {
            editor.addEventListener('paste', function(e) {
                e.preventDefault(); // Empêcher le collage par défaut avec mise en forme

                // Obtenir le texte du presse-papiers en tant que texte brut
                var text = e.clipboardData.getData('text/plain');

                // Insérer le texte brut à la position actuelle du curseur
                if (document.queryCommandSupported('insertText')) {
                    document.execCommand('insertText', false, text);
                } else { // Pour les navigateurs qui ne supportent pas insertText
                    // Récupérer la sélection actuelle
                    var selection = window.getSelection();
                    if (!selection.rangeCount) return false;
                    selection.deleteFromDocument(); // Supprimer la sélection actuelle
                    selection.getRangeAt(0).insertNode(document.createTextNode(text));
                    
                    // Déplacer la sélection après le texte inséré
                    var range = document.createRange();
                    range.setStartAfter(textNode);
                    range.collapse(true);
                    selection.removeAllRanges();
                    selection.addRange(range);
                }
            });
        });
    });
    
  document.getElementById('missionForm').addEventListener('submit', function (e) {
        // Récupérer le contenu HTML de Quill
        var missionElementsHTML = document.querySelectorAll('.ql-editor');

        // Mettre le contenu HTML dans le champ de texte masqué
        document.getElementById('missionDescription').value = missionElementsHTML[0].innerHTML;

        // Mettre le contenu HTML dans le champ de texte masqué
        document.getElementById('missionAvantages').value =  missionElementsHTML[1].innerHTML;;
    });

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
            searchEnabled: true,
            removeItemButton: true,
            itemSelectText: '',
            placeholder: true,
            placeholderValue: 'Selectcompétences',
            allowHTML: true,
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
        
        //Script selection des pays
        const countriesChoices = new Choices('#countriesAll', {
            searchEnabled: true,
            removeItemButton: true,
            itemSelectText: '',
            placeholder: true, // Ajoutez cette ligne pour activer le placeholder
            placeholderValue: 'Select country', // Texte du placeholder

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

        // Gestion de la sélection de la durée de la mission
        $(document).on('change', 'input[name="missionDuration"]', function() {
            const selectedDuration = $(this).val();
            const dateDebutInput = document.getElementById('missionDateDebut');
            const dateFinInput = document.getElementById('missionDateFin');

            const currentDate = new Date().toISOString().split('T')[0];

            if (selectedDuration === 'courte') {
                // Courte durée : Date de début = aujourd'hui, Date de fin = une semaine après aujourd'hui
                dateDebutInput.value = currentDate;

                const endDate = new Date();
                endDate.setDate(endDate.getDate() + 7);
                const endDateString = endDate.toISOString().split('T')[0];
                dateFinInput.value = endDateString;
                dateFinInput.disabled = false; // Activer le champ Date de fin
            } else if (selectedDuration === 'longue') {
                // Longue durée : Date de début = aujourd'hui, Date de fin = un mois après aujourd'hui
                dateDebutInput.value = currentDate;

                const endDate = new Date();
                endDate.setMonth(endDate.getMonth() + 1);
                const endDateString = endDate.toISOString().split('T')[0];
                dateFinInput.value = endDateString;
                dateFinInput.disabled = false; // Activer le champ Date de fin
            } else if (selectedDuration === 'indefinie') {
                // Durée indéfinie : Date de début = aujourd'hui, Date de fin désactivée
                dateDebutInput.value = currentDate;
                dateFinInput.value = '';
                dateFinInput.disabled = true; // Désactiver le champ Date de fin
            } else {
                // Autre durée : Réinitialiser les dates et activer le champ Date de fin
                dateDebutInput.value = currentDate;
                dateFinInput.value = '';
                dateFinInput.disabled = false; // Activer le champ Date de fin
            }
        });

        // Gestion des compétences avec Choices.js
        const skillSelects = document.querySelectorAll('.new-skill-select');

        // Bouclez à travers chaque élément et initialisez une instance Choices.js
        skillSelects.forEach(function(skillSelect) {
            new Choices(skillSelect, {
                searchEnabled: true,
                removeItemButton: true,
                itemSelectText: '',
                placeholder: true,
                placeholderValue: 'Select compétences',
                allowHTML: true,
            });
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
                    <div class="w-3/4 mr-2 text-black">
                        <select class="p-2 border rounded-lg w-full new-skill-select" name="skillsAll[]" required>
                            <option value="">Sélectionnez une compétence</option>
                            <?php foreach ($skillsAll as $skill): ?>
                                <option value="<?= $skill['skillId'] ?>"><?= $skill['skillName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="w-1/4">
                        <select class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="skillsLevel[]" required>
                            <option value="1">Junior</option>
                            <option value="2">intermediate</option>
                            <option value="3">Expert</option>
                        </select>
                    </div>
                    <button type="button" class="text-red-600 hover:text-red-900 focus:outline-none ml-4 delete-skill-row">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;
            $('#skills-container').append(newSkillRow);

            // Désinitialisez et réinitialisez les instances Choices.js sur les éléments nouvellement ajoutés
            $('.new-skill-select').each(function() {
                destroyChoicesInstance(this);
                createChoicesInstance(this);
            });
        });

        $(document).on('click', '.delete-skill-row', function() {
            // Supprimez le parent .skill-row
            $(this).closest('.skill-row').remove();
        });

    });

    // Vérifie avant de soumettre le formulaire si missionDescription ne contient pas que des balises html, car par défaut il prend la valeur <p><br></p> si vide
    document.getElementById('missionForm').addEventListener('submit', function (e) {
        let missionDescription = document.getElementById('missionDescription').value;
        if (missionDescription === "<p><br></p>") {
            e.preventDefault();
            var missionDescriptionError = document.getElementById('missionDescriptionError');
            missionDescriptionError.classList.remove('hidden');
            // alert('La description de l\'entreprise ne peut pas être vide');
        }
        // vérifie si il n'y a pas que des balises html
        else if (!missionDescription.replace(/<[^>]+>/g, '').trim()) {
            e.preventDefault();
            var missionDescriptionError = document.getElementById('missionDescriptionError');
            missionDescriptionError.classList.remove('hidden');
            // alert('La description de l\'entreprise ne peut pas être vide');
        }
    });

    // Vérifie avant de soumettre le formulaire si missionAvantages ne contient pas que des balises html, car par défaut il prend la valeur <p><br></p> si vide
    document.getElementById('missionForm').addEventListener('submit', function (e) {
        let missionAvantages = document.getElementById('missionAvantages').value;
        if (missionAvantages === "<p><br></p>") {
            e.preventDefault();
            var missionAvantagesError = document.getElementById('missionAvantagesError');
            missionAvantagesError.classList.remove('hidden');
            // alert('La description de l\'entreprise ne peut pas être vide');
        }
        // vérifie si il n'y a pas que des balises html
        else if (!missionAvantages.replace(/<[^>]+>/g, '').trim()) {
            e.preventDefault();
            var missionAvantagesError = document.getElementById('missionAvantagesError');
            missionAvantagesError.classList.remove('hidden');
            // alert('La description de l\'entreprise ne peut pas être vide');
        }
    });
</script>

