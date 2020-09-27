  <div class="col-lg-3 ds">
            <!--COMPLETED ACTIONS DONUTS CHART-->
<hr>
            <br><br>
<div style="height: 100px;margin-top: 10px">
    <?php
  $cur = $conn->executeQuery($db.'.'.'admin_announcement',$collection_ann);
$a=count(iterator_to_array($cur));
  ?>
<div class="news-panel pn" style="margin-left: 70px">
  <div class="fa-hover col-md-3 col-sm-4"><a href="employee_all_news.php">
    <span class="badge bg-warning" style="float: right;"><?php echo $a;?></span><i class="fa fa-globe"></i>

   <b><font size="3">NEWS</font></b></a></div>
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