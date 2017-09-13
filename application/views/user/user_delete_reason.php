<style>
	.pop-layer .pop-container {
		padding: 20px 25px;
	}
	.pop-layer {
		display: none;
		position: absolute;
		top: 20%;
		left: 10%;
		width: 310px;
		height: auto;
		background-color:white;
		z-index:10000;  
	}
	.pop_bt, .check, .cancel{
		border : 1px; 
		background : lightskyblue;
		padding : 5px;
		margin:5px;
		color:white;
	}
	.drView{
		width:100%;
		height:100%;
	}
	.drView .drView_title{
		font-size:20px; 
		text-align:center; 
		padding:30px; 
		padding-bottom:20%; 
		color:#979797;
	}
	.drView .drView_content{
		padding-left:5%;
		padding-bottom:30%;
	}
	drView.pop_bt:active{
		background-color: black;
	}
	#mask {  
		position:absolute;  
		z-index:9000;  
		background-color:#000;  
		display:none;  
	}
	.pop-container .pop-title{
		border-bottom: 1px solid black; 
		padding-bottom:5%
	}
	.pop-container .message{
		padding-top:5%;
	}
</style>
<div id="mask"></div>
<div class="drView">
	<div class="drView_title"> 회원탈퇴 사유선택 </div>	
	<div class="drView_content">
		<form action="">
			<?php 
			foreach ($pwReasons as $pwReason ) { 		
				if($pwReason-> 공통코드_id==6){	?>
					<div style="padding:5px; font-size:20px;"> <input type="radio" name="reason" value="<?=$pwReason-> 공통코드_id?>"><?=$pwReason-> 코드명?> <input type="text" name="etc" style="border:none; border-bottom:1px solid black; width:70%"> </div>
			<?php
				} else { ?>
					<div style="padding:5px; font-size:20px;"> <input type="radio" name="reason" value="<?=$pwReason-> 공통코드_id?>"><?=$pwReason-> 코드명?> </div>		
			<?php 
				}
			}	
			?>
		</form>
	</div>
	<div class="pop_bt" style="background:#60b9f0; margin:0px auto; width:70%; position:relative; padding:10px 0px; text-align:center; color:white">  확인 </div>
</div>
<div id="layer1" class="pop-layer">
	<div class="pop-container">
		<div class="pop-conts">
			<div class="pop-title" align="center">회원탈퇴 유의사항 </div>		           
			<?php  //content ?>
			<div class="message" align="center" style="">회원탈퇴 시 대회 참여이력, 친구 정보, 쪽지, 경품 획득 정보 등 개인정보가 삭제되면 복구 및 이용이 불가능합니다. </div>
			<div class="btn-r">
				<div class="check" style="cursor:pointer; display:inline"> 확인하고 탈퇴하겠습니다. </div>
				<div class="cancel" style="cursor:pointer; display:inline"> 취소 </div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	$('.pop_bt').click(function() {
		<?php //validation 선택 된것이 없거나 ?>
		if($(":input:radio[name=reason]").is(':checked')==false){
			alert("체크하지 않았습니다.");
			return;
		}
		<?php //기타인 경우 값이 없을 때 ?>
		if($(":input:radio[name=reason]:checked").val()==6 && $(":input:text[name=etc]").val()==""){
			alert("기타 내용을 입력하세요");
			return;
		}				
		//화면 팝업 처리
		wrapWindowByMask();
	});

	$('.cancel').click(function() {
		$('#mask, #layer1').hide();
	});
	
	$('.check').click(function() {
		$('#mask,#layer1').hide();				
		$.ajax({
			type:"POST", 
			url: "/user/deleteInfo", 
			dataType:"json", 
			data:{"reason" : $(":input:radio[name=reason]:checked").val(),
				  "etc" : $(":input:text[name=etc]").val()
			},
			success: function(result){
				alert("삭제 완료");
				location.href="/user/loginIndex"
			},error: function(result){
			}
		});
	});
	
	function wrapWindowByMask(){
		//화면의 높이와 너비를 구한다.
		var maskHeight = $(document).height();  
		var maskWidth = $(window).width();  
		
		//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
		$("#mask").css({"width":maskWidth,"height":maskHeight});  
		$("#mask").fadeTo("slow",0.6);    
		$(".pop-layer").show();
	}
});
</script>