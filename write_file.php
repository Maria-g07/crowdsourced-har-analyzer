<?php



//apothikevoume to mystr ( me ta filtrarismena dedomena)
$filtered = $_POST["filtered"];


echo $filtered;

$myfile = fopen("filtered_data.har", "w");

fwrite($myfile, $filtered);


fclose($myfile);












?>