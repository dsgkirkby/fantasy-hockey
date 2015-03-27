<!DOCTYPE html>
<html>
	<?php
	session_start();
	require_once '../library/userVerification.php';
	if (getUsername()) {
		header('Location: main.php', true, 303);
		die();
	}
	if (empty($_GET["error"])) {
		$error = false;
	} else {
		$error = $_GET["error"];
	}
	?>
	<head>
		<meta charset="UTF-8">
		<title>Dobber Login</title>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="jquery-2.1.3.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</head>

	<body>
		<div class="container">
			<div class="jumbotron">
				<h1>Dobber Fantasy</h1>
			</div>
			<!-- New user message -->
			<div class="container">
				<?php
				$nuser = false;
				$error = false;
				if (!empty($_GET["error"])) {
					$error = $_GET["error"];
				}
				if ($error) {
					echo "<div class=\"alert alert-danger\" role=\"alert\">"
					. "<b>Credentials do not match.</b> "
					. "Check that you have entered in the correct data.";
				}
				?>
			</div>
			<div class="container">
				<div class="col-sm-4">
					<form action="verifyUser.php" class="form-horizontal <?php if ($error) { echo "has-error"; } ?>">
						<fieldset>
							<legend>Login</legend>
							<div class="form-group">
								<label class="control-label" for="username">Username</label>
								<input class="form-control input-xlarge" id="username"
								name="username" type="text" placeholder="" required="">
							</div>
							<div class="form-group">
								<label class="control-label" for="password">Password</label>
								<input class="form-control input-xlarge" id="password" 
								name="password" type="password" placeholder="*********" required="">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Login</button>
								<a href="new_user.php">Register</a>
							</div>
							<div>
							<?php
							//if ($error) {
							//echo "<font color=\"#a94442\">Invalid Login</font>";
							//}
							?>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
