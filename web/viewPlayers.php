<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
	<?php
	session_start();
	require_once('../library/players.php');
	require_once('../library/userVerification.php');
	require_once('../library/user.php');
	require_once('../library/conn.php');
	?>
	<head>
		<meta charset="UTF-8">
		<title>Dobber Players</title>
		<script src="jquery-2.1.3.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="editPlayer.js"></script>
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
					<form action="../controllers/createLeague.php">
						<div class="modal-body">

							<div class="form-group">
							name
							hometown
							height
							weight
							dob
								<label for="name">Name</label>
								<input id="name" type="text" name="name" class="form-control">
								<label for="hometown">Hometown</label>
								<input id="hometown" type="text" name="hometown" class="form-control">
								<label for="height">Height</label>
								<input id="height" type="text" name="height" class="form-control">
								<label for="weight">Wight</label>
								<input id="weight" type="text" name="weight" class="form-control">
								<label for="dob">dob</label>
								<input id="dob" type="text" name="dob" class="form-control">

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
	<div class="modal fade" id="editModal">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Edit PLayer</h4>
		  </div>
		<form action="../controllers/editPlayer.php">
		  <div class="modal-body">
		  
			  <div class="form-group">

			  <input id="playerID" type="hidden" name="playerID" class="form-control">
			  
			  <label for="name">Name</label>
			  <input id="name" type="text" name="name" class="form-control">
			  
			  <label for="hometown">Hometown</label>
			  <input id="hometown" type="hometown" name="hometown" class="form-control">

			  <label for="height">Height</label>
			  <input id="height" type="height" name="height" class="form-control">

			  <label for="weight">Weight</label>
			  <input id="weight" type="weight" name="weight" class="form-control">

			  <label for="dob">D.O.B.</label>
			  <input id="dob" type="dob" name="dob" class="form-control">
			  
			  </div>
		  
		  </div>
		  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<input type="submit" value="Save Changes" class="btn btn-primary">
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
						<li><a href="viewLeagues.php">Leagues</a></li>
						<li class="active"><a href="viewPlayers.php">Players</a></li>
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
			. "<b>Player View Failed.</b>"
			. " Please try again or contact an administrator</div>";
		}
		$players = array();
		if (!empty($_GET["username"])) {
			$uname = filter_input(INPUT_GET, "username");
			echo "<h3>Players</h3>";
			$user = new user($uname);
		} else {
			if (userIsAdmin()){
				echo "<a id=\"createButton\" class=\"btn btn-primary\">Add Player</a>";
			}
			$order="playerID";
			if (!empty($_GET["order"])) {
			  switch ($_GET["order"]) {
				case 'name':
				case 'hometown':
				case 'height':
				case 'weight':
				case 'dob':
				  $order=$_GET["order"];
				  break;
				default:
				  $order="playerID";
				  break;
			  }
			}
			$con = conn::getDB();
			$query = "SELECT * FROM players ORDER BY " . $order;
			$temp_players = mysqli_query($con, $query);
			foreach ($temp_players as $temp_player) {
				 array_push($players, new players($temp_player["playerID"]));
			}
			
			echo "<h2>Player Overview<a data-toggle=\"modal\" data-target=\"#createModal\" </a></h2>";
		}
		echo "<table class=\"table table-bordered\">
		<tr>
		<th><a href=\"viewPlayers.php?order=name\"> Name </a></th>
		<th><a href=\"viewPlayers.php?order=hometown\"> Hometown </a></th>
		<th><a href=\"viewPlayers.php?order=height\"> Height </a></th>
		<th><a href=\"viewPlayers.php?order=weight\"> Weight </a></th>
		<th><a href=\"viewPlayers.php?order=dob\"> D.O.B </a></th>"
		. (userIsAdmin() ? "<th>Action</th>" : "")
		. "</tr>";
		
		foreach($players as $player) {
			echo "<tr>"
			. "<td>" . $player->getName() . "</td>"
			. "<td>" . $player->getHometown() . "</td>"
			. "<td>" . $player->getHeight() . " cm</td>"
			. "<td>" . $player->getWeight() . " kg</td>"
			. "<td>" . $player->getDob() . "</td>"
			. (userIsAdmin() ? "<td><a class=\"btn btn-primary btn-xs\" href=\"\" onclick='startEdit(\"" 
				. $player->getPlayerId() . "\",\"" 
				. $player->getName() . "\",\"" 
				. $player->getHometown() . "\"," 
				. $player->getHeight() . "," 
				. $player->getWeight() . ",\"" 
				. $player->getDob() 
			.  "\")' data-toggle=\"modal\" data-target=\"#editModal\">Edit</a>"
			. " <a href='' class=\"btn btn-warning btn-xs\" onclick=deletePlayer(\"" . $player->getPlayerId() . "\")>Delete</a></td>" : "")
			. "</tr>";
		}
		
		?>
		</table>
	</div>
	</body>
</html>
