<style media="screen">
    .drawTab .tab ul {
        padding: 0;
        list-style-type: none;
        text-align: center;
    }
    .drawTab .tab li{
        padding-left: 5px;
        padding-right: 5px;
        font-size: 1em;
        margin: 0 0;
        width: 25%;
        display: inline;
    }
    .drawTab .tab li:first-child{
        border-left:none;
    }
    .drawTab .container{
        height: auto;
    }
    .drawTab .header{
        position: relative;
        background-color: gray;
        margin-bottom: 2.5%;
        width: auto;
    }
    .drawTab .header p{
        padding : 2.5%;
        margin: 0;
        color: white;
    }
    .drawTab .tab{
        margin-bottom: 2.5%;
        font-size: 10pt;
    }
    .drawTab .tab ul{
        background-color : orange;
        margin: 0;
        padding : 2.5%;

    }
    .drawTab .list{
        border: 1px solid black;
        margin: 5px;
        cursor: pointer;
    }
    .drawTab #banner{
        width: 100%;
    }
    .drawTab .bold{
        font-weight:bold !important;
    }
    .drawTab .off{
        display: none;
    }
    .drawTab .draw ul {
        border: 1px solid black;
        position: relative;
        padding: 0;
        text-align: center;
    }
    .draw{
        position: relative;
        width: 100%;
    }
    .draw .img{
        width: 100%;
    }
    .draw .select{
        position: absolute;
        width: inherit;
        opacity: 0.5;
    }
    .gift_draw{
        text-align: center;
    }
    .gift_list{
        margin: 4%;
        width: 40%;
        display: inline-block;
        font-size: 12px;
    }
    .gift_list p{
        font-size: 11px;
        margin-top: 1%;
        margin-bottom: 0;
    }

</style>
<div class="drawTab">
    <div class="container">
        <div class="header">
            <p>경품추천</p>
        </div>
        <div class="tab">
            <ul>
                <li class="bold" id="prize">경품추첨</li>
                <li class="" id="gift">기념품추천</li>
            </ul>
        </div>
        <div class="article">
            <div id="view"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(function() {
 	    loadList("prize");
		$("#prize").click(function(){
    	    $("#prize").addClass("bold");
    	    $("#gift").removeClass("bold");
			loadList("prize");
        });
		$("#gift").click(function(){
        	$("#prize").removeClass("bold");
        	$("#gift").addClass("bold");
			loadList("gift");
		});
    });
    function loadList(type){
        $("#view").load("drawView/"+type);
	}
    $(document).on("click", ".gift_list", function(){
        if( $(this).attr("id") == 1 || $(this).attr("id") == 3){
            $(this).children(".img").attr("src","<?=WEB_ROOT.경로_공통이미지?>get_prize.jpg");
        }
        else{
            $(this).children(".img").attr("src","<?=WEB_ROOT.경로_공통이미지?>fail_prize.jpg");
        }
	});
</script>
