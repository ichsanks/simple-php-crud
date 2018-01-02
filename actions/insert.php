<?php

require_once('../inc/session.php');	
require_once('../inc/class.crud.php');
$crud = new CRUD();

if(isset($_POST["submit"])) {
	$data = array(
		"name"				=> $_POST["name"],
		"gender"			=> $_POST["gender"],
		"place_of_birth"	=> $_POST["place-of-birth"],
		"date_of_birth"		=> $_POST["date-of-birth"],
		"address"			=> $_POST["address"],
		"phone" 			=> $_POST["phone"]
	);

	$crud->saveData($data);		

}

?>