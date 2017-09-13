<style>
	.faQ{
		border-bottom:1px solid black;
		padding :10px;
	}
	.faA{
		padding :10px;
	}
	.listTitle{
		padding:5px;
		font-size:18px;
	
	}
	.listContents{
		padding-bottom:20px;
		margin:5px;
	}
</style>
<div>
	<?php foreach($listTitles as $listTitle){ ?>
			<div class="listContents">
				<div class="listTitle"> <?= $listTitle -> 코드명 ?></div>
		<?php 	foreach($faqs as $faq){
					if($listTitle-> 코드명==$faq-> 코드명){ ?>
						<div class="faQ"> 
							<?= $faq->글제목 ?> 
							<div class="cbutton" style="float:right;"> &#8681; </div>
						</div>
						<div class="faA" style="display:none" value="<?= $faq->글내용 ?>">
						</div>
			<?php 	} ?>
		<?php 	} ?>
			</div>
	<?php } ?>		
</div>
<script>
	$(document).ready(function(){
		$(".cbutton").each(function(idx){
			$(this).click(function(){
				$index = $(".faA").eq(idx);
				$index.html("Ans : " + $index.attr("value"));
				$index.toggle("fast");
			});
		});
	});
</script>