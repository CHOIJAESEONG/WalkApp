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
	<title>나의 통계</title>	
	<style>
		.clear{clear:both;}
	</style>
</head>
<body style="overflow:auto;">
	<div class="myStaticPage_wrapper">
		<div class="navbar" style="background:#ababab;height:40px;line-height:40px;box-shadow:0 3px 6px rgba(255, 255, 255, 0.1)">
			<div class="navbar-inner">
				<div class="center" >
					← 나의 통계
				</div>
				
				<div class="right">
					<a href="#" class="link">
						<i class="icon icon-bars"></i>
					</a>
				</div>			
			</div>
		</div>					
		
		<div class="content_box" style="margin:5%;">
		
			<div class="info_box" style="margin-top:20px">
				<div style="margin-left:-1px;width:50%;float:left;text-align:center;">
					<div style="text-align:center;border-bottom:1px solid #555;padding-bottom:15px;">
						<div style="font-size:12px">이번주 총 걸음 수</div>
						<div style="font-size:22px">122,000보</div>
					</div>
				</div>
				<div style="border-left:1px solid #555;width:50%;float:left;text-align:center;">
					<div style="text-align:center;border-bottom:1px solid #555;padding-bottom:15px;">
						<div style="font-size:12px">일일 평균 걸음 수</div>
						<div style="font-size:22px">17,000보</div>
					</div>
				</div>
			</div>
			
			<div class="clear"></div>
			
			<div class="week_box">
				<div class="week_chart">
					<div style="text-align:center;background:RGB(0,176,240);margin:5px;color:white;padding:2px 0px;">주간 통계</div>
				</div>
				<img src="/mnt/walk/temp/chart_01.png" style="width:100%"/>
			</div>
			
			<div class="month_box" style="border-top:1px solid #ababab">
				<div class="month_chart">
					<div style="text-align:center;background:RGB(0,112,192);margin:5px;color:white;padding:2px 0px;">월간 통계</div>
				</div>
				<img src="/mnt/walk/temp/chart_02.png" style="width:100%"/>
			</div>
			
			<div class="friends_box"  style="border-top:1px solid #ababab">
				<div class="friends_chart">
					<div style="text-align:center;background:RGB(0,176,80);margin:5px;color:white;padding:2px 0px;">친구들 통계</div>
				</div>
				<img src="/mnt/walk/temp/chart_03.png" style="width:100%"/>
			</div>
		</div>
	</div>

</body>
</html>