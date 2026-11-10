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


$sql = "SELECT started_date_time, wait from entry";

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

     $myhour= $row['started_date_time'];
	 
	 
	 $myhour = substr($myhour,11,2);
	 
	 
	 if($myhour=="01")
		 
		 {
			
             $mysum[0] = $mysum[0] + floatval($row['wait']);
             $mycounter[0]++;			 
			 
		 }	 
	
    elseif($myhour=="02")
	
	{
		
	  $mysum[1] = $mysum[1] + floatval($row['wait']);
      $mycounter[1]++;	  

		
	}
	
	elseif($myhour=="03")
	
	{
		
	  $mysum[2] = $mysum[2] + floatval($row['wait']);
      $mycounter[2]++;	  

		
	}
	
	elseif($myhour=="04")
	
	{
		
	  $mysum[3] = $mysum[3] + floatval($row['wait']);
      $mycounter[3]++;	  

		
	}
	
	elseif($myhour=="05")
	
	{
		
	  $mysum[4] = $mysum[4] + floatval($row['wait']);
      $mycounter[4]++;	  

		
	}
	
	elseif($myhour=="06")
	
	{
		
	  $mysum[5] = $mysum[5] + floatval($row['wait']);
      $mycounter[5]++;	  

		
	}
	
	elseif($myhour=="07")
	
	{
		
	  $mysum[6] = $mysum[6] + floatval($row['wait']);
      $mycounter[6]++;	  

		
	}
	
	elseif($myhour=="08")
	
	{
		
	  $mysum[7] = $mysum[7] + floatval($row['wait']);
      $mycounter[7]++;	  

		
	}
	
	elseif($myhour=="09")
	
	{
		
	  $mysum[8] = $mysum[8] + floatval($row['wait']);
      $mycounter[8]++;	  

		
	}
	
	elseif($myhour=="10")
	
	{
		
	  $mysum[9] = $mysum[9] + floatval($row['wait']);
      $mycounter[9]++;	  

		
	}
	
	elseif($myhour=="11")
	
	{
		
	  $mysum[10] = $mysum[10] + floatval($row['wait']);
      $mycounter[10]++;	  

		
	}
	
	elseif($myhour=="12")
	
	{
		
	  $mysum[11] = $mysum[11] + floatval($row['wait']);
      $mycounter[11]++;	  

		
	}
	
	elseif($myhour=="13")
	
	{
		
	  $mysum[12] = $mysum[12] + floatval($row['wait']);
      $mycounter[12]++;	  

		
	}
	
	elseif($myhour=="14")
	
	{
		
	  $mysum[13] = $mysum[13] + floatval($row['wait']);
      $mycounter[13]++;	  

		
	}
	
	
	elseif($myhour=="15")
	
	{
		
	  $mysum[14] = $mysum[14] + floatval($row['wait']);
      $mycounter[14]++;	  

		
	}
	
	elseif($myhour=="16")
	
	{
		
	  $mysum[15] = $mysum[15] + floatval($row['wait']);
      $mycounter[15]++;	  

		
	}
	
	
	elseif($myhour=="17")
	
	{
		
	  $mysum[16] = $mysum[16] + floatval($row['wait']);
      $mycounter[16]++;	  

		
	}
	
	
	elseif($myhour=="18")
	
	{
		
	  $mysum[17] = $mysum[17] + floatval($row['wait']);
      $mycounter[17]++;	  

		
	}
	
	
	elseif($myhour=="19")
	
	{
		
	  $mysum[18] = $mysum[18] + floatval($row['wait']);
      $mycounter[18]++;	  

		
	}
	
	
	elseif($myhour=="20")
	
	{
		
	  $mysum[19] = $mysum[19] + floatval($row['wait']);
      $mycounter[19]++;	  

		
	}
	
	
	elseif($myhour=="21")
	
	{
		
	  $mysum[20] = $mysum[20] + floatval($row['wait']);
      $mycounter[20]++;	  

		
	}
	
	elseif($myhour=="22")
	
	{
		
	  $mysum[21] = $mysum[21] + floatval($row['wait']);
      $mycounter[21]++;	  

		
	}
	elseif($myhour=="23")
	
	{
		
	  $mysum[22] = $mysum[22] + floatval($row['wait']);
      $mycounter[22]++;	  

		
	}
	
	elseif($myhour=="00")
	
	{
		
	  $mysum[23] = $mysum[23] + floatval($row['wait']);
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






?>