<?php
    ob_start();
    session_start();
    include('init.php');
    $pageTitle = "Help";
    $activites = true;
    include($tmp.'header.php');
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
            <tr>
              <td>phone</td>
              <td>695325</td>
            </tr>
            <tr>
              <td>email</td>
              <td>nursery@gmail.com</td>
            </tr>
            <tr>
              <td>phone</td>
              <td>965351</td>
            </tr>
           
          </table>
        </div>
      </div>
    </div>
    
<?php
    include($tmp.'footer.php');
    ob_end_flush();

