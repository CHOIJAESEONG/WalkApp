<div class="track_content" style="background:url(<?=IMG_PATH?>MainActivity_2/track_bg.png);background-size:cover;height:100%;">
	<div style="background:rgba(0, 0, 0, 0.8);height:100%;padding:0px 10%;">

		<div class="walk_box" style="color:white;font-size:12px;color:#ababab;padding-top:15px;">
			<div style="position:relative;padding:10px 0px;">
				<div style="font-size:25px;color:RGB(255,205,51)"><?=$event_info->완보여부?></div>
			</div>
		</div>
		
		
		<div style="color:white;font-size:12px;color:white;display:-webkit-box;padding-top:15px;line-height:3em;">
			<div style="width:50%;">
				<div style="font-size:20px;color:white;">기념품추첨대상</div>
				<div style="font-size:20px;color:RGB(255,205,51)"><?=$event_info->미션완료율=="0%" ? "NO":"YES"?></div>
				<div style="font-size:25px;color:white;"><?=$event_info->미션완료율?></div>
			</div>
			<div style="width:50%;">
				<div style="font-size:20px;color:white;">경품품추첨대상</div>
				<div style="font-size:20px;color:RGB(255,205,51)"><?=$event_info->Wish완료율=="0%" ? "NO":"YES"?></div>
				<div style="font-size:25px;color:white;"><?=$event_info->Wish완료율?></div>
			</div>
		</div>
		
		<div style="font-size:12px;color:white;height:50px;padding-top:15px;">
			<a href="/walk/prizeConfirm/" class="button button-raised button-fill color-pink external link" style="color:white;">당첨자 발표</a>
		</div>
		
		<div style="font-size:14px;color:white;padding-top:15px;text-align:left;line-height:1.5em;">
			<ul>
				<li>완보번호	: <?=$user_info['user_id']?></li>
				<li>참가자명	: <?=$user_info['name']?></li>
				<li>참가기간	: <?=$event_info->참가기간?></li>
				<li>걸음수		: <?=$event_info->평균걸음수?></li>
				<li>스탬프		: <?=$event_info->Wish?>/<?=$event_info->Wish수?></li>
				<li>경품추첨권	: <?=$event_info->미션수행?>/<?=$event_info->미션수?></li>
			</ul>
		</div>
		
		
		
		<div style="font-size:12px;color:white;margin-top:15px;border-top:1px solid #929292;">
			<a href="#" class="button button-raised color-gray" style="color:white;">세부내역더보기</a>
		</div>
		
		<div style="font-size:12px;color:white;margin-top:15px;max-height:50px;">
			<div class="carousel-wrapper" style="color:white;">
				<div class="owl-carousel owl-theme">
					<div class="item"><img src="<?=IMG_PATH?>MainActivity_2/banner1.png" style="width:100%;"/></div>
					<div class="item" style="display:none"><img src="<?=IMG_PATH?>MainActivity_2/banner2.png" style="width:100%"/></div>
					<div class="item" style="display:none"><img src="<?=IMG_PATH?>MainActivity_2/banner3.png" style="width:100%"/></div>
				</div>
			</div>
		</div>
		
		
		
	</div>
</div>

<script>
$(".owl-carousel").owlCarousel({
	items:1,
	loop:false,
	nav:false,
	dots:true,
	margin:0,
	onInitialized :function(){
		$(".owl-carousel .item").show();
	}
});


setTimeout(function(){
	$(".track_content").css("height", $(window).height() - $('.track_content').offset().top); 
},100);
</script>
