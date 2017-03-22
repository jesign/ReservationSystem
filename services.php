<?php 
    include 'connect.php';
    include 'function.php';
    include 'menu.php';

   ?>
	<h1 style="text-indent: 50px;">Services</h1>

	<div class="row row-fluid first-row">
        <div class="col-lg-8 col-md-8">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="item active ">
                        <img src="img/service2.jpg" alt="#">
                    </div>
                    <div class="item">
                        <img src="img/machine1.jpg" alt="#">
                    </div>
                    <div class="item">
                        <img src="img/machine2.jpg" alt="#">
                    </div> 
                    <div class="item">
                        <img src="img/machine3.jpg" alt="#">
                    </div>   
                </div>     
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" >
             <div class="offers-home">
                <h1>We Offer!</h1>
                <h2>Eyeglass Repair</h2>
                <h2>Lens Troubleshooting</h2>
                <h2>Contact Lens Fitting</h2>
                <h2>Eye Refraction</h2>
                <h2>Cataract Screening</h2>
                <h2>and More!</h2>
                
                <?php  
                  if(loggedin()){
                    if($user_level != 1){ ?>
                        <a href="reservation.php?id=0" class="btn btn-warning btn-block">Reserve Here</a>
                    <?php } else {?>
                        <a href="admin_walkin.php?id=0" class="btn btn-warning btn-block">Reserve Here</a>
                    <?php } 
                    } else { ?>
                        <a href="reservation.php?id=0" class="btn btn-warning btn-block">Reserve Here</a>
                <?php } 
                ?>   
            </div>
        </div>
        <!-- <div class="container offers">
            <h1>We Offer!</h1>
            <h2>Eyeglass Repair</h2>
            <h2>Lens Troubleshooting</h2>
            <h2>Contact Lens Fitting</h2>
            <h2>Eye Refraction</h2>
            <h2>Cataract Screening</h2>
            <h2>and More!</h2>
        </div> -->
    </div>

        <div class="container reserve-service">
            <div class="">  
                 
            </div>
        </div>
        
    

