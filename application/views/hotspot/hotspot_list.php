<style media="screen">
    .hotspotList ul {
        padding-left: 0;
        list-style-type: none;
    }
    .hotspotList .header{
        font-size: 16px;
        background-color: rgba(201, 201, 201, 0.8);
        padding : 3%;
        position: relative;
        margin-bottom: 1.5%;
        text-align: center;
    }
    .hotspotList .header p{
        margin: 0;
    }
    .hotspotList .toMap{
        padding : 2%;
        position: relative;
        background-color: rgb(119, 218, 254);
        text-align: center;
        margin-bottom: 1.5%;
    }
    .hotspotList .toMap p{
        margin: 0;
    }
    .hotspotList .sub {
        font-weight: bold;
        color: white;
        background-color: rgba(50,92,135,0.8);
        display: inline-block;
        width: 100%;
        padding : 5px 0;
    }

    .hotspotList .gps{
        border-radius: 5px;
        position: relative;
        text-align: center;
        float : right;
        background-color: rgba(119, 242, 146,0.7);
        width: 35%;
        padding: 1px;
        margin-bottom: 2.5%;
    }
    .article ul{
        margin: 0;
        margin-bottom: 2.5%;
        width: 100%;
    }
    .hotspotList .gps p{
        margin : 0;
        padding : 5px;
        font-size: 12px;
    }
    .hotspotList .list{
        background-color: rgba(190,190,190,0.4);
        display: inline-table;
        width: 100%;
        margin-bottom: 2.5%;
    }
    .hotspotList .sub span{
        padding: 5px;
    }
    .hotspotList .state{
        font-size: 12px;
        padding : 5px;
        float: right;
    }
    .hotspotList .title{
        font-size: 12px;
        padding : 5px;
        float: left;
        text-align: left;
    }
    .hotspotList .banner{
        margin-top: -4px;
        margin-bottom:-4px;
        width: 100%;
    }
    .hotspotList .info{
        font-size: 12px;
        padding: 1.5%;
        margin: 0;
    }
</style>
<div class="hotspotList">
    <div class="container">
        <div class="header">
            <p>[캐논] 캐논 파노라마 걷기대회 핫스팟</p>
        </div>
        <div class="toMap" style="cursor: pointer;" onclick="location.href='<?=WEB_ROOT?>hotspot/hotspotListWithGoogleMap'">
            <p>지도로 보기</p>
        </div>
        <div class="gps">
            <p>GPS정보 수신 중</p>
        </div>
        <div class="article">
            <ul>
                <?php foreach ($hotspots as $hotspot){ ?>
                    <li class='list' value="<?=$hotspot->핫스팟_id?>">
                        <div class="sub">
                            <div class="title">Location : <?=$hotspot->제목 ?></div>
                            <div class="state">
                                <?php if(!($hotspot->상태 == NULL)) { ?>
                                    <span style="color : rgb(11, 33, 56);"><?=$hotspot->코드명?></span>
                                <?php }
                                    else if ($hotspot->종료시간 >= time()) { ?>
                                    <span style="color : azure;"> 참여가능 </span>
                                <?php }
                                    else { ?>
                                    <span style="color : rgb(214,50,50);"> 종료됨 </span>
                                <?php }?>
                            </div>
                        </div>
                        <img class="banner" src="<?=경로_핫스팟.$hotspot->배너?>" alt="">
                        <p class="info">체크인 가능시간 | <?= $hotspot->체크인_종료시간?></p>
                        <p class="info">상품 | <?=$hotspot->상품명?></p>
                    </li>
                <?php } ?>
           </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".list").on("click",function(){
        window.location.assign("<?=WEB_ROOT?>hotspot/hotspotView/"+$(this).attr("value"));
    })}
</script>
