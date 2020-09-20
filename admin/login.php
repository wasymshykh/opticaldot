<?php

require_once 'includes.php';

session_start();

// if session is set direct to index

if (checkLoginStatusUser()){
    redirect(LOGGED_IN_REDIRECTION);
}

if (isset($_POST['btn-login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password = hash('sha256', $password);

    $sam = $PDO->prepare("SELECT `id`,`password`,`permission` FROM `user` WHERE `email`=:email");
    $sam->execute(array(':email'=>$email));
    $count = $sam->rowCount();

    if($count > 0){
        if($count == 1){
            $row = $sam->fetch();

            if($row['password'] == $password){
                
                $userId = $row['id'];

                $_SESSION['user'] = $userId;
                $_SESSION['key'] = $password;
                setcookie('user',$userId,time()+365*24*3600);
                setcookie('key',$password,time()+365*24*3600);
								$_COOKIE['user'] = $userId;
                $_COOKIE['key'] = $password;

                redirect(LOGGED_IN_REDIRECTION);
                
                exit;
                

            }else{
                $error = 'The password is incorrect.';
            }

        }else{
            $error = 'There is an issue of multiple accounts associated with this email address, Kindly Contact Administrators.';
        }
    }else{
        $error = 'There exists no account associated with this email address.';
    }

}

require_once "header.php";

?>


        <form method="post">

            <div class="col-md-6 offset-md-3">

                <div class="form-group">
                    <h2 class="">Login</h2>
                </div>

                <div class="form-group">
                    <hr/>
                </div>

                <?php
                if (isset($error)) {

                    ?>
                    <div class="form-group">
                        <div class="alert alert-danger">
                            <span class="glyphicon glyphicon-info-sign"></span> <?php echo $error; ?>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                        <input type="email" name="email" class="form-control" placeholder="Email" required/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                        <input type="password" name="password" class="form-control" placeholder="Password" required/>
                    </div>
                </div>

                <div class="form-group">
                    <hr/>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary" name="btn-login">Login</button>
                </div>

                <div class="form-group">
                    <hr/>
                </div>

            </div>

        </form>


<?php 
require_once "footer.php";
?>
