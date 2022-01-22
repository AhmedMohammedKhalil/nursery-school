<?php
ob_start();
session_start();
include('init.php');
$pageTitle = "Add Evaluation";
include($tmp . 'header.php');
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    $oldData = $_SESSION['oldData'];
    extract($oldData);
}
?>

<div class="section" id="register">
    <div class="container">
        <h2 class="special-heading">Add Evaluation</h2>
        <form action="<?php echo $cont . "ParentController.php?method=addEvaluate" ?>" method="POST" class="form">
            <div style="display: flex;justify-content:center;flex-direction:column">

                <div>
                    <label for="kid_id">Choose Advisor</label>
                    <select name="kid_id" id="kid_id" title="choose kid" required>
                        <?php 
                            $kids = $_SESSION['kids']; 
                            foreach($kids as $k) {
                                echo "<option value='{$k['id']}'>{$k['fname']} {$k['lname']}</option>";
                            }
                        ?>
                    </select>
                </div>


                <div style="margin: 30px 0;">
                    <label style="display:inline-block;margin-bottom: 10px;">Advisor’s  Response to Student queries(questions) :</label>
                    <div style="display: flex;">
                        <input type="radio" name="relation" id="re-ex" value="excellent" style="margin-bottom:0;"> <label for="re-ex">Excellent</label> 
                        <input type="radio" name="relation" id="re-ve" value="very" style="margin-bottom:0;"> <label for="re-ex">Very</label>
                        <input type="radio" name="relation" id="re-go" value="good" style="margin-bottom:0;"> <label for="re-go">Good</label>
                        <input type="radio" name="relation" id="re-no" value="not" style="margin-bottom:0;"> <label for="re-no">Not</label>
                    </div>
                    
                </div>
                <div style="margin: 30px 0;">
                    <label style="display:inline-block;margin-bottom: 10px;">Advisor’s Class preparation :</label>
                    <div style="display: flex;align-items:center">
                        <input type="radio" name="teaching" id="te-ex" value="excellent" style="margin-bottom:0;"> <label for="te-ex">Excellent</label>
                        <input type="radio" name="teaching" id="te-ve" value="very" style="margin-bottom:0;"> <label for="te-ex">Very</label>
                        <input type="radio" name="teaching" id="te-go" value="good" style="margin-bottom:0;"> <label for="te-go">Good</label>
                        <input type="radio" name="teaching" id="te-no" value="not" style="margin-bottom:0;"> <label for="te-no">Not</label>
                    </div>
                </div>
                <div style="margin: 30px 0;">
                    <label style="display:inline-block;margin-bottom: 10px;">General Class environment  :</label>
                    <div style="display: flex;align-items:center">
                        <input type="radio" name="teaching" id="te-ex" value="excellent" style="margin-bottom:0;"> <label for="te-ex">Excellent</label>
                        <input type="radio" name="teaching" id="te-ve" value="very" style="margin-bottom:0;"> <label for="te-ex">Very</label>
                        <input type="radio" name="teaching" id="te-go" value="good" style="margin-bottom:0;"> <label for="te-go">Good</label>
                        <input type="radio" name="teaching" id="te-no" value="not" style="margin-bottom:0;"> <label for="te-no">Not</label>
                    </div>
                </div>
                <div style="margin: 30px 0;">
                    <label style="display:inline-block;margin-bottom: 10px;">Advisor’s Professional Ethics :</label>
                    <div style="display: flex;align-items:center">
                        <input type="radio" name="teaching" id="te-ex" value="excellent" style="margin-bottom:0;"> <label for="te-ex">Excellent</label>
                        <input type="radio" name="teaching" id="te-ve" value="very" style="margin-bottom:0;"> <label for="te-ex">Very</label>
                        <input type="radio" name="teaching" id="te-go" value="good" style="margin-bottom:0;"> <label for="te-go">Good</label>
                        <input type="radio" name="teaching" id="te-no" value="not" style="margin-bottom:0;"> <label for="te-no">Not</label>
                    </div>
                </div>
                <div style="margin: 30px 0;">
                    <label style="display:inline-block;margin-bottom: 10px;">Advisor’s Realation with Child :</label>
                    <div style="display: flex;align-items:center">
                        <input type="radio" name="teaching" id="te-ex" value="excellent" style="margin-bottom:0;"> <label for="te-ex">Excellent</label>
                        <input type="radio" name="teaching" id="te-ve" value="very" style="margin-bottom:0;"> <label for="te-ex">Very</label>
                        <input type="radio" name="teaching" id="te-go" value="good" style="margin-bottom:0;"> <label for="te-go">Good</label>
                        <input type="radio" name="teaching" id="te-no" value="not" style="margin-bottom:0;"> <label for="te-no">Not</label>
                    </div>
                </div>
                <div style="margin: 30px 0;">
                    <label style="display:inline-block;margin-bottom: 10px;">Advisor’s Speaking Style & Body lang :</label>
                    <div style="display: flex;align-items:center">
                        <input type="radio" name="teaching" id="te-ex" value="excellent" style="margin-bottom:0;"> <label for="te-ex">Excellent</label>
                        <input type="radio" name="teaching" id="te-ve" value="very" style="margin-bottom:0;"> <label for="te-ex">Very</label>
                        <input type="radio" name="teaching" id="te-go" value="good" style="margin-bottom:0;"> <label for="te-go">Good</label>
                        <input type="radio" name="teaching" id="te-no" value="not" style="margin-bottom:0;"> <label for="te-no">Not</label>
                    </div>
                </div>
                <div>
                    <input type="submit" value="Add Evaluate">
                </div>
            </div>
            </div>
        </form>
    </div>
</div>
<?php
include($tmp . 'footer.php');
ob_end_flush();
unset($_SESSION['errors']);
unset($_SESSION['oldData']);
