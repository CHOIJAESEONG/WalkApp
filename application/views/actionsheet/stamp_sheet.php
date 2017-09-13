
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
			<h1>축하합니다!</h1>
			<div style="height:1px;width:100%;border-top:1px solid #ccc;margin:15px 0px;"></div>
			<h3>스탬프 1개를 획득하셨습니다</h3>
			<img src="<?=경로_경품?>stamp_yes.png" style="width:100px;"/>
			<p style="line-height:1.5em;">스탬프를 모두 획득한 참가자에게는<br>기념품 추첨 자격이 주어집니다.</p>
			
			<a href="#" id="get_stamp" class="button button-raised button-fill color-pink" style="color:white;margin-top:15px;">나의 획득현황 상세 보기</a>
		</div>
	<?php
		}else{
	?>
		<div class="content-block" style="text-align:center;line-height:2em;">					
			<h1>위시에 도착하였습니다!</h1>
			<div style="height:1px;width:100%;border-top:1px solid #ccc;margin:15px 0px;"></div>
			<h3>스탬프를 획득하실 수 있습니다</h3>
			<p style="line-height:1.5em;margin-top:20px">위시에 도착해서 콘텐츠를 확인하면<br>기념품 추첨에 필요한 스탬프를 드립니다.</p>
			
			<p style="margin-top:20px;">예상 획득내용</p>
			<p style="color:yellow;">스탬프 1개</p>
			
			<a href="#" id="set_stamp" class="button button-raised button-fill color-pink" style="color:white;margin-top:15px;">위시 콘텐츠 보고 스탬프 받기</a>
		</div>
	<?php
		}
	?>
</div>
	