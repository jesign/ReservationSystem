<?php 

	//security

	include 'function.php';
	include 'menu.php';
	
	if($user_level !=1){
		header('location: index.php');
	}

	?>
	<div class="row">
		<div class="col-lg-2">
			
			<strong>Reservation</strong><br>
			<a href="admin_reservation.php?category=1">Item</a><br>
			<a href="admin_reservation.php?category=2">Service</a><br>
			<a href="admin_reservation.php?category=3">Walk-in</a>
		</div>
		<div class="col-lg-10">
			

			<?php
			date_default_timezone_set('Asia/Manila');
		    $date = date("Y-m-d");

			include 'connect.php';

			$sql2 = "SELECT * FROM reservations ";
			$query2 = $db->query($sql2);


			if(isset($_GET['cancel'])){
				if($_GET['cancel'] == 1){ ?>
					<div class='container-fluid'>
										<div class='alert alert-success'>
									        <a href='' class='close' data-dismiss='alert'>&times;</a>
									        <strong></strong>  Reservation Deleted Successfully
									    </div>
									</div>
									<?php
				}
			}

			if(isset($_GET['category']))		
		 	?>
			<h2>Item Reservations</h2>
			<table border="2px" class="reservation">
				<thead>
					<th>ID</th>
					<th>User ID</th>
					<th>Username</th>
					<th>Full Name</th>
					<th>Item ID</th>
					<th>Date</th>
					<th>Time</th>
					<th>Reserve Date</th>
					<th>Accept</th>
					<th>Delete</th>
					
				</thead>
				<tbody>
					<?php 
						while ($data = $query2->fetch_assoc()) {
							echo '<tr>';
							echo '<td>' . $data['id'] .  '</td>';
							echo '<td>' . $data['user_id'] .  '</td>';

							$user = "SELECT * FROM users WHERE id = " . $data['user_id'];
							$query = $db->query($user);
							$username = $query->fetch_assoc();
							echo '<td>' . $username['username'] .  '</td>';
							echo '<td>' . $username['firstname'] . ' ' . $username['lastname'] . '</td>';
							echo '<td>' . $data['item_id'] .  '</td>';
							echo '<td>' . $data['date'] . '</td>';
							echo '<td>' . $data['time'] .  '</td>';
							echo '<td>' . $data['rdate'] .  '</td>';
							if($data['status'] == 'a')
								echo '<td> <a href="admin_acknowledge.php?item=1&id=' . $data['id'] . '">Cancel</a></td>';
							else
								echo '<td> <a href="admin_acknowledge.php?item=1&id=' . $data['id'] . '">Accept</a></td>';
							echo '<td> <a href="delete_reservation.php?item=1&id=' . $data['id'] . '">Delete</a></td>';
							echo '</tr>';
						}

					 ?>
				</tbody>
			</table>

			<?php 
			
			$sql = "SELECT * FROM service_reserve";
			$query = $db->query($sql);

		 	?>

			<h2>Service Reservations</h2>
			<table border="2px" class="reservation">
				<thead>
					<th>ID</th>
					<th>User ID</th>
					<th>Username</th>
					<th>Date</th>
					<th>Time</th>
					<th>Reserve Date</th>
					<th>Accept</th>
					<th>Delete</th>
				</thead>
				<tbody>
					<?php 
						while ($data = $query->fetch_assoc()) {
							echo '<tr>';
							echo '<td>' . $data['id'] .  '</td>';
							echo '<td>' . $data['user_id'] .  '</td>';

							$user = "SELECT * FROM users WHERE id = " . $data['user_id'];
							$query3 = $db->query($user);
							$username = $query3->fetch_assoc();
							echo '<td>' . $username['username'] .  '</td>';
							echo '<td>' . $data['date'] . '</td>';
							echo '<td>' . $data['time'] .  '</td>';
							echo '<td>' . $data['rdate'] .  '</td>';
							if($data['status'] == 'a')
								echo '<td> <a href="admin_acknowledge.php?item=0&id=' . $data['id'] . '">Cancel</a></td>';
							else
								echo '<td> <a href="admin_acknowledge.php?item=0&id=' . $data['id'] . '">Accept</a></td>';

							echo '<td> <a href="delete_reservation.php?item=0&id=' . $data['id'] . '">Delete</a></td>';
							echo '</tr>';
							echo '</tr>';
						}

					 ?>
				</tbody>
			</table>
		</div>
	</div>
	
	<?php 
		include "javascripts.php";
	 ?>