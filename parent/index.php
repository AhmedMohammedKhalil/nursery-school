<?php
	ob_start();
    session_start();
	$pageTitle = 'Parent Profile';
	include 'init.php';
    include $tmp.'header.php';
?>

    <div class="section" id="parent-profile">
      <div class="container">
        <h2 class="special-heading">Parent Profile</h2>
        <div class="kids-info flex">
          <div>
              <img style="width: 300px;height:300px;border-radius:50%" src="<?php echo $imgs.'parent.png' ?>" alt="">
          </div>
          <h3><?php echo $_SESSION['parent']['username'] ?></h3>
          <h3><?php echo $_SESSION['parent']['name'] ?></h3>
          <h3><?php echo $_SESSION['parent']['ssn'] ?></h3>
          <h3><?php echo $_SESSION['parent']['phone'] ?></h3>
          <p><?php echo nl2br($_SESSION['parent']['address']) ?></p>
          <div class="flex" style="flex-direction: row;">
            <a class="button" href="<?php echo $cont.'ParentController.php?method=showSettings' ?>" style="margin: 10px;">Settings</a>
            <a class="button" href="<?php echo $cont.'ParentController.php?method=showChangePassword' ?>" style="margin: 10px;">change Password</a>
          </div>
        </div>
      </div>
  </div>
<?php
	include $tmp . 'footer.php'; 
	ob_end_flush();

?>