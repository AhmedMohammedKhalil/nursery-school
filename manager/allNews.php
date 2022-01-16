<?php
	ob_start();
	session_start();
	$pageTitle = 'All News';
	include 'init.php';
	include $tmp.'header.php';
	if(isset($_SESSION['news'])) {
        $news = $_SESSION['news'];
    }
?>
<div class="section news" id="news" style="min-height: 76.3vh;">
        <div style="text-align: center;    margin-bottom: 20px;">
            <a class="button" href="<?php echo $cont.'NewsController.php?method=addNew' ?>">Add News</a>
        </div>
        <div class="container">
            <h2 class="special-heading">All News</h2>
            <div class="flex">
				<?php foreach($news as $n) {?>
                <div class="item">
                    <div class="image">
                      <img src="<?php echo $imgs?>hash.jpg" alt="">
                    </div>
                    <div class="text">
                      <h3><?php echo $n['title'] ?></h3>
                      <p>
                        <?php echo nl2br($n['content'])?>
                      </p>
                      <div class="flex" style="flex-direction: row; margin:0;justify-content:start">
                          <a class="button" href="<?php echo $cont.'NewsController.php?method=editNew&id='.$n['id'] ?>" style="margin: 10px;">Edit</a>
                          <a class="button" href="<?php echo $cont.'NewsController.php?method=delNew&id='.$n['id'] ?>" style="margin: 10px;">Delete</a>
                      </div>
                    </div>
                </div>
                <?php } 
					if(empty($news)) {
						echo"<h3>Not Found News</h3>";
					}
				?>
            </div>
        </div>
    </div>
      
<?php
	include $tmp . 'footer.php';
	ob_end_flush();
?>