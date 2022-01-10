
<?php 
class User extends Database{
	private $username;
	private $email;
	private $password;
	private $country;
	private $gender;
	private $photo;
	private $msg = [];

	// sign up script

	private function username(){
		if (empty($this->username)) {
			$this->message("user", "*username is empty");
		} elseif(strlen($this->username) <=2){
			$this->message("user", "*username should be 3 letters and above");
		} elseif(!preg_match("/^[a-zA-Z ]+[a-z0-9]+$/", $this->username)){
			$this->message("user", "*username should contain letter and numbers only ");
		}  else {
			$sql = "SELECT username FROM users WHERE username = ?";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([$this->username]);
			$rowCount = $stmt->rowCount();
			if ($rowCount > 0) {
				$this->message("user", "username already exist");
			} else{
				$this->message("user", "");
			}
		}
	}

	private function email(){
		if (empty($this->email)) {
			$this->message("email", "*email is empty");
		} else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
			$this->message("email", "*invalid email");
		} else {
			$sql = "SELECT email FROM users WHERE email = ?";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([$this->email]);
			$rowCount = $stmt->rowCount();
			if ($rowCount > 0) {
				$this->message("email", "email already exist");
			} else{
				$this->message("email", "");
			}
			
		}
	}

	private function password(){
		if (empty($this->password)) {
			$this->message("pass", "*password is empty");
		} elseif(strlen($this->password) <=5){
			$this->message("pass", "*password is too short");
		} elseif(!preg_match("/^[a-zA-Z0-9.$*\/^&]+$/", $this->username)){
			$this->message("pass", "*password could only contain a-zA-Z0-9.$*\/^& characters");
		}  else{
			// $this->message("pass", "");
		}
	}
	private function country(){
		if (empty($this->country)) {
			$this->message("count", "country is empty");
		} #elseif($this->country !== "Nigeria" || $this->country !== "Benin Republic" || $this->country !== "Ghana" || $this->country !== "Kenya"){
		// 	$this->message("count", "*invalid country");
		// }
	}

	private function gender(){		
		if (empty($this->gender)) {
			$this->message("gender", "gender is empty");
		} #elseif($this->gender !== "Male" || $this->gender !== "Female"){
		// // 	$this->message("gender", "*invalid gender");
		// // }
	}

	public function save($user,$email,$pass,$country,$gender){
		$this->username = $user;
		$this->email = $email;
		$this->password = $pass;
		$this->country = $country;
		$this->gender = $gender;
		$this->username();
		$this->email();
		$this->password();
		$this->country();
		$this->gender();
		$this->photo = "images/profile-man.png";

		if (empty($this->msg["name"]) && empty($this->msg["email"])  && empty($this->msg["pass"])  && empty($this->msg["count"]) && empty($this->msg["gender"])) {
				$hash = password_hash($this->password, PASSWORD_DEFAULT);
				// $user_id = rand(time()+10000000, time()+100000000000);
				date_default_timezone_set("Africa/Lagos");
				$date = date("d-m-y h:ia");
				$sqll = "INSERT INTO users (username, email, password, gender, country,photo, DOR) VALUES (?,?,?,?,?,?,?)";
				$stmtt = $this->connect()->prepare($sqll);
				$stmtt->execute([strtolower($this->username), strtolower($this->email), $hash, strtolower($this->gender), strtolower($this->country), $this->photo,   $date]);
				$this->message("success", "Registration Successful!");
				session_start();
				$_SESSION["sender"] = $this->username;		
		
			}		

		return json_encode($this->msg);
	}


	private function message($key, $val){
		$this->msg[$key] = $val;
	}

/************************************LOGIN++++++++++++++++++++++++++++++++++++++*/

	public function login($user, $pass){
		$this->username = $user;
		$this->password = $pass;

		if (empty($this->username) || empty($this->password)) {
			$this->message("fail", "* All fields are required");
		} else{
			$sql = "SELECT * FROM users WHERE username = ?";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([$this->username]);
			$row = $stmt->fetch();
			// foreach ($row as $value) {
			// 	$id = $value["user_id"];
			// }
			$rowCount = $stmt->rowCount();
			if ($rowCount == 1) {
				$dehash = password_verify($this->password, $row["password"]);
				if ($dehash == true) {
					$this->message("success", "Login Successful!");
					session_start();

					$_SESSION["user"] = $this->username;

					$this->status($_SESSION["user"]);
				} else{
					$this->message("fail", "* invalid login details");
				}
			} else{
				$this->message("fail", "* invalid login details");
			}
		}
		return json_encode($this->msg);
	}

	public function LoggedInUser($user){
		$sql = "SELECT * FROM users WHERE username = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$user]);
		return $stmt->fetchAll();
	}

	/*+++++++++++++++++++++++++++this query displays all the memeber++++++++++++++++++++++*/
	public function members($user){
		$sql = "SELECT user_id AS main_user_id, username, status, photo, last_seen FROM users WHERE username <> '$user'";
		$stmt = $this->connect()->query($sql);
		// $stmt->execute();
		return $stmt->fetchAll();
	}

	// public function members($user,$friend_id){
	// 	$sql = "SELECT t1.user_id AS main_user_id, t1.username, t1.status, t1.photo, t1.last_seen, t3.user_id, t3.friend_id, t3.request_status FROM users AS t1 LEFT JOIN friends as t2 ON  (t1.user_id = t2.friend_id) OR (t1.user_id = t2.user_id) LEFT JOIN friend_request as t3 ON (t1.user_id = t3.user_id) WHERE (t3.friend_id ='$friend_id') AND  t2.user_id IS NULL AND t1.username <> '$user'";
	// 	$stmt = $this->connect()->query($sql);
	// 	// $stmt->execute();
	// 	return $stmt->fetchAll();
	// }


	/*+++++++++++++++++++++++++++check whether user is online+++++++++++++++*/
	public function status($session){
		if (isset($session)) {
			$ss = "UPDATE users SET status = ? WHERE username = ?";
			$sss = $this->connect()->prepare($ss);
			$sss->execute(["online", $session]);
		}	
	}

	/*++++++++++++++this will destroy the session and update the status++++++++++++++++++++++++++++*/
	public function destroySession($session){
		session_unset();
		session_destroy();
		$ss = "UPDATE users SET status = ? WHERE username = ?";
		$sss = $this->connect()->prepare($ss);
		$sss->execute(["offline", $session]);
		date_default_timezone_set("Africa/Lagos");
		$date = date("d-m-y h:i");
		$sql = "UPDATE users SET last_seen = ? WHERE username = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$date, $session]);
		header("location:login.php");
		exit();

	}

	public function profilePicture($name, $username){
		$dir = "images/";
		$ext = array("jpg", "png", "jpeg");
		$rename= $dir.basename($_FILES["photo"]["name"]);
		$extension = strtolower(pathinfo($rename, PATHINFO_EXTENSION));
		$file_path = $dir.$name.".".$extension;

		if (!empty($name)) {
			if(!in_array($extension, $ext)){
				$this->message("dp", "only jpg, png and jpeg formats are accepted");
			} elseif(file_exists($dir.$name)){
				unlink($dir.$name);
			}else{
				if (move_uploaded_file($_FILES["photo"]["tmp_name"], $file_path)) {
					$sql = "UPDATE users SET photo =? WHERE username = ?";
					$stmt =$this->connect()->prepare($sql);
					$stmt->execute([$file_path, $username]);
					$this->message("dp", "profile picture uploadeded");
						
				} else{
					$this->message("dp", "try again");
				}
			}
		}
		


		return $this->msg;

		// if (empty($this->msg["dp"])) {
		// 	if (move_uploaded_file($_FILES["photo"]["tmp_name"], $this->file_path)) {
		// 			$sq = "UPDATE users SET image =?,  status =? WHERE username = ?";
		// 			$stm =$this->connect()->prepare($sq);
		// 			$stm->execute([$this->file_path, 1,  $_SESSION["user"]]);

		// 			return "image uploadeded successfully";
				
		// 	} else {
		// 		$this->addError("something went wrong");
		// 		return $this->error;
		// 	}
		// }

	}

	


	
	

	// end of class
}
