<!DOCTYPE html>
<html>
<head>
    <title>Inscription | Café Crème Community - Rejoignez la plus grande communauté de freelances</title>
    <link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('/node_modules/choices.js/public/assets/styles/choices.min.css');?>" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
    <style>
        body {
            background-color: #ffffff;
        }
        /* Barre de progression */
        .password-strength-meter {
            height: 10px;
            background-color: #f3f3f3;
            margin-bottom: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }

        .password-strength-meter-fill {
            height: 100%;
            transition: width 0.3s ease;
            border-radius: 5px;
        }

        .password-strength-weak {
            background-color: #ff4d4f;
            border-radius: 5px;
        }

        .password-strength-medium {
            background-color: #ff7f50;
            border-radius: 5px;
        }

        .password-strength-strong {
            background-color: #52c41a;
            border-radius: 5px;
        }

        /* Couleur du texte */
        .password-strength-weak-text {
            color: #ff4d4f;
        }

        .password-strength-medium-text {
            color: #ff7f50;
        }

        .password-strength-strong-text {
            color: #52c41a;
        }

        .image-rotation {
            transition: opacity 0.5s ease;
            opacity: 0;
        }

       
    </style>
</head>
<body>
    <?php if ($this->session->flashdata('message')) : ?>
        <div class="flashdata <?php echo $this->session->flashdata('status') === 'error' ? 'error' : 'success'; ?>">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    <?php endif; ?>
    <section class="h-screen">
        <div class="container h-full px-6 mx-auto max-w-screen-xl">
            <div class="g-6 flex h-full flex-wrap items-center justify-center lg:justify-between">
                <!-- Left column container with background-->
                <div class="mb-12 md:mb-0 md:w-8/12 lg:w-6/12">
                    <img
                    src="<?php echo base_url('assets/img/cc-1.png');?>"
                    class="w-full image-rotation"
                    alt="Register Image with quote" />
                </div>

                <!-- Right column container with form -->
                <div class="md:w-8/12 lg:ml-6 lg:w-5/12">
                    <div class="flex flex-col justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                        <a href="#" class="flex mb-6 text-2xl font-semibold text-gray-900">
                            <img class="w-50 mr-2" src="<?php echo base_url('assets/img/logo.svg');?>" alt="Café Crème Community" id="logoLogin">
                        </a>
                        
                        <div id="step1" style="display:block">
                            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:text-white">
                                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                    <h1 class="text-2xl font-bold mb-2 leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                                        Créez votre compte
                                    </h1>
                                    <p class="text-dark mb-2 dark:text-white">
                                        Inscrivez-vous maintenant et commencez à découvrir les opportunités qui vous attendent.
                                    </p>
                                    <form id="register-form" class="space-y-4 md:space-y-6" method="post" action="<?php echo base_url('register/registerUser'); ?>" onsubmit="showLoader();" enctype="multipart/form-data">
                                        <div>
                                            <input type="email" name="userEmail" id="userEmail" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-lg rounded-lg block w-full p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" placeholder="Saisissez votre email *" oninput="checkEmailAvailability(this.value)" required>
                                            <p id="emailError" class="text-red-500"></p>
                                        </div>
                                        <div>
                                            <input type="password" name="userPassword" id="userPassword" placeholder="Saisissez votre mot de passe *" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-lg rounded-lg block w-full p-2.5" required oninput="checkPasswordStrength(this.value)">
                                        </div>
                                        <div>
                                            <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirmez votre mot de passe *" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-lg rounded-lg block w-full p-2.5" required oninput="checkPasswordMatch()">
                                            <p id="confirmPasswordError" class="text-red-500"></p>
                                        </div>
                                        <div class="password-strength-meter">
                                            <div class="password-strength-meter-fill"></div>
                                        </div>
                                        <p id="passwordError" class="text-red-500"></p>
                                        <div>
                                            <input type="checkbox" id="togglePasswordCheckbox" class="form-checkbox text-primary rounded">
                                            <label for="togglePasswordCheckbox" class="text-lg font-medium text-gray-900 dark:text-white">Afficher le mot de passe</label>
                                        </div>
                                        <!-- button for next step -->
                                        <button type="button" class="w-full text-white bg-primary hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center" id="nextButton" onclick="goToStep2()">Suivant</button>
                                        <!-- error message -->
                                        <p id="errorMessage1" class="text-red-500" style="display:none;">Un ou plusieurs champs non pas été remplies</p>
                                        <p class="text-lg font-light text-gray-500 dark:text-white">
                                            Vous avez déjà un compte ? <a href="<?=base_url('login')?>" class="font-medium text-primary hover:underline">Connectez-vous</a>
                                        </p>
                                </div>
                            </div>
                        </div>
                        <div id="step2" style="display: none;">
                            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:text-white">
                                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                    <div class="flex items-center">
                                        <h2 class="text-2xl font-bold mb-2 leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white" style="width: 60%;">
                                        Je suis un :
                                        </h2>
                                        <div class="relative flex flex-grow ml-4 items-center w-full h-2 bg-primary-light rounded-md" style="width: 40%;">
                                            <div class="font-bold absolute top-0 right-0 transform -translate-y-full text-primary rounded-md py-2 px-4 text-lg">
                                                1/5
                                            </div>
                                            <div class="absolute inset-0 bg-secondary rounded-md" style="width: 100%;"></div>
                                            <div class="absolute inset-0 bg-primary rounded-md" style="width: 20%;"></div>
                                        </div>
                                    </div>
                                    <div class="block-container flex flex-col items-center">
                                        <ul class="w-full col-6 md:col-cols-2">
                                            <li class="h-48 flex flex-col items-center overflow-hidden mb-4">
                                                <input type="radio" id="userTypeFreelance" name="userType" value="freelance" class="hidden peer" required>
                                                <label for="userTypeFreelance" class="h-full inline-flex flex-col items-center justify-center w-full pt-5 text-black bg-white border hover:bg-primary border-black rounded-lg cursor-pointer dark:hover:bg-primary dark:border-white dark:peer-checked:text-blue-500 peer-checked:bg-primary peer-checked:text-white hover:text-gray-600 dark:text-gray-400 dark:bg-gray-800 mb-4" onclick="handleClick(this)" onmouseover="changeTextColor(this, true)" onmouseout="changeTextColor(this, false)">
                                                    <div class="flex flex-col items-center">
                                                    <h2 class="text-2xl font-bold mb-2 leading-tight tracking-tight md:text-2xl dark:text-white">Freelance</h2>
                                                        <div class="flex flex-col items-center">
                                                            <img src="<?=base_url('assets/img/person.png')?>" alt="Freelance Image" style="width:35%;">
                                                        </div>
                                                    </div>
                                                </label>
                                            </li>

                                            <li class="h-48 flex flex-col items-center overflow-hidden">
                                                <input type="radio" id="userTypeESN" name="userType" value="sales" class="hidden peer" required>
                                                <label for="userTypeESN" class="h-full inline-flex flex-col items-center justify-center w-full pt-5 text-black bg-white border hover:bg-primary border-black rounded-lg cursor-pointer dark:hover:bg-primary dark:border-white dark:peer-checked:text-blue-500 peer-checked:bg-primary peer-checked:text-white hover:text-gray-600 dark:text-gray-400 dark:bg-gray-800 mb-4" onclick="handleClick(this)" onmouseover="changeTextColor(this, true)" onmouseout="changeTextColor(this, false)">
                                                    <div class="flex flex-col items-center">
                                                        <h2 class="text-2xl font-bold mt-4 mb-2 leading-tight tracking-tight md:text-2xl dark:text-white">ESN / Sales</h2>
                                                        <div class="flex flex-col items-center">
                                                            <img src="<?=base_url('assets/img/esn.png')?>" alt="ESN Image" style="width:35%;">
                                                        </div>
                                                    </div>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="flex justify-between pl-4 pr-4">
                                        <!-- button for previous step -->
                                        <button type="button" class="w-1/2 mr-2 text-primary border border-primary hover:text-white hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center" id="previousButton" onclick="goToStep1()">Retour</button>
                                        <!-- button for next step -->
                                        <button type="button" class="w-1/2 ml-2 text-white bg-primary hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center" id="nextButton" onclick="goToStep3()">Suivant</button>
                                    </div>
                                    <p id="errorUserType" class="text-red-500" style="display:none;">Veuillez choisir votre type de profil</p>
                                </div>
                            </div>
                        </div>
                        <div id="step3" style="display:none;">
                            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:text-white">
                                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                <div class="flex items-center">
                                    <h2 class="text-2xl font-bold mb-2 leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white" style="width: 60%;">
                                    Présentes toi
                                    </h2>
                                    <div class="relative flex flex-grow ml-4 items-center w-full h-2 bg-primary-light rounded-md" style="width: 40%;">
                                        <div class="font-bold absolute top-0 right-0 transform -translate-y-full text-primary rounded-md py-2 px-4 text-lg">
                                            2/5
                                        </div>
                                        <div class="absolute inset-0 bg-secondary rounded-md" style="width: 100%;"></div>
                                        <div class="absolute inset-0 bg-primary rounded-md" style="width: 40%;"></div>
                                    </div>
                                </div>
                                <div id="step3-freelance-avatar" class="flex flex-col items-center">
                                    <div class="relative w-32 h-32">
                                        <div class="rounded-full ring ring-primary w-full h-full flex items-center justify-center">
                                            <div class="w-full h-full rounded-full flex items-center justify-center">
                                            <img id="avatar-image" src="<?php echo base_url('assets/img/default-avatar.png'); ?>" class="rounded-full object-cover w-full h-full" alt="Avatar">
                                            </div>
                                            <div class="absolute w-10 h-10 text-center bottom-0 right-0 bg-white rounded-full">
                                            <label for="avatar-upload">
                                                <div class="rounded-full p-2 ring ring-primary">
                                                <i class="fas fa-plus text-primary cursor-pointer"></i>
                                                </div>
                                            </label>
                                            <input type="file" id="avatar-upload" name="avatar-upload" class="hidden" accept=".png, .jpeg, .jpg" onchange="showFileName(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <span id="file-name" class="hidden text-lg text-gray-500 mt-4 dark:text-white"></span>
                                </div>

                                <div>
                                    <input type="text" name="userFirstName" id="userFirstName" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-lg rounded-lg block w-full p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" placeholder="Saisissez votre prénom *" >
                                </div>
                                <div>
                                    <input type="text" name="userLastName" id="userLastName" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-lg rounded-lg block w-full p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" placeholder="Saisissez votre nom *" >
                                </div>
                                <div>
                                    <input type="number" name="userTelephone" id="userTelephone" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-lg rounded-lg block w-full p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" placeholder="Saisissez votre numéro de téléphone *" >
                                </div>
                                <div id="step3-freelance-city" class="flex">    
                                    <div class="relative city-search-container w-full mr-4">
                                        <input type="text" id="citySearch" name="userVille" placeholder="Cherchez votre ville" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-lg rounded-lg block w-full p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" placeholder="Saisissez votre localisation *" >
                                            <div id="cities-list" class="absolute z-10 mt-2 w-full  rounded bg-white max-h-64 overflow-y-auto text-black"></div>
                                    </div>
                                    <div class="flex items-center py-2.5 px-4 px- border border-gray-200 rounded dark:border-gray-700">
                                        <input type="checkbox" id="userEtranger" name="userEtranger">
                                        <label class="ml-2 text-gray-500 dark:text-gray-400">Étranger</label>
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <!-- button for previous step -->
                                    <button type="button" class="w-1/2 mr-2 text-primary border border-primary hover:text-white hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center" id="previousButton" onclick="goToStep2()">Retour</button>
                                    <!-- button for next step -->
                                    <button type="button" class="w-1/2 ml-2 text-white bg-primary hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center" id="nextButton" onclick="goToStep4()">Suivant</button>
                                </div>
                                <p id="errorMessage2" class="text-red-500 text-lg mt-2 hidden">Veuillez remplir tous les champs correctement</p>

                            </div>
                        </div>
                        </div>
                        <div id="step4" style="display: none;">
                        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:text-white">
                            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                <div class="flex items-center">
                                    <h2 class="text-2xl font-bold mb-2 leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white" style="width: 60%;">
                                    Tes Préférences
                                    </h2>
                                    <div class="relative flex flex-grow ml-4 items-center w-full h-2 bg-primary-light rounded-md" style="width: 40%;">
                                        <div class="font-bold absolute top-0 right-0 transform -translate-y-full text-primary rounded-md py-2 px-4 text-lg">
                                            3/5
                                        </div>
                                        <div class="absolute inset-0 bg-secondary rounded-md" style="width: 100%;"></div>
                                        <div class="absolute inset-0 bg-primary rounded-md" style="width: 60%;"></div>
                                    </div>
                                </div>
                                <div id="step4-esn" class="space-y-4 md:space-y-6">
                                </div>
                                <div id="step4-freelance" class="space-y-4 md:space-y-6">   
                                    <div class="relative job-search-container w-full">
                                        <input type="text" id="jobSearch" name="userJob" placeholder="Cherchez votre métier" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-lg rounded-lg block w-full p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500">
                                            <div id="jobs-list" class="absolute z-10 mt-2 w-full  rounded bg-white max-h-64 overflow-y-auto text-black"></div>
                                    </div>
                                    <div>
                                        <input type="number" name="userTJM" id="userTJM" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-lg rounded-lg block w-full p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" placeholder="Saisissez votre TJM € *" min="100" >
                                    </div>
                                    <div>
                                        <label for="userJobType" class="block mb-2 font-medium text-gray-900 dark:text-white">Type de poste</label>
                                        <div class="flex flex-1 gap-2 mb-3">
                                            <div class="flex items-center px-2 border border-gray-200 rounded dark:border-gray-700 w-full">
                                                <input id="teletravail" type="radio" value="Remote" name="userJobType" class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" >
                                                <label for="teletravail" class="py-4 ml-2  font-medium text-lg text-gray-500 dark:text-white">Télétravail</label>
                                            </div>
                                            <div class="flex items-center px-2 border border-gray-200 rounded dark:border-gray-700 w-full">
                                                <input id="hybride" type="radio" value="Hybride" name="userJobType" class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="hybride" class="py-4 ml-2  font-medium text-lg text-gray-500 dark:text-white">Hybride</label>
                                            </div>
                                            <div class="flex items-center px-2 border border-gray-200 rounded dark:border-gray-700 w-full">
                                                <input id="sur-site" type="radio" value="Physique" name="userJobType" class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="sur-site" class="py-4 ml-2  font-medium text-lg text-gray-500 dark:text-white">Physique</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="userExpertise" class="block mb-2 font-medium text-gray-900 dark:text-white">Votre expertise *</label>
                                        <select id="userExpertise" name="userExpertise" class="font-medium mb-2 bg-gray-50 border border-gray-300 text-lg text-gray-500 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                                            <option class="dark:text-black" value="junior">Junior (1 à 2 ans)</option>
                                            <option class="dark:text-black" value="intermediaire">Intermédiaire (3 à 5 ans)</option>
                                            <option class="dark:text-black" value="expert">Expert (+ 5 ans)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="userJobTime" class="block mb-2 font-medium text-gray-900 dark:text-white">Durée de la mission</label>
                                        <select id="userJobTime" name="userJobTime" class="font-medium mb-2 bg-gray-50 border border-gray-300 text-lg text-gray-500 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                                            <option class="dark:text-black" value="Courte Durée">Courte Durée</option>
                                            <option class="dark:text-black" value="Longue Durée">Longue Durée</option>
                                            <option class="dark:text-black" value="expert">Durée indéfinie</option>
                                        </select>
                                    </div>
                                </div>
                                <p id="errorMessage3" class="text-red-500 text-lg mt-2 hidden">Veuillez remplir tous les champs correctement</p>
                                <p id="tjmErrorMessage" class="text-red-500 text-lg mt-2 hidden">Le TJM doit être supérieur à 100</p>

                                <div class="flex justify-between">
                                    <!-- button for previous step -->
                                    <button type="button" class="w-1/2 mr-2 text-primary border border-primary hover:text-white hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center" id="previousButton" onclick="goToStep3()">Retour</button>
                                    <!-- button for next step -->
                                    <button type="button" class="w-1/2 ml-2 text-white bg-primary hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center" id="nextButton" onclick="goToStep5()">Suivant</button>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div id="step5" style="display:none; height:80%;">
                        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:text-white">
                            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                <div class="flex items-center">
                                    <h2 class="text-2xl font-bold mb-2 leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white" style="width: 60%;">
                                    Tes Expertises
                                    </h2>
                                    <div class="relative flex flex-grow ml-4 items-center w-full h-2 bg-primary-light rounded-md" style="width: 40%;">
                                        <div class="font-bold absolute top-0 right-0 transform -translate-y-full text-primary rounded-md py-2 px-4 text-lg">
                                            4/5
                                        </div>
                                        <div class="absolute inset-0 bg-secondary rounded-md" style="width: 100%;"></div>
                                        <div class="absolute inset-0 bg-primary rounded-md" style="width: 80%;"></div>
                                    </div>
                                </div>
                                <div>
                                    <label for="userBio" class="block mb-2 font-medium text-gray-900 dark:text-white">À propos de toi</label>
                                    <div>
                                        <textarea id="userBio" name="userBio" rows="2" class="bg-gray-50 border border-gray-300 text-lg text-gray-500  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <p class="text-lg text-gray-500 mr-3 dark:text-gray-400">Êtes-vous disponible à travailler dès maintenant ?</p>
                                    <label class="text-lg text-gray-500 mr-3 dark:text-gray-400">Non</label>
                                    <input type="checkbox" name="userIsAvailable" id="hs-basic-with-description" class="relative shrink-0 w-[3.25rem] h-7 bg-gray-100 checked:bg-gray-100 rounded-full cursor-pointer transition-colors ease-in-out duration-200 border border-transparent ring-1 ring-transparent focus:border-green-600 focus:ring-green-600 ring-offset-white focus:outline-none appearance-none dark:bg-gray-700 dark:checked:bg-green-600 dark:focus:ring-offset-gray-800 before:inline-block before:w-6 before:h-6 before:bg-white checked:before:bg-green-500 before:translate-x-0 checked:before:translate-x-full before:shadow before:rounded-full before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-gray-400">
                                    <label class="text-lg text-gray-500 ml-3 dark:text-gray-400">Oui</label>
                                </div>
                                <select id="userJobTimePartielOrFullTime" name="userJobTimePartielOrFullTime" class="font-medium mb-2 bg-gray-50 border border-gray-300 text-lg text-gray-500 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                                    <option class="dark:text-black" value="temps-plein">Temps plein</option>
                                    <option class="dark:text-black" value="temps-partiel">Temps partiel</option>
                                </select>

                                <div class="flex justify-between">
                                    <!-- button for previous step -->
                                    <button type="button" class="w-1/2 mr-2 text-primary border border-primary hover:text-white hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center" id="previousButton" onclick="goToStep4()">Retour</button>
                                    <!-- button for next step -->
                                    <button type="button" class="w-1/2 ml-2 text-white bg-primary hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center" id="nextButton" onclick="goToStep6()">Suivant</button>
                                </div>
                                <p id="errorMessage4" class="text-red-500 text-lg mt-2 hidden">Veuillez remplir tous les champs correctement</p>
                            </div>
                        </div>
                        </div>
                        <div id="step6" style="display:none; height:80%;">
                        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:text-white">
                            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                <div class="flex items-center">
                                    <h2 class="text-2xl font-bold mb-2 leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white" style="width: 60%;">
                                    Finales ton inscription
                                    </h2>
                                    <div class="relative flex flex-grow ml-4 items-center w-full h-2 bg-primary-light rounded-md" style="width: 40%;">
                                        <div class="font-bold absolute top-0 right-0 transform -translate-y-full text-primary rounded-md py-2 px-4 text-lg">
                                            5/5
                                        </div>
                                        <div class="absolute inset-0 bg-secondary rounded-md" style="width: 100%;"></div>
                                        <div class="absolute inset-0 bg-primary rounded-md" style="width: 100%;"></div>
                                    </div>
                                </div>
                                <!-- submit -->                                        
                                    <div class="flex justify-between">
                                        <button type="button" class="w-1/2 mr-2 text-primary border border-primary hover:text-white hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center" id="previousButton" onclick="goToStep5()">Retour</button>
                                        <button type="submit" class="w-1/2 ml-2 text-white bg-primary hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center" id="submitButton">S'inscrire</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="<?php echo base_url('/node_modules/choices.js/public/assets/scripts/choices.min.js'); ?>"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js@10.0.0"></script>
    <script src="<?php echo base_url('assets/js/app.js'); ?>"></script>


    <script>


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
            placeholderValue: 'Sélectionnez des compétences',
            allowHTML: true,
            /* options spécifiques à Choices */
        });
    }

$(document).ready(function() {
    
    $('#citySearch').on('keyup', function() {
        let term = $(this).val();
        if(term.length > 2) { // Recherche après 2 caractères
            $.post('register/search_cities', { term: term }, function(data) {
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

    $('#userEtranger').change(function() {
        if ($(this).is(':checked')) {
            // Si la case 'userEtranger' est cochée, vider le champ 'citySearch'
            $('#citySearch').val('');
        }
    });
    
    $('#jobSearch').on('keyup', function() {
        let term = $(this).val();
        if(term.length > 1) { // Recherche après 2 caractères
            $.post('register/search_jobs', { term: term }, function(data) {
                let jobs = JSON.parse(data);
                if(jobs.length > 0) {
                    // Ajoutez la classe .has-border si des résultats sont retournés
                    $('#jobs-list').addClass('has-border');
                } else {
                    // Supprimez la classe .has-border si aucun résultat n'est retourné
                    $('#jobs-list').removeClass('has-border');
                }
                $('#jobs-list').empty();
                jobs.forEach(function(job) {
                    $('#jobs-list').append(`<div class="job-item p-2 hover:bg-gray-200 cursor-pointer" data-id="${job.jobId}">${job.jobName}</div>`);
                });
            });
        }
        else {
            // Supprimez la classe .has-border si l'input est trop court
            $('#jobs-list').removeClass('has-border').empty();
        }
    });

    $(document).on('click', '.job-item', function() {
        let jobName = $(this).text();
        $('#jobSearch').val(jobName);  // Mettez à jour le champ de saisie avec le nom de la ville sélectionnée
        $('#jobs-list').empty(); // Videz la liste
        $('#jobs-list').removeClass('has-border').empty();
    });

    // Pour fermer la liste lorsque vous cliquez en dehors
    $(document).on('click', function(event) {
        // Si le clic n'est pas sur le champ de saisie (#citySearch)
        // et n'est pas sur un élément à l'intérieur de la liste (#cities-list)...
        if (!$(event.target).closest('#citySearch, #cities-list').length) {
            // ... alors videz et fermez la liste.
            $('#cities-list').empty().removeClass('has-border');
        }
        
        if (!$(event.target).closest('#jobSearch, #jobs-list').length) {
            // ... alors videz et fermez la liste.
            $('#jobs-list').empty().removeClass('has-border');
        }
    });

});

function showFileName(input) {
  const fileNameElement = document.getElementById("file-name");
  const avatarImageElement = document.getElementById("avatar-image");

  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      avatarImageElement.src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);

    fileNameElement.textContent = input.files[0].name;
    fileNameElement.classList.remove("hidden");
  } else {
    fileNameElement.textContent = "";
    fileNameElement.classList.add("hidden");
  }
}


    var activeElement = null;

function selectChoice(choice) {
    document.getElementById("userType").value = choice;
    console.log(document.getElementById("userType").value);
}

function changeTextColor(element, isActive) {
    var textElement = element.querySelector("h2");
    if (isActive) {
        textElement.classList.add("text-white");
        element.classList.add("bg-primary");
    } else {
        textElement.classList.remove("text-white");
        element.classList.remove("bg-primary");
    }
}

function handleClick(element) {
    if (element === activeElement) {
        return;
    }

    if (activeElement) {
        changeTextColor(activeElement, false);
    }

    changeTextColor(element, true);
    selectChoice(element.dataset.choice);
}

    


        const images = [
            '<?php echo base_url('assets/img/cc-1.png');?>',
            '<?php echo base_url('assets/img/cc-2.png');?>',
            '<?php echo base_url('assets/img/cc-3.png');?>',
            '<?php echo base_url('assets/img/cc-4.png');?>'
        ];

        let currentImageIndex = 0;
        const imageElement = document.querySelector('.image-rotation');

        imageElement.style.opacity = 1; // Affiche la première image au chargement de la page

        setInterval(() => {
            currentImageIndex = (currentImageIndex + 1) % images.length;
            imageElement.style.opacity = 0;

            setTimeout(() => {
                imageElement.src = images[currentImageIndex];
                imageElement.style.opacity = 1;
            }, 500);
        }, 5000);


        var base_url = '<?php echo base_url(); ?>';

        window.addEventListener('load', function() {
            // Cacher le loader une fois le chargement de la page terminé
            document.getElementById('loaderOverlay').style.display = 'none';
        });

        const togglePasswordCheckbox = document.getElementById('togglePasswordCheckbox');
        const passwordInput = document.getElementById('userPassword');
        const confirmPasswordInput = document.getElementById('confirmPassword');

        togglePasswordCheckbox.addEventListener('change', function () {
            if (togglePasswordCheckbox.checked) {
                passwordInput.setAttribute('type', 'text');
                confirmPasswordInput.setAttribute('type', 'text');
            } else {
                passwordInput.setAttribute('type', 'password');
                confirmPasswordInput.setAttribute('type', 'password');
            }
        });

        // Dark mode

        var body = document.body;
        var logoImg = document.getElementById('logoLogin');

        // Fonction pour mettre à jour le thème du corps
        function updateBodyTheme() {
            if (localStorage.getItem('color-theme') === 'dark' || (!localStorage.getItem('color-theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                body.classList.add('dark');
            } else {
                body.classList.remove('dark');
            }
        }

        // Fonction pour changer le logo en fonction du thème
        function updateLogoTheme() {
            if (localStorage.getItem('color-theme') === 'dark' || (!localStorage.getItem('color-theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                // Chemin vers le logo sombre
                logoImg.src = base_url + 'assets/img/logo-light.svg';
            } else {
                // Chemin vers le logo clair
                logoImg.src = base_url + 'assets/img/logo.svg';
            }
        }

        // Appeler les fonctions au chargement de la page
        window.addEventListener('DOMContentLoaded', function() {
            updateBodyTheme();
            updateLogoTheme();
        });

        // Écouter les changements de préférence du système de couleur
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
            updateBodyTheme();
            updateLogoTheme();
        });

        function checkEmailAvailability(email, callback) {
            var emailInput = document.getElementById('userEmail');
            var emailError = document.getElementById('emailError');

            // Vérifiez si l'e-mail est vide
            if (email.trim() === '') {
                emailInput.classList.remove('border-red-500');
                emailError.textContent = '';
                callback(false);
                return;
            }

            // Envoie d'une requête AJAX pour vérifier l'e-mail
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo base_url('register/checkEmailExists'); ?>', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.status === 'error') {
                            emailInput.classList.add('border-red-500');
                            emailError.textContent = response.message;
                            callback(true); // L'e-mail existe déjà
                        } else {
                            emailInput.classList.remove('border-red-500');
                            emailError.textContent = '';
                            callback(false); // L'e-mail n'existe pas
                        }
                    }
                }
            };
            xhr.send('userEmail=' + email);
        }


        function checkPasswordStrength(userPassword) {
            var strength = 0;

            if (userPassword.length >= 8) {
                // Vérifier si le mot de passe contient au moins une lettre minuscule
                if (/[a-z]/.test(userPassword)) {
                    strength += 1;
                }

                // Vérifier si le mot de passe contient au moins une lettre majuscule
                if (/[A-Z]/.test(userPassword)) {
                    strength += 1;
                }

                // Vérifier si le mot de passe contient au moins un chiffre
                if (/\d/.test(userPassword)) {
                    strength += 1;
                }

                // Vérifier si le mot de passe contient au moins un caractère spécial
                if (/[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/.test(userPassword)) {
                    strength += 1;
                }
            }

            // Mettre à jour la barre de progression
            var passwordStrengthMeterFill = document.querySelector('.password-strength-meter-fill');
            var passwordStrengthMeter = document.querySelector('.password-strength-meter');
            passwordStrengthMeterFill.style.width = (strength * 25) + '%';

            // Mettre à jour la couleur de la barre de progression
            passwordStrengthMeterFill.classList.remove('password-strength-weak', 'password-strength-medium', 'password-strength-strong');
            if (strength === 0) {
                passwordStrengthMeterFill.classList.add('password-strength-weak');
            } else if (strength === 1 || strength === 2) {
                passwordStrengthMeterFill.classList.add('password-strength-medium');
            } else if (strength >= 3) {
                passwordStrengthMeterFill.classList.add('password-strength-strong');
            }

            // Mettre à jour le texte de la force du mot de passe
            var passwordError = document.getElementById('passwordError');
            if (strength === 0) {
                passwordError.textContent = 'Mot de passe faible';
                passwordError.classList.remove('password-strength-medium-text', 'password-strength-strong-text');
                passwordError.classList.add('password-strength-weak-text');
            } else if (strength === 1 || strength === 2) {
                passwordError.textContent = 'Mot de passe moyen';
                passwordError.classList.remove('password-strength-weak-text', 'password-strength-strong-text');
                passwordError.classList.add('password-strength-medium-text');
            } else if (strength >= 3) {
                passwordError.textContent = 'Mot de passe fort';
                passwordError.classList.remove('password-strength-weak-text', 'password-strength-medium-text');
                passwordError.classList.add('password-strength-strong-text');
            }

            if (strength >=3){
                return true;
            } else {
                return false;
            }
        }

        function checkPasswordMatch() {
            var passwordInput = document.getElementById('userPassword');
            var confirmPasswordInput = document.getElementById('confirmPassword');
            var confirmPasswordError = document.getElementById('confirmPasswordError');

            var password = passwordInput.value;
            var confirmPassword = confirmPasswordInput.value;

            if (password === confirmPassword) {
                confirmPasswordInput.classList.remove('border-red-500');
                confirmPasswordError.textContent = '';
                return true;
            } else {
                confirmPasswordInput.classList.add('border-red-500');
                confirmPasswordError.textContent = "Les mots de passe ne correspondent pas";
                return false;
            }
        }

        // function validateForm() {
        //     var emailInput = document.getElementById('userEmail');
        //     var emailError = document.getElementById('emailError');
        //     var passwordInput = document.getElementById('userPassword');
        //     var confirmPasswordInput = document.getElementById('confirmPassword');
        //     var confirmPasswordError = document.getElementById('confirmPasswordError');
        //     var nextButton = document.getElementById('nextButton');

        //     // Vérification de l'e-mail
        //     if (emailInput.value.trim() === '') {
        //         emailInput.classList.add('border-red-500');
        //         emailError.textContent = 'Veuillez saisir votre e-mail';
        //         nextButton.disabled = true;
        //         return false;
        //     }

        //     // Vérification du mot de passe
        //     if (passwordInput.value.trim() === '') {
        //         passwordInput.classList.add('border-red-500');
        //         nextButton.disabled = true;
        //         return false;
        //     }

        //     // Vérification de la confirmation du mot de passe
        //     if (confirmPasswordInput.value.trim() === '') {
        //         confirmPasswordInput.classList.add('border-red-500');
        //         confirmPasswordError.textContent = 'Veuillez confirmer votre mot de passe';
        //         nextButton.disabled = true;
        //         return false;
        //     }

        //     // Vérification de la correspondance des mots de passe
        //     if (passwordInput.value !== confirmPasswordInput.value) {
        //         confirmPasswordInput.classList.add('border-red-500');
        //         confirmPasswordError.textContent = 'Les mots de passe ne correspondent pas';
        //         nextButton.disabled = true;
        //         return false;
        //     }

        //     // Vérification de l'existence de l'e-mail
        //     var xhr = new XMLHttpRequest();
        //     xhr.open('POST', '<?php echo base_url('register/checkEmailExists'); ?>', false);
        //     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        //     xhr.onreadystatechange = function() {
        //         if (xhr.readyState === XMLHttpRequest.DONE) {
        //             if (xhr.status === 200) {
        //                 var response = JSON.parse(xhr.responseText);
        //                 if (response.status === 'error') {
        //                     emailInput.classList.add('border-red-500');
        //                     emailError.textContent = response.message;
        //                     nextButton.disabled = true;
        //                 } else {
        //                     emailInput.classList.remove('border-red-500');
        //                     emailError.textContent = '';
        //                     nextButton.disabled = false;
        //                 }
        //             }
        //         }
        //     };
        //     xhr.send('userEmail=' + emailInput.value);

        //     if (!nextButton.disabled) {
        //         goToStep2();
        //     }

        //     return !nextButton.disabled;
        // }

        function goToStep1(){
            var step1 = document.getElementById('step1');
            var step2 = document.getElementById('step2');
            var step3 = document.getElementById('step3');
            var step4 = document.getElementById('step4');
            var step5 = document.getElementById('step5');
            var step6 = document.getElementById('step6');

            step2.style.display = 'none';
            step3.style.display = 'none';
            step4.style.display = 'none';
            step5.style.display = 'none';
            step6.style.display = 'none';
            step1.style.display = 'block';
        }

        function goToStep2() {
            var userEmail = document.getElementById('userEmail').value;
            var password = document.getElementById('userPassword').value;
            var confirmPassword = document.getElementById('confirmPassword').value;
            var errorMessage1 = document.getElementById('errorMessage1');

            // Expression régulière pour valider le format de l'e-mail
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (userEmail.trim() === '' || password.trim() === '' || confirmPassword.trim() === '') {
                errorMessage1.style.display = 'block';
            } else if (!emailPattern.test(userEmail)) {
                // Vérifier si l'e-mail est dans le format valide
                errorMessage1.textContent = "Veuillez saisir une adresse e-mail valide";
                errorMessage1.style.display = 'block';
            } else {
                checkEmailAvailability(userEmail, function(exists) {
                    if (!exists && checkPasswordMatch() && checkPasswordStrength(password)) {
                        errorMessage1.style.display = 'none';
                        var step1 = document.getElementById('step1');
                        var step2 = document.getElementById('step2');
                        var step3 = document.getElementById('step3');
                        var step5 = document.getElementById('step5');
                        var step6 = document.getElementById('step6');
                        step1.style.display = 'none';
                        step3.style.display = 'none';
                        step4.style.display = 'none';
                        step5.style.display = 'none';
                        step6.style.display = 'none';
                        step2.style.display = 'block';
                    } else {
                        // L'e-mail existe déjà ou les mots de passe ne correspondent pas
                    }
                });
            }
        }



        function goToStep3() {
            var selectedRadio = document.querySelector('input[name="userType"]:checked').value;
            console.log("type", selectedRadio);
            var userTypeFreelance = document.getElementById('userTypeFreelance');
            var userTypeESN = document.getElementById('userTypeESN');
            var errorUserType = document.getElementById('errorUserType');
            var step1 = document.getElementById('step1');
            var step2 = document.getElementById('step2');
            var step3 = document.getElementById('step3');
            var step4 = document.getElementById('step4');
            var step5 = document.getElementById('step5');
            var step6 = document.getElementById('step6');

            if (userTypeFreelance.checked || userTypeESN.checked) {
                errorUserType.style.display = 'none';
                step1.style.display = 'none';
                step2.style.display = 'none';
                step4.style.display = 'none';
                step5.style.display = 'none';
                step6.style.display = 'none';
                step3.style.display = 'block';
            } else {
                errorUserType.style.display = 'block';
            }
        }


        function goToStep4() {
            var userFirstName = document.getElementById('userFirstName').value;
            var userLastName = document.getElementById('userLastName').value;
            var userVille = document.getElementById('citySearch').value;
            var userTelephone = document.getElementById('userTelephone').value;
            var errorMessage2 = document.getElementById('errorMessage2');

            if (
                userFirstName.trim() === '' ||
                userLastName.trim() === '' ||
                userVille.trim() === '' ||
                userTelephone.trim() === ''
            ) {
                errorMessage2.style.display = 'block';
            } else if (parseInt(userTJM) <= 100) {
                errorMessage2.style.display = 'none';
            } else {
                errorMessage2.style.display = 'none';
                var step1 = document.getElementById('step1');
                var step2 = document.getElementById('step2');
                var step3 = document.getElementById('step3');
                var step4 = document.getElementById('step4');
                var step5 = document.getElementById('step5');
                var step6 = document.getElementById('step6');
                step1.style.display = 'none';
                step2.style.display = 'none';
                step3.style.display = 'none';
                step5.style.display = 'none';
                step6.style.display = 'none';
                step4.style.display = 'block';
            }
        }
        
        function goToStep5() {
            var userTJM = document.getElementById('userTJM').value;
            var userJobTypes = document.getElementsByName('userJobType');
            var jobTypeSelected = false;
            var errorMessage3 = document.getElementById('errorMessage3');
            var tjmErrorMessage = document.getElementById('tjmErrorMessage');

            for (var i = 0; i < userJobTypes.length; i++) {
                if (userJobTypes[i].checked) {
                    jobTypeSelected = true;
                    break;
                }
            }

            if (
                userTJM.trim() === '' ||
                !jobTypeSelected
            ) {
                errorMessage3.style.display = 'block';
                tjmErrorMessage.style.display = 'none';
            } else if (parseInt(userTJM) <= 100) {
                errorMessage3.style.display = 'none';
                tjmErrorMessage.style.display = 'block';
            } else {
                errorMessage3.style.display = 'none';
                tjmErrorMessage.style.display = 'none';
                var step1 = document.getElementById('step1');
                var step2 = document.getElementById('step2');
                var step3 = document.getElementById('step3');
                var step4 = document.getElementById('step4');
                var step5 = document.getElementById('step5');
                var step6 = document.getElementById('step6');
                step1.style.display = 'none';
                step2.style.display = 'none';
                step3.style.display = 'none';
                step4.style.display = 'none';
                step6.style.display = 'none';
                step5.style.display = 'block';
            }
        }
        
        function goToStep6() {
            var userBio = document.getElementById('userBio').value;
            var errorMessage4 = document.getElementById('errorMessage4');

            if (
                userBio.trim() === '' 
            ) {
                errorMessage4.style.display = 'block';
            } else {
                errorMessage4.style.display = 'none';
                var step1 = document.getElementById('step1');
                var step2 = document.getElementById('step2');
                var step3 = document.getElementById('step3');
                var step4 = document.getElementById('step4');
                var step5 = document.getElementById('step5');
                var step6 = document.getElementById('step6');
                step1.style.display = 'none';
                step2.style.display = 'none';
                step3.style.display = 'none';
                step4.style.display = 'none';
                step5.style.display = 'none';
                step6.style.display = 'block';
            }
        }

    </script>
</body>
</html>
