<?php
    ob_start();
    session_start();
    include('init.php');
    $pageTitle = "All Staff";
    include($tmp.'header.php'); 
    if(isset($_SESSION['allStaff']) && isset($_SESSION['allAdvisor'])) {
        $allStaff = $_SESSION['allStaff'];
        $allAdvisor = $_SESSION['allAdvisor']; 
    } else {
        header('location: dashboard.php');
    }
?>
    <?php if(isset($_SESSION['msg'])) { ?>
        <p style="color:black;background:#8bfa8b;padding:20px;margin:0">
            <?php 
                echo $_SESSION['msg'] ;
                unset($_SESSION['msg']);
            ?>
        </p>
    <?php } ?>
        <div class="section" id="kids" style="min-height: 76.3vh;">
            <div class="container">
                <div style="min-height:76.3vh">
                    <h2 class="special-heading">All Advisor</h2>
                    <?php if(count($allAdvisor) > 1) { ?>
                        <div class="section" id="sorting" style="padding:0">
                            <div class="container">
                                <form action="<?php echo $cont.'ManagerController.php?method=sortAdvisor' ?>" class="form" method="POST">
                                    <div>
                                        <div>
                                            <label for="advisor-sort">Choose your Sorting : </label>
                                            <select name="advisor-sort" id="advisor-sort">
                                                <option value="1" <?php if(isset($_SESSION['sortadvisor']) && $_SESSION['sortadvisor']  == '1'){echo 'selected';}?>>ASC</option>
                                                <option value="2" <?php if(isset($_SESSION['sortadvisor']) && $_SESSION['sortadvisor'] == '2'){echo 'selected';}?>>DESC</option>
                                            </select>
                                        </div>
                                        <div>
                                            <input type="submit" name="sortAdvisor" value="Sort">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                    <table id="table">
                        <tr>
                            <th>Advisor Name</th>
                            <th>Position</th>
                            <th>Evaluation Result</th>
                            <th>Control</th>
                        </tr>
                        
                        <?php foreach ($allAdvisor as $advisor) {?>
                        <tr>
                            <td><a href="<?php echo $cont.'ManagerController.php?method=showStaff&id='.$advisor['id'] ?>"><?php echo $advisor['name'] ?></a></td>
                            <td><?php echo $advisor['position'] ?></td>
                            <td><?php if($advisor['review'] != null) {echo $advisor['review'];} else {echo "not evaluated";} ?></td>
                            <td><a href="<?php echo $cont.'ManagerController.php?method=delStaff&id='.$advisor['id'] ?>">delete</a></td>
                        </tr>
                        <?php }
                        if(empty($allAdvisor)){
                            echo "<tr><td colspan='4'>Not Found Advisors</td></tr>";
                        }
                        ?>
                    </table>
                </div>
                <div style="min-height:76.3vh">
                    <h2 class="special-heading">All Staff</h2>
                    <?php if(count($allStaff) > 1) { ?>
                        <div class="section" id="sorting" style="padding:0">
                            <div class="container">
                                <form action="<?php echo $cont.'ManagerController.php?method=sortStaff' ?>" class="form" method="POST">
                                    <div>
                                        <div>
                                            <label for="staff-sort">Choose your Sorting : </label>
                                            <select name="staff-sort" id="staff-sort">
                                                <option value="1" <?php if(isset($_SESSION['sortstaff']) && $_SESSION['sortstaff'] == '1'){echo 'selected';}?>>ASC</option>
                                                <option value="2" <?php if(isset($_SESSION['sortstaff']) && $_SESSION['sortstaff'] == '2'){echo 'selected';}?>>DESC</option>
                                            </select>
                                        </div>
                                        <div>
                                            <input type="submit" name="sortStaff"  value="Sort">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php } ?>

                    <table id="table">
                        <tr>
                            <th>Staff Name</th>
                            <th>Position</th>
                            <th>Control</th>
                        </tr>
                        <?php foreach ($allStaff as $staff) {?>
                        <tr>
                            <td><a href="<?php echo $cont.'ManagerController.php?method=showStaff&id='.$staff['id'] ?>"><?php echo $staff['name'] ?></a></td>
                            <td><?php echo $staff['position'] ?></td>
                            <td><a href="<?php echo $cont.'ManagerController.php?method=delStaff&id='.$staff['id'] ?>">delete</a></td>
                        </tr>
                        <?php }
                        if(empty($allStaff)){
                            echo "<tr><td colspan='3'>Not Found Staff</td></tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>


<?php
    include($tmp.'footer.php');
    ob_end_flush();
