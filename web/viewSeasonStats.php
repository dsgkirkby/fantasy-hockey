<!DOCTYPE html>
<html>
    <?php
    session_start();
    require_once('../library/userVerification.php');
    require_once('../library/playerRecord.php');
    // Redirect to login screen if user is not logged in
    if (!userIsAdmin()) {
        header('Location: main.php', true, 303);
        die();
    }
    ?>
    <head>
        <title>Dobber Player Statistics</title>
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
                        <h4 class="modal-title">Create Player Record</h4>
                    </div>
                    <form action="../controllers/createPlaysFor.php">
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="playerID">Player</label>
                                <select id="playerID" type="text" name="playerID" class="form-control">
                                    <?php
                                    foreach (playerRecord::getAllPlayers() as $player) {
                                        echo "<option value=" . $player["playerID"] . ">" . $player["name"] . "</option>";
                                    }
                                    ?>
                                </select>

                                <label for="teamName">Team</label>
                                <select id="teamName" type="text" name="teamName" class="form-control">
                                    <?php
                                    foreach (playerRecord::getNHLTeams() as $team) {
                                        echo "<option>" . $team["name"] . "</option>";
                                    }
                                    ?>
                                </select>

                                <label for="season">Season</label>
                                <select id="season" name="season" class="form-control">
                                    <?php
                                    foreach (playerRecord::getSeasons() as $season) {
                                        echo "<option>" . $season["season"] . "</option>";
                                    }
                                    ?>
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
                        <h4 class="modal-title" id="edit-modal-title"></h4><!--This gets filled in JS-->
                    </div>
                    <form action="../controllers/editPlaysFor.php">
                        <div class="modal-body">

                            <div class="form-group">
                                <table>
                                    <tr>
                                        <td>
                                            <div id="contentBox" style="margin:0px auto; width:100%">

                                                <div id="column1" style="float:left; margin:2px; width:49%;">
                                                    <label for="gp">Games Played</label>
                                                    <input id="gp" type="number" name="gp" class="form-control">
                                                    <label for="hits">Hits</label>
                                                    <input id="hits" type="number" name="hits" class="form-control">
                                                    <label for="ta">Takeaways</label>
                                                    <input id="ta" type="number" name="ta" class="form-control">
                                                    <label for="sac">SA Corsi</label>
                                                    <input id="sac" type="number" name="sac" class="form-control" step="any">
                                                    <label for="qoc">QOC</label>
                                                    <input id="qoc" type="number" name="qoc" class="form-control" step="any">
                                                    <label for="toi">TOI</label>
                                                    <input id="toi" type="number" name="toi" class="form-control">
                                                </div>

                                                <div id="column2" style="float:right; margin:2px;width:45%;">
                                                    <label for="goals">Goals</label>
                                                    <input id="goals" type="number" name="goals" class="form-control">
                                                    <label for="ga">Giveaways</label>
                                                    <input id="ga" type="number" name="ga" class="form-control">
                                                    <label for="pd">Penalties Drawn</label>
                                                    <input id="pd" type="number" name="pd" class="form-control">
                                                    <label for="qot">QOT</label>
                                                    <input id="qot" type="number" name="qot" class="form-control" step="any">
                                                    <label for="ozs">OZS</label>
                                                    <input id="ozs" type="number" name="ozs" class="form-control" step="any">
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                </table>
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
                        <li class="active"><a href=\"admin.php\">Admin Tools</a></li>
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
            <h2>Player Statistics<a data-toggle="modal" data-target="#createModal" id="createButton" class="btn btn-primary">Create Record</a></h2>
            <table class="table table-bordered">
                <thead>
                <th>Player</th>
                <th>Team</th>
                <th>Season</th>
                <th>Games Played</th>
                <th>Goals</th>
                <th>Hits</th>
                <th>Giveaways</th>
                <th>Takeaways</th>
                <th>Penalties Drawn</th>
                <th>SA Corsi</th>
                <th>QOT</th>
                <th>QOC</th>
                <th>OZS%</th>
                <th>TOI</th>
                <th>Action</th>
                </thead>


                <?php
                foreach (playerRecord::getAllRecords() as $pr) {
                    echo "<tr>"
                    . "<td>" . $pr->player . "</td>"
                    . "<td>" . $pr->team . "</td>"
                    . "<td>" . $pr->season . "</td>"
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
                    . "<td><a data-toggle=\"modal\" data-target=\"#editModal\""
                    . " data-pid=\"" . $pr->playerID . "\""
                    . " data-gp=\"" . $pr->gamesPlayed . "\""
                    . " data-goals=\"" . $pr->goals . "\""
                    . " data-hits=\"" . $pr->hits . "\""
                    . " data-ga=\"" . $pr->giveaways . "\""
                    . " data-ta=\"" . $pr->takeaways . "\""
                    . " data-pd=\"" . $pr->penalties_drawn . "\""
                    . " data-sac=\"" . $pr->sacorsi . "\""
                    . " data-qot=\"" . $pr->qot . "\""
                    . " data-qoc=\"" . $pr->qoc . "\""
                    . " data-ozs=\"" . $pr->ozs . "\""
                    . " data-toi=\"" . $pr->toi . "\""
                    . " data-player=\"" . $pr->player . "\""
                    . " data-team=\"" . $pr->team . "\""
                    . " data-season=\"" . $pr->season . "\""
                    . " id=\"editPFButton\" class=\"editPlaysFor btn "
                    . "btn-primary\">Edit</a></td>"
                    . "</tr>";
                }
                ?>
            </table>
        </div>
    </body>
</html>
