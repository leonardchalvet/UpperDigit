$window = $(window);

$window.scroll(function() {
    if ( $window.scrollTop() >= 1 ) {
        $(header).addClass('style-scroll');
    } else {
    	$(header).removeClass('style-scroll');
    };
});