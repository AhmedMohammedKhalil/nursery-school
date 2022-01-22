<?php
	ob_start();
	session_start();
	$pageTitle = 'All Contacts';
	include 'init.php';
	include $tmp.'header.php';
    if(isset($_SESSION['contacts'])) {
        $contacts = $_SESSION['contacts'];
    }
  
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
        <div style="text-align: center;    margin-bottom: 20px;">
            <a class="button" href="<?php echo $cont.'ContactController.php?method=addContact' ?>">Add Contact</a>
        </div>
        <div class="container">
          <h2 class="special-heading">All Contacts</h2>
          <table id="table" style="margin-top: 20px;">
            <tr>
              <th>Type</th>
              <th>contact</th>
              <th>Control</th>
            </tr>
            <?php if(isset($_SESSION['contacts'])) { 
                foreach($contacts as $c) {
            ?>
                <tr>
                <td><?php echo $c['type'] ?></td>
                <td><?php echo $c['contact'] ?></td>
                <td>
                    <div class="flex" style="flex-direction: row;margin: 0;justify-content:space-evenly">
                        <a href="<?php echo $cont.'ContactController.php?method=editContact&id= '.$c['id'] ?>">edit</a>
                        <a href="<?php echo $cont.'ContactController.php?method=delContact&id= '.$c['id'] ?>">delete</a>
                    </div>
                </td>
                </tr>
            <?php }} 
                if(empty($contacts)) {
                    echo '<tr><td colspan="3">Not Found Contacts</td></tr>';
                }
            ?>
           
           
          </table>
        </div>
    </div>
<?php
	include $tmp . 'footer.php';
	ob_end_flush();
?>