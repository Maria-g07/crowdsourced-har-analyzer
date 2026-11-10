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

$sql = "SELECT COUNT(*) as plithos_stale FROM header_response WHERE cache_control LIKE '%max-stale%'";


$sql2 = "SELECT COUNT(*) as plithos_fresh FROM header_response WHERE cache_control LIKE '%min-fresh%'";


$sql3 = "SELECT COUNT(*) as plithos FROM header_response";

$result = $con->query($sql);

$result2 = $con->query($sql2);

$result3 = $con->query($sql3);


$row = $result->fetch_assoc();
$stales = intval($row['plithos_stale']);

$row2 = $result2->fetch_assoc();

$freshes = intval($row2['plithos_fresh']);

$row3 = $result3->fetch_assoc();

$total = intval($row3['plithos']);


echo "<table border='2'>";

echo "<tr>";

echo "<th>";
echo "Percentage of Max-stale";
echo "</th>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo $stales/$total;
echo "</td>";
echo "</tr>";
echo "</table>";

echo "<br>";

echo "<table border='2'>";

echo "<tr>";

echo "<th>";
echo "Percentage of Min-Fresh";
echo "</th>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo $freshes/$total;
echo "</td>";
echo "</tr>";
echo "</table>";


?>