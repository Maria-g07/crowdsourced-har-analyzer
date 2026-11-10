<html>

<?php

session_start();


if($_SESSION["valid"]!=1)
	
	{
	
		header("Location: admin_login.php");	

		
	}	
		


?>
<head>
<link rel="stylesheet" href="mystyle.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>

$( document ).ready(function() {
	
	$.ajax({
                url:'get_content_types.php',

                type:'post',
                
                success:function(response){
                   

                    $("#content_type").html(response);
				   

                }
            });
	
   
    $.ajax({
                url:'get_isps.php',

                type:'post',
                
                success:function(response){
                   

                    $("#isp").html(response);
				   

                }
            });	
   
	
	$.ajax({
                url:'get_average_ttl.php',

                type:'post',
                
                success:function(response){
                   

                    $("#result").html(response);
				   

                }
            });
			
			
	$.ajax({
                url:'stale_fresh.php',

                type:'post',
                
                success:function(response){
                   

                    $("#stale_fresh").html(response);
				   

                }
            });		
			
			
	$.ajax({
                url:'cacheability.php',

                type:'post',
                
                success:function(response){
                   

                    $("#cacheability").html(response);
				   

                }
            });				
			
	$("#filter_button").click(function(){
        
            $.ajax({
                url:'get_average_ttl_filters.php',
				data: {content_type: $( "#mycontent_type" ).val(),isp: $( "#myisp" ).val() },

                type:'post',
                
                success:function(response){

                    
                    $("#filtered_result").html(response);					
                }
            });
			
			
			
			 $.ajax({
                url:'stale_fresh_filt.php',
				data: {content_type: $( "#mycontent_type" ).val(),isp: $( "#myisp" ).val() },

                type:'post',
                
                success:function(response){

                    
                    $("#stale_fresh_filtered").html(response);					
                }
            });
			
			
			$.ajax({
                url:'cacheability_filt.php',
				data: {content_type: $( "#mycontent_type" ).val(),isp: $( "#myisp" ).val() },

                type:'post',
                
                success:function(response){

                    
                    $("#cache_filtered").html(response);					
                }
            });
        
    });				
			
	
});	



</script>

</head>


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

<table>

<tr>
<td>
<div id="result"> </div>

</td>
<td>

<div id="stale_fresh"> </div>

<br>

<div id="cacheability"> </div>


<br>
<br>
<br>
<br>
Select Content Type:
<div id ="content_type"> </div>
<br>
<br>
Select ISP:
<div id ="isp"> </div>
<br>
<br>
<input type = "submit" name = "filter_button" id = "filter_button"  value = "Filter">

<br>
<br>


<br>
<br>

<div id="filtered_result"> </div>

<br>
<div id="cache_filtered"> </div>
<br>

<div id="stale_fresh_filtered"> </div>

<br>



</td>
</tr>
</table>

</html>