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
	$sql ="UPDATE user SET status='Active' WHERE userid='$_GET[userid]'";
	$qsql=mysqli_query($con,$sql);
	
	$sql ="UPDATE problem SET status='Approved' WHERE problemid='$_GET[approveid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Problem record Approved successfully..');</script>";
		echo "<script>window.location='viewproblempending.php';</script>";
	}	
}
?>
<div class="container-fluid">
<div class="block-header">
        <h2 class="text-center">View Pending Problems</h2>
    </div>


<div class="card">
	<section class="container">
		<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
			<thead>

				<tr>

					<th>User Detail</th>
					<th>Date & Time</th>
					<th>Department</th>
					<th>Volunteer</th>
					<th>PanchayatRaj</th>
					<th>Problem Reason</th>
					<th>Status</th>
					<th width="15%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql ="SELECT * FROM problem WHERE (status='Pending' OR status='Inactive') ";
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
					$qsqlpan = mysqli_query($con,$sqlvol);
					$rspan = mysqli_fetch_array($qsqlvol);
					echo "<tr>

					<td>&nbsp;$rspat[username]<br>&nbsp;$rspat[mobileno]</td>		 
					<td>&nbsp;" . date("d-M-Y",strtotime($rs['date'])) . " &nbsp; " . date("H:i A",strtotime($rs['time'])) . "</td> 
					<td>&nbsp;$rsdept[departmentname]</td>
					<td>&nbsp;$rsvol[volunteername]</td>
					<td>&nbsp;$rspan[panchayatrajname]</td>
					<td>&nbsp;$rs[pro_reason]</td>
					<td>&nbsp;$rs[status]</td>
					<td>";
					if($rs['status'] != "Approved")
					{
						if(!(isset($_SESSION['userid'])))
						{
							echo "<a href='problemapproval.php?editid=$rs[problemid]&userid=$rs[userid]' class='btn btn-sm btn-raised g-bg-cyan'>Approve</a>";
						}
						echo "  <a href='viewproblem.php?delid=$rs[problemid]' class='btn btn-sm btn-raised g-bg-blush2'>Delete</a>";
					}
					else
					{
						echo "<a href='userreport.php?id=$rsuserid]&problemid=$rs[problemid]' class='btn btn-raised'>View Report</a>";
					}
					echo "</td></tr>";
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