<?php
require_once "includes.php";

$pid = $_GET['id'];
$slug = $_GET['slug'];

$sam = $PDO->prepare("SELECT *
FROM `portfolio` p
WHERE p.id=:pid AND p.slug=:slug");
$sam->execute(array(':pid' => $pid, ':slug' => $slug));

if ($sam->rowCount() < 1) {
    header('location: /web-design-portfolio');
}

$portfolio = $sam->fetch();

$portfolio_id = $portfolio['id'];

$pictures = get_portfolio_pictures($portfolio_id);
$technologies = get_portfolio_technologies_joined($portfolio_id);
$features = get_portfolio_features_joined($portfolio_id);


$keywords = [];
foreach ($technologies as $x) {
    $keywords[] = $x['name'];
}
foreach ($features as $x) {
    $keywords[] = $x['name'];
}
$meta_keywords = implode(",", $keywords);
$pageTitle = $portfolio['title'];

$pictureSlides = '';
if (!empty($pictures)) {
    foreach ($pictures as $x) {
        $pictureSlides .= '<div class="item">
            <img src="' . display_media($x['media_id']) . '">
            <a href="' . display_media($x['media_id']) . '"  class="visit-overlay" target="_blank">Full Screenshot</a>
            </div>';
    }
}

$featureList = '';
if (!empty($features)) {
    foreach ($features as $x) {
        $featureList .= '
        <li><img src="' . display_media($x['media_id']) . '" alt="' . $x['name'] . '" /> <span>' . $x['name'] . '</span></li>';
    }
}

$backendTechnologyList = '';
$frontendTechnologyList = '';
if (!empty($technologies)) {
    foreach ($technologies as $x) {
        if ($x['type'] == 'backend') {
            $backendTechnologyList .= '
            <div class="tech-imgs-icon"><img src="' . display_media($x['media_id']) . '" class="tooltipped" data-tooltip="' . $x['name'] . '" alt="' . $x['name'] . '" /></div>';
        } else {
            $frontendTechnologyList .= '
            <div class="tech-imgs-icon"><img src="' . display_media($x['media_id']) . '" class="tooltipped" data-tooltip="' . $x['name'] . '" alt="' . $x['name'] . '" /></div>';
        }
    }
}

require_once "header.php";

?>

<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/owl.theme.default.min.css">
<link rel="stylesheet" href="<?= $site_url ?>/css/animate.css" />
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/webdevportfolio.css">

<section>

    <div id="webDev-shot">
        <div class="webDevShot-inner">

            <!-- Shot top -->

            <div class="webDevShot-top">
                <div class="webDevShot-slider">
                    <div class="owl-carousel owl-theme">
                        <div class="item">
                            <img src="<?php echo display_media($portfolio['cover']); ?>">
                        
                            <a href="<?php echo display_media($portfolio['cover']); ?>" class="visit-overlay" target="_blank">
                                Full Screenshot
                            </a>
                        </div>
                        <?php echo $pictureSlides; ?>
                    </div>
                </div>

                <!-- <div class="webDevShot-slider">
                    <div class="slider">
                        <ul class="slides">
                            <li><a href="<?php echo display_media($portfolio['cover']); ?>" target="_blank"><img src="<?php echo display_media($portfolio['cover']); ?>"></a>
                                <div class="visit-overlay">Full Screenshot</div>
                            </li>
                            <?php echo $pictureSlides; ?>
                        </ul>
                    </div>
                </div> -->

                <div class="webDevShot-work">
                    <div class="shotWork-title">
                        <h1>Our Work</h1>
                    </div>
                    <?php if (!empty($frontendTechnologyList)) { ?>
                        <div class="shotWork-tech">
                            <h1>Frontend</h1>
                            <div class="shotWork-tech-imgs">
                                <?php echo $frontendTechnologyList; ?>
                            </div>
                        </div>
                    <?php }
                    if (!empty($backendTechnologyList)) { ?>
                        <div class="shotWork-tech">
                            <h1>Backend</h1>
                            <div class="shotWork-tech-imgs">
                                <?php echo $backendTechnologyList; ?>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="shotWork-tech">
                        <h1>Features</h1>
                        <ul>
                            <?php echo $featureList; ?>
                        </ul>
                    </div>
                </div>

            </div>

            <!-- Description -->

            <div class="webDevShot-bottom">
                <div class="webDevShot-title">
                    <h1><?php echo $portfolio['title']; ?></h1>
                    <div class="webDevVisit">
                        <a href="<?php echo $portfolio['externalLink']; ?>" target="_blank"><i class="material-icons">call_made</i> Visit</a>
                    </div>
                </div>
                <div class="webDevShot-data" id="description">
                    <p>
                        <?php
                        echo html_entity_decode($portfolio['description']);
                        ?>
                    </p>
                </div>
            </div>


        </div>
    </div>

</section>

<script src="<?=URL?>/js/jquery-3.5.1.min.js"></script>
<script src="<?=URL?>/js/owl.carousel.min.js"></script>

<script>
    $('.webDevShot-slider .owl-carousel').owlCarousel({
        animateOut: 'slideOutDown',
        animateIn: 'flipInX',
        nav:true,
        items:1,
        margin:30,
        stagePadding:50,
        smartSpeed:450
    });
</script>
<?php

require_once "footer.php";

?>