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
                        <li class="active"><a href="viewLeagues.php">Leagues</a></li>
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

                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </nav>
        <div class="container">
            <?php
		$leagues = array();
		if (!empty($_GET["username"])) {
		    $uname = filter_input(INPUT_GET, "username");
		    echo "<h3>" . $uname . "'s Leagues</h3>";
		    $user = new user($uname);
		    $leagues = $user->myLeagues();
		} else if (userIsAdmin()) {
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
		    
		    echo "<h3>All Leagues</h3>";
		}
		
		echo "<table class=\"table table-bordered\">
		<tr>
		    <th>Team Name</th>
		    <th>Date Created</th>
		</tr>";
		
		foreach($leagues as $league) {
		    echo "<tr>"
		    . "<td><a href=\"viewLeague.php?leagueID="
		    . $league->getLeagueID() . "\">" . $league->name . "</a></td>"
		    . "<td>" . $league->dateCreated . "</td>"
		    . "</tr>";
		}
		
		echo "</table>";
            ?>
        </table>
</body>
</html>
