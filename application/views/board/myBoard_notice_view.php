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
	<title>게시판</title>
	<style>
		.clear{clear:both;}
		.menu{border-top:1px solid #cdcdcd;margin-top:10px;padding-top:5px;border-bottom:1px solid #cdcdcd;margin-bottom:5px;padding-bottom:5px;}
		.menu:after {content:"";clear:both;display:block;}
		.list_box{display:block;}
		.contentBox{display:none;margin:2px;}
		.notice_item{
			padding:10px 0px;
		}
		.notice_item:after{
			content:"";clear:both;display:block;
		}
		
		.color_32{background-color:RGB(146,208,80);}
		.color_31{background-color:RGB(0,176,240);}
	</style>
</head>
<body style="overflow:auto;">

	<div class="myStaticPage_wrapper">
		<div class="navbar" style="background:#ababab;height:40px;line-height:40px;box-shadow:0 3px 6px rgba(255, 255, 255, 0.1)">
			<div class="navbar-inner">
				<div class="center" >
					← 게시판
				</div>
				
				<div class="right">
					<a href="#" class="link">
						<i class="icon icon-bars"></i>
					</a>
				</div>			
			</div>
		</div>		
		
		<div class="menu" style="margin-bottom:2px">
			<div style="margin-left:-1px;width:50%;float:left;">
				<div style="padding-right:10px;text-align:right">
					공지사항
				</div>
			</div>
			<div style="width:50%;border-left:1px solid #cdcdcd;float:left;">
				<div style="padding-left:10px;text-align:left">
					이벤트
				</div>
			</div>
		</div>
		<div class="clear"></div>
		
		<div class="menu" style="border-width:0px;margin:3px 0px 0px 0px;padding:0px;">			
				<div style="margin-left:-1px;width:50%;float:left;">
					<div style="padding:5px 10px 5px 0px;text-align:center;margin-left:20px;background-color:RGB(255,192,0);">
						전체공지
					</div>
				</div>
				<div style="width:50%;border-left:1px solid #cdcdcd;float:left;">
					<div style="padding:5px 0px 5px 10px;text-align:center;margin-right:20px;background-color:RGB(255,192,0);">
						내 공지
					</div>
				</div>			
		</div>	
		<div class="clear"></div>
		
		<div class="notice_box list_box" style="margin-top:10px">
		<?php 
			//페이징 없이??? 
			//운영단???
			
			//일단 더보기로 구현해보자....
			foreach($notices as $item){
				echo '
					<div class="notice_item item_'.$item->게시판_id.'" style="border-bottom:1px solid #cdcdcd">
						<div style="width:25%;float:left;text-align:center;">
							<div style="margin:0px 5px;">
								<div class="color_'.$item->머릿글종류.'" style="padding:5px 0px;border:1px solid #cdcdcd;border-radius:5px;margin:auto;max-width:120px;">'
									.$item->코드명.
								'</div>
							</div>
						</div>
						<div style="width:60%;float:left;text-align:left;">
							<div style="margin-left:5px">'.$item->글제목.'</div>
						</div>
						<div style="width:15%;float:left;text-align:center;font-size:12px;">
							'.date_format(date_create($item->등록일),"m.d").'
						</div>
					</div>
					<div class="clear"></div>
					<div class="contentBox contentBox_'.$item->게시판_id.'">
							<div style="border:1px solid #cdcdcd;border-radius:5px;padding:5px;">'.$item->글내용.'</div>			
					</div>				

				';
			}
		?>
			
		</div>
			
		<!--
		<div id="btn_more" style="margin:10px;background-color:gray;text-align:center;padding:10px 0px;">
			더보기
		</div>
		-->
		
		
	</div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js?timestamp=201512210800"></script>
	<script>
		$(document).ready(function(){
			$(".notice_item").each(function(idx){
				$(this).click(function(){
					if($(".contentBox:eq("+idx+")").css("display")=="none"){
						$(".contentBox").hide();
						$(".contentBox:eq("+idx+")").fadeIn();
					}
					else{
						$(".contentBox:eq("+idx+")").hide();
					}
				});
			});
		});
	</script>
</body>
</html>