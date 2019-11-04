<?php

include 'config.php';

$city = filter_input(INPUT_POST, 'Location_City');
$state = filter_input(INPUT_POST, 'Location_State');
$name = filter_input(INPUT_POST, 'Location_Name');
$pay = filter_input(INPUT_POST, 'Location_Pay');
$latitude = filter_input(INPUT_POST, 'Location_Latitude');
$longitude = filter_input(INPUT_POST, 'Location_Longitude');
$rating = filter_input(INPUT_POST, 'Location_Rating');
$description = filter_input(INPUT_POST, 'Location_Descritiop');

if (!empty($city))
{
  if (!empty($state))
  {

    if (!empty($name))
    {
      if (!empty($pay))
      {
        if(!empty($latitude))
        {
          if(!empty($longitude))
          {

            if (!empty($rating))
            {

              if (!empty($description))
              {

                $conn = new mysqli (DBHOST, DBROOT, DBROOTPASS, DBNAME);

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
                      }
                      else {
                        echo"Error: ".sql ."<br>".$conn->error;
                      }
                      $conn->close();
                }
              }
              else
              {
                echo"Description should not be empty";
                die();
              }
            }
            else
            {
              echo"Rating should not be empty";
              echo$rating;
              die();
            }
          }
          else
          {
            echo"Longitude should not be empty";
            die();
          }
        }
        else
        {
          echo"Latitude should not be empty";
          die();
        }
      }
      else
      {
        echo"Rating should not be empty";
        die();
      }
    }
    else
    {
      echo"Name should not be empty";
      die();
    }
  }
}
else
{
  echo"City should not be empty";
  die();
}

?>
