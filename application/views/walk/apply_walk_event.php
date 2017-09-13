<style>
div.apply_walk_event .top_content {
	position: relative;
	margin-right: auto;
	background: #f1f1f1;
	text-align: -webkit-center;
	width: 100%;
	height: 25px;
}

div.apply_walk_event div.top_sub_content {
	background: lavender;
	height: 120px;
	margin-top: 10px;
}

div.apply_walk_event div.event_apply_button {
	cursor: pointer;
	margin-right: auto;
	margin-left: auto;
	text-align: -webkit-center;
	border: groove;
	height: auto;
	background: steelblue;
	margin: auto;
	border-radius: 8px;
}

div.apply_walk_event div.event_modify_button {
	cursor: pointer;
	margin-right: auto;
	margin-left: auto;
	text-align: -webkit-center;
	border: groove;
	background: steelblue;
	margin: 20px;
	position: relative;
	top: auto;
	height: auto;
	border-radius: 8px;
}

div.apply_walk_event img#cotent_image {
	position: relative;
	max-width: 85px;
	max-height: 100%;
	float: left;
}

div.apply_walk_event div#top_info_content {
	float: left;
    position: relative;
    font-size: 13px;
    color: #666666;
    font-weight: bolder;
}

div.apply_walk_event p#apply_date {
	font-size: xx-small;
}

div.apply_walk_event div.middle_sub_content {
	background: #e3e3e3;
	height: 180px;
}

div.apply_walk_event div.bottom_sub_content {
	width: 100%;
	background: whitesmoke;
}

div.apply_walk_event div.event_join_content {
	background: whitesmoke;
	height: 120px;
}

div.apply_walk_event li.event_join_content_agree {
	position: relative;
	float: left;
	width: 100%;
	line-height: 30px;
	background-color: #e3e3e3;
	color: #666666;
	font-size: 12px;
	list-style-type: none;
}

div.apply_walk_event ul {
	padding-left: 0px;
	margin-left: 0;
}

div.apply_walk_event input {
	float: right;
}

div.apply_walk_event textarea.agree_area {
	border-color: #DFDFDF;
	background-color: silver;
	color: #333333;
	border-radius: 3px 3px 3px 3px;
	border-style: solid;
	border-width: 1px;
	font-size: 12px;
	position: relative;
	float: left;
	width: 96%;
	padding: 5px;
	height: 100px;
}

div.apply_walk_event ul.middle_sub_content_items {
	font-size: smaller;
	padding: 10px;
	margin: 5px;
	list-style-type: none;
}

div.apply_walk_event select {
	margin: 10px;
	padding: 2px;
	position: relative;
	width: 30%;
}

div.apply_walk_event p#top_company {
	font-size: 10px;
	padding-bottom: 0px;
}
</style>

<div class="apply_walk_event">
	<div class="top_content">
		<b>대회신청하기</b>
	</div>
	<div class="sub_content">
		<div class="top_sub_content">
			<img id="cotent_image" src="<?=경로_걷기대회.$selectEvent[0]->대회포스터 ?>"></img>
			<div id="top_info_content">
				<p id="top_company"><?=$selectEvent[0]->주최?></p>
				<p id="top_title"><?=$selectEvent[0]->제목?></p>				
				<p>목표결음수 : <?=number_format($selectEvent[0]->목표걸음수)?></p>
				<p id="apply_date">신청기간 : <?= substr($selectEvent[0]->시작일시,0,10)?> ~  <?=substr($selectEvent[0]->종료일시,0,10)?></p>
			</div>
		</div>
	
		<div class="middle_sub_content">
			<ul class="middle_sub_content_items">
				<li>이름 : <?=$selectUser->이름?></li>
				<li>성별 : <?=$selectUser->성별?></li>
				<li>이메일 :<?=$selectUser->이메일?></li>
				<li>전화번호:<?=$selectUser->핸드폰?></li>
				<li>지역 
					<select name='Region'>
						<option value=''>-- 선택 --</option>
						<option value='soeul'>서울시</option>
						<option value='gangju'>광주시</option>
					</select> 
					<select name='District'>
						<option value=''>-- 선택 --</option>
						<option value='seocho'>서초구</option>
						<option value='gangdong'>강동구</option>
					</select>
				</li>
				<div class="event_modify_button" value="개인정보 변경하기">
					<b>개인정보 변경하기</b>
				</div>
			</ul>
		</div>
	
		<div class="bottom_sub_content">
			<div class="event_join_content">
				<ul class="event_join_content_lists">
					<li class="event_join_content_agree">
						<input type="checkbox" name="all_agree" id="all_agree_button"> 
							<b class="agree_event" id="all_granted_button" style="font-size: small; text-decoration: underline">
								아래의 내용에 모두동의합니다.<br>
							</b> 
						</input>
					</li>
		
					<ul class='agree_subject'>
						<li class="event_join_content_agree" id="li1">
							<input type="checkbox" name="agree_box" id="agree02"> 
								<b class="agree_event" id="granted_button1" style="font-size: small; text-decoration: underline; cursor: pointer;">
									개인정보 취금방침동의(필수)<br>
								</b> 
							</input> 
							<textarea class=agree_area id="textarea1" style="display: none">동의 내용 ~~ </textarea>
						</li>
		
						<li class="event_join_content_agree" id="li2">
							<input type="checkbox" name="agree_box" id="agree03"> 
								<b class="agree_event" id="granted_button2" style="font-size: small; text-decoration: underline; cursor: pointer;">
									개인정보 3자 제공에 대한 동의(필수)<br>
								</b> 
							</input> <textarea class=agree_area id="textarea2" style="display: none">동의 내용 ~~ </textarea>
						</li>
		
						<li class="event_join_content_agree" id="li3">
							<input type="checkbox" name="agree_box" id="agree04"> 
								<b class="agree_event" id="granted_button3" style="font-size: small; text-decoration: underline; cursor: pointer;">
									개인정보 마케팅 활용에 대한 동의(선택)<br>
								</b> 
							</input> <textarea class=agree_area id="textarea3" style="display: none">동의 내용 ~~ </textarea>
						</li>
						
					</ul>
				</ul>
			</div>
		</div>
		<a href="/activity/MainActivity_2/" >
			<div class="event_apply_button" value="abcdefg">
					<b>신청완료</b>
			</div>
		</a>
	</div>
</div>

<script type="text/javascript">

	$(document).ready(function(){
		$("#all_agree_button").click(function(){
			var chk = $(this).is(":checked");	//check여부
			
			if(chk){$(".agree_subject input").prop('checked',true);}
			else{$(".agree_subject input").prop('checked',false);}
		});
	});
	
	var cur_open = "";      //현재 열려있는 토글
    function toggleclose(submenu_class){
    	$('#'+cur_open).animate({
        	opacity : "show", //투명도
        	height : "toggle",
        	queue : true
		});          
		cur_open="";
	}
	
    
	function toggle_animate(move_menu){
		if(cur_open!="" && cur_open!=move_menu){      //열려있는 토글이 현재 토글이 아니면,
            toggleclose(cur_open);  //열려있는 토글닫고,
            $('#'+move_menu).animate({    //다시 토글
                  opacity : "show", //투명도
                  height : "toggle",
            });
            cur_open = move_menu;
      	}
      	else if(cur_open==""){  //열려있는 토글이 없다면,
	    	$('#'+move_menu).animate({    //다시 토글
	        	opacity : "show", //투명도
	        	height : "toggle",
	     	});
	        cur_open = move_menu;
	    }else if(cur_open == move_menu){    //현재 열려있는 토글이 지금 토글이면,
	    	toggleclose(cur_open);  //열려있는 토글 닫기
	    }
	}	

	$(document).ready(function() {
    	$('.agree_event').click(function() {
        	var submenu_check = $(this).attr('id');  //클래스 확인을 위함
        	$(".event_join_content_agree").css("background-color",'#e3e3e3');   
    		if(submenu_check == "granted_button1") {
            	var move_menu = "textarea1";  //움직일 토글
            	toggle_animate(move_menu); 
            	if(cur_open==move_menu){
         			$(".event_join_content_agree[id=li1]").css("background-color",'lightsteelblue');
         	    }                      
            }
       		else if (submenu_check == "granted_button2") {
            	var move_menu = "textarea2";  //움직일 토글
            	toggle_animate(move_menu);
            	if(cur_open==move_menu){
         			$(".event_join_content_agree[id=li2]").css("background-color",'lightsteelblue');
         	    }      
            }
            else if (submenu_check == "granted_button3") {
            	var move_menu = "textarea3";  //움직일 토글
            	toggle_animate(move_menu);
            	if(cur_open==move_menu){
         			$(".event_join_content_agree[id=li3]").css("background-color",'lightsteelblue');
         		}  
        	}
   		});
	});
</script>

<?php
?>


