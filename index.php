<html>
<head>
	<style>
		body{
			padding:0px;
			margin:0px;
		}
		
		#center{
			width:100%;
			margin:0px auto;
			height:100%;
			color:white;
			font-family: 'Lato',Arial,sans-serif;
			background:rgba(5,5,5,0.9);
		}
		
		#timerHeader{
			width:120px;
			font-size:30px;
			margin:0px auto;
		}
		
		#numberBody{
			width:100%;
		}
		
		#resetGame{
			position:absolute;
			right:20px;
			top:5px;
			display:none;
		}
		
		.number{
			width:33%;
			height:31%;
			float:left;
			border:1px solid black;
			font-size:150px;
			text-align:center;
		}
		
		.lvl1{
			background-color:#1abc9c;
		}
		
			.lvl1:active{
				background-color:#19b193;
			}
		
		.lvl2{
			background-color:#2ecc71;
		}
		
			.lvl2:active{
				background-color:#2bbe69;
			}
			
		.lvl3{
			background-color:#3498db;
		}
		
			.lvl3:active{
				background-color:#3290cf;
			}
		
		.lvl4{
			background-color:#9b59b6;
		}
		
			.lvl4:active{
				background-color:#9052a9;
			}
			
		.lvl5{
			background-color:#e67e22;
		}
		
			.lvl5:active{
				background-color:#d97720;
			}
		
		.lvl6{
			background-color:#c0392b;
		}
		
			.lvl6:active{
				background-color:#b43629;
			}
		
		#level{
			position: absolute;
			top: 5px;
			left: 10px;
			width:70px;
		}
		
		#level div{
			width: 25px;
			height: 25px;
			position: absolute;
			top: 0px;
			right: 0px;
		}
		
		/*IE9*/
		*::selection 
		{
			background-color:transparent;
		} 
		*::-moz-selection
		{
			background-color:transparent;
		}
		*
		{        
			-webkit-user-select: none;
			-moz-user-select: -moz-none;
			/*IE10*/
			-ms-user-select: none;
			user-select: none;

			/*You just need this if you are only concerned with android and not desktop browsers.*/
			-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
		}  
	</style>
	
	<meta name="viewport" content="width=device-width, user-scalable=no">
</head>
<body>

<div id="center">
	<div id="timerHeader">00:00:0000</div>
	<div id="resetGame"><button>Reset</button></div>
	<div id="level">Level <div class="lvl1"></div></div>
	<div id="numberBody">
		<div class="number lvl1">1</div>
		<div class="number lvl1">2</div>
		<div class="number lvl1">3</div>
		<div class="number lvl1">4</div>
		<div class="number lvl1">5</div>
		<div class="number lvl1">6</div>
		<div class="number lvl1">7</div>
		<div class="number lvl1">8</div>
		<div class="number lvl1">9</div>
	</div>
</div>

<script src="scripts/jquery.js"></script>
<script>
	var timer = undefined;
	var start = false;
	var collection = [1,2,3,4,5,6,7,8,9];
	var lvl = 1;
	var prev = 1;
	$(function(){
		$(".number").click(function(){
			
			if(!start){
				if($(this).html()==1){
					swatch();
					$("#resetGame").show();
				}
			}
			
			if(start){
				if($(this).html() == prev && $(this).hasClass("lvl"+lvl)){
					$(this).removeClass("lvl"+lvl);
					$(this).addClass("lvl"+(parseInt(lvl)+1));
					
					var rand = Math.floor((Math.random()*collection.length));
					$(this).html(collection[rand]);
					collection.splice( $.inArray(collection[rand], collection), 1 );
					
					prev++;
					
				}
				if(prev == 10){
					prev = 1;
					
					$("#level div").removeClass("lvl"+lvl).addClass("lvl"+(parseInt(lvl)+1));
					
					lvl++;
					
					collection = [1,2,3,4,5,6,7,8,9];
				}
				
				if(lvl == 6){
					alert("CONGRATULATIONS!!");
					$("#resetGame").show();
					clearInterval(timer);
					timer = null
				}
				
			}
			//y.splice( $.inArray($(this).html(), collection), 1 );
		});
		
		
		$("#resetGame button").click(function(){
			clearInterval(timer);
			timer = null
					
			$("#resetGame").hide();
			$("#timerHeader").html("00:00:0000"); 
			
			$(".number").each(function(i,val){
				$(this).removeClass("lvl"+lvl).removeClass("lvl"+(parseInt(lvl)+1)).addClass("lvl1").html(i+1);
			});
			
			$("#level div").removeClass("lvl"+lvl).addClass("lvl1");
			collection = [1,2,3,4,5,6,7,8,9];
			ms=0;
			s=0;
			m=0;
			start=false;
			prev=1
			lvl=1;
			timer=undefined;
		});
	});
	
	var int, ms=0, s=0, m=0;

	function swatch(){
	  start = true;
	  var startTime = new Date().getTime();
	  timer = setInterval(function(){
		  var time = new Date().getTime(); 
		  var dif = time-startTime;
		  ms= dif%1000;
		  s = Math.floor(dif/1000)%60;
		  m = Math.floor(dif/1000/60)%60;
		  $("#timerHeader").html( m+':'+s+':'+ms); 
	  },1);
	}
	

	
</script>


</body>


</html>