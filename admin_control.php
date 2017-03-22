<?php 

	//security
	include 'function_notif.php';
	include 'function.php';
	include 'menu_no_js.php';
	if($user_level !=1){
		header('location: index.php');
	}

	?>
<!-- start navbar -->
		<nav class="navbar navbar-default nav-blue">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-tasks" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="#">Admin Tasks</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-tasks">
		      <ul class="nav navbar-nav">
		        <li ><a href="admin_control.php?category=3">Online Clients </a></li>
		        <li><a href="admin_control.php?category=4">Walk-In Clients</a></li>
		        <li><a href="admin_control.php?category=1">Online Reservation</a></li>
		        <li><a href="admin_control.php?category=2">Walk-in Reservation</a></li>
		        <li><a href="admin_control.php?category=5">Comments</a></li>
		      </ul>
		       <ul class="nav navbar-nav navbar-right">
		       	 <?php if(hasnotif()){ 
		       		echo '<li><button class="btn btn-warning btn-notif" data-toggle="modal" data-target="#notif">Notifications</button></li>';
		       		} else {
		       		echo '<li><button class="btn btn-success btn-notif" data-toggle="modal" data-target="#notif">Notifications</button></li>';
		       	} ?>
		       </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>

		  <!-- modal notif -->
		  <div class="modal fade" id="notif" role="dialog">
		    <div class="modal-dialog">
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Notification	</h4>
		        </div>
		        
		        <div class="modal-body notif-body">
		          <?php 
		          		include 'connect.php';
		          		$currentID;
		          		$currentUname; 
		          		$currentName;
		          		$currentDate; 
		          		$currentTime; 
		          		$currentMessage;
		          		$query = $db->query("SELECT * FROM notif WHERE status = 'unread' ORDER BY id DESC");
		          		$i = 0;
		          		while($notifs = $query->fetch_assoc()){
		          			$query2 = $db->query("SELECT * FROM users WHERE id = " . $notifs['user_id']);
		          			$users = $query2->fetch_assoc();
		          	?>
		          			<div class="notifications">
				          		<strong><?php echo $users['username']; ?></strong> 
			          			<?php
			          				if($notifs['type'] == 0){
			          					if($users['gender'] == 'male'){
				          					echo 'requested acceptance for his comment.';
			          					}
				          				else{
				          					echo 'requested acceptance for her comment.';
				          				}
				          				?>
			          					
			          				<a href="readnotif.php?id=<?php echo $notifs['id']; ?>&category=3" class="btn btn-info btn-sm ">Check</a>
			          					<?php
				          			}
			          				elseif($notifs['type'] == 1){
			          					echo 'has requested an item reservation.';
			          					?>
				          					<a href="readnotif.php?id=<?php echo $notifs['id']; ?>&category=1" class="btn btn-info btn-sm ">Check</a> 
				          				<?php
			          				}
			          				elseif($notifs['type'] == 2){
			          					echo 'has requested a service reservation.';
			          					?>
			          						<a href="readnotif.php?id=<?php echo $notifs['id']; ?>&category=2" class="btn btn-info btn-sm ">Check</a> 
			          					<?php
			          				}
			          				elseif($notifs['type'] == 3){
		          						echo 'have not logged in for 3 years';
		          						?>
			          					<a href="" class="btn btn-info btn-sm ">Check</a> 
			          					<?php
			          				}
			          			 ?>
				          		
				          		<br>
				          		<label class="date-time">Date: <?php echo $notifs['date']; ?> Time: <?php echo $notifs['time']; ?> </label>
				          	</div>
				   <?php
				   			$i++;
		          		}

		          		if($i == 0){
		          			?>
		          				<label  class="no-notif">There are no Notifications Yet . . .</label>

		          			<?php
		          		}
		           ?>
		        </div>
		      </div>
		    </div>
		  </div>
		  
	    <div class='table-view'>
			<?php 
			$db = new MySQLi('localhost', 'root', '', 'reservationsystem');
		    if(isset($_GET['category']))		
			 		if($_GET['category'] == 1){
			?>
			<!-- Item Reservations -->

		    <h1 class="reserve-view-head">Online Reservations</h1>
		    <?php if(isset($_GET['update']) && $_GET['update'] == 1){ ?>
		    <div class='container-fluid'>
		        <div class='alert alert-success'>
		            <a href='' class='close' data-dismiss='alert'>&times;</a>
		            <strong>Updated Successfully</strong> 
		        </div>
		    </div>
		    <?php } ?>	
			<h1 class="reserve-view-title">Items</h1>

			<label>Username: </label>
			<input type="text" id="searchbox-item-ol">
			<button id="view-ol-item" class="btn btn-sm btn-info">Search</button>
			<a href="printing/print.php?category=1" class="btn btn-sm btn-primary">Print Report</a>
			<br>
			<div class="js-contents-items">
				<?php

			$select_user = "SELECT * FROM users ";
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
				echo $str;
				?>
			</div>
		</div><!--  end column in item reservations -->
	</div> <!-- end row -->
	<div class="row">
		<div class="table-view">
					<!-- Online Service Reservations -->
			<h1 class="reserve-view-title">Services</h1>
			<label>Username: </label>
			<input type="text" id="searchbox-service-ol">
			<button id="view-ol-service" class="btn btn-sm btn-info">Search</button>
			<a href="printing/print.php?category=2" class="btn btn-sm btn-primary">Print Report</a>

			<br>
			<div class="js-contents-services">
			<?php 
			$select_user = "SELECT * FROM users ";
			
			
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
			
			echo $str;		
			 ?>
			</div>
		</div>
	</div>		<!-- End Category 1 -->
			<?php 
		}elseif($_GET['category'] == 2){
			?>
				<!-- Item Reservations -->
		    <h1 class="reserve-view-head">Walk-in Reservations</h1>	
				<h1 class="reserve-view-title">Items</h1>

				<label>Lastname: </label>
				<input type="text" id="searchbox-item-wi">
				<button id="view-wi-item" class="btn btn-sm btn-info">Search</button>
				<a href="printing/print.php?category=3" class="btn btn-sm btn-primary">Print Report</a>
				<br>
				<div class="js-contents-items-wi">
				<?php 
				
				$select_user = "SELECT * FROM walk_in ";		
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

	 				echo $str;
 				?>
				</div>
			</div><!--  end column in item reservations -->
		</div>
	<div class="table-view">
				
				<!-- Walk in Service Reservations -->
				<h1 class="reserve-view-title">Services</h1>
				<label>Last Name: </label>
				<input type="text" id="searchbox-service-wi">
				<button id="view-wi-service" class="btn btn-sm btn-info">Search</button>
				<a href="printing/print.php?category=4" class="btn btn-sm btn-primary">Print Report</a>
				<br>
				<div class="js-contents-services-wi">
				<?php 
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


				echo $str;		
	 			?>
				</div>
			</div>
		</div>	
					<!-- End Category 2 -->
				<?php
			 	} elseif($_GET['category'] == 3){
				?>
					<h1 class="reserve-view-title">Online Clients</h1>

					<label>Username: </label>
					<input type="text" id="searchbox-clients-ol">
					<button id="view-ol-clients" class="btn btn-sm btn-info">Search</button>
					<div class="js-contents-clients-ol">	
					<?php 
						$select_user = "SELECT * FROM users WHERE user_type = 'client' ";
			if(isset($_POST['name']) === true && empty($_POST['name']) === false){
				$select_user .= "AND username LIKE '" .
				mysql_real_escape_string(trim($_POST['name'])) . "%'";
			}
			
			$query = $db->query($select_user);
				
				$str = '<table border="2px" class="reservation">
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
									$str .= '<td> <a href="changeStatus.php?id=' . $users['id'] . '" class="btn btn-success">Activated</a></td>';
									}
									else{
										$str .= '<td> <a href="changeStatus.php?id=' . $users['id'] . '" class="btn btn-danger">Deactived</a></td>';
									}
									
							$str .= "</tr>";
						}	

				$str .= '</tbody>
					</table>';
					
				echo $str;

					 ?>
					</div>
				<?php 
				} elseif($_GET['category'] == 4){
				?>
					<h1 class="reserve-view-title">Walk-in Clients</h1>

					<label>Lastname: </label>
					<input type="text" id="searchbox-clients-wi">
					<button id="view-wi-clients" class="btn btn-sm btn-info">Search</button>
					<div class="js-contents-clients-wi">
					<?php 
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

				echo $str;
					 ?>
					</div>
				<?php 
				} elseif($_GET['category'] == 5){
					?>
					<h1 class="reserve-view-title">Comments</h1>
					<br>
					
					<?php 
					$select_comment = "SELECT * FROM comments WHERE status = 'not'";
					$query = $db->query($select_comment);
					
					$str = '<table border="2px" class="reservation">
					<thead>
						<th>Username</th>
						<th>Fullname</th>
						<th>Date</th>
						<th>Time</th>
						<th>Message</th>
						<th>Accept</th>
						<th>Delete</th>
					</thead>
					<tbody>';
							while ($comments = $query->fetch_assoc()) {
								$query2 = $db->query("SELECT * FROM users WHERE id = " . $comments['user_id']);
								$users = $query2->fetch_assoc(); 
								
									$str .= "<tr>";
									$str .= "<td>" . $users['username'] . "</td>
											<td>" . $users['firstname'] . ' ' . $users['lastname'] . "</td>
											<td>" . $comments['date'] . "</td>
											<td>" . $comments['time'] . "</td>
											<td>" . $comments['comment'] . "</td>";
									
								if($comments['status'] != 'accepted')
									$str .= '<td><a href="readnotif.php?id=<?php echo $currentID; ?>&category=0&accept=1&c_id=' . $comments['id'] . '" class="btn btn-primary btn-block">Accept</a></td>';
								else
									$str .= '<td><a class="btn btn-success btn-block">Accepted</a></td>';

									
										
								$str .= '<td><a href="deletecomment.php?id=' . $comments['id'] . '" class="btn btn-danger">Delete</a></td>';								$str .= "</tr>";							
								
								


							}

					$str .= '</tbody>
						</table>';


					echo $str;		

				}
	 			?>
				

	<script src="js/jquery-2.1.4.min.js" ></script>
	<script src="js/global.js"></script>
	 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	 
    <script src="js/bootstrap.min.js"></script>
        
