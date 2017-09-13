

<style>
div.selected_walk_event .clicked_event_list {
	position: static;
	font-size: 14px;
}

div.selected_walk_event #content_company {
	text-align: center;
	font-size: 14px;
}

div.selected_walk_event #content_title {
	text-align: center;
	font-size: 30px;
}

div.selected_walk_event #cotent_image {
	max-height: 200px;
	max-width: 300px;
	position: relative;
	display: block;
	margin-left: auto;
	margin-right: auto;
	border: 2px;
}

div.selected_walk_event #content_summary_info {
	position: relative;
	margin-left: auto;
	margin-right: auto;
	font-size: 12px;
	display: table;
	background-color: papayawhip;
    border-style: groove;
    border-radius: 10px;
    font-weight: 600;
}


div.selected_walk_event .event_summary {
	cursor: pointer;
	background: silver;
	margin: 5px;
	border-radius: 6px;
}

div.selected_walk_event #event_summary_detail {
	display: none;
}

div.selected_walk_event #event_course_detail {
	display: none;
}

div.selected_walk_event #event_prize_detail {
	display: none;
}

div.selected_walk_event #event_promotion_detail {
	display: none;
}

div.selected_walk_event #event_caution_detail {
	display: none;
}

div.selected_walk_event .event_course_info {
	cursor: pointer;
	background: silver;
	margin: 5px;
	border-radius: 6px;
}

div.selected_walk_event .event_prize_info {
	cursor: pointer;
	background: silver;
	margin: 5px;
	border-radius: 6px;
}

div.selected_walk_event .event_promotion_info {
	cursor: pointer;
	background: silver;
	margin: 5px;
	border-radius: 6px;
}

div.selected_walk_event .event_caution_info {
	cursor: pointer;
	background: silver;
	margin: 5px;
	border-radius: 6px;
}

div.selected_walk_event div.event_apply_button {
	cursor: pointer;
	margin-right: auto;
	margin-left: auto;
	text-align: -webkit-center;
	border: groove;
	height: 20px;
	background: steelblue;
	margin: 20px;
	border-radius: 6px;
}
</style>

<div class=selected_walk_event>
	<div class="clicked_event_list">
		<!--전체 리스트-->
		<div class="event_first_info">
			<!-- 첫번째 대회 정보 -->
			<div id="content_company"><?=$alldata[0]->머릿말 ?></div>
			<!--주최측-->
			<div id="content_title">
				<b> <?=$alldata[0]->제목?></b>
			</div>
			<!-- 제목 -->
			<img id="cotent_image" src="<?=경로_걷기대회.$alldata[0]->대회포스터 ?>"></img>
			<!-- 사진 -->
			<div id="content_summary_info">
				<!-- 신청기간 -->
				<p>신청기간 : <?= $alldata[0]->참여기간 ?> </p>
				<p>완보걸음 : <?=$alldata[0]->완보걸음?> </p>
				<p>경품 : <?= $alldata[0]->경품?> </p>
				<p>기념품 : <?= $alldata[0]->기념품?> </p>
			</div>
		</div>

		<div class="clicked_content_info">
			<div class="event_summary">
				<!-- 대회 개요 -->
				<b>대회개요 </b>
				<div id="event_summary_detail">
					<!-- 대회 개요 하위메뉴 -->
					<ul class="event_summary_top_detail">
						<li class="event_title_summary_detail">
							<span style="color:#3459e2;">대회명 :</span> 
							<span><?=$selectEvent[0]->제목 ?></span> 
						</li>
						<li class="event_title_summary_detail">
							<span style="color:#3459e2;">목표완보걸음 :</span> 
							<span><?=$selectEvent[0]->목표걸음수?></span> 
						</li>
						<li class="event_title_summary_detail">
							<span style="color:#3459e2;">진행일시 : </span>
							<span><?= $alldata[0]->참여기간 ?></span>
							<p style="margin-top:0px; margin-bottom:0px"><?= substr($selectEvent[0]->시작일시,10,20)?> 부터 접수</p>
						</li>
						<li class="event_title_summary_detail">
							<span style="color:#3459e2">경품/기념품 추첨일 : </span>
							<span> <?=$alldata[0]->추첨일?>	</span>
						</li>
						<li class="event_title_summary_detail">
							<span style="color:#3459e2">주최 : </span>
							<span> <?=$alldata[0]->주최?>	</span>
						</li>
						<li class="event_title_summary_detail">
							<span style="color:#3459e2">협찬 : </span>
							<span> <?=$alldata[0]->협찬?>	</span>
						</li>
					</ul>
				</div>
			</div>

			<div class="event_course_info">
				<!-- 코스안내 -->
				<b>코스안내</b>
				<div id="event_course_detail">
					<!-- 코스안내 하위메뉴 -->
					<p>- 본 대회는 4개의 위시와 4개의 미션으로 나뉘어 있습니다.</p>
					<p>- 위시는 약 2만보 달성 시 마다 확인할 수 있습니다.</p>
					<p>- 미션은 대회 중 무작위로 생성되며, 생성즉시 확인하실 수 있습니다.</p>
				</div>
			</div>

			<div class="event_prize_info">
				<!-- 경품 & 기념품 안내 -->
				<b>경품 &기념품안내</b>
				<div id="event_prize_detail">
					<!-- 경품 & 기념품 안내 하위메뉴 -->
					<ul class="event_prize_top_detail">
						<!--<li id="event_ranprize_summary_detail">
							<p style="color:#3459e2;">경품수 :</p>
							<p>총 <?=$selectEvent[0]->경품수 ?> 개<p>
						<li id="event_prize_summary_detail">
							<p style="color:#3459e2;">기념품수 : </p>
							<p>총 <?=$selectEvent[0]->기념품수 ?> 개</p>
						</li>-->
						<li id="event_ranprize_contents_detail">
							<p style="color:#3459e2;"> 경품 : </p>
							<p> <?= $alldata[0]->경품 ?></p>
						</li>	
						<li id="event_prize_contents_detail">
							<p style="color:#3459e2;"> 기념품 : </p>
							<p> <?= $alldata[0]->기념품 ?></p>
						</li>
					</ul>
				</div>
			</div>

			<div class="event_promotion_info">
				<!-- 체크인 프로모션 안내 -->
				<b>핫스팟안내</b>
				<div id="event_promotion_detail">
					<!-- 체크인 프로모션 안내 하위메뉴 -->
					<p>· 위치안내</p>
					<p>서울 삼성동 캐논 본사, 북촌 한옥마을, 선유도 공원 </p>
					<p>· 보상안내</p>
					<p>핫스팟 체크인 완료 시 경품추첨권 각 1장</p>
				</div>
			</div>

			<div class="event_caution_info">
				<!-- 유의사항 안내 -->
				<b>유의사항 안내</b>
				<div id="event_caution_detail">
					<!-- 유의사항 안내 하위메뉴 -->
					<p>-보행 중 충돌로 인한 신체부상 및 물품 훼손의 경우 본 대회와는 책임이 없으니 유의하시기 바랍니다.</p>
					<p>-대회 종료 전까지 완보하신 참가자 중 위시 및 미션을 해결하셔야 경품 및 기념품 추첨 대상에 포함됩니다.</p>
					<p>-부정한 방법으로 대회에 참여한 참가자는 별도 제재를 받을 수 있습니다.</p>
				</div>
			</div>
		</div>
		<div class="event_apply_button" value="<?=$selectEvent[0]->걷기대회_id?>">대회신청하기</div>
	</div>
</div>

<script>
      var cur_open = "";      //현재 열려있는 토글

      function toggleclose(submenu_class){
            $('#'+cur_open).animate({
                        opacity : "show", //투명도
                        height : "toggle",
                        queue : true
            })
            cur_open="";
      }
      
      function toggle_animate(move_menu){
  		if(cur_open!="" && cur_open!=move_menu){      //열려있는 토글이 현재 토글이 아니면,
              toggleclose(cur_open);  //열려있는 토글닫고,
              $('#'+move_menu).animate({    //다시 토글
                    opacity : "show", //투명도
                    height : "toggle",
              });
              cur_open = move_menu;
        	}
        	else if(cur_open==""){  //열려있는 토글이 없다면,
  	            $('#'+move_menu).animate({    //다시 토글
  	                  opacity : "show", //투명도
  	                  height : "toggle",
  	            });
  	            cur_open = move_menu;
  	      }else if(cur_open == move_menu){    //현재 열려있는 토글이 지금 토글이면,
  	            toggleclose(cur_open);  //열려있는 토글 닫기
  	      }
	  }
	  
      $(document).ready(function() {
            $('.clicked_content_info div').click(function() {
                  var submenu_check = $(this).attr('class');  //클래스 확인을 위함

                  if(submenu_check == "event_summary"){
                        var move_menu = "event_summary_detail";  //움직일 토글
                        toggle_animate(move_menu); 
                  }
                  else if (submenu_check == "event_course_info") {
                        var move_menu = "event_course_detail";  //움직일 토글
                        toggle_animate(move_menu); 
                  }
                  else if (submenu_check == "event_prize_info") {
                        var move_menu = "event_prize_detail";  //움직일 토글
                        toggle_animate(move_menu); 
                  }
                  else if (submenu_check == "event_promotion_info") {
                        var move_menu = "event_promotion_detail";  //움직일 토글
                        toggle_animate(move_menu); 
                  }
                  else if (submenu_check == "event_caution_info") {
                        var move_menu = "event_caution_detail";  //움직일 토글
                        toggle_animate(move_menu); 
                  }
            });
      });
  	$(".event_apply_button").on("click",function(){
    	location.href = "/walk/applyWalkEvent/"+$(this).attr("value");	//해당 url로 이동 -> user_id도 함께 넘겨야함.
	});
	
</script>

</html>

<?php
?>
