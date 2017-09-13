<div class="article">
    <div class="get_item">
        <p> <?=$user?>님의 스탬프 획득 갯수는 <?= $count ?>개입니다.</p>
        <table id="sticker">
            <tr>
                <?php foreach ($spots as $spot): ?>
                    <?php if ($spot->checkFlag == 1 ):?>
                        <td><img src="<?=경로_경품?>stamp_yes.png" alt=""></td>
                    <?php else: ?>
                        <td><img src="<?=경로_경품?>stamp_no.png" alt=""></td>
                    <?php endif ;?>
                <?php endforeach; ?>
            </tr>
        </table>
    </div>
    <div class="info">
        <?php if($flag == "stamp"): ?>
            대회장 내 스팟 도착시 콘텐츠를 확인하시면 스탬프를 획득 하실 수 있습니다.
            획득한 스탬프는 기념품 추첨에 사용됩니다.
        <?php  else:?>
            대회 참여후 일정시간이 지나면 미션이 생성됩니다. 미션을 수행하시면 경품추첨권을 휙득하실 수 있습니다. 경품추첨권이 많아질수록 당첨확률은 높아집니다.
        <?php endif; ?>
    </div>
    <div class="success">
        <ul>
            <?php foreach ($spots as $spot): ?>
               <?php if ($spot->checkFlag == 1 ):?>
                    <li class="check on"><?=$spot->title?> <span class="right">완료</span></li>
                <?php else: ?>
                    <li class="check"><?=$spot->title?> <span class="right">미완료</span></li>
                <?php endif ;?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
