<?php 
require_once "config.php";

$pageTitle = 'Page Not Found';

require_once "header.php";

?>

 <style>
    #notFound {
        width: 100%;
        display: flex;
        background: #f3f3f3;
        padding: 15rem 0;
        align-items: center;
        justify-content: center;
    }

    .notFound-text h1 {
        font-size: 4rem;
        color: #000000;
        line-height: 1;
        text-align: center;
        font-weight: 300;
        text-transform: uppercase;
    }

    .notFound-text h1 span {
        font-weight: 900;
    }

    .notFound-text h3 {
        font-size: 3rem;
        color: #000000;
        line-height: 1;
        text-align: center;
        font-weight: 300;
        text-transform: uppercase;
        margin: 1em 0 2em 0;
    }

    .notFound-text button {
        font-size: 1.4rem;
        font-weight: 300;
        text-transform: uppercase;
        color: #ffffff;
        padding: 1em 3em;
        background: #490a29;
        border: none;
        margin: 0 auto;
        cursor: pointer;
        transition: all 0.3s;
        display: block;
    }

    .notFound-text button:focus,
    .notFound-text button:active,
    .notFound-text button:hover {
        background: #2a101d;
    }

    @media (max-width: 750px) {

        #notFound {
            padding: 10rem 0;
        }

        .notFound-text h1 {
            font-size: 3rem;
        }

        .notFound-text h3 {
            font-size: 2.4rem;
        }

    }
</style>

<section>
        <div id="notFound">
            <div class="notFound-text">

                <h1><span>Page</span> Not Found</h1>
                <h3>A page that hasn't been developed yet! Inform us :)</h3>

                <button onclick="goBack()">Go Back</button>

            </div>
        </div>
    </section>
    
    <script>
        function goBack() {
            window.history.back();
        }
    </script>

<?php 

require_once "footer.php";

?>