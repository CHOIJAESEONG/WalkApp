<div class="menu_tab">
	<ul>   
		<li id="myfriends" onclick="friendsReload(1);changeFont(1)">내 친구</li>
		<li id="invite" onclick="friendsReload(2);changeFont(2)">친구초대</li>
		<li id="messege" onclick="friendsReload(3);changeFont(3)">쪽지보기</li>
	</ul>
</div>
<div class="result" style="margin-top:40px;"></div>
<script>
	$(document).ready(function() {
		friendsReload(1);
	});
</script>
