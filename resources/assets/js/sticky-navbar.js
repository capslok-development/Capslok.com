$(document).ready(function () {
    var navName = '.tabs-container';
    var stickyClassName = 'sticky';

    var navTop = $(navName).offset().top;

    var stickify = function () {
        var scrollTop = $(window).scrollTop();

        if (scrollTop > navTop) {
            $(navName).addClass(stickyClassName);
        } else {
            $(navName).removeClass(stickyClassName);
        }
    };

    // only does stickify when scrolling up
    var lastScrollTop = 0;
    $(window).scroll(function () {
        var st = $(this).scrollTop();
    
        if (st < lastScrollTop)
            stickify();

        lastScrollTop = st;
    });
});