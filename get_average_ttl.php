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

$unique_types = array();

$sum_ttls = array();

$count_ttls = array();

$sql2 = "SELECT DISTINCT content_type as mytype FROM header_response WHERE content_type<>''";

$result2 = $con->query($sql2);

while($row2 = $result2->fetch_assoc()) {
	
	array_push($unique_types,$row2['mytype']);
	
}

for($i=0;$i<count($unique_types);$i++)
	
	{
		array_push($sum_ttls,0);
		array_push($count_ttls,0);
		
	}




$sql = "SELECT cache_control, content_type from header_response where cache_control like '%max-age%'";

$db_ttl = array();

$db_con_type = array();

$result = $con->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $cache_control = $row['cache_control'];
	
	
	$token = strtok($cache_control, ",");

	while ($token !== false)
		{
		
		if (strpos($token, 'max-age') !== false) { 
			
			$token_age = strtok($token,"=");
			
			$token_age = strtok("=");
			
			
			//echo $token_age;
			//echo "<br>";
			array_push($db_ttl,intval($token_age));
			
			//echo "<br>";
			
			array_push($db_con_type,$row['content_type']);
			
			
			
			
			
			}
		
		
		
		$token = strtok(",");
	
	    }
} 

}

else {
  echo "0 results";
}






for($i=0;$i<count($unique_types);$i++)

{
	
	for($j=0;$j<count($db_con_type);$j++)
		
		{
			
			if($unique_types[$i] == $db_con_type[$j])
				
				{
					
					$sum_ttls[$i] = $sum_ttls[$i] + $db_ttl[$j];
					
					$count_ttls[$i]++;
					
				}
			
			
			
		}
	
	
	
	
}

$average_ttls = array();


for($i=0;$i<count($unique_types);$i++)
	
	{
		
		if($count_ttls[$i]!=0)
		
		{
		
		array_push($average_ttls, $sum_ttls[$i] / $count_ttls[$i]);
		
		}
		
		else
		{
			
			array_push($average_ttls,0);
		}
		
	}


echo "<table border='2'>";

echo "<tr>";

echo "<th>";
echo "Count Type";
echo "</th>";

echo "<th>";
echo "TTL";
echo "</th>";
echo "</tr>";


for($i=0;$i<count($average_ttls);$i++)
	
	{
		if($average_ttls[$i]!=0)
		{
		echo "<tr>";
		
		echo "<td>";
		echo $unique_types[$i];
		echo "</td>";
		
		echo "<td>";
		echo $average_ttls[$i];
		echo "</td>";
		echo "</tr>";
		}
	}
echo "</table>";
?>