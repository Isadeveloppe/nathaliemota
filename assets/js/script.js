/*****POPUP*****/
document.addEventListener('DOMContentLoaded', function() {
    const closeButton = document.querySelector('.popup-close');
    const popupOverlay = document.querySelector('.popup-overlay');
    const menuContactItems = document.querySelectorAll('.menu-item-contact a'); 
    const ctaContact = document.getElementById('ctaContact');

    function openPopup(refPhoto = null) {
        if (refPhoto) {
            const refPhotoField = document.querySelector('input[id="reference-photo"]');
            if (refPhotoField) {
                refPhotoField.value = refPhoto;
            }
        }
        popupOverlay.style.display = 'flex';
        document.body.classList.add('popup-open');
    }

    function closePopup() {
        popupOverlay.style.display = 'none';
        document.body.classList.remove('popup-open');
    }

    if (menuContactItems) { 
        menuContactItems.forEach(function(menuContact){
            menuContact.addEventListener('click', function(event) {          
                event.preventDefault();
                document.getElementById('menu-modal').classList.remove('show');
                document.querySelectorAll('.modal_burger').forEach(function(burgerButtonItem){
                    burgerButtonItem.classList.remove('close');   
                });
                openPopup();
            });
        });
    }

    if (ctaContact) {
        ctaContact.addEventListener('click', function() {
            const refPhoto = ctaContact.getAttribute('data-ref-photo');
            openPopup(refPhoto);
        });
    }

    if (closeButton) {
        closeButton.addEventListener('click', closePopup);
    }

    // Optionnel: la popup se ferme lorsqu'on clique n'importe où sur l'écran
    popupOverlay.addEventListener('click', function(event) {
        if (event.target === popupOverlay) {
            closePopup();
        }
    });
});


//*****IMAGES MINIATURES*****//
jQuery(document).ready(function ($) {
    // Fonction pour changer l'image affichée
    function changeThumbnail(imageUrl) {
        $('#displayed-thumbnail').attr('src', imageUrl);
    }

    // Événements de survol pour les liens de navigation
    $('.navigation_arrows a').hover(
        function () {
            const imageUrl = $(this).data('image');
            if (imageUrl) {
                changeThumbnail(imageUrl);
            }
        },
    );
});


/*****FILTRES*****/
document.addEventListener('DOMContentLoaded', function () {
    const filterList = document.querySelectorAll('.filter');

    filterList.forEach(filter => {
        filter.addEventListener('change', function (event) {
            const categorie = document.getElementById('categorie').value;
            const format = document.getElementById('format').value;
            const orderby = document.getElementById('orderby').value;
            const nonce = document.getElementById('nathaliemota_nonce').value;
            
            console.log('Filters:', { categorie, format, orderby });

            fetch('/wp-admin/admin-ajax.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    action: 'nathaliemota_load_filter',
                    category: categorie,
                    format: format,
                    orderby: orderby,
                    nonce: nonce
                })
            })
            .then(response => response.text())
            .then(data => {
                document.querySelector('.catalogue_photos').innerHTML = data;
            })
            .catch(error => console.error('Erreur:', error));
        });
    });
});



/*****LOAD MORE-CHARGER PLUS*****/
jQuery(document).ready(function($) {
    let page = 1;

    $('#load-more').on('click', function() {
        page++;
        let button = $(this);
        let data = {
            action: 'load_more_photos',
            page: page
        };

        console.log('Sending AJAX request with data:', data);

        $.ajax({
            url: button.data('url'),
            type: 'POST',
            data: data,
            beforeSend: function(xhr) {
                button.text('Loading...');
            },
            success: function(response) {
                console.log('AJAX response:', response);
                if (response === 'empty') {
                    button.text('No more photos').prop('disabled', true);
                } else {
                    $('.catalogue_photos').append(response);
                    button.text('Charger plus');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });
});


/*****BURGER MENU*****/
window.onload = function () {
    const burger = document.querySelector(".menu-toggle");
    const navMenu = document.querySelector("#nav-menu");

    if (burger && navMenu) {
        burger.addEventListener("click", function () {
            if (!navMenu.classList.contains("open")) {
                navMenu.classList.add("open");
                navMenu.classList.remove("close");
            } else {
                navMenu.classList.remove("open");
                navMenu.classList.add("close");
            }
            burger.classList.toggle("open");

            const expanded = burger.getAttribute("aria-expanded") === "true" || false;
            burger.setAttribute("aria-expanded", !expanded);
        });

        navMenu.addEventListener("click", function (event) {
            if (event.target.tagName === 'A') {
                burger.classList.remove("open");
                navMenu.classList.remove("open");
                navMenu.classList.add("close");
                burger.setAttribute("aria-expanded", false);
            }
        });
    } else {
        console.error("Le menu burger ou le navMenu n'a pas été trouvé dans le DOM.");
    }
};
