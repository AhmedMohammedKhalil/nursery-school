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
$advisors=$_SESSION['advisors'];
?>

<div class="section" id="register">
    <div class="container">
        <h2 class="special-heading">Add Evaluation</h2>
        <form action="<?php echo $cont . "ParentController.php?method=storeEvaluation" ?>" method="POST" class="form">
            <div style="display: flex;justify-content:center;flex-direction:column">

                <div>
                    <label for="kid_id">Choose Advisor</label>
                    <select name="advisor_id" id="advisor_id" title="choose advisor" required>
                        <?php 
                            foreach($advisors as $adv) {
                                echo "<option value='{$adv['id']}'>{$adv['name']}</option>";
                            }
                        ?>
                    </select>
                </div>


                <div style="margin: 30px 0;">
                    <label style="display:inline-block;margin-bottom: 10px;">Advisor’s  Response to Student queries(questions) :</label>
                    <div style="display: flex;align-items:center">
                        <input type="radio" name="ev-1" id="re-ex" value="4" style="margin-bottom:0;" checked> <label for="re-ex">Excellent</label> 
                        <input type="radio" name="ev-1" id="re-ve" value="3" style="margin-bottom:0;"> <label for="re-ex">Very</label>
                        <input type="radio" name="ev-1" id="re-go" value="2" style="margin-bottom:0;"> <label for="re-go">Good</label>
                        <input type="radio" name="ev-1" id="re-no" value="1" style="margin-bottom:0;"> <label for="re-no">Not</label>
                    </div>
                    
                </div>
                <div style="margin: 30px 0;">
                    <label style="display:inline-block;margin-bottom: 10px;">Advisor’s Class preparation :</label>
                    <div style="display: flex;align-items:center">
                        <input type="radio" name="ev-2" id="te-ex" value="4" style="margin-bottom:0;" checked> <label for="te-ex">Excellent</label>
                        <input type="radio" name="ev-2" id="te-ve" value="3" style="margin-bottom:0;"> <label for="te-ex">Very</label>
                        <input type="radio" name="ev-2" id="te-go" value="2" style="margin-bottom:0;"> <label for="te-go">Good</label>
                        <input type="radio" name="ev-2" id="te-no" value="1" style="margin-bottom:0;"> <label for="te-no">Not</label>
                    </div>
                </div>
                <div style="margin: 30px 0;">
                    <label style="display:inline-block;margin-bottom: 10px;">General Class environment  :</label>
                    <div style="display: flex;align-items:center">
                        <input type="radio" name="ev-3" id="te-ex" value="4" style="margin-bottom:0;" checked> <label for="te-ex">Excellent</label>
                        <input type="radio" name="ev-3" id="te-ve" value="3" style="margin-bottom:0;"> <label for="te-ex">Very</label>
                        <input type="radio" name="ev-3" id="te-go" value="2" style="margin-bottom:0;"> <label for="te-go">Good</label>
                        <input type="radio" name="ev-3" id="te-no" value="1" style="margin-bottom:0;"> <label for="te-no">Not</label>
                    </div>
                </div>
                <div style="margin: 30px 0;">
                    <label style="display:inline-block;margin-bottom: 10px;">Advisor’s Professional Ethics :</label>
                    <div style="display: flex;align-items:center">
                        <input type="radio" name="ev-4" id="te-ex" value="4" style="margin-bottom:0;" checked> <label for="te-ex">Excellent</label>
                        <input type="radio" name="ev-4" id="te-ve" value="3" style="margin-bottom:0;"> <label for="te-ex">Very</label>
                        <input type="radio" name="ev-4" id="te-go" value="2" style="margin-bottom:0;"> <label for="te-go">Good</label>
                        <input type="radio" name="ev-4" id="te-no" value="1" style="margin-bottom:0;"> <label for="te-no">Not</label>
                    </div>
                </div>
                <div style="margin: 30px 0;">
                    <label style="display:inline-block;margin-bottom: 10px;">Advisor’s Realation with Child :</label>
                    <div style="display: flex;align-items:center">
                        <input type="radio" name="ev-5" id="te-ex" value="4" style="margin-bottom:0;" checked> <label for="te-ex">Excellent</label>
                        <input type="radio" name="ev-5" id="te-ve" value="3" style="margin-bottom:0;"> <label for="te-ex">Very</label>
                        <input type="radio" name="ev-5" id="te-go" value="2" style="margin-bottom:0;"> <label for="te-go">Good</label>
                        <input type="radio" name="ev-5" id="te-no" value="1" style="margin-bottom:0;"> <label for="te-no">Not</label>
                    </div>
                </div>
                <div style="margin: 30px 0;">
                    <label style="display:inline-block;margin-bottom: 10px;">Advisor’s Speaking Style & Body lang :</label>
                    <div style="display: flex;align-items:center">
                        <input type="radio" name="ev-6" id="te-ex" value="4" style="margin-bottom:0;" checked> <label for="te-ex">Excellent</label>
                        <input type="radio" name="ev-6" id="te-ve" value="3" style="margin-bottom:0;"> <label for="te-ex">Very</label>
                        <input type="radio" name="ev-6" id="te-go" value="2" style="margin-bottom:0;"> <label for="te-go">Good</label>
                        <input type="radio" name="ev-6" id="te-no" value="1" style="margin-bottom:0;"> <label for="te-no">Not</label>
                    </div>
                </div>
                <div>
                    <input type="submit" value="Evaluate" name="Evaluate">
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

