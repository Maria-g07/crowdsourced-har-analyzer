<?php

$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "web"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['content_type']))
	
	{
$cont_type = $_POST['content_type'];
	}
	
if(isset($_POST['day']))
{	
$day = $_POST['day'];
}

if(isset($_POST['method_type']))
{
$method_type = $_POST['method_type'];
}

if(isset($_POST['isp']))
{
$isp =  $_POST['isp'];
}


if(isset($cont_type))
{
$condition_con_type = "header_response.content_type in  (";

$flag_conditions=0;

       foreach($cont_type as $x)
	   
	   {
		   if($flag_conditions==0)
		   {   
		   $condition_con_type = $condition_con_type. "'".$x."'";
		   $flag_conditions=1;
		   
		   }
		   
		   else
			   
			   {
				
				$condition_con_type = $condition_con_type. ",'".$x."'";

				   
			   }
		   
	   }
	$condition_con_type = $condition_con_type. ")";			
	
}
//meres

if(isset($day))
{
$condition_day_type = "entry.day_request in  (";

$flag_days=0;

       foreach($day as $x)
	   
	   {
		   if($flag_days==0)
		   {   
		   $condition_day_type = $condition_day_type. "'".$x."'";
		   $flag_days=1;
		   
		   }
		   
		   else
			   
			   {
				
				$condition_day_type = $condition_day_type. ",'".$x."'";

				   
			   }
		   
	   }
	$condition_day_type = $condition_day_type. ")";			
	
}	

//methods

if(isset($method_type))
{
$condition_method_type = "request.method in  (";

$flag_methods=0;

       foreach($method_type as $x)
	   
	   {
		   if($flag_methods==0)
		   {   
		   $condition_method_type = $condition_method_type. "'".$x."'";
		   $flag_methods=1;
		   
		   }
		   
		   else
			   
			   {
				
				$condition_method_type = $condition_method_type. ",'".$x."'";

				   
			   }
		   
	   }
	$condition_method_type = $condition_method_type. ")";	

}	
//paroxoi

if(isset($isp))
{
$condition_isp_type = "entry.isp in  (";

$flag_isps=0;

       foreach($isp as $x)
	   
	   {
		   if($flag_isps==0)
		   {   
		   $condition_isp_type = $condition_isp_type. "'".$x."'";
		   $flag_isps=1;
		   
		   }
		   
		   else
			   
			   {
				
				$condition_isp_type = $condition_isp_type. ",'".$x."'";

				   
			   }
		   
	   }
	$condition_isp_type = $condition_isp_type. ")";
}				
    	
if(isset($cont_type) && !isset($day) && !isset($method_type) && !isset($isp))

{

$sql = "SELECT entry.started_date_time as mytime, entry.wait as mywait from entry inner join request on entry.id = request.id_entry inner join header_response on entry.id = header_response.id_entry WHERE $condition_con_type";



}

else if(!isset($cont_type) && isset($day) && !isset($method_type) && !isset($isp))
	
	{
		$sql = "SELECT entry.started_date_time as mytime, entry.wait as mywait from entry inner join request on entry.id = request.id_entry inner join header_response on entry.id = header_response.id_entry WHERE $condition_day_type";

	   	
	}

else if(!isset($cont_type) && !isset($day) && isset($method_type) && !isset($isp))
	
	{
		$sql = "SELECT entry.started_date_time as mytime, entry.wait as mywait from entry inner join request on entry.id = request.id_entry inner join header_response on entry.id = header_response.id_entry WHERE $condition_method_type";

	   	
	}	

else if(!isset($cont_type) && !isset($day) && !isset($method_type) && isset($isp))
	
	{
		$sql = "SELECT entry.started_date_time as mytime, entry.wait as mywait from entry inner join request on entry.id = request.id_entry inner join header_response on entry.id = header_response.id_entry WHERE $condition_isp_type";

	   	
	}
	

else if(isset($cont_type) && isset($day) && !isset($method_type) && !isset($isp))
	
	{
		$sql = "SELECT entry.started_date_time as mytime, entry.wait as mywait from entry inner join request on entry.id = request.id_entry inner join header_response on entry.id = header_response.id_entry WHERE $condition_con_type and $condition_day_type";

	   	
	}	

else if(isset($cont_type) && !isset($day) && isset($method_type) && !isset($isp))
	
	{
		$sql = "SELECT entry.started_date_time as mytime, entry.wait as mywait from entry inner join request on entry.id = request.id_entry inner join header_response on entry.id = header_response.id_entry WHERE $condition_con_type and $condition_method_type";

	   	
	}
	
else if(isset($cont_type) && !isset($day) && !isset($method_type) && isset($isp))
	
	{
		$sql = "SELECT entry.started_date_time as mytime, entry.wait as mywait from entry inner join request on entry.id = request.id_entry inner join header_response on entry.id = header_response.id_entry WHERE $condition_con_type and $condition_isp_type";

	   	
	}

else if(!isset($cont_type) && isset($day) && isset($method_type) && !isset($isp))
	
	{
		$sql = "SELECT entry.started_date_time as mytime, entry.wait as mywait from entry inner join request on entry.id = request.id_entry inner join header_response on entry.id = header_response.id_entry WHERE $condition_day_type and $condition_method_type";

	   	
	}

else if(!isset($cont_type) && isset($day) && !isset($method_type) && isset($isp))
	
	{
		$sql = "SELECT entry.started_date_time as mytime, entry.wait as mywait from entry inner join request on entry.id = request.id_entry inner join header_response on entry.id = header_response.id_entry WHERE $condition_day_type and $condition_isp_type";

	   	
	}

else if(!isset($cont_type) && !isset($day) && isset($method_type) && isset($isp))
	
	{
		$sql = "SELECT entry.started_date_time as mytime, entry.wait as mywait from entry inner join request on entry.id = request.id_entry inner join header_response on entry.id = header_response.id_entry WHERE $condition_method_type and $condition_isp_type";

	   	
	}
	
else if(isset($cont_type) && isset($day) && isset($method_type) && !isset($isp))
	
	{
		$sql = "SELECT entry.started_date_time as mytime, entry.wait as mywait from entry inner join request on entry.id = request.id_entry inner join header_response on entry.id = header_response.id_entry WHERE $condition_con_type and $condition_day_type and $condition_method_type";

	   	
	}	
	
else if(isset($cont_type) && !isset($day) && isset($method_type) && isset($isp))
	
	{
		$sql = "SELECT entry.started_date_time as mytime, entry.wait as mywait from entry inner join request on entry.id = request.id_entry inner join header_response on entry.id = header_response.id_entry WHERE $condition_con_type and $condition_isp_type and $condition_method_type";

	   	
	}

else if(!isset($cont_type) && isset($day) && isset($method_type) && isset($isp))
	
	{
		$sql = "SELECT entry.started_date_time as mytime, entry.wait as mywait from entry inner join request on entry.id = request.id_entry inner join header_response on entry.id = header_response.id_entry WHERE $condition_day_type and $condition_isp_type and $condition_method_type";

	   	
	}		
	
else if(isset($cont_type) && isset($day) && isset($method_type) && isset($isp))
	
	{
		$sql = "SELECT entry.started_date_time as mytime, entry.wait as mywait from entry inner join request on entry.id = request.id_entry inner join header_response on entry.id = header_response.id_entry WHERE $condition_con_type and $condition_day_type and $condition_method_type and $condition_isp_type";

	   	
	}

else

{
		$sql = "SELECT entry.started_date_time as mytime, entry.wait as mywait from entry inner join request on entry.id = request.id_entry inner join header_response on entry.id = header_response.id_entry";


}	


$result = $con->query($sql);

$mysum = array();

for($i=0;$i<24;$i++)
	
	{
		
		array_push($mysum,0);
		
	}
	
$mycounter = array();

$meso_wait = [];



for($i=0;$i<24;$i++)


{
   array_push($mycounter,0);
   
   array_push($meso_wait,0);
   
}	

if ($result->num_rows > 0) {
	
	
	while($row = $result->fetch_assoc()) 
		{

     $myhour= $row['mytime'];
	 
	 
	 $myhour = substr($myhour,11,2);
	 
	 
	 if($myhour=="01")
		 
		 {
			
             $mysum[0] = $mysum[0] + floatval($row['mywait']);
             $mycounter[0]++;			 
			 
		 }	 
	
    elseif($myhour=="02")
	
	{
		
	  $mysum[1] = $mysum[1] + floatval($row['mywait']);
      $mycounter[1]++;	  

		
	}
	
	elseif($myhour=="03")
	
	{
		
	  $mysum[2] = $mysum[2] + floatval($row['mywait']);
      $mycounter[2]++;	  

		
	}
	
	elseif($myhour=="04")
	
	{
		
	  $mysum[3] = $mysum[3] + floatval($row['mywait']);
      $mycounter[3]++;	  

		
	}
	
	elseif($myhour=="05")
	
	{
		
	  $mysum[4] = $mysum[4] + floatval($row['mywait']);
      $mycounter[4]++;	  

		
	}
	
	elseif($myhour=="06")
	
	{
		
	  $mysum[5] = $mysum[5] + floatval($row['mywait']);
      $mycounter[5]++;	  

		
	}
	
	elseif($myhour=="07")
	
	{
		
	  $mysum[6] = $mysum[6] + floatval($row['mywait']);
      $mycounter[6]++;	  

		
	}
	
	elseif($myhour=="08")
	
	{
		
	  $mysum[7] = $mysum[7] + floatval($row['mywait']);
      $mycounter[7]++;	  

		
	}
	
	elseif($myhour=="09")
	
	{
		
	  $mysum[8] = $mysum[8] + floatval($row['mywait']);
      $mycounter[8]++;	  

		
	}
	
	elseif($myhour=="10")
	
	{
		
	  $mysum[9] = $mysum[9] + floatval($row['mywait']);
      $mycounter[9]++;	  

		
	}
	
	elseif($myhour=="11")
	
	{
		
	  $mysum[10] = $mysum[10] + floatval($row['mywait']);
      $mycounter[10]++;	  

		
	}
	
	elseif($myhour=="12")
	
	{
		
	  $mysum[11] = $mysum[11] + floatval($row['mywait']);
      $mycounter[11]++;	  

		
	}
	
	elseif($myhour=="13")
	
	{
		
	  $mysum[12] = $mysum[12] + floatval($row['mywait']);
      $mycounter[12]++;	  

		
	}
	
	elseif($myhour=="14")
	
	{
		
	  $mysum[13] = $mysum[13] + floatval($row['mywait']);
      $mycounter[13]++;	  

		
	}
	
	
	elseif($myhour=="15")
	
	{
		
	  $mysum[14] = $mysum[14] + floatval($row['mywait']);
      $mycounter[14]++;	  

		
	}
	
	elseif($myhour=="16")
	
	{
		
	  $mysum[15] = $mysum[15] + floatval($row['mywait']);
      $mycounter[15]++;	  

		
	}
	
	
	elseif($myhour=="17")
	
	{
		
	  $mysum[16] = $mysum[16] + floatval($row['mywait']);
      $mycounter[16]++;	  

		
	}
	
	
	elseif($myhour=="18")
	
	{
		
	  $mysum[17] = $mysum[17] + floatval($row['mywait']);
      $mycounter[17]++;	  

		
	}
	
	
	elseif($myhour=="19")
	
	{
		
	  $mysum[18] = $mysum[18] + floatval($row['mywait']);
      $mycounter[18]++;	  

		
	}
	
	
	elseif($myhour=="20")
	
	{
		
	  $mysum[19] = $mysum[19] + floatval($row['mywait']);
      $mycounter[19]++;	  

		
	}
	
	
	elseif($myhour=="21")
	
	{
		
	  $mysum[20] = $mysum[20] + floatval($row['mywait']);
      $mycounter[20]++;	  

		
	}
	
	elseif($myhour=="22")
	
	{
		
	  $mysum[21] = $mysum[21] + floatval($row['mywait']);
      $mycounter[21]++;	  

		
	}
	elseif($myhour=="23")
	
	{
		
	  $mysum[22] = $mysum[22] + floatval($row['mywait']);
      $mycounter[22]++;	  

		
	}
	
	elseif($myhour=="00")
	
	{
		
	  $mysum[23] = $mysum[23] + floatval($row['mywait']);
      $mycounter[23]++;	  

		
	}
	
	
}


for($i=0;$i<24;$i++)
	

	{
		if($mycounter[$i]>0)
			
			{
				$meso_wait[$i] = $mysum[$i]/$mycounter[$i];
				
			}
		
		
		
	}


}


echo json_encode($meso_wait);

//echo $sql;
?>