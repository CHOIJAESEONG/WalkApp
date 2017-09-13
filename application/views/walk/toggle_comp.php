

<div class="toggle_box_content">

	<div id="view_time1" style="padding-top: 10px" value="
	<?php
		if($date_diff_day < 1){
			echo $current_event->d_total;
		}else{
			echo $current_event->d_day;
		}
	?>">참가기간:</div>

	<div class="item" style="float: left; width: 33.33333%">
		<div style="font-size: 12px;">목표걸음수</div>
		<div style="font-size: 20px; color: RGB(255, 205, 51);"><?=$alldata->목표걸음수?></div>
	</div>

	<div class="item" style="float: left; width: 33.33333%">
		<div style="font-size: 12px;">누적걸음수</div>
		<div style="font-size: 20px; color: RGB(255, 205, 51);">
		<?=$alldata->누적걸음수?>
																	
		</div>
	</div>

	<div class="item" style="float: left; width: 33.33333%">
		<div style="font-size: 12px;">진행률</div>
		<div style="font-size: 20px; color: RGB(255, 205, 51);"><?=$complete_percent?>%</div>
	</div>

	<div style="clear: both;"></div>


	<div id="view_time2" style="margin-top: 10px" value="<?=$current_event->s_day?>"></div>
		<div style="margin: 10px 0px; color: RGB(119, 147, 173); font-size: 12px;">완보성공지수: 불안</div>
		<div class="item" style="float: left; width: 33.33333%">
		<div style="font-size: 12px;">남은걸음수</div>
		<div style="font-size: 20px; color: RGB(255, 205, 51);">
		<?=$alldata->남은걸음수?>
		</div>
	</div>

	<div class="item" style="float: left; width: 33.33333%">
		<div style="font-size: 12px;">일평균걸음수</div>
		<div id = "aver_perday_id" style="font-size: 20px; color: RGB(255, 205, 51);">
		<?=$per_day_walking?>
		</div>
	</div>

	<div class="item" style="float: left; width: 33.33333%">
		<div style="font-size: 12px;">일평균 추천걸음수</div>
		<div id = "recom_perday_id" style="font-size: 20px; color: RGB(255, 205, 51);"><?=$recommand_per_walking?></div>
	</div>
	<div style="clear: both;"></div>

	<div id="pop_up_page" display="none"></div>

</div>

<!-- 토글 버튼 -->
<div class="toggle_box">
	<div style="height:7px;width:100%;background-color:black;">&nbsp;</div>
	<div class="toggle_btn">
		<div class="toggle_btn_line1"></div>
		<div class="toggle_btn_line2"></div>
	</div>		
</div>




<!-- 걸음 정보 -->
<div class="info_box">
	<div class="timer">
			<div class="i_day"></div>
			<div class="i_timer"></div>
	</div>
	<div class="i_comment">
		<div id="ticker-roll" class="ticker">
			<ul>
				<li>대회 종료 시까지 트랙을 완보 해야 합니다.</li>
				<li id="recom_perday_id2"></li>
			</ul>
		</div>
	</div>
</div>
						
<script>
	<?php 
		if($flag == 0){	//대회가 종료됬다면, 
	?>
			$('.toggle_box').addClass('end');
			$('.info_box').addClass('end');
			$('.info_box').find('.i_comment').html("<div>축하합니다!<br><?=$user_info['name']?>님은 완보에 성공하였습니다!</div>");
	<?php			
		}else{
		
	?>
		$('.toggle_box').addClass('ing');
		$('.info_box').addClass('ing');
	<?php			
		}
		
	?>

function calculate(diff){
	var currSec = 1; <?php // 밀리세컨 ?>
	var currMin = 60 ; <?php // 초 * 밀리세컨 ?>
	var currHour = 60 * 60 ; <?php // 분 * 초 * 밀리세컨 ?>
	var currDay = 24 * 60 * 60 ; <?php // 시 * 분 * 초 * 밀리세컨 ?>			

	var day = parseInt(diff/currDay); <?php //d-day 일 ?>
	var hour = parseInt(diff/currHour); <?php //d-day 시 ?>
	var min = parseInt(diff/currMin); <?php //d-day 분 ?>
	var sec = parseInt(diff/currSec); <?php //d-day 초 ?>
			
	var viewHour = "0";
	if(hour-(day*24) < 10){
		viewHour = viewHour.concat(String(hour-(day*24)));
	}else{
		viewHour = hour-(day*24);
	}
	
	var viewMin = "0";
	if(min-(hour*60) < 10){
		viewMin = viewMin.concat(String(min-(hour*60)));
	}else{
		viewMin = min-(hour*60);
	}
	
	var viewSec = "0";
	if(sec-(min*60) < 10){
		viewSec = viewSec.concat(String(sec-(min*60)));
	}else{
		viewSec = sec-(min*60);
	}
	
	var diff_time = new Array(4);
	diff_time[0] = String(day);		<?php //일 차이?>
	diff_time[1] = String(viewHour);<?php //시간 차이?>
	diff_time[2] = String(viewMin); <?php //분 차이?>
	diff_time[3] = String(viewSec); <?php //초 차이?>
	
	return diff_time;
}

$(document).ready(function() {	<?php //남은시간 = 대회종료일 - 현재 ?>
	setReaminTime = function (){ <?php //함수로 만들어 준다. ?>
    	var date_end = $("#view_time1").attr("value"); <?php //현재날짜 ?>
        var date_now = parseInt(new Date().getTime()/1000); <?php //월에서 1 빼줘야 함 ?>
                
        var diff = date_end - date_now;		
        var diff_time = calculate(diff);
        var temp = <?= $date_diff_day ?>;
		if(temp >= 1){
			diff_time[0] = temp;
		}
    	
		viewStr =  diff_time[0] +"   "+diff_time[1]+":"+diff_time[2]+":"+diff_time[3];

		if(<?=$flag?>== 0){	<?php //대회가 지났다면, ?>
			$("#view_time1").html("<span style='font-size: 13pt;'><b> -- </b></span>");
			$('.i_day').html("<span style='font-size: 12pt;'>-:</span><br>");
			$('.i_timer').html("<span style='font-size: 12pt;margin-right:100px;'>-:-</span><br>");
		}else{	<?php  //대회가 종료되지 않았다면  ?>
			$("#view_time1").html("<span style='font-size: 13pt;'><b> D-"+viewStr+"</b></span><br>");
			$('.i_day').html("<span><b> D-"+ diff_time[0] +"</b></span>");
			$('.i_timer').html("<span><b>"+ diff_time[1] + ":" + diff_time[2] + ":" +  diff_time[3]+ "</b></span>");
		}
		
	}
	
	setByTime = function(){	 <?php //지난시간 = 현재 - 대회시작일 ?>
		var date_start = $("#view_time2").attr("value"); <?php //현재날짜 ?>
		var date_now = parseInt(new Date().getTime()/1000); <?php //월에서 1 빼줘야 함 ?>
		var diff = date_now - date_start; //날짜 더하기
		var diff_time = calculate(diff);

		viewStr =  diff_time[0] +"   "+diff_time[1]+":"+diff_time[2]+":"+diff_time[3];
		
		$("#view_time2").html("<span style='font-size: 13pt;'><b> S-"+viewStr+"</b></span>");	
	}

	setReaminTime();
	setByTime();
	setInterval('setReaminTime()',1000);
	setInterval('setByTime()',1000);

	
});
</script>

