<?php
	ob_start();
	session_start();
	$pageTitle = 'Add News';
	include 'init.php';
	include $tmp.'header.php';
	if(isset($_SESSION['errors'])) {
		$errors = $_SESSION['errors'];
		$oldData = $_SESSION['oldData'];
		extract($oldData);
	}
  
?>
	<div class="section" id="ADD_News" style="margin-bottom: 33px;">
      <div class="container">
        <h2 class="special-heading">Add News</h2>
        <form action="<?php echo $cont."NewsController.php?method=storeNew"?>" method="POST" class="form">
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
              <label for="title">Title</label>
              <input type="text" name="title" id="title" title="Enter title" required
                value="<?php if(isset($_SESSION['errors'])) echo $title?>">
            </div>
			      <div>
                <label for="content">Content</label>
                <textarea name="content" id="content" rows="6" title="Enter content" required><?php if(isset($_SESSION['errors'])) echo $content?></textarea>
            </div>
            <div>
              <input type="submit" name="add_new" value="Add">
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