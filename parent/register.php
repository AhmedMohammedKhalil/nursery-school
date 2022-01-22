<?php
  ob_start();
  session_start();
	$pageTitle = 'Parent Register';
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
          <h2 class="special-heading">Parent Register</h2>
          <form action="<?php echo $cont."ParentController.php?method=register"?>" method="POST" class="form">
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
                <label class="label" for="username">User Name</label>
                <input type="text" title="Enter Username" name="username" id="username" placeholder="Enter Username" required
                  value="<?php if(isset($_SESSION['errors'])) echo $username?>">
              </div>
              <div>
                <label class="label" for="name">Name</label>
                <input type="text" title="Enter name" name="name" id="name" placeholder="Enter name" required
                value="<?php if(isset($_SESSION['errors'])) echo $name?>">
              </div>
              <div>
                <label class="label" for="ssn">Civil Id</label>
                <input type="text" name="ssn" title="Enter CID" id="ssn" maxlength="12" placeholder="Enter CID" required
                  value="<?php if(isset($_SESSION['errors'])) echo $ssn?>">
              </div>
              <div>
                <label class="label" for="phone">Phone</label>
                <input type="text" title="Enter phone" name="phone" id="phone" placeholder="Enter phone" required
                  value="<?php if(isset($_SESSION['errors'])) echo $phone?>" pattern="[0-9]{8}" maxlength="8">
              </div>
              <div>
                <label class="label" for="password">Password</label>
                <input type="password" name="password" title="Enter password" id="password" placeholder="Enter password" required>
              </div>
              <div>
                  <label class="label"  for="confirm_password">Confirm Password</label>
                  <input type="password" title="Enter Password again" name="confirm_password" id="confirm_password" placeholder="Enter Password again" required>
              </div>
              <div>
                <label class="label" for="address">Address</label>
                <textarea name="address" title="Enter address" id="address" rows="6" placeholder="Enter address" required><?php if(isset($_SESSION['errors'])) echo $address?></textarea>
              </div>
              <div>
                  <label class="label" for="captcha">Enter Words in Picture</label>
                  <div style="display: flex;margin-bottom:20px;justify-content:space-between">
                    <input class="input" type="text" name="captcha" id="captcha" required title="Enter Captcha" placeholder="Enter captcha"  style="flex:1 ;margin:0 10px 0 0">
                    <img src="<?php echo $func.'captcha.php'?>" alt="captcha image">
                  </div>
                  <?php if(isset($_GET['error'])&& isset($captcha_error) && !empty($captcha_error))
                  {
                      echo "<span style='color:red'>{$captcha_error}</span>";
                  } 
                  ?>
              </div>

              <div>
                <span>if have account <a href="<?php echo $cont.'ParentController.php?method=showLogin'?>">Make Login</a></span>
              </div>
              <div>
                <input type="submit" name="parent_register" value="Register">
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