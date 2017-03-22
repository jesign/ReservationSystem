 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Shoppe and See Vision Center</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/ssvc.css">
    <link rel="stylesheet" type="text/css" href="css/reservation.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css">
  </body>
</html>


  </head>
  <body>
        
      <nav class="navbar navbar-default nav-blue navbar-fixed-top ">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img class="hidden-sm hidden-xs"src="img/companyname2.png">
                <div class="navbar-brand visible-sm"><p class="companyname">Shoppe and See Vision Center<p></div>
                <div class="navbar-brand visible-xs"><p class="companyname">SSVC<p></div>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="products.php?start=0&pro=1">Products</a>
                    </li>
                    <li>
                        <a href="services.php?">Services</a>
                    </li>
                    <li>
                        <a href="contact.php">About</a>
                    </li>
                    <?php 
                    if(loggedin()){
                     ?>
                         <li class="dropdown">
                          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><label><?php echo $user_name; ?></label><span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            
                                <?php 
                                    if($user_level ==1){
                                ?>
                                <li><a href="admin_control.php?category=3">Admin Tasks</a></li>
                                <li><a href="client_settings.php">Account Settings</a></li>
                                <li><a href="addItem.php">Add Product</a></li>
                                <?php
                                    } else {
                                 ?>

                                 <li><a href="client_reservation.php">Reservations</a></li>
                                 <li><a href="client_settings.php">Account Settings</a></li>

                                 <?php } ?>
                            <li><a href="logout.php">Logout</a></li>
                          </ul>
                        </li>
                    <?php   
                    } else {
                        ?>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="login.php">Login</a></li>
                            <li><a href="register.php">Register</a></li>
                          </ul>
                        </li>

                    <?php
                    }
                    ?>
   
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>