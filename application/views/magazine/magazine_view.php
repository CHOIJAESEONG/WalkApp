<style media="screen">
    .magazineView ul {
        padding-left: 1%;
        align-items: left;
        list-style-type: none;
    }
    .magazineView hr{
        margin: 5px 5px;
    }
    .magazineView .container{
    }
    .magazineView .header{
        margin-bottom: 2.5%;
        position: relative;
        background-color: gray;
        border: 1px solid gray;
        padding-left: 1%;
        width: auto;
    }
    .magazineView .header p{
        padding: 2.5%;
        margin: 0;
    }
    .magazineView .photo{
        margin-top: -5%;
        position: relative;
        width: auto;
    }
    .magazineView .content{
        position: relative;
    }
    .magazineView .content p{
        padding: 0 1%;
        margin: 0;
    }
    .magazineView .footer{b
        position: relative;

    }
    .magazineView .footer p{
        margin: 2% 0;
        padding: 0 1%;
    }
    .magazineView #more {
        padding-right: 1%;
        float: right;
    }
    .magazineView #img {

        position: relative;
        width: 100%;
    }
    .magazineView #title{
        background: rgba(50,92,135,0.4);
        color: #ffffff;
        padding : 2%;
        position: absolute;
        transform: translateY(-110%);
        margin: auto;
        width: 96%;
    }
</style>
<div class="magazineView">
    <div class="container">
        <div class="header">
            <p><a href="<?=WEB_ROOT?>magazine/magazineList">매거진</a></p>
        </div>
        <div class="article">
            <?=$article?>

        </div>
        <hr>
        <div class="footer">
            <p>에디터 : <?=$magazine->에디터?></p>
            <p>작성자 : <?=$magazine->작성자?></p>
        </div>
    </div>
</div>
