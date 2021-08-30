// @codekit-prepend 'common.js'

let redirection = $('#redirection').text();
$('#redirection').remove();

$('.section-signin form button').on('click', function() {

	let returnF = true;
	$(this).parent().parent().find('input, textarea').each(function(){
		
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
	})

	if(returnF) {
		let form = $(this).parent().parent();
		$.ajax({
			url : '/php/signin.php',
			type : 'POST',
			data : form.serialize(),
			success : function(code, statut){
				if(code == 'true') {
					$('.section-signin form .input').removeClass('style-error');
					document.location.href = redirection;
				} else {
					$('.section-signin form .input').addClass('style-error');
				}
			}
		});
	}
})

$('.section-signin .container-form .password-forg').click(function(){
	$('.container-lightbox').addClass('style-block');
    setTimeout(function(){
        $('.container-lightbox').addClass('style-visible');
        setTimeout(function(){
            $('.container-lightbox .wrapper .lightbox.input-email').addClass('style-active');
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

$(document).click(function(event){
    if($('.container-lightbox .wrapper .lightbox').hasClass('style-active')) {
        if (!$(event.target).closest('.container-lightbox .wrapper .lightbox').length) {
            closeLightbox();
        }
    }
});

$('.container-lightbox .wrapper .lightbox.input-email .container-button .btn').click(function(){
        

	let input = $('.container-lightbox .wrapper .lightbox.input-email input');
	if( isEmpty(input) || !verifEmail(input) ) {
		input.parent().addClass('style-error');
	}
	else {
		input.parent().removeClass('style-error');

		let form = $('.container-lightbox .wrapper .lightbox.input-email form');
		$.ajax({
            url : '/php/signin/sendpassword.php',
            type : 'POST',
            data : form.serialize(),
            success : function(code, statut){
				closeLightbox();
			}
        });

	}

});