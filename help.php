<?php
    ob_start();
    session_start();
    include('init.php');
    $pageTitle = "Help";
    $activites = true;
    include($tmp.'header.php');
    $contacts=$_SESSION['contacts'];
?>
    <div class="contact">
      <div class="container">
        <h2 class="special-heading">Contact</h2>
        <div class="info">
          <p class="label">Feel free to drop us a line at:</p>
          <table id="table">
            <tr>
              <th>Name</th>
              <th>Contact</th>
            </tr>
      
            <?php foreach ($contacts as $c) {?>
            <tr>
              <td><?php echo $c['type'] ?></td>
              <td><?php echo $c['contact'] ?></td>
            </tr>
            <?php }
            if(empty($contacts)){
              echo "<tr><td colspan='2'>Not Found Contacts</td></tr>";
            }
            ?>
            
          </table>
        </div>
      </div>
    </div>
    
<?php
    include($tmp.'footer.php');
    ob_end_flush();

