$(function(){

	if ( $('#introSection').length > 0 ) { 
		$('html').css('background','#f9f8f8');
	};

	// checkbox, radio design
	if ( $('input[type=checkbox]').length > 0 ) { 
		$('input').customInput();
	};
		
	//variable select design
	$.fn.extend({
		longStyle : function(options) {
			this.each(function() {
				var currentSelected = $(this).find(':selected');
				$(this).after('<span class="longSbox"><span class="longSboxInner">'+currentSelected.text()+'</span></span>').css({position:'absolute', opacity:0,fontSize:$(this).next().css('font-size')});
				var selectBoxSpan = $(this).next();
				var selectBoxWidth = parseInt($(this).width()) - parseInt(selectBoxSpan.css('padding-left'));   
				var selectBoxSpanInner = selectBoxSpan.find(':first-child');
				selectBoxSpan.css({display:'inline-block'});
				selectBoxSpanInner.css({width:selectBoxWidth, display:'inline'});
				var selectBoxHeight = parseInt(selectBoxSpan.height()) + parseInt(selectBoxSpan.css('padding-top')) + parseInt(selectBoxSpan.css('padding-bottom'));
				var selectWidth = $(this).siblings('.longSbox').width();
				$(this).css('width',selectWidth+'px');
				$(this).height(selectBoxHeight).change(function(){
					selectBoxSpanInner.text($(this).find(':selected').text()).parent().addClass('changed');
				});
			});
		}
	});$('.longbox').longStyle();


	// select box
	$.fn.extend({
		searchStyle : function(options) {
			this.each(function() {
				var currentSelected = $(this).find(':selected');
				$(this).after('<span class="searchStyleSelectBox"><span class="searchStyleSelectBoxInner">'+currentSelected.text()+'</span></span>').css({position:'absolute', opacity:0,fontSize:$(this).next().css('font-size')});
				var selectBoxSpan = $(this).next();
				var selectBoxWidth = parseInt($(this).width()) - parseInt(selectBoxSpan.css('padding-left'));   
				var selectBoxSpanInner = selectBoxSpan.find(':first-child');
				selectBoxSpan.css({display:'inline-block'});
				selectBoxSpanInner.css({width:selectBoxWidth, display:'inline'});
				var selectBoxHeight = parseInt(selectBoxSpan.height()) + parseInt(selectBoxSpan.css('padding-top')) + parseInt(selectBoxSpan.css('padding-bottom'));
				var selectWidth = $(this).siblings(".searchStyleSelectBox").width();
				$(this).css('width',selectWidth+'px');
				$(this).height(selectBoxHeight).change(function(){
					selectBoxSpanInner.text($(this).find(':selected').text()).parent().addClass('changed');
					});
				});	
		}
	}); $('.select').searchStyle();


	var guideWidth = function(){
		var winWidth = $(window).width();
		if (winWidth > 620) { var layerCheck = 620; }
		else if (winWidth > 540 && winWidth < 821) { var layerCheck = 540; }
		else { var layerCheck = 320; }

		// fancy box
		$(".guidepop").fancybox({
			'autoDimensions': false,
			'showCloseButton': false,
			'width': layerCheck,
			'padding': 0,
			'scrolling': 'no',
			'type': 'iframe',
			'onComplete': function () {
				$('#fancybox-frame').load(function () { // wait for frame to load and then gets it's height
				$('#fancybox-content').height($(this).contents().find('body').height());
				$.fancybox.resize();
				});
			}
		});
	}; guideWidth();

	// resize select
	$(window).resize(function(){ 
		$('.select, .longbox').each(function () {
			var selectWidth = $(this).siblings('span').width();
			var selectHeight = $(this).siblings('span').height();
			$(this).css('width',selectWidth+'px').css('height',selectHeight+'px');
		});
	});

	$(window).bind('resize', function() {
		guideWidth();
	});


});