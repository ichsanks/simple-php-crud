<?php

require_once('dbconfig.php');

class CRUD {	

	private $conn;
	
	public function __construct() {
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }	
	
	public function getData() {
		try {
			$stmt = $this->conn->prepare("SELECT * FROM customers");

			$stmt->execute();
			$result = array();

			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$result[] = $row;
			}

			return $result;
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getSingleData($id) {
		try {
			$stmt = $this->conn->prepare("SELECT * FROM customers WHERE customer_id =:id");

			$stmt->execute(array(":id" => $id));			
			$result = $stmt->fetch(PDO::FETCH_ASSOC);			

			if($stmt->rowCount() == 1) {
				return $result;
			} else {
				echo "Data tidak ada!";
			}			
			return true;
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function saveData($data) {
		try {			
			$stmt = $this->conn->prepare("
						INSERT INTO customers (name, gender, place_of_birth, date_of_birth, address, phone)
		            	VALUES(:name,:gender,:place_of_birth,:date_of_birth,:address,:phone)
		            ");
			
			$stmt->execute(array(
		    	":name" 	 		=> $data["name"],
				":gender" 	 		=> $data["gender"],
				":place_of_birth"	=> $data["place_of_birth"],
				":date_of_birth"	=> $data["date_of_birth"],
				":address"  		=> $data["address"],
				":phone" 	 		=> $data["phone"]
			));	

			
			//$this->uploadFile($data["picture"]);

			$this->redirect('../home.php');
			//return $stmt;
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}				
	}

	public function updateData($data) {
		try {			
			$stmt = $this->conn->prepare("
						UPDATE customers SET 
							name = :name,
							gender = :gender,
							place_of_birth = :place_of_birth,
							date_of_birth = :date_of_birth,
							address = :address,
							phone = :phone
						WHERE customer_id = :customer_id				
		            ");
				
			$stmt->execute(array(
				":name" 	 	 	=> $data["name"],
		    	":gender" 	 		=> $data["gender"],
				":place_of_birth"	=> $data["place_of_birth"],
				":date_of_birth"	=> $data["date_of_birth"],
				":address" 	 		=> $data["address"],
				":phone"  			=> $data["phone"],
				":customer_id" 	 	=> $data["customer_id"]
			));

			$this->redirect('../home.php');
			return $stmt;
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}				
	}
	
	public function delete($id) {
		try {
			$stmt = $this->conn->prepare("DELETE FROM customers WHERE customer_id=:id");
			$stmt->execute(array(':id'=>$id));

			$this->redirect('../home.php');
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function redirect($url) {
		header("Location: $url");
	}

	function uploadFile($file) {
		
	}
	
}

?>