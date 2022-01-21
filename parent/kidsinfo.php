<?php
    ob_start();
    session_start();
    include('init.php');
    $pageTitle = "Kid Info";
    include($tmp.'header.php');
    $kid=$_SESSION['kid'];
?>


<div class="section" id="kids-info">
        <div class="container">
          <h2 class="special-heading">Kids Info</h2>
          <div class="kids-info flex">
            <div>
                <img style="width: 300px;height:300px;border-radius:50%" src="<?php echo $imgs.'kids.jpg' ?>" alt="kids photo">
            </div>
            <h3><?php echo $kid['fname'].' '.$kid['lname'] ?></h3>
            <h3><?php echo $kid['class'] ?></h3>
            <h3><?php echo $kid['vaccination'] ?></h3>
            <h3><?php echo $kid['birth_date'] ?></h3>
            <h3><?php echo $kid['status'] ?></h3>
            <p><?php echo nl2br($kid['description']) ?></p>
          </div>
        </div>
    </div>


<?php
    include($tmp.'footer.php');
    ob_end_flush();
  //  unset($_SESSION['kid']);