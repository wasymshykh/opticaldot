<?php 

$pageTitle = 'App Development Portfolio';

require_once "header.php";

?>

<link rel="stylesheet" type="text/css" href="/css/appdevelopment.css">

<section>
    <div id="app_development_top">
        <div class="app_dev_inner">

            <div class="app_dev_text">
                <h3>Application Development</h3>
                <h1>Dawlance</h1>
                <h2>Dawlance Air Android App</h2>
                <div class="app_dev_btn">
                    <button id="goToDetails">Details <i class="material-icons">arrow_downwards</i></button>
                </div>
            </div>

            <div class="app_dev_img">
                <img src="/images/app_development/app-top-img.png" alt="Dawnlance App">
            </div>

        </div>
    </div>
</section>

<section>
    <div id="app_details">
        <div class="app_det_inner">

            <h1>Hardware, Software & Cloud</h1>
            <h3>application implemented on top notch IoT principles</h3>
            <p>Dawlance air android application gives a way to control dawlance air conditioners by just tapping on dawalance air application. 
                We have implemented optimized library for accepting client’s request, processing requests faster over WiFi. </p>
            <div class="app_det_btn">
                <button id="goToFeatures">Features <i class="material-icons">arrow_downwards</i></button>
            </div>

        </div>
    </div>
</section>

<section>
    <div id="app_features">
        <div class="app_fea_inner">


            <div class="app_fea_box">
                <img src="/images/app_development/features-img-1.png" alt="Database Driven Application">
                <div class="app_fea_text">
                    <p><span>Database Driven</span> Application</p>
                </div>
            </div>

            <div class="app_fea_box">
                <img src="/images/app_development/features-img-2.png" alt="Consumption controlling mechanism">
                <div class="app_fea_text">
                    <p><span>Consumption controlling</span> mechanism</p>
                </div>
            </div>

            <div class="app_fea_box">
                <img src="/images/app_development/features-img-3.png" alt="Custom product notification">
                <div class="app_fea_text">
                    <p><span>Custom product</span> notification</p>
                </div>
            </div>

            <div class="app_fea_box">
                <img src="/images/app_development/features-img-4.png" alt="User Management System">
                <div class="app_fea_text">
                    <p><span>User Management</span> System</p>
                </div>
            </div>

            <div class="app_fea_box">
                <img src="/images/app_development/features-img-5.png" alt="AC Profile Management">
                <div class="app_fea_text">
                    <p><span>AC Profile</span> Management</p>
                </div>
            </div>

            <div class="app_fea_box">
                <img src="/images/app_development/features-img-6.png" alt="Feedback Support System">
                <div class="app_fea_text">
                    <p><span>Feedback Support</span> System</p>
                </div>
            </div>

            <div class="app_fea_box">
                <img src="/images/app_development/features-img-7.png" alt="User Friendly Remote">
                <div class="app_fea_text">
                    <p><span>User Friendly</span> Remote</p>
                </div>
            </div>

            <div class="app_fea_box">
                <img src="/images/app_development/features-img-8.png" alt="Temperature Management System">
                <div class="app_fea_text">
                    <p><span>Temperature Management</span> System</p>
                </div>
            </div>

            <div class="app_fea_box">
                <img src="/images/app_development/features-img-9.png" alt="Controling from anywhere">
                <div class="app_fea_text">
                    <p><span>Controling from</span> anywhere</p>
                </div>
            </div>


            
        </div>

        <div class="app_fea_btn">
            <button id="goToScreen">Screenshots <i class="material-icons">arrow_downwards</i></button>
        </div>

    </div>
</section>

<section>
    <div id="app_screen">
        <div class="app_screen_inner">

            <div class="app_scr_text">
                <h3>Application</h3>
                <h1>Featured On</h1>
                <div class="app_scr_boxes">
                    <a href="" class="app_scr_box">
                        <img src="/images/app_development/dawn-logo.png" alt="Dawn News">
                    </a>
                    <a href="" class="app_scr_box">
                        <img src="/images/app_development/nc-logo.png" alt="National Courier">
                    </a>
                    <a href="" class="app_scr_box">
                        <img src="/images/app_development/bs-logo.png" alt="Brand Synario">
                    </a>
                    <a href="" class="app_scr_box">
                        <img src="/images/app_development/po-logo.png" alt="Pakistan Observer">
                    </a>
                </div>
            </div>

            <div class="app_scr_r">
                <div class="app_control_l">
                    <i class="material-icons">chevron_left</i>
                </div>

                <div class="app-slider">
                    <img src="/images/app_development/dawlance/AC Edit.png" class="app_slider_active">
                    <img src="/images/app_development/dawlance/budget meter.png">
                    <img src="/images/app_development/dawlance/call center.png">
                    <img src="/images/app_development/dawlance/complaint center.png">
                    <img src="/images/app_development/dawlance/customer services.png">
                    <img src="/images/app_development/dawlance/daily consumption.png">
                    <img src="/images/app_development/dawlance/error codes.png">
                    <img src="/images/app_development/dawlance/feedback.png">
                    <img src="/images/app_development/dawlance/filter cleaning.png">
                    <img src="/images/app_development/dawlance/KYP.png">
                    <img src="/images/app_development/dawlance/main menu.png">
                    <img src="/images/app_development/dawlance/monthly consumption.png">
                    <img src="/images/app_development/dawlance/nearby service center locator.png">
                    <img src="/images/app_development/dawlance/remote enabled.png">
                    <img src="/images/app_development/dawlance/screen-splash.png">
                    <img src="/images/app_development/dawlance/update password.png">
                    <img src="/images/app_development/dawlance/user profile.png">
                </div>

                <div class="app_control_r">
                    <i class="material-icons">chevron_right</i>
                </div>
            </div>

        </div>
    </div>
</section>


<script>

    document.querySelector('#goToDetails').addEventListener('click', ()=>{
        const topToScroll = document.querySelector('#app_details').offsetTop;
        window.scroll({
            top: topToScroll, 
            left: 0, 
            behavior: 'smooth' 
        });
    });

    document.querySelector('#goToFeatures').addEventListener('click', ()=>{
        const topToScroll = document.querySelector('#app_features').offsetTop;
        window.scroll({
            top: topToScroll, 
            left: 0, 
            behavior: 'smooth' 
        });
    });

    document.querySelector('#goToScreen').addEventListener('click', ()=>{
        const topToScroll = document.querySelector('#app_screen').offsetTop;
        window.scroll({
            top: topToScroll, 
            left: 0, 
            behavior: 'smooth' 
        });
    });

    const appSlider = document.querySelector('.app-slider');
    const appSliderLength = appSlider.children.length;

    document.querySelector('.app_control_l').addEventListener('click', ()=>{
        clearInterval(slideAuto);
        changeSlide(false);
    });
    document.querySelector('.app_control_r').addEventListener('click', ()=>{
        clearInterval(slideAuto);
        changeSlide(true);
    });

    let slideAuto = setInterval(() => {
        changeSlide(true);
    }, 2000);
    
    const changeSlide = (isIncrease)=>{
        for(let i = 0; i < appSliderLength; i++){
            if(appSlider.children[i].classList.contains('app_slider_active')){
                if(i < appSliderLength-1 && isIncrease){
                    appSlider.children[i].classList.remove('app_slider_active');
                    appSlider.children[i+1].classList.add('app_slider_active');
                } else if (isIncrease) {
                    appSlider.children[appSliderLength-1].classList.remove('app_slider_active');
                    appSlider.children[0].classList.add('app_slider_active');
                }

                if(i > 0 && !isIncrease){
                    appSlider.children[i].classList.remove('app_slider_active');
                    appSlider.children[i-1].classList.add('app_slider_active');
                } else if(!isIncrease) {
                    appSlider.children[0].classList.remove('app_slider_active');
                    appSlider.children[appSliderLength-1].classList.add('app_slider_active');
                }
                break;
            }
        }
    }

</script>


<?php 


require_once "footer.php";

?>