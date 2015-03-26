<?php

$playerID = $_GET["playerID"];
$name = $_GET["teamName"];
$hometown = $_GET["season"];
$height = $_GET["height"];
$weight = $_GET["weight"];
$dob = $_GET["dob"];

$con = conn::getDB();
$query = "UPDATE players SET "
        . "playerID=" .$playerID .","
        . "teamName=" .$teamName .","
        . "season=" .$season .","
        . "height=" .$height .","
        . "weight=" .$weight .","
        . "dob=" .$dob;
        . "WHERE playerID=" . $playerID;
echo $query;
$result = mysqli_query($con, $query);

header("location: ../web/viewPlayers.php"
        . ($result ? "" : "?error=true"), true, 303);


