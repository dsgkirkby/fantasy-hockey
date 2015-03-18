<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
	session_start();
        require_once('../library/league.php');
	require_once('../library/userVerification.php');
	require_once('../library/user.php');
	// Redirect to login screen if user is not logged in
	dieIfNoUser();
    ?>
    <head>
        <title>Home</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="jquery-2.1.3.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    </head>
    <body>
	<nav class="navbar navbar-default">
	    <div class="container-fluid">
		<div class="navbar-header">
		    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		    </button>
		    <a class="navbar-brand">Dobber Fantasy</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
		    <ul class="nav navbar-nav">
			<li class="active"><a href="">Home</a></li>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
			<li><a href="logout.php">Logout</a></li>
		    </ul>
		</div><!--/.nav-collapse -->
	    </div><!--/.container-fluid -->
	</nav>
	<div class="col-md-6">
	    <?php
		$uname = $_SESSION["username"];
		echo "<h3>Your Leagues</h3><table class=\"table table-bordered\">
		<tr>
		    <th>Team Name</th>
		    <th>Score</th>
		    <th>Place</th>
		    <th>League Name</th>
		</tr>";
		$user = new user($uname);
		foreach ($user->myLeagues() as $league) {
		    foreach ($league->getTeams() as $place => $team) {
			if ($team->ownerName == $_SESSION["username"]) {
			    $userTeam = $team;
			    $userRank = $place + 1;
			    break;
			}
		    }
		    echo "<tr>"
		    . "<td>" . $userTeam->teamName . "</td>"
		    . "<td>" . $userTeam->getScore() . "</td>"
		    . "<td>" . $userRank . "</td>"
		    . "<td><a href=\"viewleague.php?leagueID="
		    . $league->getLeagueID() . "\">" . $league->name . "</a></td>"
		    . "</tr>";
		}
	    ?>
	</div>
	<div class="col-md-6">
	</div>
    </body>
</html>
