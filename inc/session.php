<?php

session_start();

require_once 'class.user.php';
$session = new USER();

if(!$session->is_loggedin()) {
	// Redirect if not logged in
	$session->redirect('./index.php');
}