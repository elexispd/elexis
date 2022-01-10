<?php 
include_once "includes/autoload.inc.php";

$obj = new User();
$obj->msg();

?>
public function lastSeen(){
		// select the user first
		$sql = "SELECT last_seen FROM users WHERE status = ?";
		$stmt = $this->connect()->prepare($sql);
		$status = "offline";
		$stmt->execute([$status]);
		$num = $stmt->fetchAll();
		foreach ($num as $value) {
			$last = $value["last_seen"];
		}
		$time_ago = strtotime($last);
		$current_time = time();
		$time_difference = $current_time - $time_ago;
		$seconds = $time_difference;
		$minutes = round($seconds/60);
		return substr($last, strrpos($last, " ")) ;
		
	}
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body><style>
		.menu a{margin-right:10px; font-size: 17px;}
		.menu{position: relative;}
		.num{font-family: arial; font-size: 12px; position: absolute; left: 61px; top: -4px; font-weight: bold;}
		.drop{position: absolute; top:30px; padding: 10px 30px; left: -75px;  z-index: 9999999; background-color:rgba(128,128,128, .9); width: 140px; border-radius: 5px; text-align: center;}
		button:focus{outline: none;}
	</style>

</body>
</html>