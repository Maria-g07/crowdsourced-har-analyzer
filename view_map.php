<html>

<head>

<link rel="stylesheet" href="mystyle.css">


<link rel = "stylesheet" href = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css"/>
<script src = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/heatmapjs@2.0.2/heatmap.js"> </script>
<script src="leaflet-heatmap.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



<script type="text/javascript">


$(document).ready(function(){
	
	
	        var mapOptions = {
            center: [38.246242, 21.735085],
            zoom: 10
         }
		 
		 
		 let cfg = {"radius": 40,
			"maxOpacity": 2,
			"scaleRadius": false,
			"useLocalExtrema": false,
			latField: 'lat',
			lngField: 'lng',
			valueField: 'count'};	
	
		 let heatmapLayer = new HeatmapOverlay(cfg);

		 
         // Creating a map object
         var map = new L.map('map', mapOptions);
         
         // Creating a Layer object
         var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
         
         // Adding layer to the map
         map.addLayer(layer);
         
		 map.addLayer(heatmapLayer);
	

	
	
$( document ).ready(function() {
    
	  $.ajax({
                url:'find_records_by_ip.php',
			
               type:'post',

                
                success:function(response){
					
					 var data_array = JSON.parse(response);
					 
					 console.log(data_array)
					 
					 var objs = data_array.map(function(x) { 
                        return { 
						lat:x[0], 
						lng: x[1],
						count: x[2]
                       }; 
                       });

         
         
				let testData = {
				max: 10, data: objs};

         // console.log(response);	 

        heatmapLayer.setData(testData);

                }
            });
	
	
	
	
});	



	

});







</script>






</head>

<?php

session_start();

if($_SESSION["valid"]!=2)
	
	{
			header("Location: admin_login.php");		
	}


?>



<table border = "1">


	<tr>

		<td>
			<a href = "upload.php"> Upload your Http Data </a>
		</td>


		<td>
			<a href = "view_map.php"> View In Map </a>
		</td>


		<td>
			<a href = "edit_profile.php"> Edit Your Profile </a>
		</td>
		
		<td>
		<a href = "user_logout.php"> Logout </a>
		</td>

	</tr>

</table>

<a href = "find_records_by_ip.php"> View Records </a>

 <div id = "map" style = "width: 100%; height: 75%"></div>


</html>