

<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Sign up</title>

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
    <link rel="stylesheet" type="text/css" href="css/signup.css">

</head>
<body>

	<div class="signup-form">
		<form action="php/includes/landing.inc.php" method="post" class="ajax"> 
			<div class="form-header">
				<h2>Signup</h2>
				<p>Fill in your details and start chatting with friends and family</p>
			</div>
			<div class="success text-success"></div><br>
			<div class="form-group">
				<label>Username</label>
				<input type="text" class="form-control" name="username" id="username" placeholder="enter username" >
				<div class="text-danger " id="err1"></div>
			</div>

			<div class="form-group">
				<label>Email Address</label>
				<input type="text" class="form-control" name="email" id="email" placeholder="your@email.com" >
				<div class="text-danger" id="err2"></div>
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="Password" class="form-control" name="password" id="password" placeholder="password" >
				<div class="text-danger" id="err3"></div>
			</div>

			<div class="form-group">
				<label>Country</label>
				<select class="form-control" name="country" id="country">
					<option>Nigeria</option>
					<option>Ghana</option>
					<option>Benin Republic</option>
					<option>kenya</option>
				</select>
				<span class="text text-danger"><?php  ?></span>
			</div>

			<div class="form-group">
				<label>Gender</label>
				<select class="form-control" name="gender" id="gender">
					<option value="male">Male</option>
					<option value="female">Female</option>
				</select>
				<span class="text text-danger"><?php  ?></span>
			</div>

			<div class="form-group">
				<label class="check-box-inline"><input type="checkbox" id="terms"> I accept the <a href="#">Terms of  use</a> &amp; <a href="#">Privacy Policy</a></label>
			</div>

			<div class="form-group">
				<button #type="submit" class="btn btn-primary btn-block btn-lg" id="signup" name="signup">Sign up</button>
			</div>
		</form>

		<div class="text-center small" style="color:#674288;">Already have an account? <a href="login.php"> Sign in</a></div>
	</div>



<script src="js/jquery.js"></script>
<script src="js/main.js"></script>
</body>
</html>
