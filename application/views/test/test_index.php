<style>
	.tenIncrease, .hunIncrease, .thouIncrease{
		border : 1px solid black;
		float:left;
		text-align: center;
		cursor:pointer; 
		width:20%; 

	}
	.userInfo_box , tr, th, td{
		border:1px solid black;
	}
</style>
<table class="userInfo_box">
	<tr>
		<th> 사용자 아이디 </th>
		<th> 사용자 이름 </th>
		<th> 총 걸음수 </th>
		<th style="width:200px"> 걸음수 증가</th>
	</tr>
	
	<?php foreach($userInfos as $userInfo) { ?>	
	<tr>	
		<td class="user_id"><?= $userInfo-> 사용자_id ?> </td>
		<td class="name"><?= $userInfo -> 이름  ?> </td>
		<td class="walkcount"><?= $userInfo -> 총걸음수  ?> </td>
		<td class="incButton" style="width:200px" value="<?= $userInfo-> 사용자_id ?>">
			<div class="tenIncrease" style="margin-left:15px" value="10"> +10 </div>
			<div class="hunIncrease" style="margin-left:15px" value="100"> +100 </div>
			<div class="thouIncrease" style="margin-left:15px; width:50px" value="1000"> +1000 </div>
		</td>
	</tr>
	<?php } ?>
	
</table>		
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript"> 

	$(".tenIncrease").click(function(){
		var user_id = $(this).parent().attr("value");
		var count = $(this).attr("value");
		increaseCount(user_id, count);
		});
	
	$(".hunIncrease").click(function(){
		var user_id = $(this).parent().attr("value");
		var count = $(this).attr("value");
		increaseCount(user_id, count);
	});
	
	$(".thouIncrease").click(function(){
		var user_id = $(this).parent().attr("value");
		var count = $(this).attr("value");
		increaseCount(user_id, count);
	});
	
	function increaseCount(user_id, count){
		$.ajax({
			type:"POST", 
			url: "/test/increaseCount", 
			dataType:"json", 
			data:{
				"user_id" : user_id,
				"count" : count
			}, 
			success: function(result){
				location.href="/test/getUsersInfo"
			},error: function(result){
			}
		});
	}
</script>