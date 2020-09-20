<?php 

$pageTitle = 'Graphics Design Portfolio';

require_once "includes.php";
require_once "header.php";

$url = '/graphics-design-portfolio/?';
//$rowsLimit = $_GET['limit'];
$currentPage = $_GET['page'];
if(!$rowsLimit){$rowsLimit=8;}
if(!$currentPage){$currentPage=1;}
$start = ($currentPage-1)*$rowsLimit;

$sam=$PDO->query("SELECT COUNT(id) as `count` FROM `portfolio` p LEFT JOIN `portfolio_project_types` t ON (p.id=t.portfolio_id) WHERE t.type_id='3'");
$arrayTotal = $sam->fetch();
$totalRows = $arrayTotal['count'];

if($totalRows<1){
    echo display_alert('There is no portfolio to display at the moment.');
}else{

    $SqlStatement = "SELECT * FROM `portfolio` p LEFT JOIN `portfolio_project_types` t ON (p.id=t.portfolio_id) WHERE t.type_id='3' ORDER BY `listOrder` DESC, `id` DESC LIMIT :start, :limit";
    $sam=$PDO->prepare($SqlStatement);
    $sam->bindParam(':start', $start, PDO::PARAM_INT);
    $sam->bindParam(':limit', $rowsLimit, PDO::PARAM_INT);
    $sam->execute();

    if($sam->rowCount()>0){
        $portfolioArray = $sam->fetchAll();
    }

?>

<link rel="stylesheet" type="text/css" href="/css/webdesign.css">

<section>

<div id="graphicsHead">
    <div class="gHead-text">

        <div class="gHead-text-inner">
            <h1>Graphic Designing</h1>
            <h3>Logos, posters, banners and much more</h3>
            <div class="gHead-port">
                <p>Portfolio</p>
            </div>
        </div>
        

    </div>

    <div class="gHead-img"></div>

    <div class="portBtm-arrow"><i class="material-icons">arrow_downward</i></div>
</div>

<script>
    document.querySelector('.portBtm-arrow').addEventListener('click', ()=>{
        const topToScroll = document.querySelector('#graphicsportfolio').offsetTop + 40;
        window.scroll({
            top: topToScroll, 
            left: 0, 
            behavior: 'smooth' 
        });
    });
</script>



<div id="graphicsportfolio">
    <div class="graphicsportfolio-inner">


        <?php 
        
        if(!empty($portfolioArray)){
            foreach($portfolioArray as $p){            

        ?>

        <div id="modal<?php echo $p['id']; ?>" class="modal">
            <div class="model-body">
                <div class="model-top-close modal-close"><i class="material-icons">close</i></div>
                <img src="<?php echo display_media($p['cover']); ?>" alt="<?php echo $p['title']; ?>">
            </div>
        </div>

        <div class="graphicport-img">
            <div class="graphic-label">
                <div class="graphic-label-text">
                <?php echo $p['title']; ?>
                </div>
                <div class="graphic-label-btn">
                    <button data-target="modal<?php echo $p['id']; ?>" class="modal-trigger"><i class="material-icons">aspect_ratio</i> Preview</button>
                </div>
            </div>
            <img src="<?php echo display_media($p['thumbnail']); ?>" alt="<?php echo $p['title']; ?>">
        </div>

        <?php

            }
        }

        ?>


    </div>
    
    <?php
        echo paginationBarUI($totalRows,$currentPage,$rowsLimit,$url);
    ?>

</div>

</section>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems);
        });
    </script>

<?php 

    }

require_once "footer.php";

?>