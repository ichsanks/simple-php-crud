<?php 

require_once("inc/session.php");
require_once('inc/class.crud.php');
$crud = new CRUD();

$data = $crud->getSingleData($_GET['id']);

?>

<?php include 'inc/header.php'; ?>

<?php include 'inc/navbar.php'; ?>

<div class="content-body">
	<div class="container">		
		<form method="POST"
			action="actions/update.php">
			<div class="form-group">
				<input type="hidden"
					name="id"
					class="form-control"					
					value="<?php echo $_GET['id']; ?>"					
					required />
				<input type="text"
					name="name"
					class="form-control"
					placeholder="Customer name"
					value="<?php echo $data["name"]; ?>"
					required />
			</div>
			<div class="form-group">
				<label>
					<input type="radio"
						name="gender"
						value="M"
						<?php if($data["gender"] == "M") echo "checked"; ?> />
						Male
				</label>
				<label>
					<input type="radio"
						name="gender"
						value="F"
						<?php if($data["kelamin"] == "F") echo "checked"; ?> />
						Female
				</label>
			</div>
			<div class="form-group">
				<input type="text"
					name="place-of-birth"
					class="form-control"
					placeholder="Place of birth"
					value="<?php echo $data["place_of_birth"]; ?>"
					required />
			</div>
			<div class="form-group">
				<input type="text"
					name="date-of-birth"
					class="form-control"
					placeholder="Date of birth"
					value="<?php echo $data["date_of_birth"]; ?>"
					required />
			</div>
			<div class="form-group">
				<textarea
					name="address"
					class="form-control"
					placeholder="Address"
					rows="4"
					required><?php echo $data["address"]; ?></textarea>
			</div>
			<div class="form-group">
				<input type="text"
					name="phone"
					class="form-control"
					placeholder="Phone"
					value="<?php echo $data["phone"]; ?>"
					required />
			</div>

			<hr />

			<div class="form-group">
				<a href="home.php"
					class="btn">
					Cancel
				</a>
				<input type="submit"
					name="update"			
					class="btn btn-primary"					
					value="Update" />
			</div>
		</form>
	</div>
</div>

<?php include 'inc/footer.php'; ?>