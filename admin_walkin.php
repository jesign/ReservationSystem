<?php
	include "function.php";
		include "menu.php";

	    if(!loggedin()){
	    	header('location: login.php');
	    }
	    if($user_level !=1){
	    	header('location: login.php');
	    }
	    include 'connect.php';
	
		$sql2 = "SELECT * FROM walk_in";
		$query2 = $db->query($sql2);

		if(isset($_POST['add'])){
			$fname = $_POST['firstname'];
			$lname = $_POST['lastname'];
			$contact = $_POST['contact'];
			$email = $_POST['email'];
			$address = $_POST['address'];

			$sql = "INSERT INTO walk_in (first_name, last_name, contact_number, email, address, walkin_type)
					VALUES ('$fname', '$lname', '$contact', '$email', '$address', 'not')";

			$db->query($sql);
			header("location: admin_walkin.php?id=" . $_GET['id']);
		}

	?>
	<div class="row">
		<div class="col-lg-6">
		<h2>Walk-in Clients</h2>
			<table border="2px" class="reservation">
				<thead>
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Contact Number</th>
					<th>Action</th>
					
				</thead>
				<tbody>
					<?php 
						while ($data = $query2->fetch_assoc()) {
							echo '<tr>';
								echo '<td>' . $data['id'] .  '</td>';
								echo '<td>' . $data['first_name'] .  '</td>';
								echo '<td>' . $data['last_name'] .  '</td>';
								echo '<td>' . $data['contact_number'] .  '</td>';
								echo "<td><a href='admin_walkin_reserve.php?walkin_id=" . $data['id'] ."&id=" . $_GET['id'] . "' class='btn btn-info'>Choose</a></td>";

							echo '</tr>';
						}

					 ?>
				</tbody>
			</table>
		</div> 
		<div class="col-lg-6">
			<h2>Add Client</h2>
			<form method="POST">
				<div class="container-fluid">
					<div class="form-group">
	                    <input type="text" name="firstname" class="form-control" id="exampleInputfname" placeholder="First Name">        
	                </div>
	                <div class="form-group">
	                    <input type="text" name="lastname" class="form-control" id="exampleInputfname" placeholder="Last Name">        
	                </div>
	                <div class="form-group">
	                    <input type="text" name="contact" class="form-control" id="exampleInputLname" placeholder="Contact Number">        
	                </div>
	                <div class="form-group">
	                    <input type="email" name="email" class="form-control" id="exampleInputLname" placeholder="Email">        
	                </div>
	                <div class="form-group">
	                    <input type="text" name="address" class="form-control" id="exampleInputLname" placeholder="Address">        
	                </div>

	                <div class="form-group">
	                	<button type="submit" name="add" class="btn btn-success btn-lg btn-block">Add</button>
	                </div> 
				</div>
		                
				
			</form>
		</div>	
	</div>
		
