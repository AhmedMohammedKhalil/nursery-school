<?php
    ob_start();
    session_start();
    include('init.php');
    $pageTitle = "Kids Advisors";
    include($tmp.'header.php');
    $kids=$_SESSION['kids_advisors'];
    
?>
<div class="section" id="kids" style="min-height: 76.3vh;">
        <div class="container">
          <h2 class="special-heading">Kids Advisors</h2>
          <table id="table">
            <tr>
                <th>Staff Name</th>
                <th>Kid Name</th>
                <th>class</th>
                <th>Control</th>
            </tr>
            <?php foreach ($kids as $k) {?>
            <tr>
                <td><a href="<?php echo $cont.'ParentController.php?method=showStaff&id='.$k['staff_id'] ?>"><?php echo $k['staff_name'] ?></a></td>
                <td><a href="<?php echo $cont.'ParentController.php?method=showKid&id='.$k['id'] ?>"><?php echo $k['fname'].' '.$k['lname'] ?></a></td>
                <td><?php echo $k['class'] ?></td>
                <td>
                <div class="flex" style="flex-direction: row;margin: 0;justify-content:space-evenly">
                  <a href="<?php echo $cont.'ParentController.php?method=payForKid&id='.$k['id'] ?>">Make Evaluation for Advisor</a>
                </div>
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