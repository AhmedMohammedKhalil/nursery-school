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
        <form action="<?php echo $cont."ParentController.php?method=editProfile"?>" method="POST" class="form">
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
                <input type="text" name="username"  title="Enter Username"  id="username" placeholder="Enter Username" required
                value="<?php if(isset($_SESSION['errors'])){ echo $username; } else { echo $_SESSION['parent']['username'];}?>">
            </div>
            <div>
                <label class="label" for="name">Name</label>
                <input type="text" name="name" title="Enter name"  id="name" placeholder="Enter name" required
                value="<?php if(isset($_SESSION['errors'])) { echo $name ;} else { echo $_SESSION['parent']['name'];}?>">
            </div>
            <div class="civil_id">
                <label class="label" for="civil_id">Civil Id</label>
                <input type="text" name="ssn" title="Enter CID" id="civil_id" placeholder="Enter Civil ID" required pattern="[0-9]{12}" maxlength="12"
                value="<?php if(isset($_SESSION['errors'])) { echo $ssn ; } else { echo $_SESSION['parent']['ssn'];}?>">
                <span><img src="<?php echo $imgs.'CID.png'?>"/><br/>
                  Civil ID NO
                </span>
            </div>
            <div>
                <label class="label" for="phone">Phone</label>
                <input type="text" name="phone" id="phone" title="Enter phone"  placeholder="Enter phone" required pattern="[0-9]{8}" maxlength="8"
                value="<?php if(isset($_SESSION['errors'])) { echo $phone ; } else { echo $_SESSION['parent']['phone'];}?>">
            </div>
            <div>
              <label class="label" for="address">Address</label>
                <textarea name="address" id="address" title="Enter address" rows="6" placeholder="Enter address" required><?php if(isset($_SESSION['errors'])) { echo $address ; } else { echo $_SESSION['parent']['address'];}?></textarea>
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