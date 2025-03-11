$(document).ready(function() {
    // Initialisation du Owl Carousel
    $(".owli").owlCarousel({
        autoplay: true,            // Défilement automatique
        loop: true,                // Boucle infinie
        nav: false,                // Pas de boutons de navigation
        dots: true,                // Afficher les points de pagination
        items: 1,                  // Afficher un seul élément à la fois
        margin: 0,                 // Pas de marge entre les éléments
        responsive: {
            0: { items: 1 },        // Mobile
            768: { items: 1 },      // Tablette
            992: { items: 1 },      // Ordinateur de bureau
            1200: { items: 1 }      // Écrans très grands
        }
    });
});
