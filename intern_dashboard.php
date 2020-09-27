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
$collectionemp_q = new MongoDB\Driver\Query(["Email"=>$_SESSION['intern'],"task_date"=>$today,"who"=>'intern'],['limit'=>1]);
$collectionemp_u = new MongoDB\Driver\BulkWrite();
 $cursor = $conn->executeQuery($db.'.'.'intern_document',$collections);
 $cursor = $cursor->toArray()[0];  
  $task_cursor = $conn->executeQuery($db.'.'.'intern_emp_task_details',$collectionemp_q);
  $task_cursor = $task_cursor->toArray()[0];  
  if(isset($_POST['submit_task']))
  {
    $collectionemp_u->update(['Email' => $_SESSION['intern'],"task_date"=>$today],['$set' => ['start_time'=>$_POST['start_time'],'end_time'=>$_POST['end_time'],'status'=>$_POST['task_status'],'pending_work'=>$_POST['pending_work']]],['multi' => false, 'upsert' => false]);

     $updateResult = $conn->executeBulkWrite($db.'.'.'intern_emp_task_details',$collectionemp_u);
        
        header("Location: intern_dashboard.php?popup=success"); 
         }
        if(isset($_GET['popup']))
        {
          if($_GET['popup']=='success'){
             $flg=1;
             $popupmsg = 'Updated Log successfully!';}
        }
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
            <a class="active" href="#">
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
                    </style>
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-9 main-chart">
            <form action="" method="POST">
            <!--CUSTOM CHART START -->
            <div class="border-head">
              <h3><font color="black">Dashboard of Intern</font></h3>
            </div>
            <!--custom chart end-->
   
            <div class="row">
              <?php if($flg == 1)
                  {?>
                 <div class="alert alert-success"><b><?php echo $popupmsg;?></b></div>
               <?php }
               elseif ($flg==-1) {
                 ?>
                 <div class="alert alert-danger"><b><?php echo $popupmsg;?></b></div>
                 <?php 
               }
                ?>
              <!-- /col-md-4 -->
              <div class="col-md-4 mb" style="margin-left: 0px">
                <!-- WHITE PANEL - TOP USER -->
                <div class="white-panel pn">
                 <div class="white-header">
                     <input type="date" value="<?php echo $today; ?>" class="form-control" id="date" name="date">
                   
                 </div>
                  
                  <div class="row">
                    <!--<div class="col-md-2">
                      <u><font size="4">Task</font></u>
                      <p></p>
                   <p style="font-size: 17px">1.</p>
                    </div>-->
                    <div class="col-md-9" style="margin-left: 30px; margin-top: 2px">
                      <u><b><font size="4">Task</font></b></u>
                      <p></p>
                   <p style="font-size: 13px"><?php echo $task_cursor->sub_task;?></p>
                    </div>
                    <div class="col-md-9" style="margin-left: 30px; margin-top: 3px;margin-right:  ">
                      <u><b><font size="4">Status</font></b></u>
                      <p></p>
                      <p><select class="form-control" style="border-radius: 5%;margin-left: 0px" name="task_status">
                  <option value='<?php echo $task_cursor->status;?>' selected='selected'><?php echo $task_cursor->status;?><p style="font-size: 2px"> (Your Selection)</p></option>
                  <option>Pending</option>
                  <option>In Progress</option>
                  <option>Completed</option>
                </select></p>
                    </div>
                     
                  </div>
                  <a href="intern_task_view.php" class="remove-link"><font size="2"><span><b>Click here to see all Tasks</b></span></font></a>
                  
                </div>

              </div>
              <!-- /col-md-4 -->
              <div class="col-md-4 mb" style="margin-left: 30px">
                <!-- INSTAGRAM PANEL -->
                <div class="instagram-panel pn">
                  
                  <br>
                  <div class="inside-panel pn">
             <div class="md-form md-outline">
  <input type="time" id="default-picker" name="start_time" class="form-control" placeholder="Select time" value="<?php echo $task_cursor->start_time;?>">
  <label for="default-picker"><font size="3px">Punch In Time</font></label>
</div>

                  </div>
                  <div class="inside-panel pn">
                    <div class="md-form md-outline" style="align-items: center;">
  <input type="time" id="default-picker" name="end_time" class="form-control" placeholder="Select time" value="<?php echo $task_cursor->end_time;?>">
  <label for="default-picker"><font size="3px">Punch Out Time</font></label>
</div>


                  </div>
                </div>
              </div>
              <!-- /col-md-4 -->
            </div>
            <!-- /row -->
            <div class="row">
      
              <!-- /col-md-4 -->
  
              <!--/ col-md-4 -->
              <div class="col-md-9 col-sm-9 mb" style="margin-left: 0px ">
                <h3><i class="fa fa-angle-right"></i> <font color="black" size="4"> Pending Work</font></h3>
                <div class="pending-panel pn">
                  
                    
                    <div class="col-lg-12" style="margin-top:20px;">
                      <textarea class="form-control " rows="10" cols="50" id="pending" name="pending_work" required><?php echo $task_cursor->pending_work;?></textarea>
                    </div>
                
                    <h5></h5>
                  
                </div>

                <button type="submit" name="submit_task" class="btn btn-primary btn-lg" style="margin-top: 20px;margin-left: 250px;box-shadow: 5px 5px 5px #888888;">Submit</button>
                        <!--main content start-->
   
              </div>
              <!-- /col-md-4 -->
              
      
      <!-- /wrapper -->
    
            </div>
          </form>
            <!-- /row -->

      <section class="wrapper site-min-height" style="margin-top: 0px;margin-left: 0px;">
        <h4><i class="fa fa-angle-right"></i> <font color="black">Upload Your task related files</font></h4>
        <div class="row mt">
          <div style="background-color: #fff;width: 60%;">
            <div class="panel-body">
              <form action="upload.php?who=<?php echo $_SESSION['intern'];?>" class="dropzone" id="my-awesome-dropzone"></form>
            </div>
          </div>
        </div><br>

      </section>
    
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
