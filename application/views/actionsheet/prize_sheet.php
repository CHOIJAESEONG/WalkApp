
<div class="toolbar" style="background:#0d0d0d;">
  <div class="toolbar-inner">
	<div class="left" style="margin-left:15px;"><?=$contest[0]->제목?></div>
	<div class="right" style="margin-right:15px;"><a href="#" class="close-picker" style="color:white;">닫기</a></div>
  </div>
</div>
<div class="picker-modal-inner">
	<?php
		if($state=="get"){
	?>
		<div class="content-block" style="text-align:center;line-height:2em;">					
			<h2>경품추첨권 현황 : <?=$prize[0]->cnt?>개</h2>
			<img src="<?=경로_경품?>card_yes.png" style="width:100px;"/>
			<p style="line-height:1.5em;">조금만 더 힘내세요~!</p>
		</div>
	<?php
		}else{
	?>
		<div class="content-block" style="text-align:center;line-height:2em;">					
			<h1>축하합니다!</h1>
			<h3>경품추첨권 1개를 획득하셨습니다</h3>
			<img src="<?=경로_경품?>card_yes.png" style="width:100px;"/>
			<p style="line-height:1.5em;">아래 버튼을 클릭하시면 경품을 받을 수 있습니다.</p>
			
			<a href="#" id="set_prize" class="button button-raised button-fill color-pink" style="color:white;margin-top:15px;">경품추첨권 받으러가기</a>
		</div>
	<?php
		}
	?>
</div>
	