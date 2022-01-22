<?php
	ob_start();
    session_start();
	$pageTitle = 'All payments';
	include 'init.php';
    include $tmp.'header.php';
    $payments=$_SESSION['allpayments'];
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
<div style="text-align: center;">
          <a class="button" href="<?php echo $cont.'ParentController.php?method=addPaymentToAllKids'?>">Add Kids Payments</a>
        </div>
        <div class="container">
          <h2 class="special-heading">All Payments</h2>
          <table id="table" style="margin-top: 20px;">
            <tr>
              <th>Kid Name</th>
              <th>amount</th>
              <th>created_at</th>
            </tr>
            <?php foreach ($payments as $p) {?>
            <tr>
              <td><a href="<?php echo $cont.'ParentController.php?method=showKid&id='.$p['k_id'] ?>"><?php echo $p['fname'].$p['lname']?></a></td>
              <td><?php echo $p['amount']?></a></td>
              <td><?php echo $p['created_at']?></td>

            </tr>
            <?php }
            if(empty($payments)){
              echo "<tr><td colspan='4'>Payments Not Found </td></tr>";
            }
            ?>
           
          </table>
        </div>
    </div


<?php
	include $tmp . 'footer.php'; 
	ob_end_flush();
  
?>