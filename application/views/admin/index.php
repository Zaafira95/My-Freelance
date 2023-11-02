<?php
$currentPage = 'dashboard';


// Header Call
include(APPPATH . 'views/layouts/admin/header.php');
?>
<head>
    <title> Dashboard Administateur - Café Crème Community </title>

<style>
    html,
    body {
        height: 85vh;
    }
    #cities-list {
    max-height: 200px; /* ou toute autre valeur appropriée */
    overflow-y: auto;
    /* Ajoutez d'autres styles si nécessaire */
}
.has-border {
    border: 1px solid #e2e8f0; /* Couleur de bordure exemple */
}
</style>
<link rel="stylesheet" href="<?php echo base_url('assets/css/nouislider.min.css');?>">
<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('/node_modules/choices.js/public/assets/styles/choices.min.css');?>" rel="stylesheet" type="text/css">


</head> 


<?php
if ($banner->bannerStatus == "active"){ ?>
<div id="sticky-banner" tabindex="-1" class="fixed top-0 left-0 z-50 mt-4 flex justify-between w-full p-4 border-b border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
    <div class="flex items-center mx-auto">
        <p class="flex items-center  font-normal text-gray-500 dark:text-white">
            <span class="inline-flex p-1 mr-3 bg-gray-200 rounded-full dark:bg-gray-600 w-6 h-6 items-center justify-center">
                <svg class="w-3 h-3 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 19">
                    <path d="M15 1.943v12.114a1 1 0 0 1-1.581.814L8 11V5l5.419-3.871A1 1 0 0 1 15 1.943ZM7 4H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2v5a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V4ZM4 17v-5h1v5H4ZM16 5.183v5.634a2.984 2.984 0 0 0 0-5.634Z"/>
                </svg>
                <span class="sr-only">Light bulb</span>
            </span>
            <span><?= $banner->bannerMessage?> <a href="<?=$banner->bannerLink?>" class="inline font-medium text-primary underline dark:text-primary underline-offset-2 decoration-600 dark:decoration-500 decoration-solid hover:no-underline" target ="_blank"><?=$banner->bannerCta?></a></span>
        </p>
    </div>
    <div class="flex items-center">
        <button data-dismiss-target="#sticky-banner" type="button" class="flex-shrink-0 inline-flex justify-center w-7 h-7 items-center text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Fermer</span>
        </button>
    </div>
</div>
<?php } ?>


<div class="px-4 lg:px-6 py-6 h-90 overflow-y-auto no-scrollbar">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl h-full">
        <div class="w-full flex gap-6 h-full mb-3">
            <div class="rounded-lg w-full h-full overflow-y-auto no-scrollbar mb-4 dark:text-white">
                <div class="flex mb-4 gap-4">
                    <!-- Block pour afficher le nombre de freelances -->
                    <div class="w-1/3 max-w-md p-4 bg-white shadow rounded-lg sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex flex-col h-full">
                            <div class="flex-grow flex items-end mb-2">
                            <i class="fas fa-users text-3xl text-primary rounded-md"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-gray-600 dark:text-white">Freelances</p>
                            </div>
                            <div class="text-left">
                                <p class="text-5xl font-bold">1 114</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/3 max-w-md p-4 bg-white shadow rounded-lg sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex flex-col h-full">
                            <div class="flex-grow flex items-end mb-2">
                                <i class="fas fa-briefcase text-3xl text-primary p-2 rounded-md"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-gray-600 dark:text-white">Missions</p>
                            </div>
                            <div class="text-left">
                                <p class="text-5xl font-bold">512</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/3 max-w-md p-4 bg-white shadow rounded-lg sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex flex-col h-full">
                            <div class="flex-grow flex items-end mb-2">
                            <i class="fas fa-building text-3xl text-primary p-2 rounded-md"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-gray-600 dark:text-white">Entreprises</p>
                            </div>
                            <div class="text-left">
                                <p class="text-5xl font-bold">342</p>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="w-full flex mb-4 gap-4">
                    <div class="w-2/3 max-w-sm  bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="flex justify-between mb-5">
                            <div class="grid gap-4 grid-cols-2">
                            <div>
                                <h5 class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">ESN
                            
                                </h5>
                                <p class="text-gray-900 dark:text-white text-2xl leading-none font-bold">42,3k €</p>
                            </div>
                            <div>
                                <h5 class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">Freelances
                             
                                </h5>
                                <p class="text-gray-900 dark:text-white text-2xl leading-none font-bold">12,7k €</p>
                            </div>
                            </div>
                            <div>                            
                            </div>
                        </div>
                        <div id="line-chart"></div>
                    </div>  
                    <div class="w-1/3 shadow max-w-md p-4 bg-white rounded-lg  sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex items-center justify-between mb-4">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Nos Freelances</h5>
                            <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                Voir tous les freelances
                            </a>
                        </div>
                        <div class="flow-root">
                            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                <?php foreach ($freelancers as $freelancer) { ?>
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <img class="w-8 h-8 rounded-full" src="<?php echo base_url($freelancer->userAvatarPath);?>" alt="Freelancer Avatar">
                                            </div>
                                            <div class="flex flex-1 min-w-0">
                                                <div>
                                                    <div class="flex">
                                                        <p class="text-md font-medium text-gray-900 truncate dark:text-white mr-2">
                                                            <?= $freelancer->userFirstName ?>
                                                        </p>
                                                        <div>
                                                        <?php
                                                            if($freelancer->userIsAvailable == 1){
                                                        ?>
                                                        <div class="flex items-center space-x-1 bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-300 dark:text-green-900">
                                                            <div style="width: 0.5rem; height: 0.5rem" class="bg-green-500 rounded-full dark:bg-green-700"></div>
                                                            <div>Disponible</div>
                                                        </div>
                                                        <?php
                                                            } else {
                                                        ?>
                                                            <div class="flex items-center space-x-1 bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-300 dark:text-red-900">
                                                                <div style="width: 0.5rem; height: 0.5rem" class="bg-red-500 rounded-full dark:bg-red-700"></div>
                                                                <div>Non Disponible</div>
                                                            </div>
                                                        <?php
                                                            }
                                                        ?> 
                                                        </div>
                                                    </div>
                                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                        <?= $freelancer->userEmail?>
                                                    </p>
                                                </div>
                                                
                                                
                                            </div>
                                            
                                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                <?= $freelancer->userTJM?> €/j
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                      
                </div>   
                <div class="w-full flex mb-4 gap-4">
                    <div class="w-1/3 shadow max-w-md p-4 bg-white rounded-lg  sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex items-center justify-between mb-4">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Les Entreprises</h5>
                            <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                Voir toutes les entreprises
                            </a>
                        </div>
                        <div class="flow-root">
                            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                <?php foreach ($companies as $company) { 
                                    
                                    ?>
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <img class="w-8 h-8 rounded-full" src="<?php echo base_url($company->companyLogoPath);?>" alt="Freelancer Avatar">
                                            </div>
                                            <div class="flex flex-1 min-w-0">
                                                <div>
                                                    <div class="flex">
                                                        <p class="text-md font-medium text-gray-900 truncate dark:text-white mr-2">
                                                            <?= $company->companyName ?>
                                                        </p>
                                                        <div>
                                                        
                                                        </div>
                                                    </div>
                                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                        <?= $companyUsers[$company->idCompany][0]->userFirstName ?>
                                                        <?= $companyUsers[$company->idCompany][0]->userLastName ?> 
                                                    </p>
                                                </div>
                                                
                                                
                                            </div>
                                            
                                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                            <a href="#" class="w-full text-white bg-primary hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-full text-sm px-5 py-2.5 text-center">Voir</a>
                                            </div>
                                        </div>
                                    </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="w-1/3 shadow max-w-md p-4 bg-white rounded-lg  sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex items-center justify-between mb-4">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Les Offres</h5>
                            <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                Voir toutes les offres
                            </a>
                        </div>
                        <div class="flow-root">
                            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                <?php 
                                $count = 0;
                                foreach ($missions as $mission) {
                                    if ($count >= 5) {
                                        break; // Sortez de la boucle si le compteur atteint 5
                                    }
                                    ?>
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <img class="w-8 h-8 rounded-full" src="<?php echo base_url($freelancer->userAvatarPath);?>" alt="Freelancer Avatar">
                                            </div>
                                            <div class="flex flex-1 min-w-0">
                                                <div>
                                                    <div class="flex">
                                                        <p class="text-md font-medium text-gray-900 truncate dark:text-white mr-2">
                                                            <?= $mission->missionName ?>
                                                        </p>
                                                    <div>
                                                        
                                                        </div>
                                                    </div>
                                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                        <?= $freelancer->userEmail?>
                                                    </p>
                                                </div>
                                                
                                                
                                            </div>
                                            
                                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                <?= $freelancer->userTJM?> €/j
                                            </div>
                                        </div>
                                    </li>
                                    <?php 
                                        $count++; // Incrémente le compteur après chaque mission affichée
                                    } 
                                    ?>
                            </ul>
                        </div>
                    </div>
                    <div class="w-1/3 shadow max-w-md p-4 bg-white rounded-lg  sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex items-center justify-between mb-4">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Les Avis</h5>
                            <!-- <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                Voir toutes les offres
                            </a> -->
                        </div>
                        <!-- <div class="flow-root">
                            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                <?php foreach ($freelancers as $freelancer) { ?>
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <img class="w-8 h-8 rounded-full" src="<?php echo base_url($freelancer->userAvatarPath);?>" alt="Freelancer Avatar">
                                            </div>
                                            <div class="flex flex-1 min-w-0">
                                                <div>
                                                    <div class="flex">
                                                        <p class="text-md font-medium text-gray-900 truncate dark:text-white mr-2">
                                                            <?= $freelancer->userFirstName ?>
                                                        </p>
                                                        <div>
                                                        <?php
                                                            if($freelancer->userIsAvailable == 1){
                                                        ?>
                                                        <div class="flex items-center space-x-1 bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-300 dark:text-green-900">
                                                            <div style="width: 0.5rem; height: 0.5rem" class="bg-green-500 rounded-full dark:bg-green-700"></div>
                                                            <div>Disponible</div>
                                                        </div>
                                                        <?php
                                                            } else {
                                                        ?>
                                                            <div class="flex items-center space-x-1 bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-300 dark:text-red-900">
                                                                <div style="width: 0.5rem; height: 0.5rem" class="bg-red-500 rounded-full dark:bg-red-700"></div>
                                                                <div>Non Disponible</div>
                                                            </div>
                                                        <?php
                                                            }
                                                        ?> 
                                                        </div>
                                                    </div>
                                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                        <?= $freelancer->userEmail?>
                                                    </p>
                                                </div>
                                                
                                                
                                            </div>
                                            
                                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                <?= $freelancer->userTJM?> €/j
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div> -->
                    <!-- </div> --> 
                      
                </div>         
            </div>
        </div>
    </div>
</div>








<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script>
  // ApexCharts options and config
  window.addEventListener("load", function() {
    let options = {
      chart: {
        height: "100%",
        maxWidth: "100%",
        type: "line",
        fontFamily: "Inter, sans-serif",
        dropShadow: {
          enabled: false,
        },
        toolbar: {
          show: false,
        },
      },
      tooltip: {
        enabled: true,
        x: {
          show: false,
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        width: 6,
      },
      grid: {
        show: true,
        strokeDashArray: 4,
        padding: {
          left: 2,
          right: 2,
          top: -26
        },
      },
      series: [
        {
          name: "Clicks",
          data: [6500, 6418, 6456, 6526, 6356, 6456],
          color: "#1A56DB",
        },
        {
          name: "CPC",
          data: [6456, 6356, 6526, 6332, 6418, 6500],
          color: "#7E3AF2",
        },
      ],
      legend: {
        show: false
      },
      stroke: {
        curve: 'smooth'
      },
      xaxis: {
        categories: ['01 Feb', '02 Feb', '03 Feb', '04 Feb', '05 Feb', '06 Feb', '07 Feb'],
        labels: {
          show: true,
          style: {
            fontFamily: "Inter, sans-serif",
            cssClass: 'text-xs font-normal dark:text-white fill-gray-500 dark:fill-gray-400 '
          }
        },
        axisBorder: {
          show: false,
        },
        axisTicks: {
          show: false,
        },
      },
      yaxis: {
        show: false,
      },
    }

    if (document.getElementById("line-chart") && typeof ApexCharts !== 'undefined') {
      const chart = new ApexCharts(document.getElementById("line-chart"), options);
      chart.render();
    }
  });
</script>
