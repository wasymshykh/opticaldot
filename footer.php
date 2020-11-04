<footer id="nonFullPage">
        <div id="footer">

            <?php if(!isset($NoFooterContactForm)){ ?>

            
    
            <div class="footer-top">
                <div class="footer-qoute">
                    <h1>Request a <span>Quote</span></h1>
                    
                    <ul>
                        <li><span class="footer-email"></span> support@opticaldot.com</li>
                        <li><span class="footer-phone"></span> +92-302-736286</li>
                    </ul>
                    <h3>Official Social Media</h3>
                    <ul>
                        <li><span class="footer-skype"></span> opticaldot</li>
                        <li><span class="footer-facebook"></span> fb.com/opticaldot</li>
                        <li><span class="footer-twitter"></span> @opticaldot</li>
                    </ul>
                </div>

                <form method="POST" action="/contact.php">
                
                <div class="footer-contact">
                    <div class="input-row">
                        <div class="input-field">
                            <input id="full_name" type="text" name="full_name" class="validate">
                            <label for="full_name">Name</label>
                        </div>
                    </div>
        
                    <div class="input-row">
                        <div class="input-field">
                            <input id="email" type="text" name="email" class="validate">
                            <label for="email">Email</label>
                        </div>
                    </div>
        
                    <div class="input-row">
                        <div class="input-field">
                            <textarea name="message" id="textarea1" class="materialize-textarea"></textarea>
                            <label for="textarea1">Write your message</label>
                        </div>
                    </div>
        
                    <div class="input-row">
                        <input type="submit" name="submit" value="Send Message">
                    </div>
                </div>

                </form>

            </div>

            <?php } ?>
            
    
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
                    <p>We established as a independent graphic design agency back in 2014. Today, our platform provides every solution for taking your business to cloud.</p>
                </div>
            </div>
    
    
    
        </div>
    </footer>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.slider');
            var instances = M.Slider.init(elems, {
                height: 350,
                duration: 300,
                interval: 1500
            });
        });
    </script>

    <script src="<?=URL?>/js/fontawesome-all.min.js"></script>
    <script src="<?=URL?>/js/materialize.min.js"></script>
    <script src="<?=URL?>/js/custom.js"></script>


    <?php if(ENV !== "development"): ?>
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