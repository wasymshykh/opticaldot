<?php

require_once "includes.php";
pageRequiresAuthentication();

require_once "header.php";

if (checkLoginStatusUser()!=7){
    echo "Accessible only to Admins";
}

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $password = hash('sha256',$_POST['password']);
    $permission = $_POST['permission'];
    
    $sam = $PDO->prepare("INSERT INTO `user` SET `email`=:email, `password`=:password, permission=:permission");
    $sam->execute(array(':email'=>$email,':password'=>$password,':permission'=>$permission));     

}

?>

<table class="table table-striped">
<thead>
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
    </tr>
</thead>

<tbody>

<?php

// iterate through user table here with edit delete links

$sam = $PDO->query('SELECT * FROM `user`');

if($sam->rowCount()>0){

    $array = $sam->fetchAll();
    
    foreach($array as $x){
        $records.='
        <tr>
        <td>'.$x['id'].'</td>
        <td>'.$x['email'].'</td>
        <td>'.iif($x['permission']==7,'Admin',iif($x['permission']==1,'User')).'</td>
        <td>
        <a href="user_edit.php?u='.$x['id'].'" class="btn btn-warning">Edit</a>
        </td>
        </tr>
        ';
    }

    echo $records;
}

?>

<tr>
    <td colspan="4" style="text-align:center;font-weight:bold;font-style:italic;">Add User</td>
</tr>

<form method="POST">
<tr>
    <td><input type="email" name="email" placeholder="Email Address" required /></td>
    <td><input type="password" name="password" placeholder="Password" required /></td>
    <td><select name="permission" required>
        <option value="1" selected>User</option>
        <option value="7">Admin</option>
    </select></td>
    <td><input type="submit" name="submit" value="Add" class="btn btn-success" /></td>
</tr>
</form>

</table>


<?php 
require_once "footer.php";
?>
