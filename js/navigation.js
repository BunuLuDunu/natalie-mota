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

// Toggle de la modale de contact
const contactBtn = document.getElementById('menu-item-52');

const contactModale = document.querySelector('.contact-modale');

const contactModaleWrap = document.querySelector('.contact-modale-wrapper');

contactBtn.addEventListener('click', () => {
    contactModale.showModal()
})

document.addEventListener('click', (event) => {
    console.log(event.target)
    if(!contactModaleWrap.contains(event.target) && !contactBtn.contains(event.target)) {
        contactModale.close();
    };
})