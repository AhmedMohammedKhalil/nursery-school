<?php
	ob_start();
	session_start();
	$pageTitle = 'Settings';
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
        <h2 class="special-heading">Settings</h2>
        <form action="<?php echo $cont."StaffController.php?method=editProfile"?>" method="POST" class="form">
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
                value="<?php if(isset($_SESSION['errors'])){ echo $username; } else { echo $_SESSION['staff']['username'];}?>">
            </div>
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" title="Enter name" required
                value="<?php if(isset($_SESSION['errors'])) { echo $name ;} else { echo $_SESSION['staff']['name'];}?>">
            </div>
            <div>
                <label for="position">Position</label>
                <input type="text" name="position" id="position" title="Enter position" required
                value="<?php if(isset($_SESSION['errors'])) { echo $position ; } else { echo $_SESSION['staff']['position'];}?>">
            </div>
            <div>
                <input type="submit" name="edit_profile" value="Save Changes">
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