<!DOCTYPE html>
<html lang="ko" class="">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no,target-densitydpi=medium-dpi"/>
	
	<!-- 공통 스타일 -->
		<link rel="stylesheet" href="/mnt/walk/common/css/framework7.material.min.css">
	<link rel="stylesheet" href="/mnt/walk/common/css/framework7.material.colors.min.css">
	<link rel="stylesheet" href="/mnt/walk/common/css/framework7-icons.css">
	<link rel="stylesheet" href="/mnt/walk/common/css/common.css?t=1">
	<title>참가현황 통계</title>

	<style>
		.myStaticPage_wrapper .menu .active{
			font-weight:bold !important;
		}
		.myStaticPage{display:none;}
		.myStaticPage_1 .mythumb {margin:10px auto;width:80px;height:80px;overflow:hidden;display:block;border-radius:80px;text-align:center;}
		.myStaticPage_1 .mythumb img{width:80px;height:80px;}
		.myStaticPage_1 .myName {font-size:20px;text-align:center;}
		.clear{clear:both;}
		.history table{border-collapse: collapse;}
		.history table td{border:1px solid #cdcdcd;line-height:15px;width:16.6666%;padding:5px 0px;}
		.step_down {
			padding-left:10px;
			color:#005de4;
			background: url(http://img.focus.kr/mnt/webdata/SERVICE/cdn/b2c/images/stockinfo/ico_down1.gif) no-repeat 0 5px;
		}
		.step_up {
			padding-left:10px;
			color:#fb261a;
			background: url(http://img.focus.kr/mnt/webdata/SERVICE/cdn/b2c/images/stockinfo/ico_up1.gif) no-repeat 0 5px;
		}
		.myBanner{font-weight:normal;margin:5px;background-color:RGB(91,155,213);color:white;font-size:18px;padding:10px 0px;text-align:center;}
		.detail_info table{border-collapse: collapse;width:100%;font-size:12px;color:#ababab;}
		.detail_info table td{border:1px solid white;line-height:15px;width:50%;padding:5px 0px;text-align:left;}
	</style>

</head>
<body style="overflow:auto;">
	<div class="myStaticPage_wrapper">
		<div class="navbar" style="background:#ababab;height:40px;line-height:40px;box-shadow:0 3px 6px rgba(255, 255, 255, 0.1)">
			<div class="navbar-inner">
				<div class="center" >
					← 참가현황 통계
				</div>
				
				<div class="right">
					<a href="#" class="link">
						<i class="icon icon-bars"></i>
					</a>
				</div>			
			</div>
		</div>					
		

		<div class="menu" style="height:25px;line-height:25px;border-bottom:1px solid #cdcdcd;">
			<div style="height:20px;line-height:20px;margin-top:10px;">
				<div class="tab active" style="margin-left:-1px;float:left;width:50%;text-align:center;">나의 대회 참여 통계</div>
				<div class="tab" style="border-left:1px solid #cdcdcd;float:left;width:50%;text-align:center;">대회 참가 현황 통계</div>
			</div>
		</div>
		<div class="clear"></div>
		
		<?php
						
						$for_i=0;
						
						$마지막걸은날짜;
						$남은걸음수;
						$기준날짜;
						$누적걸음수;
						$진행률;
						$걷기시작일="-";
						$테이블데이터="<tr>
						<td>날짜</td>
						<td>걸음 수</td>
						<td><div>누적</div><div>걸음 수</div></td>
						<td><div>남은</div><div>걸음 수</div></td>
						<td>진행률</td>
						<td><div>전일</div><div>대비</div><div>증감</div></td>
						";
						
						foreach($myTable_Step_Data as $item){							
							$updown="";
							if($item->증감<0)
								$updown='<span class="step_down">'.abs($item->증감)."</span>";	
							else{
								$updown='<span class="step_up">'.abs($item->증감)."</span>";	
							}
							
							if($for_i==0){
								$updown="-";								
								$걷기시작일= @$item->원본날짜;
														
							}
							
							$테이블데이터 .='<tr>
							<td>'.$item->날짜.'</td>
							<td>'.$item->걸음수.'</td>
							<td>'.$item->누적걸음수.'</td>
							<td>'.$item->남은걸음수.'</td>
							<td>'.$item->진행률.'</td>
							<td>'.$updown.'</td>
							</tr>';
							
							$남은걸음수 = $item->원본남은걸음수;
							$누적걸음수 = $item->누적걸음수;
							$진행률 = $item->원본진행률;
							$기준날짜 = $item->원본날짜;
							$마지막걸은날짜 = $item->무형식원본날짜;
							$for_i++;
						}						
					?>
					
		<div class="myStaticPage_1 myStaticPage">
			<div class="myInfo">
				<div class="mythumb"><img src="<?=$myInfo["USER_PIC"]?>" alt=""/></div>
				<div class="myName"><?=$myInfo["USER_NAME"]?></div>
				<div class="myDate" style="margin-top:10px;">
					<div style="margin-left:-1px;float:left;width:50%;">
						<div style="margin-left:10%;text-align:center;border-bottom:1px solid #555;padding-bottom:6px;">
							<div>참가신청일</div>
							<div style="color:RGB(42,189,242);">
							<?php 
								if(@$myTable_TournamentStart[0] ===NULL){
									echo "-";
								}
								else{
									echo @$myTable_TournamentStart[0]->참가신청일시;
								}
							?></div>
						</div>
					</div>
					<div style="float:left;width:50%;">
						<div style="margin-right:10%;border-left:1px solid #555;text-align:center;border-bottom:1px solid #555;padding-bottom:6px;">
							<div>걷기시작일</div>
							<div style="color:RGB(42,189,242);"><?=$걷기시작일?></div>
						</div>			
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<div class="history" style="text-align:center;margin:10px 5px;">
				
				<table style="table-layout:fixed;width:100%;">
					<?=$테이블데이터?>
				
				</table>		
				<div style="margin-top:15px">
					<?php
						$대회종료일시 =  $myTable_TournamentInfo[0]->종료일시;
						//echo $대회종료일시;
						//echo "<br>";
						//echo $마지막걸은날짜;
						
						
						$시작일 = @new DateTime(@$마지막걸은날짜===NULL?$대회종료일시:$마지막걸은날짜); // 20120101 같은 포맷도 잘됨
						$종료일 = @new DateTime($대회종료일시);
						 
						// $차이 는 DateInterval 객체. var_dump() 찍어보면 대충 감이 옴.
						$남은일자    = date_diff($시작일, $종료일);
						 
						echo "대회 종료일까지 <span style='color:red;font-weight:bold;font-size:16px;'>". $남은일자->days."</span>일 남았습니다."; 	
						echo "<br>";
						echo "하루에 <span style='color:blue;font-weight:bold;font-size:16px;'>".@number_format(ceil($남은걸음수/$남은일자->days),0)."</span>을 걸으시면 완주가 예상됩니다.";
					?>
				</div>
				<div>
					<div style="margin:10px;font-size:12px;text-align:left;">
						<div>
						* 금일 이후의 수치는 참가자님의 평균 걸음 데이터를 분석하여 
						대회 종료일까지의 일일 추천 걸음수를 안내해 드립니다.
						</div>
						<div style="margin-top:5px">
						* 일일 데이터는 전일 자정~금일 자정까지의 걸음데이터로 반영됩니다.
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="myStaticPage_2 myStaticPage">		
			<div >
				<div class="myBanner"><?=$myTable_TournamentInfo[0]->제목?></div>
			</div>
			<?php
				//echo $남은걸음수 ;
				//echo $기준날짜  ;
			?>
			<div style="text-align:center;padding:10px 0px;">
				<div style="width:33.333333%;float:left">
					<div>목표걸음 수</div>
					<div style="color:#ababab;font-size:20px;"><?=number_format($myTable_TournamentInfo[0]->목표걸음수)?><span class="unit" style="font-size:12px">보</span></div>
				</div>
				
				<div style="width:33.333333%;float:left">
					<div>누적걸음 수</div>
					<div style="color:#ababab;font-size:20px;"><?=@$누적걸음수===NULL?'- ':$누적걸음수?><span class="unit" style="font-size:12px">보</span></div>
				</div>
				
				<div style="width:33.333333%;float:left">
					<div>진행률</div>
					<div style="color:#ababab;font-size:20px;"><?=@$진행률===NULL?'- ':$진행률?><span class="unit" style="font-size:12px">%</span></div>
				</div>
				
			</div>			
			<div class="clear"></div>
			<div style="border-top:1px solid #ababab;margin-top:10px;">
			
			<div class="detail_info" style="margin-top:15px;margin:10px 8%;">
				<table>
					<tr>
						<td style="font-size:16px">참가인원</td>
						<td style="text-align:right;font-size:16px"><?=number_format($myTable_TournamentInfo[0]->참가자수)?>명</td>
					</tr>
					<?php
						$spot_data="";
						$total_stamp=0;
						foreach($myTable_Stamp_Data as $item){
								$spot_data .= '<tr><td >- '.$item->위시제목.'</td><td style="text-align:center;">'.$item->위시성공여부.'</td></tr>';
								if($item->위시성공여부 ==="성공")
									$total_stamp++;
						}
					?>
					<tr><td style="font-size:16px">획득한 스탬프</td><td style="text-align:right;font-size:16px"><?=$total_stamp?>개</td></tr>
					
					
					<?=$spot_data?>
					
					<?php
						
						$total_card=0;
						foreach($myTable_Card_Data as $item){
								if($item->미션성공여부 ==="성공")
									$total_card++;
						}
					?>
					
					<tr><td style="font-size:16px">획득한 경품추천권</td><td style="text-align:right">11112개</td></tr>
					<tr><td>-미션</td><td style="text-align:center"><?=$total_card?>개</td></tr>
					<tr><td>-체크인 프로모션</td><td style="text-align:center">111110개</td></tr>
				</table>
			
			</div>
			
			
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js?timestamp=201512210800"></script>
	<script>
		$(document).ready(function(){
			$(".myStaticPage_1").show();
			$(".menu .tab").each(function(idx){
				$(this).click(function(){
					$(".menu .tab").removeClass("active");
					$(this).addClass("active");
					$(".myStaticPage").hide();
					$(".myStaticPage_"+(idx+1)).fadeIn();
				});
			});
		});
	</script>
</body>
</html>