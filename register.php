<!DOCTYPE html>
<html>
<head>
	<title>
		Register
	</title>
</head>
<body>
<?php 

	include 'function.php';
	include 'menu.php';
 ?>

<?php
	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$password2= md5($_POST['password2']);
		$firstname = $_POST['fname'];
		$lastname = $_POST['lname'];
		$email = $_POST['email'];
		$contact = $_POST['contact'];
		$gender = $_POST['gender'];
		$address = $_POST['address'];

		include "connect.php";

		$check_login = $db->query("SELECT id, status FROM users WHERE username = '$username'");
		 
		if(empty($username) or empty($password)  or empty($password2) or empty($firstname) or empty($lastname) or empty($email) or empty($gender) or empty($address) ){
			echo "
				<div class='container-fluid'>
					<div class='alert alert-warning'>
				        <a class='close' data-dismiss='alert'>&times;</a>
				        <strong>Notice: </strong> Some Fields are Empty!
				    </div>
				</div>
				";
		}else if($run = $check_login->fetch_assoc()){ 
			echo "
				<div class='container-fluid'>
					<div class='alert alert-warning'>
				        <a class='close' data-dismiss='alert'>&times;</a>
				        <strong>Notice: </strong> Username Already Existed;
				    </div>
				</div>
				";

		}else if ($password != $password2){
			echo "
				<div class='container-fluid'>
					<div class='alert alert-warning'>
				        <a href='' class='close' data-dismiss='alert'>&times;</a>
				        <strong>Notice: </strong> Please check your password
				    </div>
				</div>
			";
		} else if (strlen($_POST['password']) < 6){
			echo "
				<div class='container-fluid'>
					<div class='alert alert-warning'>
				        <a href='' class='close' data-dismiss='alert'>&times;</a>
				        <strong>Notice: </strong> Your password is less than 6 characters
				    </div>
				</div>
			";
		}else if (strlen($_POST['username']) > 20){
			echo "
				<div class='container-fluid'>
					<div class='alert alert-warning'>
				        <a href='' class='close' data-dismiss='alert'>&times;</a>
				        <strong>Notice: </strong> Username exceeded to the maximum number of characters
				    </div>
				</div>
			";
		}else {

			

			$sql = "INSERT INTO `users`(`username`, `password`, `user_level`, `status`, `firstname`, `lastname`, `contact_number` ,`email`, `gender`, `address`,`user_type`)
				 VALUES ('$username','$password','2','a','$firstname','$lastname','$contact','$email', '$gender','$address', 'not')";

			if($query = $db->query($sql))
			echo "
				<div class='container-fluid'>
					<div class='alert alert-success'>
				        <a href='' class='close' data-dismiss='alert'>&times;</a>
				        <strong></strong> Successfully Registered
				    </div>
				</div>
			";
			else
				echo "
				<div class='container-fluid'>
					<div class='alert alert-success'>
				        <a href='' class='close' data-dismiss='alert'>&times;</a>
				        <strong></strong> Failed to Register
				    </div>
				</div>
			";
		}
	}	
?>

	<div class="container register">
        <div class="row"></div>
        <div class="col-lg-offset-3 col-lg-6 ">
            <div class="panel panel-primary">
            	<div class="panel-heading">
            		<h3 class="panel-title">Sign Up</h3>
            	</div>
            	<div class="panel-body">
            		
		            <form role="form" method="POST">
		                <div class="form-group">
		                    <label for="exampleInputuname">User Name</label>
		                    <input type="text" name="username" class="form-control" id="exampleInputfname" placeholder="Enter Username">        
		                </div>
		                <div class="form-group">
		                    <label for="exampleInputFname">First Name</label>
		                    <input type="text" name="fname" class="form-control" id="exampleInputfname" placeholder="Enter First Name">        
		                </div>
		                <div class="form-group">
		                    <label for="exampleInputLname">Last Name</label>
		                    <input type="text" name="lname" class="form-control" id="exampleInputLname" placeholder="Enter Last Name">        
		                </div> 
		                <div class="form-group">
		                    <label for="exampleInputPassword1">Password</label>
		                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">        
		                </div>
		                <div class="form-group">
		                    <label for="exampleInputPassword1">Confirm Password</label>
		                    <input type="password" name="password2" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">        
		                </div>
		                <div class="form-group">
		                    <label for="exampleInputEmail1">Contact Number</label>
		                    <input type="text" name="contact" class="form-control" id="exampleInputcontact" placeholder="Enter Contact Number">        
		                </div>
		                <div class="form-group">
		                    <label for="exampleInputEmail1">Email address</label>
		                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Email">        
		                </div>
		                <div class="form-group">
		                    <label for="exampleInpangiutGender">Gender</label><br />
		                    <label><input type="radio" name="gender" id="exampleInputGender" value="male" checked> Male </label>
		                    <label><input type="radio" name="gender" id="exampleInputGender" value="female"> Female </label>
		                </div>
		                <div class="form-group">
		                    <label for="exampleInputGender">Address</label>
		                    <input type="text" name="address" class="form-control" id="exampleInputAddress" placeholder="Enter Address">        
		                </div>
		                
		                <button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Register</button>
		            </form>
            	</div>
            </div>
        </div>
    </div>


</body>
</html>