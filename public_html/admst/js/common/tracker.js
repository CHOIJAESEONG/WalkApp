/*
  트랙 JS
  CreateDate : 2017. 02. 10 
  ModifyDate : 2017. 03. 29 
  Copyright by Focusnews.  All rights reserved.
  
 */
 
Tracker = function(obj) {
	var pp ={};
	var anim_end_flag = false;
	this.params = {};
	
	this.params.window = {
		width 	: $(window).width(),				//화면넓이
		height 	: $(window).height()				//화면높이
	};
	this.params.canvas = {
		width 	: this.params.window.width,		//Canvas 넓이
		height 	: this.params.window.height     	//Canvas 높이
	};
	this.params.track = {
		color 		: "#789",						//트랙 색상
		strokewidth : 5,							//트랙 선 넓이
		logo		: ""
	};
	this.params.pin = {
		color 		: "#000",						//핀 색상
		radius		: 10,							//핀 반지름
		arr			: new Array()					//스탬프
	};
	this.params.progress = {
		step 	: 0
	};
	
	this.init = function() {
		// $("canvas").attr("width",this.params.window.width);		
		// $("canvas").attr("height",this.params.window.height/4.5);	
		// this.params.canvas.width = $("canvas").attr("width");
		// this.params.canvas.height = $("canvas").attr("height");	
		$("canvas").attr("width",this.params.canvas.width);		
		$("canvas").attr("height",this.params.canvas.height);		
	};
	
	this.drawTrack = function() {
		$('canvas').drawArc({
			layer:true,
			name:'track1',
			strokeStyle: this.params.track.color,
			strokeWidth: this.params.track.strokewidth,
			x: this.params.canvas.width*(0.2), 
			y: this.params.canvas.height*(0.5),
			radius: this.params.canvas.width*(0.15),
			start: 1, end: 179,
			ccw: true,
			closed: false
		})
		.drawLine({
			layer:true,
			strokeStyle: this.params.track.color,
			strokeWidth: this.params.track.strokewidth,
			x1: this.params.canvas.width*(0.2), y1: this.params.canvas.height*(0.5) - this.params.canvas.width*(0.15),
			x2: this.params.canvas.width*(0.8), y2: this.params.canvas.height*(0.5) - this.params.canvas.width*(0.15)
		})
		.drawLine({
			layer:true,
			strokeStyle: this.params.track.color,
			strokeWidth:this.params.track.strokewidth,
			x1: this.params.canvas.width*(0.2), y1: this.params.canvas.height*(0.5) + this.params.canvas.width*(0.15),
			x2: this.params.canvas.width*(0.8), y2: this.params.canvas.height*(0.5) + this.params.canvas.width*(0.15)
		})
		.drawArc({
			layer:true,
			name:'track3',
			strokeStyle: this.params.track.color,
			strokeWidth: this.params.track.strokewidth,
			x: this.params.canvas.width*(0.8), 
			y: this.params.canvas.height*(0.5),
			radius: this.params.canvas.width*(0.15),
			start: 181, end: -1,
			ccw: true,
			closed: false
		})
		.drawImage({
		  layer:true,
		  source: this.params.track.logo,
		  x: this.params.canvas.width*(0.5), y: this.params.canvas.height*(0.5),
		  scale : 0.3
		})		
		.drawArc({
			layer:true,
			name:'start-pin',
			fillStyle: '#456',
			x: this.params.canvas.width*(0.2), 
			y: this.params.canvas.height*(0.5) - this.params.canvas.width*(0.15),
			radius: this.params.pin.radius+10
		})
		.drawImage({
			layer:true,
			name:'start-img',
			source: '/mnt/walk/activity/MainActivity_2/flag.png',
			x: this.params.canvas.width*(0.2), 
			y: this.params.canvas.height*(0.5) - this.params.canvas.width*(0.15),
			scale : 0.9
		});
	};
	
	
	this.clickStamp = function(obj){
		if(!anim_end_flag){return;}
		if(this.params.progress.step<obj.pg){ 
			alert("분발하세요 아직 멀었습니다.");
		}
		else{ 
			if(obj.checked){
				// myApp.pickerModal('.picker');	
			}
			else{
				$.post("/actionsheet/setstamp_sheet/", {}, function(response){
					$("div[comp_prop='stamp_sheet_set']").html(response);
					myApp.pickerModal('.picker-set-stamp');
					$("#set_stamp").on("click",function(){ location.href = "/content/wish/"+obj.id; });
					
				});
				
			}
				
		}
		
	}
	
	this.drawPin = function(pg,arr) {
		var stamps = $('canvas').getLayerGroup('stamps');
		if(arr&&stamps){
			this.params.pin.arr = arr;
			for(var i=0;i<stamps.length;i++){				
				if(stamps[i].checked){
					stamps[i].fillStyle = "#333";					
				}else{
					if(pg>=stamps[i].pg){
						stamps[i].fillStyle = "#007ef9";					
					}
				}
			}
			
		}
		
		
		
		this.params.progress.step=0; //clear anim
		if (pg === '') {
			return;
		}
		
		/*핀 최초위치 Draw*/
		$('canvas').drawArc({
			layer:true,
			name:'pin',
			fillStyle: this.params.pin.color,
			x: this.params.canvas.width*(0.2), 
			y: this.params.canvas.height*(0.5) - this.params.canvas.width*(0.15),
			radius: this.params.pin.radius,
		});
		//Anim 호출
		pp= this.params;
		$(this.params.progress)
		.stop()
		.animate({
			step: pg,
			

		}, {
			duration: 2500,
			step: this.draw,
			complete: function() {
				anim_end_flag = true;
			}
		});
		
	};

	this.draw = function() {
		this.params = pp;
		var step = this.params.progress.step;	//단계별 Progress
		var degree;			//곡선운동용 단위
		if(step==0){
			//0 영역 - 원점
			$('canvas').setLayer('pin', {
				x: this.params.canvas.width*(0.2), 
				y: this.params.canvas.height*(0.5) - this.params.canvas.width*(0.15),
			})
			.drawLayers();	
		}
		if(0<step&&step<=25){
			//1 영역 - 직선운동
			$('canvas').setLayer('pin', {
			    x: this.params.canvas.width*(0.2+(0.15*(step/6.25))), 
				y: this.params.canvas.height*(0.5) - this.params.canvas.width*(0.15)
			})
			.drawLayers();			
		}
		else if(25<step&&step<=50){
			//2 영역 - 곡선운동
			if((step-25)*7.2<=90){
				degree = ((step-25)*7.2)-90;
			} 
			else{
				degree = ((step-25)*7.2)-90;
			} 			
			this.params.progress.radians = Calc.radians(degree);
			$('canvas').setLayer('pin', {
			x: ( this.params.canvas.width*(0.8)) + ( this.params.canvas.width*(0.15) * Calc.cos(this.params.progress.radians)), 
			y: ( this.params.canvas.height*(0.5)) + ( this.params.canvas.width*(0.15) * Calc.sin(this.params.progress.radians))
			})
			.drawLayers();		
		}
		else if(50<step&&step<=75){
			//3 영역 - 직선운동
			$('canvas').setLayer('pin', {
				x: this.params.canvas.width*(0.8-(0.15*((step-50)/6.25))), 
				y: this.params.canvas.height*(0.5) + this.params.canvas.width*(0.15),
			})
			.drawLayers();	
		}
		else if(75<step&&step<=100){
			//4 영역 - 곡선운동
			if((step-25)*7.2<=90){
				degree = ((step-25)*7.2)+90;
			} 
			else{
				degree = ((step-25)*7.2)+90;
			} 			
			this.params.progress.radians = Calc.radians(degree);
			$('canvas').setLayer('pin', {
			x: ( this.params.canvas.width*(0.2)) + ( this.params.canvas.width*(0.15) * Calc.cos(this.params.progress.radians)), 
			y: ( this.params.canvas.height*(0.5)) + ( this.params.canvas.width*(0.15) * Calc.sin(this.params.progress.radians))
			})
			.drawLayers();		
		}

	};
	
		
	this.drawStamp = function(id,tit,checked,pg){
		var construct = this;
		var step = pg;	//단계별 Progress
		var x = 0;
		var y = 0;
		var radians;
		var degree;	
		
		if(step==0){
			x = this.params.canvas.width*(0.2);
			y = this.params.canvas.height*(0.5) - this.params.canvas.width*(0.15);
		}
		if(0<step&&step<=25){
			x = this.params.canvas.width*(0.2+(0.15*(step/6.25)));
			y = this.params.canvas.height*(0.5) - this.params.canvas.width*(0.15);		
		}
		else if(25<step&&step<=50){
			if((step-25)*7.2<=90){
				degree = ((step-25)*7.2)-90;
			} 
			else{
				degree = ((step-25)*7.2)-90;
			} 			
			radians = Calc.radians(degree);
			x = ( this.params.canvas.width*(0.8)) + ( this.params.canvas.width*(0.15) * Calc.cos(radians));
			y = ( this.params.canvas.height*(0.5)) + ( this.params.canvas.width*(0.15) * Calc.sin(radians));			
		}
		else if(50<step&&step<=75){
			x = this.params.canvas.width*(0.8-(0.15*((step-50)/6.25)));
			y = this.params.canvas.height*(0.5) + this.params.canvas.width*(0.15);			
		}
		else if(75<step&&step<=100){
			if((step-25)*7.2<=90){
				degree = ((step-25)*7.2)+90;
			} 
			else{
				degree = ((step-25)*7.2)+90;
			} 			
			radians = Calc.radians(degree);
			x = ( this.params.canvas.width*(0.2)) + ( this.params.canvas.width*(0.15) * Calc.cos(radians));
			y = ( this.params.canvas.height*(0.5)) + ( this.params.canvas.width*(0.15) * Calc.sin(radians));
		}
		
		$('canvas').drawArc({
			layer		:true,
			groups		: ['stamps'],
			fillStyle	: '#FFC93E',
			x			: x, 
			y			: y,
			radius		: this.params.pin.radius+3,
			pg 			: step,
			id 			: id,
			tit 		: tit,
			checked 	: checked,
			click : function(layer){
				construct.clickStamp(layer);
			}
		});
		
		
		
	};
	
	
	
	
	
	
	
	
	

};
