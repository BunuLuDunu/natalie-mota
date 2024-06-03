// Récupération du formulaire
const loadMoreForm = document.querySelector(".photo-list-filters");

// Récupération du bouton
const loadMoreBtn = document.querySelector(".load-more-btn");

// Récupération du container de la liste des photos
const loadMoreContainer = document.querySelector(".photo-list-container");

loadMoreBtn.addEventListener('click', async () => {
    const request = await fetch(loadMoreForm.getAttribute('action'), {
        method: "POST",
        body: new FormData(loadMoreForm)
    })
    const response = await request.json();

    if (response.success) {
        loadMoreContainer.insertAdjacentHTML('beforeend', response.data.html);

        if(response.data.is_last_page) {
            loadMoreBtn.remove()
        } else {
            loadMoreForm.page.value = parseInt(loadMoreForm.page.value) + 1;
        }
    }
})