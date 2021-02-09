// @codekit-prepend 'common.js'

$(window).on('load', function() {
	/*
	$('.section-search .container-search .container-input .input input').focusin(function(){
		$('.section-search .container-search .container-input .input').addClass('style-search');
		$('.section-search .container-search .container-input .dropdown').addClass('style-show');
		
		if (!$('.section-search .container-search .container-result').hasClass('style-show')) {
			$('.section-search .container-search .container-placeholder').addClass('style-show');
		}
	})
	*/

	$('.section-search .container-search .container-input .input input').focusout(function(){
		if ($(this).val() === "") {
			$('.section-search .container-search .container-input .input').removeClass('style-search');
			$('.section-search .container-search .container-input .dropdown').removeClass('style-show');
		};
	})

	$('.section-search .container-search .container-input .input .container-action button').click(function(){
		$('.section-search .container-search .container-input .input input').focus();
	})

	function closeSearch() {
		$('.section-search .container-search .container-input .input').removeClass('style-search');
		$('.section-search .container-search .container-input .dropdown').removeClass('style-show');

		$('.section-search .container-search .container-result').removeClass('style-show');
		//$('.section-search .container-search .container-placeholder').addClass('style-show');
	}

	$('.section-search .container-search .container-input .input .container-action .cross').click(function(){
		$('.section-search .container-search .container-input .input input').val('');
		closeSearch();
	})

	/* ALGOLIA */
	const client = algoliasearch('XPXU1DOA36', 'dbfeccb756f9c49a7d852aece7784c44');
	const index = client.initIndex('question_reponse');

	$(".section-search .container-search .container-input .input input").on("keyup", function() {
		let value = $(this).val().toLowerCase();
		if(value.length > 0) {

			$('.section-search .container-search .container-input .input').addClass('style-search');
			$('.section-search .container-search .container-input .dropdown').addClass('style-show');
			//$('.section-search .container-search .container-placeholder').removeClass('style-show');
			$('.section-search .container-search .container-result').addClass('style-show');

			index.search(value, { highlightPreTag: '<em>' }).then(({ hits }) => {
				let arrayLi = "";
				$(hits).each(function(index) {
					if(index < 4) 
						arrayLi += '<li><div class="answer">' + hits[index]._highlightResult.question.value + "</div></li>";
				});
				$('.section-search .container-search .container-input .dropdown .container-result ul li').remove();
				$('.section-search .container-search .container-input .dropdown .container-result ul').append(arrayLi);
			});
		}
		else {
			$('.section-search .container-search .container-input .input').removeClass('style-search');
			$('.section-search .container-search .container-input .dropdown').removeClass('style-show');
			$('.section-search .container-search .container-result').removeClass('style-show');
			//$('.section-search .container-search .container-placeholder').addClass('style-show');
		}
	});
	/* END ALGOLIA */
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
sectionFtrCaroussel(
	10000,
	'.section-ftr',  
	".container-el .el", 
	".container-video .video",
	".container-line .line"
);



function sectionQuote_caroussel(button, el){

	var valDelay = 5000;
	var count = 1;
	var numEl = $(el).length;


	function prg(){
		console.log('start prg');
		count++;
		if (count <= numEl) {
			$(el + '.style-active').removeClass('style-active').next().addClass('style-active');
		} else {
			count = 1;
			$(el + '.style-active').removeClass('style-active');
			$(el + ':nth-child(1)').addClass('style-active');
			
		}
		var elActive = $(el + '.style-active').index() + 1;
		
		$(button).removeClass('style-progress');
		setTimeout(function(){
			$(button).addClass('style-progress');
		}, 50);

		clearInterval(interval);
		var interval = setInterval(function() {
	    	//prg();
	    }, valDelay);
	}

	$(button).click(function(){
		prg();
	})

	var interval = setInterval(function() {
    	prg();
    }, valDelay);

	/* INIT */
	$(el + ':nth-child(1)').addClass('style-active');
}
sectionQuote_caroussel('.section-quote .container .container-btn .btn', '.section-quote .container .container-quote .quote');






