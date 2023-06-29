<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
    <style>
        body {
            background-color: #ffffff;
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
      <!-- Left column container with background-->
      <div class="mb-12 md:mb-0 md:w-8/12 lg:w-6/12">
          <img
          src="<?php echo base_url('assets/img/cc-2.png');?>"
          class="w-full image-rotation"
          alt="Login Image with quote" />
      </div>

      <!-- Right column container with form -->
      <div class="md:w-8/12 lg:ml-6 lg:w-5/12">
      <div class="flex flex-col justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex mb-6 text-2xl font-semibold text-gray-900">
                <img class="w-50 mr-2" src="<?php echo base_url('assets/img/logo.svg');?>" alt="Café Crème Community" id="logoLogin">
            </a>
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:text-white">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-2-xl font-bold mb-2 leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                      Connectez-vous
                  </h1>
                  <p class="text-dark mb-2 dark:text-white">
                  Explorer de nouvelles missions, discuter avec d'autres professionnels de l'IT au coeur d’une communauté dynamique.
                  </p>
      <form class="space-y-4 md:space-y-6" method="post" action="<?php echo base_url('login/login'); ?>" onsubmit="showLoader();">
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre email</label>
                <input type="email" name="userEmail" id="userEmail" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 " placeholder="name@company.com" required="">
            </div>
            <div class="relative">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre mot de passe</label>
                <div class="flex flex-col">
                    <input type="password" name="userPassword" id="userPassword" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" required="">
                    <div class="mt-4">
                    <input type="checkbox" id="togglePasswordCheckbox" class="form-checkbox text-primary rounded">
                    <label for="togglePasswordCheckbox" class="text-sm font-medium text-gray-900 dark:text-white">Afficher le mot de passe</label>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <a href="<?php echo base_url('login/forgot_password'); ?>" class="text-sm font-medium text-primary hover:underline">Mot de passe oublié ?</a>
            </div>
            <button type="submit" class="w-full text-white bg-primary hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Se connecter</button>
            <p class="text-sm font-light text-gray-500 dark:text-white">
                Vous n'avez pas de compte ? <a href="<?=base_url('register')?>" class="font-medium text-primary hover:underline">Inscrivez-vous</a>
            </p>
        </form>
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

    togglePasswordCheckbox.addEventListener('change', function () {
        if (togglePasswordCheckbox.checked) {
        passwordInput.setAttribute('type', 'text');
        } else {
        passwordInput.setAttribute('type', 'password');
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
    </script>

</body>
</html>
