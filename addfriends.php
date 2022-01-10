<?php 
	session_start();
	$session = $_SESSION["user"];
	include_once "php/includes/autoload.inc.php";
	$obj = new User();
	$members = $obj->members($session);

	
?>

<!DOCTYPE html>

<html>
<head>
	<title>my chat - HOME</title>
	  <!-- Font awesome -->
    <link href="css/fontawesome.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">   
    <!-- Main style sheet -->
    <link href="css/style.css" rel="stylesheet">     

    <link rel="stylesheet" type="text/css" href="css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="css/all.min.css">
</head>
<body>
	<!-- for side bar -->
	<?php include_once "php/includes/header.inc.php";
		
	?>	
				
	<!-- users list -->
	<div id="aa"></div>
					<div class="user-list">
						<form action="php/includes/addfriend.inc.php" method="post" class="ajax form-group form d-flex mt-4">
							<input type="text"  name="search_friends" id="search_friends" class="round px-3 w-100 form-control" placeholder="Search">
							<button class="btn btn-secondary"><i class="fa fa-search"></i></button>
						</form>
						<h6 class="pl-3">ALL MEMBERS</h6>
						<ul class="list-unstyled">
						 <?php foreach ($members as  $value) {?>
						 	<li class="pb-2 pt-2">
								<div class="d-flex list">
									<div class="img pr-3">
										<a href="images/profile-man.png"><img src="<?php echo $value["photo"]; ?>"></a>
									</div>
									<div class="user w-100">
										<div class=" d-flex justify-content-between">
											<span style="cursor: pointer;"><?php echo $value["username"]; ?></span>
											<form class="request" action="php/includes/addfriend.inc.php" method="post">									<button style="background:none; border:none;" name="send_request" id="send_request"><i class="fa fa-plus"></i></button>
												<input type="text" name="sender" id="sender" value="<?php echo $user_id; ?>" hidden>
												<input type="text" name="receiver" id="receiver" value="<?php $friend_id = $value["main_user_id"]; echo $friend_id; ?>" hidden>
											</form>
										</div>
											<!--  -->
										<div class=" online"><?php echo $value["status"]; ?></div>
									</div>
								</div>
							</li>
						 <?php } 

						 ?>
							
				
							

						</ul>
					</div>
					<!-- list user ends -->	
<script src="js/jquery.js"></script>
<script src="js/mobile.js"></script>
<script src="js/requests.js"></script>
<script>
	$(document).ready(function(){ 
		
})
	
</script>
</body>
</html>