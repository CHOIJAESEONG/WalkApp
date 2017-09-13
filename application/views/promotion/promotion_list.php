<ul class="open">
    <?php  foreach ($checkInList as $checkIn){ ?>
        <li class="list" value="<?=$checkIn->프로모션_id?>" onclick="">
            <p class="title">[<?=$checkIn->주최?>] <?=$checkIn->제목?></p>
            <img class="banner" src="/mnt/walk/checkin/<?=$checkIn->배너?>" alt="">
        </li>
    <?php } ?>
</ul>
