<?php 
session_start();
if(!isset($_SESSION['admin']))
{
  header("Location: admin_login.php");
}
include 'templates/db_conn.php';
$collections_u = new MongoDB\Driver\BulkWrite();
$collections = new MongoDB\Driver\Query(["Email"=>$_SESSION['admin']],['limit'=>1]);
$flg=0;
$popupmsg='';
$default_country='';
if (isset($_POST["image_btn"]))
{
       
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
              
              $fileDestination='img/admin/'.$fileName;
              move_uploaded_file($fileTempName, $fileDestination);
              $filedes=$fileDestination;
              $collections_u->update(
    ['Email' => $_SESSION['admin']],
    ['$set' => ['img_dir_path' => $fileDestination]]
);
              $updateResult = $conn->executeBulkWrite($db.'.'.'admin_details_doc',$collections_u);


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

if(isset($_POST['submit_profile']))
{
   $collections_u->update(
    ['Email' => $_SESSION['admin']],
    ['$set' => ['linked_profile'=>$_POST['linkedin'],'insta_profile'=>$_POST['insta'],'facebook_profile'=>$_POST['facebook'],'address'=>$_POST['address'],'city'=>$_POST['city'],'country'=>$_POST['country'],'pincode'=>$_POST['pincode'],'about'=>$_POST['about']]]
);
   $updateResult2 = $conn->executeBulkWrite($db.'.'.'admin_details_doc',$collections_u);
   $popupmsg = 'Updated Profile Successfully!';
   $flg=1;
}
if(isset($_POST['submit_nda']))
{
   if(isset($_POST['tandc']))
   {
       $file=$_FILES['nda'];
 $fileName= $_FILES['nda']['name'];
 $fileTempName= $_FILES['nda']['tmp_name'];
 $fileError=$_FILES['nda']['error'];
 $fileType=$_FILES['nda']['type'];
 $fileSize=$_FILES['nda']['size'];
 $fileExt=explode('.', $fileName);
        $fileActualExt=strtolower(end($fileExt));
        $allowed= array('pdf');
        if(in_array($fileActualExt, $allowed))
        {
          if($fileError===0){
          
              
              $fileDestination='nda_files/admin_nda/'.$fileName;
              move_uploaded_file($fileTempName, $fileDestination);
              
              $filedes=$fileDestination;
              $collections_u->update(
    ['Email' => $_SESSION['admin']],
    ['$set' => ['nda_file_path' => $fileDestination]]
    
);
              $updateResult2 = $conn->executeBulkWrite($db.'.'.'admin_details_doc',$collections_u);

$flg = 1;
    $popupmsg = "Successfully uploaded NDA Form"." "."' ".$fileName." '";
            
            
          } 
          else{
            $flg=-1;
            $popupmsg = "There was an error uploading file!";
          }
        }
        else{
          $flg=-1;
          $popupmsg = "You cannot upload file of this type!";
        }
   }
   else{
    $flg=-1;
    $popupmsg = "Please check Terms & Conditions!";
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
  width: 100%;
  margin: 0 auto;
}


.container-login100 {
  width: 90%;  
  margin-left: 5px;
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
              <li><a href="gallery.html">Add / Update Device</a></li>
              <li><a href="todo_list.html">Announcement</a></li>
              
            </ul>
          </li>
        <li>
            <a href="#!" class="active">
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
          
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-comments-o"></i>
              <span>Chat Room</span>
              </a>
            <ul class="sub">
              <li><a href="lobby.html">Lobby</a></li>
              <li><a href="chat_room.html"> Chat Room</a></li>
            </ul>
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
              <h3><font color="black">Admin Profile</font></h3>
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
        
        
          <form action="" method="post"name="imageImport" id="imageImport" enctype="multipart/form-data">
            <center>
            <div class="col-lg-11">
                <h4 style="color: black;">Upload your Picture</h4><br> <input type="file" name="img_file"
                    id="file">
                    <div style="float: right; margin-right:  200px;">
                <button type="submit" id="submit" name="image_btn"
                    class="btn-submit">Upload</button>
              </div><br>
                    <div style="margin-top: 10px;"><center><img src="<?php echo $cursor2->img_dir_path;?>" alt="NO IMG CHOSEN" class="img-circle" width="80"></center></div>
                    <hr>
        
            </div>
          </center>
        </form>
        
         
            </br>
        </br>
                  
          <div class="row">
    <div class="col-lg-4">
      <form action="" method="POST">
              <label for="cname">Company</label>
              <input type="text" id="cname" name="companyname"  value="ROBIC RUFARM PVT. LTD." disabled="true">
            </div> 
            <div class="col-lg-4">
              <label for="fname">User Name</label>
               <input type="text" id="fname" name="intern_name" value="<?php echo $cursor2->Name;?>" disabled="true" >
            </div>
            <div class="col-lg-4">
              <label for="lname">Email - id</label>
              <input type="text" id="lname" name="intern_email" value="<?php echo $cursor2->Email;?>" disabled="true">
            </div>

            
          </div>
          <br><br>
  <div class="row">
            <div class="col-lg-9">
              <label for="liname" style="align-self: auto;">LinkedIn - Profile</label>
              <input type="text" id="liname" name="linkedin" placeholder="Your LinkedIn-profile" value="<?php echo $cursor2->linked_profile;?>">
            </div>
          </div>
 
<br><br>
  <div class="row">
            <div class="col-lg-5">
              <label for="iname">Instagram - profile</label>
              <input type="text" id="iname" name="insta" placeholder="Your Insta profile" value="<?php echo $cursor2->insta_profile;?>">
            </div>
  <div class="col-lg-5">
              <label for="faname">Facebook - profile</label>
              <input type="text" id="faname" name="facebook" placeholder="Your Facebook profile" value="<?php echo $cursor2->facebook_profile;?>">
            </div>
            
          </div>
          
<br><br>
   <div class="row">
            <div class="col-lg-7">
              <label for="subject">Address</label>
               <textarea id="subject" name="address" placeholder="Address here" rows="5"><?php echo $cursor2->address;?></textarea>
            </div>
          </div>
  
<br><br>

          <div class="row">
          <div class="col-lg-3">
          <label for="cname">City</label>
          <input type="text" id="cname" name="city" placeholder="City" value="<?php echo $cursor2->city;?>">
            </div>
           <?php
           if($cursor2->country=='' or $cursor2->country=='--CHOOSE COUNTRY--')
               $default_country = '--CHOOSE COUNTRY--';
             else
              $default_country = $cursor2->country;

           ?>
            <div class="col-lg-3">
              <label for="country">Country</label>
              <select id="country" name="country" >
          <option value='<?php echo $default_country?>' selected='selected'><?php echo $default_country;?></option>
                <option value="Afghanistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antartica">Antarctica</option>
<option value="Antigua and Barbuda">Antigua and Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
<option value="Botswana">Botswana</option>
<option value="Bouvet Island">Bouvet Island</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
<option value="Brunei Darussalam">Brunei Darussalam</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Islands">Cocos (Keeling) Islands</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Congo">Congo, the Democratic Republic of the</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cota D'Ivoire">Cote d'Ivoire</option>
<option value="Croatia">Croatia (Hrvatska)</option>
<option value="Cuba">Cuba</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands (Malvinas)</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="France Metropolitan">France, Metropolitan</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Territories">French Southern Territories</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guinea-Bissau">Guinea-Bissau</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
<option value="Holy See">Holy See (Vatican City State)</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran (Islamic Republic of)</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
<option value="Korea">Korea, Republic of</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Lao">Lao People's Democratic Republic</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
<option value="Madagascar">Madagascar</option>
<option value="Malawi">Malawi</option>
<option value="Malaysia">Malaysia</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Micronesia">Micronesia, Federated States of</option>
<option value="Moldova">Moldova, Republic of</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Namibia">Namibia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherlands">Netherlands</option>
<option value="Netherlands Antilles">Netherlands Antilles</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Northern Mariana Islands">Northern Mariana Islands</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau">Palau</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Philippines">Philippines</option>
<option value="Pitcairn">Pitcairn</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russia">Russian Federation</option>
<option value="Rwanda">Rwanda</option>
<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
<option value="Saint LUCIA">Saint LUCIA</option>
<option value="Saint Vincent">Saint Vincent and the Grenadines</option>
<option value="Samoa">Samoa</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia (Slovak Republic)</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="South Georgia">South Georgia and the South Sandwich Islands</option>
<option value="Span">Spain</option>
<option value="SriLanka">Sri Lanka</option>
<option value="St. Helena">St. Helena</option>
<option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Svalbard">Svalbard and Jan Mayen Islands</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syrian Arab Republic</option>
<option value="Taiwan">Taiwan, Province of China</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania, United Republic of</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad and Tobago">Trinidad and Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks and Caicos">Turks and Caicos Islands</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Emirates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States">United States</option>
<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
<option value="Uruguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Viet Nam</option>
<option value="Virgin Islands (British)">Virgin Islands (British)</option>
<option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
<option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
<option value="Western Sahara">Western Sahara</option>
<option value="Yemen">Yemen</option>
<option value="Serbia">Serbia</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
              </select>
              
            </div>
    <div class="col-lg-3">
              <label for="pname">Pincode</label>
               <input type="text" id="pname" name="pincode" placeholder="Pincode" value="<?php echo $cursor2->pincode;?>">
            </div>
            
          </div>
          
         
        <br><br> 
          
            
 
          <div class="row">
            <div class="col-lg-7">
              <label for="subject1">About Me</label>
                <textarea id="subject" name="about" placeholder="Write about yourself in one line..." rows="2"><?php echo $cursor2->about;?></textarea>
            </div>
          </div>
  
        </br></br>
        
          <div align="center" >
           
             <button type="submit" id="submit" name="submit_profile"
                    class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
  </br>

      <div class="profilecontainer" style="margin-top: 20px;">
       
   
          <header >
              <h2 align="center"><font color="black">Non Disclosure Agreement</h2>
          </header>
          <div align="center">
            
        
            <form action="" method="post" name="fileImport" id="fileImport" enctype="multipart/form-data">
            <input type="file" id="myFile" name="nda" value="Choose File"><br>
            <p><input type="checkbox" name="tandc">&nbsp;I have read and approved <u>general terms</u> and <u>privacy policy</u>.</p>
            <button type="submit" id="submit" name="submit_nda"
                    class="btn btn-success">Upload</button>
            </form>
          </div>
</div>
  
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
            <div class="col-lg-3 ds">
            <!--COMPLETED ACTIONS DONUTS CHART-->
               
            
      
            <!-- First Member -->
            
            <!-- Second Member -->
            
           
           <br>
           <div >
             <h4 class="centered mt">Your Profile</h4>
                
                  <div class="content-panel pn">
                  <div id="profile-02">
                    <div class="user">
                      <img src="<?php echo $cursor2['img_dir_path']?>"  onerror=this.src="img/admin/adminpic.png" class="img-circle" width="80">
                      <h4><?php echo $cursor2['Name'];?></h4>
                      <h5 style="color: white;"><?php echo $cursor2->Email;?></h5>
                      <br>
                      <center><p style="color: white;">"<?php echo $cursor2->about;?>"</p></center>
                      <br>
                    </div>
                    
                  </div>

                  <div class="pr2-social centered">
                    <a href="<?php echo $cursor2->linked_profile;?>"><i class="fa fa-linkedin"></i></a>
                    <a href="<?php echo $cursor2->insta_profile;?>"><i class="fa fa-instagram"></i></a>
                    <a href="<?php echo $cursor2->facebook_profile;?>"><i class="fa fa-facebook"></i></a>
                  </div>
                </div>
                 
                  
                  <footer>
                    
                  </footer>
                
                <!--  /darkblue panel -->
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
