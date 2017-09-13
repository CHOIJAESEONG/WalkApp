<style>
div.walk_tab div[class="event_tab"] {
	height: 50px;
	display: block;
	width: 100%;
}

div.walk_tab ul[class="event_tab_item"] {
	display: -webkit-box;
	padding: 0px;
	height: 100%;
	border: 1px solid #000;
}

div.walk_tab span {
	display: table-cell;
	vertical-align: middle;
	text-align: center;
}

div.walk_tab div[id="pre_event"] {
	width: 33.3333333%;
	color: black;
	cursor: pointer;
	position: relative;
	display: table;
	height: 100%;
}

div.walk_tab div[id="out_event"] {
	width: 33.3333333%;
	color: black;
	cursor: pointer;
	position: relative;
	display: table;
	height: 100%;
}

div.walk_tab div[id="live_event"] {
	width: 33.3333333%;
	color: black;
	cursor: pointer;
	position: relative;
	display: table;
	height: 100%;
}

div.walk_tab .event_tab_item #out_event span {
	display: table-cell;
	vertical-align: middle;
	text-align: center;
}

div.walk_tab #events_list {
	background-color: white;
	margin: 5px;
	width: 95%;
}

div.walk_tab #event_lists {
	height: 120px;
	background-color: #ddd;
	margin: 5px;
	display: -webkit-inline-box;
	font-size: 14px;
	width: 100%;
	position: relative;
	border-radius: 10px;
}

div.walk_tab .event_poster {
	display: -webkit-box;
	height: 200px;
	max-width: 85px;
	max-height: 100%;
}


div.walk_tab #event_items {
	display: block;
}



div.walk_tab .partici_button {
	border: outset;
	background: mintcream;
	height: 20px;
	position: absolute;
	right: 10px;
	bottom: 10px;
	width: 60px;
	border-radius: 6px;
}

div.walk_tab .move_buttons {
	text-align: center;
	position: relative;
	margin: auto;
}

div.walk_tab div.focus_on_item {
	/* display: none; */
	position: fixed;
	background-color: #ddd;
	width: 70%;
	height: 140px;
	text-align: -webkit-center;
	margin-left: 22%;
	top: 70%;
	border-radius: 6px;
}

div.walk_tab ul.event_items_details{
	list-style: none;
    position: absolute;
    left: 20%;
    font-size: 12px;
    font-weight: 500;
    color: #030352;
    width: 55%;
    height: 85%;
}
</style>


<div class="walk_tab">
	<div class="event_tab";>
		<ul class="event_tab_item">
			<div id="live_event" onclick="loadList()">
				<span style="font-weight: bold;">진행중 대회 </span>
			</div>
			<div id="pre_event" onclick="loadList('predate')"
				style="font-weight: bold;">
				<span>| 진행 예정 |</span>
			</div>
			<div id="out_event" onclick="loadList('close')">
				<span style="font-weight: bold;">종료된 대회 </span>
			</div>
		</ul>
	</div>
	<div id="events_list" style="display: contents;"></div>
</div>



<script>	
	$(document).ready(function(){
		loadList("");
	});

	function loadList(tab){
	  	$("#events_list").load("/walk/getWalkList/"+tab);
	}
		
</script>
