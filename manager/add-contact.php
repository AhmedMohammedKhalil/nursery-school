<?php
	ob_start();
	session_start();
	$pageTitle = 'Add Contact';
	include 'init.php';
	include $tmp.'header.php';
	if(isset($_SESSION['errors'])) {
		$errors = $_SESSION['errors'];
		$oldData = $_SESSION['oldData'];
		extract($oldData);
	}
  
?>
	<div class="section" id="ADD_Contact" style="margin-bottom: 33px;">
      <div class="container">
        <h2 class="special-heading">Add Contact</h2>
        <form action="<?php echo $cont."ContactController.php?method=addContact"?>" method="POST" class="form">
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
              <label for="type">Type</label>
              <input type="text" name="type" id="type" title="Enter type" required
                value="<?php if(isset($_SESSION['errors'])) echo $type?>">
            </div>
			      <div>
              <label for="contact">Contact</label>
              <input type="text" name="contact" id="contact" title="Enter contact" required
                value="<?php if(isset($_SESSION['errors'])) echo $contact?>">
            </div>
            <div>
              <input type="submit" name="add_contact" value="Add">
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