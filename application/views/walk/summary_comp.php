<style>
.summary_box .content_box{display:none;}
</style>
<div style="text-align:left;margin:5px;line-height:23px;">
	<div>캐논과 함께하는</div>
	<div style="font-size:25px;font-weight:bold;"><?=$event->제목?></div>
	<div><?=$event->s_year." ".$event->s_md?> ~
		<?php if( $event->s_year == $event->e_year ){
			echo $event->e_md;
				}
				else{
						echo $event->e_year." ".$event->e_md;
				}?>
	</div>
	<div>대한민국 국민 모두 함께하는<br>파노라마 걷기대회</div>
</div>
<div style="font-size:12px">+펼쳐보기</div>
<div class="btn_info" style="background-color:#555;margin:5px;padding:5px 0px;">특별프로그램 안내</div>
<div class="content_box">1</div>
<div class="btn_info" style="background-color:#555;margin:5px;padding:5px 0px;">기념품안내</div>
<div class="content_box">
	<?php foreach ($mementos as $memento): ?>
  	<p>기념품 : <?=$memento->경품명?> </p>
  	<p>수량 : <?=$memento->경품수?>개</p>
	<?php endforeach; ?></div>
<div class="btn_info" style="background-color:#555;margin:5px;padding:5px 0px;">경품안내</div>
<div class="content_box">
	<?php foreach ($gifts as $gift): ?>
	<p>기념품 : <?=$gift->경품명?> </p>
	<p>수량 : <?=$gift->경품수?>개</p>
	<?php endforeach; ?></div>
<div class="btn_info" style="background-color:#555;margin:5px;padding:5px 0px;">유의사항</div>
<div class="content_box">
			※ 유의사항
			<div style="margin:10px">정해진 기간 동안 걸음 수를 맞추지 못하면 자동으로 실패됩니다.
			트랙을 완보해도 스템프를 받지 못하면 기념품을 받을 수 없습니다.
		경품추첨은 00월00일에 진행됩니다.</div>
</div>
