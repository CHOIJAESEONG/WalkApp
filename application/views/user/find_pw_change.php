<style>
	.pwChange_view{
		width:100%;
		height:100%;
	}
	.pwChange_title {
		padding: 30px;
		padding-bottom:10%;
		font-size:20px; 
		text-align:center;
	}
	div{
		padding : 10px; 	
	}
	.pwChange{
			border : 1px; 
			background : lightskyblue;
			padding : 5px;
			color:white;
	}
	.pwChange_view .msg{
		padding:5%; 
		padding-bottom:15%; 
		text-align:center; 
		color:#979797;
	}
	.pwChange_view .pwChange{
		cursor:pointer; 
		width:70%; 
		margin:0 auto; 
		text-align:center;
	}
</style>
<div class="pwChange_view">
	<div class="pwChange_title"> 비밀번호 재설정 </div>
	<div class="msg">
		본인확인 절차가 모두 완료되었습니다. <br> 비밀번호를 새로 설정해주세요.
	</div>
	<div class="pwChange_content" style="padding-bottom:70px">
		<form action="" method="post" id="newPassword">
			<div> 아이디 : <input type="hidden" id="user_id" value="<?=$user_id?>"> <?=$user_id?> 
			</div>
			<div> 새 비밀번호 <input type="password" id="newpw" style="border:none;border-bottom:1px solid black"> </div>
			<div style="margin-left:20%"> 7~8자, 영문, 숫자, 특수문자 사용 </div>
			<div> 새 비밀번호 확인 <input type="password" id="newpw2" style="border:none;border-bottom:1px solid black"> 
			</div>
		</form>
	</div>
	<div class="pwChange"> 비밀번호 변경완료 </div>
</div>
<script>
	$(document).ready(function() {
		
		$('.pwChange').click(function() {
			if($("#newpw").val()!= $("#newpw2").val()){
				alert("새 비밀번호가 서로 일치하지 않습니다");
				$("#newpw").val("");
				$("#newpw2").val("");
			}else{
				$.ajax({
					type:"POST", 
					url: "/user/newPwSet2", 
					dataType:"json", 
					data:{
						"user_id" : $("#user_id").val(),
						"password" : $("#newpw").val()
					}, 
					success: function(result){
						alert("변경 완료");
						location.href="/user/loginIndex"
					},error: function(result){
					}
				});
			}
		});
	});
</script>