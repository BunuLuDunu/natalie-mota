// Script pour le bouton charger plus de la page d'accueil

// Récupération du formulaire
const filtersForm = document.querySelector(".photo-list-filters");

// Récupération du bouton
const loadMoreBtn = document.querySelector(".load-more-btn");

// Récupération du container de la liste des photos
const filtersContainer = document.querySelector(".photo-list-container");

filtersForm.addEventListener('change', () => {
    filtersForm.requestSubmit();
})

// Au clic sur le bouton, on fait une requête Ajax
filtersForm.addEventListener('submit', async (e) => {
    // preventDefault pour ne pas recharger la page
    e.preventDefault();

    const isLoadMore = e.submitter !== null;

    const data = new FormData(filtersForm)

    if(isLoadMore) {
        data.append('page', filtersForm.dataset.page)
    }

    const request = await fetch(filtersForm.getAttribute('action'), {
        method: "POST",
        body: data
    })
    const response = await request.json();

    if (response.success) {

        if (isLoadMore) {
            // Si la réponse est un succès lorsqu'on appuie sur le bouton charger plus, on ajoute le HTML à la div container
            filtersContainer.insertAdjacentHTML('beforeend', response.data.html);
        } else {
            // Sinon on remplace le HTML par la réponse
            filtersContainer.innerHTML = response.data.html;
        }

        // Si c'est la dernière page, on retire le bouton charger plus
        if(response.data.is_last_page) {
            loadMoreBtn.hidden = true
        } else {
            loadMoreBtn.hidden = false
            
            if(isLoadMore) {
                // Sinon on charge la page suivante seulement si on clique sur charger plus
                filtersForm.dataset.page = parseInt(filtersForm.dataset.page) + 1;
            }
        }
    }
})