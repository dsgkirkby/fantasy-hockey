<!DOCTYPE html>
<html>
    <?php
        require_once('../library/league.php');
	// Redirect to main if leagueID not set
	if (empty($_GET["leagueID"])) {
	    header('Location: main.php', true, 303);
	    die();
	}
        $league = new league($_GET["leagueID"]);
    ?>
    <head>
        <meta charset="UTF-8">
        <title>League View</title>
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
                    <a class="navbar-brand" href="">Dobber Fantasy</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="">Home</a></li>
                        <li><a href="">Rankings</a></li>
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">My Teams<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="">Action</a></li>
                                <li><a href="">Another action</a></li>
                                <li><a href="">Something else here</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Nav header</li>
                                <li><a href="">Separated link</a></li>
                                <li><a href="">One more separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                            echo "<li><a href=\"editLeague.php?leagueID=" . $_GET["leagueID"] . "\">Manage League</a></li>"
                        ?>
                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </nav>
        <div class="container">
            <table class="table table-bordered">
                <tr>
                    <th>Place</th>
                    <th>Team Name</th>
                    <th>Owner Name</th>
                    <th>Score</th>
		    <th></th>
                </tr>
            <?php
                $teams = $league->getTeams();
                $place = 1;
                foreach($teams as $team) {
                    echo "<tr>"
                        . "<td>" . $place . "</td>"
                        . "<td>" . $team->teamName . "</td>"
                        . "<td>" . $team->ownerName . "</td>"
                        . "<td>" . $team->score . "</td>"
			. "<td><a href='viewTeam.php?teamID=" . $team->id . "'>View</a></td>"
                        . "</tr>";
                    $place++;
                }
            ?>
            </table>
        </di>
    </body>
</html>
