<div class="profile_box">
	<div class="profile_top">
		<div style="position:absolute; top:30%; align:center; width:100%">
			<div class="profilethumb"><img src="<?=경로_사용자?><?=$joininfos->사진?>" alt="프로필사진"></div>
		</div>
		<div class="top_nameinfo" style="width:100%; top:80%; font-size:30px; margin-top:10px; text-align:center;"><?=$stepinfos->이름?></div>
	</div>
	<div class="profile_middle">
		<div class="middle_info">
			<div class="sub_middle_info">
				<b><?=$friendcnt?></b>
			</div>친구수
		</div>
		<div class="middle_info">
			<div class="sub_middle_info">
				<b><?=$joininfos->참여대회수?></b>
			</div>대회 참가수
		</div>
		<div class="middle_info">
			<div  class="sub_middle_info">
				<?php
				if($stepinfos->일일평균걸음수 == null){ ?>
					<b>X</b>
				<?php }else{ ?>
					<b><?=$stepinfos->일일평균걸음수?></b>
				<?php } ?>
			</div>일일 평균 걸음 수
		</div>
	</div>
	<div class="profile_bottom">
		<div style="padding:5px; text-align:left;">최근 참여 대회</div>
		<?php
		foreach($recentEventInfos as $recentEventInfo){ ?>
			<div class="bottom_info">
				<div class="sub_bottom_info">
					<img src="<?=경로_걷기대회?><?=$recentEventInfo->대회포스터?>" alt="참가대회 이미지">
				</div><?=$recentEventInfo->제목?>
			</div>
		<?php
		}
		?>
	</div>
	<table style="width:100%;height:10%">
	<tr>
	<td><div class="sendbtn">쪽지보내기</div></td>
	<td><div class="circlebtn" style="left:10%"><p style="margin-top:30%;">응원하기</p></div></td>
	<td><div class="circlebtn" style="left:15%"><p style="margin-top:30%;">약올리기</p></div></td>
	</tr>
	</table>
</div>