<style>
	#message{
		width:100%;
		height:100%
	}
	.messageTab{
		border-bottom:1px solid black; 
		padding-bottom:15px
	}
</style>
<div class="message">
	<div class="messageTab" align="center">
		<div id="os" style="display:inline; border-right:1px solid black;font-weight:bold; font-size:25px" onclick="pageloading(1)"> 개회사 </div>
		<div id="message" style="display:inline; margin-left:10px; font-size:25px" onclick="pageloading(2)">축하메시지 </div>
	</div>
	<div class="contents">
	</div>
</div>
<script type="text/javascript"> 
	$(document).ready(function() {
		pageloading(<?= $index?>);
	});
	
	function pageloading(index){
		switch(index){
			case 1 : 
				$("#os").css("font-weight","bold");
				$(".messageTab #message").css("font-weight","");
				$(".contents").load("/message/celeIndex_sub/"+index);
				break;
			case 2: 
				$("#os").css("font-weight","");
				$(".messageTab #message").css("font-weight","bold");
				$(".contents").load("/message/celeIndex_sub/"+index);
				break;
		}
		
	}

</script>