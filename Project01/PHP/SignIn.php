<?php

include('config.php');

$conn = new mysqli (DBHOST, DBUSERNAME, DBPASSWORD, DBNAME);

$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');


$query = "SELECT * FROM `account_data` WHERE Account_User_Name = '$username' and Account_Password = '$password'";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0)
{
  echo'Logged In';
}
else
{
  echo'The Username or Password are incorect!';
}
?>
