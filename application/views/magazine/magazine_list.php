<style media="screen">
    ul {
        margin: 0;
        padding-left: 0;
        list-style-type: none;
    }
    a{
        text-decoration:none !important;
    }
    .header{
        position: relative;
        background-color: gray;
        width: auto;
        margin-bottom: 2.5%;
    }
    .header p{
        padding: 10px;
        margin: 0;
    }
    .list{
        position: relative;
        height: auto;
        margin-bottom: 2.5%;
        width: 100%;
    }
    .title{
        padding: 7px 5px;
        width: auto;
        color: white;
        background-color: rgba(0,172,238,0.5);
        margin: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .article {
        position: relative;
        height: auto;
        margin-top: 2.5%;
    }
    .banner {
        width: 100%;
        margin-bottom: -4px;
        height: auto;
    }
</style>
<div class="magazineList">
    <div class="container" >
        <div class="header">
            <p>매거진</p>
        </div>
        <div class="article">
        	 <ul>
                <?php foreach ($magazines as $magazine){ ?>
                <li class='list' value="<?=$magazine->매거진_id?>">
                    <p class="title"><?= $magazine->제목 ?></p>
                    <img class="banner" src="<?=경로_매거진.$magazine->배너?>" alt="">
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
        })}
    );
</script>
