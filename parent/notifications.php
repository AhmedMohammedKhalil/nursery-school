<?php
	ob_start();
  session_start();
	$pageTitle = 'Parent Notifications';
	include 'init.php';
  include $tmp."header.php";
  $notifications = $_SESSION['notifications'];
?>
<div class="section" id="notification" style="min-height: 76.3vh;">
        <div class="container">
            <h2 class="special-heading">Notifications</h2>
            <?php if(!empty($notifications)) { ?>
            <div class="flex">
                <?php foreach($notifications as $n) {?>
                    <div class="notify">
                        <div class="image">
                            <img src="<?php echo $imgs.'hash.jpg'?>" alt="notification photo">
                        </div>
                        <?php if(preg_match("/Accepted/i",$n['message'])) { ?>
                            <div class="text">
                                <h3>Kids Accepted</h3>
                                <p>
                                    <?php echo $n['message']?>
                                </p>
                                <div>
                                    <a class="button" href="<?php echo $cont.'ParentController.php?method=showKid&id='.$n['kid_id'] ?>">kid info</a>
                                    <a class="button" href="<?php echo $cont.'ParentController.php?method=showStaff&id='.$n['staff_id'] ?>">Advisor info</a>
                                </div>
                            </div>
                        <?php } else {?>
                            <div class="text">
                                <h3>Payment Remainder</h3>
                                <p>
                                    <?php echo $n['message']?>
                                </p>
                                <div>
                                    <a class="button" href="<?php echo $cont.'StaffController.php?method=showKid&id='.$n['kid_id'] ?>">kid info</a>
                                    <a class="button" href="<?php echo $cont.'StaffController.php?method=addpayment&id='.$n['kid_id'] ?>">Add Payment</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php }?>
            </div>
            <?php } else { ?>
                <h3 style="text-align: center;">Not Found Notifications</h2>
            <?php }?>
        </div>
    </div>
<?php
	include $tmp . 'footer.php'; 
  ob_end_flush();

?>