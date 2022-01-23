<?php
	ob_start();
session_start();
	$pageTitle = 'Add Kid payment';
	include 'init.php';
include $tmp."header.php";
if(isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    $oldData = $_SESSION['oldData'];
    extract($oldData);
}

$kids=$_SESSION['kids'];
?>
<?php if(isset($_SESSION['msg'])) { ?>
        <p style="color:black;background:#8bfa8b;padding:20px;margin:0">
            <?php 
                echo $_SESSION['msg'] ;
                unset($_SESSION['msg']);
            ?>
        </p>
<?php } ?>
	<div class="section" id="accept-kid" style="min-height: 76.3vh;">
        <div class="container">
          <h2 class="special-heading">Add Kid Payment</h2>
          <?php
            if(isset($_SESSION['errors'])) {
              echo '<ol style="width:fit-content;margin: 0 auto">';
              foreach($errors as $e) {
                echo '<li style="color: red">'.$e.'</li>';
              }
              echo '</ol>';
            }
          ?>
          <form action="<?php echo $cont."ParentController.php?method=storePayment"?>" method="POST" class="form">
            <div style="display: flex;justify-content:center;flex-direction:column">  

                <div>
                    <label for="kid_id">choose kid</label>
                    <select name="kid_id" id="kid_id" title="choose kid" required>
                        <?php 
                            $kids = $_SESSION['kids']; 
                            foreach($kids as $k) {
                                echo "<option value='{$k['id']}'>{$k['fname']} {$k['lname']}</option>";
                            }
                        ?>
                    </select>
                </div>
            
                <div>
                    <label class="label" for="description">Description</label>
                    <textarea name="description" title="Enter description" id="description" rows="6" placeholder="Enter address" required><?php if(isset($_SESSION['errors'])) echo $description?></textarea>
                </div>

                <div>
                    <label class="label" for="amount">Amount</label>
                    <input type="text" title="Enter Amount" name="amount" id="amount" placeholder="Enter Amount" required value="<?php if(isset($_SESSION['errors'])) echo $amount ?>" maxlength="10">
                </div>
                <div>
                    <input type="submit" name="store_payment" value="Accept">
                </div>
            </div>
          </form>
        </div>
    </div>
<?php
	include $tmp . 'footer.php'; 
  ob_end_flush();
  unset($_SESSION['errors']);
  unset($_SESSION['oldData']);
?>