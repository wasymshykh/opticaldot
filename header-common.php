    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <meta content="https://www.facebook.com/opticaldot/" property="fb:profile_id">
    <meta content="en_US" property="og:locale">
    
    <meta content="OpticalDot" property="og:site_name">
    <meta content="website" property="og:type">
    
    <meta content="website" property="og:type">
    <meta content="<?=URL?><?=$_SERVER['REQUEST_URI'];?>" property="og:url">
    
    <link href="<?=URL?>/" rel="home">
    <link href="<?=URL?><?=$_SERVER['REQUEST_URI'];?>" rel="canonical">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@opticaldot">
    <meta name="twitter:creator" content="@opticaldot">

    <?php
    
    if(!empty($pageTitle)){
        
        echo '<title>'.$pageTitle.' - Optical Dot</title>';
        echo '<meta content="'.$pageTitle.'" property="og:title">';
        echo '<meta name="twitter:title" content="'.$pageTitle.'">';
        
        if(strpos($pageTitle, 'Services') !== false){
            
            $description = 'Optical Dot offers '.$pageTitle.'. We paint your dreams. Engineer the innovation you believe in. 
            From idea brainstorming to a product customer experience, we take your business to next level.';
            
        }elseif(strpos($pageTitle, 'Portfolio') !== false){
            
            $description = 'Explore our '.$pageTitle.'. We have been working on breakthrough projects for years with a greater goal of serving masses 
            through research, out-of-the-box product development & ingenious customer experiences.';
            
        }else{
            
            $description = $pageTitle.' Optical Dot. Reach out to the team comprised of industry experts with hands-on experience, 
            forming a solid base for innovation in development and seamless integration.';
            
        }
        
        
    }else{
        echo '<title>Optical Dot</title>';
        $description = 'Exquisite Designs to Solid Code, Optical Dot offers cutting edge IT solutions for industries 
        ranging from Sole Internet based Companies to White Goods Manufacturers';
    }
    
    echo '<meta name="description" content="'.$description.'">';
    
    if(!empty($meta_keywords)) {
        echo '<meta name="keywords" content="'.$meta_keywords.'">';
    }
    
    ?>
    
    
    
    <link rel="apple-touch-icon" sizes="76x76" href="<?=URL?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=URL?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=URL?>/favicon-16x16.png">
    <link rel="manifest" href="<?=URL?>/site.webmanifest">
    <link rel="mask-icon" href="<?=URL?>/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
	

	<link rel="stylesheet" type="text/css" href="<?=URL?>/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=URL?>/css/style.css">
    
	<link href="https://fonts.googleapis.com/css?family=Lato:900,700,400,300" rel="stylesheet" type="text/css">