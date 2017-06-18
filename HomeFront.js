// Frontpage.js

//Note: changing the colors on the nodes to reflect only PM2.5, CO, and O3 with the data Derek emailed
//the numbers are in counts, and ppm (which is what we'll be using once things are calibrated)

var serverURL = "http://clairity.mit.edu/latest/all/";

var sensors = [];
var new_sensor;
var nodesDrawn = false;
var firstUpdate = false;

var update_int = 11000; //milliseconds, 11 seconds;

var mapBig = true;

var alpha1_thresholds = [0, 4500, 9500]; //CO
var alpha2_thresholds = [100000, 500000, 900000, 1300000, 1500000]; //NO
var alpha3_thresholds = [100000, 500000, 900000, 1300000, 1500000]; //NO2
var alpha4_thresholds = [0, 2000, 3000]; //O3
var pm25_thresholds = [0, 600, 2100];
var pm10_thresholds = [10000, 50000, 90000, 130000, 150000];
var alpha_thresholds = [alpha1_thresholds, alpha2_thresholds, alpha3_thresholds, alpha4_thresholds, pm25_thresholds, pm10_thresholds];

var drawNodes;

function sensor(lat,lon,location,id,in_out,offline) {
	this.node_id = id;
	this.lat = lat;
	this.lon = lon;
	this.location = location;
	this.indoor = in_out;
	this.alpha1 = null;
	this.alpha2 = null;
	this.alpha3 = null;
	this.alpha4 = null;
	this.color = [0,0,0,0,0,0,0]; 
	//Overall color, alpha1 color, alpha2 color, alpha3 color, alpha4 color, pm2.5 color, pm10 color
	// 0 = green, 1 = yellow, 2 = red
	this.pm25 = null;
	this.pm10 = null;
	this.functioning = true;
	this.alphaFunctioning = true;
	this.dylosFunctioning = true;
	this.alpha1Functioning = true;
	this.alpha2Functioning = true;
	this.alpha3Functioning = true;
	this.alpha4Functioning = true;
	this.offline = offline;
}

function RequestNodes(sidebarNode) {
	$.getJSON(serverURL, function (data) {
		if(!nodesDrawn){
			for(i=0; i<data.length; i++){
				new_sensor = new sensor(data[i]["latitude"],data[i]["longitude"],data[i]["name"],data[i]["node_id"],data[i]["indoor"],data[i]["offline"]);
	    		sensors.push(new_sensor);
				if(sensors[i].offline){
					sensors[i].alphaFunctioning = false;
					sensors[i].dylosFunctioning = false;
					console.log(sensors[i].location+" "+sensors[i].offline);
				}
			}
			drawNodes();
			nodesDrawn=true;
			console.log(sensors[3].location+" "+sensors[3].alphaFunctioning);
		}
		if(nodesDrawn){
			for(i=0; i<sensors.length; i++){
				sensors[i].color = [0,0,0,0,0,0,0];
				for(j=1; j<7; j++){
					addAlphasenseData(i,j,data);
				}
				sensors[i].temp = data[i]["temperature"];
				sensors[i].rh = data[i]["rh"];
				var tempDate = data[i]["last_modified"].split(/[\s*\-\s*,":"]/,5); 
				sensors[i].lastUpdated = tempDate[1]+"/"+tempDate[2]+"/"+tempDate[0]+" "+tempDate[3]+":"+tempDate[4];
				if(!sensors[i].alpha1Functioning && !sensors[i].alpha2Functioning && !sensors[i].alpha3Functioning && !sensors[i].alpha4Functioning){
					sensors[i].alphaFunctioning = false;
				}
				if(!sensors[i].alphaFunctioning && !sensors[i].dylosFunctioning){
					sensors[i].functioning = false;
				}
				setColor(i);
			}
			displaySidebar(sidebarNode);
			if(firstUpdate){
				sensors[sidebarNode].circ.setStyle({fillOpacity: "1"}); 
				firstUpdate = false; 
			}
		}
	});
}

function addAlphasenseData(i,j,data){
	if(j==1){
		var toAdd = data[i]["co"];
		sensors[i].alpha1 = toAdd;
		if(toAdd < 1 && toAdd > -1 || toAdd > 5000 || toAdd < -500){
			sensors[i].alpha1Functioning = false;
		}
		findColor(i,1,toAdd);	
	}
	else if(j==2){
		 var toAdd = data[i]["no"];
		 sensors[i].alpha2 = toAdd;
		 if(toAdd < 1 && toAdd > -1 || toAdd > 1000 || toAdd < -500){
			sensors[i].alpha2Functioning = false;
		}
			findColor(i,2,toAdd);
	}
	else if(j==3){
		var toAdd = data[i]["no2"];
		sensors[i].alpha3 = toAdd;
		if(toAdd < 1 && toAdd > -1 || toAdd > 5000 || toAdd < -500){
			sensors[i].alpha3Functioning = false;
		}
		findColor(i,3,toAdd);
	}
	else if(j==4){
		var toAdd = data[i]["o3"];
		sensors[i].alpha4 = toAdd;
		if(toAdd < 1 && toAdd > -1 || toAdd > 5000 || toAdd < -500){
			sensors[i].alpha4Functioning = false;
		}
		findColor(i,4,toAdd);
	}
	else if(j==5){
			var toAdd = data[i]["small_particles"];
			sensors[i].pm25 = toAdd;
			findColor(i,5,toAdd);
			if(toAdd < 1 ){
				sensors[i].dylosFunctioning = false;
			}
	}
	else{
		if(data[i]["big_particles"]){
			var toAdd = data[i]["big_particles"];
			sensors[i].pm10 = toAdd;
		}
	}
}

function findColor(i, j, value) {
	if(value > alpha_thresholds[j-1][2]){ 
		sensors[i].color[j] = 2; 
	}
	else if(value > alpha_thresholds[j-1][1]){ 
		sensors[i].color[j] = 1; 
	}
}

function setColor(i){
	var circColor = null;
	if(sensors[i].lat){
		if(sensors[i].dylosFunctioning && sensors[i].alphaFunctioning){
			index = [1,4,5];
			for(k=1;k<4;k++){
				z = index[k-1];
				if(sensors[i].color[z]>sensors[i].color[0]){
					sensors[i].color[0]=sensors[i].color[z];
				}
			}
			if(sensors[i].color[0] == 0){ circColor = "green"; }
			else if(sensors[i].color[0] == 1){ circColor = "yellow"; }
			else{ circColor = "red"; }
		}
		else{
			circColor = "grey";
		}
		sensors[i].circ.setStyle({color: circColor, fillColor: circColor});
	}
}

function displaySidebar(i){
	$("#locationheader").html(String(sensors[i].location));
	if(!sensors[i].alphaFunctioning){
		var alpha_color = "grey";
		co_color = "grey";
		$(".alpha1").html("--");
		$(".alpha2").html("--");
		$(".alpha3").html("--");
		$(".alpha4").html("--");
	}
	else{
		alpha_color = "white";
		$(".alpha1").html(String(Math.round(sensors[i].alpha1)));
		$(".alpha2").html(String(Math.round(sensors[i].alpha2)));
		$(".alpha3").html(String(Math.round(sensors[i].alpha3)));
		$(".alpha4").html(String(Math.round(sensors[i].alpha4)));
		if(sensors[i].color[1]==1){
			co_color = "yellow";
		}
		else if(sensors[i].color[1]==2){
			co_color = "red";
		}
		else{
			co_color = "green";
		}
	}
	doc = document.getElementById("no2a").style.color=alpha_color;
	doc = document.getElementById("no2b").style.color=alpha_color;

	doc = document.getElementById("o3a").style.color="grey";
	doc = document.getElementById("o3b").style.color="grey";

	doc = document.getElementById("coa").style.color=co_color;
	doc = document.getElementById("cob").style.color=co_color;

	doc = document.getElementById("noa").style.color=alpha_color;
	doc = document.getElementById("nob").style.color=alpha_color;
		
	if(!sensors[i].dylosFunctioning){
		doc = document.getElementById("dylos1").style.color="grey";
		doc = document.getElementById("dylos2").style.color="grey";
		doc = document.getElementById("dylosa").style.color="grey";
		doc = document.getElementById("dylosb").style.color="grey";
		$(".pm25").html("--");
		$(".pm10").html("--");
	}
	else{
		if(sensors[i].color[5]==1){
			doc = document.getElementById("dylos1").style.color="yellow";
			doc = document.getElementById("dylosa").style.color="yellow";
		}
		else if(sensors[i].color[5]==2){
			doc = document.getElementById("dylos1").style.color="red";
			doc = document.getElementById("dylosa").style.color="red";
		}
		else{
			doc = document.getElementById("dylos1").style.color="green";
			doc = document.getElementById("dylosa").style.color="green";
		}


		doc = document.getElementById("dylos2").style.color="white";
		doc = document.getElementById("dylosb").style.color="white";
		$(".pm25").html(String(Math.round(sensors[i].pm25)));
		$(".pm10").html(String(Math.round(sensors[i].pm10)));
	}
	$("#lastupdated").html("Last Updated: "+sensors[i].lastUpdated + " UTC");
};


$(document).ready(function(){
    //Leaflet Map 
	var googleLayer = new L.Google('ROADMAP',mapStylesArray);

	var sWBound = L.latLng(42.336976,-71.153984);
	var nEBound = L.latLng(42.381880,-71.052017);
	var map = new L.Map('map', {center: [42.3590000, -71.095500], zoom: 16, minZoom: 14, maxBounds:[sWBound,nEBound], zoomControl: false, attributionControl: false, layers: [googleLayer] });

	map.addLayer(googleLayer);
	var zoomBar = L.control.zoom({ position: 'topright' }).addTo(map);
	var attribution = L.control.attribution({position: 'topright'}).addTo(map);

	map.doubleClickZoom.disable();
	map.scrollWheelZoom.disable();

	var sidebarNode = 14;

	drawNodes = function(){
	for(var i=0; i<sensors.length; i++){
		if(sensors[i].lat){
			var delt_lat = 0.00015;
			var delt_lon = 0.00028;
			if(sensors[i].indoor){
				sensors[i].circ = L.polygon([[sensors[i].lat+delt_lat,sensors[i].lon],[sensors[i].lat-delt_lat,sensors[i].lon+delt_lon],[sensors[i].lat-delt_lat,sensors[i].lon-delt_lon]],{
	    			color: 'red',
	    			fillColor: "#f03",
	    			fillOpacity: 0.5
				}).addTo(map);
				sensors[i].circ.bindPopup(sensors[i].location, {closeButton: false,'offset': L.point(-12,-15)});
			}
			else{
				sensors[i].circ = L.circle([sensors[i].lat,sensors[i].lon], 16, {
	    			color: 'red',
	    			fillColor: "#f03",
	    			fillOpacity: 0.5
				}).addTo(map);
				sensors[i].circ.bindPopup(sensors[i].location, {closeButton: false,'offset': L.point(0,-5)});
			}

			sensors[i].circ.number = i;

			sensors[i].circ.on('mouseover', function(evt) {
				evt.target.openPopup();
			});
			sensors[i].circ.on('mouseout', function(evt){
				evt.target.closePopup();
			});

			sensors[i].circ.on('click', function(evt){
				displaySidebar(this.number);
				sidebarNode = this.number;
				for(var i=0; i<sensors.length; i++){
					if(sensors[i].lat){
					sensors[i].circ.setStyle({fillOpacity: "0.5"});
					}
				}
				this.setStyle({fillOpacity: "1"});
			});

		};
	};
}

	RequestNodes(sidebarNode);
	var reset = setInterval(function() {RequestNodes(sidebarNode)}, update_int);
   
});