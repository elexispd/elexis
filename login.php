<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Login to your account</title>

    <!-- Font awesome -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">   
    <!-- Main style sheet -->
    <link href="css/style.css" rel="stylesheet">     
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,700' rel='stylesheet' type='text/css'>

    <!-- signin style -->
    <link rel="stylesheet" type="text/css" href="css/signin.css">

</head>
<body>
	<div class="signin-form">
		<form action="php/includes/landing.inc.php" method="post" class="ajax">
			<div class="form-header">
				<h2>Sign in</h2>
				<p>Login to MyChat</p>
			</div>

			<div class="success text-success"></div><br>
			<div class="error text-danger"></div><br>
			
			<div class="form-group">
				<label>Username</label>
				<input type="text" class="form-control" name="user" placeholder="your username" id="username" autocomplete="on" >
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="Password" class="form-control" name="pass" placeholder="password" id="password" autocomplete="off" >
			</div>

			<div class="small">
				forgot passwowrd? <a href="forgotpassword.php">Click here</a>
			</div><br>

			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block btn-lg" id="login" name="signin">Login</button>
			</div>

			
		</form>

		<div class="text-center small" style="color:#674288;">Don't have an account? <a href="signup.php">Create one</a></div>
	</div>

	<script src="js/jquery.js"></script>
	<script src="js/main.js"></script>
</body>
</html>