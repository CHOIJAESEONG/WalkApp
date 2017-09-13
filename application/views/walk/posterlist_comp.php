<div class="owl-carousel owl-theme" style="padding-top:10px" >
	<?php foreach($walkLists as $key=>$walkList) {?>
		
	<div class="item" style="position:relative;">
		<div class="" style="">
			<div class="card-content">
				<div class="card-content-inner" style="padding:0px;">
				
					<div style="text-align:center;position:relative;display:table;background:#191919;" class="pic_wrapper">
						<div style="display:table-cell;vertical-align:middle;"> 
							<a href="/walk/getSelectedWalkEvent/<?= $walkList->걷기대회_id?>" class="external">
								<div class="pic_box" style="position:relative;" >
									<span style="position:absolute;top:5px;right:5px;padding:5px 10%;background:rgba(0, 0, 0, 0.8);z-index:99999;font-size:10px;color:#c7c7c7;border-radius:20px;">1. 종료일 <?= $diffdate->남은종료일?>일 남음</span>
									
									<img src="<?= 경로_걷기대회.$walkList->대회포스터?>" style="width:100%;">
								</div>
							</a>
						</div>
					</div>
	
					<div class="swp_text" >
						<div comp_prop="poster_info" style="width:70%;float:left;">
							<div style="padding:10px 0px">
								<div comp_prop="poster_info_a" style="display:block;">
									<div style="text-align:left;">
										<h4><?= $walkList->제목?></h4>
										<div style="font-weight:normal;font-size:14px;"><?= substr($walkList->시작일시,0,10)?> ~  <?=substr($walkList->종료일시,0,10)?></div>
										<div style="display:-webkit-inline-box;">
											<div style="margin-right:10px;"><i class="f7-icons size-20">person</i><span style="color:#727219;"><?=number_format($walkList->참가자수)?>명</span></div>
											<div ><i class="f7-icons size-20">flag</i><span style="color:#727219;"><?=number_format($walkList->완보자수)?>명</span></div>
										</div>
									</div>
								</div>	
								
								<div comp_prop="poster_info_b" style="display:none;">
									<div style="text-align:left;padding-left:10px;">
										<div style="display:flex;"><i class="f7-icons size-20 ">bag</i><span style="font-size:13px;font-weight:bold;"><?=number_format($walkList->경품수)?>개 (70% 이하)</span></div>
										<div style="display:flex;"><i class="f7-icons size-20 ">bag_fill</i><span style="font-size:13px;font-weight:bold;"><?=number_format($walkList->기념품수)?>개 (10% 이상)</span></div>
										<div style="display:flex;"><span style="font-size:11px;color:#727219;">스파크자동차, 서울랜드 자유이용권 등</span></div>
									</div>
								</div>
							</div>
						</div>
						
						<div style="width:30%;float:left;position:relative;">
						
							<div style="padding:0px 0px;margin-top:10px;">
								<a href="/walk/getSelectedWalkEvent/<?= $walkList->걷기대회_id?>" class="button button-big button-fill button-raised external" style="height:40px;background-color:#3a3737;width:100%;">
									<div style="margin:0px 0px;line-height:20px;">
										<div style="color:#ff0;font-size:12px;">참가신청</div>
										<div style="color:#827d7d;font-size:12px;">D<?= $diffdate->남은참가신청일?></div>
									</div>
									
								</a>
							</div>
						</div>
						<div style="clear:both"></div>
						
					</div>
				
				
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
</div>

<!-- ENTRANCE BUTTON -->
<div comp_prop="entrance_button" style="height:60px;">
	<a href="#" class="button button-big button-fill button-raised external" style="background-color:#141031;width:100%;height:100%;border-radius:0px;">
		<div style="line-height:15px;height:100%;padding:10px 0px;">
			<span style="display:block;width:100%;color:#ff0;font-size:1.5em;margin-bottom:10px;">WISH TRACK 입장하기</span>
			<span class="walk_tit" style="display:block;width:100%;color:#ed8300;margin:0px;"></span>
		</div>
		
	</a>
</div>
<!-- ENTRANCE BUTTON END-->

