// src/app.js
window.addEventListener('load', function() {
    // Cacher le loader une fois le chargement de la page terminé
    document.getElementById('loaderOverlay').style.display = 'none';
});

document.getElementById('heart').addEventListener('click', function() {
    if (this.getAttribute('fill') === 'none') {
        this.setAttribute('fill', 'currentColor');
    } else {
        this.setAttribute('fill', 'none');
    }
});


// Dark mode

var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
var themeToggleBtn = document.getElementById('theme-toggle');
var body = document.body;
var logoImg = document.getElementById('logo');

// Fonction pour mettre à jour le thème du corps
function updateBodyTheme() {
  if (localStorage.getItem('color-theme') === 'dark' || (!localStorage.getItem('color-theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    body.classList.add('dark');
    themeToggleDarkIcon.classList.remove('hidden');
    themeToggleLightIcon.classList.add('hidden');
  } else {
    body.classList.remove('dark');
    themeToggleDarkIcon.classList.add('hidden');
    themeToggleLightIcon.classList.remove('hidden');
  }
}

// Fonction pour changer le logo en fonction du thème
function updateLogoTheme() {
  if (localStorage.getItem('color-theme') === 'dark' || (!localStorage.getItem('color-theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    // Chemin vers le logo sombre
    logoImg.src = 'assets/img/logo-light.svg';
  } else {
    // Chemin vers le logo clair
    logoImg.src = 'assets/img/logo.svg';
  }
}

// Appeler les fonctions au chargement de la page
window.addEventListener('DOMContentLoaded', function() {
  updateBodyTheme();
  updateLogoTheme();
});

// Écouter le clic sur le bouton de basculement du thème
themeToggleBtn.addEventListener('click', function() {
  // Toggle icons inside button
  themeToggleDarkIcon.classList.toggle('hidden');
  themeToggleLightIcon.classList.toggle('hidden');

  // Toggle dark mode
  if (localStorage.getItem('color-theme')) {
    if (localStorage.getItem('color-theme') === 'light') {
      body.classList.add('dark');
      localStorage.setItem('color-theme', 'dark');
    } else {
      body.classList.remove('dark');
      localStorage.setItem('color-theme', 'light');
    }
  } else {
    if (body.classList.contains('dark')) {
      body.classList.remove('dark');
      localStorage.setItem('color-theme', 'light');
    } else {
      body.classList.add('dark');
      localStorage.setItem('color-theme', 'dark');
    }
  }

  // Mettre à jour le logo en fonction du thème
  updateLogoTheme();
});

// Écouter les changements de préférence du système de couleur
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
  updateBodyTheme();
  updateLogoTheme();
});
