<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title><?php echo $pageTitle?></title>
		<link rel="stylesheet" href="<?php echo $css?>normalize.css" />
    	<link rel="stylesheet" href="<?php echo $css?>style.css" />
		
		<?php if(isset($landing)) { ?>
		<style>
			.landing {
				background-image:url('<?php echo $landing?>');
			}
		</style>
		<?php } ?>
    </head>
	
	<body>
	<div class="header">
      <div class="container">
        <img class="logo" src="<?php echo $imgs.'logo.png' ?>" alt="logo photo" />
        <div class="links">
          <ul>
            <li><a href="<?php echo $app?>index.php">Home</a></li>
            <li><a href="<?php echo $cont.'HomeController.php?method=showServices'?>">Services</a></li>
            <li><a href="<?php echo $cont.'HomeController.php?method=showHelp'?>">Help</a></li>
          </ul>
        </div>
        <div class="links">
		  <?php if(!isset($_SESSION['username'])) { ?>
          <ul>
            <li><a href="<?php echo $cont.'ParentController.php?method=showLogin'?>">Parent Login</a></li>
            <li><a href="<?php echo $cont.'StaffController.php?method=showLogin'?>">Staff Login</a></li>
            <li><a href="<?php echo $cont.'ManagerController.php?method=showLogin'?>">Manager Login</a></li>
          </ul>
		  <?php } ?>

        
        <?php if(isset($_SESSION['manager'])) { ?>
          <ul>
            <li><a href="<?php echo $cont.'ManagerController.php?method=showProfile'?>">Profile</a></li>
            <li><a href="<?php echo $cont.'ManagerController.php?method=dashboard'?>">Dashboard</a></li>
            <li><a href="<?php echo $cont.'ManagerController.php?method=logout'?>">Logout</a></li>
          </ul>
		  <?php } ?>
 

		  <?php if(isset($_SESSION['parent'])) { ?>
          <ul>
            <li><a href="<?php echo $cont.'ParentController.php?method=showProfile'?>">Profile</a></li>
            <li><a href="<?php echo $cont.'ParentController.php?method=dashboard'?>">Dashboard</a></li>
            <li><a href="<?php echo $cont.'ParentController.php?method=logout'?>">Logout</a></li>
          </ul>
		  <?php } ?>

		  <?php if(isset($_SESSION['staff'])) { ?>
        <ul>
            <li><a href="<?php echo $cont.'StaffController.php?method=showProfile'?>">Profile</a></li>
            <li><a href="<?php echo $cont.'StaffController.php?method=dashboard'?>">Dashboard</a></li>      
            <li><a href="<?php echo $cont.'StaffController.php?method=logout'?>">Logout</a></li>
          </ul>
		  <?php } ?>
      </div>
      </div>
    </div>
