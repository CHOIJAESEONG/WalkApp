<style>
	.faQ{
		border-bottom:1px solid black;
		padding :10px;
	}
</style>
<div>
	<?php foreach($faqs as $faq){?>
		<div class="faQ"> 
			<?= $faq->글제목 ?> 
			<div class="cbutton" style="float:right;"> &#8681; </div>
		</div>
		<div class="faA" style="display:none" value="<?= $faq->글내용 ?>">
		
		</div>
	<?php } ?>
</div>
<script>
	$(document).ready(function(){
		$(".cbutton").each(function(idx){
			$(this).click(function(){
				
			});
		});
	});

</script>