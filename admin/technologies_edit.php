<?php

require_once 'includes.php';
pageRequiresAuthentication();

require_once "header.php";

if($permission!=7){
    echo display_alert('This Area is for Admins Only','danger');
}else{

    $id = $_GET['id'];

    if($_GET['action']=='delete'){

        $sam = $PDO->prepare("DELETE FROM `technologies` WHERE `id`=:id");
        $sam->execute(array(':id'=>$id));
    
        Redirect('settings.php');
    
    }

    require_once "../imgupload.class.php";

    if(isset($_POST['technologyTitle'])){

        $technologyTitle = $_POST['technologyTitle'];
        $technologyType = $_POST['technologyType'];

        $imgTechnology = new ImageUpload;
        $technologyThumbnail = $imgTechnology->uploadImages($_FILES['technologyThumbnail']);

        if(!empty($technologyThumbnail->error)){
            foreach($technologyThumbnail->error as $errMsg){
              $error .= "Error with Cover Photo: ".$errMsg.". ";
            }
        }

        if(!empty($technologyThumbnail->ids)){
            foreach($technologyThumbnail->ids as $i){
              $technologyMediaId = $i;
            }
        }

        if(!$error && !empty($technologyMediaId) && !empty($technologyTitle)){

            $sam = $PDO->prepare("UPDATE `technologies` SET `name`=:name, `type`=:type, `media_id`=:media_id WHERE `id`=:id");
            $sam->execute(array(':name'=>$technologyTitle,':type'=>$technologyType,':media_id'=>$technologyMediaId,':id'=>$id));

        }elseif(!$error && !empty($technologyTitle)){

            $sam = $PDO->prepare("UPDATE `technologies` SET `type`=:type, `name`=:name WHERE `id`=:id");
            $sam->execute(array(':name'=>$technologyTitle,':type'=>$technologyType,':id'=>$id));

        }else{
            $error .= 'The technology could not be saved to database. ';
        }


    }


    $data = get_technology($id);
    $technologyTitle = $data['name'];
    $technologyMediaId = $data['media_id'];
    $technologyType = $data['type'];

if(!empty($error)){
    echo display_alert($error,'danger');
}

?>


<div class="row justify-content-md-center">
    <div class="col">

        <form name="saveTechnology" method="POST" enctype="multipart/form-data">

            <div class="form-group row">
                <label for="technologyTitle" class="col-2 col-form-label">Title</label>
                <div class="col-10">
                    <input class="form-control" type="text" placeholder="e.g. Javascript" id="technologyTitle" name="technologyTitle" value="<?php echo $technologyTitle; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="technologyTitle" class="col-2 col-form-label">Type</label>
                <div class="col-8">
                    <select class="form-control" name="technologyType" id="technologyType">
                        <option value="frontend" <?php echo iif($technologyType=='frontend','selected'); ?>>Frontend</option>
                        <option value="backend" <?php echo iif($technologyType=='backend','selected'); ?>>Backend</option>
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <label for="technologyThumbnail" class="col-2 col-form-label">Thumbnail 
                    <small class="text-muted">(50px x 50px)</small>
                </label>
                <div class="col-6">
                    <img src="<?php echo display_media($technologyMediaId); ?>" width="50" height="50" /> &nbsp; &nbsp; <small class="text-muted">Donot Upload a New Thumbnail if you want to keep the current thumbnail.</small> <br />
                </div>
                <div class="col-4">
                    <input class="form-control" id="technologyThumbnail" type="file" name="technologyThumbnail[]" accept="image/*">
                </div>
            </div>

            <center>
            <a class="btn btn-secondary" href="settings.php"><i class="fa fa-backward"></i> Back to Settings</a>
            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save Technology</button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Delete Technology </button>
            </center>

        </form>

  </div>
</div>



<?php

echo modal_delete('deleteModal','Technology','technologies_edit.php?action=delete&id='.$id);

}

require_once "footer.php";

?>