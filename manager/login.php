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
              <input type="text" name="username" id="username" placeholder="Enter Username" required
                value="<?php if(isset($_SESSION['errors'])) echo $username?>">
            </div>
            <div>
                <input type="password" name="password" id="password" placeholder="Enter Password">
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