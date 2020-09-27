<?php
   $flg3 ='';
   $popupmsg3 = '';
   $filter_adm = ['email'=>$_SESSION['intern']];
   $options = ['limit'=>1];
   $collection_idea = new MongoDB\Driver\BulkWrite();
   $collection_adm = new MongoDB\Driver\Query($filter_adm,$options);
   $cursor4 = $conn->executeQuery($db.'.'.'admin_document',$collection_adm);
   $cursor4 = $cursor4->toArray()[0];  
   $filter_emp = ['Email'=>$cursor4->mentor];
   $collection_emp = new MongoDB\Driver\Query($filter_emp,$options);
   $cursor5 = $conn->executeQuery($db.'.'.'employee_document',$collection_emp);
   $cursor5 = $cursor5->toArray()[0];  
                  if(isset($_POST['pitch']))
                  {  
    $inserteddata3=array(
 'intern_email'=> $_SESSION['intern'],
 'idea_date'=> $today,
 'idea' => $_POST['idea']
);
      $collection_idea->insert($inserteddata3);
                     if($conn->executeBulkWrite($db.'.'.'intern_idea_board',$collection_idea)){
  $flg3 = 1;
$popupmsg3 = "Your response has been noted!";
}
else
{
  $flg3 = -1;
$popupmsg3 = "Please resubmit your response!";
}
                  }
?>
<div class="col-lg-3 ds">
            <!--COMPLETED ACTIONS DONUTS CHART-->
               
            
            <h4 class="centered mt">MENTORS</h4>
            <!-- First Member -->
            <div class="desc">
              <div class="thumb">
                <img class="img-circle" src="<?php echo $cursor5->img_file_path;?>" onerror=this.src="img/employee/employeepic.png" width="35px" height="35px" align="">
              </div>
              <div class="details">
                <p>
                  <a href="#!"><font color="black"><?php echo $cursor5->Name;?></font></a><br/>
                  <muted><?php echo $cursor5->role;?></muted>
                </p>
              </div>
            </div>
            <!-- Second Member -->

           
           <br>
           <div >
            <div class="row">
              <?php

               if($flg3 == 1)
                  {?>
                 <div class="alert alert-success"><b><?php echo $popupmsg3;?></b></div>
               <?php }
               elseif ($flg3==-1) {
                 ?>
                 <div class="alert alert-danger"><b><?php echo $popupmsg3;?></b></div>
                 <?php 
               }
                ?>
             <h4 class="centered mt">IDEA BOARD</h4>
            
                <div class="darkblue-panel pn" style="height: 300px">

              
                  <form action="" method="POST">

                     <div class="col-lg-12" style="margin-top: 20px;">
                       <b style="margin-bottom: 30px;">
                  <font size="2px" color="#fff"><?php echo $today; ?></font>
                </b>
                      <textarea style="margin-top: 30px" class="form-control" rows="7" cols="30" id="idea" name="idea" required></textarea>
                    </div>

                      <button type="submit" name="pitch" class="btn btn-success" style="margin-top: 20px;box-shadow: 5px 5px 5px #000;">Pitch</button>
                  </form>
                  <footer>
                    
                  </footer>
                </div>
          
                <!--  /darkblue panel -->
              </div>
<div class="row" style="height: 100px;margin-top: 10px">
  <?php
  $cur = $conn->executeQuery($db.'.'.'admin_announcement',$collection_ann);
$a=count(iterator_to_array($cur));
  ?>
<div class="news-panel pn">
  <div class="fa-hover col-md-3 col-sm-4"><a href="intern_all_news.php">
    <span class="badge bg-warning" style="float: right;"><?php echo $a;?></span><i class="fa fa-globe"></i>

   <b><font size="3">NEWS</font></b></a>
 </div>
</div>
<div class="survey-panel pn">
  <div class="fa-hover col-md-3 col-sm-4"><a href="https://docs.google.com/forms" target="_blank"><i class="fa fa-edit"></i> <b><font size="3">Survey</font></b></a></div>
</div>
     </div>
            <!-- CALENDAR-->
             <h4 class="centered mt">CALENDAR</h4>
            <div id="calendar" class="mb">
              <div class="panel green-panel no-margin">
                <div class="panel-body">
                  <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                    <div class="arrow"></div>
                    <h3 class="popover-title" style="disadding: none;"></h3>
                    <div id="date-popover-content" class="popover-content"></div>
                  </div>
                  <div id="my-calendar"></div>
                </div>
              </div>
            </div>
            <!-- / calendar -->
          </div>