<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
    require_once('../library/user.php');
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Users View</title>
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
                        <li class="active"><a href="">Home</a></li>
                        <li><a href="">Rankings</a></li>
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
            if (!empty($_GET["username"])) {
                echo "<table class=\"table table-bordered\">
                <tr>
                    <th>League Name</th>
                    <th>Date Created</th>
                </tr>";
                $user = new user(filter_input(INPUT_GET, "username"));
                $myLeagues = $user->myLeagues();
                while ($league = $myLeagues->fetch_array(MYSQLI_ASSOC)) {
                    echo "<tr>"
                    . "<td>" . $league["name"] . "</td>"
                    . "<td>" . $league["date_created"] . "</td>"
                    . "</tr>";
                }
            } else {
                echo "<form class = \"form-horizontal\" action=\"viewleague.php\" method=\"get\">
                    <fieldset>

                    <!--Form Name -->
                    <legend>Enter Your Username</legend>

                    <!--Text input-->
                    <div class = \"form-group\">
                    <label class = \"col-md-4 control-label\" for = \"username\">Username</label>
                    <div class = \"col-md-4\">
                    <input id = \username\" name = \"username\" placeholder = \"\" class = \"form-control input-md\" required = \"\" type = \"text\">

                    </div>
                    </div>

                    <!--Button -->
                    <div class = \"form-group\">
                    <label class = \"col-md-4 control-label\" for = \"submit\"></label>
                    <div class = \"col-md-4\">
                    <button id = \"submit\" name = \"submit\" class = \"btn btn-primary\" formaction=\"viewMyLeagues.php\">Submit</button>
                    </div>
                    </div>

                    </fieldset>
                    </form>";
            }
            ?>
        </table>
</body>
</html>
