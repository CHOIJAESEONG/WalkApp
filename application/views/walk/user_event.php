<style>
.user_event .top_vanner{
	position: absolute;
    width: 96%;
    height: 60px;
    background: royalblue;
    text-align: -webkit-center;
}

.top_vanner #dday,#dtime,#dsec{
	color: white;
}
.top_vanner #dtime{
	font-size:20px;
}

.user_event #panorama_track{
	position: absolute;
    width: 96%;
    color: white;
    top: 20%;
    background: black;
    height: 5%;
    text-align: -webkit-center;
}

.middle_content{
    position: absolute;
    width: 96%;
    top: 25%;
    height: 75%;
    background: grey;
}

.middle_content #walk_state{
	text-align: center;
	font-size : 25px;
}

.middle_content .prize_state{
	position: relative;
    height: 25%;
    width:100%;
}
.prize_state .left_state, .right_state{
	position: relative;
    width: 48%;
    float: left;
    padding-bottom: 10%;
    text-align: center;
}

.prize_user_show_btn{
	text-align: center;
    background: #9f5959;
    cursor: pointer;
}

.user_info_detail{
	margin: 10px;
    color: white;
    font-size: 13px;
}

</style>

<div class="user_event">
	<div class="top_vanner">
		<span id="dday">D-<?= $diff_day?> </span>
		<span id="dtime"><?= $diff_time?></span> 
		<span id="dsec"></span> 
		<p>기념품/경품 추첨일</p>
	</div>
	<div id="panorama_track">
		파노라마 트랙
	</div>
	<div class="middle_content">
		<div class="walk_success_state">
			<p id="walk_state"></p>
		</div>	
		<div class="prize_state">
			<div class="left_state"> 
				<p style="margin: 0px;">기념품 추첨 대상</p>
				<p style="margin: 0px;"></p>
				<p style="margin: 0px;">47.5%</p>
			</div>
			<div class="right_state">
				<p style="margin: 0px;">경품 추첨 대상</p>
				<p style="margin: 0px;"></p>
				<p style="margin: 0px;">30.5%</p>
			</div>
		</div>
		<div class="prize_user_show_btn">
			당첨자 발표보기
		</div>
		<div class="user_info_detail">
			<p style="margin:0px">
				<span>완료번호 : </span>
			</p>
			<p style="margin:0px">
				<span>참가자명 :  </span>
			</p>
			
			<p style="margin:0px">
				<span>참가기간 :  </span>
			</p>
			
			<p style="margin:0px">
				<span>걸음수 : </span>
			</p>
			<p style="margin:0px">
				<span>스템프 : </span>
			</p>
			
			<p style="margin:0px">
				<span>경품추첨권 : </span>
			</p>
			
			
		</div>
		
	</div>
</div>



