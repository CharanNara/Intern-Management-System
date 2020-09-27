<div class="col-lg-3 ds">
            <!--COMPLETED ACTIONS DONUTS CHART-->
               
          
            <!-- First Member -->
           <hr>
           
           
          
<div class="row" style="height: 100px;margin-top: 0px">


     </div>
     <div class="row" style="height: 100px;margin-top: 0px">
  <?php
   $cur = $conn->executeQuery($db.'.'.'admin_announcement',$collection_ann);
$a=count(iterator_to_array($cur));
  ?>
  
<div class="news-panel pn" style="width: 190px;margin-left: 50px;">
  <div class="fa-hover col-md-8 col-sm-4" style="margin-left: 20px;"><a href="admin_all_news.php">
    <i class="fa fa-globe"></i>

   <b><font size="2">See all your announcements</font></b></a>
 </div>
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