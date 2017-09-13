
	<?php foreach($walkLists as $key=>$walkList) {?>
		<div id="event_lists">
			<img class="event_poster" src="<?=경로_걷기대회.$walkList->대회포스터?>"></img>
			<div class="event_items" value="<?=$walkList->걷기대회_id?>">
				<ul class="event_items_details" style="list-style: none;">
					<li> <?= $walkList->제목?> </li>	
					<li><?= $walkList->시작일시?> ~  <?=$walkList->종료일시?> </li>
					<li>참가자수 :<?=$walkList->참가자수?> </li>
					<li>완보자수 :<?=$walkList->완보자수?> </li>
				</ul>
			</div>
			
			<div class="event_items_pre_details" value="<?=$walkList->걷기대회_id?>" style="display: none">
				<ul class="event_items_details" style="list-style: none;">
					<li>경품수 : <?=$walkList->경품수?> </li>
					<li>기념품수 : <?=$walkList->기념품수?> </li>
				</ul>			
			</div>
			
			<div id="participate_button" class="partici_button">	  
				<?php if($walkList->버튼상태 == '참가신청'){ ?>
						<p class="move_buttons"  onclick="apply(<?= $walkList->걷기대회_id ?>)">참가신청<p>
				<?php }else{ ?>
						<p class="move_buttons"><?= $walkList->버튼상태?> </p>
				<?php } ?>	
			</div>
		</div>	
	<?php } ?>



<script>
	function apply(id){
		location.href = "/walk/getSelectedWalkEvent/"+id;	//해당 url로 이동;
	}
	
	$("div.event_items").on("click",function(){
		var id_num = $(this).attr("value");
		$(".event_items[value="+id_num+"]").css("display","none");
		$(".event_items_pre_details[value="+id_num+"]").css("display","block");
	});

	$("div.event_items_pre_details").on("click",function(){
		var id_num = $(this).attr("value");
		$(".event_items[value="+id_num+"]").css("display","block");
		$(".event_items_pre_details[value="+id_num+"]").css("display","none");
	});
	
</script>
