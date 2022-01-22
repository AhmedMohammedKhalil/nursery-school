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
$advisors=$_SESSION['getadvisors'];
?>

<div class="section" id="register">
    <div class="container">
        <h2 class="special-heading">Add Evaluation</h2>
        <form action="<?php echo $cont . "ManagerController.php?method=addEvaluate" ?>" method="POST" class="form">
            <div style="display: flex;justify-content:center;flex-direction:column">

                <div>
                    <label for="advisor_id">Choose Advisor</label>
                    <select name="advisor_id" id="advisor_id" title="choose Advisor" required>
                        <?php 
                            foreach($advisors as $adv) {
                                echo "<option value='{$adv['id']}'>{$adv['name']}</option>";
                            }
                        ?>
                    </select>
                </div>


                <div style="margin: 30px 0;">
                    <label style="display:inline-block;margin-bottom: 10px;">Advisor’s Speaking Style & Body lang :</label>
                    <div style="display: flex;align-items:center">
                        <input type="radio" name="ev-1" id="1-ex" value="4" style="margin-bottom:0;" checked> <label for="1-ex">Excellent</label> 
                        <input type="radio" name="ev-1" id="1-ve" value="3" style="margin-bottom:0;"> <label for="1-ve">Very</label>
                        <input type="radio" name="ev-1" id="1-go" value="2" style="margin-bottom:0;"> <label for="1-go">Good</label>
                        <input type="radio" name="ev-1" id="1-no" value="1" style="margin-bottom:0;"> <label for="1-no">Not</label>
                    </div>
                    
                </div>
                <div style="margin: 30px 0;">
                    <label style="display:inline-block;margin-bottom: 10px;">Advisor’s General Knowledge:</label>
                    <div style="display: flex;align-items:center">
                        <input type="radio" name="ev-2" id="2-ex" value="4" style="margin-bottom:0;" checked> <label for="2-ex">Excellent</label>
                        <input type="radio" name="ev-2" id="2-ve" value="3" style="margin-bottom:0;"> <label for="2-ve">Very</label>
                        <input type="radio" name="ev-2" id="2-go" value="2" style="margin-bottom:0;"> <label for="2-go">Good</label>
                        <input type="radio" name="ev-2" id="2-no" value="1" style="margin-bottom:0;"> <label for="2-no">Not</label>
                    </div>
                </div>
                <div style="margin: 30px 0;">
                    <label style="display:inline-block;margin-bottom: 10px;">Advisor’s Teaching Ability  :</label>
                    <div style="display: flex;align-items:center">
                        <input type="radio" name="ev-3" id="3-ex" value="4" style="margin-bottom:0;" checked> <label for="3-ex">Excellent</label>
                        <input type="radio" name="ev-3" id="3-ve" value="3" style="margin-bottom:0;"> <label for="3-ve">Very</label>
                        <input type="radio" name="ev-3" id="3-go" value="2" style="margin-bottom:0;"> <label for="3-go">Good</label>
                        <input type="radio" name="ev-3" id="3-no" value="1" style="margin-bottom:0;"> <label for="3-no">Not</label>
                    </div>
                </div>
                <div style="margin: 30px 0;">
                    <label style="display:inline-block;margin-bottom: 10px;">Advisor’s extra Responsibility :</label>
                    <div style="display: flex;align-items:center">
                        <input type="radio" name="ev-4" id="4-ex" value="4" style="margin-bottom:0;" checked> <label for="4-ex">Excellent</label>
                        <input type="radio" name="ev-4" id="4-ve" value="3" style="margin-bottom:0;"> <label for="4-ve">Very</label>
                        <input type="radio" name="ev-4" id="4-go" value="2" style="margin-bottom:0;"> <label for="4-go">Good</label>
                        <input type="radio" name="ev-4" id="4-no" value="1" style="margin-bottom:0;"> <label for="4-no">Not</label>
                    </div>
                </div>
                <div style="margin: 30px 0;">
                    <label style="display:inline-block;margin-bottom: 10px;">Advisor’s  Punctuality/ attendants :</label>
                    <div style="display: flex;align-items:center">
                        <input type="radio" name="ev-5" id="5-ex" value="4" style="margin-bottom:0;" checked> <label for="5-ex">Excellent</label>
                        <input type="radio" name="ev-5" id="5-ve" value="3" style="margin-bottom:0;"> <label for="5-ve">Very</label>
                        <input type="radio" name="ev-5" id="5-go" value="2" style="margin-bottom:0;"> <label for="5-go">Good</label>
                        <input type="radio" name="ev-5" id="5-no" value="1" style="margin-bottom:0;"> <label for="5-no">Not</label>
                    </div>
                </div>
                <div style="margin: 30px 0;">
                    <label style="display:inline-block;margin-bottom: 10px;">Advisor’s  Co operation with colleagues   :</label>
                    <div style="display: flex;align-items:center">
                        <input type="radio" name="ev-6" id="6-ex" value="4" style="margin-bottom:0;" checked> <label for="6-ex">Excellent</label>
                        <input type="radio" name="ev-6" id="6-ve" value="3" style="margin-bottom:0;"> <label for="6-ve">Very</label>
                        <input type="radio" name="ev-6" id="6-go" value="2" style="margin-bottom:0;"> <label for="6-go">Good</label>
                        <input type="radio" name="ev-6" id="6-no" value="1" style="margin-bottom:0;"> <label for="6-no">Not</label>
                    </div>
                </div>

                <div style="margin: 30px 0;">
                    <label style="display:inline-block;margin-bottom: 10px;">Advisor’s  Proficiency in teaching   :</label>
                    <div style="display: flex;align-items:center">
                        <input type="radio" name="ev-7" id="7-ex" value="4" style="margin-bottom:0;" checked> <label for="7-ex">Excellent</label>
                        <input type="radio" name="ev-7" id="7-ve" value="3" style="margin-bottom:0;"> <label for="7-ve">Very</label>
                        <input type="radio" name="ev-7" id="7-go" value="2" style="margin-bottom:0;"> <label for="7-go">Good</label>
                        <input type="radio" name="ev-7" id="7-no" value="1" style="margin-bottom:0;"> <label for="7-no">Not</label>
                    </div>
                </div>

                <div>
                    <input type="submit" name="manager-evaluation" value="Add Evaluate">
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
