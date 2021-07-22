document.addEventListener('keydown', function(event){
	if(event.key === "Escape"){
		$('.devtools-menu').toggleClass('mode-active');
		$('.devtools-containerLink').toggleClass('mode-active');
		$('.devtools-text').toggleClass('style-active');
	}
	if ($('.devtools-menu').hasClass('mode-active')) {
		if(event.key === "r"){
			document.location.reload();
		}
		if(event.key === "t"){
			window.scrollTo({ top: 0, behavior: 'smooth' });
		}
		if(event.key === "b"){
			window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
		}
	}
	
});

$('.devtools-menu .container-el .el').click(function(){
	if (!$(this).data('option') === 'reset') {
		$(this).toggleClass('style-active');
	}
})

$('.devtools-menu .container-el .el').click(function(){
	$(this).toggleClass('style-active');
})

// SCREEN SIZE
$(window).resize(function() {
	var screenHeight = $(window).height();
	var screenWidth = $(window).width();

	$('.devtools-size').html(screenHeight + ' X ' + screenWidth);
})

$(window).on('load', function() {
	var screenHeight = $(window).height();
	var screenWidth = $(window).width();

	$('.devtools-size').html(screenHeight + ' X ' + screenWidth);
})


// SCROLL POSITION
$(window).scroll(function() {
	var $height = $(window).scrollTop();
	var screenHeight = $(document).height();
	var calcPercent = Math.round($height*100/screenHeight);
	$('.devtools-scrollposition').html($height+'px ' + calcPercent + '%');
});
$(window).on('load', function() {
	var $height = $(window).scrollTop();
	var screenHeight = $(document).height();
	var calcPercent = Math.round($height*100/screenHeight);
	$('.devtools-scrollposition').html($height+'px ' + calcPercent + '%');
})



$('.devtools-menu .container-el .el[data-option="reset"]').click(function(){
	$('.devtools-menu .container-el .el').removeClass('style-active');
	$('html').removeClass('mode-section');
	$('html').removeClass('mode-element');
	$('.devtools-size').removeClass('style-active');
	$('.devtools-grid').removeClass('mode-active');
	$('.devtools-scrollposition').removeClass('style-active');
	$('.devtools-containerLink').removeClass('style-active');
	$('.devtools-containerLink .btn').removeClass('style-active');
	$('.devtools-containerLink .container-el').removeClass('style-active');
})

$('.devtools-menu .container-el .el[data-option="grid"]').click(function(){

	$('.devtools-grid').toggleClass('mode-active');
})


$('.devtools-menu .container-el .el[data-option="element"]').click(function(){

	$('html').toggleClass('mode-element');
})

$('.devtools-menu .container-el .el[data-option="section"]').click(function(){

	$('html').toggleClass('mode-section');
})


$('.devtools-menu .container-el .el[data-option="screensize"]').click(function(){
	$('.devtools-size').toggleClass('style-active');
})
$('.devtools-menu .container-el .el[data-option="scrollposition"]').click(function(){
	$('.devtools-scrollposition').toggleClass('style-active');
})

$('.devtools-containerLink .btn').click(function(){
	if ($(this).hasClass('style-active')) {
		$(this).removeClass('style-active');
		$('.devtools-containerLink .container-el').removeClass('style-active');
	} else {
		$(this).addClass('style-active');
		$('.devtools-containerLink .container-el').addClass('style-active');
	}
	
})




