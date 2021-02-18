// @codekit-prepend 'common.js'



/* STEP 1 */

$('.step-1 .el').click(function(){
	$('.step-1 .el').removeClass('style-active');
	$(this).addClass('style-active');
	$('.step-1 .btn-next').removeClass('style-disable');

	if ($(this).data('subscription') === 2 || $(this).data('subscription') === 3 ) {
		$('.step-2 .container-form .col:nth-child(3)').addClass('style-show');
	} else {
		$('.step-2 .container-form .col:nth-child(3)').removeClass('style-show');
	}
})

/* STEP 2 */

$('.step-2 .btn-next').click(function(){
	var isValid;
	$('.step-2 form input[required]').closest('.input').removeClass('style-error');
	$('.step-2 form input[required]').each(function() {
	   var element = $(this);
	   if (element.val() == "") {
	   		$(this).closest('.input').addClass('style-error');
	       	isValid = false;
	   } else {
	   		isValid = true;
	   		$('.step-2 .btn-next').removeClass('style-disable');
	   }
	});
})

/* STEP 3 */










function nav(){

	var index = 1;

	var direction
	
	function refresh(){

		$('.sidebar .container-illu img.style-show').removeClass('style-show').addClass(direction);
		$('.sidebar .container-illu img:nth-child(' + index +')').removeClass('style-hide-right style-hide-left').addClass('style-show');

		$('.header .container-tab .tab.style-active').removeClass('style-active');
		$('.header .container-tab .tab:nth-child(' + index +')').addClass('style-show').prevAll().addClass('style-show');

		$('.container-step .step.style-show').removeClass('style-show');
		$('.container-step .step:nth-child(' + index +')').addClass('style-show');
	}

	function init(){
		$('.sidebar .container-illu img:nth-child(' + index + ')').addClass('style-show').nextAll().addClass('style-hide-right');
		$('.header .container-tab .tab:nth-child(' + index + ')').addClass('style-active');
		$('.container-step .step:nth-child(' + index + ')').addClass('style-show');
	}

	init();

	$('.btn-next').click(function(){
		if (!$(this).hasClass('style-disable')) {

			index++;
			direction = 'style-hide-left';
			refresh();
		}

		if (index === 4) {
			$('.section-tunnel .header').addClass('style-hide');
		}
		
	})

	$('.btn-prev').click(function(){
		if (index > 1) {
			index--;
			direction = 'style-hide-right';
			refresh();
		}
	})
};


nav();