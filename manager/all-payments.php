<?php
    ob_start();
    session_start();
    include('init.php');
    $pageTitle = "All Payments";
    include($tmp.'header.php'); 
    if(isset($_SESSION['payments'])) {
        $allpayments = $_SESSION['payments']; 
    } else {
        header('location: dashboard.php');
    }
?>
        <div class="section" id="kids" style="min-height: 76.3vh;">
            <div class="container">
                <div>
                    <h2 class="special-heading">All Payments</h2>
                    <table id="table">
                        <tr>
                            <th>Kid Name</th>
                            <th>class</th>
                            <th>amount</th>
                            <th>description</th>
                            <th>created_at</th>
                        </tr>
                        <?php foreach ($allpayments as $p) {?>
                        <tr>
                            <td><a href="<?php echo $cont.'ManagerController.php?method=showKid&id='.$p['k_id'] ?>"><?php echo $p['fname'].' '.$p['lname'] ?></a></td>
                            <td><?php echo $p['class'] ?></td>
                            <td><?php echo $p['amount'] ?></td>
                            <td><?php echo $p['description'] ?></td>
                            <td><?php echo $p['created_at'] ?></td>

                        </tr>
                        <?php }
                        if(empty($unacceptedKids)){
                            echo "<tr><td colspan='5'>Not Found Payments</td></tr>";
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