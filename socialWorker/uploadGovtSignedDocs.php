
<?php
session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$name = $_SESSION["name"];
$pic = $_SESSION["pic"];
$info="";
$mpid=$_REQUEST["mpid"];

if(isset($_POST["btn"])){
  $doctype=$_POST["doctype"];
}

   if(isset($_FILES['doc'])){
     $docType = $_POST["doctype"];
      $errors= array();
      $file_name = $_FILES['doc']['name'];
      $file_size =$_FILES['doc']['size'];
      $file_tmp =$_FILES['doc']['tmp_name'];
      $file_type=$_FILES['doc']['type'];
      $temp=explode('.',$_FILES['doc']['name']);
      $file_ext=strtolower(end($temp));

      $extensions= array("pdf","doc","docx","jpeg","jpg","png");

      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, use pdf, doc, docx, jpeg, or png files";
      }

      if($file_size > 8097152){
         $errors[]='File size exceed the required!';
      }

      if(empty($errors)==true){
         if(move_uploaded_file($file_tmp,"doc/".$file_name)){

          $cnn = mysqli_connect("localhost","root","","rar");
          $sql1="select * from uploaddocs where mpid='$mpid'";
          $result=$cnn->query($sql1);
          $c = mysqli_num_rows($result);
          if($c<2){
            $sql = "INSERT INTO uploaddocs (mpid, document, doctype) VALUES ('$mpid', '$file_name', '$doctype')";
            //$sql = "INSERT INTO doc (document) VALUES ('$file_name')";
            if (mysqli_query($cnn, $sql)) {
                 $info="<font color='green'>uploaded succesfully</font>";
             }else{
               $info="<font color='red'>upload not successful</font>";

             }
          }else{

            $info="<font color='red'>Documents already submitted!</font>";

          }


         }
      }else{
         print_r($errors);
      }
   }
?>
<?php
include_once("socialHeader.php");
?>
<div class="main-content-inner">


            <div class="page-content">
                <div class="ace-settings-container" id="ace-settings-container">
                    <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                        <i class="ace-icon fa fa-cog bigger-130"></i>
                    </div>

                    <div class="ace-settings-box clearfix" id="ace-settings-box">
                        <div class="pull-left width-50">
                            <div class="ace-settings-item">
                                <div class="pull-left">
                                    <select id="skin-colorpicker" class="hide">
                                        <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                        <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                        <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                        <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                    </select>
                                </div>
                                <span>&nbsp; Choose Skin</span>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
                                <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
                                <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
                                <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
                                <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
                                <label class="lbl" for="ace-settings-add-container">
                                    Inside
                                    <b>.container</b>
                                </label>
                            </div>
                        </div><!-- /.pull-left -->

                        <div class="pull-left width-50">
                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
                                <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
                                <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
                                <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                            </div>
                        </div><!-- /.pull-left -->
                    </div><!-- /.ace-settings-box -->
                </div><!-- /.ace-settings-container -->

                <div class="page-header">
                    <h1>
                  Upload Document


                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->

                          <form action="" method="POST" enctype="multipart/form-data">
                            <div class='center'>
                            Select the document to submit:
                             <select name="doctype">
                              <option>select option</option>
                               <option>Moving Plan</option>
                               <option>Kids details</option>

                            </select>
                            <br><br>
                             <div style="margin-left: 350px;"><input type="file" name="doc" /></div>
                             &emsp;&emsp;<?php echo "$info"; ?>

                             <br>
                             <br>
                             &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                             <input type="submit" name="btn" value="Upload"/>
                             &emsp;&emsp;
                             <a href="socialWorker.php">Done! Go to home page</a>
                             <div>
                          </form>
                      </div>
                    </div>

                        </div>



<?php
include_once("socialFooter.php");
?>
