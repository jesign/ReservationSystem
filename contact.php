<?php 
    include 'function.php';
    include 'menu.php';

   ?>

    <div class="row">
        <div class="col-lg-7">
            <div class="contact-image">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>

                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="item active ">
                        <img src="img/front.jpg" alt="#">
                    </div>
                    <div class="item">
                        <img src="img/about1.jpg" alt="#">
                    </div>
                    <div class="item">
                        <img src="img/about2.jpg" alt="#">
                    </div>  
                </div>     
            </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" >
            <h1>About Us</h1>
            <p>On May 19, 2010, SHOPPE and SEE VISION CENTER started its operations as partnership with its clinic located at VICTORIA PLAZA, J.P LAUREL AVE., BAJADA, DAVAO CITY.</p>
            <h1>Vision</h1>
            <p>To provide the best eye care services, by utilizing the most advanced technologies and working with the innovators in the eye care industry.</p>
            <h1>Mission</h1>
            <p>To continue to grow and develop with competency. Provide the highest quality and superior products that could enhance peoples lives.</p>
        </div>    

    </div>
    <hr class="gray" />
    <h1 align="center">Contact Us</h1>
    <div class="container contact-us">
        <div class="row">
        <?php 
            include "connect.php";
            $q = $db->query("SELECT * FROM users WHERE user_level = 1");
            $admin = $q->fetch_assoc();
         ?>
            <div class="col col-lg-3"><strong>Email: </strong><br><?php echo $admin['email']; ?></div>
            <div class="col col-lg-3"><strong>Cellphone No. : </strong><br><?php echo $admin['contact_number']; ?></div>
            <div class="col col-lg-3"><strong>Address: </strong><br><?php echo $admin['address']; ?></div>
            <div class="col col-lg-3"><strong>Open Hours: </strong><br> MONDAY to  SUNDAY <br> 10:00 am - 8:00 pm</div>
        </div>
    </div>