<?php

require_once 'includes.php';
pageRequiresAuthentication();

require_once "header.php";

if($permission!=7){
    echo display_alert('This Area is for Admins Only','danger');
}else{

    $id = $_GET['id'];

    if($_GET['action']=='delete'){

        $sam = $PDO->prepare("DELETE FROM `features` WHERE `id`=:id");
        $sam->execute(array(':id'=>$id));
    
        Redirect('settings.php');
    
    }

    require_once "../imgupload.class.php";

    if(isset($_POST['featureTitle'])){

        $featureTitle = $_POST['featureTitle'];

        $imgFeature = new ImageUpload;
        $featureThumbnail = $imgFeature->uploadImages($_FILES['featureThumbnail']);

        if(!empty($featureThumbnail->error)){
            foreach($featureThumbnail->error as $errMsg){
              $error .= "Error with Cover Photo: ".$errMsg.". ";
            }
        }

        if(!empty($featureThumbnail->ids)){
            foreach($featureThumbnail->ids as $i){
              $featureMediaId = $i;
            }
        }

        if(!$error && !empty($featureMediaId) && !empty($featureTitle)){

            $sam = $PDO->prepare("UPDATE `features` SET `name`=:name, `media_id`=:media_id WHERE `id`=:id");
            $sam->execute(array(':name'=>$featureTitle,':media_id'=>$featureMediaId,':id'=>$id));

        }elseif(!$error && !empty($featureTitle)){

            $sam = $PDO->prepare("UPDATE `features` SET `name`=:name WHERE `id`=:id");
            $sam->execute(array(':name'=>$featureTitle,':id'=>$id));

        }else{
            $error .= 'The feature could not be saved to database. ';
        }


    }


    $data = get_feature($id);
    $featureTitle = $data['name'];
    $featureMediaId = $data['media_id'];

if(!empty($error)){
    echo display_alert($error,'danger');
}

?>


<div class="row justify-content-md-center">
    <div class="col">

        <form name="saveFeature" method="POST" enctype="multipart/form-data">

            <div class="form-group row">
                <label for="featureTitle" class="col-2 col-form-label">Title</label>
                <div class="col-10">
                    <input class="form-control" type="text" placeholder="e.g. Javascript" id="featureTitle" name="featureTitle" value="<?php echo $featureTitle; ?>" required>
                </div>
                </div>

                <div class="form-group row">
                <label for="featureThumbnail" class="col-2 col-form-label">Thumbnail 
                <small class="text-muted">(50px x 50px)</small>
                </label>
                <div class="col-6">
                <img src="<?php echo display_media($featureMediaId); ?>" width="50" height="50" /> &nbsp; &nbsp; <small class="text-muted">Donot Upload a New Thumbnail if you want to keep the current thumbnail.</small> <br />
                </div>
                <div class="col-4">
                <input class="form-control" id="featureThumbnail" type="file" name="featureThumbnail[]" accept="image/*">
                </div>
            </div>

            <center>
            <a class="btn btn-secondary" href="settings.php"><i class="fa fa-backward"></i> Back to Settings</a>
            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save Feature</button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Delete Feature </button>
            </center>

        </form>

  </div>
</div>



<?php

echo modal_delete('deleteModal','Feature','features_edit.php?action=delete&id='.$id);

}

require_once "footer.php";

?>