// @codekit-prepend 'common.js'

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

$('.section-dashboard .container-informations section .head .container-btn .btn:nth-child(1)').click(function(){
    $(this).removeClass('style-active');
    $('.section-dashboard .container-informations section .head .container-btn .btn:nth-child(2)').addClass('style-active');

    $('.section-dashboard .container-informations .section-informations .content-save').removeClass('style-active');
    $('.section-dashboard .container-informations .section-informations .content-edit').addClass('style-active');
});

$('.section-dashboard .container-informations section .head .container-btn .btn:nth-child(2)').click(function(){
    
    let returnToEdit = true;

    let returnF = true;
    $('form[data-info="perso"] input').each(function(){
        
        if( isEmpty($(this)) ) {
			returnF = false;
			$(this).parent().addClass('style-error');
		}
		else {
			$(this).parent().removeClass('style-error');
		}

    });

    if(returnF) {
        let form = $('form[data-info="perso"]');
        $.ajax({
            url : '/php/dashboard/perso.php',
            type : 'POST',
            data : form.serialize(),
            success : function(code, statut){}
        });
    } else returnToEdit = false;

    returnF = true;
    $('form[data-info="securite"] input').each(function(){

        if($(this).attr("name") != 'password2') {
            if($(this).attr("name") != 'password1') {
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
            } else {
                if( $('form[data-info="securite"] input[name="password2"]').val() != $(this).val() ) {
                    returnF = false;
                    $(this).parent().addClass('style-error');
                    $('form[data-info="securite"] input[name="password2"]').parent().addClass('style-error');
                } else {
                    $(this).parent().removeClass('style-error');
                    $('form[data-info="securite"] input[name="password2"]').parent().removeClass('style-error');
                }
            }
        }

    });

    if(returnF) {
        let form = $('form[data-info="securite"]');
        $.ajax({
            url : '/php/dashboard/securite.php',
            type : 'POST',
            data : form.serialize(),
            success : function(code, statut){
                $('form input[name=mail]').attr('value',$('form[data-info="securite"] input[name=email]'));
            }
        });
    } else returnToEdit = false;

    returnF = true;
    $('form[data-info="paiement"] input').each(function(){
        
        if(!$(this).parent().hasClass('__PrivateStripeElement')) {
            if( isEmpty($(this)) ) {
                returnF = false;
                $(this).parent().addClass('style-error');
            }
            else {
                $(this).parent().removeClass('style-error');
            }
        } else {
            if( $(this).parent().parent().hasClass('StripeElement--invalid') ) {
                returnF = false;
                $(this).parent().parent().parent().parent().addClass('style-error');
            } else {
                $(this).parent().parent().parent().parent().removeClass('style-error');
            }
        }

    });

    if(returnF) {
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
                            let form = $('form[data-info="paiement"]');
                            $.ajax({
                                url : '/php/dashboard/paiement.php',
                                type : 'POST',
                                data : form.serialize(),
                                success : function(code, statut){
                                    console.log(code, statut);
                                }
                            });
                        }, 250);
                    }
                });
            }
        });
    } else returnToEdit = false;
    
    returnF = true;
    if( $('form[data-info="pro"]') ) {
        $('form[data-info="pro"] input').each(function(){
            
            if( isEmpty($(this)) ) {
                returnF = false;
                $(this).parent().addClass('style-error');
            }
            else {
                $(this).parent().removeClass('style-error');
            }

        });
    }

    if(returnF) {
        let form = $('form[data-info="pro"]');
        $.ajax({
            url : '/php/dashboard/pro.php',
            type : 'POST',
            data : form.serialize(),
            success : function(code, statut){}
        });
    } else returnToEdit = false;

    
    if(returnToEdit) {
        location.reload();
    }

});


$('.section-dashboard .container-informations .section-subscribe ul li .link').click(function(){
    $('.container-lightbox').addClass('style-block');
    setTimeout(function(){
        $('.container-lightbox').addClass('style-visible');
        setTimeout(function(){
            $('.container-lightbox .wrapper .lightbox.subscribe').addClass('style-active');
        }, 100);
    }, 100);
});

$('.section-dashboard .container-informations .section-account ul li .link').click(function(){
    $('.container-lightbox').addClass('style-block');
    setTimeout(function(){
        $('.container-lightbox').addClass('style-visible');
        setTimeout(function(){
            $('.container-lightbox .wrapper .lightbox.account').addClass('style-active');
        }, 100);
    }, 100);
});

function closeLightbox() {
    $('.container-lightbox .wrapper .lightbox').removeClass('style-active');
    setTimeout(function(){
        $('.container-lightbox').removeClass('style-visible');
        setTimeout(function(){
            $('.container-lightbox').removeClass('style-block');
        }, 100);
    }, 100);
}

$('.container-lightbox .wrapper .lightbox .cross').click(function(){
    closeLightbox();
});

$('.container-lightbox .wrapper .lightbox .container-button .btn:first-child .btn-text').click(function(){
    closeLightbox();
});

$(document).click(function(event){
    if($('.container-lightbox .wrapper .lightbox').hasClass('style-active')) {
        if (!$(event.target).closest('.container-lightbox .wrapper .lightbox').length) {
            closeLightbox();
        }
    }
});

//Subscribe
$('.container-lightbox .wrapper .lightbox.subscribe .container-button .btn:last-child').click(function(){
    let form = $('.container-lightbox form');
    $.ajax({
        url : '/php/dashboard/unsubscribe.php',
        type : 'POST',
        data : form.serialize(),
        success : function(code, statut){
            location.reload();
        }
    });
});

//Account
$('.container-lightbox .wrapper .lightbox.account .container-button .btn:last-child').click(function(){
    let form = $('.container-lightbox form');
    $.ajax({
        url : '/php/dashboard/unaccount.php',
        type : 'POST',
        data : form.serialize(),
        success : function(code, statut){
            location.reload();
        }
    });
});

$('.section-dashboard .container-sidebar .container-tab .tab').click(function(){
    $('.section-dashboard .container-sidebar .container-tab .tab').removeClass('style-active');
    $(this).addClass('style-active');
})