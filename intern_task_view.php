<?php 
session_start();
if(!isset($_SESSION['intern']))
{
  header("Location: intern_login.php");
}
$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;
include 'templates/intern_auth.php';
$flg=0;
$popupmsg='';
$collection_ann = new MongoDB\Driver\Query([]);
$collections = new MongoDB\Driver\Query(["Email"=>$_SESSION['intern']],['limit'=>1]);
$collectionemp = new MongoDB\Driver\Query(["Email"=>$_SESSION['intern'],"task_date"=>$today,"who"=>'intern'],['limit'=>1]);
 $cursor =  $conn->executeQuery($db.'.'.'intern_document',$collections);
 $cursor = $cursor->toArray()[0];  
  $task_cursor = $conn->executeQuery($db.'.'.'intern_emp_task_details',$collectionemp);
  $task_cursor = $task_cursor->toArray()[0];  
?>


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
          <p class="centered"><a href="intern_profile.php"><img src="<?php echo $cursor->img_dir_path;?>" onerror=this.src="img/intern/internpic.png" class="img-circle" width="80"></a></p>
          <h5 class="centered"><?php echo $cursor->name;?></h5>
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
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <style type="text/css">
                      .remove-link{
                        color: #E0E0E0;
                        margin-left: 30px;
                      }
                      .remove-link:hover {text-decoration: underline; color: #FFFFFF;}

                        
table {
    border-collapse: collapse;
}

td {
    padding-top: .5em;
    padding-bottom: .5em;
}
                    </style>

    <section id="main-content">
      <section class="wrapper">
        <div class="row">
                   <div class="col-lg-9 main-chart">
            <!--CUSTOM CHART START -->
            <div class="border-head">
              <h3><font color="black"> Intern Dashboard </font></h3>
            </div>
            
            <!--custom chart end-->
             <div class="row">
             <?php
             $collections2 = new MongoDB\Driver\Query(['Email'=>$_SESSION['intern']]);
             $cursor = $conn->executeQuery($db.'.'.'intern_emp_task_details',$collections2);
             $cnt = 1;
             ?>
              <!-- /col-md-4 -->
              <div class="col-md-12 mb" style="margin-left: 0px">
              <h3><i class="fa fa-angle-right"></i> <font color="black" size="4"> Your Task Details</font></h3>
                <!-- WHITE PANEL - TOP USER -->
                <div class="etask-panel pn" style="height: 400px;"><br>
                  
                  <table>

                    <thead class="headd"><th><font size="2" style="margin-right: 0px; margin-left: 20px"><u>Task_no.</u></font></th><th><font size="2" style="margin-right: 30px; margin-left: 25px" ><u>Date</u></font></th><th><font size="2" style="margin-right: 25px; margin-left: 0px"> <u>Punch_in</u> </font></th><th><font size="2" style="margin-right: 40px; margin-left: 0px"><u>Punch_out</u></font></th><th><font size="2" style="margin-right: 80px; margin-left: 0px" ><u>About_Task</u></font></th><th><font size="2" style="margin-right: 100px; margin-left: 0px"><u>Pending_work</u></font></th><th><font size="2" style="margin-right: 40px; margin-left: 0px"><u>Task_files</u></font></th></thead>
                    </table>
                    <div class="scrollit" style="margin-top: 10px;height: 355px;" >
                    <table>

                   <?php
                   foreach ($cursor as $document)
                   {
                   ?>
                    <tr><td><font style="margin-left: 40px;margin-right: 30px;" size="3">
                      <?php echo $cnt;?>.

                    </font></td><td>
                      <div class="col-lg-12" style="margin-left: 0px;">
                      <label style="width: 40px;"><font size="2"><?php echo $document->task_date;?></font></label>
                    </div>
                    </td>

               <td><div class="col-lg-12" style="margin-left: 0px">
                      <label style="width: 45px;"><font size="3"><?php echo $document->start_time;?></font></label>
                    </div></td>
                    <td><div class="col-lg-12" style="margin-left: 0px">
                      <label style="width: 60px;"><font size="3"><?php echo $document->end_time;?></font></label>
                    </div></td>
                    <td><div class="col-lg-12" style="margin-left: 0px">
                      <label style="width: 135px;"><font size="2"><?php echo $document->sub_task;?></font></label>
                    </div></td>
                    <td><div class="col-lg-12" style="margin-left: 0px">
                      <label style="width: 140px;"><font size="2"><?php echo $document->pending_work;?></font></label>
                    </div></td>
                    <style type="text/css">
                      .remove-link{
                        color: #E0E0E0;
                      }
                      .remove-link:hover {text-decoration: underline; color: #FFFFFF;}
                    </style>
                    <td><div class="col-lg-12" style="margin-left: 0px">

                      <?php 
                      $collections3 = new MongoDB\Driver\Query(['Email'=>$_SESSION['intern'],'task_date'=>$document->task_date],['limit'=>1]);
                      $jlt = $conn->executeQuery($db.'.'.'intern_emp_task_details',$collections3);
                      $jlt = $jlt->toArray()[0];
                    $a=1;
        foreach ($jlt->task_file_path as $tr) {
          if(!empty($tr[0])){
        ?>

         <a href="<?php echo $tr[0];?>" class="remove-link"><font size="3"><span>File - <?php echo $a;?></span></font></a>
        <?php
        $a++;
      }
        
      }?>
                    
                    </div></td>
              </tr>
              <?php
              $cnt++;

            }?>


              
                    
                    
                             
                  </table>
                  </div>

                </div>

              </div>

              
              <!-- /col-md-4 -->
              
              <!-- /col-md-4 -->
            </div>
            <!-- /row -->
            

    
      <!-- /wrapper -->
             </div>
          <!-- /col-lg-9 END SECTION MIDDLE -->
          <!-- **********************************************************************************************************************************************************
              RIGHT SIDEBAR CONTENT
              *********************************************************************************************************************************************************** -->
              <?php
               include 'templates/intern_right_sidebar.php';
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
