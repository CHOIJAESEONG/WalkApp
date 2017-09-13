<style>
.popup_page{
	position: absolute;
    margin: 12%;
    background-color: white;
    width: 70%;
    height: 80%;
    border: 3px solid black;
    border-radius: 10px;
}
.popup_page .top_info{
	position: relative;
    width: 100%;
    height: 15%;
    background-color: white;
    border-bottom: 3px solid black;
    text-align: center;
    top: 2%;
}

.popup_page .middle_info{
	position: relative;
    width: 100%;
    height: 37%;
    background-color: white;
    border-bottom: 3px solid black;
    text-align: -webkit-auto;
}
.popup_page .bottom_info{
	position: relative;
    width: 100%;
    height: 36%;
    background-color: white;
    border-bottom: 3px solid black;
    text-align: -webkit-auto;
}

.popup_page .ok_button{
	position: absolute;
    width: 100%;
    height: 8%;
    background-color: #f3f35d;
    border-bottom: 3px solid black;
    text-align: center;
    font-size: 14px;
    font-weight: 800;
    border-radius: 10px;
    cursor: pointer;
    
}

.popup_page .target_walking_num{
	width: 30%;
    background-color: #ffc107;
    height: 52%;
    border: 3px solid;
    text-align: center;
    position: absolute;
}

.popup_page .day_per_aver_walking{
	width: 30%;
    background-color: #ffc107;
    height: 52%;
    position: absolute;
    margin-left: 34%;  
    border: 3px solid;
    text-align: center;   
}

.popup_page .complete_walking{
	width: 30%;
    background-color: #ffc107;
    height: 52%;
    position: absolute;
    margin-left: 68%;
    border: 3px solid;
    text-align: center;
}

.popup_page .rank_of_people{
	position: relative;
    height: 20%;
    top: 60%;
    font-size: 10px;
    font-weight: bold;
    width: 70%;
}

.popup_page .show_complete_viwer{
	position: relative;
    height: 15%;
    top: 40%;
    font-size: 12px;
    font-weight: bold;
    width: 35%;
    left: 66%;
    cursor: pointer;
    text-align: -webkit-center;
}

.popup_page .mission_num{
	position: absolute;
    width: 70%;
    height: 12%;
    background-color: antiquewhite;
    font-size: 14px;

}

.popup_page .numof_val{
	position: absolute;
    left: 70%;
    width: 30%;
    height: 12%;
    font-size: 14px;
    background: bisque;

}

.popup_page .checkin_success{
	position: absolute;
    width: 70%;
    height: 12%;
    background-color: antiquewhite;
    font-size: 14px;
    margin-top: 10%;
}

.popup_page .chechin_val{
	position: absolute;
    left: 70%;
    width: 30%;
    height: 12%;
    font-size: 14px;
    background: bisque;
    margin-top: 10%;
}

.popup_page .hotspot_success{
	position: absolute;
    width: 70%;
    height: 12%;
    background-color: antiquewhite;
    font-size: 14px;
        margin-top: 21%;
}

.popup_page .numof_hotspot{
	position: absolute;
    left: 70%;
    width: 30%;
    height: 12%;
    font-size: 14px;
    background: bisque;
    margin-top: 21%;
}

.popup_page .suc_mission_num{
	position: absolute;
    width: 70%;
    height: 12%;
    background-color: antiquewhite;
    font-size: 14px;
    margin-top: 31%;
}

.popup_page .suc_mission_val{
	position: absolute;
    left: 70%;
    width: 30%;
    height: 12%;
    font-size: 14px;
    background: bisque;
    margin-top: 31%;
}

.select_popup_page{
	width: 85%;
    height: 120px;
    border: 3px solid;
    border-radius: 10px;
    font-weight: bold;
    position: relative;
    margin: 10px;
    margin-left: auto;
    margin-right: auto;
}

.select_popup_page .ment_post_btn{
	cursor: pointer;
    border: 1px solid;
    position: absolute;
    background: gold;
    width: 49%;
    display: block;
    bottom: 0px;
    left: 0px;
    text-align: center;
    border-bottom-left-radius: 6px;
 
}

.select_popup_page .exit_event_btn{
	cursor: pointer;
    border: 1px solid;
    position: absolute;
    background: gold;
    width: 50%;
    display: block;
    left: 49%;
    bottom: 0px;
    text-align: center;
    border-bottom-right-radius: 6px;
    
}

.select_popup_page .btns{
	position: absolute;
    background: gold;
    bottom: 0px;
    width: 100%;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    border: 1px solid;
}

.user_preserve_popup{
	position: absolute;
    margin-left: auto;
    margin-right: auto;
    top: 40%;
    width: 96%;
    height: 50%;
    background: darkgray;
    border: 3px solid;
    border-radius: 8px;
    display : none;
    
}

.user_preserve_popup .top_user_preserve_popup{
	position: relative;
    width: 100%;
    height: 25%;
    background: bisque;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    border-bottom: 1px solid;
    text-align: -webkit-center;  
}

.user_preserve_popup .middle_user_preserve_popup{
	position: relative;
    width: 100%;
    height: 60%;
    background: bisque;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    border-bottom: 1px solid;
    text-align: -webkit-center;  
}


.user_preserve_popup .bottom_user_preserve_popup{
	position: relative;
    width: 100%;
    height: 14.5%;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    border-bottom: 1px solid;
    text-align: -webkit-center;  
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
    background: gold;
}

.bottom_user_preserve_popup .left_bt{
	width: 49%;
    position: absolute;
    left: 0;
    height: 100%;
    border-right: 1px solid;
    cursor: pointer;
}

.bottom_user_preserve_popup .right_bt{
	width: 59%;
    position: absolute;
    height: 100%;
    left: 47%;
    cursor: pointer;
}

.event_poster{
    height: 50px;
    max-width: 100px;
    width: 80px;
    max-height: 100%;
}

.event_name{
	font-size: 14px;
}

.event_day{
    font-size: 14px;
}

.event_st{
	font-size:14px;
}

</style>

<div class="popup_page">
	<div class="top_info">
		<span style="font-size: 20px"><b>축하합니다.<br></b></span>
		<span style="font-size: 13px">대회의 목표걸음을 완보하셨습니다.</span>
	</div>
	
	<div class="middle_info">
		<p style="font-size: 10px; margin-left: 10%; "><b>나의 참여 기록 </b></p>
		<div class="target_walking_num">
			<p style="font-size: 10px;"><?= $middle_view->목표걸음수 ?> 보</p>
			<p style="font-size: 10px;">대회 목표 걸음수</p>
		</div>
		<div class="day_per_aver_walking">
			<p id ="day_of_aver_walking" style="font-size: 10px;"> <?= $middle_view->평균걸음수 ?> 보</p> 
			<p style="font-size: 10px;">일일 평균 걸음수</p>
		</div>
		<div class="complete_walking">
			<p style="font-size: 10px;"><?= $middle_view->소요일?> </p>
			<p style="font-size: 10px;">완보 소요일</p>
		</div>
		<div class="rank_of_people"> <?= $middle_view->완보랭킹 ?>번째 완보자 입니다. </div>
		<div class="show_complete_viwer"> 완료증 보기> </div>
	</div>
	
	<div class="bottom_info">
		<p style="font-size: 10px; margin-left: 10%;"><b>미션 참여</b></p>
		<p>
			<span class="mission_num"> 성공 미션수</span>
			<span class="numof_val"> <?= $middle_view->미션수행 ?> 개</span>
		</p>
		<p>
			<span class="suc_mission_num"> 완료한 미션</span>
			<span class="suc_mission_val"> <?= $middle_view->미션수행 ?> (<?= $middle_view->미션완료율 ?>)  </span>
		</p>
		<p>
			<span class="checkin_success"> Wish 스템프  성공여부</span>
			<span class="chechin_val"> <?= $middle_view->체크인성공여부 ?> </span>
		</p>
		<p>
			<span class="hotspot_success"> 완료한 Wish</span>
			<span class="numof_hotspot"> <?= $middle_view->Wish ?> (<?= $middle_view->Wish완료율 ?>) </span>
		</p>		
	</div>
	
	<div class="ok_button" onclick="select_popup()">
		확인
	</div>
	
</div>

<div class='select_popup_page' style="display:none">
	<div class = 'message_comp'>
		<p style="text-align: center;">대회가 종료되었습니다.</p>
		<p style="text-align: center;">참가 후기를 남기시겠습니까 ? </p>
		<div class="btns">
			<span class='ment_post_btn'>후기남기기</span>
			<span class='exit_event_btn' onclick='preserve_popup()'>대회종료하기</span>
		</div>
	</div>
</div>


<div class='user_preserve_popup' >
	<div class='top_user_preserve_popup'>
		<p style="margin:0px"> 현재 <?= $count ?> 개의 찜한 대회가 있습니다.	</p>
		<p>	어떤 대회에 참가 하시겠습니까? </p>
	</div>
	<div class= 'middle_user_preserve_popup' >
		<div class='user_preserve_item'>
			<ul style="margin: 0px; padding:0px;">
				<?php 
				foreach ($preserveEvent as $row){?>
				<li style="list-style-type: none;">
					<img class='event_poster' src= <?= 경로_걷기대회.$row->대회포스터 ?> ></img>
					<span class='event_name'> <?= $row->제목?> <br></span>
					<span class='event_day'> <?= $row->시작일시 ?>~<?=$row->종료일시?><br></span>
					<span class='event_st'> <?= $row->진행여부?>	</span>
				
				</li>
				<?php 
				}
				?>
				
			</ul>		
		</div>
	</div>
	<div class= 'bottom_user_preserve_popup'>
		<span class='left_bt'>참가 신청하기</span>
		<span class='right_bt'>바로 종료하기</span>
	</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
	function select_popup(){
		$('.popup_page').css('display','none');
		$('.select_popup_page').css('display','block');
	}

	function preserve_popup(){
		$('.select_popup_page').css('display','none');
		$('.user_preserve_popup').css('display','block');
		
	}
</script>




