<?php

$pageTitle = 'Web Design Portfolio';

require_once "includes.php";
require_once "header.php";

$url = $site_url . '/web-design-portfolio';
//$rowsLimit = $_GET['limit'];
$currentPage = $_GET['page'];
if (!$rowsLimit) {
    $rowsLimit = 9;
}
if (!$currentPage) {
    $currentPage = 1;
}
$start = ($currentPage - 1) * $rowsLimit;

$sam = $PDO->query("SELECT COUNT(id) as `count` FROM `portfolio` p LEFT JOIN `portfolio_project_types` t ON (p.id=t.portfolio_id) WHERE t.type_id='1'");
$arrayTotal = $sam->fetch();
$totalRows = $arrayTotal['count'];

if ($totalRows < 1) {
    echo display_alert('There is no portfolio to display at the moment.');
} else {

    $SqlStatement = "SELECT * FROM `portfolio` p LEFT JOIN `portfolio_project_types` t ON (p.id=t.portfolio_id) WHERE t.type_id='1' ORDER BY `listOrder` DESC, `id` DESC LIMIT :start, :limit";
    $sam = $PDO->prepare($SqlStatement);
    $sam->bindParam(':start', $start, PDO::PARAM_INT);
    $sam->bindParam(':limit', $rowsLimit, PDO::PARAM_INT);
    $sam->execute();

    if ($sam->rowCount() > 0) {
        $portfolioArray = $sam->fetchAll();
    }

    ?>

    <link rel="stylesheet" type="text/css" href="<?= $site_url; ?>/css/webdesign.css">

    <section>

        <div id="portHead">
            <div class="portHead--inner">

                <div class="portHead-title">
                    <h1>World Wide Web. <span>Designs</span></h1>
                </div>

            </div>
        </div>


        <div id="portContent">
            <div class="portContent--inner">

                <div class="portBoxRow">


                    <?php

                    if (!empty($portfolioArray)) {
                        foreach ($portfolioArray as $p) {

                            $portfolioLink = $site_url . '/project/' . $p['id'] . '/' . $p['slug'];

                            $technologies = get_portfolio_technologies_joined($p['id']);


                            $backendTechnologyList = '';
                            $frontendTechnologyList = '';
                            if (!empty($technologies)) {
                                foreach ($technologies as $x) {
                                    if ($x['type'] == 'backend') {

                                        $backendTechnologyList .= '
                                            <div class="tech-hash">
                                                <span>#</span> ' . $x['name'] . '
                                            </div>
                                                ';
                                    } else {

                                        $frontendTechnologyList .= '
                                            <div class="tech-hash">
                                                <span>#</span> ' . $x['name'] . '
                                            </div>
                                        ';
                                    }
                                }
                            }



                            ?>

                            <div class="portBox">
                                <div class="portBox-img">
                                    <a href="<?php echo $portfolioLink; ?>"><img src="<?php echo display_media($p['thumbnail']); ?>" alt="<?php echo $p['title']; ?>"></a>
                                    <div class="portBox-img-overlay">
                                        <i class="material-icons">arrow_right_alt</i>
                                    </div>
                                </div>
                                <div class="portBox-content">
                                    <a href="<?php echo $portfolioLink; ?>">
                                        <h1><?php echo $p['title']; ?></h1>
                                    </a>

                                    <div class="portBox-tech-img">
                                        <?php echo  $frontendTechnologyList; ?>
                                    </div>

                                    <div class="portBox-team">
                                        <div class="portBox-team-text">
                                            <img src="<?= $site_url; ?>/images/user.png" alt="UI Team">
                                            <span>Team <b>Optical Dot UI/UX</b></span>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        <?php

                        }
                    }

                    ?>


                </div>

                <?php
                echo paginationBarUI($totalRows, $currentPage, $rowsLimit, $url);
                ?>




            </div>
        </div>

    </section>


<?php

}

require_once "footer.php";

?>