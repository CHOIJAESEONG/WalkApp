<link rel="stylesheet" href="<?=ADMIN_PATH?>css/MainActivity_2/init.css">
<script type="text/javascript" src="<?=ADMIN_PATH?>js/common/jcanvas.min.js"></script>
<script type="text/javascript" src="<?=ADMIN_PATH?>js/common/calc.js"></script>
<script type="text/javascript" src="<?=ADMIN_PATH?>js/common/tracker.js"></script>

<!-- Views -->
<div class="views">
	<div class="view view-main">
		<div class="pages">
			
			<!-- page -->			
			<div data-page="MainActivity_2" class="page" style="background:#fff;overflow:hidden;">	
				<div class="page-content" style="background:#0d0d0d;overflow-x:hidden;">
					<div class="page2">
						
						<!-- navbar -->	
						<div class="navbar" style="background:#0d0d0d;height:50px;box-shadow:0 3px 6px rgba(255, 255, 255, 0.1)">
							<div class="navbar-inner">
								
								<div class="left">
									<a href="#" class="link">
										<i class="icon icon-bars"></i>
									</a>
								</div>
								
								<div class="center">
									<a href="#" class="link" style="font-size:14px;">
										<?=$event_info[0]->제목?>
									</a>
								</div>
								
								<div class="right">
									<a href="#" class="link" style="font-size:14px;">
										닫기
									</a>
								</div>
								
							</div>
						</div>
						<!-- navbar END -->
						
						<!-- 토글 박스 내용 -->
						<div comp_prop="toggle_comp">	
						</div>
						
						<!-- 트랙 -->
						<div comp_prop="contest_comp">
						</div>
						
						<!-- 대회 댓글 -->
						<div comp_prop="comment" style="margin:5px;">
							
						</div>
						
						<!-- 축하메시지 -->
						<div comp_prop="cm_msg" class="cm_box" style="background:RGB(127,127,127);padding-bottom:5px;margin-top:15px;">	
						</div>
						<div style="clear:both;"></div>
						
						
						<!-- 매거진 -->
						<div comp_prop="magazine_comp" class="book_box" style="background:RGB(127,127,127);padding-bottom:5px;margin-top:15px;">
						</div>
						<div style="clear:both;"></div>
						
						
						<!-- 대회 간략 정보 -->
						<div comp_prop="summary" class="summary_box">
							
						</div>
						
					</div>
				
				</div>	
			</div>
			
			<div comp_prop="stamp_sheet_get" class="picker-modal picker-get-stamp" style="height:auto;background:#515151;color:white;">			
			</div>
			
			<div comp_prop="stamp_sheet_set" class="picker-modal picker-set-stamp" style="height:auto;background:#515151;color:white;">			
			</div>
			
			<div comp_prop="prize_sheet_get" class="picker-modal picker-get-prize" style="height:auto;background:#515151;color:white;">			
			</div>
			
			<div comp_prop="prize_sheet_set" class="picker-modal picker-set-prize" style="height:auto;background:#515151;color:white;">			
			</div>
			
			<div class="custom-toolbar toolbar toolbar-bottom" style="overflow:hidden">
				<div class="toolbar-inner toolbar1" style="transition:1s;">
				  <a href="#" class="link external">공지사항</a>
				  <a href="/walk/condition/" class="link external">대회현황</a>
				  <a href="/activity/MainActivity_2/" class="link external"><i class="f7-icons size-22">home_fill</i></a>
				  <a href="#" class="link external">커뮤니티</a>
				  <a href="/hotspot/hotspotListWithGoogleMap" class="link external">핫스팟</a>
				</div>
				
				<div class="toolbar-inner toolbar2" style="top:50px;transition:1s;">
				  <a href="/activity/MainActivity_2/index/1" class="link external">진행중</a>
				  <a href="/activity/MainActivity_2/index/0" class="link external">완보시</a>
				  <a href="#" class="link external" onClick="temp_Mission();">미션받기</a>
				  <a href="/content/deleteWish/" class="link" onClick="setTimeout(function(){ location.reload(); },300);">초기화</a>
				  <a href="#" class="link external" onClick="temp_Move();">걸음수+10</a>
				</div>
				
				<a href="#" class="link customlink"><i class="f7-icons">more_vertical</i></a>
			</div>
			
			
			
			
			
			
		</div>
	</div>
</div>


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
	var isVisible_toggle_box=false;
	var contest_state = <?=$contest_state?>;
	
	$(document).ready(function(){
		
		$.post("/walk/toggle_comp/", { contest_state : contest_state }, function(response){
			$("div[comp_prop='toggle_comp']").html(response);
			
			$(".toggle_btn").click(function(){
				if(!isVisible_toggle_box){ 
					isVisible_toggle_box=true;
					$(".toggle_box_content").slideDown();
					$(".info_box").css("display","none");
				}
				else{
					isVisible_toggle_box=false;
					$(".toggle_box_content").slideUp();
					$(".info_box").css("display","table");
					
				}
			});
		});
		
		if(contest_state==0){
			$.post("/activity/MainActivity_2/contest_comp/", { contest_state : contest_state }, function(response){ 
				$("div[comp_prop='contest_comp']").html(response); 
				
				
			});
		}
		else if(contest_state==1){
			$.post("/activity/MainActivity_2/contest_comp/", { contest_state : contest_state }, function(response){
				$("div[comp_prop='contest_comp']").html(response);
			});
		}
		
		$.post("/actionsheet/getstamp_sheet/", {}, function(response){
			$("div[comp_prop='stamp_sheet_get']").html(response);
		});
		
		$.post("/actionsheet/getprize_sheet/", {}, function(response){
			$("div[comp_prop='prize_sheet_get']").html(response);
		});
		
		
		$.post("/board/comment_comp/", {}, function(response){
			$("div[comp_prop='comment']").html(response);
		});
		
		// $.post("/message/celMessage_comp/", {}, function(response){
			// $("div[comp_prop='cm_msg']").html(response);
		// });
		
		// $.post("/magazine/magazine_comp/", { type : "v" }, function(response){
			// $("div[comp_prop='magazine_comp']").html(response);
		// });
		
		
		// $.post("/walk/summary_comp/", {}, function(response){
			// $("div[comp_prop='summary']").html(response);
			
			// $(".summary_box .btn_info").each(function(idx){
				// $(this).click(function(){
					// $(".summary_box .content_box").hide();
					// $(".summary_box .content_box:eq("+idx+")").fadeIn();
				// });
			// });
		
		
		// });
		var toolbar_flag = true;
		$(".customlink").on("click",function(){
			if(toolbar_flag){
				$(".toolbar1").css("top","-50px");
				$(".toolbar2").css("top","0px");
				toolbar_flag = false;
			}else{
				$(".toolbar1").css("top","0px");
				$(".toolbar2").css("top","50px");
				toolbar_flag = true;
			}
			
		});
		

	});
	function temp_Mission(){
		$.post("/actionsheet/setprize_sheet/", {}, function(response){
			$("div[comp_prop='prize_sheet_set']").html(response);
			myApp.pickerModal('.picker-set-prize');
			$("#set_prize").on("click",function(){ /*location.href = "/content/mission/"+obj.id;*/ });
			
		});
	}
	
	var cnt = 0;
	function temp_Move(){
		var temp_rate = tracker.params.progress.step;
		var temp_stemp = tracker.params.pin.arr;
		tracker.drawPin(temp_rate+10,temp_stemp);
		cnt += 1000;
		$("#step_cnt").text(cnt);
	}
</script>