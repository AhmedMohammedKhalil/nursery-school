<?php
    ob_start();
    session_start();
    include('init.php');
    $pageTitle = "Kids Advisors";
    include($tmp.'header.php');
    $kids=$_SESSION['kids_advisors'];
    
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
          <h2 class="special-heading">Kids Advisors</h2>
          <table id="table">
            <tr>
                <th>Staff Name</th>
                <th>Kid Name</th>
                <th>class</th>
            </tr>
            <?php foreach ($kids as $k) {?>
            <tr>
                <td><a href="<?php echo $cont.'ParentController.php?method=showStaff&id='.$k['staff_id'] ?>"><?php echo $k['staff_name'] ?></a></td>
                <td><a href="<?php echo $cont.'ParentController.php?method=showKid&id='.$k['id'] ?>"><?php echo $k['fname'].' '.$k['lname'] ?></a></td>
                <td><?php echo $k['class'] ?></td>
              </td>
            </tr>
            <?php }
            if(empty($kids)){
              echo "<tr><td colspan='4'>Kids Not Found </td></tr>";
            }
            ?>
           
          </table>
        </div>
    </div>


<?php
    include($tmp.'footer.php');
    ob_end_flush();
   // unset($_SESSION['kids']);