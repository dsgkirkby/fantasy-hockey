<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
	<?php
	session_start();
	require_once('../library/user.php');
	require_once('../library/userVerification.php');
	require_once('../library/conn.php');
	dieIfNotAdmin();
	?>
	<head>
		<meta charset="UTF-8">
		<title>Users View</title>
		<script src="jquery-2.1.3.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="editUser.js"></script>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="createButton.css">
	</head>
	<body>
	<div class="modal fade" id="createModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Create User</h4>
					</div>
					<form action="../controllers/createUser.php">
						<div class="modal-body">

							<div class="form-group">
								<label for="username">Username</label>
								<input id="username" type="text" name="username" class="form-control">

								<label for="password">Password</label>
								<input id="password" type="text" name="password" class="form-control">

								<label for="email">Email</label>
								<input id="email" type="text" name="email" class="form-control">

								<label for="is_admin">Admin</label>
								<select id="is_admin" name="is_admin" class="form-control">
									<option value="true">Yes</option>
									<option value="false">No</option>
								</select>
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
		<h4 class="modal-title">Edit User</h4>
		  </div>
		<form action="../controllers/editUser.php">
		<div class="modal-body">
			<div class="form-group">

			<input id="username" type="hidden" name="username" class="form-control">			

			<label for="password">Password</label>
			<input id="password" type="text" name="password" class="form-control">

			<label for="email">Email</label>
			<input id="email" type="email" name="email" class="form-control">

			<label for="is_admin">Administrator</label>
			<select id="is_admin" name="is_admin" class="form-control">
				<option value="true">Yes</option>
				<option value="false">No</option>
			</select>
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
						<li><a href="viewPlayers.php">Players</a></li>
						<li class="active"><a href="admin.php">Admin Tools</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
			<li><a href="logout.php">Logout</a></li>
			</ul>
				</div><!--/.nav-collapse -->
			</div><!--/.container-fluid -->
		</nav>
		<div class="container">
		<h2>All Users<a data-toggle="modal" data-target="#createModal" id="createButton" class="btn btn-primary">Create User</a></h2>
			<table class="table table-bordered">
				<tr>
				<th>Username</th>
				<th>Password</th>
				<th>Email Address</th>
				<th>Administrator</th>
				<th>Action</th>
				</tr>
				<?php
				if (!empty($_GET["error"])) {
					$displayWarning = $_GET["error"];
				} else {
					$displayWarning = false;
				}
				
				if ($displayWarning) {
					echo "<div class=\"alert alert-danger\" role=\"alert\">"
					. "<b>User View Failed.</b>"
					. " Please try again or contact an administrator</div>";
				}
				$users = user::getUsers();
				foreach($users as $user) {
					echo "<tr>"
					. "<td><a href=\"viewLeagues.php?username=" . $user["username"] . "\">" . $user["username"] . "</a></td>"
					. "<td>" . $user["password"] . "</td>"
					. "<td>" . $user["email"] . "</td>"
					. "<td>" . ($user["is_admin"] ? "Yes" : "No") . "</td>"
					. "<td><a class=\"btn btn-primary btn-xs\" href=\"\" onclick='startEdit(\"" 
						. $user["username"] . "\",\""
						. $user["password"] . "\",\"" 
						. $user["email"] . "\"," 
						. $user["is_admin"]
					.  ")' data-toggle=\"modal\" data-target=\"#editModal\">Edit</a>"
					. " <a href='' class=\"btn btn-warning btn-xs\" onclick=deleteUser(\"" 
						. $user["username"] . "\")>Delete</a></td>"
					. "</tr>";
				}
				?>
			</table>
	</body>
</html>
