
<link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">
<link rel="icon" href="<?php echo base_url('assets/img/Favicon.ico'); ?>" type="image/x-icon">

<?php 
    // Set default avatar if user has no avatar
    if($user->userAvatarPath == null){
        $user->userAvatarPath = 'assets/img/default-avatar.png';
    }

    // Verify user Date Fin Indisponibilité
    $today = date("Y-m-d");
    $todayTimestamp = strtotime($today);
    $datePlus15Jours = date('Y-m-d', strtotime($user->userDateFinIndisponibilite. ' + 14 days'));
    $datePlus15JoursTimestamp = strtotime($datePlus15Jours);
    
?>
<!-- Modal toggle -->


<!-- Main modal -->
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

<header>
    <nav class="bg-white py-6 px-12 lg:px-6 lg:py-6 dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="<?php echo base_url('/');?>" class="flex items-center">
                <img src="<?php echo base_url('assets/img/logo.svg');?>" class="object-cover mr-3 h-16 lg:h-9" id="logo" alt="My Freelance"/>
                <!-- <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span> -->
            </a>
            <div class="flex items-center lg:order-2">
            <div class="flex justify-center">
                <button type="button" class="block" onclick="openTheModalUpdate()">
                    <?php
                        // check user availability
                        if($user->userIsAvailable == 1){
                    ?>
                        <div style="padding-top: 0.2em; padding-bottom: 0.2rem" class="flex items-center space-x-1 bg-green-100 text-green-800 text-2xl lg:text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-300 dark:text-green-900">
                            <div class="w-2 h-2 lg:h-2 lg:w-2 bg-green-500 rounded-full dark:bg-green-700"></div>
                            <div>Disponibilité confirmée</div>
                        </div>
                    <?php
                        } else {
                    ?>
                        <div style="padding-top: 0.2em; padding-bottom: 0.2rem" class="flex items-center space-x-1 bg-red-100 text-red-800 text-2xl lg:text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-300 dark:text-red-900">
                            <div class="w-2 h-2 lg:h-2 lg:w-2 bg-red-500 rounded-full dark:bg-red-700"></div>
                            <div>Non Disponible</div>
                        </div>
                    <?php
                        }
                    ?> 
                </button>
            </div>
            <div class="mr-4 ml-4">
            <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                <svg id="theme-toggle-light-icon" class="hidden w-10 h-10 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-10 h-10 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
            </button>
            </div>

                <!-- <a href="#" class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Log in</a>
                <a href="#" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Get started</a> -->
                <div class="relative">
                    <!-- Avatar avec une bordure primary de 3px -->
                    <div class="rounded-full border-10 border-primary cursor-pointer" onclick="toggleDropdown()">
                    <img src="<?php echo base_url($user->userAvatarPath); ?>" alt="Avatar" class="object-cover w-16 h-16 lg:w-8 lg:h-8 rounded-full ring-2 ring-primary">
                    </div>
                    <!-- Dropdown Menu -->
                    <div id="dropdown" class=" absolute right-0 mt-2 w-64 lg:w-48 bg-white dark:bg-gray-800 rounded-md overflow-hidden shadow-xl z-10 hidden">
                        <a href="<?php echo base_url('user/profil');?>" class="text-3xl lg:text-base items-center space-x-2 block rounded-md px-4 py-4 text-gray-400 dark:text-gray-400 hover:bg-secondary dark:hover:text-white hover:text-gray-900 dark:hover:bg-primary">
                            <i class="fas fa-user-circle"></i>
                            <span>Mon Profil</span>
                        </a>
                        <a href="<?php echo base_url('User/favoriteMission');?>" class="text-3xl lg:text-base items-center space-x-2 block rounded-md px-4 py-4 text-gray-400 dark:text-gray-400 hover:bg-secondary dark:hover:text-white hover:text-gray-900 dark:hover:bg-primary">
                            <i class="far fa-heart"></i>
                            <span>Favoris</span>
                        </a>
                        <a href="<?php echo base_url('user/settings');?>" class="text-3xl lg:text-base items-center space-x-2 block rounded-md px-4 py-4 text-gray-400 dark:text-gray-400 hover:bg-secondary dark:hover:text-white hover:text-gray-900 dark:hover:bg-primary">
                            <i class="fas fa-cog"></i>
                            <span>Paramètres</span>
                        </a>
                       
                        <a href="<?php echo base_url('user/logout');?>" class="text-3xl lg:text-base items-center space-x-2 block rounded-md px-4 py-4 text-red-600 dark:text-red-900 dark:hover:text-white hover:text-white hover:bg-red-900">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Déconnexion</span>
                        </a>
                    </div>


                    <!-- Badge vert pour indiquer la personne en ligne -->
                    <!-- <span class="absolute bottom-0 right-0 inline-block w-3 h-3 p-0.5 bg-green-500 rounded-full ring-2 ring-white dark:ring-gray-800"></span> -->
                </div>

                
                <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex p-2 ml-4 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <?php 
                            if ($currentPage == 'dashboard'){
                        ?>
                            <a href="<?php echo base_url('/');?>" class="text-3xl lg:text-base block py-2 pr-4 pl-3 text-primary  border-b lg:bg-transparent lg:text-primary lg:p-0 lg:border-b-2 border-primary dark:text-primary">Dashboard</a>

                        <?php
                            } else {
                        ?>
                            <a href="<?php echo base_url('/');?>" class="text-3xl lg:text-base block py-2 pr-4 pl-3 text-black border-b  lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-400 lg:p-0 dark:text-white">Dashboard</a>
                        <?php
                            }
                        ?>
                    </li>
                    <li>
                        <?php 
                            if ($currentPage == 'missions'){
                        ?>
                            <a href="<?php echo base_url('user/mission');?>" class="text-3xl lg:text-base block py-2 pr-4 pl-3 text-primary  border-b lg:bg-transparent lg:text-primary lg:p-0 lg:border-b-2 border-primary dark:text-primary">Missions</a>
                        <?php
                            } else {
                        ?>
                            <a href="<?php echo base_url('user/mission');?>" class="text-3xl lg:text-base block py-2 pr-4 pl-3 text-black border-b lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-400 lg:p-0 dark:text-white">Missions</a>
                        <?php
                            }
                        ?>
                    </li>
                    <li>
                        <?php 
                            if ($currentPage == 'companies'){
                        ?>
                            <a href="<?php echo base_url('user/companies');?>" class="text-3xl lg:text-base block py-2 pr-4 pl-3 text-primary  border-b lg:bg-transparent lg:text-primary lg:p-0 lg:border-b-2 border-primary dark:text-primary">Entreprises</a>
                        <?php
                            } else {
                        ?>
                            <a href="<?php echo base_url('user/companies');?>" class="text-3xl lg:text-base block py-2 pr-4 pl-3 text-black border-b lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-400 lg:p-0 dark:text-white">Entreprises</a>
                        <?php
                            }
                        ?>
                    </li>
                    <li>
                        <?php 
                            if ($currentPage == 'profil'){
                        ?>
                            <a href="<?php echo base_url('user/profil');?>" class="text-3xl lg:text-base block py-2 pr-4 pl-3 text-primary  border-b lg:bg-transparent lg:text-primary lg:p-0 lg:border-b-2 border-primary dark:text-primary">Profil</a>
                        <?php
                            } else {
                        ?>
                            <a href="<?php echo base_url('user/profil');?>" class="text-3xl lg:text-base block py-2 pr-4 pl-3 text-black border-b lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-400 lg:p-0 dark:text-white">Profil</a>
                        <?php
                            }
                        ?>
                    </li>
                    <li>
                        <?php 
                            if ($currentPage == 'whatsapp'){
                        ?>
                            <a href="<?php echo base_url('user/whatsapp');?>" class="text-3xl lg:text-base block py-2 pr-4 pl-3 text-primary  border-b lg:bg-transparent lg:text-primary lg:p-0 lg:border-b-2 border-primary dark:text-primary">Communauté</a>
                        <?php
                            } else {
                        ?>
                            <a href="<?php echo base_url('user/whatsapp');?>" class="text-3xl lg:text-base block py-2 pr-4 pl-3 text-black border-b lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-400 lg:p-0 dark:text-white">Communauté</a>
                        <?php
                            }
                        ?>
                    </li>
                    <li>
                        <?php 
                            if ($currentPage == 'settings'){
                        ?>
                            <a href="<?php echo base_url('user/settings');?>" class="text-3xl lg:text-base block py-2 pr-4 pl-3 text-primary  border-b lg:bg-transparent lg:text-primary lg:p-0 lg:border-b-2 border-primary dark:text-primary">Paramètres</a>
                        <?php
                            } else {
                        ?>
                            <a href="<?php echo base_url('user/settings');?>" class="text-3xl lg:text-base block py-2 pr-4 pl-3 text-black border-b lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-400 lg:p-0 dark:text-white">Paramètres</a>
                        <?php
                            }
                        ?>
                    </li>
                </ul>
            </div>


        </div>
    </nav>
</header>

<!-- component -->

<div id="availabilityWarning-modal" class="<?php echo (($today >= $user->userDateFinIndisponibilite && $user->userIsAvailable == 0)) ? '' : 'hidden' ?> fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10" style="z-index:100">
    <div class="relative p-4 w-80 lg:w-60 h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 justify-start items-start bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-start items-start pb-4 mb-2 text-left">
                    <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100  mr-4">
                        <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div>
                        <div>      
                            <h3 class="text-3xl lg:text-lg font-semibold text-gray-900 dark:text-white">
                                Votre période d'indisponibilité est dépassée. Veuillez mettre à jour votre disponibilité.
                            </h3>
                            <?php   
                                if($todayTimestamp >= $datePlus15JoursTimestamp) {?>
                                    <p class="text-3xl lg:text-base text-gray-500 dark:text-gray-400 mt-1">
                                        Vous n'aurez plus accès aux missions tant que vous n'aurez pas mis à jour votre disponibilité.
                                    </p>
                                <?php
                                    } else {
                                ?>
                                <p class="text-3xl lg:text-base text-gray-500 dark:text-gray-400 mt-1">
                                    Vous n'aurez plus accès aux missions dans 
                                    <?php
                                    // Compter le nombre de jours restant, sachant que la date de fin d'indisponibilité est dépassée et que l'utilisateur a 15 jours pour mettre à jour sa disponibilité
                                    $dateFinIndisponibilite = new DateTime($user->userDateFinIndisponibilite);
                                    $dateFinIndisponibiliteTimestamp = strtotime($dateFinIndisponibilite->format('Y-m-d'));
                                    $dateFinIndisponibilitePlus15Jours = date('Y-m-d', strtotime($dateFinIndisponibilite->format('Y-m-d'). ' + 14 days'));
                                    $dateFinIndisponibilitePlus15JoursTimestamp = strtotime($dateFinIndisponibilitePlus15Jours);
                                    $today = date("Y-m-d");
                                    $todayTimestamp = strtotime($today);
                                    $diff = $dateFinIndisponibilitePlus15JoursTimestamp - $todayTimestamp;
                                    $diff = round($diff / (60 * 60 * 24));
                                    echo $diff;
                                    // Si le nombre de jours restant est égal à 1, on affiche "jour" au singulier, sinon on affiche "jours" au pluriel
                                    if($diff == 1) {
                                        echo " jour";
                                    } else {
                                        echo " jours";
                                    }
                                    ?>
                                     tant que vous n'aurez pas mis à jour votre disponibilité.
                                </p>
                            <?php
                                }
                            ?>  
                        </div>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="flex items-center space-x-4 mt-4">
                    <button type="button"  class="text-3xl lg:text-base text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" onclick="closeAvailabilityWarning()">
                        Mettre à jour
                    </button>
                    <?php 
                        if($todayTimestamp < $datePlus15JoursTimestamp) {
                    ?>
                            <button type="button" class="text-3xl lg:text-base text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" onclick="closeAvailabilityWarningWithoutOpenUpdate()">
                                Plus tard
                            </button>
                    <?php 
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="updateProductModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden right-0 z-50 md:inset-0 h-modal md:h-full fixed left-0 top-0  h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
    <div class="relative p-4 w-80 lg:w-60 h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-3xl lg:text-lg font-semibold text-gray-900 dark:text-white">
                Your availability
                </h3>
                <?php 
                    if($todayTimestamp < $datePlus15JoursTimestamp) {
                ?>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeUpdateModal()">
                    <svg aria-hidden="true" class="w-8 h-8 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close</span>
                </button>
                <?php 
                    }
                ?>
            </div>
            <!-- Modal body -->

            <form id="userAvailabilityForm" action="<?=base_url("user/updateAvailability")?>" method="post">
                <div>
                    <label for="name" class="text-3xl lg:text-base block mb-2 font-medium text-gray-900 dark:text-white">Are you available to work right now?</label>
                    <label class="text-3xl lg:text-base text-gray-500 mr-3 dark:text-gray-400">No</label>
                    <input type="checkbox" name="userIsAvailable" id="hs-basic-with-description" <?php echo $checkboxChecked; ?> onchange="displayAvailibilityOptions()" class="relative shrink-0 w-[3.25rem] h-7 bg-gray-100 checked:bg-gray-100 rounded-full cursor-pointer transition-colors ease-in-out duration-200 border border-transparent ring-1 ring-transparent focus:border-green-600 focus:ring-green-600 ring-offset-white focus:outline-none appearance-none dark:bg-gray-700 dark:checked:bg-green-600 dark:focus:ring-offset-gray-800 before:inline-block before:w-6 before:h-6 before:bg-white checked:before:bg-green-500 before:translate-x-0 checked:before:translate-x-full before:shadow before:rounded-full before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-gray-400 dark:checked:before:bg-green-200">
                    <label class="text-3xl lg:text-base text-gray-500 ml-3 dark:text-gray-400">Yes</label>
                    <div id="isAvailaibleOptions" style="display: <?php echo $checkboxChecked == 'checked' ? "block" : "none" ?>">
                        <label for="name" class="text-3xl lg:text-base block mb-2 mt-6 font-medium text-gray-900 dark:text-white">How many days per week are you available?</label>
                        <select id="userJobTimePartielOrFullTime" name="userJobTimePartielOrFullTime" class="text-3xl lg:text-base bg-gray-50 border mt-4 border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="temps-plein" 
                                <?php if ($user->userJobTimePartielOrFullTime === "temps-plein") {
                                    echo ' selected';
                                } ?>> Full-time
                            </option>
                            <option value="temps-partiel" 
                                <?php if ($user->userJobTimePartielOrFullTime === "temps-partiel") {
                                    echo ' selected';
                                } ?>> Part-time
                            </option>
                        </select>
                    </div>
                    <div id="isNotAvailaibleOptions" style="display: <?php echo $checkboxChecked == '' ? "block" : "none" ?>">
                        <label for="dateFinIndisponibilite" class="text-3xl lg:text-base block mb-2 mt-6 font-medium text-gray-900 dark:text-white">When will you be available again?</label>
                        <div class="flex flex-1 mt-4">
                            <div class="flex items-center mr-6">
                                <input type="radio" id="1mois" value="1" name="finIndisponibiliteDuree" class="text-3xl lg:text-base finIndisponibiliteBtn w-6 h-6 lg:w-4 lg:h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="1mois" class="text-3xl lg:text-base ml-2 font-medium text-gray-900 dark:text-white">In 1 month</label>
                            </div>
                            <div class="flex items-center mr-6">
                                <input type="radio" id="3mois" value="3" name="finIndisponibiliteDuree" class="text-3xl lg:text-base finIndisponibiliteBtn w-6 h-6 lg:w-4 lg:h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="3mois" class="text-3xl lg:text-base ml-2 font-medium text-gray-900 dark:text-white">In 3 months</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="6mois" value="6" name="finIndisponibiliteDuree" class="text-3xl lg:text-base finIndisponibiliteBtn w-6 h-6 lg:w-4 lg:h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="6mois" class="text-3xl lg:text-base ml-2 font-medium text-gray-900 dark:text-white">In 6 months</label>
                            </div>
                        </div>
                        <input type="date" id="dateFinIndisponibilite" value="<?= $user->userDateFinIndisponibilite ?>" name="dateFinIndisponibilite" class="text-3xl lg:text-base w-full mt-4 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        
                        <p id="errorDateFinIndisponibilite" class="text-3xl lg:text-base mt-2 text-red-500" style="display:none;">Please provide a date</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4 mt-8">
                    <button type="submit" class="text-3xl lg:text-base text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Confirm
                    </button>
                    <?php 
                        if($todayTimestamp < $datePlus15JoursTimestamp) {
                    ?>
                    <button type="button" class="text-3xl lg:text-base text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" onclick="closeUpdateModal()">
                        Cancel
                    </button>
                    <?php 
                        }
                    ?>

                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo base_url('node_modules/flowbite/dist/flowbite.min.js'); ?>"></script>
<script>
    try {
        function toggleDropdown() {
            var dropdown = document.getElementById('dropdown');
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        }
    } catch (error) {
        console.error("An error occurred while toggling the dropdown: ", error);
    }

    // Fonctions pour désactiver et réactiver le clic droit
    function disableRightClick() {
        document.addEventListener('contextmenu', preventDefaultHandler, false);
    }

    function enableRightClick() {
        document.removeEventListener('contextmenu', preventDefaultHandler, false);
    }

    function preventDefaultHandler(e) {
        e.preventDefault();
    }

    
    // Fonctions pour désactiver et réactiver les raccourcis clavier
    function disableInspectShortcuts() {
        document.addEventListener('keydown', disableInspectShortcutsHandler, false);
    }

    function enableInspectShortcuts() {
        document.removeEventListener('keydown', disableInspectShortcutsHandler, false);
    }

    function disableInspectShortcutsHandler(e) {
        if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'C')) || (e.metaKey && e.altKey && e.key === 'I')) {
            e.preventDefault();
        }
    }

    // Fonction pour fermer le modal et réactiver les fonctionnalités
    function closeAvailabilityWarning() {
        var modal = document.getElementById('availabilityWarning-modal');
        var modalUpdateProduct = document.getElementById('updateProductModal');
        if (modal) {
            modal.style.display = 'none';
            modalUpdateProduct.style.display = 'flex';
            enableRightClick();
            enableInspectShortcuts();
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Vérifiez si le modal est ouvert
        var modal = document.getElementById('availabilityWarning-modal'); 
        if (!modal.classList.contains('hidden')) {
            document.addEventListener('contextmenu', disableRightClick, false);
            document.addEventListener('keydown', disableInspectShortcuts, false);
        }
    });

    function closeAvailabilityWarningWithoutOpenUpdate(){
        var modal = document.getElementById('availabilityWarning-modal');
        var modalUpdateProduct = document.getElementById('updateProductModal');
        if (modal) {
            modal.style.display = 'none';
            modalUpdateProduct.style.display = 'none';
            enableRightClick();
            enableInspectShortcuts();
        }
    }
    
    function closeUpdateModal() {
        var modal = document.getElementById('updateProductModal');
        if (modal) {
            modal.style.display = 'none';
            enableRightClick();
            enableInspectShortcuts();
        }
    }

    function openTheModalUpdate() {
        var modal = document.getElementById('updateProductModal');
        if (modal) {
            modal.style.display = 'flex';
            disableRightClick();
            disableInspectShortcuts();
        }
    }

document.addEventListener('DOMContentLoaded', function() {
        const formulaires = document.querySelectorAll('form');

        formulaires.forEach(formulaire => {
            formulaire.addEventListener('submit', function(e) {

                // Réinitialise les messages d'erreur précédents
                const messagesErreur = formulaire.querySelectorAll('.message-erreur');
                messagesErreur.forEach(msg => msg.remove());

                let tousValides = true;

                // Sélectionne uniquement les champs requis
                const inputs = formulaire.querySelectorAll('input[required], textarea[required]');
                inputs.forEach(input => {
                    // Vérifie si le champ est vide
                    if (input.value.trim() === '') {
                        tousValides = false;

                        // Crée et affiche un message d'erreur pour ce champ
                        const message = document.createElement('div');
                        message.textContent = 'This field is required';
                        message.className = 'message-erreur text-red-600 text-3xl lg:text-base mt-4'; // Utilisez cette classe pour styliser le message d'erreur
                        input.parentNode.insertBefore(message, input.nextSibling);
                        input.classList.add('erreur');

                        // console.log(input);
                    } else {
                        input.classList.remove('erreur');
                    }
                });

                if (tousValides) {
                    // console.log('Tous les champs requis sont correctement remplis.');
                    // formulaire.submit(); // Décommentez cette ligne pour soumettre le formulaire si tout est valide
                } else {
                    // console.log('Certains champs requis sont vides.');
                    e.preventDefault(); // Empêche la soumission du formulaire
                }
            });
        });
    });

	

    


    </script>
