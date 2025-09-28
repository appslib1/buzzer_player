/**
 * File Custom.js.
 **/
(function($) {
    $(document).ready(function() {

        // Apply only on homepage
        if ($('body').hasClass('home')) {
            $(window).on('scroll', function() {
                let scroll = $(window).scrollTop();
                if (scroll > 50) { // adjust value as needed
                    $('header').addClass('shadow');
                } else {
                    $('header').removeClass('shadow');
                }
            });
        }




        // Increase quantity
        $(document).on('click', '.btn-increase', function() {
            var input = parseInt($(this).parent().find('.quantity input.qty').val());
            $(this).parent().find('.quantity input.qty').val(input + 1).trigger('change');
        });

        // Decrease quantity
        $(document).on('click', '.btn-decrease', function() {
            var input = parseInt($(this).parent().find('.quantity input.qty').val());
            var newVal = input - 1;
            $(this).parent().find('.quantity input.qty').val(newVal).trigger('change');
        });

        $(document).on('change', 'input.qty', function() {
            $('button[name="update_cart"]').prop('disabled', false).trigger('click');
        });
        

        jQuery(document).ready(function($) {
            if ($(window).width() < 768) { // Only on mobile
                var $title = $('.product-top-section h1');
                var $images = $('.product-top-section .col-md-5');

                if ($title.length && $images.length) {
                $images.insertAfter($title); // Move images right after the title
                }
            }
        });

        let currentAudio = null;

        $(document).on('click', '.audios .sound-button-group img', function(e) {
            e.preventDefault();
            if (currentAudio) {
                currentAudio.pause();
                currentAudio.currentTime = 0;
            }
            var currentImg = $(this);
            const homeUrl = window.location.origin;
            $('.audios .sound-button-group img').attr('src',homeUrl+'/wp-content/themes/buzzerplayer/assets/icons/buzzBtn.png');
            //alert(homeUrl);
            currentImg.attr('src',homeUrl+'/wp-content/themes/buzzerplayer/assets/icons/buzzBtnClick.png');
            setTimeout(() => {
                currentImg.attr('src',homeUrl+'/wp-content/themes/buzzerplayer/assets/icons/buzzBtn.png');
            // put your code here
            }, 200); 
            var audioUrl = $(this).attr('data-audio');
            // Play audio from a URL

            currentAudio = new Audio(audioUrl);

            // Play
            currentAudio.play();

            // Handle finish
            currentAudio.addEventListener("ended", function() {
                //console.log('audio finished...');
                //currentImg.attr('src',homeUrl+'/wp-content/themes/buzzerplayer/assets/icons/buzzBtn.png');
            });

        });


        $(document).on('click', '#customToggler', function() {
            if(!$(this).hasClass('open')){
                $(this).addClass('open');
                $('#navbarNavAltMarkup').addClass('show');
                $('header').addClass('f-height');
            }
            else{
                $(this).removeClass('open');
                $('#navbarNavAltMarkup').removeClass('show');
                $('header').removeClass('f-height');
            }
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

        if ($('.productThumbs').length && ('.productSwiper').length) {

            var productThumbs = new Swiper(".productThumbs", {
                spaceBetween: 10,
                slidesPerView: 4,
                freeMode: true,
                watchSlidesProgress: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });

            var productSwiper = new Swiper(".productSwiper", {
                spaceBetween: 10,
                thumbs: {
                    swiper: productThumbs,
                },
            });
        }


    });
})(jQuery);


