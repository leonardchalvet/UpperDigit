// @codekit-prepend 'common.js'

$('.section-search .container-search .container-input .input input').focusin(function(){
	$('.section-search .container-search .container-input .input').addClass('style-search');
	$('.section-search .container-search .container-input .dropdown').addClass('style-show');
	if (!$('.section-search .container-search .container-result').hasClass('style-show')) {
		$('.section-search .container-search .container-placeholder').addClass('style-show');
	}
})

$('.section-search .container-search .container-input .input input').focusout(function(){
	if ($(this).val() === "") {
		$('.section-search .container-search .container-input .input').removeClass('style-search');
		$('.section-search .container-search .container-input .dropdown').removeClass('style-show');
	};
})

$('.section-search .container-search .container-input .input .container-action button').click(function(){
	$('.section-search .container-search .container-input .input input').focus();
})

$('.section-search .container-search .container-input .input .container-action .cross').click(function(){
	$('.section-search .container-search .container-input .input input').val('');
	$('.section-search .container-search .container-input .input').removeClass('style-search');
	$('.section-search .container-search .container-input .dropdown').removeClass('style-show');

	$('.section-search .container-search .container-result').removeClass('style-show');
	$('.section-search .container-search .container-placeholder').addClass('style-show');
})

$('.section-search .container-search .container-input .input input').on('keyup', function() {
	if (this.value.length > 1) {
		$('.section-search .container-search .container-placeholder').removeClass('style-show');
		$('.section-search .container-search .container-result').addClass('style-show');

	} else {
		$('.section-search .container-search .container-result').removeClass('style-show');
		$('.section-search .container-search .container-placeholder').addClass('style-show');
	}
});


$('.container-lightbox .lightbox .cross').click(function(){
	$('.container-lightbox .lightbox').removeClass('style-show');
	$('.container-lightbox').removeClass('style-show');
})