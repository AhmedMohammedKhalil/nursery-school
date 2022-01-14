<?php
    ob_start();
    session_start();
    include('init.php');
    $pageTitle = "Home";
    $activites = true;
    include($tmp.'header.php');
    include_once('layout/functions/functions.php');
    $news=selectAll('*','news');

?>

    <div class="landing">
        <div class="intro-text">
        <h1>Hello There</h1>
        <p>We are Nursry School - Best Website for Manage Kids in Our School</p>
        </div>
    </div>
    <?php if(isset($news)) { ?>
    <div class="section" id="">
        <div class="container">

        <h2 class="special-heading">News</h2>
        <div class="section-content">
            <div class="text">
                <?php foreach ($news as $n) {  ?>
                <div>
                    <h3><?php echo $n['title'] ?></h3>
                    <p>
                    <?php echo nl2br($n['content']) ?>
                    </p>
                </div>
                <?php }?>
            </div>
            <div class="image" style="display: flex;height:auto">
                <img src="<?php echo $imgs?>events.png" alt="" />
            </div>
        </div>
        </div>
    </div>
    <?php }?>

    <div class="section" id="about">
        <div class="container">
        <h2 class="special-heading">About</h2>
        <div class="section-content">
            <div class="image" style="display: flex;height:auto">
                <img src="<?php echo $imgs?>about.jpg" alt="" />
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

