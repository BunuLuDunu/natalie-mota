// Toggle de la lightbox pour chaque photo card

// Récupération de la lightbox 
const lightbox = document.getElementById('lightbox-modal');

// Récupération de l'image dans la lightbox
const lightboxImg = lightbox.querySelector('img');

// Récupération de la zone réference dans la lightbox
const lightboxRef = lightbox.querySelector('.ref');

// Récupération de la zone catégorie dans la lightbox
const lightboxCat = lightbox.querySelector('.categorie');

let selectedCard;

const updateModalInfo = () => {
    if(!selectedCard) return

    // On remplace la source de l'image par celle de la card
    lightboxImg.src = selectedCard.querySelector('img').src;
    // On ajoute la référence de la photo
    lightboxRef.innerHTML = selectedCard.querySelector('.reference-photo').innerHTML;
    // On ajoute la catégorie de la photo
    lightboxCat.innerHTML = selectedCard.querySelector('.categorie-photo').innerHTML;
}

// Ecouteur d'évènement sur tous les boutons expand
document.addEventListener('click', e => {
    if(!e.target.closest('.expand-btn')) return;

    selectedCard = e.target.closest('.photo-card-container')

    // On ouvre la modale
    lightbox.showModal();

    updateModalInfo();
})

// Fermer la modale en cliquant en dehors
document.addEventListener('click', (event) => {
    if(lightbox.contains(event.target) && !event.target.closest('.lightbox-card, .lightbox-nav')) {
        lightbox.close();
    }
})

// Navigation dans la lightbox

// Récupération du bouton précédent
const prevBtn = lightbox.querySelector('.lightbox-nav.prev');

// Récupération du bouton suivant
const nextBtn = lightbox.querySelector('.lightbox-nav.next');

prevBtn.addEventListener('click', () => {
    if(!selectedCard.previousElementSibling) return

    selectedCard = selectedCard.previousElementSibling;

    updateModalInfo();
})

nextBtn.addEventListener('click', () => {
    if(!selectedCard.nextElementSibling) return

    selectedCard = selectedCard.nextElementSibling;

    updateModalInfo();
})