<?php 
    include 'function.php';
    include 'menu.php';

    if($user_level !=1){
        header('location: index.php');
    }
 
    include 'connect.php';

    if(isset($_POST['add'])){


        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                 echo "
                <div class='container-fluid'>
                    <div class='alert alert-warning'>
                        <a href='' class='close' data-dismiss='alert'>&times;</a>
                        <strong>Notice: </strong> The file is not an image.
                    </div>
                </div>
            ";
                $uploadOk = 0;
            }
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
             echo "
                <div class='container-fluid'>
                    <div class='alert alert-warning'>
                        <a href='' class='close' data-dismiss='alert'>&times;</a>
                        <strong>Notice: </strong> Your file is too large
                    </div>
                </div>
            ";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPG"  && $imageFileType != "JPEG"
        && $imageFileType != "gif" ) {
            echo "
                <div class='container-fluid'>
                    <div class='alert alert-warning'>
                        <a href='' class='close' data-dismiss='alert'>&times;</a>
                        <strong>Notice: </strong> Sorry, only JPG, JPEG, PNG & GIF files are allowed.
                    </div>
                </div>
            ";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            
             echo "
                <div class='container-fluid'>
                    <div class='alert alert-warning'>
                        <a href='' class='close' data-dismiss='alert'>&times;</a>
                        <strong>Notice: </strong> Sorry, your file was not uploaded
                    </div>
                </div>
            ";
            $uploadOk = 0;
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "
                    <div class='container-fluid'>
                        <div class='alert alert-success'>
                            <a href='' class='close' data-dismiss='alert'>&times;</a>
                            <strong></strong> The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.
                        </div>
                    </div>
                ";


            } else {
                 echo "
                <div class='container-fluid'>
                    <div class='alert alert-warning'>
                        <a href='' class='close' data-dismiss='alert'>&times;</a>
                        <strong>Notice: </strong> Sorry, there was an error uploading your file.
                    </div>
                </div>
            ";
                
            }
        }



        $image=basename( $_FILES["fileToUpload"]["name"]); // used to store the filename in a variable
        //insert

       if($uploadOk == 1){
             
            $sql = 'INSERT INTO `items`(`item_name`, `item_type`, `brand`, `style`, `material`, `color`, `gender` , `picture` ) 
                    VALUES ( 
                        "' . mysqli_escape_string($db, $_POST['itemname']) . '", 
                        "' . mysqli_escape_string($db, $_POST['itemtype']) . '", 
                        "' . mysqli_escape_string($db, $_POST['brand']) . '", 
                        "' . mysqli_escape_string($db, $_POST['style']) . '", 
                        "' . mysqli_escape_string($db, $_POST['material']) . '",    
                        "' . mysqli_escape_string($db, $_POST['color']) . '", 
                        "' . mysqli_escape_string($db, $_POST['gender']) . '", 
                        "' . $image . '")';

            $query = $db->query($sql);

            echo "
                <div class='container-fluid'>
                    <div class='alert alert-success'>
                        <a href='' class='close' data-dismiss='alert'>&times;</a>
                        <strong></strong> Successfully Added
                    </div>
                </div>
            ";
        }else{ 

            echo "
                <div class='container-fluid'>
                    <div class='alert alert-warning'>
                        <a href='' class='close' data-dismiss='alert'>&times;</a>
                        <strong>Notice: </strong> There was an error adding the item
                    </div>
                </div>
            ";
        }
    }
 ?>
        <div class="col-lg-offset-4 col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">ADD PRODUCT</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="POST" enctype="multipart/form-data" class="additem">
                        <div class="form-group">
                                <label> 
                                    <input type="radio" name="itemtype" value="1" checked /> New Arrival
                                </label>
                                <label> 
                                    <input type="radio" name="itemtype" value="2" /> Best Seller
                                </label>
                                <label> 
                                    <input type="radio" name="itemtype" value="3" /> Trend
                                </label>
                        </div>
                        <div class="form-group  productcode">
                            
                            <label >Product Code: </label>
                            <label>
                            <?php 
                                $sqlgetlast = "SELECT * FROM items ORDER BY id DESC LIMIT 1";
                                $querylast = $db->query($sqlgetlast);
                                $last = $querylast->fetch_assoc();
                                echo $last['id'] + 1;
                             ?>
                             </label>
                        </div>
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="itemname" class="form-control" placeholder="Enter Item Name">        
                        </div>
                        <div class="form-group">
                            <label >
                                <strong>Gender</strong>
                            </label><br>
                            <label> 
                                <input type="radio" name="gender" value="1" checked /> Male
                            </label>
                            <label> 
                                <input type="radio" name="gender" value="2" /> Female
                            </label>
                            <label> 
                                <input type="radio" name="gender" value="3" /> Unisex
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Brand</label>
                            <input type="text" name="brand" class="form-control" placeholder="Enter Brand">        
                        </div>
                 
                        <div class="form-group">
                            <label>Style</label>
                            <input type="text" name="style" class="form-control" placeholder="Enter style">        
                        </div>
                        <div class="form-group">
                            <label>material</label>
                            <input type="text" name="material" class="form-control" placeholder="Enter material kind">        
                        </div>
                        <div class="form-group">
                            <label>Color</label>
                            <input type="text" name="color" class="form-control" placeholder="Enter Color">        
                        </div>
                         <label>Picture</label>   
                         <input type="file" name="fileToUpload" id="fileToUpload">
                        <br>
                        
                        <button type="submit" name="add" class="btn btn-success btn-lg btn-block">Add Item</button>
                    </form>
                </div>
            </div>
        </div>




</body>
</html>

<?php 
    $db->close();
 ?>