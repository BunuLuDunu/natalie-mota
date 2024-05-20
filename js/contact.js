// Toggle de la modale de contact pour les photos

// On récupère le bouton de contact
const modalBtn = document.querySelector('.contact-btn');

// On récupère le champ ref du formulaire
const refField = document.getElementById('ref');
// On récupère la reférence de la photo
const refPhoto = modalBtn.dataset.reference;

modalBtn.addEventListener('click', () => {
    contactModal.showModal();
    refField.value = refPhoto;
});

