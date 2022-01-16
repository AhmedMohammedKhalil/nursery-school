<?php
    ob_start();
    session_start();
    include('init.php');
    $pageTitle = "Services";
    $activites = true;
    include($tmp.'header.php');
?>
    <div class="section" id="search">
      <div class="container">
        <form action="" class="form">
          <div>
            <div>
              <label for="search">Search</label>
              <input type="search" name="search" id="searching" title="Search...">
            </div>
            <div>
              <input type="submit" value="Search">
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="section" id="services">
      <div class="container">
        <h2 class="special-heading">Services</h2>
        <div class="section-content">
          <div class="text">
            <div>
              <h3>title</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil nemo neque voluptate tempora velit cum non,
                fuga vitae architecto delectus sed maxime rerum impedit aliquam obcaecati, aut excepturi iusto laudantium!
              </p>
            </div>
            <div>
              <h3>title</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil nemo neque voluptate tempora velit cum non,
                fuga vitae architecto delectus sed maxime rerum impedit aliquam obcaecati, aut excepturi iusto laudantium!
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
<?php
    include($tmp.'footer.php');
    ob_end_flush();

