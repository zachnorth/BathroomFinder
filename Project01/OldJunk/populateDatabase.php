<?php

include('config.php');

$conn = new mysqli (DBHOST, DBUSERNAME, DBPASSWORD, DBNAME);


$city = filter_input(INPUT_POST, 'Location_City');
$state = filter_input(INPUT_POST, 'Location_State');
$name = filter_input(INPUT_POST, 'Location_Name');
$pay = filter_input(INPUT_POST, 'Location_Pay');
$latitude = filter_input(INPUT_POST, 'Location_Latitude');
$longitude = filter_input(INPUT_POST, 'Location_Longitude');
$rating = filter_input(INPUT_POST, 'Location_Rating');
$description = filter_input(INPUT_POST, 'Location_Descritiop');


$sql = "INSERT INTO location_data (Location_City, Location_State,
   Location_Name, Location_Pay, Location_Latitude,
   Location_Longitude, Location_Rating, Location_Description)
   VALUES ('$city', '$state', '$name', '$pay', '$latitude',
     '$longitude', '$rating', '$description')";


?>
