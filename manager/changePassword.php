<?php
	ob_start();
	session_start();
	$pageTitle = 'change Password';
	include 'init.php';
	include $tmp.'header.php';
  if(isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
  }
?>
	<div class="section" id="change_password" style="margin-bottom: 33px;">
      <div class="container">
        <h2 class="special-heading">change Password</h2>
        <form action="<?php echo $cont."ManagerController.php?method=changePassword"?>" method="POST" class="form">
          <?php
            if(isset($_SESSION['errors'])) {
              echo '<ol style="width:fit-content;margin: 0 auto">';
              foreach($errors as $e) {
                echo '<li style="color: red">'.$e.'</li>';
              }
              echo '</ol>';
            }
          ?>
          <div style="display: flex;justify-content:center;flex-direction:column">
            
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" title="Enter Password" placeholder="Enter Password" required>
            </div>
            <div>
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" title="Enter Password again" placeholder="Enter Password again" required>
            </div>
            <div>
              <input type="submit" name="change_password" value="Change Password">
            </div>
          </div>
        </form>
      </div>
    </div>
<?php
	include $tmp . 'footer.php';
	ob_end_flush();
    unset($_SESSION['errors']);
?>