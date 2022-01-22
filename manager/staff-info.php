<?php
	ob_start();
    session_start();
	$pageTitle = 'Staff Info';
	include 'init.php';
    include $tmp.'header.php';
?>

    <div class="section" id="staff-info">
      <div class="container">
        <h2 class="special-heading">Staff Info</h2>
        <div class="staf-info flex">
          <div>
              <img style="width: 300px;height:300px;border-radius:50%" src="<?php echo $imgs.'staff.jpg' ?>" alt="staff image Profile">
          </div>
          <h3><?php echo $_SESSION['staff_info']['username'] ?></h3>
          <h3><?php echo $_SESSION['staff_info']['name'] ?></h3>
          <h3><?php echo $_SESSION['staff_info']['position'] ?></h3>
          <h3><?php echo $_SESSION['staff_info']['role'] ?></h3>

        </div>
      </div>
  </div>
<?php
	include $tmp . 'footer.php'; 
	ob_end_flush();

?>