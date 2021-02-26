// @codekit-prepend 'common.js'

/* COMMON FUNCTION */
	
	let index = 1;
	let direction;

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
		$('.step-2 .btn-next').removeClass('style-disable');
	}
	init();

	function isEmpty(el){
		return !$.trim(el.val());
	}

	function verifEmail(c) {
		let regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
		return regex.test(c.val());
	}

/* END COMMON FUNCTION */

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
	});

	$('.step-1 .btn-prev').click(function(){
		let url = window.location.href.split('/');
		url = url[0] + "//" + url[2] + "/" + url[3];
		console.log(url);
		window.location.href = url;
	});

	$('.step-1 .btn-next').click(function(){
		if (!$(this).hasClass('style-disable')) {
			index++;
			direction = 'style-hide-left';
			refresh();
		}
	});

/* END STEP 1 */

/* STEP 2 */

	$('.step-2 .btn-next').click(function(){
		
		let stateForm = false;

		let returnF = true;
		$('.step-2 form').find('input').each(function(){

			if($(this).attr('type') == "checkbox") {
				if($(this).is(':checked')) {
					$(this).parent().removeClass('style-error');
				}
				else {
					returnF = false;
					$(this).parent().addClass('style-error');
				}
			}
			else {

				if( isEmpty($(this)) ) {
					returnF = false;
					$(this).parent().addClass('style-error');
				}
				else {
					$(this).parent().removeClass('style-error');
				}

				if($(this).attr("name") == 'email') {
					let returnV = verifEmail($(this));
					if(!returnV) {
						returnF = false;
						$(this).parent().addClass('style-error');
					}
				}

			}
		});

		if(returnF) {
			stateForm = true;
			setTimeout(function(){
				index++;
				direction = 'style-hide-left';
				refresh();
			}, 250)
		}
	});

	$('.step-2 .btn-prev').click(function(){
		if (index > 1) {
			index--;
			direction = 'style-hide-right';
			refresh();
		}
	});

/* END STEP 2 */

/* STEP 3 */

	$('.step-3 .btn-next').click(function(){

		let stateForm = false;

		let returnF = true;
		$('.step-3 form').find('input').each(function(){

			if( isEmpty($(this)) ) {
				returnF = false;
				$(this).parent().addClass('style-error');
			}
			else {
				$(this).parent().removeClass('style-error');
			}

		});

		if(returnF) {
			stateForm = true;
			setTimeout(function(){
				$('.section-tunnel .header').addClass('style-hide');
				index++;
				direction = 'style-hide-left';
				refresh();
			}, 250)
		}
	});

	$('.step-3 .btn-prev').click(function(){
		if (index > 1) {
			index--;
			direction = 'style-hide-right';
			refresh();
		}
	});

/* END STEP 3 */