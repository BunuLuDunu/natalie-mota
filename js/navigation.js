// Toggle du menu au clic sur l'icon burger/la croix
const siteNavigation = document.getElementById('site-navigation');

const navButton = document.querySelector('.nav-toggle');

navButton.addEventListener('click', () => {
    siteNavigation.classList.toggle('toggled');
});

// Fermeture du menu au clic sur un lien de navigation
const navLinks = document.querySelectorAll('.site-menu a');

navLinks.forEach(link => {
    link.addEventListener('click', () => {
        siteNavigation.classList.remove("toggled");
    })
});

