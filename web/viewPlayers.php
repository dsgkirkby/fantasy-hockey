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
    require_once('../library/users.php');
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Dobber Players</title>
        <script src="jquery-2.1.3.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="createButton.css">
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
            echo "<h3>Players:</h3>";
            $user = new user($uname);
        } else {
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
            $con = mysqli_connect("localhost", "root", "");
            if (!$con) {
                exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
            }
            //set the default client character set 
            mysqli_set_charset($con, 'utf-8');
            if (mysqli_select_db($con, "dobber") == FALSE) {
                exit('DB select failed!');
            }
            $query = "SELECT * FROM players ORDER BY " . $order;
            $temp_players = mysqli_query($con, $query);
            foreach ($temp_players as $temp_player) {
                 array_push($players, new players($temp_player["playerID"]));
            }
            
            echo "<h2>Player Overview<a data-toggle=\"modal\" data-target=\"#createModal\" id=\"createButton\""
            . " class=\"btn btn-primary\">Filter (todo)</a></h2>";
        }
        echo "<table class=\"table table-bordered\">
        <tr>
        <th><a href=\"viewPlayers.php?order=name\"> Name </a></th>
        <th><a href=\"viewPlayers.php?order=hometown\"> Hometown </a></th>
        <th><a href=\"viewPlayers.php?order=height\"> Height </a></th>
        <th><a href=\"viewPlayers.php?order=weight\"> Weight </a></th>
        <th><a href=\"viewPlayers.php?order=dob\"> D.O.B </a></th>
        </tr>";
        
        foreach($players as $player) {
            echo "<tr>"
            . "<td>" . $player->getName() . "</td>"
            . "<td>" . $player->getHometown() . "</td>"
            . "<td>" . $player->getHeight() . "</td>"
            . "<td>" . $player->getWeight() . "</td>"
            . "<td>" . $player->getDob() . "</td>"
            . "</tr>";
        }
        
        echo "</table>";
        ?>
    </div>
    </body>
</html>
