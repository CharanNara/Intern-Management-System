<?php 
session_start();
if(!isset($_SESSION['employee']))
{
  header("Location: employee_login.php");
}
$month = date('m');
$day = date('d');
$year = date('Y');
$today = $year . '-' . $month . '-' . $day;

  include 'templates/employee_auth.php';

 $flg=0;
$popupmsg='';
$collectionemp = new MongoDB\Driver\Query(["Email"=>$_SESSION['employee']],['limit'=>1]);
$collection_ann = new MongoDB\Driver\Query([]);
  $collectiontask = new MongoDB\Driver\Query(['Email'=>$_SESSION['employee']]);
  $collectiontask_in = new MongoDB\Driver\BulkWrite();
  $cursor2 = $conn->executeQuery($db.'.'.'intern_emp_task_details',$collectiontask);
 $cursor = $conn->executeQuery($db.'.'.'employee_document',$collectionemp);
 $cursor = $cursor->toArray()[0];
if(isset($_POST['assign']))
{
 if($_POST['assignto'] == 'Intern')
 {

  $inserteddata=array(
 'Email'=> $_POST['em'],
 'Name' => $_POST['toname'],
 'task_date'=> $_POST['task_date'],
 'start_time' =>'',
 'end_time' => '',
 'main_task'=>$_POST['main_task'],
 'sub_task'=> $_POST['abttask'],
 'status' => 'Pending',
 'pending_work' => '',
 'task_file_path'=>['0'=>[]],
  'assigned_by'=> $cursor->Name,
  'who' => 'intern'
);
  $collectiontask_in->insert($inserteddata);
  if($conn->executeBulkWrite($db.'.'.'intern_emp_task_details',$collectiontask_in)){
  $flg = 1;
$popupmsg = "Task assignment successful!";
}
else
{
  $flg = -1;
$popupmsg = "Please retry to assign task!";
}
}
elseif ($_POST['assignto'] == 'Yourself') {
  $collectiontask_in->update(['Email'=>$_POST['em']],['$set'=>[
    'Name'=>$_POST['assignto'],
'task_date'=> $_POST['task_date'],
 'start_time' =>'',
 'end_time' => '',
 'sub_task'=> $_POST['abttask'],
 'status' => 'Pending',
 'pending_work' => '',
 'task_file_path'=>['0'=>[]],
  'assigned_by'=> $cursor->Name,
  'who' => 'employee'
  ]]);
  if($conn->executeBulkWrite($db.'.'.'intern_emp_task_details',$collectiontask_in)){
  $flg = 1;
$popupmsg = "Task assignment successful!";
}
else
{
  $flg = -1;
$popupmsg = "Please retry to assign task!";
}
}

}
if(isset($_POST['apply']))
{
  $collection_leave = new MongoDB\Driver\BulkWrite();
    $inserteddata2=array(
 'employee_email'=> $_SESSION['employee'],
 'from_date'=> $_POST['from_date'],
 'to_date' => $_POST['to_date'],
 'reason'=> $_POST['reason']
);
    $collection_leave->insert($inserteddata2)
if($conn->executeBulkWrite($db.'.'.'employee_leave_doc',$collection_leave)){
  $flg = 1;
$popupmsg = "Leave application successful!";
}
else
{
  $flg = -1;
$popupmsg = "Please retry to apply leave!";
}
}
?>


<!DOCTYPE html>
<html lang="en">
<?php
include 'templates/employee_header.php';
?>
<style type="text/css">
  
table {
    border-collapse: collapse;
}

td {
    padding-top: .5em;
    padding-bottom: .5em;
}
</style>
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="employee_profile.php"><img src="<?php echo $cursor->img_dir_path?>" onerror=this.src="img/employee/employeepic.png" class="img-circle" width="80"></a></p>
          <h5 class="centered"><?php echo $cursor->Name;?></h5>
          <li class="mt">
            <a class="active" href="#!">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
          </li>
          
        <li>
            <a href="employee_profile.php">
              <i class="fa fa-user"></i>
              <span>User Profile</span>
              
              </a>
          </li>
          
          <li>
            <a href="">
              <i><img src="img/system-monitoring.webp" height="15px" width="15px" style="background-color: white;"></i>
              <span>Monitoring systems</span>
              
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
              <h3><font color="black">Dashboard of Employee</font></h3>
            </div>
            
            <!--custom chart end-->
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
   
            <div class="row">
             
              <!-- /col-md-4 -->
              <div class="col-md-12 mb" style="margin-left: 0px">
              <h3><i class="fa fa-angle-right"></i> <font color="black" size="4">Work Profile</font></h3>

                <!-- WHITE PANEL - TOP USER -->
                <div class="etask-panel pn" style="height: 400px"><br>
                  
                  <table style="margin-left: 40px;">
       <th style="width: 180px;"><u>Task</u></th><th style="width: 190px;"><u style="margin-left: 40px;">Status</u></th><th style="width: 150px;"><u>Pending work</u></th><th style="width: 100px;"><u>Task files</u></th> <th style="width: 180px;"><u>Assigned to</u></th></tr>
                    
                    </table>
                    <div class="scrollit" style="height: 365px;">
<font style="margin-left: 30px" size="3">
                        <table border="0" style="margin-left: 40px;"><tr>
 <?php

              $cursor5 = $conn->executeQuery($db.'.'.'intern_emp_task_details',$collectiontask);
                            foreach ($cursor5 as $doc1) {
                
              
                    $collectiontask2 = new MongoDB\Driver\Query(['assigned_by'=>$cursor->Name,'main_task'=>$doc1->main_task]);
                    $cursor4 = $conn->executeQuery($db.'.'.'intern_emp_task_details',$collectiontask2);
?>
                   
                          <tr><td style="font-size: 16px; width: 170px;"><b><?php echo $doc1->main_task;?></b></td></tr>
                          <?php
                       foreach ($cursor4 as $doc2) {
                          ?>
                         <tr> <td style="width: 170px;font-size: 13px;">- <?php echo $doc2->sub_task;?></td>
                          <td style="width: 150px;">
                            <?php 
                              if($doc2->who=='intern')
                              {
                            ?>
                            <input type="text" name="" size="15" style="color: black;margin-left: 20px" value="<?php echo $doc2->status;?>" disabled="true">
                            <?php
                          }
                          else{?>
                            <select class="form-control" style="border-radius: 5%;margin-left: 20px">
                             <option value='<?php echo $doc2->status;?>' selected='selected'><?php echo $doc2->status;?><p style="font-size: 2px"> (Your Selection)</p></option>
                  <option>Pending</option>
                  <option>In Progress</option>
                  <option>Completed</option>
                </select></td>
                <?php
              }?>
                <td style="width: 170px;"><div class="col-lg-12" style="">
                              <?php 
                              if($doc2->who=='intern')
                              {
                            ?>

                      <textarea style="margin-left: 30px;" class="form-control " rows="2" cols="20" id="pending" name="pending" disabled="true"><?php echo $doc2->pending_work;?></textarea>
                      <?php
                    }
                    else
                      {?>
                        <textarea style="margin-left: 30px;" class="form-control " rows="2" cols="20" id="pending" name="pending"><?php echo $doc2->pending_work;?></textarea>
                        <?php
                      }?>

                    </div></td>
                     <style type="text/css">
                      .remove-link{
                        color: #E0E0E0;
                      }
                      .remove-link:hover {text-decoration: underline; color: #FFFFFF;}
                    </style>
                    <td style="width: 150px;"><div style="margin-left: 60px;">
                      <?php 
                      $collectiontask3 = new MongoDB\Driver\Query(['Email'=>$doc2->Email,'task_date'=>$doc2->task_date],['limit'=>1]);
                      $jlt = $conn->executeQuery($db.'.'.'intern_emp_task_details',$collectiontask3);
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

                    <td style="width: 170px;font-size: 15px;"><p><?php echo $doc2->Name;?></p></td>
              </tr>
      <?php
}
    }?>
                        </table>

                    </font>
                  </div>

                </div>

              </div>

              <button type="submit" name="work" class="btn btn-primary btn-lg" style="margin-top: 10px;margin-left: 350px;box-shadow: 5px 5px 5px #888888;">Submit</button>
              <!-- /col-md-4 -->
              
              <!-- /col-md-4 -->
            </div>
            <!-- /row -->
            <div class="row" style="margin-top: 25px;">
              
      
              <!-- /col-md-4 -->
  
              <!--/ col-md-4 -->
              <div class="col-md-6 col-sm-10 mb" style="margin-left: 0px ">
                <h3><i class="fa fa-angle-right"></i> <font color="black" size="4"> Assign Task to Intern / Yourself</font></h3>
               <div class="col-lg-8">
            <div class="assign-panel pn" style="height: 100%;">
              <form action="#" method="POST">
                  <div class="form-group">
                  <label style="margin-top: 20px;font-size: 13px;" class="col-sm-3 col-sm-3 control-label">Assign To</label>
                  <div class="col-sm-7" style="margin-top: 10px;">
                   <select class="form-control action" style="border-radius: 5%;" id="assignto" name="assignto">
                    <option value="" disabled="true" selected="true">--SELECT--</option>
                  <option value="Intern">Intern</option>
                  <option value="Yourself">Yourself</option>
                 </select>
                  </div>
                </div>
             
                <div class="form-group">
                  <label style="margin-top: 20px;font-size: 13px;" class="col-sm-3 col-sm-3 control-label">Name</label>
                  <div class="col-sm-7" style="margin-top: 10px;">
                   <select class="form-control action" style="border-radius: 5%;" id="toname" name="toname">
                  <option disabled="true" value="" selected="true">--SELECT--</option>
                
                  
                </select>
                  </div>
              
                </div>
                  <div class="form-group">
                  <label style="margin-top: 20px;font-size: 13px;" class="col-sm-3 col-sm-3 control-label">Email</label>
                  <div class="col-sm-7" style="margin-top: 10px;">
                    <input type="text" placeholder="Did not chose any" name="em" id="em" class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <label style="margin-top: 20px" class="col-sm-3 col-sm-3 control-label">Date</label>
                  <div class="col-sm-7" style="margin-top: 10px;">
                    <input type="date" class="form-control" name="task_date" required>
                  </div>
                </div>
                                <div class="form-group">
                                  <??>
                  <label style="margin-top: 20px;font-size: 13px;" class="col-sm-3 col-sm-3 control-label">Main_Task </label>
                  <div class="col-sm-7" style="margin-top: 10px;">
                   <select class="form-control action" style="border-radius: 5%;" id="" name="main_task">
                  <option disabled="true" value="" selected="true">--SELECT--</option>
                <?php
                 foreach ($cursor2 as $document) {
                   ?>
                   <option value="<?php echo $document->main_task;?>"><?php echo $document->main_task;?></option>
                   <?php
                 }
                ?>
                  
                </select>
                  </div>
              
                </div>
                <div class="form-group">
                  <label style="margin-top: 20px" class="col-sm-3 col-sm-3 control-label">Subtask</label>
                  <div class="col-sm-7" style="margin-top: 10px;">
                    <textarea rows="2" cols="5" class="form-control" name="abttask" required></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <button type="submit" name="assign" class="btn btn-theme" style="margin-top: 10px;margin-left: 150px;box-shadow: 5px 5px 5px #888888;">Assign</button>
                </div>
                <br>
              </form>
            </div>
            <!-- /form-panel -->
          </div>      

              </div>


          <div class="col-md-6 col-sm-10 mb" style="margin-left: 0px ">
                <h3><i class="fa fa-angle-right"></i> <font color="black" size="4"> Apply for Leave</font></h3>
               <div class="col-lg-8">
            <div class="leave-panel pn">
              <form action="" method="POST">
                <div class="form-group">
                  <label style="margin-top: 70px" class="col-sm-3 col-sm-3 control-label"> From</label>
                  <div class="col-sm-7" style="margin-top: 60px;">
                    <div class="input-group input-large" data-date="01/01/2014" data-date-format="mm/dd/yyyy">
                      <input type="text" class="form-control dpd1" name="from_date" required>
                      <span class="input-group-addon">To</span>
                      <input type="text" class="form-control dpd2" name="to_date" required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label style="margin-top: 20px" class="col-sm-3 col-sm-3 control-label">Reason</label>
                  <div class="col-sm-7" style="margin-top: 10px;">
                    <textarea rows="5" cols="5" class="form-control" name="reason" required=""></textarea>
                  </div>
                </div>

                <div class="form-group">
                  
                  <button type="submit" name="apply" class="btn btn-theme" style="margin-top: 30px;margin-left: 160px;box-shadow: 5px 5px 5px #888888;">Apply</button>
                </div>
              </form>
            </div>
            <!-- /form-panel -->
          </div>      
           
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
         include 'templates/employee_right_sidebar.php';
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
   <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script type="text/javascript" src="lib/bootstrap-daterangepicker/date.js"></script>
<script type="text/javascript" src="lib/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="lib/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="lib/jquery.sparkline.js"></script>
<script src="lib/advanced-form-components.js"></script>
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
     $('.action').change(function() {
      if($(this).val()!='')
      {
        var action = $(this).attr("id");
        var query = $(this).val();
        var result = '';
        if(action == "assignto")
        {
          result = 'toname';
        }

        $.ajax({
          url:"fetch.php",
          method:"POST",
          data:{action:action,query:query},
          success:function(data){
            $('#'+result).html(data);
          }
        })
      }
     });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
     $('.action').change(function() {
      if($(this).val()!='')
      {
        var action = $(this).attr("id");
        var query = $(this).val();
        var result = '';
        if(action == "toname")
        {
          result = 'em';
        }

        $.ajax({
          url:"fetch2.php",
          method:"POST",
          data:{action:action,query:query},
          success:function(data){
            $('#'+result).val(data);
          }
        })
      }
     });
    });
  </script>
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
