<style>
	body{margin:0px;}
	
	.chat_box {
		display: inline-block;
		color: #34495e;
		margin: 0;
		width:100%;
		overflow:auto;
		background-color:#fdffa8;
	}
	
	.chat_box .addMs {
		position:fixed;
		left:0;
		right:0;
		top:0px;
		z-index:100;
		width:90%;
		height:20px;
		background-color:#ffca47;
		text-align:center;
		margin:10px 0px 10px 7px;
		padding:10px;
		border-radius:10px;
		opacity:0.4;
	}
	
	.chat_box ul {
		-webkit-padding-start: 0px;
		width:100%;
	}
	
	.chat_box li{
		display: table;
		font-size: 12px;
		line-height: 25px;
		margin-bottom:10px;
		width:100%;
	}
	
	.chat_box .odd {
		display: block;
		padding: 10px;
		margin-bottom: 7px;
		font-size: 15px;
		line-height: 25px;
		border-top-left-radius: 6px;
		border-top-right-radius: 6px;
		border-bottom-right-radius: 6px;
		border-bottom-left-radius: 6px;
		background-color: #ecf0f1;
		clear: both;
		/* float: left; */
		position: relative;
		word-wrap: break-word;
		word-break: break-all;
	}
	
	.odd:after {
		content: ' ';
		top: auto;
		bottom: auto;
		border: 12px solid;
		border-color: transparent transparent #ecf0f1 transparent;
		margin: 0 0 0 -23px;
		float: left;
		position: absolute;
		left: 10px;
		bottom: 6px;
	}
	
	.chat_box .even {
		display: block;
		padding: 10px;
		margin-bottom:7px;
		font-size: 15px;
		line-height: 25px;
		border-top-left-radius: 6px;
		border-top-right-radius: 6px;
		border-bottom-right-radius: 6px;
		border-bottom-left-radius: 6px;
		background-color: #C1E4EC;
		/* float: left; */
		position: relative;
		word-wrap: break-word;
		word-break: break-all;
	}
	
	.even:after {
		content: ' ';
		top:auto;
		bottom: auto;
		right:28px;
		border: 12px solid;
		border-color: transparent transparent #C1E4EC transparent;
		margin: 0 -40px 0 0;
		position: absolute;
		bottom: 6px;
	}

	.chat_box li .time {
		font-size:10px;
		width:55px;
		text-align:center;
	}
	
	.mspop {
		position:fixed;
		width:100%;
		padding:15px 0 15px 0;
		z-index:100;
		background-color:#a18752;
		bottom:0;
	}
	
	.mspop .input_ms {
		float:left;
		width:70%;
		height:19px;
		padding:5px;
		border-radius:8px;
		margin-left:2%;
	}
	
	.mspop .enter_btn {
		position:absolute;
		background-color :#ffffff;
		border-radius:12px;
		text-align:center;
		padding:7px;
		right:4%;
	}

	.mythumb3 {
		margin-right:10px;
		width: 50px;
		height: 50px;
		top:20px;
		overflow: hidden;
		border-radius: 50px;
		clear:both;
	} 
	
	.mythumb3 img {
		width: 50px;
		height: 50px;
	}
</style>
<div class="chat_box">
	<div class="addMs">△ MORE MESSEGE</div>
	<ul class="heightchk">				
		<?php 
		foreach($friendIds as $friendId){
		?>
		<?php
			$date_temp=date_create($friendId->전송일시);
			$date_time = date_format($date_temp,"h:i");
			$date_ampm = date_format($date_temp,"A");
			$date_ampm =$date_ampm =="AM"?"오전":"오후";
		?> 
			<?php 
			if($friendId->전송_id==$user_id) { 
			?>
				<li class="group_box" msid="<?=$friendId->쪽지_id ?>">
					<div style="position:relative;margin-right:10px">
						<table style="max-width:80%;table-layout:fixed;" align="right">
							<tr>
								<td>
									<div class="time" style="margin-left:5px;" >
										<?=$date_ampm?> <?=$date_time?>
									</div>
								</td>
								<td style="max-width:60%">
									<div class="even">
										<?=$friendId-> 내용?>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</li>
			<?php
			}else{
			?>
				<li msid="<?=$friendId->쪽지_id ?>">
					<div style="position:relative;">
						<table style="max-width:90%;table-layout:fixed;">
							<tr>
								<td><div class="mythumb3"><img src="<?=경로_사용자?><?=$friendId->사진?>" alt=""></div></td>
								<td style="max-width:70%">
									<div><?=$friendId->전송_id?></div>
									<div class="odd">
										<?=$friendId->내용?>
									</div>
								</td>
								<td>
									<div class="time" style="margin-left:5px;" >
										<?=$date_ampm?> <?=$date_time?>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</li>
			<?php
			}
			?>         
		<?php
		} 
		?>   
	</ul>
</div>
<div class="mspop">
	<div class="enter_text">
		<input class="input_ms" type="text" placeholder="Please enter your messege." name="contents"/>
		<div id="enter_btn" class="enter_btn">ENTER</div>
	</div>
</div>
<script>
	var groupId = "<?=$groupIds?>";
	var msCnt = "<?=$msCnt?>"; <?php //전체 쪽지의 개수 ?>
	var upperMsId = "<?=$upperMsId?>"; <?php //초기값 설정 ?>
	var totalminMs = "<?=$totalminMs?>";
	
	function getMaxId(){
		if($(".chat_box ul li").last().attr("msid")==null){
			return 0;
		}else{
			return $(".chat_box ul li").last().attr("msid"); <?php //가장 마지막 메세지의 쪽지_id를 받아옴 ?>
		}
	}
	
	function msAjax(url,data,isMove){ <?php //공통된 ajax문 함수 ?>
		$.ajax({
			type:"POST",
			url: url,
			dataType:"text",
			data:data,
			success: function(result){
				$(".heightchk").append(result.trim()); <?php //li태그의 상위 태그에 붙임 ?>
				if(result.trim()!="")
					bottomMove();
			},error: function(result){
				alert("오류가 발생했습니다.");
			}
		});
	}
	
	function getNewMs(){ <?php //상대방의 메세지 받아오기 ?>
		msAjax("/friends/refreshMs",{"groupId" : groupId,"msId" : getMaxId() },false);	
	}
	
	$(document).ready(function() {
		if(msCnt<=10){
			addMsHidden();
		}
		$("#enter_btn").click(function(){ <?php //메세지 입력 이벤트 ?>	
			contents = $(".input_ms").val();				
			if(contents==null || contents==""){ <?php //내용을 입력하지 않았을 시에 alert ?>
				alert("값을 입력하세요");
				return;
			}
			input_Reset();
			msAjax("/friends/insertContents",{"groupId" : groupId, "contents" : contents,"msId" : getMaxId()},true);	
		});

		$(".addMs").click(function(){ <?php //메세지 더보기 버튼 클릭시 발생 이벤트 ?>	
			$.ajax({
				type:"POST", 
				url: "/friends/addMs", 
				dataType:"text",
				data:{
					"groupId" : groupId,
					"upperMsId": upperMsId
				},
				success: function(result){
					topMove();
					$(".chat_box .heightchk").prepend(result.trim());
					upperMsId = $(".chat_box .heightchk:eq(0) li:eq(0)").attr("msid");
					if(upperMsId==totalminMs){
						addMsHidden(); <?php //더보기 할 필요가 없으니 버튼 숨김 ?>
					}
				},error: function(result){
					alert("오류가 발생했습니다.");
				}
			});
		});
		resetUI();
		bottomMove();
		setInterval(getNewMs, 5000); <?php //5초마다 한번씩 getNewMs 함수 발동 ?>
	});

	$(window).resize(function(){resetUI();});
	
	function resetUI(){
		$(".chat_box").width($(window).width());
		$(".chat_box").height($(window).height()-60);
	}
	function bottomMove(){ <?php //스크롤 아래 고정 함수 ?>
        var docHeight = $(".heightchk").height();
		$('.chat_box').scrollTop(docHeight); 
    }
	function topMove(){ <?php //스크롤 위 고정 함수 ?>
		$('.chat_box').scrollTop("0"); 
    }
	function input_Reset(){ <?php //메세지 입력란 입력 후 공백처리 ?>
		$(".input_ms").val('');
	}
	function addMsHidden(){
		$(".addMs").css("display","none");
	}
</script>