<?php 

		$db = new MySQLi('localhost', 'root', '', 'reservationsystem');
		
		if(isset($_POST['category']) && $_POST['category'] == 'ol-item'){
		
		$select_user = "SELECT * FROM users ";
		if(isset($_POST['name']) === true && empty($_POST['name']) === false){
			$select_user .= "WHERE username LIKE '" .
			mysql_real_escape_string(trim($_POST['name'])) . "%'";
		}
		
		$query = $db->query($select_user);

			$str = '<table border="2px" class="reservation-i">
				<thead>
					<th>Username</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Item </th>
					<th>Date</th>
					<th>Time</th>
					<th>Claim Date</th>
					<th>Claim Time</th>
					<th>Status</th>
					<th>Finish</th>
					<th>Delete</th>
				</thead>
				<tbody>';
						while ($users = $query->fetch_assoc()) {
							$query2 = $db->query("SELECT * FROM reservations WHERE user_id = " . $users['id'] . " ORDER BY id DESC");

							while ($results = $query2->fetch_assoc()) {
								$query3 = $db->query("SELECT * FROM items WHERE id = " . $results['item_id']);
								$data = $query3->fetch_assoc();
								
								$str .= "<tr>";
								$str .= "<td>" . $users['username'] . "</td>
										<td>" . $users['firstname'] . "</td>
										<td>" . $users['lastname'] . "</td>
										<td><a data-toggle='modal' data-target='#modal-item".$results['item_id'] . "' >" . $data['item_name'] . "</a></td>
										<td>" . $results['date'] . "</td>
										<td>" . $results['time'] . "</td>
										<td>" . $results['rdate'] . "</td>
										<td>" . $results['rtime'] . "</td>";
									
									?>

								  <div class="modal fade" id="modal-item<?php echo $results['item_id']; ?>" role="dialog">
								    <div class="modal-dialog">
								      <div class="modal-content modal-item">
								        <div class="modal-header">
								          <button type="button" class="close" data-dismiss="modal">&times;</button>
								          <h4 class="modal-title">Product Code <?php echo $results['item_id']; ?></h4>
								        </div>
								        <div class="modal-body">
								          	<img src='uploads/<?php echo $data['picture']; ?>' height='150px' width='300px'>
							                <p class="product-details">
							               		<strong>Product Name: </strong> <?php echo $data['item_name']; ?><br>
							                	<strong>Brand: </strong> <?php echo $data['brand']; ?><br>   	
							                	<strong>Style: </strong> <?php echo $data['style']; ?><br>
							                	<strong>Material: </strong> <?php echo $data['material']; ?><br>
							                	<strong>Color: </strong> <?php echo $data['color']; ?><br>
						                	</p>
								        </div>
								      </div>
								    </div>
								  </div>
								  <?php
								if($results['status'] == 'a'){
									$str .= '<td> <a href="admin_acknowledge.php?item=1&id=' . $results['id'] . '" class="btn btn-success">Cancel</a></td>';
								}
								else{
									$str .= '<td> <a href="admin_acknowledge.php?item=1&id=' . $results['id'] . '" class="btn btn-primary">Accept</a></td>';
								}
								if($results['finish'] == 'yes')
									$str .= '<td><a href="admin_finish_rsrv.php?item=1&id=' . $results['id'] . '" class="btn btn-info"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></td>';
								else
									$str .= '<td><a href="admin_finish_rsrv.php?item=1&id=' . $results['id'] . '" class="btn btn-warning"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>';
								
								$str .= '<td><a href="admin_delete_rsrv.php?item=1&id=' . $results['id'] . '" class="btn btn-danger">Delete</a></td>';
								$str .= "</tr>";									
							}


						}

				$str .= '</tbody>
					</table>';
		} elseif(isset($_POST['category']) && $_POST['category'] == 'ol-service') {
			
			$select_user = "SELECT * FROM users ";
			if(isset($_POST['name']) === true && empty($_POST['name']) === false){
				$select_user .= "WHERE username LIKE '" .
				mysql_real_escape_string(trim($_POST['name'])) . "%'";
			}
			
			$query = $db->query($select_user);
				
				$str = '<table border="2px" class="reservation">
				<thead>
					<th>Username</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Date</th>
					<th>Time</th>
					<th>Claim Date</th>
					<th>Claim Time</th>
					<th>Appointment</th>
					<th>Status</th>
					<th>Finish</th>
					<th>Delete</th>
				</thead>
				<tbody>';
						while ($users = $query->fetch_assoc()) {
							$query2 = $db->query("SELECT * FROM service_reserve WHERE user_id = " . $users['id'] . " ORDER BY id DESC");

							while ($results = $query2->fetch_assoc()) {
								$str .= "<tr>";
								$str .= "<td>" . $users['username'] . "</td>
										<td>" . $users['firstname'] . "</td>
										<td>" . $users['lastname'] . "</td>
										<td>" . $results['date'] . "</td>
										<td>" . $results['time'] . "</td>
										<td>" . $results['rdate'] . "</td>
										<td>" . $results['rtime'] . "</td>";
								$query3 = $db->query("SELECT services FROM service_list WHERE service_id = " . $results['id']);
								$str .= "<td class='last-column'>";
								while($service = $query3->fetch_assoc()){
									$str .= '<li>' . $service['services'] . '</li>';
								}
								$str .= "</td>";	

								if($results['status'] == 'a'){
									$str .= '<td> <a href="admin_acknowledge.php?service=1&id=' . $results['id'] . '" class="btn btn-success">Cancel</a></td>';
								}
								else{
									$str .= '<td> <a href="admin_acknowledge.php?service=1&id=' . $results['id'] . '" class="btn btn-primary">Accept</a></td>';
								}
								if($results['finish'] == 'yes')
									$str .= '<td><a href="admin_finish_rsrv.php?service=1&id=' . $results['id'] . '" class="btn btn-info"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></td>';
								else
									$str .= '<td><a href="admin_finish_rsrv.php?service=1&id=' . $results['id'] . '" class="btn btn-warning"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>';
								
								$str .= '<td><a href="admin_delete_rsrv.php?service=1&id=' . $results['id'] . '" class="btn btn-danger">Delete</a></td>';
								$str .= "</tr>";									
							}


						}

				$str .= '</tbody>
					</table>';

					// walk-in item

		}elseif(isset($_POST['category']) && $_POST['category'] == 'wi-item'){

		$select_user = "SELECT * FROM walk_in ";
		if(isset($_POST['name']) === true && empty($_POST['name']) === false){
			$select_user .= "WHERE last_name LIKE '" .
			mysql_real_escape_string(trim($_POST['name'])) . "%'";
		}
		
		$query = $db->query($select_user);

			$str = '<table border="2px" class="reservation-i">
				<thead>
					<th>Last Name</th>
					<th>First Name</th>
					<th>Item </th>
					<th>Date</th>
					<th>Time</th>
					<th>Claim Date</th>
					<th>Finish</th>
					<th>Delete</th>
				</thead>
				<tbody>';
						while ($users = $query->fetch_assoc()) {
							$query2 = $db->query("SELECT * FROM walkin_reservations WHERE walkin_id = " . $users['id'] . " ORDER BY id DESC");

							while ($results = $query2->fetch_assoc()) {
								$query3 = $db->query("SELECT * FROM items WHERE id = " . $results['item_id']);
								$data = $query3->fetch_assoc();

								$str .= "<tr>";
								$str .= "<td>" . $users['last_name'] . "</td>
										<td>" . $users['first_name'] . "</td>
										<td><a data-toggle='modal' data-target='#modal-item".$results['item_id'] . "' >" . $data['item_name'] . "</a></td>
										<td>" . $results['date'] . "</td>
										<td>" . $results['time'] . "</td>
										<td>" . $results['rdate'] . "</td>";
								?>
								  <div class="modal fade" id="modal-item<?php echo $results['item_id']; ?>" role="dialog">
								    <div class="modal-dialog">
								      <div class="modal-content modal-item">
								        <div class="modal-header">
								          <button type="button" class="close" data-dismiss="modal">&times;</button>
								          <h4 class="modal-title">Product Code <?php echo $results['item_id']; ?></h4>
								        </div>
								        <div class="modal-body">
								          	<img src='uploads/<?php echo $data['picture']; ?>' height='150px' width='300px'>
							                <p class="product-details">
							               		<strong>Product Name: </strong> <?php echo $data['item_name']; ?><br>
							                	<strong>Brand: </strong> <?php echo $data['brand']; ?><br>   	
							                	<strong>Style: </strong> <?php echo $data['style']; ?><br>
							                	<strong>Material: </strong> <?php echo $data['material']; ?><br>
							                	<strong>Color: </strong> <?php echo $data['color']; ?><br>
						                	</p>
								        </div>
								      </div>
								    </div>
								  </div>
								  <?php
								if($results['finish'] == 'yes')
									$str .= '<td><a href="admin_finish_rsrv.php?item=2&id=' . $results['id'] . '" class="btn btn-info"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></td>';
								else
									$str .= '<td><a href="admin_finish_rsrv.php?item=2&id=' . $results['id'] . '" class="btn btn-warning"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>';
								
									
								$str .= '<td><a href="admin_delete_rsrv.php?item=2&id=' . $results['id'] . '" class="btn btn-danger">Delete</a></td>';								$str .= "</tr>";									
							}


						}

				$str .= '</tbody>
					</table>';





		}elseif(isset($_POST['category']) && $_POST['category'] == 'wi-service') {
			$select_user = "SELECT * FROM walk_in ";
			if(isset($_POST['name']) === true && empty($_POST['name']) === false){
				$select_user .= "WHERE last_name LIKE '" .
				mysql_real_escape_string(trim($_POST['name'])) . "%'";
			}
			
			$query = $db->query($select_user);
				
				$str = '<table border="2px" class="reservation">
				<thead>
					<th>Last Name</th>
					<th>First Name</th>
					<th>Date</th>
					<th>Time</th>
					<th>Claim Date</th>
					<th>Appointment</th>
					<th>Finish</th>
					<th>Delete</th>
				</thead>
				<tbody>';
						while ($users = $query->fetch_assoc()) {
							$query2 = $db->query("SELECT * FROM walkin_service_reserve WHERE walkin_id = " . $users['id'] . " ORDER BY id DESC");

							while ($results = $query2->fetch_assoc()) {
								$str .= "<tr>";
								$str .= "<td>" . $users['last_name'] . "</td>
										<td>" . $users['first_name'] . "</td>
										<td>" . $results['date'] . "</td>
										<td>" . $results['time'] . "</td>
										<td>" . $results['rdate'] . "</td>";
								$query3 = $db->query("SELECT services FROM walkin_service_list WHERE service_id = " . $results['id']);
								$str .= "<td class='last-column'>";
								while($service = $query3->fetch_assoc()){
									$str .= '<li>' . $service['services'] . '</li>';
								}

								$str .= "</td>";	
								if($results['finish'] == 'yes')
									$str .= '<td><a href="admin_finish_rsrv.php?service=2&id=' . $results['id'] . '" class="btn btn-info"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></td>';
								else
									$str .= '<td><a href="admin_finish_rsrv.php?service=2&id=' . $results['id'] . '" class="btn btn-warning"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>';
								
									
								$str .= '<td><a href="admin_delete_rsrv.php?service=2&id=' . $results['id'] . '" class="btn btn-danger">Delete</a></td>';								$str .= "</tr>";							
								$str .= "</tr>";									
							}


						}

				$str .= '</tbody>
					</table>';

		}elseif(isset($_POST['category']) && $_POST['category'] == 'ol-clients') {

			$select_user = "SELECT * FROM users WHERE user_type = 'client' ";
			if(isset($_POST['name']) === true && empty($_POST['name']) === false){
				$select_user .= "AND username LIKE '" .
				mysql_real_escape_string(trim($_POST['name'])) . "%'";
			}
			
			$query = $db->query($select_user);
				
				$str = '<table border="2px" class="reservation-i">
				<thead>
					<th>Username</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Gender</th>
					<th>Contact No.</th>
					<th>Email</th>
					<th>Address</th>
					<th>Status</th>
				</thead>
				<tbody>';
						while ($users = $query->fetch_assoc()) {
							$str .= "<tr>";
							$str .= '<td>' . $users['username'] . '</td>
									<td>' . $users['firstname'] . '</td>
									<td>' . $users['lastname'] . '</td>
									<td>' . $users['gender'] . '</td>
									<td>' . $users['contact_number'] . '</td>
									<td>' . $users['email'] . '</td>
									<td>' . $users['address'] . '</td>';
									if($users['status'] == 'a'){
									$str .= '<td> <a href="admin_acknowledge.php?service=1&id=' . $users['id'] . '" class="btn btn-success">Activated</a></td>';
									}
									else{
										$str .= '<td> <a href="admin_acknowledge.php?service=1&id=' . $users['id'] . '" class="btn btn-danger">Deactived</a></td>';
									}
									
							$str .= "</tr>";
						}	

				$str .= '</tbody>
					</table>';


		}elseif(isset($_POST['category']) && $_POST['category'] == 'wi-clients') {

			$select_user = "SELECT * FROM walk_in WHERE walkin_type = 'client' ";
			if(isset($_POST['name']) === true && empty($_POST['name']) === false){
				$select_user .= "AND last_name LIKE '" .
				mysql_real_escape_string(trim($_POST['name'])) . "%'";
			}
			
			$query = $db->query($select_user);
				
				$str = '<table border="2px" class="reservation-i">
				<thead>
					<th>Last Name</th>
					<th>First Name</th>
					<th>Gender</th>
					<th>Contact No.</td>
					<th>Email</th>
					<th>Address</th>
					
				</thead>
				<tbody>';
						while ($users = $query->fetch_assoc()) {
							$str .= "<tr>";
							$str .= '<td>' . $users['last_name'] . '</td>
									<td>' . $users['first_name'] . '</td>
									<td>' . $users['gender'] . '</td>
									<td>' . $users['contact_number'] . '</td>
									<td>' . $users['email'] . '</td>
									<td>' . $users['address'] . '</td>';

							$str .= "</tr>";
						}	

				$str .= '</tbody>
					</table>';
		}
		echo $str;		
 ?>