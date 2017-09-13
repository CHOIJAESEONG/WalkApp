<table style="z-index:100;position:fixed;width:100%;padding:10px 0 10px 0;background-color:#ffffff;">
	<tr>
		<td style="text-align:left;width:130px;padding-left:5px;"><b>대화중인 쪽지방</td>
		<td style="text-align:left;border-bottom:1px solid #555;"></td>
	</tr>
</table>
<div class="list_box" id="mscheck" style="padding-top:35px;">
	<form action="/friends/msRoom/" method="POST" id="form">
		<input type="hidden" id="groupId" name="groupId" value=""/>
	</form>
	<ul class="msCheck_box"><?php 
		foreach($friendIds as $friendId ) {
		?>
			<?php
			$date_temp=date_create($friendId->전송일시);
			$date_time = date_format($date_temp,"h:i:s");
			$date_ampm = date_format($date_temp,"A");
			$date_ampm =$date_ampm =="AM"?"오전":"오후";
			?> 
			<li>
				<div class="room_box" m_name="<?=$friendId->그룹_id?>">
					<div class="room_btn" style="margin-right:60px;min-height:50px;" onclick="room_btn_click('<?=$friendId->그룹_id?>')">
						<div class="mythumb2">
							<img src="<?=경로_사용자?><?=$friendId->사진?>" alt="">
						</div>
						<div style="margin-left:60px">
							<div class="userName"><b><?=$friendId->이름?></b></div>
							<input type="hidden" class="find" value="<?=$friendId->전송_id?>"/>
							<div class="time">
								<div style="position:relative">
									<?php if($friendId->확인여부=="N" && $friendId->전송_id!=$userId){ ?>
										<img class="badge" src="/mnt/walk/friends/N.PNG" alt="확인하지 않은 메세지에서 나타남">
									<?php } ?>
									<?=$date_ampm?> <?=$date_time?>
								</div>
							</div>
							<div class="text_over" v_id="<?=$friendId->쪽지_id?>">
								<?=$friendId->내용?>
							</div>
						</div>
					</div>
					<div class="det2" name="<?=$friendId->전송_id?>">삭제</div>
				</div>
			</li>
		<?php
		}
		?>
	</ul>
</div>
<div id="pop_delete" class="pop-layer">
	<div class="pop-container">
		<div class="pop-conts">
			<p>쪽지 삭제</p>
			<p class="ctxt mb20"></p>
			<div class="btn-r" value=" ">
				<div id="ok">확인</div>
				<div id="cancel">취소</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		var group_id_tmp = "";
		var name_name_tmp = "";
		var ms_id_tmp = "";
		msCheckEvent();
		setInterval(getNewCheck, 5000); <?php //5초마다 한번씩 getNewCheck 함수 발동 ?>
	});
	
	function room_btn_click(id){<?php //post방식으로 파라미터 넘겨주기 위한 함수 ?>
	
		$("#groupId").val(id); <?php //room_btn 클릭시에 groupId라는 id를 가진 input 태그에 value를 넣어준다. ?>
		$("#form").submit();
	}
	
	function getNewCheck(){
		<?php //새로운 메세지 왔을 때 refresh ?>
		$.ajax({
			type:"POST", 
			url:"/friends/refreshCheck", 
			dataType:"text",
			success: function(result){
				$(".msCheck_box").html(result.trim());
				msCheckEvent();
			},error: function(result){
				alert("오류가 발생했습니다.");
			}
		}); 		
	}
	
	function msCheckEvent(){ <?php //refresh할 때 이벤트 초기화를 방지하기 위한 함수 ?>
		
		$('.room_btn').each(function(){
			$(this).click(function(){
				$(this).parent().submit();
			});
		});
		$('.room_box .det2').click(function(){
			name_name_tmp=$(this).parent().find(".userName b").html();
			$('#pop_delete').show();
			$('.btn-r').attr("value",$(this).parent().attr("m_name"));
			$('.ctxt').text(name_name_tmp+" 님과의 쪽지를 삭제하시겠습니까?");
		});
		$('.pop-layer #cancel').click(function() {
			$('#pop_delete').hide();
		});
		$('.pop-layer #ok').click(function() {
			group_id_tmp = $(this).parent().attr("value");
			$('#pop_delete').hide();				
			$.ajax({
				type:"POST", 
				url: "/friends/deleteMs", 
				dataType:"text", 
				data:{
					"groupId" : group_id_tmp
				},
				success: function(result){
					friendsReload(3);
				},error: function(result){
					alert("오류가 발생했습니다.");
				}
			});
		});
	}
</script>