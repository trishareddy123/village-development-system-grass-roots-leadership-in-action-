<?php
include("adheader.php");
include("dbconnection.php");

if (isset($_POST['submit'])) {
    if (isset($_GET['editid'])) {
        $sql = "UPDATE action_records SET 
                    problemid='$_POST[select2]',
                    userid='$_POST[userid]',
                    volunteerid='$_POST[volunteerid]',
                    panchayatrajid='$_POST[panchayatrajid]',
                    description='$_POST[textarea]',
                    date='$_POST[date]',
                    time='$_POST[time]',
                    status='Active' 
                WHERE problemid='$_GET[editid]'";

        if ($qsql = mysqli_query($con, $sql)) {
            echo "<script>alert('Action record updated successfully...');</script>";
        } else {
            echo mysqli_error($con);
        }
    } else {
        $sql = "INSERT INTO action_records(problemid, actionid, userid, volunteerid, panchayatrajid, description, date, time, status) 
                VALUES ('$_POST[select2]', '$_POST[select4]', '$_POST[userid]', '$_POST[volunteerid]', '$_POST[panchayatrajid]', '$_POST[textarea]', '$_POST[date]', '$_POST[time]', 'Active')";

        $qsql = mysqli_query($con, $sql);
        if (mysqli_affected_rows($con) >= 1) {
            echo "<script>alert('Action record inserted successfully...');</script>";
        } else {
            echo mysqli_error($con);
        }
        $volunteerid= $_POST['select5'];
        $panchayatrajid= $_POST['select5'];
    }
}

if (isset($_GET['editid'])) {
    $sql = "SELECT * FROM action_records WHERE problemid='$_GET[editid]'";
    $qsql = mysqli_query($con, $sql);
    $rsedit = mysqli_fetch_array($qsql);
}

if (isset($_GET['delid'])) {
    $sql = "DELETE FROM action_records WHERE problemid='$_GET[delid]'";
    $qsql = mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) == 1) {
        echo "<script>alert('Problem record deleted successfully..');</script>";
    }
}
?>
< class="container-fluid">
    <div class="block-header">
        <h2>Add New Action Records</h2>
    </div>

    < class="card" style="padding: 10px">
        <form method="post" action="" name="frmactrec" onSubmit="return validateform()">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td width="40%">Problem</td>
                        <td width="60%">
                            <input class="form-control" type="text" readonly name="select2" value="<?php echo $_GET['proid']; ?>" />
                        </td>
                    </tr>

                    <!-- User field -->
                    <tr>
                        <td>User</td>
                        <td>
                            <input class="form-control" type="hidden" name="userid" value="<?php echo $_GET['userid']; ?>" />
                            <?php
                            $sqluser = "SELECT * FROM user WHERE status='Active' AND userid='$_GET[userid]'";
                            $qsqluser = mysqli_query($con, $sqluser);
                            $rsuser = mysqli_fetch_array($qsqluser);
                            ?>
                            <input class="form-control" type="text" readonly name="select3" value="<?php echo $rsuser['username']; ?>" />
                        </td>
                    </tr>

                    <!-- Volunteer field -->
                    <?php
		if(isset($_SESSION['volunteerid']))
		{
		?>
        <tr>
          <td>Volunteer</td>
          <td>
    		<?php
				$sqlvolunteer= "SELECT * FROM volunteer INNER JOIN department ON department.departmentid=volunteer.departmentid WHERE volunteer.status='Active' AND volunteer.volunteerid='$_SESSION[volunteerid]'";
				$qsqlvolunteer = mysqli_query($con,$sqlvolunteer);
				while($rsvolunteer = mysqli_fetch_array($qsqlvolunteer))
				{
					echo "$rsvolunteer[volunteername] ( $rsvolunteer[departmentname] )";
				}
				?>
                <input class="form-control" type="hidden" name="select5" value="<?php echo $_SESSION['volunteerid']; ?>"  />
          </td>
        <?php
		}
		else
		{
		?>
        <tr>
          <td>Volunteer</td>
          <td>
          <select name="select5" id="select5">
    		<option value="">Select</option>
    		<?php
				$sqlvolunteer= "SELECT * FROM doctor INNER JOIN department ON department.departmentid=volunteer.departmentid WHERE volunteer.status='Active'";
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
          </td>
        <?php
		}
		?>
          
       
        </tr>

                    <!-- PanchayatRaj field -->
                    <?php
		if(isset($_SESSION['panchayatrajid']))
		{
		?>
        <tr>
          <td>PanchayatRaj</td>
          <td>
    		<?php
				$sqlpanchayatraj= "SELECT * FROM panchayatraj INNER JOIN department ON department.departmentid=panchayatraj.departmentid WHERE panchayatraj.status='Active' AND doctor.doctorid='$_SESSION[doctorid]'";
				$qsqlpanchayatraj = mysqli_query($con,$sqldoctor);
				while($rspanchayatraj = mysqli_fetch_array($qsqldoctor))
				{
					echo "$rspanchayatraj[panchayatrajname] ( $rspanchayatraj[departmentname] )";
				}
				?>
                <input class="form-control" type="hidden" name="select5" value="<?php echo $_SESSION['doctorid']; ?>"  />
          </td>
        <?php
		}
		else
		{
		?>
        <tr>
          <td>PanchayatRaj</td>
          <td>
          <select name="select5" id="select5">
    		<option value="">Select</option>
    		<?php
				$sqlpanchayatraj= "SELECT * FROM panchayatraj INNER JOIN department ON department.departmentid=panchayatraj.departmentid WHERE panchayatraj.status='Active'";
				$qsqlpanchayatraj = mysqli_query($con,$sqlpanchayatraj);
				while($rspanchayatraj = mysqli_fetch_array($qsqlpanchayatraj))
				{
					if($rsdoctor['panchayatrajid'] == $rsedit['panchayatrajid'])
					{
					echo "<option value='$rsdoctor[panchayatrajid]' selected>$rspanchayatraj[panchayatrajname] ( $rspanchayatraj[departmentname] ) </option>";
					}
					else
					{
					echo "<option value='$rspanchayatraj[panchayatrajid]'>$rspanchayatraj[panchayatrajname] ( $rspanchayatraj[departmentname] )</option>";				
					}
				}
		  		?>
          	</select>
          </td>
        <?php
		}
		?>
          
       
        </tr>

                    <!-- Description -->
                    <tr>
                        <td>Description</td>
                        <td><textarea class="form-control" name="textarea" id="textarea" cols="45" rows="5"><?php echo $rsedit['description']; ?></textarea></td>
                    </tr>

                    <!-- Date -->
                    <tr>
                        <td>Date</td>
                        <td><input class="form-control" type="date" max="<?php echo date("Y-m-d"); ?>" name="date" id="date" value="<?php echo $rsedit['date']; ?>" /></td>
                    </tr>

                    <!-- Time -->
                    <tr>
                        <td>Time</td>
                        <td><input class="form-control" type="time" name="time" id="time" value="<?php echo $rsedit['time']; ?>" /></td>
                    </tr>

                    <tr>
                        <td colspan="2" align="center"><input class="form-control" type="submit" name="submit" id="submit" value="Submit" /></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <p>&nbsp;</p>
          <table class="table table-bordered table-striped">
        <tbody>
          <tr>
    
            <td width="78">Volunteer</td>
            <td width="78">PanchayatRaj</td>
            <td width="82">Description</td>
            <td width="43">date</td>
            <td width="43">time</td>
            <td width="54">Status</td>
            <td width="58">Action</td>
          </tr>
          <?php
		$sql ="SELECT * FROM action_records WHERE userid='$_GET[userid]' AND problemid='$_GET[proid]' ";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqluser = "SELECT * FROM user WHERE userid='$rs[userid]'";
			$qsqluser = mysqli_query($con,$sqluser);
			$rsuser = mysqli_fetch_array($qsqluser);
			
			$sqlvol= "SELECT * FROM volunteer WHERE volunteerid='$rs[volunteerid]'";
			$qsqlvol = mysqli_query($con,$sqlvol);
			$rsvol = mysqli_fetch_array($qsqlvol);
			
            $sqlpan= "SELECT * FROM panchayatraj WHERE panchayatrajid='$rs[panchayatrajid]'";
			$qsqlpan = mysqli_query($con,$sqlpan);
			$rspan = mysqli_fetch_array($qsqlpan);
			
			
        echo "<tr>

		    <td>&nbsp;$rsvol[Volunteername]</td>
            <td>&nbsp;$rspan[PanchayatRajname]</td>
			<td>&nbsp;$rs[description]</td>
			 <td>&nbsp;$rs[date]</td>
			  <td>&nbsp;$rs[time]</td>
			    <td>&nbsp;$rs[status]</td>
          <td>&nbsp;
		  <a href='actionrecord.php?editid=$rs[problemid]&userid=$_GET[userid]&proid=$_GET[proid]'>Edit</a>| <a href='actionrecord.php?delid=$rs[actionid]&userid=$_GET[userid]&problemid=$_GET[proid]'>Delete</a> </td>
        </tr>";
		}
		?>
        </tbody>
      </table>
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
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform()
{
	if(document.frmactrec.select2.value == "")
	{
		alert("Problem ID should not be empty..");
		document.frmactrec.select2.focus();
		return false;
	}
	
	else if(document.frmactrec.select3.value == "")
	{
		alert("User ID should not be empty..");
		document.frmactrec.select3.focus();
		return false;
	}
	else if(document.frmactrec.select5.value == "")
	{
		alert("Volunteer ID should not be empty..");
		document.frmactrec.select5.focus();
		return false;
	}
    else if(document.frmactrec.select5.value == "")
	{
		alert("PanchayatRaj ID should not be empty..");
		document.frmactrec.select5.focus();
		return false;
	}
	else if(document.frmactrec.textarea.value == "")
	{
		alert("Description should not be empty..");
		document.frmtreatrec.textarea.focus();
		return false;
	}
	else if(document.frmactrec.date.value == "")
	{
		alert("date should not be empty..");
		document.frmactrec.date.focus();
		return false;
	}
	else if(document.frmactrec.treatmenttime.value == "")
	{
		alert("time should not be empty..");
		document.frmactrec.time.focus();
		return false;
	}
	else if(document.frmactrec.select.value == "" )
	{
		alert("Kindly select the status..");
		document.frmactrec.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>


