<?php
// Header Call
$currentPage = 'settings';

include(APPPATH . 'views/layouts/user/header.php' );
?>
<head>
    <title><?='Paramètres '.$user->userFirstName.' '.$user->userLastName.' '.ucfirst($user->userType)?>  - Café Crème Community </title>

<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">

</head>

<div id="updateProductModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Votre disponibilité
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg  p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateProductModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Fermer</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?=base_url("user/updateAvailability")?>" method="post">
                    <div>
                        <label for="name" class="block mb-2  font-medium text-gray-900 dark:text-white">Êtes-vous disponible pour travailler dès maintenant ?</label>
                        <label class=" text-gray-500 mr-3 dark:text-gray-400">Non</label>
                        <input type="checkbox" name="userIsAvailable" id="hs-basic-with-description" <?php echo $checkboxChecked; ?> class="relative shrink-0 w-[3.25rem] h-7 bg-gray-100 checked:bg-gray-100 rounded-full cursor-pointer transition-colors ease-in-out duration-200 border border-transparent ring-1 ring-transparent focus:border-green-600 focus:ring-green-600 ring-offset-white focus:outline-none appearance-none dark:bg-gray-700 dark:checked:bg-green-600 dark:focus:ring-offset-gray-800 before:inline-block before:w-6 before:h-6 before:bg-white checked:before:bg-green-500 before:translate-x-0 checked:before:translate-x-full before:shadow before:rounded-full before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-gray-400 dark:checked:before:bg-green-200">
                        <label class=" text-gray-500 ml-3 dark:text-gray-400">Oui</label>
                    </div>
                <div class="flex items-center space-x-4 mt-4">
                    <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Valider
                    </button>
                    <button type="button" data-modal-toggle="updateProductModal" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
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
                            <img src="<?php echo base_url($user->userAvatarPath); ?>" class="w-40 h-40 rounded-full" alt="Photo de profil">
                        </div>
                        <div class="ml-4">
                            <div class="flex" id="user-data">
                                <h1 class="text-5xl font-bold" id="userFirstName"><?=$user->userFirstName?></h1>
                                    <?php 
                                    // capitalize user last name
                                    $userLastName = $user->userLastName;
                                    $userLastName = strtoupper($userLastName);
                                    ?>
                                    <h1 class="text-5xl font-bold ml-2" id="userLastName"><?=$userLastName?></h1>
                            </div>
                            <p class="text-lg text-black-500 font-bold"><?=$job->jobName?></p>
                            <div class="flex items-center mb-4">
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                <?php if ($i <= $averageStars) { ?>
                                    <img src="<?php echo base_url('assets/img/fill-star.svg'); ?>" class="w-6 h-6">
                                <?php } else { ?>
                                    <img src="<?php echo base_url('assets/img/light-star.svg'); ?>" class="w-6 h-6">
                                <?php } ?>
                                <?php } ?>
                                <a href="#rating">
                                    <p class="ml-2"><?=round($averageStars, 1).' ( '.$ratingCount.' avis )'?></p>
                                </a>
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
            <div class="flex flex-1">
                <div class="rounded-lg h-full w-1/3 mb-4 mr-4 dark:text-white">
                    <div class="relative flex grid-cols-2 items-center overflow-hidden bg-white h-full rounded-lg mb-4 dark:bg-gray-800 py-4 px-4">
                        <ul>
                            <li> <a href="#user-data" class="p-8 text-lg w-full">Informations personnelles</a></li>
                            <li> <a href="#user-job" class="p-8 text-lg w-full">Informations professionnelles</a></li>
                            <li> <a href="#user-preference" class="p-8 text-lg w-full">Préférences</a></li>
                            <li> <a href="#rating" class="p-8 text-lg w-full">Avis</a></li>
                        </ul>
                    </div>
                </div>
                <div class="rounded-lg h-full w-2/3 mb-4 dark:text-white">
                    <div class="relative flex grid-cols-2 items-center overflow-hidden bg-white rounded-lg mb-4 dark:bg-gray-800 py-4 px-4">
                        <div id="user-data" class="space-y-4 md:space-y-6 w-2/3">
                            <form method="post" action="<?php echo base_url('register/registerUser'); ?>" enctype="multipart/form-data">
                                <label for="userFirstName" class="block font-medium text-gray-900 dark:text-white">Votre prénom *</label>
                                <input type="text" name="userFirstName" id="userFirstName" value="<?=$user->userFirstName?>" class="w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required>

                                <label for="userLastName" class="block font-medium text-gray-900 dark:text-white">Votre nom *</label>
                                <input type="text" name="userLastName" id="userLastName" value="<?=$user->userLastName?>" class="w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required>

                                <label for="userTelephone" class="block font-medium text-gray-900 dark:text-white">Votre numéro de téléphone *</label>
                                <input type="text" name="userTelephone" id="userTelephone" value="<?=$user->userTelephone?>" class="w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required>                                
                                <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    Valider
                                </button>
                            </form>
                        </div>
                        <div id="user-job" class="space-y-4 md:space-y-6 w-2/3 hidden">
                        <form method="post" action="<?php echo base_url('register/registerUser'); ?>" enctype="multipart/form-data">
                                <label for="userFirstName" class="block font-medium text-gray-900 dark:text-white">Votre prénom *</label>
                                <input type="text" name="userFirstName" id="userFirstName" value="<?=$user->userFirstName?>" class="w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required>                                
                                <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    Valider
                                </button>
                            </form>
                        </div>
                        
                        <div id="user-preference" class="space-y-4 md:space-y-6 w-2/3 hidden">
                        <form method="post" action="<?php echo base_url('register/registerUser'); ?>" enctype="multipart/form-data">
                                <label for="userFirstName" class="block font-medium text-gray-900 dark:text-white">Votre prénom *</label>
                                <input type="text" name="userFirstName" id="userFirstName" value="<?=$user->userFirstName?>" class="w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required>

                                <label for="userLastName" class="block font-medium text-gray-900 dark:text-white">Votre nom *</label>
                                <input type="text" name="userLastName" id="userLastName" value="<?=$user->userLastName?>" class="w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required>

                                <label for="userTelephone" class="block font-medium text-gray-900 dark:text-white">Votre numéro de téléphone *</label>
                                <input type="text" name="userTelephone" id="userTelephone" value="<?=$user->userTelephone?>" class="w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required>

                                <!-- Autres champs d'informations personnelles -->
                                
                                <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    Valider
                                </button>
                            </form>
                        </div>
                        
                        <div id="rating" class="space-y-4 md:space-y-6 w-2/3 hidden">
                            <form method="post" action="<?php echo base_url('register/registerUser'); ?>" enctype="multipart/form-data">
                                <label for="userFirstName" class="block font-medium text-gray-900 dark:text-white">Votre prénom *</label>
                                <input type="text" name="userFirstName" id="userFirstName" value="<?=$user->userFirstName?>" class="w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required>

                                <label for="userLastName" class="block font-medium text-gray-900 dark:text-white">Votre nom *</label>
                                <input type="text" name="userLastName" id="userLastName" value="<?=$user->userLastName?>" class="w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required>

                                <label for="userTelephone" class="block font-medium text-gray-900 dark:text-white">Votre numéro de téléphone *</label>
                                <input type="text" name="userTelephone" id="userTelephone" value="<?=$user->userTelephone?>" class="w-full mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm: rounded-lg block p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" required>

                                <!-- Autres champs d'informations personnelles -->
                                
                                <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
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
<script>
    $(document).ready(function () {
        // Cacher tous les formulaires sauf le premier au chargement de la page
        $(".relative > div:not(:first-child)").hide();

        // Gérer le changement d'onglet lorsque l'utilisateur clique sur un lien d'onglet
        $("ul li a").click(function (event) {
            event.preventDefault();
            var target = $(this).attr("href");
            $(".relative > div").hide();
            $(target).fadeIn();
        });
    });
</script>

