<?php

require_once "includes.php";
pageRequiresAuthentication();

if ($permission!=7){
    echo "Accessible only to Admins";
}

require_once "header.php";

$u = $_GET['u'];

if($_GET['action']=='delete'){

    $sam = $PDO->prepare("DELETE FROM `user` WHERE `id`=:u");
    $sam->execute(array(':u'=>$u));

    header('Location: users.php');
    exit;

}

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $permission = $_POST['permission'];

    if(isset($_POST['password'])){
        $password = hash('sha256',$_POST['password']);

        $sam = $PDO->prepare("UPDATE `user` 
        SET `email`=:email, `password`=:password, permission=:permission WHERE `id`=:u");
        $sam->execute(array(
            ':email'=>$email,':password'=>$password,':permission'=>$permission,':u'=>$u));
    }else{
        $sam = $PDO->prepare("UPDATE `user` 
        SET `email`=:email, permission=:permission WHERE `id`=:u");
        $sam->execute(array(
            ':email'=>$email,':permission'=>$permission,':u'=>$u));
    }

}

if(!isset($u)){

    echo 'Please specify user.';

}else{
    $sam = $PDO->prepare("SELECT * FROM `user` WHERE `id`=:u");
    $sam->execute(array(':u'=>$u));
    if($sam->rowCount()!=1){
        echo 'There exists no such user.';
    }else{

        $row = $sam->fetch();

?>

 <form method="post" action="user_edit.php?u=<?php echo $u; ?>">

<div class="col-md-6 offset-md-3">

    <div class="form-group">
        <h2 class="">Edit User</h2>
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
            <span class="input-group-addon">Email </span>
            <input type="email" value="<?php echo $row['email'] ?>" name="email" class="form-control" placeholder="Email" required/>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Password </span>
            <input type="password" name="password" class="form-control" placeholder="Leave Blank if not modifying it"/>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Role </span>
            <select name="permission" class="form-control" required>
                <option value="1" <?php if($row['permission']==1){echo 'selected';} ?>>User</option>
                <option value="7" <?php if($row['permission']==7){echo 'selected';} ?>>Admin</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <hr/>
    </div>

    <div class="form-group">
        <button type="submit" name="submit" class="btn btn-block btn-primary">Save</button>
    </div>

    <div class="form-group">
        <hr/>
    </div>

    <div class="form-group">
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Delete </button>
    </div>

    <div class="form-group">
        <hr/>
    </div>

    </div>
</form>


<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="deleteModalLabel">Delete this User?</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        Are you sure you want to delete this user?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-danger" href="user_edit.php?action=delete&u=<?php echo $u; ?>"><i class="fa fa-trash"></i> Delete</a>
			      </div>
			    </div>
			  </div>
			</div>


<?php 


}
}

require_once "footer.php";
?>
