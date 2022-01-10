<?php 
// no prepared statement in the select statements because of laziness... remember to use prepared statement here in the next version
class Friendship extends Database{

public function sendRequest($user_id, $friend_id){
	$date = date("d-m-y");
	$ss = "SELECT * FROM friend_request WHERE (user_id = '$user_id' AND friend_id = '$friend_id') OR (user_id = '$friend_id' AND friend_id = '$user_id')";
	$stm = $this->connect()->query($ss);
	$row = $stm->rowCount();
	if ($row < 1) {
		$sq = "SELECT * FROM friends  WHERE (user_id = '$user_id' AND friend_id = '$friend_id') OR (user_id = '$friend_id' AND friend_id = '$user_id')";
		$st = $this->connect()->prepare($sq);
		$st->execute([$user_id,$friend_id,$date,1]);
		$ro = $st->rowCount();
		if ($ro > 0) {
			return "you are already a friend with this user";
		} else{	
			$sql = "INSERT INTO friend_request (user_id, friend_id, date_sent,request_status) VALUES (?,?,?,?)";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([$user_id,$friend_id,$date,1]);
			return "Your request has been sent.";
		}	
	} else{
		return "You have a pending request with this user";
	}
}



public function requestList($friend_id){
	$sql = "SELECT t1.friend_id, t1.user_id, t1.date_sent, t2.user_id, t2.username FROM friend_request AS t1 LEFT JOIN users AS t2 ON (t1.user_id = t2.user_id) WHERE friend_id = '$friend_id'";
	$stmt = $this->connect()->query($sql);
	$stmt->execute([$friend_id]);
	$row = $stmt->rowCount();
	if ($row < 1) {
		return "You have no friend request(s)";
	} else{
		return $stmt->fetchAll();
	}
}

public function acceptRequest($friend_id, $user_id, $date){
	$sql = "INSERT INTO friends (friend_id, user_id, dat)  VALUES (?,?,?)";
	$stmt = $this->connect()->prepare($sql);
	$stmt->execute([$friend_id,$user_id,$date]);
	$num = $stmt->rowCount();
	if ($num == 1) {
		$sqll ="DELETE FROM friend_request WHERE friend_id= ? AND user_id = ?";
		$stmll = $this->connect()->prepare($sqll);
		$stmll->execute([$friend_id,$user_id]);
	} 
	return "Friendship Accepted";
}

public function deleteRequest($friend_id, $user_id){
		$sqll ="DELETE FROM friend_request WHERE friend_id= ? AND user_id = ?";
		$stmll = $this->connect()->prepare($sqll);
		$stmll->execute([$friend_id,$user_id]);
	return "Friend Deleted";
}
public function friendList($user_id){
	$sql = "SELECT f.*, u.username, u.status, u.photo AS friend_dp FROM users u INNER JOIN ( SELECT user_id, friend_id FROM friends WHERE user_id = '$user_id' UNION SELECT friend_id, user_id FROM friends WHERE friend_id = ? ) f ON f.friend_id = u.user_id ";
	$stmt = $this->connect()->prepare($sql);
	$stmt->execute([$user_id]);
	return $stmt->fetchAll();
}
public function totalFriends($username){
	$sql = "SELECT t1.user_id, t1.friend_id, t2.username, t2.user_id FROM friends AS t1 LEFT JOIN users AS t2 ON (t1.user_id = t2.user_id OR t1.friend_id = t2.user_id) WHERE t2.username = ?";
	$stmt = $this->connect()->prepare($sql);
	$stmt->execute([$username]);
	return $stmt->rowCount();
}

public function notification($user){
		$sql = "SELECT user_id FROM users WHERE username = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$user]);
		$fetch = $stmt->fetchAll();
		foreach ($fetch as $list) {
			$accept_id = $list["user_id"];
		}
		if ($accept_id) {
			$sql = "SELECT friend_id FROM friend_request WHERE friend_id = ?";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([$accept_id]);
			$row = $stmt->rowCount();
			return $row;
		}
	}

	/*++++++++++++++++++++++++++++ chat of users+++++++++++++++++++++++++++++++*/

	//this will insert chats into chats table

	public function sendMessage($sender,$receiver,$message){
		date_default_timezone_set("Africa/Lagos");
		$date = date("y-m-d h:i");
		if (!empty($message)) {
			$sql = "INSERT INTO chat (user_id, friend_id,message, msg_time) VALUES (?,?,?,?)";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([$sender, $receiver, $message, $date]);
			exit();
		}
	}

	// Query that knows the sender

	public function selectUser($friend_id){
		$sql = "SELECT * FROM users WHERE user_id = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$friend_id]);
		return $stmt->fetchAll();
	}

	//++++++++++++++++++++++++++++++++displays chats++++++++++++++++++++++++++++
	public function startChat($sender, $receiver){
		$sql = "SELECT t1.username, t1.status,t1.last_seen,t1.photo, t1.user_id, t2.friend_id, t2.message, t2.msg_time FROM users AS t1 LEFT JOIN chat AS t2 ON (t1.user_id = t2.user_id) OR (t1.user_id = t2.friend_id)  WHERE (t2.user_id = '$sender' AND t2.friend_id = '$receiver') OR (t2.friend_id = '$sender' AND t2.user_id = '$receiver')";
		$stmt = $this->connect()->query($sql);
		$num = $stmt->rowCount();
		if ($num > 0 ) {
			while ($row = $stmt->fetch()) {
			$data[] = $row;
		}
		return $data;
		exit();
		} 	
	}

	/*-------------------INDEX PAGE-----------------------------------*/

	public function loadMessages($user){
				$sql = "SELECT 
							c.message, c.user_id,  c.friend_id,c.id,
							u.username AS friend_name, u.status, u.photo AS friend_dp
							FROM users u 
							INNER JOIN ( SELECT user_id, friend_id,message,id FROM chat 
							            WHERE user_id = {$user}
							            UNION SELECT friend_id, user_id, message,id FROM chat 
							            WHERE friend_id = $user) c ON c.friend_id = u.user_id ORDER BY c.id DESC LIMIT 1";
				$stmt = $this->connect()->query($sql);
		return $stmt->fetchAll();
	}


// public function loadMessages($user){
	// 		$sql = "SELECT 
	// 			c.id, 
	// 		    u.user_id, 
	// 		    u.username,
	// 		    f.photo AS friend_dp,
	// 		    f.user_id AS friend_id,
	// 		    f.username AS friend_name, 
	// 		    c.message, c.msg_time 
	// 		    FROM chat c 
	// 		    inner join ( 
	// 		        SELECT user_id, 
	// 		        friend_id, 
	// 		        MAX(msg_time) AS maxtime FROM chat GROUP BY user_id, friend_id ) c2 ON c2.user_id = c.user_id AND c.friend_id = c2.friend_id AND c.msg_time = c2.maxtime INNER JOIN users u ON c.user_id = u.user_id INNER JOIN users f ON f.user_id = c.friend_id WHERE u.user_id = '$user'";
	// 			$stmt = $this->connect()->query($sql);
	// 	return $stmt->fetchAll();
	// }


	// public function loadMessages($user){
	// 	$sql = "SELECT u.user_id, u.username, m.message FROM users u INNER JOIN (SELECT id, user_id, friend_id, message, MAX(msg_time) AS mdate FROM chat msg WHERE friend_id = '$user' GROUP BY user_id ORDER BY id desc) as m ON u.user_id = m.user_id ";
	// 	$stmt = $this->connect()->query($sql);
	// 	return $stmt->fetchAll();
	// }
	/*public function loadMessages($user){
		$sql = "SELECT f.*, u.username FROM users u INNER JOIN ( SELECT user_id, friend_id,message FROM chat WHERE user_id = '$user' UNION SELECT friend_id, user_id, message FROM chat WHERE friend_id = '$user') f ON f.friend_id = u.user_id ";
		$stmt = $this->connect()->query($sql);
		return $stmt->fetchAll();
	}*/
	/*public function loadMessages($user){
		$sql = "SELECT c.*, u.username, u.status FROM users u INNER JOIN ( SELECT user_id, friend_id,id, message FROM chat WHERE user_id = 1 OR friend_id = 1 UNION SELECT friend_id, user_id,id, message FROM chat WHERE friend_id = '$user' OR user_id = '$user' ORDER BY id DESC) c ON c.friend_id = u.user_id ";
		$stmt = $this->connect()->query($sql);
		return $stmt->fetchAll();
	}*/
	// select u.username, u.user_id, c.* from users u join chat c on u.user_id = c.user_id join ( select user_id, max(id) as id from chat group by user_id ) t on c.id = t.id and c.user_id = t.user_id WHERE friend_id = 2 order by c.id desc 

	





/************************************end of class*************************************/
}