<?php 

$pageTitle = 'Designing Services';

//require_once "includes.php";
require_once "header.php";

?>

<link rel="stylesheet" type="text/css" href="/css/designing.css">


<section>
    <div id="design">

        <div class="design-top">
            <div class="design-t-left">
                <div class="design-t-text">
                    <h1>one. <br>stop. <br>shop.</h1>
                    <h3>Solution for every designing work.</h3>
                    <button class="design-t-btn">Explore <i class="material-icons">arrow_downward</i></button>
                </div>
            </div>
            <div class="design-t-right">
                <div class="design-t-headings">
                    <h1>Designs</h1>
                    <h2>We Draw!</h2>
                </div>
            </div>
        </div>

        <div class="design-services">
            <div class="d-s-boxes">
                <div class="d-s-box">
                    <div class="d-s-box-head">
                        <img src="/images/designing/icon-1.png" alt="Web Designing">
                        <h1>Web Designing</h1>
                    </div>
                    <div class="d-s-box-body">
                        <p> Analysing the user experience, designing user interfaces, modern browsers compatible. Solid interactive cross-origin well optimized designs. Made from scratch to surface.</p>
                    </div>
                </div>
                <div class="d-s-box">
                    <div class="d-s-box-head">
                        <img src="/images/designing/icon-2.png" alt="App Prototyping">
                        <h1>App Prototyping</h1>
                    </div>
                    <div class="d-s-box-body">
                        <p>The most optimal mobile or desktop application designing. It is essential to have most interactive design of your application before it goes to development stage.</p>
                    </div>
                </div>
                <div class="d-s-box">
                    <div class="d-s-box-head">
                        <img src="/images/designing/icon-3.png" alt="Banners & Panaflex">
                        <h1>Banners & Panaflex</h1>
                    </div>
                    <div class="d-s-box-body">
                        <p>Have a product? opticaldot provides banners and panaflex designing service to design promotional graphics for your product publicity on web, streets and on billboards.</p>
                    </div>
                </div>
                <div class="d-s-box">
                    <div class="d-s-box-head">
                        <img src="/images/designing/icon-4.png" alt="Logo Designing">
                        <h1>Logo Designing</h1>
                    </div>
                    <div class="d-s-box-body">
                        <p>Every brand has an identity which represents their vision, a logo of a brand reflects the principle of company. Our logos are made after studying your brand vision.</p>
                    </div>
                </div>
                <div class="d-s-box">
                    <div class="d-s-box-head">
                        <img src="/images/designing/icon-5.png" alt="Posters Designing">
                        <h1>Posters Designing</h1>
                    </div>
                    <div class="d-s-box-body">
                        <p>Designing of elegent, attractive and eye catching posters and flyers to attract the attention of your targetted market. Posters that explain your product to your customers well.</p>
                    </div>
                </div>
                <div class="d-s-box">
                    <div class="d-s-box-head">
                        <img src="/images/designing/icon-6.png" alt="Visiting Cards">
                        <h1>Visiting Cards</h1>
                    </div>
                    <div class="d-s-box-body">
                        <p>Beautifully designed business/visiting cards leave positive impact of your company. Our professional designs help you expand your network, meet new friends/partners/vendors. </p>
                    </div>
                </div>
            </div>

            <div class="d-s-even">
                <h1><span>&</span> even more..</h1>
                <div class="d-s-even-boxes">
                    <div class="d-s-even-box">
                        <img src="/images/designing/icon-7.png" alt="Icons Designing">
                        <div class="d-s-even-text">Icons designing</div>
                    </div>
                    <div class="d-s-even-box">
                        <img src="/images/designing/icon-8.png" alt="Character Designing">
                        <div class="d-s-even-text">Character Designing</div>
                    </div>
                    <div class="d-s-even-box">
                        <img src="/images/designing/icon-9.png" alt="Social Media Posts">
                        <div class="d-s-even-text">Social Media Posts</div>
                    </div>
                    <div class="d-s-even-box">
                        <img src="/images/designing/icon-10.png" alt="Product Presentation">
                        <div class="d-s-even-text">Product Presentation</div>
                    </div>
                    <div class="d-s-even-box">
                        <img src="/images/designing/icon-11.png" alt="Printable Stickers">
                        <div class="d-s-even-text">Printable Stickers</div>
                    </div>
                    <div class="d-s-even-box">
                        <img src="/images/designing/icon-12.png" alt="Photograph Effects">
                        <div class="d-s-even-text">Photograph Editing</div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</section>

<script>
    document.querySelector('.design-t-btn').addEventListener('click', (e)=>{
        e.preventDefault();
        document.querySelector('.design-services').scrollIntoView({behavior:'smooth'});
    });
</script>




<?php 

require_once "footer.php";

?>