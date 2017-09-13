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
		.myPrize_wrapper .menu .active{
			font-weight:bold !important;
		}
		.clear{clear:both;}
		.info_content table td{width:50%;}
		.myPrize .color_prize{color:RGB(0,176,240);text-decoration:underline;}
		.myPrize .color_card{color:RGB(84,130,53);text-decoration:underline;}
		.myPrize .pic_box:after{content:"";clear:both;display:block;}
		.myPrize{display:none;}
	</style>

</head>
<body style="overflow:auto;">
	<div class="myPrize_wrapper">
		
		<div class="navbar" style="background:#ababab;height:40px;line-height:40px;box-shadow:0 3px 6px rgba(255, 255, 255, 0.1)">
			<div class="navbar-inner">
				<div class="center" >
					← 내 주머니
				</div>
				
				<div class="right">
					<a href="#" class="link">
						<i class="icon icon-bars"></i>
					</a>
				</div>			
			</div>
		</div>					
		

		<div class="menu" style="height:25px;line-height:25px;border-bottom:1px solid #cdcdcd;">
			<div style="height:20px;line-height:24px;margin-top:10px;">
				<div class="tab active" style="margin-left:-1px;float:left;width:50%;text-align:center;">스탬프</div>
				<div class="tab" style="border-left:1px solid #cdcdcd;float:left;width:50%;text-align:center;">경품 추첨권</div>
			</div>
		</div>
		<div class="clear"></div>

					
		<div class="myPrize_1 myPrize">
			<div style="text-align:center;font-weight:bold;margin:30px 10px 10px 10px;">참가자님의 스탬프 획득 갯수는 <span class="color_prize">2개</span> 입니다.</div>
			
			<?php //스탬프 미션 가변 갯수??? 최대 5개??10개??ㅋㅋ ?>
			<div style="pic_box">
				<div style="margin:0px 5%">
					<div style="width:25%;float:left;text-align:center;"><img style="width:100%;" src="mnt/walk/prize/stamp_yes.png"/></div>
					<div style="width:25%;float:left;text-align:center;"><img style="width:100%" src="mnt/walk/prize/stamp_no.png"/></div>
					<div style="width:25%;float:left;text-align:center;"><img style="width:100%" src="mnt/walk/prize/stamp_yes.png"/></div>
					<div style="width:25%;float:left;text-align:center;"><img style="width:100%" src="mnt/walk/prize/stamp_no.png"/></div>
				</div>
			</div>
			<div class="clear"></div>
			<div style="margin-top:15px">
				<div>
					<div style="width:200px;line-height:25px;height:25px;background-color:#aeaeae;margin:auto;text-align:center;font-weight:bold;">기념품 당첨여부 확인하기</div>
				</div>
			</div>
			
			<div class="info_Box" style="border:1px solid #333;border-radius:5px;margin:15px 2% 10px 2%;">
				<div class="info_title" style="color:white;background-color:RGB(0,176,240);padding:2px 0px 2px 10px;font-size:14px;">혜택</div>
				<div class="info_content" style="margin-top:20px 10px;line-height:25px;padding:10px 5px;">
					<table>
						<tr><td>캐논 렌즈 교환권</td><td style="text-align:right">1명</td></tr>
						<tr><td>스타벅스 커피 교환권</td><td style="text-align:right">100명</td></tr>
						<tr><td>카카오톡 이모티콘</td><td style="text-align:right">500명</td></tr>
					</table>
				</div>
				
			</div>
			
			<div class="info_Box" style="border:1px solid #333;border-radius:5px;margin:8px 2%;">
				<div class="info_title" style="color:white;background-color:RGB(0,176,240);padding:2px 0px 2px 10px;font-size:14px;">스탬프 획득방법</div>
				<div class="info_content" style="margin-top:20px 10px;line-height:25px;padding:10px 5px;">대회장 내 스팟 도착시 실행되는 핫스팟 미션을 보시면 스탬프를 획득하실 수 있습니다.</div>
			</div>
			
		</div>
		
		<div class="myPrize_2 myPrize">		
			
		<div style="text-align:center;font-weight:bold;margin:30px 10px 10px 10px;">참가자님의 경품 추첨권 획득 갯수는 <span class="color_card">2개</span> 입니다.</div>
			
			<?php //스탬프 미션 가변 갯수??? 최대 5개??10개??ㅋㅋ ?>
			<div style="pic_box">
				<div style="margin:0px 5%">
					<div style="width:25%;float:left;text-align:center;"><img style="width:100%;" src="mnt/walk/prize/card_yes.png"/></div>
					<div style="width:25%;float:left;text-align:center;"><img style="width:100%" src="mnt/walk/prize/card_no.png"/></div>
					<div style="width:25%;float:left;text-align:center;"><img style="width:100%" src="mnt/walk/prize/card_yes.png"/></div>
					<div style="width:25%;float:left;text-align:center;"><img style="width:100%" src="mnt/walk/prize/card_no.png"/></div>
				</div>
			</div>
			<div class="clear"></div>
			<div style="margin-top:15px">
				<div>
					<div style="width:200px;line-height:25px;height:25px;background-color:#aeaeae;margin:auto;text-align:center;font-weight:bold;">경품 당첨여부 확인하기</div>
				</div>
			</div>
			
			<div class="info_Box" style="border:1px solid #333;border-radius:5px;margin:15px 2% 10px 2%;">
				<div class="info_title" style="color:white;background-color:RGB(84,130,53);padding:2px 0px 2px 10px;font-size:14px;">혜택</div>
				<div class="info_content" style="margin-top:20px 10px;line-height:25px;padding:10px 5px;">
					<table>
						<tr><td>쉐보레 스파크</td><td style="text-align:right">1대</td></tr>
						<tr><td>갤럭시 S7</td><td style="text-align:right">3대</td></tr>
						<tr><td>신일전자 선풍기</td><td style="text-align:right">50대</td></tr>
					</table>
				</div>
				
			</div>
			
			<div class="info_Box" style="border:1px solid #333;border-radius:5px;margin:8px 2%;">
				<div class="info_title" style="color:white;background-color:RGB(84,130,53);padding:2px 0px 2px 10px;font-size:14px;">경품 추첨권 획득방법</div>
				<div class="info_content" style="margin-top:20px 10px;line-height:25px;padding:10px 5px;">대회장 진입 후 아래 버튼 중 ‘미션’ 항목에 들어가서 주어진 미션을 해결하시면 됩니다. 미션은 핫스팟의 미션을 성공해야 확인하실 수 있습니다. 경품추첨권이 많아질수록 당첨확률은 높아집니다.</div>
			</div>
			
			
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js?timestamp=201512210800"></script>
	<script>
		$(document).ready(function(){
			$(".myPrize_1").show();
			$(".menu .tab").each(function(idx){
				$(this).click(function(){
					$(".menu .tab").removeClass("active");
					$(this).addClass("active");
					$(".myPrize").hide();
					$(".myPrize_"+(idx+1)).fadeIn();
				});
			});
		});
	</script>
</body>
</html>