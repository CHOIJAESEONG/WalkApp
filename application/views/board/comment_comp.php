<div class="cmt_comm">				
	<?php foreach($comments as $comment){ ?>
			<div class="list_cmt">
				<div><img class="cmt_head" src="<?=경로_사용자?><?=$comment->사진 ?>" alt=""/></div>
				<div class="cmt_body">
					<p class="txt_desc">
						<?= $comment -> 댓글?>
					</p>
					<div class="info_append">
						<div class="txt_name"><?= $comment -> 작성자?></div>							
						<div class="txt_time"><?= $comment -> 작성일?></div>
					</div>
					
				</div>
				<div class="cmt_foot" style="display:none">
					<a href="#none">답글</a><span class="txt_bar">|</span><a href="#none">수정</a><span class="txt_bar">|</span><a href="#none">삭제</a><span class="txt_bar">|</span><a href="#none">신고</a>
				</div>
			</div>
	<?php }?>
</div>
<div style="height:30px;line-height:30px;background-color:RGB(171,171,171);color:black;"><strong class="screen_out">모두보기</strong></div>
