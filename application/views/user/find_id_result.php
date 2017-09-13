<style>
	.findIdResult_view{
		width:100%;
		height:100%;
	}
	.findIdResult_title{
		font-size:20px; 
		text-align:center; 
		padding:30px; 
		padding-bottom:5%; 
		color:#979797
	}
	.findIdResult_view .msg2{
		padding:5%; 
		padding-bottom:15%; 
		text-align:center; 
		color:#979797;
	}
	.findIdResult_content{
		padding:5%; 
		padding-bottom:15px; 
		border:1px solid black; 
		margin-bottom : 150px;
	}
	.findIdResult_view .login{
		background:#60b9f0; 
		margin:10px auto; 
		width:70%; 
		position:relative; 
		padding:10px 0px; 
		text-align:center; 
		color:white;
	}
	.findIdResult_view .findpwBtn{
		background:#60b9f0; 
		margin :10px auto; 
		width:70%; 
		position:relative; 
		padding:10px 0px; 
		text-align:center; 
		color:white;
	}
</style>
<div class="findIdResult_view">
	<div class="findIdResult_title"> 아이디 찾기 </div>
	<div class="msg2">
		입력하신 정보와 일치하는 아이디 목록입니다. </br>
		아이디를 확인한 후, 로그인 또는 비밀번호 찾기버튼을 눌러주세요.
	</div>
	<div class="findIdResult_content">
		<div style="display:inline"> <?=$fid -> 사용자_id?> </div>
		<div style="float:right;"> 가입일 : <?=$fid -> 가입일?> </div>
	</div>
	<div class="login"> 로그인 </div>
	<div class="findpwBtn"> 비밀번호 찾기 </div>
</div>
<script>
	$(document).ready(function() {
		$('.login').click(function() {
			location.href="/user/loginIndex";
		});
		
		$('.findpwBtn').click(function() {   
			location.href="/user/findPwIndex";
		});
	});
</script>