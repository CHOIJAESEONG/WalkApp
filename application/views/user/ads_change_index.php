<style>
	.adsChange_view{
		width:100%;
		height:100%;
	}
	.adsChange_title {
		padding: 30px;
		padding-bottom:10%;
		font-size:20px; 
		text-align:center;
	}
	div{
		padding : 10px; 	
	}
	.adsChange{
		border : 1px; 
		background : lightskyblue;
		padding : 5px;
		color:white;
		cursor:pointer; 
		width:70%; 
		margin:100px auto; 
		text-align:center; 
		padding:15px 0;
	}
</style>
<div class="adsChange_view">
	<div class="adsChange_title"> 주소 재설정 </div>
	<div class="adsChange_content" style="padding-bottom:70px">
		<form action="/user/adsChange" method="post" class="newAddress">
			<div> 아이디 : <?=$user_id?> 
			</div>
			<div> 변경할 주소를 입력하세요. <input type="text" name="newAdd" id="newAdd" style="border:none;border-bottom:1px solid black"> </div>
		</form>
	</div>
	<div class="adsChange"> 변경완료 </div>
</div>
<script>
	$('.adsChange').click(function() {
			$('.newAddress').submit();
	});
</script>
