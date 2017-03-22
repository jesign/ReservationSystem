<?php 
	include "function.php";
	include "menu_no_js.php";

    if(!loggedin()){
    	header('location: login.php');
    }
    if($user_level !=1){
    	header('location: login.php');
    }
 	
	include 'connect.php';

	$sql = "SELECT * FROM items WHERE id = " . $_GET['id'];

	$query = $db->query($sql);
	$data = $query->fetch_assoc();
	$id = $data['id'];

	date_default_timezone_set('Asia/Manila');
	$name = $data['item_name'];
	$date = date("Y-m-d");
	$time = date("h:i:sa");		

	$db->close();

	if(isset($_GET['reserve'])){
		if($_GET['reserve'] == 1){	
			echo "
					<div class='container-fluid'>
						<div class='alert alert-success'>
					        <a href='' class='close' data-dismiss='alert'>&times;</a>
					        <strong></strong> Reserved Successfully.
					    </div>
					</div>
				";
		} elseif($_GET['reserve'] == 2){
			echo "
					<div class='container-fluid'>
						<div class='alert alert-danger'>
					        <a href='' class='close' data-dismiss='alert'>&times;</a>
					        <strong></strong> The date can only be set 10 days from now.
					    </div>
					</div>
				";
		} elseif($_GET['reserve'] == 3) {
			echo "
					<div class='container-fluid'>
						<div class='alert alert-danger'>
					        <a href='' class='close' data-dismiss='alert'>&times;</a>
					        <strong></strong> Please check the Date.
					    </div>
					</div>
				";
		} elseif($_GET['reserve'] == 4){
			echo "
					<div class='container-fluid'>
						<div class='alert alert-danger'>
					        <a class='close' data-dismiss='alert'>&times;</a>
					        <strong></strong> No product Selected <a href='products.php'>Select Product Now</a>
					    </div>
					</div>
				";
		} elseif($_GET['reserve'] == 5){
			echo "
					<div class='container-fluid'>
						<div class='alert alert-danger'>
					        <a class='close' data-dismiss='alert'>&times;</a>
					        <strong></strong> Please Enter the services to be reserved.
					    </div>
					</div>
				";
		} elseif ($_GET['reserve'] == 6) {
			echo "
					<div class='container-fluid'>
						<div class='alert alert-danger'>
					        <a class='close' data-dismiss='alert'>&times;</a>
					        <strong></strong> Please Enter the services to be reserved.
					    </div>
					</div>
				";
		}

	}



	 ?>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!-- 
    
    <script> $(document).ready(
  
		  /* This is the function that will get executed after the DOM is fully loaded */
		  function () {
		    $( ".datepicker" ).datepicker({
		      changeMonth: true,//this option for allowing user to select month
		      changeYear: true //this option for allowing user to select from year range
		    });
		    
		  }
		 

		);
  
    </script>
    -->
    


 	<div class="container reservation-background">
	
		<?php 
			if ($_GET['id']!=0) {
		 ?>

		 <!-- item reservation -->

 		<center><h2>Walk-in Reservation - <?php 
 					if(isset($_GET['walkin_id'])){
 						
	 				
	 				$view = "SELECT * FROM walk_in WHERE id = " . $_GET['walkin_id'];
	 				$vquery = $db->query($view);
	 				$walkin = $vquery->fetch_assoc();
	 				echo $walkin['first_name'] . ' ' . $walkin['last_name'];
	 				
 					}

	 				 ?></h2></center>
 		<div class="detailbox">
 			<div class="row">
 				<div class="col-md-6">	
					<p>
						<img src='uploads/<?php echo $data['picture']; ?>' height='150px' width='300px'><br>
						<strong>Product Code: </strong> <?php echo $data['id']; ?> <br>
						<strong>Product Name: </strong><?php echo $data['item_name']; ?><br>
						<strong>Classification: </strong> Eyeglass<br>
						<strong>Specifications: </strong> <br>
						<strong>Brand: </strong> <?php echo $data['brand']; ?><br>   	
			        	<strong>Style: </strong> <?php echo $data['style']; ?><br>
			        	<strong>Material: </strong> <?php echo $data['material']; ?><br>
			        	<strong>Color: </strong> <?php echo $data['color']; ?><br>
			        	<strong>Gender: </strong> <?php echo $data['gender']; ?><br>
					</p>
	 			</div>
	 			<div class="col-md-6">
		 			<form action="admin_reserve.php" method="POST">
                        <input type="hidden" name="walkin_id" value="<?php echo $_GET['walkin_id']; ?>">
				 		<input type="hidden" name="item_id" value="<?php echo $_GET['id'];?>">
				 		<input type="hidden" name="date" value="<?php echo $date;?>">
				 		<input type="hidden" name="time" value="<?php echo $time; ?>">
						<div class="form-group">
				 			<!-- <label>Date to claim: <input type="text" class="datepicker" name="datepicker"/></label> -->
				 			<p>Claim Date: <input type="text" id="dp-wi-item" name="datepicker"/></p>
				 			<p>Claim Time: <input type="text" id="tp-wi-item" name="timepicker"/></p>
				 		</div>
				 		<div class="form-group">
				 			<input class = "btn btn-success" type="submit" name="reserve" value="Reserve">
				 		</div>
				 	</form>
				 	<label>
				 		<div id="sched-wi-item">
				 			
				 		</div>
				 	</label>
	 			</div>
 			</div>

 		</div>
		<?php 
			} else {
		 ?>
		 <!-- service reservation -->
 		<div >
 			<center><h2>Walk-in Reservation - <?php 
	 				include 'connect.php';
 					if(isset($_GET['walkin_id'])){
 						
	 				$view = "SELECT * FROM walk_in WHERE id = " . $_GET['walkin_id'];
	 				$vquery = $db->query($view);
	 				$walkin = $vquery->fetch_assoc();
	 				echo $walkin['first_name'] . ' ' . $walkin['last_name'];
	 				
 					}

	 				 ?></h2></center>
 			<div class="detailbox">
	 			<div class="row">
	 				<div class="col-md-6">
	 					
						<form method="post" action="admin_reserve.php">
		                        <label ><strong>Choose: </strong></label><br>
							<div class="form-group">
		                      		<input type="checkbox" name="service_list[]" value="Eyeglass Repair"> Eyeglass Repair<br>
		                      		<input type="checkbox" name="service_list[]" value="Lens Troubleshooting"> Lens Troubleshooting<br>
		                      		<input type="checkbox" name="service_list[]" value="Contact Lens Fitting"> Contact Lens Fitting<br>
		                      		<input type="checkbox" name="service_list[]" value="Eye Refraction"> Eye Refraction<br>
		                      		<input type="checkbox" name="service_list[]" value="Cataract Screening"> Cataract Screening<br>
		                        <p>Others: </p>
		                        <textarea placeholder="You may specify here.."rows="5" cols="50" class="textarea" maxlength="200" name="others"></textarea>
		                    </div>
	 				</div>
	 				<div class="col-md-6">
						 		<p>Appointment Date: <input type="text" id="dp-wi-service" name="datepicker"/></p>
						 		<p>Appointment Time: <input type="text" id="tp-wi-service" name="timepicker"/></p>
					 			<input type="hidden" name="walkin_id" value="<?php echo $_GET['walkin_id']; ?>">
			                    <input type="hidden" name="user_id" value="<?php echo $my_id; ?>">
						 		<input type="hidden" name="date" value="<?php echo $date;?>">
						 		<input type="hidden" name="time" value="<?php echo $time; ?>">
		                    <div class="form-group">
		                    	<input class = "btn btn-success" type="submit" name="service" value="Reserve">
		                    </div>
						</form>
						<label>
				 		<div id="sched-wi-service">
				 			
				 		</div>
				 	</label>
	 				</div>
	 			</div>
 			</div>
 		</div>

 		<?php
 		$db->close();
 		 } ?>
 	
	 </div>
	<script src="js/jquery-2.1.4.min.js"></script>
 	<script src="js/jquery.timepicker.js"></script>
	<script src="js/global.js"></script>

    
    <!-- Load jQuery JS 
    -->
    
    <!-- Load jQuery UI Main JS  
    -->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    
	<script src="js/bootstrap.min.js"></script>
</body>
</html>