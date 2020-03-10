<?php

include('config.php');


$city = filter_input(INPUT_POST, 'city');
$state = filter_input(INPUT_POST, 'state');
$name = filter_input(INPUT_POST, 'est_name');
$pay = filter_input(INPUT_POST, 'pay');
$latitude = filter_input(INPUT_POST, 'latitude');
$longitude = filter_input(INPUT_POST, 'longitude');
$rating = filter_input(INPUT_POST, 'rating');
$description = filter_input(INPUT_POST, 'description');


$conn = new mysqli ($DBHOST, $DBUSERNAME, $DBPASSWORD, $DBNAME);

if (mysqli_connect_error())
{
  die('Connect Error ('.mysqli_connect_errno() .')'
  .mysqli_connect_error());
}
else
{
  $sql = "INSERT INTO location_data (Location_City, Location_State,
     Location_Name, Location_Pay, Location_Latitude,
     Location_Longitude, Location_Rating, Location_Description)
     VALUES ('$city', '$state', '$name', '$pay', '$latitude', '$longitude', '$rating', '$description')";

      if($conn->query($sql))
      {
        echo"New Location Inserted Into Database";
        header("Location:http://localhost/projects/Bathroom_Finder/BathroomFinder/Project01/BathroomAppMapLoggedIn.html");
      }
      else {
        echo"Error: ".$sql ."<br>".$conn->error;
      }
      $conn->close();
}


?>
