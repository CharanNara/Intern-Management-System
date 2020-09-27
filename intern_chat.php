<!DOCTYPE html>
<html lang="en">

<?php
include 'templates/intern_header.php'
?>
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="intern_profile.php"><img src="<?php echo $cursor['img_dir_path'];?>" onerror=this.src="img/intern/internpic.png" class="img-circle" width="80"></a></p>
          <h5 class="centered"><?php echo $cursor['name'];?></h5>
          <li class="mt">
            <a class="active" href="intern_dashboard.php">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
          </li>
          
        <li>
            <a href="intern_profile.php">
              <i class="fa fa-user"></i>
              <span>User Profile</span>
              
              </a>
          </li>
          
          
          
          <li>
            <a href="inbox.html">
              <i class="fa fa-envelope"></i>
              <span>Mail </span>
              <span class="label label-theme pull-right mail-info">2</span>
              </a>
          </li>
          
          <li>
            <a href="http://www.rrrocketchat.tk/" target="_blank">
              <i class="fa fa-comments-o"></i>
              <span>Chat Room </span>
              <span class="label label-theme pull-right mail-info">2</span>
              </a>
          </li>
          
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <section id="main-content">
        
             <link rel="import" href="https://www.rrrocketchat.tk/home">
    </section>
    </html>

