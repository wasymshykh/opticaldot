<?php

require_once 'includes.php';
pageRequiresAuthentication();

require_once "header.php";

if($permission!=7){
    echo display_alert('This Area is for Admins Only','danger');
}else{

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
            foreach($technologyThumbnail->ids as $id){
              $technologyMediaId = $id;
            }
        }

        if(!$error && !empty($technologyMediaId) && !empty($technologyTitle)){

            $sam = $PDO->prepare("INSERT INTO `technologies` SET `name`=:name, `type`=:type, `media_id`=:media_id");
            $sam->execute(array(':name'=>$technologyTitle,':type'=>$technologyType,':media_id'=>$technologyMediaId));

        }else{
            $error .= 'The technology could not be added to database. ';
        }

    } // Technology


    
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
            foreach($featureThumbnail->ids as $id){
              $featureMediaId = $id;
            }
        }

        if(!$error && !empty($featureMediaId) && !empty($featureTitle)){

            $sam = $PDO->prepare("INSERT INTO `features` SET `name`=:name, `media_id`=:media_id");
            $sam->execute(array(':name'=>$featureTitle,':media_id'=>$featureMediaId));

        }else{
            $error .= 'The feature could not be added to database. ';
        }

    } // Feature




if(!empty($error)){
    echo display_alert($error,'danger');
}

?>





<!-- Technologies -->

<div class="row justify-content-md-center">
    <div class="col">

        <table class="table">
        <thead>
        <th colspan=4>
        Technologies
        </th>
        </thead>
        <tbody>
        <?php
        $technologies = get_technologies();
        if(!empty($technologies) && is_array($technologies)){
            foreach($technologies as $t){
                echo '<tr>
                <td><img src="'.display_media($t['media_id']).'" width="50" height="50" /></td>
                <td>'.$t['name'].'</td>
                <td>'.ucwords($t['type']).'</td>
                <td><a class="btn btn-warning" href="technologies_edit.php?id='.$t['id'].'">Edit</a></td>
                </tr>';
            }
        }
        ?>
        <tr><td colspan=4>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addTechnologyModal"><i class="fa fa-plus"></i> Add Technology </button>
        </td></tr>
        </tbody>
        </table>

  </div>
</div>

<?php

$addTechnologyForm = '
<form name="addTechnology" method="POST" enctype="multipart/form-data">

    <div class="form-group row">
        <label for="technologyTitle" class="col-2 col-form-label">Title</label>
        <div class="col-8">
            <input class="form-control" type="text" placeholder="e.g. Javascript" id="technologyTitle" name="technologyTitle" value="'.$technologyTitle.'" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="technologyTitle" class="col-2 col-form-label">Type</label>
        <div class="col-8">
            <select class="form-control" name="technologyType" id="technologyType">
                <option value="frontend" '.iif($technologyType=='frontend','selected').'>Frontend</option>
                <option value="backend" '.iif($technologyType=='backend','selected').'>Backend</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="technologyThumbnail" class="col-2 col-form-label">Thumbnail 
            <small class="text-muted">(50px x 50px)</small>
        </label>
        <div class="col-8">
            <input class="form-control" id="technologyThumbnail" type="file" name="technologyThumbnail[]" accept="image/*">
        </div>
    </div>

    <center>
        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Add Technology</button>
    </center>

</form>
';

echo modal_simple('addTechnologyModal','Adding Technology',$addTechnologyForm);

?>

<!-- Technologies -->










<!-- Features -->

<div class="row justify-content-md-center">
    <div class="col">

        <table class="table">
        <thead>
        <th colspan=3>
        Features
        </th>
        </thead>
        <tbody>
        <?php
        $features = get_features();
        if(!empty($features) && is_array($features)){
            foreach($features as $t){
                echo '<tr>
                <td><img src="'.display_media($t['media_id']).'" width="50" height="50" /></td>
                <td>'.$t['name'].'</td>
                <td><a class="btn btn-warning" href="features_edit.php?id='.$t['id'].'">Edit</a></td>
                </tr>';
            }
        }
        ?>
        <tr><td colspan=3>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addFeatureModal"><i class="fa fa-plus"></i> Add Feature </button>
        </td></tr>
        </tbody>
        </table>

  </div>
</div>

<?php

$addFeatureForm = '
<form name="addFeature" method="POST" enctype="multipart/form-data">

    <div class="form-group row">
        <label for="featureTitle" class="col-2 col-form-label">Title</label>
        <div class="col-8">
            <input class="form-control" type="text" placeholder="e.g. Mobile Friendly" id="featureTitle" name="featureTitle" value="'.$featureTitle.'" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="featureThumbnail" class="col-2 col-form-label">Thumbnail 
            <small class="text-muted">(50px x 50px)</small>
        </label>
        <div class="col-8">
            <input class="form-control" id="featureThumbnail" type="file" name="featureThumbnail[]" accept="image/*">
        </div>
    </div>

    <center>
        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Add Feature</button>
    </center>

</form>
';

echo modal_simple('addFeatureModal','Adding Feature',$addFeatureForm);

?>

<!-- Features -->

<?php

}

require_once "footer.php";

?>