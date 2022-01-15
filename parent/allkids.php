<?php
    ob_start();
    session_start();
    include('init.php');
    $pageTitle = "Kids";
    include($tmp.'header.php');
    $kids=$_SESSION['allkids'];
    
?>
<div class="section" id="kids" style="min-height: 76.3vh;">
        <div style="text-align: center;">
          <a class="button" href="<?php echo $cont.'ParentController.php?method=addKid'?>">Add Kids</a>
        </div>
        <div class="container">
          <h2 class="special-heading">All Kids</h2>
          <table id="table">
            <tr>
              <th>Kid Name</th>
              <th>class</th>
              <th>status</th>
              <th>Control</th>
            </tr>
            <?php foreach ($kids as $k) {?>
            <tr>
              <td><a href="<?php echo $cont.'ParentController.php?method=showKid&id='.$k['id'] ?>"><?php echo $k['fname'].' '.$k['lname'] ?></a></td>
              <td><?php echo $k['class'] ?></td>
              <td><?php echo $k['status'] ?></td>
              <td>
                <div class="flex" style="flex-direction: row;margin: 0;justify-content:space-evenly">
                  <a href="<?php echo $cont.'ParentController.php?method=payForKid&id='.$k['id'] ?>">Pay</a>
                  <a href="<?php echo $cont.'ParentController.php?method=editKid&id='.$k['id']?>">edit</a>
                  <a href="<?php echo $cont.'ParentController.php?method=deleteKid&id='.$k['id']?>">delete</a>
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