<?php require_once("inc/session.php"); ?>

<?php include 'inc/header.php'; ?>

<?php include 'inc/navbar.php'; ?>

<div class="content-body">
	<div class="container">

		<form method="POST"
			enctype="multipart/form-data"
			action="actions/insert.php">

			<div class="form-group">
				<input type="text"
					name="name"
					class="form-control"
					placeholder="Customer name"
					required />
			</div>
			<div class="form-group">
				<label>
					<input type="radio"
						name="gender"
						value="M"
						checked />
						Male
				</label>
				<label>
					<input type="radio"
						name="gender"
						value="F" />
						Female
				</label>
			</div>
			<div class="form-group">
				<input type="text"
					name="place-of-birth"
					class="form-control"
					placeholder="Place of birth"
					required />
			</div>
			<div class="form-group">
				<input type="text"
					name="date-of-birth"
					class="form-control"
					placeholder="Date of birth (yyyy-mm-dd)"
					required />
			</div>
			<div class="form-group">
				<textarea
					name="address"
					class="form-control"
					placeholder="Address"
					rows="4"
					required></textarea>
			</div>
			<div class="form-group">
				<input type="text"
					name="phone"
					class="form-control"
					placeholder="Phone"
					required />
			</div>

			<hr />

			<div class="form-group">
				<a href="home.php"
					class="btn">
					Cancel
				</a>
				<input type="submit"
					name="submit"			
					class="btn btn-primary"					
					value="Save" />
			</div>

		</form>
		
	</div>
</div>

<?php include 'inc/footer.php'; ?>