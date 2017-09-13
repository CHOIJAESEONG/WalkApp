<style>
	.guide{
		padding:15px;
	}
	.queKind{
		float:right;
		margin-right:30px;
		font-size:15px;
		width:60%;
		padding:5px;
		background:#b7b5b5;
		
	}
	.question_content>div{	
		margin:5px;
		width:90%;
	}
	#contents{
		width:90%;
		height:100px;
		margin:5px;
	}
	#name_t,#email_t{
		width:35%;
		float:left;
	}
	#name_c, #email_c{
		width:50%;
		float:left;
	}
	.adm{
		margin:10px;
	}
	.inquiry{
		width:90%;
		background:#ffc107;
		text-align:center;
		font-weight:bold;
		padding:5px;
		cursor:pointer; 
	}
</style>
<div class="que" style="width:100%;height:100%;">
	<div class="guide">
	  서비스 이용에 궁금한 점이나 개선사항에 대해 알려주세요. <br>
	  보내주신 내용을 토대로 서비스 개선에 반영하겠습니다.
	</div>
	<div>
		<form action="/board/insertQue" method="post" class="question">
			<div style="height:50px">
				<select class="queKind" name="queKind">
					<?php foreach($qnaTitles as $qnaTitle){ ?>
							<option value="<?= $qnaTitle -> 공통코드_id?>"> <?= $qnaTitle -> 코드명 ?> </option>
					<?php } ?>
				</select>
			</div>
			<div class="question_content"> 
				<div id="name_t"> 이름  </div>
				<div id="name_c"> <input type="text" id="name" name="name" size="30"></div>
				<div id="email_t"> 이메일 </div>
				<div id="email_c"> <input type="text" id="email" name="email" size="30"> </div>
				<textarea id="contents" name="contents" placeholder="내용을 입력하세요"></textarea>
			</div>
		</form>
	</div>
	<div class="adm">
		포커스뉴스<br>
		담당자 이메일 : asdd@focus.co.kr <br>
		팩스 : 02-580-2900
	</div>
	<div class="inquiry"> 문의하기 </div>
</div>
<script>
	$(document).ready(function(){
		$(".inquiry").click(function(){
			$('.question').submit();
		});
	});
</script>
