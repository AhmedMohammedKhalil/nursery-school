<?php
	ob_start();
	session_start();
	$pageTitle = 'All Services';
	include 'init.php';
	include $tmp.'header.php';
	if(isset($_SESSION['services'])) {
        $services = $_SESSION['services'];
    }
?>
<?php if(isset($_SESSION['msg'])) { ?>
        <p style="color:black;background:#8bfa8b;padding:20px;margin:0">
            <?php 
                echo $_SESSION['msg'] ;
                unset($_SESSION['msg']);
            ?>
        </p>
<?php } ?>
<div class="section news" id="news" style="min-height: 76.3vh;">
        <div style="text-align: center;    margin-bottom: 20px;">
            <a class="button" href="<?php echo $cont.'ServicesController.php?method=addService' ?>">Add Service</a>
        </div>
        <div class="container">
            <h2 class="special-heading">All Services</h2>
            <div class="flex">
				<?php foreach($services as $s) {?>
                <div class="item">
                    <div class="image">
                      <img src="<?php echo $imgs?>hash.jpg" alt="">
                    </div>
                    <div class="text">
                      <h3><?php echo $s['title'] ?></h3>
                      <p>
                        <?php echo nl2br($s['body'])?>
                      </p>
                      <div class="flex" style="flex-direction: row; margin:0;justify-content:start">
                          <a class="button" href="<?php echo $cont.'ServicesController.php?method=editService&id='.$s['id'] ?>" style="margin: 10px;">Edit</a>
                          <a class="button" href="<?php echo $cont.'ServicesController.php?method=delService&id='.$s['id'] ?>" style="margin: 10px;">Delete</a>
                      </div>
                    </div>
                </div>
                <?php } 
					if(empty($services)) {
						echo"<h3>Not Found Services</h3>";
					}
				?>
            </div>
        </div>
    </div>
      
<?php
	include $tmp . 'footer.php';
	ob_end_flush();
?>