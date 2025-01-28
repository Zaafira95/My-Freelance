<?php
// Header Call
$currentPage = 'settings';

include(APPPATH . 'views/layouts/user/header.php' );
?>
<head>
    <title><?='Paramètres '.$user->userFirstName.' '.$user->userLastName.' '.ucfirst($user->userType)?>  - Café Crème Community </title>

<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">
<link href="<?php echo base_url('/node_modules/choices.js/public/assets/styles/choices.min.css');?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('/node_modules/intl-tel-input/build/css/intlTelInput.min.css');?>">



<style>
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


<div class="absolute hidden top-0 right-4 mt-4 mb-4">
    <svg id="heart" class="w-5 h-5 text-red-600 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 30" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.879c-2.484-4.375-12-1.82-12 4.879 0 5.572 5.126 7.664 12 14.121 6.874-6.457 12-8.549 12-14.121 0-6.699-9.516-9.254-12-4.879z"/>
    </svg>
</div>
<?php
// Rating
$totalStars = 0;
$totalCount = 0;
foreach ($ratings as $rating) {
  $totalStars += $rating->ratingStars;
  $totalCount += 1;
}
if ($totalCount > 0) {
  $averageStars = $totalStars / $totalCount;
} else {
  $averageStars = 0;
}
?>

<div class="px-4 lg:px-6 py-6 h-full overflow-y-auto no-scrollbar">
    <div class="flex flex-wrap justify-between mx-auto max-w-screen-xl h-full">
        <div class="h-full w-full mb-3">
            <div class="rounded-lg w-full mb-4 dark:text-white">
                <div class="relative flex grid-cols-2 items-center overflow-hidden bg-white rounded-lg mb-4 dark:bg-gray-800 py-4 px-4">
                <div class="flex flex-1">
                        <div>
                            <img src="<?php echo base_url($user->userAvatarPath); ?>" class="object-cover w-40 h-40 rounded-full" alt="Photo de profil">
                        </div>
                        <div class="ml-4">
                            <div class="flex">
                                <h1 class="text-5xl font-bold" id="userFirstName"><?=$user->userFirstName?></h1>
                                    <?php 
                                    // capitalize user last name
                                    $userLastName = $user->userLastName;
                                    $userLastName = strtoupper($userLastName);
                                    ?>
                                    <h1 class="text-5xl font-bold ml-2" id="userLastName"><?=$userLastName?></h1>
                            </div>
                            <p class="text-3xl lg:text-2xl text-black-500 font-bold"><?=$job->jobName?></p>
                            <div class="flex items-center mb-4">
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                <?php if ($i <= $averageStars) { ?>
                                    <img src="<?php echo base_url('assets/img/fill-star.svg'); ?>" class="w-6 h-6">
                                <?php } else { ?>
                                    <img src="<?php echo base_url('assets/img/light-star.svg'); ?>" class="w-6 h-6">
                                <?php } ?>
                                <?php } ?>
                                    <p class="ml-2 text-3xl lg:text-base"><?=round($averageStars, 1).' ( '.$ratingCount.' avis )'?></p>
                            </div>
                        <!-- Whatsapp -->
                        <div class="flex flex-wrap items-center">
                                <!-- Whatsapp -->
                            <a href="https://wa.me/<?=$user->userTelephone?>?text=Bonjour%20<?=$user->userFirstName?>%20!%20Je%20suis%20intéressé%20par%20votre%20profil%20sur%20Café%20Crème%20Community%20!%20" target="_blank">
                            
                            <button type="button" data-te-ripple-init data-te-ripple-color="light"
                                class="mb-2 mr-4 inline-flex items-center rounded-full px-6 py-2.5 leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg"
                                style="background-color: #25D366">
                                <span class="mr-2">Contacter</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                </svg>
                                </button>
                            </a>
                                <p class="mb-2 mt-2 inline-block px-4 py-2.5 rounded-full bg-primary text-white"><?=$user->userTJM?> € / Jour</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:flex flex-1">
                    <div class="rounded-lg lg:h-full lg:w-1/2 mb-4 lg:mr-4 dark:text-white">
                        <div class="relative lg:flex grid-cols-2 items-center overflow-hidden bg-white lg:h-full w-full rounded-lg mb-4 dark:bg-gray-800 py-8 px-4">
                            <ul class="w-full">
                            <li class="tab-item mb-8 w-full flex"> <a href="#user-data" class="tab-link px-6 text-3xl lg:text-lg font-bold w-full text-primary"><i class="far fa-user mr-4"></i>Informations personnelles</a></li>
                            <li class="tab-item mb-8 w-full flex"> <a href="#user-password" class="tab-link px-6 text-3xl lg:text-lg w-full"><i class="far fa-eye mr-4"></i>Mot de passe</a></li>                            
                        </ul>
                    </div>
                </div>
                <div class="rounded-lg lg:h-full lg:w-3/4 mb-4 dark:text-white">
                    <div class="form-container relative flex grid-cols-2 items-center overflow-hidden bg-white rounded-lg mb-4 dark:bg-gray-800 py-4 px-4">
                        <div id="user-data" class="px-6 space-y-4 md:space-y-6 w-full">
                            <form method="post" action="<?php echo base_url('user/updateUserDataSettings'); ?>" id="updateUserDataSettingsForm" enctype="multipart/form-data">
                                <label for="userFirstName" class="text-3xl lg:text-base block font-medium text-gray-900 dark:text-white">Votre prénom *</label>
                                <input type="text" name="userFirstName" id="userFirstName" value="<?=$user->userFirstName?>" class="text-3xl lg:text-base w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required>

                                <label for="userLastName" class="text-3xl lg:text-base block font-medium text-gray-900 dark:text-white">Votre nom *</label>
                                <input type="text" name="userLastName" id="userLastName" value="<?=$user->userLastName?>" class="text-3xl lg:text-base w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required>

                                <label for="userTelephone" class="text-3xl lg:text-base  block font-medium text-gray-900 dark:text-white"> Votre numéro WhatsApp *</label>
                                <input type="tel" name="userTelephone" id="userTelephone" value="<?=$user->userTelephone?>" class="text-3xl lg:text-base  w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required>    
                                <p id="errorUserTelephone" class="text-red-500 text-3xl lg:text-base mt-2 hidden mb-4 ">Veuillez renseigner un numéro de téléphone valide</p>

                                <label for="userEmail" class="text-3xl lg:text-base block mt-4 font-medium text-gray-900 dark:text-white">Votre email *</label>
                                <input type="email" name="userEmail" id="userEmail" value="<?=$user->userEmail?>" class="text-3xl lg:text-base w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" disabled>    

                                <button type="submit" class="text-3xl lg:text-base text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg px-5 py-2.5 mt-4 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    Valider
                                </button>
                            </form>
                        </div>
                        <div id="user-password" class="px-6 space-y-4 md:space-y-6 6 w-full h-full hidden">
                            <form id="updatePassword-form" method="post" action="<?php echo base_url('user/updateUserPassword'); ?>" enctype="multipart/form-data">

                            <label for="userCurrentPassword" class="text-3xl lg:text-base block font-medium text-gray-900 dark:text-white">Saisissez votre mot de passe actuel *</label>
                            <input type="password" name="userCurrentPassword" id="userCurrentPassword" class="text-3xl lg:text-base w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" oninput="checkCurrentPassword(this.value)" required> 
                            <p id="currentPasswordError" class="text-3xl lg:text-base text-red-500"></p>
                            
                            <label for="userPassword" class="text-3xl lg:text-base block font-medium text-gray-900 dark:text-white">Saisissez votre nouveau mot de passe *</label>
                            <input type="password" name="userPassword" id="userPassword" class="text-3xl lg:text-base w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required oninput="checkPasswordStrength(this.value)"> 
                            <label for="confirmPassword" class="text-3xl lg:text-base block font-medium text-gray-900 dark:text-white">Confirmez votre nouveau mot de passe *</label>
                            <input type="password" name="confirmPassword" id="confirmPassword" class="text-3xl lg:text-base w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required  oninput="checkPasswordMatch()"> 

                            <div>
                                <p id="confirmPasswordError" class="text-3xl lg:text-base text-red-500"></p>
                            </div>

                            <div class="password-strength-meter">
                                <div class="password-strength-meter-fill"></div>
                            </div>
                            <p id="passwordError" class="text-3xl lg:text-base text-red-500"></p>
                            <div>
                                <input type="checkbox" id="togglePasswordCheckbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox text-primary rounded mr-2">
                                <label for="togglePasswordCheckbox" class="text-3xl lg:text-base font-medium text-gray-900 dark:text-white">Afficher le mot de passe</label>
                            </div>
                                <!-- Autres champs d'informations personnelles -->
                                
                                <button id="passwordSubmit" type="submit" class="text-3xl lg:text-base text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg px-5 py-2.5 mt-4 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    Valider
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Script JS -->

<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="<?php echo base_url('/node_modules/intl-tel-input/build/js/intlTelInput.min.js'); ?>"></script>
<script src="<?php echo base_url('/node_modules/intl-tel-input/build/js/intlTelInput.js'); ?>"></script>
<script src="<?php echo base_url('/node_modules/intl-tel-input/build/js/utils.js'); ?>"></script>


<script>

    var base_url = '<?php echo base_url(); ?>'; // Assurez-vous que PHP est exécuté correctement ici

    var input = document.querySelector("#userTelephone");
    var iti = window.intlTelInput(input, {
        preferredCountries: ['us', 'fr', 'ae'],
        utilsScript: base_url + "node_modules/intl-tel-input/build/js/utils.js"
    });



    document.querySelector("#updateUserDataSettingsForm").addEventListener("submit", function(event) {
        
        var errorMap = ["Numéro invalide", "Code de pays invalide", "Trop court", "Trop long", "Numéro invalide"];
        
        if (iti.isValidNumber()) {
            var phoneNumber = iti.getNumber();
            input.value = phoneNumber;
        } else {
            var errorCode = iti.getValidationError();
            event.preventDefault();
            document.getElementById("errorUserTelephone").style = "display:block"; 
        }
    });

    $(document).ready(function () {

    // Cacher tous les formulaires sauf le premier au chargement de la page
    $(".form-container > div:not(:first-child)").hide();

    // Gérer le changement d'onglet lorsque l'utilisateur clique sur un lien d'onglet
    $(".tab-link").click(function (event) {
        event.preventDefault();
        var target = $(this).attr("href");
        $(".form-container > div").hide();
        $(target).fadeIn();

        // Supprimer la classe "text-gray-400" de tous les liens avec la classe "tab-link"
        $(".tab-link").removeClass("font-bold text-primary");
        // Ajouter la classe "text-gray-400" à l'élément cliqué
        $(this).addClass("font-bold text-primary");

        // Mettre à jour l'URL sans recharger la page
        history.pushState(null, null, target);
    });

    // Gérer le retour en arrière du navigateur
    window.addEventListener('popstate', function (event) {
        // Récupérer l'ancien état de l'URL et afficher la section correspondante
        var target = window.location.hash;
        $(".form-container > div").hide();
        $(target).fadeIn();

        // Rétablir la classe "text-gray-400" à tous les liens avec la classe "tab-link"
        $(".tab-link").addClass("text-gray-400");
        // Ajouter la classe "text-gray-400" à l'élément correspondant à l'onglet actif
        $("a[href='" + target + "']").removeClass("text-gray-400");
    });
});


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
        document.getElementById("passwordSubmit").removeAttribute("disabled");
        confirmPasswordInput.classList.remove('border-red-500');
        confirmPasswordError.textContent = '';
        return true;
    } else {
        document.getElementById("passwordSubmit").setAttribute("disabled", "true");
        confirmPasswordInput.classList.add('border-red-500');
        confirmPasswordError.textContent = "Les mots de passe ne correspondent pas";
        return false;
    }
}

const togglePasswordCheckbox = document.getElementById('togglePasswordCheckbox');
const passwordInput = document.getElementById('userPassword');
const confirmPasswordInput = document.getElementById('confirmPassword');
const userCurrentPasswordInput = document.getElementById('userCurrentPassword');

togglePasswordCheckbox.addEventListener('change', function () {
    if (togglePasswordCheckbox.checked) {
        passwordInput.setAttribute('type', 'text');
        confirmPasswordInput.setAttribute('type', 'text');
        userCurrentPasswordInput.setAttribute('type', 'text');
    } else {
        passwordInput.setAttribute('type', 'password');
        confirmPasswordInput.setAttribute('type', 'password');
        userCurrentPasswordInput.setAttribute('type', 'password');
    }
});


function showModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.remove('hidden');
}

function hideModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.add('hidden');
}


function checkCurrentPassword(password) {
    var passwordInput = document.getElementById('userCurrentPassword');
    var passwordError = document.getElementById('currentPasswordError');

    // Vérifiez si le mot de passe est vide
    if (password.trim() === '') {
        passwordInput.classList.remove('border-red-500');
        passwordError.textContent = '';
        return;
    }

    // Envoie d'une requête AJAX pour vérifier le mot de passe
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?php echo base_url('user/checkCurrentPassword'); ?>', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'error') {
                    passwordInput.classList.add('border-red-500');
                    passwordError.textContent = response.message;
                } else {
                    passwordInput.classList.remove('border-red-500');
                    passwordError.textContent = '';
                }
            }
        }
    };
    xhr.send('userCurrentPassword=' + password);
}

$('#updatePassword-form').on('submit', function(event) {
    var passwordError = document.getElementById('currentPasswordError');

    if (passwordError.textContent != '') {
        event.preventDefault(); // Empêcher la soumission du formulaire
    }
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

