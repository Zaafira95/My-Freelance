<?php
// Header Call
$currentPage = 'whatsapp';

include(APPPATH . 'views/layouts/user/header.php' );
?>
<head>
    <title>Communauté WhatsApp | Café Crème Community </title>

<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>


</head>



<div class="absolute hidden top-0 right-4 mt-4 mb-4">
    <svg id="heart" class="w-5 h-5 text-red-600 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 30" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.879c-2.484-4.375-12-1.82-12 4.879 0 5.572 5.126 7.664 12 14.121 6.874-6.457 12-8.549 12-14.121 0-6.699-9.516-9.254-12-4.879z"/>
    </svg>
</div>

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
                                <!-- <p class="text-3xl lg:text-base text-gray-600 mb-4 dark:text-white"><?= $group->whatsAppGroupDescription?></p> -->

                                <!-- Bouton pour rejoindre le groupe -->
                                <!-- Si le groupe est plein, afficher un bouton grisé écrit Complet -->
                                <?php if ($group->whatsAppGroupIsFull == 1){?>
                                    <a href="#" class="mt-4 text-3xl lg:text-base block w-full text-center bg-gray-300 text-white font-semibold px-4 py-2 rounded-full hover:shadow-md transition duration-300 dark:text-white cursor-not-allowed">Complet</a>
                                <?php
                                }
                                else {
                                ?>
                                    <a href="<?= $group->whatsAppGroupLink?>" class="mt-4  text-3xl lg:text-base block w-full text-center bg-primary hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-full hover:shadow-md transition duration-300 dark:text-white">Rejoindre</a>
                                <?php
                                }
                                ?>
                            </div>
                            <?php $count++; ?>
                        <?php endforeach; ?>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>

<!--- test -->

<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    
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