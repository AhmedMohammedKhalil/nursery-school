<?php
	ob_start();
    session_start();
	$pageTitle = 'Parent Dashboard';
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
<div class="section" id="kids" style="min-height: 76.3vh;">
        <div class="container">
          <h2 class="special-heading">Dashboard</h2>
          <div style="display:flex;justify-content:space-evenly;margin:30px">
            <a class="button btn-width" href="<?php echo $cont.'ParentController.php?method=allKids'?>">All Kids</a>
            <a class="button btn-width" href="<?php echo $cont.'ParentController.php?method=showKidsAdvisors'?>">All advisors</a>
            <a class="button btn-width" href="<?php echo $cont.'ParentController.php?method=showKidsAdvisors'?>">Evaluations</a>
          </div>

          <div style="display:flex;justify-content:space-evenly;margin:30px">
            <a class="button btn-width" href="<?php echo $cont.'ParentController.php?method=getNotifications'?>">All Notifications</a>
            <a class="button btn-width" href="<?php echo $cont.'ParentController.php?method=showAllPayments'?>">All Payments</a>
            <a class="button btn-width" href="<?php echo $cont.'ParentController.php?method=addpayment'?>">Add Payments</a>

          </div>
        </div>
    </div>

<?php
	include $tmp . 'footer.php'; 
	ob_end_flush();

?>