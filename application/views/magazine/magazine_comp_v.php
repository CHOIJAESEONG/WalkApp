<style media="screen">
	.list{
		text-align: center;
		display: inline-block;
		float: left;
		width: 45%;
		margin: 2.5%;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: normal;

	}
	.title{
		position: relative;
		 text-align: left;
		margin : 1px;
		width: 100%;
		line-height: 1.3;
		max-height: 2.6em;
		white-space: normal;
		word-wrap: break-word;
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
	}
	#thumbnail{
		position: relative;
		width: 100%;
	}
</style>
<div style="color:RGB(255,205,51);background:RGB(12,12,12);padding:10px 0px; ">매거진</div>
<div class="article"style="text-align:center;">
	<?php foreach ($magazines as $magazine){ ?>
		<div class="list" value="<?=$magazine->매거진_id?>" >
			<img id="thumbnail" src="<?=경로_매거진.$magazine->섬네일?>">
		</div>
	<?php } ?>
</div>
<script type="text/javascript">
  $(document).ready(function(){
	$(".list").on("click",function(){
	  window.location.assign("<?=WEB_ROOT?>magazine/magazineView/"+$(this).attr("value"));
	})}
  );
</script>
