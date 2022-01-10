<?php 
include_once "php/includes/landing.inc.php";
include_once "php/includes/sendMessage.inc.php";
session_start();
$session = $_SESSION["user"];
$friend = new Friendship();

// for chatting area

if (isset($_GET["user"])) {
	$select = $friend->selectUser($_GET["fri"]);
	$sender = $_GET["user"];
	$receiver = $_GET["fri"];
	$chat = $friend->startChat($sender,$receiver);
	// $send = $friend->sendMessage()
}
if (!isset($session)) {
	header("location:login.php");
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
    <!-- Google Fonts -->
  
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/all.min.css">
</head>
<body>
	
	<div class="container">
		<div class="wrapper">
			<div class="row center">
				<div class="w-100 msg-wrapper">
					<div class="chat-header d-flex justify-content-between">

					<?php if (isset($_GET["user"])) {?>
						<div class="d-flex pt-2 pb-2 pl-2">
							<img src="images/profile-man.png">
							<span class="p-2 selected-user">
							<?php 
								foreach ($select as $key) {
									$receiver = $key["username"];
									echo $receiver?>
									<div style="font-size: 12px;"><?php echo $key["status"]; ?></div>
								<?php }
							?>

							</span>
						</div>
						<span class="p-3"><a href="#"><i class="fa fa-trash text-danger"></i></a></span>
					</div>
					<div class="main-chat-wrapper pt-4">
						<?php
							if (is_array($chat)) {
								foreach ($chat as  $value) {

								if ($sender == $value["user_id"] AND $_GET["fri"] == $value["friend_id"]) {?>
									<div class="sender d-flex pr-2 justify-content-end">
										<div class="content">
											<div class="s-msg msg text-light"><?php echo $value["message"]; ?></div>
											<div class="text-muted time text-right">
												<?php echo substr($value["msg_time"], strrpos($value["msg_time"], " ")); ?>
											</div>
										</div>
									</div>
									<?php } 
								elseif ($sender == $value["friend_id"] AND $_GET["fri"] == $value["user_id"]) {?>
									<div class="receiver-div d-flex pl-2">
										<div class="image">
											<img src="images/profile-man.png" style="width: 50px;" height="50">
										</div>
										<div class="content receiver pl-2">
											<div class="msg r-msg"><?php echo $value["message"]; ?></div>
											<div class="text-muted time">
												<?php echo substr($value["msg_time"], strrpos($value["msg_time"], " ")); ?>
											</div>
										</div>
									</div>
							<?php }
						
							}
							
							}
							
						 ?>

						
					<!-- chat area ends -->

					<div class="send-message">
						<form action="php/includes/sendMessage.inc.php" method="post" class="request d-flex container form-group my-auto p-2 form">
							<textarea placeholder="Type your message..." rows="1" name="message_content" class="form-control"></textarea>
							<input type="text" name="sender" hidden value="<?php echo $sender;?>">
							<input type="text" name="receiver" hidden value="<?php echo $_GET['fri']?>">
							<button class="btn-primary" type="submit" name="send"><i class="fa fa-paper-plane"></i></button>

						</form>
					<?php } ?>
					</div>
				</div>	
			</div>
		</div>
	</div>


<script src="js/jquery.js"></script>
<script src="js/main.js"></script>
<script src="js/requests.js"></script>
<script>
	//refresh chat when button is clicked
	var receiver = '<?php echo $_GET['fri']; ?>'
	var sender = '<?php echo $_GET['user']; ?>'
	$("button[name = 'send']").click(function(){
		setInterval(function(){
			window.location.href ="chat.php?user="+sender+"&fri="+receiver;	
		}, 500);
		
	})
</script>

</body>
</html>