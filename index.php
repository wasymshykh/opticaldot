<?php require_once "config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	
    <?php require_once "header-common.php"; ?>
    
    <link rel="stylesheet" type="text/css" href="<?=URL?>/css/home.css">
    <link rel="stylesheet" type="text/css" href="<?=URL?>/css/fullpage.css">

    <link rel="stylesheet" type="text/css" href="<?=URL?>/css/responsive.css">

	<meta name="google-site-verification" content="8N-48BnhiP-_mzCLhle4LnSiMv7jOhwlKy0t68HNyuk" />
	
    <style>
        body {
            overflow: hidden;
        }
        #page-loader {
            width: 100%;
            height: 100%;
            position: fixed;
            background: rgba(255,255,255,1);
            z-index: 101;
            overflow: hidden;
            transition: cubic-bezier(0.075, 0.82, 0.165, 1);
        }

        #page-loader img {
            position: absolute;
            top: calc(50% - 30px);
            left: calc(50% - 30px);
            transform: rotate(180deg);
            animation: 1s rotatorAnimation infinite;
        }

        @keyframes rotatorAnimation {
            0% {
                transform: rotate(0deg);
            }
            50% {
                transform: rotate(90deg);
            }
            100% {
                transform: rotate(180deg);
            }
            
        }
        
        
        @keyframes fade-out-bck {
        0% {
            -webkit-transform: translateZ(0);
                    transform: translateZ(0);
            opacity: 1;
        }
        100% {
            -webkit-transform: translateZ(-80px);
                    transform: translateZ(-80px);
            opacity: 0;
        }
        }

    </style>
    
    <?php if (ENV !== "development"): ?>
        <!--Start of Tawk.to Script-->
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
        <!--End of Tawk.to Script-->
    <?php endif; ?>
</head>

<body>

<div id="page-loader">
    <img src="<?=URL?>/images/logoicon.png" alt="Loading">
</div>


<div id="fullpage">

<section class="scrollSection">

    <div id="header">
        <div class="header-inner">

            <div class="header-logo">
                <a href="<?=URL?>/">
                    <img src="<?=URL?>/images/logo.png" class="logo" alt="OpticalDot logo">
                </a>
            </div>
            
            <?php
                require_once "navigation.php";
            ?>
            
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
                        document.body.style.overflow = 'initial';
                    } else {
                        navigation.classList.add('nav-opened');
                        document.body.style.overflow = 'hidden';
                    }
                });

            </script>

        </div>
    </div>

    <div id="bigVid">

        <div class="bigVid-inner">

            <div class="bigVid-text">
                <h1>One stop Shop for your Business</h1>
                <div class="bigVid-dig">
                    Digitalizing the 
                    <span>
                        <i class="material-icons">lightbulb_outline</i> 
                        ideas</span>
                    <span>
                        <i class="material-icons">pie_chart_outlined</i> 
                        products</span>
                    <span>
                        <i class="material-icons">card_travel</i> 
                        businesses</span>
                </div>
                <div class="bigVid-dig bV-d">
                    Developing
                    <span>
                        <i class="material-icons">developer_board</i> 
                        Hardware</span>&nbsp;
                        And
                    <span>
                        <i class="material-icons">cloud_queue</i> 
                        Software</span>
                </div>
            </div>

        </div>
    </div>

</section>

<section class="scrollSection" id="companyDiv">

    <div id="company">
        <div class="company-left">
            <div class="company-leftText">
                <h1>Our<span>Team</span></h1>
                <p>
                    Our team is comprised of industry experts with hands-on experience, 
                    forming a solid base for innovation in development and seamless integration. </p>
                <p> We have been working on breakthrough projects for years 
                    with a greater goal of serving masses through research, out-of-the-box product development & ingenious customer experiences.</p>
                <ul>
                    <li><i class="material-icons">favorite_border</i> Dedicated People</li>
                    <li><i class="material-icons">favorite_border</i> Professionals</li>
                    <li><i class="material-icons">favorite_border</i> Experienced</li>
                    <li><i class="material-icons">favorite_border</i> Friendly Folks</li>
                </ul>

                <div class="company-bottom">
                    <a href="<?=URL?>/contact">Let's Hangout</a>
                    <a href="<?=URL?>/development-services" class="company-bottom-dark">Our Solutions</a>
                </div>

            </div>
        </div>

        <div class="company-center">
            <div class="company-centerTop">
                
                <h1>Our Company</h1>
                <p>
                    Exquisite Designs to Solid Code, Optical Dot offers cutting edge IT solutions for industries ranging from Sole Internet based Companies to White Goods Manufacturers. We practice the impact of technology, the enabler, in curating user experiences. As we preach, we make sure to deliver at market’s most competitive value, both in time and money.
                </p>
                <p>
                    We paint your dreams. Engineer the innovation you believe in. From idea brainstorming to a product customer experience, we take your business to next level.
                </p>



            </div>

            <div class="company-centerBottom">
                <h1>Our Mission</h1>
                <p>Optical Dot aims to offer complete suite of services and broker products to major industries that can directly influence an end-user. The services range from Frontend to Backend, Design to Development, Innovation to Maintenance, all precisely curated to integrate technology rim in the conventional wheel of manufacturers while making the best out of their online presence.</p>
            </div>
        </div>

        
    </div>


</section>


<section class="scrollSection" id="techDiv">
    <div id="technology">

        <div class="tech-center">

            <div class="tech-heading">
                <h1>Technology & Services</h1>
                <h3>From Idea to Market, we have it all</h3>
            </div>

            <div class="tech-cat">
                <div class="tech-cat-row">
                    <img src="<?=URL?>/images/icons/tech-icon-1.svg" alt="Brand">
                    <div class="tech-cat-text">
                        <div class="tech-cat-ul">
                            <div class="tech-cat-heading">Brand</div>
                            <ul>
                                <li><i class="material-icons">check</i> Theme</li>
                                <li><i class="material-icons">check</i> Viability Study</li>
                                <li><i class="material-icons">check</i> Audience Specialization</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="tech-cat-row">
                    <img src="<?=URL?>/images/icons/tech-icon-2.svg" alt="Customization">
                    <div class="tech-cat-text">
                        <div class="tech-cat-ul">
                            <div class="tech-cat-heading">Customization</div>
                            <ul>
                                <li><i class="material-icons">check</i> CMS Modification</li>
                                <li><i class="material-icons">check</i> Plugin Creation</li>
                                <li><i class="material-icons">check</i> Library Development</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="tech-cat-row">
                    <img src="<?=URL?>/images/icons/tech-icon-3.svg" alt="Optimization">
                    <div class="tech-cat-text">
                        <div class="tech-cat-ul">
                            <div class="tech-cat-heading">Optimization</div>
                            <ul>
                                <li><i class="material-icons">check</i> Database Optimization</li>
                                <li><i class="material-icons">check</i> Search Engine Optimization</li>
                                <li><i class="material-icons">check</i> App Maintenance</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="tech-cat-row">
                    <img src="<?=URL?>/images/icons/tech-icon-4.svg" alt="Optimization">
                    <div class="tech-cat-text">
                        <div class="tech-cat-ul">
                            <div class="tech-cat-heading">Marketing</div>
                            <ul>
                                <li><i class="material-icons">check</i> Search Engine Marketing</li>
                                <li><i class="material-icons">check</i> Social Media Targeted Marketing</li>
                                <li><i class="material-icons">check</i> Affiliate Advertising</li>
                                <li><i class="material-icons">check</i> Incentivized Traffic Marketing</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>



<section class="scrollSection">
	<div id="services">
		<div class="services-inner">

			<div class="services-lane">
				<div class="service-box">
					<div class="service-img">
						<img src="<?=URL?>/images/service-img-1.png">
					</div>
					<div class="service-text">
						<h1><span>Website</span> Designing</h1>
						<p>Exquisite frontends with responsiveness, hence your website can be viewed from desktop, laptop, tablet, mobile or any other device</p>
                    </div>
                    <div class="service-tech">
                        <img src="<?=URL?>/images/technology/adobe-xd.jpg" class="tooltipped" data-tooltip="Adobe Xd" alt="Adobe Xd">         
                        <img src="<?=URL?>/images/technology/adobe-photoshop.jpg" class="tooltipped" data-tooltip="Adobe Photoshop" alt="Adobe Photoshop">
                        <img src="<?=URL?>/images/technology/html5logo.png" class="tooltipped" data-tooltip="HTML5" alt="HTML5">
                        <img src="<?=URL?>/images/technology/css3logo.png" class="tooltipped" data-tooltip="CSS3" alt="CSS3"> 
                        <img src="<?=URL?>/images/technology/jslogo.png" class="tooltipped" data-tooltip="Javascript" alt="Javascript">   
                        <img src="<?=URL?>/images/technology/jquerylogo.png" class="tooltipped" data-tooltip="Jquery" alt="Jquery"> 
                        <img src="<?=URL?>/images/technology/bootstraplogo.png" class="tooltipped" data-tooltip="Bootstrap" alt="Bootstrap"> 
                    </div>
                    
				</div>
				<div class="service-box">
					<div class="service-img">
						<img src="<?=URL?>/images/service-img-2.png">
					</div>
					<div class="service-text">
						<h1><span>Website</span> Development</h1>
						<p>Extremely powerful web applications with highly secure backends and cutting-edge scalable technologies utilization</p>
                    </div>
                    <div class="service-tech">
                        <img src="<?=URL?>/images/technology/dotnetlogo.png" class="tooltipped" data-tooltip=".net" alt=".net">
                        <img src="<?=URL?>/images/technology/phplogo.png" class="tooltipped" data-tooltip="Php" alt="Php">
                        <img src="<?=URL?>/images/technology/mysqllogo.png" class="tooltipped" data-tooltip="MySQL" alt="MySQL">
                        <img src="<?=URL?>/images/technology/nodejslogo.png" class="tooltipped" data-tooltip="NodeJS" alt="NodeJS">
                        <img src="<?=URL?>/images/technology/mongodblogo.png" class="tooltipped" data-tooltip="MongoDB" alt="MongoDB">
                        <img src="<?=URL?>/images/technology/wordpresslogo.png" class="tooltipped" data-tooltip="Wordpress" alt="Wordpress">   
                        <img src="<?=URL?>/images/technology/drupallogo.png" class="tooltipped" data-tooltip="Drupal" alt="Drupal">    
                    </div>
				</div>
				<div class="service-box">
					<div class="service-img">
						<img src="<?=URL?>/images/service-img-3.png">
					</div>
					<div class="service-text">
						<h1><span>Mobile App</span> Development</h1>
						<p>Stable, interactive and powerful mobile applications. Supporting Android, iOS and Windows Platforms</p>
                    </div>
                    <div class="service-tech">
                        <img src="<?=URL?>/images/technology/androidstudiologo.png" class="tooltipped" data-tooltip="Android Studio" alt="Android Studio">
                        <img src="<?=URL?>/images/technology/swiftlogo.png" class="tooltipped" data-tooltip="Swift" alt="Swift">
                        <img src="<?=URL?>/images/technology/javalogo.png" class="tooltipped" data-tooltip="Java" alt="Java">
                        <img src="<?=URL?>/images/technology/unitylogo.png" class="tooltipped" data-tooltip="Unity" alt="Unity">
                        <img src="<?=URL?>/images/technology/xcodelogo.png" class="tooltipped" data-tooltip="XCode" alt="XCode">
                        <img src="<?=URL?>/images/technology/apachecordovalogo.png" class="tooltipped" data-tooltip="Apache Cordova" alt="Apache Cordova">
                        <img src="<?=URL?>/images/technology/phonegaplogo.png" class="tooltipped" data-tooltip="Phone Gap" alt="Phone Gap">
                    </div>
				</div>
			</div>

			<div class="services-lane">
				<div class="service-box">
					<div class="service-img">
						<img src="<?=URL?>/images/service-img-4.png">
					</div>
					<div class="service-text">
						<h1><span>Desktop App</span> Development</h1>
                        <p>Highly Customizable Desktop development with local database as well as adaptive network connectivity</p>
                    </div>
                    <div class="service-tech">
                        <img src="<?=URL?>/images/technology/dotnetlogo.png" class="tooltipped" data-tooltip=".net" alt=".net">
                        <img src="<?=URL?>/images/technology/javalogo.png" class="tooltipped" data-tooltip="Java" alt="Java">
                        <img src="<?=URL?>/images/technology/pythonlogo.png" class="tooltipped" data-tooltip="Python" alt="Python">                        
                    </div>

				</div>
				
				<div class="service-box">
					<div class="service-img">
						<img src="<?=URL?>/images/service-img-5.png">
					</div>
					<div class="service-text">
                        <h1><span>Logo</span> and <span>Iconography</span></h1>
                        <p>From concept to brand, we make sure your icons reflect your idea</p>
                    </div>
                    <div class="service-tech">
                        <img src="<?=URL?>/images/technology/adobe-illustrator.jpg" class="tooltipped" data-tooltip="Adobe Illustrator" alt="Adobe Illustrator"> 
                    </div>
                </div>
				
				<div class="service-box">
					<div class="service-img">
						<img src="<?=URL?>/images/service-img-6.png">
					</div>
					<div class="service-text">
                        <h1><span>Advertisement</span> Graphics</h1>
                        <p>Static and Animated banners/panaflex and misc. advert graphics curated to attract your customer</p>
                    </div>
                    <div class="service-tech">
                        <img src="<?=URL?>/images/technology/adobe-photoshop.jpg" class="tooltipped" data-tooltip="Adobe Photoshop" alt="Adobe Photoshop">
                    </div>
				</div>
			</div>

		</div>
	</div>
</section>

<section class="scrollSection">
	<div id="testimonial">
		<div class="testimonial-inner">
			
			<div class="testimonial-l">
				
				<h1>What <span>Customers Say</span></h1>
				<p>Some of our customers have reviewed our work.</p>
				
			</div>

			<div class="testimonial-row">

                <div class="carousel">

                <div class="carousel-item testimonial-box">
                        <div class="testimonial-text">
                            <p>Awesome work! I love the page Design Because of the hourly zone maybe we can't get connected at the same time and that cost us a little work and time.
        But The work with Optical Dot was Amazing! Solved everything immediately. Outstanding experience.</p>
                            <div class="testimonial-author">
                                <img src="<?=URL?>/images/jason.png">
                                <div class="testimonial-author-text">
                                    <h3>Jason</h3>
                                    <h5>Quantumshares Owner</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item testimonial-box">
                        <div class="testimonial-text">
                            <p>Fresh creative seller. Cooperation with OpticalDot is pleasure. It is a true professional. Quality and timing of the work above all praise, thank you!</p>
                            <div class="testimonial-author">
                                <img src="<?=URL?>/images/clixmatic.jpg">
                                <div class="testimonial-author-text">
                                    <h3>Clixmatic</h3>
                                    <h5>Clixmatic Owner</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item testimonial-box">
                        <div class="testimonial-text">
                            <p>Very happy with the results. Seller was helpful throughout the development process and patient with my requested revisions. Would recommend this seller to anyone.</p>
                            <div class="testimonial-author">
                                <img src="<?=URL?>/images/customer.jpg">
                                <div class="testimonial-author-text">
                                    <h3>tkeyesjr</h3>
                                    <h5>Customer</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>

			</div>

		</div>
	</div>
</section>

<footer class="scrollSection" id="footerDiv">
    <div id="footer">

        <div class="footer-top">
            <div class="footer-qoute">
                <h1>Request a <span>Quote</span></h1>
                <p></p>
                <ul>
                    <li><span class="footer-icon footer-email"></span> opticaldotofficial@gmail.com</li>
                    <li><span class="footer-icon footer-whatsapp"></span> <i style="font-weight: 300">whatsapp</i> +92-302-736286</li>
                </ul>
                <h3>Official Social Media</h3>
                <ul>
                    <li><span class="footer-icon footer-skype"></span> opticaldot</li>
                    <li><span class="footer-icon footer-facebook"></span> fb.com/opticaldot</li>
                    <li><span class="footer-icon footer-twitter"></span> @opticaldot</li>
                </ul>
            </div>

            <form method="POST" action="<?=URL?>/contact">
            
                <div class="footer-contact">
                    <div class="input-row">
                        <div class="input-field">
                            <input id="full_name" name="full_name" type="text" class="validate">
                            <label for="full_name">Name</label>
                        </div>
                    </div>
        
                    <div class="input-row">
                        <div class="input-field">
                            <input id="email" name="email" type="text" class="validate">
                            <label for="email">Email</label>
                        </div>
                    </div>
        
                    <div class="input-row">
                        <div class="input-field">
                            <textarea name="message" id="writemessage" class="materialize-textarea"></textarea>
                            <label for="writemessage">Write your message</label>
                        </div>
                    </div>
        
                    <div class="input-row">
                        <input name="submit" type="submit" value="Send Message">
                    </div>
                </div>

            </form>
        </div>
        

        <div class="footer-bottom">
            <div class="footer-industries">
                <h1>Industries</h1>
                <ul>
                    <li><span class="footer-ecommerce"></span> Ecommerce</li>
                    <li><span class="footer-food"></span> Food/Drinks</li>
                    <li><span class="footer-advertising"></span> Advertising</li>
                    <li><span class="footer-school"></span> School/College</li>
                    <li><span class="footer-banking"></span> Banking/Finance</li>
                    <li><span class="footer-camera"></span> Photography/media</li>
                    <li><span class="footer-office"></span> Office/Workplace</li>
                    <li><span class="footer-telecommunication"></span> Telecommunication</li>
                    <li><span class="footer-medical"></span> Medical/Insurance</li>
                    <li><span class="footer-security"></span> Security</li>
                    <li><span class="footer-music"></span> Music/Entertainment</li>
                    <li><span class="footer-automation"></span> Automation</li>
                </ul>
            </div>
            <div class="footer-logo">
                <img src="<?=URL?>/images/footer-logo.png" alt="OpticalDot Logo">
                <p>We established as an independent graphic design agency back in 2014. Today, our platform provides full-stack solution for businesses.</p>
            </div>
        </div>



    </div>
</footer>
    
</div>
  


<script>
    document.querySelector("#writemessage").addEventListener('keydown', function (e) { 
        var keycode1 = (e.keyCode ? e.keyCode : e.which);
        console.log(keycode1);
        if (keycode1 == 32 || keycode1 == 38) 
        { e.stopPropagation(); } 
    })
    
</script>
<script src="<?=URL?>/js/materialize.min.js"></script>
<script src="<?=URL?>/js/fullpage.js"></script>


<script>
    let nav;

    if(window.innerWidth <= 750) {
        const footerSec = document.getElementById('footerDiv');
        const footerRemain = footerSec.children.footer.children[1];

        let createASec = document.createElement('section');
        createASec.classList = 'scrollSection';
        let createAInner = document.createElement('div');
        createAInner.id = 'footer-center';
        createAInner.appendChild(footerRemain);
        createASec.appendChild(createAInner);
        footerSec.parentElement.insertBefore(createASec, footerRemain.nextSibling);
        nav = ['Top', 'Company', 'Offerings', 'Web', 'Testimonials', 'Contact', 'Footer'];
    } else {
        nav = ['Top', 'Company', 'Offerings', 'Web', 'Testimonials', 'Footer'];
    }

    if(window.innerWidth <= 650) {
        const companySec = document.getElementById('companyDiv');

        const companyRemain = companySec.children.company.children[1];

        let createASec = document.createElement('section');
        createASec.classList = 'scrollSection';
        createASec.appendChild(companyRemain);
        companySec.parentElement.insertBefore(createASec, companySec.nextSibling);


        nav = ['Top', 'OurTeam', 'Company', 'Development', 'Web', 'Testimonials', 'Contact', 'Footer'];
    }



    fullpage.initialize('#fullpage', {
        'anchors': nav,
        'menu': '#menu',
        'navigation': true,
        'navigationPosition': 'right',
        'navigationColor': '#000',
        'navigationTooltips': nav,
        'scrollBar': false,

        'css3': true,
        'scrollingSpeed': 1000,
        'autoScrolling': true,
        'easingcss3': 'ease',
        'touchSensitivity': 5,

        'keyboardScrolling': true,
        'recordHistory': false,

        'controlArrows': false,

        'sectionSelector': '.scrollSection'
    });
</script>

    <script src="<?=URL?>/js/custom.js"></script>

    <?php if (ENV !== "development"): ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-44817856-7"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-44817856-7');
        </script>
    <?php endif; ?>
    
    </body>
</html>