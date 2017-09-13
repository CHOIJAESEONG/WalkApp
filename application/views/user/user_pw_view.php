<style>
	.pwView{
		width:100%; 
		height:100%;
	}
	.pw_title {
		padding: 30px;
		padding-bottom:10%;
		font-size:20px; 
		text-align:center;
	}
	.pw_content{
		text-align:center;
		padding-top:10%; 
		width:100%; height:100%
	}
	.sb{
		position:absolute;
		width:100%; 
		margin:0 auto;
		bottom:20%;
	}
	.pwView .nextBtn{
		background:#60b9f0; 
		margin:50px auto; 
		width:70%; 
		position:relative; 
		padding:10px 0px; 
		text-align:center; 
		color:white;
	}
</style>
<div class="pwView">
	<div class="pw_title"> 비밀번호 확인 </div>
	<div class="pw_content">
		<form action="/user/<?=(($check==1)? "pwChange":"pwCheck")?>/<?=$check?> " method="post" class="pwinfo">
			<div style="line-height:300px">
				<input type="password" name="password" placeholder="현재 비밀번호를 입력하세요" style="padding-right:100px;,padding-left:100px; padding-bottom:10px;border:none; border-bottom:1px solid black; width:100%; text-align:center">
			</div>
			<div style="color:red">
				<?=$pw_error?> 
			</div>
		</form>
	</div>
	<div class="nextBtn"> 다음 단계 </div>		
</div>
<script>
	$(document).ready(function() {			
		$('.nextBtn').click(function() {
			$('.pwinfo').submit();
		});
	});
</script>
  
