<?php

include('config.php');

$firstName = filter_input(INPUT_POST, 'firstName');
$lastName = filter_input(INPUT_POST, 'lastName');
$email = filter_input(INPUT_POST, 'email');
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'psw');
$password_repeat = filter_input(INPUT_POST, 'psw-repeat');
$city = filter_input(INPUT_POST, 'city');


$conn = new mysqli (DBHOST, DBUSERNAME, DBPASSWORD, DBNAME);

if (mysqli_connect_error())
{
  die('Connect Error ('.mysqli_connect_errno() .')'
  .mysqli_connect_error());
}
else
{

  $sql = "INSERT INTO account_data (Account_Name_First, Account_Name_Last,
  Account_Email, Account_User_Name, Account_Password, Account_Home_City)
  VALUES ('$firstName', '$lastName', '$email', '$username', '$password', '$city')";

  if($conn->query($sql))
  {
    echo"New User Inserted Into Database";
  }
  else {
    echo"Error: ".sql ."<br>".$conn->error;
  }
  $conn->close();
}


?>
