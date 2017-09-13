$(document).ready(function() {
	
	var mainshow = $('.intro');
	mainshow.imagesLoaded( function() {
		var winWidth = $(window).width();
		var topPos = null;
		if (winWidth > 540){ topPos = 68 } else { topPos = 30}
		$('.step01').stop().animate({'top':topPos},500);
	}).done( function( instance ) {
		action();
	});


	var shoot = function(){
		mainshow.find('.overlay').css({'opacity':'0.4','background-color':'white'});
		setTimeout(function(){mainshow.find('.overlay').css({'opacity':'0','background-color':''})},100);
	};


	var action = function (){
		var overlay = $('<div class="overlay">').css({opacity:0}).appendTo(mainshow);	
		setTimeout( function(){ shoot(); } ,800);
		setTimeout( function(){ shoot(); } ,1000);
		setTimeout( function(){ mainActive(); } ,2000);

		$('.step02').delay(1200).fadeIn(2000).fadeOut(1500).queue(function() {
			shoot(); setTimeout( function(){ shoot(); }, 200);
			$('.step03').delay(400).fadeIn(2000).fadeOut(1500).queue(function() {
				shoot(); setTimeout( function(){ shoot(); }, 200);
				$('.step01').fadeOut();
				$('.step04').delay(400).fadeIn(2000);				
			});
		});		
			
	};
	
	var spanAct = function(target){
		target.children().find('.lt').stop().animate({'left':'0','top':'0'},200)
		target.children().find('.rt').stop().animate({'right':'0','top':'0'},200)
		target.children().find('.lb').stop().animate({'left':'0','bottom':'0'},200)
		target.children().find('.rb').stop().animate({'right':'0','bottom':'0'},200)
	};

	var bannerHover = function(){
		$('.mainBanner ul li').each(function(){			
			$(this).hover(function(){
				$thisTarget = $(this).children().children('.hover');
				$thisTarget.stop().fadeIn(150);
				$thisTarget.children().prepend("<span class='lt'></span><span class='rt'></span><span class='lb'></span><span class='rb'></span>");
				spanAct($(this));
			},function(){
				$thisTarget = $(this).children().children('.hover');
				$thisTarget.stop().fadeOut(150);
				$thisTarget.children().children('span').remove();
			});
		});
	};


	var mainActive = function(){
		for (var i=0; i<7; i++ ){
			$('.mainBanner ul li:eq(' + i +')').delay(100*i).fadeIn(200);
		};
		

		var filter = "win16|win32|win64|mac";
		if(navigator.platform){
			if(0 > filter.indexOf(navigator.platform.toLowerCase())){
				// mobile
			} else {
				bannerHover();
			}
		}


		$('#atoz').delay(1000).fadeIn().queue(function() {
			
			var winWidth = $(window).width();
			var rnum = 0;
			if(winWidth > 1400){ rnum = 7; } 
			else if(winWidth < 1401 && winWidth > 1200){ rnum = 6; } 
			else if(winWidth < 1201 && winWidth > 1000){ rnum = 5; } 
			else if(winWidth < 1001 && winWidth > 800){ rnum = 4; } 
			else if(winWidth < 801 && winWidth > 600){ rnum = 3; } 
			else { rnum = 2; };

			function rollwidth(){
				var winWidth = $(window).width();
				if(winWidth > 1400){ mySwiper.params.slidesPerView = 7; }
				else if(winWidth < 1401 && winWidth > 1200){ mySwiper.params.slidesPerView = 6; } 
				else if(winWidth < 1201 && winWidth > 1000){ mySwiper.params.slidesPerView = 5; } 
				else if(winWidth < 1001 && winWidth > 800){ mySwiper.params.slidesPerView = 4; } 
				else if(winWidth < 801 && winWidth > 600){ mySwiper.params.slidesPerView = 3; } 
				else { mySwiper.params.slidesPerView = 2; };
			}

			var mySwiper = new Swiper('.atozRoll',{
				paginationClickable: true,
				slidesPerView: rnum,
				loop: true,
				autoplay:3000
			});

			
			
			$(window).bind('resize', function() {
				rollwidth();
			});

		});

		$('#footerWrap').delay(1200).fadeIn();
	};
	
	$(window).bind('resize', function() {
		var winWidth = $(window).width();
		var topPos = null;
		if (winWidth > 540){ topPos = 68 } else { topPos = 30}
		$('.step01').stop().animate({'top':topPos},200);
	});


});