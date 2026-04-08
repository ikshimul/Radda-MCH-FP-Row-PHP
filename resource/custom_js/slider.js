//jQuery(document).ready(function () {
//    jQuery('#mycarousel').jcarousel({
//        scroll: 2,
//        vertical: true,
//        animation: 3000,
//        auto: 2,
//        wrap: 'circular'
//    });
//});
function create() {
    $('#jcarousel1').jcarousel()
    $('#jcarousel2').jcarousel({
        wrap: 'circular',
        animation: 3000,
    });
    $('.jcarousel').addClass('jcarousel-vertical').jcarousel('reload');
}

$(function () {
    create();
    $('#jcarousel1').jcarouselAutoscroll({
        interval: 3000,
        autostart: true
    });

    $('#jcarousel2').jcarouselAutoscroll({
        scroll: 2,
        auto: 2,
        target: '+=2',
        autostart: true
    });
    $('.jcarousel-control-prev')
            .on('jcarouselcontrol:active', function () {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function () {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                target: '-=2'
            });

    $('.jcarousel-control-next')
            .on('jcarouselcontrol:active', function () {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function () {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                target: '+=2'
            });
});
$(document).ready(function () {
    $('#sb-slider').cycle({
        fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
    });
});