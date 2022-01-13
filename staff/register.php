<?php
	ob_start();
  session_start();
	$pageTitle = 'Staff Register';
	include 'init.php';
  include $tmp."header.php";

  if(isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    $oldData = $_SESSION['oldData'];
    extract($oldData);
  }
?>

	<div class="section" id="register">
        <div class="container">
          <h2 class="special-heading">Staff Register</h2>
          <form action="<?php echo $cont."StaffController.php?method=register"?>" method="POST" class="form">
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
                <input type="text" name="username" id="username" placeholder="Enter Username" required
                  value="<?php if(isset($_SESSION['errors'])) echo $username?>">
              </div>
              <div>
                <input type="text" name="name" id="name" placeholder="Enter name" required
                value="<?php if(isset($_SESSION['errors'])) echo $name?>">
              </div>
              <div>
                <input type="text" name="position" id="position" placeholder="Enter position" required
                value="<?php if(isset($_SESSION['errors'])) echo $position?>">
              </div>
              <div>
                <input type="password" name="password" id="password" placeholder="Enter password">
              </div>
              <div>
                  <input type="password" name="confirm_password" id="confirm_password" placeholder="Enter Password again">
              </div>
              <div>
                <span>if have account <a href="<?php echo $cont.'StaffController.php?method=showLogin'?>">Make Login</a></span>
              </div>
              <div>
                <input type="submit" name="staff_register" value="Register">
              </div>
            </div>
          </form>
        </div>
    </div>
<?php
	include $tmp . 'footer.php'; 
  ob_end_flush();
  unset($_SESSION['oldData']);
  unset($_SESSION['errors']);

?>