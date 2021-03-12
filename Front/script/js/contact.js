// @codekit-prepend 'common.js'

$('.container-lightbox .background').click(function (){
	$('.container-lightbox').removeClass('style-show');
})
$('.container-lightbox .cross').click(function (){
	$('.container-lightbox').removeClass('style-show');
});

$('.section-contact form button').on('click', function() {

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
			url : '/php/contact.php',
			type : 'POST',
			data : form.serialize(),
			success : function(code, statut){
				if(code == 'true') {
					$('.section-contact form .input, .section-contact form .textarea').removeClass('style-error');
					$('.container-lightbox').addClass('style-show')
				} else {
					$('.section-contact form .input, .section-contact form .textarea').addClass('style-error');
				}
			}
		});
	}
})

