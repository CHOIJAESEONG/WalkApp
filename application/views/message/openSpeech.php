<style>
	.ostitle{
		font-weight:bold;
		font-size:20px;
		margin:20px;
	}
	.speechContents{
		padding:20px;
	}
</style>
<div class="openSpeech_box" style="width:100% height:100%">
	<?php 
		foreach($speeches as $speech){ ?>
			<div class="speechContents"> <?= $speech -> 내용 ?> </div>
			<div align="center">
				<video controls src="<?= 경로_메시지?><?= $speech -> 동영상경로 ?>" width="80%" height="20%"> </video>
			</div>
	<?php } ?>
</div>