<?php
    ob_start();
    session_start();
    include('init.php');
    $pageTitle = "Services";
    $activites = true;
    include($tmp.'header.php');
    $services=$_SESSION['services'];
    

?>
    <div class="section" id="search">
      <div class="container">
        <form action="<?php echo $cont."HomeController.php?method=search"?>" class="form" method="POST">
          <div style="display: flex;justify-content:center">
            <div>
              <input type="search" name="search" id="searching"  title="Search..." placeholder="Search..." value="<?php if(isset($_SESSION['oldsearch'])) echo $_SESSION['oldsearch']; ?>">
            </div>
            <div>
              <input type="submit" value="Search" name="servicesearch">
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="section" id="services" style="min-height: 76.4 vh;">
      <div class="container">
        <h2 class="special-heading">Services</h2>
        <div class="section-content">
          <div class="text">
            <?php foreach ($services as $s) {?>
              <div>
              <h3><?php echo $s['title'] ?></h3>
              <p>
              <?php echo nl2br($s['body']) ?>
              </p>
              </div>
            <?php }
            if(empty($services)){
              echo "<h3 class='text' style='text-align:center;'>Services Not Found</h3>";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    
<?php
    include($tmp.'footer.php');
    ob_end_flush();
    unset($_SESSION['oldsearch']);

