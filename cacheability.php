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

$sql = "SELECT COUNT(*) as plithos_public FROM header_response WHERE cache_control LIKE '%public%'";


$sql2 = "SELECT COUNT(*) as plithos_private FROM header_response WHERE cache_control LIKE '%private%'";

$sql3 = "SELECT COUNT(*) as plithos_no_cache FROM header_response WHERE cache_control LIKE '%no-cache%'";

$sql4 = "SELECT COUNT(*) as plithos_no_store FROM header_response WHERE cache_control LIKE '%no-store%'";


$sql5 = "SELECT COUNT(*) as plithos FROM header_response";

$result = $con->query($sql);

$result2 = $con->query($sql2);

$result3 = $con->query($sql3);

$result4 = $con->query($sql4);

$result5 = $con->query($sql5);


$row = $result->fetch_assoc();

$row2 = $result2->fetch_assoc();

$row3 = $result3->fetch_assoc();

$row4 = $result4->fetch_assoc();

$row5 = $result5->fetch_assoc();

$public_percent = intval($row['plithos_public'])/intval($row5['plithos']);

$private_percent = intval($row2['plithos_private'])/intval($row5['plithos']);

$no_cache_percent = intval($row3['plithos_no_cache'])/intval($row5['plithos']);

$no_store_percent = intval($row4['plithos_no_store'])/intval($row5['plithos']);



echo "<table border='2'>";

echo "<tr>";

echo "<th>";
echo "Public Percentage";
echo "</th>";

echo "<th>";
echo "Private Percentage";

echo "</th>";

echo "<th>";
echo "No-Cache Percentage";

echo "</th>";

echo "<th>";
echo "No-Store Percentage";

echo "</th>";

echo "</tr>";

echo "<tr>";

echo "<td>";

echo $public_percent;

echo "</td>";

echo "<td>";

echo $private_percent;

echo "</td>";

echo "</td>";

echo "<td>";

echo $no_cache_percent;

echo "</td>";

echo "</td>";

echo "<td>";

echo $no_store_percent;

echo "</td>";


echo "</tr>";

echo "</table>";
?>