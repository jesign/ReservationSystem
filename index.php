    <?php 
        include 'function.php';
        include 'menu.php';
     ?>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-xs-12"  >
            <img src="img/fundus.png" class="img-responsive">
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" >
             <div class="offers-home">
                <h1>Greetings!</h1>
                <h2>We are glad for being with us!</h2> <h2>Please feel free to avail our high quality products at a very affordable price and optical services. </h2>
                <h2>See you!</h2>
                <a href="products.php?start=0&pro=1" class="btn btn-warning btn-block">Reserve Here</a> 
            </div>
        </div>
    </div>
    <div class="row row-comment">
        <div class="container-comment col-lg-7" id="example-form">
            
            <form role="form" action="addcomment.php" method="POST">
                <div class="form-group">
                    <label for="comment">Leave a comment:</label>
                    <textarea name="comment" class="form-control" rows="3" id="inputExample" placeholder="comment..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>   
            </form>
                <?php if(isset($_GET['comment']) && $_GET['comment'] == 1 && $user_level != 1){ ?>
                    <div class='container-fluid'>
                        <div class='alert alert-success'>
                            <a href='' class='close' data-dismiss='alert'>&times;</a>
                            <strong>Notice: </strong> Your comment will be posted after the admin will accept it.
                        </div>
                    </div>
                <?php } ?>
                  <br>
            <?php  
                include 'connect.php';
                
                $sql2 = "SELECT * FROM comments WHERE status = 'accepted'";
                $query2 = $db->query($sql2);

                while ($data = $query2->fetch_assoc()) {
            ?>
                   
                <div class="boxcomment">  
                      
                    <strong class="commentname">
                        <?php 
                            $newSql = "SELECT * FROM users WHERE id = " . $data['user_id'];

                            $newquery = $db->query($newSql);
                            $newData = $newquery->fetch_assoc();
                            echo $newData['firstname'] . ' ' . $newData['lastname'];
                        ?>
                    </strong>:
                    <span class="date">                    
                        <?php echo $data['date']; ?>
                        <?php echo $data['time']; ?>
                    </span>
                       
                    <p class="indent">
                        <?php echo $data['comment']; ?>
                    </p>
                </div>
            <?php
            }
            ?>            
        </div>  



    </div>
