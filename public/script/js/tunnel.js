// @codekit-prepend 'common.js'

/* COMMON FUNCTION */
	
	let index = 1;
	let direction;

	function refresh(){
		$('.sidebar .container-illu img.style-show').removeClass('style-show').addClass(direction);
		$('.sidebar .container-illu img:nth-child(' + index +')').removeClass('style-hide-right style-hide-left').addClass('style-show');

		$('.header .container-tab .tab.style-active').removeClass('style-active');
		
		if (window.matchMedia("(min-width: 1250px)").matches) {
			$('.header .container-tab .tab:nth-child(' + index +')').addClass('style-active').prevAll().addClass('style-active');
		} else {
			$('.header .container-tab .tab:nth-child(' + index +')').addClass('style-active');
		}

		$('.container-step .step.style-show').removeClass('style-show');
		$('.container-step .step:nth-child(' + index +')').addClass('style-show');

		$('.section-tunnel .wrapper .content .header .container-line .line').removeClass('style-active-1 style-active-2 style-active-3 style-active-4').addClass('style-active-' + index);
	}

	function init(){
		$('.sidebar .container-illu img:nth-child(' + index + ')').addClass('style-show').nextAll().addClass('style-hide-right');
		$('.header .container-tab .tab:nth-child(' + index + ')').addClass('style-active');
		$('.container-step .step:nth-child(' + index + ')').addClass('style-show');
		$('.step-2 .btn-next').removeClass('style-disable');
		$('.section-tunnel .wrapper .content .header .container-line .line').removeClass('style-active-1 style-active-2 style-active-3 style-active-4').addClass('style-active-' + index);
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

		$('.step-2 input[name=product]').attr('value', $(this).data('stripe'));
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
				if($(this).attr('type') == "checkbox" || $(this).attr('type') == "number") {
					if( $(this).attr('type') != "number" ) {

						let modifiedThis = "";
						if($(this).attr('name') == "cgu1") modifiedThis = "cgu2";
						if($(this).attr('name') == "inform1") modifiedThis = "inform2";

						if( $(this).is(':checked') ) {
							$('.step-2 .checkbox input[name='+modifiedThis+']').attr('value', 1);
						} else {
							$('.step-2 .checkbox input[name='+modifiedThis+']').attr('value', 0);
						}
					}
					if( $(this).attr('name') == 'cgu1' ) {
						if($(this).is(':checked')) {
							$(this).parent().removeClass('style-error');
						}
						else {
							returnF = false;
							$(this).parent().addClass('style-error');
						}
					}
				}
				else if($(this).attr('type') == "password" ) {
					let password1 = $('.step-2 form input[name=password-1]').val(),
					 	password2 = $('.step-2 form input[name=password-2]').val();
					if( password1 != password2 || password1.length <= 6|| password2.length <= 6 ) {
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

	stripe = Stripe("pk_test_51ITTz8FhVHJZbiNtVMX7yRBoHXfr6EBdEr2Rxc4irOVrbyVTMWNu6iPdjdY4gNloIqNCHO7b1Jun2zsHhHlOfCDP00McJPnNjo");

	let idCardNumber = "#cardNumber-element";
	let idCardExpiry = "#cardExpiry-element";
	let idCardCvc = "#cardCvc-element";

	let elementStyles = {
	base: {
		color: '#535353',
		fontSize: '14px',
		fontSmoothing: 'antialiased',
		fontFamily: 'Mulish',

		'::placeholder': {
		color: '#535353',
		},
		':focus': {
		color: '#535353',
		},
	},
	invalid: {
		color: '#FF4351',

		'::placeholder': {
		color: '#FF4351',
		},
	},
	};

	let elements = stripe.elements({ fonts: [ { cssSrc: 'https://fonts.googleapis.com/css2?family=Mulish&display=swap', }, ], });

	let cardNumberPlaceholder = $(idCardNumber).parent().find('.placeholder').text();
	$(idCardNumber).parent().find('.placeholder').remove();
	let cardNumber = elements.create('cardNumber', {
	style: elementStyles,
	showIcon: true,
	placeholder: cardNumberPlaceholder
	});
	cardNumber.mount(idCardNumber);

	let cardExpiryPlaceholder = $(idCardExpiry).parent().find('.placeholder').text();
	$(idCardExpiry).parent().find('.placeholder').remove();
	let cardExpiry = elements.create('cardExpiry', {
	style: elementStyles,
	placeholder: cardExpiryPlaceholder
	});
	cardExpiry.mount(idCardExpiry);

	let cardCvcPlaceholder = $(idCardCvc).parent().find('.placeholder').text();
	$(idCardCvc).parent().find('.placeholder').remove();
	let cardCvc = elements.create('cardCvc', {
	style: elementStyles,
	placeholder: cardCvcPlaceholder
	});
	cardCvc.mount(idCardCvc);

	$('.__PrivateStripeElement').attr('style', "");

	let allElements = [cardNumber, cardExpiry, cardCvc];

	$('.step-3 .btn-next').click(function(){
		if( !$('.step-3 .container-nav .btn-next .btn-text').hasClass('style-none') ) {
			let returnF = true;
			$('.step-3 form').find('input').each(function(){

				if(!$(this).parent().hasClass('__PrivateStripeElement')) {
				if( isEmpty($(this)) ) {
					returnF = false;
					$(this).parent().addClass('style-error');
				}
				else {
					$(this).parent().removeClass('style-error');
				}
				}

			});

			if( $('#cardNumber-element').hasClass('StripeElement--invalid') || $('#cardNumber-element').hasClass('StripeElement--empty') ) {
				returnF = false;
				$('#cardNumber-element').parent().addClass('style-error');
			} else $('#cardNumber-element').parent().removeClass('style-error');

			if( $('#cardExpiry-element').hasClass('StripeElement--invalid') || $('#cardExpiry-element').hasClass('StripeElement--empty') ) {
				returnF = false;
				$('#cardExpiry-element').parent().addClass('style-error');
			} else $('#cardExpiry-element').parent().removeClass('style-error');

			if( $('#cardCvc-element').hasClass('StripeElement--invalid') || $('#cardCvc-element').hasClass('StripeElement--empty') ) {
				returnF = false;
				$('#cardCvc-element').parent().addClass('style-error');
			} else $('#cardCvc-element').parent().removeClass('style-error');

			if(returnF) {

				$('.step-3 .container-nav .btn-next .btn-text').addClass('style-none');
				$('.step-3 .container-nav .btn-next .btn-arrow').addClass('style-none');
				$('.step-3 .container-nav .btn-next .btn-load').removeClass('style-none');

				$.ajax({
					url : '/php/intent.php',
					type : 'POST',
					success : function(code, statut){
						$('input[name=intent]').attr('value', code.split('|')[0]);
						let clientSecret = code.split('|')[1];

						stripe.confirmCardSetup(clientSecret, {
							payment_method: {
								card: cardNumber,
								billing_details: {
									name: $('.cardholderName').val(),
								},
							},
						})
						.then(function(result) {
							if (result.error) {} else {
								setTimeout(function(){
									let form = $('.step-3 form');
									$.ajax({
										url : '/php/form.php',
										type : 'POST',
										data : form.serialize(),
										success : function(code, statut){
											if(code == 'mail') {
												alert('Adresse email déjà utilisé');

												$('.step-3 .container-nav .btn-next .btn-text').removeClass('style-none');
												$('.step-3 .container-nav .btn-next .btn-arrow').removeClass('style-none');
												$('.step-3 .container-nav .btn-next .btn-load').addClass('style-none');

											} else {
												$('.section-tunnel .header').addClass('style-hide');
												index++;
												direction = 'style-hide-left';
												refresh();
											}
										}
									});
								}, 250);
							}
						});
					}
				});
			}
		}
	});

	$('.step-3 .btn-prev').click(function(){
		if( !$('.step-3 .container-nav .btn-next .btn-text').hasClass('style-none') ) {
			if (index > 1) {
				index--;
				direction = 'style-hide-right';
				refresh();

				$('.step-3 .container-steps input').remove();
			}
		}
	});

/* END STEP 3 */















