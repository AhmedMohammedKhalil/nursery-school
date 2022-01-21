<?php
	ob_start();
    session_start();
	$pageTitle = 'Staff Dashboard';
	include 'init.php';
    include $tmp.'header.php';
?>

<div class="section" id="kids" style="min-height: 76.3vh;">
        <div class="container">
          <h2 class="special-heading">Dashboard</h2>
          <div style="display:flex;justify-content:space-evenly;margin:30px">
          <a class="button btn-width" href="<?php echo $cont.'StaffController.php?method=allKids'?>">All Kids</a>
            <a class="button btn-width" href="<?php echo $cont.'StaffController.php?method=showNotifications'?>">All Notifications</a>
          </div>
        </div>
</div>

<?php
	include $tmp . 'footer.php'; 
	ob_end_flush();

?>