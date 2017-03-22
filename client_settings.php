<?php 

	//security

	include 'function.php';
	include 'menu.php';
		
	include 'connect.php';
	
	$sql2 = "SELECT * FROM `users` WHERE id = " . $my_id;
	$query2 = $db->query($sql2);
	$data = $query2->fetch_assoc();
?>
<?php 
			if(isset($_POST['submit1'])){
				$sql = "UPDATE `users` SET `password` = '".md5($_POST['newpass'])."' WHERE id=".$my_id;
				if(md5($_POST['current']) != $data['password']){

					echo "
								<div class='container-fluid'>
			                        <div class='alert alert-danger'>
			                            <a href='' class='close' data-dismiss='alert'>&times;</a>
			                            <strong></strong> Password Incorrect.
			                        </div>
			                    </div>
							";
			}else if (strlen($_POST['newpass']) < 6){
				echo "
					<div class='container-fluid'>
						<div class='alert alert-warning'>
					        <a href='' class='close' data-dismiss='alert'>&times;</a>
					        <strong>Notice: </strong> Your password is less than 6 characters
					    </div>
					</div>
				";
			}else
				echo "
					<div class='container-fluid'>
						<div class='alert alert-success'>
					        <a href='' class='close' data-dismiss='alert'>&times;</a>
					        <strong>Notice: </strong> password updated successfully
					    </div>
					</div>
				";
				$db->query($sql);
			}

			if(isset($_POST['submit'])){
				echo "
					<div class='container-fluid'>
						<div class='alert alert-success'>
					        <a href='' class='close' data-dismiss='alert'>&times;</a>
					        <strong>Notice: </strong> Name updated successfully
					    </div>
					</div>
				";
				$sql = "UPDATE `users` SET `firstname` = '".$_POST['fname']."', `lastname` = '".$_POST['lname']."' WHERE id=".$my_id;
				$db->query($sql);
			}
			if(isset($_POST['submit2'])){
				echo "
					<div class='container-fluid'>
						<div class='alert alert-success'>
					        <a href='' class='close' data-dismiss='alert'>&times;</a>
					        <strong>Notice: </strong> Email updated successfully
					    </div>
					</div>
				";
				$sql = "UPDATE `users` SET `email` = '".$_POST['email']."' WHERE id=".$my_id;
				$db->query($sql);
			}
			if(isset($_POST['contact-s'])){
				echo "
					<div class='container-fluid'>
						<div class='alert alert-success'>
					        <a href='' class='close' data-dismiss='alert'>&times;</a>
					        <strong>Notice: </strong> Contact updated successfully
					    </div>
					</div>
				";
				$sql = "UPDATE `users` SET `contact_number` = '".$_POST['contact']."' WHERE id=".$my_id;
				$db->query($sql);
			}	
			if(isset($_POST['submit3'])){
				echo "
					<div class='container-fluid'>
						<div class='alert alert-success'>
					        <a href='' class='close' data-dismiss='alert'>&times;</a>
					        <strong>Notice: </strong> Address updated successfully
					    </div>
					</div>
				";
				$sql = "UPDATE `users` SET `address` = '".$_POST['address']."' WHERE id=".$my_id;
				$db->query($sql);

			}

		 ?>
<h1 class="account-setting-title">ACCOUNT SETTINGS</h1>
<div class="col-lg-12 col-md-10 col-sm-8 col-xs-8">
		<div class="container-fluid">
							
						<div class="panel-group" id="accordion">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><label>Username: </label>
											<td id="pangit"><?php echo ' <label>'.$data['username'].'</label>'; ?></td>
											</a>
										</h4>
									</div>
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><label>Name: </label>
											<?php echo $data['firstname'].' '.$data['lastname']; ?>
											<label class="pull-right"><span class="glyphicon glyphicon-pencil"></span></label>
											</a>
										</h4>
									</div>
									<div id="collapse1" class="panel-collapse collapse">
										<div class="panel-body">
											<form method="POST">
												<table class="edit-account-table"align="center">
													<tr><td>First Name: </td><td><input type="text" name="fname"></td></tr>
													<tr><td>Last Name: </td><td><input type="text" name="lname"></td></tr>
													<tr><td></td><td><input class="btn btn-success pull-right" type="submit" name="submit" value="Submit"></td></tr>
												</table>
												</form>
								
										</div>
									</div>
									
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><label>Password: </label>
											<?php $data['password']; ?>
											<label class="pull-right"><span class="glyphicon glyphicon-pencil"></span></label>
											</a>
										</h4>
									</div>
									<div id="collapse3" class="panel-collapse collapse">
										<div class="panel-body">
											<form method="POST">
												<table class="edit-account-table"align="center">
													<tr><td>Current Password:</td> <td><input type="password" name="current"></td></tr>
													<tr><td>New Password:</td> <td><input type="password" name="newpass"></td></tr>
													<tr><td>Re-type New Password:</td><td><input type="password" name="newpass2"></td></tr>
													<tr><td></td><td><input class="btn btn-success pull-right" type="submit" name="submit1" value="Submit"></td>	</tr>
													
												</table>
											</form>
		
										</div>
									</div>
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse4"><label>Email: </label>
											<?php echo $data['email']; ?>
											<label class="pull-right"><span class="glyphicon glyphicon-pencil"></span></label>
											</a>
										</h4>
									</div>
									<div id="collapse4" class="panel-collapse collapse">
										<div class="panel-body">
											<form method="POST" align= "center">
												<table class="edit-account-table"align="center">
													<tr><td>Email</td><td><input type="text" name="email"></td></tr> 
													<tr><td></td><td><input class="btn btn-success pull-right" type="submit" name="submit2" value="Submit"></td></tr>
												</table>
											</form>
	
			 							</div>
									</div>
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse6"><label>Contact Number: </label>
											<?php echo $data['contact_number']; ?>
											<label class="pull-right"><span class="glyphicon glyphicon-pencil"></span></label>
											</a>
										</h4>
									</div>
									<div id="collapse6" class="panel-collapse collapse">
										<div class="panel-body">
											<form method="POST" align= "center">
												<table class="edit-account-table"align="center">
													<tr><td>Contact Number: </td><td><input type="text" name="contact"></td></tr> 
													<tr><td></td><td><input class="btn btn-success pull-right" type="submit" name="contact-s" value="Submit"></td></tr>
												</table>
											</form>
							</div>
									</div>
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse5"><label>Address: </label>
											<?php echo $data['address']; ?>
											<label class="pull-right"><span class="glyphicon glyphicon-pencil"></span></label>
											</a>
										</h4>
									</div>
									<div id="collapse5" class="panel-collapse collapse">
										<div class="panel-body">
											<form method="POST" align="center">
												<table class="edit-account-table"align="center">
													<tr><td>Address</td><td><input type="text" name="address"></td></tr> 
													<tr><td></td><td><input class="btn btn-success pull-right" type="submit" name="submit3" value="Submit"></td></tr>
												</table>
											</form>
										</div>
									</div>
								</div>
						</div>
			</div>
	</div>
