			
<?php 
foreach($friendIds as $friendId){
?>
<?php
	$date_temp=date_create($friendId->전송일시);
	$date_time = date_format($date_temp,"h:i");
	$date_ampm = date_format($date_temp,"A");
	$date_ampm =$date_ampm =="AM"?"오전":"오후";
?> 
	<?php 
	if($friendId->전송_id==$user_id) { 
	?>
		<li class="group_box" msid="<?=$friendId->쪽지_id ?>">
			<div style="position:relative;margin-right:10px">
				<table style="max-width:80%;table-layout:fixed;" align="right">
					<tr>
						<td>
							<div class="time" style="margin-left:5px;" >
								<?=$date_ampm?> <?=$date_time?>
							</div>
						</td>
						<td style="max-width:60%">
							<div class="even">
								<?=$friendId-> 내용?>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</li>
	<?php
	}else{
	?>
		<li msid="<?=$friendId->쪽지_id ?>">
			<div style="position:relative;">
				<table style="max-width:90%;table-layout:fixed;">
					<tr>
						<td><div class="mythumb3"><img src="<?=경로_사용자?><?=$friendId->사진?>" alt=""></div></td>
						<td style="max-width:70%">
							<div><?=$friendId->전송_id?></div>
							<div class="odd">
								<?=$friendId->내용?>
							</div>
						</td>
						<td>
							<div class="time" style="margin-left:5px;" >
								<?=$date_ampm?> <?=$date_time?>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</li>
	<?php
	}
	?>         
<?php
} 
?>   