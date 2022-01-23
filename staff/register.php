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
                <label for="username">Username</label>
                <input type="text" name="username" id="username" title="Enter Username" required
                  value="<?php if(isset($_SESSION['errors'])) echo $username?>">
              </div>
              <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" title="Enter name" required
                value="<?php if(isset($_SESSION['errors'])) echo $name?>">
              </div>
              <div>
                <label for="position">Position</label>
                <input type="text" name="position" id="position" title="Enter position" required
                value="<?php if(isset($_SESSION['errors'])) echo $position?>">
              </div>
              <div>
                <label for="role">Role</label>
                <select name="role" id="role" title="choose Role">
                  <option value="staff" <?php if(isset($_SESSION['errors']) && $role == 'staff') echo 'selected'?>>Staff</option>
                  <option value="advisor" <?php if(isset($_SESSION['errors']) && $role == 'advisor') echo 'selected'?>>Advisor</option>
                </select>
                
              </div>
              <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" title="Enter Password" required>
              </div>
              <div>
                  <label for="confirm_password">Confirm Password</label>
                  <input type="password" name="confirm_password" id="confirm_password" title="Enter Password again" required>
              </div>
 
              <div>
                  <label class="label" for="captcha">Enter Words in Picture</label>
                  <div style="display: flex;margin-bottom:20px;justify-content:space-between">
                    <input class="input" type="text" name="captcha" id="captcha" required title="Enter Captcha" placeholder="Enter captcha"  style="flex:1 ;margin:0 10px 0 0">
                    <img src="<?php echo $func.'captcha.php'?>" alt="captcha image">
                  </div>
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