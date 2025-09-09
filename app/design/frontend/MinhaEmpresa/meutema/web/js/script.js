require(['jquery', 'domReady!'], function($) {
    'use strict';

//  var logoMoved = false;

//     var $logoImg = $('.logo'); 

//     $(window).on('scroll', function () {
//         var scrollTop = $(this).scrollTop();

//         if (scrollTop > 100 && !logoMoved) {
//             $logoImg.addClass('logo-header').removeClass('logo');
//             logoMoved = true;
//         } else if (scrollTop <= 100 && logoMoved) {
//             $logoImg.removeClass('logo-header').addClass('logo');
//             logoMoved = false;
//         }
//     });

    $(document).on('click', '#toggle-theme-btn', function() {
        if ($('body').hasClass('black-background')) {
            $('body').removeClass('black-background').addClass('white-background');
        } else {
            $('body').removeClass('white-background').addClass('black-background');
        }
    });
});

