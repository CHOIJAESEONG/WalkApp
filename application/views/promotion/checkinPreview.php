<style media="screen">
    .checkinPreview .container{
        border : 1px solid black;
        width : 100%;
        background-color: gray;
    }
    .checkinPreview ul {
        padding: 5px 0;
        list-style-type: none;
        background-color: gray;
        position: relative;
    }
    .checkinPreview .header{
        position: relative;
        background-color: gray;
        margin: 5px;
        border: 1px solid gray;
        padding-left: 1%;
        width: auto;
    }
    .checkinPreview .list{
        width: 44%;
        height: 140px;
        display: inline-flex;
        margin: 2.5%;
    }
    .checkinPreview .article {
        position: relative;
        margin: 5px;
        height: auto;
    }
    .checkinPreview .title{
        padding: 5px;
        color: white;
        width: 30%;
    }
    .checkinPreview #thumbnail{
        width: 100%;
        height: 100%;
        position: relative;
    }
    .checkinPreview #more {
        color: black;
        padding-right: 5px;
        float: right;
    }
</style>
<div class="checkinPreview">
    <div class="container">
        <div class="header">
            <span class="title">체크인</span>
            <?php  if( $count > 2 ){ ?>
                <a id="more" href="<?=WEB_ROOT?>checkin/checkinTab"> 더보기</a>
            <?php }	?>
        </div>
        <div class="article">
            <ul>
                <?php foreach ($events as $event){ ?>
                    <li class='list' value="<?=$event->프로모션_id?>">
                        <img id="thumbnail" src="/mnt/walk/checkin/<?=$event->배너?>" >
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(".list").on("click",function(){
            window.location.assign("<?=WEB_ROOT?>hotspot/hotspotList/"+$(this).attr("value"));
        })
    });
</script>
