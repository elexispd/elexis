<?php 
session_start();
	include_once "php/includes/autoload.inc.php";
		$session = $_SESSION["user"];
		$request = new Friendship();
		$members = new User();

				// logouts out
		if (isset($_POST["logout"])) {
			$members->destroySession($session);
		}

	
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
		$list = $request->requestList($user_id);
	?>	
				
	<!-- users list -->
					<div class="user-list">
						
						<ul class="list-unstyled">
							<?php 
								if (is_array($list)) {?>
								<form action="" method="post" class="ajax form-group d-flex mt-4" id="search">
									<input type="text"  name="search_friends" id="search_friends" class="round px-3 w-100 form-control" placeholder="Search">
									<button class="btn btn-primary"><i class="fa fa-search"></i></button>
								</form>
								<?php foreach ($list as  $value) {?>
									<li class="pb-2 pt-2">
								<div class="d-flex list">
									<div class="img pr-3">
										<a href="home.php?"><img src="<?php echo $value["photo"]; ?>"></a>
									</div>
									<div class="user w-100">
										<div class="text-light d-flex justify-content-between">
											<span><?php echo $value["username"];?></span>
											<form class="request" action="php/includes/addfriend.inc.php" method="post">
												<button style="background:green; border:none; color: white;" name="accept"><i class="fa fa-check"></i></button>
												<input type="text" name="user_id" value="<?php echo $value["user_id"]; ?>" hidden>
												<input type="text" name="friend_id" value="<?php echo $value["friend_id"]; ?>" hidden>
												<input type="text" name="date_sent" value="<?php echo $value["date_sent"]; ?>" hidden>
												<a href="php/includes/addfriend.inc.php?f=<?php echo $value["friend_id"]; ?>&u=<?php echo $value["user_id"]; ?>" style="background:none; border:none; color: red;" name="reject"><i class="fa fa-times"></i></a>
											</form>
										</div>
											<!--  -->
										<div class="text-light online"><?php echo "sent you a friend request"; ?></div>
									</div>
								</div>
							</li>
								<?php }
								} else{?>
									<div  style="text-align: center; margin-top: 120px;">
										<span class="">No Request</span>
									</div>
							
								<?php }
								
							?>
							

						</ul>
					</div>
					<!-- list user ends -->	

<script src="js/jquery.js"></script>
<script src="js/mobile.js"></script>
<script src="js/requests.js"></script>

</body>
</html>