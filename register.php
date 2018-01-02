<?php

session_start();
require_once("inc/class.user.php");
$user = new USER();

if($user->is_loggedin() !="") {
	$user->redirect('home.php');
}

if(isset($_POST['btn-register'])) {
	$uname = strip_tags($_POST['uname']);
	$umail = strip_tags($_POST['email']);	
	$passwd = strip_tags($_POST['passwd']);

	$result = $user->register($uname, $umail, $passwd);

	if($result === "Success") {
		$message = "Success";
	} else {
		$message = "Error";
		$existedData = $result;
	}
}

?>

<?php include 'inc/header.php'; ?>

<div class="signin">
	
	<div class="content-body">

		<form method="post">

			<h2>Sign Up</h2>

			<hr />

			<div class="error">
			<?php if(isset($message)) { ?>
			<div class="alert">
				<?php 
					echo $message == "Success" ? 
						'Registration success. Please <a href="index.php">Log In</a>' :
						$existedData;
				?>
			</div>
			<?php } ?>
			</div>

			<div class="form-group">
				<input type="text" 
				name="uname" 
				class="form-control" 
				placeholder="Username" 
				autofocus
				required />        
			</div>

			<div class="form-group">
				<input type="text" 
				name="email" 
				class="form-control" 
				placeholder="Email" 
				required />        
			</div>

			<div class="form-group">
				<input type="password" 
				name="passwd" 
				class="form-control" 
				placeholder="Password"
				required />
			</div>

			<hr />

			<div class="form-group">
				<span>Already have an account? <a href="index.php">Log In</a></span>
				<input type="submit" 
					name="btn-register" 
					class="btn btn-primary float-right"
					value="Register" />
			</div>  

		</form>

	</div>

</div>

<?php include 'inc/footer.php'; ?>