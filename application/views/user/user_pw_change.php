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
		cursor:pointer; 
		width:70%; 
		margin:100px auto; 
		text-align:center; 
		padding:15px 0;
	}
</style>
<div class="pwChange_view">
	<div class="pwChange_title"> 비밀번호 재설정 </div>
	<div class="pwChange_content" style="padding-bottom:70px">
		<form action="" method="post" id="newPassword">
			<div> 아이디 : <?=$info-> 사용자_id?> 
			</div>
			<div> 새 비밀번호 <input type="password" id="newpw" style="border:none;border-bottom:1px solid black"> </div>
			<div style="margin-left:20%"> 7~8자, 영문, 숫자, 특수문자 사용 </div>
			<div> 새 비밀번호 확인 <input type="password" id="newpw2" style="border:none;border-bottom:1px solid black"> 
			</div>
		</form>
	</div>
	<div class="pwChange"> 변경완료 </div>
</div>
<script>
	$(document).ready(function() {
		$('.pwChange').click(function() {
			if($("#newpw").val()!= $("#newpw2").val()){
				alert("비밀번호가 서로 일치하지 않습니다");
				$("#newpw").val("");
				$("#newpw2").val("");
			}else{
				$.ajax({
					type:"POST", 
					url: "/user/newPwSet", 
					dataType:"json", 
					data:{
						"password" : $("#newpw").val()
					}, 
					success: function(result){
						alert("변경 완료");
						location.href="/user/userInfo"
					},error: function(result){
					}
				});
			}
		});
	});
</script>
