<div class="gift_draw">
    <div class="subtitle">
        <p>이미지를 클릭하시면   <br> 당첨여부를 확인하실 수 있습니다.</p>
        <div class="gift_button">경품추첨 안내사항</div>
    </div>
    <div class="info">
        <p>내가 획득한 경품 획득권 : 2개</p>
    </div>
    <div class="draw">
        <ul>
            <?php foreach ($prizes as $prize) { ?>
                <li class="gift_list" id="<?=$prize->경품_id?>">
                    <img class="img" src="<?=WEB_ROOT.경로_경품.$prize->경품사진?>" alt="">
                    <p><?=$prize->경품명?></p>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
