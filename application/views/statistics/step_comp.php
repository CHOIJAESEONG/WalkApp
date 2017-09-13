<div class="navbar-inner">
	<div style="display:table;width:30%;height:100%;">
		<a href="#" class="link prev" style="display:table-cell;vertical-align:middle;">
			<img src="<?=IMG_PATH?>MainActivity_1/main_arrow_left.png" style="display:table-cell;height:80%;float:right;">
		</a>
	</div>
	
	<div class="step" style="width:40%;height:100%;text-align:center;padding-top:15px;">
		<span style="color:#c7c7c7;"></span>
		<h3></h3>
	</div>
	
	<div style="display:table;width:30%;height:100%;">
		<a href="#" class="link next" style="display:table-cell;vertical-align:middle;">
			<img src="<?=IMG_PATH?>MainActivity_1/main_arrow_right.png" style="display:table-cell;height:80%;">
		</a>
	</div>
</div>

<script>
var cnt = 0;
var step_info = new Array();
    <?php foreach($step_info as $val){ ?>
        step_info.push(JSON.parse('<?=$val?>'));
    <?php } ?>
$("div[comp_prop='step_comp']").find(".step").find("span").text(step_info[0].날짜);
$("div[comp_prop='step_comp']").find(".step").find("h3").text(step_info[0].걸음수);
$("div[comp_prop='step_comp']").find(".link").on("click",function(){
	if($(this).attr("class").indexOf("next")>-1){
		if(cnt==0) return;
		cnt--;
		$("div[comp_prop='step_comp']").find(".step").find("span").text(step_info[cnt].날짜);
		$("div[comp_prop='step_comp']").find(".step").find("h3").text(step_info[cnt].걸음수);
	}
	if($(this).attr("class").indexOf("prev")>-1){
		if(cnt==step_info.length-1) return;
		cnt++;
		$("div[comp_prop='step_comp']").find(".step").find("span").text(step_info[cnt].날짜);
		$("div[comp_prop='step_comp']").find(".step").find("h3").text(step_info[cnt].걸음수);
	}
});
</script>