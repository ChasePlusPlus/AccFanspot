<?php

session_start();

include_once("./library.php"); // To connect to the database
$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
 // Check connection
if (mysqli_connect_errno()){
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$username = $_POST["username"];
$password = $_POST["password"];

$result = mysqli_query($con, "select * from `Fan` where Username = '$username' and Password = MD5('$password')");
$rowcount=mysqli_num_rows($result);

$result = mysqli_fetch_assoc($result);

if($rowcount == 0){

 $_SESSION["login_error"] = "Your username/password combination was not recognized.";
 header("Refresh:0; url=login.php");

} else {
 session_destroy();

 session_start();
 $_SESSION["login"] = "valid";
 $_SESSION["username"] = $username;
 $_SESSION["fan_id"] = $result['Fan_ID'];
 header("Refresh:0; url=home.php");
}

?>
