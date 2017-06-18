<?php
include("db.php");
include("new.php");
?>
<html>
  <head>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>  -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!--<link href="cssForHome.css" rel="stylesheet">-->
  <!--Leaflet Links-->
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script><!--
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-1.0.3/leaflet.css" />
	<script src="http://cdn.leafletjs.com/leaflet-1.0.3/leaflet.js"></script> -->
    <style>
      #map {
        height:650px;
        width: 100%;
       }
	  #legend {
        font-family: Arial, sans-serif;
         background: #fff;
        padding: 10px;
        margin: 10px;
        border: 3px solid #000;
      }
      #legend h3 {
        margin-top: 0;
      }
      #legend img {
        vertical-align: middle;
      }
	  #valuesTable{
	background-color: #6699FF;
	background: rgba(0, 0, 0, 0.7);
	position: fixed;
	left: 1%;
	top: 50px;
	height: 100%;
	width: 23%;
	color: white;
	z-index: 1;
	overflow: auto;
}

#lastupdated{
	position: relative;
	left: 10px;
	font-size: 10px;
}

#locationheader{
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-style: bold;
	font-size: 25px;
	position: relative;
}
.values{
	font-size: 22px;
}
table{
	border-collapse:separate;
	border-spacing:0px 0px;
	font-style: bold;
}


table.table#temprh > tbody > tr > td {
	border: 0;
}
#temprh {
	padding-top: 10px;
	font-size: 12px;
}
.table>tbody>tr>td.pollutantName {
	border-top: 0px;

}

.table-condensed>tbody>tr>td {
	padding: 0.5px;
}

.table-condensed>tbody>tr>td.pollutantFull {
	padding-bottom: 5px;
	font-size: 10px;
}

.pollutantValue {
	text-align: right;
}
    </style>
	
	 <?php
            $sql = "UPDATE gases SET CO=RAND()*100,NO=RAND()*100,NO2=RAND()*100,O3=RAND()*100,FineParticles=RAND()*100,CourseParticles=RAND()*100 WHERE id=1";
			//if($con->query($sql) === FALSE)
				//echo "Error updating record: " . $con->error;
			 if ($con->query($sql) === TRUE) {
              //echo "Record updated successfully";
			  toXML();
            }
			$sql= "UPDATE gases SET CO=RAND()*100,NO=RAND()*100,NO2=RAND()*100,O3=RAND()*100,FineParticles=RAND()*100,CourseParticles=RAND()*100 WHERE id=2";
			//if($con->query($sql) === FALSE)
				//echo "Error updating record: " . $con->error;
			 if ($con->query($sql) === TRUE) {
              //echo "Record updated successfully";
			  toXML();
            }
			$sql= "UPDATE gases SET CO=RAND()*100,NO=RAND()*100,NO2=RAND()*100,O3=RAND()*100,FineParticles=RAND()*100,CourseParticles=RAND()*100 WHERE id=3";
			 if ($con->query($sql) === TRUE) {
              //echo "Record updated successfully";
			  toXML();
            }
			$sql= "UPDATE gases SET CO=RAND()*100,NO=RAND()*100,NO2=RAND()*100,O3=RAND()*100,FineParticles=RAND()*100,CourseParticles=RAND()*100 WHERE id=4";
			 if ($con->query($sql) === TRUE) {
              //echo "Record updated successfully";
			  toXML();
            }
			$sql= "UPDATE gases SET CO=RAND()*100,NO=RAND()*100,NO2=RAND()*100,O3=RAND()*100,FineParticles=RAND()*100,CourseParticles=RAND()*100 WHERE id=5";

            if ($con->query($sql) === TRUE) {
              //echo "Record updated successfully";
			  toXML();
            } else {
            echo "Error updating record: " . $con->error;
            }
      ?>			
		
  </head>
  <body>
  
  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
 <div class="container">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	  <span class="sr-only">Toggle navigation</span>
	  <span class="icon-bar"></span>
	  </button>
	 </div>
  <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
      <li><a href="home.html" class="image_navbar"></a></li>
<li><a href="#"><font size=5" color="yellow"><b> Air Pollution Monitoring System</b></font></a></li>
      <li class="active"><a href="#">Home</a></li>
     <!-- <li><a href="team.html">The Team</a></li>
	  <li><a href="export.html">Data</a></li>    
      <li><a href="project.html">The Project</a></li>  -->
<li><a href="HowItWorks2.html" rel="m_PageScroll2id">How It Works</a></li>
	  </ul>
	<!--  <ul class="nav navbar-nav navbar-right visible-lg">
	  <li>
	      <a href="http://iitism.ac.in/index.php/home/"><div id="IIT(ISM)-logo-small" class ="visible-lg"></a>
                       <!-- <a style="width:5px; height:5px;"href="http://iitism.ac.in/index.php/home/"><img src="C:\Users\Abhishek Upadhyay\Desktop\bootstrap\ismlogo.png" id="ismlogo"/></a>
                 
         <!--   <div id="divider-large-reversed"></div>
            <a href="http://csesociety.in/"><div id="CSES-logo-web-large"></div></a>  
          </div>
        </li>
      </ul>      -->
    </div>
  </div>
  </div>
 <!-- <iframe src="index.php"></iframe>-->
  <!--  <h3>My Google Maps Demo</h3>  -->
    <div id="map"></div>
	<div id="legend"><h3>Legend</h3></div>
    <script>
	/*var customLabel = {
        NLHC: {
          label: 'A'
        },
        OAT: {
          label: 'B'
        },
		 CSEDEPT: {
          label: 'C'
        },
		 Director: {
          label: 'D'
        },
		 Library: {
          label: 'E'
        }
      };*/
	  var iconBase = 'https://maps.google.com/mapfiles/kml/pushpin/';
	  var icons={
	     a:{
		   icon:iconBase+'red-pushpin.png',
		   name:'Unhealthy'
		 },
         b:{
		   icon:iconBase+'ylw-pushpin.png',
		   name:'Moderate'
		 },
		  c:{
		   icon:iconBase+'grn-pushpin.png',
		   name:'Good'
		 }
	  };
  
		function initMap() {
		var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(23.8144,86.4412),
		  zoom: 17,
          mapTypeId: 'roadmap'
        });
        var infoWindow = new google.maps.InfoWindow;
         document.getElementById('locationheader').innerHTML ='Location';
				document.getElementById('cob').innerHTML ='Blank';
				document.getElementById('nob').innerHTML ='Blank';
				document.getElementById('no2b').innerHTML ='Blank';
				document.getElementById('o3b').innerHTML ='Blank';
				document.getElementById('Fineb').innerHTML ='Blank';
				document.getElementById('Courseb').innerHTML ='Blank';
          // Change this depending on the name of your PHP or XML file
          downloadUrl('myxml.xml?id='+Math.random(), function(data) {
            var xml = data.responseXML;
            var gases= xml.getElementsByTagName('gas');
			var i=0;
            Array.prototype.forEach.call(gases, function(gasElem) {
              var CO =parseInt(gases[i].getElementsByTagName("CO")[0].childNodes[0].nodeValue);
			 // console.log(CO);
              var NO = parseInt(gases[i].getElementsByTagName("NO")[0].childNodes[0].nodeValue);
			  var NO2= parseInt(gases[i].getElementsByTagName("NO2")[0].childNodes[0].nodeValue);
			  var O3= parseInt(gases[i].getElementsByTagName("O3")[0].childNodes[0].nodeValue);
			  var Fine= parseInt(gases[i].getElementsByTagName("FineParticles")[0].childNodes[0].nodeValue);
			  var Course= parseInt(gases[i].getElementsByTagName("CourseParticles")[0].childNodes[0].nodeValue);
              var type = gases[i].getElementsByTagName("type")[0].childNodes[0].nodeValue;
              var point = new google.maps.LatLng(
                  parseFloat(gases[i].getElementsByTagName("lat")[0].childNodes[0].nodeValue),
                  parseFloat(gases[i].getElementsByTagName("lng")[0].childNodes[0].nodeValue));
				  
			  var avg=(CO+NO+NO2+O3+Fine+Course)/6;
			  console.log(avg);
			  if(avg>50) console.log("Hi");
              i++;
              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = type
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = 'CO:'+CO
              infowincontent.appendChild(text);
			  infowincontent.appendChild(document.createElement('br'));
			  
			  var text = document.createElement('text');
              text.textContent ='NO:'+NO
              infowincontent.appendChild(text);
			  infowincontent.appendChild(document.createElement('br'));
			  
			   var text = document.createElement('text');
              text.textContent ='NO2:'+NO2
              infowincontent.appendChild(text);
			  infowincontent.appendChild(document.createElement('br'));
			  
			  var x;
			  if(avg>=66) x='a';
			  else if(avg>=33&&avg<66) x='b';
			  else x='c';
              
			  //var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
				//label: icon.label
				icon: icons[x].icon
              });
			  
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
				document.getElementById('locationheader').innerHTML =type;
				document.getElementById('cob').innerHTML =CO;
				document.getElementById('nob').innerHTML =NO;
				document.getElementById('no2b').innerHTML =NO2;
				document.getElementById('o3b').innerHTML =O3;
				document.getElementById('Fineb').innerHTML =Fine;
				document.getElementById('Courseb').innerHTML =Course;
              });
            });
          });
        var legend = document.getElementById('legend');
        for (var key in icons) {
          var type = icons[key];
          var name = type.name;
		  console.log(name);
          var icon = type.icon;
          var div = document.createElement('div');
          div.innerHTML = '<img src="' + icon + '"> ' + name;
          legend.appendChild(div);
        }

        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);
        }

        function openIW(layerEvt) {
  if (layerEvt.row) {
    var content = layerEvt.row['admin'].value;
  } else if (layerEvt.featureData) {
    var content = layerEvt.featureData.name;
  }
  document.getElementById('locationheader').innerHTML =content;
  document.getElementById('cob').innerHTML =content;
  document.getElementById('nob').innerHTML =content;
  document.getElementById('no2b').innerHTML =content;
  document.getElementById('o3b').innerHTML =O3;
				document.getElementById('Fineb').innerHTML =content;
				document.getElementById('Courseb').innerHTML =content;
}

      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
	  
	

    </script>
	
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6wAa9OYZjUFgisXP6vIez963OflUcq2Q&callback=initMap">
    </script>

	<!-- MAP SECTION -->
<!--<div id="map"> -->
	<div>

		<div class="col-md-3" id="valuesTable">

		<div class="col-md-3" id="valuesTable" style="padding-top: 24px;">

			<div id="locationheader"></div>
			<!--<div id="lastupdated">Last Updated</div>-->

			<table class="table table-condensed" id="pollutants" style="padding-top: 20px">
			<tr>
				<td id="coa" class="pollutantName values" style="color:white";>CO</td>
				<td id="cob" class="alpha1 pollutantName pollutantValue values" style="color:white";></td>
			</tr>	
			<tr>
				<td class="pollutantFull" style="color:white";>Carbon Monoxide</td>
				<td class="unitlabel" style="color:white";>ppb</td>
			</tr>
			<tr>
				<td id="noa" class="pollutantName values" style="color:white";>NO</td>
				<td id="nob" class="alpha2 pollutantName pollutantValue values" style="color:white";></td>
			</tr>
			<tr>
				<td class="pollutantFull" style="color:white";>Nitric Oxide</td>
				<td class="unitlabel" style="color:white";>ppb</td>
			</tr>
			<tr>
				<td id="no2a" class="pollutantName values" style="color:white";>NO<sub>2</sub></td>
				<td id="no2b" class="alpha3 pollutantName pollutantValue values" style="color:white";></td>
			</tr>
			<tr>
				<td class="pollutantFull" style="color:white";>Nitrogen Dioxide</td>
				<td class="unitlabel" style="color:white";>ppb</td>
			</tr>
			<tr>
				<td id="o3a" class="pollutantName values" style="color:white";>O3</td>
				<td id="o3b" class="alpha1 pollutantName pollutantValue values" style="color:white";></td>
			</tr>	
			<tr>
				<td class="pollutantFull" style="color:white";>O3</td>
				<td class="unitlabel" style="color:white";>ppb</td>
			</tr>
			<tr>
				<td id="Finea" class="pollutantName values" style="color:white";>Fine Particles</td>
				<td id="Fineb" class="alpha1 pollutantName pollutantValue values" style="color:white";></td>
			</tr>	
			<tr>
				<td class="pollutantFull" style="color:white";>Fine Particles</td>
				<td class="unitlabel" style="color:white";>ppb</td>
			</tr>
			<tr>
				<td id="Coursea" class="pollutantName values" style="color:white";>Course Particles</td>
				<td id="Courseb" class="alpha1 pollutantName pollutantValue values" style="color:white";></td>
			</tr>	
			<tr>
				<td class="pollutantFull" style="color:white";>Course Particles</td>
				<td class="unitlabel" style="color:white";>ppb</td>
			</tr>
			</table>
			<div>
				<p style="font-size: 15px; margin-top: 30px">Click on a location to display air quality data</p>
				<p style="font-size: 12px; margin-bottom: 55px">Note: Values shown are 10 second averages, and therefore may be influenced by small fluctuations and noise</p>
			</div>
			</div>
		<!--	</div>   -->
			<script src="HomeFront.js"></script>
  </body>
</html>