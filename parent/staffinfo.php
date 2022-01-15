<?php
    ob_start();
    session_start();
    include('init.php');
    $pageTitle = "Staff Info";
    include($tmp.'header.php');
    $staff_info=$_SESSION['staff_info'];
?>


<div class="section" id="kids-info">
        <div class="container">
          <h2 class="special-heading">Staff Info</h2>
          <div class="kids-info flex">
            <div>
                <img style="width: 300px;height:300px;border-radius:50%" src="../assets/images/staff.jpg" alt="">
            </div>
            <h3><?php echo $staff_info['username'] ?></h3>
            <h3><?php echo $staff_info['name'] ?></h3>
            <h3><?php echo $staff_info['position'] ?></h3>
          </div>
        </div>
    </div>


<?php
    include($tmp.'footer.php');
    ob_end_flush();
    //unset($_SESSION['staff']);