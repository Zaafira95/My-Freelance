
<link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">
<link rel="icon" href="<?php echo base_url('assets/img/Favicon.ico'); ?>" type="image/x-icon">

<?php 
    // Set default avatar if user has no avatar
    if($user->userAvatarPath == null){
        $user->userAvatarPath = 'assets/img/default-avatar.png';
    }
?>
<!-- Modal toggle -->


<!-- Main modal -->
<?php if ($this->session->flashdata('message')) : ?>
    <div class="flashdata <?php echo $this->session->flashdata('status') === 'error' ? 'error' : 'success'; ?>">
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
    <nav class="bg-white px-4 lg:px-6 py-6 dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="<?php echo base_url('/');?>" class="flex items-center">
                <img src="<?php echo base_url('assets/img/logo.svg');?>" class="mr-3 h-8 sm:h-9" id="logo" alt="Café Crème Community"/>
                <!-- <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span> -->
            </a>
            <div class="flex items-center lg:order-2">
            
              <div class="mr-4 ml-4">
                <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
              </div>

                <!-- <a href="#" class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Log in</a>
                <a href="#" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Get started</a> -->
                <div class="relative">
                    <!-- Avatar avec une bordure primary de 3px -->
                    <div class="rounded-full border-10 border-primary cursor-pointer" onclick="toggleDropdown()">
                    <img src="<?php echo base_url($user->userAvatarPath); ?>" alt="Avatar" class="w-10 h-10 p-0.5 rounded-full ring-2 ring-primary">
                    </div>
                    <!-- Dropdown Menu -->
                    <div id="dropdown" class=" absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md overflow-hidden shadow-xl z-10 hidden">
                        <a href="<?php echo base_url('company/my_company');?>" class="flex items-center space-x-2 block rounded-md px-4 py-4 text-gray-400 dark:text-gray-400 hover:bg-secondary dark:hover:text-white hover:text-gray-900 dark:hover:bg-primary">
                            <i class="fas fa-user-circle"></i>
                            <span>Mon entreprise</span>
                        </a>
                        <a href="#" class="flex items-center space-x-2 block rounded-md px-4 py-4 text-gray-400 dark:text-gray-400 hover:bg-secondary dark:hover:text-white hover:text-gray-900 dark:hover:bg-primary">
                            <i class="fas fa-cog"></i>
                            <span>Paramètres</span>
                        </a>
                       
                        <a href="<?php echo base_url('company/logout');?>" class="flex items-center space-x-2 block rounded-md px-4 py-4 text-red-600 dark:text-red-900 dark:hover:text-white hover:text-white hover:bg-red-900">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Déconnexion</span>
                        </a>
                    </div>


                    <!-- Badge vert pour indiquer la personne en ligne -->
                    <!-- <span class="absolute bottom-0 right-0 inline-block w-3 h-3 p-0.5 bg-green-500 rounded-full ring-2 ring-white dark:ring-gray-800"></span> -->
                </div>

                
                <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <?php 
                            if ($currentPage == 'dashboard'){
                        ?>
                            <a href="<?php echo base_url('/');?>" class="block py-2 pr-4 pl-3 text-primary bg-primary lg:bg-transparent lg:text-primary lg:p-0 border-b-2 border-primary dark:text-white">Dashboard</a>

                        <?php
                            } else {
                        ?>
                            <a href="<?php echo base_url('/');?>" class="block py-2 pr-4 pl-3 text-black border-b  lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-400 lg:p-0 dark:text-white">Dashboard</a>
                        <?php
                            }
                        ?>
                    </li>
                    <li>
                        <?php 
                            if ($currentPage == 'freelancers'){
                        ?>
                            <a href="<?php echo base_url('company/freelancer');?>" class="block py-2 pr-4 pl-3 text-primary bg-primary lg:bg-transparent lg:text-primary lg:p-0 border-b-2 border-primary dark:text-white">Freelances</a>
                        <?php
                            } else {
                        ?>
                            <a href="<?php echo base_url('company/freelancer');?>" class="block py-2 pr-4 pl-3 text-black border-b lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-400 lg:p-0 dark:text-white">Freelances</a>
                        <?php
                            }
                        ?>
                    </li>
                    <li>
                        <?php 
                            if ($currentPage == 'my_company'){
                        ?>
                            <a href="<?php echo base_url('company/my_company');?>" class="block py-2 pr-4 pl-3 text-primary bg-primary lg:bg-transparent lg:text-primary lg:p-0 border-b-2 border-primary dark:text-white">Mon entreprise</a>
                        <?php
                            } else {
                        ?>
                            <a href="<?php echo base_url('company/my_company');?>" class="block py-2 pr-4 pl-3 text-black border-b lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-400 lg:p-0 dark:text-white">Mon entreprise</a>
                        <?php
                            }
                        ?>
                    </li>
                    <li>
                        <?php 
                            if ($currentPage == 'whatsapp'){
                        ?>
                            <a href="<?php echo base_url('company/whatsapp');?>" class="block py-2 pr-4 pl-3 text-primary bg-primary lg:bg-transparent lg:text-primary lg:p-0 border-b-2 border-primary dark:text-white">Communauté</a>
                        <?php
                            } else {
                        ?>
                            <a href="<?php echo base_url('company/whatsapp');?>" class="block py-2 pr-4 pl-3 text-black border-b lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-400 lg:p-0 dark:text-white">Communauté</a>
                        <?php
                            }
                        ?>
                    </li>
                    <li>
                        <?php 
                            if ($currentPage == 'settings'){
                        ?>
                            <a href="<?php echo base_url('company/settings');?>" class="block py-2 pr-4 pl-3 text-primary bg-primary lg:bg-transparent lg:text-primary lg:p-0 border-b-2 border-primary dark:text-white">Paramètres</a>
                        <?php
                            } else {
                        ?>
                            <a href="<?php echo base_url('company/settings');?>" class="block py-2 pr-4 pl-3 text-black border-b lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-400 lg:p-0 dark:text-white">Paramètres</a>
                        <?php
                            }
                        ?>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</header>
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
    </script>