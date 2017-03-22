<?php 

	//security

	include 'function.php';
	include 'menu.php';
	
	if($user_level != 2){
		header('location: index.php');
	}
 	
	include 'connect.php';
	
	$sql2 = "SELECT * FROM reservations WHERE user_id = " . $my_id . " ORDER BY id DESC";
	$query2 = $db->query($sql2); 	

	if(isset($_GET['cancel'])){
		if($_GET['cancel'] == 1){ ?>
			<div class='container-fluid'>
								<div class='alert alert-success'>
							        <a href='' class='close' data-dismiss='alert'>&times;</a>
							        <strong></strong>  Reservation cancelled Successfully
							    </div>
							</div>
							<?php
		}
	}

 ?>
	<div class="client-reservation">
		
	<h2>Item Reservations</h2>
		<table border="2px" class="reservation">
			<thead>
				<th>Username</th>
				<th>Full Name</th>
				<th>Item ID</th>
				<th>Date</th>
				<th>Time</th>
				<th>Reserve Date</th>
				<th>Reserve Time</th>
				<th>Accepted</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php 
					while ($data = $query2->fetch_assoc()) {
						echo '<tr>';
							$user = "SELECT * FROM users WHERE id = " . $data['user_id'];
							$query = $db->query($user);
							$username = $query->fetch_assoc();
							echo '<td>' . $username['username'] .  '</td>';
							echo '<td>' . $username['firstname'] . ' ' . $username['lastname'] . '</td>';
							echo '<td>' . $data['item_id'] .  '</td>';
							echo '<td>' . $data['date'] . '</td>';
							echo '<td>' . $data['time'] .  '</td>';
							echo '<td>' . $data['rdate'] .  '</td>';
							echo '<td>' . $data['rtime'] .  '</td>';
							if($data['status'] == 'a')
								echo '<td><label style="color: blue;">Accepted</label></td>';
							else
								echo '<td><label style="color: red;">Not yetAccepted</label></td>';
							echo '<td><a class="btn btn-danger" href="delete_reservation.php?item=1&id=' . $data['id'] .'">Cancel</a></td>'; 
						echo '</tr>';
					}

				 ?>
			</tbody>
		</table>
	<?php 
		
		$sql = "SELECT * FROM service_reserve WHERE user_id = " . $my_id . " ORDER BY id DESC";
		$query = $db->query($sql);

	 ?>

	<h2>Service Reservations</h2>
		<table border="2px" class="reservation">
			<thead>
				
				<th>Username</th>
				<th>Full Name</th>
				<th>Date</th>
				<th>Time</th>
				<th>Reserve Date</th>
				<th>Reserve Time</th>
				<th>Service</th>
				<th>Accepted</th>
				<th>Action</th>			
			</thead>
			<tbody>
				<?php 
					while ($data = $query->fetch_assoc()) {
						echo '<tr>';
						$user = "SELECT * FROM users WHERE id = " . $data['user_id'];
						$query3 = $db->query($user);
						$username = $query3->fetch_assoc();
						echo '<td>' . $username['username'] .  '</td>';
						echo '<td>' . $username['firstname'] . ' ' . $username['lastname'] . '</td>';
						echo '<td>' . $data['date'] . '</td>';
						echo '<td>' . $data['time'] .  '</td>';
						echo '<td>' . $data['rdate'] .  '</td>';
						echo '<td>' . $data['rtime'] .  '</td>';
						$query3 = $db->query("SELECT services FROM service_list WHERE service_id = " . $data['id']);
									echo "<td class='last-column'>";
									echo '<ul>';
									while($service = $query3->fetch_assoc()){
										echo '<li>' . $service['services'] . '</li>';
									}
									echo '</ul>';

						echo '</td>';
						if($data['status'] == 'a')
							echo '<td><label style="color: blue;">Accepted</label></td>';
						else
							echo '<td><label style="color: red;">Not yetAccepted</label></td>';
						echo '<td><a class="btn btn-danger" href="delete_reservation.php?item=0&id=' . $data['id'] .'">Cancel</a></td>'; 
						echo '</tr>';

					}

				 ?>
			</tbody>
		</table>
	</div>