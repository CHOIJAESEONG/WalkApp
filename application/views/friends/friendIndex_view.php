<style>
	.pop-layer .pop-container , .pop-layer2 .pop-container, .pop-layer3 .pop-container, .pop-layer4 .pop-container {
		padding: 20px 25px;
	}  
	
	.pop-layer, .pop-layer2, .pop-layer3, .pop-layer4 {
		display: none;
		background:#f2f2f2;
		color:#000000;
		position: fixed;
		top: 35%;
		left: 9%;
		width: 80%;
		height: auto;
		border-radius: 10px;
		border: 5px solid #cdcdcd;
	}
	
	.btn-r {
		height:20px;
	}
	
	.btn-r #ok{
		position:absolute;
		right:60%;
		background-color:#ffe882;
		padding:8px;
		font-size:12px;
		border-radius:4px;
	}
	
	.btn-r #cancel{
		position:absolute;
		left:60%;
		background-color:#7ec6f7;
		padding:8px;
		font-size:12px;
		border-radius:4px;
	}
	
	.pop-conts {
		text-align:center;
	}
	
	#myfriendlist {
		margin-top:86px;
	}

	#invitefriend{
		margin-top:42px;
	}
	
	.list_box ul{
		list-style:none;
		border-left:1px solid #cdcdcd;
		border-right:1px solid #cdcdcd;
		border-bottom:1px solid #cdcdcd;
		margin-bottom:20%;
	}
	
	.list_box .friend_box{
		border-top:1px solid #cdcdcd;
		padding:10px;
		position:relative;
	}
	
	.list_box .friend_box:hover{
		background-color:#f2f2f2;
	}
	
	.list_box .ms_bt, .accept_bt, .invite_bt {
		position:absolute;
		right:60px;
		top:20px;
		background-color:#ffe882;
		padding:8px;
		font-size:12px;
		border-radius:4px;
	}
	
	.list_box .del_bt, .reject_bt, .cancel_bt {
		position:absolute;
		right:10px;
		top:20px;
		background-color:#7ec6f7;
		padding:8px;
		font-size:12px;
		border-radius:4px;
	}
	
	.list_box .ms_bt:hover, .accept_bt:hover, .invite_bt:hover,.btn-r #ok:hover {
		background-color:#fff5bc;
	}
	
	.list_box .del_bt:hover, .reject_bt:hover, .cancel_bt:hover,.btn-r #cancel:hover {
		background-color:#bcefff;
	}
	
	.mythumb{
		margin: 10px auto;
		width: 50px;
		height: 50px;
		overflow: hidden;
		display: block;
		border-radius: 50px;
		text-align: center;
		position:absolute;
		left:10px;
		top:0px;
	}
	
	.mythumb img{
		width: 50px;height: 50px;
	}
	
	.add_btn{
		z-index:100;
		position:fixed;
		background-color:#ffffff;
		bottom:0;
		width:100%;
		height=25%;
		left:0;
	}
	
	.add_btn .container {
		border:1px solid #cdcdcd;
		border-radius:10px;
		text-align:center;
		background-color:#cdcdcd;
		font-size: 15px;
		padding:5px;
		margin:10px;
	}
	
	.menu_tab {
		z-index:100;
		position:fixed;
		width:100%;
		top:0;
		text-align:center;
		background-color:white;
	}
	
	.menu_tab ul {
		background-color:#63483c;
		padding:10px 0 10px 0;
		margin:0;
	}
	
	.menu_tab ul #myfriends {
		display:inline;
		font: 18px Dotum;
		font-family: arial;
		color: #ffffff;
		padding:0 10px; 
	}
	
	.menu_tab ul #invite,.menu_tab ul #messege {
		display:inline;
		border-left:1px solid #999;
		font: 18px Dotum; 
		font-family: arial;
		color: #ffffff;
		padding:0 10px; 
	}
	
	.menu_tab ul #myfriends:hover,.menu_tab ul #invite:hover,.menu_tab ul #messege:hover {
		font-weight:bold;
	}
	
	
	.sub_menu_tab {
		z-index:100;
		position:fixed;
		width:100%;
		top:45px;
		text-align:center;
		/*padding-left:25px;*/
		background-color:white;
	}
	
	.sub_menu_tab ul {
		background-color:#63483c;
		padding:10px 0 10px 0;
		margin:0 0 20px 0;
	}
	
	.sub_menu_tab ul #sub_left {
		display:inline;
		font: 15px Dotum;
		font-family: arial;
		color: #ffffff;
		padding:0 10px; 
	}
	
	.sub_menu_tab ul #sub_right {
		display:inline;
		border-left:1px solid #999;
		font: 15px Dotum; 
		font-family: arial;
		color: #ffffff;
		padding:0 10px; 
	}
	
	.menu_tab ul li:first-child{
		border-left:none;
	}

	.list_box li{
		/*border:1px solid #cdcdcd;*/
	}
	
	.list_box .room_box{
		border-top:1px solid #cdcdcd;
		padding:10px;
		position:relative;			
	}
	
	.list_box .room_box:hover{
		background-color:#f2f2f2;
	}
	
	.list_box .det2{
		position:absolute;
		right:10px;
		bottom:18px;
		background-color:#7ec6f7;
		padding:8px;
		font-size:12px;
		border-radius:4px;
	}
	
	.list_box .det2:hover {
		background-color:#bcefff;
	}
	
	.list_box .time{
		position:absolute;
		right:60px;
		top:10px;
		font-size:12px;
		color:#888;
	}
	
	.time .badge{			
		position:absolute;
		left:-20px;
		top:0px;
		width: 15px;
		height: 15px;
	}
	
	.mythumb2{
		width: 50px;
		height: 50px;
		overflow: hidden;
		display: block;
		border-radius: 50px;
		text-align: center;
		position:absolute;
		left:10px;
	}
	
	.mythumb2 img{
		width: 50px;
		height: 50px;
	}
	
	.text_over{
		overflow:hidden;
		white-space:nowrap;
		text-overflow:ellipsis;
		font-size:15px;
		padding-top:10px;
	}
	
	.profile_box {
		position: absolute;
		width:100%;
		height:90%;
		overflow:auto;
	}
	
	.profile_box .profile_top {
		position: relative;
		width: 100%;
		height: 35%;
		background-color: #f2f2f2;
		border-top: 3px solid black;
	}
	
	.profile_box .profile_middle {
		position: relative;
		width: 100%;
		height: 15%;
		padding-top:10%;
		background-color: white;
		border-top: 3px solid black;
		text-align: -webkit-center;
		
	}
	
	.profile_middle .middle_info {
		float:left;
		width:33.33333%;
		height:100%;
		font-size:12px;
	}
	
	.profile_middle .sub_middle_info {
		position:relative;
		width:33%;
		font-size:15px;
	}
	
	.profile_box .profile_bottom {
		position: relative;
		width: 100%;
		height: 27%;
		background-color: white;
		border-top: 3px solid black;
		text-align: -webkit-center;
	}
	
	.profile_bottom .bottom_info {
		float:left;
		width:33%;
		height:80%;
		font-size:12px;
	}
	
	.profile_bottom .sub_bottom_info {
		position:relative;
		width:90%;
		height:60%;
		font-size:18px;
	}
	
	.sub_bottom_info img {
		width:100%;
		height:100%;
	}
	
	.profile_box .profilethumb{
			width: 100px;
			height: 100px;
			overflow: hidden;
			border-radius: 50px;
			text-align: center;
			position:absolute;
			left:36%;
			top:20%;
	}
		
	.profile_box .profilethumb img{
			width: 100px;
			height: 100px;
			align : center;
	}
		
	.profile_box .sendbtn {
		text-align:center;
		margin-left:5%;
		padding:10px 30px 10px 30px;
		border-radius: 10px;
		background-color:#f9c454;
		display:inline-block;
		float:left;
	}
	
	.profile_box .circlebtn {
		width: 70%;
		height: 90%;
		overflow: hidden;
		float:left;
		border-radius: 50px;
		text-align: center;
		font-size:12px;
		background-color:#a7f2f9;
		position:relative;
		left:35%;
		margin-top:3%;
		padding:1px;
	}
	
	body{margin:0px;}
	ul{padding:0px;}
</style>
<div class="total">
</div>
<script>
	$(document).ready(function() {
		friendsReload(5);
	});
	
	function friendsReload(idx){ <?php //페이지 이동 함수 ?>
		switch(idx){
		case 1:
			$(".result").load("/friends/myFriends");
			break;
		case 2:
			$(".result").load("/friends/invite");
			break;
		case 3:
			$(".result").load("/friends/msCheck");
			break;
		case 4:
			$(".result").load("/friends/inviteEvents");
			break;
		case 5:
			$(".total").load("/friends/friendList");
			break;
		case 6:
			$(".total").load("/friends/msRoom");
			break;
		}
	}
	
	function changeFont(idx){ <?php //탭 클릭 시 bold 변경 함수 ?>
		switch(idx){
		case 1:
			$("#myfriends").css("font-weight","bold");
			$("#invite").css("font-weight","");
			$("#messege").css("font-weight","");
			break;
		case 2:
			$("#myfriends").css("font-weight","");
			$("#invite").css("font-weight","bold");
			$("#messege").css("font-weight","");
			break;
		case 3:
			$("#myfriends").css("font-weight","");
			$("#invite").css("font-weight","");
			$("#messege").css("font-weight","bold");
			break;
		case 4:
			$("#myfriends").css("font-weight","");
			$("#invite").css("font-weight","bold");
			$("#messege").css("font-weight","");
			$(".sub_menu_tab #sub_left").css("font-weight","bold");
			$("#sub_right").css("font-weight","");
			break;
		case 5:
			$("#myfriends").css("font-weight","");
			$("#invite").css("font-weight","bold");
			$("#messege").css("font-weight","");
			$(".sub_menu_tab #sub_left").css("font-weight","");
			$("#sub_right").css("font-weight","bold");
			break;
		}
	}
</script>