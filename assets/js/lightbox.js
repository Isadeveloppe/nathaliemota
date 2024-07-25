document.addEventListener('DOMContentLoaded', function() {
    console.log('Script loaded');
    const fullscreenIcons = document.querySelectorAll('.fullscreen');
    const lightbox = document.querySelector('.lightbox');
    const lightboxImage = document.querySelector('.middle-image');
    const lightboxCategory = document.getElementById('lightbox-category');
    const lightboxReference = document.getElementById('lightbox-reference');
    const lightboxClose = document.querySelector('.lightbox_close');
    const lightboxPrev = document.querySelector('.lightbox_prev');
    const lightboxNext = document.querySelector('.lightbox_next');
    const overlayLightbox = document.querySelector('.overlay-lightbox');
    let currentIndex = 0;

    const images = Array.from(fullscreenIcons).map(icon => ({
        src: icon.closest('.photo').getAttribute('data-href'),
        category: icon.closest('.photo').getAttribute('data-category'),
        reference: icon.closest('.photo').getAttribute('data-reference')
    }));
console.log(images);
    function openLightbox(index) {
        console.log('Opening lightbox for index:', index);
        currentIndex = index;
        const { src, category, reference } = images[currentIndex];
        lightboxImage.src = src;
        lightboxCategory.textContent = `Catégorie: ${category}`;
        lightboxReference.textContent = `Référence: ${reference}`;
        lightbox.style.display = 'flex';
    }

    function closeLightbox() {
        console.log('Closing lightbox');
        lightbox.style.display = 'none';
        overlayLightbox.style.display = 'flex';
    }

    function showPrevImage() {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : images.length - 1;
        openLightbox(currentIndex);
    }

    function showNextImage() {
        currentIndex = (currentIndex < images.length - 1) ? currentIndex + 1 : 0;
        openLightbox(currentIndex);
    }

    fullscreenIcons.forEach((icon, index) => {
        icon.addEventListener('click', (e) => {
            e.preventDefault();  // Prevent the default action
            console.log('Fullscreen icon clicked:', index);
            openLightbox(index);
        });
    });

    lightboxClose.addEventListener('click', closeLightbox);
    lightboxPrev.addEventListener('click', showPrevImage);
    lightboxNext.addEventListener('click', showNextImage);

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeLightbox();
        } else if (e.key === 'ArrowLeft') {
            showPrevImage();
        } else if (e.key === 'ArrowRight') {
            showNextImage();
        }
    });
});
