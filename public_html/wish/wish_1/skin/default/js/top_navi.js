$(function(){

	//navi control
	$('#mOpen a').bind('click',function(){
		var winWidth = $(window).width();
		var winHeight = null;
		var wH = $(window).height();
		var aH = $('#allwrap').height();

		if (wH > aH){ winHeight = wH;
		} else { winHeight = aH;}

		if (winWidth > 540){ var gnbW = 510; 
		} else if (winWidth < 541 && winWidth > 480 ){ var gnbW = 420;
		} else {var gnbW = 280;}

		$('#allBg').css('height',winHeight);
		$('#allBg').show();
		$('#navi').css('height','5px');
		$('#navi').stop().animate({'width':gnbW},600,'easeInQuad', function() {
			setTimeout( function(){
				$('#navi').stop().animate({'height':winHeight},600);				
				$("#topMenu ul").slideToggle(600);
				$("#msnb ul").slideToggle(600);				
			},300);
		});
	});

	$('#mClose').bind('click',function(){
		$('#navi').stop().animate({'height':'5'},600,'easeInQuad', function() {
			$('#navi').stop().animate({'width':'0'},600);
			setTimeout( function(){
				$('#allBg').hide()
			},600);
		});
		
		$("#topMenu ul").slideToggle(600);	
		$("#msnb ul").slideToggle(600);				
	});

	// navi ani
	$("#topMenu ul li").each(function( index ) {
		$(this).css({'animation-delay': (index/10)+'s'});
	});	
	$("#msnb ul li").each(function( index ) {
		$(this).css({'animation-delay': (index/10)+'s'});
	});	

	$('#allBg').click(function(){ $('#mClose').click(); });
	

	var $el, leftPos, newWidth,
	$mainNav = $("#topMenu ul");
	$mainNav.prepend("<li id='magic-line'><span class='lt'></span><span class='rt'></span><span class='lb'></span><span class='rb'></span></li>");


	var lineOpen = function(){
		var winWidth = $(window).width();
		var targetDiv = $(this);		
		var $magicLine = $("#magic-line");
		var lineHeight = targetDiv.height();
		var lineTop = (targetDiv.parent().index() -1) * lineHeight; 

		var lineLeft = null;
		if (winWidth > 480){ lineLeft = 30;
		} else { lineLeft = 15 };		

		var lineWidth = null;
		if (winWidth > 480){ lineWidth = targetDiv.width()+60;
		} else { lineWidth = targetDiv.width()+30; };
		
		$magicLine.fadeIn();

		$magicLine.stop().animate({
			'width': lineWidth,
			'left': targetDiv.position().left - lineLeft,
			'top': lineTop
		},200);    
		
	}
	
	$('#topMenu ul').mouseleave(function(){
		$("#magic-line").hide();
	});
	

	var filter = "win16|win32|win64|mac";
	if(navigator.platform){
		if(0 > filter.indexOf(navigator.platform.toLowerCase())){
			// mobile
		} else {
			$("a[id^=topNavi]").each(function() {
				$(this).mouseover(lineOpen)
					   .focus(lineOpen)
			});
		}
	}

	


});