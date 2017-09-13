<?php
	if(empty($alldata->로고)) $src = "";
	else $src = 경로_걷기대회.$alldata->로고; 
?>

<style media="screen">
	.background_image{
		background-image: url("<?=$src?>");
    	background-repeat:no-repeat;
		background-position:center;
		background-origin:content-box;
		background-size: 90%;
		opacity: 0.7!important;
		filter:alpha(opacity=30);
		width: 94%;
		height: 100%;
		position: absolute;
	}
    .container{
    	
        height: 100%;
        width: 100%;
        margin: 0;
    }
    .header{
        text-align: center;
        color: white;
        background-color: black;
        padding: 2%;
    }
    .header span{
        width: 10%;
        float: left;
    }
    .header p{
        margin: 0;
    }
    .article{
        position: relative;
        margin: 2.5%;
        opacity: 1.0!important;
    }
    .subtitle{
        position: relative;
        text-align: center;
        font-size: 12px;
        padding : 3%;
    }
    .condition{
        text-align: center;
    }
    .condition p{
        margin : 0;
        margin-bottom: 2%;
    }
    .condition .entry{
        width: 25%;
        display: inline-block;
        margin-bottom: 2.5%;
    }
    .tab{
        text-align: center;
    }
    .mytab{
        padding: 2%;
        background-color: gray;
        width: 43%;;
        display: inline-block;
    }
    .info{
        margin: 3%;
    }
    .info p{
        margin: 1%;
        font-size: 12px;
    }
    #my_opp{
        text-align: center;
    }
    .opp{
        text-align: center;
        margin:auto;
        width: 40%;
        display: inline-block;
    }
    .check{
        color: white;
        text-align: center;
        padding: 1.5%;
        margin: auto;
        width: 91%;
        background-color: red;
        cursor: pointer;
    }
    #bottom_box{
        border: 1px solid blue;
        padding: 1.5%;
    }
    .highlight{
        margin: auto;
        margin-top: 2%;
        color: white;
        text-align: center;
        padding: 1.5%;
        background-color: gray;
    }
    .check_list{
        list-style-type : circle;
        padding-left: 6%;
        padding-bottom: 2%;
        position: relative;
        font-size: 12px;
    }
    .prize_button{
        border: 1px solid black;
    }
    .off{
        display: none;
    }
    .bold{
        font-weight: bold;
    }
    img.logo{
    	position: relative;
   		width: 20%;
    }
</style>

<div class="background">
	<div class="background_image">
	</div>
	<div class="container">
	    <div class="header">
	        <span></span>
	        <p>대회현황</p>
	    </div>
	    <div class="article">
	        <div class="subtitle">
	            <img class="logo" src="<?=경로_걷기대회.$alldata->로고?>">
	        <p>캐논에서 대회현황을 알려드립니다.</p>
	        </div>
	        <hr>
	        <div class="condition">
	            <p>전체 참가자 현황</p>
	            <div class="entry">
	                <p>참가자수</p>
	                <p><?=$alldata->참가자수 ?>명</p>
	            </div>
	            <div class="entry">
	                <p>완보자 수</p>
	                <p><?=$alldata->완보자수?>명</p>
	            </div>
	            <div class="entry">
	                <p>완보율</p>
	                <p><?=$alldata->완보율?></p>
	            </div>
	        </div>
	        <div class="tab">
	            <div class="mytab" id="info">
	               	 나의 참가현황
	            </div>
	            <div class="mytab" id="opp">
	                	당첨확률
	            </div>
	        </div>
	        <div class="info" id="my_info">
	            <p>참가번호 : <?= $user_id?> (완보번호 : <?= $user_id?>)</p>
	            <p>참가자명 : <?= $user_name?></p>
	            <p>참가기간 : <?= $alldata->유저참가신청일시?> ~ <?php if($end_state==1){ echo $alldata->종료일시;}else{echo date("Y-m-d");}?>(<?=$user_prt_day?>일)</p>
	            <p>누적걸음수 : <?= $alldata->누적걸음수?> (남은걸음수 : <?= $alldata->남은걸음수?>)</p>
	            <p>진행률 : <?= $alldata->진행률?></p>
	            <p>스템프 : <?= $alldata->유저위시개수?>/<?= $alldata->위시개수?></p>
	            <p>경품추첨권 : 2</p>
	            <p>핫스팟 : <?= $alldata->유저핫스팟개수?></p>
	        </div>
	        <div class="info off" id="my_opp">
	            <div class="opp">
	                <p style=" margin : 0">나의 기념품 당첨확률</p>
	                <p style="margin-top : 1%; margin-bottom : 1%;">0%</p>
	                <p style="margin : 0; margin-bottom : 5%;">평균 00%</p>
	                <div class= "prize_button">기념품보기</div>
	            </div>
	            <div class="opp">
	                <p style=" margin : 0">나의 경품 당첨확률</p>
	                <p style="margin-top : 1%; margin-bottom : 1%; ">10.6%</p>
	                <p style="margin : 0;  margin-bottom : 5%;">평균 00%</p>
	                <div class= "prize_button">경품보기</div>
	            </div>
	            <div style="text-align : left; font-size : 12px;">
	                * 대회기간 내에 완보하지 못하면 추첨대상에서 제외됩니다.
	            </div>
	        </div>
	        <div class="check">
	        	당첨자발표확인
	        </div>
	        <div class="info">
	            <div class="info_walk" id="info_walk">
	                <div id="bottom_box">
	                    <p>대회기간 : <?= $alldata->대회기간?> (<?= $date_diff_day ?>일)</p>
	                    <p>기념품/경품 추첨일 : <?= $alldata->추첨일?></p>
	                    <p>목표걸음수 : <?= $alldata->목표걸음수?></p>
	                    <p>위시스템프 : <?= $alldata->위시개수?></p>
	                    <p>핫스팟 : <?= $alldata->핫스팟개수?></p>
	                    <p>기념품 수량 : <?= $alldata->기념품수 ?></p>
	                    <p>경품수량 : <?= $alldata->경품수 ?></p>
	                </div>
	                <div class="highlight">
	                    대회개요 자세히보기->
	                </div>
	                <ul class="check_list">
	                    <li>대회기간 내에 목표걸음을 도달해야 완보로 처리됩니다.</li>
	                    <li>하루최대 2만보까지만 걸음수가 체크됩니다.</li>
	                </ul>
	            </div>
	
	            <div class="info_prize off" id="info_prize">
	                <div class="highlight">기념품 추첨기준</div>
	                <ul class="check_list">
	                    <li>대회기간 내에 목표걸음을 완보한 참가자만 추첨기회가 주어집니다.</li>
	                    <li>위시스템프를 모두 휙득해야만 추첨기회가 주어집니다.</li>
	                    <li>준비한 기념품 수량보다 완보자가 많으면 랜덤으로 추첨합니다.</li>
	                </ul>
	                <div class="highlight">경품 추첨기준</div>
	                <ul class="check_list">
	                    <li>대회기간 내에 목표걸음을 완보한 참가자만 추첨기회가 주어집니다.</li>
	                    <li>위시스템프를 모두 휙득해야만 추첨기회가 주어집니다.</li>
	                    <li>준비한 경품 수량보다 완보자가 많으면 랜덤으로 추첨합니다.</li>
	                </ul>
	            </div>
	        </div>
	    </div>
	</div>
</div>

<script>
    $(document).ready(function() {
        $("#info").click(function(){
            $("#my_info").removeClass("off");
            $("#info_walk").removeClass("off");
            $("#my_opp").addClass("off");
            $("#info_prize").addClass("off");
        });
        $("#opp").click(function(){
            $("#my_opp").removeClass("off");
            $("#info_prize").removeClass("off");
            $("#my_info").addClass("off");
            $("#info_walk").addClass("off");
        });
    });

    
	$("div.check").on("click",function(){
		location.href = "/walk/prizeConfirm/"
	});

	
</script>
