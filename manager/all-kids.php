<?php
    ob_start();
    session_start();
    include('init.php');
    $pageTitle = "All Kids";
    include($tmp.'header.php'); 
    if(isset($_SESSION['unaccepted-kids']) && isset($_SESSION['accepted-kids'])) {
        $unacceptedKids = $_SESSION['unaccepted-kids'];
        $acceptedKids = $_SESSION['accepted-kids']; 
    } else {
        header('location: dashboard.php');
    }
?>
        <div class="section" id="kids" style="min-height: 76.3vh;">
            <div class="container">
                <div style="min-height:76.3vh">
                    <h2 class="special-heading">Unaccepted Kids</h2>
                    <table id="table">
                        <tr>
                            <th>Kid Name</th>
                            <th>class</th>
                            <th>Parent Name</th>
                        </tr>
                        <?php foreach ($unacceptedKids as $k) {?>
                        <tr>
                            <td><a href="<?php echo $cont.'ManagerController.php?method=showKid&id='.$k['id'] ?>"><?php echo $k['fname'].' '.$k['lname'] ?></a></td>
                            <td><?php echo $k['class'] ?></td>
                            <td><a href="<?php echo $cont.'ManagerController.php?method=showParent&id='.$k['parent_id'] ?>"><?php echo $k['parent_name'] ?></a></td>
                        </tr>
                        <?php }
                        if(empty($unacceptedKids)){
                            echo "<tr><td colspan='4'>Not Found unaccepted kids</td></tr>";
                        }
                        ?>
                    </table>
                </div>
                <div style="min-height:76.3vh">
                    <h2 class="special-heading">Accepted Kids</h2>
                    <table id="table">
                        <tr>
                            <th>Kid Name</th>
                            <th>class</th>
                            <th>staff Name</th>
                            <th>Parent Name</th>

                        </tr>
                        <?php foreach ($acceptedKids as $k) {?>
                        <tr>
                            <td><a href="<?php echo $cont.'ManagerController.php?method=showKid&id='.$k['id'] ?>"><?php echo $k['fname'].' '.$k['lname'] ?></a></td>
                            <td><?php echo $k['class'] ?></td>
                            <td><a href="<?php echo $cont.'ManagerController.php?method=showStaff&id='.$k['staff_id'] ?>"><?php echo $k['staff_name'] ?></a></td>
                            <td><a href="<?php echo $cont.'ManagerController.php?method=showParent&id='.$k['parent_id'] ?>"><?php echo $k['parent_name'] ?></a></td>

                        </tr>
                        <?php }
                        if(empty($acceptedKids)){
                            echo "<tr><td colspan='4'>Not Found accepted kids</td></tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>


<?php
    include($tmp.'footer.php');
    ob_end_flush();
   // unset($_SESSION['kids']);