<?php
    ob_start();
    session_start();
    include('init.php');
    $pageTitle = "Edit Kid";
    include($tmp.'header.php');
    $kid=$_SESSION['kid'];
    if(isset($_SESSION['errors'])) {
      $errors = $_SESSION['errors'];
      $oldData = $_SESSION['oldData'];
      extract($oldData);
    }
?>

<div class="section" id="register">
        <div class="container">
          <h2 class="special-heading">Edit Kids</h2>
          <form action="<?php echo $cont."ParentController.php?method=updateKid"?>" method="POST"  class="form">
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
            <input type="hidden" name="kid_id" value="<?php echo $_SESSION['kid']['id'];?>">
              <div>
                <label for="fname" > First Name</label>
                <input type="text" name="fname" id="fname" title="Enter fname" required
                value="<?php if(isset($_SESSION['errors'])){ echo $fname; } else { echo $_SESSION['kid']['fname'];}?>">
              </div>
              <div>
                <label for="lname" >Last Name</label>
                <input type="text" name="lname" id="lname" title="Enter lname" required value="<?php if(isset($_SESSION['errors'])){ echo $lname; } else { echo $_SESSION['kid']['lname'];}?>">
              </div>

              <div>
                <label for="vaccination">Vaccination Status</label>
                <select name="vaccination" id="vaccination" title="choose Status">
                  <option value="Yes" <?php if(isset($_SESSION['errors']) && $vaccination == 'Yes') {echo 'selected';}else{if($_SESSION['kid']['vaccination'] == 'Yes'){echo 'selected';}}?>>Yes</option>
                  <option value="No" <?php if(isset($_SESSION['errors']) && $vaccination == 'No') {echo 'selected';}else{if($_SESSION['kid']['vaccination'] == 'No'){echo 'selected';}}?>>No</option>
                </select>
              </div>

              <div>
                <label for="class" >Class</label>
                <input type="text" name="class" id="class" title="Enter class" required value="<?php if(isset($_SESSION['errors'])){ echo $class; } else { echo $_SESSION['kid']['class'];}?>">
              </div>
              <div>
                <label for="birth_date" > Birthdate</label>
                <input type="text" name="birth_date" id="birth-date" title="Enter birth-date" required value="<?php if(isset($_SESSION['errors'])){ echo $birth_date; } else { echo $_SESSION['kid']['birth_date'];}?>">
              </div>
              <div>
                <label for="description" >Description</label>
                <textarea name="description" id="description" rows="6" title="Enter description" required><?php if(isset($_SESSION['errors'])){ echo $description; } else { echo $_SESSION['kid']['description'];}?></textarea>
              </div>
              <div>
                <input name="update_kid" type="submit" value="Save Changes">
              </div>
            </div>
          </form>
        </div>
    </div>
<?php
    include($tmp.'footer.php');
    unset($_SESSION['errors']);
    unset($_SESSION['oldData']);
    ob_end_flush();