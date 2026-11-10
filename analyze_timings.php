<html>

<head>
<link rel="stylesheet" href="mystyle.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js'></script>


<script>

$( document ).ready(function() {
	
	meso_wait = new Array();
	
	filtered_meso_wait  = new Array();

	
	$.ajax({
                url:'find_average_waiting.php',

                type:'post',
                
                success:function(response){
                   

                   // $("#result").html(response);
					
					meso_wait = JSON.parse(response);
					
					//console.log(meso_wait);
					
					const ctx = document.getElementById('histogram').getContext('2d');

const chart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [1, 2, 3, 4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,0],
    datasets: [{
      label: 'Average Response Time',
      data: meso_wait,
      backgroundColor: 'blue',
    }]
  },
  options: {
    scales: {
      xAxes: [{
        display: false,
        barPercentage: 1,
        ticks: {
          max: 24,
        }
      }, {
        display: true,
        ticks: {
          autoSkip: false,
          max: 24,
        }
      }],
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
});
					
					
					
					
					

                }
            });	
	
    
	$.ajax({
                url:'get_content_types.php',

                type:'post',
                
                success:function(response){
                   

                    $("#content_type").html(response);
				   

                }
            });
	
	
	$.ajax({
                url:'get_method_types.php',

                type:'post',
                
                success:function(response){
                   

                    $("#method_type").html(response);
				   

                }
            });
			
	$.ajax({
                url:'get_isps.php',

                type:'post',
                
                success:function(response){
                   

                    $("#isp").html(response);
				   

                }
            });		
	
	
	
	$("#filter_button").click(function(){
        
            $.ajax({
                url:'find_avg_waiting_filter.php',
				data: {content_type: $( "#mycontent_type" ).val(),day: $( "#day" ).val(), method_type: $( "#mymethod_type" ).val(),isp: $( "#myisp" ).val() },

                type:'post',
                
                success:function(response){

                    
                   // $("#filtered_result").html(response);
					
					
					filtered_meso_wait = JSON.parse(response);
					
					//console.log(meso_wait);
					
					const ctx = document.getElementById('histogram').getContext('2d');

const chart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [1, 2, 3, 4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,0],
    datasets: [{
      label: 'Average Response Time',
      data: filtered_meso_wait,
      backgroundColor: 'blue',
    }]
  },
  options: {
    scales: {
      xAxes: [{
        display: false,
        barPercentage: 1,
        ticks: {
          max: 24,
        }
      }, {
        display: true,
        ticks: {
          autoSkip: false,
          max: 24,
        }
      }],
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
});
					
					
					
					
					
					
					
					
					
					
                }
            });
        
    });		
	
	
	
	
	
});	


</script>


</head>

<?php

session_start();


if($_SESSION["valid"]!=1)
	
	{
	
		header("Location: admin_login.php");	

		
	}	
		


?>

<table border="1">

	<tr>
		
		<td>
			<a href ="view_basic_info.php"> View Basic Info </a>
		</td>
		
		  <td>
			<a href ="analyze_timings.php"> Analyze Timings</a>

          </td>
		  
		  
		<td>
		
			<a href ="analyze_headers.php"> Analyze Headers</a>

		</td>
		
		<td>
			<a href ="map_visualization.php">Map Visualization</a>
		</td>
		
		
		<td>
			<a href ="admin_logout.php">Logout</a>
		</td>
		

	
	
	</tr>





</table>

<br>
<br>

<table>

<tr>
<td>
Select Content Type: 
<br>
<div id = "content_type"> </div>

<br>
<br>

Select Day:
<br>

<select  id="day" multiple>
  <option value="Monday">Monday</option>
  <option value="Tuesday">Tuesday</option>
  <option value="Wednesday">Wednesday</option>
  <option value="Thursday">Thursday</option>
  <option value="Friday">Friday</option>
  <option value="Saturday">Saturday</option>
  <option value="Sunday">Sunday</option>


  
</select>

<br>

<br>

Select Method Type:
<br>
<div id = "method_type"> </div>

<br>
<br>


Select ISP:
<br>

<div id = "isp"> </div>

<br>
<br>

<input type = "submit" name = "filter_button" id = "filter_button"  value = "Filter">

<br>
<br>

<div id = "filtered_result"> </div>

<div id = "result"> </div>

</td>

<td>

<canvas id="histogram" width="50" height="20"></canvas>

</td>

</tr>

</table>

</html>