<style media="screen">
    .header{
        background-color: #ababab;
        padding: 10px;
    }
    .get_item{
        text-align: center;
    }
    .get_item p{
        font-size: 12px;
    }
    .selecter{
        display: inline-block;
        width: 100%;
    }
    .tab{
        padding : 7px 0;
        width: 50%;
        float: left;
        text-align: center;
        border-left: 1px solid black;
        border-bottom: 1px solid black;
    }
    .tab:first-child {
        margin-left: -1px;
        border-left: none;
    }
    #sticker{
        margin: auto;
        width: 100%;
    }
    #sticker img{
        width: 100%;
    }
    .info{
        margin-bottom: 2.5%;
        text-align:justify;
    }
    .success ul{
        position: relative;
        margin : 0;
        width: 100%;
        padding: 0px;
        list-style: none;
    }
    .check{
        margin-bottom: 2.5%;
        padding: 3%;
        background-color: gray;
        border-radius: 5px;
    }
    .info{
        text-align: left;
        font-size: 12px;
    }
    .right{
        float: right;
    }
    .on{
        background-color: skyblue !important;
    }

    .bold{
        font-weight: bold;
    }
</style>
<div class="container">
    <div class="header">← 내 주머니</div>
    <div class="selecter">
        <div class="tab bold" id="stamp">스탬프</div>
        <div class="tab" id="mission">경품 추첨권</div>
    </div>
    <div class="view" id="view"></div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        loadList("stamp");
        $("#stamp").click(function(){
            $("#stamp").addClass("bold");
            $("#mission").removeClass("bold");
            loadList("stamp");
        });
        $("#mission").click(function(){
            $("#stamp").removeClass("bold");
            $("#mission").addClass("bold");
            loadList("mission");
        });
    });
    function loadList(type){
        $("#view").load("awardView/"+type);
    }
</script>
