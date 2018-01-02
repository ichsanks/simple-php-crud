<?php

require_once('../inc/session.php');	
require_once('../inc/class.crud.php');
$crud = new CRUD();

if(isset($_GET["id"])) {
	
	$crud->delete($_GET["id"]);		

}