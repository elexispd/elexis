<?php 
session_start();
	include_once "php/includes/autoload.inc.php";

		$session = $_SESSION["user"];
		$chats = new Friendship();
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

    <link rel="stylesheet" type="text/css" href="css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="css/all.min.css">
</head>
<body>
		<!-- <div id="preloader">
			<div id="status"><img src="images/bg.jpg"></div>
		</div> -->
	<!-- for side bar -->
		<?php include_once "php/includes/header.inc.php";
			$chatList = $chats->loadMessages($user_id);
		?>
		
	<!-- users list -->
<div class="wrapper">

	<ul class="list-unstyled">
		<form action="" method="post" class="ajax form-group form mt-4">
			<input type="text"  name="search_friends" id="search_friends" class="round px-3 w-100 form-control" placeholder="Search">
		</form>
		<?php 
			foreach ($chatList as $chatL) {?>
				<li class="pb-2 pt-2">
					<div class="d-flex list">
						<div class="img pr-3">
							<a href="images/profile-man.png"><img src="<?php echo $chatL["friend_dp"]; ?>"></a>
						</div>
						<div class="user w-100">
							<a href="chat.php?user=<?php echo $user_id; ?>&fri=<?php echo $chatL["friend_id"]; ?>">
								<div class=" d-flex justify-content-between">
									<span><?php echo $chatL["friend_name"]; ?></span>
									<span class="unread">3</span>
								</div>
								<?php 
									/*if ($session !== $chatL["friend_name"]) {?>
										<div class="online"><span class="text-muted">You: </span><?php echo $chatL["message"]; ?></div>
									<?php } else{?>
										<div class="online"><?php echo $session . $chatL["friend_name"]; ?></div>
									<?php }*/
									$friend = $chatL["friend_name"];
									echo $friend;
									if ($session !== $friend) {
										echo $session
										;
									} else{echo "ni";}
								?>
								
							</a>							
						</div>
					</div>
				</li>
		<?php } ?>
	</ul>
	<div class="friends">
		<a href="friends.php">
			<i class="fa fa-comment-alt"></i>
		</a>
	</div>
</div>
				<!-- side bar ends -->
<script src="js/jquery.js"></script>
<script src="js/main.js"></script>
<script src="js/mobile.js"></script>
<script>
 	var session = "<?php echo $session; ?>"
	jQuery(window).load(function() {
// will first fade out the loading animation
	jQuery("#status").delay(1000).fadeOut();
	// will fade out the whole DIV that covers the website.
	jQuery("#preloader").delay(1000).fadeOut("slow");

});
</script>

</body>
</html>