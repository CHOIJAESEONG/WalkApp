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
	<title>내가 참여한 대회</title>

	<style>
		.myGame_wrapper .menu .active{
			font-weight:bold !important;
		}
		.clear{clear:both;}
		.info_content table td, .item_bottom table td{width:50%;font-size:12px;}
		.detail_box table{width:100%;margin-top:20px;}
		
		.detail_box table td:nth-child(odd){text-align:left;width:60%;}
		.detail_box table td:nth-child(even){text-align:center;width:40%;}
		
		.item_bottom table td{text-align:left;padding-left:10px;color:RGB(141,117,42);font-size:12px;}
		.myGame{display:none;}
		.myGame .color_prize{color:RGB(0,176,240);text-decoration:underline;}
		.myGame .color_card{color:RGB(84,130,53);text-decoration:underline;}
		.myGame .pic_box:after{content:"";clear:both;display:block;}
		.color_ing{color:green;}
		.color_success{color:blue;}
		.color_fail{color:red;}
		
		
		.i_tit{
			text-overflow:ellipsis;
			white-space:nowrap;
			word-wrap:normal;
			width:100%;
			overflow:hidden;
		}
		.i_status{position:absolute;right:20px;bottom:0px;font-size:12px;}
						
		.myGame_1 .list_box .item{margin-top:5px;}
		.myGame_2 .list_box .item{margin-top:5px;}
		.myGame_2 .item_bottom table{width:calc(100% - 70px);}
		.myGame_2 .item_bottom table td{width:50%;font-size:12px;}
	</style>

</head>
<body style="overflow:auto;">

	<div class="myGame_wrapper">
		
		<div class="navbar" style="background:#ababab;height:40px;line-height:40px;box-shadow:0 3px 6px rgba(255, 255, 255, 0.1)">
			<div class="navbar-inner">
				<div class="center" >
					← 내가 참여한 대회
				</div>
				
				<div class="right">
					<a href="#" class="link">
						<i class="icon icon-bars"></i>
					</a>
				</div>			
			</div>
		</div>			

		<div class="menu" style="border-bottom:1px solid #cdcdcd;margin-top:10px;">
			<div style="height:20px;line-height:20px;border-top:1px solid #cdcdcd;padding:5px 0px;">
				<div class="tab active" style="margin-left:-1px;float:left;width:33.333%;text-align:center;">참가 대회</div>
				<div class="tab" style="border-left:1px solid #cdcdcd;float:left;width:33.3333%;text-align:center;">찜대회</div>
				<div class="tab" style="border-left:1px solid #cdcdcd;margin-left:-1px;float:left;width:33.333%;text-align:center;">완보증</div>
			</div>
		</div>
		
		<div class="clear"></div>

					
		<div class="myGame_1 myGame">
			<div class="list_box">
				<div style="margin:10px">총 6개의 대회에 참가하셨습니다.</div>
				<div style="margin-top:10px;">
					<div class="item">						
						<div style="position:relative;overflow:hidden;">
							<div style="position:absolute;left:5px;top:0px"><img src="" style="width:80px;height:80px"/></div>
							<div style="margin-left:100px;min-height:81px;margin-top:5px;">
								<div>
									<div class="i_tit">제1회 CANON과 함께하는 파노라마 걷기대회111111111</div>
									<div class="i_day">YYYY.MM.DD ~ YYYY’.MM’.DD’</div>
									<div style="position:relative">
										<div class="i_com">(주)캐논</div>
										<div class="i_status color_ing">진행중</div>
									</div>
								</div>
							</div>
							
						</div>
						
						<div class="item_bottom" style="background-color:#cdcdcd;">
							<table>
								<tr><td>1,256명</td><td>1000개 (70% 이하)</td></tr>
								<tr><td>565명</td><td>20개(10% 이상)</td></tr>
							</table>						
						</div>
					</div>
					
					<div class="item">						
						<div style="position:relative;overflow:hidden;">
							<div style="position:absolute;left:5px;top:0px"><img src="" style="width:80px;height:80px"/></div>
							<div style="margin-left:100px;min-height:81px;margin-top:5px;">
								<div>
									<div class="i_tit">제1회 CANON과 함께하는 파노라마 걷기대회111111111</div>
									<div class="i_day">YYYY.MM.DD ~ YYYY’.MM’.DD’</div>
									<div style="position:relative">
										<div class="i_com">(주)캐논</div>
										<div class="i_status color_success">완보성공</div>
									</div>
								</div>
							</div>
							
						</div>
						
						<div class="item_bottom" style="background-color:#cdcdcd;">
							<table>
								<tr><td>1,256명</td><td>1000개 (70% 이하)</td></tr>
								<tr><td>565명</td><td>20개(10% 이상)</td></tr>
							</table>						
						</div>
					</div>
					
					
					<div class="item">						
						<div style="position:relative;overflow:hidden;">
							<div style="position:absolute;left:5px;top:0px"><img src="" style="width:80px;height:80px"/></div>
							<div style="margin-left:100px;min-height:81px;margin-top:5px;">
								<div>
									<div class="i_tit">제1회 CANON과 함께하는 파노라마 걷기대회111111111</div>
									<div class="i_day">YYYY.MM.DD ~ YYYY’.MM’.DD’</div>
									<div style="position:relative">
										<div class="i_com">(주)캐논</div>
										<div class="i_status color_fail">완보실패</div>
									</div>
								</div>
							</div>
							
						</div>
						
						<div class="item_bottom" style="background-color:#cdcdcd;">
							<table>
								<tr><td>1,256명</td><td>1000개 (70% 이하)</td></tr>
								<tr><td>565명</td><td>20개(10% 이상)</td></tr>
							</table>						
						</div>
					</div>
					
					
				</div>
			</div>
			<div class="showInfo_box" style="display:none">
				<div style="position:relative;overflow:hidden;margin-top:10px;padding-bottom:5px;border-bottom:1px solid #ababab;">
					<div style="position:absolute;left:5px;top:0px"><img src="" style="width:80px;height:80px"/></div>
					<div style="margin-left:90px;min-height:76px;margin-top:5px;">
						<div>
							<div class="i_tit">제1회 CANON과 함께하는 파노라마 걷기대회111111111</div>
							<div class="i_day">YYYY.MM.DD ~ YYYY’.MM’.DD’</div>
							<div style="position:relative">
								<div class="i_com">(주)캐논</div>										
							</div>
						</div>
					</div>
					
				</div>
				
				<div class="detail_box" style="margin:20px">
					<div style="text-align:center;font-size:20px;font-weight:bold;" class="color_success">완보성공</div>
					<table>
						<tr><td>총 걸음 수</td><td>50,000보</td></tr>
						<tr><td>일일 평균 걸음 수</td><td>4,500보</td></tr>
					</table>
					<table style="margin-top:20px">
						<tr><td>총 소요시간</td><td>10일</td></tr>
						<tr><td>성공 미션 수</td><td>3개/4개</td></tr>
						<tr><td>체크인 성공여부</td><td>실패</td></tr>
						<tr><td>수령한 기념푸</td><td>4개</td></tr>			
						<tr><td>총 참여인원</td><td>12,345명</td></tr>
					</table>
					<div class="btn_goStage" style="background-color:RGB(255,192,0);margin-top:20px;padding:5px 0px;text-align:center;font-weight:bold;">
						대회장 바로가기
					</div>
				</div>
			</div>
			
			
			
			
			
			
		</div>
		
		<div class="myGame_2 myGame">		
			<div class="list_box">
				<div style="margin:10px">총 2개의 대회를 찜하셨습니다.</div>
				<div style="margin-top:10px;">
					<div class="item">						
						<div style="position:relative;overflow:hidden;">
							<div style="position:absolute;left:5px;top:0px"><img src="" style="width:80px;height:80px"/></div>
							<div style="margin-left:100px;min-height:81px;margin-top:5px;">
								<div>
									<div class="i_tit">제1회 CANON과 함께하는 파노라마 걷기대회111111111</div>
									<div class="i_day">YYYY.MM.DD ~ YYYY’.MM’.DD’</div>
									<div style="position:relative">
										<div class="i_com">(주)캐논</div>
										<div class="i_status color_ing">대회 종료 시 까지 D-2</div>
									</div>
								</div>
							</div>
							
						</div>
						
						<div class="item_bottom" style="background-color:#cdcdcd;position:relative;">
							<table style="margin-right:50px">
								<tr><td>1,256명</td><td>1000개 (70% 이하)</td></tr>
								<tr><td>565명</td><td>20개(10% 이상)</td></tr>
							</table>					
							<div style="position:absolute;right:5px;bottom:7px;border-radius:5px;padding:5px 0px;
							background-color:RGB(255,192,0);text-align:center;width:45px;">
								삭제
							</div>
						</div>
					</div>
					
					<div class="item">						
						<div style="position:relative;overflow:hidden;">
							<div style="position:absolute;left:5px;top:0px"><img src="" style="width:80px;height:80px"/></div>
							<div style="margin-left:100px;min-height:81px;margin-top:5px;">
								<div>
									<div class="i_tit">제1회 CANON과 함께하는 파노라마 걷기대회111111111</div>
									<div class="i_day">YYYY.MM.DD ~ YYYY’.MM’.DD’</div>
									<div style="position:relative">
										<div class="i_com">(주)캐논</div>
										<div class="i_status color_fail">종료</div>
									</div>
								</div>
							</div>
							
						</div>
						
						<div class="item_bottom" style="background-color:#cdcdcd;position:relative;">
							<table style="margin-right:50px">
								<tr><td>1,256명</td><td>1000개 (70% 이하)</td></tr>
								<tr><td>565명</td><td>20개(10% 이상)</td></tr>
							</table>	
											
								<div style="position:absolute;right:5px;bottom:7px;border-radius:5px;padding:5px 0px;
								background-color:RGB(255,192,0);text-align:center;width:45px;">
									삭제
								</div>
							
						</div>
					</div>
					
					
				</div>
			</div>
		</div>
		
		<div class="myGame_3 myGame">		
			<div class="list_box">
				<div style="margin:10px">총 3개의 완보증이 있습니다.</div>
				<div style="margin-top:10px;border-top:1px solid #cdcdcd;">
					<div class="item" style="border-bottom:1px solid #cdcdcd;padding-bottom:10px;">						
						<div style="position:relative;overflow:hidden;">
							<div style="margin-left:15px;min-height:81px;margin-top:20px;font-size:12px;">
								<div>
									<div class="i_tit">제1회 CANON과 함께하는 파노라마 걷기대회11111111111111111111</div>
									<div class="i_day">YYYY.MM.DD ~ YYYY’.MM’.DD’</div>
									<div style="position:relative">
										<div class="i_com">(주)캐논</div>
										
									</div>
								</div>
							</div>
							
							<div class="show_certificate"  style="position:absolute;right:10px;bottom:0px;border-radius:5px;padding:5px 0px;
							background-color:RGB(255,192,0);text-align:center;width:100px;">
								완보증보기
							</div>
							
						</div>				
					</div>
					
					<div class="item" style="border-bottom:1px solid #cdcdcd;padding-bottom:10px;">						
						<div style="position:relative;overflow:hidden;">
							<div style="margin-left:15px;min-height:81px;margin-top:20px;font-size:12px;">
								<div>
									<div class="i_tit">제1회 CANON과 함께하는 파노라마 걷기대회111111111</div>
									<div class="i_day">YYYY.MM.DD ~ YYYY’.MM’.DD’</div>
									<div style="position:relative">
										<div class="i_com">(주)캐논</div>
										
									</div>
								</div>
							</div>
							
							<div class="show_certificate"  style="position:absolute;right:10px;bottom:0px;border-radius:5px;padding:5px 0px;
							background-color:RGB(255,192,0);text-align:center;width:100px;">
								완보증보기
							</div>
							
						</div>				
					</div>
					
					<div class="item" style="border-bottom:1px solid #cdcdcd;padding-bottom:10px;">						
						<div style="position:relative;overflow:hidden;">
							<div style="margin-left:15px;min-height:81px;margin-top:20px;font-size:12px;">
								<div>
									<div class="i_tit">제1회 CANON과 함께하는 파노라마 걷기대회111111111</div>
									<div class="i_day">YYYY.MM.DD ~ YYYY’.MM’.DD’</div>
									<div style="position:relative">
										<div class="i_com">(주)캐논</div>
										
									</div>
								</div>
							</div>
							
							<div class="show_certificate" style="position:absolute;right:10px;bottom:0px;border-radius:5px;padding:5px 0px;
							background-color:RGB(255,192,0);text-align:center;width:100px;">
								완보증보기
							</div>
							
						</div>				
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php //완보증 ?>
	<div class="popup_box" style="z-index:99999;width:100%;height:100%;position:fixed;left:0px;top:0px;display:none;">
		
			<div style="position:absolute;left:0px;top:0px;width:100%;height:100%;background-color:black;opacity:0.7;"></div>
			<div style="position:absolute;left:0;top:0;right:0;bottom:0;margin:auto;
				width:90%;height:90%;background-color:white;
				max-width:320px;max-height:400px;
				border:1px solid #cdcdcd;border-radius:10px;
			">
				<div style="position:relative;height:100%;">
					<div style="position:relative;font-size:18px;text-align:center;border-bottom:1px solid #cdcdcd;line-height:40px;height:40px;">
						완보증
						<div id="pop_close" style="position:absolute;bottom:0px;right:10px;">X</div>
					</div>
					<div style="width:100%;height:calc(100% - 80px);overflow:auto;">
						<div class="i_box certificate">
							<img src="/mnt/walk/certificate/test.png" style="width:100%;height:100%;"/>
						</div>
						<div class="i_box email" style="text-align:center;margin-top:50px;">
							<div>완보증을 수령할 이메일을 입력해주세요.</div>
							<div style="margin:30px 20px"><input type="text" style="width:100%"/></div>
							<div style="font-size:12px;width:220px;margin:30px auto;">완보증 이메일 발송은 1회로 제한하며 최대 1일이상 소요될 수 있습니다.</div>
						</div>
					</div>
					<div id="send_mail" style="border-radius:0px 0px 10px 10px;width:100%;position:absolute;left:0px;bottom:0px;background-color:RGB(255,192,0);text-align:center;padding:8px 0px;font-weight:bold;">
						 이메일 완보증 신청하기
					</div>
					<div id="send_ok" style="display:none;border-radius:0px 0px 10px 10px;width:100%;position:absolute;left:0px;bottom:0px;background-color:RGB(255,192,0);text-align:center;padding:8px 0px;font-weight:bold;">
						 확인
					</div>
				 </div>
			</div>
		
	</div>	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js?timestamp=201512210800"></script>
	<script>
		$(document).ready(function(){
			$(".myGame_1").show();
			$(".myGame_1 .list_box .item").each(function(){
				$(this).click(function(){
					$(".myGame_1 .list_box").hide();
					$(".myGame_1 .showInfo_box").show();
				});
			});
			
			$(".menu .tab").each(function(idx){
				$(this).click(function(){
					$(".menu .tab").removeClass("active");
					$(this).addClass("active");
					$(".myGame").hide();
					$(".myGame_"+(idx+1)).fadeIn();
					
					$(".myGame_1 .list_box").show();
					$(".myGame_1 .showInfo_box").hide();
					
					$(".myGame_2 .list_box").show();
					$(".myGame_2 .showInfo_box").hide();
				});
			});
			
			$(".show_certificate").click(function(){
				$(".popup_box").show();
				$(".popup_box #send_mail").show();
				$(".popup_box #send_ok").hide();
				$(".popup_box .i_box").hide();
				$(".popup_box .certificate").show();
				
				<?php //이메일로 완보증 보내기 ?>
				$("#send_mail").click(function(){
					$(".popup_box .i_box").hide();
					$(".popup_box .email").show();
					$(".popup_box #send_mail").hide();
					$(".popup_box #send_ok").show();
					$(".popup_box #send_ok").click(function(){
						$(".popup_box").hide();		
						alert("이메일로 완보증이 전송되었습니다");
					});
					
				});
				
				
				
			});
			
			$("#pop_close").click(function(){
				$(".popup_box").hide();
				
				
			});
		});
	</script>
</body>
</html>