<!DOCTYPE html>
<html>
    <?php
	session_start();
        require_once('../library/league.php');
	require_once('../library/userVerification.php');
	// Redirect to login screen if user is not logged in
	dieIfNoUser();
	// Redirect to main if leagueID not set
	if (empty($_GET["leagueID"])) {
	    header('Location: main.php', true, 303);
	    die();
	}
        $league = new league($_GET["leagueID"]);
	$userIsManager = userIsManagerOfLeague($league->getLeagueId());
    ?>
    <head>
        <meta charset="UTF-8">
        <title>League View</title>
        <script src="jquery-2.1.3.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<?php if ($userIsManager) { echo "<script src='editLeague.js'></script>"; } ?>
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
                        <li><a href="main.php">Home</a></li>
			<li class="active"><a href="viewLeagues.php">Leagues</a></li>
			<?php
			    if (userIsAdmin()) {
				echo "<li><a href=\"admin.php\">Admin Tools</a></li>";
			    }
			?>
                    </ul>
		    <ul class="nav navbar-nav navbar-right">
			<li><a href="logout.php">Logout</a></li>
		    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
	    <h2><?php echo $league->name; ?></h2>
            <table class="table table-bordered">
                <tr>
                    <th>Place</th>
                    <th>Team Name</th>
                    <th>Owner Name</th>
		    <th>Goals</th>
		    <th>Assists</th>
                    <th>Score</th>
		    <th>View</th>
		    <?php if ($userIsManager) { echo "<th>Delete</th>"; } ?>
                </tr>
            <?php
                $teams = $league->getTeams();
		usort($teams, "team::compareTeamScore");
                foreach($teams as $place => $team) {
                    echo "<tr>"
			. "<td>" . ($place + 1) . "</td>"
			. "<td>" . $team->teamName . "</td>"
			. "<td>" . $team->ownerName . "</td>"
			. "<td>" . $team->goals . "</td>"
			. "<td>" . $team->assists . "</td>"
			. "<td>" . $team->getScore() . "</td>"
			. "<td><a href='viewTeam.php?teamID=" . $team->id . "'>View</a></td>"
			. ($userIsManager ? "<td><a href='' onclick=deleteTeam(" . $team->id . ")>Delete</a></td>" : "")
			. "</tr>";
                }
            ?>
            </table>
        </di>
    </body>
</html>
