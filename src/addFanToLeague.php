<?php

session_start();

include_once("./library.php"); // To connect to the database
$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
// Check connection
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$my_fan_id = $_SESSION["fan_id"];
$username = $_POST["username"];
$league_id = $_POST["leagueID"];


$result = mysqli_query($con, "select Fan_ID from `Fan` where  `Username` = '$username'");
$result = mysqli_fetch_assoc($result);
$user_id = $result["Fan_ID"];


$result = mysqli_query($con, "select * from `Creates` where `Fan_ID` = $user_id limit 1");
$rowcount = mysqli_num_rows($result);


if($rowcount == 0){
    $response["invalid"] = "You cannot add Fans to a League that have not created a Watchlist.";
} else {
    $result = mysqli_fetch_assoc($result);
    $watchlist_id = $result["Watchlist_ID"];
    mysqli_query($con, "INSERT INTO `EnteredIn`(`League_ID`, `Watchlist_ID`) VALUES ($league_id,$watchlist_id)");
    $response["valid"] = $username.(" has been succesfully entered in a league.");
}

$JSONStringResults = json_encode($response);
echo $JSONStringResults;

?>