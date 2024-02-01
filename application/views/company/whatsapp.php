<?php
// Header Call
$currentPage = 'whatsapp';

include(APPPATH . 'views/layouts/company/header.php' );
?>
<head>
    <title>Communauté WhatsApp | Café Crème Community </title>

<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>


</head>

<div class="px-8 py-6 lg:px-4 lg:py-6 h-90 overflow-y-auto no-scrollbar">
    <div class="justify-between items-center mx-auto max-w-screen-xl h-full">
        <div class="lg:flex gap-6 h-full mb-3">
            <div class="w-full overflow-y-auto no-scrollbar">
                <h1 class="text-3xl lg:text-2xl font-semibold text-gray-900 dark:text-white py-4 px-4">
                    Rejoignez les groupes de la plus grande communauté de freelance en France
                </h1>
                <div class="items-center overflow-hidden py-4 px-4">
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Remplacez les informations de chaque groupe avec vos propres données -->
                        <?php $count = 0; ?>
                        <?php foreach ($groups as $group) : ?>
                            <div class="bg-white  mb-4 dark:bg-gray-800 shadow-md rounded-lg p-6">
                                <!-- Icône du groupe -->
                                <img src="<?php echo base_url($group->whatsAppGroupImage); ?>" alt="Icone du groupe" class="rounded-full mx-auto mb-4" style="width:120px; height:120px;">

                                <!-- Nom du groupe -->
                                <h3 class="text-3xl lg:text-lg font-semibold text-gray-900 dark:text-white"><?= $group->whatsAppGroupName?></h3>

                                <!-- Description du groupe -->
                                <p class="text-3xl lg:text-base text-gray-600 mb-4 dark:text-white"><?= $group->whatsAppGroupDescription?></p>

                                <!-- Bouton pour rejoindre le groupe -->
                                <a href="<?= $group->whatsAppGroupLink?>" class="text-3xl lg:text-base block w-full text-center bg-primary hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-full hover:shadow-md transition duration-300 dark:text-white">Rejoindre</a>
                            </div>
                            <?php $count++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
