<?php

include("adheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
  if(isset($_GET['editid']))
  {
   $sql ="UPDATE problem SET userid='$_POST[select4]',departmentid='$_POST[select5]',date='$_POST[date]',time='$_POST[time]',volunteerid='$_POST[select6]',panchayatrajid='$_POST[select6]'status='$_POST[select]' WHERE problemid='$_GET[editid]'";
   if($qsql = mysqli_query($con,$sql))
   {
    echo "<script>alert('problem record updated successfully...');</script>";
}
else
{
    echo mysqli_error($con);
}	
}
else
{
   $sql ="UPDATE user SET status='Active' WHERE userid='$_POST[select4]'";
   $qsql=mysqli_query($con,$sql);

   $sql ="INSERT INTO problem(userid, departmentid,date, time, volunteerid,panchayatrajid, status, pro_reason) values('$_POST[select4]','$_POST[select5]','$_POST[date]','$_POST[time]','$_POST[select6]','$_POST[select6]','$_POST[select]','$_POST[proreason]')";
   if($qsql = mysqli_query($con,$sql))
   {

    
    echo "<script>alert('Problem record inserted successfully...');</script>";
    echo "<script>window.location='userreport.php?userid=$_POST[select4]';</script>";
}
else
{
    echo mysqli_error($con);
}
}
}
if(isset($_GET['editid']))
{
	$sql="SELECT * FROM problem WHERE problemid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>


<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Tell the Problem</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Problem Information </h2>

                </div>
                <form method="post" action="" name="frmprblm" onSubmit="return validateform()">
                    <input type="hidden" name="select2" value="Offline">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php
                                        if(isset($_GET['patid']))
                                        {
                                          $sqluser= "SELECT * FROM user WHERE userid='$_GET[userid]'";
                                          $qsqluser = mysqli_query($con,$sqluser);
                                          $rsuser=mysqli_fetch_array($qsqluser);
                                          echo $rsuser['username'] . " (User ID - $rsuser[userid])";
                                          echo "<input type='hidden' name='select4' value='$rsuser[userid]'>";
                                      }
                                      else
                                      {
                                          ?>
                                        <select name="select4" id="select4" class=" form-control show-tick">
                                            <option value="">Select User</option>
                                            <?php
                                            $sqluser= "SELECT * FROM user WHERE status='Active'";
                                            $qsqluser = mysqli_query($con,$sqluser);
                                            while($rsuser=mysqli_fetch_array($qsqluser))
                                            {
                                                if($rsuser['userid'] == $rsedit['userid'])
                                                {
                                                 echo "<option value='$rsuser[userid]' selected>$rsuser[userid] - $rsuser[username]</option>";
                                             }
                                             else
                                             {
                                                 echo "<option value='$rsuser[userid]'>$rsuser[userid] - $rsuser[username]</option>";
                                             }

                                         }
                                         ?>
                                        </select>
                                        <?php
                                 }
                                 ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="select5" id="select5" class=" form-control show-tick">
                                            <option value="">Select</option>
                                            <?php
                                    $sqldepartment= "SELECT * FROM department WHERE status='Active'";
                                    $qsqldepartment = mysqli_query($con,$sqldepartment);
                                    while($rsdepartment=mysqli_fetch_array($qsqldepartment))
                                    {
                                       if($rsdepartment['departmentid'] == $rsedit['departmentid'])
                                       {
                                        echo "<option value='$rsdepartment[departmentid]' selected>$rsdepartment[departmentname]</option>";
                                    }
                                    else
                                    {
                                        echo "<option value='$rsdepartment[departmentid]'>$rsdepartment[departmentname]</option>";
                                    }

                                }
                                ?>
                                        </select>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" type="date" name="date"
                                            id="date" value="<?php echo $rsedit['date']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" type="time" name="time" id="time"
                                            value="<?php echo $rsedit['time']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="select6" id="select6" class=" form-control show-tick">
                                            <option value="">Select Volunteer</option>
                                            <?php
                                $sqlvolunteer= "SELECT * FROM volunteer INNER JOIN department ON department.departmentid=volunteer.departmentid WHERE volunteer.status='Active'";
                                $qsqlvolunteer = mysqli_query($con,$sqlvolunteer);
                                while($rsvolunteer = mysqli_fetch_array($qsqlvolunteer))
                                {
                                   if($rsvolunteer['volunteerid'] == $rsedit['volunteerid'])
                                   {
                                    echo "<option value='$rsvolunteer[volunteerid]' selected>$rsvolunteer[volunteername] ( $rsvolunteer[departmentname] ) </option>";
                                }
                                else
                                {
                                    echo "<option value='$rsvolunteer[volunteerid]'>$rsvolunteer[volunteername] ( $rsvolunteer[departmentname] )</option>";				
                                }
                            }
                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="select6" id="select6" class=" form-control show-tick">
                                            <option value="">Select PanchayatRaj</option>
                                            <?php
                                $sqlpanchayatraj= "SELECT * FROM panchayatraj INNER JOIN department ON department.departmentid=panchayatraj.departmentid WHERE panchayatraj.status='Active'";
                                $qsqlpanchayatraj = mysqli_query($con,$sqlpanchayatraj);
                                while($rspanchayatraj = mysqli_fetch_array($qsqlpanchayatraj))
                                {
                                   if($rspanchayatraj['panchayatrajid'] == $rsedit['panchayatrajid'])
                                   {
                                    echo "<option value='$rspanchayatraj[panchayatrajid]' selected>$rspanchayatraj[panchayatrajname] ( $rspanchayatraj[departmentname] ) </option>";
                                }
                                else
                                {
                                    echo "<option value='$rspanchayatraj[panchayatrajid]'>$rspanchayatraj[panchayatrajname] ( $rspanchayatraj[departmentname] )</option>";				
                                }
                            }
                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>




                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="4" class="form-control no-resize" name="proreason"
                                            id="proreason" s><?php echo $rsedit['pro_reason']; ?></textarea>


                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 ">
                                <div class="form-group drop-custum">
                                    <select name="select" id="select" class=" form-control show-tick">

                                        <option value="">Select Status</option>
                                        <?php
                        $arr = array("Active","Inactive");
                        foreach($arr as $val)
                        {
                           if($val == $rsedit['status'])
                           {
                            echo "<option value='$val' selected>$val</option>";
                        }
                        else
                        {
                            echo "<option value='$val'>$val</option>";			  
                        }
                    }
                    ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-12">

                                <input type="submit" class="btn btn-raised g-bg-cyan" name="submit" id="submit"
                                    value="Submit" />

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
















<?php include 'adfooter.php'; ?>
<script type="application/javascript">
function validateform() {
    if (document.frmprblm.select4.value == "") {
        alert("User name should not be empty..");
        document.frmprblm.select4.focus();
        return false;
    }  else if (document.frmprblm.select5.value == "") {
        alert("Department name should not be empty..");
        document.frmprblm.select5.focus();
        return false;
    } else if (document.frmprblm.date.value == "") {
        alert(" date should not be empty..");
        document.frmprblm.date.focus();
        return false;
    } else if (document.frmprblm.time.value == "") {
        alert(" time should not be empty..");
        document.frmprblm.time.focus();
        return false;
    } else if (document.frmprblm.select6.value == "") {
        alert("Volunteer name should not be empty..");
        document.frmappnt.select6.focus();
        return false;
    } else if (document.frmprblm.select6.value == "") {
        alert("PanchayatRaj name should not be empty..");
        document.frmprblm.select6.focus();
        return false;    
    } else if (document.frmprblm.select.value == "") {
        alert("Kindly select the status..");
        document.frmprblm.select.focus();
        return false;
    } else {
        return true;
    }
}
</script>