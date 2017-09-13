<style>
.eventthumb{
	margin: 10px auto;
	width: 50px;
	height: 50px;
	overflow: hidden;
	display: block;
	border-radius: 50px;
	text-align: center;
	position:absolute;
	left:4%;
	top:20%;
}
	
.eventthumb img{
	width: 50px;height: 50px;
}
</style>
<div class="list_box">
	<div>
		<div class="table_container">
			<table class="table_layer">
				<tr>
					<td style="text-align:left;width:130px;"><b>나를 초대한 친구</td>
					<td style="text-align:left;border-bottom:1px solid #555"></td>
				</tr>
			</table>
		</div>
		<ul><?php foreach($friendIds as $friendId ) { ?>
				<li>
					<div class="friend_box" name="<?=$friendId->초대_id?>">	
						<div class="eventthumb"><img src="<?=경로_사용자?><?=$friendId->사진?>" alt=""></div>
						<div class="userName" style="margin:15px 0px;margin-left:70px;"><?=$friendId->이름?></div>
						<div class="eventId" v_id="<?=$friendId->걷기대회_id?>" style="margin:15px 0px;margin-left:70px;"><?=$friendId->제목?></div>
						<div class="accept_bt">참여하기</div>
						<div class="reject_bt">거절</div>
					</div>
				</li>
			<?php } ?>
		</ul>
	</div>
	<div>
		<div class="table_container">
			<table class="table_layer">
				<tr>
					<td style="text-align:left;width:130px;"><b>내가 초대한 친구</td>
					<td style="text-align:left;border-bottom:1px solid #555"></td>
				</tr>
			</table>
		</div>
		<ul><?php foreach($userIds as $userId ) { ?>
				<li>
					<div class="friend_box" name="<?=$userId->초대_id?>">	
						<div class="eventthumb"><img src="<?=경로_사용자?><?=$userId->사진?>" alt=""></div>
						<div class="userName" style="margin:15px 0px;margin-left:70px;"><?=$userId->이름?></div>
						<div class="subeventId" v_name="<?=$userId->걷기대회_id?>" style="margin:15px 0px;margin-left:70px;"><?=$userId->제목?></div>
						<div class="invite_bt" style="background-color:#d1f9b6;color:#b2b2b2;" disabled>초대중</div>
						<div class="cancel_bt">취소</div>
					</div>
				</li>
			<?php } ?>
		</ul>
	</div>
	<div id="pop_delete" class="pop-layer">
		<div class="pop-container">
			<div class="pop-conts">
				<p>초대 거절</p>
				<p class="ctxt mb20"></p>
				<div class="btn-r">
					<div id="ok">확인</div>
					<div id="cancel">취소</div>
				</div>
			</div>
		</div>
	</div>
	<div id="pop_accept" class="pop-layer2">
		<div class="pop-container">
			<div class="pop-conts">
				<p>초대 수락</p>
				<p class="ctxt mb20"></p>
				<div class="btn-r">
					<div id="ok">확인</div>
					<div id="cancel">취소</div>
				</div>
			</div>
		</div>
	</div>
	<div id="pop_cancel" class="pop-layer4">
		<div class="pop-container">
			<div class="pop-conts">
				<p>초대 취소</p>
				<p class="ctxt mb20"></p>
				<div class="btn-r">
					<div id="ok">확인</div>
					<div id="cancel">취소</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
	
		var name_id_tmp = "";
		var name_name_tmp = "";
		var event_id_tmp = "";
		
		<?php //수락하기 버튼 클릭 시 작동 ?>
		$('.accept_bt').click(function(){
			event_id_tmp = $('.eventId').attr("v_id");
			name_name_tmp = $(this).parent().find(".userName").html();
			$('#pop_accept').show();
			$('.ctxt').text(name_name_tmp+"님이 초대한 대회에 참여하시겠습니까?");
		});
		
		$('.pop-layer2 #cancel').click(function() {
			$('#pop_accept').hide();
		});
		
		$('.pop-layer2 #ok').click(function() {
			$('#pop_accept').hide();				
			$.ajax({
				type:"POST", 
				url: "/friends/acceptEvents", 
				dataType:"text", 
				data:{
					"event_id" : event_id_tmp
				},
				success: function(result){
					friendsReload2(2);
				},error: function(result){
					alert("오류가 발생했습니다.");
				}
			});
		});
		
		<?php //거절 버튼 클릭 시 작동	?>
		$('.reject_bt').click(function(){
			event_id_tmp = $('.eventId').attr("v_id");
			name_id_tmp = $(this).parent().attr("name");
			name_name_tmp = $(this).parent().find(".userName").html();
			$('#pop_delete').show();
			$('.ctxt').text(name_name_tmp+"님의 대회참여 초대를 거절하시겠습니까?");
		});
		
		$('.pop-layer #cancel').click(function() {
			$('#pop_delete').hide();
		});
		
		$('.pop-layer #ok').click(function() {
			$('#pop_delete').hide();				
			$.ajax({
				type:"POST", 
				url: "/friends/rejectEvents", 
				dataType:"text", 
				data:{
					"mode" : '1',
					"invite_id" : name_id_tmp,
					"event_id" : event_id_tmp
				},
				success: function(result){
					friendsReload2(2);
				},error: function(result){
					alert("오류가 발생했습니다.");
				}
			});
		});

		<?php //취소 버튼 클릭 시 작동	?>
		$('.cancel_bt').click(function(){
			event_id_tmp = $('.subeventId').attr("v_name");
			name_id_tmp = $(this).parent().attr("name");
			name_name_tmp = $(this).parent().find(".userName").html();
			$('#pop_cancel').show();
			$('.ctxt').text(name_name_tmp+"님에게 대회참여 초대를 취소하시겠습니까?");
		});
		
		
		$('.pop-layer4 #cancel').click(function() {
			$('#pop_cancel').hide();
		});
		
		$('.pop-layer4 #ok').click(function() {
			$('#pop_cancel').hide();				
			$.ajax({
				type:"POST", 
				url: "/friends/rejectEvents", 
				dataType:"text", 
				data:{
					"mode" : '2',
					"invite_id" : name_id_tmp,
					"event_id" : event_id_tmp
				},
				success: function(result){
					alert(result);
					friendsReload2(2);
				},error: function(result){
					alert("오류가 발생했습니다.");
				}
			});
		});
	});

</script>
