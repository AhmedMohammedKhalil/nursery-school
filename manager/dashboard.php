<?php
	ob_start();
	session_start();
	$pageTitle = 'Dashboard';
	include 'init.php';
	include $tmp.'header.php';
  
?>
  <?php if(isset($_SESSION['msg'])) { ?>
        <p style="color:black;background:#8bfa8b;padding:20px;margin:0">
            <?php 
                echo $_SESSION['msg'] ;
                unset($_SESSION['msg']);
            ?>
        </p>
  <?php } ?>
	<div class="section" id="kids">
        <div class="container">
          <h2 class="special-heading">Dashboard</h2>
          <div style="display:flex;justify-content:space-evenly;margin:30px">
            <a class="button" href="<?php echo $cont.'ManagerController.php?method=allPayments' ?>">All Payments</a>
            <a class="button" href="<?php echo $cont.'ManagerController.php?method=allKids' ?>">All Kids</a>
            <a class="button" href="<?php echo $cont.'ManagerController.php?method=allStaff' ?>">All Staff</a> 
            <a class="button" href="<?php echo $cont.'ManagerController.php?method=showAddEvaluation' ?>">Evaluation</a>
          </div>
          <h2 class="special-heading">Control</h2>
          <div style="display:flex;justify-content:space-evenly;margin:30px">
            <a class="button" href="<?php echo $cont.'NewsController.php?method=showNews' ?>">All News</a>
            <a class="button" href="<?php echo $cont.'ServicesController.php?method=showServices' ?>">All Services</a>
            <a class="button" href="<?php echo $cont.'ContactController.php?method=showContacts' ?>">All Contacts</a>  

          </div>
        </div>
    </div>
<?php
	include $tmp . 'footer.php';
	ob_end_flush();
?>