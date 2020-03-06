<?php

include('config.php');

$conn = new mysqli ($DBHOST, $DBUSERNAME, $DBPASSWORD, $DBNAME);

$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');


$query = "SELECT * FROM account_data WHERE Account_User_Name = '$username' and Account_Password = '$password'";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 1)
{
  echo'Logged In';
  $_SESSION['message'] = "Logged In";
  header("Location:http://localhost/Projects/Card_Game_Current/BathroomFinder/Project01/BathroomAppMapLoggedIn.html");
  if(isset($_SESSION['message']))
  {
    echo '<script>alert("Logged In")</script>';
    unset($_SESSION['message']);
  }
}
else
{
  echo'The Username or Password are incorect!';
}


?>
