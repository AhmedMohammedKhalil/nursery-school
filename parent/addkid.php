<?php
    ob_start();
    session_start();
    include('init.php');
    $pageTitle = "Add Kid";
    include($tmp.'header.php');
    if(isset($_SESSION['errors'])) {
      $errors = $_SESSION['errors'];
      $oldData = $_SESSION['oldData'];
      extract($oldData);
    }
?>

<div class="section" id="register">
        <div class="container">
          <h2 class="special-heading">Add Kids</h2>
          <form action="<?php echo $cont."ParentController.php?method=storeKid"?>" method="POST"  class="form">
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
                <label for="fname" > First Name</label>
                <input type="text" name="fname" id="fname" title="Enter fname" required
                value="<?php if(isset($_SESSION['errors'])){ echo $fname; } ?>">
              </div>
              <div>
                <label for="lname" >Last Name</label>
                <input type="text" name="lname" id="lname" title="Enter lname" required value="<?php if(isset($_SESSION['errors'])){ echo $lname; } ?>">
              </div>
              <div>
                <label for="vaccination">Vaccination Status</label>
                <select name="vaccination" id="vaccination" title="choose Status">
                  <option value="Yes" <?php if(isset($_SESSION['errors']) && $vaccination == 'Yes') {echo 'selected';}?>>Yes</option>
                  <option value="No" <?php if(isset($_SESSION['errors']) && $vaccination == 'No') {echo 'selected';}?>>No</option>
                </select>
              </div>
              <div>
                <label for="class" >Class</label>
                <input type="text" name="class" id="class" title="Enter class" required value="<?php if(isset($_SESSION['errors'])){ echo $class; }?>">
              </div>
              <div>
                <label for="birth_date" > Birthdate</label>
                <input type="text" name="birth_date" id="birth-date" title="Enter birth-date" required value="<?php if(isset($_SESSION['errors'])){ echo $birth_date; }?>">
              </div>
              <div>
                <label for="description" >Description</label>
                <textarea name="description" id="description" rows="6" title="Enter description" required><?php if(isset($_SESSION['errors'])){ echo $description; }?></textarea>
              </div>
              <div>
                <input name="add_kid" type="submit" value="Save Changes">
              </div>
            </div>
          </form>
        </div>
    </div>
<?php
    include($tmp.'footer.php');
    ob_end_flush();
    unset($_SESSION['errors']);
    unset($_SESSION['oldData']);