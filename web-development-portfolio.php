<?php

$pageTitle = 'Web Development Portfolio';

require_once "includes.php";
require_once "header.php";

$sam = $PDO->query("SELECT * FROM `portfolio` p LEFT JOIN `portfolio_project_types` t ON (p.id=t.portfolio_id) WHERE t.type_id='2' ORDER BY `listOrder` DESC, `id` DESC");
if ($sam->rowCount() > 0) {
    $portfolioArray = $sam->fetchAll();
}

?>

<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/webdevelopment.css">

<section>
    <div id="webDev">
        <div class="webDev-header">
            <div class="webDev-heading">
                <h1>Web Development <span>Portfolio</span></h1>
            </div>
        </div>



        <div class="webDev-portfolio">
            <div class="webDev-portfolioBoxes">


                <?php

                if (!empty($portfolioArray)) {
                    foreach ($portfolioArray as $p) {

                        $portfolioLink = $site_url . '/project/' . $p['id'] . '/' . $p['slug'];

                        $pictures = get_portfolio_pictures($p['id']);
                        $technologies = get_portfolio_technologies_joined($p['id']);
                        $features = get_portfolio_features_joined($p['id']);

                        $featureList = '';
                        if (!empty($features)) {
                            foreach ($features as $x) {
                                $featureList .= '
                                    <div class="webDev-f-box"><p>' .
                                    $x['name']
                                    . '</p></div>';
                            }
                        }

                        $backendTechnologyList = '';
                        $frontendTechnologyList = '';
                        if (!empty($technologies)) {
                            foreach ($technologies as $x) {
                                if ($x['type'] == 'backend') {

                                    $backendTechnologyList .= '<p><span>#</span> ' . $x['name'] . '</p>';
                                } else {

                                    $frontendTechnologyList .= '<p><span>#</span> ' . $x['name'] . '</p>';
                                }
                            }
                        }



                        ?>

                        <div class="webDev-p-box">
                            <div class="webDev-p-image">
                                <a href="<?php echo $portfolioLink; ?>">
                                    <img src="<?php echo display_media($p['thumbnail']); ?>">
                                </a>
                            </div>

                            <div class="webDev-p-content">
                                <div class="webDev-title">
                                    <a href="<?php echo $portfolioLink; ?>">
                                        <h1><?php echo $p['title']; ?></h1>
                                    </a>
                                </div>

                                <div class="webDev-tech">
                                    <div class="webDev-tech-box">
                                        <div class="webDev-tech-p">
                                            <?php echo $frontendTechnologyList; ?>
                                        </div>
                                    </div>

                                    <div class="webDev-tech-box">
                                        <div class="webDev-tech-p">
                                            <?php echo $backendTechnologyList; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="webDev-features">
                                    <h5>Features</h5>
                                    <div class="webDev-features-boxes">
                                        <?php echo $featureList; ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                    <?php

                    }
                }

                ?>


            </div>
        </div>

        <div class="webDev-Bottom">
            <div class="webDev-b-text">
                <h1>View indepth detail about our development</h1>
                <a href="<?= $site_url ?>/development-services"><span>View</span> Our Services</a>
            </div>
        </div>


    </div>
</section>


<?php

require_once "footer.php";

?>