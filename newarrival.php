
    <?php 
        include 'connect.php';
        include 'function.php';
        include 'menu.php';
     ?>
    <div class="row-fluid first-row">
        <div class="col-lg-9 col-md-9">
            <div id="myCarousel" class="car ousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>

                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="item active ">
                        <img src="img/rimless_slider.jpg" alt="#">
                    </div>
                    <div class="item">
                        <img src="img/oval_slider.jpg" alt="#">
                    </div>
                    <div class="item">
                        <img src="img/round_slider.jpg" alt="#">
                    </div>
                </div>
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"></a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"></a>

                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
     
            </div>
        </div>
        <div class="col-lg-3 col-md-3 hidden-xs hidden-sm">
            <div class="container-fluid">
                <div class="modal-dialog-absolute pull-right">
                <!-- Modal content-->
                    <div class="modal-content modal-blue">
                        <div class="modal-header">
                            <h3 class="modal-title"><b>Products</b></h3>
                        </div>
                        <div class="modal-body">
                            <form class="center-block">
                                <div class="form-group">
                                   
                                    <button class="btn btn-lg btn-block modal-button a-white"><a href="newarrival.php"> New Arrival </a></button>
                                    <button class="btn btn-lg btn-block modal-button a-white"><a href="bestseller.php">Best Sellers</a></button>
                                    <button class="btn btn-lg btn-block modal-button a-white"><a href="trend.php">Trends</a></button>
                          
                                    
                                </div>
                                    <p class="visible-lg">Account is required for Reservation</p>                                
                            </form>
                            <div class="modal-footer">
                                    <button class="btn btn-warning btn-lg btn-block">Reserve Now!</button>
                            </div>                                                                                                     
                        </div>                                                                                                                  
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <!-- navbar for product. only visible for small and below screen ^_- -->
    <div class="container-fluid navbar2">    
    <nav class="navbar navbar-default navmodal-blue visible-xs visible-sm">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand visible-sm visible-xs"><p class="product-text">Product:<p></div>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse top-nav" id="bs-example-navbar-collapse-2">
                <ul class="nav navbar-nav navbar-right top-nav">
                    <li >
                        <a href="newarrival.php" >New Arrival</a>
                    </li>
                    <li >
                        <a href="bestseller.php" >Best Sellers</a>
                    </li>
                    <li >
                        <a href="trends.php" >Trends</a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    </div>
    <!--  -->
    <div class="extended-body">
       <div class="row-fluid">
            <div class="container-fluid ">
                <h2>Welcome to Shoppe and See Vision Center</h2>
            </div>
           
       </div>

       <div class="container-fluid ">
                <h2><strong>New Arrival</strong></h2>
            </div> 

            <div class="col-md-4 col-sm-6 container" >
                <div class="product-box">
                    <center>
                        <img src="img/silhouette-rimless.jpg" alt="#">
                        <p class="product-details">
                            <strong>Product Code: </strong> #12312<br>
                            <strong>Classification: </strong> Eyeglass<br> 
                            <strong>Lense: </strong> Polycarbonate lenses<br> 
                            <strong>Frame Shape: </strong> Square<br> 
                        </p>
                    </center>
                    <a href="reserve.php">
                        <button type="button" class="btn btn-warning reserve-button">Reserve</button>
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 container" >
                <div class="product-box">
                    <center>
                        <img src="img/silhouette-rimless1.jpg"alt="#">
                        <p class="product-details">
                            <strong>Product Code: </strong> #12313<br>
                            <strong>Classification: </strong> Eyeglass<br> 
                            <strong>Lense: </strong> Polycarbonate lenses<br> 
                            <strong>Frame Shape: </strong> Square<br> 
                        </p>
                    </center>
                    <a href="reserve.php">
                        <button type="button" class="btn btn-warning reserve-button">Reserve</button>
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 container" >
                <div class="product-box">
                    <center>
                        <img src="img/silhouette-rimless2.jpg" alt="#">
                
                        <p class="product-details">
                            <strong>Product Code: </strong> #12313<br>
                            <strong>Classification: </strong> Eyeglass<br> 
                            <strong>Lense: </strong> Polycarbonate lenses<br> 
                            <strong>Frame Shape: </strong> <br> 
                        </p>
                    </center>
                    <a href="reserve.php">
                        <button type="button" class="btn btn-warning reserve-button">Reserve</button>
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 container" >
                <div class="product-box">
                    <center>
                        <img src="img/oval.jpg" c alt="#">
                        <p class="product-details">
                            <strong>Product Code: </strong> #12313<br>
                            <strong>Classification: </strong> Eyeglass<br> 
                            <strong>Lense: </strong> Polycarbonate lenses<br> 
                            <strong>Frame Shape: </strong> Round <br> 
                        </p>
                    </center>
                    <a href="reserve.php">
                        <button type="button" class="btn btn-warning reserve-button">Reserve</button>
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 container" >
                <div class="product-box">
                    <center>
                        <img src="img/oval.jpg" c alt="#">
                        <p class="product-details">
                            <strong>Product Code: </strong> #12313<br>
                            <strong>Classification: </strong> Eyeglass<br> 
                            <strong>Lense: </strong> Polycarbonate lenses<br> 
                            <strong>Frame Shape: </strong> Round <br> 
                        </p>
                    </center>
                    <a href="reserve.php">
                        <button type="button" class="btn btn-warning reserve-button">Reserve</button>
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 container" >
                <div class="product-box">
                    <center>
                        <img src="img/oval.jpg" c alt="#">
                        <p class="product-details">
                            <strong>Product Code: </strong> #12313<br>
                            <strong>Classification: </strong> Eyeglass<br> 
                            <strong>Lense: </strong> Polycarbonate lenses<br> 
                            <strong>Frame Shape: </strong> Round <br> 
                        </p>
                    </center>
                    <a href="reserve.php">
                        <button type="button" class="btn btn-warning reserve-button">Reserve</button>
                    </a>
                </div>
            </div>
    
    </div>
        <!-- <div class="container-fluid">
            <div class="row-fluid">
                <div class="col-md-6">
                   <footer>
                        <div class="copyright">Shoppe and See Vision Center © 2015 <span id="copyright-year"></span>.&nbsp;&nbsp;<a href="#">Terms and Condtions</a><span> | </span>
                            <a href="#">Privacy and Policy</a>
                        </div>
                    </footer>
                </div>
            </div>
        </div> -->
    </div>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
  </body>
</html>

