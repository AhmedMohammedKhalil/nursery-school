<?php
	ob_start();
    session_start();
	$pageTitle = 'Staff Profile';
	include 'init.php';
    include $tmp.'header.php';
?>

    <div class="section" id="staff-profile">
      <div class="container">
        <h2 class="special-heading">Staff Profile</h2>
        <div class="kids-info flex">
          <div>
              <img style="width: 300px;height:300px;border-radius:50%" src="<?php echo $imgs.'staff.jpg' ?>" alt="staff image Profile">
          </div>
          <h3><?php echo $_SESSION['staff']['username'] ?></h3>
          <h3><?php echo $_SESSION['staff']['name'] ?></h3>
          <h3><?php echo $_SESSION['staff']['position'] ?></h3>
          <div class="flex" style="flex-direction: row;">
            <a class="button" href="<?php echo $cont.'StaffController.php?method=showSettings' ?>" style="margin: 10px;">Settings</a>
            <a class="button" href="<?php echo $cont.'StaffController.php?method=showChangePassword' ?>" style="margin: 10px;">change Password</a>
          </div>
        </div>
      </div>
  </div>
<?php
	include $tmp . 'footer.php'; 
	ob_end_flush();

?>