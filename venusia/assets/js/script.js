// CHANGEMENT D'IMAGE

// éléments de la page qui ont la class .infos
document.querySelectorAll('.infos').forEach(function(element) {

    //  éléments stockés dans la variable 
    let mainImages = element.querySelectorAll('.mainImage');

    element.addEventListener('mouseover', function() {
        mainImages[0].classList.add('d-none'); // la première image est cachée
        mainImages[1].classList.remove('d-none'); // la deuxième image est affichée en cachant l'autre
    });

    element.addEventListener('mouseout', function() {
        mainImages[0].classList.remove('d-none'); // la première image est affichée
        mainImages[1].classList.add('d-none'); // la deuxième image est cachée
    });
});




// BOUTON //quantité fiche produit//

document.addEventListener('DOMContentLoaded', function() {/* événement JavaScript indiquant la disponibilité du contenu HTML */
  // Sélection des éléments du DOM
  let btnMin = document.getElementById('btnMin');
  let btnPlus = document.getElementById('btnPlus');
  let quantityInput = document.getElementById('quantite');

  // Ajout d'écouteurs d'événements pour les boutons Plus(+) et Moins(-)
  btnPlus.addEventListener('click', function() {
      quantityInput.value = parseInt(quantityInput.value) + 1;
  });

  btnMin.addEventListener('click', function() {
      // Vérification pour éviter les quantités négatives
      if (parseInt(quantityInput.value) > 1) {
          quantityInput.value = parseInt(quantityInput.value) - 1;
      }
  });
});

  


