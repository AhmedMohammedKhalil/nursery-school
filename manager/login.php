<?php
	ob_start();
	session_start();
	$pageTitle = 'Manager login';
	include 'init.php';
	include $tmp.'header.php';
  if(isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    $oldData = $_SESSION['oldData'];
    extract($oldData);
  }
?>
	<div class="section" id="login" style="margin-bottom: 33px;">
      <div class="container">
        <h2 class="special-heading">Manager Login</h2>
        <form action="<?php echo $cont."ManagerController.php?method=login"?>" method="POST" class="form">
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
                <label for="password">Password</label>
                <input type="password" name="password" id="password" title="Enter Password">
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
              <input type="submit" name="manager_login" value="Login">
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