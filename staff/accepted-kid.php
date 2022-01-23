<?php
	ob_start();
  session_start();
	$pageTitle = 'Accepte Kids';
	include 'init.php';
  include $tmp."header.php";
?>

	<div class="section" id="accept-kid" style="min-height: 76.3vh;">
        <div class="container">
          <h2 class="special-heading">Accept Kid</h2>
          <form action="<?php echo $cont."StaffController.php?method=acceptedKid"?>" method="POST" class="form">
            <div style="display: flex;justify-content:center;flex-direction:column">
                <input type="hidden" name='id' value="<?php echo $_SESSION['kid_id']?>">
                <div>
                    <label for="advisor">choose advisor</label>
                    <select name="advisor" id="advisor" title="choose advisor" aria-placeholder="choose advisor" required>
                        <?php 
                            $advisors = $_SESSION['advisors']; 
                            foreach($advisors as $advisor) {
                                echo "<option value='{$advisor['id']}'>{$advisor['name']}</option>";
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <input type="submit" name="accepted_kid" value="Accept">
                </div>
            </div>
          </form>
        </div>
    </div>
<?php
	include $tmp . 'footer.php'; 
  ob_end_flush();

?>