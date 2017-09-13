<style media="screen">
	.eventMain ul {
		padding: 5px 0;
		list-style-type: none;
		background-color: #282828
	}
	.eventMain .container{
	  border : 1px solid black;
	  width : 100%;
	  background-color: gray;
	}
	.eventMain .header{
	  position: relative;
	  background-color: gray;
	  margin: 5px;
	  border: 1px solid gray;
	  padding-left: 1%;
	  width: auto;
	}
	.eventMain .list{
	  color: white;
	  position: relative ;
	  width: auto;
	  min-height: 100px;
	}
	.eventMain .article {
	  position: relative;
	  height: auto;
	}
	.eventMain .title{

	  color: whit
	  position: relative;
	  padding: 0 2%;
	}
	.eventMain #thumbnail{
	  position: ;
	  margin: 0px 5px;
	  float: left;
	}
	.eventMain #more {
	  padding-right: 5px;
	  float: right;
	  color:#000;
	}
	.eventMain li {
	  padding:5px;
	  line-height:0px;
	}
</style>
 
 
<div class="eventMain">
  <div class="container">
	  <div class="header">
		  <p>이벤트
			  <?php  if( $count > 2 ){ ?>
			  <a id="more" href="<?=WEB_ROOT?>magazine/magazineList"> 더보기</a>
			<?php }	?>
		  </p>
	  </div>
	  <div class="article">
		  <ul>
			  <?php foreach ( $events as $event ) { ?>
			  <li>
				 <img src="<?=경로_이벤트.$event->배너파일?>" alt=<?=htmlspecialchars($event->제목,ENT_QUOTES)?> width="100%"/>
			  </li>
			  <?php } ?>

		  </ul>
	  </div>
  </div>
</div>
		

