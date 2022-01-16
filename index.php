<?php
    ob_start();
    session_start();
    include('init.php');
    $pageTitle = "Home";
    $activites = true;
    include($tmp.'header.php');
?>

    <div class="landing">
        <div class="intro-text">
        <h1>Hello There</h1>
        <p>We are Nursry School - Best Website for Manage Kids in Our School</p>
        </div>
    </div>
    <div class="section" id="">
        <div class="container">
        <h2 class="special-heading">News</h2>
        <div class="section-content">
            <div class="text">
                <div>
                    <h3>title</h3>
                    <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil nemo neque voluptate tempora velit cum non,
                    fuga vitae architecto delectus sed maxime rerum impedit aliquam obcaecati, aut excepturi iusto laudantium!
                    </p>
                </div>
                <div>
                    <h3>title</h3>
                    <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil nemo neque voluptate tempora velit cum non,
                    fuga vitae architecto delectus sed maxime rerum impedit aliquam obcaecati, aut excepturi iusto laudantium!
                    </p>
                </div>
            </div>
            <div class="image" >
                <img src="<?php echo $imgs?>events.png" alt="Events Photo" />
            </div>
        </div>
        </div>
    </div>

    <div class="section" id="about">
        <div class="container">
        <h2 class="special-heading">About</h2>
        <div class="section-content">
            <div class="image">
                <img src="<?php echo $imgs?>about.jpg" alt="About photo" />
            </div>
            <div class="text">
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil nemo neque voluptate tempora velit cum non,
                fuga vitae architecto delectus sed maxime rerum impedit aliquam obcaecati, aut excepturi iusto laudantium!
            </p>
            <hr />
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus, sapiente. Velit iure exercitationem
                dolores nesciunt dolore. Eum officiis dolorum hic voluptate quaerat minima, similique inventore esse,
                alias, sed quo officia?
            </p>
            </div>
        </div>
        </div>
    </div>
<?php
    include($tmp.'footer.php');
    ob_end_flush();

