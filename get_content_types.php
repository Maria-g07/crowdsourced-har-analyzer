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


$sql_query = "select DISTINCT content_type as tipos from header_response";
    $result = mysqli_query($con,$sql_query);

$option ="<select id = 'mycontent_type' name='mycontent_type[]' multiple>";
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		   
		   if($row['tipos']!="")
		   {
           $option .= '<option value = "'.$row['tipos'].'">'.$row['tipos'].'</option>';
		   }
    }
}

$option.="</select>";	
 

echo $option;





?>