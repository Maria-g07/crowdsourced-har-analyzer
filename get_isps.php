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


$sql_query = "select DISTINCT isp as paroxos from entry";
    $result = mysqli_query($con,$sql_query);

$option ="<select id = 'myisp' name='myisp[]' multiple>";
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		   
		   if($row['paroxos']!="")
		   {
           $option .= '<option value = "'.$row['paroxos'].'">'.$row['paroxos'].'</option>';
		   }
    }
}

$option.="</select>";	
 

echo $option;





?>