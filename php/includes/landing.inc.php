<?php 
include_once "autoload.inc.php";


$obj = new User();
if (isset($_POST["username"])) {
	
	$username = htmlspecialchars($_POST["username"]);
	$email = htmlspecialchars($_POST["email"]);
	$password = htmlspecialchars($_POST["password"]);
	$country = htmlspecialchars($_POST["country"]);
	$gender = htmlspecialchars($_POST["gender"]);

	echo $obj->save($username, $email, $password, $country, $gender);


}

if (isset($_POST["user"])) {
	$username = htmlspecialchars(strtolower($_POST["user"]));
	$password = htmlspecialchars($_POST["pass"]);
	echo $obj->login($username, $password);
}
 



if(isset($_POST["send"])){
	$sender = $_POST["sender"];
	$receiver = $_POST["receiver"];
	$message = $_POST["message_content"];
	// echo $sender." ". $receiver. " ".$message;
	echo $obj->sendMessage($sender, $receiver, $message);
} 

/*+++++++++++++++++++++++logout+++++++++++++++++*/
			// logouts out
	if (isset($_POST["logout"])) {
		$members->destroySession($session);
	}

/*++++++++++++++search++++++++++++++++++*/
// if ($_POST["search"]) {
// 	echo $obj->search($_POST["search"]);
// }
