<?php

$playerID = $_GET["playerID"];
$teamName = $_GET["teamName"];
$season = $_GET["season"];
$gp = $_GET["gp"];
$hits = $_GET["hits"];
$ga = $_GET["ga"];
$ta = $_GET["ta"];
$pd = $_GET["pd"];
$sac = $_GET["sac"];
$qot = $_GET["qot"];
$qoc = $_GET["qoc"];
$ozs = $_GET["ozs"];
$toi = $_GET["toi"];
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


