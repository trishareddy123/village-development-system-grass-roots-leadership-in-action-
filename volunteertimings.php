<?php
include("adheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
			 $sql ="UPDATE volunteer_timings SET volunteerid='$_POST[select2]',start_time='$_POST[ftime]',end_time='$_POST[ttime]',status='$_POST[select]'  WHERE volunteer_timings_id='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Volunteer Timings record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
	$sql ="INSERT INTO volunteer_timings(volunteerid,start_time,end_time,status) values('$_POST[select2]','$_POST[ftime]','$_POST[ttime]','$_POST[select]')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('Volunteer Timings record inserted successfully...');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
}
if(isset($_GET['editid']))
{
	$sql="SELECT * FROM volunteer_timings WHERE volunteer_timings_id='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>


<div class="container-fluid">
	<div class="block-header">
            <h2 class="text-center">Add New Volunteer Timings</h2>
            
        </div>
  <div class="card">
    
   <form method="post" action="" name="frmvoltimings" onSubmit="return validateform()">
    <table class="table table-hover">
      <tbody>
        <?php
		if(isset($_SESSION['volunteerid']))
		{
			echo "<input class='form-control'  type='hidden' name='select2' value='$_SESSION[volunteerid]' >";
		}
		else
		{
		?>      
        <tr>
          <td width="34%" height="36">Volunteer</td>
          
          <td width="66%"><select class="form-control"  name="select2" id="select2">
           <option value="">Select</option>
            <?php
          	$sqlvolunteer= "SELECT * FROM volunteer WHERE status='Active'";
			$qsqlvolunteer = mysqli_query($con,$sqlvolunteer);
			while($rsvolunteer = mysqli_fetch_array($qsqlvolunteer))
			{
				if($rsvolunteer['volunteerid'] == $rsedit['volunteerid'])
				{
				echo "<option value='$rsvolunteer[volunteerid]' selected>$rsvolunteer[volunteerid] - $rsvolunteer[volunteername]</option>";
				}
				else
				{
				echo "<option value='$rsvolunteer[volunteerid]'>$rsvolunteer[volunteerid] - $rsvolunteer[volunteername]</option>";				
				}
			}
		  ?>
          
          </select></td>
        </tr>
        <?php
		}
		?>
        <tr>
          <td height="36">From</td>
          <td><input class="form-control"  type="time" name="ftime" id="ftime" value="<?php echo $rsedit['start_time']; ?>"></td>
        </tr>
        <tr>
          <td height="34">To</td>
          <td><input  class="form-control" type="time" name="ttime" id="ttime"  value="<?php echo $rsedit['end_time']; ?>" ></td>
        </tr>
        <tr>
          <td height="33">Status</td>
          <td><select class="form-control"  name="select" id="select">
          <option value="">Select</option>
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
           </select></td>
        </tr>
        <tr>
          <td height="36" colspan="2" align="center"><input class="btn btn-default" type="submit" name="submit" id="submit" value="Submit" /></td>
        </tr>
      </tbody>
    </table>
    </form>
    <p>&nbsp;</p>
  </div>
</div>
</div>
 <div class="clear"></div>
  </div>
</div>
<?php
include("adfooter.php");
?>
<script type="application/javascript">
function validateform()
{
	if(document.frmvoltimings.select2.value == "")
	{
		alert(" volunteername should not be empty..");
		document.frmvoltimings.select2.focus();
		return false;
	}
	else if(document.frmvoltimings.ftime.value == "")
	{
		alert("from time should not be empty..");
		document.frmvoltimings.ftime.focus();
		return false;
	}
	else if(document.frmvoltimings.ttime.value == "")
	{
		alert("To time should not be empty..");
		document.frmvoltimings.ttime.focus();
		return false;
	}
	
	else if(document.frmvoltimings.select.value == "" )
	{
		alert("Kindly select the status..");
		document.frmvoltimings.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>