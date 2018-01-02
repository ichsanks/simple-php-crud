<?php

require_once('dbconfig.php');

class USER {	

	private $conn;
	
	public function __construct() {
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql) {
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function register($uname, $umail, $upass) {
		try {
			$isUserExist = $this->checkUser($uname, $umail);

			if(!$isUserExist) {
				$new_password = password_hash($upass, PASSWORD_DEFAULT);
				
				$stmt = $this->conn->prepare("INSERT INTO users(user_name,user_email,user_pass) 
			                                               VALUES(:uname, :umail, :upass)");
													  
				$stmt->bindparam(":uname", $uname);
				$stmt->bindparam(":umail", $umail);
				$stmt->bindparam(":upass", $new_password);										  
					
				$stmt->execute();	
				
				return "Success";
			} else {
				return $isUserExist;
			}
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}				
	}
		
	public function doLogin($uname, $upass) {
		try {
			$stmt = $this->conn->prepare("SELECT user_id, user_name, user_pass FROM users WHERE user_name=:uname");
			
			$stmt->execute(array(':uname'=>$uname));
			
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);			
			
			if($stmt->rowCount() == 1) {
				if(password_verify($upass, $userRow['user_pass'])) {					
					$_SESSION['user_session'] = $userRow['user_id'];
					return true;
				} else {
					return false;
				}
			}
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
	
	public function is_loggedin() {
		if(isset($_SESSION['user_session'])) {			
			return true;
		}
	}
	
	public function redirect($url) {
		header("Location: $url");
	}
	
	public function doLogout() {
		session_destroy();
		unset($_SESSION['user_session']);
		echo 'destroyed';
		return true;
	}

	function checkUser($uname, $email) {		
		try {
			$stmt = $this->conn->prepare("SELECT user_name, user_email	FROM users WHERE user_name=:uname OR user_email=:email");
			
			$stmt->execute(array(
				':uname'	=> $uname,
				':email'	=> $email
			));

			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

			if($stmt->rowCount() > 0) {
				if($userRow["user_name"] === $uname) {
					return "An account already exists with this user name, please select another user name!";
				} else {					
					return "An account already exists with this email, please select another email!";
				}
			}
			return false;
			
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}	
	}
}

?>