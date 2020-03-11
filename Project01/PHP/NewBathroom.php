<?php

require("config.php");

$lat = filter_input(INPUT_POST, 'lat');
$lng = filter_input(INPUT_POST, 'lng');
$address = filter_input(INPUT_POST, 'address');
$name = filter_input(INPUT_POST, 'name');
$description = filter_input(INPUT_POST, 'description');


$conn = mysqli_connect($DBHOST, $DBUSERNAME, $DBPASSWORD);

if(!$conn)
{
    die("Not Connected : " . mysql_error());
}

$db_selected = mysqli_select_db($conn, $DBNAME);
if(!$db_selected)
{
    die("Can\'t us db : " . mysql_error());
}

$query = "INSERT INTO markers (name, address, lat, 
        lng, description)
        values ('$name', '$address', '$lat',
        '$lng', '$description')";

if($conn->query($query))
{
    echo"New Location Inserted Into Database";
    header("Location:http://localhost/projects/Bathroom_Finder/BathroomFinder/Project01/BathroomAppMapLoggedIn.html");
}
else
{
    echo"Error: ".$query ."<br>".$conn->error;
}

$conn->close();
?>