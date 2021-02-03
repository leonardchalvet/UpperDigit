// @codekit-prepend 'common.js'

$(window).on('load', function() {
	$('.section-search .container-search .container-input .input input').focusin(function(){
		$('.section-search .container-search .container-input .input').addClass('style-search');
		$('.section-search .container-search .container-input .dropdown').addClass('style-show');
		if (!$('.section-search .container-search .container-result').hasClass('style-show')) {
			$('.section-search .container-search .container-placeholder').addClass('style-show');
		}
	})

	$('.section-search .container-search .container-input .input input').focusout(function(){
		if ($(this).val() === "") {
			$('.section-search .container-search .container-input .input').removeClass('style-search');
			$('.section-search .container-search .container-input .dropdown').removeClass('style-show');
		};
	})

	$('.section-search .container-search .container-input .input .container-action button').click(function(){
		$('.section-search .container-search .container-input .input input').focus();
	})

	$('.section-search .container-search .container-input .input .container-action .cross').click(function(){
		$('.section-search .container-search .container-input .input input').val('');
		$('.section-search .container-search .container-input .input').removeClass('style-search');
		$('.section-search .container-search .container-input .dropdown').removeClass('style-show');

		$('.section-search .container-search .container-result').removeClass('style-show');
		$('.section-search .container-search .container-placeholder').addClass('style-show');
	})

	$('.section-search .container-search .container-input .input input').on('keyup', function() {

		if (this.value.length > 1) {
			$('.section-search .container-search .container-placeholder').removeClass('style-show');
			$('.section-search .container-search .container-result').addClass('style-show');

		} else {
			$('.section-search .container-search .container-result').removeClass('style-show');
			$('.section-search .container-search .container-placeholder').addClass('style-show');
		}
	});
})



function sectionFtrCaroussel(Delay, Section, El, Video){
		
	El = Section + ' ' + El;
	Video = Section + ' ' + Video;

	var valDelay = 0;
	var numberEl = $(El).length;
	var countEl;
	
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
	".container-video .video"
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






