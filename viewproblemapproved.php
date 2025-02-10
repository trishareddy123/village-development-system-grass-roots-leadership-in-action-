<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM problem WHERE problemid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('problem record deleted successfully..');</script>";
	}
}
if(isset($_GET['approveid']))
{
	$sql ="UPDATE problem SET status='Approved' WHERE problemid='$_GET[approveid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Problem record Approved successfully..');</script>";
	}
}
?>
<div class="container-fluid">
<div class="block-header">
        <h2 class="text-center">View Problems - Approved</h2>
    </div>

<div class="card">
	<section class="container">
		<table class="table table-bordered table-striped table-hover js-basic-example dataTable">

			<thead>
				<tr>

					<td>User Detail</td>
					<td>Date & Time</td>
					<td>Department</td>
					<td>Volunteer</td>
					<td>PanchayatRaj</td>
					<td>Problem Reason</td>
					<td>Status</td>
					<td><div align="center">Action</div></td>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql ="SELECT * FROM problem WHERE (status='Approved' OR status='Active')";
				if(isset($_SESSION['userid']))
				{
					$sql  = $sql . " AND userid='$_SESSION[userid]'";
				}
				if(isset($_SESSION['volunteerid']))
				{
					$sql  = $sql . " AND volunteerid='$_SESSION[volunteerid]'";			
				}
				if(isset($_SESSION['panchayatrajid']))
				{
					$sql  = $sql . " AND panchayatrajid='$_SESSION[panchayatrajid]'";			
				}
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
					$sqluser = "SELECT * FROM user WHERE userid='$rs[userid]'";
					$qsqluser = mysqli_query($con,$sqluser);
					$rsuser = mysqli_fetch_array($qsqluser);


					$sqldept = "SELECT * FROM department WHERE departmentid='$rs[departmentid]'";
					$qsqldept = mysqli_query($con,$sqldept);
					$rsdept = mysqli_fetch_array($qsqldept);

					$sqlvol= "SELECT * FROM volunteer WHERE volunteerid='$rs[volunteerid]'";
					$qsqlvol = mysqli_query($con,$sqlvol);
					$rsvol = mysqli_fetch_array($qsqlvol);

					$sqlpan= "SELECT * FROM panchayatraj WHERE panchayatrajid='$rs[panchayatrajid]'";
					$qsqlpan = mysqli_query($con,$sqlpan);
					$rspan = mysqli_fetch_array($qsqlpan);
					echo "<tr>

					<td>&nbsp;$rsuser[username]<br>&nbsp;$rsusr[mobileno]</td>		 
					<td>&nbsp;$rs[date]&nbsp;$rs[time]</td> 
					<td>&nbsp;$rsdept[departmentname]</td>
					<td>&nbsp;$rsvol[volunteername]</td>
					<td>&nbsp;$rspan[panchayatrajname]</td>
					<td>&nbsp;$rs[pro_reason]</td>
					<td>&nbsp;$rs[status]</td>
					<td><div align='center'>";
					if($rs['status'] != "Approved")
					{
						if(!(isset($_SESSION['userid'])))
						{
							echo "<a href='problemapproval.php?editid=$rs[problemid]' class='btn btn-raised g-bg-cyan>Approve</a><hr>";
						}
						echo "  <a href='viewproblem.php?delid=$rs[problemid]' class='btn btn-raised g-bg-blush2'>Delete</a>";
					}
					else
					{
						echo "<a href='userreport.php?userid=$rs[userid]&problemid=$rs[problemid]' class='btn btn-raised bg-cyan'>View Action</a>";
					}
					echo "</center></td></tr>";
				}
				?>
			</tbody>
		</table>
	</section>

</div>
</div> 
<?php
include("adformfooter.php");
?>