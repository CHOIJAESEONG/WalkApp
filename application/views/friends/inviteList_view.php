<div class="list_box">
	<div class="invite_container">
		나와 친구를 맺고 있는 참가자 입니다.
	</div>
	<ul>
		<?php foreach($invitefriends as $invitefriend ) { ?>
			<li>
				<div class="invite_box">	
					<div class="mythumb"><img src="<?=경로_사용자?><?=$invitefriend->사진?>" alt=""></div>
					<div class="userName" style="margin:15px 0px;margin-left:70px;"><?=$invitefriend->이름?></div>
					<?php 
					if($invitefriend->상태 == '초대'){ 
					?>
						<div class="id_box" v_id="<?=$invitefriend->친구_id?>" v_name="<?=$invitefriend->이름?>">	
							<div class="invite_bt" name="<?=$invitefriend->이름?>"><?=$invitefriend->상태?></div>
						</div>
					<?php 
					}else{ 
					?>
						<div class="notinvite_bt"style="background-color:#d1f9b6; color:#cdcdcd;"><?=$invitefriend->상태?></div>
					<?php 
					} 
					?>
				</div>
			</li>
		<?php } ?>
	</ul>
</div>
<div id="pop_delete" class="pop-layer">
	<div class="pop-container">
		<div class="pop-conts">
			<p>친구 초대</p>
			<p class="ctxt mb20"></p>
			<div class="btn-r">
				<div id="ok">확인</div>
				<div id="cancel">취소</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		var name_id_tmp = "";
		var name_name_tmp="";
			
		$('.invite_bt').click(function() {
			name_name_tmp = $(this).parent().attr("v_name");
			name_id_tmp	  = $(this).parent().attr("v_id");
			$('#pop_delete').show();
			$('.ctxt').text(name_name_tmp+" 친구를 참여 중인 대회에 초대하시겠습니까?");
		});
			
		$('.pop-layer #cancel').click(function() {
			$('#pop_delete').hide();
		});
		
		$('.pop-layer #ok').click(function() {
			$('#pop_delete').hide();			
			$.ajax({
				type:"POST", 
				url: "/friends/insertInvite", 
				dataType:"text", 
				data:{
					"friend_id" : name_id_tmp
				},
				success: function(result){
					inviteReload(1);
				},error: function(result){
					alert("오류가 발생했습니다.");
				}
			});  
		});
	});
</script>