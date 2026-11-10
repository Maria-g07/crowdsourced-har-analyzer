<html>

<head>
<link rel="stylesheet" href="mystyle.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>

$( document ).ready(function() {
    
	$.ajax({
                url:'count_users.php',

                type:'post',
                
                success:function(response){
                   

                    $("#div1").html(response);
				   

                }
            });
	
	$.ajax({
                url:'count_request_type.php',

                type:'post',
                
                success:function(response){
                   

                    $("#div2").html(response);
				   

                }
            });
	
	$.ajax({
                url:'count_response_status.php',

                type:'post',
                
                success:function(response){
                   

                    $("#div3").html(response);
				   

                }
            });
	
	$.ajax({
                url:'count_domains.php',

                type:'post',
                
                success:function(response){
                   

                    $("#div4").html(response);
				   

                }
            });
	
	$.ajax({
                url:'count_isps.php',

                type:'post',
                
                success:function(response){
                   

                    $("#div5").html(response);
				   

                }
            });
	
	$.ajax({
                url:'find_average_age.php',

                type:'post',
                
                success:function(response){
                   

                    $("#div6").html(response);
				   

                }
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

Count of Registered Users:
<br>
<div id="div1">   </div>
<br>
<br>

Count of Records per Method Type:
<br>
<div id="div2">   </div>
<br>
<br>

Count of Records per Status Response:
<br>
<div id="div3">   </div>
<br>
<br>
Count of Unique Domains:
<br>
<div id="div4">   </div>
<br>
<br>
Count of Unique ISPs:
<br>
<div id="div5">   </div>
<br>
<br>
Average Age per Content Type:
<div id="div6">   </div>






</html>