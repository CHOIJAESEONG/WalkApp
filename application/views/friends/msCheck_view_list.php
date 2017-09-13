<?php 
foreach($friendIds as $friendId ) {
?>
	<?php
	$date_temp=date_create($friendId->전송일시);
	//  $date_val=substr($date_temp,10,15);
	$date_time = date_format($date_temp,"h:i:s");
	$date_ampm = date_format($date_temp,"A");
	
	$date_ampm =$date_ampm =="AM"?"오전":"오후";
	?> 
	<li>
		<div class="room_box" m_name="<?=$friendId->그룹_id?>">
			<div class="room_btn" style="margin-right:60px;min-height:50px;" onclick="room_btn_click('<?=$friendId->그룹_id?>')">
				<div class="mythumb2">
					<img src="<?=경로_사용자?><?=$friendId->사진?>" alt="">
				</div>
				<div style="margin-left:60px">
					<div class="userName"><b><?=$friendId->이름?></b></div>
					<input type="hidden" class="find" value="<?=$friendId->전송_id?>"/>
					<div class="time">
						<div style="position:relative">
							<?php if($friendId->확인여부=="N" && $friendId->전송_id!=$userId){ ?>
								<img class="badge" src="/mnt/walk/friends/N.PNG" alt="확인하지 않은 메세지에서 나타남">
							<?php } ?>
							<?=$date_ampm?> <?=$date_time?>
						</div>
					</div>
					<div class="text_over">
						<?=$friendId->내용?>
					</div>
				</div>
			</div>
			<div class="det2" name="<?=$friendId->전송_id?>">삭제</div>
		</div>
	</li>
<?php
}
?>