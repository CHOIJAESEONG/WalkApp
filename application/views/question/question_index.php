<style>
	.questionTab{
		background-color:#ffc107;
		
	}

</style>
<div>
	<div class="questionTab" align="center"> 
		<div id="FAQ" style="display:inline; border-right:1px solid black;font-weight:bold; font-size:25px" onclick="pageloading(41)"> FAQ </div>
		<div id="question" style="display:inline; margin-left:10px; font-size:25px" onclick="pageloading(42)"> 문의하기 </div>
	</div>
	<div class="contents">
	</div>
</div>
<script>
	$(document).ready(function(){
		pageloading(41);
	});
	
	function pageloading(index){
		switch(index){
			case 41:
				$("#FAQ").css("font-weight","bold");
				$(".questionTab #question").css("font-weight","");
				$(".contents").load("/question/questionIndex_sub/"+index);
				break;
			case 42:
				$("#FAQ").css("font-weight","");
				$(".questionTab #question").css("font-weight","bold");
				$(".contents").load("/question/questionIndex_sub/"+index);
				break;
		}		
	}

</script>
