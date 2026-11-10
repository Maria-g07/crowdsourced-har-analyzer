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


$sql = "SELECT COUNT(DISTINCT url) as plithos FROM request";

$result = $con->query($sql);

$row = $result->fetch_assoc();

$plithos = $row['plithos'];


echo "<table border='2'>";

echo "<tr>";

echo "<th>";

echo "Count of Unique Domains";
echo "</th>";
echo "</tr>";

echo "<tr>";

echo "<td>";
echo $plithos;
echo "</td>";
echo "</tr>";
echo "</table>";

?>