<?php

require_once 'includes.php';
pageRequiresAuthentication();

require_once "header.php";

// TODO: Sanitize the following inputs
$title = isset($_POST['title']) ? $_POST['title'] : "";
$slug = isset($_POST['slug']) ? $slug = strtolower(str_replace(" ", "-", trim($_POST['slug']))) : "";
$description = isset($_POST['description']) ? nl2br(htmlentities($_POST['description'])) : "";
$externalLink = isset($_POST['externalLink']) ? $_POST['externalLink'] : "";
$listOrder = isset($_POST['listOrder']) ? $_POST['listOrder'] : "";
$date_completed = isset($_POST['date_completed']) ? $_POST['date_completed'] : "";
$themeColor = isset($_POST['themeColor']) ? $_POST['themeColor'] : "";

$type = isset($_POST['type']) ? $_POST['type'] : "";
$features = isset($_POST['features']) ? $_POST['features'] : "";
$technologies = isset($_POST['technologies']) ? $_POST['technologies'] : "";


if (isset($_POST['title'])) {

  require_once "../imgupload.class.php";



  // Media Handling:

  $imgCover = new ImageUpload;
  $resultCover = $imgCover->uploadImages($_FILES['cover']);

  $imgThumbnail = new ImageUpload;
  $resultThumbnail = $imgThumbnail->uploadImages($_FILES['thumbnail']);

  $imgPictures = new ImageUpload;
  $resultPictures = $imgPictures->uploadImages($_FILES['pictures']);

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
      $cover = $id;
    }
  }

  if (!empty($resultThumbnail->ids)) {
    foreach ($resultThumbnail->ids as $id) {
      $thumbnail = $id;
    }
  }


  // If there is none error so far, proceed

  if (empty($error)) {

    $portfolio_id = insert_portfolio($title, $slug, $description, $externalLink, $cover, $thumbnail, $listOrder, $date_completed, $themeColor);

    if ($portfolio_id > 0) {

      if (!empty($resultPictures->ids)) {
        foreach ($resultPictures->ids as $id) {
          insert_portfolio_pictures($portfolio_id, $id);
        }
      }

      // Project Type:

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

      /*

      // Features:

      $get_features = get_features();
      if(!empty($get_features)){
        foreach($get_features as $feature){
          $features_id = 'feature'.$feature['id'];
          if(isset($_POST[$features_id])){
            insert_portfolio_features($portfolio_id,$feature['id']);
          }
        }
      }

      // Technologies:

      $get_technologies = get_technologies();
      if(!empty($get_technologies)){
        foreach($get_technologies as $technology){
          $technologies_id = 'technology'.$technology['id'];
          if(isset($_POST[$technologies_id])){
            insert_portfolio_technologies($portfolio_id,$technology['id']);
          }
        }
      }

      */

      echo display_alert('Successfully Added the Project', 'success');
    } else {
      $error = 'An error occured while inserting project in portfolio database ' . $portfolio_id;
    }
  }

  if (!empty($error)) {
    echo display_alert($error, 'danger');
  }
}



$url = 'portfolio.php?';
$rowsLimit = isset($_GET['limit']) ? $_GET['limit'] : 0;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
if (!$rowsLimit) {
  $rowsLimit = 10;
}
if (!$currentPage) {
  $currentPage = 1;
}
$start = ($currentPage - 1) * $rowsLimit;

$sam = $PDO->query("SELECT COUNT(id) as `count` FROM `portfolio`");
$arrayTotal = $sam->fetch();
$totalRows = $arrayTotal['count'];

if ($totalRows > 0) {

  $SqlStatement = "SELECT * FROM `portfolio` ORDER BY `listOrder` DESC, `id` DESC LIMIT :start, :limit";
  $sam = $PDO->prepare($SqlStatement);
  $sam->bindParam(':start', $start, PDO::PARAM_INT);
  $sam->bindParam(':limit', $rowsLimit, PDO::PARAM_INT);
  $sam->execute();

  if ($sam->rowCount() > 0) {
    $finalArray = $sam->fetchAll();

    $num = 0;
    $list = "";
    foreach ($finalArray as $x) {
      $num++;

      $ptype = get_portfolio_project_types_joined($x['id']);

      $list .= '
                <div class="card mb-4">
                <img class="card-img-top img-fluid" src="' . display_media($x['thumbnail']) . '" alt="">
                  <div class="card-body">
                    <h5 class="card-title">' . $x['title'] . '</h5>
                    <p class="card-text">
                    ' . serialize_array($ptype, ',', 'name') . '<br />
                    <small class="text-muted">' . substr(br2nl($x['description']), 0, 100) . '</small></p>
                    <a href="portfolio_edit.php?id=' . $x['id'] . '" class="btn btn-info"><i class="fas fa-edit"></i> Edit Project</a>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted">Added ' . timeSince(($x['datetime_added'])) . ' ago</small>
                  </div>
                  </div>

                  ' . iif($num % 5 == 0, '</div><div class="card-deck">') . '
                  
                  ';
    }

    echo '<div class="card-deck">
            ' . $list . '
          </div>';
    echo '<center>';
    echo paginationBar($totalRows, $currentPage, $rowsLimit, $url);
    echo '</center>';
  }
}




/*
if($permission==7){
   echo "Admin Logged In";
}else{
    echo "User Logged In";
}
*/


?>



<div class="row justify-content-md-center">
  <div class="col col-lg-2">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddProject">
      <i class="fa fa-plus"></i> Add New Project
    </button>
  </div>
</div>

<br /><br />


<!-- Modal -->
<div class="modal fade" id="modalAddProject" tabindex="-1" role="dialog" aria-labelledby="modalAddProjectTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAddProjectTitle">Adding New Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form name="addProject" method="POST" enctype="multipart/form-data">

          <div class="form-group row">
            <label for="title" class="col-2 col-form-label">Title</label>
            <div class="col-10">
              <input class="form-control" type="text" placeholder="Title of Project, e.g. Success Bux" id="title" name="title" value="<?php echo $title; ?>" onkeyup="copycontent()" onchange="copycontent()" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="slug" class="col-2 col-form-label">Slug</label>
            <div class="col-10">
              <input class="form-control" type="text" placeholder="Slug seo friendly, e.g. success-bux" id="slug" name="slug" value="<?php echo $slug; ?>" required>
            </div>
          </div>

          <script>
            function copycontent() {
              let title_val = document.querySelector("#title").value;
              let slug_inp = document.querySelector("#slug");

              let title_val_san = title_val.toString().trim().toLowerCase().replace(" ", "-");

              slug_inp.value = title_val_san;
            }
          </script>

          <div class="form-group row">
            <label for="type" class="col-2 col-form-label">Project Type</label>
            <div class="col-10">
              <select multiple class="form-control" id="type" name="type[]">
                <?php
                $project_types = get_project_types();
                if ($project_types !== FALSE) {
                  foreach ($project_types as $x) {
                    echo '
                  <option value="' . $x['id'] . '">' . $x['name'] . '</option>';
                  }
                }

                ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="description" class="col-2 col-form-label">Description</label>
            <div class="col-10">
              <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
          </div>

          <div class="form-group row">
            <label for="externalLink" class="col-2 col-form-label">URL</label>
            <div class="col-10">
              <input class="form-control" type="url" placeholder="External Link to project e.g: https://successbux.com" id="externalLink" name="externalLink" value="<?php echo $externalLink; ?>">
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
                      <input type="checkbox" name="features[]" value="' . $x['id'] . '" />
                    </label>
                  </span>
                  ';
                }
              }

              ?>
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
                      <input type="checkbox" name="technologies[]" value="' . $x['id'] . '" />
                    </label>
                  </span>
                  ';
                }
              }

              ?>
            </div>
          </div>


          <div class="form-group row">
            <label for="cover" class="col-2 col-form-label">Cover</label>
            <div class="col-10">
              <input class="form-control" id="cover" type="file" name="cover[]" accept="image/*">
            </div>
          </div>

          <div class="form-group row">
            <label for="thumbnail" class="col-2 col-form-label">Thumbnail</label>
            <div class="col-10">
              <input class="form-control" id="thumbnail" type="file" name="thumbnail[]" accept="image/*">
            </div>
          </div>

          <div class="form-group row">
            <label for="pictures" class="col-2 col-form-label">Project Picture(s)</label>
            <div class="col-10">
              <input class="form-control" id="pictures" type="file" name="pictures[]" accept="image/*" multiple>
            </div>
          </div>

          <div class="form-group row">
            <label for="themeColor" class="col-2 col-form-label">Sort Order</label>
            <div class="col-10">
              <input class="form-control" type="number" placeholder="Greater the number, the more priority in display" id="listOrder" name="listOrder">
            </div>
          </div>

          <div class="form-group row">
            <label for="date_completed" class="col-2 col-form-label">Completion Date</label>
            <div class="col-10">
              <input class="form-control" type="date" id="date_completed" name="date_completed">
            </div>
          </div>

          <div class="form-group row">
            <label for="themeColor" class="col-2 col-form-label">Theme Color</label>
            <div class="col-10">
              <input class="form-control" type="color" id="themeColor" name="themeColor">
            </div>
          </div>

          <center>
            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Add Project in Portfolio</button>
          </center>
          <br /><br />

        </form>

      </div>

    </div>
  </div>
</div>

<?php

require_once "footer.php";

?>