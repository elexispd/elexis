<?php 
	include_once "autoload.inc.php";
	$session = $_SESSION["user"];
	if (isset($session)) {
		$obj = new User();
		$owner = $obj->loggedInUser($session);
		$request = new Friendship();
		$notify = $request->notification($session);
				// logouts out
		if (isset($_POST["logout"])) {
			$obj->destroySession($session);
		}
	}

	else{
		header("location:login.php");
	}
	





			// logouts out
	
	 ?>

	<style>
		.header{
			margin-bottom: 7px;
			padding: 0 0 0 10px;
			border-bottom: 1px dashed #000000;
		}
		.head{
			color: white;
			font-size: 23px;
		}
		.menu a{margin-left:10px;  font-size: 19px;}
		.menu{position: relative;}
		.num{ font-size: 12px; position: absolute; left: 73px; top: -4px; font-weight: bold;}
		.drop{position: absolute; top:30px; padding: 10px 30px; left: -28px;  z-index: 9999999; background-color:rgba(128,128,128, .9); width: 140px; border-radius: 5px; text-align: center; display:none;}
		button:focus{outline: none;}
	</style>

<div class="col-md-3  col-lg-3 col-md-3 col-sm-3 col-xm-12 sidebar pt-2 pb-2" style="background: #F6D8BB;">
					<!-- displays Account Owner -->
					

					<?php foreach ($owner as  $value) {?>
						<div class="d-flex">
							<div class="img pr-3">
								<a href="settings.php"><img src="<?php echo $value["photo"]; ?>"></a>
							</div>
							<div class="user d-flex justify-content-between w-100">
								<div class=" justify-content-between">
									<a href="settings.php">
										<span><?php echo $value["username"]; ?></span>
										<div class=" online"><?php echo $value["status"]; ?></div>
									</a>
								</div>
												<!--  -->
								<div class="d-flex menu">
									<a href="index.php"><i class="fa fa-home" style="color: #000000;"></i></a>
									<a href="addfriends.php"><i class="fa fa-plus" style="color: #000000;"></i></a>
									<span class="text-danger num"><?php echo $notify	; ?></span>
									<a href="comfirm_request.php"><i class="fa fa-bell" style="color:#000000;"></i></a>
									<a class="drop-menu"><i class="fa fa-bars" style="color:#000000; cursor: pointer;"></i></a>
										<div class="drop">
											<form action="" method="post" class="">
												<input type="text" name="" value="<?php $user_id  = $value["user_id"]; echo $user_id;?>" hidden>
												<button style="border:none !important; background-color: transparent;" name="logout" class="text-light pb-3">Logout</button><i class="fa fa-power-off text-danger" style="font-size: 15px;"></i>
											</form>
											<a href="settings.php" class="text-light">Settings</a>
										</div>
									
									<!-- <form action="" method="post" class="ajax">
										<button style="border:none !important; background-color: transparent;" name="logout"><i class="fa fa-power-off text-danger" style="font-size: 20px;"></i></button>
									</form> -->				
								</div>
								
							</div>
						</div>
					<?php } ?>
				</div>
		

