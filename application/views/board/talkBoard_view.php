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
	<title>대회톡</title>
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
		body{margin:0px}
		.comment_image{
			width: 50px;
			height: 50px;
			overflow: hidden;
			border-radius: 100px;
			clear:both;
		}
	</style>
</head>
<body style="overflow:auto;">

	<div class="talkComments_wrapper">
		<div class="navbar" style="background:#ababab;height:40px;line-height:40px;box-shadow:0 3px 6px rgba(255, 255, 255, 0.1)">
			<div class="navbar-inner">
				<div class="center" >
					← 대회톡
				</div>
				
				<div class="right">
					<a href="#" class="link">
						<i class="icon icon-bars"></i>
					</a>
				</div>			
			</div>
		</div>		
	</div>
	
	<div style="margin:5px;background-color:#ababab;border-radius:5px;padding:10px;">
		<div style="font-weight:bold;margin:0px 0px 5px 0px;font-size:16px;">이런 태그는 어때요?</div>
		<style>
			.tag{
				margin-top:5px;display:inline-block;line-height:15px;border:1px solid #555;padding:5px 3px;background-color:white;border-radius:5px;
			}
		</style>
		<?php foreach($commentTags as $commentTag){ ?>
			<span class="tag" value=<?=$commentTag->공통코드_id?>>#<?= $commentTag -> 코드명 ?></span>
		<?php } ?>
	</div>
	
	<div class="comment_list">
		<?php foreach($comments as $index => $comment){ ?>
			<div class="item" style="border:1px solid #cdcdcd;margin:5px;border-radius:5px;padding:5px 10px;">
				<div style="display:inline-table;width:100%;height:100%">
					<img class="comment_image" src="<?=경로_사용자?><?=$comment->사진?>"/>
					<span style="display: table-cell; vertical-align: middle;width:100px;"><?=$comment->작성자?></span>
					<span style="padding-left:30%;display:table-cell; vertical-align: middle;"><?= $comment->작성날짜?></span>
				</div>
				<div>
					<span style="padding-left:60px;" class="content"><?=$comment->댓글?></span> 
				</div>
			</div>
		<?php } ?>
	</div>
	
	<div style="height:80px"></div>
	
	<div class="more" style="position:fixed;bottom:40px;left:0px;width:100%;background-color:white;height:40px;line-height:40px;text-align:center;border-top:1px solid #cdcdcd;">
		더보기(전체)
	</div>
	
	<div class="more2" style="position:fixed;bottom:40px;left:0px;width:100%;background-color:white;height:40px;line-height:40px;text-align:center;border-top:1px solid #cdcdcd;">
		더보기(태그)
	</div>
	<div style="position:fixed;bottom:0px;left:0px;width:100%;">
		<div style="border:1px solid #555;position:relative;height:40px;overflow:hidden;background-color:#cdcdcd;">
			<span style="margin-left:10px">#</span><input type="text" id="comment" name="comment" style="width:calc(100% - 120px);height:34px;border-width:0px;margin-left:10px;margin-top:2px;" value=""/>
			<div style="margin:auto;position:absolute;right:2px;top:2px;text-align:center;border-radius:5px;background-color:RGB(255,192,0);width:80px;line-height:35px;height:35px" class="com_insert">글쓰기</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js?timestamp=201512210800"></script>
	<script>
		$(document).ready(function(){
			<?php //태그 기준으로 더보기를 하기 위한 변수들 초기화 ?>
			var totalTagCnt=0;
			var firstIndex2 = 9;
			<?php //기본 load화면 - 전체 댓글 더보기 ?>
			$(".more").css("display","block");
			$(".more2").css("display","none");
			
			<?php // 태그 기준으로 불러오기 - 공통코드Table에 있는 공통코드_id 값을 value에 넣어서 가져감 ?>
			$(".tag").each(function(idx){
				$(this).click(function(){
					removeCss();
					$index = $(".tag").eq(idx);
					$.ajax({
						type:"POST", 
						url: "/board/commentByTag", 
						dataType:"json", 
						data:{
							"ctag_id" : $index.attr("value") 
						}, 
						success: function(data){
							<?php // 태그 기준 누를 때마다 인덱스 초기화 / 인덱스는 0부터시작이므로 9?>
							firstIndex2 = 9;
							<?php //태그 기준 더보기 총 개수 구하기 ?>
							totalTagCnt = data.totalTagCnt;
							var str ="";
							$.each(data.commentByTags , function (index, value) {
                                str += "<div class='item' style='border:1px solid #cdcdcd;margin:5px;border-radius:5px;padding:5px 10px;'><div style='display:inline-table;width:100%;height:100%'>"
									+"<img class='comment_image' src='<?=경로_사용자?>"+ value.사진 + "'/>"
									+"<span style='display: table-cell; vertical-align: middle;width:100px;'>" + value.작성자 + "</span><span style='padding-left:30%;display: table-cell; vertical-align: middle;'>" + (value.작성날짜) + "</span>"
									+"</div><div><span style='padding-left:60px;' class='tag_id' value=" + value.태그+ ">" + value.댓글 +"</span> </div></div>";
								});
							$(".comment_list").html(str);
							<?php //태그기준으로 더보기 추가 ?>
							$(".more").css("display","none");
							$(".more2").css("display","block");
							$(".tag").eq(idx).css("background-color","#00d2ff"); <?php // 태그 눌렀을 때 css효과 ?>
						},error: function(result){
							alert("실패");
						}
					});
				});
			});
			
			<?php // 태그 눌렀을 때 css효과 ?>
			function removeCss(){
				$(".tag").each(function(idx){
					$(".tag").eq(idx).css("background-color","white");
				});
			}
			
			<?php // 전체 댓글 더보기 를 위한 변수 2개 (firstIndex : 더보기 누를 때마다 시작되는 첫번째 index / totalCnt : 댓글 전체 개수 )?>
			var firstIndex = 10;
			var totalCnt = "<?=$totalCnt?>";		
			$(".more").click(function(){
				if(firstIndex>= totalCnt){
					alert("이전 댓글이 없습니다.");
					$(".more").css("display","none");
				}else{
					$.ajax({
							type:"POST", 
							url: "/board/addComment", 
							dataType:"json", 
							data:{
								"firstIndex" : firstIndex,
								"totalCnt" : totalCnt
							}, 
							success: function(data){
								var str ="";
								 $.each(data.addcomments, function (index, value) {
									str += "<div class='item' style='border:1px solid #cdcdcd;margin:5px;border-radius:5px;padding:5px 10px;'><div style='display:inline-table;width:100%;height:100%'>"
										+"<img class='comment_image' src='<?=경로_사용자?>"+ value.사진 + "'/>"
										+"<span style='display: table-cell; vertical-align: middle;width:100px;'>" + value.작성자 + "</span><span style='padding-left:30%;display: table-cell; vertical-align: middle;'>" + (value.작성날짜) + "</span>"
										+"</div><div><span style='padding-left:60px;' class='content'>" + value.댓글 +"</span> </div></div>";
									});
								$(".comment_list").append(str);
								<?php // 더보기 10개가 추가되었으면 더보기 다시 눌렀을 때 firstIndex 10개를 추가함?>
								firstIndex = firstIndex+10;
							},error: function(result){
								alert("실패");
							}
					});
				}
			});
				
			$(".more2").click(function(){
				<?php //index는 0에서 시작 / id는 1에서 시작 ?>
				if(parseInt(firstIndex2)+1>= totalTagCnt){
					alert("이전 댓글이 없습니다.");
					$(".more2").css("display","none");
				}else{
					$.ajax({
							type:"POST", 
							url: "/board/addCommentByTag", 
							dataType:"json", 
							data:{
								<?php //현재 나와있는 마지막 index 다음부터 10개를 select해야 해서 1를 추가함 ?>
								"firstIndex2" : parseInt(firstIndex2)+1,
								"ctag_id" : $(".tag_id").attr("value")
							}, 
							success: function(data){
								var str ="";
								 $.each(data.addcommentByTags , function (index, value) {
									str += "<div class='item' style='border:1px solid #cdcdcd;margin:5px;border-radius:5px;padding:5px 10px;'><div style='display:inline-table;width:100%;height:100%'>"
										+"<img class='comment_image' src='<?=경로_사용자?>"+ value.사진 + "'/>"
										+"<span style='display: table-cell; vertical-align: middle;width:100px;'>" + value.작성자 + "</span><span style='padding-left:30%;display: table-cell; vertical-align: middle;'>" + (value.작성날짜) + "</span>"
										+"</div><div><span style='padding-left:60px; class='content' value='"+ value.태그 + "'>" + value.댓글 +"</span> </div></div>";
									});
								$(".comment_list").append(str);
								firstIndex2 = firstIndex2+10;
							},error: function(result){
								alert("실패");
							}
					});
				}
			});
			
			$(".com_insert").click(function(){
				$.ajax({
					type:"POST", 
					url: "/board/insertComment", 
					dataType:"json", 
					data:{
						"comment" : $("#comment").val()
					}, 
					success: function(result){
						<?php // result가 1이면 로그인이 성공한 경우 , result가 0이면 실패?>
						if(result==1){
							alert("성공");
							$("#comment").val("");
						}else{
							alert("삽입되지 않음");
							$("#comment").val("");
						}
					},error: function(result){
						
					}
				});
			});
		});
	</script>
</body>
</html>