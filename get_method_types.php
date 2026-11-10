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


$sql_query = "select DISTINCT method as methodos from request";
    $result = mysqli_query($con,$sql_query);

$option ="<select id = 'mymethod_type' name = 'mymethod_type[]' multiple>";
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		   
		   if($row['methodos']!="")
		   {
           $option .= '<option value = "'.$row['methodos'].'">'.$row['methodos'].'</option>';
		   }
    }
}

$option.="</select>";	
 

echo $option;





?>