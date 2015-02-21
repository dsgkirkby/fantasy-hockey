<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>New User</title>
        <link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap-theme.min.css">
        <script src="bootstrapp-3.3.2-dist/js/bbootstrap.min.js"></script>
    </head>
    <body>
      <form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Register</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="uname">Username</label>
  <div class="controls">
    <input id="uname" name="uname" type="text" placeholder="" class="input-xlarge" required="">
    
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
    <button id="submit" name="submit" class="btn btn-primary">Submit</button>
  </div>
</div>

</fieldset>
</form>

        <?php
        // put your code here
        ?>
    </body>
</html>
