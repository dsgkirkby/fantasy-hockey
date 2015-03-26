<?php

$playerID = $_GET["playerID"];
$name = $_GET["teamName"];
$hometown = $_GET["season"];
$height = $_GET["height"];
$weight = $_GET["weight"];
$dob = $_GET["dob"];
$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}
//set the default client character set 
mysqli_set_charset($con, 'utf-8');
mysqli_select_db($con, "dobber");

$query = "UPDATE plays_for SET "
        . "gamesPlayed=" . $gp . ","
        . "goals=" . $goals . ","
        . "hits=" . $hits . ","
        . "giveaways=" . $ga . ","
        . "takeaways=" . $ta . ","
        . "penalties_drawn=" . $pd . ","
        . "sacorsi=" . $sac . ","
        . "qot=" . $qot . ","
        . "qoc=" . $qoc . ","
        . "ozs=" . $ozs . ","
        . "toi=" . $toi . " "
        . "WHERE playerID=" . $playerID . " "
        . "and teamName=\"" . $teamName . "\" "
        . "and season=" . $season;
echo $query;
$result = mysqli_query($con, $query);

header("location: ../web/viewSeasonStats.php"
        . ($result ? "" : "?error=true"), true, 303);


