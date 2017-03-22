<?php 
	include 'function.php';
	include 'connect.php';

	$sql = "SELECT * FROM items";

	$query = $db->query($sql);

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>
	</title>
</head>
<body>

<?php 
	include 'menu.php';
 ?>
	<table border="2px">
		<thead>
			<th>ID</th>
			<th>Item Name</th>
			<th>Item Type</th>
			<th>Quantity</th>
			<th>Description</th>
			<th>Reserve</th>
		</thead>
		<tbody>
			<?php 
				while ($data = $query->fetch_assoc()) {

					echo '<tr>';
					echo '<td>' . $data['id'] .  '</td>';
					echo '<td>' . $data['item_name'] .  '</td>';
					echo '<td>' . $data['item_name'] .  '</td>';
					echo '<td>' . $data['item_quantity'] . '</td>';
					echo "<td><img src='uploads/".$data['picture']."' height='150px' width='300px'></td>";
					echo '<td><a href="reservation.php?id=' . $data['id'] .  '">reserve</a></td>';
					echo '</tr>';
				}

			 ?>
		</tbody>
</body>
</html>
<?php
				$db->close();
				// $db->close();
	
	?>