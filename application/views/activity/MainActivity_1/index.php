<!-- Views -->
<div class="views">
	<div class="view view-main">
		<div class="pages">
			
			<!-- page -->			
			<div data-page="MainActivity_1" class="page" style="background:#fff;overflow:hidden;">	
				<div class="page-content" style="background:#0d0d0d;overflow-x:hidden;">
				
					<!-- navbar -->	
					<div class="navbar" style="background:#0d0d0d;height:50px;box-shadow:0 3px 6px rgba(255, 255, 255, 0.1)">
						<div class="navbar-inner">
							<div class="center">
								<a href="/activity/MainActivity_1/" class="link external">
									WISH WALK
								</a>
							</div>
							
							<div class="right">
								<a href="#" class="link">
									<i class="icon icon-bars"></i>
								</a>
							</div>
							
						</div>
					</div>
					<!-- navbar END -->
					
					<!-- pedometer -->
					<div comp_prop="step_comp" class="navbar" style="background:#0a0a0a;height:70px;">
											
					</div>
					<!-- pedometer -->
					
					<div comp_prop="marquee_main_1_comp" style="background-color:#ababab;">						
					</div>		
					
					<!-- poster -->
					<div comp_prop="poster" style="background-color:#ababab;">						
					</div>					
					<!-- poster END -->
					
					
					
					
					<!-- Competition Dashboard -->
					<div comp_prop="competit_dash" style="height:auto">						
					</div>
					<!-- Competition Dashboard END-->
					
					<!-- Ad Banner -->
					<div comp_prop="ad_banner" style="height:auto;line-height:0px;">	
						<img src="<?=IMG_PATH?>MainActivity_1/ad.jpg" style="width:100%;">
					</div>
					<!-- Ad Banner END-->
					
					<!-- MAGAZINE LIST -->
					<div comp_prop="magazine_comp" style="height:auto">						
					</div>
					<!-- MAGAZINE LIST END-->
					
					<!-- EVENT LIST -->
					<div comp_prop="event_list" style="height:auto">						
					</div>
					<!-- EVENT END-->
					
					<!-- CHECK IN LIST -->
					<div comp_prop="checkin_list" style="height:auto">						
					</div>
					<!-- CHECK IN LIST END-->
					
			
					<div class="footer" style="background:#808080;padding:10px 0px;">
					
						<div style="font-size:1em;text-align:center;position:relative;text-align:center;">
							<p style="font-size:1.7em;margin:auto;">행복한걸음</p>
							<p style="font-size:1.7em;margin:auto;">WISH WALK</p>
							<br>
							<p style="margin:auto;">related</p>
							<div style="margin-top:10px;">&nbsp;한국관광공사&nbsp;문화관광부&nbsp;굿네이버스&nbsp;서울시청&nbsp;포커스뉴스&nbsp;</div>
						</div>
					
					</div>
					
					
				</div>
			</div>	
			<!-- page END -->
			
			
			
		</div>
	</div>
</div>

	<style>
		.owl-theme .owl-nav.disabled+.owl-dots{margin-top:0px;position:absolute;bottom:0px;left:0;right:0;}
		.owl-theme .owl-dots .owl-dot span{margin:2px 3px;width:5px;height:5px;}

		.card-content .pic_wrapper{width:100%;}
		@media screen and (orientation:landscape) {
			.owl-carousel .item{height:auto !important;}
			.card-content .pic_wrapper{height:auto !important;}
			.card-content img{height:auto !important;}
			
		}

	</style>


<script>
var myApp = new Framework7({
	material: true,
	pushState : true,
});

var mainView = myApp.addView('.view-main');
var $$ = Dom7;


  
var w_width =  $(window).width();
var w_height = $(window).height();

var poster_info_anim_flag = true;
</script>



<script>

	
$(document).ready(function() {
	
	$.post("/statistics/step_comp/", {}, function(response){
		$("div[comp_prop='step_comp']").html(response);
	});
	 
	$.post("/marquee/main_1_comp/", {}, function(response){
		$("div[comp_prop='marquee_main_1_comp']").html(response);
	});
	
	$.post("/walk/posterlist_comp/", {}, function(response){
		$("div[comp_prop='poster']").html(response);
		
		resetUI();

		$(".owl-carousel").owlCarousel({
			items:1,
			loop:false,
			nav:false,
			dots:false,
			stagePadding: 55,
			margin: 20,
			onInitialized :function(){
				$(".owl-carousel .item").show();
				$("div[comp_prop='entrance_button']").find("a").attr("href",$(".owl-item").eq(0).find("a").attr("href"));
				$("div[comp_prop='entrance_button']").find(".walk_tit").text($(".owl-item").eq(0).find("h4").text());
				
			}
		});
		
		$(".owl-carousel").on('changed.owl.carousel', function(event) {
			$("div[comp_prop='entrance_button']").find("a").attr("href",$(".owl-item").eq(event.item.index).find("a").attr("href"));
			$("div[comp_prop='entrance_button']").find(".walk_tit").text($(".owl-item").eq(event.item.index).find("h4").text());
		
		});	
			
			
			
		$("div[comp_prop='poster_info']").each(function(){
			$(this).click(function(){
				if($(this).find("div[comp_prop='poster_info_a']").css('display') == 'block'){
					$(this).find("div[comp_prop='poster_info_a']").hide();
					$(this).find("div[comp_prop='poster_info_b']").show();
				}
				else{
					$(this).find("div[comp_prop='poster_info_a']").show();
					$(this).find("div[comp_prop='poster_info_b']").hide();
				}
			});
		});
	

		
	

	
	});
	
	
	$.post("/walk/getWishTrack/", {}, function(response){
		$("div[comp_prop='competit_dash']").html(response);
	});
	
	$.post("/magazine/magazine_comp/", { type:"h" }, function(response){
		$("div[comp_prop='magazine_comp']").html(response);
	});
	
	$.post("/event/walkMain/", {}, function(response){
		$("div[comp_prop='event_list']").html(response);
	});
	
	$.post("/promotion/checkinPreview/", {}, function(response){
		$("div[comp_prop='checkin_list']").html(response);
	});
	
	
	

				
	
});

$(window).resize(function(){
	resetUI();
});
 
function resetUI(){
	$(".owl-carousel .item").height($(window).height()-214+"px");
	$(".card-content .pic_wrapper").height($(window).height()-320+"px");
}
		 
</script>


