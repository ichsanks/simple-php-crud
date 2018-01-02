<?php

session_start();
require_once("inc/class.user.php");
$login = new USER();

if($login->is_loggedin() != "") {
	$login->redirect('home.php');
}

if(isset($_POST['btn-login'])) {
	$uname = strip_tags($_POST['uname']);	
	$passwd = strip_tags($_POST['passwd']);	

	echo $login->doLogin($uname, $passwd);

	if($login->doLogin($uname, $passwd)) {
		$login->redirect('home.php');
	} else {
		$error = "Wrong username or password";
	}
}

?>

<?php include 'inc/header.php'; ?>

<div class="signin">
	
	<div class="content-body">

		<form method="post">

			<h2>Log In</h2>

			<hr />

			<div class="error">
			<?php if(isset($error)) { ?>
			<div class="alert">
				<?php echo $error; ?> !
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
				<input type="password" 
				name="passwd" 
				class="form-control" 
				placeholder="Password"
				required />
			</div>

			<hr />

			<div class="form-group">
				<span>Don't have an account? <a href="register.php">Sign Up</a></span>
				<input type="submit" 
					name="btn-login" 
					class="btn btn-primary float-right"
					value="Log In" />
			</div>  

		</form>

	</div>

</div>

<?php include 'inc/footer.php'; ?>