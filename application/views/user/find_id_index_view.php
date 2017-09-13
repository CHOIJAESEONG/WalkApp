<style>
	.findId_view{
		width:100%;
		height:100%;
	}
	
	.findId_title{
		font-size:20px; 
		text-align:center; 
		padding:30px; 
		padding-bottom:5%; 
		color:#979797;
	}
	.findId_view .msg{
		padding:5%; 
		padding-bottom:15%; 
		text-align:center; 
		color:#979797;
	}
	.findId_contents{
		padding:5%; 
		padding-bottom:15px;
	}
	.findId_contents .vcCode{
		background:#60b9f0; 
		margin-left:10px; 
		width:120px; 
		position:relative; 
		padding:10px 10px; 
		text-align:center; 
		color:white; 
		display:inline
	}
	.findId_contents #myCode{
		width:80%; 
		border:none;
		border-bottom:1px solid #979797; 
		padding-bottom:10px; 
		margin-bottom:20px; 
		display:inline;
	}
	.findId_contents .check{
		background:#60b9f0;
		text-align:center; 
		color:white; 
		width:50%; 
		margin:0 auto; 
		padding:10px 0;
	}
	.findId_contents .nextBtn{
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
<div class="findId_view">
	<div class="findId_title"> 아이디 찾기 </div>
	<div class="msg">
		회원정보에 등록한 휴대폰 번호와 입력한 휴대폰 번호가 같아야, 인증정보를 받을 수 있습니다.
	</div>
	<div class="findId_contents">
		<form method="post" class="info" action="/user/findId">
			<div> <input type="text" id="name" name="name" placeholder="이름 입력" style="border:none; border-bottom: 1px solid #979797; margin-bottom:5%; padding-bottom:10px; width:100%">
			</div>
			<div> <input type="text" id="phone" name="phone" placeholder="휴대폰번호 입력" style="width:100%; border:none; border-bottom:1px solid #979797; padding-bottom:10px; margin-bottom:20px;">
			</div>
		</form>
		
		<div class="vcCode"> 인증번호 요청	</div>
		<div class="codeValue" style="padding:5%; color:red;">
		</div>
		<div> 
			<input type="text" id="myCode" placeholder="인증번호 입력">
			<div class="check">  인증번호 확인 </div>				
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('.vcCode').click(function() {
			
			if($('#name').val()=="" || $('#phone').val()==""){
				alert("내용을 다 입력하지 않았습니다.");
				return;
			}
			
			$.ajax({
				type:"POST", 
				url: "/user/insertCode", 
				dataType:"json", 
				data:{ 	"name" : $("#name").val(),
						"phone" : $("#phone").val()
				}, 
				success: function(result){
					if (result["cnt"]==0){
						alert("일치하는 정보가 없습니다.");
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
				url: "/user/checkCode", 
				dataType:"json", 
				data:{ 	"name" : $("#name").val(),
						"phone" : $("#phone").val(),
						"code" : $("#myCode").val()
				}, 
				success: function(result){
					<?php //DB에 인증번호 저장 후 인증번호 보여주기 ?>
					if(result==1){
						$('.info').submit();
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