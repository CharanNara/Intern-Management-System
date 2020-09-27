<?php 
session_start();
if(!isset($_SESSION['admin']))
{
  header("Location: admin_login.php");
}
include 'templates/db_conn.php';
$collectionadm = new MongoDB\Driver\Query(["Email"=>$_SESSION['admin']],['limit'=>1]);
$collection_ann = new MongoDB\Driver\Query([]);
$popupmsg = '';
$flg=-1;
$em = '';
$nm = '';
if(isset($_GET['emailid']))
{
  $collectiontask = new MongoDB\Driver\Query(['email'=>$_GET['emailid'],'typeofuser'=>'employee'],['limit'=>1]);
  $cursor3 = $conn->executeQuery($db.'.'.'admin_document',$collectiontask);
  $cursor3 = $cursor3->toArray()[0];
  $em = $cursor3->username;
  $nm = $cursor3->email;
}
if(isset($_POST['assign']))
{
  if($_POST['employee_name'] && $_POST['employee_email'] && $_POST['maintask'])
  {
    $flg=1;
      $collections = new MongoDB\Driver\BulkWriite();
  $collections->insert(['Email' => $_POST['employee_email'],'main_task' => $_POST['maintask']]);
  $insertOneResult = $conn->executeBulkWrite($db.'.'.'intern_emp_task_details',$collections);
  if($insertOneResult)
  {
    $popupmsg = 'Task assignment successful!';
    $flg = 1;
  }
  else {
    $popupmsg = 'Database Error!';
    $flg = 0;
  }
  }
  else{
    $flg = 0;
    $popupmsg = 'Fill all details!';
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<?php
include 'templates/admin_header.php';
?>
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <?php
       $cursor2 = $conn->executeQuery($db.'.'.'admin_details_doc',$collectionadm);
                $cursor2 = $cursor2->toArray()[0];
    ?>
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="admin_profile.php"><img src="<?php echo $cursor2->img_dir_path;?>"  onerror=this.src="img/admin/adminpic.png" class="img-circle" width="80"></a></p>
          <h5 class="centered"><?php echo $cursor2->Name;?></h5>
          <li class="sub-menu">
            <a class="active" href="javascript:;">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
            <ul class="sub">
              <li><a href="admindash_intern.php">Add / Remove Intern</a></li>
              <li class="active"><a href="admindash_employee.php">Add / Remove Employee</a></li>
              <li><a href="">Add / Update Device</a></li>
              <li><a href="admin_announcement.php">Announcement</a></li>
              
            </ul>
          </li>
        <li>
            <a href="admin_profile.php">
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
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-9 main-chart">
            <!--CUSTOM CHART START -->
            <div class="border-head">
              <h3><font color="black"> Admin Dashboard </font></h3>
            </div>
            
            <!--custom chart end-->

            <!-- /row -->
            <div class="row">
      
              <!-- /col-md-4 -->
               
              <!--/ col-md-4 -->
              <div class="col-md-9 col-sm-9 mb" style="margin-left: 0px ">
                <h3><i class="fa fa-angle-right"></i> <font color="black" size="4"> Assign Task to Employee</font></h3>
                

                <div class="assign-panel pn" style="width: 800px;height: 320px">
                  <?php if($flg == 1)
                  {?>
                 <div class="alert alert-success"><b><?php echo $popupmsg;?></b></div>
               <?php }
                else if($flg==0)
                {?>
                   <div class="alert alert-danger"><b><?php echo $popupmsg;?></b></div>
                  <?php
                }
                else {
                  ?>
                   <div class="alert alert-info"><b></b></div>
                  <?php
                }
               ?>

              <form action="#" method="POST">
                <div class="form-group">
                  <label style="margin-top: 20px" class="col-sm-3 col-sm-3 control-label">Employee Name</label>
                  <div class="col-sm-7" style="margin-top: 10px;">
                    <input type="text" name="employee_name" value="<?php echo $em;?>" class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <label style="margin-top: 20px" class="col-sm-3 col-sm-3 control-label">Email ID</label>
                  <div class="col-sm-7" style="margin-top: 10px;">
                    <input type="text" name="employee_email" value="<?php echo $nm;?>" class="form-control">
                  </div>
                </div>


           


                <div class="form-group">
                  <label style="margin-top: 20px" class="col-sm-3 col-sm-3 control-label">Main Task Description</label>
                  <div class="col-sm-7" style="margin-top: 10px;">
                    <textarea class="form-control" name="maintask"rows="3"></textarea>
                  </div>
                </div>

                <div class="form-group">
                  
                  <button type="submit" name="assign" class="btn btn-theme" style="margin-top: 20px;margin-left: 350px;box-shadow: 5px 5px 5px #888888;">Assign</button>
                </div>
              </form>

            </div>
                        <!--main content start-->
   
              </div>
              <!-- /col-md-4 -->
              
      
      <!-- /wrapper -->
    
            </div>
            <!-- /row -->

    
      <!-- /wrapper -->
             </div>

          <!-- /col-lg-9 END SECTION MIDDLE -->
          <!-- **********************************************************************************************************************************************************
              RIGHT SIDEBAR CONTENT
              *********************************************************************************************************************************************************** -->
          <?php
           include 'templates/admin_right_sidebar.php';
          ?>
          <!-- /col-lg-3 -->
        </div>
        <!-- /row -->
      </section>
    </section>
    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; Copyrights <strong>Robic Rufarm India pvt ltd</strong>. All Rights Reserved
        </p>
        <div class="credits">
          <!--
            You are NOT allowed to delete the credit link to TemplateMag with free version.
            You can delete the credit link only if you bought the pro version.
            Buy the pro version with working PHP/AJAX contact form: https://templatemag.com/dashio-bootstrap-admin-template/
            Licensing information: https://templatemag.com/license/
          -->
          
        </div>
        <a href="index.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>

  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="lib/jquery.sparkline.js"></script>

  <!--script for this page-->
  <script src="lib/dropzone/dropzone.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <script type="text/javascript" src="lib/gritter/js/jquery.gritter.js"></script>
  <script type="text/javascript" src="lib/gritter-conf.js"></script>
  <!--script for this page-->
  <script src="lib/sparkline-chart.js"></script>
  <script src="lib/zabuto_calendar.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Welcome to Robic Rufarm!',
        // (string | mandatory) the text inside the notification
        text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo.',
        // (string | optional) the image to display on the left
        image: 'img/robic2.png',
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: false,
        // (int | optional) the time you want it to be alive for before fading out
        time: 8000,
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
      });

      return false;
    });
  </script>
  <script type="application/javascript">
    $(document).ready(function() {
      $("#date-popover").popover({
        html: true,
        trigger: "manual"
      });
      $("#date-popover").hide();
      $("#date-popover").click(function(e) {
        $(this).hide();
      });

      $("#my-calendar").zabuto_calendar({
        action: function() {
          return myDateFunction(this.id, false);
        },
        action_nav: function() {
          return myNavFunction(this.id);
        },
        ajax: {
          url: "show_data.php?action=1",
          modal: true
        },
        legend: [{
            type: "text",
            label: "Special event",
            badge: "00"
          },
          {
            type: "block",
            label: "Regular event",
          }
        ]
      });
    });

    function myNavFunction(id) {
      $("#date-popover").hide();
      var nav = $("#" + id).data("navigation");
      var to = $("#" + id).data("to");
      console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
  </script>
</body>

</html>
