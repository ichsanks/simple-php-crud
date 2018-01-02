<?php

require_once("inc/session.php");
require_once('inc/class.crud.php');

$crud = new CRUD();

?>

<?php include 'inc/header.php'; ?>
<?php include 'inc/navbar.php'; ?>

<div class="content-header">
	<div class="container">
		<a href="add.php"
			class="btn">
			Add customer
		</a>
	</div>
</div>

<div class="content-body">
	<div class="container">		
		<table class="table">
			<thead>
				<tr>
					<th>Customer name</th>
					<th>Place and date of birth</th>
					<th>Gender</th>
					<th>Address</th>
					<th>Phone</th>
					<th style="width:100px"></th>
				</tr>
			</thead>
			<tbody>
				<?php

				$data = $crud->getData();

				foreach($data as $row) {

				?>
				<tr>
					<td><?php echo $row["name"]; ?></td>
					<td><?php echo $row["place_of_birth"].', '.$row["date_of_birth"]; ?></td>
					<td><?php echo $row["gender"] == "M" ? "Male" : "Female"; ?></td>
					<td><?php echo $row["address"]; ?></td>
					<td><?php echo $row["phone"]; ?></td>
					<td class="text-right">
						<a href="edit.php?id=<?php echo $row["customer_id"]; ?>">Edit</a>
						<a href="actions/delete.php?id=<?php echo $row["customer_id"]; ?>">Hapus</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<?php include 'inc/footer.php'; ?>