<!DOCTYPE html>
<html>
<head>
    <title>Réinitialisez votre mot de passe | Café Crème Community</title>
    <link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
    <style>
        /* body {
            background-color: #ffffff;
        } */
        .image-rotation {
            transition: opacity 0.5s ease;
            opacity: 0;
        }
    </style>
</head>
<body>
<?php if ($this->session->flashdata('message')) : ?>
    <div class="text-2xl lg:text-base flashdata <?php echo $this->session->flashdata('status') === 'error' ? 'error' : 'success'; ?>">
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
            <a href="#" class="flex mb-6 text-2xl font-semibold text-gray-900">
                <img class="w-60 lg:justify-start lg:m-0 lg:w-40 mr-2" src="<?php echo base_url('assets/img/logo.svg');?>" alt="Café Crème Community" id="logoLogin">
            </a>
            <div class="p-6 w-full bg-white rounded-lg shadow md:mt-0 xl:p-0 dark:bg-gray-800 dark:text-white lg:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-5xl lg:text-2xl font-bold mb-2 leading-tight tracking-tight text-gray-900 dark:text-white">
                        Mot de passe oublié ?
                    </h1>
                    <p class="text-3xl lg:text-base text-dark mb-2 dark:text-white">
                    Saississez l'adresse e-mail utilisée lors de votre inscription, et nous vous enverrons un lien pour réinitialiser votre mot de passe.
                    </p>
                    <form class="space-y-4 md:space-y-6" method="post" action="<?php echo base_url('login/forgotPassword'); ?>" onsubmit="showLoader();">
                        <div>
                            <input type="email" name="userEmail" id="userEmail" class="rounded-lg p-4 text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900 block w-full lg:p-2.5" placeholder="name@company.com" required="">
                        </div>
                        <button type="submit" class="text-3xl lg:text-base w-full text-white bg-primary hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg px-5 py-2.5 text-center">Envoyer le lien</button>
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
