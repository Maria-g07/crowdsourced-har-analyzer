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


$sql = "SELECT COUNT(*) as plithos,status FROM response  GROUP BY status";

$result = $con->query($sql);

if ($result->num_rows > 0) {

echo "<table border='2'>";

	echo "<tr>";
	
	echo "<th>";
	
	echo "Response Status";
	echo "</th>";
	
	echo "<th>";
	
	echo "Count Of Records";
	echo "</th>";

echo "</tr>";
  while($row = $result->fetch_assoc()) 
		{
          echo "<tr>";
		  
		  echo "<td>";
		  echo $row['status'];
		  echo "</td>";
		  
		  echo "<td>";
		  echo $row['plithos'];
		  echo "</td>";
		  echo "</tr>";

		}
  
  	echo "</table>";



}

else 
	
	{
		
		echo "No results";
	}



?>