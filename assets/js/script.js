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


//***** Images miniatures*****//
jQuery(document).ready(function($) {
  // Fonction pour changer l'image affichée
  function changeThumbnail(imageUrl) {
      $('#displayed-thumbnail').attr('src', imageUrl);
  }

  // Événements de survol pour les liens de navigation
  $('.navigation_arrows a').hover(function() {
      const imageUrl = $(this).data('image');
      if (imageUrl) {
          changeThumbnail(imageUrl);
      }
  }, function() {
      // Réinitialiser à l'image actuelle lorsqu'on ne survole plus la flèche
      const currentImage = "<?php echo esc_url($current_thumbnail); ?>";
      changeThumbnail(currentImage);
  });
});



/*****FILTRES*****/
jQuery(document).ready(function($) {
    const filterList = document.querySelectorAll('.filter');
    filterList.forEach((filter) => {
        filter.addEventListener('change', function(event) {
            const categorie = document.getElementById('categorie').value;
            const format = document.getElementById('format').value;
            const orderby = document.getElementById('orderby').value;
            console.log('Filters:', { categorie, format, orderby });

            $.ajax({
                type: 'POST',
                url: '/wp-admin/admin-ajax.php',
                dataType: 'html',
                data: {
                    action: 'filter_photos',
                    category: categorie,
                    format: format,
                    orderby: orderby,
                },
                success: function(res) {
                    $('.catalogue_photos').html(res);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        });
    });
});


/*****LOAD MORE*****/
jQuery(document).ready(function($) {
    let page = 1;

    $('#load-more').on('click', function() {
        page++;
        let button = $(this);
        let data = {
            action: 'load_more_photos',
            page: page
        };

        $.ajax({
            url: button.data('url'),
            type: 'POST',
            data: data,
            beforeSend: function(xhr) {
                button.text('Loading...');
            },
            success: function(response) {
                if (response === 'empty') {
                    button.text('No more photos').prop('disabled', true);
                } else {
                    $('.catalogue_photos').append(response);
                    button.text('Load More');
                }
            }
        });
    });
});



/***** LIGHTBOX*****/
document.addEventListener('DOMContentLoaded', () => {
  const lightbox = document.getElementById('.lightbox');
  const closeBtn = document.getElementById('.lightboxClose');
  const prevBtn = document.getElementById('.lightboxPrev');
  const nextBtn = document.getElementById('.lightboxNext');
  const photo = document.getElementById('.photo');
  const middleImage = document.getElementById('.middleImage');
  const modalReference = document.getElementById('.modal-reference');
  const modalCategory = document.getElementById('.modal-category');

  // Initial data for the images
  const images = [
      {
          src: '<?php echo get_theme_file_uri() . "/assets/img/nathalie-15.jpeg.webp"; ?>',
          reference: 'Reference 1',
          category: 'Category 1'
      },
      // Add more images as needed
  ];

  let currentIndex = 0;

  const updateLightbox = (index) => {
      const image = images[index];
      if (image) {
          middleImage.src = image.src;
          modalReference.textContent = image.reference;
          modalCategory.textContent = image.category;
      }
  };

  const showLightbox = (index) => {
      currentIndex = index;
      updateLightbox(currentIndex);
      lightbox.style.display = 'block';
  };

  const hideLightbox = () => {
      lightbox.style.display = 'none';
  };

  const showPrevImage = () => {
      currentIndex = (currentIndex > 0) ? currentIndex - 1 : images.length - 1;
      updateLightbox(currentIndex);
  };

  const showNextImage = () => {
      currentIndex = (currentIndex < images.length - 1) ? currentIndex + 1 : 0;
      updateLightbox(currentIndex);
  };

  // Event listeners
  closeBtn.addEventListener('click', hideLightbox);
  prevBtn.addEventListener('click', showPrevImage);
  nextBtn.addEventListener('click', showNextImage);

  // Initial setup
  updateLightbox(currentIndex);
});




