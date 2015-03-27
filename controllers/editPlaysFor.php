<?php

require_once('../library/conn.php');

$playerID = $_GET["playerID"];
$teamName = $_GET["teamName"];
$season = $_GET["season"];
$gp = $_GET["gp"];
$goals = $_GET["goals"];
$hits = $_GET["hits"];
$ga = $_GET["ga"];
$ta = $_GET["ta"];
$pd = $_GET["pd"];
$sac = $_GET["sac"];
$qot = $_GET["qot"];
$qoc = $_GET["qoc"];
$ozs = $_GET["ozs"];
$toi = $_GET["toi"];
$con = conn::getDB();

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


