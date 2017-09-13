<style media="screen">
    .checkIn ul {
        margin-top: 10px;
        margin-bottom: 5px;
        padding: 0;
        list-style-type: none;
        text-align: center;
    }
    .checkIn .tab li{
        border-left: 1px solid black;
        padding-left: 5px;
        padding-right: 5px;
        font-size: 1em;
        margin:0 0;
        width: 25%;
        display: inline;
    }
    .checkIn .tab li:first-child{
        border-left:none;
    }
    .container{
        height: auto;
    }
    .checkIn .header{
        position: relative;
        background-color: gray;
        border: 1px solid gray;
        padding-left: 1%;
        width: auto;
        margin-bottom: 2.5%;
    }
    .checkIn .header p{
        margin: 0;
        padding : 2.5%;
        color: white;
    }
    .checkIn .tab{
        font-size: 10pt;
    }
    .checkIn .tab ul{
        background-color : rgb(255, 213, 79);
        padding : 2.5%;
        margin: auto;
    }
    .checkIn .miniTitle{
        font-size: 12px;
        text-align: center;
        color: rgb(71, 120, 244);
    }
    .checkIn .list{
        background-color : rgba(190,190,190,0.4);
        cursor: pointer;
        margin-bottom : 2.5%;
    }
    .checkIn .title{
        color : white;
        background-color: rgba(50,92,135,0.8);
        padding : 2%;
        margin : 0px;
        text-align: left;
    }
    .checkIn .banner{
        width: 100%;
        margin-bottom: -5px;
    }
    .checkIn .bold{
        font-weight:bold !important;
    }
    .checkIn .off{
        display: none;
    }
</style>
<div class="checkIn">
    <div class="container">
        <div class="header">
            <p>체크인 프로모션</p>
        </div>
        <div class="tab">
            <ul>
                <li class="bold" id="open">진행중인 프로모션</li>
                <li class="" id="close">종료된 프로모션</li>
            </ul>
         </div>
         <div class="article">
            <p class="miniTitle"> 체크인 프로모션에 오신걸 환영합니다.</p>
            <p class="miniTitle">해당 포인트 체크인하고 추짐한 경품을 받아가세요</p>
            <div id="view"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(function() {
 	    loadList("open");
		$("#open").click(function(){
            $("#open").toggleClass("bold");
            $("#close").toggleClass("bold");
			loadList("open");
		});
		$("#close").click(function(){
            $("#open").toggleClass("bold");
            $("#close").toggleClass("bold");
			loadList("close");
		});
    });
	function loadList(type){
  	    $("#view").load("promotionView/"+type);
	}
    $(document).on("click", ".list", function(){
        window.location.assign("<?=WEB_ROOT?>hotspot/hotspotListProm/"+$(this).attr("value"));
    });
</script>
