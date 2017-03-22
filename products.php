<?php 
    include 'function.php';
    include 'menu.php';
 ?>
				 <div class="row">
					 <div class="col-lg-3 col-md-3">
					 	<div class="container-fluid">
					 		<div id = "pro" class="hidden-xs">
					 			<a href="products.php?start=0&pro=1" class="btn btn-info btn-md">All</a>
					 			<a href="products.php?start=0&pro=2" class="btn btn-info btn-md">New Arrivals</a>
					 			<a href="products.php?start=0&pro=3" class="btn btn-info btn-md">Best Sellers</a>
					 			<a href="products.php?start=0&pro=4" class="btn btn-info btn-md">Trends</a>
					 		</div>
					 		<div id = "pro" class="visible-xs">
					 			<a href="products.php?start=0&pro=1" class="btn btn-info btn-sm">All</a>
					 			<a href="products.php?start=0&pro=2" class="btn btn-info btn-sm">New Arrivals</a>
					 			<a href="products.php?start=0&pro=3" class="btn btn-info btn-sm">Best Sellers</a>
					 			<a href="products.php?start=0&pro=4" class="btn btn-info btn-sm">Trends</a>
					 		</div>
					 	</div>
					 </div>
				</div>	            
				<div id="eyeglass">
	            <?php 
	            include 'connect.php';
	            
	             ?>
	            	<div class="container-fluid ">
	                	<h2><strong>FRAMES</strong></h2>
	            	</div>
	            <?php 
	            	$sql = "SELECT * FROM items ";
	            	if($_GET['pro'] == 2){
	            		$sql .= " WHERE `item_type` = 1 ";
	            	}elseif($_GET['pro'] == 3){
	            		$sql .= " WHERE `item_type` = 2 ";
	            	}elseif($_GET['pro'] == 4){
	            		$sql .= " WHERE `item_type` = 3 ";
	            	}
					$query = $db->query($sql);

						$start = $_GET['start'];
						$i = 1;
						$limit = 0;
						while ($data = $query->fetch_assoc()) {
						
							if($i >= $start){
								if($limit == 9)
									break;
						?>
					            <div class="col-md-4 col-sm-6 container" >
						            <div class="product-box">
							            <center>
							            	<img src='uploads/<?php echo $data['picture']; ?>' class="img-responsive product-image" >
							                <p class="product-details">
							                	<?php if($data['item_type'] == 1){ ?> 
														<label style="color:yellow; font-size: 20px;">New Arrival</label><br>
						                		<?php }elseif($data['item_type'] == 2){ ?>
						                				<label style="color:blue; font-size: 20px;">Best Seller</label><br>
				                				<?php }elseif($data['item_type'] == 3){ ?>
					                					<label style="color:green; font-size: 20px;">Trends</label><br>
				                				<?php } ?>
							               		<strong>Product Name: </strong> <?php echo $data['item_name']; ?><br>
							                	<strong>Brand: </strong> <?php echo $data['brand']; ?><br>   	
							                	<strong>Style: </strong> <?php echo $data['style']; ?><br>
							                	<strong>Material: </strong> <?php echo $data['material']; ?><br>
							                	<strong>Color: </strong> <?php echo $data['color']; ?><br>
							                	<strong>Gender: </strong> <?php echo $data['gender']; ?><br>
						                	</p>
							            </center>
							            <?php 
						            if(loggedin()){
							            if($user_level!=1){ ?>
					                	<a class="btn btn-warning hidden-xs reserve-button" href="reservation.php?id=<?php echo $data['id']; ?>">Reserve</a>
					                	<a class="btn btn-warning visible-xs btn-sm reserve-button" href="reservation.php?id=<?php echo $data['id']; ?>">Reserve</a>
					                	<?php }else{ ?>
					                	<a class="btn btn-warning hidden-xs reserve-button" href="admin_walkin.php?id=<?php echo $data['id']; ?>">Reserve</a>
					                	<a href="editItem.php?id=<?php echo $data['id']; ?>" class="btn btn-success hidden-xs">Update</a>
					                	<a href="deleteItem.php?pro=1&id=<?php echo $data['id']; ?>" class="btn btn-danger hidden-xs ">Delete</a>
					                	<a class="btn btn-warning visible-xs btn-xs" href="admin_walkin.php?id=<?php echo $data['id']; ?>">Reserve</a>
					                	<a class="btn btn-success visible-xs btn-xs" href="editItem.php?id=<?php echo $data['id']; ?>" >Update</a>
					                	<a class="btn btn-danger visible-xs btn-xs" href="deleteItem.php?pro=1&id=<?php echo $data['id']; ?>" >Delete</a>
				                	<?php 				

				                		}
				                	} else { ?>
				                		<a class="btn btn-warning reserve-button" href="admin_walkin.php?id=<?php echo $data['id']; ?>">Reserve</a>
				                	<?php } ?>

						            </div>
					            </div>
					<?php
							$limit++;
						}
						$i++;
					}

					$next = $_GET['start'] + 10;
					$previous = $_GET['start'] - 10;
				 ?>
            </div>
            	<div class="row"></div>
	            <div class="container">
	            	
			        <ul class="pager">
					  <?php if($previous >= 0 && $limit !=0 ) {?><li class="previous" ><a  href="products.php?start=<?php echo $previous; ?>">Previous</a></li><?php } ?>
					  <?php if($limit !=0 ){ ?><li class="next"><a href="products.php?start=<?php echo $next; ?>&pro=1">Next</a></li> <?php }
					  		else {?><h2>There are no more products to be shown</h2> <li class="previous" ><a  href="products.php?start=<?php echo $previous; ?>&pro=1">Previous</a></li><?php } ?>
					</ul>
	            </div>
	     <?php 