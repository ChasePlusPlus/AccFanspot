<?php

session_start();

include_once("./library.php"); // To connect to the database
$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
// Check connection
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$username = $_SESSION["username"];
$fan_id = $_SESSION["fan_id"];

$team_id = $_POST["team"];

mysqli_query($con, "delete from `Favorites` where `Fan_ID` = '$fan_id' and `Team_ID` = '$team_id'");

header("Refresh:0; url=teams.php");
?>