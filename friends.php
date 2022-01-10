<?php
session_start();
	include_once "php/includes/autoload.inc.php";
		
		$friends = new Friendship();

		
	

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
	<!-- for side bar -->
			<?php include_once "php/includes/header.inc.php";
				$friendList = $friends->friendList($user_id);
				$total = $friends->totalFriends($session);
			?>					

<!-- users list -->
					<div class="user-list">
						<form action="" method="post" class="ajax form-group form d-flex  mt-4">
							<input type="text"  name="search_my_friends" id="search_friends" class="round px-3 w-100 form-control" placeholder="Search">
						</form>
						<div class="">
							Friends <span><?php echo $total; ?></span>
						</div>
						<ul class="list-unstyled">
							<?php 
								foreach ($friendList as  $list) {?>
									<li class="pb-2 pt-2">
								<div class="d-flex list">
									<div class="img pr-3">
										<a href="images/profile-man.png"><img src="<?php echo $list["friend_dp"]; ?>"></a>
									</div>
									<div class="user w-100">
										<div class=" d-flex justify-content-between">
											<span><?php if($list["friend_id"] == $user_id){?>
												  <a href="chat.php?user=<?php echo $user_id; ?>&fri=<?php echo $list["user_id"]; ?>"><?php echo $list["username"];?></a>
												<?php } else{?>
													<a href="chat.php?user=<?php echo $user_id; ?>&fri=<?php echo $list["friend_id"]; ?>"><?php echo $list["username"];?></a>
												<?php }?></span>
											<?php if ($list["status"] == "offline") {?>
												<div class="bg-danger" style="width:12px; height: 12px; border-radius: 50%;"></div>
											<?php } else {?>
												<div class="bg-success" style="width:12px; height: 12px; border-radius: 50%;"></div>
											<?php }
											 ?>
										</div>
										
									</div>
								</div>
							</li>
								<?php }
							?>
							
							

						</ul>
					</div>
					<!-- list user ends -->
				</div>
				<!-- side bar ends -->
<script src="js/jquery.js"></script>
<script src="js/mobile.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- <script>
	$(document).ready(function(){ 
		$(".drop").hide();
		$("i").click(function(){
		$(".drop").toggle();
	})
	})
	
</script> -->
</body>
</html>