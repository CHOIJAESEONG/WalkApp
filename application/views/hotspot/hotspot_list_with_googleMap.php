<style media="screen">
    html{

    }
    ul {
        padding-left: 0;
        list-style-type: none;
    }
    .hotspotList p{
        margin: 0;
    }
    .hotspotList .header{
        font-size: 16px;
        background-color: rgba(201, 201, 201, 0.8);
        padding : 3%;
        position: relative;
        margin-bottom: 1.5%;
    }
    .hotspotList .gps{
        position: absolute;
        display: block;
        text-align: center;
        float : right;
        background-color: rgba(119, 242, 146,0.7);
        width: 35%;
        padding: 1px;
        z-index: 10;
    }
    .hotspotList .gps p{
        padding : 5px;
        font-size: 12px;
    }
    .hotspotList .wellcome{
        padding: 2.5%;
        background: pink;
        margin : 2.5% 0 ;
        text-align: center;
    }
    .hotspotList .myInfo{
        font-size: 12px;
        margin-top: 4.5%;
        text-align: right;
    }
    .hotspotList .nearby{
        text-align: center;
        padding: 2.5%;
    }
    .hotspotList .nearby ul{
        margin : 0 !important;
    }

    .hotspotList .article ul{
        margin: 0;
        width: 100%;
    }
    .hotspotList .list{
        background-color: rgba(190,190,190,0.4);
        display: inline-table;
        width: 100%;
    }
    .hotspotList .list p{
        position: relative;
        font-size: 12px;
    }
    .hotspotList .sub{
        display: table-header-group;

    }
    .hotspotList .sub span{
        padding: 5px;
    }
    .hotspotList .info{
        margin-bottom: 0.5%;
        padding-left: 1%;
        font-size: 14px;
        text-align: left;
        vertical-align: middle;
        display: run-in;
    }
    .hotspotList .state{
        font-size: 12px;
        padding : 5px;
        float: right;
    }
    .hotspotList .title{
        font-size: 12px;
        float: left;
        text-align: left;
    }
    .hotspotList .banner{
        margin-left: 1%;
        margin-bottom: 1%;
        display: table-cell;
        vertical-align: middle;
        float: left;
        width: 30%;
    }
    .hotspotList .map{
        position: relative;
        width: 100%;
        height:300px;
        margin-bottom: 2.5%;
        z-index: 0;
    }
    .hotspotList #nearby{
        font-size: 14px;
    }
    .hotspotList .checkIn{
        margin: 1% 0;
        background: yellow;
        text-align: center;
        display: table-footer-group;
    }
    .hotspotList .checkIn p{
        padding: 1.5%;
    }
    .hotspotList .hotspotInfo{
        padding-top: 1%;
        padding-left: 1%;
        margin-bottom: 1%;
        display: inline-block;
        width: 67%;
        height: auto
    }
    .hotspotList .more{
        padding: 2%;
        float: right;
        font-size: 12px;
        position: relative;
    }
</style>
<script type="text/javascript">
    var id = new Array();
    var myLatLng = new Array(new Array(),new Array());
    var customInfo = new Array();
</script>
<div class="hotspotList">
    <div class="container">
        <div class="header">
            <div id="back">◀ 명소 실제방문</div>
        </div>
        <div class="article">
            <div class="wellcome">
                <p>핫스팟에 입장하신 것을 환영합니다.</p>
                <p>핫스팟에 방문해서 체크인하면<br>경품당첨 확률이 높아지는 추첨권을 드립니다.</p>
                <div class="myInfo">
                    <ul>
                        <li>내 체크인 완료 개수 :   <?=$state->checkIn?></li>
                        <li>총 획득 경품추첨권  :   <?=$state->prize?></li>
                    </ul>
                </div>
            </div>
            <div class="nearby">
                <p id="nearby">계산중 입니다.</p>
            </div>
            <div class="gps">
                <p>GPS정보 수신 중</p>
            </div>
            <div class="map" id="map"></div>
            <ul>
                <?php foreach ($hotspots as $hotspot){ ?>
                    <li class='list'  id="<?=$hotspot->핫스팟_id?>">
                        <div class="sub">
                            <span class="title"><?=$hotspot->제목 ?></span>
                            <div class="state">
                                <?php if(!($hotspot->분류 == NULL)) { ?>
                                    <span>참여완료</span>
                                <?php }
                                    else if ($hotspot->종료시간 >= time()) { ?>
                                    <span> 참여가능 </span>
                                <?php }
                                    else { ?>
                                    <span> 종료됨 </span>
                                <?php }?>
                            </div>
                        </div>
                        <script type="text/javascript">
                            id.push(<?=$hotspot->핫스팟_id?>);
                            myLatLng[0].push(<?=$hotspot->위도?>);
                            myLatLng[1].push(<?=$hotspot->경도?>);
                            customInfo.push(<?=$hotspot->핫스팟_id?>);
                        </script>
                        <img class="banner" src="<?=경로_핫스팟.$hotspot->배너?>" alt="">
                        <div class="hotspotInfo">
                            <p class="info">체크인 가능시간 | <?= $hotspot->체크인_종료시간?></p>
                            <p class="dist info"></p>
                            <span class="info">아이콘 경품추첨권 <?=$hotspot->추첨권수?>장 </span>
                            <span class="more" value="<?=$hotspot->핫스팟_id?>" >자세히보기</span>
                        </div>
                        <div class="checkIn" value="<?=$hotspot->핫스팟_id?>">
                            <p>체크인하기</p>
                        </div>
                    </li>
                <?php } ?>
             </ul>
        </div>
    </div>
</div>
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmZ_NwaMseZFl_QanMjo5DTOqTHwo3gPY&callback=initMap" async defer></script>
<script>
    function initMap() { //구글 맵 선언
        var marker = new Array();
        var temp;
        var index;
        var loc = {lat : 37.566567, lng : 126.992542}; //지도의 중심점
        var shortDist // loc의 위치로 부터 가장 가까운 핫스팟을 거리를 저장
        var center //loc위치의 마커
        var select // 가장 가까운 핫스팟의 index 값
        var dist; // 지도의 중심으로부터 각각의 핫스팟의 거리값을 저장

        var map = new google.maps.Map(document.getElementById("map"), { // 지도 정보 선언
            center: loc, // 지도의 중심
            scrollwheel: false,
            zoom: 13,
            mapTypeControl : false,
            streetViewControl: false,
            fullscreenControl: false,
        });
        center = new google.maps.Marker({ // 각각의 핫스팟과 지도의 중심점을 구하기 위해서 마커로 선언
            position: loc,
            map: map,
            icon: {
                path:google.maps.SymbolPath.CIRCLE
                //fillOpacity:0.0,
                //strokeOpacity: 0.0
            }
        })
        for(var i = 0; i < id.length; i++){
                temp = {lat : myLatLng[0][i] ,lng : myLatLng[1][i]} // 각각의 핫스팟의 위도, 경도값을 저장
                marker[i] = new google.maps.Marker({ //각각의 마커는 배열로 선언되어 index로 접근 가능
                position: temp,
                map: map,
                customInfo: customInfo[i] // 위에서 저장한 핫스팟_id를 가져옴 하단에 리스트를 표시하기 위하여 사용
                });
            setMarker(marker[i], center); // 마커를 설정 하단에 선언되어 있음
            if(i == 0){
                shortDist = getDistance(marker[i].position, center.position);
                select = 0;
            } // 첫번째 마커가 가장 짧으므로 저장
            else if ( shortDist > ( tempDist = getDistance(marker[i].position, center.position) ) ){
                shortDist = tempDist;
                select = i;
            }// 저장된 거리를 비교하여 짧으면 그 거리를 저장하고 인덱스 값도 저장
        }; //for문 종료
        marker[select].setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png'); //가장짧은 거리의 핫스팟의 마커 아이콘을 변경
        $( ".list" ).hide();
        $( ".dist" ).text( "아이콘 " + Math.round(shortDist) + "m");
        $( '#' + marker[select].customInfo ).show();
        $( "#nearby" ).text("현재 가장 가까운 핫스팟은 "+ Math.round(shortDist) +"m 이내에 있습니다!");
    }
    function setMarker(marker, center) {
        marker.addListener('click', function(){
            $( ".list" ).hide();
            $( ".dist" ).text("아이콘 " + Math.round( getDistance(this.position, center.position) ) + "m");
            $( '#'+this.customInfo ).show();
            console.log(this.customInfo);
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
    function hotspotAjax(url, data, page_id){
        $.ajax({
			type:"POST",
			url: url,
			dataType:"text",
			data:data,
			success: function(result){
                window.location.assign("<?=WEB_ROOT?>hotspot/hotspotView/"+page_id);
			},error: function(request,status,error){
                alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
    }
    $(document).ready(function(){
        $(".checkIn").on("click",function(){
            hotspot_id = $(this).attr("value");
            hotspotAjax( "/hotspot/insertCheckIn",{ "hotspot_id" : hotspot_id},hotspot_id );
        });
        $("#back").on("click", function(){
            history.back();
        });
        $(".more").on("click", function(){
            window.location.assign("<?=WEB_ROOT?>hotspot/hotspotView/"+$(this).attr("value")+"/more");
        });
    });
</script>
