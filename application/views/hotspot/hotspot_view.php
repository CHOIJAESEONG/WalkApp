<style media="screen">
    .HotspotView{
        border-radius : 5px;
        width: 100%;
    }
    .HotspotView ul {
          padding-left: 0;
        align-items: left;
        list-style-type: none;
     }
    .HotspotView a{
        text-decoration:none !important;
    }

    .container hr{
        border-width: 1px;
        border-style: solid;
    }
    .HotspotView .header{
        font-size: 16px;
        background-color: rgba(201, 201, 201, 0.8);
        padding : 3%;
        position: relative;
        margin-bottom: 1.5%;
    }
    .HotspotView .getTicket{
        text-align: center;
    }
    .HotspotView .title{
        position: relative;
        text-align: center;
    }
    .HotspotView .imformation{
        text-align: center;
    }
    .HotspotView .imformation p{
        margin: 0;
    }
    .HotspotView .link{
        display: inline-block;
        width: 94%;
        color: white;
        background-color: skyblue;
        padding: 6px;
        padding-left: 3%;
        padding-right: 3%;
    }
    .HotspotView .article{
        padding : 1%;
        text-align: justify;
            font-size: 12px;
    }
    .HotspotView .article p{
        margin:  0px;

    }
    .HotspotView #banner{
        position: relative;
        width: 100%
    }
    .HotspotView #title{
        padding: 5px;
        color: white;
        background-color: rgba(50,92,135,0.7);
        position: absolute;
        transform: translateY(-107%);
        padding : 2%;
        width: 96%;
    }
    .HotspotView #left{
        font-size: 18px;
        float: left;
        margin-right: auto;
    }
    .HotspotView #right{
        padding : 5px;
        float: right;
        margin-left: auto;
    }
    .HotspotView #thumb{
        display: block;
        margin-top: 5%;
        margin-left: auto;
        margin-right: auto;
        height: auto;
        width: 80%;
    }
    .HotspotView .goToMain{
        background: gray;
        text-align: center;
        padding : 1.5%;
    }
    .HotspotView .goToMain p{
        margin : 0;
    }
</style>
<div class="HotspotView">
    <div class="container">
        <div class="header">
            <div id="back">◀ 명소 실제방문</div>
        </div>
        <div class="getTicket">
            <p>축하합니다. 체크인을 완료하였습니다.</p>
            <p>경품추첨권 <?=$hotspot->추첨권수?>장을 획득하셨습니다.</p>
        </div>
        <div class="title">
            <img id="banner"src="<?=경로_핫스팟.$hotspot->banner?>" alt="">
            <div id="title">
                <div id="left"><?=$hotspot->제목?></div>
                <div id="right">[<?=$hotspot->주최?>]</div>
            </div>
        </div>
        <div class="imformation">
            <p class="link" value="<?=$hotspot->핫스팟_id?>">체크인하기</p>
        </div>
        <?php if ($more != TRUE): ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    $(".imformation").hide();
                });
            </script>
        <?php elseif ($hotspot->분류 !=NULL): ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    $(".imformation").hide();
                });
            </script>
        <?php endif; ?>
        <hr>
        <div class="article"></div>

        <div class="goToMain">
            <p>처음으로</p>
        </div>
    </div>
</div>
<script type="text/javascript">
    function hotspotAjax(url, data, page_id){
        $.ajax({
            type:"POST",
            url: url,
            dataType:"text",
            data:data,
            success: function(result){
                $(".imformation").hide();
                alert("체크인했습니다.");
            },error: function(result){
            }
        });
    }

    var rad = function(x) {
        return x * Math.PI / 180;
    };
    function getDistance(p1, p2) { //마커 사아의 거리를 구하는 함수
        var R = 6378137; // Earth’s mean radius in meter
        var dLat = rad(p2.lat() - p1.lat());
        var dLong = rad(p2.lng() - p1.lng());
        var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(rad(p1.lat())) * Math.cos(rad(p2.lat())) *
            Math.sin(dLong / 2) * Math.sin(dLong / 2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        var d = R * c;
        return d;
    };

    $(document).ready(function() {
        $("#back").on("click", function(){
            window.location.assign("<?=WEB_ROOT?>hotspot/hotspotListWithGoogleMap");
        });
        $(".link").on("click", function(){
            hotspot_id = $(this).attr("value");
            hotspotAjax( "/hotspot/insertCheckIn",{ "hotspot_id" : hotspot_id},hotspot_id );
        });
        $(".goToMain").on("click", function(){
            window.location.assign("/activity/MainActivity_2/");
        });

		$.ajax({
            type:"GET",
            url: "<?=WEB_ROOT.$article?>",
            dataType:"text",
            success: function(result){
				$(".article").html(result);
            },
            error: function(result){
            }
        });
    });
</script>
