<!DOCTYPE html>
<html>
	<?php
	session_start();
	require_once('../library/userVerification.php');
	require_once('../library/playerRecord.php');
	require_once('../library/team.php');
	require_once('../library/team.php');
	require_once('../library/conn.php');
	// Redirect to login screen if user is not logged in
	dieIfNoUser();

	// Redirect to main if leagueID or teamID not set
	if (empty($_GET["teamID"])) {
		header('Location: main.php', true, 303);
		die();
	}
	
	$con = conn::getDB();
	$rosterConstruct = "SELECT * from players NATURAL JOIN player_assignments "
	. "NATURAL JOIN plays_for WHERE player_assignments.teamID = ". $_GET["teamID"];
	
	$roster = mysqli_fetch_assoc(mysqli_query($con, $rosterConstruct));

	$teamsQuery =  "SELECT * FROM f_teams where teamID=". $_GET["teamID"];

	$team = mysqli_fetch_assoc(mysqli_query($con, $teamsQuery));

	?>
	<head>
		<title>Dobber Team View</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="jquery-2.1.3.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="editPlaysFor.js"></script>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="createButton.css">
	</head>
	<body>
		<div class="modal fade" id="createModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Add Player</h4>
					</div>
					<form action="../controllers/addPlayer.php">
						<div class="modal-body">
							<div class="form-group">
								<input type="hidden" name="teamID" value="<?php echo $team["teamID"]; ?>">
								
								<label for="playerID">Player</label>
								<select id="playerID" type="text" name="playerID" class="form-control">
									<?php
									$con2 = conn::getDB();
									$ownedInLeagueQuery = 
									"SELECT name, playerID FROM players p "
									. "WHERE NOT EXISTS (Select * from
										player_assignments pa2 natural join f_teams
										where pa2.playerID=p.playerID AND f_Teams.leagueID=" . $team["leagueID"] . ")";
									$ownedInLeague = mysqli_query($con, $ownedInLeagueQuery);
									if (!$ownedInLeague) {
										echo "<option>No players available in your league</option>";
									} else {
										foreach ($ownedInLeague as $player) {
											echo "<option value=" . $player["playerID"] . ">" . $player["name"] . "</option>";
										}
									}
									?>
								</select>

							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<input type="submit" value="Add" class="btn btn-primary">
						</div>
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

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
			<li><a href="viewPlayers.php">Players</a></li>
						<li><a href="admin.php">Admin Tools</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div><!--/.container-fluid -->
		</nav>
		<div class="container">
			<?php
			if (!empty($_GET["error"])) {
				$displayWarning = $_GET["error"];
			} else {
				$displayWarning = false;
			}

			if ($displayWarning) {
				echo "<div class=\"alert alert-danger\" role=\"alert\">"
				. "<b>Record Creation Failed.</b>"
				. " Please verify a record with that <b>Player</b>, <b>Team</b>,"
				. " and <b>Season</b> does not already exist, and try again.</div>";
			}
			?>
			<h2>
				<?php echo $team["name"];
				if($team["username"] == getUsername()) {
					echo "<a data-toggle=\"modal\" data-target=\"#createModal\""
					. " id=\"createButton\" class=\"btn btn-primary\">Add Player</a>";
				}
				?>
			</h2>
			<table class="table table-bordered">
				<thead>
				<th>Player</th>
				<th>Team</th>
				<th>Games</th>
				<th>Goals</th>
				<th>Hits</th>
				<th>Giveaways</th>
				<th>Takeaways</th>
				<th>Pen. Drawn</th>
				<th>SA Corsi</th>
				<th>QOT</th>
				<th>QOC</th>
				<th>OZS%</th>
				<th>TOI</th>
				<th>Action</th>
				</thead>


				<?php
				foreach (playerRecord::getAllRecords() as $pr) {
					if (in_array($pr->player,$roster)){
						echo "<tr>"
						. "<td>" . $pr->player . "</td>"
						. "<td>" . $pr->team . "</td>"
						. "<td>" . $pr->gamesPlayed . "</td>"
						. "<td>" . $pr->goals . "</td>"
						. "<td>" . $pr->hits . "</td>"
						. "<td>" . $pr->giveaways . "</td>"
						. "<td>" . $pr->takeaways . "</td>"
						. "<td>" . $pr->penalties_drawn . "</td>"
						. "<td>" . $pr->sacorsi . "</td>"
						. "<td>" . $pr->qot . "</td>"
						. "<td>" . $pr->qoc . "</td>"
						. "<td>" . $pr->ozs . "</td>"
						. "<td>" . $pr->toi . "</td>"
						. "<td><a href=\"../controllers/dropPlayer.php?"
						. "playerID=" . $pr->playerID 
						. "&teamID=" . $team["teamID"]
						. "\" id=\"removePFButton\" class=\"btn "
						. "btn-primary btn-xs btn-warning\">Drop</a></td></td>"
						. "</tr>";
					}
				}
				?>
			</table>
		</div>
	</body>
</html>
