<?php
	ob_start();
	session_start();
	$pageTitle = 'Edit News';
	include 'init.php';
	include $tmp.'header.php';
	if(isset($_SESSION['errors'])) {
		$errors = $_SESSION['errors'];
		$oldData = $_SESSION['oldData'];
		extract($oldData);
	}
  
?>
	<div class="section" id="edit_News" style="margin-bottom: 33px;">
      <div class="container">
        <h2 class="special-heading">Edit News</h2>
        <form action="<?php echo $cont."NewsController.php?method=updateNew&id=".$_SESSION['new']['id']?>" method="POST" class="form">
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

              <input type="text" name="title" id="title" title="Enter title" placeholder="Enter title" required
                value="<?php if(isset($_SESSION['errors'])) {echo $title;}else {echo $_SESSION['new']['title'];}?>">
            </div>
			      <div>
                <label for="content">Content</label>
                <textarea name="content" id="content" rows="6" title="Enter content" placeholder="Enter content" required><?php if(isset($_SESSION['errors'])) {echo $content;}else {echo $_SESSION['new']['content'];}?></textarea>
            </div>
            <div>
              <input type="submit" name="update_new" value="Edit">
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