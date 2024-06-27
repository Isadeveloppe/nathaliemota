// *****Code pour la popup*****//
document.addEventListener('DOMContentLoaded', function() {
  const closeButton = document.querySelector('.popup-close');
  const popupOverlay = document.querySelector('.popup-overlay');
  const popupOpen = document.querySelector('.popup-open');

  const contactButton = document.getElementById('.contactButton');

popupOpen.addEventListener('click',function() {
  popupOverlay.style.display = 'flex';
});

closeButton.addEventListener('click', function() {
      popupOverlay.style.display = 'none';
  });
});


//***** Slide *****//
document.addEventListener('DOMContentLoaded', function() {
  const track = document.querySelector('.carousel-track');
  const slides = Array.from(track.children);
  const nextButton = document.querySelector('.next-button');
  const prevButton = document.querySelector('.prev-button');
  const totalSlides = slides.length;

  let currentIndex = 0;

  const updateSlidesPosition = () => {
      slides.forEach((slide, index) => {
          slide.style.display = index === currentIndex ? 'block' : 'none';
      });
  };

  const moveToSlide = (targetIndex) => {
      if (targetIndex < 0) {
          currentIndex = totalSlides - 1;
      } else if (targetIndex >= totalSlides) {
          currentIndex = 0;
      } else {
          currentIndex = targetIndex;
      }
      updateSlidesPosition();
  };

  nextButton.addEventListener('click', () => {
      moveToSlide(currentIndex + 1);
  });

  prevButton.addEventListener('click', () => {
      moveToSlide(currentIndex - 1);
  });

  // Initial setup: Afficher la première slide
  updateSlidesPosition();
});


//*****Requête Ajax*****/
(function ($) {
  $(document).ready(function () {

      // Chargment des photographies en Ajax
      $('.js-load-photographies').click(function (e) {

          // Empêcher l'envoi classique du formulaire
          e.preventDefault();

          // L'URL qui réceptionne les requêtes Ajax dans l'attribut "action" de <form>
          const ajaxurl = $(this).data('ajaxurl');

          // Les données de notre formulaire
    // ⚠️ Ne changez pas le nom "action" !
    const data = {
      action: $(this).data('action'), 
      nonce:  $(this).data('nonce'),
      postid: $(this).data('postid'),
          }

          // Pour vérifier qu'on a bien récupéré les données
          console.log(ajaxurl);
          console.log(data);

          // Requête Ajax en JS natif via Fetch
          fetch(ajaxurl, {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded',
                  'Cache-Control': 'no-cache',
              },
              body: new URLSearchParams(data),
          })
          .then(response => response.json())
          .then(body => {
              console.log(body);

              // En cas d'erreur
              if (!body.success) {
                  alert(response.data);
                  return;
              }

              // Et en cas de réussite
              $(this).hide(); // Cacher le formulaire
              $('.comments').html(body.data); // Et afficher le HTML
          });
      });
      
  });
})(jQuery);
