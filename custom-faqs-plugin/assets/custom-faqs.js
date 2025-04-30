document.addEventListener('DOMContentLoaded', function () {
  const swiper = new Swiper('.faq-swiper', {
    slidesPerView: 1.2,
    spaceBetween: 20,
    breakpoints: {
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      }
    },
    navigation: {
      nextEl: '.faq-next',
      prevEl: '.faq-prev',
    },
    pagination: {
      el: '.faq-pagination',
      type: 'fraction',
    },
  });
});
