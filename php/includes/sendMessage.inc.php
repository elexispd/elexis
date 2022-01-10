<?php 
include_once "autoload.inc.php";


$obj = new Friendship();
if (isset($_POST["send"])) {
	
	$sender = htmlspecialchars($_POST["sender"]);
	$receiver = htmlspecialchars($_POST["receiver"]);
	$message = htmlspecialchars($_POST["message_content"]);


	$obj->sendMessage($sender, $receiver, $message);


}