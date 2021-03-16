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
	
	let subTextSave = $('.step-3 .col-recap .abonnement').text();
	$('.step-2 .btn-next').click(function(){

		let returnF = true;
		$('.step-2 form').find('input').each(function(){

			if( $(this).parent().parent().index() !== 2 
				|| ( $(this).parent().parent().index() === 2 && $(this).parent().parent().hasClass('style-show') ) ) {
				if($(this).attr('type') == "checkbox") {
					if($(this).is(':checked')) {
						$(this).parent().removeClass('style-error');
					}
					else {
						returnF = false;
						$(this).parent().addClass('style-error');
					}
				}
				else if($(this).attr('type') == "password" ) {
					let password1 = $('.step-2 form input[name=password-1]').val(),
					 	password2 = $('.step-2 form input[name=password-2]').val();
					if( password1 != password2 || password1.length <= 0|| password2.length <= 0 ) {
						returnF = false;
						$(this).parent().addClass('style-error');
					}
					else {
						$(this).parent().removeClass('style-error');
					}
				} else {
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
			}
		});

		if(returnF) {
			setTimeout(function(){
				index++;
				direction = 'style-hide-left';
				refresh();

				$('.step-3 .col-recap .name-1').text($('.step-2 input[name=firstname]').val());
				$('.step-3 .col-recap .name-2').text($('.step-2 input[name=lastname]').val());
				$('.step-3 .col-recap .abonnement').text(subTextSave + " " + $('.step-1 .el.style-active .title').text());
				$('.step-3 .col-recap .price').text($('.step-1 .el.style-active .price span:nth-child(1)').text() + " " + $('.step-1 .el.style-active .price span:nth-child(2)').text());

				/* ADD INPUT */

				let input = document.createElement("input");
				input.setAttribute("type", "text");
				input.setAttribute("name", "id_stripe");
				input.setAttribute("value",$('.step-1 .el.style-active').attr('data-stripe'));
				$('.step-3 .container-steps').append(input);

				$('.step-2 form').find('input').each(function(){
					if( $(this).parent().parent().index() !== 2 
						|| ( $(this).parent().parent().index() === 2 && $(this).parent().parent().hasClass('style-show') ) ) {

						let input = document.createElement("input");
						input.setAttribute("name", $(this).attr("name"));
						input.setAttribute("value", $(this).val());
						$('.step-3 .container-steps').append(input);

					}
				});
				/* END ADD INPUT */

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
			setTimeout(function(){
				let form = $('.step-3 form');
				$.ajax({
					url : '/php/form.php',
					type : 'POST',
					data : form.serialize(),
					success : function(code, statut){
						console.log(code, statut);
						if(code == 'true') {
							$('.section-tunnel .header').addClass('style-hide');
							index++;
							direction = 'style-hide-left';
							refresh();
						} else {
							/* AJOUTER UNE ERREUR */
							alert('Probleme');
						}
					}
				});
			}, 250)
		}
	});

	$('.step-3 .btn-prev').click(function(){
		if (index > 1) {
			index--;
			direction = 'style-hide-right';
			refresh();

			$('.step-3 .container-steps input').remove();
		}
	});

/* END STEP 3 */

var stripe = Stripe("pk_test_51ITTz8FhVHJZbiNtVMX7yRBoHXfr6EBdEr2Rxc4irOVrbyVTMWNu6iPdjdY4gNloIqNCHO7b1Jun2zsHhHlOfCDP00McJPnNjo");















