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

	$('.section-search .container-search .container-input .input input').focusout(function(){
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

	/* END ALGOLIA */

	// RUN FUNCTION

	carousel(
		".section-quote", 
		".btn", 
		".quote", 
		5000
	);
	sectionFtrCaroussel(
		10000,
		'.section-ftr',  
		".container-el .el", 
		".container-video .video",
		".container-line .line"
	);
})


function sectionFtrCaroussel(Delay, Section, El, Video, Progress){
		
	El = Section + ' ' + El;
	Video = Section + ' ' + Video;
	Progress = Section + ' ' + Progress;

	var valDelay = 0;
	var numberEl = $(El).length;
	var countEl;

	var progressHeight = $(Progress).height();
	var progressStep = progressHeight / numberEl;
	var timing;
	
	var drtc;


	function prg(drtc){

		var elVideo = Video;

		if (drtc === 'next') {
			countEl++;
		} else if (drtc === 'prev') {
			countEl--;
		};

		if (countEl <= numberEl && countEl >= 1) {

			$(El).css({
			  '-webkit-transform' : 'translateY(0px)',
			  '-moz-transform'    : 'translateY(0px)',
			  '-ms-transform'     : 'translateY(0px)',
			  '-o-transform'      : 'translateY(0px)',
			  'transform'         : 'translateY(0px)'
			});

			$(El + '.active').removeClass('active');
			$(elVideo).hide().removeClass('active');
			
			
			$(El + ':nth-child('+countEl+')').addClass('active');

			
			
			$(elVideo + '.' + $(El + '.active').data('video')).fadeIn(350).addClass('active');

			var iframe = $(elVideo + '.active' + ' iframe');
			var player = new Vimeo.Player(iframe);
			player.play();

			$(Progress).css({

				'-webkit-transition-duration' : '0s',
			    '-moz-transition-duration'    : '0s',
			    '-ms-transition-duration'     : '0s',
			    '-o-transition-duration'      : '0s',
			    'transition-duration'         : '0s',
				

			  	'-webkit-transform' : 'translateY(0px)',
			  	'-moz-transform'    : 'translateY(0px)',
			  	'-ms-transform'     : 'translateY(0px)',
			  	'-o-transform'      : 'translateY(0px)',
			  	'transform'         : 'translateY(0px)'
			  	
			});

			player.getDuration().then(function(duration) {
				$(Progress).css("top", ((progressStep * ($(El + '.active').index())) - progressHeight) + 'px');
				$(Progress).css({

					'-webkit-transition-duration' : duration + 's',
				    '-moz-transition-duration'    : duration + 's',
				    '-ms-transition-duration'     : duration + 's',
				    '-o-transition-duration'      : duration + 's',
				    'transition-duration'         : duration + 's',
					

				  	'-webkit-transform' : 'translateY(' + progressStep + 'px' + ')',
				  	'-moz-transform'    : 'translateY(' + progressStep + 'px' + ')',
				  	'-ms-transform'     : 'translateY(' + progressStep + 'px' + ')',
				  	'-o-transform'      : 'translateY(' + progressStep + 'px' + ')',
				  	'transform'         : 'translateY(' + progressStep + 'px' + ')'
				  	
				});
			});


			

			//transition-duration: 10s;

			


			


			var transformDistance = $(El + '.active .text').height()/2;

			$(El + '.active').nextAll().css({
			  '-webkit-transform' : 'translateY(' + transformDistance + 'px' + ')',
			  '-moz-transform'    : 'translateY(' + transformDistance + 'px' + ')',
			  '-ms-transform'     : 'translateY(' + transformDistance + 'px' + ')',
			  '-o-transform'      : 'translateY(' + transformDistance + 'px' + ')',
			  'transform'         : 'translateY(' + transformDistance + 'px' + ')'
			});
			$(El + '.active').css({
			  '-webkit-transform' : 'translateY(-' + transformDistance + 'px' + ')',
			  '-moz-transform'    : 'translateY(-' + transformDistance + 'px' + ')',
			  '-ms-transform'     : 'translateY(-' + transformDistance + 'px' + ')',
			  '-o-transform'      : 'translateY(-' + transformDistance + 'px' + ')',
			  'transform'         : 'translateY(-' + transformDistance + 'px' + ')'
			});
			$(El + '.active').prevAll().css({
			  '-webkit-transform' : 'translateY(-' + transformDistance + 'px' + ')',
			  '-moz-transform'    : 'translateY(-' + transformDistance + 'px' + ')',
			  '-ms-transform'     : 'translateY(-' + transformDistance + 'px' + ')',
			  '-o-transform'      : 'translateY(-' + transformDistance + 'px' + ')',
			  'transform'         : 'translateY(-' + transformDistance + 'px' + ')'
			});

			clearInterval(interval);
			interval = setInterval(function() {
		      	prg('next');
		    }, valDelay);

		} else if (countEl < 1) {
			countEl = numberEl;
			prg();
		} else {
			countEl = 1;
			prg();
		};
		
	};

	function init(){	    
		$(El + ':nth-child(1)').addClass('active');
		$(Video + ':nth-child(1)').addClass('active');
	};

	init();

	$(El).click(function(){
		var index = $(this).index() + 1;
		countEl=index;
		prg();
	})

	var interval = setInterval(function() {
    	prg('next');
    }, valDelay);

    valDelay = Delay;
};

function carousel(section, nav, el, delay){
	var nav = section + ' ' + nav;
	var el = section + ' ' + el;

	$(nav).click(function(){
		clearInterval(interval);
		$(nav).removeClass('style-load');
		if ($(this).hasClass('style-prev')) {
			setTimeout(function(){
				$(nav + '.style-prev').addClass('style-load');
			}, 50);
			
			if (!$(el + '.style-active').is(':first-child')) {
				$(el + '.style-active').removeClass('style-active').prev().addClass('style-active');
			} else if ($(el + '.style-active').is(':first-child')) {
				$(el + '.style-active').removeClass('style-active');
				$(el + ':last-child').addClass('style-active');
			}
			interval = setInterval(function() {
				$(nav + '.style-prev').click();
		    	console.log('step-prev');
		    }, delay);
		} else if ($(this).hasClass('style-next')) {
			setTimeout(function(){
				$(nav + '.style-next').addClass('style-load');
			}, 50);
			if (!$(el + '.style-active').is(':last-child')) {
				$(el + '.style-active').removeClass('style-active').next().addClass('style-active');
			} else if ($(el + '.style-active').is(':last-child')) {
				$(el + '.style-active').removeClass('style-active');
				$(el + ':first-child').addClass('style-active');
			}
			interval = setInterval(function() {
				$(nav + '.style-next').click();
		    	console.log('step-next');
		    }, delay);
		}
	})

	
	var interval = setInterval(function() {
    	console.log('step-next');
    	$(nav + '.style-next').click();
    	
    }, delay);
    setTimeout(function(){
		$(nav + '.style-next').addClass('style-load');
	}, 50);	
};

