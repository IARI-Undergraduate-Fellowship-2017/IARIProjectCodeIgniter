<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>IARI</title>
		<!-- Leaflet -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>third_party/leaflet/leaflet.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>third_party/leaflet/leaflet.label.css" />
		<script src="<?php echo base_url(); ?>third_party/leaflet/leaflet.js"></script>
		<script src="<?php echo base_url(); ?>third_party/leaflet/leaflet.label.js"></script>
		<style type="text/css">
			#map {	height: 885px;
					width: 1731px;}
			body, html {
      		font-family: sans-serif;
    	}
		</style>
		<!-- Calendar -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>third_party/calendar/stylesheets/calendarview.css" />
		<style>
			body {
				font-family: Trebuchet MS;
			}
			div.calendar {
				max-width: 240px;
				margin-left: auto;
				margin-right: auto;
			}
			div.calendar table {
				width: 100%;
			}
			div.dateField {
				width: 140px;
				padding: 6px;
				-webkit-border-radius: 6px;
				-moz-border-radius: 6px;
				color: #555;
				background-color: white;
				margin-left: auto;
				margin-right: auto;
				text-align: center;
			}
			div#popupDateField:hover {
				background-color: #cde;
				cursor: pointer;
			}
		</style>
		<script src="<?php echo base_url(); ?>third_party/calendar/javascripts/prototype.js"></script>
		<script src="<?php echo base_url(); ?>third_party/calendar/javascripts/calendarview.js"></script>
		<!-- jQuery -->
		<script src="<?php echo base_url(); ?>third_party/jQuery/jquery-3.1.1.min.js"></script>
		<!-- vis -->
		<script src="<?php echo base_url(); ?>third_party/vis-4.18.1/dist/vis.js"></script>
  	<!-- <link href="lib/vis-4.18.1/dist/vis.css" rel="stylesheet" type="text/css" /> -->
		<link href="<?php echo base_url(); ?>third_party/vis-4.18.1/dist/vis-timeline-graph2d.min.css" rel="stylesheet" type="text/css" />

		<!-- BootStrap -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>third_party/bootstrap-3.3.7-dist/css/bootstrap.min.css" />
		<script src="<?php echo base_url(); ?>third_party/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		<style>
			/* Remove the navbar's default margin-bottom and rounded borders */
			.navbar {
				margin-bottom: 0;
				border-radius: 0;
			}

			/* Set height of the grid so .sidenav can be 100% (adjust as needed) */
			.row.content {height: 450px}

			/* Set gray background color and 100% height */
			.sidenav {
				padding-top: 20px;
				background-color: #f1f1f1;
				height: 100%;
			}

			/* Set black background color, white text and some padding */
			footer {
				background-color: #555;
				color: white;
				padding: 15px;
			}

			/* On small screens, set height to 'auto' for sidenav and grid */
			@media screen and (max-width: 767px) {
				.sidenav {
					height: auto;
					padding: 15px;
				}
				.row.content {height:auto;}
			}
		</style>

	</head>

	<body>
		<!--  -->
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="#">Logo</a>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav">
		        <li class="active"><a href="#">Home</a></li>
		        <li><a href="#">About</a></li>
		        <li><a href="#">Projects</a></li>
		        <li><a href="#">Contact</a></li>
		      </ul>
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		      </ul>
		    </div>
		  </div>
		</nav>

		<div class="container-fluid text-center">
		  <div class="row content">
		    <div class="col-sm-2 sidenav">
		      <p><a href="#">Link</a></p>
		      <p><a href="#">Link</a></p>
		      <p><a href="#">Link</a></p>
		    </div>
		    <div class="col-sm-8 text-left">
					<!--  -->
					<!--  -->
		    </div>
		    <div class="col-sm-2 sidenav">
		      <div class="well">
		        <p>ADS</p>
		      </div>
		      <div class="well">
		        <p>ADS</p>
		      </div>
		    </div>
		  </div>
		</div>

		<footer class="container-fluid text-center">
		  <p>Footer Text</p>
		</footer>
		<!--  -->
		<h1>IARI</h1>
		<div id="map"></div>

		<br />
		<div style="float: right; width: 15%">
			<div style="height: 230px; background-color: #efefef; padding: 10px; -webkit-border-radius: 12px; -moz-border-radius: 12px; margin-right: 10px">
				<div id="embeddedExample" style="">
					<div id="embeddedCalendar" style="margin-left: auto; margin-right: auto"></div>
					<br />
					<div id="embeddedDateField" class="dateField">
						Select Date
					</div>
					<br />
				</div>
			</div>
		</div>

		<p id="currDate"></p>
		<div id="fullCalendar"></div>
		<p id="d"></p>

		<script>
			$.noConflict();
			jQuery(document).ready(function(){
				<!-- Retrieve Gallery Model 3th JSON -->
				var url = "<?php echo base_url(); ?>resources/misc/gallery_model_3th.json";
				jQuery.getJSON(url,function(data){
					galModel3 = data;
					console.log(galModel3);

					<!-- Retrieve Gallery Model 4th JSON -->
					var url = "<?php echo base_url(); ?>resources/misc/gallery_model_4th.json";
					jQuery.getJSON(url,function(data){
						galModel4 = data;
						console.log(galModel4);

						<!-- Retrieving Interactive Model 3th JSON -->
						var url = "<?php echo base_url(); ?>resources/misc/interactive_model_3th.json";
						jQuery.getJSON(url,function(data){
							intModel3 = data;
							console.log(intModel3);

							<!-- Retrieving Interactive Model 4th JSON -->
							var url = "<?php echo base_url(); ?>resources/misc/interactive_model_4th.json";
							jQuery.getJSON(url,function(data){
								intModel4 = data;
								console.log(intModel4);

								<!-- Retrieving Museum Model JSON -->
								var url = "<?php echo base_url(); ?>resources/misc/museum_model.json";
								jQuery.getJSON(url,function(data){
									museumModel = data;
									console.log(museumModel.floor[0].image);
									console.log(url);
									museumModel = museumModelImageaddress(museumModel);
									currFloor = museumModel.floor[0];

									setupMap(mapConfig, [currFloor.imageHeight,currFloor.imageWidth], currFloor.image);
							    drawInteractiveLayer(mapConfig,intModel3);

									<!-- Retrieving Schedule JSON -->
									var url = "<?php echo base_url(); ?>resources/misc/exhibition_schedule.json";
									jQuery.getJSON(url,function(data){
										sched = data;
										convertDateSched(sched);

										document.getElementById("currDate").innerHTML = selDate.toString();
										exhibList = matchDate(sched, selDate,selDate);
										disp(exhibList);
										polyList = matchPlace(exhibList,currFloor);
										console.log(polyList);
										drawPolyLayer(mapConfig,polyList);
										drawMarkerLayer(mapConfig,polyList);
										setupFullCalendar(fullCalendarConfig, sched);
									});
								});
							});
						});
					});
				});
			});
			function getCurrentDateString(){
				var tmp = new Date();
				return (tmp.getMonth()+1) +"/" + tmp.getDate() + "/" + tmp.getFullYear();
			}

			function normalizeDate(date){
				date.setHours(0,0,0,0);
				return date;
			}

			function convertDateSched(sched){
				var i;
				for(i=0;i<sched.length;i++){
					sched[i]['From'] = new Date(sched[i]['From']);
					sched[i]['To'] = new Date(sched[i]['To']);
					sched[i]['Amended'] = new Date(sched[i]['Amended']);
				}
			}

			function exhib(){
				this.name = "";
				this.place = "";
				this.year = "";
				this.from = "";
				this.to = "";
				this.curatedBy = "";
				this.amended = "";
				this.color = "";
			}

			function createExhib(name, place, year,from,to,curatedBy,amended){
				var tmp = new exhib();
				tmp.name = name;
				tmp.place = place;
				tmp.year = year;
				tmp.from = from;
				tmp.to = to;
				tmp.curatedBy = curatedBy;
				tmp.amended = amended;
				return tmp;
			}

			function poly(name, exhib, coord, center, color){
				this.name = name;
				this.exhib = exhib;
				this.coord = coord;
				this.center = center;
				this.color = "";
			}

			function matchDate(sched, start = normalizeDate(new Date()),end = normalizeDate(new Date()) ){
				console.log(start.toString());
				console.log(end.toString());
				var exhibList = [];
				var i;
				for(i=0;i<sched.length;i++){
					if( ((sched[i]['From'] <= start) && (sched[i]['To'] >= start)) ||
						((sched[i]['From'] <= end) && (sched[i]['To'] >= end)) ||
						((sched[i]['From'] >= start) && (sched[i]['To'] <= end)) ){

						exhibList.push(createExhib(	sched[i]['Exhibition Name'],
													sched[i]['Place'],
													sched[i]['Year'],
													sched[i]['From'],
													sched[i]['To'],
													sched[i]['Curated By'],
													sched[i]['Amended']
													));
					}
				}
				return exhibList;
			}

			function customSelectHandler(calendar){
				Calendar.defaultSelectHandler(calendar);
				selDate = normalizeDate(calendar.date);
				document.getElementById("currDate").innerHTML = selDate.toString();
				exhibList = matchDate(sched,selDate,selDate);
				disp(exhibList);
				polyList = matchPlace(exhibList,currFloor);
				console.log(polyList);
				drawPolyLayer(mapConfig,polyList);
				drawMarkerLayer(mapConfig,polyList);
			}

			function disp(arr){
				var out = "";
				var i;
				for(i = 0;i<arr.length;i++){
						out+=i + ": "+ arr[i].place + " : " + arr[i].from.toString() +" : " + arr[i].to.toString() + "<br />" ;
				}
				document.getElementById("d").innerHTML = out;
			}

			function matchPlace(list, cFloor){
				var tmp = [];
				var i;
				var j;
				for(i = 0;i<list.length;i++){
					var text = list[i].place;
					for(j = 0;j<cFloor.gallery.length;j++){
						var g = "Gallery";
						var t = cFloor.gallery[j];
						var r = new RegExp(t,"i");

						if(r.exec(text) == undefined){
							var rg = new RegExp(g,"i");
							if(rg.exec(t) != undefined){
								t = t.replace(rg,"");
								t = "Galleries[ 0-9,a-z]*" + t;
								r = new RegExp(t, "i");
								if(r.exec(text) != undefined){
									var gModel;
									var k;
									var c;
									var cent;
									var m;
									var exist = false;
									if(cFloor.level == "3"){
										gModel = galModel3;
									}else if(cFloor.level == "4"){
										gModel = galModel4;
									}
									r = new RegExp(cFloor.gallery[j],"i");
									for(k=0;k<gModel.length;k++){
										if(r.exec(gModel[k].name) != undefined){
											c = gModel[k].coord;
											cent = gModel[k].center;
										}
									}
									for(m=0;m<tmp.length;m++){
										if(cFloor.gallery[j] == tmp[m].name){
											exist = true;
											break;
										}
									}
									if(exist){
										tmp[m].exhib.push(list[i]);
									}else{
										tmp.push(new poly(cFloor.gallery[j],[list[i]],c,cent,""));
									}
								}
							}
						}else{
							var gModel;
							var k;
							var c;
							var cent;
							var m;
							var exist = false;
							if(cFloor.level == "3"){
								gModel = galModel3;
							}else if(cFloor.level == "4"){
								gModel = galModel4;
							}
							for(k=0;k<gModel.length;k++){
								if(r.exec(gModel[k].name) != undefined){
									c = gModel[k].coord;
									cent = gModel[k].center;
								}
							}
							for(m=0;m<tmp.length;m++){
								if(cFloor.gallery[j] == tmp[m].name){
									exist = true;
									break;
								}
							}
							if(exist){
								tmp[m].exhib.push(list[i]);
							}else{
								tmp.push(new poly(cFloor.gallery[j],[list[i]],c,cent,""));
							}
						}
					}
				}
				return tmp;
			}

			function drawPolyLayer(_map, list){
				_map.map.removeLayer(_map.polyLayer);
				_map.polyList = [];
				var i;
				for(i=0;i<list.length;i++){
					_map.polyList.push(L.polygon(list[i].coord));
				}
				_map.polyLayer = L.layerGroup(_map.polyList);
				_map.map.addLayer(_map.polyLayer);
			}

			function drawMarkerLayer(_map, list){
				_map.map.removeLayer(_map.markerLayer);
				_map.markerList = [];
				var i;
				for(i=0;i<list.length;i++){
					var tmp = "[+] " +list[i].exhib[0].name;
					var j;
					for(j=1;j<list[i].exhib.length;j++){
						tmp = tmp + "<br/>[+] " + list[i].exhib[j].name;
					}
					console.log(tmp);
					_map.markerList.push(L.circleMarker(list[i].center, {
												radius : 100.0,
												opacity : 0,
												fillOpacity : 0
											}).bindTooltip( tmp, {
												permanent : true,
												direction : 'right'
											}));
				}
				_map.markerLayer = L.layerGroup(_map.markerList);
				_map.map.addLayer(_map.markerLayer);
			}

			function drawInteractiveLayer(_map, list){
				_map.map.removeLayer(_map.interactiveLayer);
				_map.interactiveList = [];
				var i;
				for(i=0;i<list.length;i++){
					_map.interactiveList.push(L.polygon(list[i].coord, {fillOpacity: 0.05, opacity: 0.1}).on({click: toNextFloor}));
				}
				_map.interactiveLayer = L.layerGroup(_map.interactiveList);
				_map.map.addLayer(_map.interactiveLayer);
			}

			function toNextFloor(){
				if(currFloor.level == "3"){
					currFloor = museumModel.floor[1];
					mapConfig.bounds = [[0,0], [currFloor.imageHeight,currFloor.imageWidth]];
					mapConfig.map.setMaxBounds(mapConfig.bounds).setView([0.0,0.0],0);
					mapConfig.map.removeLayer(mapConfig.floorLayer);
					mapConfig.floorLayer = L.imageOverlay(currFloor.image,mapConfig.bounds).addTo(mapConfig.map);
					mapConfig.map.fitBounds(mapConfig.bounds);
					drawInteractiveLayer(mapConfig,intModel4);
				}else{
					currFloor = museumModel.floor[0];
					mapConfig.bounds = [[0,0], [currFloor.imageHeight,currFloor.imageWidth]];
					mapConfig.map.setMaxBounds(mapConfig.bounds).setView([0.0,0.0],0);
					mapConfig.map.removeLayer(mapConfig.floorLayer);
					mapConfig.floorLayer = L.imageOverlay(currFloor.image,mapConfig.bounds).addTo(mapConfig.map);
					mapConfig.map.fitBounds(mapConfig.bounds);
					drawInteractiveLayer(mapConfig,intModel3);
				}

				document.getElementById("currDate").innerHTML = selDate.toString();
				exhibList = matchDate(sched,selDate,selDate);
				disp(exhibList);
				polyList = matchPlace(exhibList,currFloor)
				console.log(polyList);
				drawPolyLayer(mapConfig,polyList);
				drawMarkerLayer(mapConfig,polyList);
				setupFullCalendar(fullCalendarConfig, sched);
			}

			function museumModelImageaddress(_museumModel){
				var i;
				for(i=0;i<_museumModel.floor.length;i++){
					_museumModel.floor[i].image = '<?php echo base_url()."resources/data/"?>'.concat(_museumModel.floor[i].image);
					console.log(_museumModel.floor[i].image);
				}
				return _museumModel;
			}

			var currDate = normalizeDate(new Date());
			var selDate = currDate;
			var exhibList = [];
			var galModel3;
			var galModel4;
			var intModel3;
			var intModel4;
			var museumModel;
			var sched;
			var url;
			var xmlhttp;
			var currFloor;
			var polyList = [];

			//
			// <!-- Retrieving Gallery Model 3th JSON -->
			// xmlhttp = new XMLHttpRequest();
			// url = "<?php echo base_url(); ?>resources/misc/gallery_model_3th.json";
			// xmlhttp.onreadystatechange = function(){
			// 	if(this.readyState == 4 && this.status == 200){
			// 		galModel3 = JSON.parse(this.responseText);
			// 	}
			// };
			// xmlhttp.open("GET", url, true);
			// xmlhttp.send();
			//
			// <!-- Retrieving Gallery Model 4th JSON -->
			// xmlhttp = new XMLHttpRequest();
			// url = "<?php echo base_url(); ?>resources/misc/gallery_model_4th.json";
			// xmlhttp.onreadystatechange = function(){
			// 	if(this.readyState == 4 && this.status == 200){
			// 		galModel4 = JSON.parse(this.responseText);
			// 	}
			// };
			// xmlhttp.open("GET", url, true);
			// xmlhttp.send();
			//
			// <!-- Retrieving Interactive Model 3th JSON -->
			// xmlhttp = new XMLHttpRequest();
			// url = "<?php echo base_url(); ?>resources/misc/interactive_model_3th.json";
			// xmlhttp.onreadystatechange = function(){
			// 	if(this.readyState == 4 && this.status == 200){
			// 		intModel3 = JSON.parse(this.responseText);
			// 	}
			// };
			// xmlhttp.open("GET", url, true);
			// xmlhttp.send();
			//
			// <!-- Retrieving Interactive Model 4th JSON -->
			// xmlhttp = new XMLHttpRequest();
			// url = "<?php echo base_url(); ?>resources/misc/interactive_model_4th.json";
			// xmlhttp.onreadystatechange = function(){
			// 	if(this.readyState == 4 && this.status == 200){
			// 		intModel4 = JSON.parse(this.responseText);
			// 	}
			// };
			// xmlhttp.open("GET", url, true);
			// xmlhttp.send();
			//
			// <!-- Retrieving Museum Model JSON -->
			// xmlhttp = new XMLHttpRequest();
			// url = "<?php echo base_url(); ?>resources/misc/museum_model.json";
			// xmlhttp.onreadystatechange = function(){
			// 	if(this.readyState == 4 && this.status == 200){
			// 		museumModel = JSON.parse(this.responseText);
			// 		console.log(museumModel.floor[0].image);
			// 		console.log(url);
			// 		museumModel = museumModelImageaddress(museumModel);
			// 		currFloor = museumModel.floor[0];
			// 		while(intModel3 == undefined){};
			// 		setupMap(mapConfig, [currFloor.imageHeight,currFloor.imageWidth], currFloor.image);
			// 		drawInteractiveLayer(mapConfig,intModel3);
			// 	}
			// };
			// xmlhttp.open("GET", url, true);
			// xmlhttp.send();
			//
			// <!-- Retrieving Schedule JSON -->
			// xmlhttp = new XMLHttpRequest();
			// url = "<?php echo base_url(); ?>resources/misc/exhibition_schedule.json";
			// xmlhttp.onreadystatechange = function(){
			// 	if(this.readyState == 4 && this.status == 200){
			// 		sched = JSON.parse(this.responseText);
			// 		convertDateSched(sched);
			//
			// 		while(	(galModel3 == undefined) ||
			// 				(galModel4 == undefined) ||
			// 				(intModel3 == undefined) ||
			// 				(intModel4 == undefined) ||
			// 				(museumModel == undefined)
			// 		){}
			// 	document.getElementById("currDate").innerHTML = selDate.toString();
			// 	exhibList = matchDate(sched,selDate,selDate);
			// 	disp(exhibList);
			// 	polyList = matchPlace(exhibList,currFloor);
			// 	console.log(polyList);
			// 	drawPolyLayer(mapConfig,polyList);
			// 	drawMarkerLayer(mapConfig,polyList);
			// 	setupFullCalendar(fullCalendarConfig, sched);
			//
			// 	}
			// };
			// xmlhttp.open("GET", url, true);
			// xmlhttp.send();

			<!-- Calendar -->
			function setupCalendars() {
				Calendar.setup({dateField: 'embeddedDateField',
								parentElement: 'embeddedCalendar',
								selectHandler: customSelectHandler});
			}
			Event.observe(window,'load',function(){setupCalendars()});

			<!-- Leaflet -->
			function mapConfigObj(){
				this.map = {};
				this.bounds = [[0,0], [0,0]];
				this.floorLayer = {};
				this.polyLayer = L.layerGroup();
				this.polyList = [];
				this.markerLayer = L.layerGroup();
				this.markerList = [];
				this.interactiveLayer = L.layerGroup();
				this.interactiveList = [];
			}

			var mapConfig = new mapConfigObj();

			function setupMap(_map, _bounds, _url){
				_map.bounds = [[0,0], _bounds];
				_map.map =  L.map('map', {	crs: L.CRS.Simple,
											maxZoom: 3,
											maxBounds: _map.bounds}).setView([0.0,0.0],0);
				_map.floorLayer = L.imageOverlay(_url, _map.bounds).addTo(_map.map);
				_map.map.fitBounds(_map.bounds);

/*
var popup = L.popup();

function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent("You clicked the map at " + e.latlng.toString())
        .openOn(_map.map);
}

_map.map.on('click', onMapClick);
*/
			}

			function matchExhib(sched, start = new Date(0),
												end = normalizeDate(new Date()).setFullYear(normalizeDate(new Date()).getFullYear() + 100)){
				var tmp = matchDate(sched, start, end);
				tmp = matchPlace(tmp, currFloor);
				return tmp;
			}

			function newGroups(exhibList){
				var groups = new vis.DataSet();
				for(var i = 0; i<exhibList.length;i++){
					groups.add({id: i, content: exhibList[i].name});
				}
				return groups;
			}

			function newItems(exhibList){
				var items = new vis.DataSet();
				var k = 0;
				for(var i = 0; i<exhibList.length;i++){
					for(var j = 0; j < exhibList[i].exhib.length; j++){
						items.add({	id: k,
												group: i,
												content: exhibList[i].exhib[j].name,
												start: exhibList[i].exhib[j].from,
												end: exhibList[i].exhib[j].to
												// type: 'box'
												});
						k++;
					}
				}
				return items;
			}

			<!-- vis -->
			function fullCalendarConfigObj(elementID){
				this.calendarContainer = document.getElementById(elementID);
				this.calendarList = {};
				this.calendarGroups = {};
				this.calendarItems = {};
				this.options = {};
				this.timeline = new vis.Timeline(this.calendarContainer);
			}

			var fullCalendarConfig = new fullCalendarConfigObj('fullCalendar');

			function setupFullCalendar(_calendar, sched){
				// _calendar.calendarContainer = {};
				// _calendar.calendarList = {};
				// _calendar.calendarGroups = {};
				// _calendar.calendarItems = {};
				// _calendar.options = {};
				_calendar.timeline.destroy();
				// DOM element where the Timeline will be attached
				// _calendar.calendarContainer = document.getElementById('fullCalendar');

				// Create a DataSet (allows two way data-binding)
				// var calendarItems = new vis.DataSet([
				// 	{id: 1, content: 'item 1', start: '2013-04-20'},
				// 	{id: 2, content: 'item 2', start: '2013-04-14'},
				// 	{id: 3, content: 'item 3', start: '2013-04-18'},
				// 	{id: 4, content: 'item 4', start: '2013-04-16', end: '2013-04-19'},
				// 	{id: 5, content: 'item 5', start: '2013-04-25'},
				// 	{id: 6, content: 'item 6', start: '2013-04-27'}
				// ]);

				_calendar.fullCalendarList = matchExhib(sched);
				console.log(_calendar.fullCalendarList);
				_calendar.Groups = newGroups(_calendar.fullCalendarList);
				_calendar.Items = newItems(_calendar.fullCalendarList);

				// Configuration for the Timeline
				_calendar.options = {
					groupOrder: 'content'
				};

				// Create a Timeline
				_calendar.timeline = new vis.Timeline(_calendar.calendarContainer);
				_calendar.timeline.setOptions( _calendar.options);
				_calendar.timeline.setData({	groups: _calendar.Groups,
																			items: _calendar.Items});
			}
		</script>
	</body>
</html>
