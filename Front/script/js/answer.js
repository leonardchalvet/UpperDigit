// @codekit-prepend 'common.js'

$(window).on('load', function() {

	let clickOutOfInput = true;
	$(document).click(function(){
		if (!$(event.target).closest('.section-search .container-search .container-input .dropdown').length) {
			clickOutOfInput = false;
		}
		else {
			clickOutOfInput = true;
		}
	});

	$('.section-search .container-search .container-input .input input').focusout(function(event){
		let thisI = $(this);
		setTimeout(function(){
			if (thisI.val() === "" && !clickOutOfInput) {
				clickOutOfInput = true;
				$('.section-search .container-search .container-input .input').removeClass('style-search');
				$('.section-search .container-search .container-input .dropdown').removeClass('style-show');	
			}
		}, 50);
	})

	$('.section-search .container-search .container-input .input .container-action button').click(function(){
		$('.section-search .container-search .container-input .input input').focus();
	})

	function closeSearch() {
		$('.section-search .container-search .container-input .input').removeClass('style-search');
		$('.section-search .container-search .container-input .dropdown').removeClass('style-show');

		$('.section-search .container-search .container-result').removeClass('style-show');
		$('.section-search .container-search .container-placeholder').addClass('style-show');
	}

	$('.section-search .container-search .container-input .input .container-action .cross').click(function(){
		$('.section-search .container-search .container-input .input input').val('');
		closeSearch();
	})

	/* ALGOLIA */
	const client = algoliasearch('XPXU1DOA36', 'dbfeccb756f9c49a7d852aece7784c44');
	const index = client.initIndex('question_reponse');

	function resultPlaceholder() {
		index.search(" ", { highlightPreTag: '<em>', hitsPerPage: 4 }).then(({ hits }) => {
			let arrayLi = '<li><div class="title">' + titlePlaceholder + "</div></li>";
			$(hits).each(function(index) {
				arrayLi += '<li><div class="answer" data-answer="' + hits[index]._highlightResult.reponse.value + '">' + hits[index]._highlightResult.question.value + "</div></li>";
			});
			$('.section-search .container-search .container-input .dropdown .container-placeholder ul li').remove();
			$('.section-search .container-search .container-input .dropdown .container-placeholder ul').append(arrayLi);
			updateClickAnswer();
		});
	}

	let titlePlaceholder = $('.section-search .container-search .container-placeholder .title').text();
	$(".section-search .container-search .container-input .input input").on("keyup", function() {
		let value = $(this).val().toLowerCase();
		if(value.length > 0) {

			$('.section-search .container-search .container-input .input').addClass('style-search');
			$('.section-search .container-search .container-input .dropdown').addClass('style-show');
			$('.section-search .container-search .container-placeholder').removeClass('style-show');
			$('.section-search .container-search .container-result').addClass('style-show');

			index.search(value, { highlightPreTag: '<em>', hitsPerPage: 4 }).then(({ hits }) => {
				let arrayLi = "";
				$(hits).each(function(index) {
					arrayLi += '<li><div class="answer" data-answer="' + hits[index]._highlightResult.reponse.value + '">' + hits[index]._highlightResult.question.value + "</div></li>";
				});
				$('.section-search .container-search .container-input .dropdown .container-result ul li').remove();
				$('.section-search .container-search .container-input .dropdown .container-result ul').append(arrayLi);
				updateClickAnswer();
			});
		}
		else {
			$('.section-search .container-search .container-result').removeClass('style-show');
			$('.section-search .container-search .container-placeholder').addClass('style-show');

			resultPlaceholder();
		}
	});

	$('.section-search .container-search .container-input .input input').focusin(function(){
		$('.section-search .container-search .container-input .input').addClass('style-search');
		$('.section-search .container-search .container-input .dropdown').addClass('style-show');
		
		if (!$('.section-search .container-search .container-result').hasClass('style-show')) {
			$('.section-search .container-search .container-placeholder').addClass('style-show');
		}

		resultPlaceholder();
	});

	function updateClickAnswer() {
		$('.section-search .container-search .container-input .dropdown ul li .answer').click(function(){
			$('.section-search .container-search .container-input .input input[name="question"]').val($(this).text());
			$('.section-search .container-search .container-input .input input[name="answer"]').val($(this).attr('data-answer'));

			$('.section-search form button').click();
		});
	}

	$('.container-lightbox .lightbox .cross').click(function(){
		$('.container-lightbox .lightbox').removeClass('style-show');
		$('.container-lightbox').removeClass('style-show');
	})

	/* END ALGOLIA */
});