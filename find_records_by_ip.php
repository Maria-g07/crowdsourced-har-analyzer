<?php

session_start();

$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "web"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

$username = $_SESSION["username"];

$sql = "SELECT COUNT(*) as plithos, entry.server_latlng as slatlng FROM entry inner join header_response on entry.id = header_response.id_entry WHERE entry.server_latlng<>''AND entry.username='$username' and (header_response.content_type LIKE '%html%' or header_response.content_type LIKE '%php' or header_response.content_type LIKE '%jsp%' or header_response.content_type LIKE '%asp%')  GROUP BY entry.server_latlng";


$result = $con->query($sql);

$final_array = array();

if ($result->num_rows > 0) {


while($row = $result->fetch_assoc()) 
		{
          $temp_array = array();
		  
		  $my_array = explode(',', $row["slatlng"]);
           
		  
		  array_push($temp_array,floatval($my_array[0]));
		  
		  array_push($temp_array,floatval($my_array[1]));
          
          array_push($temp_array,intval($row["plithos"]));

          
		   array_push($final_array,$temp_array);


		}


}

echo json_encode($final_array);


?>