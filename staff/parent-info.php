<?php
	ob_start();
    session_start();
	$pageTitle = 'Parent Info';
	include 'init.php';
    include $tmp.'header.php';
?>

    <div class="section" id="parent-profile">
      <div class="container">
        <h2 class="special-heading">Parent Info</h2>
        <div class="kids-info flex">
          <div>
              <img style="width: 300px;height:300px;border-radius:50%" src="<?php echo $imgs.'parent.png' ?>" alt="parent photo">
          </div>
          <h3><?php echo $_SESSION['parent_info']['username'] ?></h3>
          <h3><?php echo $_SESSION['parent_info']['name'] ?></h3>
          <h3><?php echo $_SESSION['parent_info']['ssn'] ?></h3>
          <h3><?php echo $_SESSION['parent_info']['phone'] ?></h3>
          <p><?php echo nl2br($_SESSION['parent_info']['address']) ?></p>
        </div>
      </div>
  </div>
<?php
	include $tmp . 'footer.php'; 
	ob_end_flush();

?>