<!DOCTYPE html>
<html>
<head>
  <title>Exemple de section fixe</title>
  <!-- Incluez les balises CSS et autres balises meta si nécessaire -->
  <style>
    .sticky-container {
      display: flex;
      height: calc(100vh - 50px); /* Réglez la hauteur du conteneur selon vos besoins */
    }
    .sticky-column {
      position: sticky;
      top: 0;
    }
  </style>
</head>
<body>
  <?php include(APPPATH . 'views/layouts/user/header.php'); ?>

  <div class="px-4 lg:px-6 py-6 h-full">
    <div class="sticky-container">
      <div class="sticky-column w-1/4">
        <div class="bg-white rounded-lg h-full p-4">
          <p>Contenu de la première colonne</p>
        </div>
      </div>
  
      <div class="w-1/2 overflow-y-auto">
        <div class="bg-primary rounded-lg h-20vh p-4 text-white">
          <p class="font-bold">Découvrez la manière la plus rapide et efficace de décrocher une mission.</p>
          <p class="font-normal mt-2">Lorem ipsum dolor sit amet consectetur. Feugiat quis tristique vitae viverra faucibus in lectus adipiscing sed.</p>
        </div>
      
        <div class="bg-white rounded-lg h-20vh mt-4 p-4">
          <p>Test sticky</p>
        </div>
        <div class="bg-white rounded-lg h-20vh mt-4 p-4">
          <p>Test sticky</p>
        </div>
        <div class="bg-white rounded-lg h-20vh mt-4 p-4">
          <p>Test sticky</p>
        </div>
        <div class="bg-white rounded-lg h-20vh mt-4 p-4">
          <p>Test sticky</p>
        </div><div class="bg-white rounded-lg h-20vh mt-4 p-4">
          <p>Test sticky</p>
        </div>
        <div class="bg-white rounded-lg h-20vh mt-4 p-4">
          <p>Test sticky</p>
        </div><div class="bg-white rounded-lg h-20vh mt-4 p-4">
          <p>Test sticky</p>
        </div>
        <div class="bg-white rounded-lg h-20vh mt-4 p-4">
          <p>Test sticky</p>
        </div><div class="bg-white rounded-lg h-20vh mt-4 p-4">
          <p>Test sticky</p>
        </div>
        <div class="bg-white rounded-lg h-20vh mt-4 p-4">
          <p>Test sticky</p>
        </div><div class="bg-white rounded-lg h-20vh mt-4 p-4">
          <p>Test sticky</p>
        </div>
        <div class="bg-white rounded-lg h-20vh mt-4 p-4">
          <p>Test sticky</p>
        </div><div class="bg-white rounded-lg h-20vh mt-4 p-4">
          <p>Test sticky</p>
        </div>
        <div class="bg-white rounded-lg h-20vh mt-4 p-4">
          <p>Test sticky</p>
        </div>
        <!-- Ajoutez plus de contenu pour la colonne du milieu ici -->
      </div>

      <div class="sticky-column w-1/4">
        <div class="bg-white rounded-lg h-full p-4">
          <div class="flex flex-col items-center mb-4">
            <div class="w-20 h-20 rounded-full border-10 ring-2 ring-primary overflow-hidden">
              <img src="<?php echo base_url('assets/avatar/img.png');?>" alt="Avatar" class="w-20 h-20 p-0.5 rounded-full ring-2 ring-primary">
            </div>
            <h3 class="text-lg font-medium mt-2"><?=$user->userFirstName .' '. $user->userLastName?></h3>
            <div class="flex items-center mt-1">
              <p class="text-gray-500 font-light"><?=$user->userJob?></p>
              <span class="mr-4 text-gray-500"></span>
              <p class="text-gray-500 font-light"><?=$user->userTJM . ' €'?></p>
            </div>
            <a href="#" class="text-blue-500 mt-2">Modifier mon profil</a>
          </div>
        </div>
    
        <div class="bg-white rounded-lg h-20vh mt-4 p-4">
          <p>Contenu de la dernière colonne 1</p>
        </div>
        <!-- Ajoutez plus de contenu pour la dernière colonne ici -->
      </div>
    </div>
  </div>

  <script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
</body>
</html>
