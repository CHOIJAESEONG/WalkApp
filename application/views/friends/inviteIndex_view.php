<style>
.list_box ul{
		list-style:none;
		padding:0px;
		border-left:1px solid #cdcdcd;
		border-right:1px solid #cdcdcd;
		border-bottom:1px solid #cdcdcd;
		margin-bottom:20%;
	}
	
	.list_box .invite_box{
		border-top:1px solid #cdcdcd;
		padding:10px;
		position:relative;
	}
	
	.list_box .invite_box:hover {
		background-color:#f2f2f2;
	}
	.list_box li .invite_box {position:relative;padding:10px 0px;}
	
	.list_box .invite_bt ,.list_box .notinvite_bt {
		position:absolute;
		right:10%;
		top:20px;
		background-color:#b6bef9;
		padding:8px;
		font-size:12px;
		border-radius:4px;
	}

	.list_box .invite_bt:hover {
		background-color:#daceff;
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
	
	.list_box .invite_container {
		width:97%;
		height:40px;
		background-color:#cdcdcd;
		margin:5px;
		text-align:center;
		padding-top:15px;
	}
	
	.pop-layer .pop-container {
		padding: 20px 25px;
		
	}  
	
	.pop-layer{
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
	body{margin:0px}
	ul{padding:0px;}
</style>
<div class="total">
</div>
<script>
$(document).ready(function() {
		inviteReload(1);
	});
	
	function inviteReload(idx){
		switch(idx){
		case 1:
			$(".total").load("/friends/inviteList");
			break;
		}
	};  
</script>