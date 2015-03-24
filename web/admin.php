<!DOCTYPE html>
<html>
    <?php
	session_start();
	require_once('../library/userVerification.php');
	// Redirect to login screen if user is not logged in
	if (!userIsAdmin()) {
	    header('Location: main.php', true, 303);
	    die();
	}
    ?>
    <head>
        <title>Dobber Admin Tools</title>
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
			<li><a href="main.php">Home</a></li>
			<li><a href="viewLeagues.php">Leagues</a></li>
			<li class="active"><a href=\"admin.php\">Admin Tools</a></li>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
			<li><a href="logout.php">Logout</a></li>
		    </ul>
		</div><!--/.nav-collapse -->
	    </div><!--/.container-fluid -->
	</nav>
	<div class="container">
	    <h3>Admin Tools</h3>
	    <h3><a href="viewLeagues.php">View All Leagues</a></h3>
	    <h3><a href="viewUsers.php">View All Users</a></h3>
    </body>
</html>
