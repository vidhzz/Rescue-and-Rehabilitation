<?php
    session_start();
    if($_SESSION["logged_in"]==False){
     header("location: ../loginUser.php");
    }

    $name = $_SESSION["name"];
    $pic = $_SESSION["pic"];
    $userid = $_SESSION["uid"];
	$cnn = mysqli_connect("localhost","root","","rar");
    $childid=$_REQUEST["id"];
   // echo $childid;
    $dd = date("Y-m-d");
    $ck1 = "";
    $ck2 = "";
    $ck3 = "";

    $_SESSION["familyCalled"] = "";
    $_SESSION["fatherCalled"] = "";
    $_SESSION["motherCalled"] = "";
    $_SESSION["relativeCalled"] = "";
    $_SESSION["motherPicked"] = "";
    $_SESSION["fatherPicked"] = "";
    $_SESSION["relativePicked"] = "";
    $_SESSION["familyConfirmed"] = "";


    $qry2 = "select * from familydetails where childid=$childid and fdid=(select max(fdid)
    from familydetails where ChildId=$childid)";

    $result2 = $cnn->query($qry2);
    $nums = mysqli_num_rows($result2);
    $row2 = $result2->fetch_assoc();

    if($nums>0){
        if($row2["familyConfirmed"]=='yes'){
            header("location: address.php?id=$childid");
        }
        else{
        $_SESSION["familyCalled"] = $row2["familyCalled"];
        $_SESSION["fatherCalled"] = $row2["fatherCalled"];
        $_SESSION["motherCalled"] = $row2["motherCalled"];
        $_SESSION["relativeCalled"] = $row2["relativeCalled"];
        $_SESSION["motherPicked"] = $row2["motherPicked"];
        $_SESSION["fatherPicked"] = $row2["fatherPicked"];
        $_SESSION["relativePicked"] = $row2["relativePicked"];
        $_SESSION["familyConfirmed"] = $row2["familyConfirmed"];
        }
    }


	if(isset($_POST["btn"])){

       // echo 'aa';

        if(isset($_POST["ck1"])){
            if(isset($_POST["ck4"])){
                $ans1 = 'yes';
            }
            else{
                $ans1 = 'no';
            }
            $ck1 = 'yes';
        }
        else{
            $ck1 = 'no';
        }

        if(isset($_POST["ck2"])){
            if(isset($_POST["ck5"])){
                $ans2 = 'yes';
            }
            else{
                $ans2 = 'no';
            }
            $ck2 = 'yes';
        }
        else{
            $ck2 = 'no';
        }

        if(isset($_POST["ck3"])){
            if(isset($_POST["ck6"])){
                $ans3 = 'yes';
            }
            else{
                $ans3 = 'no';
            }
            $ck3 = 'yes';
        }
        else{
            $ck3 = 'no';
        }



        if(isset($_POST["rd3"])){

            echo 'aa';
            $rd3 = $_POST["rd3"];
            echo $rd3;
            if($rd3=='yes'){



                $qry1 = "insert into familyDetails (ChildId,familyCalled,dateOfFamilyCalled,
                fatherCalled,motherCalled,relativeCalled,motherPicked,fatherPicked,relativePicked,
                dofCalled,familyConfirmed,dofConfirmed) values ('$childid','yes','$dd','$ck1','$ck2',
                '$ck3','$ans1','$ans2','$ans3','$dd','yes','$dd')";
                $cnn->query($qry1);
                header("location: address.php?id=$childid");
            }
            else{
               // echo 'aa';
                $qry1 = "insert into familyDetails (ChildId,familyCalled,dateOfFamilyCalled,
                fatherCalled,motherCalled,relativeCalled,motherPicked,fatherPicked,relativePicked,
                dofCalled,familyConfirmed,dofConfirmed) values ('$childid','yes','$dd','$ck1','$ck2',
                '$ck3','$ans1','$ans2','$ans3','$dd','no','$dd')";
                $cnn->query($qry1);
                header("location: socialWorker.php");
            }

        }

    }


    if(isset($_POST["exit"])){

        if(isset($_POST["rd"])){

            $rd = $_POST["rd"];



                if($rd=='no'){

                $qry=" insert into familyDetails (ChildId,familyCalled,dateOfFamilyCalled)
                values ('$childid','no','$dd')";


                $cnn->query($qry);
                header("location: socialWorker.php");
                }
            }


        if(isset($_POST["rd4"])){


                if(isset($_POST["ck1"])){

                    $ck1 = 'yes';

                }
                else{
                    $ck1 = 'no';
                }
                if(isset($_POST["ck2"])){
                    $ck2 = 'yes';
                }
                else{
                    $ck2 = 'no';
                }
                if(isset($_POST["ck3"])){
                    $ck3 = 'yes';
                }
                else{
                    $ck3 = 'no';
                }


                $qry="insert into familyDetails (ChildId,familyCalled,dateOfFamilyCalled,
                fatherCalled,motherCalled,relativeCalled,motherPicked,fatherPicked,relativePicked,dofCalled)
                values ('$childid','yes','$dd','$ck1','$ck2','$ck3','no','no','no','$dd')";

                //echo $qry;
                $cnn->query($qry);
                header("location: socialWorker.php");

    }
}

if(isset($_POST["exit1"])){
                        $qry1 = "update childcase set ctsId='4' where ChildId=$childid and statusId='12'";
						$qry2 = "insert into childconference (ChildId,csid) values ('$childid','1')";
						$qry3 = "insert into childtransportcase (ChildId,UserId,ctsId,Dosc) values
						('$childid','$userid','4','$dd')";
						echo $qry3;
						$cnn->query($qry1);
						$cnn->query($qry2);
						$cnn->query($qry3);
						header("location: socialWorker.php");
}


?>

<?php
include_once("socialHeader.php");
?>
<script>
    if(document.getElementById("radYes").checked){
       // alert('hi');
        var chkYes = document.getElementById("rad");
		var chkno = document.getElementById("rad1");
        var chk = document.getElementById("prc");
		chkno.style.display = "None";
		chkYes.style.display = "block";
        chk.style.display = "block";

    }
	function showPara(){
		var chkYes = document.getElementById("rad");
		var chkno = document.getElementById("rad1");
        var chk = document.getElementById("prc");
		chkno.style.display = "None";
		chkYes.style.display = "block";
        chk.style.display = "block";
	}
	function showParaNo(){
		var chkYes = document.getElementById("rad");
        var chk = document.getElementById("prc");
        var cc = document.getElementById("chk1");
		var cd = document.getElementById("chk2");
		cc.style.display = "none";
		cd.style.display = "none";

		var chkno = document.getElementById("rad1");
        chk.style.display = "none";
		chkno.style.display = "block";
		chkYes.style.display = "None";


    }
    function showRdNo(){

       if(document.getElementById("rd4").checked){
                document.getElementById("ck1").checked = false;
                document.getElementById("ck2").checked = false;
                document.getElementById("ck3").checked = false;
                var cc = document.getElementById("chk1");
		        var cd = document.getElementById("chk2");
		        cc.style.display = "block";
		        cd.style.display = "block";
                var chkYes = document.getElementById("rad");
                var chk = document.getElementById("prc");
                var chkno = document.getElementById("rad1");
                chkno.style.display = "block";
                chk.style.display = "none";
                chkYes.style.display = "block";


       }
       else{
            var chkYes = document.getElementById("rad");// who was called and who picked
            var chk = document.getElementById("prc");// is the parent and submit
            var chkno = document.getElementById("rad1");// save and exit
            var cc = document.getElementById("chk1");
		    var cd = document.getElementById("chk2");
		    cc.style.display = "none";
		    cd.style.display = "none";
            chkno.style.display = "none";
            chk.style.display = "block";
            chkYes.style.display = "block";

       }
    }
    function func(){
		if(document.getElementById("chk1").checked){
		var cc = document.getElementById("aa");
		var cd = document.getElementById("ab");
		cc.style.display = "block";
		cd.style.display = "none";
		}
		else{
		var cc = document.getElementById("aa");
		var cd = document.getElementById("ab");
		cc.style.display = "none";
		cd.style.display = "block";
		}
	}

</script>
<div class="main-content">
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
                            <h1>Parent Tracing
								</h1>
                        </div>
                        <!-- /.page-header -->

						<div class="row">
                            <div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
							<!--	<div class="hr dotted"> -->



								<div class="widget-box" style="width:500px; margin:auto;">
											<div class="widget-header">
												<h4 class="smaller">
													Contact Details

												</h4>
											</div>
                                            <form method="post" >

											<div class="widget-body">
												<div class="widget-main">
                                                <div class="well">
                                                <h4 class="green smaller lighter"><font color="#132BAE">Is the family called?</font></h4>
                                                    <input id="radYes" type="radio" value="yes" name="rd" onclick="showPara();" <?php
                                                    if($_SESSION["familyCalled"]=='yes') echo 'checked';
                                                    ?> >&nbsp;yes &nbsp;&nbsp;&nbsp;&nbsp;

													<input type="radio" value="no" name="rd" onclick="showParaNo();" <?php
                                                    if($_SESSION["familyCalled"]=='no') echo 'checked';
                                                    ?> >&nbsp;no


                                                    </div>
                                                                <hr>
													<div id="rad" style="display:none;">





                                                        <div class="well" >
                                                            <h4 class="green smaller lighter"><font color="#132BAE">Who was called?</font></h4>
                                                            <input type="checkbox" value="mother" name="ck1" <?php
                                                            if($_SESSION["motherCalled"]=='yes') echo 'checked';
                                                            ?>>&nbsp;mother &nbsp;&nbsp;&nbsp;&nbsp;
                                                            <input type="checkbox" value="father" name="ck2" <?php
                                                            if($_SESSION["fatherCalled"]=='yes') echo 'checked';
                                                            ?>>&nbsp;father &nbsp;&nbsp;&nbsp;&nbsp;
                                                            <input type="checkbox" value="relative" name="ck3" <?php
                                                            if($_SESSION["relativeCalled"]=='yes') echo 'checked';
                                                            ?>>&nbsp;relative
                                                            <br>
                                                        </div>

                                                        <div class="well">
                                                        <h4 class="green smaller lighter"><font color="#132BAE">Who picked up the call?</font></h4>
                                                            <input id="ck1" type="checkbox" value="mother" name="ck4" onclick="showPara()" <?php
                                                            if($_SESSION["motherPicked"]=='yes') echo 'checked';
                                                            ?>>&nbsp; mother &nbsp;&nbsp;&nbsp;&nbsp;
                                                            <input id="ck2" type="checkbox" value="father" name="ck5" onclick="showPara()" <?php
                                                            if($_SESSION["fatherPicked"]=='yes') echo 'checked';
                                                            ?>>&nbsp;father &nbsp;&nbsp;&nbsp;&nbsp;
                                                            <input id="ck3" type="checkbox" value="relative" name="ck6" onclick="showPara()" <?php
                                                            if($_SESSION["relativePicked"]=='yes') echo 'checked';
                                                            ?>>&nbsp;relative &nbsp;&nbsp;&nbsp;&nbsp;<br>
                                                            <br>
                                                            <input id="rd4" type="checkbox" value="No One" name="rd4" onclick="showRdNo()" <?php
                                                            if($_SESSION["motherPicked"]=='no' and $_SESSION["fatherPicked"]=='no' and
                                                            $_SESSION["relativePicked"]=='no') echo 'checked';
                                                            ?>>&nbsp;No one
                                                            <br>

                                                        </div>




											    </div>

                                                <div class="well" id="prc" style="display:none;">
                                                            <h4 class="green smaller lighter"><font color="#132BAE">Is the parent or relative confirmed?</font></h4>
                                                            <input type="radio" value="yes" name="rd3" <?php
                                                            if($_SESSION["familyConfirmed"]=='yes') echo 'checked';
                                                            ?> >&nbsp;yes &nbsp;&nbsp;&nbsp;&nbsp;

                                                            <input type="radio" value="no" name="rd3" <?php
                                                            if($_SESSION["familyConfirmed"]=='no') echo 'checked';
                                                            ?>>&nbsp;no


                                                            <br><br>
                                                            <div class="center">
                                                                <input type="submit" name="btn" value="Submit" class="btn btn-info">
                                                            </div>
                                                </div>

                                                <div id="rad1" style="display:none;">

                                                    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                                    <input id="ab" class="btn btn-info" type="submit" value="save and exit" name="exit">
                                                    <br><br><br>
                                                    <input id="chk1" type="checkbox" name="conference" onclick="func()">
                                                    <font id="chk2" color="red">Even after many attempts if family does not respond.</font>



                                                 </div>
                                                    <div id="aa" style="display:none;text-align:center;">
                                                    <br><br>
                                                    <input class="btn btn-info" type="submit" value="next" name="exit1">
                                                    </div>
                                                    </form>
												</div>
											</div>
										</div>

                                    </div>
                                    </div>
                                  </div>
                                </div>
                              </div>






<?php
include_once("socialFooter.php");
?>
