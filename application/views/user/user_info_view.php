<style>
	.user{
		width:100%; height:100%;
	}
	.userinfo, li{
		padding : 10px;
	}
	.userInfo_title{
		padding:15px;
	}
	.image{
		background-color:lightgrey;
		width: 100%;
		height: 150px;
	}
	.pwChange, .adsChange, .imgChange{
		border : 1px; 
		background : lightskyblue;
		width:5%;
		padding : 5px;
		color:white;
	}
	.userDelete{
		border : 1px solid black;
		text-align: center;
		cursor:pointer; 
		width:50%; 
		margin:0 auto; 
		padding:5px;
	}
	.logout{
		background:#60b9f0; 
		margin:50px; 
		margin-left:200px; 
		width:40%; 
		position:relative; 
		padding:10px 0px; 
		text-align:center; 
		color:white;
	}
	.userInfo_title{
		font-weight:bold; 
		font-size:20px;
	}
	.image_thumb{
		width: 100px;
		height: 100px;
		overflow: hidden;
		border-radius: 100px;
		clear:both;
		margin-top:30px;
	}
</style>
<div class="user">
	<div class="image" align="center">
		<div style="display:inline"><img class="image_thumb" src="<?=경로_사용자?><?=$info->사진 ?>" alt=""/></div>
		<div class="imgChange" style="cursor:pointer; display:inline"> 변경 </div>
	</div>
	<div class="userInfo">
		<div class="userInfo_title"> 내 정보 </div>
		<ul>
			<li> 이름 : <?=$info-> 이름?>	</li>
			<li> 성별 : <?=$info-> 성별?>	</li>
			<li> 아이디 : <?=$info-> 사용자_id?>	</li>
			<li> 비밀번호 : ********	<div class="pwChange" style="cursor:pointer; display:inline"> 변경 </div>
			<li> 이메일: <a href=""> <?=$info-> email?> </a> </li>
			<li> 주소 : <?=$info-> 주소?> <div class="adsChange" style="cursor:pointer; display:inline"> 변경 </div>	</li>
		</ul>
	</div>

	<div class="userDelete" align="center"> 회원탈퇴 </div> 
	<div class="logout"> 로그아웃 </div>
</div>
<script>
	$(document).ready(function() {			
		$('.pwChange').click(function() {
			location.href="/user/indexPw/1"
		});

		$('.adsChange').click(function() {
			location.href="/user/adsChangeIndex";
		});
		
		$('.userDelete').click(function() {
			location.href="/user/indexPw/2"
		});
		
		$('.logout').click(function(){
			alert("로그아웃 성공!!");
			location.href="/user/logout"
		});
	});
</script>