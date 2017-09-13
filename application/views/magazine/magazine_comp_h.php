<style media="screen">
    .magazineWalkMain ul {

        padding: 5px 0;
        list-style-type: none;
        background-color: #282828
    }
    .magazineWalkMain .container{
        width : 100%;
        background-color: gray;
    }
    .magazineWalkMain .header{
        position: relative;
        background-color: gray;
        width: auto;
    }
    .magazineWalkMain .header p{
        text-align: left;
        padding: 3%;
        margin:  0;
    }
    .magazineWalkMain .list{
        display : table;
        position: relative ;
        width: auto;
        min-height: 100px;
    }
    .magazineWalkMain .article {
        position: relative;
        height: auto;
    }
    .magazineWalkMain .subtitle{
        text-align: left;
        padding-right: 10px;
        display: table-cell;
        vertical-align: middle;
        color: gray;
        position: relative;

    }
    .magazineWalkMain #thumbnail{
        display: table-cell;
        vertical-align: middle;
        float: left;
        padding : 10px;
    }
    .magazineWalkMain #more {
      padding-right: 5px;
      float: right;
    }
    .magazineWalkMain .article li:last-child hr{
        display: none;
    }
</style>
<div class="magazineWalkMain">
    <div class="container">
        <div class="header">
            <p>매거진
                <?php  if( $count > 2 ){ ?>
                    <a class="external" id="more" href="<?=WEB_ROOT?>magazine/magazineList"> 더보기</a>
                <?php }	?>
            </p>
        </div>
        <div class="article">
            <ul>
                <?php foreach ($magazines as $magazine){ ?>
                    <li  value="<?=$magazine->매거진_id?>" >
                        <p class='list' value="<?=$magazine->매거진_id?>">
                            <img id="thumbnail" src="<?=경로_매거진.$magazine->섬네일?>" >
                            <span class="subtitle"><?= $magazine->제목 ?></span>
                        </p>
                        <hr>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $(".list").on("click",function(){
        window.location.assign("<?=WEB_ROOT?>magazine/magazineView/"+$(this).attr("value"));
    })
});
</script>
