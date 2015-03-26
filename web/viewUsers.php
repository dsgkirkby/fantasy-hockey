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
	dieIfNotAdmin();
	?>
	<head>
		<meta charset="UTF-8">
		<title>Users View</title>
		<script src="jquery-2.1.3.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="editUser.js"></script>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	</head>
	<body>
	<div class="modal fade" id="editModal">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Edit User</h4>
		  </div>
		<form action="editUser.php">
		  <div class="modal-body">
		  
			  <div class="form-group">
			  <label for="username">Username</label>
			  <input id="username" type="text" name="username" class="form-control">
			  
			  <label for="password">Password</label>
			  <input id="password" type="text" name="password" class="form-control">
			  
			  <label for="email">Email</label>
			  <input id="email" type="email" name="email" class="form-control">
			  
			  <label for="admin">Administrator</label>
			  <select id="admin" name="admin" class="form-control">
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
		<h2>All Users</h2>
			<table class="table table-bordered">
				<tr>
					<th>Username</th>
					<th>Password</th>
					<th>Email Address</th>
			<th>Administrator</th>
			<th>Edit</th>
			<th>Delete</th>
				</tr>
				<?php
				$users = user::getUsers();
				foreach($users as $user) {
					echo "<tr>"
					. "<td><a href=\"viewLeagues.php?username=" . $user["username"] . "\">" . $user["username"] . "</a></td>"
					. "<td>" . $user["password"] . "</td>"
					. "<td>" . $user["email"] . "</td>"
					. "<td>" . ($user["is_admin"] ? "Yes" : "No") . "</td>"
					. "<td><a href=\"\" onclick=startEdit(\"" 
						. $user["username"] . "\",\"" 
						. $user["password"] . "\",\"" 
						. $user["email"] . "\"," 
						. $user["is_admin"] 
						. ") data-toggle=\"modal\" data-target=\"#editModal\">Edit</a></td>"
					. "<td><a href=\"\" onclick=deleteUser(\"" . $user["username"] . "\")>Delete</a></td>"
					. "</tr>";
				}
				?>
			</table>
	</body>
</html>
