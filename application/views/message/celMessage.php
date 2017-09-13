<style>
	.celtitle{
		font-weight:bold;
		font-size:20px;
		margin:20px;
	}
	.celebrities{
		background-color:green; 
		color:white;
		font-weight:bold; 
		padding:5px;
		margin-top:20px;
		margin-bottom:10px;
	}
</style>
<div class="celMessage_box" style="width:100% height:100%">
	<?php 
		foreach($celMessages as $celMessage){ ?>
			<div class="celebrities"> <?= $celMessage -> 내용 ?> </div>
			<div align="center">
				<video controls src="<?= 경로_메시지?><?= $celMessage -> 동영상경로 ?>" width="80%" height="20%"> </video>
			</div>
	<?php } ?>
</div>

