<?php
	ob_start();
    session_start();
	$pageTitle = 'Manager Profile';
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
    <div class="section" id="manager-profile">
      <div class="container">
        <h2 class="special-heading">Manager Profile</h2>
        <div class="kids-info flex">
          <div>
              <img style="width: 300px;height:300px;border-radius:50%" src="<?php echo $imgs.'manager.png' ?>" alt="Manager image Profile">
          </div>
          <h3><?php echo $_SESSION['manager']['username'] ?></h3>
          <h3><?php echo $_SESSION['manager']['name'] ?></h3>
          <h3><?php echo $_SESSION['manager']['position'] ?></h3>
          <div class="flex" style="flex-direction: row;">
            <a class="button" href="<?php echo $cont.'ManagerController.php?method=showSettings' ?>" style="margin: 10px;">Settings</a>
            <a class="button" href="<?php echo $cont.'ManagerController.php?method=showChangePassword' ?>" style="margin: 10px;">change Password</a>
          </div>
        </div>
      </div>
  </div>
<?php
	include $tmp . 'footer.php'; 
	ob_end_flush();

?>