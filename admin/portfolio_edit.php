<?php

require_once 'includes.php';
pageRequiresAuthentication();


require_once "header.php";

$id = $_GET['id'];

if (isset($_GET['action']) && $_GET['action'] == 'delete') {

  $sam = $PDO->prepare("DELETE FROM `portfolio` WHERE `id`=:id");
  $sam->execute(array(':id' => $id));

  delete_portfolio_features($id);
  delete_portfolio_technologies($id);
  delete_portfolio_project_types($id);
  delete_portfolio_pictures($id);

  header('Location: portfolio.php');
  exit;
}

$sam = $PDO->prepare("SELECT * FROM `portfolio` WHERE `id`=:id");
$sam->execute(array(':id' => $id));
if ($sam->rowCount() != 1) {
  $error = "There's a problem fetching the requested portfolio from the database. ";
} else {

  $row = $sam->fetch();

  $title = $row['title'];
  $slug = $row['slug'];
  $description = html_entity_decode(br2nl($row['description']));
  $externalLink = $row['externalLink'];
  $listOrder = $row['listOrder'];
  $date_completed = $row['date_completed'];
  $themeColor = $row['themeColor'];

  //$type = $row['type'];

  $cover = $row['cover'];
  $thumbnail = $row['thumbnail'];

  $picturesArray = get_portfolio_pictures($row['id']);
  $typesArray = get_portfolio_project_types($row['id']);
  $technologiesArray = get_portfolio_technologies($row['id']);
  $featuresArray = get_portfolio_features($row['id']);

  $portfolioTypes = array();
  if (!empty($typesArray)) {
    foreach ($typesArray as $t) {
      array_push($portfolioTypes, $t['type_id']);
    }
  }

  $portfolioFeatures = array();
  if (!empty($featuresArray)) {
    foreach ($featuresArray as $t) {
      array_push($portfolioFeatures, $t['features_id']);
    }
  }

  $portfolioTechnologies = array();
  if (!empty($technologiesArray)) {
    foreach ($technologiesArray as $t) {
      array_push($portfolioTechnologies, $t['technologies_id']);
    }
  }


  $picturesList = "";
  if (!empty($picturesArray)) {
    foreach ($picturesArray as $p) {
      $picturesList .= '
        <span class="col-xs-4 col-sm-3 col-md-2 nopad text-center">
          <label class="image-checkbox">
            ' . iif(!empty($p['media_id']), '<img class="img-responsive" width="200" src="' . display_media($p['media_id']) . '" />') . '
            <input type="checkbox" name="removePictures[]" value="' . $p['media_id'] . '" />
          </label>
        </span>';
    }
  }
}

if (isset($_POST['title'])) {

  require_once "../imgupload.class.php";

  // TODO: Sanitize the following inputs
  $title = $_POST['title'];
  $slug = strtolower(str_replace(" ", "-", trim($_POST['slug'])));
  $description = htmlentities(nl2br($_POST['description']));
  $externalLink = $_POST['externalLink'];
  $listOrder = $_POST['listOrder'];
  $date_completed = $_POST['date_completed'];
  $themeColor = $_POST['themeColor'];

  $type = $_POST['type'];
  $features = $_POST['features'];
  $technologies = $_POST['technologies'];
  $removePictures = $_POST['removePictures'];


  // Media Handling:

  $imgCover = new ImageUpload;
  $resultCover = $imgCover->uploadImages($_FILES['cover']);

  $imgThumbnail = new ImageUpload;
  $resultThumbnail = $imgThumbnail->uploadImages($_FILES['thumbnail']);

  $imgPictures = new ImageUpload;
  $resultPictures = $imgPictures->uploadImages($_FILES['picturesUpload']);

  if (!empty($resultCover->error)) {
    foreach ($resultCover->error as $errMsg) {
      $error .= "Error with Cover Photo: " . $errMsg . ". ";
    }
  }
  if (!empty($resultThumbnail->error)) {
    foreach ($resultThumbnail->error as $errMsg) {
      $error .= "Error with Thumbnail Photo: " . $errMsg . ". ";
    }
  }
  if (!empty($resultPictures->error)) {
    foreach ($resultPictures->error as $errMsg) {
      $error .= "Error with Project Pictures: " . $errMsg . ". ";
    }
  }


  // Fetch the successfully uploaded ids of media

  if (!empty($resultCover->ids)) {
    foreach ($resultCover->ids as $id) {
      if (!empty($id)) {
        $cover = $id;
      }
    }
  }

  if (!empty($resultThumbnail->ids)) {
    foreach ($resultThumbnail->ids as $id) {
      if (!empty($id)) {
        $thumbnail = $id;
      }
    }
  }


  // If there is none error so far, proceed

  if (empty($error)) {

    $portfolio_id = $_GET['id'];

    $updated = update_portfolio($portfolio_id, $title, $slug, $description, $externalLink, $cover, $thumbnail, $listOrder, $date_completed, $themeColor);

    if ($updated > 0) {

      delete_portfolio_features($portfolio_id);
      delete_portfolio_technologies($portfolio_id);
      delete_portfolio_project_types($portfolio_id);

      if (!empty($removePictures)) {
        foreach ($removePictures as $picMediaId) {
          delete_portfolio_pictures_specific($portfolio_id, $picMediaId);
        }
      }

      if (!empty($resultPictures->ids)) {
        foreach ($resultPictures->ids as $id) {
          insert_portfolio_pictures($portfolio_id, $id);
        }
      }

      if (!empty($type)) {
        if (is_array($type)) {
          foreach ($type as $type_id) {
            insert_portfolio_project_types($portfolio_id, $type_id);
          }
        } else {
          insert_portfolio_project_types($portfolio_id, $type);
        }
      }

      if (!empty($features)) {
        if (is_array($features)) {
          foreach ($features as $feature_id) {
            insert_portfolio_features($portfolio_id, $feature_id);
          }
        } else {
          insert_portfolio_features($portfolio_id, $features);
        }
      }

      if (!empty($technologies)) {
        if (is_array($technologies)) {
          foreach ($technologies as $technology_id) {
            insert_portfolio_technologies($portfolio_id, $technology_id);
          }
        } else {
          insert_portfolio_technologies($portfolio_id, $technologies);
        }
      }

      echo display_alert('Successfully Saved the Project', 'success');

      $page = strlen($_SERVER['QUERY_STRING']) ? basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING'] : basename($_SERVER['REQUEST_URI']);
      $sec = "1";
      header("Refresh: $sec; url=$page");
    } else {
      $error = 'An error occured while inserting project in portfolio database ' . $portfolio_id;
    }
  }
}


if (!empty($error)) {
  echo display_alert($error, 'danger');
}

?>


<div class="row justify-content-md-center">
  <div class="col">

    <form name="addProject" method="POST" enctype="multipart/form-data">

      <div class="form-group row">
        <label for="title" class="col-2 col-form-label">Title</label>
        <div class="col-10">
          <input class="form-control" type="text" placeholder="Title of Project, e.g. Success Bux" id="title" name="title" value="<?php echo $title; ?>" required>
        </div>
      </div>

      <div class="form-group row">
        <label for="slug" class="col-2 col-form-label">Slug <small>[seo friendly]</small></label>
        <div class="col-10">
          <input class="form-control" type="text" placeholder="Slug, e.g. success-bux" id="slug" name="slug" value="<?php echo $slug; ?>" required>
        </div>
      </div>

      <div class="form-group row">
        <label for="type" class="col-2 col-form-label">Project Type</label>
        <div class="col-10">
          <select multiple class="form-control" id="type" name="type[]">
            <?php
            $project_types = get_project_types();
            if ($project_types !== FALSE) {
              foreach ($project_types as $x) {
                echo '
                  <option value="' . $x['id'] . '" ' . iif(in_array($x['id'], $portfolioTypes), 'selected') . '>' . $x['name'] . '</option>';
              }
            }

            ?>
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label for="description" class="col-2 col-form-label">Description</label>
        <div class="col-10">
          <textarea class="form-control" id="description" name="description" rows="3"><?php echo $description; ?></textarea>
        </div>
      </div>

      <div class="form-group row">
        <label for="externalLink" class="col-2 col-form-label">URL</label>
        <div class="col-10">
          <input class="form-control" type="url" placeholder="External Link to project e.g: https://successbux.com" id="externalLink" name="externalLink" value="<?php echo $externalLink; ?>">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-12">
          <hr>
        </div>
      </div>


      <div class="form-group row">
        <label for="type" class="col-2 col-form-label">Features</label>
        <div class="col-10">
          <?php
          $get_features = get_features();
          if ($get_features !== FALSE) {
            foreach ($get_features as $x) {
              echo '
                  <span class="col-xs-4 col-sm-3 col-md-2 nopad text-center">
                    <label class="image-checkbox">
                      ' . iif(!empty($x['media_id']), '<img class="img-responsive" src="' . display_media($x['media_id']) . '" alt="' . $x['name'] . '" title="' . $x['name'] . '" />', $x['name']) . '
                      <input type="checkbox" ' . iif(in_array($x['id'], $portfolioFeatures), 'checked') . ' name="features[]' . $x['id'] . '" value="' . $x['id'] . '" />
                    </label>
                  </span>                  
                  ';
            }
          }

          ?>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-12">
          <hr>
        </div>
      </div>

      <div class="form-group row">
        <label for="type" class="col-2 col-form-label">Technologies</label>
        <div class="col-10">
          <?php
          $get_technologies = get_technologies();
          if ($get_technologies !== FALSE) {
            foreach ($get_technologies as $x) {
              echo '
                  <span class="col-xs-4 col-sm-3 col-md-2 nopad text-center">
                    <label class="image-checkbox">
                      ' . iif(!empty($x['media_id']), '<img class="img-responsive" src="' . display_media($x['media_id']) . '" alt="' . $x['name'] . '" title="' . $x['name'] . '" />', $x['name']) . '
                      <input type="checkbox" ' . iif(in_array($x['id'], $portfolioTechnologies), 'checked') . ' name="technologies[]" value="' . $x['id'] . '" />
                    </label>
                  </span>
                
                  ';
            }
          }

          ?>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-12">
          <hr>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-12">
          <hr>
        </div>
      </div>


      <div class="form-group row">
        <label for="cover" class="col-2 col-form-label">Cover</label>
        <div class="col-7">
          <a target="_blank" href="<?php echo display_media($cover); ?>"><img src="<?php echo display_media($cover); ?>" width="200" /></a> &nbsp; &nbsp;
        </div>
        <div class="col-3">
          <input class="form-control-file" id="cover" type="file" name="cover[]" accept="image/*">
          <small class="text-muted">Donot Upload a New Cover if you want to keep the current one.</small>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-12">
          <hr>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-12">
          <hr>
        </div>
      </div>

      <div class="form-group row">
        <label for="thumbnail" class="col-2 col-form-label">Thumbnail</label>
        <div class="col-7">
          <a target="_blank" href="<?php echo display_media($thumbnail); ?>"><img src="<?php echo display_media($thumbnail); ?>" width="200" height="200" /></a> &nbsp; &nbsp;

        </div>
        <div class="col-3">
          <input class="form-control-file" id="thumbnail" type="file" name="thumbnail[]" accept="image/*">
          <small class="text-muted">Donot Upload a New Thumbnail if you want to keep the current one.</small>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-12">
          <hr>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-12">
          <hr>
        </div>
      </div>

      <div class="form-group row">
        <label for="pictures" class="col-2 col-form-label">Project Picture(s)</label>
        <div class="col-8">
          <?php echo $picturesList; ?>
          <br />
        </div>
        <div class="col-2">
          <input class="form-control-file" id="pictures" type="file" name="picturesUpload[]" accept="image/*" multiple>
          <br />
          <small class="text-muted">Select to remove a specific project picture and then save</small>

        </div>
      </div>

      <div class="form-group row">
        <div class="col-12">
          <hr>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-12">
          <hr>
        </div>
      </div>

      <div class="form-group row">
        <label for="themeColor" class="col-2 col-form-label">Sort Order</label>
        <div class="col-10">
          <input class="form-control" type="number" value="<?php echo $listOrder; ?>" placeholder="Greater the number, the more priority in display" id="listOrder" name="listOrder">
        </div>
      </div>

      <div class="form-group row">
        <label for="date_completed" class="col-2 col-form-label">Completion Date</label>
        <div class="col-10">
          <input class="form-control" type="date" id="date_completed" name="date_completed" value="<?php echo $date_completed; ?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="themeColor" class="col-2 col-form-label">Theme Color</label>
        <div class="col-10">
          <input class="form-control" type="color" id="themeColor" name="themeColor" value="<?php echo $themeColor; ?>">
        </div>
      </div>

      <center>
        <button type="submit" class="btn btn-warning">Save Project</button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Delete Project </button>
      </center>
      <br /><br />

    </form>

  </div>
</div>



<?php

echo modal_delete('deleteModal', 'Project', 'portfolio_edit.php?action=delete&id=' . $id);

require_once "footer.php";

?>