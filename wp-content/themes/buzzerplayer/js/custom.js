/**
 * File Custom.js.
 **/
(function($) {
    $(document).ready(function() {

        const toggler = document.getElementById('customToggler');
        const collapseEl = document.getElementById('navbarNavAltMarkup');

        toggler.addEventListener('click', () => {
            collapseEl.classList.toggle('show');
        });

        if ($('.ideas-slider').length) {
            const swiper = new Swiper('.ideas-slider', {
                slidesPerView: "auto",
                spaceBetween: 25,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
				breakpoints: {
                    768: {
                        slidesPerView: 4,
                    }
                },
            });
        }
    });
})(jQuery);


