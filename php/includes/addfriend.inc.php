<?php 
include_once "autoload.inc.php";
$friend = new friendship();
	if (isset($_POST["send_request"])) {
		$user_id = htmlspecialchars($_POST["sender"]);
		$friend_id = htmlspecialchars($_POST["receiver"]);
		echo $friend->sendRequest($user_id, $friend_id);
		
	}

	if (isset($_POST["delete"])) {
		$sender = htmlspecialchars($_POST["sender"]);
		$receiver = htmlspecialchars($_POST["receiver"]);
		echo $obj->deleteRequest($receiver,$sender);
	}



	/*++++++++++ comfirm request++++++++++++++++++++*/

	if (isset($_POST["accept"])) {
		$user_id = htmlspecialchars($_POST["user_id"]);
		$friend_id = htmlspecialchars($_POST["friend_id"]);
		$date = $_POST["date_sent"];
		echo $friend->acceptRequest($friend_id, $user_id, $date);
	}

	/*++++++++++ comfirm request++++++++++++++++++++*/

	if (isset($_GET["f"])) {
		$friend->deleteRequest($_GET["f"], $_GET["u"]);
		header("location:../../comfirm_request.php");
		
	}
	
?>