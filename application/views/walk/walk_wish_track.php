<style media="screen">
    .walkWishTrack .container{
        background-color: rgb(51, 63, 80);
        width: 100%;
        padding-bottom: 5px;
    }
    .walkWishTrack .article{
        padding: 5px;
        position: relative;
        color: white;
        text-align: center;
    }

    .walkWishTrack #greeting  {
        margin: 5px auto;
        width: 60%;
        font-size: 10px;
    }
    .walkWishTrack #dDay{
        margin: 2.5%;
        padding: 10px auto;
    }
    .walkWishTrack .info{
        margin-bottom: 10px;
        position:relative;
        height: auto;
        width: 100%;
    }
    .walkWishTrack .info p{
        margin-top: 5px;
        margin-bottom: 5px;
        padding-left: 5px;
    }
    .walkWishTrack .info sup{
        padding-left: 5px;
        font-size: 9px;
        color: rgb(132 , 128, 134);
    }
    .walkWishTrack .left{
        padding-top: 5px;
        border: 1px solid rgb(89, 89, 89);
        float: left;
        text-align: left;
        width: 45%;
        margin-left: 3%;
        margin-right: 1%;
        min-height: 110px;
        font-size: 12px;
        margin-bottom: 1px
    }
    .walkWishTrack .right{
        padding-top: 5px;
        border: 1px solid rgb(89, 89, 89);
        display: inline-block;
        text-align: left;
        width: 45%;
        margin-left: 1%;
        margin-right: 3%;
        min-height: 110px;
        font-size: 12px;
    }
    .walkWishTrack #bottom {
        color: rgb(89, 89, 89);
        font-size: 12px;
    }
    .walkWishTrack .footer{
        position: relative;
        width: 100%;
    }
    .walkWishTrack .footer p{
        background-color: rgb(31, 78, 121);
        width: 80%;
        padding-top: 10px;
        padding-bottom: 10px;
        margin: auto;
        font-size: 10px;
    }
    .walkWishTrack .#d-day{
        background-color: rgb(31, 78, 121);
        width: 80%;
        padding-top: 10px;
        padding-bottom: 10px;
        margin: auto;
        font-size: 10px;
    }
</style>
<div class="walkWishTrack">
    <div class="container">
        <div class="article">
            <p id="greeting"> <?=$event->제목?>가 <span id="going"> </span></p>
            <p id="d-day" value="<?=$event->dDay?>">
            </p>
            <div class="info">
                <div class="left">
                    <p id="entry" value="<?=$event->참가자수?>">참가자수 : <?=$event->참가자수?>명</p>
                    <sup id = "entry_per" value="<?=$user->참가자수?>" ></sup>
                    <p id="finish" value="<?=$event->완보자수?>">완보자수 : <?=$event->완보자수?>명</p>
                    <sup id="finish_per" value="<?=$event->참가자수?>"></sup>
                </div>
                <div class="right">
                    <p>기념품수  : <?=$event->기념품수?>개</p>
                    <sup>획득률 : 80%</sup>
                    <p>경품수 : <?=$event->경품수?>개</p>
                    <sup>획득률 : 10%</sup>
                </div>
                <br>
                <p id="bottom">
                </p>
            </div>
            <div class="footer">
                <p><?=$name->이름?>님의 참가현황</p>
            </div>
        </div>
    </div>
</div>
<script language="javascript">
    $(document).ready(function() {
        $("#d-day").html("<span style='font-size: 13pt;'> D-day 계산중 </span>");
        $("#entry_per").html("참가율 : 집계중")
        $("#finish_per").html("완보율 : 집계중%");
        nowTime();

        setViewTime = function (){ //함수로 만들어 준다.
            var date_end = $("#d-day").attr("value"); //현재날짜
            var date_now = parseInt(new Date().getTime()/1000); //월에서 1 빼줘야 함
            var diff = date_end - date_now; //날짜 빼기

            var currSec = 1; // 밀리세컨
            var currMin = 60 ; // 초 * 밀리세컨
            var currHour = 60 * 60 ; // 분 * 초 * 밀리세컨
            var currDay = 24 * 60 * 60 ; // 시 * 분 * 초 * 밀리세컨

            var day = parseInt(diff/currDay); //d-day 일
            var hour = parseInt(diff/currHour); //d-day 시
            var min = parseInt(diff/currMin); //d-day 분
            var sec = parseInt(diff/currSec); //d-day 초
            var viewHour = hour-(day*24);
            var viewMin = min-(hour*60);
            var viewSec = sec-(min*60);
            var viewStr = day+"일 "+viewHour+"시 "+viewMin+"분 "+viewSec+"초";

            if(diff > 0){
                  $("#going").html("진행중입니다");
                  $("#d-day").html("<span style='font-size: 13pt;'><b>"+viewStr+"</b></span>");
            }
            else{
                $("#going").html("종료되었습니다.");
                $("#d-day").html("<span style='font-size: 13pt;'><b>종료되었습니다.</b></span>");
                    clearInterval(leftTime);
                    clearInterval(realTimeUser);
                }
        }
        getEntry = function(){
            var entry = parseInt($("#entry").attr("value"));
            var totalEntry = parseInt($("#entry_per").attr("value"));
            var getEntryPercent = (entry/totalEntry)*100;

            var finish = parseInt($("#finish").attr("value"));
            var totalfinish = parseInt($("#finish_per").attr("value"));
            var getFinishPercent = (finish/totalfinish)*100;

            $("#entry_per").html("참가율 : "+getEntryPercent.toFixed(0)+"%")
            $("#finish_per").html("완보율 : "+getFinishPercent.toFixed(0)+"%");
        }
        function nowTime(){
            var nowDate = new Date();
            var date = [nowDate.getFullYear(),nowDate.getMonth()+1,nowDate.getDate()];
            $("#bottom").html("*"+date[0]+". "+date[1]+". "+date[2]+" 기준");
        }
        var realTimeUser = setInterval('getEntry()',1000);
        var leftTime = setInterval('setViewTime()',1000);
    });
</script>
