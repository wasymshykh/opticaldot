<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php require_once "header-common.php"; ?>
	
    <link rel="stylesheet" type="text/css" href="<?=URL?>/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="<?=URL?>/css/footerOverride.css">

    <?php if(ENV !== "development"): ?>
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
                var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                s1.async=true;
                s1.src='https://embed.tawk.to/55c08aa98e8770ff0c657771/default';
                s1.charset='UTF-8';
                s1.setAttribute('crossorigin','*');
                s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
    <?php endif; ?>

</head>
<body>

    <div id="page-loader">
        <img src="<?=URL?>/images/logoicon.png" alt="Loading">
    </div>
    
    <header>
        
        <div id="header">
            <div class="header-inner">

                <div class="header-logo">
                    <a href="<?=URL?>/">
                        <img src="<?=URL?>/images/logo.png" class="logo" alt="OpticalDot logo">
                    </a>
                </div>

                <?php require_once "navigation.php"; ?>
                
                <div class="hamburger">
                    <div class="ham-row"></div>
                    <div class="ham-row"></div>
                    <div class="ham-row"></div>
                </div>

                <script>
                    document.querySelector('.hamburger').addEventListener('click', (e)=>{

                        const navigation = document.querySelector('.navigation');
                        
                        if(navigation.classList.contains('nav-opened')){
                            navigation.classList.remove('nav-opened');
                        } else {
                            navigation.classList.add('nav-opened');
                        }
                    });

                </script>

            </div>
        </div>
            
    </header>