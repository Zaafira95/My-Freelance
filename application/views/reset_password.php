<!DOCTYPE html>
<html>
<head>
    <title>Réinitialisez votre mot de passe | Café Crème Community</title>
    <link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
    <link rel="icon" href="<?php echo base_url('assets/img/Favicon.ico'); ?>" type="image/x-icon">

    <style>
        /* body {
            background-color: #ffffff;
        } */
        .image-rotation {
            transition: opacity 0.5s ease;
            opacity: 0;
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
    </style>
</head>
<body>
<?php if ($this->session->flashdata('message')) : ?>
    <div class="text-3xl lg:text-base flashdata <?php echo $this->session->flashdata('status') === 'error' ? 'error' : 'success'; ?>">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
    <script>
        setTimeout(function() {
            var flashdata = document.querySelector('.flashdata');
            flashdata.style.animation = 'slideOutRight 1s';
            setTimeout(function() {
                flashdata.style.display = 'none';
            }, 1000);
        }, 3000);
    </script>
<?php endif; ?>
<section class="h-screen">
  <div class="container h-full px-6 mx-auto max-w-screen-xl">
    <div class="g-6 flex h-full flex-wrap items-center justify-center lg:justify-between">
      <!-- Left column container with background-->
      <!-- Left column container with background-->
      <div class="hidden lg:block md:w-8/12 lg:w-6/12">
          <img
          src="<?php echo base_url('assets/img/cc-2.png');?>"
          class="w-full image-rotation"
          alt="Login Image with quote" />
      </div>
      <!-- <div class="hidden md:block bg-red-500">
        <p>Je ne devrais être visible que sur les écrans moyens et grands</p>
    </div> -->


      <!-- Right column container with form -->
    <div class="w-full lg:ml-6 lg:w-5/12">
        <div class="flex flex-col justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="<?php echo base_url('/')?>" class="flex mb-6 text-2xl font-semibold text-gray-900">
                <img class="w-60 lg:justify-start lg:m-0 lg:w-40 mr-2" src="<?php echo base_url('assets/img/logo.svg');?>" alt="Café Crème Community" id="logoLogin">
            </a>
            <div class="p-6 w-full bg-white rounded-lg shadow md:mt-0 xl:p-0 dark:bg-gray-800 dark:text-white lg:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-5xl lg:text-2xl font-bold mb-2 leading-tight tracking-tight text-gray-900 dark:text-white">
                    Réinitialisez votre mot de passe
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="post" action="<?php echo base_url('login/resetPassword'); ?>" onsubmit="showLoader();">
                        <div>
                            <input type="text" name="userEmail" id="userEmail" value="<?= $userEmail ?>" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900 sm:text-lg rounded-lg block w-full p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" placeholder="Saisissez votre email *" required readonly="readonly">
                            <p id="emailError" class="text-3xl lg:text-base text-red-500"></p>
                        </div>
                        <div>
                            <input type="password" name="userPassword" id="userPassword" placeholder="Saisissez votre mot de passe *" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900 sm:text-lg rounded-lg block w-full p-2.5" required oninput="checkPasswordStrength(this.value)">
                        </div>
                        <div>
                            <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirmez votre mot de passe *" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900 sm:text-lg rounded-lg block w-full p-2.5" required oninput="checkPasswordMatch()">
                            <p id="confirmPasswordError" class="text-3xl lg:text-base text-red-500"></p>
                        </div>
                        <div class="password-strength-meter">
                            <div class="password-strength-meter-fill"></div>
                        </div>
                        <p id="passwordError" class="text-3xl lg:text-base text-red-500"></p>
                        <div>
                            <input type="checkbox" id="togglePasswordCheckbox" class="w-6 h-6 lg:w-3 lg:h-3 form-checkbox text-primary rounded">
                            <label for="togglePasswordCheckbox" class="text-3xl lg:text-base font-medium text-gray-900 dark:text-white">Afficher le mot de passe</label>
                        </div>
                        <button type="submit" class="text-3xl lg:text-base w-full text-white bg-primary hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg px-5 py-2.5 text-center">Mettre à jour le mot de passe</button>
                    </form>
                    <div class="flex items-center justify-end">
                        <a href="<?php echo base_url('login'); ?>" class="text-3xl lg:text-base font-medium text-primary hover:underline">Finalement je m'en souviens !</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <script>

        const images = [
            '<?php echo base_url('assets/img/cc-2.png');?>',
            '<?php echo base_url('assets/img/cc-3.png');?>',
            '<?php echo base_url('assets/img/cc-4.png');?>',
            '<?php echo base_url('assets/img/cc-1.png');?>'
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


    </script>

</body>
</html>
