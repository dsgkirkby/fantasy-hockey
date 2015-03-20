<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
	session_start();
	require_once('../library/users.php');
	require_once('../library/userVerification.php');
	dieIfNotAdmin();
	$users = new users();
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
                        <li><a href="main.php">Home</a></li>
                        <li><a href="viewLeagues.php">Leagues</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">

                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </nav>
        <div class="container">
	    <h3>All Users</h3>
            <table class="table table-bordered">
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email Address</th>
		    <th>Edit</th>
		    <th>Delete</th>
                </tr>
                <?php
                $usersData = $users->getUsers();
                while ($user = $usersData->fetch_array(MYSQLI_ASSOC)) {
                    echo "<tr>"
                    . "<td><a href=\"viewLeagues.php?username=" . $user["username"] . "\">" . $user["username"] . "</a></td>"
                    . "<td>" . $user["password"] . "</td>"
                    . "<td>" . $user["email"] . "</td>"
                    . "<td><a href=\"\">Edit</a></td>"
		    . "<td><a href=\"\" onclick=deleteUser(\"" . $user["username"] . "\")>Delete</a></td>"
		    . "</tr>";
                }
                ?>
            </table>
    </body>
</html>
