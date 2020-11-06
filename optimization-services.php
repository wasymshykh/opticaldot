<?php 
    require_once "config.php";

    $pageTitle = 'Optimization Services';

    require_once "header.php";

?>

<link rel="stylesheet" type="text/css" href="/css/optimization.css">
    
    <div id="optimization">
        <div class="optimization-inner">

            <div class="optimization-text">
                <h1>Optimization</h1>
                <p>Our solutions help your business to optimize experience for you & your customers.</p>
                
                <div class="optimization-btn">
                    <button id="optimizationScroll">Check our solutions <i class="material-icons">arrow_downwards</i></button>
                </div>
            </div>

        </div>
    </div>

    <div id="optimization-services">
        <div class="opti-s-inner">

            <div class="opti-s-boxes">
                <div class="opti-s-box">
                    <img src="/images/optimization/db-optimization.png" alt="Database Optimization">
                    <div class="opti-s-box-text">
                        <h1>Strategic Database Optimization</h1>
                        <p>Our experts make sure that your valuable database is continuously monitored, maintained, optimized and backed-up while
                            making sure integrity and safety stays first.</p>
                    </div>
                </div>
                <div class="opti-s-box">
                    <img src="/images/optimization/se-optimization.png" alt="Search Engine Optimization">
                    <div class="opti-s-box-text">
                        <h1>Search Engine Optimization</h1>
                        <p>We make sure your online presence stays first in relevant Google searches. Not only this, our solution integrates 
                            indexing your website in highly ranked databases.
                        </p>
                    </div>
                </div>

                <div class="opti-s-box">
                    <img src="/images/optimization/sm-management.png" alt="Social Media Management">
                    <div class="opti-s-box-text">
                        <h1>Social Media Management</h1>
                        <p>Keeping your business socially managed is a necessity now! We offer complete management solutions with practices 
                            to increase user engagement and social outreach.
                        </p>
                    </div>
                </div>

                <div class="opti-s-box">
                    <img src="/images/optimization/web-optimization.png" alt="Website Optimization">
                    <div class="opti-s-box-text">
                        <h1>Website Optimization</h1>
                        <h3>and management</h3>
                        <p>Need to manage, monitor and enhance your online presence while you focus on your actual product? 
                            A responsible team will be allocated to manage your valuable business online.</p>
                    </div>
                </div>

                <div class="opti-s-box">
                    <img src="/images/optimization/app-optimization.png" alt="App Management">
                    <div class="opti-s-box-text">
                        <h1>App Management</h1>
                        <p>
                        Application isn't just left at store when you care about user reviews. We make sure your app is continuously maintained, 
                            made compatible with new versions of operating systems and target the broadest scope of devices in support.
                        </p>
                        <h5>For your Application</h5>
                        <ul>
                            <li>Application Maintenance</li>
                            <li>User Feedback Review</li>
                            <li>Continuous Debugging</li>
                            <li>Compatibility Enhancement</li>
                        </ul>
                    </div>
                </div>
                
               
            </div>

        </div>
    </div>
    
    <script>
        document.querySelector('#optimizationScroll').addEventListener('click', ()=>{
            const topToScroll = document.querySelector('#optimization-services').offsetTop + 40;
            window.scroll({
                top: topToScroll, 
                left: 0, 
                behavior: 'smooth' 
            });
        });
    </script>

<?php 

require_once "footer.php";

?>