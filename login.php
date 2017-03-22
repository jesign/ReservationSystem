<?php include_once("function.php");

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        
        if(empty($username) or empty($password)){
            echo "
                    <div class='container-fluid'>
                        <div class='alert alert-danger'>
                            <a href='' class='close' data-dismiss='alert'>&times;</a>
                            <strong></strong> Some Fields are Empty.
                        </div>
                    </div>
                ";
        } else {
            include 'connect.php';
            $check_login = $db->query("SELECT id, status FROM users WHERE username = '$username' And password = '$password' ");
            
            

            if($run = $check_login->fetch_assoc()){ 

                $user_id = $run['id'];
                $status = $run['status'];
                if($status == 'd'){
                    echo "
                    <div class='container-fluid'>
                        <div class='alert alert-danger'>
                            <a href='' class='close' data-dismiss='alert'>&times;</a>
                            <strong></strong> Your account is deactivated by the admin.
                        </div>
                    </div>
                ";
                } else {
                    $_SESSION['user_id'] = $user_id;
                    header('Location: ' . 'index.php', false, 302);
                    exit;
                }
            } else {
                echo "
                    <div class='container-fluid'>
                        <div class='alert alert-danger'>
                            <a href='' class='close' data-dismiss='alert'>&times;</a>
                            <strong></strong> Username or Password incorrect.
                        </div>
                    </div>
                ";

            }
        }
    }   
    include 'menu.php';
    ?>
    <div class="gray-bg"></div>
    <?php

?>

<div class="container login">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">Sign In</h2>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" >
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password">
                            </div>


                            <input class="btn btn-lg btn-success btn-block" type="submit" name="login" value="login">

                            <!-- Change this to a button or input when using this as a form -->
                          <!--  <a href="index.html" class="btn btn-lg btn-success btn-block">Login</a> -->
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

</html>

