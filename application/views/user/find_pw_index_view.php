<style>
	.findPw_view{
		width:100%;
		height:100%;
	}
	.findPw_title{
		font-size:20px; 
		text-align:center; 
		padding:30px; 
		padding-bottom:5%; 
		color:#979797;
	}
	.findPw_view .msg{
		padding:5%; 
		padding-bottom:10%; 
		text-align:center; 
		color:#979797;
	}
	.findPw_view .vcCode{
		background:#60b9f0; 
		margin-left:10px; 
		width:120px; 
		position:relative; 
		padding:10px 10px; 
		text-align:center; 
		color:white; 
		display:inline;
	}
	.findPw_view .codeValue{
		padding:5%; 
		color:red;
	}
	
	.findPw_view #myCode{
		width:80%; 
		border:none; 
		border-bottom:1px solid #979797; 
		padding-bottom:10px; 
		margin-bottom:20px; 
		display:inline;
	}
	.findPw_view .check{
		background:#60b9f0; 
		text-align:center; 
		color:white; 
		width:50%; 
		margin:0 auto; 
		padding:10px 0;
	}
	.findPw_view .nextBtn{
		background:#60b9f0; 
		margin:10px; 
		width:100%; 
		position:relative; 
		padding:10px 0px; 
		text-align:center; 
		color:white; 
		display:none;
	}
</style>
<div class="findPw_view">
	<div class="findPw_title"> 비밀번호 찾기 </div>
	<div class="msg">
		비밀번호를 찾고자 하는 아이디를 입력하세요.
	</div>
	<form method="post" action="/user/findPw" class="findPw_contents" style="padding:5%; padding-bottom:15px;">
		<div> <input type="text" id="user_id" name="user_id" placeholder="아이디 입력" style="border:none; border-bottom: 1px solid #979797; margin-bottom:5%; padding-bottom:10px; width:100%">
		</div>
		<div> <input type="text" id="name" name="name" placeholder="이름 입력" style="border:none; border-bottom: 1px solid #979797; margin-bottom:5%; padding-bottom:10px; width:100%">
		</div>
		<div> <input type="text" id="phone" name="phone" placeholder="휴대폰번호 입력" style="width:100%; border:none; border-bottom:1px solid #979797; padding-bottom:10px; margin-bottom:20px;">
		</div>
		
		<div class="vcCode"> 인증번호 요청	</div>
		<div class="codeValue">	</div>
		<div> 
			<input type="text" id="myCode" placeholder="인증번호 입력">
			<div class="check">  인증번호 확인 </div>
		</div>
	</form>
</div>
<script>
	$(document).ready(function() {
		$('.vcCode').click(function() {
			
			if($('#user_id').val()=="" || $('#name').val()=="" || $('#phone').val()==""){
				alert("내용을 다 입력하지 않았습니다.");
				return;
			}
			$.ajax({
				type:"POST", 
				url: "/user/insertCode2", 
				dataType:"json", 
				data:{  "user_id" : $("#user_id").val(),
						"phone" : $("#phone").val(),
				}, 
				success: function(result){
					if (result["cnt"]==0){
						alert("일치하는 정보가 없습니다.");
						$('#user_id').val("");
						$('#name').val("");
						$('#phone').val("");
						return;
					}else{
						<?php //DB에 인증번호 저장 후 인증번호 보여주기 ?>
						$(".codeValue").text("해당번호로 인증번호를 발송했습니다. " + result["rand_num"]);
					}
				},error: function(result){
				}
			});
		});
		
		$('.check').click(function() {   
			$.ajax({
				type:"POST", 
				url: "/user/checkCode2", 
				dataType:"json", 
				data:{ "user_id" : $("#user_id").val(),
						"code" : $("#myCode").val()
				}, 
				success: function(result){
					<?php //DB에 인증번호 저장 후 인증번호 보여주기 ?>
					if(result==1){
						$('.findPw_contents').submit();
					}else{
						alert("인증번호가 틀렸습니다");
						$(".codeValue").text("");
						$("#myCode").val("");
					}
				},error: function(result){
				}
			});
		});
	});
</script>