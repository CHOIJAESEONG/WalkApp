<!-- 트랙 정보 -->
<div class="track_title navbar">
	<div class="tit"><?=$contest_info[0]->제목?></div>
	<div class="share">알림</div>
</div>

<div class="track_content" style="background:url(<?=IMG_PATH?>MainActivity_2/track_bg.png);background-size:cover;">
	<div style="background:rgba(0, 0, 0, 0.5);">
		<!-- 오늘의 걸음수 -->
		<div class="walk_box" style="color:white;font-size:12px;color:#ababab;">
			<div style="position:relative;padding:10px 0px;">
				<div>오늘의 걸음수</div>
				<div id="step_cnt" style="font-size:25px;color:RGB(255,205,51)">0</div>
				<div style="position:absolute;left:20%;top:20px;"><img style="width:30px;" src="<?=IMG_PATH?>MainActivity_2/main_arrow_left.png"/></div>
				<div style="position:absolute;right:20%;top:20px;"><img style="width:30px;" src="<?=IMG_PATH?>MainActivity_2/main_arrow_right.png"/></div>
			</div>
		</div>
		
		<!-- 트랙 컴포넌트 -->
		<div class="track_box" >	
			<div class="canvas" style="width:100%;font-size:0px;">
				<canvas width='800' height='600' id='cv'/>
			</div>
			
			<div class="friend_comp" style="display:-webkit-box;height:60px;line-height:30px;padding:5px 20px;">
				<div style="width:80%;height:100%;text-align:left;overflow-x:scroll;overflow-y:hidden;">
					<div style="display:-webkit-inline-box;">
						<div style="height:100%;line-height:1em;margin:0px 5px;position:relative;"><img src="<?=IMG_PATH?>MainActivity_2/profile1.jpg" style="width:46px;height:46px;border-radius:30px;"/><p style="padding:0px;margin:0px;text-align:center;">최주현</p></div>
						<div style="height:100%;line-height:1em;margin:0px 5px;position:relative;"><img src="<?=IMG_PATH?>MainActivity_2/profile2.jpg" style="width:46px;height:46px;border-radius:30px;"/><img src="<?=IMG_PATH?>MainActivity_2/badge_red.png" style="position:absolute;bottom:10px;right:-5px;background:#101313;border-radius:20px;width:25px;"/><p style="padding:0px;margin:0px;text-align:center;">조현철</p></div>
						<div style="height:100%;line-height:1em;margin:0px 5px;position:relative;"><img src="<?=IMG_PATH?>MainActivity_2/profile3.jpg" style="width:46px;height:46px;border-radius:30px;"/><img src="<?=IMG_PATH?>MainActivity_2/badge_blue.png" style="position:absolute;bottom:10px;right:-5px;background:#101313;border-radius:20px;width:25px;"/><p style="padding:0px;margin:0px;text-align:center;">이병현</p></div>
						<div style="height:100%;line-height:1em;margin:0px 5px;position:relative;"><img src="<?=IMG_PATH?>MainActivity_2/profile.png" style="width:46px;height:46px;border-radius:30px;"/><p style="padding:0px;margin:0px;text-align:center;">이종호</p></div>

					</div>
				</div>
				
				<div style="width:10%;height:100%;text-align:left;">
					<div style="display:-webkit-inline-box;">
						<div style="height:100%;line-height:1em;margin:0px 5px;"><img src="<?=IMG_PATH?>MainActivity_2/profile.png" style="height:80%;"/></div>
					</div>
				</div>
				
			</div>
			
			<div comp_prop='marquee_main_2_comp'></div>
		</div>
	</div>
</div>


<!-- 진행 정보 -->
<div class="track_box_info" style="background-color:RGB(81,81,81);color:white;font-size:12px;padding:10px 0px;">		
	<div class="item rate" style="float:left;width:33.33333%">
		<div class="i1">진행률</div>
		<div class="i2"><?=$stat_info["rate"]?>%</div>
		<div class="i3">누적걸음(필수)</div>
	</div>
	<div class="item stamp" style="float:left;width:33.33333%">
		<div class="i1">스템프</div>
		<div class="i2"><?=$stat_info["stamp"]?></div>
		<div class="i3">핫스팟 방문(필수)</div>
	</div>
	<div class="item prize" style="float:left;width:33.33333%">
		<div class="i1">경품추첨권</div>
		<div class="i2"><?=$stat_info['prize'][0]->cnt?></div>
		<div class="i3">미션참여(선택)</div>
	</div>
</div>
<div style="clear:both;"></div>


<!-- 대회 정보 배너 -->
<div class="carousel-wrapper" style="color:white;background:#515151;">
	<div class="owl-carousel owl-theme">
		<div class="item"><img src="<?=IMG_PATH?>MainActivity_2/banner1.png" style="width:100%;"/></div>
		<div class="item" style="display:none"><img src="<?=IMG_PATH?>MainActivity_2/banner2.png" style="width:100%"/></div>
		<div class="item" style="display:none"><img src="<?=IMG_PATH?>MainActivity_2/banner3.png" style="width:100%"/></div>
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
var tracker 	= new Tracker();
setTimeout(function(){
	var w_height = $(window).height();
	var w_width  = $(window).width();
	
	var cv_height = ( w_height - $('canvas').offset().top ) - 223;
	if(w_width<360){
		cv_height *= 1.7
	}
	
	var stamp_arr 	= JSON.parse('<?=json_encode($stamp_info)?>');
	var checked_arr = JSON.parse('<?=json_encode($checked_info)?>');
	var stamp_pg 	= new Array();
	

	tracker.params.canvas.height = cv_height;
	tracker.params.track.logo 	 = "<?=경로_걷기대회?>cannon/logo.png";
	tracker.init();
	tracker.drawTrack();
	
	for(i=0;i<stamp_arr.length;i++){
		var checked = false;
		for(j=0;j<checked_arr.length;j++){
			if(checked_arr[j]['위시_id'] == stamp_arr[i]['위시_id']){ checked = true; break;}
			else{ checked = false; }
		}
		var rate 	= (stamp_arr[i]['위시기준']/stamp_arr[i]['목표걸음수'])*100
		tracker.drawStamp(stamp_arr[i]['위시_id'], stamp_arr[i]['위시제목'],checked,rate);
		stamp_pg.push(rate);
	}
	
	tracker.drawPin(<?=$stat_info['rate']?>,stamp_pg);
},100);

$.post("/marquee/main_2_comp/", {}, function(response){
	$("div[comp_prop='marquee_main_2_comp']").html(response);
	$("div[comp_prop='marquee_main_2_comp']").find("marquee").on("click",function(){ $(".toggle_btn").click(); });

});

$("div[comp_prop='contest_comp']").find(".track_box_info").find(".rate").on("click",function(){ $(".toggle_btn").click(); });
$("div[comp_prop='contest_comp']").find(".track_box_info").find(".stamp").on("click",function(){ myApp.pickerModal('.picker-get-stamp'); });
$("div[comp_prop='contest_comp']").find(".track_box_info").find(".prize").on("click",function(){ myApp.pickerModal('.picker-get-prize'); });

</script>



