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


$sql = "SELECT COUNT(*) as plithos FROM user";

$result = $con->query($sql);

$row = $result->fetch_assoc();

$plithos = $row['plithos'];


echo "<table border = '2'>";

echo "<tr>";

echo "<th>";
echo "Total Count Of Users";
echo "</th>";
echo "</tr>";

echo "<tr>";

echo "<td>";
echo $plithos;
echo "</td>";
echo "</tr>";
echo "</table>";
?>