<style>
body{margin:0px;}
.top_content .background{
	background-image: url("<?=경로_걷기대회?>prize_companies.png");
    background-size: contain;
    opacity: 1.0!important;
    filter:alpha(opacity=30);
    width: 100%;
    height: 100%;
    position: absolute;
}

.top_content .content{
    position: absolute;
    width: 100%;
    height: 100%;
    text-align: -webkit-center;
    background: #282525;
    opacity: 0.9!important;
}

.top_content .prize_image{
	width: 100%;
    height: 40%;
}

.top_content .loading_gif{
    width: 10%;
    height: 5%;
}

</style>

<div class="top_content">
	<div class= "background_img">
		<div class = "background"></div> 
	</div>
	
	
	<div class="content" style="opacity: 0!important">	
			<p><b style="color:white">광고 후 곧 발표됩니다!</b></p>
			<img class="prize_image" src="<?=경로_걷기대회?>prize_camera.jpg"></img>
			<p><b style="color:white">협찬사 광고시청 후 결과를 보실 수 있습니다.</b></p>
			<p id=ShowSeconds style="color:white"></p>
			<img class="loading_gif" src="<?=경로_걷기대회?>loading.gif"></img>
			<p><b style="color:white">조회중..</b></p>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		window_onload();
	});
	function window_onload(){
	    setTimeout('show_content()',2000)  // 2초후 show_content() 함수를 호출한다.
	}
	
	function show_content(){
		$('.background_img').animate({
			opacity: 0.5
		},1000);

		$('.content').animate({
			opacity: 1
		},function(){
			setShowTime();
			setInterval('setShowTime()',1000);	
		});
	}
	
	var second=10;
	function setShowTime(){
		$("#ShowSeconds").html(second+"초");
		if(second !=0){
			second--;
		}
	}

	
</script>

