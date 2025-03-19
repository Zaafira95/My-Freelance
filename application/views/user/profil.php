<?php
// Header Call
$currentPage = 'profil';

include(APPPATH . 'views/layouts/user/header.php' );
?>
<head>
    <title><?=$user->userFirstName.' '.$user->userLastName.' '.ucfirst($user->userType)?>  - My Freelance </title>

<style>
  
    .file-thumbnail-img {
    max-width: 100%;
    height: auto;
    cursor: pointer;
    border-radius: 4px;
}

.full-pdf-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    display: none;
    z-index: 9999;
    overflow: auto;
}

.full-pdf-container canvas {
    display: block;
    margin: 20px auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 4px;
}

</style>

<link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">
<link href="<?php echo base_url('/node_modules/choices.js/public/assets/styles/choices.min.css');?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('/node_modules/intl-tel-input/build/css/intlTelInput.min.css');?>">



</head>



<!-- User Data Modal -->

<div id="updateUserData" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-80 lg:w-60 h-90 overflow-y-auto no-scrollbar">
        <!-- Modal content -->
        <div class="relative p-8 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-3xl lg:text-lg font-semibold text-gray-900 dark:text-white">
                    Your personal information
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg  p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateUserData">
                    <svg aria-hidden="true" class="w-8 h-8 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?=base_url("user/updateUserData")?>" id="updateUserDataForm" method="post" enctype="multipart/form-data">
                    <div>
                        <div class="flex flex-col items-center">
                            <div class="relative w-64 h-64 lg:w-32 lg:h-32">
                                <div class="rounded-full ring ring-primary w-full h-full flex items-center justify-center">
                                    <div class="w-full h-full rounded-full flex items-center justify-center">
                                    <?php 
                                        if($user->userAvatarPath == null){
                                            $user->userAvatarPath = 'assets/img/default-avatar.png';
                                        }
                                    ?>
                                    <img id="avatar-image" src="<?php echo base_url($user->userAvatarPath); ?>" class="rounded-full object-cover w-full h-full" alt="Avatar">
                                    </div>
                                    <div class="absolute bottom-0 right-0 bg-white rounded-full">
                                    <label for="avatar-upload">
                                        <div class="rounded-full p-2 ring ring-primary">
                                        <i class="fas fa-pen text-primary cursor-pointer"></i>
                                        </div>
                                    </label>
                                    <input type="file" id="avatar-upload" name="avatar-upload" class="hidden" accept=".png, .jpeg, .jpg" onchange="showFileName(this)">
                                    </div>
                                </div>
                            </div>
                            <p id="avatarErrorMessage" class="text-red-500 text-base mt-2 hidden">The image size must be less than 2048 KB</p>
                            <span id="file-name" class="hidden  text-gray-500 mt-4 dark:text-white"></span>
                            <!-- Delete user profile picture -->
                            <?php
                                if ($user->userAvatarPath !=='assets/img/default-avatar.png') {
                                    ?>
                                    <a href="#" onclick="showModal('deleteAvatarConfirmationModal');" class="text-3xl lg:text-base text-red-600 hover:text-red-900 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg px-5 py-2.5 text-center dark:text-red-500 dark:hover:text-white dark:focus:ring-red-900" data-modal-toggle="deleteUserAvatar">
                                        Delete profile picture
                                    </a>
                                    <div id="deleteAvatarConfirmationModal" class="hidden fixed inset-0 flex items-center justify-center z-50">
                                        <div class="fixed inset-0 bg-black opacity-50"></div>
                                        <div class="relative bg-gray-50 rounded-lg shadow p-6 border border-gray-800 dark:bg-gray-800 sm:p-5">
                                            <h3 class="text-3xl lg:text-lg font-semibold mb-4">Deletion confirmation</h3>
                                            <p class="text-3xl lg:text-base text-gray-700 dark:text-white mb-6">Are you sure you want to delete your profile picture?</p>
                                            <div class="flex justify-end">
                                                <button type="button" onclick="hideModal('deleteAvatarConfirmationModal');" class="text-3xl lg:text-base text-gray-600 inline-flex items-center hover:text-white hover:bg-gray-800 border-gray-600  focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg px-5 py-2.5 text-center dark:border-gray-500 dark:text-gray-500  dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-900">Annuler</button>
                                                <a href="<?php echo base_url('user/deleteProfilPicture/'.$user->userId);?>" class="text-3xl lg:text-base text-red-800 inline-flex items-center hover:text-white hover:bg-red-900 border-red-900  focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500  dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Supprimer</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                        </div>

                    <label for="userFirstName" class="text-3xl lg:text-base block mb-1  font-medium text-gray-900 dark:text-white">Your first name *</label>
                        <input type="text" name="userFirstName" id="userFirstName" value="<?=$user->userFirstName?>" class="text-3xl lg:text-base mb-2 bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <label for="userLastName" class="text-3xl lg:text-base block mb-1  font-medium text-gray-900 dark:text-white">Your last name *</label>
                        <input type="text" name="userLastName" id="userLastName" value="<?=$user->userLastName?>" class="text-3xl lg:text-base mb-2 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <label for="userJobName" class="text-3xl lg:text-base block mb-1  font-medium text-gray-900 dark:text-white">Your job *</label>
                        <div class="w-full text-black">    
                            <select id="jobsAll" name="jobsAll[]"  style="font-size:1rem;" class="text-3xl lg:text-base font-medium mb-2 bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <?php foreach ($jobsAll as $joba): ?>
                                    <option class="text-3xl lg:text-base dark:text-black" value="<?= $joba['jobName']?>"
                                        <?= ($job->jobName == $joba['jobName']) ? 'selected' : '' ?>>
                                    <?= $joba['jobName'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <label for="userExpertise" class="text-3xl lg:text-base block mb-1  font-medium text-gray-900 dark:text-white">Your expertise *</label>
                        <select id="userExpertise" name="userExpertise" class="text-3xl lg:text-base font-medium mb-2 bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option class="text-3xl lg:text-base dark:text-black" value="junior">Junior (1 to 2 years)</option>
                            <option class="text-3xl lg:text-base dark:text-black" value="intermediaire">Intermediate (3 to 5 years)</option>
                            <option class="text-3xl lg:text-base dark:text-black" value="expert">Expert (5+ years)</option>
                        </select>
                    <label for="userTJM" class="text-3xl lg:text-base block mb-1 mt-2 font-medium text-gray-900 dark:text-white">Your daily rate *</label>
                        <input type="number" name="userTJM" id="userTJM" value="<?=$user->userTJM?>" class="text-3xl lg:text-base mb-2 bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" min="100" required>
                    <label for="userTelephone" class="text-3xl lg:text-base block mb-1  font-medium text-gray-900 dark:text-white">Your WhatsApp number *</label>
                        <input type="tel" name="userTelephone" id="userTelephone" value="<?=$user->userTelephone?>" class="text-3xl lg:text-base mb-2 bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <p id="errorUserTelephone" class="text-red-500 text-3xl lg:text-base mt-2 hidden">Please enter a valid phone number</p>


                        <p id="errorMessageUserData" class="text-3xl lg:text-base text-red-500  mt-2 hidden">Please fill in all fields correctly</p>
                        <p id="tjmErrorMessage" class="text-3xl lg:text-base text-red-500  mt-2 hidden">The daily rate must be greater than 100</p>
                    </div>
                <div class="flex items-center space-x-4 mt-4">
                    <button type="submit" class="text-3xl lg:text-base text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Save
                    </button>
                    <button type="button" data-modal-toggle="updateUserData" class="text-3xl lg:text-base text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- User Preference Modal -->
<div id="updateUserPreference" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-80 lg:w-60 h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-3xl lg:text-lg font-semibold text-gray-900 dark:text-white">
                Your Preferences
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg  p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateUserPreference">
                    <svg aria-hidden="true" class="w-8 h-8 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?=base_url("user/updateUserPreference")?>" method="post" id ="userPreferenceForm" enctype="multipart/form-data">
                <div>
                    <label for="name" class="text-3xl lg:text-base block mb-2  font-medium text-gray-900 dark:text-white">Are you available to work right now?</label>
                    <label class="text-3xl lg:text-base text-gray-500 mr-3 dark:text-gray-400">No</label>
                    <input type="checkbox" name="userIsAvailable" id="hs-basic-with-description-preference" <?php echo $checkboxChecked; ?> onchange="displayAvailibilityOptionsPreference()" class="text-3xl lg:text-base relative shrink-0 w-[3.25rem] h-7 bg-gray-100 checked:bg-gray-100 rounded-full cursor-pointer transition-colors ease-in-out duration-200 border border-transparent ring-1 ring-transparent focus:border-green-600 focus:ring-green-600 ring-offset-white focus:outline-none appearance-none dark:bg-gray-700 dark:checked:bg-green-600 dark:focus:ring-offset-gray-800 before:inline-block before:w-6 before:h-6 before:bg-white checked:before:bg-green-500 before:translate-x-0 checked:before:translate-x-full before:shadow before:rounded-full before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-gray-400 dark:checked:before:bg-green-200">
                    <label class="text-3xl lg:text-base text-gray-500 ml-3 dark:text-gray-400">Yes</label>
                    <div id="isAvailaibleOptionsPreference" style="display: <?php echo $checkboxChecked == 'checked' ? "block" : "none" ?>" class=" mt-4 mb-2">
                        <label for="name" class="block mb-2 font-medium text-gray-900 dark:text-white">How many days per week are you available?</label>
                        <select id="userJobTimePartielOrFullTime" name="userJobTimePartielOrFullTime" class="bg-gray-50 border mt-2 border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                    <div id="isNotAvailaibleOptionsPreference" style="display: <?php echo $checkboxChecked == '' ? "block" : "none" ?>" class="mt-4 mb-2">
                        <label for="dateFinIndisponibilitePreference" class="block mb-2 font-medium text-gray-900 dark:text-white">When will you be available again?</label>
                        <div class="flex flex-1 mt-2">
                            <div class="flex items-center mr-6">
                                <input type="radio" id="1mois" value="1" name="finIndisponibiliteDuree" class="finIndisponibiliteBtnPreference w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="1mois" class="ml-2 font-medium text-gray-900 dark:text-white">In 1 month</label>
                            </div>
                            <div class="flex items-center mr-6">
                                <input type="radio" id="3mois" value="3" name="finIndisponibiliteDuree" class="finIndisponibiliteBtnPreference w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="3mois" class="ml-2 font-medium text-gray-900 dark:text-white">In 3 months</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="6mois" value="6" name="finIndisponibiliteDuree" class="finIndisponibiliteBtnPreference w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="6mois" class="ml-2 font-medium text-gray-900 dark:text-white">In 6 months</label>
                            </div>
                        </div>
                        <input type="date" id="dateFinIndisponibilitePreference" value="<?= $user->userDateFinIndisponibilite ?>" name="dateFinIndisponibilite" class="w-full mt-2 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <p id="errorDateFinIndisponibilitePreference" class="mt-2 text-red-500" style="display:none;">Please enter a date</p>
                    </div>

                    <label for="userJobType" class="text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Job type</label>
                    
                    <div class="flex flex-1 gap-6 mb-3">
                        <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700 w-full mr-4">
                            <input id="teletravail" type="radio" value="Remote" name="userJobType" class="text-3xl lg:text-base w-6 h-6 lg:w-4 lg:h-4  text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" <?php echo ($user->userJobType === 'Remote') ? 'checked' : ''; ?> required>
                            <label for="teletravail" class="text-3xl lg:text-base py-4 ml-2  font-medium text-gray-900 dark:text-white">Remote</label>
                        </div>
                        <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700 w-full mr-4">
                            <input id="hybride" type="radio" value="Hybride" name="userJobType" class="text-3xl lg:text-base w-6 h-6 lg:w-4 lg:h-4  text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" <?php echo ($user->userJobType === 'Hybride') ? 'checked' : ''; ?>>
                            <label for="hybride" class="text-3xl lg:text-base py-4 ml-2  font-medium text-gray-900 dark:text-white">Hybrid</label>
                        </div>
                        <div class="flex items-center pl-4 border  border-gray-200 rounded dark:border-gray-700 w-full mr-4">
                            <input id="sur-site" type="radio" value="Physique" name="userJobType" class="text-3xl lg:text-base w-6 h-6 lg:w-4 lg:h-4  text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" <?php echo ($user->userJobType === 'Physique') ? 'checked' : ''; ?>>
                            <label for="sur-site" class="text-3xl lg:text-base py-4 ml-2  font-medium text-gray-900 dark:text-white">On site</label>
                        </div>
                    </div>
                    <p id="errorMessageJobType" class="text-3xl lg:text-base text-red-500" style="display:none;">Please choose a job type</p>
                    <label for="userVille" class="text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Location</label>
                    <div>    
                        <div class="relative city-search-container w-full mr-4">
                            <input type="text" id="citySearch" name="userVille" placeholder="Search your city" value="<?php echo $user->userVille != 'Etranger' ? $user->userVille : "" ?>" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900 sm:text-lg rounded-lg block w-full p-2.5 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500" placeholder="Saisissez votre localisation *" >
                                <div id="cities-list" class="text-3xl lg:text-base absolute z-10 mt-2 w-full  rounded bg-white max-h-64 overflow-y-auto text-black"></div>
                        </div>
                        <div class="flex items-center mt-2">
                            <input type="checkbox" id="userEtranger" name="userEtranger" <?php echo $user->userVille === 'Etranger' ? 'checked' : "" ?>>
                            <label class="text-3xl lg:text-base ml-2 text-gray-500 dark:text-gray-400">Abroad</label>
                        </div>
                    </div>
                    <label for="userJobTime" class="text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Mission Duration</label>
                    <select id="userJobTime" name="userJobTime" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        <?php
                        $jobTimeOptions = ['Short-term', 'Long-term', 'Indefinite duration'];
                        foreach ($jobTimeOptions as $option) {
                            echo '<option value="' . $option . '"';
                            if ($user->userJobTime === $option) {
                                echo ' selected';
                            }
                            echo '>' . $option . '</option>';
                        }
                        ?>
                    </select>


                
                    <p id="errorMessageUserData" class="text-3xl lg:text-base text-red-500  mt-2 hidden">Please fill in all fields correctly</p>
                    <p id="tjmErrorMessage" class="text-3xl lg:text-base text-red-500  mt-2 hidden">The daily rate must be greater than 100</p>
                </div>
                <div class="flex items-center space-x-4 mt-4">
                    <button type="submit" class="text-3xl lg:text-base text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Save
                    </button>
                    <button type="button" data-modal-toggle="updateUserPreference" class="text-3xl lg:text-base text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- User Links Modal -->
<div id="updateUserLinks" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-80 lg:w-60 h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-3xl lg:text-lg font-semibold text-gray-900 dark:text-white">
                    Your useful links
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg  p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateUserLinks">
                    <svg aria-hidden="true" class="w-8 h-8 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?=base_url("user/updateUserLinks")?>" method="post" enctype="multipart/form-data">
                <div>
                    <label for="userEmail" class="text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" id="userEmail" name="userEmail" value="<?=$user->userEmail?>" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-not-allowed" placeholder="Email" disabled>

                    <label for="userPortfolioLink" class="text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Portfolio</label>
                    <input type="text" id="userPortfolioLink" name="userPortfolioLink" value="<?=$user->userPortfolioLink?>" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Portfolio" onblur="checkPortfolioLink()">

                    <label for="userLinkedinLink" class="text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Linkedin</label>
                    <input type="text" id="userLinkedinLink" name="userLinkedinLink" value="<?=$user->userLinkedinLink?>" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Linkedin" onblur="checkLinkedinLink()">

                    <label for="userGithubLink" class="text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Github</label>
                    <input type="text" id="userGithubLink" name="userGithubLink" value="<?=$user->userGithubLink?>" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Github" onblur="checkGithubLink()">
                    
                    <label for="userDribbleLink" class="text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Dribbble</label>
                    <input type="text" id="userDribbleLink" name="userDribbleLink" value="<?=$user->userDribbleLink?>" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Dribbble" onblur="checkDribbbleLink()">

                    <label for="userBehanceLink" class="text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Behance</label>
                    <input type="text" id="userBehanceLink" name="userBehanceLink" value="<?=$user->userBehanceLink?>" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Behance" onblur="checkBehanceLink()">

                </div>
                <div class="flex items-center space-x-4 mt-4">
                    <button type="submit" class="text-3xl lg:text-base text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Save
                    </button>
                    <button type="button" data-modal-toggle="updateUserLinks" class="text-3xl lg:text-base text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
foreach ($experiences as $index => $experience) {
?>
    <div id="updateUserExperience<?=$index?>" tabindex="-1" aria-hidden="true" class=" hidden overflow-y-auto overflow-x-hidden fixed top-30 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-80 lg:w-60 h-90 overflow-y-auto no-scrollbar">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-3xl lg:text-lg font-semibold text-gray-900 dark:text-white">
                        <?='Experience: '.$experience->experienceJob?>
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg  p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateUserExperience<?=$index?>">
                        <svg aria-hidden="true" class="w-8 h-8 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form id="updateUserExperience-form" action="<?=base_url("user/updateUserExperience/".$experience->idExperience)?>" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="userExperienceJob" class="text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Experience name</label>
                        <input type="text" id="userExperienceJob" name="userExperienceJob" value="<?=$experience->experienceJob?>" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Title">
                        <label for="userExperienceCompany" class="text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Company name</label>
                        <input type="text" id="userExperienceCompany" name="userExperienceCompany" value="<?=$experience->experienceCompany?>" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Company">

                        <label for="userExperienceDateDebut" class="w-full text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Start date</label>
                        <input type="date" id="updateUserExperienceDateDebut<?=$index?>" name="userExperienceDateDebut" value="<?=$experience->experienceDateDebut?>" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" oninput="validateDates('updateUserExperienceDateDebut<?=$index?>', 'updateUserExperienceDateFin<?=$index?>', 'errorUpdateUserExperienceDate<?=$index?>', 'userExperienceSubmit<?=$index?>')">

                        <label for="userExperienceDateFin" class="text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">End date</label>
                        <input type="date" id="updateUserExperienceDateFin<?=$index?>" name="userExperienceDateFin" value="<?=$experience->experienceDateFin?>" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" oninput="validateDates('updateUserExperienceDateDebut<?=$index?>', 'updateUserExperienceDateFin<?=$index?>', 'errorUpdateUserExperienceDate<?=$index?>', 'userExperienceSubmit<?=$index?>'), resetCheckbox('updateUserExperienceDateFinToday<?=$index?>')">
                                                
                        <div class="flex items-center mt-2">
                            <input type="checkbox" id="updateUserExperienceDateFinToday<?=$index?>" name="updateUserExperienceDateFinToday" <?= ($experience->experienceDateFin == '0000-00-00') ? 'checked' : '' ?> onclick="resetDateFin('updateUserExperienceDateFin<?=$index?>', 'updateUserExperienceDateFinToday<?=$index?>', 'errorUpdateUserExperienceDate<?=$index?>', 'userExperienceSubmit<?=$index?>')">
                            <label class="text-3xl lg:text-base ml-2 text-gray-500 dark:text-gray-400">Today</label>
                        </div>
                        <p id="errorUpdateUserExperienceDate<?=$index?>" class="text-red-500" style="display:none;">The end date must be later than the start date</p>

                        <label for="userExperienceDescription" class="text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="userExperienceDescription" name="userExperienceDescription" rows="3" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><?=$experience->experienceDescription?></textarea>
                    </div>
                    <!-- Rest of the form fields for the experience -->
                    <div class="mt-6 mb-6 bg-white rounded-lg dark:bg-gray-800 text-black">
                        <label for="userExperienceSkills" class="text-2xl lg:text-lg block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Your Skills</label>
                        <div id="experience-skills-container-<?=$index?>">
                        <?php foreach ($experienceSkills[$experience->idExperience] as $experienceSkill): ?>
                            <div class="flex flex-1 mb-4 skill-row">
                                <div class="text-3xl lg:text-base w-3/4 mr-2 text-black">
                                    <!--<select id="skillsAll" name="skillsAll[]"  class="new-skill-select mt-1 block w-full py-2 px-3 border border-gray-300 bg-white text-black rounded-full shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>-->
                                    <select id="skillsAll2" name="skillsAll[]"  class="text-3xl lg:text-base new-skill-select bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                        <option value="">Select a skill</option>
                                        <?php foreach ($skillsAll as $skill): ?>
                                            <option value="<?= $skill['skillId'] ?>" <?= ($experienceSkill->experienceSkills_skillId == $skill['skillId']) ? 'selected' : '' ?>><?= $skill['skillName'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="w-1/4">
                                    <select name="skillsLevel[]" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                        <option value="1" <?= ($experienceSkill->experienceSkillsExpertise == 1) ? 'selected' : '' ?>>Junior</option>
                                        <option value="2" <?= ($experienceSkill->experienceSkillsExpertise == 2) ? 'selected' : '' ?>>Intermediate</option>
                                        <option value="3" <?= ($experienceSkill->experienceSkillsExpertise == 3) ? 'selected' : '' ?>>Expert</option>
                                    </select>
                                </div>
                                <button type="button" class="text-red-600 hover:text-red-900 focus:outline-none ml-4 delete-skill-row">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <button id="add-experience-skill-btn" type="button" class="text-3xl lg:text-base add-experience-skill-btn py-2 px-4 bg-primary text-white rounded-lg" data-container="experience-skills-container-<?=$index?>">Add a skill</button>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <div>
                            <button type="submit" id="userExperienceSubmit<?=$index?>" class="text-3xl lg:text-base text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Save
                            </button>
                            <button type="button" data-modal-toggle="updateUserExperience<?=$index?>" class="text-3xl lg:text-base text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                Cancel
                            </button>
                        </div>
                        <a href="#" onclick="showModal('deleteConfirmationModal<?=$index?>');" class="text-3xl lg:text-base text-red-600 inline-flex items-center hover:text-white hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                            <i class="fa fa-trash mr-2"></i> Delete
                        </a>
                    </div>
                    <div id="deleteConfirmationModal<?=$index?>" class="hidden fixed inset-0 flex items-center justify-center z-50">
                        <div class="fixed inset-0 bg-black opacity-50"></div>
                        <div class="relative bg-gray-50 rounded-lg shadow p-6 border border-gray-800 dark:bg-gray-800 sm:p-5">
                            <h3 class="text-2xl lg:text-lg font-semibold mb-4">Deletion confirmation</h3>
                            <p class="text-3xl lg:text-base text-gray-700 dark:text-white mb-6">Are you sure you want to delete this experience?</p>
                            <div class="flex justify-end">
                                <button type="button" onclick="hideModal('deleteConfirmationModal<?=$index?>');" class="text-gray-600 inline-flex items-center hover:text-white hover:bg-gray-800 border-gray-600  focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg px-5 py-2.5 text-center dark:border-gray-500 dark:text-gray-500  dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-900">Annuler</button>
                                <a href="<?= base_url("user/deleteUserExperience/".$experience->idExperience) ?>" class="text-red-800 inline-flex items-center hover:text-white hover:bg-red-900 border-red-900  focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500  dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Supprimer</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
}
?>

<!-- User Add Experience -->
<div id="addUserExperience" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">

    <div class="relative p-4 w-80 lg:w-60 h-90 overflow-y-auto no-scrollbar">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-3xl lg:text-lg font-semibold text-gray-900 dark:text-white">
                Add an Experience
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg  p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="addUserExperience">
                    <svg aria-hidden="true" class="w-8 h-8 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="addUserExperience-form" action="<?=base_url("user/addUserExperience")?>" method="post" enctype="multipart/form-data">
                <div>
                    <label for="userExperienceJob" class="text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Experience Name</label>
                    <input type="text" id="userExperienceJob" name="userExperienceJob" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Title" required>
                    <label for="userExperienceCompany" class="text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Company Name</label>
                    <input type="text" id="userExperienceCompany" name="userExperienceCompany" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Company" required>

                    <label for="userExperienceDateDebut" class="text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Start Date</label>
                    <input type="date" id="addUserExperienceDateDebut" name="userExperienceDateDebut" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>

                    <label for="userExperienceDateFin" class="text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">End Date</label>
                    <input type="date" id="addUserExperienceDateFin" name="userExperienceDateFin" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                                                                   
                    <div class="flex items-center mt-2">
                        <input type="checkbox" id="addUserExperienceDateFinToday" name="addUserExperienceDateFinToday">
                        <label class="text-3xl lg:text-base ml-2 text-gray-500 dark:text-gray-400">Today</label>
                    </div>
                    <p id="errorAddUserExperienceDate" class="mt-2 text-red-500" style="display:none;">The end date must be later than the start date</p>

                    <label for="userExperienceDescription" class="text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Description</label>
                    <textarea id="userExperienceDescription" name="userExperienceDescription" rows="3" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>

                </div>
                <div class="mt-6 mb-6 bg-white rounded-lg dark:bg-gray-800 text-black">
                    <label for="userExperienceSkills" class="text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Your Skills</label>

                    <div id="experience-skills-container">

                    </div>
                    <button id="add-experience-skill-btn" type="button" class="text-3xl lg:text-base add-experience-skill-btn py-2 px-4 bg-primary text-white rounded-lg" data-container="experience-skills-container">Add a skill</button>
                </div>
                <div class="flex items-center space-x-4 mt-4">
                    <button type="submit" class="text-3xl lg:text-base text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Save
                    </button>
                    <button type="button" data-modal-toggle="addUserExperience" class="text-3xl lg:text-base text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="updateUserSkills" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-80 lg:w-60 h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-3xl lg:text-lg font-semibold text-gray-900 dark:text-white">
                   Your skills
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg  p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateUserSkills">
                    <svg aria-hidden="true" class="w-8 h-8 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?=base_url("user/updateUserSkills")?>" method="post" enctype="multipart/form-data">
                <div>
                    <?php 
                    foreach ($skills as $index => $skill) {
                    ?> 

                    <label for="userSkill<?=$index?>" class="text-3xl lg:text-base block mt-4 mb-2  font-medium text-gray-900 dark:text-white">Skill</label>
                    <input type="text" id="userSkill<?=$index?>" name="userSkill<?=$index?>" value="<?=$skill->skillName?>" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-3/4 p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Skill">

                    <?php } ?>
                </div>
                <div class="flex items-center space-x-4 mt-4">
                    <button type="submit" class="text-3xl lg:text-base text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Save
                    </button>
                    <button type="button" data-modal-toggle="updateUserSkills" class="text-3xl lg:text-base text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- User Add Attachment -->
<div id="addUserAttachment" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-80 lg:w-60 h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-3xl lg:text-lg font-semibold text-gray-900 dark:text-white">
                Add an attachment
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg  p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="addUserAttachment">
                    <svg aria-hidden="true" class="w-8 h-8 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?= base_url("user/addUserAttachment") ?>" method="post" enctype="multipart/form-data">
                <div>
                    <label for="userAttachmentFile" class="text-3xl lg:text-base block mt-4 mb-2 font-medium text-gray-900 dark:text-white">Attachment (.pdf)</label>
                    <input type="file" id="userAttachmentFile" name="userAttachmentFile" accept=".pdf" class="hidden" data-max-size="2048">
                    <label for="userAttachmentFile" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-pointer">
                        <span class="filename">Choose a file </span>

                    </label>
                    <div id="fileSizeInfo" class="text-2xl lg:text-sm text-gray-500 mt-1">The maximum allowed size is 2 MB.</div>
                </div>
                <div class="flex items-center space-x-4 mt-4">
                    <button type="submit" class="text-3xl lg:text-base text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Save
                    </button>
                    <button type="button" data-modal-toggle="addUserAttachment" class="text-3xl lg:text-base text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Cancel
                    </button>
                </div>
            </form>


        </div>
    </div>
</div>

<!-- User Add Skill -->
<div id="addUserSkills" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-80 lg:w-60 h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5 ">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-3xl lg:text-lg font-semibold text-gray-900 dark:text-white">
                    Add your skills
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg  p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="addUserSkills">
                    <svg aria-hidden="true" class="w-8 h-8 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?= base_url("user/addUserSkills") ?>" method="post" enctype="multipart/form-data">
            <div class="p-4 bg-white rounded-lg dark:bg-gray-800 text-black">
                <div id="skills-container">
                    <div class="flex flex-1 mb-4 skill-row">
                        <div class="w-3/4 mr-2">
                        <select id="skillsAll" name="skillsAll[]"  class="text-3xl lg:text-base new-skill-select mt-1 block w-full py-2 px-3 border border-gray-300 bg-white text-black rounded-full shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Select a skill</option>
                                <?php foreach ($skillsAll as $skill): ?>
                                    <option value="<?= $skill['skillId'] ?>"><?= $skill['skillName'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="w-1/4">
                            <select class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="skillsLevel[]" required>
                                <option value="1">Junior</option>
                                <option value="2">Intermediate</option>
                                <option value="3">Expert</option>
                            </select>
                        </div>
                        <button type="button" class="text-red-600 hover:text-red-900 focus:outline-none ml-4 delete-skill-row">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <button id="add-skill-btn" type="button" class="text-3xl lg:text-base py-2 px-4 bg-primary text-white rounded-lg">Add a skill</button>
            </div>
                <div class="flex items-center space-x-4 mt-4">
                    <button type="submit" class="text-3xl lg:text-base text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Save
                    </button>
                    <button type="button" data-modal-toggle="addUserSkills" class="text-3xl lg:text-base text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal pour modifier les compétences -->
<div id="editUserSkills" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-80 lg:w-60 h-full md:h-auto">
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-3xl lg:text-lg font-semibold text-gray-900 dark:text-white">
                Edit your Skills
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editUserSkills">
                    <svg aria-hidden="true" class="w-8 h-8 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <form action="<?= base_url("user/editUserSkills") ?>" method="post" enctype="multipart/form-data">
                <div class="text-3xl lg:text-base p-4 bg-white rounded-lg dark:bg-gray-800 text-black">
                    <div>
                    <?php 
                    $index = 0;
                    foreach ($skills as $skill): ?>
                        <div class="flex flex-1 mb-4 skill-row items-center">
                            <div class="w-3/4 mr-2">
                            <input type="text" name="skillsName[<?=$index?>]" id="skillName" value="<?=$skill->skillName?>" readonly class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="w-1/4 flex items-center justify-between">
                                <select class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-4/5 p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="skillsLevel[]" id="skillLevel" required>
                                    <option value="1" <?= ($skill->userSkillsExperience == 1) ? 'selected' : '' ?>>Junior</option>
                                    <option value="2" <?= ($skill->userSkillsExperience == 2) ? 'selected' : '' ?>>Intermedite</option>
                                    <option value="3" <?= ($skill->userSkillsExperience == 3) ? 'selected' : '' ?>>Expert</option>
                                </select>
                                <a href="<?=base_url('user/deleteUserSkill/'.$skill->skillId)?>">
                                    <button type="button" class="text-3xl lg:text-base text-red-600 hover:text-red-900 focus:outline-none ml-4">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    <?php 
                        $index++;
                        endforeach; 
                    ?>
                    </div>
                </div>
                <div class="flex items-center space-x-4 mt-4">
                    <button type="submit" class="text-3xl lg:text-base text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Save
                    </button>
                    <button type="button" data-modal-toggle="editUserSkills" class="text-3xl lg:text-base text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Company Advantages modal -->
<div id="editUserBio" tabindex="-1" aria-hidden="true" class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-80 lg:w-60 h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-3xl lg:text-lg font-semibold text-gray-900 dark:text-white">
                About you
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg  p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editUserBio">
                    <svg aria-hidden="true" class="w-8 h-8 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?=base_url("user/updateUserBio")?>" method="post" enctype="multipart/form-data">
                <div>

                    <!--<label for="companyDescription" class="block mt-4 mb-2 font-medium text-gray-900 dark:text-white">Description</label>-->
                    <textarea id="userBio" name="userBio" rows="6" class="text-3xl lg:text-base bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><?=$user->userBio?></textarea>

                </div>
                <div class="flex items-center space-x-4 mt-4">
                    <button type="submit" class="text-3xl lg:text-base text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Save
                    </button>
                    <button type="button" data-modal-toggle="editUserBio" class="text-3xl lg:text-base text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
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

// Vérification taux de complétion du profil
$totalInfos = 0;
$tauxCompletion = 40;
if(is_array($skills) && !empty($skills)){
    $totalInfos += 1;
}
if(is_array($experiences) && !empty($experiences)){
    $totalInfos += 1;
}
if(is_array($attachments) && !empty($attachments)){
    $totalInfos += 1;
}
if((isset($user->userPortfolioLink) && !empty($user->userPortfolioLink)) || (isset($user->userLinkedinLink) && !empty($user->userLinkedinLink)) || (isset($user->userGithubLink) && !empty($user->userGithubLink)) || (isset($user->userDribbleLink) && !empty($user->userDribbleLink)) || (isset($user->userBehanceLink) && !empty($user->userBehanceLink))){
    $totalInfos += 1;
}

if($totalInfos == 1 ){
    $tauxCompletion = 55;
} else if ($totalInfos == 2 ){
    $tauxCompletion = 70;
} else if ($totalInfos == 3 ){
    $tauxCompletion = 85;
} else if ($totalInfos == 4 ){
    $tauxCompletion = 100;
}

?>
<div class="absolute hidden top-0 right-4 mt-4 mb-4">
    <svg id="heart" class="w-5 h-5 text-red-600 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 30" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.879c-2.484-4.375-12-1.82-12 4.879 0 5.572 5.126 7.664 12 14.121 6.874-6.457 12-8.549 12-14.121 0-6.699-9.516-9.254-12-4.879z"/>
    </svg>
</div>

<div class="px-8 py-6 lg:px-4 lg:py-6 h-full no-scrollbar">
    <div class="lg:flex flex-wrap justify-between mx-auto max-w-screen-xl h-full">
        <div class="lg:flex h-full w-full mb-3">
            <div class="lg:rounded-lg h-full w-full mb-4 dark:text-white ">
               <?php
                if ($tauxCompletion != 100){
                ?>
                <div class="relative py-4 mb-4">
                    <p class="text-2xl lg:text-lg mb-2">Your profile is completed at <?=$tauxCompletion?>% </p>
                    <div class="relative flex flex-grow items-center w-full h-4 bg-primary-light rounded-md" style="width: 100%;">
                        <div class="absolute inset-0 bg-secondary rounded-lg" style="width: 100%;"></div>
                        <div class="absolute inset-0 bg-primary rounded-lg" style="width: <?=$tauxCompletion?>%;"></div>
                    </div>
                </div>
                
                <?php
                }
                ?>
                <div class="relative flex grid-cols-2 items-center overflow-hidden bg-white rounded-lg mb-4 dark:bg-gray-800 py-4 px-4">
                    <div class="flex flex-1">
                        <div>
                            <img src="<?php echo base_url($user->userAvatarPath); ?>" class="object-cover w-40 h-40 rounded-full" alt="Profile photo">
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
                            <p class="text-3xl lg:text-lg text-black-500 font-bold"><?=$job->jobName?></p>
                            <p class="text-2xl lg:text-lg text-black-500 font-medium">
                                <?php
                                    if ($user->userExperienceYear == "junior"){
                                        $user->userExperienceYear = "Junior";
                                    }
                                    elseif ($user->userExperienceYear == "intermediaire"){
                                        $user->userExperienceYear = "Intermediate";
                                    }
                                    elseif ($user->userExperienceYear == "expert"){
                                        $user->userExperienceYear = "Expert";
                                    }
                                ?>
                                <?=$user->userExperienceYear?>
                            </p>
                            <div class="flex items-center mb-4">
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                <?php if ($i <= $averageStars) { ?>
                                    <img src="<?php echo base_url('assets/img/fill-star.svg'); ?>" class="w-6 h-6">
                                <?php } else { ?>
                                    <img src="<?php echo base_url('assets/img/light-star.svg'); ?>" class="w-6 h-6">
                                <?php } ?>
                                <?php } ?>
                                <a href="#rating">
                                    <p class="ml-2 text-3xl lg:text-base"><?=round($averageStars, 1).' ( '.$ratingCount.' reviews )'?></p>
                                </a>
                            </div>
                        <!-- Whatsapp -->
                        
                        <div class="flex flex-wrap items-center">
                                <!-- Whatsapp -->
                            <?php
                            // if user
                                if($user->userId = $this->session->userdata('userId')){
                            ?>
                                <a href="https://wa.me/<?=$user->userTelephone?>?text=Hello%20<?=$user->userFirstName?>%20!%20I%20am%20interested%20by%20your%20profile%20on%20My%20Freelance%20!%20" target="_blank">
                                
                                <button type="button" data-te-ripple-init data-te-ripple-color="light"
                                    class="font-medium text-3xl lg:text-base mb-2 mr-4 inline-flex items-center rounded-full px-6 py-2.5 leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg"
                                    style="background-color: #25D366">
                                    <span class="mr-2">Contact</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                    </svg>
                                    </button>
                                </a>
                            <?php
                                }
                            ?>

                                <p class="font-medium text-3xl lg:text-base mb-2 mt-2 inline-block px-4 py-2.5 rounded-full bg-primary text-white"><?=$user->userTJM?> AED / day</p>
                            </div>
                        </div>
                    </div>
                    <div class="absolute top-0 right-0 mt-4 mr-4 flex">
                        <button id="updateUserData" data-modal-toggle="updateUserData" class="text-3xl lg:text-base py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                            <i class="fas fa-pen fa-fw"></i>
                        </button>
                    </div>
                </div>
                <div class="lg:flex gap-6 mb-3 mt-6">
                    <div class="w-full lg:w-1/4 lg:sticky lg:top-0">
                        <div class="lg:w-full">
                            <div class="relative bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                                <h2 class="text-4xl lg:text-xl font-bold mb-4"> Preferences </h2> 
                                    <div class="flex grid-cols-2 items-center mb-4">
                                        <?php
                                        // user is available or not
                                        if($user->userIsAvailable == 1){
                                        ?>
                                            <div>
                                                <p class="w-16 h-16 lg:w-9 lg:h-9 rounded-full bg-secondary text-white text-center text-4xl lg:text-xl flex items-center justify-center mr-4 pt-2">👍🏻</p>
                                            </div>
                                        <?php
                                        }else
                                        {
                                        ?>
                                        <div>
                                            <p class="w-16 h-16 lg:w-9 lg:h-9 rounded-full bg-red-400 text-white text-center text-4xl lg:text-xl flex items-center justify-center mr-4 pt-2">👎🏻</p>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <div>
                                            <p class="text text-2xl lg:text-lg">Availibility</p>
                                            <?php
                                            if($user->userIsAvailable == 1){
                                            ?>
                                                <p class="font-bold text-4xl lg:text-xl">Available 
                                                    
                                                <?php
                                                    if($user->userJobTimePartielOrFullTime == "temps-plein"){
                                                ?>
                                                    Full time
                                                <?php
                                                    }
                                                    else{
                                                ?> 
                                                    Part time
                                                <?php
                                                    }
                                                }else{
                                                    
                                                    $dateFinIndisponibilite = new DateTime($user->userDateFinIndisponibilite);
                                                   
                                                    $dateFinIndisponibilite = $dateFinIndisponibilite->format('d/m/Y');
                                            ?>
                                                <p class="font-bold text-4xl lg:text-xl">Not available until <?=$dateFinIndisponibilite?> </p>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="flex grid-cols-2 items-center mb-4">
                                        <?php
                                        // user is available or not
                                        if($user->userJobType == "Hybride"){
                                        ?>
                                            <div>
                                                <p class="w-16 h-16 lg:w-9 lg:h-9 rounded-full bg-pink-300 text-white text-center text-4xl lg:text-xl flex items-center justify-center mr-4 pt-2">✈️</p>
                                            </div>
                                        <?php
                                        }else
                                        {
                                            if ($user->userJobType == "Remote"){
                                        ?>
                                        <div>
                                            <p class="w-16 h-16 lg:w-9 lg:h-9 rounded-full bg-pink-300 text-white text-center text-4xl lg:text-xl flex items-center justify-center mr-4 pt-2">✈️</p>
                                        </div>
                                        <?php
                                            }else{
                                        ?>
                                        <div>
                                            <p class="w-16 h-16 lg:w-9 lg:h-9 rounded-full bg-green-400 text-white text-center text-4xl lg:text-xl flex items-center justify-center mr-4 pt-2">👨🏻‍💻</p>
                                        </div>
                                        <?php
                                        } }
                                        ?>
                                        <div>
                                            <p class="text text-2xl lg:text-lg">Job type</p>
                                            <?php
                                                if($user->userJobType == "Hybride"){
                                                ?>
                                                    <p class="font-bold text-4xl lg:text-xl">Hybrid</p>
                                                <?php
                                                    }else if($user->userJobType == "Remote"){
                                                ?>
                                                    <p class="font-bold text-4xl lg:text-xl">Full remote</p>
                                                <?php
                                                    }else if($user->userJobType == "Physique"){
                                                ?>
                                                    <p class="font-bold text-4xl lg:text-xl">On site</p>
                                                <?php
                                                    }
                                                ?>
                                            <!-- error message -->
                                        </div>
                                    </div>
                                    <div class="flex grid-cols-2 items-center mb-4">
                                        <div>
                                            <p class="w-16 h-16 lg:w-9 lg:h-9 rounded-full bg-orange-400 text-white text-center text-4xl lg:text-xl flex items-center justify-center mr-4 pt-2">📍</p>
                                        </div>
                                        
                                        <div>
                                            <p class="text text-2xl lg:text-lg">Location</p>
                                            
                                                <p class="font-bold text-4xl lg:text-xl"><?=$user->userVille?></p>
                                            
                                        </div>
                                    </div>
                                    <div class="flex grid-cols-2 items-center mb-4">
                                        <div>
                                            <p class="w-16 h-16 lg:w-9 lg:h-9 rounded-full bg-indigo-300 text-white text-center text-4xl lg:text-xl flex items-center justify-center mr-4 pt-2">⏳</p>
                                        </div>
                                        
                                        <div>
                                            <p class="text text-2xl lg:text-lg">Mission duration</p>
                                                <?php
                                                if ($user->userJobTime == "Courte Durée"){ 
                                                    $user->userJobTime = "Short-term";
                                                }
                                                elseif ($user->userJobTime == "Longue Durée"){
                                                    $user->userJobTime = "Long-term";
                                                }
                                                elseif ($user->userJobTime == "Durée indéfinie"){
                                                    $user->userJobTime = "Indefinite duration";
                                                }                                            
                                                ?>
                                            <p class="font-bold text-4xl lg:text-xl"><?=$user->userJobTime?></p>
                                            
                                        </div>
                                    </div>
                                    <div class="absolute top-0 right-0 mt-4 mr-4 flex hover:text-gray-800">
                                        <button id="updateUserPreference" data-modal-toggle="updateUserPreference" class="text-3xl lg:text-base py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                    </div>
                            </div>
                            <div class="relative bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                                <h2 class="text-4xl lg:text-xl font-bold mb-4"> Useful links </h2> 
                                <div class="flex flex-col mt-2 mb-2 w-full">
                                    <?php
                                    // mail link

                                    if (isset($user->userEmail)){
                                    ?>
                                    <a href="mailto:<?=$user->userEmail?>" title="Envoyer un mail" class="flex-shrink-0 mr-2">
                                        <div class="flex grid-cols-2 items-center mb-4">
                                                <div>
                                                    <img src="<?=base_url('assets/img/logo-link/mail.png')?>" alt="Logo Mail" class="w-16 h-16 lg:w-9 lg:h-9 transition-transform transform hover:scale-110">
                                                </div>
                                                <div>
                                                    <p class="text-3xl lg:text-base ml-4"><?=$user->userEmail?></p>
                                                </div>
                                        </div>
                                    </a>
                                    <?php
                                    }?>
                                    <?php 
                                    // Links
                                    if (isset($user->userPortfolioLink) && !empty($user->userPortfolioLink)){
                                    ?>
                                    <a href="<?=$user->userPortfolioLink?>" title="Visiter le portfolio" class="flex-shrink-0 mr-2" target="_blank">
                                        <div class="flex grid-cols-2 items-center mb-4">
                                                <div>
                                                    <img src="<?=base_url('assets/img/logo-link/portfolio.png')?>" alt="Logo Portfolio" class="w-16 h-16 lg:w-9 lg:h-9 transition-transform transform hover:scale-110">
                                                </div>
                                                <div>
                                                    <p class="text-3xl lg:text-base ml-4">Portfolio</p>
                                                </div>
                                        </div>
                                    </a>
                                    <?php
                                    }
                                    if (isset($user->userLinkedinLink) && !empty($user->userLinkedinLink)){
                                    ?>
                                    <a href="<?=$user->userLinkedinLink?>" title="Visiter le linkedin" class="flex-shrink-0 mr-2" target="_blank">
                                        <div class="flex grid-cols-2 items-center mb-4">
                                                <div>
                                                    <img src="<?=base_url('assets/img/logo-link/linkedin.png')?>" alt="Logo Linkedin" class="w-16 h-16 lg:w-9 lg:h-9 transition-transform transform hover:scale-110">
                                                </div>
                                                <div>
                                                    <p class="text-3xl lg:text-base ml-4">Linkedin</p>
                                                </div>
                                        </div>
                                    </a>
                                    <?php
                                    }
                                    if (isset($user->userGithubLink) && !empty($user->userGithubLink)){
                                    ?>
                                    <a href="<?=$user->userGithubLink?>" title="Visiter le github" class="flex-shrink-0 mr-2" target="_blank">
                                        <div class="flex grid-cols-2 items-center mb-4">
                                                <div>
                                                    <img src="<?=base_url('assets/img/logo-link/github.png')?>" alt="Logo Github" class="w-16 h-16 lg:w-9 lg:h-9 transition-transform transform hover:scale-110">
                                                </div>
                                                <div>
                                                    <p class="text-3xl lg:text-base ml-4">Github</p>
                                                </div>
                                        </div>
                                    </a>
                                    <?php
                                    }
                                    if (isset($user->userDribbleLink) && !empty($user->userDribbleLink)){
                                    ?>
                                    <a href="<?=$user->userDribbleLink?>" title="Visiter le dribbble" class="flex-shrink-0 mr-2" target="_blank">
                                        <div class="flex grid-cols-2 items-center mb-4">
                                                <div>
                                                    <img src="<?=base_url('assets/img/logo-link/dribbble.png')?>" alt="Logo Dribbble" class="w-16 h-16 lg:w-9 lg:h-9 transition-transform transform hover:scale-110">
                                                </div>
                                                <div>
                                                    <p class="text-3xl lg:text-base ml-4">Dribbble</p>
                                                </div>
                                        </div>
                                    </a>
                                    <?php 
                                    }
                                    if (isset($user->userBehanceLink) && !empty($user->userBehanceLink)): ?>
                                        <a href="<?=$user->userBehanceLink?>" title="Visiter le Behance" class="flex-shrink-0 mr-2" target="_blank">
                                            <div class="flex grid-cols-2 items-center mb-4">
                                                <div>
                                                    <img src="<?=base_url('assets/img/logo-link/behance.png')?>" alt="Logo Behance" class="w-16 h-16 lg:w-9 lg:h-9 transition-transform transform hover:scale-110">
                                                </div>
                                                <div>
                                                    <p class="text-3xl lg:text-base ml-4">Behance</p>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="absolute top-0 right-0 mt-4 mr-4 flex hover:text-gray-800">
                                    <button id="updateUserLinks" data-modal-toggle="updateUserLinks" class="text-3xl lg:text-base py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                    </div>
                            </div>
                            <div class="relative bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white" id="rating">
                                <h2 class="text-4xl lg:text-xl font-bold mb-4"> Reviews </h2> 
                                    <div class="flex flex-col mt-2 mb-2 w-full">
                                    <div class="flex-1"></div>
                                    <?php
                                        if (is_array($raterUser) && !empty($raterUser)) {
                                            $ratingsCount = 0;
                                                foreach ($raterUser as $rating) {
                                                    if ($ratingsCount < 3) {
                                                    ?>
                                                    <a href="<?= base_url('user/companyView/'.$rating->idCompany) ?>" title="Voir le profil" class="flex-shrink-0 mr-2" target="_blank">
                                                        <div class="items-center mb-4 mt-4">
                                                            <div class="flex items-center">
                                                                <div class="w-10 h-10" style="font-size:1rem;">
                                                                    <img src="<?=base_url($rating->companyLogoPath)?>" class="w-10 h-10 rounded-full flex items-center justify-center" alt="User Photo">
                                                                </div>
                                                                <div class="ml-4">
                                                                    <p class="text text-3xl lg:text-base"><?= $rating->userFirstName.' '.$rating->userLastName?></p>
                                                                    <p class="text text-3xl lg:text-base mt-1  text-gray-400"><?= $rating->companyName?></p>
                                                                </div>
                                                            </div>
                                                            <div class="flex items-center mt-4 mb-4">
                                                                <div class="flex items-center">
                                                                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                                                                        <?php if ($i <= $rating->ratingStars) { ?>
                                                                            <img src="<?php echo base_url('assets/img/fill-star.svg'); ?>" class="w-4 h-4">
                                                                        <?php } else { ?>
                                                                            <img src="<?php echo base_url('assets/img/light-star.svg'); ?>" class="w-4 h-4">
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                </div>
                                                                <p class="text text-3xl lg:text-base text-gray-400 ml-4"><?=$rating->ratingDate = date('d/m/Y', strtotime($rating->ratingDate))?></p>

                                                            </div> 
                                                            <?php 
                                                            if (isset($rating->ratingComment) && ($rating->ratingComment != " ")): 
                                                            ?>
                                                                <div>
                                                                    <p class="text-3xl lg:text-base"><?= '"'.$rating->ratingComment.'"'?></p>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </a>
                                                    <?php
                                                    $ratingsCount++;
                                                    } else {
                                                    //break; // Arrêter la boucle si le nombre d'avis atteint 3
                                                    //echo $ratingsCount;
                                                    ?>
                                                    <div id="more-avis" class="hidden">
                                                        <a href="<?= base_url('user/companyView/'.$rating->idCompany) ?>" title="Voir le profil" class="flex-shrink-0 mr-2" target="_blank">
                                                            <div class="items-center mb-4 mt-4">
                                                                <div class="flex items-center">
                                                                    <div class="w-10 h-10" style="font-size:1rem;">
                                                                        <img src="<?=base_url($rating->companyLogoPath)?>" class="w-10 h-10 rounded-full flex items-center justify-center" alt="User Photo">
                                                                    </div>
                                                                    <div class="ml-4">
                                                                        <p class="text text-3xl lg:text-base"><?= $rating->userFirstName.' '.$rating->userLastName?></p>
                                                                        <p class="text text-3xl lg:text-base mt-1  text-gray-400"><?= $rating->companyName?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="flex items-center mt-4 mb-4">
                                                                    <div class="flex items-center">
                                                                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                                                                            <?php if ($i <= $rating->ratingStars) { ?>
                                                                                <img src="<?php echo base_url('assets/img/fill-star.svg'); ?>" class="w-4 h-4">
                                                                            <?php } else { ?>
                                                                                <img src="<?php echo base_url('assets/img/light-star.svg'); ?>" class="w-4 h-4">
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <p class="text text-3xl lg:text-base text-gray-400 ml-4"><?=$rating->ratingDate = date('d/m/Y', strtotime($rating->ratingDate))?></p>

                                                                </div>  
                                                                <?php 
                                                                if (isset($rating->ratingComment) && ($rating->ratingComment != " ")): 
                                                                ?>
                                                                    <div>
                                                                        <p class="text-3xl lg:text-base"><?= '"'.$rating->ratingComment.'"'?></p>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </a>
                                                    </div>
                                                        <button id="more-avis-button" class="text-primary text-3xl lg:text-base mt-2  px-4 py-1 rounded 2 hover:bg-primary-900 hover:text-white">
                                                            See more
                                                        </button>
                                                        <button id="less-avis-button" class="hidden text-primary text-3xl lg:text-base mt-2  px-4 py-1 rounded 2 hover:bg-primary-900 hover:text-white">
                                                            See less
                                                        </button>
                                                <?php 
                                                    }
                                                    
                                                }
                                            
                                            
                                        }
                                        else {
                                            ?>
                                                <p class="mt-2 mb-2 text-3xl lg:text-base"> No reviews for now. </p>
                                             <?php
                                        }
                                        ?>


                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:w-3/4 sticky top-0">
                        <div class="relative bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                            <h2 class="text-4xl lg:text-xl font-bold mb-4">About me</h2>
                            <p class="text-3xl lg:text-base text-gray-500 mb-4 mt-4 dark:text-white"><?= $user->userBio ?></p>
                            <div class="absolute top-0 right-0 mt-4 mr-4 flex hover:text-gray-800">
                                <button id="editUserBio" data-modal-toggle="editUserBio" class="text-3xl lg:text-base py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white ml-2" type="button">
                                    <i class="fas fa-pen fa-fw"></i>
                                </button>
                            </div>
                        </div>
                        <div class="relative bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                            <h2 class="text-4xl lg:text-xl font-bold mb-4 flex items-center cursor-pointer" id="skillsTitle">
                                Skills
                                <i class="fas fa-chevron-down ml-2" id="skillsArrow" style='font-size:0.75rem;' data-order="asc"></i>
                            </h2>

                            <div class="skills-container mb-4">
                                <?php
                                if (is_array($skills) && !empty($skills)) {
                                foreach ($skills as $skill) {
                                    $level = '';
                                    $color = '';
                                    switch ($skill->userSkillsExperience) {
                                        case 1:
                                            $level = 'Junior';
                                            $color = '#BEE3F8'; // Couleur pour le niveau junior
                                            $text = "text-black";
                                            $textdark = "text-black";
                                            break;
                                        case 2:
                                            $level = 'Intermediate';
                                            $color = '#63B3ED'; // Couleur pour le niveau intermédiaire
                                            $text = "text-black";
                                            $textdark = "text-white";
                                            break;
                                        case 3:
                                            $level = 'Expert';
                                            $color = '#2C5282'; // Couleur pour le niveau confirmé
                                            $text = "text-white";
                                            $textdark = "text-white";
                                            break;

                                        default:
                                            $level = 'N/A'; // Si la valeur de userSkillsExperience n'est pas valide, afficher "N/A"
                                            break;
                                    }
                                ?>
                                <div class="skill-item" data-level="<?=$level?>">
                                    <span class="text-3xl lg:text-base dark:<?=$textdark?> inline-block px-4 py-1 rounded-full <?=$text?>" style="background-color:<?=$color?>;"><?=$skill->skillName?></span>
                                    <div class="skill-level"><?=$level?></div>
                                </div>
                                
                                <?php
                                }
                                
                                ?>
                                 
                                
                                <?php
                                    } else {
                                ?>
                                <div class="absolute top-0 right-0  mt-4 mr-4 flex hover:text-gray-800">
                                    <button id="addUserSkills" data-modal-toggle="addUserSkills" class="text-3xl lg:text-base py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="display inline">
                                    <p class="mt-2 mb-2 text-3xl lg:text-base">No skills and expertise provided.</p>
                                    <button id="addUserSkills" data-modal-toggle="addUserSkills" class="text-3xl lg:text-base py-2 px-4 bg-primary text-white rounded-full">Add yous skills</button>
                                </div>
                                <?php } ?>
                                
                            </div> 
                            <div class="flex items-center">
                                <div class="absolute top-0 right-0 mt-4 mr-4 flex hover:text-gray-800">
                                    <?php 
                                    if(is_array($skills) && !empty($skills)){ 
                                    ?>
                                    <button id="editUserSkills" data-modal-toggle="editUserSkills" class="text-3xl lg:text-base py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white ml-2" type="button">
                                        <i class="fas fa-pen fa-fw"></i>
                                    </button>
                                    <?php 
                                    }
                                    ?>
                                    <button id="addUserSkills" data-modal-toggle="addUserSkills" class="text-3xl lg:text-base py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div> 
                            <div class="flex justify-end gap-4" id="legendeskills">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 mr-1 rounded-full" style="background-color: #BEE3F8;"></div>
                                    <span class="text-gray-600 mr-2 text-3xl lg:text-base dark:text-white">Junior</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 mr-1 rounded-full" style="background-color: #63B3ED;"></div>
                                    <span class="text-gray-600 mr-2 text-3xl lg:text-base dark:text-white">Intermediate </span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 mr-1 rounded-full" style="background-color: #2C5282;"></div>
                                    <span class="text-gray-600 mr-2 text-3xl lg:text-base dark:text-white">Expert</span>
                                </div>
                            </div>
                        </div>
                        <div class="relative bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                            <h2 class="text-4xl lg:text-xl font-bold mb-4">Experiences</h2>
                            <?php
                            if (is_array($experiences) && !empty($experiences)) {
                                $experienceCount = 0;
                                foreach ($experiences as $index => $experience) {
                                    if ($experienceCount < 3) {
                            ?>
                                        <div class="mb-4 mt-4">
                                            <div class="flex items-center mt-2 mb-2">
                                                <div class="mr-2 mt-2">
                                                    <p class="w-20 h-20 rounded-full bg-secondary text-white text-center flex items-center justify-center mr-4" style="font-size:2rem;">💼</p>
                                                </div>
                                                <div>
                                                    <h3 class="text-3xl lg:text-lg font-medium"><?= $experience->experienceJob?></h3>
                                                    <h3 class="text-3xl lg:text-lg font-medium"><?= $experience->experienceCompany?></h3>
                                                    <?php
                                                    setlocale(LC_TIME, 'fr_FR.utf8');
                                                    $dateDebut = strftime('%d %B %Y', strtotime($experience->experienceDateDebut));
                                                    $dateFin = strftime('%d %B %Y', strtotime($experience->experienceDateFin));
                                                    $months = array(
                                                        'January' => 'January',
                                                        'February' => 'February',
                                                        'March' => 'March',
                                                        'April' => 'April',
                                                        'May' => 'May',
                                                        'June' => 'June',
                                                        'July' => 'July',
                                                        'August' => 'August',
                                                        'September' => 'September',
                                                        'October' => 'October',
                                                        'November' => 'November',
                                                        'December' => 'December'
                                                    );

                                                    $dateDebut = strtr($dateDebut, $months);
                                                    if($experience->experienceDateFin == NULL || $experience->experienceDateFin == "0000-00-00") {
                                                        $dateFin = "Today";
                                                    }
                                                    else {
                                                        $dateFin = strtr($dateFin, $months);
                                                    }
                                                    ?>

                                                    <p class="text-3xl lg:text-base"><?= $dateDebut.' - '. $dateFin?></p>
                                                </div>
                                                
                                                <div class="ml-auto mr-4">
                                                    <button id="updateUserExperience<?=$index?>" data-modal-toggle="updateUserExperience<?=$index?>" class="text-3xl lg:text-base py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                                        <i class="fas fa-pen fa-fw"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="mb-6 mt-4 ml-2 mr-4">
                                                <p class="experience-description text-3xl lg:text-base text-gray-500dark:text-white"><?= $experience->experienceDescription ?> <span class="see-more hidden ml-1 cursor-pointer text-primary-500 hover:underline">see more</span></p>
                                            </div>
                                            <div class="skills-container mb-4">
                                            <?php
                                                $dataExperienceSkills = [];
                                                foreach ($experienceSkills[$experience->idExperience] as $skill):
                                                    $dataExperienceSkills[] = $skill->skillName;
                                                $dataExperienceSkillsString = implode(',', $dataExperienceSkills);
                                            
                                                    // Déterminer le niveau en fonction de la valeur de missionSkillsExperience
                                                    $level = '';
                                                    $color = '';
                                                    switch ($skill->experienceSkillsExpertise) {
                                                        case 1:
                                                            $level = 'Junior';
                                                            $color = '#BEE3F8'; // Couleur pour le niveau junior
                                                            $textdark = "text-black";
                                                            $text = "text-black";
                                                            
                                                            break;
                                                        case 2:
                                                            $level = 'Intermediate';
                                                            $color = '#63B3ED'; // Couleur pour le niveau intermédiaire
                                                            $textdark = "text-white";
                                                            $text = "text-black";
                                                            break;
                                                        case 3:
                                                            $level = 'Expert';
                                                            $color = '#2C5282'; // Couleur pour le niveau expert
                                                            $textdark = "text-white";
                                                            $text = "text-white";
                                                            break;
                                                        default:
                                                            $level = 'N/A'; // Si la valeur de missionSkillsExperience n'est pas valide, afficher "N/A"
                                                            break;
                                                    }
                                                ?>
                                                <div class="skill-item" data-level="<?=$level?>">
                                                    <span class="text-3xl lg:text-base dark:<?=$textdark?> inline-block px-4 py-1 rounded-full <?=$text?>" style="background-color:<?=$color?>;"><?=$skill->skillName?></span>
                                                    <div class="skill-level"><?=$level?></div>
                                                </div>
                                                    
                                            <?php endforeach; ?>
                                            </div>                                        
                                        </div>

                                        <?php
                                        if ($experienceCount < 2) {
                                        ?>
                                            <hr>
                                        <?php
                                        }
                                    ?>
                                <?php
                                        $experienceCount++;
                                    } else {
                                        break;
                                    }
                                }
                                if ($experienceCount < 3) {
                            ?>

                                <div class="absolute top-0 right-0 mt-4 mr-4 flex hover:text-gray-800">
                                    <button id="addUserExperience" data-modal-toggle="addUserExperience" class="text-3xl lg:text-base py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            <?php 
                                }
                            } else { ?>
                                <p class="mt-2 mb-2 text-3xl lg:text-base">No experience available.</p>
                                <button id="addUserExperience" data-modal-toggle="addUserExperience" class="text-3xl lg:text-base py-2 px-4 bg-primary text-white rounded-full">Add experience</button>
                                <div class="absolute top-0 right-0 mt-4 mr-4 flex hover:text-gray-800">
                                    <button id="addUserExperience" data-modal-toggle="addUserExperience" class="text-3xl lg:text-base py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            <?php } ?>
                        </div> 
                        <div class="relative bg-white rounded-lg mb-4 p-4 dark:bg-gray-800 dark:text-white">
                            <h2 class="text-4xl lg:text-xl font-bold mb-4">Portfolio & Achievements </h2>
                            <?php if (is_array($attachments) && !empty($attachments)) { ?>
                                <div class="grid grid-cols-4 gap-8">
                                    <?php foreach ($attachments as $index => $attachment) { ?>
                                        <div class="relative flex justify-center items-center border border-1 p-2 mr-4 mb-4 rounded-lg bg-white">
                                            <h3 class="text-3xl lg:text-base font-medium"><?= $attachment->attachmentName ?></h3>
                                            <div class="pdf-thumbnail overflow-hidden z-10 mb-2" style="max-height: 14rem" data-pdf="<?= base_url($attachment->attachmentPath) ?>">
                                                <div class="absolute top-0 right-0 mr-4 mt-4 flex space-x-4 z-20">
                                                <a href="<?= base_url($attachment->attachmentPath) ?>" download class="download-icon text-gray-400 hover:text-gray-900" onclick="event.stopPropagation();">
                                                    <i class="fas fa-download text-4xl lg:text-xl"></i>
                                                </a>
                                                <a href="#" class="delete-icon text-red-800 hover:text-red-900" onclick="event.stopPropagation(); showModal('deleteAttachmentConfirmationModal<?=$index?>');">
                                                    <i class="fas fa-trash text-4xl lg:text-xl"></i>
                                                </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="deleteAttachmentConfirmationModal<?=$index?>" class="hidden fixed flex inset-0 items-center justify-center z-50">
                                            <div class="fixed inset-0 bg-black opacity-50"></div>
                                            <div class="relative bg-gray-50 rounded-lg shadow p-6 border border-gray-800 dark:bg-gray-800 sm:p-5">
                                                <h3 class="text-3xl lg:text-lg font-semibold mb-4">Deletion Confirmation</h3>
                                                <p class="text-3xl lg:text-base text-gray-700 dark:text-white mb-6">Are you sure you want to delete this attachment?</p>
                                                <div class="flex justify-end">
                                                    <button type="button" onclick="hideModal('deleteAttachmentConfirmationModal<?=$index?>');" class="text-3xl lg:text-base text-gray-600 inline-flex items-center hover:text-white hover:bg-gray-800 border-gray-600  focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg px-5 py-2.5 text-center dark:border-gray-500 dark:text-gray-500  dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-900">Cancel</button>
                                                    <a href="<?=base_url("user/deleteUserAttachment/".$attachment->idAttachment)?>" class="text-3xl lg:text-base text-red-800 inline-flex items-center hover:text-white hover:bg-red-900 border-red-900  focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500  dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Delete</a>
                                                </div>
                                            </div>
                                        </div>

                                    <?php } ?>
                                </div>


                            <?php } else { ?>
                                <p class="text-3xl lg:text-base mt-2 mb-2">No attachment available.</p>
                            <?php } ?>
                            <div class="absolute top-0 right-0 mt-4 mr-4 flex hover:text-gray-800">
                                <button id="addUserAttachment" data-modal-toggle="addUserAttachment" class="text-3xl lg:text-base py-2.5 px-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>       
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/pdf.js'); ?>"></script>
<script src="<?php echo base_url('/node_modules/choices.js/public/assets/scripts/choices.min.js'); ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js@10.0.0"></script>
<script src="<?php echo base_url('/node_modules/intl-tel-input/build/js/intlTelInput.min.js'); ?>"></script>
<script src="<?php echo base_url('/node_modules/intl-tel-input/build/js/utils.js'); ?>"></script>
<script src="<?php echo base_url('/node_modules/intl-tel-input/build/js/intlTelInput.js'); ?>"></script>
<script>

	var base_url = '<?php echo base_url(); ?>'; // Assurez-vous que PHP est exécuté correctement ici

        var input = document.querySelector("#userTelephone");
        var iti = window.intlTelInput(input, {
            preferredCountries: ['us', 'fr', 'ae'],
            utilsScript: base_url + "node_modules/intl-tel-input/build/js/utils.js"
        });



        document.querySelector("#updateUserDataForm").addEventListener("submit", function(event) {
            
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

    $(document).ready(function() {

    
        $('#citySearch').on('keyup', function() {
            let term = $(this).val();
            if(term.length > 2) { // Recherche après 2 caractères
                $.post('search_cities', { term: term }, function(data) {
                    let cities = JSON.parse(data);
                    if(cities.length > 0) {
                        // Ajoutez la classe .has-border si des résultats sont retournés
                        $('#cities-list').addClass('has-border');
                    } else {
                        // Supprimez la classe .has-border si aucun résultat n'est retourné
                        $('#cities-list').removeClass('has-border');
                    }
                    $('#cities-list').empty();
                    cities.forEach(function(city) {
                        $('#cities-list').append(`<div class="city-item p-2 hover:bg-gray-200 cursor-pointer" data-id="${city.geoname_id}">${city.name}</div>`);
                    });
                });
            }
            else {
                // Supprimez la classe .has-border si l'input est trop court
                $('#cities-list').removeClass('has-border').empty();
            }
        });

        $(document).on('click', '.city-item', function() {
            let cityName = $(this).text();
            $('#citySearch').val(cityName);  // Mettez à jour le champ de saisie avec le nom de la ville sélectionnée
            $('#cities-list').empty(); // Videz la liste
            $('#cities-list').removeClass('has-border').empty();
        });

        // Pour fermer la liste lorsque vous cliquez en dehors
        $(document).on('click', function(event) {
            // et n'est pas sur un élément à l'intérieur de la liste (#cities-list)...
            if (!$(event.target).closest('#citySearch, #cities-list').length) {
                // ... alors videz et fermez la liste.
                $('#cities-list').empty().removeClass('has-border');
            }
        });

        $('#userEtranger').change(function() {
            if ($(this).is(':checked')) {
                $('#citySearch').val('');
            }
        });
        
        $('#citySearch').on('input', function() {
            $('#userEtranger').prop('checked', false);
        });

        const jobsChoices = new Choices('#jobsAll', {
            searchEnabled: true,
            removeItemButton: true,
            itemSelectText: '',
            placeholder: true, // Ajoutez cette ligne pour activer le placeholder
            placeholderValue: 'Sélectionnez votre métier', // Texte du placeholder

        });

            /*const expertiseChoices = new Choices('#expertiseAll', {
            searchEnabled: true,
            removeItemButton: true,
            itemSelectText: '',
            placeholder: true, // Ajoutez cette ligne pour activer le placeholder
            placeholderValue: 'Sélectionnez votre expertise', // Texte du placeholder
*/

    });
    
    $(document).ready(function(){
        $('#search-input-job').on('keyup', function(){
            let term = $(this).val();
            $.post('user/search_jobs', { term: term }, function(data){
                let jobs = JSON.parse(data);
                $('#jobs-list').empty();
                jobs.forEach(function(job){
                    $('#jobs-list').append(`<div class="text-3xl lg:text-base job-item" data-id="${job.jobId}">${job.jobName}</div>`);
                });
            });
        })


        $(document).on('click', '.job-item', function(){
            let jobId = $(this).data('id');
            let jobName = $(this).text();
            // Vérifiez si la compétence est déjà sélectionnée
            if (!$(`#selected-jobs .selected-job[data-id="${jobId}"]`).length) {
                $('#selected-jobs').append(`<div class="text-3xl lg:text-base selected-job" data-id="${jobId}">${jobName}</div>`);
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const arrow = document.getElementById('skillsArrow');
        const skillsContainer = document.querySelector('.skills-container');
        const skillItems = [...skillsContainer.querySelectorAll('.skill-item')];
        let sortOrder = 'asc';

        arrow.addEventListener('click', function() {
            sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
            updateSkillsOrder(skillItems, sortOrder);
        });

        function updateSkillsOrder(items, order) {
            const sortedItems = items.slice().sort(function(a, b) {
                const aLevel = a.getAttribute('data-level');
                const bLevel = b.getAttribute('data-level');
                return order === 'asc' ? aLevel.localeCompare(bLevel) : bLevel.localeCompare(aLevel);
            });

            skillsContainer.innerHTML = ''; // Clear container

            sortedItems.forEach(function(item) {
                skillsContainer.appendChild(item);
            });
        }

        const moreAvis = document.getElementById("more-avis");
        const moreAvisButton = document.getElementById("more-avis-button");
        const lessAvisButton = document.getElementById("less-avis-button");

        // Ajout d'un gestionnaire d'événement pour le bouton "Voir plus"
        moreAvisButton.addEventListener("click", function() {
            moreAvis.classList.remove("hidden"); // Afficher le contenu
            lessAvisButton.classList.remove("hidden"); // Afficher le bouton "Voir moins"
            moreAvisButton.classList.add("hidden"); // Masquer le bouton "Voir plus"
        });

        // Ajout d'un gestionnaire d'événement pour le bouton "Voir moins"
        lessAvisButton.addEventListener("click", function() {
            moreAvis.classList.add("hidden"); // Masquer le contenu
            lessAvisButton.classList.add("hidden"); // Masquer le bouton "Voir moins"
            moreAvisButton.classList.remove("hidden"); // Afficher le bouton "Voir plus"
        });
        
    });

    /* Zaafira 17/01/2024 : Correction fonctions onclick add-skill-btn et add-experience-skill-btn */
    $(document).ready(function() {
        $('#add-skill-btn').on('click', function() {
            const newSkillRow = `
                <div class="flex flex-1 mb-4 skill-row">
                    <div class="w-3/4 mr-2">
                        <select class="p-2 border rounded-lg w-full new-skill-select" name="skillsAll[]" id="skillsAll" required>
                            <option value="">Sélectionnez une compétence</option>
                            <?php foreach ($skillsAll as $skill): ?>
                                <option value="<?= $skill['skillId'] ?>"><?= $skill['skillName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="w-1/4">
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="skillsLevel[]" required>
                            <option value="1">Junior</option>
                            <option value="2">Intermédiaire</option>
                            <option value="3">Expert</option>
                        </select>
                    </div>
                    <button type="button" class="text-red-600 hover:text-red-900 focus:outline-none ml-4 delete-skill-row">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;
            $('#skills-container').append(newSkillRow);
            // Désinitialiser les instances Choices existantes
            $('.new-skill-select').each(function() {
                const choicesInstance = this.choices;
                if (choicesInstance) {
                    choicesInstance.destroy();
                }
            });
            // Réinitialiser les instances Choices
            $('.new-skill-select').each(function() {
                new Choices(this, {
                    /* options spécifiques à Choices */
                });
            });
        });

        
        // Utilisez une classe pour cibler les boutons "Ajouter une compétence"
        $('.add-experience-skill-btn').on('click', function() {
            const container = $(this).data('container'); // Récupérer le conteneur correspondant à ce bouton

            const newSkillRow2 = `
                <div class="flex flex-1 mb-4 skill-row">
                    <div class="w-3/4 mr-2 text-black">
                        <select name="skillsAll[]" class="new-skill-select mt-1 block w-full py-2 px-3 border border-gray-300 bg-white text-black rounded-full shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="">Sélectionnez une compétence</option>
                            <?php foreach ($skillsAll as $skill): ?>
                                <option value="<?= $skill['skillId'] ?>"><?= $skill['skillName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="w-1/4">
                        <select name="skillsLevel[]" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option value="1">Junior</option>
                            <option value="2">Intermédiaire</option>
                            <option value="3">Expert</option>
                        </select>
                    </div>
                    <button type="button" class="text-red-600 hover:text-red-900 focus:outline-none ml-4 delete-skill-row">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;
            $('#' + container).append(newSkillRow2);

            // Désinitialiser les instances Choices existantes
            $('.new-skill-select').each(function() {
                const choicesInstance2 = this.choices;
                if (choicesInstance2) {
                    choicesInstance2.destroy();
                }
            });
            // Réinitialiser les instances Choices
            $('.new-skill-select').each(function() {
                new Choices(this, {
                    /* options spécifiques à Choices */
                });
            });
        });
        
        $(document).on('click', '.delete-skill-row', function() {
            // Supprimez le parent .skill-row
            $(this).closest('.skill-row').remove();
        });
    });

    $(document).ready(function() {
        const skillsChoices = new Choices('#skillsAll', {
            searchEnabled: true,
            removeItemButton: true,
            itemSelectText: '',
            placeholder: true,
            placeholderValue: 'Select Skills',
        });

        const skillsChoices2 = new Choices('#skillsAll2', {
            searchEnabled: true,
            removeItemButton: true,
            itemSelectText: '',
            placeholder: true,
            placeholderValue: 'Select Skills',
        });

        $('#search-input-skill').on('keyup', function(){
            let term = $(this).val();
            if (term.length > 2) {
                $.post('user/search_skills', { term: term }, function(data){
                    let skills = JSON.parse(data);
                    $('#skills-list').empty();
                    skills.forEach(function(skill){
                        $('#skills-list').append(`<div class="skill-item p-2 hover:bg-gray-200 cursor-pointer" data-id="${skill.skillId}">${skill.skillName}</div>`);
                    });
                });
            } else {
                $('#skills-list').empty();
            }
        });

        $(document).on('click', '.skill-item', function(){
            let skillId = $(this).data('id');
            let skillName = $(this).text();
            if (!$(`#selected-skills .selected-skill[data-id="${skillId}"]`).length) {
                $('#selected-skills').append(`<div class="selected-skill" data-id="${skillId}">${skillName}</div>`);
            }
            $('#skills-list').empty(); // Vider la liste après sélection
        });

        // Pour fermer la liste lorsque vous cliquez en dehors
        $(document).on('click', function(event) {
            if (!$(event.target).closest('#search-input-skill, #skills-list').length) {
                $('#skills-list').empty();
            }
        });

    });


    document.addEventListener("DOMContentLoaded", function(event) {
        document.getElementById('updateUserData').click();
    });

    // Zaafira 18/01/2024 : correction fonction showfile
    function showFileName(input) {
        const MAX_SIZE = 2048; // Taille maximale en Ko
        const avatarImageElement = document.getElementById("avatar-image");
        const avatarErrorMessage = document.getElementById("avatarErrorMessage");
        if (input.files && input.files[0]) {
            const fileSize = input.files[0].size / 1024; // Taille en Ko
            if (fileSize > MAX_SIZE) {
                // Afficher un message d'erreur
                avatarErrorMessage.classList.remove("hidden");
                return; // Arrêter l'exécution si le fichier est trop grand
            }

            var reader = new FileReader();
            reader.onload = function(e) {
                avatarImageElement.src = e.target.result;
                avatarErrorMessage.classList.add("hidden");

            };
            reader.readAsDataURL(input.files[0]);
        }
    }

document.addEventListener('DOMContentLoaded', function() {
    var errorMessageJobType = document.getElementById('errorMessageJobType');
    var form = document.getElementById('userPreferenceForm');
    form.addEventListener('submit', function(event) {
        // Vérifier si au moins un type de poste est sélectionné
        var userJobType = form.elements['userJobType[]'];
        var hasSelectedJobType = false;
        for (var i = 0; i < userJobType.length; i++) {
            if (userJobType[i].checked) {
                hasSelectedJobType = true;
                break;
            }
        }
        if (!hasSelectedJobType) {
            event.preventDefault();
            errorMessageJobType.style.display = 'block';
        }
    });
});
    function showModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('hidden');
    }

    function hideModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.add('hidden');
    }
</script>

<!-- Inclure PDF.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
<!-- Inclure le PDF.js Worker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js"></script>

<script>
    // Fonction pour charger la miniature PDF dans un conteneur donné
    function loadPdfThumbnail(pdfUrl, container) {
        // Charger le PDF en utilisant PDF.js
        pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
            // Obtenir la première page du PDF
            pdf.getPage(1).then(function(page) {
                var viewport = page.getViewport({ scale: 0.25 }); // Échelle de 0.25 pour la miniature
                var canvas = document.createElement('canvas');
                var context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Dessiner la miniature sur le canvas
                page.render({ canvasContext: context, viewport: viewport }).promise.then(function() {
                    // Convertir le canvas en base64 pour l'afficher comme une image
                    var thumbnailUrl = canvas.toDataURL();
                    var img = new Image();
                    img.src = thumbnailUrl;
                    img.classList.add('file-thumbnail-img');

                    // Ajouter l'image miniature dans le conteneur spécifié
                    container.appendChild(img);

                    // Gérer le clic sur la miniature pour afficher le PDF complet
                    container.addEventListener('click', function() {
                        // Charger le PDF complet
                        pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
                            var numPages = pdf.numPages;
                            var fullPdfContainer = document.createElement('div');
                            fullPdfContainer.classList.add('full-pdf-container');

                            // Afficher chaque page du PDF complet dans le conteneur
                            for (var pageNum = 1; pageNum <= numPages; pageNum++) {
                                pdf.getPage(pageNum).then(function(page) {
                                    var fullViewport = page.getViewport({ scale: 1 });
                                    var fullCanvas = document.createElement('canvas');
                                    var fullContext = fullCanvas.getContext('2d');
                                    fullCanvas.height = fullViewport.height;
                                    fullCanvas.width = fullViewport.width;

                                    // Dessiner la page du PDF sur le canvas
                                    page.render({ canvasContext: fullContext, viewport: fullViewport }).promise.then(function() {
                                        fullPdfContainer.appendChild(fullCanvas);
                                    });
                                });
                            }

                            // Afficher le PDF complet dans une boîte de dialogue
                            
                            fullPdfContainer.style.display = 'block';
                            document.body.appendChild(fullPdfContainer);

                            // Gérer le clic en dehors de la boîte de dialogue pour la fermer
                            fullPdfContainer.addEventListener('click', function(event) {
                                if (event.target === fullPdfContainer) {
                                    fullPdfContainer.style.display = 'none';
                                }
                            });
                        });
                    });
                });
            });
        });
    }

    function loadFileThumbnail(fileUrl, container) {
        var fileExtension = fileUrl.split('.').pop().toLowerCase();

        if (fileExtension === 'pdf') {
            // Afficher la miniature PDF
            loadPdfThumbnail(fileUrl, container);
        } else {
            // Gérer d'autres types de fichiers ici
            // Par exemple, afficher une icône générique pour les types de fichiers inconnus
            displayGenericThumbnail(container);
        }
    }

    function displayGenericThumbnail(container) {
        // Afficher une icône générique ou un message pour les types de fichiers inconnus
        var genericThumbnail = document.createElement('div');
        genericThumbnail.textContent = 'Fichier non pris en charge';
        container.appendChild(genericThumbnail);
    }

    // Chargement des miniatures pour chaque conteneur avec la classe .file-thumbnail
    var thumbnailContainers = document.querySelectorAll('.pdf-thumbnail');
    thumbnailContainers.forEach(function (container) {
        var fileUrl = container.getAttribute('data-pdf');
        loadFileThumbnail(fileUrl, container);
    });


    const fileInput = document.getElementById('userAttachmentFile');
    const filenameSpan = document.querySelector('.filename');

    fileInput.addEventListener('change', function() {
        if (fileInput.files.length > 0) {
            filenameSpan.textContent = fileInput.files[0].name;
        } else {
            filenameSpan.textContent = 'select a file';
        }
    });
    
    $('#addUserExperienceDateDebut, #addUserExperienceDateFin').on('change keyup', function() {
        var startDate = new Date($('#addUserExperienceDateDebut').val());
        var endDate = new Date($('#addUserExperienceDateFin').val());
        var errorMessage = $('#errorAddUserExperienceDate');

        if (startDate && endDate && startDate > endDate) {
            errorMessage.show();
        } else {
            errorMessage.hide();
        }
    });

    $('#addUserExperience-form').on('submit', function(event) {
        var startDate = new Date($('#addUserExperienceDateDebut').val());
        var endDate = new Date($('#addUserExperienceDateFin').val());
        var endDateValue = $('#addUserExperienceDateFin').val();
        var todayCheckbox = $('#addUserExperienceDateFinToday').prop('checked');

        if (startDate && endDate && startDate > endDate) {
            $('#errorAddUserExperienceDate').show();
            event.preventDefault(); // Empêcher la soumission du formulaire
        }
        else if (!todayCheckbox && endDateValue == ""){
            event.preventDefault(); // Empêcher la soumission du formulaire
        }
    });

    $('#addUserExperienceDateFinToday').change(function() {
        if ($(this).is(':checked')) {
            $('#addUserExperienceDateFin').val('');
            $('#errorAddUserExperienceDate').hide();
        }
    });
    
    $('#addUserExperienceDateFin').on('input', function() {
        $('#addUserExperienceDateFinToday').prop('checked', false);
    });

    function validateDates(updateUserExperienceDateDebut, updateUserExperienceDateFin, errorUpdateUserExperienceDate, experienceFormButton) {
        var startDate = new Date(document.getElementById(updateUserExperienceDateDebut).value);
        var endDate = new Date(document.getElementById(updateUserExperienceDateFin).value);
        var errorMessage = document.getElementById(errorUpdateUserExperienceDate);

        if (startDate && endDate && startDate > endDate) {
            errorMessage.style.display = 'block';
            document.getElementById(experienceFormButton).disabled = true;
        } else {
            errorMessage.style.display = 'none';
            document.getElementById(experienceFormButton).disabled = false;
        }
    }

    function resetCheckbox(updateUserExperienceDateFinToday) {
        var todayCheckbox = document.getElementById(updateUserExperienceDateFinToday);

        todayCheckbox.checked = false;

    }

    function resetDateFin(updateUserExperienceDateFin, updateUserExperienceDateFinToday, errorUpdateUserExperienceDate, experienceFormButton) {
        var endDate = document.getElementById(updateUserExperienceDateFin);
        var todayCheckbox = document.getElementById(updateUserExperienceDateFinToday);
        var errorMessage = document.getElementById(errorUpdateUserExperienceDate);

        if(todayCheckbox.checked) {
            endDate.value='';
            errorMessage.style.display = 'none';
            document.getElementById(experienceFormButton).disabled = false;
        }
    }


    $(document).ready(function(){ 
        $(document).on('change', 'input[name="finIndisponibiliteDuree"]', function() {
            const selectedDuration = $(this).val();
            const dateInput = document.getElementById('dateFinIndisponibilitePreference');

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

        $('#userPreferenceForm').on('submit', function(event) {
            var dateInput = document.getElementById('dateFinIndisponibilitePreference');
            var checkBox = document.getElementById('hs-basic-with-description-preference');

            if (!checkBox.checked && dateInput.value == '') {
                $('#errorDateFinIndisponibilitePreference').show();
                event.preventDefault(); // Empêcher la soumission du formulaire
            }
        });

    });

    function displayAvailibilityOptionsPreference() {
        var checkBox = document.getElementById('hs-basic-with-description-preference');
        var isAvailableDiv = document.getElementById('isAvailaibleOptionsPreference');
        var isNotAvailableDiv = document.getElementById('isNotAvailaibleOptionsPreference');
        var radioButtons = document.getElementsByClassName('finIndisponibiliteBtnPreference');
        var dateInput = document.getElementById('dateFinIndisponibilitePreference');
        var errorMessage = document.getElementById('errorDateFinIndisponibilitePreference');

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

    function checkPortfolioLink() {
        let portfolioLink = document.getElementById('userPortfolioLink');
        let portfolioLinkValue = portfolioLink.value;
        if (portfolioLinkValue !== '') {
            if (!portfolioLinkValue.startsWith('https://') && !portfolioLinkValue.startsWith('http://')) {
                portfolioLink.value = 'https://' + portfolioLinkValue;
            }
        }
    }

    function checkLinkedinLink() {
        let linkedinLink = document.getElementById('userLinkedinLink');
        let linkedinLinkValue = linkedinLink.value;
        if (linkedinLinkValue !== '') {
            if (!linkedinLinkValue.startsWith('https://') && !linkedinLinkValue.startsWith('http://')) {
                linkedinLink.value = 'https://' + linkedinLinkValue;
            }
        }
    }

    function checkGithubLink() {
        let githubLink = document.getElementById('userGithubLink');
        let githubLinkValue = githubLink.value;
        if (githubLinkValue !== '') {
            if (!githubLinkValue.startsWith('https://') && !githubLinkValue.startsWith('http://')) {
                githubLink.value = 'https://' + githubLinkValue;
            }
        }
    }

    function checkDribbbleLink() {
        let dribbbleLink = document.getElementById('userDribbbleLink');
        let dribbbleLinkValue = dribbbleLink.value;
        if (dribbbleLinkValue !== '') {
            if (!dribbbleLinkValue.startsWith('https://') && !dribbbleLinkValue.startsWith('http://')) {
                dribbbleLink.value = 'https://' + dribbbleLinkValue;
            }
        }
    }

    function checkBehanceLink() {
        let behanceLink = document.getElementById('userBehanceLink');
        let behanceLinkValue = behanceLink.value;
        if (behanceLinkValue !== '') {
            if (!behanceLinkValue.startsWith('https://') && !behanceLinkValue.startsWith('http://')) {
                behanceLink.value = 'https://' + behanceLinkValue;
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        var descriptions = document.querySelectorAll('.experience-description');
        
        descriptions.forEach(function(descriptionElement) {
            // Trouvez le bouton "voir plus" à l'intérieur de l'élément de description courant
            var seeMoreElement = descriptionElement.querySelector('.see-more');
            
            // Texte complet avant modification
            var fullText = descriptionElement.innerText;
            
            if (fullText.length > 200) {
                // Texte tronqué à afficher initialement
                var shortText = fullText.substring(0, 200) + "...";
                // Mettre à jour le texte de l'élément de description avec le texte tronqué
                descriptionElement.firstChild.nodeValue = shortText;
                
                // Afficher le bouton "voir plus"
                seeMoreElement.style.display = 'inline';

                seeMoreElement.addEventListener('click', function () {
                    // Vérifiez si le texte affiché est le texte tronqué ou le texte complet
                    if (descriptionElement.firstChild.nodeValue === shortText) {
                        descriptionElement.firstChild.nodeValue = fullText;
                        seeMoreElement.innerText = 'voir moins';
                    } else {
                        descriptionElement.firstChild.nodeValue = shortText;
                        seeMoreElement.innerText = 'voir plus';
                    }
                });
            } else {
                // Si le texte est moins de 200 caractères, cachez le bouton "voir plus"
                seeMoreElement.style.display = 'none';
            }
        });
    });


</script>