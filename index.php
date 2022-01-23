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
            <div class="image" >
                <img src="<?php echo $imgs?>events.png" alt="Events Photo" />
            </div>
        </div>
        </div>
    </div>
    <?php }?>

    <div class="section" id="about">
        <div class="container">
        <h2 class="special-heading">About</h2>
        <div class="section-content">
            <div class="image">
                <img src="<?php echo $imgs?>about.jpg" alt="About photo" />
            </div>
            <div class="text">
            <p>
                Our emphasis is on educating the whole child – the entire emotional, social, physical, creative and intellectual being. </p>
            <hr />
            <p>
                We value and respect each child as an individual and as an important part of our school family. Social development is a central focus of our program, which builds the foundation for successful learning. 
            </p>
            <hr />
            <p>
                Children are given many opportunities to make their own choices and participate in decision-making.
            </p>
            <hr />
            <p>
                Each class is taught by two team teachers, highly trained in child development and appropriate practices. 
            </p>
            <hr />
            <p>
                Our teachers bring a wealth of experience to the classroom and particpate in ongoing staff development opportunities.             
            </p>
            </div>
        </div>
        </div>
    </div>
<?php
    include($tmp.'footer.php');
    ob_end_flush();

