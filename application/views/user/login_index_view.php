<style>
body{background:#000;}
.login_view{
	width:100%;
	height:100%;
}
.login_title {
	padding: 30px;
	padding-bottom:5%;
	font-size:20px; 
	text-align:center;
}
.login_content{
	padding:10%; 
	padding-bottom:15px;
}
.login_view .errMessage{
	color:red; 
	height:30px; 
	font-size:15px; 
	font-weight:bold;
}
.login_view .login_bt{
	border : 1px; 
	padding-left : 5%;padding-right:5%;
	color:white;
	cursor:pointer; 
	width:100%; 
	padding:0px; 
	margin:40px auto;
	position:relative;
}
.funcs{
	padding:5%; 
	color:#979797;
}
.funcs #register{
	display:inline; 
	border-right:1px solid #979797; 
	padding-right:5px;
}
.funcs #findId{
	display:inline; 
	border-right:1px solid #979797; 
	padding-left:5px;
}
.funcs #findPw{
	display:inline; 
	padding-left:5px;
}
</style>

<div class="splash" style="height:100vh;background:#000000;transition:1s;display:table;width:100%;">
	<span style="font-size:40px;font-weight:bold;color:white;display:table-cell;vertical-align:middle;text-align:center;">WISH WALK</span>
</div>

<div class="login_view" style="opacity:0;transition:1s;background:#000;color:white;">
	<div class="login_title"> 로그인 하기 </div>
	<div class="login_content">
		<form action="/index" class="logininfo" method="post">
			<input type="text" id="user_id" placeholder="아이디" style="border:none; border-bottom: 1px solid #979797; margin-bottom:5%; padding-bottom:10px; width:100%">
			<input type="password" id="password" placeholder="비밀번호" style="width:100%; border:none; border-bottom:1px solid #979797; padding-bottom:10px;">	
		</form>
	</div>
	<div class="errMessage" align="center">	
	</div>
	<div class="login_bt" align="center" style=""> 
		<div style="background:#60b9f0; margin:0px 10%; height:100%; position:relative; padding:20px 0px;"> 로그인 </div>
	</div>
	
	<div class="funcs" align="center">
		<div id="register"> 회원가입 </div>
		<div id="findId"> 아이디 찾기 </div>
		<div id="findPw"> 비밀번호 찾기 </div>
	</div>
</div>
<script>
	$(document).ready(function() {
		
		$(".splash").find("span").animate({
			opacity: 0,
		}, 500, function() {
			$(".splash").find("span").animate({
			opacity: 1,
			}, 500, function() {
	
				$(".splash").css("height","30vh");
				
				setTimeout(function () {
					
					$(".login_view").css("opacity",1);
					start();
										
				}, 1000);
					
			});
		});
		
	});
	
	function start(){
		$('.login_bt').click(function() {
			$user_id = $("#user_id").val();
			$.ajax({
				type:"POST", 
				url: "/user/loginCheck", 
				dataType:"json", 
				data:{ "user_id" : $("#user_id").val(),
					"password" : $("#password").val()
				}, 
				success: function(result){
					<?php // result가 1이면 로그인이 성공한 경우 , result가 0이면 실패?>
					if(result==1){
						<?php if(ENVIRONMENT=="mig"||ENVIRONMENT=="stage"){
							echo "location.href='/activity/MainActivity_1'";
						}
						else{
							echo "$('.logininfo').submit()";
						}?>
					}else{
						$("#user_id").val("");
						$("#password").val("");
						$('.errMessage').html("아이디 또는 비밀번호가 일치하지 않습니다");
					}
				},error: function(result){
					
				}
			});
		});

		$('#register').click(function() {
			location.href="/user/registerIndex";
		});
		$('#findId').click(function() {
			location.href="/user/findIdIndex";
		});
		$('#findPw').click(function() {
			location.href="/user/findPwIndex";
		});
	
	}
		
</script>