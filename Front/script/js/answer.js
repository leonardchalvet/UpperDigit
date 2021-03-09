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

	index.search(' ', { similarQuery: $('.section-answer .container-answer .answer h2').text(), highlightPreTag: '<em>', hitsPerPage: 4 }).then(({ hits }) => {
		$(hits).each(function(index) {
			if(index !== 0) {
				$('.section-answer .container-questions ul li:nth-child('+(index)+') .link-text').text(hits[index].question);
				$('.section-answer .container-questions ul li:nth-child('+(index)+') form').html('<input name="question" type="text" value="' + hits[index].question + '"/><input name="answer" type="text" value="' + hits[index].reponse + '"/>');
			}
		});
	});

	$('.section-answer .container-questions ul li').click(function(){
		$(this).find('form').submit();
	});

	/* END ALGOLIA */

	/* LIGHTBOX */

	$('.container-lightbox .lightbox .cross').click(function(){
		$('.container-lightbox .lightbox').removeClass('style-show');
		$('.container-lightbox').removeClass('style-show');
	});

	$(document).click(function(){
		if (!$(event.target).closest('.container-lightbox .lightbox').length) {
			$('.container-lightbox .lightbox .cross').click();
		}
	});

	function showLg1() {
		setTimeout(function(){
			$('.container-lightbox').addClass('style-show');
			$('.container-lightbox .lightbox-1').addClass('style-show');
		}, 10000);
	}

	if(!getCookie('answer')) {
		setCookie('answer', "1");
		showLg1();
	}
	else {
		let answerCookie = getCookieAndValue('answer');
		if(answerCookie[1] == "1") {
			setCookie('answer', "2");
		}
		else if(answerCookie[1] == "2") {
			setCookie('answer', "3");
		} else if(answerCookie[1] == "3") {
			$('.container-lightbox').addClass('style-show');
			$('.container-lightbox .lightbox-2').addClass('style-show');
			$('.section-answer .container-answer').addClass('style-blur');
		}

		if(answerCookie[1] != "3") {
			showLg1();
		}
	}

	/* END LIGHTBOX */
});