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
	?>
	<head>
		<meta charset="UTF-8">
		<title>Dobber Leagues</title>
		<script src="jquery-2.1.3.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="createButton.css">
	</head>
	<body>
		<div class="modal fade" id="createModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Create League</h4>
					</div>
					<form action="../controllers/createLeague.php">
						<div class="modal-body">

							<div class="form-group">
								<label for="leagueName">League Name</label>
								<input id="leagueName" type="text" name="leagueName" class="form-control">

								<label for="maxSize">Max Size</label>
								<input id="maxSize" type="number" name="maxSize" class="form-control">
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<input type="submit" value="Create" class="btn btn-primary">
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
						<?php
						if (userIsAdmin()) {
							echo "<li><a href=\"admin.php\">Admin Tools</a></li>";
						}
						?>
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
				. "<b>League Creation Failed.</b>"
				. " Please try again or contact an administrator</div>";
			}
			$leagues = array();
			if (!empty($_GET["username"])) {
				$uname = filter_input(INPUT_GET, "username");
				echo "<h3>" . $uname . "'s Leagues</h3>";
				$user = new user($uname);
				$leagues = $user->myLeagues();
			} else {
				$con = mysqli_connect("localhost", "root", "");
				if (!$con) {
					exit('Connect Error (' . mysqli_connect_errno() . ') '
							. mysqli_connect_error());
				}
				//set the default client character set 
				mysqli_set_charset($con, 'utf-8');
				if (mysqli_select_db($con, "dobber") == FALSE) {
					exit('DB select failed!');
				}
				$query = "SELECT leagueID FROM f_leagues";
				$temp_leagues = mysqli_query($con, $query);
				foreach ($temp_leagues as $temp_league) {
					array_push($leagues, new league($temp_league["leagueID"]));
				}

				echo "<h2>All Leagues<a data-toggle=\"modal\" data-target=\"#createModal\" id=\"createButton\""
				. " class=\"btn btn-primary\">Create League</a></h2>";
			}

			echo "<table class=\"table table-bordered\">"
			. "<tr>"
			. "<th>Team Name</th>"
			. "<th>Date Created</th>"
			. "<th>Managers</th>"
			. (userIsAdmin() ? "<th>Action</th>" : "")
			. "</tr>";

			foreach ($leagues as $league) {
				echo "<tr>"
				. "<td><a href = \"viewleague.php?leagueID=" . $league->getLeagueID() . "\">" . $league->name . "</a></td>"
				. "<td>" . $league->dateCreated . "</td>"
				. "<td>";
				foreach ($league->getManagers() as $manager) {
					echo $manager->getUsername() . "</br>";
				}
				echo"</td>"
				. (userIsAdmin() ? "<td><a href='' onclick=deleteLeague(" . $league->getLeagueID() . ")>Delete</a></td>" : "")
				. "</tr>";
			}

			echo "</table>";
			?>
		</div>
		<?php
		if (userIsAdmin()) {
			echo "<script src='editLeague.js'></script>";
		}
		?>
	</body>
</html>
