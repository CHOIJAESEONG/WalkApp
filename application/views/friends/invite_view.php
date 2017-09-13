<style>
.table_container{
	margin:0px 0px 0px 10px;
}
.table_layer{
	width:100%;
	background-color:white;
	table-layout:fixed;
}
</style>
<div class="sub_menu_tab">
	<ul>
		<li id="sub_left" onclick="friendsReload2(1);changeFont(4)">내 친구초대</li>
		<li id="sub_right" onclick="friendsReload2(2);;changeFont(5)">대회참여 초대</li>
	</ul>
</div>
<div class="res" style="margin-top:100px;">
</div>
<script>
	$(document).ready(function() {
		friendsReload2(1);
		changeFont(4);
	});
	<?php //소메뉴 클릭시 페이지 이동을 위한 함수 ?>
	function friendsReload2(idx){
		switch(idx){
		case 1:
			$(".res").load("/friends/inviteFriends"); 
			break;
		case 2:
			$(".res").load("/friends/inviteEvents");
			break;
		}
	};
</script>