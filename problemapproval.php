<?php
include("adheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
		if(isset($_GET['editid']))
		{
				$sql ="UPDATE user SET status='Active' WHERE userid='$_GET[userid]'";
				$qsql=mysqli_query($con,$sql);
			    $sql ="UPDATE problem SET type='online',departmentid='$_POST[select5]',volunteerid='$_POST[select6]',panchayatrajid='$_POST[select6]',status='Approved',date='$_POST[date]',time='$_POST[time]' WHERE problemid='$_GET[editid]'";
				if($qsql = mysqli_query($con,$sql))
			{
							
				echo "<script>alert('problem record updated successfully...');</script>";				
				echo "<script>window.location='userreport.php?userid=$_GET[userid]&problemid=$_GET[editid]';</script>";
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
				
			$sql ="INSERT INTO problem(type,userid,departmentid,date,time,volunteerid,panchayatrajid,status) values('Online','$_POST[select4]','$_POST[select5]','$_POST[date]','$_POST[time]','$_POST[select6]','$_POST[select6]','$_POST[select]')";
			if($qsql = mysqli_query($con,$sql))
			{
				echo "<script>alert('Problem record inserted successfully...');</script>";
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


<div class="card ">
 
    <div class="block-header">
	<h2 class="text-center">Problem Approval Process</h2>
	</div>
   <form method="post" action="" name="frmprblm" onSubmit="return validateform()">
  
    <table class="table table-striped">                
        <tr>
          <td >User</td>
          <td >
            <?php
			if(isset($_GET['userid']))
			{
				$sqluser= "SELECT * FROM user WHERE userid='$_GET[userid]'";
				$qsqluser = mysqli_query($con,$sqluser);
				$rsuser=mysqli_fetch_array($qsqluser);
				echo $rsuser['username'] . " (User ID - $rsuser[userid])";
			}
			else
			{
				$sqluser= "SELECT * FROM user WHERE status='Active'";
				$qsqluser = mysqli_query($con,$sqluser);
				while($rsuser=mysqli_fetch_array($qsqluser))
				{
					if($rsuser['userid'] == $rsedit['userid'])
					{
					echo "<option value='$rsuser[userid]' selected> $rsuser[username](User ID - $rsuser[userid])</option>";
					}
				}
			}
		  ?>
      </td>
        </tr>

        <tr>
          <td>Department</td>
          <td><select name="select5" id="select5" class="form-control show-tick">
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
          </select></td>
        </tr>
		
        <tr>
          <td>Volunteer</td>
          <td><select name="select6" id="select6" class="form-control show-tick">
            <option value="">Select</option>
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
          </select></td>
        </tr>
		<tr>
          <td>PanchayatRaj</td>
          <td><select name="select6" id="select6" class="form-control show-tick">
            <option value="">Select</option>
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
          </select></td>
        </tr>
		
        <tr>
          <td> Date</td>
          <td><input class="form-control" type="date" name="date" id="date" value="<?php echo $rsedit['date']; ?>" /></td>
        </tr>
        <tr>
          <td> Time</td>
          <td><input class="form-control" type="time" name="time" id="time" value="<?php echo $rsedit['time']; ?>" /></td>
        </tr>
        <tr>
          <td>Problem reason</td>
          <td><input class="form-control" name="proreason" id="proreason" value="<?php echo $rsedit['pro_reason']; ?>"/></td>         
        </tr>
        <tr>
          <td colspan="2" align="center"><input class="btn btn-default" type="submit" name="submit" id="submit" value="Submit" /></td>
        </tr>
      </tbody>
    </table>
    </form>
    <p>&nbsp;</p>
  </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php
include("adfooter.php");
?>
<script type="application/javascript">
function validateform()
{
	if(document.frmprblm.select4.value == "")
	{
		alert("User name should not be empty..");
		document.frmprblm.select4.focus();
		return false;
	}
	else if(document.frmprblm.select5.value == "")
	{
		alert("Department name should not be empty..");
		document.frmprblm.select5.focus();
		return false;
	}
	else if(document.frmprblm.date.value == "")
	{
		alert(" date should not be empty..");
		document.frmprblm.date.focus();
		return false;
	}
	else if(document.frmprblm.time.value == "")
	{
		alert(" time should not be empty..");
		document.frmprblm.time.focus();
		return false;
	}
	else if(document.frmprblm.select6.value == "")
	{
		alert("Volunteer name should not be empty..");
		document.frmprblm.select6.focus();
		return false;
	}
	else if(document.frmprblm.select6.value == "")
	{
		alert("PanchayatRaj name should not be empty..");
		document.frmprblm.select6.focus();
		return false;
	}
	else if(document.frmprblm.select.value == "" )
	{
		alert("Kindly select the status..");
		document.frmprblm.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
$('.out_user').hide();
$('#protype').change(function()
{
	protype=$('#protype').val();
	if(protype=='InUser')
	{
		$('.out_user').show();
	}
	else
	{
		$('.out_user').hide();
	}
});
</script>