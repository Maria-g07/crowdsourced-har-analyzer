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


$sql = "SELECT AVG(age) as mesos,content_type FROM header_response GROUP BY content_type HAVING  mesos >0";


$result = $con->query($sql);


if ($result->num_rows > 0) {
	
  echo "<table border='2'>";

   echo "<tr>";
   
   echo "<th>";
   
   echo "Content Type";
   echo "</th>";
   
   echo "<th>";
   echo "Average Age";
   echo "</th>";

   echo "</tr>";   
  // output data of each row
  while($row = $result->fetch_assoc()) 
  {
    echo "<tr>";
	
	echo "<td>";
	echo $row['content_type'];
	echo "</td>";
	
	echo "<td>";
	echo $row['mesos'];
	echo "</td>";
	echo "</tr>";
  
  }
  
    echo "</table>";

  
} else {
  echo "0 results";
}








?>