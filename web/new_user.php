<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
        require_once('../library/users.php');
    ?>
    <head>
        <meta charset="UTF-8">
        <title>New User</title>
        <script src="jquery-2.1.3.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="js/bootstrap.min.js"></script>

            <form class="form-horizontal" method="post">
                <fieldset>
                    <div class="jumbotron">
                    <!-- Form Name -->
                    <h2>Register</h2>
                </div>

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="uname">Username</label>
                        <div class="controls">
                            <input id="uname" name="uname" type="text" placeholder="" class="input-xlarge" required="">
                            <!--<span><img    src="err_unameExists.png" /></span>-->
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="email">Email Address</label>
                        <div class="controls">
                            <input id="email" name="email" type="text" placeholder="" class="input-xlarge" required="">
                            
                        </div>
                    </div>

                    <!-- Password input-->
                    <div class="control-group">
                        <label class="control-label" for="passwd">Password</label>
                        <div class="controls">
                            <input id="passwd" name="passwd" type="password" placeholder="****************" class="input-xlarge" required="">
                            
                        </div>
                    </div>

                    <!-- Password input-->
                    <div class="control-group">
                        <label class="control-label" for="conf_passwd">Confirm Password</label>
                        <div class="controls">
                            <input id="conf_passwd" name="conf_passwd" type="password" placeholder="****************" class="input-xlarge" required="">

                        </div>
                    </div>

                    <!-- Button -->
                    <div class="control-group">
                        <label class="control-label" for="submit"></label>
                        <div class="controls">
                            <button id="submit" name="submit" class="btn btn-primary">Submit</button>'
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>
        <?php
            if (isset($_POST["submit"])) {
                //echo $_POST["uname"]." ".$_POST["passwd"];
                if (user::username_exists($_POST["uname"])) {
                    echo $_POST["uname"] . " exists";
                } else {
                    echo $_POST["uname"] . " does not exist";
                    $new_user = new user($_POST["uname"], $_POST["passwd"], $_POST["email"]);
                    if($new_user->add_user($_POST["uname"]))
                        echo "Great success!";
                    else
                        echo "Maybe next year.";
                }
            }
        ?>
    </body>
</html>
