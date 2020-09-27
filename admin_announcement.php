<?php 
session_start();
if(!isset($_SESSION['admin']))
{
  header("Location: admin_login.php");
}
$month = date('m');
$day = date('d');
$year = date('Y');
$today = $year . '-' . $month . '-' . $day;
include 'templates/db_conn.php';
$collections = new MongoDB\Driver\Query(["Email"=>$_SESSION['admin']],['limit'=>1]);
$collection_ann = new MongoDB\Driver\Query([]);
$collection_ann_in = new MongoDB\Driver\BulkWrite();
$flg=0;
$popupmsg='';

$default_user='Both Employee & Intern';
$title = '';
$fileDestination='';
$content = '';
if(isset($_POST['announce']))
{
              $default_user = $_POST['whom'];
              $title = $_POST['title'];
              $content = $_POST['content'];
  if(!empty($_FILES['img_file']['name'])){
 $file=$_FILES['img_file'];
 $fileName= $_FILES['img_file']['name'];
 $fileTempName= $_FILES['img_file']['tmp_name'];
 $fileError=$_FILES['img_file']['error'];
 $fileType=$_FILES['img_file']['type'];
 $fileSize=$_FILES['img_file']['size'];
 $fileExt=explode('.', $fileName);
        $fileActualExt=strtolower(end($fileExt));
        $allowed= array('jpg','jpeg','png');
        if(in_array($fileActualExt, $allowed))
        {
          if($fileError===0){
            if($fileSize<10000000){
              
              $fileDestination='news_images/'.$fileName;
              move_uploaded_file($fileTempName, $fileDestination);
              $filedes=$fileDestination;
               $inserteddata=array(
  'announcement_date'=>$today,
 'announcement_by'=> $_SESSION['admin'],
 'to_whom'=> $_POST['whom'],
 'title' =>$_POST['title'],
 'content' => $_POST['content'],
 'picture'=> $fileDestination
);
               $collection_ann_in->insert($inserteddata);
if($conn->executeBulkWrite($db.'.'.'admin_announcement',$collection_ann_in)){
  $flg = 1;
$popupmsg = "Announcement successful!";
}
else
{
  $flg = -1;
$popupmsg = "Retry Announcement again!";
}
            }
            else{
              $flg=-1;
              $popupmsg= "Your image file is too big";
            }
          } 
          else{
            $flg=-1;
            $popupmsg = "There was an error uploading image";
          }
        }
        else{
          $flg=-1;
          $popupmsg = "You cannot upload image of this type";
        }
      }
      else{
echo "no img";
 $inserteddata=array(
 'announcement_date'=>$today,
 'announcement_by'=> $_SESSION['admin'],
 'to_whom'=> $_POST['whom'],
 'title' =>$_POST['title'],
 'content' => $_POST['content'],
 'picture'=> ''
);
 $collection_ann_in->insert($inserteddata);
if($conn->executeBulkWrite($db.'.'.'admin_announcement',$collection_ann_in)){
  $flg = 1;
$popupmsg = "Announcement successful!";
}
else
{
  $flg = -1;
$popupmsg = "Retry Announcement again!";
}
}


}


?>


<!DOCTYPE html>
<html lang="en">

<?php
include 'templates/admin_header.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
</script>
<style type="text/css">

.file-upload
{
  display: inline-flex;
  align-items: center;
  font-size: 15px;
}
.file-upload__input{
  display: none;

}
label {
    color: black;
    font-weight: bold;
  box-sizing: border-box;
  width:100%
    text-decoration: underline ;
  padding: 12px 12px 12px 79px;
  display: inline-block;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: horizontal;
}



input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: center;
}

input[type=submit]:hover {
  background-color: #45a049;
}



.col-25 {
    font-size: 150%;
    font-style: italic;
    text-decoration: underline;
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
/*.row:after {
  content: "";
  display: table;
  clear: both;
}*/

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
.profilecontainer{
  
  align-items: center;
    border-radius: 15px;
    background-color: #D4E5EE;
    padding: 20px;
  width: 800px;
  margin:0px auto 0;
  display:table;
  box-sizing:border-box;
  box-shadow: 5px 10px 5px #888888;
}
.profilecontainer1{

  margin-left: 30%;
  
    border-radius: 15px;
    background-color: #D4E5EE;
    padding: 0px 0px 0px 20px;
  height: 150px;
  width:150px;
  
  display:table;
  box-sizing:border-box;
}


.coloumn
{
  background:transparent;
  display:table-cell;
  width:33.33333%;
  padding:10px;

  color:#fff;

  border-left: 10px solid transparent;
  border-right: 10px solid transparent;

  
}

.limiter {
  width: 80%;
  margin: 0 auto;
}


.container-login100 {
  width: 90%;  
  margin-left: 30px;
  min-height: 100vh;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  padding: 15px;
  background-repeat: no-repeat;
  background-size: cover;
 
  
  position: relative;
  z-index: 1;
}

</style>
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
          <?php
                $cursor2 = $conn->executeQuery($db.'.'.'admin_details_doc',$collections);
                $cursor2 = $cursor2->toArray()[0];
          
     ?>   
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="admin_profile.php"><img src="<?php echo $cursor2->img_dir_path;?>"  onerror=this.src="img/admin/adminpic.png" class="img-circle" width="80"></a></p>
          <h5 class="centered"><?php echo $cursor2->Name;?></h5>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
            <ul class="sub">
              <li><a href="admindash_intern.php">Add / Remove Intern</a></li>
              <li><a href="admindash_employee.php">Add / Remove Employee</a></li>
              <li><a href="">Add / Update Device</a></li>
              <li class="active"><a href="#!">Announcement</a></li>
              
            </ul>
          </li>
        <li>
            <a href="#!">
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
              <h3><font color="black">Admin Dashboard - Announcements</font></h3>
            </div>
            
            <!--custom chart end-->
     
   
            <div class="limiter" >

<div class="container-login100" >
<div class=row>
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

   
    <div class="profilecontainer">

          <div class="row">
            <form action="" method="post" name="imageImport" id="imageImport" enctype="multipart/form-data">
            <div class="col-lg-6">
              <label for="subject1" style="margin-left: 60px; text-align: center;">To whom is this announcement for</label>
            </div>
                <div class="col-lg-3">
                 <select id="" name="whom"  style="margin-left:  0px">
          <option value='<?php echo $default_user?>' selected='selected'><?php echo $default_user;?>(Selected)</option>
          <option value="Employee">Employee</option>
          <option value="Intern">Intern</option>
          <option value="Both Employee & Intern">Both Employee & Intern</option>
        </select>
                </div>
            
          </div>
    <br><br>
          <div class="row">
            <div class="col-lg-7">
              <label for="subject1" style="margin-left: 240px;">News Title </label>
              <input type="text"  style="margin-left: 140px;" name="title" placeholder="Enter News Title here..." value="<?php echo $title;?>">
            </div>
          </div>
<br><br>
<div class="row">
 
      <div class="col-lg-8">
              <label for="subject1" style="margin-left: 200px;">Add a picture (if needed) </label>
               <input type="file"  style="margin-left: 260px;" name="img_file" id="file"><br>
                
            </div>
            
         
        
      </div>
      <br>
    
          <img src="<?php echo $fileDestination;?>" alt="" height="200" width="400" style="margin-left:  150px;">
      
      
<br><br>
 <div class="row">
            <div class="col-lg-7">
              <label for="subject1" style="margin-left: 240px;">Add Content </label>
              <textarea style="margin-left: 140px;" rows="15" cols="10" name="content" placeholder="Add your announcement content here.."><?php echo $content;?></textarea>
            </div>
          </div>
  
        </br></br>
        
          <div align="center" >
           
             <button type="submit" id="submit" name="announce"
                    class="btn btn-success">Announce</button>
          </div>
        </form>
      </div>
  </br>

     
  
  </div>

      </div>



    </div>
            <!-- /row -->
            
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
