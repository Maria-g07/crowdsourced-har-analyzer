<html>

<head>

<link rel="stylesheet" href="mystyle.css">

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




</html>