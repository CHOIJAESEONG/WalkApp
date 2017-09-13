<div align="center" style="z-index:100;top:45px;position:fixed;width:100%;padding:10px 0 10px 0;background-color:white;">
	현재 등록된 친구는 <b><?=$friendcnt?></b>명 입니다.  
</div>
<div class="list_box" id="myfriendlist">
	<form action="/friends/msRoomOther/" method="POST" id="form">
		<input type="hidden" id="friend_id" name="friend_id" value=""/>
	</form>
	<ul>
		<?php foreach($friendIds as $friendId ) { ?>
			<li>
				<div class="friend_box" name="<?=$friendId->친구_id?>">	
					<div class="friendsInfo" style="width:65%; height:100%;">
						<div class="mythumb"><img src="<?=경로_사용자?><?=$friendId->사진?>" alt=""></div>
						<div class="userName" style="padding:15px 0px;padding-left:70px;"><?=$friendId->이름?></div>
					</div>
					<div class="ms_bt" onclick="ms_bt_click('<?=$friendId->친구_id?>')">쪽지</div>
					<div class="del_bt">삭제</div>
				</div>
			</li>
		<?php } ?>
	</ul>
	<div id="pop_delete" class="pop-layer">
		<div class="pop-container">
			<div class="pop-conts">
				<p>친구 삭제	</p>
				<p class="ctxt mb20"></p>
				<div class="btn-r">
					<div id="ok">확인</div>
					<div id="cancel">취소</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="add_btn">
	<div class="container">친구 추가 및 초대</div>
</div>
<script>
	$(document).ready(function() {
		
		var name_id_tmp = "";
		var name_name_tmp = "";
					
		$('.del_bt').click(function(){ <?php //삭제버튼 클릭 ?>
			name_id_tmp = $(this).parent().attr("name");
			name_name_tmp = $(this).parent().find(".userName").html();
			$('#pop_delete').show();
			$('.ctxt').text(name_name_tmp+" 친구를 삭제하시겠습니까?");
		});

		
		$('.pop-layer #cancel').click(function() { <?php //삭제 시 팝업레이어의 취소 클릭 ?>
			$('#pop_delete').hide();
		});
		
		$('.pop-layer #ok').click(function() { <?php //삭제 시 팝업레이어의 확인 클릭 ?>
			$('#pop_delete').hide();				
			$.ajax({
				type:"POST", 
				url: "/friends/deleteFriends", 
				dataType:"text", 
				data:{
					"friend_id" : name_id_tmp
				},
				success: function(result){
					friendsReload(1);
				},error: function(result){
					alert("오류가 발생했습니다.");
				}
			});
		});
		
		$('.friendsInfo').click(function(){ <?php // 프로필 영역 클릭(친구정보 화면으로 이동)?>
			name_id_tmp=$(this).parent().attr("name");
			$.ajax({
				type:"POST", 
				url: "/friends/friendsInfo", 
				dataType:"text", 
				data:{
					"friend_id" : name_id_tmp
				},
				success: function(result){
					$(".result").html(result);
				},error: function(result){
					alert("오류가 발생했습니다.");
				}
			});
		});
	});

	function ms_bt_click(id){ <?php //post방식으로 파라미터 넘겨주기 위한 함수 ?>
		$("#friend_id").val(id);
		$("#form").submit();
	}
</script>