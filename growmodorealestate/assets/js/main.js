// Carousel functionality for navigation and counter
document.addEventListener('DOMContentLoaded', function () {
    const carousels = document.querySelectorAll('.testimonials-carousel, .properties-carousel');

    carousels.forEach((carousel) => {
        const slides = carousel.querySelectorAll('.swiper-slide');
        const counter = carousel.querySelector('.pagination-counter');
        const nextButton = carousel.querySelector('.swiper-button-next');
        const prevButton = carousel.querySelector('.swiper-button-prev');

        const updateCounter = () => {
            const activeSlide = carousel.querySelector('.swiper-slide-active');
            if (activeSlide) {
                const activeIndex = activeSlide.getAttribute('data-swiper-slide-index');
                counter.textContent = `${parseInt(activeIndex, 10) + 1} of ${slides.length}`;
            }
        };

        // Attach event listeners for navigation buttons
        if (nextButton) {
            nextButton.addEventListener('click', updateCounter);
        }
        if (prevButton) {
            prevButton.addEventListener('click', updateCounter);
        }

        // Initialize the counter
        updateCounter();
    });
});
